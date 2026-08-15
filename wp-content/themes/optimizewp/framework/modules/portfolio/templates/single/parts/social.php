
    <div class="mkdf-portfolio-item-social">
	    <?php if(optimize_mikado_options()->getOptionValue('enable_social_share') == 'yes'
	             && optimize_mikado_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes' && optimize_mikado_core_installed()) : ?>
		    <div class="mkdf-portfolio-single-share-holder">
				<span class="mkdf-share-label">
				    <?php esc_html_e('Share', 'optimizewp'); ?>
			    </span>
			    <?php echo optimize_mikado_get_social_share_html() ?>
		    </div>
	    <?php endif; ?>
		<div class="mkdf-portfolio-single-likes">
			<?php echo optimize_mikado_like_portfolio_list(get_the_ID()); ?>
		</div>
    </div>
