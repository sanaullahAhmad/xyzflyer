<script>
$( document ).ready(function() {
  $( ".removemsg" ).click(function() {
	$('#message').remove();
	$('#iploadedImg').remove();
});
});
</script>
<ul class="nav nav-tabs">
	<li class="<?php if(isset($tab) && $tab=='upload' || !isset($tab)) echo '"active"'; ?>removemsg"><a data-toggle="tab" href="#tab-id-1-1">Upload a Flyer</a></li>
	<li class="<?php if(isset($tab) && $tab=='choose') echo 'class="active"'; ?>removemsg"><a data-toggle="tab" href="#tab-id-1-2" id="remove" >Choose Your Flyer</a></li>
	<li class="<?php if(isset($tab) && $tab=='design') echo 'class="active"'; ?>removemsg"><a data-toggle="tab" href="#tab-id-1-3" class="load_flyer_json">Flyer Design Layout</a></li>
	<li class="<?php if(isset($tab) && $tab=='proof') echo 'class="active"'; ?>removemsg"><a data-toggle="tab" href="#tab-id-1-4" id="save">Proof</a></li>
	<!-- <li <?php //if(isset($tab) && $tab=='delivery') echo 'class="active"'; ?>><a data-toggle="tab" href="#tab-id-1-5">Delivery Area</a></li> -->
</ul>

<div class="tab-content">

	<div id="tab-id-1-1" class="tab-pane fade <?php if(isset($tab) && $tab=='upload' || !isset($tab)) echo 'in active'; ?>">
        <?php $this->load->view( 'admin/manageflyers/tabs/flyer-design-tab-1' ); ?>
	</div>

	<div id="tab-id-1-2" class="tab-pane fade <?php if(isset($tab) && $tab=='choose') echo 'in active'; ?>">
        <?php $this->load->view( 'admin/manageflyers/tabs/flyer-design-tab-2' ); ?>
	</div>

	<div id="tab-id-1-3" class="tab-pane fade <?php if(isset($tab) && $tab=='design') echo 'in active'; ?>">
		<?php $this->load->view( 'admin/manageflyers/tabs/flyer-design-layout' ); ?>
	</div>

	<div id="tab-id-1-4" class="tab-pane fade <?php if(isset($tab) && $tab=='proof') echo 'in active'; ?>">
        <?php $this->load->view( 'admin/manageflyers/tabs/proof' ); ?>
	</div>

	<!-- <div id="tab-id-1-5" class="tab-pane fade <?php if(isset($tab) && $tab=='delivery') echo 'in active'; ?>">
        <?php //$this->load->view( 'admin/manageflyers/tabs/delivery-area' ); ?>
	</div> -->

</div>

<script>
    function uploadflayer() {

            var form = jQuery("#flayer_form");
            var data = new FormData();
            var file = document.getElementById('fileinput').files[0];
            jQuery.each(jQuery('#fileinput')[0].files, function(i, file) {
                data.append('files[]', file);
            });

            jQuery.ajax({
                url: base_url + 'admin/manageflyers/uploadflayer',
                type: 'POST',
                data: data,
                form: form,
                cache: false,
                contentType: false,
                processData: false,
                context: document.body,
                error: function(data, transport) {},
                success: function(data) {
                    $("#select-flyer-size").css("display", "block");
                    $('#hidden_flayer_images_id').val(data);
                }
            });
        }
</script>
<script>
    function uploadflayerimagesize() {

            var form = jQuery("#flayer_size_form");
            var data = form.serialize();
            jQuery.ajax({
                url: base_url + 'admin/manageflyers/uploadflayeriamgesize',
                type: 'POST',
                data: data,
                form: form,
                cache: false,
                contentType: false,
                processData: false,
                context: document.body,
                error: function(data, transport) {},
                success: function(data) {
                    alert(data);
                    $('#hidden_flayer_images_id').val(data);
                }
            });
        }
</script>