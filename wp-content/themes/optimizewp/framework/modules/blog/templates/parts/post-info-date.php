<div class="mkdf-post-info-date">
	<?php if(!optimize_mikado_post_has_title()) { ?>
	<a itemprop="url" href="<?php the_permalink() ?>">
		<?php } ?>
		<time itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time(get_option('date_format')); ?></time>
		<?php if(!optimize_mikado_post_has_title()) { ?>
	</a>
<?php } ?>
</div>