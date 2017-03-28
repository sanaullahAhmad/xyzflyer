<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <h2 style="margin-top:0px">Coupons List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <div class="col-md-12">
               

                    <form action="<?php echo site_url('admin_coupons/index'); ?>" class="form-inline" method="get">
                        <div class="form-group">
                              <label for="sel1">Records: </label>
                              <select  class="form-control" id="sel1" name="records">
                                <option value='10' <?php if(isset($records)){ if ($records == 10){ echo "selected"; } }?>>10</option>
                                <option value='25' <?php if(isset($records)){  if ($records == 25){ echo "selected"; } }?> >25</option>
                                <option value='50' <?php if(isset($records)){  if ($records == 50){ echo "selected"; } }?> >50</option>
                                <option value='100' <?php if(isset($records)){  if ($records == 100){ echo "selected"; } }?> >100</option>
                              </select>
                        </div>
                        <div class="form-group">
                                <?php       
                                    if(isset($records)){ 
                                    if ($records == 10 || $records == 25 || $records == 50 || $records == 100)
                                    {
                                        ?>
                                        <a href="<?php echo site_url('admin_coupons'); ?>" class="btn btn-default" style="height:33px;">Reset</a>
                                        <?php
                                    }
                                    }
                                ?>
                           
                            <button id="records" class="btn btn-primary" type="submit" style="display: none;">Records</button>
                            &nbsp;&nbsp;
                            <?php 
                                if(xyzAccesscontrol('coupen_managment','Add')==TRUE){
                                echo anchor(site_url('admin_coupons/create'),'Create', 'class="btn btn-primary"'); 
                                }
                            ?>
                        </div>
                    </form>
                    
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('admin_coupons/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin_coupons'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                            <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">

            <tr>
                <th width="3%">No</th>
        		<th>Title</th>
        		<th>Value</th>
        		<th>Max Uses</th>
                <th>Total Used</th>
                <th>Code</th>
        		<th>Created</th>
        		<th width="10%">Action</th>
            </tr><?php
            foreach ($admin_coupons_data as $admin_coupons)

            {
                ?>
                <tr <?php 
				$now = date('m-d-Y');
				$date = date_create($admin_coupons->coupon_date); $date1 = date_format($date, 'm-d-Y');
				
					if($date1 > $now){
						echo "style='background-color:#FF91A1;'";
					}elseif ($admin_coupons->coupon_status == 1 && $admin_coupons->coupon_maximum_uses > $admin_coupons->total) {
                        echo "style='background-color:#dff0d8;'";
                    }else if($admin_coupons->coupon_status == 0 && $admin_coupons->coupon_maximum_uses > $admin_coupons->total){
                        echo "style=''";
                    }else{
                        echo "style='background-color:#FF91A1;'";
                    }
                ?>>
        			<td width="80px">
                        <?php echo ++$start ?>    
                    </td>
        			<td>
                        <?php echo $admin_coupons->coupon_title ?>
                        <table class="table table-bordered" style="margin-bottom: 10px;">
                            <tr>
                                <th>Start</th>
                                <th>End</th>
                            </tr>
                            <tr>
                                <td>
                                    <?php $date = date_create($admin_coupons->coupon_start_date); echo date_format($date, 'm-d-Y');?>   
                                </td>
                                <td>
                                    <?php $date = date_create($admin_coupons->coupone_end_date); echo date_format($date, 'm-d-Y'); ?>   
                                </td>
                            </tr>
                        </table>  
                    </td>                    
        			<td>
                        <?php 
                            if ($admin_coupons->coupon_type=='0') {
                                echo "-". $admin_coupons->coupon_value. "%" ;
                            }
                            elseif ($admin_coupons->coupon_type=='1') {
                                echo  "-$" .$admin_coupons->coupon_value;
                            }elseif ($admin_coupons->coupon_type=='2') {
                                echo  "-$" .$admin_coupons->coupon_value . " (Override)";
                            }elseif($admin_coupons->coupon_type=='3') {
                                echo  "Undefined!";
                            }
                        ?>
                            
                    </td>
			<td><?php echo $admin_coupons->coupon_maximum_uses ?></td>
            <td><?php echo $admin_coupons->total; ?></td>
            <td><?php echo $admin_coupons->coupon_code ?></td>
			<td><?php $date = date_create($admin_coupons->coupon_date); echo date_format($date, 'm-d-Y'); ?></td>
			<td style="text-align:center" width="200px">
				<?php
                 if(xyzAccesscontrol('coupen_managment','Read')==TRUE){
				echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('admin_coupons/read/'.$admin_coupons->coupon_id).'" data-toggle="tooltip" title="View"><i class="fa fa-bars"></i></a>';
                 }

			     if(xyzAccesscontrol('coupen_managment','Edit')==TRUE){
				echo '<a style="margin:2px;" class="btn btn-warning" href="'.site_url('admin_coupons/update/'.$admin_coupons->coupon_id).'" data-toggle="tooltip" title="update" ><i class="fa fa-pencil"></i></a>';
                 } if(xyzAccesscontrol('coupen_managment','Delete')==TRUE){
			
				echo '<a style="margin:2px;" class="btn btn-danger" href="'.site_url('admin_coupons/delete/'.$admin_coupons->coupon_id).'" onclick="javasciprt: return confirm(\'Are You Sure ?\')" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>';
                    }
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php if(xyzAccesscontrol('coupen_managment','Excel')==TRUE){
            echo anchor(site_url('admin_coupons/excel'), 'Excel', 'class="btn btn-primary"'); 
            }?>
		<?php if(xyzAccesscontrol('coupen_managment','Word')==TRUE){
            echo anchor(site_url('admin_coupons/word'), 'Word', 'class="btn btn-primary"');
            } ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
</div>
<script>
    
    $('#sel1').on('change', function(e){
        e.preventDefault();
        $('#records').trigger('click');

    });
</script>