/*-----------------------------------------------------------------------------------

  Template Name: Metro admin HTML5 Template.
  Template URI: #
  Description: Metro is a unique website template designed in HTML with a simple & beautiful look. There is an excellent solution for creating clean, wonderful and trending material design corporate, corporate any other purposes websites.
  Author: Offpacks
  Author URI: https://www.offpacks.com
  Version: 1.1

-----------------------------------------------------------------------------------*/

/*-------------------------------
[  Table of contents  ]
---------------------------------

  01. RFQ 
  02. Product provide CRUD
  03. Product CRUD

/*--------------------------------
[ End table content ]
-----------------------------------*/




// passes csrf token to every ajax htttp request
// =============
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


//##.payment acknowledgement

$(document).on('click','.payment-acknowledgement-status', function() {
    $('#payment-acknowledgement').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Delivery Acknowledgement status (prodyct received or not)');
    $('#payment_order_id').val($(this).data('order_id'));
});

$("#payment_acknowledgement_status-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: '/payment-acknowledgement-status',
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data);
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.payment_acknowledgement_status === 'undefined') {
                    $('.payment_acknowledgement_status').addClass('hidden');
                }
                $('.payment_acknowledgement_status').text(data.errors.price);
                
            } else {
                
                $('.error').addClass('hidden');
                $('#payment_acknowledgement').modal('hide');
                location.reload();
            }
        },
    });
});

/*-------------------------------
[  01. delivery  start ]
---------------------------------*/


// -- quotation submit for rfq --
$(document).on('click','.delivery-status', function() {
    $('#delivery').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Price quotation For this RFQ');
    $('#order_id').val($(this).data('order_id'));
    $('#vendor_id').val($(this).data('vendor_id'));

});

$("#delivery_status-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'vendor-delivery-status',
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data);
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.delivery_status === 'undefined') {
                    $('.delivery_status').addClass('hidden');
                }
                $('.delivery_status').text(data.errors.price);
                
            } else {
                
                $('.error').addClass('hidden');

                $('#delivery').modal('hide');
                location.reload();
            }
        },
    });
});

// Show function
$(document).on('click', '.show-quotation', function(e) {
    e.preventDefault();
    $('#show-quotation').modal('show');
    $('#quotationId').val($(this).data('id'));
    $('#sprice').val($(this).data('price')+' ৳');
    $('#sdelivery_day').val($(this).data('delivery_day'));

    $('.modal-title').text('Show Quotation');
});



/*-------------------------------
[  01. RFQ start ]
---------------------------------*/


// -- quotation submit for rfq --
$(document).on('click','.rfq-quote', function() {
    $('#quotation').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Price quotation For this RFQ');
    $('#ondemand_id').val($(this).data('id'));
});

$("#quotation-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'quotation/' + $('#ondemand_id').val(),
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data);
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.price === 'undefined') {
                    $('.price').addClass('hidden');
                }
                $('.price').text(data.errors.price);

                if (typeof data.errors.delivery_date === 'undefined') {
                    $('.delivery_day').addClass('hidden');
                }
                $('.delivery_day').text(data.errors.delivery_day);


                $('.already_submited').text(data.errors);
                
            } else {
                
                $('.error').addClass('hidden');

                $('#quotation').modal('hide');
                location.reload();
            }
        },
    });
});

// Show function
$(document).on('click', '.show-quotation', function(e) {
    e.preventDefault();
    $('#show-quotation').modal('show');
    $('#quotationId').val($(this).data('id'));
    $('#sprice').val($(this).data('price')+' ৳');
    $('#sdelivery_day').val($(this).data('delivery_day'));

    $('.modal-title').text('Show Quotation');
});

// Show function
$(document).on('click', '.show-rfq', function(e) {
    e.preventDefault();
    $('#show').modal('show');
    $('#i').val($(this).data('id'));
    $('#sname').val($(this).data('product'));
    $('#ct').val($(this).data('category'));
    $('#img').attr('src', 'storage/images/ondemand/' + $(this).data('image'));
    $('#sunit').val($(this).data('unit'));
    $('#sqty').val($(this).data('qty'));

    $('#details').html($(this).data('product_details'));
    $('.modal-title').text('Show RFQ');
});


/*--------------------------------
[ 01. RFQ end ]
-----------------------------------*/

//product provide
// Retrieve subcategories from category dynamically using ajax & jquery
$(document).ready(function() {
    $('#category_id').change(function() {
        $.ajax({
            type:"GET",
            url:"getSubCat/"+$('#category_id').val(),
            success : function(results) {
                $("#subcategory_id").html(results);
            }
        });
    });
});

// Retrieve minicategories from subcategory dynamically using ajax & jquery
$(document).ready(function() {
    $('#subcategory_id').change(function() {
        $.ajax({
            type:"GET",
            url:"getMiniCat/"+$('#subcategory_id').val(),
            success : function(results) {
                $("#minicategory_id").html(results);
            }
        });
    });
});

// Retrieve subcategories from category dynamically using ajax & jquery
$(document).ready(function() {
    $('#ecategory_id').change(function() {
        $.ajax({
            type:"GET",
            url:"getSubCat/"+$('#ecategory_id').val(),
            success : function(results) {
                $("#esubcategory_id").html(results);
            }
        });
    });
});

// Retrieve minicategories from subcategory dynamically using ajax & jquery
$(document).ready(function() {
    $('#esubcategory_id').change(function() {
        $.ajax({
            type:"GET",
            url:"getMiniCat/"+$('#esubcategory_id').val(),
            success : function(results) {
                $("#eminicategory_id").html(results);
            }
        });
    });
});

// Retrieve minicategories from subcategory dynamically using ajax & jquery
$(document).ready(function() {
    $('#minicategory_id').change(function() {
        $.ajax({
            type:"GET",
            url:"/getTab/"+$('#minicategory_id').val(),
            success : function(results) {
                $("#tab_id").html(results);
            }
        });
    });
});

$(document).ready(function() {
    $('#eminicategory_id').change(function() {
        $.ajax({
            type:"GET",
            url:"/getTab/"+$('#eminicategory_id').val(),
            success : function(results) {
                $("#etab_id").html(results);
            }
        });
    });
});




/*-------------------------------------------
02. Product provide CRUD
--------------------------------------------- */


// -- ajax Form Add Product--
$(document).on('click','.addProductProvide', function(e) {
    e.preventDefault();
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add which type of product you want to provide');
});
$("#product_provide-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'product-provide-store',
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.category_id === 'undefined') {
                    $('.category_id').addClass('hidden');
                }
                $('.category_id').text(data.errors.category_id);
                
            } else {
                
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='productProvide" + data.id + "'>"+
                    "<td>" + data.id + "</td>"+
                    "<td>" + $('#category_id >option:selected').text() + "</td>"+
                    "<td>" + $('#subcategory_id >option:selected').text() + "</td>"+
                    "<td>" + $('#minicategory_id >option:selected').text() + "</td>"+
                    "</tr>");
                    $('#product_provide-form').trigger("reset");
            }
        },
    });
});

// function Edit Product
$(document).on('click', '.edit-productProvide', function(e) {
    e.preventDefault();
    $('#updateProductProvide').trigger("reset");

    $('#ID').val($(this).data('id'));


    // Set all selected elements to false
    $("option:selected").prop("selected", false);

    // Get the category_id
    var  category_id = $(this).data('category_id');
    // Loop over each select option
    $("#ecategory_id > option").each(function(){
        // Check for the matching category
        if ($(this).val() == category_id){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the subcategory
    $("#esubcategory_id").html("<option value='" + $(this).data('subcategory_id') + "'>" + $(this).data('subcategory') + "</option>");

    // Get the minicategory
    $("#eminicategory_id").html("<option value='" + $(this).data('minicategory_id') + "'>" + $(this).data('minicategory') + "</option>");

    $('.modal-title').text('Edit which type of product you want to provide');
    $('.form-horizontal').show();
    $('#update').modal('show');
});

$('#updateProductProvide').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_method', 'PUT');
    $.ajax({
        type: 'POST',
        url: 'product-provide-update/' + $('#ID').val(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.ecategory_id === 'undefined') {
                    $('.eproductName').addClass('hidden');
                }
                $('.ecategory_id').text(data.errors.ecategory_id);
                    
            } else {
                                
                $('#productProvide' + data.id).replaceWith(" " +
                    "<tr id='productProvide" + data.id + "'>" +
                    "<td>" + data.id + "</td>" +
                    "<td>" + $('#ecategory_id >option:selected').text() + "</td>" +
                    "<td>" + $('#esubcategory_id >option:selected').text() + "</td>" +
                    "<td>" + $('#eminicategory_id >option:selected').text() + "</td>" +
                    "</tr>");
            }
        }
    });
});


// form Delete function
$(document).on('click', '.delete-productProvide', function(e) {
    e.preventDefault();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteProductProvide');
    $('.modal-title').text('Delete content');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteProductProvide', function(){
    $.ajax({
        type: 'POST',
        url: 'product-provide-delete/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(){
            $('#productProvide' + $('.id').text()).remove();
        }
    });
});

/*-------------------------------------------
03. Product CRUD start
--------------------------------------------- */


// -- ajax Form Add Product--
$(document).on('click','.addVendorProduct', function(e) {
    e.preventDefault();
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Product');
});
$("#product-form").submit(function(event) {
    // update CKEDITOR element
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'vendors-products',
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.productName === 'undefined') {
                    $('.productName').addClass('hidden');
                }
                $('.productName').text(data.errors.productName);
                if (typeof data.errors.sku === 'undefined') {
                    $('.sku').addClass('hidden');
                }
                $('.sku').text(data.errors.sku);
                if (typeof data.errors.regularPrice === 'undefined') {
                    $('.regularPrice').addClass('hidden');
                }
                $('.regularPrice').text(data.errors.regularPrice);
               
                if (typeof data.errors.image1 === 'undefined') {
                    $('.image1').addClass('hidden');
                }
                $('.image1').text(data.errors.image1);
                if (typeof data.errors.image2 === 'undefined') {
                    $('.image2').addClass('hidden');
                }
                $('.image2').text(data.errors.image2);
                if (typeof data.errors.image3 === 'undefined') {
                    $('.image3').addClass('hidden');
                }
                $('.image3').text(data.errors.image3);
                if (typeof data.errors.image4 === 'undefined') {
                    $('.image4').addClass('hidden');
                }
                $('.image4').text(data.errors.image4);
                if (typeof data.errors.image5 === 'undefined') {
                    $('.image5').addClass('hidden');
                }
                $('.image5').text(data.errors.image5);
                if (typeof data.errors.description === 'undefined') {
                    $('.description').addClass('hidden');
                }
                $('.description').text(data.errors.description);
                if (typeof data.errors.shortDescription === 'undefined') {
                    $('.shortDescription').addClass('hidden');
                }
                $('.shortDescription').text(data.errors.shortDescription);
            } else {
                var colors, color_ids, sizes, size_ids, tags, tag_ids;
                colors = color_ids = sizes = size_ids = tags = tag_ids  = "";
                $.each(data.colors, function (index,value) {
                    colors += value.color+" ";
                    color_ids += value.id+" ";
                });
                $.each(data.sizes, function (index,value) {
                    sizes += value.size+" ";
                    size_ids += value.id+" ";
                });
                $.each(data.tags, function (index,value) {
                    tags += value.tag+" ";
                    tag_ids += value.id+" ";
                });
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='product" + data.product.id + "'>"+
                    "<td>" + data.product.productName + "</td>"+
                    "<td><img src='storage/images/product/" + data.image.image1 + "' height='100px' width='100px'></td>"+
                    "<td>" + data.product.sku + "</td>"+
                    "<td>" + $('#category_id >option:selected').text() + "</td>"+
                    "<td>" + $('#subcategory_id >option:selected').text() + "</td>"+
                    "<td>" + $('#minicategory_id >option:selected').text() + "</td>"+
                    "<td>" + $('#brand_id >option:selected').text() + "</td>"+
                    "<td>৳ " + data.product.regularPrice + "</td>"+
                    "<td><a class='show-product btn btn-info btn-sm' data-id='" + data.product.id + "' data-productName='" + data.product.productName + "' data-image='" + data.image.image1 + "' data-sku='" + data.product.sku + "' data-category='" + $('#category_id >option:selected').text() + "' data-subcategory='" + $('#subcategory_id >option:selected').text() + "' data-minicategory='" + $('#minicategory_id >option:selected').text() + "' data-tab='" + $('#tab_id >option:selected').text() + "' data-industry='" + $('#industry_id >option:selected').text() +"' data-regularPrice='" + data.product.regularPrice + "' data-description='" + data.product.description + "' data-specification='" + data.product.specification + "' data-color='" + colors + "' data-size='" + sizes + "' data-tag='" + tags + "' data-type='" + $('#type >option:selected').text() + "' data-payment='" + $('#paymentOption >option:selected').text() + "' data-availability='" + $('#availability >option:selected').text() + "' data-deal_id='" + $('#deal_id >option:selected').text() + "'><span class='fa fa-eye'></span></a><a class='edit-product btn btn-warning btn-sm' data-id='" + data.product.id + "' data-productName='" + data.product.productName + "' data-sku='" + data.product.sku + "' data-category_id='" + $('#category_id >option:selected').val() + "' data-subcategory_id='" + $('#subcategory_id >option:selected').val() + "' data-minicategory_id='" + $('#minicategory_id >option:selected').val() + "' data-tab_id='" + $('#tab_id >option:selected').val() + "' data-subcategory='" + $('#subcategory_id >option:selected').text() + "' data-minicategory='" + $('#minicategory_id >option:selected').text() + "' data-tab='" + $('#tab_id >option:selected').text() + "' data-brand_id='" + $('#brand_id >option:selected').val() + "' data-regularPrice='" + data.product.regularPrice + "' data-description='" + data.product.description + "' data-short_description='" + data.product.shortDescription + "' data-specification='" + data.product.specification + "' data-color='" + colors + "' data-size='" + sizes + "' data-tag='" + tags + "' data-type='" + $('#type >option:selected').val() + "' data-payment='" + $('#paymentOption >option:selected').val() + "' data-availability='" + $('#availability >option:selected').val() + "' data-deal_id='" + $('#deal_id >option:selected').val()+ "'><span class='fa fa-edit'></span></a> <a class='delete-product btn btn-danger btn-sm' data-id='" + data.product.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
                    $('#product-form').trigger("reset");
                    CKEDITOR.instances.shortDescription.setData( '' );
                    CKEDITOR.instances.description.setData( '' );
                    CKEDITOR.instances.specification.setData( '' );
            }
        },
    });
});


// function Edit Product
$(document).on('click', '.edit-vendor-product', function(e) {
    e.preventDefault();
    $('#updateProduct').trigger("reset");
    // CKEDITOR.instances.shortDescription.setData( '' );
    // CKEDITOR.instances.description.setData( '' );
    // CKEDITOR.instances.specification.setData( '' );
    $('#ID').val($(this).data('id'));
    $('#eproductName').val($(this).data('productname'));
    $('#esku').val($(this).data('sku'));
    $('#eregularPrice').val($(this).data('regularprice'));
    $('#eslug').val($(this).data('slug'));

    $('#emin_order_qty').val($(this).data('min_order_qty'));
    $('#edelivery_time').val($(this).data('delivery_time'));
    $('#edelivery_from').val($(this).data('delivery_from'));
    $('#edelivery_charge').val($(this).data('delivery_charge'));
    $('#ereturn_policy').val($(this).data('return_policy'));
    $('#ereturn_policy').summernote('code',$(this).data('return_policy'));


    $('#ediscount').val($(this).data('discount'));

    if($(this).data('occasion'))
    {
        $('#eoccasion').prop( "checked", true );
    }
    if($(this).data('promotion'))
    {
        $('#epromotion').prop( "checked", true );
    }
    if($(this).data('clearance'))
    {
        $('#eclearance').prop( "checked", true );
    }
    if($(this).data('buy_get'))
    {
        $('#ebuy_get').prop( "checked", true );
    }



    // Set all selected elements to false
    $("option:selected").prop("selected", false);

    // Get the category_id
    var  category_id = $(this).data('category_id');
    // Loop over each select option
    $("#ecategory_id > option").each(function(){
        // Check for the matching category
        if ($(this).val() == category_id){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the subcategory
    $("#esubcategory_id").html("<option value='" + $(this).data('subcategory_id') + "'>" + $(this).data('subcategory') + "</option>");

    // Get the minicategory
    $("#eminicategory_id").html("<option value='" + $(this).data('minicategory_id') + "'>" + $(this).data('minicategory') + "</option>");

    // Get the Tab
    $("#etab_id").html("<option value='" + $(this).data('tab_id') + "'>" + $(this).data('tab') + "</option>");

    // Get the brand_id
    var  brand_id = $(this).data('brand_id');
    // Loop over each select option
    $("#ebrand_id > option").each(function(){
        // Check for the matching brand_id
        if ($(this).val() == brand_id){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the offer
    var  offer = $(this).data('offer');
    // Loop over each select option
    $("#eoffer > option").each(function(){
        // Check for the matching offer
        if ($(this).val() == offer){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the mesurement
    // var  mesurement = $(this).data('mesurement');
    var  measurement = $(this).data('measurement');

    // Loop over each select option
    $("#emeasurement > option").each(function(){
        // Check for the matching availability
        if ($(this).val() == measurement){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the availability
    var  availability = $(this).data('availability');
    // Loop over each select option
    $("#eavailability > option").each(function(){
        // Check for the matching availability
        if ($(this).val() == availability){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the type
    var  type = $(this).data('type');
    // Loop over each select option
    $("#etype > option").each(function(){
        // Check for the matching type
        if ($(this).val() == type){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the paymentOption
    var  payment_option = $(this).data('payment');
    // Loop over each select option
    $("#epaymentOption > option").each(function(){
        // Check for the matching type
        if ($(this).val() == payment_option){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the deal_id
    var  deal_id = $(this).data('deal_id');
    // Loop over each select option
    $("#edeal_id > option").each(function(){
        // Check for the matching category
        if ($(this).val() == deal_id){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the color
    var color = $(this).data('color');
    // Loop over each select option
    $(".color").each(function(){
        // Check for the matching type
        if (color.indexOf($(this).data('value')) >= 0){
            // Select the matched option
            $(this).prop("checked", true);
        }
    });

    // Get the size
    var size = $(this).data('size');
    // Loop over each select option
    $(".size").each(function(){
        // Check for the matching type
        if (size.indexOf($(this).data('value')) >= 0){
            // Select the matched option
            $(this).prop("checked", true);
        }
    });

    // Get the tag
    var tag = $(this).data('tag');
    // Loop over each select option
    $(".tag").each(function(){
        // Check for the matching type
        if (tag.indexOf($(this).data('value')) >= 0){
            // Select the matched option
            $(this).prop("checked", true);
        }
    });

    CKEDITOR.instances.eshortDescription.setData( $(this).data('short_description') );
    CKEDITOR.instances.uDescription.setData( $(this).data('description') );
    CKEDITOR.instances.uSpecification.setData( $(this).data('specification') );
    $('.modal-title').text('Edit Product');
    $('.form-horizontal').show();
    $('#update').modal('show');
});

$('#updateProduct').submit(function(event) {
    // update CKEDITOR element
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_method', 'PUT');
    $.ajax({
        type: 'POST',
        url: 'vendors-products/' + $('#ID').val(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.productName === 'undefined') {
                    $('.eproductName').addClass('hidden');
                }
                $('.eproductName').text(data.errors.productName);
                if (typeof data.errors.sku === 'undefined') {
                    $('.esku').addClass('hidden');
                }
                $('.esku').text(data.errors.sku);
                if (typeof data.errors.regularPrice === 'undefined') {
                    $('.eregularPrice').addClass('hidden');
                }
                $('.eregularPrice').text(data.errors.regularPrice);
                if (typeof data.errors.image1 === 'undefined') {
                    $('.eimage1').addClass('hidden');
                }
                $('.eimage1').text(data.errors.image1);
                if (typeof data.errors.image2 === 'undefined') {
                    $('.eimage2').addClass('hidden');
                }
                $('.eimage2').text(data.errors.image2);
                if (typeof data.errors.image3 === 'undefined') {
                    $('.eimage3').addClass('hidden');
                }
                $('.eimage3').text(data.errors.image3);
                if (typeof data.errors.image4 === 'undefined') {
                    $('.eimage4').addClass('hidden');
                }
                $('.image4').text(data.errors.image4);
                if (typeof data.errors.image5 === 'undefined') {
                    $('.eimage5').addClass('hidden');
                }
                $('.image5').text(data.errors.image5);
                if (typeof data.errors.description === 'undefined') {
                    $('.edescription').addClass('hidden');
                }
                $('.edescription').text(data.errors.description);
                if (typeof data.errors.shortDescription === 'undefined') {
                    $('.eshortDescription').addClass('hidden');
                }
                $('.eshortDescription').text(data.errors.shortDescription);
                if (typeof data.errors.specification === 'undefined') {
                    $('.especification').addClass('hidden');
                }
                $('.especification').text(data.errors.specification);
            } else {
                var colors, color_ids, sizes, size_ids, tags, tag_ids;
                colors = color_ids = sizes = size_ids = tags = tag_ids = "";
                $.each(data.colors, function (index, value) {
                    colors += value.color + " ";
                    color_ids += value.id + " ";
                });
                $.each(data.sizes, function (index, value) {
                    sizes += value.size + " ";
                    size_ids += value.id + " ";
                });
                $.each(data.tags, function (index, value) {
                    tags += value.tag + " ";
                    tag_ids += value.id + " ";
                });
                $('#product' + data.product.id).replaceWith(" " +
                    "<tr id='product" + data.product.id + "'>" +
                    "<td>" + data.product.productName + "</td>" +
                    "<td><img src='storage/images/product/" + data.image.image1 + "' height='100px' width='100px'></td>" +
                    "<td>" + data.product.sku + "</td>" +
                    "<td>" + $('#ecategory_id >option:selected').text() + "</td>" +
                    "<td>" + $('#esubcategory_id >option:selected').text() + "</td>" +
                    "<td>" + $('#eminicategory_id >option:selected').text() + "</td>" +
                    "<td>৳ " + data.product.regularPrice + "</td>" +
                    "<td>" + Unpublished + "</td>" +
                    "<td><a class='show-product btn btn-info btn-sm' data-id='" + data.product.id + "' data-productName='" + data.product.productName + "' data-image='" + data.image.image1 + "' data-sku='" + data.product.sku + "' data-category='" + $('#category_id >option:selected').text() + "' data-subcategory='" + $('#subcategory_id >option:selected').text() + "' data-minicategory='" + $('#minicategory_id >option:selected').text() + "' data-tab='" + $('#tab_id >option:selected').text() + "' data-brand='" + $('#brand_id >option:selected').text() +"' data-regularPrice='" + data.product.regularPrice + "' data-description='" + data.product.description + "' data-specification='" + data.product.specification + "' data-color='" + colors + "' data-size='" + sizes + "' data-tag='" + tags + "' data-type='" + $('#type >option:selected').text() +  "' data-payment='" + $('#paymentOption >option:selected').text() + "' data-availability='" + $('#availability >option:selected').text()+ "' data-deal_id='" + $('#deal_id >option:selected').text() + "'><span class='fa fa-eye'></span></a><a class='edit-product btn btn-warning btn-sm' data-id='" + data.product.id + "' data-productName='" + data.product.productName + "' data-sku='" + data.product.sku + "' data-category_id='" + $('#category_id >option:selected').val() + "' data-subcategory_id='" + $('#subcategory_id >option:selected').val() + "' data-minicategory_id='" + $('#minicategory_id >option:selected').val() + "' data-tab_id='" + $('#tab_id >option:selected').val() + "' data-subcategory='" + $('#subcategory_id >option:selected').text() + "' data-minicategory='" + $('#minicategory_id >option:selected').text() + "' data-tab='" + $('#tab_id >option:selected').text() + "' data-brand_id='" + $('#brand_id >option:selected').val() + "' data-regularPrice='" + data.product.regularPrice + "' data-short_description='" + data.product.shortDescription + "' data-description='" + data.product.description + "' data-specification='" + data.product.specification + "' data-color='" + colors + "' data-size='" + sizes + "' data-tag='" + tags + "' data-type='" + $('#type >option:selected').val() + "' data-payment='" + $('#epaymentOption >option:selected').val() + "' data-availability='" + $('#availability >option:selected').val()+ "' data-deal_id='" + $('#deal_id >option:selected').val()  + "'><span class='fa fa-edit'></span></a> <a class='delete-product btn btn-danger btn-sm' data-id='" + data.product.id + "'><span class='fa fa-trash'></span></a></td>" +
                    "</tr>");
            }
        }
    });
});


// form Delete function
$(document).on('click', '.delete-product', function(e) {
    e.preventDefault();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteProduct');
    $('.modal-title').text('Delete Product');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteProduct', function(){
    $.ajax({
        type: 'POST',
        url: 'vendors-products/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(){
            $('#product' + $('.id').text()).remove();
        }
    });
});


// Show function
$(document).on('click', '.show-product', function(e) {
    e.preventDefault();
    $('#show').modal('show');
    $('#i').val($(this).data('id'));
    $('#prnm').val($(this).data('productname'));
    $('#ct').val($(this).data('category'));
    $('#img').attr('src', 'storage/images/product/' + $(this).data('image'));
    $('#sct').val($(this).data('subcategory'));
    $('#mnctgr').val($(this).data('minicategory'));
    $('#stab').val($(this).data('tab'));
    $('#sl').val($(this).data('slug'));
    $('#br').val($(this).data('brand'));
    $('#tp').val($(this).data('type'));
    $('#spaymentOption').val($(this).data('payment'));
    $('#sdeal').val($(this).data('deal'));

    $('#sdiscount').val($(this).data('discount'));
    
    if($(this).data('occasion'))
    {
        $('#soccasion').prop( "checked", true );
    }
    if($(this).data('promotion'))
    {
        $('#spromotion').prop( "checked", true );
    }
    if($(this).data('clearance'))
    {
        $('#sclearance').prop( "checked", true );
    }
    if($(this).data('buy_get'))
    {
        $('#sbuy_get').prop( "checked", true );
    }

    
    $('#smeasurement').val($(this).data('measurement'));
    $('#smin_order_qty').val($(this).data('min_order_qty'));
    $('#sdelivery_time').val($(this).data('delivery_time'));
    $('#sdelivery_from').val($(this).data('delivery_from'));
    $('#sdelivery_charge').val($(this).data('delivery_charge'));
    $('#sreturn_policy').val($(this).data('return_policy'));
    $('#sreturn_policy').summernote('code',$(this).data('return_policy'));


    $('#sk').val($(this).data('sku'));
    $('#cl').val($(this).data('color'));
    $('#sz').val($(this).data('size'));
    $('#tg').val($(this).data('tag'));
    $('#av').val($(this).data('availability'));
    $('#rPrice').val($(this).data('regularprice'));
    $('#showShortDescription').html($(this).data('short_description'));
    $('#des').html($(this).data('description'));
    $('#spc').html($(this).data('specification'));
    $('.modal-title').text('Show Product');
});

/*-------------------------------------------
03. Product CRUD end
--------------------------------------------- */
