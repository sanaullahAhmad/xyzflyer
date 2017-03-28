<div id="page-wrapper" >
    <div class="page-content">
	<section>
		<?	echo $this->breadcrumbs->show(); ?>
	</section>
    <div class="row">
        <div class="col-md-6">
        <h2 style="margin-top:0px"><?php echo $button ?></h2>
		
        <form action="<?php echo $action; ?>" method="post" name="addAdminform">
		 <input type="hidden" name="length" value="10">
		 
		<div class="form-group">
            <label for="varchar">First Name <?php echo form_error('First_Name') ?></label>
            <input type="text" class="form-control" name="First_Name" id="First_Name" placeholder="First name" value="<?php echo $First_Name; ?>" required />
        </div>
		<div class="form-group">
            <label for="varchar">Last Name <?php echo form_error('Last_Name') ?></label>
            <input type="text" class="form-control" name="Last_Name" id="Last_Name" placeholder="Last name" value="<?php echo $Last_Name; ?>" required />
        </div>
		
	  <!--  <div class="form-group">
            <label for="varchar">Full name <?php echo form_error('Full_Name') ?></label>
            <input type="text" class="form-control" name="Full_Name" id="Full_Name" placeholder="Full Name" value="<?php echo $Full_Name; ?>" required/>
        </div> -->
	    <div class="form-group">
            <label for="varchar">Agency Name <?php echo form_error('Agency_Name') ?></label>
            <input type="text" class="form-control" name="Agency_Name" id="Agency_Name" placeholder="Agency Name" value="<?php echo $Agency_Name; ?>" />
        </div> 
		
		 
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email_address') ?></label>
            <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Email" value="<?php echo $email_address; ?>" required/>
        </div>
		
		 <div class="form-group">
		  <label for="varchar">State <?php echo form_error('State') ?></label>
           <select class="form-control" name="State" onChange="getState(this.value);" required>
				<option value="">Select a State</option>
				<?php  if(isset($us_state) && is_array($us_state)){
                    foreach($us_state as $key => $value){
                    echo "<option ".($State==$key?"selected='selected'":"")." value='".$key."'>".$value."</option>";
                    }
				}?>
				
		</select>		
		<script>
            function getState(val) {
                $.ajax({
                     type: "POST",
                   url: '<?php echo base_url(); ?>newdesign/counties',
                   dataType: 'html',
                   data: { state : val },
                   success: function(data) {
                      $('#county').html( data );
                   }
                });
            }
        </script>
        </div>
	
		<div class="form-group">
			<label>County</label>
				<select name="County" id="county" class="form-control">
					<?php if ($County !='' ){ ?> 
					<option value="<?=$County?>"><?=$County;?> </option> <?php } ?>
					<option value="">Select County</option>
				</select>
        </div>
									
	 <div class="form-group">
            <label for="varchar">City <?php echo form_error('City') ?></label>
            <input type="text" class="form-control" name="City" id="City" placeholder="City" value="<?php echo $City; ?>" />
        </div>
		<!--	
		<div class="form-group">
            <label for="varchar">CountyFIPS <?php echo form_error('CountyFIPS') ?></label>
            <input type="text" class="form-control" name="CountyFIPS" id="CountyFIPS" placeholder="CountyFIPS" value="<?php echo $CountyFIPS; ?>" required/>
        </div>
		<div class="form-group">
            <label for="varchar">Address <?php echo form_error('Address') ?></label>
            <input type="text" class="form-control" name="Address" id="Address" placeholder="Address" value="<?php echo $Address; ?>" required/>
        </div> -->
		<!--
		<div class="form-group">
            <label for="varchar">ZIPCode <?php echo form_error('ZIPCode') ?></label>
            <input type="text" class="form-control" name="ZIPCode" id="ZIPCode" placeholder="ZIPCode" value="<?php echo $ZIPCode; ?>" required/>
        </div>
		
		<div class="form-group">
            <label for="varchar">StateFIPS <?php echo form_error('StateFIPS') ?></label>
            <input type="text" class="form-control" name="StateFIPS" id="StateFIPS" placeholder="StateFIPS" value="<?php echo $StateFIPS; ?>" required/>
        </div>
		<div class="form-group">
            <label for="varchar">Phone_Number <?php echo form_error('Phone_Number') ?></label>
            <input type="text" class="form-control" name="Phone_Number" id="Phone_Number" placeholder="Phone_Number" value="<?php echo $Phone_Number; ?>" required/>
        </div>
		<div class="form-group">
            <label for="varchar">Website <?php echo form_error('Phone_Number') ?></label>
            <input type="text" class="form-control" name="Website" id="Website" placeholder="Website" value="<?php echo $Website; ?>" required/>
        </div>-->
		<!-- <div class="form-group">
            <label for="varchar">Fax_Number <?php echo form_error('Fax_Number') ?></label>
            <input type="text" class="form-control" name="Fax_Number" id="Fax_Number" placeholder="Fax_Number" value="<?php echo $Fax_Number; ?>" required/>
        </div>
		
		<div class="form-group">
            <label for="varchar">Timezone <?php echo form_error('Timezone') ?></label>
            <input type="text" class="form-control" name="Timezone" id="Timezone" placeholder="Timezone" value="<?php echo $Timezone; ?>" required/>
        </div>
		<div class="form-group">
            <label for="varchar">Latitude <?php echo form_error('Latitude') ?></label>
            <input type="text" class="form-control" name="Latitude" id="Latitude" placeholder="Latitude" value="<?php echo $Latitude; ?>" required/>
        </div>
		<div class="form-group">
            <label for="varchar">Longitude  <?php echo form_error('Longitude ') ?></label>
            <input type="text" class="form-control" name="Longitude" id="Latitude" placeholder="Latitude" value="<?php echo $Longitude; ?>" required/>
        </div>
		<div class="form-group">
            <label for="varchar">ZIPType <?php echo form_error('ZIPType') ?></label>
            <input type="text" class="form-control" name="ZIPType" id="ZIPType" placeholder="ZIPType" value="<?php echo $ZIPType; ?>" required/>
        </div>
		<div class="form-group">
            <label for="varchar">CityType <?php echo form_error('CityType') ?></label>
            <input type="text" class="form-control" name="CityType" id="CityType" placeholder="CityType" value="<?php echo $CityType; ?>" required/>
        </div>
		
		<div class="form-group">
            <label for="varchar">UTC <?php echo form_error('UTC') ?></label>
            <input type="text" class="form-control" name="UTC" id="UTC" placeholder="UTC" value="<?php echo $UTC; ?>" required/>
        </div>-->
		<div class="form-group">
            <label for="varchar">Subscription Status <?php echo form_error('unsubscribed') ?></label>
			 <select class="form-control" name="unsubscribed" id="unsubscribed" required>
				<option>Select a Staus</option>
				<option value="0" <?= ($unsubscribed== 0 ? "selected='selected'": "") ?> >Subscribed</option>
				<option value="1" <?= ($unsubscribed== 1 ? "selected='selected'": "") ?> >UnSubscribed</option>
			</select>		
        </div>
	   
	    <input type="hidden" name="email_id" value="<?php echo $email_id; ?>" />
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
	    <a href="<?php echo site_url('Email_databaseManagement') ?>" class="btn btn-default">Cancel</a>
	</form>
  </div>
  </div>
    </div>

