<div class="mkdf-portfolio-info-item">
    <h5 itemprop="headline" class="mkdf-portfolio-item-title"><?php the_title(); ?></h5>

	<?php optimize_mikado_portfolio_get_info_part('categories'); ?>

    <div itemprop="description" class="mkdf-portfolio-item-content">
        <?php the_content(); ?>
    </div>
</div>