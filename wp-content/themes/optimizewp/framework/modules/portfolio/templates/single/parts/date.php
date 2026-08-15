<?php if(optimize_mikado_options()->getOptionValue('portfolio_single_hide_date') !== 'yes') : ?>

    <div class="mkdf-portfolio-info-item mkdf-portfolio-date">
        <h6><?php esc_html_e('Date', 'optimizewp'); ?></h6>

        <p>
	        <time itemprop="datePublished" datetime="<?php echo esc_attr(the_time('Y-m-d')); ?>">
		        <?php the_time(get_option('date_format')); ?>
	        </time>
        </p>
    </div>

<?php endif; ?>