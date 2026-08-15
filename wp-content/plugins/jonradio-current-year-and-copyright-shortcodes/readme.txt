=== InstallActivateGo.com Copyright Current Date Shortcodes ===
Contributors: adiant, dgewirtz
Tags: copyright, date, year, shortcode, plugin
Tested up to: 6.3.1
Stable tag: 2.0.0
License: GPL-3.0+
License URI: https://www.gnu.org/licenses/gpl-3.0.txt

Provides Shortcodes to display the Copyright symbol and Current Year, Month and Day.

== Description ==

This plugin provides the `[iagc]` shortcode, which can be inserted on a WordPress Page or Post to display the official Copyright notice, a C with a circle around it ("&copy;") required legally in many countries to protect ("copyright") many forms of intellectual property. 

The `[iagy]` shortcode displays the current year. To display the Copyright symbol followed by the current year, use the `[iagcy]` shortcode.

Although not required in a Copyright notice, the `[iagm]` shortcode displays the name of the current month and the `[iagd]` shortcode displays the current day of the month.

Note that the day, month and year are truly Current, accurate to the moment the Page or Post is displayed, based on the Timezone set in WordPress General Settings.

To provide compatibility with previous Versions of this plugin, the `[c]`, `[y]`, `[cy]`, `[m]` and `[d]` shortcodes will still work, but one or more of them will be disabled if any other activated plugin or theme defines the same shortcode, so as not to interfere with that other plugin or theme.

[Click here](https://installactivatego.com/copyright-shortcodes/ "InstallActivateGo.com Copyright Current Date Shortcodes") for examples of the shortcodes and an explanation of their use to create valid U.S.A. Copyright Notices.

== Frequently Asked Questions ==

= Why are some or all of the Shortcodes showing instead of their values being displayed? =

This can happen if this plugin is not activated on the site you are using it on.  Or if you mistyped the name of the Shortcode.

By itself, this plugin only supports Shortcode use in Pages and Posts, i.e. - not even in Comments. Other plugins may expand Shortcode usage into other areas, though older plugins may have stopped working with newer versions of WordPress.

== Changelog ==

= 2.0.0 =
* Added unique Shortcode Names to avoid Naming Collisions with other Plugins and Themes
* Kept previous Shortcode Names, except when another plugin or theme is using the same Shortcode Name
* Use the Time Zone set in WordPress Settings for current date shortcodes

= 1.0.2 =
* Added shortcodes for the current Month and Day of the Month

= 1.0 =
* Copyright shortcode added
* Current Year Shortcode converted from Shortcode Exec PHP plugin to standalone Plugin

== Upgrade Notice ==

= 2.0.0 =
Provides unique shortcode names that will not conflict with other plugins and themes.

= 1.0 =
Production version, updated to meet WordPress Repository standards