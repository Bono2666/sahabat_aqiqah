<?php if(has_post_thumbnail()) : ?>
	<div class="mkdf-post-image" itemprop="image">
		<?php the_post_thumbnail('full'); ?>
	</div>
<?php endif; ?>