<script src="<?php echo $js_create_package ?>" language="javascript" type="text/javascript"></script>

<h1 class="heading-sty-1">Add <?php echo PACKAGES; ?></h1>

<form onsubmit="return CreatePackageFormSubmit();" class="navbar-form form-sty-1 m-0" action="<?php print $sFormAction; ?>" method="post" id="create-package-form">
    <div id="pkg_add_top" class="c-box">

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group form-group-default">
                    <label class="title">Title:</label>
                    <div class="controls">
                        <input required name="package[title]" type="text" class="form-control" placeholder="Name">
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group form-group-default">
                    <label class="description">Description:</label>
                    <div class="controls">
                        <textarea required rows="6" cols="80" name="package[description]"class="form-control" placeholder="Add some package details..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-6">
                <div class="form-group form-group-default">
                    <label class="price">Price:</label>
                    <div class="controls">
                        <input required data-a-sign="$ " name="package[price]" type="text" class="form-control autonumeric" placeholder="US Dollar">
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="1" name="package[status]"/>
        <div class="row">
            <!--<div class="col-lg-1 col-md-3">
                <div class="form-group form-group-default form-group-default-select2">
                    <label class="status">Status:</label>
                   <select required name="package[status]" class="full-width select--no-search" data-init-plugin="select2">
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>

                </div>
            </div>-->

            <div class="col-lg-2 col-md-4">
                <div class="form-group form-group-default form-group-default-select2">
                    <label class="status">Package belongs to:</label>
                    <select onchange="return IfWhiteLabelSelected(this);" required  name="package[type]" class="full-width select--no-search pkg_belongs_to" data-init-plugin="select2">
                        <option value="">-- Select --</option>
                        <option value="WhiteLabel">White Label User</option>
                        <option value="Subscriber">Subscriber</option>
                    </select>
                </div>

            </div>

        </div>

        <div class="row">
            <div class="whitelabel_drpdown" style="display: none;"></div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="modules">Add Modules:</label>
                    <div class="controls">
                        
                        <?php

                        if($aModules)
                        {
                            $iTotalModules = count($aModules);

                            for($m=0; $m < $iTotalModules; $m++)
                            {
                                $iModuleId      = $aModules[$m]['module_id'];
                                $sModuleName    = $aModules[$m]['title'];

                                ?>
                                <div class="checkbox ">
                                    <input  id="checkbox<?php echo $m; ?>" type="checkbox" name="modules[]" value="<?php echo $iModuleId?>" />
                                    <label for="checkbox<?php echo $m; ?>"><?php echo $sModuleName?></label>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row m-b-20" id="pkg_products_added_list">
            <div class="col-md-12">
                <h4 class="m-t-0">Products</h4>
                <ul class="list-sty-2 has-same-height" id="final_products">
                    <!-- <li>
                        <a href="#" class="remove fa"></a>
                        <div style="background-image: url(&quot;http://lorempixel.com/300/200&quot;);" class="img cover-img" data-img="http://lorempixel.com/300/200">
                            <a class="fa img-preview magnific-popup" href="http://lorempixel.com/600/400"></a>
                        </div>
                        <div class="title">
                            <h4>Vertical Business Card</h4>
                        </div>
                        <p>When it comes to digital design, the lines between functionality, aesthetics, and psychology are inseparably blurred.</p>
                        <ul class="details">
                            <li>
                                <div class="field">
                                    specs
                                </div>
                                <div class="value">One Sided</div>
                                <div class="value">3.5x2 inches CMYK</div>
                            </li>
                            <li>
                                <div class="field">
                                    cut off period
                                </div>
                                <div class="value">
                                    3 Days
                                </div>
                            </li>
                        </ul>
                    </li> -->
                    <li class="add h-440">
                        <a href="javascript:void(0);" class="addMore" onclick="javascript:add_product(this);">
                            <i class="fa"></i>
                        </a>
                    </li>
                  </ul>
            </div>
        </div>

    </div>

    <br>

    <div role="alert" class="alert alert-danger error_msg hide"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="text-right m-t-0 m-b-20">
                <input type="submit" class="create_pkg btn btn-success m-btn-full" value="CREATE PACKAGE" name="btnSubmit">
            </div>
        </div>
    </div>

</form>

<br>
    
<div id="parent_products">

    <div id="pkg_add_product" class="pkg_add_product hide">

        <div class="t-layout m-t-layout-off">
            <div class="t-row">
                <div class="t-col t-col--mid">
                    <h2 class="heading-sty-2" id="add-products">Select Products</h2>
                </div>
                <div class="t-col text-right t-col--mid m-text-left m-m-b-20">
                    <!-- <a href="#" class="btn btn-complete m-hide">Add to Package</a> -->
                </div>
            </div>
        </div>

        <div class="c-box">
            <div class="row">
                <div class="col-lg-12">
                        <div class="panel panel-transparent">
                          <ul class="nav nav-tabs nav-tabs-simple nav-tabs-left bg-white" id="tab-3">
                            <?php
                            $iProducts = 0;
                            foreach ($aProducts as $data): ?>
                                <li class="<?php if ($iProducts==0){ echo 'active'; $iProducts++; } ?>">
                                    <a data-toggle="tab" data-val="<?php echo $data->product_id; ?>" href="#template-tab-<?php echo $data->product_id; ?>" onclick="return ajax_get_templates_by_product_id(this);"><?php echo $data->title; ?></a>
                                </li>
                            <?php endforeach; ?>
                          </ul>
                          <div class="tab-content bg-white">
                            <!-- Umair Code -->

                            <?php 
                            $iProducts = 0;
                            foreach ($aProducts as $data):                                
                            ?>
                                <div class="tab-pane <?php if ($iProducts==0){ echo 'active'; $iProducts++; } ?>" id="template-tab-<?php echo $data->product_id; ?>"></div>
                            <?php endforeach; ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    ajax_get_templates_by_product_id($('#tab-3 li:first-child > a'));
                                });
                            </script>
                            <br>

                            <div id="select-products_action" class="hide">
                                <a href="javascript:void(0)" onclick="javascript: add_product_to_packg();" class="btn btn-success">Add Products</a>
                                <a href="javascript:void(0)" onclick="javascript: cancel_adding_product();" class="btn">Cancel</a>
                            </div>
                          </div>
                        </div>

                        <!-- / Template -->
                        <!-- <div class="form-group form-group-default form-group-default-select2">
                            <label class="status">Package belongs to:</label>
                            <select onchange="return ajax_get_templates_by_product_id(this);" id="products" name="sample_products[]" class="selecter_1 product_tmp_select full-width select--no-search" data-init-plugin="select2">
                                <option value="0">-- Select --</option>
                                <?php foreach ($aProducts as $data): ?>
                                    <option value="<?php echo $data->product_id; ?>"><?php echo $data->title; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> -->

                </div>
            </div>
        </div>

    </div>

</div>




<!-- ========================= -->
<!-- Package Summary -->
<!-- ========================= -->

<!-- <h1 class="heading-sty-1">Package Summary</h1>

<div class="c-box">
    <div class="row">
        <div class="col-md-12">
            <h4>Xyz Package</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
            <hr>
            <ul class="list-sty-4">
                <li>
                    <strong>Price</strong>
                    <span>$250</span>
                </li>
                <li>
                    <strong>Status</strong>
                    <span>Inactive</span>
                </li>
                <li>
                    <strong>Package Belongs To</strong>
                    <span>Xyz</span>
                </li>
            </ul>
            <hr>
            <div class="form-group">
                <label>Modules</label>
                <span class="tag label">CRM</span>
                <span class="tag label">Xyz Module</span>
            </div>
            
            <hr>

            <h4 class="">Products</h4>

            <ul class="list-sty-2">
                <li>
                    <div data-img="http://lorempixel.com/300/200" class="img cover-img" style="background-image: url(&quot;http://lorempixel.com/300/200&quot;);">
                        <a href="http://lorempixel.com/600/400" class="fa img-preview magnific-popup"></a>
                    </div>
                    <div class="title">
                        <h4>Vertical Business Card</h4>
                    </div>
                    <p>When it comes to digital design, the lines between functionality, aesthetics, and psychology are inseparably blurred.</p>
                    <ul class="details">
                        <li>
                            <div class="field">
                                specs
                            </div>
                            <div class="value">One Sided</div>
                            <div class="value">3.5x2 inches CMYK</div>
                        </li>
                        <li>
                            <div class="field">
                                cut off period
                            </div>
                            <div class="value">
                                3 Days
                            </div>
                        </li>
                    </ul>
                </li>
                <li>
                    <div data-img="http://lorempixel.com/300/200" class="img cover-img" style="background-image: url(&quot;http://lorempixel.com/300/200&quot;);">
                        <a href="http://lorempixel.com/600/400" class="fa img-preview magnific-popup"></a>
                    </div>
                    <div class="title">
                        <h4>Vertical Business Card</h4>
                    </div>
                    <p>When it comes to digital design, the lines between functionality, aesthetics, and psychology are inseparably blurred.</p>
                    <ul class="details">
                        <li>
                            <div class="field">
                                specs
                            </div>
                            <div class="value">One Sided</div>
                            <div class="value">3.5x2 inches CMYK</div>
                        </li>
                    </ul>
                </li>
              </ul>
        </div>
    </div>
</div> -->