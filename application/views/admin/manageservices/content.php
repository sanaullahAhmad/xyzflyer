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
                <h2>Admin Services</h2>   
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
                        <a  href="<?php echo base_url() . 'admin/manageservices/savePage'; ?>" class="btn btn-primary">Add Service</a>
                    </div>
                    <?php if(isset($sucess) &&  $sucess!=''){ ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $sucess; ?>
                        </div>
                        <?php } ?>
                    <div class="panel-body" id="page_option">
                        <div class="table-responsive">
                            <?php    if (!empty($pages)) { ?>
                            <table class="table table-striped table-bordered table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>Service Title</th>
                                        <th>Service Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pages as $cat) { ?>
                                        <tr>
                                            <td> <?php echo $cat['services_title']; ?> </td>
                                            <td> <?php echo $cat['services_creation_date_time'] ?></td>
                                            <td>
                                              <a href="<?php echo base_url('admin/manageservices/savePage/'.$cat['pk_services_id']); ?>"> Edit </a>
                                              <a onclick="return confirm('Are you sure you want to delete this record?');" href="<?php echo base_url('admin/manageservices/delete/'.$cat["pk_services_id"]);  ?>">Delete </a>
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