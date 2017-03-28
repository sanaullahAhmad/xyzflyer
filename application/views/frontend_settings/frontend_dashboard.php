<div id="page-wrapper" >
    <div class="page-content">
<!--         <div class="row">
            <div class="col-md-12"> -->
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <h2 style="margin-top:0px"></h2>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message" class="alert">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">

	    </div>
        </div>


        <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <div class="row">
                    <div class="col-md-4"><a href="<?php echo site_url('Frontend_settings/index'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-home fa-lg"></i></div>
                            <h3>Home Slider</h3>
                        </div>
                    </a></div>
                <div class="col-md-4"><a href="<?php echo site_url('Frontend_settings/aboutus'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-user fa-lg"></i></div>
                            <h3>About us Slider</h3>
                        </div>
                    </a></div>
                <div class="col-md-4"><a href="<?php echo site_url('Frontend_settings/howitworks'); ?>">
                        <div class="box">
                            <div class="icon"><i class="fa fa-link fa-lg"></i></div>
                            <h3>How it works Slider</h3>
                        </div>
                    </a></div>
                    </div>
                    <br/>
                </div>
                </div>
      
</div>