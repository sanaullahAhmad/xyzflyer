<?php
    //function to log all the changes in the database in a single page visit
function log_queries($user_type, $action_type, $object_type, $object) {
    $CI =& get_instance();
    $subject = "";
    $CI->load->model('Admin_activity_model');
    $CI->load->model('Users_activity_model');
    $CI->load->helper('format_helper');

    $log = NULL;

    //get a list of all the queries executed so far
    $queries = $CI->db->queries;

    //if some queries were actually executed, iterate through them
    if( count($queries) != 0 ):
        foreach($queries as $key => $query):
                //skip logging of queries for ci_sessions and last_activity of user table
                // if( strpos( $query, "ci_sessions") !== FALSE OR strpos( $query, "last_activity") !== FALSE ):
                //     continue;
                // endif;

                //add to log array only if the query for INSERT, UPDATE or DELETE
            if( strpos( $query, "INSERT") !== FALSE OR strpos( $query, "UPDATE") !== FALSE OR strpos( $query, "DELETE") !== FALSE ):
                $log[] = $query;

            endif;
            endforeach;
            endif;

        //if some INSERT, UPDATE or DELETE queries were found, log them
            if( is_array($log) ):
            //change array to json string
                $log = json_encode( $log );


            $session = $CI->session->userdata();
            if($user_type === "admin"){
                if($session && isset($session['admin_data']) ){
                    $id = $session['admin_data']['pk_admin_id'];
                    $subject = $session['admin_data']['username'];
                }else{
                    //if no id found in session
                    $id = 999;
                    $subject = "unknown";
                }



                $activity_text = ucfirst($user_type) . " named '" . $subject . "' " . format($action_type, 'action_type') . " " . $object_type . " '" . $object . "' " . 'at' . " " . date('Y-m-d H:i:s');
                $CI->Admin_activity_model->insert( [ 'action_type' => $action_type, 'activity_type' => $object_type  ,  'activity_text' => $activity_text, 'activity_date' => date('Y-m-d H:i:s') , 'admin_id' => $id] );

            }

            if($user_type === "user"){
                $id =NULL;
                $subject = NULL;

                if($session && isset($session['user_data']) ){
                    $id = $session['user_data']['pk_user_id'];
                    $subject = $session['user_data']['username'];
                }else{
                    //if no id found in session
                    $id = 999;
                    $subject = "unknown";
                }

                $activity_text = ucfirst($user_type) . " named '" . $subject . "' " . format($action_type, 'action_type') . " " . $object_type . " '" . $object . "' " . 'at' . " " . date('Y-m-d H:i:s');


                $CI->Users_activity_model->insert( [ 'action_type' => $action_type, 'activity_type' => $object_type  ,  'activity_text' => $activity_text, 'activity_date' => date('Y-m-d H:i:s') , 'user_id' => $id] );

            }


            //$subject which action done
            //$object upon which action happened
            //$object_type which type of object it is





            endif;
        }

function log_user_activity($custom_activity_text, $user_id, $activity_type=0)
{
    $CI =& get_instance();
    $subject = "";
    $CI->load->model('Admin_activity_model');
    $CI->load->model('Users_activity_model');
    $CI->load->helper('format_helper');

    $row = $CI->Users_activity_model->get_user_by_id($user_id);


    $activity_text = "User '" .$row->username. "' (id: ".$user_id.") ".$custom_activity_text." at " . date('Y-m-d H:i:s');
    if($CI->Users_activity_model->insert( ['activity_type' => $activity_type  ,  'activity_text' => $activity_text, 'activity_date' => date('Y-m-d H:i:s') , 'user_id' => $user_id] ))
        return true; 
    else return false;
}