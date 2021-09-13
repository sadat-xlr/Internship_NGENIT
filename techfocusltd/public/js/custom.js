/*-----------------------------------------------------------------------------------

  Template Name: Techfocus admin HTML5 Template.
  Template URI: #
  Description: Techfocus is a unique website template designed in HTML with a simple & beautiful look. There is an excellent solution for creating clean, wonderful and trending material design corporate, corporate any other purposes websites.
  Author: Techfocus
  Author URI: https://www.techfocusltd.com
  Version: 1.1

-----------------------------------------------------------------------------------*/

/*-------------------------------
[  Table of contents  ]
---------------------------------
  01. User CRUD
  02. Coupon CRUD
  03. Product filter
  04. Product compare
  05. Quotation
  06. Password reset
  07. Client CRUD
  08. Plan CRUD
  09. DMAR CRUD
  10. Deal CRUD
  11. Blog filter
  12. Brand filter
  13. Color filter



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




/*-------------------------------------------------------------
01. User CRUD
---------------------------------------------------------------*/


// -- ajax Form update info --

$(function() {

    // Get the form.
    var form = $('#update-client');

    // Set up an event listener for the login form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Serialize the form data.
        var formData = $(form).serialize();

        // Submit the form using AJAX.
        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData,
            success: function(data){
                // Show success message
                $('#message').modal('show');
                $('.wmessage').css('color', 'green');
                $('.modal-title').css('color', 'green');
                $('.modal-title').text('Congrats!');
                $('.wmessage').text('Account details updated successfully.');
            }
        });
    });
});


// -- ajax Form update password --

$(document).on('click', '#updatePass', function() {
    $.ajax({
        type: 'post',
        url: base_url + '/updatePass',
        data: {
            'oldpassword': $('input[name=oldpassword]').val(),
            'password': $('input[name=password]').val(),
            '_method': 'PUT'
        },
        success: function(data){
            if ((data.errors)) {
                $('.err').remove();
                $('#message').modal('show');
                $('.wmessage').css('color', 'red');
                $('.modal-title').css('color', 'red');
                $('.modal-title').text('Oops!');
                if (typeof data.errors.oldpassword !== 'undefined') {
                    $('.wmessage').append("<li class='err'>" + data.errors.oldpassword + "</li>");
                };
                if (typeof data.errors.password !== 'undefined') {
                    $('.wmessage').append("<li class='err'>" + data.errors.password + "</li>");
                };
                if (typeof data.errors.error !== 'undefined') {
                    $('.wmessage').append("<li class='err'>" + data.errors.error + "</li>");
                };
            } else {
                $('#message').modal('show');
                $('.wmessage').css('color', 'green');
                $('.modal-title').css('color', 'green');
                $('.modal-title').text('Congrats!');
                $('.wmessage').text('Password updated successfully.');
            }
        }
    });
    $('input[name=oldpassword]').val('');
    $('input[name=password]').val('');
});





/*-------------------------------------------
  02. Coupon apply
--------------------------------------------- */


// form applyCoupon function

$(document).on('submit', '#applyCoupon', function(e){
    // Stop the form from being submit
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(data){
            if ((data.errors)) {
                if (typeof data.errors.coupon_code !== 'undefined') {
                    var error = data.errors.coupon_code;
                }
                else{
                    var error = data.errors;
                }
                $('#message').modal('show');
                $('.wmessage').css('color', 'red');
                $('.modal-title').css('color', 'red');
                $('.modal-title').text('Oops!');
                $('.wmessage').text(error);
            } else {
                $('#message').modal('show');
                $('.wmessage').css('color', 'green');
                $('.modal-title').css('color', 'green');
                $('.modal-title').text('Congrats!');
                $('.wmessage').text('Coupon applied successfully.');
                $(location).attr("href", "cart");
            }
        }
    });
    $('input[name=coupon_code]').val('');
});






/*-------------------------------------------
  03. Product filter
--------------------------------------------- */

// External js: jquery, isotope.pkgd.js, bootstrap.min.js, bootstrap-slider.js
$(document).ready( function() {

    // Create object to store filter for each group
    var buttonFilters = {};
    var filters = {};
    var $checkboxes = $('.widget-content');
    var buttonFilter = '*';
    var comboFilter = '*';
    // Create new object for the range filters and set default values,
    // The default values should correspond to the default values from the slider
    var rangeFilters = {
        'price': {'min':0, 'max': 2000000}
    };

    // Initialise Isotope
    // Set the item selector
    var $grid = $('.tab-product').isotope({
        itemSelector: '.product',
        layout: 'masonry',
        // use filter function
        filter: function() {
            var $this = $(this);
            var price = $this.attr('data-price');
            var isInPriceRange = (rangeFilters['price'].min <= price && rangeFilters['price'].max >= price);
            //console.log(rangeFilters['height']);
            //console.log(rangeFilters['weight']);
            // Debug to check whether an item is within the height weight range
            //console.log('isInHeightRange:' +isInHeightRange + '\nisInWeightRange: ' + isInWeightRange );
            return $this.is( buttonFilter ) && (isInPriceRange) && $this.is(comboFilter || '*');
        }
    });


    // Initialise Sliders
    // Set min/max range on sliders as well as default values
    var $priceSlider = $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 2000000,
        values: [ 0, 2000000 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "৳" + ui.values[ 0 ] + " - ৳" + ui.values[ 1 ] );
            updateRangeSlider(event, ui);
        }
    });
    $( "#amount" ).val( "৳" + $( "#slider-range" ).slider( "values", 0 ) +
        " - ৳" + $( "#slider-range" ).slider( "values", 1 ) );


    function updateRangeSlider(slider, slideEvt) {
        //console.log('Current slider:' + slider);
        var sldmin = +slideEvt.values[0],
            sldmax = +slideEvt.values[1],
            // Find which filter group this slider is in (in this case it will be price)
            // This can be changed by modifying the data-filter-group="age" attribute on the slider HTML
            filterGroup = $( "#slider-range" ).attr('data-filter-group'),
            // Set current selection in variable that can be pass to the label
            currentSelection = sldmin + ' - ' + sldmax;

        // Update filter label with new range selection
        //slider.siblings('.filter-label').find('.filter-selection').text(currentSelection);

        // Set min and max values for current selection to current selection
        // If no values are found set min to 0 and max to 100000
        // Store min/max values in rangeFilters array in the relevant filter group
        // E.g. rangeFilters['price'].min and rangeFilters['price'].max
        console.log('Filtergroup: '+ filterGroup);
        rangeFilters[filterGroup] = {
            min: sldmin || 0,
            max: sldmax || 2000000
        };
        // Trigger isotope again to refresh layout
        $grid.isotope();
    }

    // Look inside element with .filters class for any clicks on elements with .buttons
    $(document).on( 'click', '.buttons', function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        var $this = $(this);
        // Get group key from parent btn-group (e.g. data-filter-group="color")
        var $buttonGroup = $this.parents('.widget-content');
        var filterGroup = $buttonGroup.attr('data-filter-group');
        // set filter for group
        buttonFilters[ filterGroup ] = $this.attr('data-filter');
        // Combine filters or set the value to * if buttonFilters
        buttonFilter = concatValues( buttonFilters ) || '*';
        // Log out current filter to check that it's working when clicked
        console.log( buttonFilter );
        // Trigger isotope again to refresh layout
        $grid.isotope();
    });


    // change is-checked class on btn-filter to toggle which one is active
    $('.widget-content').each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', '.buttons', function() {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });

    // Look inside element with .box-checkbox class for any clicks on elements with .buttons
    $checkboxes.change( function(jQEvent) {
        // map input values to an array
        var $checkbox = $(jQEvent.target);
        // get all checked box associated with their filter-group
        manageCheckbox($checkbox);
        // combine all checkbox within an array
        comboFilter = getComboFilter(filters);

        // Log out current filter to check that it's working when clicked
        console.log( comboFilter );
        // Trigger isotope again to refresh layout
        $grid.isotope();
    });

    // combine all checkbox within an array
    function getComboFilter(filters) {
        var i = 0;
        var comboFilters = [];
        var message = [];
        for (var prop in filters) {
            message.push(filters[prop].join(' '));
            var filterGroup = filters[prop];
            // skip to next filter group if it doesn't have any values
            if (!filterGroup.length) {
                continue;
            }
            if (i === 0) {
                // copy to new array
                comboFilters = filterGroup.slice(0);
            } else {
                var filterSelectors = [];
                // copy to fresh array
                var groupCombo = comboFilters.slice(0); // [ A, B ]
                // merge filter Groups
                for (var k = 0, len3 = filterGroup.length; k < len3; k++) {
                    for (var j = 0, len2 = groupCombo.length; j < len2; j++) {
                        filterSelectors.push(groupCombo[j] + filterGroup[k]); // [ 1, 2 ]
                    }
                }
                // apply filter selectors to combo filters for next group
                comboFilters = filterSelectors;
            }
            i++;
        }
        var comboFilter = comboFilters.join(', ');
        return comboFilter;
    }

    // get all checked box associated with their filter-group
    function manageCheckbox($checkbox) {
        var checkbox = $checkbox[0];
        var group = $checkbox.parents('.widget-content').attr('data-filter-group');
        // create array for filter group, if not there yet
        var filterGroup = filters[group];
        if (!filterGroup) {
            filterGroup = filters[group] = [];
        }
        var isAll = $checkbox.hasClass('all');
        // reset filter group if the all box was checked
        if (isAll) {
            delete filters[group];
            if (!checkbox.checked) {
                checkbox.checked = 'checked';
            }
        }
        // index of
        var index = $.inArray(checkbox.value, filterGroup);
        if (checkbox.checked) {
            var selector = isAll ? 'input' : 'input.all';
            $checkbox.siblings(selector).removeAttr('checked');
            if (!isAll && index === -1) {
                // add filter to group
                filters[group].push(checkbox.value);
            }
        } else if (!isAll) {
            // remove filter from group
            filters[group].splice(index, 1);
            // if unchecked the last box, check the all
            if (!$checkbox.siblings('[checked]').length) {
                $checkbox.siblings('input.all').attr('checked', 'checked');
            }
        }
    }

});

// Flatten object by concatting values
function concatValues( obj ) {
    var value = '';
    for ( var prop in obj ) {
        value += obj[ prop ];
    }
    return value;
}






/*-------------------------------------------
  04. Product compare
--------------------------------------------- */

// Commpare dialogue box
$(document).on('click', '.compare', function(e){
    // Stop the form from being submit
    e.preventDefault();

    $('#compareSimiliar').attr('href', $(this).data('comparesimiliar'));
    $('#compareList').attr('href', $(this).data('comparelist'));
    $('#compare').modal('show');
});






/*-------------------------------------------
  05. Quotation
--------------------------------------------- */

// Quotation dialogue box
$(document).on('click', '.quotation', function(e){
    // Stop the form from being submit
    e.preventDefault();

    $('#subject').val($(this).data('subject'));
    $('#messageBody').val($(this).data('message'));
    $('#quotation').modal('show');
});





/*-------------------------------------------
  06. Password reset
--------------------------------------------- */

// form password reset
$(document).on('click', '#forgotPass', function(e) {
    e.preventDefault();
    $('.modal-title').text('Password reset');
    $('#password_reset').modal('show');
});


// Password reset
$(function() {

    // Get the form.
    var form = $('#password-reset-form');

    // Set up an event listener for the register form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Submit the form using AJAX.
        $.ajax({
            type: 'post',
            url: $(form).attr('action'),
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                if (data.error){
                    $('.error').show();
                    $('.success').hide();
                    $('.error').text(data.error);
                } else {
                    $('.success').show();
                    $('.error').hide();
                    $('.success').text('We have e-mailed your password reset link!');
                }
            }
        });
    });
});





/*-------------------------------------------
  06. Client CRUD
--------------------------------------------- */


// store Client
$(function() {

    // Get the form.
    var form = $('#form-add-client');

    // Set up an event listener for the register form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Submit the form using AJAX.
        $.ajax({
            type: 'post',
            url: $(form).attr('action'),
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                $(form).trigger('reset');
                var i = 0;
                var row = '';
                var first_row = '';
                $(data.contactpeople).each(function (key, value) {
                    i++;
                    if (i == 1){
                        first_row = '<td>'+value.contactPersonName+'</td>\n' +
                            '<td>'+value.designation+'</td>\n' +
                            '<td>'+value.department+'</td>\n' +
                            '<td>'+value.cell+'</td>\n';
                    }
                    if (i > 1){
                        row += '<tr>\n' +
                            '<td>'+value.contactPersonName+'</td>\n' +
                            '<td>'+value.designation+'</td>\n' +
                            '<td>'+value.department+'</td>\n' +
                            '<td>'+value.cell+'</td>\n' +
                            '</tr>';
                    }
                });
                $('#client-table').append('<tr id="client'+data.client.id+'">\n' +
                    '<td rowspan="'+i+'">'+$("#sector option:selected").text()+'</td>\n' +
                    '<td rowspan="'+i+'">'+$("#subsector_id option:selected").text()+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.companyName+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.address+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.area+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.phone+'</td>\n' + first_row +
                    '<td rowspan="'+i+'">'+data.client.email_office+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.status+'</td>\n' +
                    '<td rowspan="'+i+'">\n' +
                    'Prime\n' +
                    '</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.comments+'</td>\n' +
                    '<td rowspan="'+i+'">\n' +
                    '<a href="#" class="edit-client btn btn-warning btn-sm" data-id="'+data.client.id+'" data-companyName="'+data.client.companyName+'" data-address="'+data.client.address+'" data-area="'+data.client.area+'" data-phone="'+data.client.phone+'" data-sector="'+$("#sector option:selected").val()+'" data-subsector="'+$("#subsector_id option:selected").val()+'" data-subsectorname="'+$("#subsector_id option:selected").text()+'" data-comments="'+data.client.comments+'" data-web="'+data.client.web+'" data-email_office="'+data.client.email_office+'" data-status="'+data.client.status+'" data-cell_office="'+data.client.cell_office+'">\n' +
                    '<i class="fa fa-edit"></i>\n' +
                    '</a>\n' +
                    '<a href="#" class="delete-client btn btn-danger btn-sm" data-id="'+data.client.id+'">\n' +
                    '<i class="fa fa-trash"></i>\n' +
                    '</a>\n' +
                    '</td>\n' +
                    '</tr>' + row);
            }
        });
    });
});

// Retrieve subsectors from sector dynamically using ajax & jquery
$(document).ready(function() {
    $('#sector').change(function() {
        $.ajax({
            type:"GET",
            url:base_url+"/sectors/"+$('#sector').val(),
            success : function(results) {
                $("#subsector_id").html(results);
            }
        });
    });
});

$(document).ready(function() {
    $('#esector').change(function() {
        $.ajax({
            type:"GET",
            url:base_url+"/sectors/"+$('#esector').val(),
            success : function(results) {
                $("#esubsector_id").html(results);
            }
        });
    });
});

// add person to form
$('#addPerson').click(function (e) {
    // Stop the browser from submitting the form.
    e.preventDefault();

    // var for counter
    var sum = 0;

    // Loop over person
    $('.contactPerson').each(function () {
        sum++;
    });

    // append person to HTML DOM
    $('#contactPerson').append('<div id="person'+sum+'" class="contactPerson"><div class="field-row">\n' +
        '<p class="field-one-half">\n' +
        '<a href="#" type="button" data-id="'+sum+'" class="btn btn-danger btn-sm removePerson" onclick="removePerson('+sum+')">'+
        '<i class="fa fa-minus"></i></a>' +
        '<label class="control-label" for="contactPersonName">Contact Person *:</label>\n' +
        '<input type="text" name="contactPersonName[]" placeholder="Contact Person here..." required>\n' +
        '</p>\n' +
        '<p class="field-one-half">\n' +
        '<label class="control-label" for="designation">Designation *:</label>\n' +
        '<input type="text" name="designation[]" placeholder="designation here..." required>\n' +
        '</p>\n' +
        '<div class="clearfix"></div>\n' +
        '</div>\n' +
        '<div class="field-row">\n' +
        '<p class="field-one-half">\n' +
        '<label class="control-label" for="department">Department *:</label>\n' +
        '<input type="text" name="department[]" placeholder="Department here..." required>\n' +
        '</p>\n' +
        '<p class="field-one-half">\n' +
        '<label class="control-label" for="cell">Mobile ( Personal  ) *:</label>\n' +
        '<input type="number" name="cell[]" placeholder="Mobile ( Personal  ) here..." required>\n' +
        '</p>\n' +
        '<div class="clearfix"></div>\n' +
        '</div></div>');
});

function addPerson() {
    // var for counter
    var sum = 0;

    // Loop over person
    $('.econtactPerson').each(function () {
        sum++;
    });

    // append person to HTML DOM
    $('#econtactPerson').append('<div id="eperson'+sum+'" class="econtactPerson"><div class="field-row">\n' +
        '<p class="field-one-half">\n' +
        '<a href="#" type="button" data-id="'+sum+'" class="btn btn-danger btn-sm removePerson" onclick="removePerson('+sum+')">'+
        '<i class="fa fa-minus"></i></a>' +
        '<label class="control-label" for="contactPersonName">Contact Person *:</label>\n' +
        '<input type="text" name="contactPersonName[]" placeholder="Contact Person here..." required>\n' +
        '</p>\n' +
        '<p class="field-one-half">\n' +
        '<label class="control-label" for="designation">Designation *:</label>\n' +
        '<input type="text" name="designation[]" placeholder="designation here..." required>\n' +
        '</p>\n' +
        '<div class="clearfix"></div>\n' +
        '</div>\n' +
        '<div class="field-row">\n' +
        '<p class="field-one-half">\n' +
        '<label class="control-label" for="department">Department *:</label>\n' +
        '<input type="text" name="department[]" placeholder="Department here..." required>\n' +
        '</p>\n' +
        '<p class="field-one-half">\n' +
        '<label class="control-label" for="cell">Mobile ( Personal  ) *:</label>\n' +
        '<input type="number" name="cell[]" placeholder="Mobile ( Personal  ) here..." required>\n' +
        '</p>\n' +
        '<div class="clearfix"></div>\n' +
        '</div></div>');
};

// remove person from form
function removePerson(id) {
    // Remove person from html dom
    $('#person' + id).remove();
    $('#eperson' + id).remove();
}

// function Edit Client
$(document).on('click', '.edit-client', function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();
    $('#econtactPerson').html('');
    $.ajax({
        type:"GET",
        url:base_url + "/clients/" + $(this).data('id') + '/edit',
        success : function(data) {
            // var for counter
            var sum = 0;

            // Loop over person
            $('.econtactPerson').each(function () {
                sum++;
            });
            var i = 0;
            $(data).each(function (key, value) {
                i++;
                if (i == 1){
                    var id = 'addPerson';
                    var icon = 'plus';
                    var button = 'success';
                    var className = 'N/A';
                } else {
                    var id = 'removePerson';
                    var icon = 'minus';
                    var button = 'danger';
                    var className = 'econtactPerson';
                }
                $('#econtactPerson').append('<div id="eperson'+sum+'" class="'+className+'"><div class="field-row">\n' +
                    '                                        <p class="field-one-half">\n' +
                    '                                            <a href="#" type="button" id="'+id+'" class="btn btn-'+button+' btn-sm" onclick="'+id+'('+sum+')">\n' +
                    '                                                <i class="fa fa-'+icon+'"></i>\n' +
                    '                                            </a>\n' +
                    '                                            <label class="control-label" for="contactPersonName">Contact Person *:</label>\n' +
                    '                                            <input type="text" name="contactPersonName[]" value="'+value.contactPersonName+'" placeholder="Contact Person here..." required>\n' +
                    '                                        </p>\n' +
                    '                                        <p class="field-one-half">\n' +
                    '                                            <label class="control-label" for="designation">Designation *:</label>\n' +
                    '                                            <input type="text" name="designation[]" value="'+value.designation+'" placeholder="designation here..." required>\n' +
                    '                                        </p>\n' +
                    '                                        <div class="clearfix"></div>\n' +
                    '                                    </div>\n' +
                    '                                    <div class="field-row">\n' +
                    '                                        <p class="field-one-half">\n' +
                    '                                            <label class="control-label" for="department">Department *:</label>\n' +
                    '                                            <input type="text" name="department[]" value="'+value.department+'" placeholder="Department here..." required>\n' +
                    '                                        </p>\n' +
                    '                                        <p class="field-one-half">\n' +
                    '                                            <label class="control-label" for="cell">Mobile ( Personal  ) *:</label>\n' +
                    '                                            <input type="number" name="cell[]" value="'+value.cell+'" placeholder="Mobile ( Personal  ) here..." required>\n' +
                    '                                        </p>\n' +
                    '                                        <div class="clearfix"></div>\n' +
                    '                                    </div></div>');
            });
        }
    });
    $('.modal-title').text('Client Edit');
    $('#fid').val($(this).data('id'));
    $('#companyName').val($(this).data('companyname'));
    // Get the status
    var  status = $(this).data('status');
    // Loop over each select option
    $("#status > option").each(function(){
        // Check for the matching status
        if ($(this).val() == status){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });
    // Get the sector
    var  sector = $(this).data('sector');
    // Loop over each select option
    $("#esector > option").each(function(){
        // Check for the matching sector
        if ($(this).val() == sector){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });
    // Set the subsector
    $("#esubsector_id").html('<option value="'+$(this).data('subsector')+'">'+$(this).data('subsectorname')+'</option>');
    // Get the area
    var  area = $(this).data('area');
    // Loop over each select option
    $("#area > option").each(function(){
        // Check for the matching sector
        if ($(this).val() == area){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });
    $('#cell_office').val($(this).data('cell_office'));
    $('#address').val($(this).data('address'));
    $('#email_office').val($(this).data('email_office'));
    $('#phone').val($(this).data('phone'));
    $('#web').val($(this).data('web'));
    $('#comments').val($(this).data('comments'));
    $('#edit-client').modal('show');
});

// update Client
$(function() {

    // Get the form.
    var form = $('#form-update-client');

    // Set up an event listener for the register form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Submit the form using AJAX.
        $.ajax({
            type: 'post',
            url: $(form).attr('action') + '/' + $('#fid').val(),
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                var i = 0;
                var row = '';
                var first_row = '';
                $(data.contactpeople).each(function (key, value) {
                    i++;
                    if (i == 1){
                        first_row = '<td>'+value.contactPersonName+'</td>\n' +
                            '<td>'+value.designation+'</td>\n' +
                            '<td>'+value.department+'</td>\n' +
                            '<td>'+value.cell+'</td>\n';
                    }
                    if (i > 1){
                        row += '<tr>\n' +
                            '<td>'+value.contactPersonName+'</td>\n' +
                            '<td>'+value.designation+'</td>\n' +
                            '<td>'+value.department+'</td>\n' +
                            '<td>'+value.cell+'</td>\n' +
                            '</tr>';
                    }
                });
                $('#client'+data.client.id+'').replaceWith('<tr id="client'+data.client.id+'">\n' +
                    '<td rowspan="'+i+'">'+$("#esector option:selected").text()+'</td>\n' +
                    '<td rowspan="'+i+'">'+$("#esubsector_id option:selected").text()+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.companyName+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.address+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.area+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.phone+'</td>\n' + first_row +
                    '<td rowspan="'+i+'">'+data.client.email_office+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.status+'</td>\n' +
                    '<td rowspan="'+i+'">\n' +
                    'Prime\n' +
                    '</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.comments+'</td>\n' +
                    '<td rowspan="'+i+'">\n' +
                    '<a href="#" class="edit-client btn btn-warning btn-sm" data-id="'+data.client.id+'" data-companyName="'+data.client.companyName+'" data-address="'+data.client.address+'" data-area="'+data.client.area+'" data-phone="'+data.client.phone+'" data-sector="'+$("#esector option:selected").val()+'" data-subsector="'+$("#esubsector_id option:selected").val()+'" data-subsectorname="'+$("#esubsector_id option:selected").text()+'" data-comments="'+data.client.comments+'" data-web="'+data.client.web+'" data-email_office="'+data.client.email_office+'" data-status="'+data.client.status+'" data-cell_office="'+data.client.cell_office+'">\n' +
                    '<i class="fa fa-edit"></i>\n' +
                    '</a>\n' +
                    '<a href="#" class="delete-client btn btn-danger btn-sm" data-id="'+data.client.id+'">\n' +
                    '<i class="fa fa-trash"></i>\n' +
                    '</a>\n' +
                    '</td>\n' +
                    '</tr>' + row);
            }
        });
    });
});

// form Delete function
$(document).on('click', '.delete-client', function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();
    $('#footer_action_button').text(" Delete");
    $('.actionBtn').removeClass('deletePlan deleteDmar deleteDeal');
    $('.actionBtn').addClass('deleteClient');
    $('.modal-title').text('Delete Client');
    $('.id').text($(this).data('id'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteClient', function(){
    $.ajax({
        type: 'POST',
        url: base_url + '/clients/'+$('.id').text(),
        data: {
            '_method': 'DELETE',
            'id': $('.id').text()
        },
        success: function(data){
            $('#client' + $('.id').text()).remove();
        }
    });
});





/*-------------------------------------------
  08. Plan CRUD
--------------------------------------------- */

// store Plan
$(function() {

    // Get the form.
    var form = $('#form-add-plan');

    // Set up an event listener for the register form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Submit the form using AJAX.
        $.ajax({
            type: 'post',
            url: $(form).attr('action'),
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                $(form).trigger('reset');
                var i = 0;
                var row = '';
                var first_row = '';
                $(data.client.contactpeople).each(function (key, value) {
                    i++;
                    if (i == 1){
                        first_row = '<td>'+value.contactPersonName+'</td>\n' +
                            '<td>'+value.designation+'</td>\n' +
                            '<td>'+value.cell+'</td>\n';
                    }
                    if (i > 1){
                        row += '<tr>\n' +
                            '<td>'+value.contactPersonName+'</td>\n' +
                            '<td>'+value.designation+'</td>\n' +
                            '<td>'+value.cell+'</td>\n' +
                            '</tr>';
                    }
                });
                $('#plan-table').append('<tr id="plan'+data.plan.id+'">\n' +
                    '<td rowspan="'+i+'">'+data.plan.date+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.companyName+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.area+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.address+'</td>\n' + first_row +
                    '<td rowspan="'+i+'">'+data.client.email_office+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.plan.solution+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.subcategory.category.categoryName+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.subcategory.categoryName+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.plan.product+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.plan.details+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.status+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.plan.comments+'</td>\n' +
                    '<td rowspan="'+i+'">\n' +
                    '<a href="#" class="edit-plan btn btn-warning btn-sm" data-id="'+data.plan.id+'">\n' +
                    '<i class="fa fa-edit"></i>\n' +
                    '</a>\n' +
                    '<a href="#" class="delete-plan btn btn-danger btn-sm" data-id="'+data.plan.id+'">\n' +
                    '<i class="fa fa-trash"></i>\n' +
                    '</a>\n' +
                    '</td>\n' +
                    '</tr>' + row);
            }
        });
    });
});

// function Edit Plan
$(document).on('click', '.edit-plan', function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();

    $.ajax({
        type:"GET",
        url:base_url + "/plans/" + $(this).data('id') + '/edit',
        success : function(data) {
            // Get the month
            var  month = data.month;
            // Loop over each select option
            $("#month > option").each(function(){
                // Check for the matching option
                if ($(this).val() == month){
                    // Select the matched option
                    $(this).prop("selected", true);
                }
            });
            // Get the marketingType
            var  marketingType = data.marketingType;
            // Loop over each select option
            $("#marketingType > option").each(function(){
                // Check for the matching option
                if ($(this).val() == marketingType){
                    // Select the matched option
                    $(this).prop("selected", true);
                }
            });
            // Get the client_id
            var  client_id = data.client_id;
            // Loop over each select option
            $("#client_id > option").each(function(){
                // Check for the matching option
                if ($(this).val() == client_id){
                    // Select the matched option
                    $(this).prop("selected", true);
                }
            });
            // Get the status
            var  status = data.status;
            // Loop over each select option
            $("#status > option").each(function(){
                // Check for the matching option
                if ($(this).val() == status){
                    // Select the matched option
                    $(this).prop("selected", true);
                }
            });

            $('#year').val(data.year);
            $('#date').val(data.date);
            $('#product').val(data.product);
            $('#details').val(data.details);
            $('#solution').val(data.solution);
            $('#plan_comments').val(data.comments);
            $('#edit-plan').modal('show');
        }
    });

    $('#fid').val($(this).data('id'));
    // Get the category
    var  category = $(this).data('category_id');
    // Loop over each select option
    $("#ecatId > option").each(function(){
        // Check for the matching option
        if ($(this).val() == category){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });
    // Set the minicategory
    $("#eminiCatId").html('<option value="'+$(this).data('minicategory_id')+'">'+$(this).data('minicategory')+'</option>');
    // Set the subcategory
    $("#esubCatId").html('<option value="'+$(this).data('subcategory_id')+'">'+$(this).data('subcategory')+'</option>');
    $('.modal-title').text('Plan Edit');
    $('#edit-plan').modal('show');
});

// update Plan
$(function() {

    // Get the form.
    var form = $('#form-update-plan');

    // Set up an event listener for the register form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Submit the form using AJAX.
        $.ajax({
            type: 'post',
            url: $(form).attr('action') + '/' + $('#fid').val(),
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                var i = 0;
                var row = '';
                var first_row = '';
                $(data.client.contactpeople).each(function (key, value) {
                    i++;
                    if (i == 1){
                        first_row = '<td>'+value.contactPersonName+'</td>\n' +
                            '<td>'+value.designation+'</td>\n' +
                            '<td>'+value.cell+'</td>\n';
                    }
                    if (i > 1){
                        row += '<tr>\n' +
                            '<td>'+value.contactPersonName+'</td>\n' +
                            '<td>'+value.designation+'</td>\n' +
                            '<td>'+value.cell+'</td>\n' +
                            '</tr>';
                    }
                });
                $('#plan'+data.plan.id+'').replaceWith('<tr id="plan'+data.plan.id+'">\n' +
                    '<td rowspan="'+i+'">'+data.plan.date+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.companyName+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.area+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.address+'</td>\n' + first_row +
                    '<td rowspan="'+i+'">'+data.client.email_office+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.plan.solution+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.subcategory.category.categoryName+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.subcategory.categoryName+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.plan.product+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.plan.details+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.client.status+'</td>\n' +
                    '<td rowspan="'+i+'">'+data.plan.comments+'</td>\n' +
                    '<td rowspan="'+i+'">\n' +
                    '<a href="#" class="edit-plan btn btn-warning btn-sm" data-id="'+data.plan.id+'">\n' +
                    '<i class="fa fa-edit"></i>\n' +
                    '</a>\n' +
                    '<a href="#" class="delete-plan btn btn-danger btn-sm" data-id="'+data.plan.id+'">\n' +
                    '<i class="fa fa-trash"></i>\n' +
                    '</a>\n' +
                    '</td>\n' +
                    '</tr>' + row);
            }
        });
    });
});

// form Delete function
$(document).on('click', '.delete-plan', function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();
    $('#footer_action_button').text(" Delete");
    $('.actionBtn').removeClass('deleteClient deleteDmar deleteDeal');
    $('.actionBtn').addClass('deletePlan');
    $('.modal-title').text('Delete Plan');
    $('.id').text($(this).data('id'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deletePlan', function(){
    $.ajax({
        type: 'POST',
        url: base_url + '/plans/'+$('.id').text(),
        data: {
            '_method': 'DELETE',
            'id': $('.id').text()
        },
        success: function(data){
            $('#plan' + $('.id').text()).remove();
        }
    });
});





/*-------------------------------------------
  09. DMAR CRUD
--------------------------------------------- */

// store DMAR
$(function() {

    // Get the form.
    var form = $('#form-add-dmar');

    // Set up an event listener for the register form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Submit the form using AJAX.
        $.ajax({
            type: 'post',
            url: $(form).attr('action'),
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                $(form).trigger('reset');
                $('#dmar-table').append('<tr id="dmar'+data.id+'">\n' +
                    '<td>'+data.status+'</td>\n' +
                    '<td>'+data.area+'</td>\n' +
                    '<td>'+data.date+'</td>\n' +
                    '<td>'+data.clientType+'</td>\n' +
                    '<td>'+$('#dmar_sector option:selected').text()+'</td>\n' +
                    '<td>'+data.companyName+'</td>\n' +
                    '<td>'+data.acitivity+'</td>\n' +
                    '<td>'+data.current_status+'</td>\n' +
                    '<td>'+data.solution+'</td>\n' +
                    '<td>'+$('.category_id option:selected').text()+'</td>\n' +
                    '<td>'+$('.subcategory_id option:selected').text()+'</td>\n' +
                    '<td>'+$('.minicategory_id option:selected').text()+'</td>\n' +
                    '<td>'+data.product+'</td>\n' +
                    '<td>'+data.contact+'</td>\n' +
                    '<td>'+data.comment_by_sales+'</td>\n' +
                    '<td>\n' +
                    '<a href="#" class="edit-dmar btn btn-warning btn-sm" data-id="'+data.id+'">\n' +
                    '<i class="fa fa-edit"></i>\n' +
                    '</a>\n' +
                    '<a href="#" class="delete-dmar btn btn-danger btn-sm" data-id="'+data.id+'">\n' +
                    '<i class="fa fa-trash"></i>\n' +
                    '</a>\n' +
                    '</td>\n' +
                    '</tr>');
            }
        });
    });
});

// function Edit DMAR
$(document).on('click', '.edit-dmar', function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();

    $.ajax({
        type:"GET",
        url:base_url + "/dmars/" + $(this).data('id') + '/edit',
        success : function(data) {
            // Get the status
            var  status = data.dmar.status;
            // Loop over each select option
            $("#status > option").each(function(){
                // Check for the matching option
                if ($(this).val() == status){
                    // Select the matched option
                    $(this).prop("selected", true);
                }
            });
            // Get the area
            var  area = data.dmar.area;
            // Loop over each select option
            $("#area > option").each(function(){
                // Check for the matching option
                if ($(this).val() == area){
                    // Select the matched option
                    $(this).prop("selected", true);
                }
            });
            // Get the clientType
            var  clientType = data.dmar.clientType;
            // Loop over each select option
            $("#clientType > option").each(function(){
                // Check for the matching option
                if ($(this).val() == clientType){
                    // Select the matched option
                    $(this).prop("selected", true);
                }
            });
            // Get the edmar_sector
            var  edmar_sector = data.dmar.sector_id;
            // Loop over each select option
            $("#edmar_sector > option").each(function(){
                // Check for the matching option
                if ($(this).val() == edmar_sector){
                    // Select the matched option
                    $(this).prop("selected", true);
                }
            });
            // Get the category
            var  category = data.minicategory.subcategory.category_id;
            // Loop over each select option
            $(".category_id > option").each(function(){
                // Check for the matching option
                if ($(this).val() == category){
                    // Select the matched option
                    $(this).prop("selected", true);
                }
            });

            $('#dmar_companyName').val(data.dmar.companyName);
            $('#dmar_date').val(data.dmar.date);
            $('#dmar_product').val(data.dmar.product);
            $('#acitivity').val(data.dmar.acitivity);
            $('#current_status').val(data.dmar.current_status);
            $('#dmar_solution').val(data.dmar.solution);
            $('#contact').val(data.dmar.contact);
            $('#comment_by_sales').val(data.dmar.comment_by_sales);
            // Set the minicategory
            $(".minicategory_id").html('<option value="'+data.minicategory.id+'">'+data.minicategory.miniCategoryName+'</option>');
            // Set the subcategory
            $(".subcategory_id").html('<option value="'+data.minicategory.subcategory_id+'">'+data.minicategory.subcategory.categoryName+'</option>');
        }
    });

    $('#fid').val($(this).data('id'));
    $('.modal-title').text('DMAR Edit');
    $('#edit-dmar').modal('show');
});

// update DMAR
$(function() {

    // Get the form.
    var form = $('#form-update-dmar');

    // Set up an event listener for the register form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Submit the form using AJAX.
        $.ajax({
            type: 'post',
            url: $(form).attr('action') + '/' + $('#fid').val(),
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                $('#dmar'+data.id+'').replaceWith('<tr id="dmar'+data.id+'">\n' +
                    '<td>'+data.status+'</td>\n' +
                    '<td>'+data.area+'</td>\n' +
                    '<td>'+data.date+'</td>\n' +
                    '<td>'+data.clientType+'</td>\n' +
                    '<td>'+$('#edmar_sector option:selected').text()+'</td>\n' +
                    '<td>'+data.companyName+'</td>\n' +
                    '<td>'+data.acitivity+'</td>\n' +
                    '<td>'+data.current_status+'</td>\n' +
                    '<td>'+data.solution+'</td>\n' +
                    '<td>'+$('.category_id option:selected').text()+'</td>\n' +
                    '<td>'+$('.subcategory_id option:selected').text()+'</td>\n' +
                    '<td>'+$('.minicategory_id option:selected').text()+'</td>\n' +
                    '<td>'+data.product+'</td>\n' +
                    '<td>'+data.contact+'</td>\n' +
                    '<td>'+data.comment_by_sales+'</td>\n' +
                    '<td>\n' +
                    '<a href="#" class="edit-dmar btn btn-warning btn-sm" data-id="'+data.id+'">\n' +
                    '<i class="fa fa-edit"></i>\n' +
                    '</a>\n' +
                    '<a href="#" class="delete-dmar btn btn-danger btn-sm" data-id="'+data.id+'">\n' +
                    '<i class="fa fa-trash"></i>\n' +
                    '</a>\n' +
                    '</td>\n' +
                    '</tr>');
            }
        });
    });
});

// form Delete function
$(document).on('click', '.delete-dmar', function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();
    $('#footer_action_button').text(" Delete");
    $('.actionBtn').removeClass('deleteClient deletePlan deleteDeal');
    $('.actionBtn').addClass('deleteDmar');
    $('.modal-title').text('Delete Plan');
    $('.id').text($(this).data('id'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteDmar', function(){
    $.ajax({
        type: 'POST',
        url: base_url + '/dmars/'+$('.id').text(),
        data: {
            '_method': 'DELETE',
            'id': $('.id').text()
        },
        success: function(data){
            $('#dmar' + $('.id').text()).remove();
        }
    });
});





/*-------------------------------------------
  10. Deal CRUD
--------------------------------------------- */

// store Deal
$(function() {

    // Get the form.
    var form = $('#form-add-deal');

    // Set up an event listener for the register form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Submit the form using AJAX.
        $.ajax({
            type: 'post',
            url: $(form).attr('action'),
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                $(form).trigger('reset');
                $('#deal-table').append('<tr id="deal'+data.id+'">\n' +
                    '<td>'+data.date+'</td>\n' +
                    '<td>'+$('#deal_client_id option:selected').text()+'</td>\n' +
                    '<td>'+data.category_solution+'</td>\n' +
                    '<td>'+data.category_product+'</td>\n' +
                    '<td>'+data.pqr+'</td>\n' +
                    '<td>'+data.pq_value+'</td>\n' +
                    '<td>'+data.probability_status+'</td>\n' +
                    '<td>'+data.probability_reason+'</td>\n' +
                    '<td>'+data.comments_by_sales+'</td>\n' +
                    '<td>'+data.comments_by_manager+'</td>\n' +
                    '<td>\n' +
                    '<a href="#" class="edit-deal btn btn-warning btn-sm" data-id="'+data.id+'">\n' +
                    '<i class="fa fa-edit"></i>\n' +
                    '</a>\n' +
                    '<a href="#" class="delete-deal btn btn-danger btn-sm" data-id="'+data.id+'">\n' +
                    '<i class="fa fa-trash"></i>\n' +
                    '</a>\n' +
                    '</td>\n' +
                    '</tr>'
                );
            }
        });
    });
});

// function Edit Deal
$(document).on('click', '.edit-deal', function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();

    $.ajax({
        type:"GET",
        url:base_url + "/mydeals/" + $(this).data('id') + '/edit',
        success : function(data) {
            // Get the quarter
            var  quarter = data.deal.quarter;
            // Loop over each select option
            $("#quarter > option").each(function(){
                // Check for the matching option
                if ($(this).val() == quarter){
                    // Select the matched option
                    $(this).prop("selected", true);
                }
            });
            // Get the client_id
            var  client_id = data.deal.client_id;
            // Loop over each select option
            $("#deal_client_id > option").each(function(){
                // Check for the matching option
                if ($(this).val() == client_id){
                    // Select the matched option
                    $(this).prop("selected", true);
                }
            });
            // Get the category
            var  category = data.minicategory.subcategory.category_id;
            // Loop over each select option
            $(".category_id > option").each(function(){
                // Check for the matching option
                if ($(this).val() == category){
                    // Select the matched option
                    $(this).prop("selected", true);
                }
            });

            $('#deal_current_status').val(data.deal.current_status);
            $('#pqr').val(data.deal.pqr);
            $('#pq_value').val(data.deal.pq_value);
            $('#deal_date').val(data.deal.date);
            $('#closing_status').val(data.deal.closing_status);
            $('#probability_status').val(data.deal.probability_status);
            $('#probability_reason').val(data.deal.probability_reason);
            $('#category_product').val(data.deal.category_product);
            $('#category_solution').val(data.deal.category_solution);
            $('#final_status').val(data.deal.final_status);
            $('#project_status').val(data.deal.project_status);
            $('#comment_by_sales').val(data.deal.comment_by_sales);
            $('#comments_by_manager').val(data.deal.comments_by_manager);
            // Set the minicategory
            $(".minicategory_id").html('<option value="'+data.minicategory.id+'">'+data.minicategory.miniCategoryName+'</option>');
            // Set the subcategory
            $(".subcategory_id").html('<option value="'+data.minicategory.subcategory_id+'">'+data.minicategory.subcategory.categoryName+'</option>'
            );
        }
    });

    $('#fid').val($(this).data('id'));
    $('#edit-deal').modal('show');
});

// update Deal
$(function() {

    // Get the form.
    var form = $('#form-update-deal');

    // Set up an event listener for the register form.
    $(form).submit(function(e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        // Submit the form using AJAX.
        $.ajax({
            type: 'post',
            url: $(form).attr('action') + '/' + $('#fid').val(),
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                $('#deal'+data.id+'').replaceWith('<tr id="deal'+data.id+'">\n' +
                    '<td>'+data.date+'</td>\n' +
                    '<td>'+$('#deal_client_id option:selected').text()+'</td>\n' +
                    '<td>'+data.category_solution+'</td>\n' +
                    '<td>'+data.category_product+'</td>\n' +
                    '<td>'+data.pqr+'</td>\n' +
                    '<td>'+data.pq_value+'</td>\n' +
                    '<td>'+data.probability_status+'</td>\n' +
                    '<td>'+data.probability_reason+'</td>\n' +
                    '<td>'+data.comments_by_sales+'</td>\n' +
                    '<td>'+data.comments_by_manager+'</td>\n' +
                    '<td>\n' +
                    '<a href="#" class="edit-deal btn btn-warning btn-sm" data-id="'+data.id+'">\n' +
                    '<i class="fa fa-edit"></i>\n' +
                    '</a>\n' +
                    '<a href="#" class="delete-deal btn btn-danger btn-sm" data-id="'+data.id+'">\n' +
                    '<i class="fa fa-trash"></i>\n' +
                    '</a>\n' +
                    '</td>\n' +
                    '</tr>'
                );
            }
        });
    });
});


// form Delete function
$(document).on('click', '.delete-deal', function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();
    $('#footer_action_button').text(" Delete");
    $('.actionBtn').removeClass('deleteClient deletePlan deleteDmar');
    $('.actionBtn').addClass('deleteDeal');
    $('.modal-title').text('Delete Deal');
    $('.id').text($(this).data('id'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteDeal', function(){
    $.ajax({
        type: 'POST',
        url: base_url + '/mydeals/'+$('.id').text(),
        data: {
            '_method': 'DELETE',
            'id': $('.id').text()
        },
        success: function(data){
            $('#deal' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
  11. Blog filter
--------------------------------------------- */

// External js: jquery, isotope.pkgd.js, bootstrap.min.js, bootstrap-slider.js
$(document).ready( function() {

    // Create object to store filter for each group
    var buttonFilters = {};
    var buttonFilter = '*';

    // Initialise Isotope
    // Set the item selector
    var $grid = $('.post-wrap').isotope({
        itemSelector: '.main-post',
        layout: 'masonry',
        // use filter function
        filter: function () {
            var $this = $(this);
            return $this.is(buttonFilter);
        }
    });

    // Look inside element with .filters class for any clicks on elements with .buttons
    $(document).on('click', '.buttons', function (e) {
        // Stop the browser from submitting the form.
        e.preventDefault();

        var $this = $(this);
        // Get group key from parent btn-group (e.g. data-filter-group="color")
        var $buttonGroup = $this.parents('.cat-list');
        var filterGroup = $buttonGroup.attr('data-filter-group');
        // set filter for group
        buttonFilters[filterGroup] = $this.attr('data-filter');
        // Combine filters or set the value to * if buttonFilters
        buttonFilter = concatValues(buttonFilters) || '*';
        // Log out current filter to check that it's working when clicked
        console.log(buttonFilter);
        // Trigger isotope again to refresh layout
        $grid.isotope();
    });


    // change is-checked class on btn-filter to toggle which one is active
    $('.widget-content').each(function (i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', '.buttons', function () {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });
});

// Filter Search by input text
$('#blog_search').keyup(function(){
    var valThis = $(this).val().toLowerCase();
    if(valThis == ""){
        $('.main-post').show();
    } else {
        $('.main-post').each(function(){
            var text = $(this).text().toLowerCase();
            (text.indexOf(valThis) >= 0) ? $(this).show() : $(this).hide();
        });
    };
});






/*-------------------------------------------
  12. Brand filter
--------------------------------------------- */

// Filter Search by input text
$('#brands').keyup(function(){
    var valThis = $(this).val().toLowerCase();
    if(valThis == ""){
        $('.brands').show();
    } else {
        $('.brands').each(function(){
            var text = $(this).text().toLowerCase();
            (text.indexOf(valThis) >= 0) ? $(this).show() : $(this).hide();
        });
    };
});






/*-------------------------------------------
  13. Color filter
--------------------------------------------- */

// Filter Search by input text
$('#color').keyup(function(){
    var valThis = $(this).val().toLowerCase();
    if(valThis == ""){
        $('.color').show();
    } else {
        $('.color').each(function(){
            var text = $(this).text().toLowerCase();
            (text.indexOf(valThis) >= 0) ? $(this).show() : $(this).hide();
        });
    };
});

/*-------------------------------------------
  14. our product click on shop home page
--------------------------------------------- */

// Filter Search by input text
$('.our-product-sub').click(function(e){
    e.preventDefault();
    var subcat_id = $(this).data('subcat_id');

    $('.our_product').hide();
    $('.ajax_product').html('');
    // $('.ajax_product').removeClass('hide');

    $.ajax({
        type: "get",
        url: $(this).data('url'),
        data: {
            'subcat_id' : subcat_id,
        },
        
        dataType: "json",
        success: function (data) {
            //for product show
            $.each(data, function(index, item) {

                $('.ajax_product').append(

                        '<div class="col-lg-4 col-md-4  product-box style1">\n'+
                            '<div class="imagebox style1">\n'+
                                '<div class="box-image">\n'+
                                    '<a href="/productDetails/' + item.slug +'" title="">\n'+
                                        '<img src="storage/images/product/' + item.image.image1 +'" alt="" style="width: 153px;height: 122px">\n'+
                                    '</a>\n'+
                                '</div>\n'+
                                '<div class="box-content">\n'+
                                    '<div class="cat-name">\n'+
                                        '<a href="/productsByCat/' + item.category_id +'" title="">' + item.category.categoryName +'</a>\n'+
                                    '</div>\n'+
                                    '<div class="product-name">\n'+
                                        '<a href="/productDetails/' + item.slug +'" title="">' + item.productName +'</a>\n'+
                                    '</div>\n'+
                                    '<div class="price">\n'+
                                        '<a href="#" data-subject="Price quotation for' + item.productName + '" data-message="I would like to know the price of' + item.productName + '" class="btn btn-warning btn-sm quotation" title="">Ask for Quote</a>\n'+
                                    '</div>\n'+
                                '</div>\n'+
                                '<div class="box-bottom">\n'+
                                    '<div class="compare-wishlist">\n'+
                                        '<a href="#" class="compare" title="" data-comparelist="/addCompare/' + item.id +'" data-comparesimiliar="/compareSimiliar/' + item.id + '/' + item.minicategory_id +'">\n'+
                                            '<img src="images/icons/compare.png" alt="">Compare \n'+
                                        '</a>\n'+
                                        '<a href="/addWishlist/' + item.id + '" class="wishlist" title="">\n'+
                                            '<img src="images/icons/wishlist.png" alt="">Wishlist \n'+
                                        '</a>\n'+
                                    '</div>\n'+
                                '</div>\n'+
                            '</div>\n'+
                        '</div>\n'
                );

            });
        }
    });




});