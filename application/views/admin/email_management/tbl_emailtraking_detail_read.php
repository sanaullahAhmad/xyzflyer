<div id="page-wrapper" >
	<div class="page-content">
		<section>
			<?	echo $this->breadcrumbs->show(); ?>
		</section>
		<div class="row" style="margin-bottom: 10px">
			<div class="col-md-4">
				<h2 style="margin-top:0px">Email Tracking List</h2>
			</div>
			<div class="col-md-4 text-center">
				<div style="margin-top: 4px"  id="message">
					<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
				</div>
			</div>
			<div class="col-md-4 text-right">
				<?php //if(xyzAccesscontrol('flyer_shapes','Add')==TRUE){ echo anchor(site_url('admin_svgs/create'), 'Create', 'class="btn btn-primary"'); }?>
				<?php //if(xyzAccesscontrol('flyer_shapes','Excel')==TRUE){ echo anchor(site_url('admin_svgs/excel'), 'Excel', 'class="btn btn-primary"'); }?>
				<?php //if(xyzAccesscontrol('flyer_shapes','Word')==TRUE){ echo anchor(site_url('admin_svgs/word'), 'Word', 'class="btn btn-primary"'); }?>
			</div>
		</div>
		<div class="row" style="margin-bottom: 10px;">
			<div class="col-md-6">
				<form action="<?php echo site_url('admin/managereports/email_track_read/'.$this->uri->segment(4)); ?>" class="form-inline" method="get">
					<div class="form-group">
						<label for="sel1">Records:</label>
						<select  class="form-control" id="records" name="records">
							<option value='10' <?php if(isset($records)){ if ($records == "10"){ echo "selected"; } }?>>10</option>
							<option value='25' <?php if(isset($records)){  if ($records == "25"){ echo "selected"; } }?> >25</option>
							<option value='50' <?php if(isset($records)){  if ($records == "50"){ echo "selected"; } }?> >50</option>
							<option value='100' <?php if(isset($records)){  if ($records == "100"){ echo "selected"; } }?> >100</option>
						</select>
					</div>
					<div class="form-group">
						<?php
						if(isset($records)){
							if ($records == 10 || $records == 25 || $records == 50 || $records == 100)
							{
								?>
								<a href="<?php echo site_url('admin/managereports/email_track_read/'.$this->uri->segment(4)); ?>" class="btn btn-default" style="height:33px;">Reset</a>
								<?php
							}
						}
						?>

						<button id="recordsbtn" class="btn btn-primary" type="submit" style="height:33px; display: none;">Records</button>
					</div>
				</form>
			</div>
		</div>


		<table class="table table-bordered" style="margin-bottom: 10px; ">
			<?php
			$display = 0;
			if(isset($users_orders_data)){
				if(count($users_orders_data)>0){
					//echo "<pre>"; print_r($users_orders_data) ;exit;
					foreach ($users_orders_data as $users_orders){
						?>
						<tr>
							<th>Sr.#</th>
							<th>Order No.</th>
							<th>IP</th>
							<th>Dated</th>
							<th>Headers</th>
						</tr>

						<tr>
							<td width="50px"><?php echo ++$start ?></td>
							<td><?php echo $users_orders->order_id; ?><br>

							</td>
							 <td><?php echo $users_orders->ip; ?></td>

							<td>
								<?php $date = date_create($users_orders->datetime); echo date_format($date, 'm/d/Y'); //echo ' '.date_format($date, 'Hi').'hrs'; ?>
							</td>
							<td><?php echo $users_orders->headers; ?></td>

						</tr>
						<?php
					}
				}else{ ?>
					<tr>
						<td>
							<br>
							<h4>You don't have any orders yet, continue here to <a href="<?=site_url('order')?>">Create Your First Order</a></h4>
						</td>
					</tr>
				<?php }
			}
			?>
		</table>
		<div class="row">
			<div class="col-md-6">
				<a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
			</div>
			<div class="col-md-6 text-right">
				<?php echo $pagination ?>
			</div>
		</div>
	</div>
	<script>
		$('#records').on('change', function(e){
			e.preventDefault();
			$('#recordsbtn').trigger('click');

		});
	</script>