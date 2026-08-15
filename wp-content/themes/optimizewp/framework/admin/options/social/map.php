<?php

if ( ! function_exists('optimize_mikado_social_options_map') ) {

	function optimize_mikado_social_options_map() {

		optimize_mikado_add_admin_page(
			array(
				'slug'  => '_social_page',
				'title' => esc_html__( 'Social Networks', 'optimizewp' ),
				'icon'  => 'fa fa-share-alt'
			)
		);

		/**
		 * Enable Social Share
		 */
		$panel_social_share = optimize_mikado_add_admin_panel(array(
			'page'  => '_social_page',
			'name'  => 'panel_social_share',
			'title' => esc_html__( 'Enable Social Share', 'optimizewp' )
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share',
			'default_value'	=> 'no',
			'label' => esc_html__( 'Enable Social Share', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will allow social share on networks of your choice', 'optimizewp' ),
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_panel_social_networks, #mkdf_panel_show_social_share_on'
			),
			'parent'		=> $panel_social_share
		));

		$panel_show_social_share_on = optimize_mikado_add_admin_panel(array(
			'page'  			=> '_social_page',
			'name'  			=> 'panel_show_social_share_on',
			'title' => esc_html__( 'Show Social Share On', 'optimizewp' ),
			'hidden_property'	=> 'enable_social_share',
			'hidden_value'		=> 'no'
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share_on_post',
			'default_value'	=> 'no',
			'label' => esc_html__( 'Posts', 'optimizewp' ),
			'description' => esc_html__( 'Show Social Share on Blog Posts', 'optimizewp' ),
			'parent'		=> $panel_show_social_share_on
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share_on_page',
			'default_value'	=> 'no',
			'label' => esc_html__( 'Pages', 'optimizewp' ),
			'description' => esc_html__( 'Show Social Share on Pages', 'optimizewp' ),
			'parent'		=> $panel_show_social_share_on
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share_on_attachment',
			'default_value'	=> 'no',
			'label' => esc_html__( 'Media', 'optimizewp' ),
			'description' => esc_html__( 'Show Social Share for Images and Videos', 'optimizewp' ),
			'parent'		=> $panel_show_social_share_on
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_social_share_on_portfolio-item',
			'default_value'	=> 'no',
			'label' => esc_html__( 'Portfolio Item', 'optimizewp' ),
			'description' => esc_html__( 'Show Social Share for Portfolio Items', 'optimizewp' ),
			'parent'		=> $panel_show_social_share_on
		));

		if(optimize_mikado_is_woocommerce_installed()){
			optimize_mikado_add_admin_field(array(
				'type'			=> 'yesno',
				'name'			=> 'enable_social_share_on_product',
				'default_value'	=> 'no',
				'label' => esc_html__( 'Product', 'optimizewp' ),
				'description' => esc_html__( 'Show Social Share for Product Items', 'optimizewp' ),
				'parent'		=> $panel_show_social_share_on
			));
		}

		/**
		 * Social Share Networks
		 */
		$panel_social_networks = optimize_mikado_add_admin_panel(array(
			'page'  			=> '_social_page',
			'name'				=> 'panel_social_networks',
			'title' => esc_html__( 'Social Networks', 'optimizewp' ),
			'hidden_property'	=> 'enable_social_share',
			'hidden_value'		=> 'no'
		));

		/**
		 * Facebook
		 */
		optimize_mikado_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'facebook_title',
			'title' => esc_html__( 'Share on Facebook', 'optimizewp' )
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_facebook_share',
			'default_value'	=> 'no',
			'label' => esc_html__( 'Enable Share', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will allow sharing via Facebook', 'optimizewp' ),
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_facebook_share_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_facebook_share_container = optimize_mikado_add_admin_container(array(
			'name'		=> 'enable_facebook_share_container',
			'hidden_property'	=> 'enable_facebook_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'facebook_icon',
			'default_value'	=> '',
			'label' => esc_html__( 'Upload Icon', 'optimizewp' ),
			'parent'		=> $enable_facebook_share_container
		));

		/**
		 * Twitter
		 */
		optimize_mikado_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'twitter_title',
			'title' => esc_html__( 'Share on Twitter', 'optimizewp' )
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_twitter_share',
			'default_value'	=> 'no',
			'label' => esc_html__( 'Enable Share', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will allow sharing via Twitter', 'optimizewp' ),
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_twitter_share_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_twitter_share_container = optimize_mikado_add_admin_container(array(
			'name'		=> 'enable_twitter_share_container',
			'hidden_property'	=> 'enable_twitter_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'twitter_icon',
			'default_value'	=> '',
			'label' => esc_html__( 'Upload Icon', 'optimizewp' ),
			'parent'		=> $enable_twitter_share_container
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'text',
			'name'			=> 'twitter_via',
			'default_value'	=> '',
			'label' => esc_html__( 'Via', 'optimizewp' ),
			'parent'		=> $enable_twitter_share_container
		));

		/**
		 * Google Plus
		 */
		optimize_mikado_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'google_plus_title',
			'title' => esc_html__( 'Share on Google Plus', 'optimizewp' )
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_google_plus_share',
			'default_value'	=> 'no',
			'label' => esc_html__( 'Enable Share', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will allow sharing via Google Plus', 'optimizewp' ),
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_google_plus_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_google_plus_container = optimize_mikado_add_admin_container(array(
			'name'		=> 'enable_google_plus_container',
			'hidden_property'	=> 'enable_google_plus_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'google_plus_icon',
			'default_value'	=> '',
			'label' => esc_html__( 'Upload Icon', 'optimizewp' ),
			'parent'		=> $enable_google_plus_container
		));

		/**
		 * Linked In
		 */
		optimize_mikado_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'linkedin_title',
			'title' => esc_html__( 'Share on LinkedIn', 'optimizewp' )
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_linkedin_share',
			'default_value'	=> 'no',
			'label' => esc_html__( 'Enable Share', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will allow sharing via LinkedIn', 'optimizewp' ),
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_linkedin_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_linkedin_container = optimize_mikado_add_admin_container(array(
			'name'		=> 'enable_linkedin_container',
			'hidden_property'	=> 'enable_linkedin_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'linkedin_icon',
			'default_value'	=> '',
			'label' => esc_html__( 'Upload Icon', 'optimizewp' ),
			'parent'		=> $enable_linkedin_container
		));

		/**
		 * Tumblr
		 */
		optimize_mikado_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'tumblr_title',
			'title' => esc_html__( 'Share on Tumblr', 'optimizewp' )
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_tumblr_share',
			'default_value'	=> 'no',
			'label' => esc_html__( 'Enable Share', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will allow sharing via Tumblr', 'optimizewp' ),
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_tumblr_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_tumblr_container = optimize_mikado_add_admin_container(array(
			'name'		=> 'enable_tumblr_container',
			'hidden_property'	=> 'enable_tumblr_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'tumblr_icon',
			'default_value'	=> '',
			'label' => esc_html__( 'Upload Icon', 'optimizewp' ),
			'parent'		=> $enable_tumblr_container
		));

		/**
		 * Pinterest
		 */
		optimize_mikado_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'pinterest_title',
			'title' => esc_html__( 'Share on Pinterest', 'optimizewp' )
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_pinterest_share',
			'default_value'	=> 'no',
			'label' => esc_html__( 'Enable Share', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will allow sharing via Pinterest', 'optimizewp' ),
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_pinterest_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_pinterest_container = optimize_mikado_add_admin_container(array(
			'name'				=> 'enable_pinterest_container',
			'hidden_property'	=> 'enable_pinterest_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'pinterest_icon',
			'default_value'	=> '',
			'label' => esc_html__( 'Upload Icon', 'optimizewp' ),
			'parent'		=> $enable_pinterest_container
		));

		/**
		 * VK
		 */
		optimize_mikado_add_admin_section_title(array(
			'parent'	=> $panel_social_networks,
			'name'		=> 'vk_title',
			'title' => esc_html__( 'Share on VK', 'optimizewp' )
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'yesno',
			'name'			=> 'enable_vk_share',
			'default_value'	=> 'no',
			'label' => esc_html__( 'Enable Share', 'optimizewp' ),
			'description' => esc_html__( 'Enabling this option will allow sharing via VK', 'optimizewp' ),
			'args'			=> array(
				'dependence' => true,
				'dependence_hide_on_yes' => '',
				'dependence_show_on_yes' => '#mkdf_enable_vk_container'
			),
			'parent'		=> $panel_social_networks
		));

		$enable_vk_container = optimize_mikado_add_admin_container(array(
			'name'				=> 'enable_vk_container',
			'hidden_property'	=> 'enable_vk_share',
			'hidden_value'		=> 'no',
			'parent'			=> $panel_social_networks
		));

		optimize_mikado_add_admin_field(array(
			'type'			=> 'image',
			'name'			=> 'vk_icon',
			'default_value'	=> '',
			'label' => esc_html__( 'Upload Icon', 'optimizewp' ),
			'parent'		=> $enable_vk_container
		));

		if(defined('MIKADOF_TWITTER_FEED_VERSION')) {
            $twitter_panel = optimize_mikado_add_admin_panel(array(
                'title' => esc_html__( 'Twitter', 'optimizewp' ),
                'name'  => 'panel_twitter',
                'page'  => '_social_page'
            ));

            optimize_mikado_add_admin_twitter_button(array(
                'name'   => 'twitter_button',
                'parent' => $twitter_panel
            ));
        }

        if(defined('MIKADOF_INSTAGRAM_FEED_VERSION')) {
            $instagram_panel = optimize_mikado_add_admin_panel(array(
                'title' => esc_html__( 'Instagram', 'optimizewp' ),
                'name'  => 'panel_instagram',
                'page'  => '_social_page'
            ));

            optimize_mikado_add_admin_instagram_button(array(
                'name'   => 'instagram_button',
                'parent' => $instagram_panel
            ));
        }
	}

	add_action( 'optimize_mikado_options_map', 'optimize_mikado_social_options_map', 12);
}