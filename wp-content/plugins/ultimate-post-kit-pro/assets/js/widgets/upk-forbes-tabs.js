; (function ($) {
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction("frontend/element_ready/upk-forbes-tabs.default", function (scope) {

            scope.find('.upk-forbes-tabs').each(function () {
                // alert("hmm");
                var element = $(this)[0];

                if (element) {
                    var showHide = $(this).data('show-hide');
                    var tabs = $(this).find('.upk-option');
                    var responsive_tabs = $(this).find('.upk-filter-item');
                    var tabs_header = $(this).find('.upk-forbes-tabs-header-wrap')
                    var item_wrapper = $(this).find('.upk-forbes-tabs-grid-wrapper');
                    var settings = item_wrapper.data('settings');

                    tabs.on('click', function (e) {
                        var category = $(this).data('slug');
                        tabs_header.find('li').removeClass('upk-forbes-tabs-active');
                        $(this).parent().addClass('upk-forbes-tabs-active');
                        e.preventDefault();
                        $.ajax({
                          url: UltimatePostKitConfig.ajaxurl,
                          data: {
                            action: "upk_forbes_tabs",
                            post_type: settings["post_type"],
                            taxonomy: settings["taxonomy"],
                            order: settings["order"],
                            orderby: settings["orderby"],
                            meta_separator: settings["meta_separator"],
                            title_text_limit: settings["title_text_limit"],
                            category: category,
                            show_category: showHide['show_category'],
                            show_title: showHide['show_title'],
                            show_meta: showHide['show_meta'],
                            show_author: showHide['show_author']


                          },
                          type: "POST",
                          dataType: "HTML",
                          success: function (response) {
                            item_wrapper.html(response);
                          },
                          error: function (response) {
                            console.log(response);
                          },
                        });
                    });
                    responsive_tabs.on('change', function (e) {
                        var slug = $(this).val();
                        e.preventDefault();
                        $.ajax({
                            url: UltimatePostKitConfig.ajaxurl,
                            data: {
                                action: "upk_forbes_tabs",
                                settings: settings,
                                post_type: settings['post-type'],
                                showHide: showHide,
                                data: slug,
                            },
                            type: "POST",
                            dataType: "HTML",
                            success: function (response) {
                                item_wrapper.html(response)
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