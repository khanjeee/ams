<?php
/**
 * Created by PhpStorm.
 * User: Umair Ahmed
 * Date: 1/2/15
 * Time: 1:10 PM
 */
?>

<!-- <div class="template-info product_id_<?php echo $product_id; ?>">

    <?php

    if($aTemplates)
    {

        ?>


        <p>
            <a class="close-template-info" onclick="return removeProduct('product_id_<?php echo $product_id; ?>','<?php echo $product_id; ?>','<?php echo $product_name; ?>')">Cancel</a>
        </p>

        <p class="select_box">Select
            <a onclick="return selectAll('all','prod-template-<?php echo $product_id;?>');"><?php echo 'All'; ?></a> |
            <a onclick="return selectAll('none','prod-template-<?php echo $product_id;?>');"> <?php  echo 'None'; ?></a>
        </p>


        <h3><?php echo $product_name; ?></h3>

        <?php

        $iTotalTemplates = count($aTemplates);

        for($t=0; $t < $iTotalTemplates; $t++)
        {
            $aTemplate          = (object) $aTemplates[$t];

            ?>

            <div class="template-container">
                <div> <input onclick="return setCheckBox(this);" type="checkbox" class="prod-template-<?php echo $product_id;?> select_templates" name="templates[<?php echo $product_id; ?>][]" value="<?php echo $aTemplate->template_id; ?>" /> <strong><?php echo $aTemplate->title; ?></strong></div>
                <div><?php echo $aTemplate->description; ?></div>
                <div>Printing Price = <?php echo $aTemplate->printing_price; ?>$</div>
            </div>



            <?php
        }

     ?>

            <input type="hidden" name="products[]" value="<?php echo $product_id; ?>">
            <a class="add_product_to_packg" onclick="javascript:saveProduct('product_id_<?php echo $product_id; ?>','<?php echo $product_id; ?>');"> Add to <?php echo PACKAGES; ?></a>
        </div>


    <?php
    }
    else
    {
        ?>
                <div class="template-container">No template for this product.</div>
        <?php
    }
?> -->


<div class="row column-seperation">
    <div class="col-md-12 select-products">
        
        <?php

            if($aTemplates)
            {

        ?>
        
        <ul class="list-sty-2" id="product-ul-id-<?php echo $product_id; ?>">

        <?php

        $iTotalTemplates = count($aTemplates);

        for($t=0; $t < $iTotalTemplates; $t++)
        {
            $aTemplate = (object) $aTemplates[$t];

        ?>

            <li id="product-id-<?php echo $aTemplate->template_id; ?>" data-product-id="<?php echo $product_id; ?>">
                
                <a href="javascript:void(0)" onclick="javascript: remove_product_from_packg(this);" class="remove fa" data-target="<?php echo $aTemplate->template_id; ?>"></a>

                <div data-img="<?php echo site_url('assets/img/front.png'); ?>" class="img cover-img" style="background-image: url(<?php echo site_url('assets/img/front.png'); ?>);">
                    <a href="<?php echo site_url('assets/img/back.png'); ?>" class="fa img-preview magnific-popup-<?php echo $aTemplate->template_id;?>"></a>
                </div>
                
                <div class="select">
                    <input onclick="return setCheckBox(this);" id="template_checkbox_<?php echo $aTemplate->template_id; ?>" type="checkbox" class="prod-template-<?php echo $product_id;?> select_templates" name="templates[<?php echo $product_id; ?>][]" value="<?php echo $aTemplate->template_id; ?>"/>
                    <label for="template_checkbox_<?php echo $aTemplate->template_id; ?>">
                        <span class="btn" >+</span>
                        <span class="btn btn-complete" >+</span>
                    </label>
                </div>

                <div class="title">
                    <h4><?php echo $aTemplate->title; ?></h4>                
                </div>

                <p><?php echo $aTemplate->description; ?></p>
                
                <ul class="details">
                    <li class="details__printing-price">
                        <div class="field">
                            Printing Price
                        </div>
                        <div class="value">$<?php echo $aTemplate->printing_price; ?></div>
                    </li>
                </ul>               
                <input type="hidden" name="products[]" value="<?php echo $product_id; ?>" id="product_active_<?php echo $product_id; ?>" class="product_active">
            </li>

        <?php
        
        }

        ?>
        
        </ul>
        
        <!-- <a class="add_product_to_packg" onclick="javascript:saveProduct('product_id_<?php echo $product_id; ?>','<?php echo $product_id; ?>');"> Add to <?php echo PACKAGES; ?></a> -->

        <?php 
            }
            else
            {
        ?>
        <p class="no-data">No template for this product.</p>

        <?php
            }
        ?>
    </div>
</div>