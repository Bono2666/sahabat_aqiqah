<?php

namespace UltimatePostKit\Modules\PostCalendar;

use UltimatePostKit\Base\Ultimate_Post_Kit_Module_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Module extends Ultimate_Post_Kit_Module_Base {

    public function get_name() {
        return 'post-calendar';
    }

    public function get_widgets() {

        $widgets = [
            'Post_Calendar',
        ];

        return $widgets;
    }

    public function __construct() {
        parent::__construct();

        add_action('wp_ajax_ultimate_post_kit_calendar_post', [$this, 'upk_get_calendar_post']);
        add_action('wp_ajax_nopriv_ultimate_post_kit_calendar_post', [$this, 'upk_get_calendar_post']);

        add_action('wp_ajax_ultimate_post_kit_calendar', [$this, 'upk_get_calendar_show']);
        add_action('wp_ajax_nopriv_ultimate_post_kit_calendar', [$this, 'upk_get_calendar_show']);
    }

    public function upk_get_calendar_post() {


        
        $get_url = sanitize_text_field($_POST['filterDate']);
        

        $url_explode = explode('/', $get_url);

        $year  = $url_explode[0];
        $month = $url_explode[1];
        $date  = $url_explode[2];

        $args = [
            'post_type'      => 'post',
            'posts_per_page' => '3',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_status'    => 'publish',
            'status'         => 'approve',
            // 'paged'          => $paged,
            'date_query'     => [
                [
                    'year'  => $year,
                    'month' => $month,
                    'day'   => $date,
                ],
            ],
        ];

        $wp_query = new \WP_Query($args);

        if (!$wp_query->found_posts) { ?>
            <li class=""><?php echo esc_html('There is no post on today', 'ultimate-post-kit') ?></li>
        <?php
        }
        while ($wp_query->have_posts()) {
            $wp_query->the_post(); ?>
            <li class="upk-post-calendar-title">
                <a href="<?php echo get_the_permalink(); ?>" target="_blank" title="">
                    <?php the_title(); ?>
                </a>
            </li>
            <?php
        }

        wp_reset_postdata();
        die();
    }

    /*
     * Generate months options list for select box
     */
    function getMonthList($selected = '') {
        $options = '';
        for ($i = 1; $i <= 12; $i++) {
            $value = ($i < 10) ? '0' . $i : $i;
            $selectedOpt = ($value == $selected) ? 'selected' : '';
            $options .= '<option value="' . $value . '" ' . $selectedOpt . ' >' . date("F", mktime(0, 0, 0, $i + 1, 0, 0)) . '</option>';
        }
        return $options;
    }

    public function upk_get_calendar($initial = false, $echo = true, $set_month = null, $showPostsList = null) {

        global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;

        $dateMonth = ($set_month != '') ? $set_month : date("m");

        $key   = md5($m . $monthnum . $year);
        $cache = wp_cache_get('upk_get_calendar', 'calendar');

        if ($cache && is_array($cache) && isset($cache[$key])) {
            /** This filter is documented in wp-includes/general-template.php */
            $output = apply_filters('upk_get_calendar', $cache[$key]);

            if ($echo) {
                echo  $output;
                return;
            }

            return $output;
        }

        if (!is_array($cache)) {
            $cache = [];
        }

        // Quick check. If we have no posts at all, abort!
        if (!$posts) {
            $gotsome = $wpdb->get_var("SELECT 1 as test FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' LIMIT 1");
            if (!$gotsome) {
                $cache[$key] = '';
                wp_cache_set('upk_get_calendar', $cache, 'calendar');
                return;
            }
        }

        if (isset($_GET['w'])) {
            $w = sanitize_key($_GET['w']);
        }
        // week_begins = 0 stands for Sunday.
        $week_begins = (int) get_option('start_of_week');

        // Let's figure out when we are.
        if (!empty($monthnum) && !empty($year)) {
            $thismonth = zeroise(intval($monthnum), 2);
            $thisyear  = (int) $year;
        } elseif (!empty($w)) {
            // We need to get the month from MySQL.
            $thisyear = (int) substr($m, 0, 4);
            // It seems MySQL's weeks disagree with PHP's.
            $d         = (($w - 1) * 7) + 6;
            $thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('{$thisyear}0101', INTERVAL $d DAY) ), '%m')");
        } elseif (!empty($m)) {
            $thisyear = (int) substr($m, 0, 4);
            if (strlen($m) < 6) {
                $thismonth = '01';
            } else {
                $thismonth = zeroise((int) substr($m, 4, 2), 2);
            }
        } else {
            $thisyear  = current_time('Y');
            $thismonth = $set_month; //current_time('m');
        }

        $unixmonth = mktime(0, 0, 0, $thismonth, 1, $thisyear);
        $last_day  = gmdate('t', $unixmonth);

        $calendar_caption = _x('%1$s', 'calendar caption');
        $calendar_output  = '<table id="upk-calendar" class="upk-calendar-table">
        <caption><select class="upk-month-dropdown">' . $this->getMonthList($dateMonth) . '</select><span class="upk-year">' . sprintf(
            $calendar_caption,
            // $wp_locale->get_month($thismonth)
            date('Y')
        ) . '</span></caption>


        <thead><tr class="upk-days-name">';


        $myweek = [];

        for ($wdcount = 0; $wdcount <= 6; $wdcount++) {
            $myweek[] = $wp_locale->get_weekday(($wdcount + $week_begins) % 7);
        }

        foreach ($myweek as $wd) {
            $day_name = $initial ? $wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
            $wd       = esc_attr($wd);
            $calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
        }

        $calendar_output .= '
        </tr>
        </thead>
        <tbody class="upk-table-body upk-position-relative">
        <tr>';

        $daywithpost = [];

        // Get days with posts.
        $dayswithposts = $wpdb->get_results(
            "SELECT DISTINCT DAYOFMONTH(post_date)
            FROM $wpdb->posts WHERE post_date >= '{$thisyear}-{$thismonth}-01 00:00:00'
            AND post_type = 'post' AND post_status = 'publish'
            AND post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59'",
            ARRAY_N
        );

        if ($dayswithposts) {
            foreach ((array) $dayswithposts as $daywith) {
                $daywithpost[] = (int) $daywith[0];
            }
        }

        // See how much we should pad in the beginning.
        $pad = calendar_week_mod(gmdate('w', $unixmonth) - $week_begins);
        if (0 != $pad) {
            $calendar_output .= "\n\t\t" . '<td colspan="' . esc_attr($pad) . '" class="pad">&nbsp;</span></td>';
        }

        $newrow      = false;
        $daysinmonth = (int) gmdate('t', $unixmonth);

        for ($day = 1; $day <= $daysinmonth; ++$day) {
            if (isset($newrow) && $newrow) {
                $calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
            }
            $newrow = false;

            if (
                current_time('j') == $day &&
                current_time('m') == $thismonth &&
                current_time('Y') == $thisyear
            ) {
                $calendar_output .= '<td id="today"><span>';
            } else if (in_array($day, $daywithpost, true)) {
                $calendar_output .= '<td class="upk-has-post"><span>';
            } else {
                $calendar_output .= '<td><span class="upk-date">';
            }

            if (in_array($day, $daywithpost, true)) {
                // Any posts today?
                $date_format = gmdate(_x('F j, Y', 'daily archives date format'), strtotime("{$thisyear}-{$thismonth}-{$day}"));
                /* translators: Post calendar label. %s: Date. */
                $label = sprintf(__('Posts published on %s'), $date_format);
                $final_date = $thisyear . '/' . $thismonth . '/' . $day . '/';

                if ('yes' == $showPostsList) {
                    $calendar_output .= sprintf(
                        '<a href="javascript:void(0);" class="upk-click-day" value="%s" aria-label="%s">%s</a>',
                        $final_date,
                        esc_attr($label),
                        $day
                    );
                } else {
                    $calendar_output .= sprintf(
                        '<a href="' . esc_url(site_url() . '/' . $final_date) . '" class="upk-click-day" value="%s" aria-label="%s">%s</a>',
                        $final_date,
                        esc_attr($label),
                        $day
                    );
                }
            } else {
                $calendar_output .= $day;
            }

            $calendar_output .= '</span></td>';

            if (6 == calendar_week_mod(gmdate('w', mktime(0, 0, 0, $thismonth, $day, $thisyear)) - $week_begins)) {
                $newrow = true;
            }
        }

        $pad = 7 - calendar_week_mod(gmdate('w', mktime(0, 0, 0, $thismonth, $day, $thisyear)) - $week_begins);
        if (0 != $pad && 7 != $pad) {
            $calendar_output .= "\n\t\t" . '<td class="pad" colspan="' . esc_attr($pad) . '">&nbsp;</span></td>';
        }

        $calendar_output .= "\n\t</tr>\n\t</tbody>";

        $calendar_output .= "\n\t</table>";

        $cache[$key] = $calendar_output;
        wp_cache_set('upk_get_calendar', $cache, 'calendar');

        if ($echo) {
            /**
             * Filters the HTML calendar output.
             *
             * @since 3.0.0
             *
             * @param string $calendar_output HTML output of the calendar.
             */
            echo apply_filters('upk_get_calendar', $calendar_output);
            return;
        }
        /** This filter is documented in wp-includes/general-template.php */
        return apply_filters('upk_get_calendar', $calendar_output);
    }

    /**
     * Purge the cached results of upk_get_calendar.
     *
     * @see upk_get_calendar
     * @since 2.1.0
     */
    function delete_upk_get_calendar_cache() {
        wp_cache_delete('upk_get_calendar', 'calendar');
    }

    public function upk_get_calendar_show($data) {
        $month = sanitize_text_field($_POST['getMonth']);
        $showPostsList = sanitize_text_field($_POST['showPostsList']);

        $this->upk_get_calendar($initial = false, $echo = true, $month, $showPostsList);
        die();
    }
}
