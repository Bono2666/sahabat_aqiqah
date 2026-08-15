<?php if(optimize_mikado_core_installed()) { ?>
<div class="mkdf-blog-like mkdf-post-info-item">
	<?php if( function_exists('optimize_mikado_get_like') ) optimize_mikado_get_like(); ?>
</div>
<?php } ?>