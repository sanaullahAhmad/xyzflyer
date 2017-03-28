<!-- site footer -->
    <footer id="site-footer" class="site-footer">
        <div class="wrap container">
            <div class="inner row">
                <div class="footer-left col-md-6">
                    <ul class="footer-menu list-inline list-unstyled">
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Legal Statement</a></li>
                    </ul>
                    <!-- footer-menu -->
                    <p class="credits">Copyright &copy; 2015 - <a href="#">Major Properties</a></p>
                </div>
                <!-- footer-left -->
                <div class="footer-right col-md-6">
                    <p class="pull-right text-right">213.747.4151 <br />
                    1200 West Olympic Boulevard <br />
                    Los Angeles, CA 90015</p>
                </div>
                <!-- footer-right -->
            </div>
            <!-- inner -->
        </div>
        <!-- wrap -->
    </footer>
    <!-- end site footer -->

    <!-- footer js resourses -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/bootstrap-lightbox.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/parallax.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/jquery-1.11.3.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/bootstrap.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/parallax.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/design-script.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/fabric.min.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/fabric/fabric_api.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/fabric/text.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/fabric/image.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/fabric/shapes.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/json.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/script.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/dropzone.min.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/wan-spinner.js"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/cropper.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>public/frontend/js/evol.colorpicker.js"></script>
    <script> var base_url = '<?php echo base_url(); ?>' ;</script>
    <script src="http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ['Open Sans',
                    'Roboto',
                    'Lato',
                    'Oswald',
                    'Lora',
                    'Source Sans Pro',
                    'Montserrat',
                    'Raleway',
                    'Ubuntu',
                    'Droid Serif',
                    'Merriweather',
                    'Indie Flower',
                    'Titillium Web',
                    'Poiret One',
                    'Oxygen',
                    'Yanone Kaffeesatz',
                    'Lobster',
                    'Playfair Display',
                    'Fjalla One',
                    'Inconsolata',
                    'Droid Sans',
                    'Droid Serif']
            }
        });
    </script>
    <script type="text/javascript">
         var recaptcha_widgets={};
         function recaptchaLoadCallback(){ 
            try {
                grecaptcha;
            } catch(err){
                return;
            }
            var e=document.querySelectorAll ? document.querySelectorAll('.g-recaptcha') : document.getElementsByClassName('g-recaptcha'),form_submits;
         
            for (var i=0;i<e.length;i++) {
                (function(el){
                    var wid;
                    // check if captcha element is unrendered
                    if ( ! el.childNodes.length) {
                        wid = grecaptcha.render(el,{
                            'sitekey':'6LfyXw4TAAAAAIpIbjBSI7vRGYcMVqig-pN8EJDS',
                            'theme':el.getAttribute('data-theme') || 'light'
                        });
                        el.setAttribute('data-widget-id',wid);
                    } else {
                        wid = el.getAttribute('data-widget-id');
                        grecaptcha.reset(wid);
                    }
                })(e[i]);
            }
         }
         
         // if jquery present re-render jquery/ajax loaded captcha elements 
         if ( typeof jQuery !== 'undefined' )
            jQuery(document).ajaxComplete( function(evt,xhr,set){
                if( xhr.responseText && xhr.responseText.indexOf('6LfyXw4TAAAAAIpIbjBSI7vRGYcMVqig-pN8EJDS') !== -1)
                    recaptchaLoadCallback();
            } );
         
      </script><script src='<?php echo base_url() ?>public/frontend/js/api.js' async="" defer=""></script>
      <!-- END recaptcha -->
      <script type="text/javascript" src="<?php echo base_url() ?>public/frontend/js/owl.carousel.js"></script>
      <script type="text/javascript">
         /* <![CDATA[ */
         var wc_add_to_cart_params = {"ajax_url":"\/propblast\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/propblast\/create-new-flyer\/?wc-ajax=%%endpoint%%","i18n_view_cart":"View Cart","cart_url":"http:\/\/45.33.34.56\/propblast\/cart\/","is_cart":"","cart_redirect_after_add":"no"};
         /* ]]> */
      </script>
      <script type="text/javascript" src='<?php echo base_url() ?>public/frontend/js/add-to-cart.min.js'></script>
      <script type="text/javascript" src='<?php echo base_url() ?>public/frontend/js/jquery.blockUI.min.js'></script>
      <script type="text/javascript">
         /* <![CDATA[ */
         var woocommerce_params = {"ajax_url":"\/propblast\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/propblast\/create-new-flyer\/?wc-ajax=%%endpoint%%"};
         /* ]]> */
      </script>
      <script type="text/javascript" src='<?php echo base_url() ?>public/frontend/js/woocommerce.min.js"></script>
      <script type="text/javascript" src='<?php echo base_url() ?>public/frontend/js/jquery.cookie.min.js"></script>
      <script type="text/javascript">
         /* <![CDATA[ */
         var wc_cart_fragments_params = {"ajax_url":"\/propblast\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/propblast\/create-new-flyer\/?wc-ajax=%%endpoint%%","fragment_name":"wc_fragments"};
         /* ]]> */
      </script>
      <script type="text/javascript" src="<?php echo base_url() ?>public/frontend/js/cart-fragments.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url() ?>public/frontend/js/jquery-ui.js"></script>
      <script type="text/javascript" src="<?php echo base_url() ?>public/frontend/js/jquery.isotope.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url() ?>public/frontend/js/jquery.minicolors.js"></script>
      <script type="text/javascript" src="<?php echo base_url() ?>public/frontend/js/main.js"></script>
      <script type="text/javascript" src="<?php echo base_url() ?>public/frontend/js/comment-reply.min.js"></script>
      <script type="text/javascript">
         /* <![CDATA[ */
         var js_local_vars = {"admin_ajax":"http:\/\/45.33.34.56\/propblast\/wp-admin\/admin-ajax.php","admin_ajax_nonce":"aedf2bf49f","protocol":"","theme_url":"http:\/\/45.33.34.56\/propblast\/wp-content\/themes\/Avada","dropdown_goto":"Go to...","mobile_nav_cart":"Shopping Cart","page_smoothHeight":"false","flex_smoothHeight":"false","language_flag":"","infinite_blog_finished_msg":"<em>All posts displayed.<\/em>","infinite_finished_msg":"<em>All items displayed.<\/em>","infinite_blog_text":"<em>Loading the next set of posts...<\/em>","portfolio_loading_text":"<em>Loading Portfolio Items...<\/em>","faqs_loading_text":"<em>Loading FAQ Items...<\/em>","order_actions":"Details","avada_rev_styles":"1","avada_styles_dropdowns":"0","blog_grid_column_spacing":"40","blog_pagination_type":"load_more_button","body_font_size":"15","custom_icon_image_retina":"","disable_mobile_animate_css":"1","portfolio_pagination_type":"Pagination","header_transparency":"1","header_padding_bottom":"0px","header_padding_top":"0px","header_position":"Top","header_sticky":"1","header_sticky_tablet":"0","header_sticky_mobile":"0","header_sticky_type2_layout":"menu_and_logo","ipad_potrait":"0","is_responsive":"1","isotope_type":"masonry","layout_mode":"boxed","lightbox_animation_speed":"Fast","lightbox_path":"horizontal","lightbox_arrows":"1","lightbox_autoplay":"0","lightbox_desc":"0","lightbox_deeplinking":"1","lightbox_gallery":"1","lightbox_opacity":"0.925","lightbox_post_images":"1","lightbox_skin":"smooth","lightbox_slideshow_speed":"5000","lightbox_social":"1","lightbox_title":"0","logo_alignment":"Left","logo_margin_bottom":"31px","logo_margin_top":"31px","megamenu_max_width":"1100px","mobile_menu_design":"modern","nav_height":"83","nav_highlight_border":"3","page_title_fading":"1","pagination_video_slide":"0","retina_icon_height":"","retina_icon_width":"","submenu_slideout":"1","sidenav_behavior":"Hover","site_width":"1170px","slider_position":"Below","slideshow_autoplay":"1","slideshow_speed":"3000","smooth_scrolling":"1","status_lightbox":"0","status_totop_mobile":"0","status_vimeo":"0","status_yt":"0","testimonials_speed":"4000","tfes_animation":"sides","tfes_autoplay":"1","tfes_interval":"3000","tfes_speed":"800","tfes_width":"150","title_style_type":"single","typography_responsive":"1","typography_sensitivity":"0.6","typography_factor":"1.5","woocommerce_shop_page_columns":"4","woocommerce_23":"1","side_header_width":"0"};
         /* ]]> */
      </script>
      <script type="text/javascript" src="<?php echo base_url() ?>public/frontend/js/main.min.js"></script>
      <style type="text/css">
                              ul.custom-footer-social-icons {
                              display: inline-block;
                              text-align: center;
                              margin-top: 20px;
                              }
                              ul.custom-footer-social-icons li {
                              display: inline-block !important;
                              float: left;
                              text-decoration: none;
                              height: 50px;
                              width: 50px;
                              background-color: #FFF;
                              text-align: center;
                              line-height: 50px;
                              margin: 0px 5px !important;
                              border: 0px !important;
                              border-radius: 50%;
                              }
                              ul.custom-footer-social-icons li a {
                              color: #333;
                              border: 0px !important;
                              padding-top: 0px;
                              font-size: 20px;
                              }
        </style>
      <!--[if lte IE 8]>
      <script type="text/javascript" src="<?php echo base_url(); ?>wp-content/themes/Avada/assets/js/respond.js"></script>
      <![endif]-->
    </body>
</html>
