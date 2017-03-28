var editor;
$(document).ready(function () {
    
var table = $('#template_js').DataTable({
        lengthChange: false,
        "order": [[ 1, "desc" ]],
        ajax: base_url+"admin/managetemplate/gettemplate",
        columns: [
            {data: "product_template_name"},
            {data: "product_template_status"},
            {data: "product_template_image"},
            {     // fifth column (Edit link)
                "sName": "pk_product_template_id",
                "bSearchable": false,
                "bSortable": false,
                "mRender": function (data, type, full) {
                    //console.info(full);
                    var id = full.pk_product_template_id; //row id in the first column
                    var status = full.product_template_status;
                    return "<a href='"+base_url+"admin/managetemplate/savetemplate/"+id+"'>Edit</a> // <a href='"+base_url+"admin/managetemplate/deltemplate/"+id+"'>Del</a> // <a href='"+base_url+"admin/managetemplate/changestatus/"+id+"/"+status+"'>Change Status</a>";
             } }
            
        ]
    });
    

}); 