<ul class="nav nav-tabs">
	<li class="active"><a data-toggle="tab" href="#tab-id-1-1">Upload a Flyer</a></li>
	<li><a data-toggle="tab" href="#tab-id-1-2">Choose Your Flyer</a></li>
	<li><a data-toggle="tab" href="#tab-id-1-3">Flyer Design Layout</a></li>
	<li><a data-toggle="tab" href="#tab-id-1-4">Proof</a></li>
	<li><a data-toggle="tab" href="#tab-id-1-5">Delivery Area</a></li>
</ul>

<div class="tab-content">

	<div id="tab-id-1-1" class="tab-pane fade in active">
        <?php $this->load->view( 'admin/manageflyers/tabs/flyer-design-tab-1' ); ?>
	</div>

	<div id="tab-id-1-2" class="tab-pane fade">
        <?php $this->load->view( 'admin/manageflyers/tabs/flyer-design-tab-2' ); ?>
	</div>

	<div id="tab-id-1-3" class="tab-pane fade">
		<h3>Menu 2</h3>
		<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
	</div>

	<div id="tab-id-1-4" class="tab-pane fade">
		<h3>Menu 3</h3>
		<p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	</div>

	<div id="tab-id-1-5" class="tab-pane fade">
		<h3>Menu 3</h3>
		<p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
	</div>

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