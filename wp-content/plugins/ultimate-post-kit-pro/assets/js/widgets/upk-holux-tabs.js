; (function ($) {
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction("frontend/element_ready/upk-holux-tabs.default", function (scope) {
            scope.find('.ultimate-post-kit-holux-tabs-wrap').each(function () {
                var element = $(this)[0];
                if (element) {
                    var settings = $(this).data('settings');
                    var tabs = $(this).find('.post-tab-option');
                    var tabs_header = $(this).find('.upk-holux-tabs-header-tabs')
                    var item = $(this).find('.upk-holux-tabs');
                    tabs.on('click', function (e) {
                        var data = $(this).data('settings');

                        tabs_header.find('li').removeClass('upk-holux-tabs-active');
                        $(this).parent().addClass('upk-holux-tabs-active');
                        e.preventDefault();
                        $.ajax({
                          url: UltimatePostKitConfig.ajaxurl,
                          data: {
                            action: "upk_holux_tabs",
                            // settings: settings,
                            meta_separator: settings["meta_separator"],
                            order: settings["order"],
                            posts_per_page: settings["posts_per_page"],
                            show_author: settings["show_author"],
                            show_category: settings["show_category"],
                            show_date: settings["show_date"],
                            show_meta: settings["show_meta"],
                            show_title: settings["show_title"],
                            title_tags: settings["title_tags"],
                            trending_days_limit:settings["trending_days_limit"],

                            filter_by: data['filter_by'],
                            post_format: data['post_format'],
                            post_type: data['post_type']
                          },
                          type: "POST",
                          dataType: "HTML",
                          success: function (response) {
                            item.html(response);
                          },
                          error: function (response) {
                            console.log(response);
                          },
                        });
                    })
                }
            });
        });
    });
})(jQuery);
