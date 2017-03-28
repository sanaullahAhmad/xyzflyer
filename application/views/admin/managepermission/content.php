
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
                <h2>Permission Management</h2>   
                <h5>Welcome <?php if ($this->session->userdata('admin_data') != "") {
                            echo $this->session->userdata['admin_data']['username'];
                        } ?> , Love to see you back. </h5>
            </div>
        </div>              
        <!-- /. ROW  -->
        <hr />  
        <div class="row">
            <div class="col-md-12">
            <?php echo  $this->session->flashdata('message'); ?>
                <!-- Advanced Tables -->
                    <?php if(isset($Users) && !empty($Users)){ foreach($Users as $key=> $user){?>
                     <div class="panel panel-default" style="width:95%;">
                     <div class="panel-heading" data-toggle="collapse" href="#user_<?php echo $key; ?>" style="cursor:pointer;">
                        <h3 align="center"><?php echo $user; ?></h3>
                     </div>
                     <div class="panel-body collapse" id="user_<?php echo $key; ?>">
                     <form name="perfrm" id="perfrm" method="post" action="<?php echo base_url(); ?>admin/managepermission/save">
                     <div class="table-responsive">
                     <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="alert-info">
                                <th>Permission Tabs<br/>&nbsp;<input type="hidden" name="utype" value="<?php echo $key; ?>"></th>
                                <th>Menu<br/><input type="checkbox" id="Full_<?php echo $key; ?>"></th>
                                <th>Read<br/><input type="checkbox" id="Read_<?php echo $key; ?>"></th>
                                <th>Add<br/><input type="checkbox" id="Add_<?php echo $key; ?>"></th>
                                <th>Edit<br/><input type="checkbox" id="Edit_<?php echo $key; ?>"></th>
                                <th>Delete<br/><input type="checkbox" id="Delete_<?php echo $key; ?>"></th>
                                <th>Excel<br/><input type="checkbox" id="Excel_<?php echo $key; ?>"></th>
                                <th>Word<br/><input type="checkbox" id="Word_<?php echo $key; ?>"></th>
                                <th>View Log<br/><input type="checkbox" id="ViewLog_<?php echo $key; ?>"></th>
                                <th>Reports<br/><input type="checkbox" id="Reports_<?php echo $key; ?>"></th>
                                <th>Status<br/><input type="checkbox" id="Status_<?php echo $key; ?>"></th>
                            </tr>
                        </thead>
                        <tbody>
                     <?php 
                     if(isset($perm_tab) && !empty($perm_tab)){
                        $tab="";
                        foreach($perm_tab as $loc => $tab){?>
                        <tr>
                    <td>
                        <?php echo $tab['tab_name']; ?><input type="hidden"  name="perm_tab[]" value="<?php echo $tab['tab_code']; ?>"></td>
                    <td>
                        <input class="Full_<?php echo $key; ?>" type="checkbox" name="<?php echo $tab['tab_code']; ?>[]" value="Full" <?php checkselected($tab['tab_code'],$key,'permFull');?>></td>
                    <td>
                        <input class="Read_<?php echo $key; ?>" type="checkbox" name="<?php echo $tab['tab_code']; ?>[]" value="Read" <?php checkselected($tab['tab_code'],$key,'permRead');?>></td>
                    <td>
                        <input class="Add_<?php echo $key; ?>" type="checkbox" name="<?php echo $tab['tab_code']; ?>[]"
                         value="Add" <?php checkselected($tab['tab_code'],$key,'permAdd');?>></td>
                    <td>
                        <input class="Edit_<?php echo $key; ?>" type="checkbox" name="<?php echo $tab['tab_code']; ?>[]" value="Edit" <?php checkselected($tab['tab_code'],$key,'permEdit');?>></td>
                    <td>
                        <input class="Delete_<?php echo $key; ?>" type="checkbox" name="<?php echo $tab['tab_code']; ?>[]" value="Delete" <?php checkselected($tab['tab_code'],$key,'permDelete');?>></td>
                    <td>
                        <input class="Excel_<?php echo $key; ?>" type="checkbox" name="<?php echo $tab['tab_code']; ?>[]" value="Excel" <?php checkselected($tab['tab_code'],$key,'permExcel');?>></td>
                    <td>
                        <input class="Word_<?php echo $key; ?>" type="checkbox" name="<?php echo $tab['tab_code']; ?>[]" value="Word" <?php checkselected($tab['tab_code'],$key,'permWord');?>></td>
                    <td>
                        <input class="ViewLog_<?php echo $key; ?>" type="checkbox" name="<?php echo $tab['tab_code']; ?>[]" value="ViewLog" <?php checkselected($tab['tab_code'],$key,'permViewLog');?>></td>
                    <td>
                        <input class="Reports_<?php echo $key; ?>" type="checkbox" name="<?php echo $tab['tab_code']; ?>[]" value="Reports" <?php checkselected($tab['tab_code'],$key,'permReports');?>></td>
                    <td>
                        <input class="Status_<?php echo $key; ?>" type="checkbox" name="<?php echo $tab['tab_code']; ?>[]" value="Status" <?php checkselected($tab['tab_code'],$key,'permStatus');?>></td></tr>
                       <?php }}?>
                        </tbody>
                       </table>
                       </div>
                       <button type="submit" name="save" class="btn btn-primary pull-right">Save</button>
                       </form>
                     </div>
                     </div>
                     <?php }} ?>
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        //Super Admin
        $('#Full_0').change(function(){
            this.checked ? isChecked('Full_0') : isnotChecked('Full_0');
        });
        $('#Read_0').change(function(){
            this.checked ? isChecked('Read_0') : isnotChecked('Read_0');
        });
        $('#Add_0').change(function(){
            this.checked ? isChecked('Add_0') : isnotChecked('Add_0');
        });
        $('#Edit_0').change(function(){
            this.checked ? isChecked('Edit_0') : isnotChecked('Edit_0');
        });
        $('#Delete_0').change(function(){
            this.checked ? isChecked('Delete_0') : isnotChecked('Delete_0');
        });
        $('#Word_0').change(function(){
            this.checked ? isChecked('Word_0') : isnotChecked('Word_0');
        });
        $('#Excel_0').change(function(){
            this.checked ? isChecked('Excel_0') : isnotChecked('Excel_0');
        });
        $('#ViewLog_0').change(function(){
            this.checked ? isChecked('ViewLog_0') : isnotChecked('ViewLog_0');
        });
        $('#Reports_0').change(function(){
            this.checked ? isChecked('Reports_0') : isnotChecked('Reports_0');
        });
        $('#Status_0').change(function(){
            this.checked ? isChecked('Status_0') : isnotChecked('Status_0');
        });
         //Templates Designer
         $('#Full_1').change(function(){
            this.checked ? isChecked('Full_1') : isnotChecked('Full_1');
        });
        $('#Read_1').change(function(){
            this.checked ? isChecked('Read_1') : isnotChecked('Read_1');
        });
        $('#Add_1').change(function(){
            this.checked ? isChecked('Add_1') : isnotChecked('Add_1');
        });
        $('#Edit_1').change(function(){
            this.checked ? isChecked('Edit_1') : isnotChecked('Edit_1');
        });
        $('#Delete_1').change(function(){
            this.checked ? isChecked('Delete_1') : isnotChecked('Delete_1');
        });
        $('#Word_1').change(function(){
            this.checked ? isChecked('Word_1') : isnotChecked('Word_1');
        });
        $('#Excel_1').change(function(){
            this.checked ? isChecked('Excel_1') : isnotChecked('Excel_1');
        });
        $('#ViewLog_1').change(function(){
            this.checked ? isChecked('ViewLog_1') : isnotChecked('ViewLog_1');
        });
        $('#Reports_1').change(function(){
            this.checked ? isChecked('Reports_1') : isnotChecked('Reports_1');
        });
        $('#Status_1').change(function(){
            this.checked ? isChecked('Status_1') : isnotChecked('Status_1');
        });
        //Accounts Manager
       $('#Full_2').change(function(){
            this.checked ? isChecked('Full_2') : isnotChecked('Full_2');
        });
        $('#Read_2').change(function(){
            this.checked ? isChecked('Read_2') : isnotChecked('Read_2');
        });
        $('#Add_2').change(function(){
            this.checked ? isChecked('Add_2') : isnotChecked('Add_2');
        });
        $('#Edit_2').change(function(){
            this.checked ? isChecked('Edit_2') : isnotChecked('Edit_2');
        });
        $('#Delete_2').change(function(){
            this.checked ? isChecked('Delete_2') : isnotChecked('Delete_2');
        });
        $('#Word_2').change(function(){
            this.checked ? isChecked('Word_2') : isnotChecked('Word_2');
        });
        $('#Excel_2').change(function(){
            this.checked ? isChecked('Excel_2') : isnotChecked('Excel_2');
        });
        $('#ViewLog_2').change(function(){
            this.checked ? isChecked('ViewLog_2') : isnotChecked('ViewLog_2');
        });
        $('#Reports_2').change(function(){
            this.checked ? isChecked('Reports_2') : isnotChecked('Reports_2');
        });
        $('#Status_2').change(function(){
            this.checked ? isChecked('Status_2') : isnotChecked('Status_2');
        });
        //Sales/Orders Manager
        $('#Full_3').change(function(){
            this.checked ? isChecked('Full_3') : isnotChecked('Full_3');
        });
        $('#Read_3').change(function(){
            this.checked ? isChecked('Read_3') : isnotChecked('Read_3');
        });
        $('#Add_3').change(function(){
            this.checked ? isChecked('Add_3') : isnotChecked('Add_3');
        });
        $('#Edit_3').change(function(){
            this.checked ? isChecked('Edit_3') : isnotChecked('Edit_3');
        });
        $('#Delete_3').change(function(){
            this.checked ? isChecked('Delete_3') : isnotChecked('Delete_3');
        });
        $('#Word_3').change(function(){
            this.checked ? isChecked('Word_3') : isnotChecked('Word_3');
        });
        $('#Excel_3').change(function(){
            this.checked ? isChecked('Excel_3') : isnotChecked('Excel_3');
        });
        $('#ViewLog_3').change(function(){
            this.checked ? isChecked('ViewLog_3') : isnotChecked('ViewLog_3');
        });
        $('#Reports_3').change(function(){
            this.checked ? isChecked('Reports_3') : isnotChecked('Reports_3');
        });
        $('#Status_3').change(function(){
            this.checked ? isChecked('Status_3') : isnotChecked('Status_3');
        });
        function isChecked(c){
            //alert(c);
             $('.'+c).prop('checked', true);

        }
        function isnotChecked(c){
            //alert(c);
           $('.'+c).prop('checked', false); 
        }
    });
</script>