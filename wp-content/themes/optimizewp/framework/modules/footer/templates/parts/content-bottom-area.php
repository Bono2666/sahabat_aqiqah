<?php if(($content_bottom_area == "yes") && (is_active_sidebar($content_bottom_area_sidebar))) { ?>
	<div class="mkdf-content-bottom">
		<?php if($content_bottom_area_in_grid == 'yes'){ ?>
			<div class="mkdf-container" <?php optimize_mikado_inline_style($content_bottom_background_color); ?>>
				<div class="mkdf-container-inner clearfix">
		<?php } ?>
				<?php dynamic_sidebar($content_bottom_area_sidebar); ?>
		<?php if($content_bottom_area_in_grid == 'yes'){ ?>
				</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>