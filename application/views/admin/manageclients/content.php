<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/frontend/css/datatables.min.css" />
<script type="text/javascript" language="javascript" class="init">


    $(document).ready(function () {
           var oTable = $('#example').dataTable();
           oTable.fnSort( [ [5,'desc'] ] );
    });
</script>
<div id="page-wrapper" >
    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <h2>Admin Clients</h2>   
                <h5>Welcome <?php if ($this->session->userdata('admin_data') != "") {
                            echo $this->session->userdata['admin_data']['username'];
                        } ?> , Love to see you back. </h5>
            </div>
        </div>              
        <!-- /. ROW  -->
        <hr />  
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a  href="<?php echo base_url() . 'admin/manageclients/saveclient'; ?>" class="btn btn-primary">Add Client</a>
                    </div>
                    <?php if(isset($Parent_error) &&  $Parent_error!=''){ ?>
                        <div class="alert alert-danger" role="alert">
                            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                            <span class="sr-only">Error:</span>
                                <?php echo $Parent_error; ?>
                        </div>
                        <?php } ?>
                    <?php if(isset($sucess) &&  $sucess!=''){ ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $sucess; ?>
                        </div>
                        <?php } ?>
                    <div class="panel-body" id="page_option">
                        <div class="table-responsive">
                            <?php    if (!empty($clients)) { ?>
                            <table class="table table-striped table-bordered table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Client Image</th>
                                        <th>Client Status</th>
                                        <th>Client Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($clients as $cat) { ?>
                                        <tr>
                                            <td> <?php echo $cat['client_name']; ?> </td>
                                            <td> <?php  if($cat['client_logo']!=''){ ?> <img width="110" height="40" src="<?php echo base_url().'public/upload/client_images/'.$cat['client_logo']; ?>"/> <?php }else{ echo 'No Logo';}?> </td>
                                             <?php if($cat['client_status']==1){ ?>
                                                <td class="hidden-phone" align="center">
                                                  <div style="margin-left:17px;" class="label label label-success">
                                                   <a  href="<?php echo base_url('admin/manageclients/status/'.$cat["pk_client_id"].'/0');  ?>">Enable</a>
                                                  </div>
                                                </td>
                                        <?php }else{ ?>
                                          <td class="hidden-phone" align="center">
                                            <div style="margin-left:17px;" class="label label label-danger">
                                             <a href="<?php echo base_url('admin/manageclients/status/'.$cat["pk_client_id"].'/1');  ?>">Disable</a>
                                            </div>
                                          </td>
                              		<?php }?>
                                          <td> <?php $time = strtotime($cat['client_creation_date_time']);echo date('Y-M-d',$time); ?></td>
                                            <td>
                                              <a href="<?php echo base_url('admin/manageclients/saveclient/'.$cat['pk_client_id']); ?>"> Edit </a>
                                              ||
                                              <a onclick="return confirm('Are you sure you want to delete this record?');" href="<?php echo base_url('admin/manageclients/delete/'.$cat["pk_client_id"]);  ?>">Delete </a>
                                          
                                           </td>
                                        </tr>
                                        <?php
                                    }
                                
                                ?>
                                </tbody>
                            </table>
                            <?php } ?>   
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>