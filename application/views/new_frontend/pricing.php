<?php 
$this->load->view('new_frontend/public/head');?>
<style>
	#selected_counties{ font-size: 14px;height: 200px;overflow: auto;position: relative;}
</style>
<?php
$this->load->view('new_frontend/public/header');
?>
<!-- pricing content -->
<div role="main" class="main">
	<section class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="<?= site_url('newdesign');?>">Home</a></li>
						<li></li>Pricing</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>Pricing</h1>
				</div>
			</div>
		</div>
	</section>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12 center mb-xl">
						<h2 class="mb-sm mt-md">Email Flyer <strong>Pricing</strong> and<strong> Delivery</strong> Areas</h2>
						<p class="lead mb-xl">Reaching over <?php if(isset($overall_emails)){ echo number_format($overall_emails->overallEmails);} ?> Real Estate Professionals Nationwide for a flat fee of only $39.95</p>
						<h4 class="heading-primary alternative-font mt-xl pt-xl"><strong class="custom-underline">Pick a state to check Pricing</strong></h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<div id="tooltip"></div><!-- div to hold tooltip. -->
						<svg width="960" height="600" id="statesvg"></svg> <!-- svg to hold the map. -->
						<script src="<?php echo site_url(); ?>public/new_frontend/flyer/uStates-less.js"></script> <!-- creates uStates. -->
						<script src="https://d3js.org/d3.v3.min.js"></script>
						<script>
							function tooltipHtml(n, d){
								return "<h4 style='color:white;'>"+n+"</h4><table class='statesAgt'>"+"<tr><td>Agents</td><td>"+(d.agents.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") )+"</td></tr>"+"</table>";
							}
							var sampleData ={};	/* Sample random data. */
							<?php echo json_encode($us_state_agents); ?>.forEach(function(d){
										// var low=Math.round(100*Math.random()),
										// mid=Math.round(100*Math.random()),
										// high=Math.round(100*Math.random());
										sampleData[d.code]={code:d.code, agents:d.agt, color:"#0088cc"};
									});
										//console.log(sampleData);
										/* draw states on id #statesvg */
										uStates.draw("#statesvg", sampleData, tooltipHtml);
										d3.select(self.frameElement).style("height", "600px");
									</script>
									<style type="text/css">
										#county_list{
											font-size:16px;
											color: #777777;

										}
										#county_list .col-md-1{padding: 4px ; background-color: #f7f7f7; margin: 3px;}
									</style>
									<br>
									<div class="information text-center hide">
										<hr>
										<div class="row">
											<div class="col-md-8 text-left">
												<h1 style="margin-bottom: 10px; font-size: 46px; font-weight: bold" id="state_name"></h1>
												<h4 style="text-transform: capitalize">Reaching <strong> <u><span id="state_agents"></span></u></strong> agents</h4>
											</div>
											<div class="col-md-4 text-center">
												<div class="email_entire_state hidden">
													<button class="btn btn-lg btn-block btn-success">Email Entire State</button>
												</div>
											</div>
										</div>
										<div id="county_list" class=" text-left">
											<div class="row">
												<div class="col-md-8">
													<table class="table text-left table-bordered table-hover"></table>
												</div>
												<div class="col-md-4">
													<div class="row">
														<div class="col-md-10 col-md-offset-1 floting_div" style="border: 1px solid #aaa; border-radius: 10px; z-index: 10!important">
															<p style="padding: 10px 0px; border-bottom: 1px solid #ccc; font-weight: bold;">List of selected counties</p>
															<!-- <?echo "<pre>";print_r($this->session->user_order);echo "</pre>";?> -->
															<div class="row">
																<div class="col-md-6">
																	<div id="selected_counties"><?if($this->session->user_order){$orders = $this->session->user_order; $quantity = 0;
																		foreach ($orders['details'] as $order) {$quantity = $order['quantity'];
																		echo '<div id="selected_'.$order["fips"].'" fips="'.$order["fips"].'" quantity="'.$order["quantity"].'" state="'.$order["state"].'" county="'.$order["county"].'" special='.$order["special"].'" class="selected_count_row"><a href="" class="remove_selected_county" id="remove_'.$order["fips"].'" fips="'.$order["fips"].'" special="'.$order["special"].'" quantity="'.$order["quantity"].'" state="'.$order["state"].'"><i class="fa fa-times text-danger"></i></a> '.$order["state"].' &raquo; '.$order["county"].'</div>';
																	}
																	?>
																	<?php }?></div>
																</div>
																<div class="col-md-6 text-center">
																	<div style="background: yellow; padding: 5px 5px 1px">
																		Total number of agents reached <h4 id="total_reach"><?if($orders = $this->session->user_order){echo $orders['quantity']; }else echo '0';?></h4>
																		<div id="free_total_agents_wrapper">
																			<hr style="margin: 0px 0px 15px">
																			Add for free <h4 id="free_total_agents"></h4>
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="row row_pricing">
																<div class="row">
																	<div class="col-md-12 "><hr style="padding: 0; margin: 11px; margin-bottom: 5px"></div>
																</div>
																<div class="col-md-6 text-left">
																	<!-- <small>Price:</small>  --><strong>$<span  class="sum_it" id="total_price">39.95</span></strong>
																</div>
																<div class="col-md-6 text-center">
																	<button class="process_order btn btn-success btn-block">Proceed</button>
																	<small class="text-center" id="total_reach_10k">(10,000)<small> only</small></small>
																	<br>
																</div>
															</div>

															<div class="row row_additional_pricing" style="<?if($this->session->user_order){$orders = $this->session->user_order; $display = 'display: none;'; $check = true; if($orders['order_type']=='complete') $check = false; else $check = true;  if($check) echo $display;}else echo 'display: none'?>">
																<div class="col-md-12 text-center">
																	<hr style="padding: 0; margin: 11px; margin-bottom: 5px">	
																	<? if($this->session->user_order)
																	{
																		$orders = $this->session->user_order;
																		$total_bulk_quantity = 0; $total_special = 0;
																		// echo "<pre>";print_r($orders);echo "</pre>";
																		foreach ($orders['details'] as $order) {
																			if($order['special']=='true'){
																				$total_special = $total_special + intval($order['quantity']);
																			}
																		}
																		$total_bulk_quantity = intval($orders['quantity']) - $total_special;
																	}
																	?>
																	<p>Do you want to add the additional <span id="additional_agents"><?=($this->session->user_order)?$total_bulk_quantity:''?></span> for $<span id="additional_pricing" class="sum_it"><?=($this->session->user_order)?$total_bulk_quantity*0.004:''?></span>?</p>
																	<div id="special_counties" class="special_counties" style="<?if($this->session->user_order){$orders = $this->session->user_order; $display = 'display: none;'; $check = true; foreach($orders['details'] as $order){if($order['special']=='true')  $check = false; else $check = true; } if($check) echo $display;}else echo 'display: none'?>"><strong>Discounted Counties:</strong>
																		<?if($this->session->user_order){$orders = $this->session->user_order; $total_quantity = 0; foreach($orders['details'] as $order){?>
																		<?if($order['special']=='true') {echo '<div id="special_'.$order["fips"].'" fips="'.$order["fips"].'" quantity="'.$order["quantity"].'" state="'.$order["state"].'" county="'.$order["county"].'" special='.$order["special"].'" class="special_count_row"><small>'.$order["county"].', '.$order["quantity"].' Agents @ $<span class="sum_it">39.95</span></small></div>';}?>
																		<?}}?>
																	</div>
																	
																	<div class="row">
																		<div class="col-md-6 text-left">
																			<!-- <small>Price:</small>  --><strong>$<span id="total_reach_price"><?=$orders['price']?></span></strong>
																		</div>
																		<div class="col-md-6 text-center">
																			<button class="process_order_full btn-block btn btn-warning">Proceed</button>
																			<small class="text-center <?if($this->session->user_order){$orders = $this->session->user_order; $display = 'hidden'; $check = true; if($orders['quantity']>10000)  $check = false; else $check = true;  if($check) echo $display;}else echo 'hidden'?>">(<span id="total_reach_additioanl"><?=($this->session->user_order)?$orders['quantity']:'10,000'?></span>)</small>
																			<br>
																		</div>
																	</div>
																</div>

															</div>
															<div class="row">
																<div class="col-md-12 text-center">
																	<a href="" id="clear_selection" style="position: relative; text-align: center; bottom: -24px; color: darkgray; border: 1px solid #ccc; padding: 3px 10px; border-radius: 0px 0px 8px 8px ; border-top: 0; background: white;"><i class="fa fa-times text-danger"></i><small> Clear Selection</small></a>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<br><br>
					</div>

				</div>
			</div>
			<!-- <section class="call-to-action call-to-action-primary mb-xl">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="call-to-action-content align-left pb-md mb-xl ml-none">
								<h2 class="text-color-light mb-none mt-xl">Everything you need for your next <strong>House.</strong></h2>
								<p class="lead mb-xl">Not convinced yet? Here are more reasons to choose Flyer:</p>
							</div>
							<div class="call-to-action-btn">
								<a href="<?=( $this->session->user_data)?site_url('editor'):site_url('register')?>" target="_blank" class="btn btn-lg btn-primary btn-primary-scale-2 mr-md">Get Started Today</a>
								<span class="mr-md text-color-light hidden-xs"><span class="arrow arrow-light hlb" style="top: -88px; right: -47px;"></span></span>
							</div>
						</div>
					</div>
				</div>
			</section> -->
			<div id="myorder" class="hidden"></div>
			<div class="hidden" id="current_state"></div>
			<div class="hidden" id="current_name"></div>

		</div>
		<script>
			
			$(function() {

		// set the offset pixels automatically on how much the sidebar height is.
		// plus the top margin or header height
		var offsetPixels = $('#county_list .col-md-4').outerHeight() + 900;
//floating pricing box, scroll
		$(window).scroll(function() {
			if ( $(window).scrollTop() > offsetPixels ) {
				$('.floting_div').css({
					'position': 'fixed',
					'top': '120px',
					'background-color': 'white',
					'width': '300px',
					'z-index': '10!important'
				});
			} else {
				$('.floting_div').css({
					'position': 'static'
				});
			}
		});
	});
		</script>
		<?php $this->load->view('new_frontend/public/footer'); ?>