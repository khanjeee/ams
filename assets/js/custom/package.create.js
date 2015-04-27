/*@Description:Custom javascript */
$(document).ready(function () {
    $('#tab-3 a').click(function () {
        $('#select-products_action').removeClass('hide');
    });
});

function add_product(element)
{
    jQuery('#pkg_add_product').removeClass('hide');
    
    $('html, body').animate({
        scrollTop: $("#pkg_add_product").offset().top-60
    }, 1000);
    
    return false;
}
function add_product_to_packg(element)
{
    $('.select-products input:checked').each(function (id) {
        id = $(this).attr('value');
        console.log(id);
        $('.select-products #product-id-'+id).prependTo('#final_products');

        //===========================================
        // Editing Printing Price
        //===========================================
        //Clone Printing Price
        $('#final_products #product-id-'+id+' .details__printing-price').clone().insertAfter($('#final_products #product-id-'+id+' .details__printing-price')).addClass('editable');
        //Hide actual printing price
        $('#final_products #product-id-'+id+' .details__printing-price:not(.editable)').addClass("hide");
        //Adding editing icon.
        $('#final_products #product-id-'+id+' .details__printing-price.editable .value').after('<a href="#" class="fa fa-pencil printing-price__edit"></a>');
        //Adding textfield with cancel & done button.
        var printingPrice = $('#final_products #product-id-'+id+' .details__printing-price .value').html().substring(1);
        $('#final_products #product-id-'+id+' .details__printing-price.editable .value').after('<div class="form-group form-group-default">'+
                                                                                                            '<label class="printing_price_'+id+'">PRINTING PRICE</label>'+
                                                                                                            '<div class="controls">'+
                                                                                                                '<input value="'+printingPrice+'" data-a-sign="$ " placeholder="US Dollar" type="text" placeholder="Printing Price" class="form-control" id="printing_price_'+id+'" onkeypress="return event.keyCode != 13;">'+
                                                                                                            '</div>'+
                                                                                                      '</div>'+
                                                                                                      '<a href="#" class="btn btn-danger printing_price_cancel" data-target="'+id+'">Cancel</a> '+
                                                                                                      '<a href="#" class="btn btn-complete printing_price_done" data-target="'+id+'">Done</a>'+
                                                                                                      '<input name="data[printing_price_'+id+']" value="'+printingPrice+'" data-a-sign="$ " type="text" placeholder="Printing Price" class="hide" id="printing_price_'+id+'_final" onkeypress="return event.keyCode != 13;">');
        //Adding functionality to Cancel button.
        $('#final_products #product-id-'+id+' .details__printing-price.editable .printing_price_cancel').on('click', function(e) {
            e.preventDefault();
            $('#final_products #product-id-'+id+' .details__printing-price.editable').removeClass('show-edit');
            sameHeight();
        });

        //Adding functionality to Done button.
        $('#final_products #product-id-'+id+' .details__printing-price.editable .printing_price_done').on('click', function(e) {
            e.preventDefault();
            var newPrintingPrice = $('#final_products #product-id-'+id+' .details__printing-price.editable #printing_price_'+id).val();
            $('#printing_price_'+id+'_final').val(newPrintingPrice);
            newPrintingPrice = '$'+newPrintingPrice;
            $('#final_products #product-id-'+id+' .details__printing-price.editable').removeClass('show-edit');
            $('#final_products #product-id-'+id+' .details__printing-price.editable .value').html(newPrintingPrice);            
            sameHeight();
        });

        //On clicking edit icon show/hide textfield.
        $('#final_products #product-id-'+id+' .details__printing-price.editable .printing-price__edit').on('click', function(e) {
            e.preventDefault();
            $('#final_products #product-id-'+id+' .details__printing-price.editable').addClass('show-edit');
            sameHeight();
        });

        //===========================================
        // END - Editing Printing Price
        //===========================================

    });
    
    $('html, body').animate({
        scrollTop: $('#pkg_products_added_list').offset().top-60
    }, 1000, function () {
        jQuery('#pkg_add_product').addClass('hide');
    });

    sameHeight();

    //Adding a message if all the template were selected.
    $('.tab-pane .list-sty-2').each(function () {
        if(!$('li', this).length && !$('.all-template-added-msg', this).length){
            if(!$(this).next().hasClass('all-template-added-msg')){
                $(this).after('<p class="m-t-20 all-template-added-msg">All templates of this product are already added.</p>');
            }
       } 
    });
}
function remove_product_from_packg(closeBtn){

    var targetId = $(closeBtn).attr('data-target');
    var productId = $('#pkg_products_added_list #product-id-'+targetId).attr('data-product-id');

    //Removing the printing price edit feature.
    $('#final_products #product-id-'+targetId+' .details__printing-price.editable').remove();
    $('#final_products #product-id-'+targetId+' .details__printing-price.editable').removeClass('show-edit');
    $('#final_products #product-id-'+targetId+' .details__printing-price:not(.editable)').removeClass("hide");
    $('#printing_price_'+targetId+'_final').remove();

    $('#pkg_products_added_list #product-id-'+targetId).prependTo('#product-ul-id-'+productId);

    $('#product-id-'+targetId+' input[type="checkbox"]').prop('checked', false);

    //Removing the message "all template selected" message was there.
    if($('#product-ul-id-'+productId).next().hasClass('all-template-added-msg')){
        $('#product-ul-id-'+productId).next().remove();
    }
}
function cancel_adding_product(){
    $('html, body').animate({
        scrollTop: $('#pkg_products_added_list').offset().top-60
    }, 1000, function () {
        jQuery('#pkg_add_product').addClass('hide');
    });
}

function ajax_get_templates_by_product_id(element)
{
    if(jQuery('#template-tab-'+$(element).attr('data-val')).is(':empty')){
        jQuery.ajax
        ({
            type    :   'POST',
            url     :   getBaseUrl()+'ajax/product/',
            data    :   { call_from:'createPackage', product_id: $(element).attr('data-val'), method: 'getTemplatesByProductId',product_name:jQuery("#products option[value='"+element.value+"']").text()},
            success :   function(response)
            {
                jQuery('#template-tab-'+$(element).attr('data-val')).html("");
                jQuery('#template-tab-'+$(element).attr('data-val')).html(response);
                if($('#select-products_action').hasClass('hide')){ $('#select-products_action').removeClass('hide'); };
            },
            error   :   function()          {jQuery('.error_msg').text("Oops! Some thing went wrong");}
        });
    }
    return false;
}

function removeProduct(ProductClass,Id,Name)
{
    var exists = false;
    $('#products').each(function()
    {
        if (this.value == Id)
        {
            exists = true;
        }
    });

    if(!exists)
    {
        $('#products').append($("<option></option>").attr("value",Id).text(Name));
        sortDropDownListByText('products');
    }

    if(!jQuery('#final_products').html()) { jQuery('.create_pkg').hide();}
    jQuery('.'+ProductClass).remove();

    return false;
};


function saveProduct(ProductClass,Id)
{
    if (jQuery('.prod-template-'+Id+':checked').length == 0)
    {
        jQuery('.error_msg').text("Please select a template");
    }
    else
    {
        jQuery('.select_templates').attr('disabled',true);
        jQuery("#products option[value='"+Id+"']").each(function()   {jQuery(this).remove();});
        jQuery('#final_products').append(jQuery(jQuery('#parent_products').html()));
        jQuery('#parent_products').html("");
        jQuery('.'+ProductClass).css('background','grey');
        jQuery('.select_box').hide();
        jQuery('.add_product_to_packg').hide();
        jQuery('#products').hide();
        jQuery('.error_msg').text("");
        jQuery('.addMore').show();
        jQuery('.create_pkg').show();
    }

    return false;
};



function setCheckBox(checkBox)
{
    if      ( jQuery(checkBox).is(":checked"))          {   jQuery(jQuery(checkBox)).attr('checked','checked');    }
    else                                                {   jQuery(jQuery(checkBox)).removeAttr('checked');        }
}


function CreatePackageFormSubmit()
{

    if (jQuery('#final_products input:checked').length != 0){
        var products=[];
        jQuery('#final_products .product_active').each(function () {
            /*if (jQuery('input:checked', this).length == 0){
                jQuery('.product_active', this).remove();
            }*/
            var thisValue = $(this).attr('value');
            if(! jQuery.inArray( thisValue , products )){
                $(this).remove();
            }else{
                products.push(thisValue);
            }
            
        });
        return true;
    }else{
        jQuery('.error_msg').text("Please add atleast one product");
        jQuery('.error_msg').removeClass("hide");
        return false;
    }
    /*if(jQuery('#final_products').html())
    {
        jQuery('#final_products').find('input,select').attr("disabled", false); //enabling all disabled fields to be posted correctly
        return true;
    }
    else
    {
        jQuery('.error_msg').text("Please add atleast one product");
        return false;
    }*/
}


function IfWhiteLabelSelected(e)
{
    var SelectedValue = $(e).val();

        if(SelectedValue == "WhiteLabel")
        {
            jQuery.ajax
            ({
                type    :   'POST',
                url     :   getBaseUrl()+'ajax/package/',
                data    :   { call_from:'createPackage',method: 'ajax_get_white_labels'},
                success :   function(html)
                {
                    jQuery(".whitelabel_drpdown").html(html);jQuery(".whitelabel_drpdown").show();

                    $('select.select--no-search').select2({
                        minimumResultsForSearch: -1
                    });
                },
                error   :   function()          {jQuery('.error_msg').text("Oops! Some thing went wrong.");}
            });
        }
        else
        {
            jQuery(".whitelabel_drpdown").html("");
            jQuery(".whitelabel_drpdown").hide();
        }
    return false;
}




    
    