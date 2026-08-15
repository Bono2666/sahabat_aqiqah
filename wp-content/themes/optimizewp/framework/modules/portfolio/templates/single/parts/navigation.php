<?php if(optimize_mikado_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes') : ?>

    <?php
    $back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    $nav_same_category = optimize_mikado_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';
    ?>

    <div class="mkdf-portfolio-single-nav">
        <?php if($has_prev_post) : ?>
            <div class="mkdf-portfolio-prev <?php if($prev_post_has_image) { echo esc_attr('mkdf-single-nav-with-image'); } ?>">
	            <?php if($prev_post_has_image) : ?>
		            <div class="mkdf-single-nav-image-holder">
			            <a href="<?php echo esc_url($prev_post['link']); ?>">
				            <?php echo optimize_mikado_kses_img($prev_post['image']); ?>
			            </a>
		            </div>
	            <?php endif; ?>

	            <div class="mkdf-single-nav-content-holder">
		            <h6>
			            <a href="<?php echo esc_url($prev_post['link']); ?>">
				            <?php echo esc_html($prev_post['title']); ?>
			            </a>
		            </h6>
		            <a class="mkdf-single-nav-label-holder" href="<?php echo esc_url($prev_post['link']) ?>">
			            <span class="mkdf-single-nav-arrow">
					        <?php echo optimize_mikado_icon_collections()->renderIcon('arrow_carrot-left_alt2', 'font_elegant') ?>
			            </span>
			            <span class="mkdf-single-nav-label"><?php esc_html_e('Previous', 'optimizewp') ?></span>
		            </a>
	            </div>
            </div>
        <?php endif; ?>

        <?php if($back_to_link !== '') : ?>
            <div class="mkdf-portfolio-back-btn">
                <a href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
                    <span class="fa fa-th-large"></span>
                </a>
            </div>
        <?php endif; ?>

        <?php if($has_next_post) : ?>
            <div class="mkdf-portfolio-next <?php if($next_post_has_image) { echo esc_attr('mkdf-single-nav-with-image'); } ?>">
	            <?php if($next_post_has_image) : ?>
		            <div class="mkdf-single-nav-image-holder">
			            <a href="<?php echo esc_url($next_post['link']); ?>">
				            <?php echo optimize_mikado_kses_img($next_post['image']); ?>
			            </a>
		            </div>
	            <?php endif; ?>
	            <div class="mkdf-single-nav-content-holder">
		            <h6>
			            <a href="<?php echo esc_url($next_post['link']); ?>">
				            <?php echo esc_html($next_post['title']); ?>
			            </a>
		            </h6>
		            <a class="mkdf-single-nav-label-holder" href="<?php echo esc_url($next_post['link']) ?>">
			            <span class="mkdf-single-nav-label"><?php esc_html_e('Next', 'optimizewp') ?></span>
			            <span class="mkdf-single-nav-arrow">
				            <?php echo optimize_mikado_icon_collections()->renderIcon('arrow_carrot-right_alt2', 'font_elegant') ?>
			            </span>
		            </a>
	            </div>
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>