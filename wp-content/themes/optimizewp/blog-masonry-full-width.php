<?php
	/*
	Template Name: Blog: Masonry Full Width
	*/
?>
<?php get_header(); ?>

<?php optimize_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>

	<div class="mkdf-full-width">
		<div class="mkdf-full-width-inner clearfix">
			<?php optimize_mikado_get_blog('masonry-full-width'); ?>
		</div>
	</div>
<?php get_footer(); ?>