<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Shapes List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
        <?php if(xyzAccesscontrol('flyer_shapes','Add')==TRUE){ echo anchor(site_url('admin_svgs/create'), 'Create', 'class="btn btn-primary"'); }?>
		<?php if(xyzAccesscontrol('flyer_shapes','Excel')==TRUE){ echo anchor(site_url('admin_svgs/excel'), 'Excel', 'class="btn btn-primary"'); }?>
		<?php if(xyzAccesscontrol('flyer_shapes','Word')==TRUE){ echo anchor(site_url('admin_svgs/word'), 'Word', 'class="btn btn-primary"'); }?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">Sr.#</th>
		    <th>Title</th>
            <?php 
            if(xyzAccesscontrol('flyer_shapes','Read')==TRUE){ ?>
		    <th>File Url</th>
            <?php } ?>
		    <th>Created Date</th>
		   
		    <th>Created By</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($admin_svgs_data as $admin_svgs)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $admin_svgs->svgTitle ?></td>
            <?php 
            if(xyzAccesscontrol('flyer_shapes','Read')==TRUE){ ?>
		    <td><a target="_blank" href="<?php echo base_url('uploads/svgs/'.$admin_svgs->svgFileUrl); ?>">See Uploaded File</a></td>
            <?php } ?>
		    <td><?php $date = date_create($admin_svgs->createdDate); echo date_format($date, 'm-d-Y'); ?></td>
		   
		    <td><?php echo (format($admin_svgs->adminId, 'admin_name')!=""?format($admin_svgs->adminId, 'admin_name'):$admin_svgs->adminId); ?></td>
		    <td style="text-align:center" width="200px">
			<?php 
            if(xyzAccesscontrol('flyer_shapes','Read')==TRUE){
				echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('admin_svgs/read/'.$admin_svgs->svgId).'" data-toggle="tooltip" title="View"><i class="fa fa-bars"></i></a>';
			
             }
            if(xyzAccesscontrol('flyer_shapes','Edit')==TRUE){
			
			echo '<a style="margin:2px;" class="btn btn-warning" href="'.site_url('admin_svgs/update/'.$admin_svgs->svgId).'" data-toggle="tooltip" title="update" ><i class="fa fa-pencil"></i></a>'; 
            }
            if(xyzAccesscontrol('flyer_shapes','Delete')==TRUE){
			
			echo '<a style="margin:2px;" class="btn btn-danger" href="'.site_url('admin_svgs/delete/'.$admin_svgs->svgId).'" onclick="javasciprt: return confirm(\'Are You Sure ?\')" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>';
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