<div class="row" id="editor">
    <div class="col-md-8 col-xs-12" id="editor-left">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <h5 class="inline">Choose your Flyer Size :</h5>
                <button type="button" id="editor-canvasSize" data-width="8.5" data-height="9" class="btn btn-default btn-primary">8.5 X 11</button>
            </div>
        </div>
        <div class="canvasBig" style="">
            <center><canvas id="myCanvas"></canvas></center>
        </div>
        <div class="row" style="margin-top: -2%;">
            <div class="col-md-6 col-xs-12">
                <div class="wan-spinner wan-spinner-1">
                    <a href="javascript:void(0)" class="minus"><i class="fa fa-minus"></i></a>
                    <input type="text" id="screen_value" value="100">
                    <a href="javascript:void(0)" class="plus"><i class="fa fa-plus"></i></a>
                </div>
                <div class="mt-5">
                    <button type="button" id="editor-zoomButton" data-number="50" style="width: 50px" class="btn btn-default btn-sm zoom-class">50</button>
                    <button type="button" id="editor-zoomButton" data-number="75" style="width: 50px" class="btn btn-default btn-sm zoom-class">75</button>
                    <button type="button" id="editor-zoomButton" data-number="100" style="width: 50px" class="btn btn-default btn-sm zoom-class">100</button>
                    <button type="button" id="editor-zoomButton" data-number="150" style="width: 50px" class="btn btn-default btn-sm zoom-class">150</button>
                    <button type="button" id="editor-zoomButton" data-number="200" style="width: 50px" class="btn btn-default btn-sm zoom-class">200</button>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 text-right">
                <div >
                    <button type="button" id="fullScreenEditor" class="btn btn-success"><i class="fa fa-desktop"></i> Full Screen</button>
                    <div class="btn-group" role="group">
                        <button data-type="redo" type="button" class="btn btn-default" id="undobtn"><i class="fa fa-undo"></i> Undo</button>
                        <button data-type="undo" type="button" class="btn btn-default" id="redobtn"><i class="fa fa-repeat"></i> Redo</button>
                    </div>
                    <button type="button" id="save" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
                <div class="mt-5">
                    <button class="btn btn-danger" id="lockAll">Lock Everything</button>
                    <button class="btn btn-success" id="Gridbtn">Create Grids</button>
                    <button class="btn btn-info disabled" id="gridToggle">Bring Grids To Front</button>
                </div>
                <div class=" mt-5 form-check">
                     <label for="GridRT">
                     <input type="checkbox" id="GridRT" class="chkbx form-check-input"  value="Ratio">
                        SnaptoGrid
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mt-20 mb-30">
                <div class="mt-10">
                    <button class="btn btn-danger btn-large" id="remove_reload_background"><i class="fa fa-ban"></i> Remove Background</button>
                </div>
            </div>
            <div class="col-md-8 col-md-offset-1 mt-20 mb-30 bgOpacityContainer">
                <div class="row mt-10">
                    <div class="col-md-3" style="margin-top:-17px">
                        <p>Background Opacity:</p>
                    </div>
                    <div class="col-md-6" style="margin-top:7px">
                        <input id="opacity_range" type="range" min="0" max="100" step="5" value="100"/>
                    </div>    
                    <div class="col-md-3">
                        <form class="form-inline">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="number" class="form-control" id="opacityByNumber" min="0" max="100" step="5" value="100" />
                                    <div class="input-group-addon">%</div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4 col-xs-12 right-col" id="editor-right">
        <ul class="nav nav-tabs editor-tabs" role="tablist" id="editor-mainTabs">
            <li class="active"><a href="#text" role="tab" data-toggle="tab"><i class="fa fa-font"></i>Text</a></li>
            <li><a href="#image" role="tab" data-toggle="tab"><i class="fa fa-picture-o"></i>Image</a></li>
            <li><a href="#color" role="tab" data-toggle="tab"><i class="fa fa-paint-brush"></i>Set Colors</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="text">
                <div class="row pt-10">
                    <div class="col-md-12 col-xs-12">
                        <textarea id="editor-textarea" type="textbox" placeholder="Your Text here..." class="form-control editor-textarea"></textarea>
                    </div>
                </div>
                <div class="row pt-10">
                    <div class="col-md-6 col-xs-12">
                        <div class="row pt-10">
                            <div class="col-md-12 col-xs-12">
                                <!-- <button type="button" classs="btn btn-default" id="editor-sendBack">
                                    <img src="<?php echo base_url('public/admin/img/layered-bottom.png')?>" class="imageIcon">
                                </button> -->
                                <button type="button" class="btn btn-default" id="editor-sendBack">
                                    <img src="<?php echo base_url('public/admin/img/layered-bottom.png')?>" class="imageIcon">
                                </button>
                                <button type="button" class="btn btn-default" id="editor-bringFront">
                                    <img src="<?php echo base_url('public/admin/img/layered-top.png')?>" class="imageIcon">
                                </button>
                                <button class="btn btn-default" id="editor-delete" property ="text" data-type="text" type="button"><span class="glyphicon glyphicon-trash editor-fa"></span></button>
                            </div>
                        </div>
                        <div class="row pt-20">
                            <div class="col-md-12 col-xs-12">
                                <label class="control-label">lock/unlock</label>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <div class="btn-group" role="group" id="editor-lockGroup">
                                    <button id="lock-text" type="button" class="btn btn-default"><i class="fa fa-lock"></i></button>
                                    <button id="unlock-text" type="button" class="btn btn-default btn-primary"><i class="fa fa-unlock"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-20">
                                <div class="col-md-12 col-xs-12"><label class="control-label">Max Font size</label></div>
                                <div class="col-md-12 col-xs-12">
                                    <select class="form-control" id="editor-maxfontSize"style="width:100%;">
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="12">12</option>
                                        <option value="14">14</option>
                                        <option value="16">16</option>
                                        <option value="18">18</option>
                                        <option value="20">20</option>
                                        <option value="22">22</option>
                                        <option value="24">24</option>
                                        <option value="26">26</option>
                                        <option value="28">28</option>
                                        <option value="36">36</option>
                                        <option value="50">50</option>
                                        <option value="72">72</option>
                                    </select>
                                </div>
                            </div>
                            
                            </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="row">
                                    <label class="control-label" for="">Font Size</label>
                                    <!-- <label class="control-label">Font size</label> -->
                                    
                                </div>
                                <div class="row">
                                    <input id="editor-fontSize" class="form-control" type="number" style="width: 94%;" value="16" min="0" max="400">
                                    <!-- <select class="form-control" id="editor-fontSize" style="width:95%;">
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="12">12</option>
                                        <option value="14">14</option>
                                        <option value="16">16</option>
                                        <option value="18">18</option>
                                        <option value="20">20</option>
                                        <option value="22">22</option>
                                        <option value="24">24</option>
                                        <option value="26">26</option>
                                        <option value="28">28</option>
                                        <option value="36">36</option>
                                        <option value="48">48</option>
                                        <option value="72">72</option>
                                    </select> -->
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="row">
                                    <label class="control-label">
                                        Font Family
                                    </label>
                                </div>
                                <div class="row">
                                    <select class="form-control" id="editor-fontFamily" style="font-size:11px; padding: 0px;">
                                        <!-- <option value="Arial">Arial</option>
                                        <option value="Verdana" >Verdana</option>
                                        <option value="Open Sans">Open Sans</option>
                                        <option value="Sans Serif">Sans Serif</option> -->
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-10">
                            <div class="col-md-12 col-xs-12 nopad">
                                <label class="control-label">Alignment</label>
                            </div>
                            <div class="col-md-12 col-xs-12 nopad">
                                <div class="btn-group" role="group" id="editor-textAlign">
                                    <button type="button" class="btn btn-default" data-type="left"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></button>
                                    <button type="button" class="btn btn-default" data-type="center"><span class="glyphicon glyphicon-align-center" aria-hidden="true"></button>
                                    <button type="button" class="btn btn-default" data-type="right"><span class="glyphicon glyphicon-align-right" aria-hidden="true"></button>
                                    <button type="button" class="btn btn-default" data-type="justify"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></button>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-10">
                            <div class="col-md-12 col-xs-12 nopad">
                                <label class="control-label">Style</label>
                            </div>
                            <div class="col-md-12 col-xs-12 nopad">
                                <div class="btn-group" role="group" style="">
                                    <button id="editor-textBold" class="btn btn-default"><span class="glyphicon glyphicon-bold" aria-hidden="true"></button>
                                    <button id="editor-textItalic" class="btn btn-default"><span class="glyphicon glyphicon-italic" aria-hidden="true"></button>
                                    <button id="editor-textUnderline" class="btn btn-default"><i class="fa fa-underline"></i></button>
                                    <button id="editor-textList" class="btn btn-default"><span class="glyphicon glyphicon-list" aria-hidden="true"></button>
            
                                </div>
                            </div>
                        </div>
                        <div class="row pt-10">
                        <br>
                            <div class="col-md-8 col-xs-12 nopad">
                                <label>Color</label>
                                <div class="inline vt">
                                    <a id="text_color_btn" class="btn btn-xs dropdown-toggle clr-pallete-picker" data-toggle="dropdown" style="" aria-expanded="false" disabled="disabled">
                                    </a>
                                    <ul id="text" class="dropdown-menu textpicker clrpicker picker">
                                        <li>
                                            <div class="row">
                                                <div class="col-md-6" >
                                                    <input type="text" class="form-control" id="pickClrByName" placeholder="00000" maxlength="6" />
                                                </div>
                                                <div class="col-md-6" id="show_color">
                                                    <a class="btn btn-xs temp clr_thumbnail_lg btn-color" data-value="#000000"></a>
                                                    <a class="btn btn-xs clr_thumbnail_lg btn-color" data-value="#000000"></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li style="margin-top: 5px;"><div id="editor-font-clr"></div></li>
                                        <li style="margin-top: 5px;">
                                            <div class="text_hover_clr pull-left">
                                                <a class="btn btn-xs clr_thumbnail"></a>
                                                <span>#000000</span>
                                            </div>
    
                                            <div class="text_selected_clr pull-right">
                                                <a class="btn btn-xs clr_thumbnail"></a>
                                                <span>#000000</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 nopad text-right">
                                
                                
                            </div>

                        </div>
                    </div>
                </div>
                 <div class="row pt-20">
                    <div class="col-md-3">
                      <label >Opacity:</label>
                    </div>
                    <div class="col-md-9">
                     <input type="range" id="opacity_range_text" min="0" max="100" step="10">
                    </div>
                  </div>
                  <hr>
                  <div class="row pt-20">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5 col-xs-5"><label class="control-label">Textbox Width</label></div>
                            <div class="col-md-7 col-xs-7">
                                <input type="number" id="textbox_width" value="100" class="form-control"/>
                            </div>
                        </div>
                        <div class="row pt-20">
                            <div class="col-md-5 col-xs-5"><label class="control-label">Textbox Padding</label></div>
                            <div class="col-md-7 col-xs-7">
                                <input type="number" id="textbox_padding" value="0" min="0" class="form-control"/>
                            </div>
                        </div>
                        
                    </div>
                   
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-5 col-xs-5"><label class="control-label">Textbox Height</label></div>
                            <div class="col-md-7 col-xs-7">
                                <input type="number" id="textbox_height" value="100" class="form-control">
                            </div>
                        </div>
                        <div class="row pt-20">
                            <div class="col-md-5 col-xs-5"><label class="control-label">Line Height</label></div>
                            <div class="col-md-7 col-xs-7">
                                <input type="number" id="textbox_lineHeight" value="1" step="0.25" class="form-control"/>
                            </div>
                        </div>
                    </div>
                  </div>

                <ul class="nav nav-tabs small-tabs mt-50" role="tablist" id="editor-infoTabs">
                    <li class="active"><a href="#propertyinfo" role="tab" data-toggle="tab">Property info</a></li>
                    <li><a href="#agent1" role="tab" data-toggle="tab">Agent 1</a></li>
                    <li><a href="#agent2" role="tab" data-toggle="tab">Agent 2</a></li>
                    <li><a href="#company1" role="tab" data-toggle="tab">Company 1</a></li>
                    <li><a href="#company2" role="tab" data-toggle="tab">Company 2</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane pt-20 active" id="propertyinfo">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="mainheader" data-id="">Main Header</button>
                            </div>
                            <div class="col-md-6">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="headline" data-id="">Headline</button>
                            </div>

                        </div>
                        <div class="row mt-5">
                         <div class="col-md-6">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="address" data-id="">Address</button>
                            </div>
                            <div class="col-md-6">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="price" data-id="">Price</button>
                            </div>
                            
                        </div>
                        <div class="row mt-5">

                            <div class="col-md-6">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="body1" data-id="">Body 1</button>
                            </div>
                            <div class="col-md-6">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="body2" data-id="">Body 2</button>
                            </div>
                            
                            
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="body3" data-id="">Body 3</button>
                            </div>
                            <div class="col-md-6">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="calltoaction" data-id="">Call to Action</button>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane pt-20" id="agent1">
                        <div class="row">
                            <div class="col-md-8">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="agent1-contactinfo" data-id="">Agent Contact Info</button>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-8">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="agent1-license" data-id="">License #</button>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane pt-20" id="agent2">
                        <div class="row">
                            <div class="col-md-8">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="agent2-contactinfo" data-id="">Agent Contact Info</button>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-8">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="agent2-license" data-id="">License #</button>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane pt-20" id="company1">
                        <div class="row">
                            <div class="col-md-8">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="company1-contactinfo" data-id="">Company Contact Info</button>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-8">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="company1-license" data-id="">License #</button>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane pt-20" id="company2">
                        <div class="row">
                            <div class="col-md-8">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="company2-contactinfo" data-id="">Company Contact Info</button>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-8">
                                <button class="editor-textAssign btn btn-default fullwidth" data-type="company2-license" data-id="">License #</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="image">
                <!-- <div class="row mt-10">
                    <div class="col-md-12 col-xs-12 text-center">
                        <h4 class="mt-0">Select Image Number To Input</h4>
                    </div>
                </div> -->
                <div class="row mt-10">
                    <div class="col-md-12 col-xs-12">
                        <!-- <button type="file" id="editor-addImage" class="btn btn-primary">Add Image</button><input type="file" id="editor-addImageFile" accept="image/png, image/jpeg, image/jpg" style="display:none;"> -->
                        <fieldset id="zbasic">
                            <legend>Drop a file inside…</legend>
                            <p>Or click here to <em>Browse…</em></p>
                            <!-- <p style="position: relative; z-index: 1">
                                <input id="zbasicm" type="checkbox" checked>
                                <label for="zbasicm">
                                    Allow multiple selection in <em>Browse</em> dialog.
                                </label>
                            </p> -->
                        </fieldset>

                        <div class="progress" style="display: none">
                            <div class="progress-bar progress-bar-info progressing" role="progressbar" style="">
                                
                            </div>
                        </div>                                
                    </div>
                </div>
                <div class="row mt-10">
                        <label>Add Placeholders</label>
                    <div class="editor-placeholderBox col-md-10 col-md-offset-1 col-xs-10">
                        <img class="pHimage" data-value="uploader" src="<?php echo base_url('assets/imgs/placeholderICON.png')?>"/>
                        <img class="pHimage" data-value="agentUploader" src="<?php echo base_url('assets/imgs/userPH_BG.png')?>"/>
                        <img class="pHimage" data-value="companyUploader" src="<?php echo base_url('assets/imgs/companyPH_BG.png')?>"/>
                    </div>
                </div>
                <div class="row mt-20">
                    <div class="col-md-4 mt-5 col-xs-12">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <label class="control-label">lock/unlock</label>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <div class="btn-group">
                                    <button id="lock-img" type="button" class="btn btn-default"><i class="fa fa-lock"></i></button>
                                    <button id="unlock-img" type="button" class="btn btn-default btn-primary"><i class="fa fa-unlock"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="col-md-5 p-5">
                            <div class="form-group">
                                <label for="Editor-imageWidth">Width</label>
                                <input type="number" class="form-control pr-0" id="editor-imageWidth" placeholder="Width">
                            </div>
                        </div>
                        <div class="col-md-5 p-5">
                            <div class="form-group">
                                <label for="Editor-imageHeight">Height</label>
                                <input type="number" class="form-control pr-0" id="editor-imageHeight" placeholder="Height">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-30">
                    <div class="col-md-4 col-xs-12 mt-50">
                        <button type="button" class="btn btn-default" id="editor-sendBack">
                            <img src="<?php echo base_url('public/admin/img/layered-bottom.png') ?>" class="imageIcon">
                        </button>
                        <button type="button" class="btn btn-default" id="editor-bringFront">
                            <img src="<?php echo base_url('public/admin/img/layered-top.png') ?>" class="imageIcon">
                        </button>
                        <button type="button" class="btn btn-default" data-type="image" id="editor-delete">
                            <span class="glyphicon glyphicon-trash editor-fa"></span>
                        </button>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="col-md-5 p-5">
                            <div class="form-group">
                                <label for="Editor-IMGstrokeWidth">Stroke Width</label>
                                <input type="number" class="form-control pr-0" id="editor-IMGstrokeWidth" value="0" min="-5">
                            </div>
                        </div>
                        <div class="col-md-7 p-5">
                            <div class="form-group">
                                <label for="Editor-IMGstrokeColor">Stroke Color</label><br>
                                <div class="inline vt"><a id="img_color_btn" class="btn btn-xs dropdown-toggle clr-pallete-picker" data-toggle="dropdown" style="" aria-expanded="false" disabled="disabled">
                                    </a>
                                    <ul id="img" class="dropdown-menu imgStroke clrpicker picker" style="top:45px">
                                        <li>
                                            <div class="row">
                                                <div class="col-md-6" >
                                                    <input type="text" class="form-control" id="pickClrByName" placeholder="00000" maxlength="6" />
                                                </div>
                                                <div class="col-md-6" id="show_color">
                                                    <a class="btn btn-xs temp clr_thumbnail_lg btn-color" data-value="#000000"></a>
                                                    <a class="btn btn-xs clr_thumbnail_lg btn-color" data-value="#000000"></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li style="margin-top: 5px;"><div id="editor-IMGstrokeColor"></div></li>
                                        <li style="margin-top: 5px;">
                                            <div class="img_hover_clr pull-left">
                                                <a class="btn btn-xs clr_thumbnail"></a>
                                                <span>#000000</span>
                                            </div>
    
                                            <div class="img_selected_clr pull-right">
                                                <a class="btn btn-xs clr_thumbnail"></a>
                                                <span>#000000</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                      <label >Opacity:</label>
                    </div>
                    <div class="col-md-9">
                     <input type="range" id="opacity_range_image" min="0" max="100" step="10">
                    </div>
                  </div>
                <div class="row pt-20 mt-20" style="border-top:1px solid #ccc;">
                    <div class="col-md-12" id="editor-imageList">
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="color">
                <div class="row mt-20 mb-30">
                    <div class="col-md-6 col-xs-12">
                        <div class="row mt-10">
                            <div class="col-md-12 col-xs-12">
                                <button type="button" class="btn btn-default" id="editor-sendBack">
                                    <img src="<?php echo base_url('public/admin/img/layered-bottom.png') ?>" class="imageIcon">
                                </button>
                                <button type="button" class="btn btn-default" id="editor-bringFront">
                                    <img src="<?php echo base_url('public/admin/img/layered-top.png') ?>" class="imageIcon">
                                </button>
                                <button type="button" class="btn btn-default" data-type="color" id="editor-delete">
                                    <span class="glyphicon glyphicon-trash editor-fa"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="col-md-6 p-5">
                            <div class="form-group">
                                <label for="editor-colorWidth">Width</label>
                                <input type="number" class="form-control " id="editor-colorWidth" placeholder="Width">
                            </div>
                        </div>
                        <div class="col-md-6 p-5">
                            <div class="form-group">
                                <label for="editor-colorHeight">Height</label>
                                <input type="number" class="form-control " id="editor-colorHeight" placeholder="Height">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <label class="control-label">lock/unlock</label>
                            </div>
                            <div class="col-md-12 col-xs-12">
                                <div class="btn-group">
                                    <button id="lock-svg" type="button" class="btn btn-default"><i class="fa fa-lock"></i></button>
                                    <button id="unlock-svg" type="button" class="btn btn-default btn-primary"><i class="fa fa-unlock"></i></button>
                                </div>
                            </div>
                </div>
                <div class="row" style="margin-top: 6px;">
                    <div class="col-md-3">
                      <label for="test5b">Opacity:</label>
                    </div>
                    <div class="col-md-9">
                      <input type="range" id="myRange" min="0" max="100" step="10">
                    </div>
                  </div>

                <div class="row mt-10">

                    <div class="col-md-6 col-xs-6">
                        <button type="button" class="btn btn-default" id="editor-renameSet">
                            Rename Set
                        </button>
                        <button type="button" class="btn btn-default" id="editor-deleteSet">
                            Delete Set
                        </button>
                    </div>
                    <div class="col-md-6 col-xs-6 text-right">
                        <button type="button" class="btn btn-default" id="editor-addSets">
                            Add Color Set
                        </button>
                        <button type="button" class="btn btn-default" id="editor-duplicateShape">
                            Duplicate Shape
                        </button>
                    </div>
                </div>
                <div class="row mt-20 editor-objectsBox dno" id="editor-objectsBox">
                    <div class="col-md-12">
                    <?php 
                    if(count($svgs)>0){
                    foreach ($svgs as $svg) {
                        // print_r($svg); ?>

                        <img class="svgImage" id="editor-setsImage" src="<?php echo base_url('uploads/svgs/'.$svg['svgFileUrl'])?>">

                    <?php }}
                    else{ ?>
                        <p>No Shapes Available. Add Some Shapes <a href="<?=base_url('admin_svgs/create')?>">Here</a></p>
                    <?php } ?>
                        <!-- <img class="svgImage" id="editor-setsImage" src="<?php echo base_url('public/admin/img/svg/check56.svg')?>">
                        <img class="svgImage" id="editor-setsImage" src="<?php echo base_url('public/admin/img/svg/circle111.svg')?>">
                        <img class="svgImage" id="editor-setsImage" src="<?php echo base_url('public/admin/img/svg/heart13.svg')?>">
                        <img class="svgImage" id="editor-setsImage" src="<?php echo base_url('public/admin/img/svg/plain.svg')?>">
                        <img class="svgImage" id="editor-setsImage" src="<?php echo base_url('public/admin/img/svg/right11.svg')?>">
                        <img class="svgImage" id="editor-setsImage" src="<?php echo base_url('public/admin/img/svg/square_2.svg')?>">
                        <img class="svgImage" id="editor-setsImage" src="<?php echo base_url('public/admin/img/svg/square61.svg')?>">
                        <img class="svgImage" id="editor-setsImage" src="<?php echo base_url('public/admin/img/svg/star129.svg')?>">
                        <img class="svgImage" id="editor-setsImage" src="<?php echo base_url('public/admin/img/svg/triangle36.svg')?>"> -->
                    </div>
                </div>

                <!-- OLD COLOR SETS 
                <div class="row pt-10">
                    <div class="col-md-12 col-xs-12">
                        <ul class="nav nav-tabs" role="tablist" id="cs-tablist">
                            <li class="active"><a href="#cs-sample1" data-toggle="tab">Sample 1</a></li>
                        </ul>
                        <div class="tab-content" id="cs-tabContent">
                            <div role="tabpanel" class="tab-pane active" id="cs-sample1">
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="row pt-10">
                    <div class="col-md-12 col-xs-12">
                        <ul class="nav nav-tabs" role="tablist" id="cs-tablist">
                            <li class="active"><a href="#cs-sample1" class="cs-sample1" data-toggle="tab">Sample 1</a></li>
                        </ul>
                        <div class="tab-content" id="cs-tabContent">
                            <div role="tabpanel" class="tab-pane active" id="cs-sample1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>