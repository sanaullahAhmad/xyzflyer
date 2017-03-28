<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function format($data, $type = '') {
         $CI = get_instance();

        if($type === 'date' && $data === '0000-00-00'):
            return 'N/A';

        elseif($type === 'time' && $data === '00:00:00'):
            return 'N/A';

        elseif($type === 'format_date' && $data):
            $d = date_create($data);
            return date_format($d, 'm/d/Y Hi');

        elseif($type=== 'status'):
            if($data === '1' || $data === 1){
                return 'Active';
            }else{
                return 'Inactive';
            }
        elseif($type === 'admin'):
            if($data){
            $CI->load->model('Admins_model');
            $row = $CI->Admins_model->get_by_id($data);
            if($row){
                return $row->admin_username;
            }else{
                return 'N/A';
            }

            }else{
                return "N/A";
            }
		elseif($type === 'admin_name'):
            if($data){
            $CI->load->model('Admins_model');
            $row = $CI->Admins_model->get_by_id($data);
            if($row){
                return $row->admin_firstname." ".$row->admin_lastname ;
            }else{
                return 'N/A';
            }

            }else{
                return "N/A";
            }
		 elseif($type === 'user_name'):
            $CI->load->model('Users_model');
            $row = $CI->Users_model->get_by_id($data);
            if($row){
                return $row->userFirstName." ".$row->userLastName;
            }else{
                return "N/A";
            }
		
        elseif($type === 'user'):
            $CI->load->model('Users_model');
            $row = $CI->Users_model->get_by_id($data);
            if($row){
                return $row->username;
            }else{
                return "N/A";
            }
         elseif($type==="countflyers"):
                    $CI->load->model('frontend/commonmodel');
                    $row = $CI->commonmodel->total_records_where('repeater', $data, 'user_flyers');
                    if($row){
                        return $row;
                    }else{
                        return 0;
                    }
        elseif($type === 'state_name'):
            if($data){
            $CI->load->model('frontend/Commonmodel', 'cm');
            return $CI->cm->state_list[$data];
            }else{
                return $data;
            }
		elseif($type==="countAdminflyers"):
                    $CI->load->model('frontend/commonmodel');
                    $row = $CI->commonmodel->total_records_where('flyerId', $data, 'user_flyers');
                    if($row){
                        return $row;
                    }else{
                        return 0;
                    }
        elseif($type === 'coupon_type'):
            if($data === 0 || $data === "0"){
                return 'Percentage';
            }else if($data === 1 || $data === "1"){
                return 'Fixed Amount';
            }else if($data === 2 || $data === "2"){
                return 'Price Override';
            }else{
                return "Undefined";
            }

        elseif($type === "BOOL"):
            if($data === "1" || $data === 1){
                return "YES";
            }else{
                return "NO";
            }

        elseif($type === "order_status"):
            if($data === 0 || $data === "0"){
                return 'Pending';
            }else if($data === 1 || $data === "1"){
                return 'Approved';
            }else if($data === 2 || $data === "2"){
                return 'Process';
            }else if($data === 3 || $data === "3"){
                return "Done";
            }else{
                return "Undefined";
            }

        elseif($type === "admin_type"):
            if($data === 0 || $data === "0"){
                return 'Super Admin';
            }else if($data === 1 || $data === "1"){
                return 'Templates Designer';
            }else if($data === 2 || $data === "2"){
                return 'Accounts Manager';
            }else if($data === 3 || $data === "3"){
                return "Sales/Order Manager";
            }else{
                return "Undefined";
            }

        elseif($type === "admin_status"):
            if($data === 0 || $data === "0"){
                return 'Closed';
            }else if($data === 1 || $data === "1"){
                return 'Active';
            }else{
                return "Undefined";
            }

        elseif($type === "user_status"):
            if($data === 0 || $data === "0"){
                return 'Unverified';
            }else if($data === 1 || $data === "1"){
                return 'Active';
            }else if($data === 2 || $data === "2"){
                return 'Suspended';
            }else{
                return "Undefined";
            }

        elseif($type === "gender"):
            if($data === 0 || $data === "0"){
                return 'Male';
            }else if($data === 1 || $data === "1"){
                return 'Female';
            }else{
                return "Unknown";
            }

        elseif($type === "action_type"):
            if($data === "0" || $data === 0)
                return "inserted";
            else if($data === "1" || $data === 1)
                return "updated";
            else if($data === "2" || $data === 2)
                return "deleted";
            else
                return 'read';

         elseif($type === "activity_type"):
            if($data === "0" || $data === 0)
                return "admins";
            else if($data === "1" || $data === 1)
                return "users";
            else if($data === "2" || $data === 2)
                return "orders";
            else if($data === "3" || $data === 2)
                return "flyers";
            else if($data === "4" || $data === 2)
                return "coupons";
            else if($data === "5" || $data === 2)
                return "pages";
            else
                return 'notdefined';

        //chop() method remove the trailing whitespaces and is an alias to rtrim()
        elseif(chop($data) === NULL || chop($data) === '' ):
            return 'N/A';

        endif;
        return $data;
    }

?>
