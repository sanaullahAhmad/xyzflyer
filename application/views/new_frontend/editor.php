<?php
$this->load->view('new_frontend/public/head');
$this->load->view('new_frontend/public/header');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

<div role="main" class="main shop">
	<section class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="<?php echo site_url('order'); ?>">Home</a></li>
						<li class="active">Order</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>Let's Get Started</h1>
				</div>
			</div>
		</div>
	</section>
	
	<div class="container buttons" >
		<div class="row">
			<div class="panel-group" id="accordion">
				
				<div class="panel panel-default" id="step_1">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
								Step 1: Start
							</a>
						</h4>
					</div>

					<div id="" class="accordion-body collapse <?php if($this->session->userdata('tab_open')==1){echo 'in';} ?>">
						<div class="panel-body">
							<div class="row">
								<div class="col-md-4" id="hook_1_1">
									<a href="" id="create_your_flyer"><div class="servive-block servive-block-dark-blue">
										<i class="icon-2x color-light fa fa-paint-brush"></i>
										<h4 class="heading-md">CREATE A NEW FLYER</h4>
									</div></a>
								</div>
								<div class="col-md-4">
									<a href="javascript:void(0);" id="use_previous_flyer"><div class="servive-block servive-block-aqua">
										<i class="icon-2x color-light fa fa-picture-o"></i>
										<h4 class="heading-md">USE PREVIOUS FLYER</h4>
									</div></a>
								</div>

								<div class="col-md-4"  id="hook_1_2">
									<a href="" id="upload_btn"><div class="servive-block servive-block-grey">
										<i class="icon-2x color-light fa fa-upload"></i>
										<h4 class="heading-md">UPLOAD YOUR OWN FLYER</h4>
									</div></a>
								</div>
							</div>

							<div class="row" id="previous_flyer" style="display:none;">
								<?php if(isset($userflyers) && $userflyers!=""){ ?>
								<div class="col-md-6">
									<div class="row choose-flyer-grid-wrap">
										<?php
										foreach($userflyers as $uflyer){
											if(file_exists("public/upload/user_flyer_store/". $uflyer['fimage'])){
												?>
												<div class="col-md-4 mb-20">
													<img class="img-responsive flyer_small flyer_megnify" id="<?php echo  $uflyer['fimage'];?>"src="<?php echo base_url();?>public/upload/user_flyer_store/_thumbs/thumb_<?php echo $uflyer['fimage']; ?>" alt="<?php echo $uflyer['ftitle']; ?>" title="<?php echo  $uflyer['fid'].'_thumb.jpg';?>"/>
												</div>
												<?php 
											}
										} 
										?>
									</div>
								</div>

								<div class="col-md-6" id="megaimg">
									<div class="jumbotron alert-warning" style="border-color: #ebccd1">
										<h4 class="text-success" id="use_previous_heading_msg">
											Choose a flyer to get started!
										</h4>
									</div>
								</div>

								<?php }else{ ?>
								<div class="col-md-6 col-md-offset-3">
									<br>
									<p class="well text-danger text-center">
										There are no flyers to choose. Please try other options.
									</p>
								</div>

								<?php } ?>
								<div class="col-md-12">
									<p id="msgprev"></p>
									<div class="button-group-warp clearfix mt-20">
										<ul class="list-inline pull-left mb-0">
											<a href="javascript:void(0)" class="btn btn-primary" id="prev_flyer_cancel"><i class="fa fa-arrow-left"></i> Cancel & Go Back</a>
										</ul>
										<ul class="list-inline pull-right mb-0">
											<a href="javascript:void(0)" class="btn btn-primary" id="use_prev_flyer"><i class="fa fa-arrow-right"></i> Save & Continue</a>
										</ul>
									</div>
									<input type="hidden" id="prev_flyer_id" name="prev_flyer_id" value="">
								</div>
							</div>

							<div class="row" id="upload_file" style="display:none;">
								<div class="col-md-12">
									<form action="" method="post" id="frm_flyer" enctype="multipart/form-data">
										<div class="row">
											<div class="col-md-12">

												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="input-append">
														<div class="uneditable-input">
															<span class="fileupload-preview">Upload File</span>
															<i class="fa fa-file fileupload-exists"></i>
														</div>
														<span class="btn btn-default btn-file">

															<span class="fileupload-new" style="margin-right: 127px;">Select a file to Upload</span>
															<input type="file" id="custom_file" name="userfile">
														</span>
													</div>
												</div>
											</div>
										</div>
										<br>
										<div class="checkbox-custom checkbox-default">
											<input type="checkbox" name="terms" value="1" id="flyer_terms" >
											<label for="checkboxExample1">Accept Terms & Conditions</label>
											<p>PROOF CAREFULLY! Once you upload your own E-Flyer and submit your order, full responsibility for the accuracy of the order is YOURS. Please carefully review ALL text and contact information including phone numbers, email addresses, etc. Refunds will not be given for user errors or incorrect information. The file should be in PDF or JPG Format. We will not edit an E-Flyer you have designed. We will not email a copyrighted. We will adjust your flyer to 680 pixels wide, and its height will adjust proportionally. At this width, it may be no longer than 1500 pixels high or 8.5” x 11”.</p>
										</div>
										<p id="msgfile"></p>
										<div class="button-group-warp clearfix mt-20">
											<ul class="list-inline pull-left mb-0">
												<a href="javascript:void(0)" class="btn btn-primary" id="upload_cancel"><i class="fa fa-arrow-left"></i> Cancel & Go Back</a>
											</ul>
											<ul class="list-inline pull-right mb-0">
												<a href="javascript:void(0)" class="btn btn-primary" id="upload_flyer"><i class="fa fa-arrow-right"></i> Save & Continue</a>
											</ul>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-default" id="step_2">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
								Step 2: Choose Your Flyer
							</a>
						</h4>
					</div>
					<div id="" class="accordion-body collapse <?php if($this->session->userdata('tab_open')==2){echo 'in';} ?>">
						<div class="panel-body">
							<h4>Choose a Flyer</h4>
							<div class="row">
								<div class="col-md-12">
									<div class="row customButton customButtonFrontEnd" id="customButton">
										<div class="col-md-12">
											<a class="btn btn-success col-md-2 btn-design new_flyers_btn"  id="new_flyers_btn" href="">Show All Flyers</a>
											<?php $num = 0; foreach ($flyerTags as $tags) { $num++;?>
											<a class="btn btn-primary col-md-2 btn-design load_flyers" id="<?php echo $tags['pk_flyer_tags']; ?>" href=""><?php echo $tags['flyer_tags_title']; ?></a>
											<?php } ?>
										</div>
									</div>

									<div class="row mt-20">
										<?php $num = 0; if($flyers){ ?>
										<div class="col-md-6" id="choose_flyer_grid">
											<div class="row choose-flyer-grid-wrap">
												<?php foreach ($flyers as $flyer) { $num++;?>
												<div class="col-md-4 mb-20" id="flyer_small_<?php echo $flyer['pk_flyer_detail_id']?>">
													<img class="img-responsive flyer_small" id="<?php echo $flyer['pk_flyer_detail_id']?>" size="<?php echo $flyer['flyer_size_title']?>" src="<?php echo base_url() . 'public/upload/flyer_images/thumb_'.$flyer['flyer_image'] ?>" img="<?=$flyer['flyer_image']?>" width="100%" />
												</div>
												<?php } ?>
											</div>
										</div>
										<div class="col-md-6" id="hook-2_4">
											<img class="img-responsive" id="big_image" src="<?php echo base_url() . 'public/upload/flyer_images/placeholder-image.jpg' ?>"  idd=""/>
										</div>
										<?php } else{?>
										<div class="col-md-6 col-md-offset-3">
											<br>
											<p class="well text-danger text-center">
												There are no flyers to choose. Please check again later.
											</p>
										</div>
										<?php }?>
									</div>
									<div class="button-group-warp clearfix mt-20">
										<p id="msg_choose"></p>
									</div>
									<div class="button-group-warp clearfix mt-20">
										<ul class="list-inline pull-left mb-0">
											<a href="javascript:void(0)" class="btn btn-primary" id="choose_cancel"><i class="fa fa-arrow-left"></i> Cancel & Go Back</a>
										</ul>
										<ul class="list-inline pull-right mb-0" id="hook-2_5">
											<a id="next_flyer_design" class="btn btn-primary load_flyer_json" href="javascript:void(0)"><i class="fa fa-arrow-right"></i> Next (Design Flyer)</a>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-default three" id="step_3">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
								Step 3: Design Your Flyer
							</a>
						</h4>
					</div>
					<div id="" class="accordion-body collapse collapse_design <?php if($this->session->userdata('tab_open')==3){echo 'in';} ?>">
						<div class="panel-body">
							<div id="toggle-id-3" class="panel-collapse" aria-expanded="true">
								<div class="panel-body toggle-content">
									<div class="design-flyer-wrap container-fluid">
										<div class="container-fluid">
											<div class="row">
												<div class="col-md-8 col-xs-12"> <!-- //canvas area -->
													<center>
														<div class="row" align="center" style="height: 800px; width: 100%;margin-left: 0%;  background-size:cover; display: table-cell;vertical-align: middle;" id="hook-3_4">
															<div class="canvas-container" id="canvas-containerOut" style="display: inline-block;height: 750px; width: 650px; position: relative; -webkit-user-select: none;max-height:750px; max-width:650px;">
																<canvas id="myCanvas" style="border: 1px solid rgb(116, 116, 116); position: absolute; width: 510px; height: 650px; left: 0px; top: 0px; -webkit-user-select: none;" class="lower-canvas" width="510" height="650"></canvas>
															</div>
														</div>
													</center>
													<div class="row" style="margin-top: 2%;">
														<center>
															<div class="col-md-9 col-xs-12" style="margin-bottom: 5px; background: white;" id="hook-3_8">
																<div class="col-md-4 col-xs-12" style="margin : 0px;padding : 0px; background: white;">
																	<div class="wan-spinner wan-spinner-1 dropup ">
																		<a href="javascript:void(0)" class="minus" style="line-height: 0em; width:0%;padding: 5px">
																			-
																		</a>
																		<input type="text" class="dropdown-toggle" id="zoom" value="100" style="width: 80px;padding:5px;text-align: center;" readonly="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		<a href="javascript:void(0)" class="plus" style="line-height: 0em; width:0%;padding: 5px">
																			+
																		</a>
																	</div>
																</div>
																<div class="col-md-8 col-xs-12" style="margin : 0px;padding : 0px;">
																	<div class="col-md-2 col-xs-2" style="margin : 0px;padding : 0px;">
																		<button type="button" id="zoom-50" style="width: 50px" class="btn btn-default btn-sm zoom-class">
																			50
																		</button>
																	</div>
																	<div class="col-md-2  col-xs-2" style="margin : 0px;padding : 0px;">
																		<button type="button" id="zoom-75" style="width: 50px" class="btn btn-default btn-sm zoom-class">
																			75
																		</button>
																	</div>
																	<div class="col-md-2  col-xs-2" style="margin : 0px;padding : 0px;">
																		<button type="button" id="zoom-100" style="width: 50px" class="btn btn-default btn-sm zoom-class">
																			100
																		</button>
																	</div>
																	<div class="col-md-2  col-xs-2" style="margin : 0px;padding : 0px;">
																		<button type="button" id="zoom-120" style="width: 50px" class="btn btn-default btn-sm zoom-class">
																			120
																		</button>
																	</div>
																	<div class="col-md-2  col-xs-2" style="margin : 0px;padding : 0px;">
																		<button type="button" id="zoom-150" style="width: 50px" class="btn btn-default btn-sm zoom-class">
																			150
																		</button>
																	</div>
																	<div class="col-md-2  col-xs-2" style="margin : 0px;padding : 0px;">
																		<button type="button" id="zoom-200" style="width: 50px" class="btn btn-default btn-sm zoom-class">
																			200
																		</button>
																	</div>
																</div>
															</div>
															<div class="col-md-3 col-xs-12" style="margin: 0px;margin-bottom: 5px;" id="hook-3_7">
																<div class="btn-group" role="group" aria-label="...">

																	<button type="button" id="undobtn" style="width: 50px" class="btn btn-default btn-sm">
																		Undo
																	</button>
																	<button type="button" id="redobtn" style="width: 50px" class="btn btn-default btn-sm">
																		Redo
																	</button>

																</div>
															</div>
														</center>
													</div>
												</div>
												<div class="col-md-4 col-xs-12"> <!-- //toolbox left -->
													<div id="textOpt" style="margin-bottom:20px;">
														<div class="row" style="margin: 0px;padding: 0px;">
															<div style="font-size: 16px;margin: 0px;padding: 0px;font-weight: bold;margin-top: 15px;">
																TEXT :
															</div>
															<hr style="width: 100%;margin: 0px;padding: 0px; margin-bottom: 10px;">
														</div>

														<div class="input-group " style="width: 100%; margin-top:5%;" id="hook-3_3">
															<textarea id="text-area" type="textbox" placeholder="Text" class="form-control" style="height: 200px;resize: none;" disabled="disabled"></textarea>
															<input type="number" id="TBHeight" value="0" style="display: none"/>
														</div>

														<div id="hook-3_1" style="background:white" class="row">
															<div class="" style="">
																<div class="row">
																	<div class="col-md-5" style="margin: 0px;padding: 0px;">
																		<div class="col-md-12 col-xs-12">
																			<div class="textalign" style="font-weight: bold;">
																				SIZE :
																			</div>
																		</div>
																		<div class="col-md-12 col-xs-12">
																			<input type="number" class="form-control" id="font_Size" value="12" min="8" max="72" disabled="disabled" />
																		</div>
																	</div>
																	<div class="col-md-7" style="margin: 0px;padding: 0px;">
																		<div class="col-md-12 col-xs-12">
																			<div class="textalign" style="font-weight: bold;">
																				FONT :
																			</div>
																		</div>
																		<div class="col-md-12">
																			<select class="form-control" id="textfont" style="width: 100%;" disabled="disabled">

																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row" style="margin-top: 5px;">
																<div class="col-md-2 col-xs-12">
																	<div class=" col-md-12 col-xs-12" style="padding: 0px;margin: 0px;">
																		<div class="textalign" style="font-weight: bold;">
																			STYLE:
																		</div>
																	</div>
																</div>
																<div class="col-md-10 col-xs-12">
																	<div class=" col-md-12 col-xs-12" style="padding: 0px;margin: 0px;">
																		<div class="btn-group btn-sm" role="group" aria-label="..." style="width : 100%;">
																			<button type="button" id="bold" class="btn btn-default btn-sm" style="width: 25%;" disabled="disabled"><span class="glyphicon glyphicon-bold" aria-hidden="true"></span></button>
																			<button type="button" id="italic" class="btn btn-default btn-sm" style="width: 25%;" disabled="disabled"><span class="glyphicon glyphicon-italic" aria-hidden="true"></span></button>
																			<button type="button" id="underline" class="btn btn-default btn-sm" style="width: 25%;" disabled="disabled"><span style="font-size:14px;" class="fa fa-underline" aria-hidden="true"></span></button>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row" style="margin-top: 5px;">
																<div class="col-md-2 col-xs-12">
																	<div class=" col-md-12 col-xs-12" style="padding: 0px;margin: 0px;">
																		<div class="textalign" style="font-weight: bold;">
																			ALIGN:
																		</div>
																	</div>
																</div>
																<div class="col-md-10 col-xs-12">
																	<div class=" col-md-12 col-xs-12" align="right" style="padding: 0px;margin: 0px;">
																		<div class="btn-group btn-sm" role="group" aria-label="..." style="width : 100%;">
																			<button type="button" id="left" class="btn btn-default btn-sm" style="width: 25%;" disabled="disabled"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span></button>
																			<button type="button" id="center" class="btn btn-default btn-sm" style="width: 25%;" disabled="disabled"><span class="glyphicon glyphicon-align-center" aria-hidden="true"></span></button>
																			<button type="button" id="right" class="btn btn-default btn-sm" style="width: 25%;" disabled="disabled"><span class="glyphicon glyphicon-align-right" aria-hidden="true"></span></button>
																			<button type="button" id="justify" class="btn btn-default btn-sm" style="width: 25%;" disabled="disabled"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span></button>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row" style="margin-top: 6px;margin-bottom: 5px;">
																<div class="col-md-2 col-xs-2 " style="font-weight: bold;padding-top: 3px;margin-right: 15px;">
																	COLOR:
																</div>
																<div class="col-md-9 col-xs-9" style="padding: 0px;margin: 0px;font-weight: bold; margin-left: -5px;">
																	<div class=" col-md-12 col-xs-12">
																		<div class="evo-cp-wrap">
																			<a id="font_color" class="btn btn-xs dropdown-toggle" data-toggle="dropdown" style="" aria-expanded="false" disabled="disabled">
																			</a>
																			<ul class="dropdown-menu clrpicker">
																				<li style="margin-top: 5px;">
																					<div class="pull-left bootstrap-colorpalette">
																						<a class="btn btn-xs clr_thumbnail btn-color" type="button" style="background-color:#000000;width: 20px; height: 20px; border: 1px solid black;" data-value="#000000" title="#000000"></a>
																						<span>#000000</span>
																					</div>

																					<div class="bootstrap-colorpalette">
																						<a class="btn btn-xs clr_thumbnail btn-color" type="button" style="background-color:#ffffff;width: 20px; margin-left: 10px; margin-bottom:3px ;   height: 20px; border: 1px solid black;" data-value="#ffffff" title="#ffffff"></a>
																						<span>#ffffff</span>
																					</div>
																				</li>
																				<li><div id="colorpalette1"></div></li>
																				<li style="margin-top: 5px;">
																					<div class="hover_clr pull-left">
																						<a class="btn btn-xs clr_thumbnail"></a>
																						<span>#000000</span>
																					</div>

																					<div class="selected_clr pull-right">
																						<a class="btn btn-xs clr_thumbnail"></a>
																						<span>#000000</span>
																					</div>
																				</li>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row" style="margin-top: 5px;" id="hook-3_2">
															<div class="col-md-10 col-xm-10 col-sm-10 col-md-offset-1 col-xm-offset-1 col-sm-offset-1 txtbuttonContainer" style="margin: 0px;padding: 0px;">
																<div class="row" style="margin: 0px;padding: 0px;">
																	<div style="font-size: 16px;margin: 0px;padding: 0px;font-weight: bold;margin-top: 15px;">
																		Available Text :
																	</div>
																	<hr style="width: 100%;margin: 0px;padding: 0px; margin-bottom: 10px;">
																</div>
																<div class="row text-btns" >

																</div>
															</div>
														</div>
													</div>
													<div class="" id="hook-3_6">
														<div id="colorStyleOpt" style="margin-bottom:20px; background-color: white;" class="col-md-12">
															<div class="row" style="margin: 0px;padding: 0px;">
																<div style="font-size: 16px;margin: 0px;padding: 0px;font-weight: bold;margin-top: 15px;">
																	Flyer Themes :
																</div>
																<hr style="width: 100%;margin: 0px;padding: 0px; margin-bottom: 10px;">
															</div>
															<div class="row color-pallet-row colorRow" id="Ccol-1">
																<div class="col-md-9 col-xs-8" style="margin: 0px;padding: 0px;">
																	<div class="col-md-2  col-xs-2" style="border: 0px;padding: 0px;">
																		<div id="C11" class="square1" style="background-color: rgb(255, 128, 0);"></div>
																	</div>
																	<div class="col-md-2  col-xs-2" style="border: 0px;padding: 0px;">
																		<div id="C12" class="square1" style="background-color: rgb(184, 204, 0);"></div>
																	</div>
																	<div class="col-md-2  col-xs-2" style="border: 0px;padding: 0px;">
																		<div id="C13" class="square1" style="background-color: rgb(51, 102, 0);"></div>
																	</div>
																	<div class="col-md-2  col-xs-2" style="border: 0px;padding: 0px;">
																		<div id="C14" class="square1" style="background-color: rgb(0, 255, 179);"></div>
																	</div>
																	<div class="col-md-2  col-xs-2" style="border: 0px;padding: 0px;">
																		<div id="C15" class="square1" style="background-color: rgb(0, 204, 255);"></div>
																	</div>
																	<div class="col-md-2  col-xs-2" style="border: 0px;padding: 0px;">
																		<div id="C16" class="square1" style="background-color: rgb(0, 122, 204);"></div>
																	</div>
																</div>
																<div class="col-md-3 col-xs-4" style="margin:0px;padding:0px;">
																	<label class="textalign1" for="exampleInputEmail1">
																		SAMLPLE1
																	</label>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="" style="margin-bottom:20px;">
														<div class="col-md-12 col-xs-5" style="margin:0px;padding:0px; padding-left:20px;">
															<p id="msg_editor"></p>
														</div>
														<div class="col-md-6 col-xs-5" style="margin:0px;padding:0px; padding-left:20px;" align="left">
															<ul class="list-inline pull-left mb-0">
																<a href="javascript:void(0)" class="btn btn-primary" id="editor_cancel"><i class="fa fa-arrow-left"></i> Cancel & Go Back</a>
															</ul>
														</div>
														<div class="col-md-6 col-xs-6" style="margin:0px;padding:0px;padding-right:20px;" align="right">

															<ul class="list-inline pull-right mb-0" id="hook-3_9">
																<a id="save_flyer_design" class="btn btn-primary" href=""><i class="fa fa-arrow-right"></i> SAVE &amp; CONTINUE</a>
															</ul>
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

				<div class="panel panel-default" id="step_4">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
								Step 4: Proof
							</a>
						</h4>
					</div>
					<div id="" class="accordion-body collapse <?php if($this->session->userdata('tab_open')==4){echo 'in';} ?>">
						<div class="panel-body">
							<div class="proof-flyer-wrap container-fluid">
								<div class="row">
									<form name="" action="" method="post" id="frm_proof">
										<div class="edit-flyer-section col-md-6">
											<div class="full-flyer-design">
												<img src="<?php echo site_url(); ?>public/upload/user_flyer_store/<?php if(isset($flyer_proof)){ echo (!empty($flyer_proof->flyer_created_image)?$flyer_proof->flyer_created_image:'placeholder-image.jpg');} ?>">
											</div>
										</div>

										<div class="edit-flyer-menu col-md-6">
											<div class="row">
												<div class="col-md-12" id="hook-4_1">
													<label for="subject">Enter the subject line for your email</label>
													<input type="text" required placeholder="Subject" value="<?php if(isset($flyer_proof)){ echo (!empty($flyer_proof->uFlyerTitle)?$flyer_proof->uFlyerTitle:'');} ?>" class="form-control" name="subject" >
												</div>
											</div>
											<div class="row">
												<div class="col-md-12" id="hook-4_2">
													<label for="email">Please enter your return email address here</label>
													<input type="text" required placeholder="Your email address"  value="<?php if(isset($flyer_proof)){ echo (!empty($flyer_proof->agentEmail)?$flyer_proof->agentEmail:'');} ?>" class="form-control" name="email">
												</div>
											</div>
											<div class="row">
												<div class="col-md-12"  id="hook-4_3">
													<label for="email-address">If you would like to copy your client, enter their email address here</label>
													<input type="text" required placeholder=" Your client's email address" value="<?php if(isset($flyer_proof)){ echo (!empty($flyer_proof->uFlyerEmail)?$flyer_proof->uFlyerEmail:'');} ?>" class="form-control" name="client_email">
												</div>
											</div>

											<div class="row" id="hook-4_4" style="background: white">

												<div class="row"  style="background: white">
													<div class="col-md-12">
														<br><div class="well"><p><strong>PROOF CAREFULLY!</strong><br>Once you approve this proof and submit your order, full responsibility for the accuracy of the order is YOURS. Please carefully review ALL text and contact information including phone numbers, email addresses, etc. Refunds will not be given for user errors or incorrect information; however we will be happy to assist you in resending the order at your expense.</p></div>
													</div>
												</div>

												<?php if($this->session->userdata('tab_refrer') != "upload_own_flyer"){ ?>
												<div class="row">
													<div class="col-md-12">
														<p class="input-wrap">
															<label for="mls-num">MLS No.</label>
															<input type="text" required placeholder="MLS No. : 1234567" class="form-control " value="<?php if(isset($flyer_proof)){ echo (!empty($flyer_proof->agent1License)?$flyer_proof->agent1License:'');} ?>" name="mls-num" >
														</p>
														<p class="input-wrap">
															<label for="listing-price">Listing Price</label>
															<input type="text" placeholder="Listing Price : $567,890"  value="<?php if(isset($flyer_proof)){ echo (!empty($flyer_proof->propertyPrice)?$flyer_proof->propertyPrice:'');} ?>" class="form-control " name="listing-price" readonly>
														</p>
														<p class="input-wrap">
															<label for="prop-address">Property Address</label>
															<input type="text" required placeholder="123 Easy Street, Anytown, USA 87654321"  value="<?php if(isset($flyer_proof)){ echo (!empty($flyer_proof->propertyAddress)?$flyer_proof->propertyAddress:'');} ?>" class="form-control " name="prop-address" readonly>
														</p>
														<?php if(!empty($flyer_proof->propertyMainHeader)){ ?>
														<p class="input-wrap">
															<label for="main-header">Main Header</label>
															<input type="text" required placeholder="This is the best house in the World." value="<?php if(isset($flyer_proof)){ echo (!empty($flyer_proof->propertyMainHeader)?$flyer_proof->propertyMainHeader:'');} ?>" class="form-control " name="main-header" readonly>
														</p>
														<? } ?>
														<?php if(!empty($flyer_proof->propertyBody1)) { ?>
														<p class="input-wrap">
															<label for="body">Body1</label>
															<textarea name="body" required class="form-control proof-textarea " rows="12" readonly><?php if(isset($flyer_proof)){ echo (!empty($flyer_proof->propertyBody1)?$flyer_proof->propertyBody1:'');} ?></textarea>
														</p>
														<?php } ?>
														<?php if(!empty($flyer_proof->propertyBody2)) { ?>
														<p class="input-wrap">
															<label for="body">Body2</label>
															<textarea name="body" required class="form-control proof-textarea " rows="12" readonly><?php if(isset($flyer_proof)){ echo (!empty($flyer_proof->propertyBody2)?$flyer_proof->propertyBody2:'');} ?></textarea>
														</p>
														<?php } ?>
														<?php if(!empty($flyer_proof->propertyBody3)) {?>
														<p class="input-wrap">
															<label for="body">Body3</label>
															<textarea name="body" required class="form-control proof-textarea " rows="12" readonly><?php if(isset($flyer_proof)){ echo (!empty($flyer_proof->propertyBody3)?$flyer_proof->propertyBody3:'');} ?></textarea>
														</p>
														<?php } ?>
													</div>
												</div> 
												<?php }	?>
											</div>
										</div>

										<div class="col-md-12">
											<p id="msgproof"></p>
											<div class="button-group-warp clearfix mt-20">
												<?php if(isset($flyer_proof) && $flyer_proof->flyerType=='Editor'){ ?>

												<ul class="list-inline pull-left  mb-0" id="hook-4_5">
													<a href="javascript:void(0)" class="btn btn-primary" id="update_flyer"><i class="fa fa-arrow-left"></i> Cancel & Go Back</a>
												</ul>

												<?php   }else{ ?>

												<ul class="list-inline pull-left mb-0" id="hook-4_5">
													<a href="javascript:void(0)" class="btn btn-primary" id="proof_cancel"><i class="fa fa-arrow-left"></i> Cancel & Go Back</a>
												</ul>

												<?php } ?>
												<?php ?>

												<ul class="list-inline pull-right mb-0">
													<a href="javascript:void(0)" class="btn btn-primary" id="proof_flyer"><i class="fa fa-arrow-right"></i> Save & Continue</a>
												</ul>

											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="panel panel-default" id="step_5">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
								Step 5: Delivery Area
							</a>
						</h4>
					</div>
					<div id="" class="accordion-body collapse <?php if($this->session->userdata('tab_open')==5){echo 'in';} ?>">
						<? if($this->session->userdata('tab_open')==5){?>
						<div class="panel-body"> 
							<div id="order_selection" class="">
								<div class="row">
									<div class="col-md-12">
										<h4 align="center"><?php if(isset($overall_emails)){echo (!empty($overall_emails->overallEmails)?number_format($overall_emails->overallEmails):'None');} ?> of Agent Emails Available</h4>
										<input type="hidden" name="selectedEmails" id="selectedEmails" value="712">
									</div>
								</div>
								<div id="tooltip"></div><!-- div to hold tooltip. -->

								<svg width="960" height="600" id="statesvg"></svg> <!-- svg to hold the map. -->
								<script src="<?php echo site_url(); ?>public/new_frontend/flyer/uStates-less.js"></script> <!-- creates uStates. -->
								<script src="https://d3js.org/d3.v3.min.js"></script>
								<script>
									function tooltipHtml(n, d){
										return "<h4 style='color:white;'>"+n+"</h4><table class='statesAgt'>"+"<tr><td>Agents</td><td>"+(d.agents.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))+"</td></tr>"+"</table>";
									}
									var sampleData ={};	/* Sample random data. */
									<?php if(isset($us_state_agents)){ echo json_encode($us_state_agents); ?>.forEach(function(d){

										sampleData[d.code]={code:d.code, agents:d.agt, color:"#0088cc"};
									});
									<? } ?>

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
											<h4 style="text-transform: capitalize">Reach <strong> <u><span id="state_agents"></span></u></strong> agents in this state</h4>
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
													<div class="floting_div" style="border: 1px solid #aaa; border-radius: 10px; z-index: 10!important; padding: 10px 20px;">
														<p style="padding: 10px 0px; border-bottom: 1px solid #ccc; font-weight: bold;">List of selected counties</p>
														<div class="row">
															<div class="col-md-6">
																<div id="selected_counties" style="max-height: 200px; overflow-y:scroll;font-size: 14px">
																	<?if($this->session->user_order){$orders = $this->session->user_order; $quantity = 0;
																		foreach ($orders['details'] as $order) {$quantity = $order['quantity'];
																		echo '<div id="selected_'.$order["fips"].'" fips="'.$order["fips"].'" quantity="'.$order["quantity"].'" state="'.$order["state"].'" county="'.$order["county"].'" special='.$order["special"].'" class="selected_count_row"><a href="" id="remove_selected_county" id="remove_'.$order["fips"].'" special="'.$order["special"].'" quantity="'.$order["quantity"].'" state="'.$order["state"].'"><i class="fa fa-times text-danger"></i></a> '.$order["state"].' &raquo; '.$order["county"].'</div>';
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
																	<button class="process_order btn btn-success btn-block skip_next_step">Proceed</button>
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
																			<button class="process_order_full btn-block btn btn-warning skip_next_step">Proceed</button>
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

								<div class="row">
									<div class="col-md-12">
										<p id="msgdelivery"></p>
										<div class="button-group-warp clearfix mt-20">
											<ul class="list-inline pull-left mb-0">
												<a href="javascript:void(0)" class="btn btn-primary" id="delivery_cancel"><i class="fa fa-arrow-left"></i> Cancel & Go Back</a>
											</ul>
											<ul class="list-inline pull-right mb-0">
												<a href="javascript:void(0)" class="btn btn-primary" id="delivery_flyer"><i class="fa fa-arrow-right"></i> Save & Continue</a>
											</ul>
										</div>
									</div>
								</div>
							</div> <!-- //#order_selection end -->
						</div> <!-- // panel-body end -->
						<? } ?>
					</div> <!-- //accordion-body end -->
				</div> <!-- //panel end for step 5 -->

				<div class="panel panel-default" id="step_6">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
								Step 6: Order review & Payment Information
							</a>
						</h4>
					</div>

					<div id="" class="accordion-body collapse <?php if($this->session->userdata('tab_open')==6){echo 'in';} ?>">
						<div class="panel-body">
						   <div class="row">
								<div class="col-md-12">
									<h4 class="heading-primary">Order Details</h4>
									<!-- <?$order = $this->session->user_order; print_r($order); echo "<br>";?>  -->
									<div class="row">
										<div class="col-md-8">
											<table class="shop_table table table-condensed table-hover table-striped table-bordered" id="hook-6_1" style="background-color: white">
												<thead class="bg-primary">
													<tr>
														<th class="product-name">
															State
														</th>
														<th class="product-price">
															County
														</th>
														<th class="product-quantity">
															Agents
														</th>
														<th class="product-subtotal">
															Discounted
														</th>
													</tr>
												</thead>
												<tbody id="ordershow">
													<? if(isset($this->session->user_order)) { 
														$order = $this->session->user_order;
														if(is_array($order) && count($order)>0){
															if($order->details){
														foreach ($order->details as $detail) 
															{?>
														<tr>
															<td><?=$detail['state']?></td>
															<td><?=($detail['county'])?$detail['county']: $detail['fips']?></td>
															<td><?=number_format($detail['quantity'])?></td>
															<td><?=($detail['special']=='true')?'yes':'no'?></td>
														</tr>
														<?}}}?>
													</tbody>
												</table>

												<div style="font-size: 19px; line-height: 30px; text-align: right">
													<strong>Total Agents: <?=number_format($order['quantity'])?></strong><br>
													<?php if(isset($order['coupon_applied'])){?>
													<strong>Price:  $<?=number_format($order['price'],2)?></strong><br>
													<strong>Coupon Discount :$<?=number_format(($order['price']-$order['coupon_applied']['cpn_total']),2);?></strong><br>
													<?php if(isset($billinginfo->state) && $billinginfo->state=="CA"){
														$tax_applied=round($order['coupon_applied']['cpn_total']*8.5/100,2);
														echo '<strong>California State Tax: $'.number_format(round($order['coupon_applied']['cpn_total']*8.5/100,2),2).'<strong><br/>';
														echo '<strong>Total Price: $'.number_format(round((($order['coupon_applied']['cpn_total']*8.5/100)+$order['coupon_applied']['cpn_total']),2),2).'</strong>';
													}else{
														$tax_applied=0.00;
														echo '<strong>Total Price: $'.number_format(round($order['coupon_applied']['cpn_total'],2),2).'</strong>';
													}?>
													<?php }else{
														echo '<strong>Price:  $'.number_format($order['price'],2).'</strong><br>	';
														if(isset($billinginfo->state) && $billinginfo->state=="CA"){
															$tax_applied=round($order['price']*8.5/100,2);
															echo '<strong>California State Tax: $'.number_format(round($order['price']*8.5/100,2),2).'<strong><br/>';
															echo '<strong>Total Price: $'.number_format(round((($order['price']*8.5/100)+$order['price']),2),2).'</strong>';
														}else{
															$tax_applied=0.00;
															echo '<strong>Total Price: $'.number_format($order['price'],2).'</strong>';
														}
													}?>
												</div>

                                               	<?php //add tax to session
                                               	$finalarray=$this->session->user_order;
                                               	$finalarray['tax_applied']=$tax_applied;
                                               	$this->session->set_userdata('user_order',$finalarray);
                                               }?>
                                       </div>

                                       <div class="col-md-4" id="hook-6_2">
	                                       	<?php  if(isset($coupen_code) && !empty($coupen_code)){?>
	                                       	<h4 class="heading-primary">Coupon Code</h4>
	                                       	<p id="msgcoupen"></p>
	                                       	<table class="table table-bordered">
	                                       		<tr><td>Coupon code</td><td><?php echo $coupen_code->coupon_code;?></td></tr>
	                                       		<tr><td>Coupon Title</td><td><?php echo $coupen_code->coupon_title;?></td></tr>
	                                       		<tr><td>Coupon Description</td><td><?php echo $coupen_code->coupon_description;?></td></tr>
	                                       		<tr><td colspan="2"><a href="javascript:void(0);" id="removecoupen" class="btn btn-default pull-right">Use another code &nbsp;<i class="fa fa-close"></i></a></td></tr>
	                                       	</table>

	                                       	<?php }else{ ?>
	                                       	<h4 class="heading-primary">Coupon Code <input type="checkbox" id="coupenId" name="coupenadd" value="1"></h4>
	                                       	<div id="coupenform" style="display:none; border: 1px solid #ccc; padding: 0px 10px; background: #f8f8f8">

	                                       		<p id="msgcoupen"></p>
	                                       		<form method="post" action="#" id="coupenfrm" class="form">
	                                       			<div class="form-group col-md-8">
	                                       				<label>Coupon Code</label>
	                                       				<input type="text" name="coupon_code" id="coupon_code" class="form-control" value="" required="required"  title="Enter coupon code" placeholder="Enter coupon code">
	                                       			</div>
	                                       			<div class="form-group col-md-4">
	                                       				<!-- <label>&nbsp;</label> -->
	                                       				<input type="button" value="Save" id="addcoupen" class="btn btn-primary mb-sm btn-lg" data-loading-text="Loading...">
	                                       			</div>
	                                       		</form>
	                                       		<div class="clearfix"></div>
	                                       	</div>

	                                       	<?php } ?>

	                                       </div>
                                   </div>
                               </div>
                           </div>
                           <hr class="tall">

                           <div class="row">
	                           	<div class="col-md-6" id="hook-6_3"  style="background-color: white">
	                           		<h4 class="heading-primary">Billing Address</h4>
	                           		<p class="alert alert-danger" id="error" style="display:none;">&nbsp;</p>
	                           		<table class="table" id="tblShippingAddress"  style="<?php if(isset($billinginfo) && empty($billinginfo->state)){ echo 'display:none'; }?>">
	                           			<tr><td >Address </td><td id="billAddress"><?php if(isset($billinginfo) && !empty($billinginfo->state)){ echo $billinginfo->address; }?></td><td><a class="pull-right" id="editShippingAddress" href="javascript:void(0)">Edit</a></td> </tr>
	                           			<tr><td>City </td><td id="billCity"><?php if(isset($billinginfo) && !empty($billinginfo->state)){ echo $billinginfo->city; }?></td><td>&nbsp;</td></tr>
	                           			<tr><td>State </td><td id="billState"><?php if(isset($billinginfo) && !empty($billinginfo->state)){ echo $billinginfo->state; }?></td><td>&nbsp;</td></tr>
	                           			<tr><td>Zip Code </td><td id="billCounty"><?php if(isset($billinginfo) && !empty($billinginfo->state)){ echo $billinginfo->zipCode; }?></td><td>&nbsp;</td></tr>
	                           		</table>
	                           		<form action="" id="frmShippingAddress" method="post" style="<?php if(isset($billinginfo) && !empty($billinginfo->state)){ echo 'display:none'; }?>">
	                           			<div class="row">
	                           				<div class="form-group">
	                           					<div class="col-md-12">
	                           						<label>State</label>
	                           						<select class="form-control" name="state" id="billing_state">
	                           							<option value="">Select a State</option>
	                           							<?php  if(isset($us_state) && is_array($us_state)){
	                           								foreach($us_state as $key => $value){
	                           									echo "<option ".($billinginfo->state==$key?"selected='selected'":"")." value='".$key."'>".$value."</option>";
	                           								}}?>
	                           							</select>
	                           						</div>
	                           					</div>
	                           				</div>
	                           				<div class="row">
	                           					<div class="col-md-12">
	                           						<div class="form-group">
	                           							<label>City </label>
	                           							<input type="text" name="city" value="<?php  echo $billinginfo->city;?>" class="form-control">
	                           						</div>
	                           					</div>
	                           				</div>
	                           				<div class="row">
	                           					<div class="form-group">
	                           						<div class="col-md-12">
	                           							<label>Address </label>
	                           							<textarea class="form-control" name="address"><?php  echo $billinginfo->address;?></textarea>
	                           						</div>
	                           					</div>
	                           				</div>
	                           				<div class="row">
	                           					<div class="col-md-12">
	                           						<input type="button" value="Save" id="savebilling" class="btn btn-primary pull-right mb-sm" data-loading-text="Loading...">
	                           					</div>
	                           				</div>
	                           			</form>
	                   			</div> <!-- //hook-6_3 ended -->

	                       		<div class="col-md-6" id="paymentfields">
	                       			<div style="bacgkground-color: white">
	                       				<script>
	                       					function myFunction(x, y) {
	                       						$( "input[maxlength]" ).keyup(function() {
	                       							var maxLen = this.maxLength;
	                       							var currentLen = this.value.length;
	                       							var next = x.tabIndex+1;
	                       							if (maxLen === currentLen)
	                       							{
												//debugger;
												document.getElementById("paymentfrm").elements[next].focus();
											}
										});
	                       					}
	                       				</script>

	                       				<form name="payment" id="paymentfrm" method="post" action=""  style="bacgkground-color: white">
	                       					<div class="row">
	                       						<div class="col-md-6"><h4 class="heading-primary">Payment Details</h4></div>
	                       						<div class="col-md-6" >
	                       							<img class="img-responsive pull-right" src="<?=base_url('public/new_frontend/img/cc_payment.png')?>">
	                       						</div>
	                       					</div>
	                       					<div class="row">
	                       						<div class="form-group">
	                       							<div class="col-md-12">
	                       								<label>Name as it appears on the card </label>
	                       								<input class="form-control" id="cc_name" name="cc_name" pattern="\w+ \w+.*" title="First and last name" required="required" type="text" placeholder="Full Name">
	                       							</div>
	                       						</div>
	                       					</div>
	                       					<div class="row">
	                       						<div class="form-group">
	                       							<div class="col-md-12">
	                       								<label>Card Number </label>
	                       							</div>
	                       							<div class="col-md-3">
	                       								<input class="form-control" name="ccn1" autocomplete="off" tabindex="1" maxlength="4" pattern="\d{4}" title="First four digits" required="" type="text" value="" onkeyup="myFunction(this,this.value)">
	                       							</div>
	                       							<div class="col-md-3">
	                       								<input class="form-control" name="ccn2" autocomplete="off" tabindex="2" maxlength="4" pattern="\d{4}" title="Second four digits" required="" type="text" value="" onkeyup="myFunction(this,this.value)">
	                       							</div>
	                       							<div class="col-md-3">
	                       								<input class="form-control" name="ccn3" autocomplete="off" tabindex="3" maxlength="4" pattern="\d{4}" title="Third four digits" required="" type="text" value="" onkeyup="myFunction(this,this.value)">
	                       							</div>
	                       							<div class="col-md-3">
	                       								<input class="form-control" name="ccn4" autocomplete="off" tabindex="4" maxlength="4" pattern="\d{4}" title="Fourth four digits" required="" type="text" value="" onkeyup="myFunction(this,this.value)">
	                       							</div>
	                       						</div>
	                       					</div>
	                       					<div class="row">
	                       						<div class="form-group">
	                       							<div class="col-md-6">
	                       								<label>Expiration Date </label>
	                       							</div>
	                       							<div class="col-md-9">
	                       								<select class="form-control" name="cc_exp_mo">
	                       									<option value="01">01 - January</option>
	                       									<option value="02">02 - February</option>
	                       									<option value="03">03 - March</option>
	                       									<option value="04">04 - April</option>
	                       									<option value="05">05 - May</option>
	                       									<option value="06">06 - June</option>
	                       									<option value="07">07 - July</option>
	                       									<option value="08">08 - August</option>
	                       									<option value="09">09 - September</option>
	                       									<option value="10">10 - October</option>
	                       									<option value="11">11 - November</option>
	                       									<option value="12">12 - December</option>
	                       								</select>
	                       							</div>
	                       							<div class="col-md-3">
	                       								<select class="form-control" name="cc_exp_yr">
	                       									<?php for($i=date("y");$i <= 25;$i++){
	                       										echo '<option value="'.$i.'">20'.$i.'</option>';
	                       									}
	                       									?>
	                       								</select>
	                       							</div>
	                       						</div>
	                       						<div class="col-md-6">
	                       							<label>Card CVV </label>
	                       							<input class="form-control" name="ccvv" autocomplete="off" maxlength="3" pattern="\d{3}" title="Three digits at back of your card" required="" type="text" value="">
	                       						</div>
	                       					</div>
	                       				</form>
	                       			</div>
	                       		</div> <!-- //paymentfields ended -->
                       	   </div>
                           <div class="row">
                           		<div class="col-md-12">
                           			<br/>
                           			<p id="msgpayinfo"></p>
                           			<div class="button-group-warp clearfix mt-20">
                           				<ul class="list-inline pull-left mb-0">
                           					<a href="javascript:void(0)" class="btn btn-primary" id="payment_cancel"><i class="fa fa-arrow-left"></i> Edit Order</a>
                           				</ul>
                           				<ul class="list-inline pull-right mb-0" id="hook-6_5">
                           					<a href="javascript:void(0)" class="btn btn-primary" id="payment_flyer"><i class="fa fa-arrow-right"></i> Process Order</a>
                           				</ul>
                           			</div>
                           		</div>
                           </div>
                       </div> <!-- //panel-body end -->
                     </div> <!-- accordian-body end -->
               </div> <!-- // step 6 end -->

               <div class="panel panel-default" id="step_7">
               	<div class="panel-heading">
               		<h4 class="panel-title">
               			<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#CollapseSeven">
               				Step 7: Send!
               			</a>
               		</h4>
               	</div>
               	<div id="" class="accordion-body collapse <?php if($this->session->userdata('tab_open')==7){echo 'in';} ?>">
               		<div class="panel-body">
               			<div class="row">
               				<div class="col-md-12">
               					<div class="col-md-12 thank_you">
               						<img src="<?php echo base_url(); ?>public/new_frontend/img/left_side.png" title="thanks" align="left"/>
               						<h3>Thank you for your Order!</h3>
               						<h5>Your order is under review we will notify you by email soon.</h5>
               					</div>
               					<div class="col-md-12">
               						<p id="msgplace_order"></p>
               					</div>
               					<div class="actions-continue">
               						<input type="button" value="Okay" id="place_order" name="proceed" class="btn btn-lg btn-primary mt-xl" style="margin-right:4px">
               					</div>
               				</div>
               			</div>
               		</div>
               	</div>
               </div> <!-- // step 7 end -->
           
           </div><!-- ////// panel-group ended -->
       </div>
   </div>
</div> <!-- //////////// #main ended -->
</div>
   </div>
   <div id="resizeObjectModal" class="modal fade" tabindex="-1" role="dialog">
   	<div class="modal-dialog" role="document">
   		<div class="modal-content">
   			<div class="modal-header">
   				<h5 class="modal-title" id="modalLabel">Cropper</h5>
   				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   			</div>
   			<div class="modal-body">
   				<center><div class="img-container">
   					<img id="imageForResize" src="" alt="Picture">
   				</div></center>
   			</div>
   			<div class="modal-footer">
   				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   			</div>
   		</div>
   	</div>
   </div>
   <!--modal canvas  -->
   <div id="resizeObjectModal" class="modal fade" tabindex="-1" role="dialog">
   	<div class="modal-dialog" role="document">
   		<div class="modal-content">
   			<div class="modal-header">
   				<h5 class="modal-title" id="modalLabel">Cropper</h5>
   				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   			</div>
   			<div class="modal-body">
   				<center><div class="img-container">
   					<img id="imageForResize" src="" alt="Picture">
   				</div></center>
   			</div>
   			<div class="modal-footer">
   				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   			</div>
   		</div>
   	</div>
   </div>

   <div style="display: none" class="hide modal fade bs-example-modal-sm" id="editor-logo_companyModal" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   	<div class="modal-dialog modal-sm">
   		<div class="modal-content">
   			<div class="modal-header">
   				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   				<h4 class="modal-title">Upload Image</h4>
   			</div>
   			<div class="modal-body" style="min-height: 200px;">
   				<div class="row">
   					<div class="col-md-6 col-md-offset-3">
   						<center>
   							<div class="logo_company_Upload btn btn-default">
   								<i class="fa fa-upload fa-5x"></i>
   								<input type="file" class="upload" id="imageUpload_logo_company" />
   							</div><br><br>
   							<h5><strong>Upload Image</strong></h5>
   						</center>
   					</div>
   				</div>
   			</div>
   		</div>
   	</div>
   </div>

   <div style="display: none" class="hide modal fade bs-example-modal-sm" id="editor-uploaderModal" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   	<div class="modal-dialog modal-sm">
   		<!-- Modal content-->
   		<div class="modal-content">
   			<div class="modal-header">
   				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: 7px;margin-top: 2px"><span aria-hidden="true">&times;</span></button>
   				<h4 class="modal-title">Upload Image</h4>
   			</div>
   			<div class="modal-body" style="min-height: 200px;">
   				<div class="row">
   					<center>
   						<div class="col-md-6" id="uploadBtnContainer">
   							<center>
   								<div class="fileUpload btn btn-default">
   									<i class="fa fa-upload fa-5x"></i>
   									<input type="file" class="upload" id="imageUpload" />
   								</div><br><br>
   								<h5><strong>Upload Image </strong></h5>
   							</center>
   						</div>
   						<div class="col-md-6" id="cropBtnContainer">
   							<center>
   								<button id="cropBtn" class="btn btn-default" style="width: 94px">
   									<i class="icon-crop fa-5x"></i>
   								</button><br><br>
   								<h5><strong>Crop Image</strong></h5>
   							</center>
   						</div>
   					</center>
   				</div>

   			</div>
   		</div>
   	</div>
   </div>

   <div class="modal fade bs-example-modal-lg" id="editor-cropperModal" data-backdrop="static" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
   	<div class="modal-dialog">
   		<!-- Modal content-->
   		<center>
   			<div class="modal-content modal-content-CROP" id="editor-cropperModalContent">


   			</div>
   		</center>
   	</div>
   </div>

   <!-- //power tour hook -->
   <div id="pull_help"><a href="" class="user_guide"><i class="fa fa-question-circle" aria-hidden="true"></i> User Guide</a></div>

   <!-- //////////power tour test code START -->


   <!-- steps(content) --> 

   <div class="single-step" id="step-id-1">
   	<h3>Ready to start a new flyer?</h3>
   	<p>Select "Create a New Flyer" here</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   	<a href="#" class="btn btn-warning btn-sm exit_tour pull-right">Exit</a> &nbsp;
   </div>

   <div class="single-step" id="step-id-2">
   	<h3>Have your own fyer?</h3>
   	<p>Select "upload your own flyer" here</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous</a>
   	<a href="" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>

   <div class="single-step" id="step-id-3">
   	<h3>Need Help?</h3>
   	<p>If you need help anytime while completing your order click this button "User Guide" in bottom left to pull help.</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<br/>
   	<br/>
   	<a href="" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="" class="btn btn-primary btn-sm" data-powertour-action="stop" style="float:right">Okay, Got it!</a>
   </div>

   <!-- //STEP 2 TOUR START -->
   <div class="single-step" id="step-2">
   	<h3>1. Looking for specific type of flyer?</h3>
   	<p>Select it here or click "Show All Flyers" to see all.</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   	<a href="#" class="btn btn-warning btn-sm exit_tour pull-right">Exit</a> &nbsp;
   </div>

   <div class="single-step" id="step-2_2">
   	<h3>2. Find something you like?</h3>
   	<p>Select from one of the flyers here</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>

   <div class="single-step" id="step-2_3">
   	<h3>3. Select a flyer for a better look.</h3>
   	<!-- <p>Select from one of the flyers here</p> -->
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>

   <div class="single-step" id="step-2_4">
   	<h3>4. Check here for a detailed view.</h3>
   	<!-- <p>Select from one of the flyers here</p> -->
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>

   <div class="single-step" id="step-2_5">
   	<h3>5. Like the flyer you selected?</h3>
   	<p>Click "Next" and lets get started on designing it.</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="stop" style="float:right">Okay</a>
   </div>

   <!-- //STEP 3 TOUR -->
   <div class="single-step" id="step-3_1">
   	<h3>1. This is where you update font settings</h3>
   	<p>Includes font size, alignment, font & color</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   	<a href="#" class="btn btn-warning btn-sm exit_tour pull-right">Exit</a> &nbsp;
   </div>
   <div class="single-step" id="step-3_2">
   	<h3>2. Available text on flyer.</h3>
   	<p>All the available text options are listed here. Just click the box or text on flyer to edit.</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>
   <div class="single-step" id="step-3_3">
   	<h3>3. This is where you edit text</h3>
   	<p>It activates when you click text on flyer on left or choose from available text boxes on right.</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>
   <div class="single-step" id="step-3_4">
   	<h3>4. Changing Images.</h3>
   	<p>Click on these <img src="https://xyzflyers.com//assets/imgs/placeholderBtn.png" alt="icon" height="35px" width="47px" /> upload icons on flyer to upload images.</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>
   <div class="single-step" id="step-3_6">
   	<h3>5. Flyer Themes</h3>
   	<p>Want to change colors or check flyer themes? click here</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>

   <div class="single-step" id="step-3_7">
   	<h3>6. Don't like what you did? Undo it!</h3>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>

   <div class="single-step" id="step-3_8">
   	<h3>7. Want a closer look?</h3>
   	<p>Click here to choose zoom levels</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>

   <div class="single-step" id="step-3_9">
   	<h3>8. Done editing flyer?</h3>
   	<p>Click "Save & Continue" to move to next step!</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="stop" style="float:right">Okay</a>
   </div>
   <!-- //STEP 3 TOUR END -->

   <!-- //STEP 4 TOUR START -->
   <div class="single-step" id="step-4_1">
   	<h3>1. Subject</h3>
   	<p>This is where you would put subject line for your email when you sent it to list, i.e. "Don't miss this great new home on market!"</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   	<a href="#" class="btn btn-warning btn-sm exit_tour pull-right">Exit</a> &nbsp;
   </div>
   <div class="single-step" id="step-4_2">
   	<h3>2. Your Email</h3>
   	<p>Enter your return email address here</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>
   <div class="single-step" id="step-4_3">
   	<h3>3. Copy to Client</h3>
   	<p>Don't forget to send a copy to your client.</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>
   <div class="single-step" id="step-4_4">
   	<h3>4. Check Carefully</h3>
   	<p>This is where you proof everything you have put on the flyer, please check carefully.</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>
   <div class="single-step" id="step-4_5">
   	<h3>5. Got something wrong?</h3>
   	<p>Click "Cancel & Go back" here to go back and change it.</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="stop" style="float:right">Okay</a>
   </div>

   <!-- //STEP 5 TOUR START -->
   <div class="single-step" id="step-5_1">
   	<h3>Selecting Target Audience</h3>
   	<p>Choose a state by clicking on the interactive map and scroll below to create your order.</p>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="stop" style="float:right">Okay</a>
   </div>

   <!-- //STEP 6 TOUR START -->
   <div class="single-step" id="step-6_1">
   	<h3>This shows what you are sending and where</h3>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>
   <div class="single-step" id="step-6_2">
   	<h3>If you have a coupon enter it here</h3>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   	<a href="#" class="btn btn-warning btn-sm exit_tour pull-right">Exit</a> &nbsp;
   </div>
   <div class="single-step" id="step-6_3">
   	<h3>Be sure to enter your billing information here</h3>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>
   <div class="single-step" id="step-6_4">
   	<h3>Enter your credit card information here</h3>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="next" style="float:right">Next...</a>
   </div>
   <div class="single-step" id="step-6_5">
   	<h3>Click "Process Order" to complete your order</h3>
   	<br/>
   	<div data-powertour-placeholder="timer" class="timer"></div>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="prev">Previous...</a>
   	<a href="#" class="btn btn-primary btn-sm" data-powertour-action="stop" style="float:right">Okay</a>
   </div>

   <?php
   $this->load->view('new_frontend/public/footer');
   ?>
   <script type="text/javascript">
   	function animate_to(elemnt)
   	{
   		$('html, body').animate({
   			scrollTop: $(elemnt).offset().top
   		}, 1000);
   	}

//STEP ONE OPTION 1 create new flyer
jQuery(document).ready(function($) {
	if(!$('#big_image').attr('idd'))
	{
		$('#big_image').addClass('hidden');
		$('#big_image').parent().append('<div id="no_selected_img_alert" class="text-center alert alert-success" style="padding:  50px;  margin:  50px;">'
			+'<div><h1 class="text-success well"><i style="font-size: 44px;" class="fa fa-thumbs-o-up"> </i>Great!</h1><h3 class="text-success beautify_text1" style="text-transform: capitalize">Now Let\'s choose a flyer</h3><h5 style="text-transform: capitalize; color: #777777">Please choose a premade flyer template <br>from left <i class="fa fa-arrow-left"></i> to continue!</h5></div></div>')
	}

});
$('#create_your_flyer').on('click', function(event) {
	event.preventDefault();
	$.ajax({
		url: site_url+"editor/create_new",
		type : 'POST',
		async: false,
		data: {"new_flyer":1},
		dataType: 'json',
		beforeSend: function(){
			$('#ajax_loader').show();
		},
		success:function(result){
			$('#ajax_loader').hide();
			$('#powertour-mask').hide(); //end tour before going to next
			$('#step_1 .accordion-body').removeClass('in');
			$('#step_2 .accordion-body').addClass('in').fadeIn();
		},
		error: function () {
			if(confirm('Some Error ! Please try again.')==true){
				$('#step_2 .accordion-body').addClass('in').fadeIn();
				$('#step_1 .accordion-body').removeClass('in');
				$("#ajax_loader").hide();
			}
		}
	});
});
//Cancel option 1
$('#choose_cancel').on('click', function(event) {
	swal({
		title: "Are you sure?", 
		text: "Are you sure you want to go back?", 
		type: "warning",
		showCancelButton: true,
		closeOnConfirm: true,
		confirmButtonText: "Yes!",
		confirmButtonColor: "#ec6c62"
	}, function() {
		$.ajax({
			url: site_url+"editor/cancel_new",
			type : 'POST',
			// async: false,
			data: {"new_cancel":1},
			dataType: 'json',
			beforeSend: function()
			{
				$('#ajax_loader').show();
				$('#powertour-mask').hide();
			},
			success:function(result){
				// setTimeout(function(){
					if(result.message=='Error')
					{
						swal("Oops...", "Somthing went wrong!", "error");
					}
					else 
					{
						$('#ajax_loader').hide();	
						$('#powertour-mask').hide();
						$('#step_2 .accordion-body').removeClass('in');
						$('#step_1 .accordion-body').addClass('in').fadeIn();
						animate_to('.breadcrumb');

					}
				// },500);
	},
	error: function () {
		if(confirm('Some Error ! Please try again.')==true){
			$("#ajax_loader").hide();
		}
	}
});
	});
});
//STEP ONE OPTION 2 USE PREVIUS FLYER
$('#use_previous_flyer').on('click', function(event) {
	$("#previous_flyer").fadeIn();
	$('#upload_file').fadeOut();					
});
//STEP ONE OPTION 2 magnify flyer
$(".flyer_megnify").on('click', function(event) {
	var flyerID= $(this).attr('title');
	var flyer_id = flyerID.split('_');
	$("#prev_flyer_id").val(flyer_id[0]);
	$(".flyer_megnify").removeClass('flyer_small_selected');
	$(this).addClass('flyer_small_selected');
	var flyerimg = $(this).attr("id");
	$("#megaimg").html('');
	$("#megaimg").html('<img class="img-responsive" src="<?php echo base_url();?>public/upload/user_flyer_store/'+flyerimg+'" alt="'+flyerimg+'"/>');
	// $("megaimg").html('');
});
//STEP ONE OPTION 2 CANCEL PREVIOUS FLYER
$("#prev_flyer_cancel").on('click', function(event) {
	swal({
		title: "Are you sure to go back?", 
		text: "", 
		type: "warning",
		showCancelButton: true,
		closeOnConfirm: true,
		confirmButtonText: "Yes!",
		confirmButtonColor: "#ec6c62"
	},function(){
		$('#ajax_loader').show();
		setTimeout(function(){
			$('#ajax_loader').hide();
			window.location.href = "<?php echo base_url(); ?>editor";
		},3000);
	});					
});
//STEP ONE OPTION 2 USE PREVIOUS FLYER
$('#use_prev_flyer').on('click', function(event) {
	$('#ajax_loader').show();
	$.ajax({
		url: site_url+"editor/use_existing_flyer",
		type : 'POST',
		data: {"flyer":$("#prev_flyer_id").val()},
		dataType: 'json',
		success:function(result){
			if(result['message']=='Success'){
				setTimeout(function(){
					$('#ajax_loader').hide();
					window.location.href = "<?php echo base_url(); ?>editor";
				},3000);
			}else{
				$("#msgprev").html('<div class="alert alert-danger">Some Error ! Please Try next one.</div>');
			}
		},
		error: function () {
			if(confirm('Some Error ! Please select a new one.')==true){
				$("#ajax_loader").hide();
			}
		}
	});
});
//STEP ONE OPTION 3 upload flyer
$('#upload_btn').on('click', function(event) {
	event.preventDefault();
	$('#previous_flyer').fadeOut();
	$('#upload_file').fadeIn();
});
$('#upload_cancel').on('click', function(event) {
	$('#custom_file').val('');
	$('#flyer_terms').prop( "checked", false );
	$('#msgfile').html('');
	$('#upload_file').fadeOut();
});
$('#upload_flyer').on('click', function(event) {
	$('#ajax_loader').show();
	$.ajax({
		url: "<?php echo base_url(); ?>editor/upload_flyer",
		type : 'POST',
		data: new FormData($('#frm_flyer')[0]),
		cache:false,
		dataType: 'json',
		contentType: false,
		async: false,
		processData: false,
		success:function(result){
			//console.log(result);
			//return false;
			if(result['message']=="Success"){
				$("#msgfile").html('<div class="alert alert-success">Successfully Uploaded.</div>');
				// setTimeout(function(){
					$('#ajax_loader').hide();
					window.location.href = "<?php echo base_url(); ?>editor";
				// },500);
}else{
	$("#msgfile").html(result);
	setTimeout(function(){
		$('#ajax_loader').hide();
	}, 500);

}
}
});

});
//Step number 4 proof
$('#proof_flyer').on('click', function(event) {
	if($("#frm_proof input[name='subject']").val()==""){
		swal({
			title: "Oops",
			text: "Please fill the subject line for your email field !",
			type: "warning",
			closeOnConfirm: true
		},function(){
			setTimeout(function(){
				$('#ajax_loader').hide();
				$("#frm_proof input[name='subject']").focus();
				window.scrollTo(0, 0);
			}, 1);
		});

		return false;
	}else if($("#frm_proof input[name='email']").val()==""){
		swal({
			title: "Oops",
			text: "Please fill the return email address field!",
			type: "warning",
			closeOnConfirm: true
		},function(){
			setTimeout(function(){
				$('#ajax_loader').hide();
				$("#frm_proof input[name='email']").focus();
				window.scrollTo(0, 0);
			}, 1);
		});
		return false;

	}else{
		$.ajax({
			url: "<?php echo base_url(); ?>editor/saveproof",
			type : 'POST',
			data: $('#frm_proof').serialize(),
			dataType: 'json',
			async: false,
			beforeSend: function(){$('#ajax_loader').show();},
			success:function(result){
				if(result['message']=='Success'){
					$("#msgproof").html('<div class="alert alert-success">Successfully Saved.</div>');
				// setTimeout(function(){
					$('#ajax_loader').hide();
					window.location.href = "<?php echo base_url(); ?>editor";
				// },3000);
	}else if(result=='Error'){
							// setTimeout(function(){
								$('#ajax_loader').hide();
							// }, 1000);
		swal('Oops','Something went wrong. Please try again later.', 'error');

	}else{
		swal('Oops', 'Please make sure all the email fields are filled.', 'warning');
							// setTimeout(function(){
								$('#ajax_loader').hide();
							// }, 1000);
	}
}
});
	}
});
$('#proof_cancel').on('click', function(event) {
	swal({
		title: "You are about to cancel flyer?", 
		text: "All data on this tab might be lost!", 
		type: "warning",
		showCancelButton: true,
		closeOnConfirm: true,
		confirmButtonText: "Yes!",
		confirmButtonColor: "#ec6c62"
	},function() {
		$('#ajax_loader').show();
		$.ajax({
			url: "<?php echo base_url(); ?>editor/cancelFlyer",
			type : 'POST',
			async: false,
			data: {"cancel_proof":1},
			dataType: 'json',
			success:function(result){
				if(result['message']=='Success'){
					$('#ajax_loader').hide();
					window.location.href = "<?php echo base_url(); ?>editor";
				}else if(result=='Error'){
					swal('Oops','Something went wrong. Please try again later.', 'error');
					setTimeout(function(){
						$('#ajax_loader').hide();
					}, 1000);

				}
			}, 
			error: function(err){
				console.log(err);
				$('#ajax_loader').hide();
				swal('Oops','Something went wrong. Please try again later.', 'error');

			}
		});
	});
});
//Step number 5 Delivery
$('#delivery_flyer').on('click', function(event) {
	$('#ajax_loader').show();
	$.ajax({
		url: "<?php echo base_url(); ?>editor/agentsInque",
		type : 'POST',
		data: {"agtentsEmails":1},
		dataType: 'json',
		success:function(result){
			if(result['message']=='Success'){
				$("#msgdelivery").html('<div class="alert alert-success">Successfully Saved.</div>');
				setTimeout(function(){
					$('#ajax_loader').hide();
					window.location.href = "<?php echo base_url(); ?>editor";
				},3000);
			}else if(result['message']=='Empty'){
				$("#msgdelivery").html('<div class="alert alert-danger">No agents are selected please select to proceed.</div>');
				swal('Please Select Agents!','No agents are selected please select to proceed.', 'error');
				setTimeout(function(){
					$('#ajax_loader').hide();
				}, 1000);

			}
		}
	});
});
$('#delivery_cancel').on('click', function(event) {
	swal({
		title: "You are about to cancel selected agents?", 
		text: "All data on this tab might be lost!", 
		type: "warning",
		showCancelButton: true,
		closeOnConfirm: true,
		confirmButtonText: "Yes!",
		confirmButtonColor: "#ec6c62"
	},function() {
		$('#ajax_loader').show();
		$.ajax({
			url: "<?php echo base_url(); ?>editor/cancelCart",
			type : 'POST',
			data: {"cancel_delivery":1},
			dataType: 'json',
			success:function(result){
				if(result['message']=='Success'){
					// $("#msgdelivery").html('<div class="alert alert-success">Successfully Cancelled.</div>');
					setTimeout(function(){
						$('#ajax_loader').hide();
						window.location.href = "<?php echo base_url(); ?>editor";
					},3000);
				}else if(result=='Error'){
					swal('Oops','Something went wrong. Please try again later.', 'error');
					setTimeout(function(){
						$('#ajax_loader').hide();
					}, 1000);

				}
			}
		});
	});
});
//Payment info step 6
$('#editShippingAddress').on('click', function(event) {

	$('#frmShippingAddress').show('slow');
	$('#tblShippingAddress').hide();

});
//save billing address
$('#savebilling').on('click', function(event) {
	$("#ajax_loader").show();
	$.ajax({
		url: "<?php echo base_url(); ?>editor/save_billing_info",
		type : 'POST',
		data: $('#frmShippingAddress').serialize(),
		dataType: 'json',
		success:function(result){
			$("#ajax_loader").hide();
			var data_billing="";
			if(result['message']=='Empty'){
				$("#error").show('slow');
				$("#error").html("Please fill the form.");
			}else if(result['message']=='Error'){
				$("#error").show('slow');
				$("#error").html("Some Error");
			}else{
				setTimeout(function(){
					$('#ajax_loader').hide();
					window.location.href = "<?php echo base_url(); ?>editor";
				},3000);
				/*$("#error").hide();
				$("#billState").html(result['billinginfo']['state']);
				$("#billCounty").html(result['billinginfo']['county']);
				$("#billCity").html(result['billinginfo']['city']);
				$("#billAddress").html(result['billinginfo']['address']);
				$('#frmShippingAddress').hide();
				$('#tblShippingAddress').show('slow');*/

			}

		},error: function () {
			if(confirm('Some Error ! Please try again.')==true){
				$("#ajax_loader").hide();
			}
		}
	});
});
//step number 6 coupen form display
$('#coupenId').on('click', function(event) {
	if($("#coupenId").prop('checked') == true){
		$("#coupenform").fadeIn();
	}else{
		$("#coupenform").fadeOut();
		$("#msgcoupen").html('');
	}
});
//step 6 coupen add
$('#addcoupen').on('click', function(event) {
	$('#ajax_loader').show();
	$.ajax({
		url: "<?php echo base_url(); ?>editor/coupenAdd",
		type : 'POST',
		data: {"cooupen_code":$('#coupon_code').val()},
		dataType: 'json',
		success:function(result){
			if(result['message']=='Success'){
				$("#msgcoupen").html('<div class="alert alert-success">Coupon Is Saved Successfully</div>');
				setTimeout(function(){
					$('#ajax_loader').hide();
					window.location.href = "<?php echo base_url(); ?>editor";
				},3000);
			}else if(result['message']=='Error'){
				swal('Oops','Something went wrong. Please try again later.', 'error');
				setTimeout(function(){
					$('#ajax_loader').hide();
				}, 1000);

			}else{
				$("#msgcoupen").html(result);
				setTimeout(function(){
					$('#ajax_loader').hide();
				}, 1000);
			}
		}
	});
});
//remove active coupen
$('#removecoupen').on('click', function(event) {
	swal({
		title: "Do you want to remove the applied coupon?", 
		text: "", 
		type: "warning",
		showCancelButton: true,
		closeOnConfirm: true,
		confirmButtonText: "Yes!",
		confirmButtonColor: "#ec6c62"
	},function() {
		$('#ajax_loader').show();
		$.ajax({
			url: "<?php echo base_url(); ?>editor/cancelCoupen",
			type : 'POST',
			data: {"cancel_coupen":1},
			dataType: 'json',
			success:function(result){
				if(result['message']=='Success'){
					$("#msgcoupen").html('<div class="alert alert-success">Successfully removed.</div>');
					setTimeout(function(){
						$('#ajax_loader').hide();
						window.location.href = "<?php echo base_url(); ?>editor";
					},3000);
				}else if(result=='Error'){
					swal('Oops','Something went wrong. Please try again later.', 'error');
					setTimeout(function(){
						$('#ajax_loader').hide();
					}, 1000);

				}
			}
		});
	});
});
//Step number 6 payment Information	
$('#payment_flyer').on('click', function(event) {
	if($("#billing_state").val()==""){
		swal('Oops','Please provide state info !', 'error');
	}else{
		$('#ajax_loader').show();
		$.ajax({
			url: "<?php echo base_url(); ?>editor/placeOrder",
			type : 'POST',
			data: $('#paymentfrm').serialize(),
			dataType: 'json',
			success:function(result){
				if(result['message']=='Success'){
					$("#msgpayinfo").html('<div class="alert alert-success">Your order is ready.</div>');
					setTimeout(function(){
						$('#ajax_loader').hide();
						window.location.href = "<?php echo base_url(); ?>editor";
					},3000);
				}else if(result['message']=='Conversion'){
					$("#msgpayinfo").html('<div class="alert alert-default text-center"><button type="button" id="HOME" class="currencybtn btn btn-secondary">Home Currency</button>&nbsp&nbsp&nbsp<button type="button" id="FOREIGN" class="currencybtn btn btn-success">Foreign Currency</button></div>');
					$('#ajax_loader').hide();
				}else if(result['message']=='Error'){
					swal('Oops','Something went wrong. Please try again later.', 'error');
					setTimeout(function(){
						$('#ajax_loader').hide();
					}, 1000);

				}else{
					$("#msgpayinfo").html('<div class="alert alert-danger">'+result['message']+'</div>');
					setTimeout(function(){
						$('#ajax_loader').hide();
					}, 1000);
				}
			}
		});
}
});
$(function() {
	$(document).on('click', '.currencybtn', function() {
		var tag = $(this).attr('id');
		$.ajax({
			url: "<?php echo base_url(); ?>editor/placeCurrencyOrder",
			type : 'POST',
			data : {'tag':tag},
			dataType: 'json',
			success: function(result){
				if(result['message']=='Success'){
					$("#msgpayinfo").html('<div class="alert alert-success">Your order is ready.</div>');
					setTimeout(function(){
						$('#ajax_loader').hide();
						window.location.href = "<?php echo base_url(); ?>editor";
					},3000);
				}else{
					$("#msgpayinfo").html('<div class="alert alert-danger">'+result['message']+'</div>');
					setTimeout(function(){
						$('#ajax_loader').hide();
					}, 1000);
				}
			}
		});
	});
});
$('#payment_cancel').on('click', function(event) {
	swal({
		title: "Are you sure?", 
		text: "All data on this tab might be lost!", 
		type: "warning",
		showCancelButton: true,
		closeOnConfirm: true,
		confirmButtonText: "Yes!",
		confirmButtonColor: "#ec6c62"
	}, function() {
		$('#ajax_loader').show();
		$.ajax({
			url: "<?php echo base_url(); ?>editor/cancelPayment",
			type : 'POST',
			async: false,
			data: {"cancel_payment":1},
			dataType: 'json',
			success:function(result){
				if(result['message']=='Success'){
					// $("#msgpayinfo").html('<div class="alert alert-success">Successfully Cancelled.</div>');
					// setTimeout(function(){
						$('#ajax_loader').hide();
						window.location.href = "<?php echo base_url(); ?>editor";
					// },3000);
	}else if(result=='Error'){
		swal('Oops','Something went wrong. Please try again later.', 'error');
					// setTimeout(function(){
						$('#ajax_loader').hide();
					// }, 1000);

	}
}
});
	});
});

//Step number 7 place order
$('#place_order').on('click', function(event) {
	$('#ajax_loader').show();
	$.ajax({
		url: "<?php echo base_url(); ?>editor/checkInfobefore",
		type : 'POST',
		data: {"send_info":'1'},
		dataType: 'json',
		success:function(result){
			if(result['message']=='Success'){
				$("#msgplace_order").html('<div class="alert alert-success">Your order is under admin review.</div>');
				setTimeout(function(){
					$('#ajax_loader').hide();
					window.location.href = "<?php echo base_url(); ?>editor";
				},3000);
			}else{
				$("#msgplace_order").html('<div class="alert alert-danger">some error occur !</div>');
				setTimeout(function(){
					$('#ajax_loader').hide();
					window.location.href = "<?php echo base_url(); ?>editor";
				}, 1000);
			}
		}
	});
});
/*#################END STEP BY STEP FUNCTIONS#################*/
//when small flyers/ thumbnails are clicked
$(document).delegate('.flyer_small', 'click', function(event) {
	added = []; removed = [];
	$('#status').hide();$('#status #removed, #status #added').text(0);
	event.preventDefault();
	previous_tags = Array();
	$('#no_selected_img_alert').fadeOut().remove();
	id = $(this).attr('id');
	$('#big_image').attr('src',site_url+'/public/upload/flyer_images/resized_'+$(this).attr('img')).attr('idd',id).removeClass('hidden').fadeIn();
	$('.flyer_small').removeClass('flyer_small_selected');
	$(this).addClass('flyer_small_selected');
	$('#selected_flyer').val(id);
	$('#editor-canvasSize').text($(this).attr('size'));

	$('.next_message_for_step_2').remove();
	$('.choose-flyer-grid-wrap').parent().append('<div class="next_message_for_step_2 hidden"><br><br><br><div class="well"><strong>Nice! Please click "Next (Design Flyer)" button on the bottom right to continue.</strong></div></div>');
	$('.next_message_for_step_2').removeClass('hidden').hide().fadeIn();
		//addBackgroundImage();
	});
// load flyers on category click
$(document).delegate('.load_flyers', 'click', function(event) {
	event.preventDefault();
	clear_tags();
	text = $(this).text();
		//alert(text); return false;

		$.ajax({
			url: '<?php echo site_url(); ?>editor/load_flyers_by_tags/',
			type: 'POST',
			data: {tagId: $(this).prop('id')},
			beforeSend: function(res){
					//loading
					// console.log('loading flyers');
					$('.choose-flyer-grid-wrap').html('');
					$('.choose-flyer-grid-wrap').html('<div class="col-md-12"><h3><i class="fa fa-loading">Loading...</h3></div>');
				},
				success: function(res){
					var jsn = $.parseJSON(res);
					$('.choose-flyer-grid-wrap').html('');
					if(jsn.length>0)
					{
						$.each(jsn, function() {
							$('.choose-flyer-grid-wrap').append(
								'<div id="flyer_small_'+this.flyer+'" class="col-md-4 mb-20">'
								+'<img src="<?php echo site_url(); ?>public/upload/flyer_images/thumb_'+this.flyer_image+'" size="'+this.flyer_size_title+'" id="'+this.fk_flyer_id+'" class="img-responsive flyer_small" img="'+this.flyer_image+'">'
								+'</div>'
								);

						});
					}
					else {
						$('.choose-flyer-grid-wrap').html('<div class="col-md-12"><p class="text-warning">No Flyers under "'+text+'"!</p></div>');
					}
				},
				error: function(res){
					noti('danger','Something went wrong: '+res);
				}
			});
});
<?php if(isset($_GET['flyer'])){?>
	$(document).ready(function(){
		//alert('ready');
		$('.flyer_small<?php //echo $_GET['flyer'];?>').trigger("click");
		setTimeout(function(){
			$("#next_flyer_design").trigger("click");
		}, 3000);

	});
	<?php }?>


//load selected template on page referesh
<? if(isset($user_selected_flyer))
{?>
	$(document).ready(function($) {
		var idd = <?=$user_selected_flyer?>;
		$.ajax({
			<? if($this->session->using_previous=='true'){?>
			url: '<?php echo site_url(); ?>editor/load_json_update/'+<?=$user_selected_flyer?>,
			<? }else {?> 
				url: '<?php echo site_url(); ?>editor/load_json/'+<?=$user_selected_flyer?>,
				<? }?>
			async: true,
			dataType:'json',
			beforeSend: function(msg){
				$('#ajax_loader').show();
			},
			success: function(msg)
		{   // console.log(msg);
				$.ajax({ // get fonts start
					url: site_url+'editor/get_fonts',
					type: 'GET',
					dataType: 'json',
					success: function(res){
						var fonts = new Array();
						if(res.length>0)
						{
							$('#textfont').empty();
							$.each(res, function(index, font) {
								fonts.push(font.fontTitle)
								$('#textfont').append('<option style="font-family:'+font.fontTitle+'" value="'+font.fontTitle+'">'+font.fontTitle+'</option>');
							});
						}
						WebFontConfig = {
							google: { families: 
								fonts}
							};

							(function() {
								var src = ('https:' === document.location.protocol ? 'https' : 'http') +
								'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';

								$.getScript(src, function(data) {      
    			                    // proFabric.canvas.renderAll();
    			                });
							})();

						},
						error: function(res){console.log(res)},
					}); //get fonts end

				if(msg['message']=='Empty'){
					$('#ajax_loader').hide();
					swal("Oops...", "This Flyer can not be loaded.Try another one !", "error");
					$.ajax({
						url: '/editor/check_if_using_previous_flyer',
						type: 'POST',
						success: function(msg){
							if(msg=='true')
							{
								$("#step_1 .collapse").collapse("show");
								$(".collapse_design").collapse("hide");
								animate_to('#step_1');	
							}else{
								$("#step_2 .collapse").collapse("show");
								$(".collapse_design").collapse("hide");
								animate_to('#step_2');
							}
						},
						error: function(msg){console.log(msg)},
					});

			}else{ // if the flyer is loaded

					$('#ajax_loader').hide();   //msg = JSON.parse(msg);
					var _height = [];
					for(i = 0; i< msg.objects.length;i++)
					{
						_height[i] = msg.objects[i].height;

					}
					proFabric.canvas.loadFromDatalessJSON(msg, proFabric.canvas.renderAll.bind(canvas), function(o, object) {

						if(object.class === 'color' && object.type === 'path-group')
						{
            				object.set({selectable:false}); // console.log('Blocked');
            			}
            			else if(object.type === 'image' && object.uploader === 'false')
            			{
            				object.set({selectable:false});
            			}
            			else if(object.type === 'image' && object.uploader === 'false')
            			{
            				object.set({selectable:false});
            			}
            			object.set({
            				lockMovementX:true,
            				lockMovementY:true,
            				lockScalingX:true,
            				lockScalingY:true,
            				lockRotation:true,
            				hasControls:false,
            				borderColor:'red',
            				hasRotationPoint:false,
            				editable:false,
            				cursorWidth:0,
            			});

            		});
					setTimeout(function(){
						objs = proFabric.canvas.getObjects();
						for(i = 0; i< msg.objects.length;i++)
						{
							objs[i].setHeight(_height[i]);
							proFabric.canvas.renderAll();
						}
					},5000);

					setTimeout(function(){
						$('#ajax_loader').hide();
						$(this).closest('.accordion-body').removeClass('in');
						$('.three .accordion-body ').addClass('in');
					},3000);
				} //else ends here

$.ajax({ //get flyer colorsets
	url: site_url+'/editor/get_flyer_colorsets',
	type: 'POST',
	dataType: 'json',
	async: false,
	data: {flyerId: idd},
	success: function(colorsets){
		old_html =  $('#colorStyleOpt').html();
		$('#colorStyleOpt').html('<div class="row" style="margin: 0px;padding: 0px;">'
			+'<div style="font-size: 16px;margin: 0px;padding: 0px;font-weight: bold;margin-top: 15px;">Flyer Themes:</div>'
			+'<hr style="width: 100%;margin: 0px;padding: 0px; margin-bottom: 10px;"></div>');
		total_colorsets = colorsets.length;

		$.each(colorsets, function(index, colorset) {
			$('#colorStyleOpt').append(
				'<div class="row color-pallet-row colorRow" id="'+colorset.id+'">'
				+'<div class="col-md-9 col-xs-8" style="margin: 0px;padding: 0px;"></div>'
				+'<div class="col-md-3 col-xs-4" style="margin:0px;padding:0px;">'
				+'<label class="textalign1" for="'+colorset.name+'">'
				+colorset.name+'</label></div></div>'
				);

			$.each(colorset.colors, function(index,color) {
				$('#colorStyleOpt #'+colorset.id+' .col-md-9').append(
					'<div class="col-md-2  col-xs-2" style="border: 0px;padding: 0px;margin-top:3px">'
					+'<div id="C11" class="square1" data-id="'+color.objID+'" style="background-color: '+color.clr+';"></div>'
					+'</div>');
			});

		});


	},
	beforeSend: function(msg){console.log(msg);},
	error: function(error){console.log(error);},
});

$.ajax({ // get flyer text properties 
	url: site_url+'/editor/get_flyer_properties/'+idd,
	type: 'POST',
	dataType: 'json',
	async: false,
	success: function(properties){
		$('.txtbuttonContainer').css('display','initial');
		$(properties).each(function(index, el) {
			if(el.property_id !== '')
			{
				_dataType = el.property_type;
				_dataId = el.property_id;
				_label = el.property_label;
				html = '<div class="col-md-6 col-sm-6 col-xm-12"><button class="editor-textAssign btn btn-default txtBtn fullwidth  mg-5" data-type="'+_dataType+'" id="'+	_dataId+'" data-id="'+	_dataId+'">'+_label+'</button></div>';
				$('.text-btns').append(html);
			}
		});

	},
	beforeSend: function(msg){console.log(msg);},
	error: function(error){console.log('------ PROEPERTIES ERROR:  '+error);},

});


$(this).removeClass('disabled')
			// $('.editor-canvasDiv').css('height',proFabric.canvas.height);
			$('html, body').animate({
				scrollTop: $("#step_3").offset().top
			}, 1000);
		},
		error: function(msg){
			$('#ajax_loader').hide();
			swal("Oops...", "Flyer could not be loaded!", "error");
		},
	});	
});

<? } ?>



//design the selected template
$('#next_flyer_design').on('click', function(event) {
	//alert('success');
	<?php if(isset($_GET['flyer'])){?>
		var idd = <?php echo $_GET['flyer'];?>;
		<?php } else {?>
			var idd = $('#big_image').attr('idd');
			<?php }?>

			var _ths = $(this);
			var _height = new Array();
			var objs = new Array();
	//event.preventDefault();
	setTimeout(function(){
		if(idd!=""){
			$.ajax({
				url: '<?php echo site_url(); ?>editor/load_json/'+idd,
				async: true,
				dataType:'json',
				beforeSend: function(msg){
					$('#ajax_loader').show();
					_ths.addClass('disabled')
					$(".collapse").collapse("hide");
					$(".collapse_design").collapse("show");
				},
				success: function(msg){   
				// console.log(msg);
				$.ajax({
					url: site_url+'editor/get_fonts',
					type: 'GET',
					dataType: 'json',
    			    // beforeSend: function(res){console.log(res)},
    			    success: function(res){
    			    	var fonts = new Array();
    			    	if(res.length>0)
    			    	{
    			    		$('#textfont').empty();
    			    		$.each(res, function(index, font) {
    			    			fonts.push(font.fontTitle)
    			    			$('#textfont').append('<option style="font-family:'+font.fontTitle+'" value="'+font.fontTitle+'">'+font.fontTitle+'</option>');
    			    		});
    			    		
    			    		
    			    		
    			    	}
    			    	WebFontConfig = {
    			    		google: { families: 
    			    			fonts}
    			    		};
    			    		
    			    		(function() {
    			    			var src = ('https:' === document.location.protocol ? 'https' : 'http') +
    			    			'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    			    			
    			    			$.getScript(src, function(data) {      
    			                    // proFabric.canvas.renderAll();
    			                });
    			    		})();
    			    		
    			    	},
    			    	error: function(res){console.log(res)},
    			    });
if(msg['message']=='Empty'){
	$('#ajax_loader').hide();
	swal("Oops...", "This Flyer can not be loaded.Try another one !", "error");
	$("#step_2 .collapse").collapse("show");
	$(".collapse_design").collapse("hide");
	animate_to('#step_2');
	_ths.removeClass('disabled')
}else{ 
	$('#ajax_loader').hide();  
            		//msg = JSON.parse(msg);
            		for(i = 0; i< msg.objects.length;i++)
            		{
            			_height[i] = msg.objects[i].height;
            			// console.log('object '+i+' height = '+_height[i]);
            		}
            		proFabric.canvas.loadFromDatalessJSON(msg, proFabric.canvas.renderAll.bind(canvas), function(o, object) {
            			
            			if(object.class === 'color' && object.type === 'path-group')
            			{
            				object.set({selectable:false});
            				// console.log('Blocked');
            			}
            			else if(object.type === 'image' && object.uploader === 'false')
            			{
            				object.set({selectable:false});
            			}
            			else if(object.type === 'image' && object.uploader === 'false')
            			{
            				object.set({selectable:false});
            			}
            			object.set({
            				lockMovementX:true,
            				lockMovementY:true,
            				lockScalingX:true,
            				lockScalingY:true,
            				lockRotation:true,
            				hasControls:false,
            				borderColor:'red',
            				hasRotationPoint:false,
            				editable:false,
            				cursorWidth:0,
            			});
            			// console.log("HERE", object);
            		});
setTimeout(function(){
	objs = proFabric.canvas.getObjects();
	for(i = 0; i< msg.objects.length;i++)
	{
		objs[i].setHeight(_height[i]);
		proFabric.canvas.renderAll();
	}
},5000);

setTimeout(function(){
	$('#ajax_loader').hide();
	$(this).closest('.accordion-body').removeClass('in');
	$('.three .accordion-body ').addClass('in');
},3000);
}

$.ajax({
	url: site_url+'/editor/get_flyer_colorsets',
	type: 'POST',
	dataType: 'json',
	async: false,
	data: {flyerId: idd},
	success: function(colorsets){
		old_html =  $('#colorStyleOpt').html();
		$('#colorStyleOpt').html('<div class="row" style="margin: 0px;padding: 0px;">'
			+'<div style="font-size: 16px;margin: 0px;padding: 0px;font-weight: bold;margin-top: 15px;">Flyer Themes:</div>'
			+'<hr style="width: 100%;margin: 0px;padding: 0px; margin-bottom: 10px;"></div>');
		total_colorsets = colorsets.length;
		
		$.each(colorsets, function(index, colorset) {
			$('#colorStyleOpt').append(
				'<div class="row color-pallet-row colorRow" id="'+colorset.id+'">'
				+'<div class="col-md-9 col-xs-8" style="margin: 0px;padding: 0px;"></div>'
				+'<div class="col-md-3 col-xs-4" style="margin:0px;padding:0px;">'
				+'<label class="textalign1" for="'+colorset.name+'">'
				+colorset.name+'</label></div></div>'
				);
			
			$.each(colorset.colors, function(index,color) {
				$('#colorStyleOpt #'+colorset.id+' .col-md-9').append(
					'<div class="col-md-2  col-xs-2" style="border: 0px;padding: 0px;margin-top:3px">'
					+'<div id="C11" class="square1" data-id="'+color.objID+'" style="background-color: '+color.clr+';"></div>'
					+'</div>');
			});

		});


	},
            		// beforeSend: function(msg){console.log(msg);},
            		error: function(error){console.log(error);},
            	});

$.ajax({
	url: site_url+'/editor/get_flyer_properties/'+idd,
	type: 'POST',
	dataType: 'json',
	async: false,
	success: function(properties){
		$('.txtbuttonContainer').css('display','initial');
		$(properties).each(function(index, el) {
			if(el.property_id !== '')
			{
				_dataType = el.property_type;
				_dataId = el.property_id;
				_label = el.property_label;
				html = '<div class="col-md-6 col-sm-6 col-xm-12"><button class="editor-textAssign btn btn-default txtBtn fullwidth  mg-5" data-type="'+_dataType+'" id="'+	_dataId+'" data-id="'+	_dataId+'">'+_label+'</button></div>';
				$('.text-btns').append(html);
			}
		});
		
	},
            		// beforeSend: function(msg){console.log(msg);},
            		error: function(error){console.log('------ PROEPERTIES ERROR:  '+error);},

            	});


$(this).removeClass('disabled')
// $('.editor-canvasDiv').css('height',proFabric.canvas.height);
$('html, body').animate({
	scrollTop: $("#step_3").offset().top
}, 1000);
},
error: function(msg){
	$('#ajax_loader').hide();
	swal("Oops...", "Flyer could not be loaded!", "error");

},
});
}else{
	swal("Oops...", "Choose a template to proceed!", "error");
}
},1500);

});

$(document).delegate('button.editor-textAssign','click',function(){
	$('button.editor-textAssign').removeClass('btn-primary');
	var _id = $(this).attr('data-id'), _this = $(this);
	var exist = proFabric.get.checkID(_id);
	setTimeout(function() {
		if(exist){
			proFabric.canvas.forEachObject(function(obj) {
				if (obj.id == _id) {	
					proFabric.canvas.setActiveObject(obj, '');
				}
			});
			proFabric.canvas.renderAll();
			_this.addClass('btn-primary');
		}
	}, 50);
});

$(document).delegate('.colorRow','click', function(event) {
	event.preventDefault();
	colorSet_id = $(this).attr('id');
	$(this).toggleClass('colorRowhover');
	/* Act on the event */

	$('#'+colorSet_id).find('.square1').each(function(index, el) {
		obj_clr = $(el).css('background-color');
		obj_id  = $(el).attr('data-id');
		proFabric.set.setColorSet(obj_id, obj_clr);
	});

});
  //update the selected template
  //design the selected template
  $('#update_flyer').on('click', function(event) {
  	var idd = '<?php echo $this->session->userdata("active_flyer"); ?>';
  	var iadm= '<?php echo $this->session->userdata("admin_flyer"); ?>';
  	var _height = new Array();
  	var objs = new Array();
	//event.preventDefault();
	if(idd!=""){ 
		$.ajax({
			url: '<?php echo site_url(); ?>editor/load_json_update/'+idd,
			async: false,
			dataType:'json',
			beforeSend: function(msg){$('#ajax_loader').show();},
			success: function(msg){   
				if(msg['message']=='Empty'){
					$('#ajax_loader').hide();
					swal("Oops...", "This Flyer can not be loaded.Try another one !", "error");
				}else{ 
					$('#ajax_loader').hide();  
					$(".collapse").collapse("hide");
					$(".collapse_design").collapse("show");
            		//msg = JSON.parse(msg);
            		for(i = 0; i< msg.objects.length;i++)
            		{
            			_height[i] = msg.objects[i].height;
            			// console.log('object '+i+' height = '+_height[i]);
            		}
            		canvas = proFabric.canvas;
            		canvas.loadFromDatalessJSON(msg, canvas.renderAll.bind(canvas), function(o, object) {
            			fabric.log(o, object);
            			object.set({
            				lockMovementX:true,
            				lockMovementY:true,
            				lockScalingX:true,
            				lockScalingY:true,
            				lockRotation:true,
            				hasControls:false,
            				borderColor:'red',
            				hasRotationPoint:false,
            				editable:false,
            				cursorWidth:0,
            			});
            			
            			// console.log("HERE", object);
            		});
            		setTimeout(function(){
            			objs = proFabric.canvas.getObjects();
            			for(i = 0; i< msg.objects.length;i++)
            			{
            				objs[i].setHeight(_height[i]);
            				canvas.renderAll();
            			}
            		},5000);
            		
            		// setTimeout(function(){
            			$('#ajax_loader').hide();
            			$(this).closest('.accordion-body').removeClass('in');
            			$('.three .accordion-body ').addClass('in');
            		// },1000);
$.ajax({
	url: site_url+'/editor/get_flyer_colorsets',
	type: 'POST',
	dataType: 'json',
	async: false,
	data: {flyerId: iadm},
	success: function(colorsets){
		old_html =  $('#colorStyleOpt').html();
		$('#colorStyleOpt').html('<div class="row" style="margin: 0px;padding: 0px;">'
			+'<div style="font-size: 16px;margin: 0px;padding: 0px;font-weight: bold;margin-top: 15px;">Flyer Themes:</div>'
			+'<hr style="width: 100%;margin: 0px;padding: 0px; margin-bottom: 10px;"></div>');
		total_colorsets = colorsets.length;
		
		$.each(colorsets, function(index, colorset) {
			$('#colorStyleOpt').append(
				'<div class="row color-pallet-row colorRow" id="'+colorset.id+'">'
				+'<div class="col-md-9 col-xs-8" style="margin: 0px;padding: 0px;"></div>'
				+'<div class="col-md-3 col-xs-4" style="margin:0px;padding:0px;">'
				+'<label class="textalign1" for="'+colorset.name+'">'
				+colorset.name+'</label></div></div>'
				);
			
			$.each(colorset.colors, function(index,color) {
				$('#colorStyleOpt #'+colorset.id+' .col-md-9').append(
					'<div class="col-md-2  col-xs-2" style="border: 0px;padding: 0px;margin-top:3px">'
					+'<div id="C11" class="square1" data-id="'+color.objID+'" style="background-color: '+color.clr+';"></div>'
					+'</div>');
			});

		});


	},
            		// beforeSend: function(msg){console.log(msg);},
            		error: function(error){console.log(error);},
            	});
$.ajax({
	url: site_url+'/editor/get_flyer_properties/'+iadm,
	type: 'POST',
	dataType: 'json',
	async: false,
	success: function(properties){
		$('.txtbuttonContainer').css('display','initial');
		$(properties).each(function(index, el) {
			if(el.property_id !== '')
			{
				_dataType = el.property_type;
				_dataId = el.property_id;
				_label = el.property_label;
				html = '<div class="col-md-6 col-sm-6 col-xm-12"><button class="editor-textAssign btn btn-default txtBtn fullwidth  mg-5" data-type="'+_dataType+'" id="'+	_dataId+'" data-id="'+	_dataId+'">'+_label+'</button></div>';
				$('.text-btns').append(html);
			}
		});	
	},
            		// beforeSend: function(msg){console.log(msg);},
            		error: function(error){console.log('------ PROEPERTIES ERROR:  '+error);},
            	});
}
},
error: function(msg){
	$('#ajax_loader').hide();
	swal("Oops...", "Flyer could not be loaded!", "error");
},
});
}else{
	swal("Oops...", "Choose a template to proceed!", "error");
}
});

$(document).delegate('#save_flyer_design','click',function(e){
	e.preventDefault()
        // proFabric.createPNGImage();
        $('#ajax_loader').show();
        var property = [];
        var jsonData = {};
        var deleteImg = new Array();
        proFabric.canvas.forEachObject(function(obj){
        	
        	if(obj.class == 'text')
        	{   
        		_id = obj.id;
        		_label = $('#'+_id).attr('data-type');
        		jsonData[_label] = obj.text;
        		property.push(jsonData);
        	}
        	if(obj.class == 'image')
        	{
        		if(obj.name)
        		{
        			for(i = 0 ; i<imgListLength; i++)
        			{
        				filename = imgList[i] 
        				if(obj.name == filename)
        				{
        					console.log('image found on canvas',filename);
                	        // imgList.splice(i, 1);
                	        for(j=i;j<imgListLength;j++)
                	        {
                	        	imgList[j]=imgList[j+1];
                	        }
                	        imgListLength--;
                	    }
                	    else
                	    {
                	    	console.log('image not fount on canvas',filename);
                	    	deleteImg.push(filename);
                	    }
                	}
                }
                
            }
        })
        // deleteImg.forEach(function(index, arr)
        // {
        	for(i = 0 ; i<deleteImg.length; i++)
        	{
        		filename = deleteImg[i];
        		$.ajax({
        			url: 'https://xyzflyers.com/editor/delete_file',
        			data: {filename},
        			type: 'POST',
        			async: true,
        			error: function (res)
        			{
        				bootbox.dialog({'message':'Error deleting the image', 'backdrop': true});
        			},
        			success: function (res)
        			{
        				console.log('Image Deleted',res);
        			},
        		});
        	} 
        // });
proFabric.canvas.deactivateAll().renderAll();
var new_json = JSON.stringify(proFabric.canvas.toDatalessJSON());
var img = proFabric.canvas.toDataURLWithMultiplier('jpeg', 4);
if(new_json!="" && img!=""){
	$.ajax({
		url: "<?php echo base_url(); ?>editor/save_editor_flyer",
		type : 'POST',
		data: {"save_editor":1,"img_file":img,"json_file":new_json, "text_properties":JSON.stringify(property)},
		dataType: 'json',
		success:function(result){
			if(result['message']=='Success'){
				$("#msg_editor").html('<div class="alert alert-success">Successfully Saved Flyer.</div>');
				setTimeout(function(){
					$('#ajax_loader').hide();
					window.location.href = "<?php echo base_url(); ?>editor";
				},3000);
			}else{
        				// setTimeout(function(){
        					$('#ajax_loader').hide();
        					swal('Error Occured', result['message'], 'error');
        				// }, 1000);

}
}
});
}else{
	swal("Oops...", "Cannot save image. Please try again later! ", "error");
	$('#ajax_loader').hide();
}
});
//cancel desiging flyer
$('#editor_cancel').on('click', function(event) {
	swal({
		title: "Are you sure?", 
		text: "Are you sure you want to go back?", 
		type: "warning",
		showCancelButton: true,
		closeOnConfirm: true,
		confirmButtonText: "Yes!",
		confirmButtonColor: "#ec6c62"
	}, function() {
		$('#ajax_loader').show();
		$.ajax({
			url: "<?php echo base_url(); ?>editor/cancel_flyer_editor",
			type : 'POST',
			data: {"cancel_editor":1},
			async: false,
			dataType: 'json',
			success:function(result){
				if(result['message']=='Success'){
					// $("#msg_editor").html('<div class="alert alert-success">Successfully Cancelled.</div>');
					// setTimeout(function(){
						$('#ajax_loader').hide();
						window.location.href = "<?php echo base_url(); ?>editor";
					// },3000);
	}else if(result=='Error'){
		swal('Oops','Something went wrong. Please try again later.', 'error');
					// setTimeout(function(){
						$('#ajax_loader').hide();
					// }, 1000);

	}
}
});
	});
});

function clear_tags()
{
	$('.box-checkbox').removeClass('checked');
	$('.flyer_tags').removeAttr('checked');
	$('#tags_number').text(0);
}


    //***************************************************

    (function($) {
    	"use strict";
    	var aaColor = [
    	['#000000', '#424242', '#636363', '#9C9C94', '#CEC6CE', '#EFEFEF', '#F7F7F7', '#FFFFFF'],
    	['#FF0000', '#FF9C00', '#FFFF00', '#00FF00', '#00FFFF', '#0000FF', '#9C00FF', '#FF00FF'],
    	['#F7C6CE', '#FFE7CE', '#FFEFC6', '#D6EFD6', '#CEDEE7', '#CEE7F7', '#D6D6E7', '#E7D6DE'],
    	['#E79C9C', '#FFC69C', '#FFE79C', '#B5D6A5', '#A5C6CE', '#9CC6EF', '#B5A5D6', '#D6A5BD'],
    	['#E76363', '#F7AD6B', '#FFD663', '#94BD7B', '#73A5AD', '#6BADDE', '#8C7BC6', '#C67BA5'],
    	['#CE0000', '#E79439', '#EFC631', '#6BA54A', '#4A7B8C', '#3984C6', '#634AA5', '#A54A7B'],
    	['#9C0000', '#B56308', '#BD9400', '#397B21', '#104A5A', '#085294', '#311873', '#731842'],
    	['#630000', '#7B3900', '#846300', '#295218', '#083139', '#003163', '#21104A', '#4A1031']
    	];

    	var createPaletteElement = function(element, _aaColor) {
    		element.addClass('bootstrap-colorpalette');
    		var aHTML = [];
    		$.each(_aaColor, function(i, aColor){
    			aHTML.push('<center><div>');
    			$.each(aColor, function(i, sColor) {
    				var sButton = ['<button type="button" class="btn-color" style="background-color:', sColor,
    				'" data-value="', sColor,
    				'" title="', sColor,
    				'"></button>'].join('');
    				aHTML.push(sButton);
    			});
    			aHTML.push('</div></center>');
    		});
    		element.html(aHTML.join(''));
    	};

    	var attachEvent = function(palette) {
    		palette.element.on('click', function(e) {
    			var welTarget = $(e.target),
    			welBtn = welTarget.closest('.btn-color');

    			if (!welBtn[0]) { return; }

    			var value = welBtn.attr('data-value');
    			palette.value = value;
    			palette.element.trigger({
    				type: 'selectColor',
    				color: value,
    				element: palette.element
    			});
    		});
    	};

    	var Palette = function(element, options) {
    		this.element = element;
    		createPaletteElement(element, options && options.colors || aaColor);
    		attachEvent(this);
    	};

    	$.fn.extend({
    		colorPalette : function(options) {
    			this.each(function () {
    				var $this = $(this),
    				data = $this.data('colorpalette');
    				if (!data) {
    					$this.data('colorpalette', new Palette($this, options));
    				}
    			});
    			return this;
    		}
    	});
    })(jQuery);
//************************************************************************************


var options = {
	colors:[['#003366', '#336699', '#3366cc', '#003399', '#000099', '#0000cc', '#000066'],
	['#006666', '#006699', '#0099cc', '#0066cc', '#0033cc', '#0000ff', '#3333ff', '#333399'],
	['#669999', '#009999', '#33cccc', '#00ccff', '#0099ff', '#0066ff', '#3366ff', '#3333cc', '#666699'],
	['#339966', '#00cc99', '#00ffcc', '#00ffff', '#33ccff', '#3399ff', '#6699ff', '#6666ff', '#6600ff', '#6600cc'],
	['#339933', '#00cc66', '#00ff99', '#66ffcc', '#66ffff', '#66ccff', '#99ccff', '#9999ff', '#9966ff', '#9933ff', '#9900ff'],
	['#006600', '#00cc00', '#00ff00', '#66ff99', '#99ffcc', '#ccffff', '#ccccff', '#cc99ff', '#cc66ff', '#cc33ff', '#cc00ff', '#9900cc'],
	['#003300', '#009933', '#33cc33', '#66ff66', '#99ff99', '#ccffcc', '#ffffff', '#ffccff', '#ff99ff', '#ff66ff', '#ff00ff', '#cc00cc', '#660066'],
	['#333300', '#009900', '#66ff33', '#99ff66', '#ccff99', '#ffffcc', '#ffcccc', '#ff99cc', '#ff66cc', '#ff33cc', '#cc0099', '#993399'],
	['#336600', '#669900', '#99ff33', '#ccff66', '#ffff99', '#ffcc99', '#ff9999', '#ff6699', '#ff3399', '#cc3399', '#990099'],
	['#666633', '#99cc00', '#ccff33', '#ffff66', '#ffcc66', '#ff9966', '#ff6666', '#ff0066', '#d60094', '#993366'],
	['#a58800', '#cccc00', '#ffff00', '#ffcc00', '#ff9933', '#ff6600', '#ff0033', '#cc0066', '#660033'],
	['#996633', '#cc9900', '#ff9900', '#cc6600', '#ff3300', '#ff0000', '#cc0000', '#990033'],
	['#663300', '#996600', '#cc3300', '#993300', '#990000', '#800000', '#993333']
	]
}
$('#colorpalette1').colorPalette(options)
.on('selectColor', function(e) {
	$('#font_color').css('background-color',e.color);
	$('.selected_clr span').html(e.color);
	$('.selected_clr .btn').css('background-color',e.color);
});
$('.bootstrap-colorpalette .btn-color').click(function(){
	clr = $(this).attr('data-value');
	$('#font_color').css('background-color',clr);
	$('.selected_clr span').html(clr);
	$('.selected_clr .btn').css('background-color',clr);
});
$('.bootstrap-colorpalette .btn-color').mouseover(function(){
	clr = $(this).attr('data-value');
	$('.hover_clr span').html(clr);
	$('.hover_clr .btn').css('background-color',clr);
});


</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>