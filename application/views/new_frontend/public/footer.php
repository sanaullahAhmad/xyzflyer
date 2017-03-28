

			<footer id="footer">
				<div class="container">
					<div class="row">
						<div class="footer-ribbon">
							<span>Get in Touch</span>
						</div>
						<div class="col-md-3">
							<div class="">
								<h4>Newsletter</h4>
								<p>Keep up on our always evolving product features and technology. Enter your e-mail and subscribe to our newsletter.</p>
								<form id="Newsletter" action="<?php echo base_url();?>Newsletter/newsletter_subscribe" method="POST" onsubmit="return validateForm();">
									<div class="input-group">
										<input class="form-control" placeholder="Email Address" name="newsletterEmail" type="email">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit">Go!</button>
										</span>
									</div>
								</form>
							</div>
						</div>
						<script>
						
							function validateForm() {
								var x = document.forms["Newsletter"]["newsletterEmail"].value;
								var atpos = x.indexOf("@");
								var dotpos = x.lastIndexOf(".");
								if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
								swal('Invalid Email','Please Enter Valid Email.', 'error');
									return false;
								}
							}
						</script>
						<div class="col-md-3">
							<h4>Latest Tweets</h4>
							<div id="tweet" class="twitter" data-plugin-tweets data-plugin-options='{"xyzflyers": "", "count": 3}'>
								<a class="twitter-timeline" data-lang="en" data-width="300" data-height="260" data-dnt="true" href="https://twitter.com/xyzflyers">Tweets by xyzflyers</a>
								<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
							</div>
						</div>
						<div class="col-md-4">
							<div class="contact-details">
								<h4>Contact Us</h4>
								<ul class="contact">
									<li><p><i class="fa fa-map-marker"></i> <strong>Address:</strong> 20 S Santa Cruz Avenue, Suite 300, <br>Los Gatos, CA 95030</p></li>
									<li><p><i class="fa fa-phone"></i> <strong>Phone:</strong> 408-335-6169 </p></li>
									<li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a mailto="sales@xyzflyers.com">sales@xyzflyers.com</a></p></li>
								</ul>
							</div>
						</div>
						<div class="col-md-2">
							<h4>Follow Us</h4>
							<ul class="social-icons">
								<li class="social-icons-facebook"><a href="http://www.facebook.com/xyzflyers" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
								<li class="social-icons-twitter"><a href="http://www.twitter.com/xyzflyers" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
								<li class="social-icons-linkedin"><a href="http://www.linkedin.com/company/xyz-flyers" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
								<li class="social-icons-pinterest"><a href="https://www.pinterest.com/xyzflyers/" target="_blank" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
							</ul>
							<br>
							<li><a href="<?= site_url('cookie-policy');?>">Cookie Policy</a></li>
							<li><a href="<?= site_url('privace-policy');?>">Privacy Policy</a></li>
						    <li><a href="<?= site_url('disclaimer');?>">Disclaimer</a></li>
							<li><a href="<?= site_url('terms');?>">Terms And Conditions</a></li>
						</div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							
								
							
							<div class="col-md-7">
								<p>XYZ Flyers© Copyright <?php echo date('Y'); ?>. All Rights Reserved.</p>
							</div>
							<div class="col-md-4">
								<nav id="sub-menu">
									<ul>
									<!--	<li><a href="<?= site_url('faqs');?>">FAQ's</a></li> -->
										<li><a href="<?= site_url('sitemap');?>">Sitemap</a></li>
										<li><a href="<?= site_url('contact-us');?>">Contact</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<script src="<?= base_url('public/new_frontend/vendor/jquery/jquery.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/jquery.appear/jquery.appear.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/jquery.easing/jquery.easing.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/jquery-cookie/jquery-cookie.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/bootstrap/js/bootstrap.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/common/common.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/jquery.validation/jquery.validation.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/jquery.stellar/jquery.stellar.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/jquery.gmap/jquery.gmap.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/jquery.lazyload/jquery.lazyload.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/isotope/jquery.isotope.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/owl.carousel/owl.carousel.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/magnific-popup/jquery.magnific-popup.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/vide/vide.min.js');?>"></script>

<script src="<?=base_url('assets/js/jRoll.min.js')?>"></script>
<script>$('#ajax_loader .loader').jRoll({
	  animation: "pulse",
	  radius: 100,
	  overflow: 'visible',
	  colors: ['#046476','#29DCFF','#61FFD5']
	});</script>
	
		<!-- Theme Base, Components and Settings -->
		<script src="<?= base_url('public/new_frontend/js/theme.js');?>"></script>

		<!-- Theme Custom -->
		<script src="<?= base_url('public/new_frontend/js/custom.js');?>"></script>

		<!-- Theme Initialization Files -->
		<script src="<?= base_url('public/new_frontend/js/theme.init.js');?>"></script>

		<script src='https://www.google.com/recaptcha/api.js'></script>
		
	<? if($this->uri->segment(1)=='editor' || $this->uri->segment(1)=='order' || $this->uri->segment(1)=='start')
	{?>

		<script src="<?= base_url('public/new_frontend/flyer/js/parallax.js');?>"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/design-script.js');?>"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/fabric.min.js');?>"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/fabric_api.js');?>"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/text.js');?>"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/image.js');?>"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/shapes.js');?>"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/json.js');?>"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/script.js');?>"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/dropzone.min.js');?>"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/wan-spinner.js');?>"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/cropper.js');?>"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/jquery-ui.min.js');?>" type="text/javascript"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/evol.colorpicker.js');?>"></script>
	    <script src="<?= base_url('public/new_frontend/flyer/js/jquery.qtip.min.js');?>"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
	    

	<? } ?>
	    <!-- Current Page Vendor and Views -->
		<script src="<?= base_url('public/new_frontend/vendor/rs-plugin/js/jquery.themepunch.tools.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/js/views/view.home.js');?>"></script>
		<script src="<?= base_url('public/new_frontend/flyer/js/bootstrap-colorpalette.js');?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.13/js/perfect-scrollbar.jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.0.0/bootbox.min.js"></script>
<!---Auto Complete-->
<script src="<?php echo base_url(); ?>public/new_frontend/autocomplete/jquery-ui.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
	  	$(function(){
	  		//var state = $("#state_code").val();
		   /* $( "#city" ).autocomplete({
		      source: '<?php echo base_url(); ?>newdesign/get_cities'
		    });*/
		    $("#city").autocomplete({
		        source: function(request, response) {
		        	var stateCode = $("#state_code").val();
		        	if(stateCode==""){
		        		alert("please select state");

		        	}else{
		        		$.ajax({
		                url: '<?php echo base_url(); ?>newdesign/get_cities',
		                dataType: "json",
		                data: {
		                    term : request.term,
		                    state : stateCode
		                }, beforeSend: function(data){
		           
		                    $(".autocomplete-animation").show();
		                },
		                success: function(data){
		                    response(data);
		                    $(".autocomplete-animation").hide();
		                }
		            });
		          }    
		        },
		        min_length: 3,
		        delay: 300
		    });
	  	});
	});
</script>
<? //if($this->uri->segment(1)=='pricing') { ?> 
<script>$('#selected_counties').perfectScrollbar();</script>

<? if($this->uri->segment(1)=='editor' || $this->uri->segment(1)=='order' || $this->uri->segment(1)=='start' || $this->uri->segment(1)=='pricing') { ?> 
<script src="<?=base_url('public/new_frontend/js/pricing.js')?>"></script>
<?	} ?>


<!-- /*<script src="<?=base_url('public/new_frontend/js/pricing_user.js')?>"></script>*/ -->
<?//	} ?>
<?php if($this->uri->segment(1) == "alpha" ) { ?>
<script type="text/javascript">
   $(window).scroll(function() {
   var hT = $('#counter_div').offset().top,
       hH = $('#counter_div').outerHeight(),
       wH = $(window).height(),
       wS = $(this).scrollTop();
        if (wS > (hT+hH-wH)){
			setTimeout(function(){
				$("#totAgt").text($("#totAgt").text().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
				$("#totAcnt").text($("#totAcnt").text().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
				$("#totCit").text($("#totCit").text().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
				$("#delEmail").text($("#delEmail").text().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
			},5000);
		  }    
		});
	</script>
	<?php } ?>
	</body>
</html>
