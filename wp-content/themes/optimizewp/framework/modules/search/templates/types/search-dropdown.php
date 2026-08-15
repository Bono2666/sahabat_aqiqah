<form action="<?php echo esc_url(home_url('/')); ?>" class="mkdf-search-dropdown-holder" method="get">
	<div class="form-inner">
		<input type="text" placeholder="<?php esc_attr_e('Type...', 'optimizewp'); ?>" name="s" class="mkdf-search-field" autocomplete="off"/>
		<input value="<?php esc_attr_e('Search', 'optimizewp'); ?>" type="submit" class="mkdf-btn mkdf-btn-solid mkdf-btn-small">
	</div>
</form>