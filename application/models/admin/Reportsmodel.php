<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reportsmodel extends CI_Model {

    /**
     * will get all the records for orders ajax data table
     */
    public function getOrderAjaxData($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
        $this->db->select(
               'uf.uFlyerTitle as flyer_title,
                uf.flyer_created_image as image,
                uf.flyer_created_thumb as thumb,
                ot.daorder_id as order_id,
                ot.daorder_price as price,
                ot.daorder_coupen_discount as discount,
                ot.daorder_coupon_type as coupen_type,
                ot.daorder_total_emails as total_agents,
                ot.daorder_grand_total,
                DATE(ot.daorder_date) as order_date,
                TIME(ot.daorder_date) as order_time,
                ot.daorder_status as status,
                usr.userId as user_id,
                usr.userFirstName as FirstName,
                usr.userLastName as  LastName'
            );
        $this->db->from('user_flyers uf');
        if($start >=0 && $end > 0){
           $this->db->limit($end, $start);
        }
        if($where!=NULL){
            $query = $this->db->where($where);
        }
        if($order!=NULL){
            if($type!=NULL){$type=$type;}else{$type='DESC';}
            $this->db->order_by($order,$type);
        }
        $this->db->join('tbl_orders ot','uf.uFlyerId=ot.daorder_flyer_id');
        $this->db->join('users usr','uf.userId=usr.userId');
        $query = $this->db->get();
        return $query->result_array();
    }
    /*count all records in order*/
    public function total_order_records($where=NULL){
           $query = $this->db->query('select count(*) as numRows from tbl_orders ot join user_flyers uf on uf.uFlyerId=ot.daorder_flyer_id join users usr on uf.userId=usr.userId '.($where!=''?'WHERE '.$where:' ').'');
           if ($query->num_rows() > 0)
                {
                   $row = $query->row_array();
                   return $row['numRows'];
                } else{
                    return 0;
            }
    }
    /*count all records in email*/
    public function total_email_records($where=NULL){
           $query = $this->db->query('select count(*) as numRows from campaign_emails as em '.($where!=''?'WHERE '.$where:' ').'');
           if ($query->num_rows() > 0)
                {
                   $row = $query->row_array();
                   return $row['numRows'];
                } else{
                    return 0;
            }
    }
    /**
     * will get all the records for emails ajax data table
     */
    public function getEmailsAjaxData($where=NULL,$order=NULL,$type=NULL,$start=NULL,$end=NULL) {
        $this->db->select('
				em.emailId as emailId,
                em.Agency_Name as agency,
                em.First_Name as firstname,
				 em.Last_Name as lastname,
                em.email_address as email,
                em.StateName as state,
                em.County as county,
                em.City as city,
                em.unsubscribed as  status'
            );
        $this->db->from('campaign_emails em ');
        if($start >=0 && $end > 0){
           $this->db->limit($end, $start);
        }
        if($where!=NULL){
            $query = $this->db->where($where);
        }
        if($order!=NULL){
            if($type!=NULL){$type=$type;}else{$type='DESC';}
            $this->db->order_by($order,$type);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function sendGrid_response($from,$to){
        if(!empty($from) && !empty($to)){
            $key = "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";
            $sg = new \SendGrid($key);
            // "country": "US",
            $query_params = json_decode('{  "start_date": "'.$from.'", "end_date": "'.$to.'" , "aggregated_by": "month"}');
            // $response = $sg->client->geo()->stats()->get(null, $query_params);
            $response = $sg->client->stats()->get(null, $query_params);
            // echo $response->statusCode();
            $body =  $response->body();
            $body = json_decode($body, true);
            $sent = 0;
            $bounces = 0;
            $optOut = 0;
            $blocks = 0;
            $bounce_drops = 0;
            $clicks = 0;
            $deferred = 0;
            $delivered  = 0;
            $invalid_emails = 0;
            $opens = 0;
            $requests = 0;
            $spam_report_drops = 0;
            $spam_reports = 0;
            $unique_clicks = 0;
            $unique_opens = 0;
            $unsubscribe_drops = 0;
            foreach ($body as $b) {
                $arr = $b['stats'][0]['metrics'];
                $sent += $arr['processed'];
                $bounces += $arr['bounces'];
                $optOut += $arr['unsubscribes'];
                $blocks += $arr['blocks'];
                $bounce_drops += $arr['bounce_drops'];
                $clicks += $arr['clicks'];
                $deferred += $arr['deferred'];
                $delivered += $arr['delivered'];
                $invalid_emails += $arr['invalid_emails'];
                $opens += $arr['opens'];
                $requests += $arr['requests'];
                $spam_report_drops += $arr['spam_report_drops'];
                $spam_reports += $arr['spam_reports'];
                $unique_clicks += $arr['unique_clicks'];
                $unsubscribe_drops += $arr['unsubscribe_drops'];
            }
            $res = [
            'sent' => $sent,
            'bounces' => $bounces,
            'optOut' => $optOut,
            'blocks' => $blocks,
            'bounce_drops' => $bounce_drops,
            'clicks' => $clicks,
            'deferred' => $deferred,
            'delivered'  => $delivered,
            'invalid_emails' => $invalid_emails,
            'opens' => $opens,
            'requests' => $requests,
            'spam_report_drops' => $spam_report_drops,
            'spam_reports' => $spam_reports,
            'unique_clicks' => $unique_clicks,
            'unique_opens' => $unique_opens,
            'unsubscribe_drops' => $unsubscribe_drops
            ];
            return $res;
        }else{
            return array();
        }

    }

    public function get_email_data($subscribeId)
    {
        $this->db->where('subId', $subscribeId);
        return $this->db->get('tbl_subscriber')->row();
    }

     // update data
    function update($id, $data)
    {
        $this->db->where('subId', $id);
        $this->db->update('tbl_subscriber', $data);
    }
    public function subscriber_read($subscribeId='')
    {
        $this->db->where('subId', $subscribeId);
        return $this->db->get('tbl_subscriber')->row();

    }

}

//end of class