<?php 
	$this->load->view('new_frontend/public/head');
	$this->load->view('new_frontend/public/header');
?>
<script type="text/javascript">
function disableselect(e) {
    return false;
}

function reEnable() {
    return true;
}

document.onselectstart = new Function("return false");

if (window.sidebar) {
    document.onmousedown = disableselect;
    document.onclick = reEnable;
}

document.onkeydown = function (e) {
    e = e || window.event;//Get event
    if (e.ctrlKey) {
        var c = e.which || e.keyCode;//Get key code
        switch (c) {
          case 65://Block Ctrl+A
            case 97://Block Ctrl+a --Not work in Chrome
			 case 99://Block Ctrl+c
            case 67://Block Ctrl+C --Not work in Chrome
                e.preventDefault();     
                e.stopPropagation();
            break;
        }
    }
};
</script>
<!-- body content goes here! -->
<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<ul class="breadcrumb">
									<li><a href="#">Home</a></li>
									<li class="active">Privacy Policy</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h1>Privacy Policy</h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row">
						<div class="col-md-6">
							<?php print_r($privacy->page_description); ?>
							
						</div>
					</div>
				</div>
			</div>		
				<section class="call-to-action call-to-action-primary mb-xl">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="call-to-action-content align-left pb-md mb-xl ml-none">
								<h3>XYZFlyers is <strong>everything</strong> you need to create an <strong>effective</strong> sales stream!</h3>
								<p>XYZ Flyers is a fast, effective marketing tool that connects your property with thousands of agents.</p>
							</div>
							<div class="call-to-action-btn">
								<a href="<?=($this->session->user_data)?site_url('editor'):site_url('register')?>" target="_blank" class="btn btn-lg btn-primary btn-primary-scale-2 mr-md">Get Started Today</a>
								<span class="mr-md text-color-light hidden-xs"><span class="arrow arrow-light hlb" style="top: -88px; right: -47px;"></span></span>
							</div>
						</div>
					</div>
				</div>
			</section>

<?php 
	$this->load->view('new_frontend/public/footer');
?>