<?php
/*Coupon calculations*/
$query3 = $this->db->query("select * from tbl_settings where mykey = 'frontend_contactus_coupon'");
$frontend_contactus_coupon = $query3->row();
//now use that selected coupon.
$this->db->select('coupon_maximum_uses, coupon_code, coupon_type, coupon_value');
if($frontend_contactus_coupon)
{
    $this->db->where('coupon_code', $frontend_contactus_coupon->Value);
}
$res = $this->db->get('admi_coupons');
$res = $res->row();
$res_coupon_code=0;
$res_coupon_type=0;
$res_coupon_value=0;
$res_coupon_maximum_uses=0;
if($res)
{
    $res_coupon_code= $res->coupon_code;
    $res_coupon_type=$res->coupon_type;
    $res_coupon_value=$res->coupon_value;
    $res_coupon_maximum_uses=$res->coupon_maximum_uses;
}
$this->db->where('coupon_code', $res_coupon_code);
$this->db->from('admi_coupons_used');
$admi_coupons_used = $this->db->count_all_results();

//echo $admi_coupons_used;exit;

if($res_coupon_type==2)
{
    $price = 39.95 - (39.95*$res->coupon_value/100);
}
else{
    $price = (39.95 - $res_coupon_value);
}

$available_coupons = ($res_coupon_maximum_uses - $admi_coupons_used);
?>
<tr>
    <td align="center" valign="top" width="100%" style="background-color: #ffffff;  border-top: 1px solid #e5e5e5; ">
       <center>
        <table cellspacing="0" cellpadding="0" width="700" class="w320">
          <tr>
            <td style="padding: 25px 0 25px">
              <strong>XYZ Flyers</strong><br />
              A 9533Designs Inc. Copmany <br />
              20 S Santa Cruz Avenue, Suite 300, Los Gatos, CA 95030 <br />
               408-335-6169 : sales@xyzflyers.com<br />
                <span style="color: blue; float: left;width: 78%;">Learn how this agent sent their properties flyers to 10,000 agents in your area for only </span>
                <span style='color:red;text-decoration:line-through; float: left;width: 8%;'>
                    <span style='color:black'>$39.95!</span>
                </span>
                <span style="color: blue; float: left;width: 8%;">
                    <?php if(isset($price)){ echo $price;}?>
                </span>
                <div style="width: 200px; height: 50px; background: #9900ff; color: #fff; font-weight: bold; float:right; padding: 7px; margin-right: -100px;">
                    Get 20% off to the first <?php if(isset($available_coupons)){ echo $available_coupons;}?> orders this month!
                </div>
                <p>&nbsp;</p>
                <a href="http://www.facebook.com/xyzflyers" style="margin-left: 100px;">
                <img src="https://xyzflyers.com/public/new_frontend/img/icons/fb_ic.png" alt="" />
               </a>
              <a href="http://www.twitter.com/xyzflyers">
                <img src="https://xyzflyers.com/public/new_frontend/img/icons/tw_ic.png" alt="" />
              </a>
              <a href="http://www.linkedin.com/company/xyz-flyers">
                <img src="https://xyzflyers.com/public/new_frontend/img/icons/li_ic.png" alt="" />
              </a>
              <a href="https://www.pinterest.com/xyzflyers/">
                <img src="https://xyzflyers.com/public/new_frontend/img/icons/pi_ic.png" alt="" />
              </a>
            </td>
          </tr>
        </table>
      </center>
    </td>
  </tr>
 <!--  <tr>
   <td align="center" valign="top" width="100%" style="background-color: #f7f7f7; height: 100px;">
    
   </td>
 </tr> -->
</table>
</body>
</html>
