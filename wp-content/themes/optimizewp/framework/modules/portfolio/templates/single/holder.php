<?php if($fullwidth) : ?>
<div class="mkdf-full-width">
    <div class="mkdf-full-width-inner">
<?php else: ?>
<div class="mkdf-container">
    <div class="mkdf-container-inner clearfix">
<?php endif; ?>
        <div <?php post_class($holder_class); ?>>
            <?php if(post_password_required()) {
                echo get_the_password_form();
            } else {
                //load proper portfolio template
                optimize_mikado_get_module_template_part('templates/single/single', 'portfolio', $portfolio_template);

                //load portfolio navigation
	            optimize_mikado_portfolio_get_single_navigation();

                //load portfolio comments
                optimize_mikado_get_module_template_part('templates/single/parts/comments', 'portfolio');

            } ?>
        </div>
    </div>
</div>