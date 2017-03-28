<div id="page-wrapper" >
    <div class="page-content">
<!--         <div class="row">
            <div class="col-md-12"> -->
    <section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row" style="margin-bottom: 10px">

            <div class="col-md-4">

                <h2 style="margin-top:0px"><?php echo $title; ?></h2>

            </div>
			<div class="col-md-4 text-center">
			<?php if($this->session->userdata('message')){ ?>
            
                <div style="margin-top: 4px"  id="message" class="alert-success">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
           
			<?php } ?>
			 </div>
            <div class="col-md-4 text-right">
                    <!-- <?php 
                        /*echo $this->session->userdata('message')*/
                    ?> -->
                    <div>
                        <?php   if(isset($_SERVER['HTTP_REFERER'])) {
								    echo anchor($_SERVER["HTTP_REFERER"].'/', 'Go Back', 'class="btn btn-primary pull-right" style="margin-left: 2px;margin-bottom: 5px;"');    
							    }
                        ?>
                    </div>
                <?php echo anchor(site_url('admins/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                <?php echo anchor(site_url('admins/word'), 'Word', 'class="btn btn-primary"'); ?>
        </div>
		 
		
        </div>
		 <div class="row" style="margin-bottom: 10px">
		<div class="col-md-4 text-left">

			<input type="button" id="save_value" class="btn btn-primary" name="save_value" value="Delete Selected Records" />

            </div>
			  </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>All<input name="select_all" id="select_all" type="checkbox"> </span></th>
                    <th width="80px">Sr. #</th>
        		    <th>Full name</th>
					 <th>Username</th>
        		    <th>Email</th>
        		    <th>Created Date</th>
        		    <th>Type</th>
        		    <th>Status</th>
        		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
                $start = 0;
                foreach ($admins_data as $admins)
                {
            ?>
                    <tr>
					
                        <td style="text-align: center;"><input class="checkbox" type="checkbox" name="checkbox[]" value="<?php echo $admins->admin_id;?>" style="margin-left: 25px;"></td> 
					
            		    <td><?php echo ++$start ?></td>
						  <td><?php echo $admins->admin_firstname ." ".$admins->admin_lastname ?></td>
            		    <td><?php echo $admins->admin_username ?></td>
            		    <td><?php echo $admins->admin_email ?></td>
            		    <td style="width: 130px"><small><?php $date = date_create($admins->admin_date); echo date_format($date, 'm-d-Y'); ?></small></td>
            		    <td style="width: 130px"><small> 
                        <?php 
                            if($admins->admin_type==0)
                                echo '<a href="'.site_url().'admins/list_all/00">Super Admin</a>';
                            elseif($admins->admin_type==1)
                                echo '<a href="'.site_url().'admins/list_all/1">Templates Designer</a>';
                            elseif($admins->admin_type==2) 
                                echo '<a href="'.site_url().'admins/list_all/2">Accounts Manager</a>';
                            elseif($admins->admin_type==3)
                                echo '<a href="'.site_url().'admins/list_all/3">Sales Manager</a>';
                            else echo "Undefined" ?></small></td>
            		    <td>
                            <small>
                                <?php if($admins->admin_status==0) echo 'InActive'; else echo 'Active'; ?>
                            </small>
                        </td>
            		    <td style="text-align:center" width="200px">
                			<?php
                            if(xyzAccesscontrol('admin_managment','Read')==TRUE) {
                                echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('admins/read/'.$admins->admin_id).' " data-toggle="tooltip" title="View"><i class="fa fa-bars"></i></a>';
                            }
                            if(xyzAccesscontrol('admin_managment','Edit')==TRUE) {
                                echo '<a style="margin:2px;" class="btn btn-warning" href="'.site_url('admins/update/'.$admins->admin_id).' " data-toggle="tooltip" title="update" ><i class="fa fa-pencil"></i></a>';
                            }
                            if(xyzAccesscontrol('admin_managment','Delete')==TRUE){
                                echo '<a style="margin:2px;" class="btn btn-danger" href="'.site_url('admins/delete/'.$admins->admin_id).' " onclick="javasciprt: return confirm(\'Are You Sure ?\')" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>';
                            }
                            ?>
            		    </td>
            	    </tr>
                    <?php
                }
            ?>
            </tbody>
        </table>
</div>
<script>
    $('#select_all').click(function(event) {
      if(this.checked) {
          // Iterate each checkbox
          $(':checkbox').each(function() {
              this.checked = true;
          });
      }
      else {
        $(':checkbox').each(function() {
              this.checked = false;
          });
      }
    });
	
$('#save_value').click(function() {
    var sel = $('.checkbox:checked').map(function(_, el) {
        return $(el).val();
    }).get();

	function isEmpty(str) {
			return (!str || 0 === str.length);
		}
	if(isEmpty(sel)){
				alert("Please select users to delete");		
	}else{
		$.ajax({
				url : "<?php echo base_url()."admins/delete_all";?>",
				type: "POST",
				data : {
					del_data:sel
				},
				success: function(data)
				{
				   location.reload();
				}
			});

	}
	
	
})

   

</script>