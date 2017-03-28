<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
        <div class="row">
            <div class="col-md-5">
                <h2 style="margin-top:0px">Shapes <?php echo $button ?></h2>
                <form action="<?php echo $action; ?>" method="post"  enctype="multipart/form-data">
                   <div class="form-group">
                    <label for="varchar">Title <?php echo form_error('svgTitle') ?></label>
                    <input type="text" class="form-control" name="svgTitle" id="svgTitle" placeholder="Title" value="<?php echo $svgTitle; ?>" />
                </div>
                <div class="form-group">
                    <label for="varchar">Svg File Url <?php echo form_error('svgFileUrl') ?></label>
                    <input type="file" class="form btn btn-primary" name="svgFileUrl" id="svgFileUrl" placeholder="File" value="<?php echo $svgFileUrl;?>" />
                </div>
                    <input type="hidden" class="form-control" name="createdDate" id="createdDate" placeholder="CreatedDate" value="<?php if(!$createdDate) echo date("Y-m-d H:i:s"); else echo $createdDate; ?>" />
                    <?php if($this->uri->segment(2)=='update'){?>
                    <input type="hidden" class="form-control" name="modifiedDate" id="modifiedDate" placeholder="ModifiedDate" value="<?php if(!$modifiedDate) echo date("Y-m-d H:i:s"); else echo $modifiedDate; ?>" />
                    <?php } ?>
                    <input type="hidden" class="form-control" name="adminId" id="adminId" placeholder="AdminId" value="<?php if(!$adminId) {$d = $this->session->userdata('admin_data'); echo $d['pk_admin_id']; }else echo $adminId; ?>" />
                    <input type="hidden" name="svgId" value="<?php echo $svgId; ?>" /> 
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                    <a href="<?php echo site_url('admin_svgs') ?>" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>