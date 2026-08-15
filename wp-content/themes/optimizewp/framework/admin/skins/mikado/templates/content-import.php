<div class="mkdf-tabs-content">
    <div class="tab-content">
        <div class="tab-pane fade in active" id="import">
            <div class="mkdf-tab-content">
                <div class="mkdf-page-title-holder clearfix">
                    <h2 class="mkdf-page-title"><?php esc_html_e( 'Import', 'optimizewp' ); ?></h2>
                </div>
                <form method="post" class="mkd_ajax_form mkdf-import-page-holder">
                    <div class="mkdf-page-form">
                        <div class="mkdf-page-form-section-holder">
                            <h3 class="mkdf-page-section-title"><?php esc_html_e( 'Import Demo Content', 'optimizewp' ); ?></h3>
                            <div class="mkdf-page-form-section">
                                <div class="mkdf-field-desc">
                                    <h4><?php esc_html_e( 'Import', 'optimizewp' ); ?></h4>

                                    <p><?php esc_html_e( 'Choose demo content you want to import', 'optimizewp' ); ?></p>
                                </div>
                                <!-- close div.mkdf-field-desc -->

                                <div class="mkdf-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <select name="import_example" id="import_example" class="form-control mkdf-form-element dependence">
                                                    <option value="optimize"><?php esc_html_e( 'Optimize', 'optimizewp' ); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- close div.mkdf-section-content -->

                            </div>

                            <div class="mkdf-page-form-section">


                                <div class="mkdf-field-desc">
                                    <h4><?php esc_html_e( 'Import Type', 'optimizewp' ); ?></h4>

                                    <p><?php esc_html_e( 'Enabling this option will switch to a Side Position (default is Top Position)', 'optimizewp' ); ?></p>
                                </div>
                                <!-- close div.mkdf-field-desc -->



                                <div class="mkdf-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <select name="import_option" id="import_option" class="form-control mkdf-form-element">
                                                    <option value=""><?php esc_html_e( 'Please Select', 'optimizewp' ); ?></option>
                                                    <option value="complete_content"><?php esc_html_e( 'All', 'optimizewp' ); ?></option>
                                                    <option value="content"><?php esc_html_e( 'Content', 'optimizewp' ); ?></option>
                                                    <option value="widgets"><?php esc_html_e( 'Widgets', 'optimizewp' ); ?></option>
                                                    <option value="options"><?php esc_html_e( 'Options', 'optimizewp' ); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- close div.mkdf-section-content -->

                            </div>
                            <div class="mkdf-page-form-section">


                                <div class="mkdf-field-desc">
                                    <h4><?php esc_html_e( 'Import attachments', 'optimizewp' ); ?></h4>

                                    <p>Do you want to import media files?</p>
                                </div>
                                <!-- close div.mkdf-field-desc -->
                                <div class="mkdf-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="field switch">
                                                    <label class="cb-enable dependence"><span><?php esc_html_e( 'Yes', 'optimizewp' ); ?></span></label>
                                                    <label class="cb-disable selected dependence"><span><?php esc_html_e( 'No', 'optimizewp' ); ?></span></label>
                                                    <input type="checkbox" id="import_attachments" class="checkbox" name="import_attachments" value="1">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- close div.mkdf-section-content -->
                            </div>
                            <div class="mkdf-page-form-section">


                                <div class="mkdf-field-desc">
                                    <input type="submit" class="btn btn-primary btn-sm " value="<?php esc_attr_e('Import','optimizewp'); ?>" name="import" id="import_demo_data" />
                                </div>
                                <!-- close div.mkdf-field-desc -->
                                <div class="mkdf-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="import_load"><span><?php esc_html_e('The import process may take some time. Please be patient.', 'optimizewp') ?> </span><br />
                                                    <div class="mkd-progress-bar-wrapper html5-progress-bar">
                                                        <div class="progress-bar-wrapper">
                                                            <progress id="progressbar" value="0" max="100"></progress>
                                                        </div>
                                                        <div class="progress-value">0%</div>
                                                        <div class="progress-bar-message">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- close div.mkdf-section-content -->
                            </div>
                            <div class="mkdf-page-form-section mkdf-import-button-wrapper">

                                <div class="alert alert-warning">
                                    <strong><?php esc_html_e('Important notes:', 'optimizewp') ?></strong>
                                    <ul>
                                        <li><?php esc_html_e('Please note that import process will take time needed to download all attachments from demo web site.', 'optimizewp'); ?></li>
                                        <li> <?php esc_html_e('If you plan to use shop, please install WooCommerce before you run import.', 'optimizewp')?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div><!-- close mkdf-tab-content -->
        </div>
    </div>
</div> <!-- close div.mkdf-tabs-content -->

<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $(document).on('click', '#import_demo_data', function(e) {
                e.preventDefault();
                if (confirm('Are you sure, you want to import Demo Data now?')) {
                    $('.import_load').css('display','block');
                    var progressbar = $('#progressbar');
                    var import_opt = $( "#import_option" ).val();
                    var import_expl = $( "#import_example" ).val();
                    var p = 0;
                    if(import_opt == 'content'){
                        for(var i=1;i<10;i++){
                            var str;
                            if (i < 10) str = 'optimize_content_0'+i+'.xml';
                            else str = 'optimize_content_'+i+'.xml';
                            jQuery.ajax({
                                type: 'POST',
                                url: ajaxurl,
                                data: {
                                    action: 'mkd_dataImport',
                                    xml: str,
                                    example: import_expl,
                                    import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
                                },
                                success: function(data, textStatus, XMLHttpRequest){
                                    p+= 10;
                                    $('.progress-value').html((p) + '%');
                                    progressbar.val(p);
                                    if (p == 90) {
                                        str = 'optimize_content_10.xml';
                                        jQuery.ajax({
                                            type: 'POST',
                                            url: ajaxurl,
                                            data: {
                                                action: 'mkd_dataImport',
                                                xml: str,
                                                example: import_expl,
                                                import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
                                            },
                                            success: function(data, textStatus, XMLHttpRequest){
                                                p+= 10;
                                                $('.progress-value').html((p) + '%');
                                                progressbar.val(p);
                                                $('.progress-bar-message').html('<div class="alert alert-success"><strong><?php esc_html_e( 'Import is completed', 'optimizewp' ); ?></strong></div>');
                                            },
                                            error: function(MLHttpRequest, textStatus, errorThrown){
                                            }
                                        });
                                    }
                                },
                                error: function(MLHttpRequest, textStatus, errorThrown){
                                }
                            });
                        }
                    } else if(import_opt == 'widgets') {
                        jQuery.ajax({
                            type: 'POST',
                            url: ajaxurl,
                            data: {
                                action: 'mkd_widgetsImport',
                                example: import_expl
                            },
                            success: function(data, textStatus, XMLHttpRequest){
                                $('.progress-value').html((100) + '%');
                                progressbar.val(100);
                            },
                            error: function(MLHttpRequest, textStatus, errorThrown){
                            }
                        });
                        $('.progress-bar-message').html('<div class="alert alert-success"><strong><?php esc_html_e( 'Import is completed', 'optimizewp' ); ?></strong></div>');
                    } else if(import_opt == 'options'){
                        jQuery.ajax({
                            type: 'POST',
                            url: ajaxurl,
                            data: {
                                action: 'mkd_optionsImport',
                                example: import_expl
                            },
                            success: function(data, textStatus, XMLHttpRequest){
                                $('.progress-value').html((100) + '%');
                                progressbar.val(100);
                            },
                            error: function(MLHttpRequest, textStatus, errorThrown){
                            }
                        });
                        $('.progress-bar-message').html('<div class="alert alert-success"><strong><?php esc_html_e( 'Import is completed', 'optimizewp' ); ?></strong></div>');
                    }else if(import_opt == 'complete_content'){
                        for(var i=1;i<10;i++){
                            var str;
                            if (i < 10) str = 'optimize_content_0'+i+'.xml';
                            else str = 'optimize_content_'+i+'.xml';
                            jQuery.ajax({
                                type: 'POST',
                                url: ajaxurl,
                                data: {
                                    action: 'mkd_dataImport',
                                    xml: str,
                                    example: import_expl,
                                    import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
                                },
                                success: function(data, textStatus, XMLHttpRequest){
                                    p+= 10;
                                    $('.progress-value').html((p) + '%');
                                    progressbar.val(p);
                                    if (p == 90) {
                                        str = 'optimize_content_10.xml';
                                        jQuery.ajax({
                                            type: 'POST',
                                            url: ajaxurl,
                                            data: {
                                                action: 'mkd_dataImport',
                                                xml: str,
                                                example: import_expl,
                                                import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
                                            },
                                            success: function(data, textStatus, XMLHttpRequest){
                                                jQuery.ajax({
                                                    type: 'POST',
                                                    url: ajaxurl,
                                                    data: {
                                                        action: 'mkd_otherImport',
                                                        example: import_expl
                                                    },
                                                    success: function(data, textStatus, XMLHttpRequest){
                                                        //alert(data);
                                                        $('.progress-value').html((100) + '%');
                                                        progressbar.val(100);
                                                        $('.progress-bar-message').html('<div class="alert alert-success"><?php esc_html_e( 'Import is completed.', 'optimizewp' ); ?></div>');
                                                    },
                                                    error: function(MLHttpRequest, textStatus, errorThrown){
                                                    }
                                                });
                                            },
                                            error: function(MLHttpRequest, textStatus, errorThrown){
                                            }
                                        });
                                    }
                                },
                                error: function(MLHttpRequest, textStatus, errorThrown){
                                }
                            });
                        }
                    }
                }
                return false;
            });
        });
    })(jQuery);

</script>