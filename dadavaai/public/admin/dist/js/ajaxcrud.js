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
  01. Site Info CRUD(done)
  02. About CRUD
  03. Contact CRUD
  04. Category CRUD (done)
  05. Color CRUD (done)
  06. Size CRUD (done)
  07. Tag CRUD (done)
  08. Product CRUD (done)
  09. Message CRUD
  10. Partner CRUD
  11. Subcategory CRUD (done)
  12. Brand CRUD (done)
  13. Industry CRUD
  14. Client CRUD
  15. Coupon CRUD
  16. Membership Type CRUD
  17. Salesman CRUD
  18. Salesman target CRUD
  19. Slider CRUD (done)
  20. MiniCategory CRUD (done)
  21. Mail CRUD
  22. Order CRUD
  23. Offer CRUD
  24. Deal CRUD
  25. Banner CRUD (done)
  26. Tab CRUD (done)
  28. products ads
  29. Terms & Policy CRUD
  30. Faq & Help CRUD
  31. bundle offers CRUD
  32. on demand RUD
  33. delivery acknowledgement
  34. payment for vendor
  35. Product Information CRUD
  36.



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






/*-------------------------------------------
  01. Site Info CRUD
--------------------------------------------- */


// -- ajax Form Add Info--
$(document).on('click','.addInfo', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Info');
});
$("#addInfo").click(function() {
    $.ajax({
        type: 'POST',
        url: 'siteinfos',
        data: {
            '_token': $('input[name=_token]').val(),
            'title': $('input[name=title]').val(),
            'copyright': $('input[name=copyright]').val(),
            'facebook': $('input[name=facebook]').val(),
            'twitter': $('input[name=twitter]').val(),
            'linkedin': $('input[name=linkedin]').val(),
            'googleplus': $('input[name=googleplus]').val()
        },
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.title === 'undefined') {
                    $('.title').addClass('hidden');
                }
                $('.title').text(data.errors.title);
                if (typeof data.errors.copyright === 'undefined') {
                    $('.copyright').addClass('hidden');
                }
                $('.copyright').text(data.errors.copyright);
                if (typeof data.errors.facebook === 'undefined') {
                    $('.facebook').addClass('hidden');
                }
                $('.facebook').text(data.errors.facebook);
                if (typeof data.errors.twitter === 'undefined') {
                    $('.twitter').addClass('hidden');
                }
                $('.twitter').text(data.errors.twitter);
                if (typeof data.errors.linkedin === 'undefined') {
                    $('.linkedin').addClass('hidden');
                }
                $('.linkedin').text(data.errors.linkedin);
                if (typeof data.errors.googleplus === 'undefined') {
                    $('.googleplus').addClass('hidden');
                }
                $('.googleplus').text(data.errors.googleplus);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='info" + data.id + "'>"+
                    "<td>" + data.title + "</td>"+
                    "<td>" + data.copyright + "</td>"+
                    "<td>" + data.facebook + "</td>"+
                    "<td>" + data.twitter + "</td>"+
                    "<td>" + data.linkedin + "</td>"+
                    "<td>" + data.googleplus + "</td>"+
                    "<td><a class='show-info btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-copyright='" + data.copyright + "' data-facebook='" + data.facebook + "' data-twitter='" + data.twitter + "' data-linkedin='" + data.linkedin + "' data-googleplus='" + data.googleplus + "'><i class='fa fa-eye'></i></a> <a class='edit-info btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-copyright='" + data.copyright + "' data-facebook='" + data.facebook + "' data-twitter='" + data.twitter + "' data-linkedin='" + data.linkedin + "' data-googleplus='" + data.googleplus + "'><i class='fa fa-edit'></i></a> <a class='delete-info btn btn-danger btn-sm' data-id='" + data.id + "'><i class='fa fa-trash'></i></a></td>"+
                    "</tr>");
            }
        },
    });
    $('#title').val('');
    $('#copyright').val('');
    $('#facebook').val('');
    $('#twitter').val('');
    $('#linkedin').val('');
    $('#googleplus').val('');
});


// function Edit Info
$(document).on('click', '.edit-info', function() {
    $('#footer_action_button').text(" Update Info");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteInfo');
    $('.actionBtn').addClass('editInfo');
    $('.modal-title').text('Info Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#etitle').val($(this).data('title'));
    $('#ecopyright').val($(this).data('copyright'));
    $('#efacebook').val($(this).data('facebook'));
    $('#etwitter').val($(this).data('twitter'));
    $('#elinkedin').val($(this).data('linkedin'));
    $('#egoogleplus').val($(this).data('googleplus'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editInfo', function() {
    $.ajax({
        type: 'POST',
        url: 'siteinfos/' + $('#fid').val(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method1]').val(),
            'id': $("#fid").val(),
            'title': $('#etitle').val(),
            'copyright': $('#ecopyright').val(),
            'facebook': $('#efacebook').val(),
            'twitter': $('#etwitter').val(),
            'linkedin': $('#elinkedin').val(),
            'googleplus': $('#egoogleplus').val()
        },
        success: function(data) {
            $('#info' + data.id).replaceWith(" "+
                "<tr id='info" + data.id + "'>"+
                "<td>" + data.title + "</td>"+
                "<td>" + data.copyright + "</td>"+
                "<td>" + data.facebook + "</td>"+
                "<td>" + data.twitter + "</td>"+
                "<td>" + data.linkedin + "</td>"+
                "<td>" + data.googleplus + "</td>"+
                "<td><a class='show-info btn btn-info btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-copyright='" + data.copyright + "' data-facebook='" + data.facebook + "' data-twitter='" + data.twitter + "' data-linkedin='" + data.linkedin + "' data-googleplus='" + data.googleplus + "'><i class='fa fa-eye'></i></a> <a class='edit-info btn btn-warning btn-sm' data-id='" + data.id + "' data-title='" + data.title + "' data-copyright='" + data.copyright + "' data-facebook='" + data.facebook + "' data-twitter='" + data.twitter + "' data-linkedin='" + data.linkedin + "' data-googleplus='" + data.googleplus + "'><i class='fa fa-edit'></i></a> <a class='delete-info btn btn-danger btn-sm' data-id='" + data.id + "'><i class='fa fa-trash'></i></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-info', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('.actionBtn').removeClass('edit-info');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteInfo');
    $('.modal-title').text('Delete Info');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteInfo', function(){
    $.ajax({
        type: 'POST',
        url: 'siteinfos/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#info' + $('.id').text()).remove();
        }
    });
});


// Show function
$(document).on('click', '.show-info', function() {
    $('#show').modal('show');
    $('#i').text($(this).data('id'));
    $('#ti').text($(this).data('title'));
    $('#by').text($(this).data('copyright'));
    $('#fb').text($(this).data('facebook'));
    $('#tw').text($(this).data('twitter'));
    $('#lk').text($(this).data('linkedin'));
    $('#gp').text($(this).data('googleplus'));
    $('.modal-title').text('Show Info');
});






/*-------------------------------------------
02. About CRUD
--------------------------------------------- */


// -- ajax Form Add About--
$(document).on('click','.addAbout', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add About');
});
$("#addAbout").click(function() {
    // update CKEDITOR element
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    // ajax post
    $.ajax({
        type: 'POST',
        url: 'abouts',
        data: $('#insertAbout').serialize(),
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.description === 'undefined') {
                    $('.description').addClass('hidden');
                }
                $('.description').text(data.errors.description);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='about" + data.id + "'>"+
                    "<td>" + data.description + "</td>"+
                    "<td><a class='show-about btn btn-info btn-sm' data-id='" + data.id + "' data-description='" + data.description + "'><i class='fa fa-eye'></i></a> <a class='edit-about btn btn-warning btn-sm' data-id='" + data.id + "' data-description='" + data.description + "'><i class='fa fa-edit'></i></a> <a class='delete-about btn btn-danger btn-sm' data-id='" + data.id + "'><i class='fa fa-trash'></i></a></td>"+
                    "</tr>");
            }
        },
    });
    $('#description').val('');
});


// function Edit About
$(document).on('click', '.edit-about', function() {
    $('#footer_action_button').text(" Update About");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteAbout');
    $('.actionBtn').addClass('editAbout');
    $('.modal-title').text('About Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#edescription').summernote('code',$(this).data('description'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editAbout', function() {
    // update CKEDITOR element
    // for (instance in CKEDITOR.instances) {
    //     CKEDITOR.instances[instance].updateElement();
    // }
    $.ajax({
        type: 'POST',
        url: 'abouts/' + $('#fid').val(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method1]').val(),
            'description': $('#edescription').val(),
            'id': $("#fid").val()
        },
        success: function(data) {
            $('#about' + data.id).replaceWith(" "+
                "<tr id='about" + data.id + "'>"+
                "<td>" + data.description + "</td>"+
                "<td><a class='show-about btn btn-info btn-sm' data-id='" + data.id + "' data-description='" + data.description + "'><i class='fa fa-eye'></i></a> <a class='edit-about btn btn-warning btn-sm' data-id='" + data.id + "' data-description='" + data.description + "'><i class='fa fa-edit'></i></a> <a class='delete-about btn btn-danger btn-sm' data-id='" + data.id + "'><i class='fa fa-trash'></i></a></td>"+
                "</tr>");
        }
    });
});


// Show function
$(document).on('click', '.show-about', function() {
    $('#show').modal('show');
    $('#i').text($(this).data('id'));
    $('#des').html($(this).data('description'));
    $('.modal-title').text('Show About');
});


// form Delete function
$(document).on('click', '.delete-about', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteAbout');
    $('.modal-title').text('Delete About');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteAbout', function(){
    $.ajax({
        type: 'POST',
        url: 'abouts/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#about' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
  03. Contact CRUD
--------------------------------------------- */


// -- ajax Form Add Contact--
$(document).on('click','.addContact', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Contact');
});
$("#addContact").click(function() {
    $.ajax({
        type: 'POST',
        url: 'contacts',
        data: $('#contact-form').serialize(),
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.address === 'undefined') {
                    $('.address').addClass('hidden');
                }
                $('.address').text(data.errors.address);
                if (typeof data.errors.phone1 === 'undefined') {
                    $('.phone1').addClass('hidden');
                }
                $('.phone1').text(data.errors.phone1);
                if (typeof data.errors.phone2 === 'undefined') {
                    $('.phone2').addClass('hidden');
                }
                $('.phone2').text(data.errors.phone2);
                if (typeof data.errors.email === 'undefined') {
                    $('.email').addClass('hidden');
                }
                $('.email').text(data.errors.email);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='contact" + data.id + "'>"+
                    "<td>" + data.address + "</td>"+
                    "<td>" + data.phone1 + "</td>"+
                    "<td>" + data.phone2 + "</td>"+
                    "<td>" + data.email + "</td>"+
                    "<td><a class='show-contact btn btn-info btn-sm' data-id='" + data.id + "' data-address='" + data.address + "' data-phone1='" + data.phone1 + "' data-phone2='" + data.phone2 + "' data-email='" + data.email + "'><span class='fa fa-eye'></span></a> <a class='edit-contact btn btn-warning btn-sm' data-id='" + data.id + "' data-address='" + data.address + "' data-phone1='" + data.phone1 + "' data-phone2='" + data.phone2 + "' data-email='" + data.email + "'><span class='fa fa-edit'></span></a> <a class='delete-contact btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        },
    });
    $('#contact-form input').val('');
});


// function Edit Contact
$(document).on('click', '.edit-contact', function() {
    $('#footer_action_button').text(" Update Contact");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteContact');
    $('.actionBtn').addClass('editContact');
    $('.modal-title').text('Contact Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#eaddress').val($(this).data('address'));
    $('#ephone1').val($(this).data('phone1'));
    $('#ephone2').val($(this).data('phone2'));
    $('#eemail').val($(this).data('email'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editContact', function() {
    $.ajax({
        type: 'POST',
        url: 'contacts/' + $('#fid').val(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method1]').val(),
            'id': $("#fid").val(),
            'address': $('#eaddress').val(),
            'phone1': $('#ephone1').val(),
            'phone2': $('#ephone2').val(),
            'email': $('#eemail').val()
        },
        success: function(data) {
            $('#contact' + data.id).replaceWith(" "+
                "<tr id='contact" + data.id + "'>"+
                "<td>" + data.address + "</td>"+
                "<td>" + data.phone1 + "</td>"+
                "<td>" + data.phone2 + "</td>"+
                "<td>" + data.email + "</td>"+
                "<td><a class='show-contact btn btn-info btn-sm' data-id='" + data.id + "' data-address='" + data.address + "' data-phone1='" + data.phone1 + "' data-phone2='" + data.phone2 + "' data-email='" + data.email + "'><span class='fa fa-eye'></span></a> <a class='edit-contact btn btn-warning btn-sm' data-id='" + data.id + "' data-address='" + data.address + "' data-phone1='" + data.phone1 + "' data-phone2='" + data.phone2 + "' data-email='" + data.email + "'><span class='fa fa-edit'></span></a> <a class='delete-contact btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-contact', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteContact');
    $('.modal-title').text('Delete Contact');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteContact', function(){
    $.ajax({
        type: 'POST',
        url: 'contacts/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#contact' + $('.id').text()).remove();
        }
    });
});


// Show function
$(document).on('click', '.show-contact', function() {
    $('#show').modal('show');
    $('#i').text($(this).data('id'));
    $('#ad').text($(this).data('address'));
    $('#ph1').text($(this).data('phone1'));
    $('#ph2').text($(this).data('phone2'));
    $('#em').text($(this).data('email'));
    $('.modal-title').text('Show Contact');
});






/*-------------------------------------------
  04. Category CRUD
--------------------------------------------- */


// -- ajax Form Add Category--
$(document).on('click','.addCategory', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Category');
});
$("#category-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'categories',
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.categoryName === 'undefined') {
                    $('.categoryName').addClass('hidden');
                }
                $('.error').text(data.errors.categoryName);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='category" + data.id + "'>"+
                    "<td><img src='storage/images/category/" + data.image_icon + "' height='100px' width='100px'></td>"+
                    "<td>" + data.categoryName + "</td>"+
                    "<td><img src='storage/images/category/" + data.image_ad + "' height='100px' width='100px'></td>"+
                    "<td><a class='edit-category btn btn-warning btn-sm' data-id='" + data.id + "' data-categoryName='" + data.categoryName + "'><span class='fa fa-edit'></span></a> <a class='delete-category btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        },
    });
    $('#categoryName').val('');
});


// function Edit Category
$(document).on('click', '.edit-category', function() {
    // $('#footer_action_button').text(" Update Category");
    // $('#footer_action_button').addClass('glyphicon-check');
    // $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').hide();
    $('.modal-title').text('Category Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#ecategoryName').val($(this).data('categoryname'));
    $('#myModal').modal('show');
});

$('#category_update-form').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_method', 'PUT');

    $.ajax({
        type: 'POST',
        url: 'categories/' + $('#fid').val(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $('#category' + data.id).replaceWith(" "+
                "<tr class='tr-shadow' id='category" + data.id + "'>"+
                "<td><img src='storage/images/category/" + data.image_icon + "' height='100px' width='100px'></td>"+
                "<td>" + data.categoryName + "</td>"+
                "<td><img src='storage/images/category/" + data.image_ad + "' height='100px' width='100px'></td>"+
                "<td><a class='edit-category btn btn-warning btn-sm' data-id='" + data.id + "' data-categoryName='" + data.categoryName + "'><span class='fa fa-edit'></span></a> <a class='delete-category btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


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


// form Delete function
$(document).on('click', '.delete-category', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteCategory');
    $('.modal-title').text('Delete Category');
    $('.id').val($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteCategory', function(){
    $.ajax({
        type: 'POST',
        url: 'categories/'+$('.id').val(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').val()
        },
        success: function(data){
            $('#category' + $('.id').val()).remove();
        }
    });
});






/*-------------------------------------------
05. Color CRUD
--------------------------------------------- */


// -- ajax Form Add Color--
$(document).on('click','.addColor', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Color');
});
$("#addColor").click(function() {
    $.ajax({
        type: 'POST',
        url: 'colors',
        data: {
            '_token': $('input[name=_token]').val(),
            'color': $('input[name=colorName]').val()
        },
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.color === 'undefined') {
                    $('.color').addClass('hidden');
                }
                $('.color').text(data.errors.color);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='color" + data.id + "'>"+
                    "<td>" + data.color + "</td>"+
                    "<td><a class='edit-color btn btn-warning btn-sm' data-id='" + data.id + "' data-color='" + data.color + "'><span class='fa fa-edit'></span></a> <a class='delete-color btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        },
    });
    $('#colorName').val('');
});


// function Edit Color
$(document).on('click', '.edit-color', function() {
    $('#footer_action_button').text(" Update Color");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteColor');
    $('.actionBtn').addClass('editColor');
    $('.modal-title').text('Color Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#ecolorName').val($(this).data('color'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editColor', function() {
    $.ajax({
        type: 'POST',
        url: 'colors/' + $('#fid').val(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method1]').val(),
            'id': $("#fid").val(),
            'color': $('#ecolorName').val()
        },
        success: function(data) {
            $('#color' + data.id).replaceWith(" "+
                "<tr id='color" + data.id + "'>"+
                "<td>" + data.color + "</td>"+
                "<td><a class='edit-color btn btn-warning btn-sm' data-id='" + data.id + "' data-color='" + data.color + "'><span class='fa fa-edit'></span></a> <a class='delete-color btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-color', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteColor');
    $('.modal-title').text('Delete Color');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteColor', function(){
    $.ajax({
        type: 'POST',
        url: 'colors/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#color' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
06. Size CRUD
--------------------------------------------- */


// -- ajax Form Add Size--
$(document).on('click','.addSize', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Size');
});
$("#addSize").click(function() {
    $.ajax({
        type: 'POST',
        url: 'sizes',
        data: {
            '_token': $('input[name=_token]').val(),
            'size': $('input[name=sizeName]').val()
        },
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.size === 'undefined') {
                    $('.size').addClass('hidden');
                }
                $('.size').text(data.errors.size);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='size" + data.id + "'>"+
                    "<td>" + data.size + "</td>"+
                    "<td><a class='edit-size btn btn-warning btn-sm' data-id='" + data.id + "' data-size='" + data.size + "'><span class='fa fa-edit'></span></a> <a class='delete-size btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        },
    });
    $('#sizeName').val('');
});


// function Edit Size
$(document).on('click', '.edit-size', function() {
    $('#footer_action_button').text(" Update Size");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteSize');
    $('.actionBtn').addClass('editSize');
    $('.modal-title').text('Size Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#esizeName').val($(this).data('size'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editSize', function() {
    $.ajax({
        type: 'POST',
        url: 'sizes/' + $('#fid').val(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method1]').val(),
            'id': $("#fid").val(),
            'size': $('#esizeName').val()
        },
        success: function(data) {
            $('#size' + data.id).replaceWith(" "+
                "<tr id='size" + data.id + "'>"+
                "<td>" + data.size + "</td>"+
                "<td><a class='edit-size btn btn-warning btn-sm' data-id='" + data.id + "' data-size='" + data.size + "'><span class='fa fa-edit'></span></a> <a class='delete-size btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-size', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteSize');
    $('.modal-title').text('Delete Size');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteSize', function(){
    $.ajax({
        type: 'POST',
        url: 'sizes/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#size' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
07. Tag CRUD
--------------------------------------------- */


// -- ajax Form Add Tag--
$(document).on('click','.addTag', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Tag');
});
$("#addTag").click(function() {
    $.ajax({
        type: 'POST',
        url: 'tags',
        data: {
            '_token': $('input[name=_token]').val(),
            'tag': $('input[name=tagName]').val()
        },
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.tag === 'undefined') {
                    $('.tag').addClass('hidden');
                }
                $('.tag').text(data.errors.tag);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='tag" + data.id + "'>"+
                    "<td>" + data.tagName + "</td>"+
                    "<td><a class='edit-tag btn btn-warning btn-sm' data-id='" + data.id + "' data-tag='" + data.tagName + "'><span class='fa fa-edit'></span></a> <a class='delete-tag btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        },
    });
    $('#tagName').val('');
});


// function Edit Tag
$(document).on('click', '.edit-tag', function() {
    $('#footer_action_button').text(" Update Tag");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteTag');
    $('.actionBtn').addClass('editTag');
    $('.modal-title').text('Tag Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#etagName').val($(this).data('tag'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editTag', function() {
    $.ajax({
        type: 'POST',
        url: 'tags/' + $('#fid').val(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method1]').val(),
            'id': $("#fid").val(),
            'tag': $('#etagName').val()
        },
        success: function(data) {
            $('#tag' + data.id).replaceWith(" "+
                "<tr id='tag" + data.id + "'>"+
                "<td>" + data.tagName + "</td>"+
                "<td><a class='edit-tag btn btn-warning btn-sm' data-id='" + data.id + "' data-tag='" + data.tagName + "'><span class='fa fa-edit'></span></a> <a class='delete-tag btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-tag', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteTag');
    $('.modal-title').text('Delete Tag');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteTag', function(){
    $.ajax({
        type: 'POST',
        url: 'tags/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#tag' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
08. Product CRUD
--------------------------------------------- */


// -- ajax Form Add Product--
$(document).on('click','.addProduct', function(e) {
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
        url: 'products',
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
$(document).on('click', '.edit-product', function(e) {
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

    if($(this).data('combo'))
    {
        $('#ecombo').prop( "checked", true );
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
        url: 'products/' + $('#ID').val(),
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
                    "<td>" + $('#ebrand_id >option:selected').text() + "</td>" +
                    "<td>৳ " + data.product.regularPrice + "</td>" +
                    "<td><a class='show-product btn btn-info btn-sm' data-id='" + data.product.id + "' data-productName='" + data.product.productName + "' data-image='" + data.image.image1 + "' data-sku='" + data.product.sku + "' data-category='" + $('#category_id >option:selected').text() + "' data-subcategory='" + $('#subcategory_id >option:selected').text() + "' data-minicategory='" + $('#minicategory_id >option:selected').text() + "' data-tab='" + $('#tab_id >option:selected').text() + "' data-brand='" + $('#brand_id >option:selected').text() +"' data-regularPrice='" + data.product.regularPrice + "' data-description='" + data.product.description + "' data-specification='" + data.product.specification + "' data-color='" + colors + "' data-size='" + sizes + "' data-tag='" + tags + "' data-type='" + $('#type >option:selected').text() +  "' data-payment='" + $('#paymentOption >option:selected').text() + "' data-availability='" + $('#availability >option:selected').text()+ "' data-deal_id='" + $('#deal_id >option:selected').text() + "'><span class='fa fa-eye'></span></a><a class='edit-product btn btn-warning btn-sm' data-id='" + data.product.id + "' data-productName='" + data.product.productName + "' data-sku='" + data.product.sku + "' data-category_id='" + $('#category_id >option:selected').val() + "' data-subcategory_id='" + $('#subcategory_id >option:selected').val() + "' data-minicategory_id='" + $('#minicategory_id >option:selected').val() + "' data-tab_id='" + $('#tab_id >option:selected').val() + "' data-subcategory='" + $('#subcategory_id >option:selected').text() + "' data-minicategory='" + $('#minicategory_id >option:selected').text() + "' data-tab='" + $('#tab_id >option:selected').text() + "' data-brand_id='" + $('#brand_id >option:selected').val() + "' data-regularPrice='" + data.product.regularPrice + "' data-short_description='" + data.product.shortDescription + "' data-description='" + data.product.description + "' data-specification='" + data.product.specification + "' data-color='" + colors + "' data-size='" + sizes + "' data-tag='" + tags + "' data-type='" + $('#type >option:selected').val() + "' data-payment='" + $('#epaymentOption >option:selected').val() + "' data-availability='" + $('#availability >option:selected').val()+ "' data-deal_id='" + $('#deal_id >option:selected').val()  + "'><span class='fa fa-edit'></span></a> <a class='delete-product btn btn-danger btn-sm' data-id='" + data.product.id + "'><span class='fa fa-trash'></span></a></td>" +
                    "</tr>");
                    location.reload();
            }
        }
    });
});


// form published function
$(document).on('click', '.publish-product', function(e) {
    e.preventDefault();
    $('#footer_action_button').text("Publish");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').addClass('publishProduct');
    $('.modal-title').text('Publish this Product');
    $('.pId').text($(this).data('id'));
    $('.publishContent').show();
    $('#publish').modal('show');
});

$('.modal-footer').on('click', '.publishProduct', function(){
    $.ajax({
        type: 'PUT',
        url: 'published-product/'+$('.pId').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.pId').text()
        },
        success: function(){
            $('#product' + $('.id').text()).remove();
            location.reload();
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
        url: 'products/'+$('.id').text(),
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
    if($(this).data('combo'))
    {
        $('#scombo').prop( "checked", true );
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
09. Message CRUD
--------------------------------------------- */

// form send message
$(document).on('click', '.email-message', function(e) {
    e.preventDefault();

    $('.modal-title').text('Quick Email');
    $('#messageId').val($(this).attr('messageId'));
    $('#to').val($(this).data('to'));
    $('#subject').val($(this).data('subject'));
    $('#create').modal('show');
});

// form Delete function
$(document).on('click', '.delete-message', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteMessage');
    $('.modal-title').text('Delete Product');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteMessage', function(){
    $.ajax({
        type: 'POST',
        url: base_url + '/messages/' + $('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#message' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
  10. Partner CRUD
--------------------------------------------- */


// -- ajax Form Add Partner--
$(document).on('click','.addPartner', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Partner');
});
$("#partner-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'partners',
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.companyUrl === 'undefined') {
                    $('.companyUrl').addClass('hidden');
                }
                $('.companyUrl').text(data.errors.companyUrl);
                if (typeof data.errors.brandLogo === 'undefined') {
                    $('.phone1').addClass('hidden');
                }
                $('.brandLogo').text(data.errors.brandLogo);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='partner" + data.id + "'>"+
                    "<td>" + data.companyUrl + "</td>"+
                    "<td><img src='storage/images/brands/" + data.brandLogo + "'></td>"+
                    "<td><a class='edit-partner btn btn-warning btn-sm' data-id='" + data.id + "' data-companyUrl='" + data.companyUrl + "' data-brandLogo='" + data.brandLogo + "'><span class='fa fa-edit'></span></a> <a class='delete-partner btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        },
    });
    $('#partner-form input').val('');
});


// function Edit Partner
$(document).on('click', '.edit-partner', function() {
    $('.actionBtn').hide();
    $('.modal-title').text('Partner Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#ecompanyUrl').val($(this).data('companyurl'));
    $('#myModal').modal('show');
});

$('#updatePartner').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_method', 'PUT');
    $.ajax({
        type: 'POST',
        url: 'partners/' + $('#fid').val(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $('#partner' + data.id).replaceWith(" "+
                "<tr id='partner" + data.id + "'>"+
                "<td>" + data.companyUrl + "</td>"+
                "<td><img src='storage/images/brands/" + data.brandLogo + "'></td>"+
                "<td><a class='edit-partner btn btn-warning btn-sm' data-id='" + data.id + "' data-companyUrl='" + data.companyUrl + "' data-brandLogo='" + data.brandLogo + "'><span class='fa fa-edit'></span></a> <a class='delete-partner btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-partner', function() {
    $('.actionBtn').show();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deletePartner');
    $('.modal-title').text('Delete Partner');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deletePartner', function(){
    $.ajax({
        type: 'POST',
        url: 'partners/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#partner' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
  11. Subcategory CRUD
--------------------------------------------- */


// -- ajax Form Add Subcategory--
$(document).on('click','.addSubcategory', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Category');
});
$("#addSubcategory").click(function() {
    $.ajax({
        type: 'POST',
        url: 'sub-categories',
        data: {
            'category_id': $('#category_id').val(),
            'subCategoryName': $('input[name=subCategoryName]').val()
        },
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.subCategoryName === 'undefined') {
                    $('.subCategoryName').addClass('hidden');
                }
                $('.error').text(data.errors.subCategoryName);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='subcategory" + data.id + "'>"+
                    "<td>" + $('#category_id >option:selected').text() + "</td>"+
                    "<td>" + data.subCategoryName + "</td>"+
                    "<td><a class='edit-subcategory btn btn-warning btn-sm' data-id='" + data.id + "' data-subCategoryName='" + data.subCategoryName + "'><span class='fa fa-edit'></span></a> <a class='delete-subcategory btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        },
    });
    $('#subCategoryName').val('');
});


// function Edit Subcategory
$(document).on('click', '.edit-subcategory', function() {
    $('#footer_action_button').text(" Update SubCategory");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteSubCategory');
    $('.actionBtn').addClass('editSubCategory');
    $('.modal-title').text('SubCategory Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $("option:selected").prop("selected", false);
    $('#esubCategoryName').val($(this).data('subcategoryname'));
    var  category_id = $(this).data('category_id');
    $("#ecategory_id > option").each(function(){
        if ($(this).val() == category_id){
            $(this).prop("selected", true);
        }
    });
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editSubCategory', function() {
    $.ajax({
        type: 'POST',
        url: 'sub-categories/' + $('#fid').val(),
        data: {
            '_method': $('input[name=_method1]').val(),
            'id': $("#fid").val(),
            'category_id': $('#ecategory_id').val(),
            'subCategoryName': $('#esubCategoryName').val()
        },
        success: function(data) {
            $('#subcategory' + data.id).replaceWith(" "+
                "<tr id='subcategory" + data.id + "'>"+
                "<td>" + $('#ecategory_id >option:selected').text() + "</td>"+
                "<td>" + data.subCategoryName + "</td>"+
                "<td><a class='edit-subcategory btn btn-warning btn-sm' data-id='" + data.id + "' data-subCategoryName='" + data.subCategoryName + "'><span class='fa fa-edit'></span></a> <a class='delete-subcategory btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-subcategory', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteSubCategory');
    $('.modal-title').text('Delete SubCategory');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteSubCategory', function(){
    $.ajax({
        type: 'POST',
        url: 'sub-categories/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#subcategory' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
  12. Brand CRUD
--------------------------------------------- */


// -- ajax Form Add Brand--
$(document).on('click','.addBrand', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Brand');
});
$("#brand_add_form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.image === 'undefined') {
                    $('.image').addClass('hidden');
                }
                $('.image').text(data.errors.image);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='brand" + data.id + "'>"+
                    "<td>" + data.brandName + "</td>"+
                    "<td><img src='storage/images/brand/" + data.brandImage + "' height='60px' width='60px'></td>"+
                    "<td><a class='edit-brand btn btn-warning btn-sm' data-id='" + data.id + "' data-image='" + data.brandImage + "' data-brandName='" + data.brandName + "'><span class='fa fa-edit'></span></a> <a class='delete-brand btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        }
    });
    $('#brand_add_form input').val('');
});



// function Edit Slider
$(document).on('click', '.edit-brand', function() {
    $('.actionBtn').hide();
    $('.modal-title').text('Brand Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#brand_name').val($(this).data('brand_name'));
    $('#myModal').modal('show');
});

$('#brand_update_form').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_method', 'PUT');
    $.ajax({
        type: 'POST',
        url: $(this).attr('action') + '/' + $('#fid').val(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.image === 'undefined') {
                    $('.image').addClass('hidden');
                }
                $('.image').text(data.errors.image);
            } else {
                $('.error').addClass('hidden');
                $('#slider' + data.id).replaceWith("<tr id='slider" + data.id + "'>"+
                    "<td>" + data.slider_link + "</td>"+
                    "<td><img src='storage/images/brand/" + data.brandImage + "' height='60px' width='60px'></td>"+
                    "<td><a class='edit-brand btn btn-warning btn-sm' data-id='" + data.id + "' data-image='" + data.brandImage + "' data-brand_name='" + data.brandName + "'><span class='fa fa-edit'></span></a> <a class='delete-brand btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");

                $('#myModal').modal('hide');
                location.reload();
            }
        }
    });
});



// form Delete function
$(document).on('click', '.delete-brand', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteBrand');
    $('.modal-title').text('Delete Brand');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteBrand', function(){
    $.ajax({
        type: 'POST',
        url: 'brands/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#brand' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
  13. Industry CRUD
--------------------------------------------- */


// -- ajax Form Add Industry--
$(document).on('click','.addIndustry', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Industry');
});
$("#addIndustry").click(function() {
    $.ajax({
        type: 'POST',
        url: 'industries',
        data: {
            'industryName': $('input[name=industryName]').val()
        },
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.industryName === 'undefined') {
                    $('.industryName').addClass('hidden');
                }
                $('.industryName').text(data.errors.industryName);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='industry" + data.id + "'>"+
                    "<td>" + data.industryName + "</td>"+
                    "<td><a class='edit-industry btn btn-warning btn-sm' data-id='" + data.id + "' data-industryName='" + data.industryName + "'><span class='fa fa-edit'></span></a> <a class='delete-industry btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        },
    });
    $('#industryName').val('');
});


// function Edit Industry
$(document).on('click', '.edit-industry', function() {
    $('#footer_action_button').text(" Update Industry");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteIndustry');
    $('.actionBtn').addClass('editIndustry');
    $('.modal-title').text('Industry Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#eindustryName').val($(this).data('industryname'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editIndustry', function() {
    $.ajax({
        type: 'POST',
        url: 'industries/' + $('#fid').val(),
        data: {
            '_method': $('input[name=_method1]').val(),
            'id': $("#fid").val(),
            'industryName': $('#eindustryName').val()
        },
        success: function(data) {
            $('#industry' + data.id).replaceWith(" "+
                "<tr id='industry" + data.id + "'>"+
                "<td>" + data.industryName + "</td>"+
                "<td><a class='edit-industry btn btn-warning btn-sm' data-id='" + data.id + "' data-industryName='" + data.industryName + "'><span class='fa fa-edit'></span></a> <a class='delete-industry btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-industry', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteIndustry');
    $('.modal-title').text('Delete Industry');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteIndustry', function(){
    $.ajax({
        type: 'POST',
        url: 'industries/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#industry' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
  14. Client CRUD
--------------------------------------------- */

// form Delete function
$(document).on('click', '.delete-client', function() {
    $('#footer_action_button').text(" Delete");
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteClient');
    $('.modal-title').text('Delete Client');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteClient', function(){
    $.ajax({
        type: 'POST',
        url: 'clients/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#client' + $('.id').text()).remove();
        }
    });
});





/*-------------------------------------------
  15. Coupon CRUD
--------------------------------------------- */


// -- ajax Form Add Coupon--
$(document).on('click','.addCoupon', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Coupon');
});
$("#addCoupon").click(function() {
    // Get the form
    var  form = $('#discount-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.coupon_code === 'undefined') {
                    $('.coupon_code').addClass('hidden');
                }
                $('.coupon_code').text(data.errors.coupon_code);
                if (typeof data.errors.discount_value === 'undefined') {
                    $('.discount_value').addClass('hidden');
                }
                $('.discount_value').text(data.errors.discount_value);
                if (typeof data.errors.valid_from === 'undefined') {
                    $('.valid_from').addClass('hidden');
                }
                $('.valid_from').text(data.errors.valid_from);
                if (typeof data.errors.valid_until === 'undefined') {
                    $('.valid_until').addClass('hidden');
                }
                $('.valid_until').text(data.errors.valid_until);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='discount" + data.id + "'>"+
                    "<td>" + data.coupon_code + "</td>"+
                    "<td>" + $('#discount_unit >option:selected').text() + "</td>"+
                    "<td>" + data.discount_value + "</td>"+
                    "<td>" + data.product_id + "</td>"+
                    "<td>" + data.limit_per_coupon + "</td>"+
                    "<td>" + data.valid_until + "</td>"+
                    "<td><a class='show-discount btn btn-info btn-sm' data-id='" + data.id + "' data-product_id='" + data.product_id + "' data-exclude_product_id='" + data.exclude_product_id + "' data-category_id='" + data.category_id + "' data-exclude_category_id='" + data.exclude_category_id + "' data-limit_per_coupon='" + data.limit_per_coupon + "' data-limit_per_client='" + data.limit_per_client + "' data-discount_value='" + data.discount_value + "' data-discount_unit='" + data.discount_unit + "' data-valid_from='" + data.valid_from + "' data-valid_until='" + data.valid_until + "' data-coupon_code='" + data.coupon_code + "' data-minimum_order_value='" + data.minimum_order_value + "' data-maximum_order_value='" + data.maximum_order_value + "' data-is_free_shipping_active='" + data.limit_per_client + "' data-discount_value='" + data.discount_value + "' data-discount_unit='" + data.is_free_shipping_active + "' data-maximum_discount_amount='" + data.maximum_discount_amount + "' data-is_redeem_allowed='" + data.is_redeem_allowed + "'><span class='fa fa-eye'></span></a> <a class='edit-discount btn btn-warning btn-sm' data-id='" + data.id + "' data-product_id='" + data.product_id + "' data-exclude_product_id='" + data.exclude_product_id + "' data-category_id='" + data.category_id + "' data-exclude_category_id='" + data.exclude_category_id + "' data-limit_per_coupon='" + data.limit_per_coupon + "' data-limit_per_client='" + data.limit_per_client + "' data-discount_value='" + data.discount_value + "' data-discount_unit='" + data.discount_unit + "' data-valid_from='" + data.valid_from + "' data-valid_until='" + data.valid_until + "' data-coupon_code='" + data.coupon_code + "' data-minimum_order_value='" + data.minimum_order_value + "' data-maximum_order_value='" + data.maximum_order_value + "' data-is_free_shipping_active='" + data.limit_per_client + "' data-discount_value='" + data.discount_value + "' data-discount_unit='" + data.is_free_shipping_active + "' data-maximum_discount_amount='" + data.maximum_discount_amount + "' data-is_redeem_allowed='" + data.is_redeem_allowed + "'><span class='fa fa-edit'></span></a> <a class='delete-discount btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
                $(form).trigger("reset");
            }
        }
    });
});


// Show function
$(document).on('click', '.show-discount', function() {
    // Set redeem allowed text value
    if ($(this).data('is_redeem_allowed') == 0)
        var is_redeem_allowed = 'Yes';
    else
        var is_redeem_allowed = 'No';

    // Set discount_unit text value
    if ($(this).data('discount_unit') == 0)
        var discount_unit = 'Percentage discount';
    else  if ($(this).data('discount_unit') == 1)
        var discount_unit = 'Fixed cart discount';
    else
        var discount_unit = 'Fixed product discount';

    // Set is_free_shipping_activetext value
    if ($(this).data('is_free_shipping_active') == 0)
        var is_free_shipping_active = 'Yes';
    else
        var is_free_shipping_active = 'No';

    // Show modal & set values
    $('#show').modal('show');
    $('#cp_code').text($(this).data('coupon_code'));
    $('#is_ra').text(is_redeem_allowed);
    $('#ds_unit').text(discount_unit);
    $('#ds_value').text($(this).data('discount_value'));
    $('#vl_form').text($(this).data('valid_from'));
    $('#vl_untill').text($(this).data('valid_until'));
    $('#mn_or_val').text($(this).data('minimum_order_value'));
    $('#mx_or_val').text($(this).data('maximum_order_value'));
    $('#mx_ds_am').text($(this).data('maximum_discount_amount'));
    $('#is_f_s_a').text(is_free_shipping_active);
    $('#pr_id').text($(this).data('product_id'));
    $('#ex_pr_id').text($(this).data('exclude_product_id'));
    $('#ct_id').text($(this).data('category_id'));
    $('#ex_ct_id').text($(this).data('exclude_category_id'));
    $('#lm_per_cp').text($(this).data('limit_per_coupon'));
    $('#lm_per_user').text($(this).data('limit_per_client'));
    $('.modal-title').text('Show Coupon');
});


// function Edit Coupon
$(document).on('click', '.edit-discount', function() {
    $('#footer_action_button').text(" Update Discount");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteDiscount');
    $('.actionBtn').addClass('editDiscount');
    $('.modal-title').text('Coupon Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();

    // Assign values
    $('#fid').val($(this).data('id'));
    $('#ecoupon_code').val($(this).data('coupon_code'));
    $('#ediscount_value').val($(this).data('discount_value'));
    $('#eminimum_order_value').val($(this).data('minimum_order_value'));
    $('#emaximum_order_value').val($(this).data('maximum_order_value'));
    $('#emaximum_discount_amount').val($(this).data('maximum_discount_amount'));
    $('#elimit_per_coupon').val($(this).data('limit_per_coupon'));
    $('#elimit_per_client').val($(this).data('limit_per_client'));

    // Set valid_from date time
    var valid_from = $('#evalid_from');
    valid_from.datepicker('setDate', new Date($(this).data('valid_from')));

    // Set valid_until date time
    var valid_until = $('#evalid_until');
    valid_until.datepicker('setDate', new Date($(this).data('valid_until')));

    // Get the value
    var is_redeem_allowed = $(this).data('is_redeem_allowed');

    // Loop over each select option
    $("#eis_redeem_allowed > option").each(function(){
        // Check for the matching field
        if ($(this).val() == is_redeem_allowed){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the value
    var discount_unit = $(this).data('discount_unit');

    // Loop over each select option
    $("#ediscount_value > option").each(function(){
        // Check for the matching field
        if ($(this).val() == discount_unit){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the value
    var is_free_shipping_active = $(this).data('is_free_shipping_active');

    // Loop over each select option
    $("#eis_free_shipping_active > option").each(function(){
        // Check for the matching field
        if ($(this).val() == is_free_shipping_active){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the value
    var product_id = $(this).data('product_id');

    // Loop over each select option
    $("#eproduct_id > option").each(function(){
        // Check for the matching field
        if ($(this).val() == product_id){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the value
    var exclude_product_id = $(this).data('exclude_product_id');

    // Loop over each select option
    $("#eexclude_product_id > option").each(function(){
        // Check for the matching field
        if ($(this).val() == exclude_product_id){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the value
    var category_id = $(this).data('category_id');

    // Loop over each select option
    $("#ecategory_id > option").each(function(){
        // Check for the matching field
        if ($(this).val() == category_id){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the value
    var exclude_category_id = $(this).data('exclude_category_id');

    // Loop over each select option
    $("#eexclude_category_id > option").each(function(){
        // Check for the matching field
        if ($(this).val() == exclude_category_id){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editDiscount', function() {
    // Get the form
    var  form = $('#discountEdit-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action') + '/' + $('#fid').val(),
        data: formData,
        success: function(data) {
            $('#discount' + data.id).replaceWith(" "+
                "<tr id='discount" + data.id + "'>"+
                "<td>" + data.coupon_code + "</td>"+
                "<td>" + $('#discount_unit >option:selected').text() + "</td>"+
                "<td>" + data.discount_value + "</td>"+
                "<td>" + data.product_id + "</td>"+
                "<td>" + data.limit_per_coupon + "</td>"+
                "<td>" + data.valid_until + "</td>"+
                "<td><a class='show-discount btn btn-info btn-sm' data-id='" + data.id + "' data-product_id='" + data.product_id + "' data-exclude_product_id='" + data.exclude_product_id + "' data-category_id='" + data.category_id + "' data-exclude_category_id='" + data.exclude_category_id + "' data-limit_per_coupon='" + data.limit_per_coupon + "' data-limit_per_client='" + data.limit_per_client + "' data-discount_value='" + data.discount_value + "' data-discount_unit='" + data.discount_unit + "' data-valid_from='" + data.valid_from + "' data-valid_until='" + data.valid_until + "' data-coupon_code='" + data.coupon_code + "' data-minimum_order_value='" + data.minimum_order_value + "' data-maximum_order_value='" + data.maximum_order_value + "' data-is_free_shipping_active='" + data.limit_per_client + "' data-discount_value='" + data.discount_value + "' data-discount_unit='" + data.is_free_shipping_active + "' data-maximum_discount_amount='" + data.maximum_discount_amount + "' data-is_redeem_allowed='" + data.is_redeem_allowed + "'><span class='fa fa-eye'></span></a> <a class='edit-discount btn btn-warning btn-sm' data-id='" + data.id + "' data-product_id='" + data.product_id + "' data-exclude_product_id='" + data.exclude_product_id + "' data-category_id='" + data.category_id + "' data-exclude_category_id='" + data.exclude_category_id + "' data-limit_per_coupon='" + data.limit_per_coupon + "' data-limit_per_client='" + data.limit_per_client + "' data-discount_value='" + data.discount_value + "' data-discount_unit='" + data.discount_unit + "' data-valid_from='" + data.valid_from + "' data-valid_until='" + data.valid_until + "' data-coupon_code='" + data.coupon_code + "' data-minimum_order_value='" + data.minimum_order_value + "' data-maximum_order_value='" + data.maximum_order_value + "' data-is_free_shipping_active='" + data.limit_per_client + "' data-discount_value='" + data.discount_value + "' data-discount_unit='" + data.is_free_shipping_active + "' data-maximum_discount_amount='" + data.maximum_discount_amount + "' data-is_redeem_allowed='" + data.is_redeem_allowed + "'><span class='fa fa-edit'></span></a> <a class='delete-discount btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-discount', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteDiscount');
    $('.modal-title').text('Delete Discount');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteDiscount', function(){
    $.ajax({
        type: 'POST',
        url: 'discounts/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method1]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#discount' + $('.id').text()).remove();
        }
    });
});





/*-------------------------------------------
  16. Membership Type CRUD
--------------------------------------------- */


// -- ajax Form Add Membership--
$(document).on('click','.addMembership', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Membership');
});
$("#addMembership").click(function() {
    // Get the form
    var  form = $('#membershipAdd-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.discount_value === 'undefined') {
                    $('.discount_value').addClass('hidden');
                }
                $('.discount_value').text(data.errors.discount_value);
                if (typeof data.errors.valid_until === 'undefined') {
                    $('.valid_until').addClass('hidden');
                }
                $('.valid_until').text(data.errors.valid_until);
            } else {
                // membership_type
                if (data.membership_type == 0){
                    var  membership_type = 'Prime';
                }else if(data.membership_type == 1){
                    var  membership_type = 'Silver';
                }else if(data.membership_type == 2){
                    var  membership_type = 'Gold';
                }else if(data.membership_type == 3){
                    var  membership_type = 'Diamond';
                }else{
                    var  membership_type = 'Platinum';
                }
                // discount_unit
                if (data.discount_unit == 0){
                    var  discount_unit = 'Percentage discount';
                }else if(data.discount_unit == 1){
                    var  discount_unit = 'Fixed cart discount';
                }else{
                    var  discount_unit = 'Fixed product discount';
                }
                // discount_unit
                if (data.is_free_shipping_active == 0){
                    var  is_free_shipping_active = 'Yes';
                }else{
                    var  is_free_shipping_active = 'No';
                }
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='membership" + data.id + "'>"+
                    "<td>" + membership_type + "</td>"+
                    "<td>" + discount_unit + "</td>"+
                    "<td>" + data.discount_value + "</td>"+
                    "<td>" + data.valid_until + "</td>"+
                    "<td>" + is_free_shipping_active + "</td>"+
                    "<td><a class='edit-membership btn btn-warning btn-sm' data-id='" + data.id + "' data-membership_type='" + data.membership_type + "' data-discount_unit='" + data.discount_unit + "' data-discount_value='" + data.discount_value + "'  data-is_free_shipping_active='" + data.is_free_shipping_active + "' data-valid_until='" + data.valid_until + "'><span class='fa fa-edit'></span></a> <a class='delete-membership btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        }
    });
    $(form).trigger("reset");
});


// function Edit Membership
$(document).on('click', '.edit-membership', function() {
    $('#footer_action_button').text(" Update Membership");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteMembership');
    $('.actionBtn').addClass('editMembership');
    $('.modal-title').text('Membership Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();

    // Set valid_until date time
    var valid_until = $('#evalid_until');
    valid_until.datepicker('setDate', new Date($(this).data('valid_until')));

    // Get the value
    var membership_type = $(this).data('membership_type');

    // Loop over each select option
    $("#emembership_type > option").each(function(){
        // Check for the matching field
        if ($(this).val() == membership_type){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the value
    var discount_unit = $(this).data('discount_unit');

    // Loop over each select option
    $("#ediscount_unit > option").each(function(){
        // Check for the matching field
        if ($(this).val() == discount_unit){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the value
    var is_free_shipping_active = $(this).data('is_free_shipping_active');

    // Loop over each select option
    $("#eis_free_shipping_active > option").each(function(){
        // Check for the matching field
        if ($(this).val() == is_free_shipping_active){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    $('#ediscount_value').val($(this).data('discount_value'));
    $('#fid').val($(this).data('id'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editMembership', function() {
    // Get the form
    var  form = $('#membershipEdit-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action') + '/' + $('#fid').val() ,
        data: formData,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.discount_value === 'undefined') {
                    $('.discount_value').addClass('hidden');
                }
                $('.discount_value').text(data.errors.discount_value);
                if (typeof data.errors.valid_until === 'undefined') {
                    $('.valid_until').addClass('hidden');
                }
                $('.valid_until').text(data.errors.valid_until);
            } else {
                // membership_type
                if (data.membership_type == 0) {
                    var membership_type = 'Prime';
                } else if (data.membership_type == 1) {
                    var membership_type = 'Silver';
                } else if (data.membership_type == 2) {
                    var membership_type = 'Gold';
                } else if (data.membership_type == 3) {
                    var membership_type = 'Diamond';
                } else {
                    var membership_type = 'Platinum';
                }
                // discount_unit
                if (data.discount_unit == 0) {
                    var discount_unit = 'Percentage discount';
                } else if (data.discount_unit == 1) {
                    var discount_unit = 'Fixed cart discount';
                } else {
                    var discount_unit = 'Fixed product discount';
                }
                // discount_unit
                if (data.is_free_shipping_active == 0) {
                    var is_free_shipping_active = 'Yes';
                } else {
                    var is_free_shipping_active = 'No';
                }
                $('#membership' + data.id).replaceWith(" " +
                    "<tr id='membership" + data.id + "'>" +
                    "<td>" + membership_type + "</td>" +
                    "<td>" + discount_unit + "</td>" +
                    "<td>" + data.discount_value + "</td>" +
                    "<td>" + data.valid_until + "</td>" +
                    "<td>" + is_free_shipping_active + "</td>" +
                    "<td><a class='edit-membership btn btn-warning btn-sm' data-id='" + data.id + "' data-membership_type='" + data.membership_type + "' data-discount_unit='" + data.discount_unit + "' data-discount_value='" + data.discount_value + "'  data-is_free_shipping_active='" + data.is_free_shipping_active + "' data-valid_until='" + data.valid_until + "'><span class='fa fa-edit'></span></a> <a class='delete-membership btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>" +
                    "</tr>");
            }
        }
    });
});


// form Delete function
$(document).on('click', '.delete-membership', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteMembership');
    $('.modal-title').text('Delete Membership');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteMembership', function(){
    $.ajax({
        type: 'POST',
        url: 'membership_types/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method1]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#membership' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
  17. Salesman CRUD
--------------------------------------------- */


// -- ajax Form Add Salesman--
$(document).on('click','.addSalesmen', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Salesman');
});
$("#addSalesmen").click(function() {
    // Get the form
    var  form = $('#salesman-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.salesmanName === 'undefined') {
                    $('.salesmanName').addClass('hidden');
                }
                $('.salesmanName').text(data.errors.salesmanName);
                if (typeof data.errors.designation === 'undefined') {
                    $('.designation').addClass('hidden');
                }
                $('.designation').text(data.errors.designation);
                if (typeof data.errors.email === 'undefined') {
                    $('.email').addClass('hidden');
                }
                $('.email').text(data.errors.email);
                if (typeof data.errors.phone === 'undefined') {
                    $('.phone').addClass('hidden');
                }
                $('.phone').text(data.errors.phone);
                if (typeof data.errors.password === 'undefined') {
                    $('.password').addClass('hidden');
                }
                $('.password').text(data.errors.password);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='salesman" + data.id + "'>"+
                    "<td>" + data.salesmanName + "</td>"+
                    "<td>" + data.designation + "</td>"+
                    "<td>" + data.email + "</td>"+
                    "<td>" + data.phone + "</td>"+
                    "<td>" + data.address + "</td>"+
                    "<td>" + data.country + "</td>"+
                    "<td>" + data.division + "</td>"+
                    "<td>" + data.city + "</td>"+
                    "<td>" + data.zipCode + "</td>"+
                    "<td><a class='edit-salesman btn btn-warning btn-sm' data-id='" + data.id + "' data-salesmanName='" + data.salesmanName + "' data-designation='" + data.designation + "' data-email='" + data.email + "' data-phone='" + data.phone + "'  data-address='" + data.address + "' data-country='" + data.country + "' data-division='" + data.division + "'  data-city='" + data.city + "' data-zipCode='" + data.zipCode + "'><span class='fa fa-edit'></span></a> <a class='delete-salesman btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        }
    });
    $(form).trigger("reset");
});


// function Edit Salesman
$(document).on('click', '.edit-salesman', function() {
    $('#footer_action_button').text(" Update Salesman");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteSalesman');
    $('.actionBtn').addClass('editSalesman');
    $('.modal-title').text('Salesman Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();

    // Get the value
    var city = $(this).data('city');

    // Loop over each select option
    $("#city > option").each(function(){
        // Check for the matching field
        if ($(this).val() == city){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the value
    var country = $(this).data('country');

    // Loop over each select option
    $("#country > option").each(function(){
        // Check for the matching field
        if ($(this).val() == country){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the value
    var division = $(this).data('division');

    // Loop over each select option
    $("#division > option").each(function(){
        // Check for the matching field
        if ($(this).val() == division){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    $('#salesmanName').val($(this).data('salesmanname'));
    $('#designation').val($(this).data('designation'));
    $('#email').val($(this).data('email'));
    $('#phone').val($(this).data('phone'));
    $('#zipCode').val($(this).data('zipcode'));
    $('#address').val($(this).data('address'));
    $('#id').val($(this).data('id'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editSalesman', function() {
    // Get the form
    var  form = $('#salesman-update-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action') + '/' + $('#id').val() ,
        data: formData,
        success: function(data){
            $('#salesman' + data.id).replaceWith(" " +
                "<tr id='salesman" + data.id + "'>"+
                "<td>" + data.salesmanName + "</td>"+
                "<td>" + data.designation + "</td>"+
                "<td>" + data.email + "</td>"+
                "<td>" + data.phone + "</td>"+
                "<td>" + data.address + "</td>"+
                "<td>" + data.country + "</td>"+
                "<td>" + data.division + "</td>"+
                "<td>" + data.city + "</td>"+
                "<td>" + data.zipCode + "</td>"+
                "<td><a class='edit-salesman btn btn-warning btn-sm' data-id='" + data.id + "' data-salesmanName='" + data.salesmanName + "' data-designation='" + data.designation + "' data-email='" + data.email + "' data-phone='" + data.phone + "'  data-address='" + data.address + "' data-country='" + data.country + "' data-division='" + data.division + "'  data-city='" + data.city + "' data-zipCode='" + data.zipCode + "'><span class='fa fa-edit'></span></a> <a class='delete-salesman btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
    $(form).trigger("reset");
});


// form Delete function
$(document).on('click', '.delete-salesman', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteSalesman');
    $('.modal-title').text('Delete Salesman');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteSalesman', function(){
    $.ajax({
        type: 'POST',
        url: 'salesmen/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method1]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#salesman' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
  18. Salesman target CRUD
--------------------------------------------- */


// -- ajax Form Add Salesman target--
$(document).on('click','.addSalesmanTarget', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Salesman target');
});
$("#addSalesmanTarget").click(function() {
    // Get the form
    var  form = $('#salseman_target_add-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.salesman_id === 'undefined') {
                    $('.salesman_id').addClass('hidden');
                }
                $('.salesman_id').text(data.errors.salesman_id);
                if (typeof data.errors.client_target === 'undefined') {
                    $('.client_target').addClass('hidden');
                }
                $('.client_target').text(data.errors.client_target);
                if (typeof data.errors.month === 'undefined') {
                    $('.month').addClass('hidden');
                }
                $('.month').text(data.errors.month);
                if (typeof data.errors.year === 'undefined') {
                    $('.year').addClass('hidden');
                }
                $('.year').text(data.errors.year);
                if (typeof data.errors.sales_target === 'undefined') {
                    $('.sales_target').addClass('hidden');
                }
                $('.sales_target').text(data.errors.sales_target);
            } else {
                $('.error').addClass('hidden');

                if(data.month == 1)
                    var month = 'January';
                else if(data.month == 2)
                    var month = 'February';
                else if(data.month == 3)
                    var month = 'March';
                else if(data.month == 4)
                    var month = 'April';
                else if(data.month == 5)
                    var month = 'May';
                else if(data.month == 6)
                    var month = 'June';
                else if(data.month == 7)
                    var month = 'July';
                else if(data.month == 8)
                    var month = 'August';
                else if(data.month == 9)
                    var month = 'September';
                else if(data.month == 10)
                    var month = 'October';
                else if(data.month == 11)
                    var month = 'November';
                else if(data.month == 12)
                    var month = 'December';
                $('#example1').append("<tr id='salesmentarget" + data.id + "'>"+
                    "<td>" + $('#salesman_id >option:selected').text() + "</td>"+
                    "<td>" + data.client_target + "</td>"+
                    "<td>" + data.sales_target + "</td>"+
                    "<td>" + month + "</td>"+
                    "<td>" + data.year + "</td>"+
                    "<td><a class='edit-salesman_target btn btn-warning btn-sm' data-id='" + data.id + "' data-salesman_id='" + data.salesman_id + "' data-client_target='" + data.client_target + "' data-sales_target='" + data.sales_target + "' data-month='" + data.month + "'  data-year='" + data.year + "'><span class='fa fa-edit'></span></a> <a class='delete-salesman_target btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        }
    });
    $(form).trigger("reset");
});


// function Edit Salesman target
$(document).on('click', '.edit-salesman_target', function() {
    $('#footer_action_button').text(" Update Salesman target");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteSalesmanTarget');
    $('.actionBtn').addClass('editSalesmanTarget');
    $('.modal-title').text('Salesman target Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();

    // Get the value
    var month = $(this).data('month');

    // Loop over each select option
    $("#month > option").each(function(){
        // Check for the matching field
        if ($(this).val() == month){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    // Get the value
    var salesman_id = $(this).data('salesman_id');

    // Loop over each select option
    $("#salesman_id > option").each(function(){
        // Check for the matching field
        if ($(this).val() == salesman_id){
            // Select the matched option
            $(this).prop("selected", true);
        }
    });

    $('#client_target').val($(this).data('client_target'));
    $('#year').val($(this).data('year'));
    $('#sales_target').val($(this).data('sales_target'));
    $('#id').val($(this).data('id'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editSalesmanTarget', function() {
    // Get the form
    var  form = $('#salesman_target-update-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action') + '/' + $('#id').val() ,
        data: formData,
        success: function(data){
            if(data.month == 1)
                var month = 'January';
            else if(data.month == 2)
                var month = 'February';
            else if(data.month == 3)
                var month = 'March';
            else if(data.month == 4)
                var month = 'April';
            else if(data.month == 5)
                var month = 'May';
            else if(data.month == 6)
                var month = 'June';
            else if(data.month == 7)
                var month = 'July';
            else if(data.month == 8)
                var month = 'August';
            else if(data.month == 9)
                var month = 'September';
            else if(data.month == 10)
                var month = 'October';
            else if(data.month == 11)
                var month = 'November';
            else if(data.month == 12)
                var month = 'December';

            $('#salesmentarget' + data.id).replaceWith(" " +
                "<tr id='salesmentarget" + data.id + "'>"+
                "<td>" + $('#salesman_id >option:selected').text() + "</td>"+
                "<td>" + data.client_target + "</td>"+
                "<td>" + data.sales_target + "</td>"+
                "<td>" + month + "</td>"+
                "<td>" + data.year + "</td>"+
                "<td><a class='edit-salesman_target btn btn-warning btn-sm' data-id='" + data.id + "' data-salesman_id='" + data.salesman_id + "' data-client_target='" + data.client_target + "' data-sales_target='" + data.sales_target + "' data-month='" + data.month + "'  data-year='" + data.year + "'><span class='fa fa-edit'></span></a> <a class='delete-salesman_target btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
    $(form).trigger("reset");
});


// form Delete function
$(document).on('click', '.delete-salesman_target', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteSalesmanTarget');
    $('.modal-title').text('Delete Salesman Target');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteSalesmanTarget', function(){
    $.ajax({
        type: 'POST',
        url: 'salesmantargets/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method1]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#salesmentarget' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
  19. Slider CRUD
--------------------------------------------- */


// -- ajax Form Add Slider--
$(document).on('click','.addSlider', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Slider');
});
$("#slider_add-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.image === 'undefined') {
                    $('.image').addClass('hidden');
                }
                $('.image').text(data.errors.image);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='slider" + data.id + "'>"+
                    "<td><img src='storage/images/slider/" + data.image + "' height='100px' width='100px'></td>"+
                    "<td>" + data.slider_link + "</td>"+
                    "<td><a class='edit-slider btn btn-warning btn-sm' data-id='" + data.id + "' data-image='" + data.image + "' data-slider_link='" + data.slider_link + "'><span class='fa fa-edit'></span></a> <a class='delete-slider btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        }
    });
    $('#slider_add-form input').val('');
});


// function Edit Slider
$(document).on('click', '.edit-slider', function() {
    $('.actionBtn').hide();
    $('.modal-title').text('Slider Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#slider_link').val($(this).data('slider_link'));
    $('#myModal').modal('show');
});

$('#slider_update-form').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_method', 'PUT');
    $.ajax({
        type: 'POST',
        url: $(this).attr('action') + '/' + $('#fid').val(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.image === 'undefined') {
                    $('.image').addClass('hidden');
                }
                $('.image').text(data.errors.image);
            } else {
                $('.error').addClass('hidden');
                $('#slider' + data.id).replaceWith("<tr id='slider" + data.id + "'>"+
                    "<td><img src='storage/images/slider/" + data.image + "' height='100px' width='100px'></td>"+
                    "<td>" + data.slider_link + "</td>"+
                    "<td><a class='edit-slider btn btn-warning btn-sm' data-id='" + data.id + "' data-image='" + data.image + "' data-slider_link='" + data.slider_link + "'><span class='fa fa-edit'></span></a> <a class='delete-slider btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        }
    });
});


// form Delete function
$(document).on('click', '.delete-slider', function() {
    $('.actionBtn').show();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteSlider');
    $('.modal-title').text('Delete Slider');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteSlider', function(){
    $.ajax({
        type: 'POST',
        url: 'sliders/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#slider' + $('.id').text()).remove();
        }
    });
});






/*-------------------------------------------
  20. Minicategory CRUD
--------------------------------------------- */


// -- ajax Form Add Minicategory--
$(document).on('click','.addMiniCategory', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Minicategory');
});
$("#addMiniCategory").click(function() {
    // Get the form.
    var form = $('#add_mini_form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.miniCategoryName === 'undefined') {
                    $('.miniCategoryName').addClass('hidden');
                }
                $('.miniCategoryName').text(data.errors.miniCategoryName);
                if (typeof data.errors.category_id === 'undefined') {
                    $('.category_id').addClass('hidden');
                }
                $('.category_id').text(data.errors.category_id);
                if (typeof data.errors.subcategory_id === 'undefined') {
                    $('.subcategory_id').addClass('hidden');
                }
                $('.subcategory_id').text(data.errors.subcategory_id);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='minicategory" + data[0].id + "'>"+
                    "<td>" + data[0].miniCategoryName + "</td>"+
                    "<td>" + data[1].subCategoryName + "</td>"+
                    "<td>" + data[1].category.categoryName + "</td>"+
                    "<td><a class='edit-minicategory btn btn-warning btn-sm' data-id='" + data[0].id + "' data-miniCategoryName='" + data[0].miniCategoryName + "' data-category_id='" + data[1].category_id + "' data-subcategory_id='" + data[0].subcategory_id + "' data-subcategoryname='" + data[1].subCategoryName + "'><span class='fa fa-edit'></span></a> <a class='delete-minicategory btn btn-danger btn-sm' data-id='" + data[0].id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        }
    });
    $('input[name=miniCategoryName]').val('');
});


// function Edit Minicategory
$(document).on('click', '.edit-minicategory', function() {
    $('#footer_action_button').text(" Update Minicategory");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteMinicategory');
    $('.actionBtn').addClass('editMinicategory');
    $('.modal-title').text('Minicategory Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#miniCategoryName').val($(this).data('minicategoryname'));
    var  category_id = $(this).data('category_id');
    $("#ecategory_id > option").each(function(){
        if ($(this).val() == category_id){
            $(this).prop("selected", true);
        }
    });
    var  subcategory_id = $(this).data('subcategory_id');
    $("#esubcategory_id").html('<option value="'+$(this).data('subcategory_id')+'">'+$(this).data('subcategoryname')+'</option>')
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editMinicategory', function() {
    // Get the form.
    var form = $('#update_mini_form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action') + '/' + $('#fid').val(),
        data: formData,
        success: function(data) {
            $('#minicategory' + data[0].id).replaceWith(" "+
                "<tr id='minicategory" + data[0].id + "'>"+
                "<td>" + data[0].miniCategoryName + "</td>"+
                "<td>" + data[1].subCategoryName + "</td>"+
                "<td>" + data[1].category.categoryName + "</td>"+
                "<td><a class='edit-minicategory btn btn-warning btn-sm' data-id='" + data[0].id + "' data-miniCategoryName='" + data[0].miniCategoryName + "' data-category_id='" + data[1].category_id + "' data-subcategory_id='" + data[0].subcategory_id + "' data-subcategoryname='" + data[1].subCategoryName + "'><span class='fa fa-edit'></span></a> <a class='delete-minicategory btn btn-danger btn-sm' data-id='" + data[0].id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-minicategory', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').removeClass('editMinicategory');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteMinicategory');
    $('.modal-title').text('Delete Minicategory');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteMinicategory', function(){
    $.ajax({
        type: 'POST',
        url: 'mini-categories/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method1]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#minicategory' + $('.id').text()).remove();
        }
    });
});


// Retrieve minicategories from subcategory dynamically using ajax & jquery
$(document).ready(function() {
    $('#subcategory_id').change(function() {
        $.ajax({
            type:"GET",
            url:"/getMiniCat/"+$('#subcategory_id').val(),
            success : function(results) {
                $("#minicategory_id").html(results);
            }
        });
    });
});

$(document).ready(function() {
    $('#esubcategory_id').change(function() {
        $.ajax({
            type:"GET",
            url:"/getMiniCat/"+$('#esubcategory_id').val(),
            success : function(results) {
                $("#eminicategory_id").html(results);
            }
        });
    });
});



/*-------------------------------------------
  21. Mail CRUD
--------------------------------------------- */
//Handle quotation form submit.
function quotationMail(e) {
    // update CKEDITOR element
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }

    // Stop the browser from submitting the form.
    e.preventDefault();

    // Get the form
    var  form = $('#quotationMail');

    // Serialize formData
    var  FormData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'post',
        url: $(form).attr('action'),
        data: FormData,
        success: function(data){
            $('.error').addClass('hidden');
            if ((data.errors)) {
                $('.success').addClass('hidden');
                if (typeof data.errors.email !== 'undefined') {
                    $('.email').removeClass('hidden');
                    $('.email').text(data.errors.email);
                };
                if (typeof data.errors.subject !== 'undefined') {
                    $('.subject').removeClass('hidden');
                    $('.subject').text(data.errors.subject);
                };
                if (typeof data.errors.mailbody !== 'undefined') {
                    $('.mailbody').removeClass('hidden');
                    $('.mailbody').text(data.errors.mailbody);
                };
            } else {
                $('.success').removeClass('hidden').append('E-mail sent successfully.');
                $(form).trigger('reset');
                CKEDITOR.instances.editor1.setData( '' );
            }
        }
    });
}

//Handle send_mail form submit.
function sendMail(e) {
    // update CKEDITOR element
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }

    // Stop the browser from submitting the form.
    e.preventDefault();

    // Get the form
    var  form = $('#sendMail');

    // Serialize formData
    var  FormData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'post',
        url: $(form).attr('action'),
        data: FormData,
        success: function(data){
            $('.error').addClass('hidden');
            if ((data.errors)) {
                $('.success').addClass('hidden');
                if (typeof data.errors.email !== 'undefined') {
                    $('.email').removeClass('hidden');
                    $('.email').text(data.errors.email);
                };
                if (typeof data.errors.subject !== 'undefined') {
                    $('.subject').removeClass('hidden');
                    $('.subject').text(data.errors.subject);
                };
                if (typeof data.errors.mailbody !== 'undefined') {
                    $('.mailbody').removeClass('hidden');
                    $('.mailbody').text(data.errors.mailbody);
                };
            } else {
                $('.success').removeClass('hidden').append('E-mail sent successfully.');
                $(form).trigger('reset');
                // CKEDITOR.instances.editor1.setData( '' );
            }
        }
    });
}

// Handle draft form submit.
$(document).on('click', '#addDraft', function(e) {
    // update CKEDITOR element
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }

    // Stop the browser from submitting the form.
    e.preventDefault();

    // Get the form
    var  form = $('#sendMail');

    // Serialize formData
    var  FormData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'post',
        url: 'drafts',
        data: FormData,
        success: function(data){
            $('.error').addClass('hidden');
            if ((data.errors)) {
                $('.success').addClass('hidden');
                alert(data.errors);
            } else {
                $('.success').removeClass('hidden').append('E-mail saved as draft successfully.');
                $(form).trigger('reset');
                CKEDITOR.instances.editor1.setData( '' );
            }
        }
    });
});

// Update draft.
$(document).on('click', '#updateDraft', function(e) {
    // update CKEDITOR element
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }

    // Stop the browser from submitting the form.
    e.preventDefault();

    // Get the form
    var  form = $('#sendMail');

    // Serialize formData
    var  FormData = $(form).serializeArray();
    FormData.push({ name: "_method", value: "PUT" });

    // Submit the form using AJAX.
    $.ajax({
        type: 'post',
        url: $(this).data('url'),
        data: FormData,
        success: function(data){
            $('.error').addClass('hidden');
            if ((data.errors)) {
                $('.success').addClass('hidden');
                alert(data.errors);
            } else {
                $('.success').removeClass('hidden').append('Draft updated successfully.');
            }
        }
    });
});

// sent form Delete function
$(document).on('click', '.delete-sentMail', function() {
    $('.actionBtn').show();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteSentMail');
    $('.modal-title').text('Delete sentMail');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteSentMail', function(){
    $.ajax({
        type: 'POST',
        url: $(this).data('url'),
        data: {
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $(location).attr("href", base_url + "/sents");
        }
    });
});

// Bulk sent form Delete function
$(document).on('click', '.delete-BulkSentMail', function() {
    $('.actionBtn').show();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteBulkSentMail');
    $('.modal-title').text('Delete sentMail');
    $('.deleteContent').show();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteBulkSentMail', function(){
    var searchIDs = $("input:checkbox:checked").map(function(){
        return $(this).val();
    }).get();

    $.ajax({
        type: 'POST',
        url: $(this).data('url'),
        data: {
            '_method': $('input[name=_method]').val(),
            'id': searchIDs
        },
        success: function(data){
            $(location).attr("href", base_url + "/sents");
        }
    });
});

// Bulk draft form Delete function
$(document).on('click', '.delete-bulkDrafts', function() {
    $('.actionBtn').show();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteBulkDraftMail');
    $('.modal-title').text('Delete sentMail');
    $('.id').text($('input:checkbox:checked:first').val());
    $('.deleteContent').show();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteBulkDraftMail', function(){
    var searchIDs = $("input:checkbox:checked").map(function(){
        return $(this).val();
    }).get();

    $.ajax({
        type: 'POST',
        url: base_url + '/drafts/'  + $('.id').text(),
        data: {
            '_method': $('input[name=_method]').val(),
            'id': searchIDs
        },
        success: function(data){
            $(location).attr("href", base_url + "/drafts");
        }
    });
});

// Toggle checkbox
$('.checkbox-toggle').click(function () {
    if($('input:checkbox').prop("checked")) {
        $('input:checkbox').prop('checked', false);
        $('.action').hide();
    }
    else {
        $('input:checkbox').prop('checked', true);
        $('.action').show();
    }
})

jQuery('.mailbox-messages input[type=checkbox]').on('change', function () {
    var len = jQuery('.mailbox-messages input[type=checkbox]:checked').length;
    if (len > 0) {
        $('.action').show();
    } else if (len === 0) {
        $('.action').hide();
    }
}).trigger('change');


/*-------------------------------------------
  22. Order CRUD
--------------------------------------------- */


// Show order
$(document).on('click', '.show-order', function() {
    $('#companyInfo').html($(this).data('company'));
    $('#billing').html($(this).data('billing'));
    $('#shipping').html($(this).data('shipping'));
    $('#ship').html($(this).data('ship'));
    $('#orderDetails').html($(this).data('orderdetails'));
    $('#payment').html($(this).data('paymentmethod'));
    $('#subtotal').html($(this).data('subtotal'));
    $('#tax').html($(this).data('tax'));
    $('#total').html($(this).data('total'));
    // if ($(this).data('discount') != 0) {
    //     $('#discount').text('৳' + $(this).data('discount'));
    //     $('#discount_row').show();
    // }else {
    //     $('#discount_row').hide();
    // }
    $('#show').modal('show');
});


// function Edit Order
$(document).on('click', '.edit-order', function() {
    $('#footer_action_button').text(" Update Order");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteOrder');
    $('.actionBtn').addClass('editOrder');
    $('.modal-title').text('Order Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    var  status = $(this).data('status');
    $("#status > option").each(function(){
        if ($(this).val() == status){
            $(this).prop("selected", true);
        }
    });
    $('#myModal').modal('show');
});


// function Update Order

$('.modal-footer').on('click', '.editOrder', function() {
    // Get the form.
    var form = $('#order-form');

    alert($(form).attr('action') + '/' + $('#fid').val());


    // Serialize the form data.
    var formData = $(form).serialize();
    

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: 'orders/' + $('#fid').val(),
        data: formData,
        success: function(data) {
            if(data.status  == 0){
                var status = 'order recived';
            }
            else if(data.status  == 1){
                var status = 'payment pending';
            }
            else if(data.status  == 2){
                var status = 'payment recived';
            }
            else if(data.status == 3){
                var status = 'order processing';
            }
            else if(data.status  == 4){
                var status = 'Cancelled';
            }
            else if(data.status  == 5){
                var status = 'Refunded';
            }
            else if(data.status  == 6){
                var status = 'Failed';
            }
            else if(data.status  == 7){
                var status = 'On shipment';
            }
            else {
                var status = 'Delivered';
            }
            $('#sts'+data.id).text(status);
            $('.edit-order').replaceWith('<a href="#" class="edit-order btn btn-warning btn-sm" data-id="'+data.id+'" data-status="'+data.status+'"><i class="fa fa-edit"></i></a>');
        }
    });
});


// form Delete function
$(document).on('click', '.delete-order', function() {
    $('.actionBtn').show();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteOrder');
    $('.modal-title').text('Delete order');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteOrder', function(){
    $.ajax({
        type: 'POST',
        url: 'orders/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method1]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#order' + $('.id').text()).remove();
        }
    });
});


/*-------------------------------------------
  23. Offer CRUD
--------------------------------------------- */


// -- ajax Form Add Offer--
$(document).on('click','.addOffer', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Offer for lucky today');
});
$("#addOffer").click(function() {
    // Get the form.
    var form = $('#addOffer-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        success: function(data){

            console.log(data);
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.discount_value === 'undefined') {
                    $('.discount_value').addClass('hidden');
                }
                $('.discount_value').text(data.errors.discount_value);
                if (typeof data.errors.valid_until === 'undefined') {
                    $('.valid_until').addClass('hidden');
                }
                $('.valid_until').text(data.errors.valid_until);
                if (typeof data.errors.product_id === 'undefined') {
                    $('.product_id').addClass('hidden');
                }
                $('.product_id').text(data.errors.product_id);
            } else {
                $('.error').addClass('hidden');
                var productName = '';
                var ids = '';
                $.each(data.products, function (key, value) {
                    productName += value.productName + ', ';
                    ids += value.id + ' ';
                });
                $('#example1').append("<tr id='offer" + data.offer.id + "'>"+
                    "<td>" + data.offer.discount_value + "</td>"+
                    "<td>" + data.offer.valid_until + "</td>"+
                    "<td>" + productName + "</td>"+
                    "<td><a class='edit-offer btn btn-warning btn-sm' data-id='" + data.offer.id + "' data-discount_value='" + data.offer.discount_value + "' data-valid_until='" + data.offer.valid_until + "' data-product_ids='" + ids + "'><span class='fa fa-edit'></span></a> <a class='delete-offer btn btn-danger btn-sm' data-id='" + data.offer.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        }
    });
    $(form).trigger('reset');
});


// function Edit Offer
$(document).on('click', '.edit-offer', function() {
    $('#footer_action_button').text(" Update Offer");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteOffer');
    $('.actionBtn').addClass('editOffer');
    $('.modal-title').text('Offer Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#discount_value').val($(this).data('discount_value'));
    // $('#etime').timepicker('setTime', new Time($(this).data('valid_until')));
    $('#etime').val($(this).data('valid_until'));

    var  product_ids = $(this).data('product_ids');
    $("#product_id > option").each(function(){
        if (product_ids.indexOf($(this).val()) !== -1){
            $(this).prop("selected", true);
        }
    });
    $('#myModal').modal('show');
});


// function Update Order

$('.modal-footer').on('click', '.editOffer', function() {
    // Get the form.
    var form = $('#updateOffer-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action') + '/' + $('#fid').val(),
        data: formData,
        success: function(data) {
            var productName = '';
            var ids = '';
            $.each(data.products, function (key, value) {
                productName += value.productName + ', ';
                ids += value.id + ' ';
            });
            $('#offer'+ data.offer.id).replaceWith("<tr id='offer" + data.offer.id + "'>"+
                "<td>" + data.offer.discount_value + "</td>"+
                "<td>" + data.offer.valid_until + "</td>"+
                "<td>" + productName + "</td>"+
                "<td><a class='edit-offer btn btn-warning btn-sm' data-id='" + data.offer.id + "' data-discount_value='" + data.offer.discount_value + "' data-valid_until='" + data.offer.valid_until + "' data-product_ids='" + ids + "'><span class='fa fa-edit'></span></a> <a class='delete-offer btn btn-danger btn-sm' data-id='" + data.offer.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-offer', function() {
    $('.actionBtn').show();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteOffer');
    $('.modal-title').text('Delete offer');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteOffer', function(){
    $.ajax({
        type: 'POST',
        url: 'luky-today/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method1]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#offer' + $('.id').text()).remove();
        }
    });
});


/*-------------------------------------------
  24. Deal CRUD
--------------------------------------------- */


// -- ajax Form Add Deal--
$(document).on('click','.addDeal', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Deal');
});
$("#addDeal").click(function() {
    // Get the form.
    var form = $('#addDeal-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.discount_value === 'undefined') {
                    $('.discount_value').addClass('hidden');
                }
                $('.discount_value').text(data.errors.discount_value);
                if (typeof data.errors.valid_until === 'undefined') {
                    $('.valid_until').addClass('hidden');
                }
                $('.valid_until').text(data.errors.valid_until);
                if (typeof data.errors.product_id === 'undefined') {
                    $('.product_id').addClass('hidden');
                }
                $('.product_id').text(data.errors.product_id);
            } else {
                $('.error').addClass('hidden');
                var productName = '';
                var ids = '';
                $.each(data.products, function (key, value) {
                    productName += value.productName + ', ';
                    ids += value.id + ' ';
                });
                $('#example1').append("<tr id='deal" + data.deal.id + "'>"+
                    "<td>" + data.deal.discount_value + "</td>"+
                    "<td>" + data.deal.valid_until + "</td>"+
                    "<td><a class='edit-deal btn btn-warning btn-sm' data-id='" + data.deal.id + "' data-discount_value='" + data.deal.discount_value + "' data-valid_until='" + data.deal.valid_until + "' data-product_ids='" + ids + "'><span class='fa fa-edit'></span></a> <a class='delete-deal btn btn-danger btn-sm' data-id='" + data.deal.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        }
    });
    $('#addDeal-form').trigger('reset');
});


// function Edit Deal
$(document).on('click', '.edit-deal', function() {
    $('#footer_action_button').text(" Update Offer");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteDeal');
    $('.actionBtn').addClass('editDeal');
    $('.modal-title').text('Deal Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#discount_value').val($(this).data('discount_value'));
    $('#evalid_until').datepicker('setDate', new Date($(this).data('valid_until')));
    var  product_ids = $(this).data('product_ids');
    $("#product_id > option").each(function(){
        if (product_ids.indexOf($(this).val()) !== -1){
            $(this).prop("selected", true);
        }
    });
    $('#myModal').modal('show');
});


// function Update Order

$('.modal-footer').on('click', '.editDeal', function() {
    // Get the form.
    var form = $('#updateDeal-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action') + '/' + $('#fid').val(),
        data: formData,
        success: function(data) {
            var productName = '';
            var ids = '';
            $.each(data.products, function (key, value) {
                productName += value.productName + ', ';
                ids += value.id + ' ';
            });
            $('#deal'+ data.deal.id).replaceWith("<tr id='deal" + data.deal.id + "'>"+
                "<td>" + data.deal.discount_value + "</td>"+
                "<td>" + data.deal.valid_until + "</td>"+
                "<td><a class='edit-deal btn btn-warning btn-sm' data-id='" + data.deal.id + "' data-discount_value='" + data.deal.discount_value + "' data-valid_until='" + data.deal.valid_until + "' data-product_ids='" + ids + "'><span class='fa fa-edit'></span></a> <a class='delete-deal btn btn-danger btn-sm' data-id='" + data.deal.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-deal', function() {
    $('.actionBtn').show();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteDeal');
    $('.modal-title').text('Delete Deal');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteDeal', function(){
    $.ajax({
        type: 'POST',
        url: 'deals/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method1]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#deal' + $('.id').text()).remove();
        }
    });
});


/*-------------------------------------------
  25. Banner CRUD
--------------------------------------------- */


// -- ajax Form Add Banner--
$(document).on('click','.addBanner', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Banner');
});
$("#banner_add-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){

            $('#example1').append("<tr id='banner" + data.id + "'>"+
                "<td><img src='storage/images/banner/" + data.home_one + "' height='100px' width='100px'></td>"+
                "<td><img src='storage/images/banner/" + data.home_two + "' height='100px' width='100px'></td>"+
                "<td><a href=\"#\" class=\"show-banner btn btn-info btn-sm\" data-id='" + data.id + "' data-home_one='" + data.home_one + "' data-home_two='" + data.home_two + "' data-home_one_link='" + data.home_one_link + "' data-home_two_link='" + data.home_two_link + "' data-home_three='" + data.home_three + "' data-home_three_link='" + data.home_three_link + "' data-header_one='" + data.header_one + "' data-header_one_link='" + data.header_one_link + "' data-header_two='" + data.header_two  + "' data-header_two_link='" + data.header_two_link+ "' data-header_three='" + data.header_three + "' data-header_three_link='" + data.header_three_link  +"' data-banner_link_brand_page='" + data.banner_link_brand_page + "' data-banner_brand_page='" + data.banner_brand_page + "' data-banner_brand_single_page='" + data.banner_brand_single_page + "' data-banner_link_brand_single_page='" + data.banner_link_brand_single_page + "' data-banner_category_page='" + data.banner_category_page + "' data-banner_link_category_page='" + data.banner_link_category_page + "' data-banner_product_page='" + data.banner_product_page + "' data-banner_link_product_page='" + data.banner_link_product_page + "' data-banner_searched_product_page='" + data.banner_searched_product_page + "' data-banner_link_searched_product_page='" + data.banner_link_searched_product_page + "'>\n" +
                "<i class=\"fa fa-eye\"></i>\n" +
                "</a><a class='edit-banner btn btn-warning btn-sm' data-id='" + data.id + "' data-home_one_link='" + data.home_one_link + "' data-home_two_link='" + data.home_two_link + "' data-home_three_link='" + data.home_three_link + "' data-header_one_link='" + data.header_one_link + "' data-header_two_link='" + data.header_two_link + "' data-header_three_link='" + data.header_three_link + "' data-banner_link_brand_single_page='" + data.banner_link_brand_single_page + "' data-banner_link_category_page='" + data.banner_link_category_page + "' data-banner_link_product_page='" + data.banner_link_product_page + "' data-banner_link_searched_product_page='" + data.banner_link_searched_product_page + "'><span class='fa fa-edit'></span></a> <a class='delete-banner btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
    $('#banner_add-form input').val('');
});


// function Edit Banner
$(document).on('click', '.edit-banner', function() {
    $('.actionBtn').hide();
    $('.modal-title').text('Banner Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#home_one_link').val($(this).data('home_one_link'));
    $('#home_two_link').val($(this).data('home_two_link'));
    $('#home_three_link').val($(this).data('home_three_link'));
    $('#header_one_link').val($(this).data('header_one_link'));
    $('#header_two_link').val($(this).data('header_two_link'));
    $('#header_three_link').val($(this).data('header_three_link'));
    $('#banner_link_brand_page').val($(this).data('banner_link_brand_page'));
    $('#banner_link_brand_single_page').val($(this).data('banner_link_brand_single_page'));
    $('#banner_link_category_page').val($(this).data('banner_link_category_page'));
    $('#banner_link_product_page').val($(this).data('banner_link_product_page'));
    $('#banner_link_searched_product_page').val($(this).data('banner_link_searched_product_page'));
    $('#myModal').modal('show');
});

$('#banner_update-form').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_method', 'PUT');
    $.ajax({
        type: 'POST',
        url: $(this).attr('action') + '/' + $('#fid').val(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $('#banner' + data.id).replaceWith("<tr id='banner" + data.id + "'>"+
                "<td><img src='storage/images/banner/" + data.home_one + "' height='100px' width='100px'></td>"+
                "<td><img src='storage/images/banner/" + data.home_two + "' height='100px' width='100px'></td>"+
                "<td><a href=\"#\" class=\"show-banner btn btn-info btn-sm\" data-id='" + data.id + "' data-home_one='" + data.home_one + "' data-home_two='" + data.home_two + "' data-home_one_link='" + data.home_one_link + "' data-home_two_link='" + data.home_two_link + "' data-home_three='" + data.home_three + "' data-home_three_link='" + data.home_three_link + "' data-header_one='" + data.header_one + "' data-header_one_link='" + data.header_one_link + "' data-header_two='" + data.header_two  + "' data-header_two_link='" + data.header_two_link+ "' data-header_three='" + data.header_three + "' data-header_three_link='" + data.header_three_link  +"' data-banner_link_brand_page='" + data.banner_link_brand_page + "' data-banner_brand_page='" + data.banner_brand_page + "' data-banner_brand_single_page='" + data.banner_brand_single_page + "' data-banner_link_brand_single_page='" + data.banner_link_brand_single_page + "' data-banner_category_page='" + data.banner_category_page + "' data-banner_link_category_page='" + data.banner_link_category_page + "' data-banner_product_page='" + data.banner_product_page + "' data-banner_link_product_page='" + data.banner_link_product_page + "' data-banner_searched_product_page='" + data.banner_searched_product_page + "' data-banner_link_searched_product_page='" + data.banner_link_searched_product_page + "'>\n" +
                "<i class=\"fa fa-eye\"></i>\n" +
                "</a><a class='edit-banner btn btn-warning btn-sm' data-id='" + data.id + "' data-home_one_link='" + data.home_one_link + "' data-home_two_link='" + data.home_two_link + "' data-home_three_link='" + data.home_three_link  + "' data-header_one_link='" + data.header_one_link + "' data-header_two_link='" + data.header_two_link  +"' data-header_three_link='" + data.header_three_link + "' data-banner_link_brand_page='" + data.banner_link_brand_page + "' data-banner_link_brand_single_page='" + data.banner_link_brand_single_page + "' data-banner_link_category_page='" + data.banner_link_category_page + "' data-banner_link_product_page='" + data.banner_link_product_page + "' data-banner_link_searched_product_page='" + data.banner_link_searched_product_page + "'><span class='fa fa-edit'></span></a> <a class='delete-banner btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-banner', function() {
    $('.actionBtn').show();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteBanner');
    $('.modal-title').text('Delete Banner');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteBanner', function(){
    $.ajax({
        type: 'POST',
        url: 'banners/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#banner' + $('.id').text()).remove();
        }
    });
});

// Show function
$(document).on('click', '.show-banner', function(e) {
    e.preventDefault();
    $('#home_one').attr('src', 'storage/images/banner/' + $(this).data('home_one'));
    $('#show_home_one_link').val($(this).data('home_one_link'));
    $('#home_two').attr('src', 'storage/images/banner/' + $(this).data('home_two'));
    $('#show_home_two_link').val($(this).data('home_two_link'));
    $('#home_three').attr('src', 'storage/images/banner/' + $(this).data('home_three'));
    $('#show_home_three_link').val($(this).data('home_three_link'));

    $('#header_one').attr('src', 'storage/images/banner/' + $(this).data('header_one'));
    $('#show_header_one_link').val($(this).data('header_one_link'));
    $('#header_two').attr('src', 'storage/images/banner/' + $(this).data('header_two'));
    $('#show_header_two_link').val($(this).data('header_two_link'));
    $('#header_three').attr('src', 'storage/images/banner/' + $(this).data('header_three'));
    $('#show_header_three_link').val($(this).data('header_three_link'));

    $('#banner_brand_page').attr('src', 'storage/images/banner/' + $(this).data('banner_brand_page'));
    $('#show_banner_link_brand_page').val($(this).data('banner_link_brand_page'));
    $('#banner_brand_single_page').attr('src', 'storage/images/banner/' + $(this).data('banner_brand_single_page'));
    $('#show_banner_link_brand_single_page').val($(this).data('banner_link_brand_single_page'));
    $('#banner_category_page').attr('src', 'storage/images/banner/' + $(this).data('banner_category_page'));
    $('#show_banner_link_category_page').val($(this).data('banner_link_category_page'));
    $('#banner_product_page').attr('src', 'storage/images/banner/' + $(this).data('banner_product_page'));
    $('#show_banner_link_product_page').val($(this).data('banner_link_product_page'));
    $('#banner_searched_product_page').attr('src', 'storage/images/banner/' + $(this).data('banner_searched_product_page'));
    $('#show_banner_link_searched_product_page').val($(this).data('banner_link_searched_product_page'));
    $('.modal-title').text('Show banner');
    $('#show').modal('show');
});


/*-------------------------------------------
  26. Tab CRUD
--------------------------------------------- */


// -- ajax Form Add Tab--
$(document).on('click','.addTab', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Tab');
});
$("#addTab").click(function() {
    // Get the form.
    var form = $('#add_tab_form');

    // Serialize the form data.
    var formData = $(form).serialize();


    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.tabName === 'undefined') {
                    $('.tabName').addClass('hidden');
                }
                $('.tabName').text(data.errors.tabName);

                if (typeof data.errors.category_id === 'undefined') {
                    $('.category_id').addClass('hidden');
                }
                $('.category_id').text(data.errors.category_id);

                if (typeof data.errors.subcategory_id === 'undefined') {
                    $('.subcategory_id').addClass('hidden');
                }
                $('.subcategory_id').text(data.errors.subcategory_id);

                if (typeof data.errors.minicategory_id === 'undefined') {
                    $('.minicategory_id').addClass('hidden');
                }
                $('.minicategory_id').text(data.errors.minicategory_id);

            } else {

                console.log(data);

                $('.error').addClass('hidden');
                $('#example1').append("<tr id='tab" + data[0].id + "'>"+
                    "<td>" + data[0].tabName + "</td>"+
                    "<td>" + data[1].miniCategoryName + "</td>"+
                    "<td>" + data[1].subcategory.subCategoryName + "</td>"+
                    "<td>" + data[2].categoryName + "</td>"+
                    "<td><a class='edit-tab btn btn-warning btn-sm' data-id='" + data[0].id + "' data-miniCategoryName='" + data[1].miniCategoryName + "' data-category_id='" + data[2].category_id + "' data-subcategory_id='" + data[1].subcategory.subcategory_id + "' data-subcategoryname='" + data[1].subcategory.subCategoryName + "'><span class='fa fa-edit'></span></a> <a class='delete-tab btn btn-danger btn-sm' data-id='" + data[0].id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        }
    });
    $('input[name=tabName]').val('');
});


// function Edit Minicategory
$(document).on('click', '.edit-tab', function() {
    $('#footer_action_button').text(" Update Tab");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteTab');
    $('.actionBtn').addClass('editTab');
    $('.modal-title').text('Tab Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#tabName').val($(this).data('tabname'));

    var  category_id = $(this).data('category_id');
    $("#ecategory_id > option").each(function(){
        if ($(this).val() == category_id){
            $(this).prop("selected", true);
        }
    });

    var  subcategory_id = $(this).data('subcategory_id');
    $("#esubcategory_id").html('<option value="'+$(this).data('subcategory_id')+'">'+$(this).data('subcategoryname')+'</option>')

    var  minicategory_id = $(this).data('minicategory_id');
    $("#eminicategory_id").html('<option value="'+$(this).data('minicategory_id')+'">'+$(this).data('minicategoryname')+'</option>')

    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editTab', function() {
    // Get the form.
    var form = $('#update_tab_form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action') + '/' + $('#fid').val(),
        data: formData,
        success: function(data) {
            $('#tab' + data[0].id).replaceWith(" "+
                "<tr id='tab" + data[0].id + "'>"+
                "<td>" + data[0].tabName + "</td>"+
                "<td>" + data[1].miniCategoryName + "</td>"+
                "<td>" + data[1].subcategory.subCategoryName + "</td>"+
                "<td>" + data[2].categoryName + "</td>"+
                "<td><a class='edit-tab btn btn-warning btn-sm' data-id='" + data[0].id + "' data-miniCategoryName='" + data[1].miniCategoryName + "' data-category_id='" + data[2].category_id + "' data-subcategory_id='" + data[1].subcategory.subcategory_id + "' data-subcategoryname='" + data[1].subcategory.subCategoryName + "'><span class='fa fa-edit'></span></a> <a class='delete-tab btn btn-danger btn-sm' data-id='" + data[0].id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-tab', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').removeClass('editTab');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteTab');
    $('.modal-title').text('Delete Tab');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteTab', function(){
    $.ajax({
        type: 'POST',
        url: 'tabs/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method1]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#tab' + $('.id').text()).remove();
        }
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
  27. prebook CRUD
--------------------------------------------- */


// -- ajax Form Add add pre-launching product --
$(document).on('click','.addLaunchingProduct', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Launching Product');

    // Set launching_date date time
    var launching_date = $('#launching_date');
    launching_date.datepicker('setDate', new Date($(this).data('launching_date')));
});

$("#addLaunchingProduct").click(function() {
    // Get the form.
    var form = $('#addLaunchingProduct-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        success: function(data){
            console.log(data);
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.prebook_discount === 'undefined') {
                    $('.prebook_discount').addClass('hidden');
                }
                $('.prebook_discount').text(data.errors.prebook_discount);
                if (typeof data.errors.amount_to_pay === 'undefined') {
                    $('.amount_to_pay').addClass('hidden');
                }
                $('.amount_to_pay').text(data.errors.amount_to_pay);
                if (typeof data.errors.valid_until === 'undefined') {
                    $('.launching_date').addClass('hidden');
                }
                $('.launching_date').text(data.errors.launching_date);
                if (typeof data.errors.product_id === 'undefined') {
                    $('.product_id').addClass('hidden');
                }
                $('.product_id').text(data.errors.product_id);
            } else {
                $('.error').addClass('hidden');
                var productName = '';
                var ids = '';
                $.each(data.products, function (key, value) {
                    productName += value.productName + ', ';
                    ids += value.id + ' ';
                });
                $('#example1').append("<tr id='prebook" + data.prebook.id + "'>"+
                    "<td>" + data.prebook.prebook_discount + "</td>"+
                    "<td>" + data.prebook.launching_date + "</td>"+
                    "<td>" + data.prebook.amount_to_pay + "</td>"+
                    "<td>" + productName + "</td>"+
                    "<td><a class='edit-offer btn btn-warning btn-sm' data-id='" + data.prebook.id + "' data-prebook_discount='" + data.prebook.prebook_discount + "' data-amount_to_pay='" + data.prebook.amount_to_pay + "' data-launching_date='" + data.prebook.launching_date + "' data-product_id='" + id + "'><span class='fa fa-edit'></span></a> <a class='delete-offer btn btn-danger btn-sm' data-id='" + data.prebook.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        }
    });
    $(form).trigger('reset');
});

// function Edit Offer
$(document).on('click', '.edit-prebook-launching-product', function() {
    $('#footer_action_button').text(" Update prebook launching product");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deletePrebookLaunchingProduct');
    $('.actionBtn').addClass('editPrebookLaunchingProduct');
    $('.modal-title').text('Prebook Launching Product Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#eprebook_discount').val($(this).data('prebook_discount'));
    $('#eamount_to_pay').val($(this).data('amount_to_pay'));

    $('#edetails').summernote('code',$(this).data('details'));

    $('#elaunching_date').datepicker('setDate', new Date($(this).data('launching_date')));
    var  product_id = $(this).data('product_id');

    $("#product_id > option").each(function(){
        if ($(this).val() == product_id){
            // Select the matched option
            $(this).prop("selected", true);
        }
        
    });
    $('#myModal').modal('show');
});

// function Update Order

$('.modal-footer').on('click', '.editPrebookLaunchingProduct', function() {
    // Get the form.
    var form = $('#updatePrebookLaunchingProduct-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action') + '/' + $('#fid').val(),
        data: formData,
        success: function(data) {
            console.log(data);
            var productName = '';
            var ids = '';
            $.each(data.products, function (key, value) {
                productName += value.productName + ', ';
                ids += value.id + ' ';
            });
            
            $('#example1').replaceWith("<tr id='prebook" + data.prebook.id + "'>"+
                "<td>" + data.prebook.prebook_discount + "</td>"+
                "<td>" + data.prebook.launching_date + "</td>"+
                "<td>" + data.prebook.amount_to_pay + "</td>"+
                "<td>" + productName + "</td>"+
                "<td><a class='edit-offer btn btn-warning btn-sm' data-id='" + data.prebook.id + "' data-prebook_discount='" + data.prebook.prebook_discount + "' data-amount_to_pay='" + data.prebook.amount_to_pay + "' data-launching_date='" + data.prebook.launching_date + "' data-product_id='" + id + "'><span class='fa fa-edit'></span></a> <a class='delete-offer btn btn-danger btn-sm' data-id='" + data.prebook.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});

// form Delete function
$(document).on('click', '.delete-prebook-launching-product', function() {
    $('.actionBtn').show();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deletePrebookLaunchingProduct');
    $('.modal-title').text('Delete Prebook Launching Product');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deletePrebookLaunchingProduct', function(){
    $.ajax({
        type: 'POST',
        url: 'pre-launching-product-delete/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method1]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#prebook' + $('.id').text()).remove();
        }
    });
});


/*-------------------------------------------
  28. Product Ads CRUD
--------------------------------------------- */


// -- ajax Form Add Product Ads--
$(document).on('click','.addProductAds', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Product & image');
});
$("#productsad_add_form").submit(function(event) {
    event.preventDefault();

    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){

            $('#example1').append("<tr id='productsAd" + data.id + "'>"+
                "<td><img src='storage/images/ads/" + data.ad1Image + "' height='100px' width='100px'></td>"+
                "<td><img src='storage/images/ads/" + data.ad2Image + "' height='100px' width='100px'></td>"+
                "<td><img src='storage/images/ads/" + data.ad3Image + "' height='100px' width='100px'></td>"+
                "<td><img src='storage/images/ads/" + data.ad4Image + "' height='100px' width='100px'></td>"+

                "<td><a class='edit-ProductAds btn btn-warning btn-sm' data-id='" + data.id + "' data-product1='" + data.product1 + "' data-product2='" + data.product2 + "' data-product3='" + data.product3 +"'><span class='fa fa-edit'></span></a> <a class='delete-ProductAds btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
    $('#create').modal('hide');
});


// function Edit Banner
$(document).on('click', '.edit-ProductAds', function() {
    $('.actionBtn').hide();
    $('.modal-title').text('Product ads Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));

    

    var  product1_id = $(this).data('product1');
    var  product2_id = $(this).data('product2');
    var  product3_id = $(this).data('product3');

    $("#eProduct1 > option").each(function(){
        if ($(this).val() == product1_id){
            // Select the matched option
            // $(this).prop("selected", true);
            $('#shProduct1').val($(this).text());
        }
        
    });

    $("#eProduct2 > option").each(function(){
        if ($(this).val() == product2_id){
            // Select the matched option
            // $(this).prop("selected", true);
            $('#shProduct2').val($(this).text());
        }
        
    });

    $("#eProduct3 > option").each(function(){
        if ($(this).val() == product3_id){
            // Select the matched option
            // $(this).prop("selected", true);
            $('#shProduct3').val($(this).text());
        }
        
    });

    $('#myModal').modal('show');
});

$('#productsad_update_form').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_method', 'PUT');
    $.ajax({
        type: 'POST',
        url: $(this).attr('action') + '/' + $('#fid').val(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $('#banner' + data.id).replaceWith("<tr id='banner" + data.id + "'>"+
                "<td><img src='storage/images/ads/" + data.ad1Image + "' height='100px' width='100px'></td>"+
                "<td><img src='storage/images/ads/" + data.ad2Image + "' height='100px' width='100px'></td>"+
                "<td><img src='storage/images/ads/" + data.ad3Image + "' height='100px' width='100px'></td>"+
                "<td><img src='storage/images/ads/" + data.ad4Image + "' height='100px' width='100px'></td>"+
                "<td><a class='edit-ProductAds btn btn-warning btn-sm' data-id='" + data.id + "' data-product1='" + data.product1 + "' data-product2='" + data.product2 +  "' data-product3='" + data.product3 +"'><span class='fa fa-edit'></span></a> <a class='delete-ProductAds btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                "</tr>");
        }
    });
});


// form Delete function
$(document).on('click', '.delete-ProductAds', function() {
    $('.actionBtn').show();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteProductAds');
    $('.modal-title').text('Delete ProductAds');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteProductAds', function(){
    $.ajax({
        type: 'POST',
        url: 'productsads/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#productsAd' + $('.id').text()).remove();
        }
    });
});

/*-------------------------------------------
29. Terms & Policy CRUD
--------------------------------------------- */


// -- ajax Form Add Policy--
$(document).on('click','.addPolicy', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Terms & Policy');
});
$("#addPolicy").click(function() {

    // ajax post
    $.ajax({
        type: 'POST',
        url: 'policies',
        data: $('#insertPolicy').serialize(),
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.description === 'undefined') {
                    $('.description').addClass('hidden');
                }
                $('.description').text(data.errors.description);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='policy" + data.id + "'>"+
                    "<td>" + data.topic + "</td>"+
                    "<td>" + data.description + "</td>"+
                    "<td><a class='show-policy btn btn-info btn-sm' data-id='" + data.id + "' data-topic='" + data.topic + "' data-description='" + data.description + "'><i class='fa fa-eye'></i></a> <a class='edit-policy btn btn-warning btn-sm' data-id='" + data.id + "' data-topic='" + data.topic +  "' data-description='" + data.description + "'><i class='fa fa-edit'></i></a> <a class='delete-policy btn btn-danger btn-sm' data-id='" + data.id + "'><i class='fa fa-trash'></i></a></td>"+
                    "</tr>");
            }
        },
    });
    $('#policy_description').val('');
    $('#topic').val('');
});


// function Edit policy
$(document).on('click', '.edit-policy', function() {
    $('#footer_action_button').text(" Update Terms & Policies");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deletePolicy');
    $('.actionBtn').addClass('editPolicy');
    $('.modal-title').text('Terms & Policy Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#etopic').val($(this).data('topic'));
    $('#epolicy_description').summernote('code',$(this).data('description'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editPolicy', function() {

    $.ajax({
        type: 'POST',
        url: 'policies/' + $('#fid').val(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method1]').val(),
            'description': $('#epolicy_description').val(),
            'topic': $('#etopic').val(),
            'id': $("#fid").val()
        },
        success: function(data) {
            $('#policy' + data.id).replaceWith(" "+
                "<tr id='policy" + data.id + "'>"+
                "<td>" + data.topic + "</td>"+
                "<td>" + data.description + "</td>"+
                "<td><a class='show-policy btn btn-info btn-sm' data-id='" + data.id + "' data-topic='" + data.topic + "' data-description='" + data.description + "'><i class='fa fa-eye'></i></a> <a class='edit-policy btn btn-warning btn-sm' data-id='" + data.id + "' data-topic='" + data.topic + "' data-description='" + data.description + "'><i class='fa fa-edit'></i></a> <a class='delete-policy btn btn-danger btn-sm' data-id='" + data.id + "'><i class='fa fa-trash'></i></a></td>"+
                "</tr>");
        }
    });
});


// Show function
$(document).on('click', '.show-policy', function() {
    $('#show').modal('show');
    $('#i').text($(this).data('id'));
    $('#des').html($(this).data('description'));
    $('#shtopic').val($(this).data('topic'));
    $('.modal-title').text('Show Policy');
});


// form Delete function
$(document).on('click', '.delete-policy', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deletePolicy');
    $('.modal-title').text('Delete Policy');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deletePolicy', function(){
    $.ajax({
        type: 'POST',
        url: 'policies/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#policy' + $('.id').text()).remove();
        }
    });
});


/*-------------------------------------------
30. Faq & Help CRUD
--------------------------------------------- */


// -- ajax Form Add Policy--
$(document).on('click','.addFaq', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Faq & Help');
});
$("#addFaq").click(function() {

    // ajax post
    $.ajax({
        type: 'POST',
        url: 'faqs',
        data: $('#insertFaq').serialize(),
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.answer === 'undefined') {
                    $('.answer').addClass('hidden');
                }
                $('.answer').text(data.errors.answer);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='faq" + data.id + "'>"+
                    "<td>" + data.question + "</td>"+
                    "<td>" + data.answer + "</td>"+
                    "<td><a class='show-faq btn btn-info btn-sm' data-id='" + data.id + "' data-question='" + data.question + "' data-answer='" + data.answer + "'><i class='fa fa-eye'></i></a> <a class='edit-faq btn btn-warning btn-sm' data-id='" + data.id + "' data-question='" + data.question + "' data-answer='" + data.answer + "'><i class='fa fa-edit'></i></a> <a class='delete-faq btn btn-danger btn-sm' data-id='" + data.id + "'><i class='fa fa-trash'></i></a></td>"+
                    "</tr>");
                    
            }
        },
    });
    $('#answer').val('');
    $('#question').val('');
});


// function Edit policy
$(document).on('click', '.edit-faq', function() {
    $('#footer_action_button').text(" Update Faq & Helps");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('deleteFaq');
    $('.actionBtn').addClass('editFaq');
    $('.modal-title').text('Faqs & Help Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#equestion').val($(this).data('question'));
    $('#eanswer').summernote('code',$(this).data('answer'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.editFaq', function() {

    $.ajax({
        type: 'POST',
        url: 'faqs/' + $('#fid').val(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method1]').val(),
            'answer': $('#eanswer').val(),
            'question': $('#equestion').val(),
            'id': $("#fid").val()
        },
        success: function(data) {
            $('#faq' + data.id).replaceWith(" "+
                "<tr id='faq" + data.id + "'>"+
                "<td>" + data.question + "</td>"+
                "<td>" + data.answer + "</td>"+
                "<td><a class='show-faq btn btn-info btn-sm' data-id='" + data.id + "' data-question='" + data.question + "' data-answer='" + data.answer + "'><i class='fa fa-eye'></i></a> <a class='edit-faq btn btn-warning btn-sm' data-id='" + data.id + "' data-question='" + data.question + "' data-answer='" + data.answer + "'><i class='fa fa-edit'></i></a> <a class='delete-faq btn btn-danger btn-sm' data-id='" + data.id + "'><i class='fa fa-trash'></i></a></td>"+
                "</tr>");
        }
    });
});


// Show function
$(document).on('click', '.show-faq', function() {
    $('#show').modal('show');
    $('#faqId').text($(this).data('id'));
    $('#faqAnswer').html($(this).data('answer'));
    $('#shquestion').val($(this).data('question'));
    $('.modal-title').text('Show FAq');
});


// form Delete function
$(document).on('click', '.delete-faq', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteFaq');
    $('.modal-title').text('Delete Faq');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteFaq', function(){
    $.ajax({
        type: 'POST',
        url: 'faqs/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#faq' + $('.id').text()).remove();
        }
    });
});


/*-------------------------------------------
31. bundle offers CRUD
--------------------------------------------- */


// -- ajax Form Add add pre-launching product --
$(document).on('click','.addBundleOffer', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Bundle offers');
});

$("#addBundleOffer").click(function() {
    // Get the form.
    var form = $('#addBundleOffer-form');

    // Serialize the form data.
    var formData = $(form).serialize();


    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action'),
        data: formData,
        success: function(data){
            console.log(data);
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.qty_start === 'undefined') {
                    $('.qty_start').addClass('hidden');
                }
                $('.qty_start').text(data.errors.qty_start);

                if (typeof data.errors.qty_end === 'undefined') {
                    $('.qty_end').addClass('hidden');
                }
                $('.qty_end').text(data.errors.qty_end);

                if (typeof data.errors.discount === 'undefined') {
                    $('.discount').addClass('hidden');
                }
                $('.discount').text(data.errors.qty_end);

                if (typeof data.errors.product_id === 'undefined') {
                    $('.product_id').addClass('hidden');
                }
                $('.product_id').text(data.errors.product_id);
            } else {
                $('.error').addClass('hidden');
                var productName = '';
                var ids = '';
                $.each(data.products, function (key, value) {
                    productName += value.productName + ', ';
                    ids += value.id + ' ';
                });
                $('#example1').append("<tr id='bundleOffer" + data.id + "'>"+
                    "<td>" + data.qty_start + "</td>"+
                    "<td>" + data.qty_end + "</td>"+
                    "<td>" + data.discount + "</td>"+
                    "<td>" + productName + "</td>"+
                    "<td><a class='edit-bundleOffer btn btn-warning btn-sm' data-id='" + data.id + "' data-qty_start='" + data.qty_start + "' data-qty_end='" + data.qty_end + "' data-discount='" + data.discount + "' data-product_id='" + data.product_id + "'><span class='fa fa-edit'></span></a> <a class='delete-bundleOffer btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
            }
        }
    });
    $(form).trigger('reset');
});

// function Edit Offer
$(document).on('click', '.edit-bundleOffer', function() {
    $('#footer_action_button').text(" Update bundle Offer");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('delete-bundleOffer');
    $('.actionBtn').addClass('editBundleOffer');
    $('.modal-title').text('bundleOffer Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#eqty_start').val($(this).data('qty_start'));
    $('#eqty_end').val($(this).data('qty_end'));
    $('#ediscount').val($(this).data('discount'));

    // Set all selected elements to false
    $("option:selected").prop("selected", false);

    var  product_id = $(this).data('product_id');
    var  product_name = $(this).data('product_name');

    $("#eproduct_id > option").each(function(){
        if ($(this).val() == product_id){
            // Select the matched option
            $(this).prop("selected", true);
            
        }
        
    });
    $('#myModal').modal('show');
});

// function Update Order

$('.modal-footer').on('click', '.editBundleOffer', function() {
    // Get the form.
    var form = $('#updateBundleOffer-form');

    // Serialize the form data.
    var formData = $(form).serialize();


    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: $(form).attr('action') + '/' + $('#fid').val(),
        data: formData,
        success: function(data) {
            console.log(data);
            var productName = '';
            var ids = '';
            $.each(data.products, function (key, value) {
                productName += value.productName + ', ';
                ids += value.id + ' ';
            });
            $('#bundleOffer'+ data.id).replaceWith("<tr id='bundleOffer" + data.id + "'>"+
                    "<td>" + data.qty_start + "</td>"+
                    "<td>" + data.qty_end + "</td>"+
                    "<td>" + data.discount + "</td>"+
                    "<td>" + productName + "</td>"+
                    "<td><a class='edit-bundleOffer btn btn-warning btn-sm' data-id='" + data.id + "' data-qty_start='" + data.qty_start + "' data-qty_end='" + data.qty_end + "' data-discount='" + data.discount + "' data-product_id='" + data.product_id + "'><span class='fa fa-edit'></span></a> <a class='delete-bundleOffer btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
        }
    });
});

// form Delete function
$(document).on('click', '.delete-bundleOffer', function() {
    $('.actionBtn').show();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteBundleOffer');
    $('.modal-title').text('Delete BundleOffer');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteBundleOffer', function(){
    $.ajax({
        type: 'POST',
        url: 'bundle-offers/'+$('.id').text(),
        data: {
            '_method': $('input[name=_method1]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#bundleOffer' + $('.id').text()).remove();
        }
    });
});

//#00 chat

$('.box-footer').on('click', '#replyButton', function() {
    // Get the form.
    var reply = $('#reply').val();
    var message_id = $(this).data('message_id');
    var client_id  = $(this).data('client_id');
    var _token = $('input[name="_token"]').val();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: 'message',
        data: {chat:reply, message_id:message_id, client_id:client_id, _token: _token},
        success: function(data) {
            console.log(data);
            location.reload(true);
        }
    });
});


/*-------------------------------------------
32. on demand RUD
--------------------------------------------- */
//for quote to client

$(".quoteToClient").click(function() {
    // Get the ondemand Id.

    var ondemand_id = $(this).data('ondemand_id');
    var quotation_id = $(this).data('quotation_id');

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: '/quote-to-client/'+ ondemand_id +'/'+ quotation_id,
        success: function(data){
            console.log(data);
            if ((data.errors)) {


            } else {

            // $('#ondemand'+ data.id).replaceWith("<tr id='ondemand" + data.id + "'>"+
            //         "<td>" + data.product + "</td>"+
            //         "<td>" + data.product_image + "</td>"+
            //         "<td>" + data.qty + "</td>"+
            //         "<td>" + data.unit + "</td>"+
            //         "<td>" + productName + "</td>"+
            //         "<td><a class='edit-bundleOffer btn btn-warning btn-sm' data-id='" + data.id + "' data-qty_start='" + data.qty_start + "' data-qty_end='" + data.qty_end + "' data-discount='" + data.discount + "' data-product_id='" + data.product_id + "'><span class='fa fa-edit'></span></a> <a class='delete-bundleOffer btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
            //         "</tr>");
                location.reload();

            }
        }
    });
});

//all to client

$(".allToQuote").click(function() {
    // Get the ondemand Id.

    var ondemand_id = $(this).data('id');

    

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: '/all-to-quote/'+ ondemand_id,
        success: function(data){
            console.log(data);
            if ((data.errors)) {

            } else {
                location.reload();

            }
        }
    });
});


$(".delete-ondemand").click(function() {
    // Get the ondemand Id.

    var ondemand_id = $(this).data('id');    

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: '/ondemands/'+ ondemand_id,
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': ondemand_id
        },        
        success: function(data){
            if ((data.errors)) {

            } else {
                location.reload();

            }
        }
    });
});


// function Edit Offer
$(document).on('click', '.update-ondemand', function() {
    $('#footer_action_button').text(" Update");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').removeClass('delete-ondemand');
    $('.actionBtn').addClass('editOndemand');
    $('.modal-title').text(' Update the ondemand / RFQ');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#eexpiry_date').val($(this).data('expiry_date'));
    $('#update').modal('show');
});

// function Update Order

$('.modal-footer').on('click', '.editOndemand', function() {


    // Get the form.
    var form = $('#updateOndemand-form');

    // Serialize the form data.
    var formData = $(form).serialize();

    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url:'ondemand-update/' + $('#fid').val(),
        data: formData,
        success: function(data) {
            console.log(data);
            location.reload();

            // $('#ondemand'+ data.id).replaceWith("<tr id='ondemand" + data.id + "'>"+
            //         "<td>" + data.product + "</td>"+
            //         "<td>" + data.product_image + "</td>"+
            //         "<td>" + data.qty + "</td>"+
            //         "<td>" + data.unit + "</td>"+
            //         "<td>" + productName + "</td>"+
            //         "<td><a class='edit-bundleOffer btn btn-warning btn-sm' data-id='" + data.id + "' data-qty_start='" + data.qty_start + "' data-qty_end='" + data.qty_end + "' data-discount='" + data.discount + "' data-product_id='" + data.product_id + "'><span class='fa fa-edit'></span></a> <a class='delete-bundleOffer btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
            //         "</tr>");
        }
    });
});


/*-------------------------------------------
33. delivery acknowledgement
--------------------------------------------- */


// -- quotation submit for rfq --
$(document).on('click','.delivery-acknowledgement-status', function() {
    $('#acknowledgement').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Delivery Acknowledgement status (prodyct received or not)');
    $('#order_id').val($(this).data('order_id'));
    $('#vendor_id').val($(this).data('vendor_id'));

});

$("#acknowledgement_status-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'delivery-acknowledgement-status',
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data);
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.acknowledgement_status === 'undefined') {
                    $('.acknowledgement_status').addClass('hidden');
                }
                $('.acknowledgement_status').text(data.errors.price);
                
            } else {
                
                $('.error').addClass('hidden');

                $('#acknowledgement').modal('hide');
                location.reload();
            }
        },
    });
});

/*-------------------------------------------
34. payment for vendor
--------------------------------------------- */

$(document).on('click','.payment-status', function() {
    $('#payment').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Payment status for vendor of this order');
    $('#payment_order_id').val($(this).data('order_id'));
    $('#payment_vendor_id').val($(this).data('vendor_id'));

});

$("#payment_status-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'vendor-payment-status',
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data);
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.payment_status === 'undefined') {
                    $('.payment_status').addClass('hidden');
                }
                $('.payment_status').text(data.errors.price);
                
            } else {
                
                $('.error').addClass('hidden');

                $('#payment').modal('hide');
                location.reload();
            }
        },
    });
});


/*-------------------------------------------
35. Product Information CRUD
--------------------------------------------- */


// -- ajax Form Add Policy--
$(document).on('click','.addProductInformation', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Product Information');
});


$("#insertProductInformation").submit(function(event) {
    event.preventDefault();

    // ajax post
    $.ajax({
        type: 'POST',
        url: '/product-Informations',
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data);
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.product_id === 'undefined') {
                    $('.product_id').addClass('hidden');
                }
                $('.product_id').text(data.errors.product_id);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='productInformation" + data.id + "'>"+
                    "<td>" + data.description_1 + "</td>"+
                    "<td><img src='storage/images/productInformation/" + data.image_1 + "' height='100px' width='100px'></td>"+
                    "<td>" + data.product_id + "</td>"+
                    "<td><a class='show-faq btn btn-info btn-sm' data-id='" + data.id + "' data-image_1='" + data.image_1 + "' data-description_1='" + data.description_1 + "' data-description_2='" + data.description_2 + "' data-description_3='" + data.description_3 + "' data-description_4='" + data.description_4 + "'><i class='fa fa-eye'></i></a> <a class='edit-faq btn btn-warning btn-sm' data-id='" + data.id + "' data-image_1='" + data.image_1 + "' data-description_1='" + data.description_1 +  "' data-description_2='" + data.description_2 + "' data-description_3='" + data.description_3 + "' data-description_4='" + data.description_4 + "'><i class='fa fa-edit'></i></a> <a class='delete-faq btn btn-danger btn-sm' data-id='" + data.id + "'><i class='fa fa-trash'></i></a></td>"+
                "</tr>");
                    
            }
        },
    });
    $('#image_1').val('');
    $('#description_1').val('');
    $('#product_id').val('');
    $('#create').modal('hide');
});

// function Edit 
$(document).on('click', '.edit-productInformation', function() {
    $('.actionBtn').hide();
    $('.modal-title').text('Product Information Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));

    

    var  product_id = $(this).data('product');

    $('#edescription_1').summernote('code',$(this).data('description_1'));
    $('#edescription_2').summernote('code',$(this).data('description_2'));
    $('#edescription_3').summernote('code',$(this).data('description_3'));
    $('#edescription_4').summernote('code',$(this).data('description_4'));

    // $("#eProduct1 > option").each(function(){
    //     if ($(this).val() == product1_id){
    //         $(this).prop("selected", true);
    //         $('#shProduct1').val($(this).text());
    //     }
        
    // });

$('#eproduct_name').text($(this).data('product_name'));


    $('#myModal').modal('show');
});

$('#updateProductInformation').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_method', 'PUT');
    $.ajax({
        type: 'POST',
        url: '/product-Informations/' + $('#fid').val(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            
            console.log(data);         
            $('#productInformation'+data.id).replaceWith("<tr id='productInformation" + data.id + "'>"+
                "<td>" + data.description_1 + "</td>"+
                "<td><img src='storage/images/productInformation/" + data.image_1 + "' height='100px' width='100px'></td>"+
                "<td>" + data.product.productName + "</td>"+
                "<td><a class='show-faq btn btn-info btn-sm' data-id='" + data.id + "' data-image_1='" + data.image_1 + "' data-description_1='" + data.description_1 + "' data-description_2='" + data.description_2 + "' data-description_3='" + data.description_3 + "' data-description_4='" + data.description_4 + "'><i class='fa fa-eye'></i></a> <a class='edit-faq btn btn-warning btn-sm' data-id='" + data.id + "' data-image_1='" + data.image_1 + "' data-description_1='" + data.description_1 +  "' data-description_2='" + data.description_2 + "' data-description_3='" + data.description_3 + "' data-description_4='" + data.description_4 + "'><i class='fa fa-edit'></i></a> <a class='delete-faq btn btn-danger btn-sm' data-id='" + data.id + "'><i class='fa fa-trash'></i></a></td>"+
                "</tr>");
        }
    });
    $('#myModal').modal('hide');
});


// Show function
$(document).on('click', '.show-faq', function() {
    $('#show').modal('show');
    $('#faqId').text($(this).data('id'));
    $('#faqAnswer').html($(this).data('answer'));
    $('#shquestion').val($(this).data('question'));
    $('.modal-title').text('Show FAq');
});


// form Delete function
$(document).on('click', '.delete-productInformation', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteProductInformation');
    $('.modal-title').text('Delete Product-Informations');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteProductInformation', function(){
    $.ajax({
        type: 'POST',
        url: 'product-Informations/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(data){
            $('#productInformation' + $('.id').text()).remove();
            location.reload();
        }
    });
});


/*-------------------------------------------
36. set commission for vendor
--------------------------------------------- */

$(document).on('click','.edit-commission', function() {
    $('#set-commission').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Set commission for vendor');
    $('#vendor_id').val($(this).data('id'));

});

$("#commission-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'vendor-commission',
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            console.log(data);
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.payment_status === 'undefined') {
                    $('.payment_status').addClass('hidden');
                }
                $('.payment_status').text(data.errors.price);
                
            } else {
                
                $('.error').addClass('hidden');

                $('#set-commission').modal('hide');
                location.reload();
            }
        },
    });
});



/*-------------------------------------------
  ##. Role CRUD
--------------------------------------------- */


// -- ajax Form Add Role--
$(document).on('click','.addRole', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Role');
});
$("#role-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'roles',
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.name === 'undefined') {
                    $('.roleName').addClass('hidden');
                }
                $('.error').text(data.errors.name);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='role" + data.id + "'>"+
                    "<td>"+data.id+"</td>"+
                    "<td>" + data.name + "</td>"+
                    "<td><a class='edit-role btn btn-warning btn-sm' data-id='" + data.id + "' data-roleName='" + data.roleName + "'><span class='fa fa-edit'></span></a> <a class='delete-role btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
                // location.reload();
            }
        },
    });
    $('#roleName').val('');
});

// function Edit Role
$(document).on('click', '.edit-role', function() {

    $('.actionBtn').hide();
    $('.modal-title').text('Role Edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));
    $('#eroleName').val($(this).data('name'));

    // Get the color
    var permission = $(this).data('permission');
    // Loop over each select option
    $(".permission").each(function(){
        // Check for the matching type
        if (permission.indexOf($(this).data('value')) >= 0){
            // Select the matched option
            $(this).prop("checked", true);
        }
    });


    $('#myModal').modal('show');
});

$('#role_update-form').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_method', 'PUT');

    $.ajax({
        type: 'POST',
        url: 'roles/' + $('#fid').val(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            location.reload();
        }
    });
});



/*-------------------------------------------
  ##. Permission CRUD
--------------------------------------------- */


// -- ajax Form Add permission--
$(document).on('click','.addPermission', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Permission');
});
$("#permission-form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'permissions',
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.name === 'undefined') {
                    $('.permissionName').addClass('hidden');
                }
                $('.error').text(data.errors.name);
            } else {
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='permission" + data.id + "'>"+
                    "<td>"+data.id+"</td>"+
                    "<td>" + data.name + "</td>"+
                    "<td><a class='edit-permission btn btn-warning btn-sm' data-id='" + data.id + "' data-roleName='" + data.name + "'><span class='fa fa-edit'></span></a> <a class='delete-permission btn btn-danger btn-sm' data-id='" + data.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
                
            }
        },
    });
    $('#permissionName').val('');
});


// form Delete function
$(document).on('click', '.delete-permission', function() {
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deletePermission');
    $('.modal-title').text('Delete Permission');
    $('.id').val($(this).data('id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deletePermission', function(){
    $.ajax({
        type: 'POST',
        url: 'permissions/'+$('.id').val(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').val()
        },
        success: function(data){
            $('#category' + $('.id').val()).remove();
        }
    });
});

/*-------------------------------------------
  ##. User role CRUD
--------------------------------------------- */

// function Edit Category
$(document).on('click', '.user-role', function() {
    $('.actionBtn').hide();
    $('.modal-title').text('Set Role & Permission');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $('#fid').val($(this).data('id'));

    // Get the color
    var permission = $(this).data('permission');
    // Loop over each select option
    $(".permission").each(function(){
        // Check for the matching type
        if (permission.indexOf($(this).data('value')) >= 0){
            // Select the matched option
            $(this).prop("checked", true);
        }
    });


    $('#set-role').modal('show');
});

$('#role_permission-form').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_method', 'PUT');

    $.ajax({
        type: 'POST',
        url: 'roles-permission/' + $('#fid').val(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            location.reload();
        }
    });
});



/*-------------------------------------------
##. Service CRUD
--------------------------------------------- */


// -- ajax Form Add Service--
$(document).on('click','.addService', function(e) {
    e.preventDefault();
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add Service');
});
$("#service-form").submit(function(event) {
    // update CKEDITOR element
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'services',
        data: new FormData( this ),
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.serviceName === 'undefined') {
                    $('.serviceName').addClass('hidden');
                }
                $('.serviceName').text(data.errors.serviceName);
                if (typeof data.errors.sku === 'undefined') {
                    $('.sku').addClass('hidden');
                }
                $('.sku').text(data.errors.sku);
                if (typeof data.errors.regularPrice === 'undefined') {
                    $('.regularPrice').addClass('hidden');
                }
                $('.regularPrice').text(data.errors.regularPrice);
               
                if (typeof data.errors.image === 'undefined') {
                    $('.image').addClass('hidden');
                }
                $('.image').text(data.errors.image);
                
                $('.description').text(data.errors.description);
                if (typeof data.errors.shortDescription === 'undefined') {
                    $('.shortDescription').addClass('hidden');
                }
                $('.shortDescription').text(data.errors.shortDescription);
            } else {
                
                $('.error').addClass('hidden');
                $('#example1').append("<tr id='service" + data.service.id + "'>"+
                    "<td>" + data.service.serviceName + "</td>"+
                    "<td><img src='storage/images/service/" + data.service.image + "' height='100px' width='100px'></td>"+
                    "<td>" + data.service.sku + "</td>"+
                    "<td>" + $('#category_id >option:selected').text() + "</td>"+
                    "<td>" + $('#subcategory_id >option:selected').text() + "</td>"+
                    "<td>" + $('#minicategory_id >option:selected').text() + "</td>"+
                    "<td>Tk " + data.service.regularPrice + "</td>"+
                    "<td><a class='show-service btn btn-info btn-sm' data-id='" + data.service.id + "' data-serviceName='" + data.service.serviceName + "' data-image='" + data.service.image + "' data-sku='" + data.service.sku + "' data-category='" + $('#category_id >option:selected').text() + "' data-subcategory='" + $('#subcategory_id >option:selected').text() + "' data-minicategory='" + $('#minicategory_id >option:selected').text() + "' data-tab='" + $('#tab_id >option:selected').text() +"' data-regularPrice='" + data.service.regularPrice + "' data-description='" + data.service.description + "' data-specification='" + data.service.specification + "' data-availability='" + $('#availability >option:selected').text() + "'><span class='fa fa-eye'></span></a><a class='edit-service btn btn-warning btn-sm' data-id='" + data.service.id + "' data-serviceName='" + data.service.serviceName + "' data-sku='" + data.service.sku + "' data-category_id='" + $('#category_id >option:selected').val() + "' data-subcategory_id='" + $('#subcategory_id >option:selected').val() + "' data-minicategory_id='" + $('#minicategory_id >option:selected').val() + "' data-tab_id='" + $('#tab_id >option:selected').val() + "' data-subcategory='" + $('#subcategory_id >option:selected').text() + "' data-minicategory='" + $('#minicategory_id >option:selected').text() + "' data-tab='" + $('#tab_id >option:selected').text() + "' data-regularPrice='" + data.service.regularPrice + "' data-description='" + data.service.description + "' data-short_description='" + data.service.shortDescription + "' data-specification='" + data.service.specification + "' data-availability='" + $('#availability >option:selected').val() + "'><span class='fa fa-edit'></span></a> <a class='delete-service btn btn-danger btn-sm' data-id='" + data.service.id + "'><span class='fa fa-trash'></span></a></td>"+
                    "</tr>");
                    $('#service-form').trigger("reset");
                    CKEDITOR.instances.shortDescription.setData( '' );
                    CKEDITOR.instances.description.setData( '' );
                    CKEDITOR.instances.specification.setData( '' );
            }
        },
    });
});

// function Edit Product
$(document).on('click', '.edit-service', function(e) {
    e.preventDefault();
    $('#updateService').trigger("reset");
    // CKEDITOR.instances.shortDescription.setData( '' );
    // CKEDITOR.instances.description.setData( '' );
    // CKEDITOR.instances.specification.setData( '' );
    $('#ID').val($(this).data('id'));
    $('#eserviceName').val($(this).data('servicename'));
    $('#esku').val($(this).data('sku'));
    $('#eregularPrice').val($(this).data('regularprice'));
    $('#eslug').val($(this).data('slug'));

    $('#emin_order_qty').val($(this).data('min_order_qty'));
    $('#eservice_area').val($(this).data('service_area'));


    $('#ediscount').val($(this).data('discount'));

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

    // Get the unit
    // var  unit = $(this).data('unit');
    var  unit = $(this).data('unit');

    // Loop over each select option
    $("#eunit > option").each(function(){
        // Check for the matching unit
        if ($(this).val() == unit){
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



    CKEDITOR.instances.eshortDescription.setData( $(this).data('short_description') );
    CKEDITOR.instances.uDescription.setData( $(this).data('description') );
    CKEDITOR.instances.uSpecification.setData( $(this).data('specification') );
    $('.modal-title').text('Edit Service');
    $('.form-horizontal').show();
    $('#update').modal('show');
});

$('#updateService').submit(function(event) {
    // update CKEDITOR element
    for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }
    event.preventDefault();
    var formData = new FormData(this);
    formData.append('_method', 'PUT');
    $.ajax({
        type: 'POST',
        url: 'service/' + $('#ID').val(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                if (typeof data.errors.serviceName === 'undefined') {
                    $('.eserviceName').addClass('hidden');
                }
                $('.eserviceName').text(data.errors.serviceName);

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
                
                $('#service' + data.service.id).replaceWith(" " +
                    "<tr id='service" + data.service.id + "'>" +
                    "<td>" + data.service.serviceName + "</td>" +
                    "<td><img src='storage/images/service/" + data.service.image + "' height='100px' width='100px'></td>" +
                    "<td>" + data.service.sku + "</td>" +
                    "<td>" + $('#ecategory_id >option:selected').text() + "</td>" +
                    "<td>" + $('#esubcategory_id >option:selected').text() + "</td>" +
                    "<td>" + $('#eminicategory_id >option:selected').text() + "</td>" +
                    "<td>৳ " + data.service.regularPrice + "</td>" +
                    "<td><a class='show-service btn btn-info btn-sm' data-id='" + data.service.id + "' data-serviceName='" + data.service.serviceName + "' data-image='" + data.service.image + "' data-sku='" + data.service.sku + "' data-category='" + $('#category_id >option:selected').text() + "' data-subcategory='" + $('#subcategory_id >option:selected').text() + "' data-minicategory='" + $('#minicategory_id >option:selected').text() + "' data-tab='" + $('#tab_id >option:selected').text() + "' data-regularPrice='" + data.service.regularPrice + "' data-description='" + data.service.description + "' data-specification='" + data.service.specification + "' data-availability='" + $('#availability >option:selected').text()+ "'><span class='fa fa-eye'></span></a><a class='edit-service btn btn-warning btn-sm' data-id='" + data.service.id + "' data-serviceName='" + data.service.serviceName + "' data-sku='" + data.service.sku + "' data-category_id='" + $('#category_id >option:selected').val() + "' data-subcategory_id='" + $('#subcategory_id >option:selected').val() + "' data-minicategory_id='" + $('#minicategory_id >option:selected').val() + "' data-tab_id='" + $('#tab_id >option:selected').val() + "' data-subcategory='" + $('#subcategory_id >option:selected').text() + "' data-minicategory='" + $('#minicategory_id >option:selected').text() + "' data-tab='" + $('#tab_id >option:selected').text() + "' data-regularPrice='" + data.service.regularPrice + "' data-short_description='" + data.service.shortDescription + "' data-description='" + data.service.description + "' data-specification='" + data.service.specification + "' data-availability='" + $('#availability >option:selected').val() + "'><span class='fa fa-edit'></span></a> <a class='delete-service btn btn-danger btn-sm' data-id='" + data.service.id + "'><span class='fa fa-trash'></span></a></td>" +
                    "</tr>");
                    location.reload();
            }
        }
    });
});

// form published function
$(document).on('click', '.publish-service', function(e) {
    e.preventDefault();
    $('#footer_action_button').text("Publish");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').addClass('publishService');
    $('.modal-title').text('Publish this Service');
    $('.sId').text($(this).data('id'));
    $('.publishContent').show();
    $('#publish').modal('show');
});

$('.modal-footer').on('click', '.publishService', function(){
    $.ajax({
        type: 'PUT',
        url: 'published-service/'+$('.sId').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.sId').text()
        },
        success: function(){
            $('#service' + $('.id').text()).remove();
            location.reload();
        }
    });
});



// form Delete function
$(document).on('click', '.delete-service', function(e) {
    e.preventDefault();
    $('#footer_action_button').text(" Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('deleteService');
    $('.modal-title').text('Delete Service');
    $('.id').text($(this).data('id'));
    $('.deleteContent').show();
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.deleteServices', function(){
    $.ajax({
        type: 'POST',
        url: 'services/'+$('.id').text(),
        data: {
            '_token': $('input[name=_token]').val(),
            '_method': $('input[name=_method]').val(),
            'id': $('.id').text()
        },
        success: function(){
            $('#service' + $('.id').text()).remove();
        }
    });
});


// Show function
$(document).on('click', '.show-service', function(e) {
    e.preventDefault();
    $('#show').modal('show');
    $('#i').val($(this).data('id'));
    $('#prnm').val($(this).data('servicename'));
    $('#ct').val($(this).data('category'));
    $('#img').attr('src', 'storage/images/service/' + $(this).data('image'));
    $('#sct').val($(this).data('subcategory'));
    $('#mnctgr').val($(this).data('minicategory'));
    $('#stab').val($(this).data('tab'));
    $('#sl').val($(this).data('slug'));

    $('#sdiscount').val($(this).data('discount'));
      
    $('#sunit').val($(this).data('unit'));
    $('#smin_order_qty').val($(this).data('min_order_qty'));
    $('#sservice_area').val($(this).data('service_area'));

    $('#sk').val($(this).data('sku'));
    $('#av').val($(this).data('availability'));
    $('#rPrice').val($(this).data('regularprice'));
    $('#showShortDescription').html($(this).data('short_description'));
    $('#des').html($(this).data('description'));
    $('#spc').html($(this).data('specification'));
    $('.modal-title').text('Show service');
});



