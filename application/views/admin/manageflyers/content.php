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
                <h2>Admin Flyers</h2>   
            </div>
        </div>              
        <!-- /. ROW  -->
        <hr />  
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a  href="<?php echo base_url().'admin/manageflyers/save'; ?>" class="btn btn-primary">Add Flyers</a>
                    </div>
                    <?php if(isset($sucess) &&  $sucess!=''){ ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $sucess; ?>
                        </div>
                        <?php } ?>
                    <div class="panel-body" id="page_option">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>Flyers Title</th>
                                        <th>Flyers Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                        <tr>
                                            <td></td>
                                            <td> </td>
                                            <td></td>
                                        </tr>
                                        
                                </tbody>
                            </table>
                            
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>