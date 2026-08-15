<div class="mkdf-post-info-comments-holder mkdf-post-info-item">
	<a class="mkdf-post-info-comments" href="<?php comments_link(); ?>">
		<span class="mkdf-post-info-comments-icon">
			<?php echo optimize_mikado_icon_collections()->renderIcon('icon_comment', 'font_elegant'); ?>
		</span>
		<span itemprop="commentCount"><?php comments_number('0', '1', '%'); ?></span>
	</a>
</div>