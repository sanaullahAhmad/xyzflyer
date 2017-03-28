<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px">Fonts List</h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <?php echo anchor(site_url('admin_fonts/create'), 'Create', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('admin_fonts/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('admin_fonts/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">Sr.#</th>
		    <th>FontTitle</th>
		    <th>FontUrl</th>
		    <th>CreatedDate</th>
		   
		    <th>AdminId</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
            $start = 0;
            foreach ($admin_fonts_data as $admin_fonts)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $admin_fonts->fontTitle ?></td>
		    <td><?php echo $admin_fonts->fontUrl ?></td>
		    <td><?php $date = date_create($admin_fonts->createdDate); echo date_format($date, 'm-d-Y'); ?></td>
		    <td><?php echo (format($admin_fonts->adminId, 'admin_name')!=""?format($admin_fonts->adminId, 'admin_name'):$admin_fonts->adminId); ?></td>
		    <td style="text-align:center" width="200px">
			<?php
            if(xyzAccesscontrol('flyer_fonts','Read')==TRUE) {
			echo '<a style="margin:2px;" class="btn btn-primary" href="'.site_url('admin_fonts/read/'.$admin_fonts->fontId).'" data-toggle="tooltip" title="View"><i class="fa fa-bars"></i></a>';
            }
            if(xyzAccesscontrol('flyer_fonts','Edit')==TRUE){
            echo '<a style="margin:2px;" class="btn btn-warning" href="'.site_url('admin_fonts/update/'.$admin_fonts->fontId).'" data-toggle="tooltip" title="update" ><i class="fa fa-pencil"></i></a>';
            }
            if(xyzAccesscontrol('flyer_fonts','Delete')==TRUE) {
                echo '<a style="margin:2px;" class="btn btn-danger" href="' . site_url('admin_fonts/delete/' . $admin_fonts->fontId) . '" onclick="javasciprt: return confirm(\'Are You Sure ?\')" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i></a>';
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