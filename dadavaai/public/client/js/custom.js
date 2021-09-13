//written by dadavaai development team start
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-bottom-left",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "100",
    "hideDuration": '1000',
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }

// passes csrf token to every ajax htttp request
// =============
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


/*-------------------------------------------
  00. compare
--------------------------------------------- */
// Retrieve subcategories from category dynamically using ajax & jquery
$(document).ready(function() {
    $('#addPreductToCompare').change(function() {
        $.ajax({
            type:"GET",
            url:"addCompare/"+$('#addPreductToCompare').val(),
            success : function(results) {
                location.reload();
            }
        });
    });
});

// -- ajax Form Wishlist register --

$(document).on('click', '.addToCompare', function(e) {
    // this will get the full URL at the address bar

    var url = window.location.href;
    e.preventDefault();
    $.ajax({
        type: 'Get',
        url: $(this).data('url'),
        data: {
            'product_id': $(this).data('id')
        },
        success: function(data){
            if ((data.error)) {
                toastr.error(data.error);

            } else {
                toastr.success(data.success);
                // $(location).attr("href", url);
            }
        }
    });
});




/*-------------------------------------------
  00. home product (minicategory)
--------------------------------------------- */

$(document).on('click', '.h_cat', function(e){
    e.preventDefault();
    $('.all_p_minicat_products').removeClass('hide');
    $('.all_p_minicat_ajax').html('')
});

$(document).on('click', '.h_minicat_all', function(e){
    e.preventDefault();
    $('.all_p_minicat_products').removeClass('hide');
    $('.all_p_minicat_ajax').html('')
});

$(document).on('click', '.h_minicat', function(e){
    e.preventDefault();

    var minicat_id = $(this).data('mini_cat_id');
    
    $('.all_p_minicat_products').addClass('hide');
    $('.all_p_minicat_ajax').html('')

    $.ajax({
        type: "get",
        url: $(this).data('url'),
        data: {
            'id' : minicat_id,
        },
        
        dataType: "json",
        success: function (data) {

            //for product show
            $.each(data.products, function(index, item) {

                var salePrice = 0;

                var salePriceStatus = true;

                var shortDescription = item.shortDescription.replace(/(<([^>]+)>)/ig,"");

                var productName = item.productName.substr(0, 26);


                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                    } else {
                        salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                    }
                } else {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                    } else {
                        salePrice = item.regularPrice;
                    }
                }

                $('.all_p_minicat_ajax').append(
                    "<div class='col-md-4 col-sm-6 w-20'>\n"+
                    "<div class='portfolio-wrapper'>\n"+
                        "<div class='portfolio-thumb'>\n"+
                            "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                            "<div class='portfolio-content'>\n"+   
                                "<div class='pop-up-icon'>\n"+
                                    "<a class='center-link quick-view' data-toggle='modal'  data-target='#product-preview' title='Quick View' data-min_order_qty='"+item.min_order_qty+"' data-brand='"+item.brand.brandName +"' data-category='"+item.category.categoryName +"'  data-id='"+item.id+"' data-slug='"+item.slug+"' data-name='"+item.productName+"' data-image='/storage/images/product/"+ item.image.image1 +"' data-desc='"+shortDescription+"' data-sale='"+salePrice+"'  data-regular='"+ item. regularPrice +"' data-url='/product/"+item.id+"/"+ item.slug + "'><i class='fa fa-search'></i></a>\n"+

                                    "<a href='#' class='compare left-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+

                                    // "<a href='#' class='left-link addToCompare' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+  

                                    "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                "</div>\n"+                                                  
                            "</div>\n"+
                        "</div>\n"+
                        "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + productName +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                     "</div>\n" +
                     "</div>\n");

            });

            if (data.products.length > 0) {
                $('.all_p_minicat_ajax').append(
                    "<div class='col-md-3 col-sm-6 col-xs-12 w-20'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='product-content'>\n"+
                                "<a href='product-by-minicategory/"+ minicat_id +"'>\n"+
                                    "<img src='client/img/extra/view_all.jpg' alt=''>\n"+
                                "</a>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"
                );
                
            } else {
                $('.all_p_minicat_ajax').append(
                    "<div class='col-md-3 col-sm-6 col-xs-12 w-20'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='product-content'>\n"+
                                "<a>Nothing to Show</a>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"
                );
                
            }


        }
    });


});




/*-------------------------------------------
  00. Ondemand
--------------------------------------------- */
$('input[type=radio][name=ondemand_type]').change(function() {
    if (this.value == 'product') {
        $('#service_rfq').addClass('hide');
        $('#product_rfq').removeClass('hide');
    }
    else if (this.value == 'service') {
        $('#service_rfq').removeClass('hide');
        $('#product_rfq').addClass('hide');
    }
});



/*-------------------------------------------
  00. review store
--------------------------------------------- */
$(document).on('submit', '#review-form', function(e) {
    e.preventDefault();

    var rating = $('#ratings-hidden').val();
    var review = $('#new_review').val();
    var product_id = $('#product_id-hidden').val();
    
    // Submit the form using AJAX.
    $.ajax({
        type: 'post',
        url: '/product-review',
        data: {
            'rating': rating,
            'review': review,
            'product_id' : product_id,
        },
        success: function(data){

            console.log(data);

            if (data.error) {
                $.each( data.error, function( key, value ) {
                    toastr.error(value);
                  });
                // toastr.error(data.error);

            } else {
                toastr.success(data.success);
                // location.reload(true);
                $("#review-block").css("display", "none");
                // location.reload();
            }
        }
    });
});




/*-------------------------------------------
  00. review
--------------------------------------------- */
(function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

$(function(){

  $('#new-review').autosize({append: "\n"});

  var reviewBox = $('#post-review-box');
  var newReview = $('#new-review');
  var openReviewBtn = $('#open-review-box');
  var closeReviewBtn = $('#close-review-box');
  var ratingsField = $('#ratings-hidden');

  openReviewBtn.click(function(e)
  {
    reviewBox.slideDown(400, function()
      {
        $('#new-review').trigger('autosize.resize');
        newReview.focus();
      });
    openReviewBtn.fadeOut(100);
    closeReviewBtn.show();
  });

  closeReviewBtn.click(function(e)
  {
    e.preventDefault();
    reviewBox.slideUp(300, function()
      {
        newReview.focus();
        openReviewBtn.fadeIn(200);
      });
    closeReviewBtn.hide();
    
  });

  $('.starrr').on('starrr:change', function(e, value){
    ratingsField.val(value);
  });
});


/*-------------------------------------------
  00. global link (middle header)
--------------------------------------------- */

$('#global-dropdown').on('change', function() {

    var goto = this.value;
    window.location.href = goto;
});



/*-------------------------------------------
  00. offers  sidebar (minicategory)
--------------------------------------------- */

$(document).on('click', '.offer-minicat-sidebar', function(e){
    e.preventDefault();

    var minicat_id = $(this).data('id');
    var cat_id = $(this).data('cat_id');
    var subcat_id = $(this).data('subcat_id');

    // $('.subcat-panel-collapse').removeClass('in');
    $('.cat-panel-'.cat_id).addClass('in');
    $('.subcat-panel-'.subcat_id).addClass('in');
    $('.offer-minicat-sidebar').css('color','');
    $(this).css("color", "red");

    $("#price_range_form").attr("action", $(this).data('url'));
    
    $('#main').addClass('hide');


    $.ajax({
        type: "get",
        url: $(this).data('url'),
        data: {
            'minicatId': minicat_id,
        },
        dataType: "json",
        success: function (data) {

            console.log(data);

            $('#ajax_cat').html("");

            $('#ajax_cat').append(

                "<div class='page-description spcbt-30'>\n"+
                       "<img src='/storage/images/category/"+ data.category.image_ad +"' alt='banner-category-page' >\n"+
                "</div>\n"+
 
                "<div class='' tab-pane fade active in' role='tabpanel'>\n"+
                    "<div id='sort' class='row text-center hvr2 clearfix'>\n"+

                    "</div>\n"+
                "</div>\n");

            $.each(data.products, function(index, item) {

                var salePrice = 0;
                var offer_val = 0;

                var salePriceStatus = true;

                var shortDescription = item.shortDescription.replace(/(<([^>]+)>)/ig,"");

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                        offer_val = item.deal.discount_value+ item.discount;
                    } else {
                        salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                        offer_val = item.discount;
                    }
                } else {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                        offer_val = item.deal.discount_value;
                    } else {
                        salePrice = item.regularPrice;
                        salePriceStatus = false;
                    }
                }
               
                $('#ajax_cat').append(
                    "<div class='col-md-4 col-sm-6'>\n"+
                    "<div class='portfolio-wrapper'>\n"+
                        "<div class='portfolio-thumb'>\n"+
                            "<div class='icon-discount-label discount-right'>" + offer_val +" % \n"+  
                            "</div>\n"+
                            "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                            "<div class='portfolio-content'>\n"+   
                                "<div class='pop-up-icon'>\n"+
                                    "<a class='center-link quick-view' data-toggle='modal'  data-target='#product-preview' title='Quick View' data-min_order_qty='"+item.min_order_qty+"' data-brand='"+item.brand.brandName +"' data-category='"+item.category.categoryName +"'  data-id='"+item.id+"' data-slug='"+item.slug+"' data-name='"+item.productName+"' data-image='/storage/images/product/"+ item.image.image1 +"' data-desc='"+shortDescription+"' data-sale='"+salePrice+"'  data-regular='"+ item. regularPrice +"' data-url='/product/"+item.id+"/"+ item.slug + "'><i class='fa fa-search'></i></a>\n"+
                                    "<a href='#' class='compare left-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+ 
                                    "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                "</div>\n"+                                                  
                            "</div>\n"+
                        "</div>\n"+
                        "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                     "</div>\n" +
                     "</div>\n");
            });
        }
    });


});


/*-------------------------------------------
  00. offers  sidebar (subcategory)
--------------------------------------------- */

$(document).on('click', '.offer-subcat-sidebar', function(e){
    e.preventDefault();

    var subcat_id = $(this).data('id');
    var cat_id = $(this).data('cat_id');


    // $('.cat-sidebar').addClass('collapsed');
    // $('cat-'.cat_id).removeClass('collapsed');
    $('.subcat-panel-collapse').removeClass('in');
    $('.cat-panel-'.cat_id).addClass('in');
    $('.subcat-panel-'.subcat_id).addClass('in');
    $('.offer-subcat-sidebar').css('color','');
    $('.offer-minicat-sidebar').css('color','');

    $(this).css("color", "red");

    $("#price_range_form").attr("action", $(this).data('url'));

    $('#main').addClass('hide');


    $.ajax({
        type: "get",
        url: $(this).data('url'),
        data: {
            'subcatId': subcat_id,
        },
        dataType: "json",
        success: function (data) {

            $('#ajax_cat').html("");

            $('#ajax_cat').append(

                "<div class='page-description spcbt-30'>\n"+
                       "<img src='/storage/images/category/"+ data.singleSubcategory.category.image_ad +"' alt='banner-category-page' >\n"+
                "</div>\n"+

                "<div class='' tab-pane fade active in' role='tabpanel'>\n"+
                    "<div id='sort' class='row text-center hvr2 clearfix'>\n"+

                    "</div>\n"+
                "</div>\n");

            $.each(data.products, function(index, item) {

                var salePrice = 0;
                var offer_val = 0;

                var salePriceStatus = true;

                var shortDescription = item.shortDescription.replace(/(<([^>]+)>)/ig,"");

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                        offer_val = item.deal.discount_value+ item.discount;
                    } else {
                        salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                        offer_val = item.discount;
                    }
                } else {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                        offer_val = item.deal.discount_value;
                    } else {
                        salePrice = item.regularPrice;
                        salePriceStatus = false;
                    }
                }

                // if (salePriceStatus == true) {
                $('#ajax_cat').append(
                    "<div class='col-md-4 col-sm-6'>\n"+
                    "<div class='portfolio-wrapper'>\n"+
                        "<div class='portfolio-thumb'>\n"+
                            "<div class='icon-discount-label discount-right'>" + offer_val +" % \n"+  
                            "</div>\n"+
                            "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                            "<div class='portfolio-content'>\n"+   
                                "<div class='pop-up-icon'>\n"+
                                    "<a class='center-link quick-view' data-toggle='modal'  data-target='#product-preview' title='Quick View' data-min_order_qty='"+item.min_order_qty+"' data-brand='"+item.brand.brandName +"' data-category='"+item.category.categoryName +"'  data-id='"+item.id+"' data-slug='"+item.slug+"' data-name='"+item.productName+"' data-image='/storage/images/product/"+ item.image.image1 +"' data-desc='"+shortDescription+"' data-sale='"+salePrice+"'  data-regular='"+ item. regularPrice +"' data-url='/product/"+item.id+"/"+ item.slug + "'><i class='fa fa-search'></i></a>\n"+
                                    "<a href='#' class='compare left-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+ 
                                    "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                "</div>\n"+                                                  
                            "</div>\n"+
                        "</div>\n"+
                        "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                     "</div>\n" +
                     "</div>\n");
            });
        }
    });


});


/*-------------------------------------------
  00. offers  sidebar (category)
--------------------------------------------- */

$(document).on('click', '.offer-cat-sidebar', function(e){
    e.preventDefault();

    var cat_id = $(this).data('id');

    $('.offer-cat-sidebar').addClass('collapsed');
    $(this).removeClass('collapsed');
    $('.panel-collapse').removeClass('in');
    $('.cat-panel-'.cat_id).addClass('in');

    $('.offer-cat-sidebar').css('color','');
    $('.offer-minicat-sidebar').css('color','');
    $('.offer-subcat-sidebar').css('color','');

    $(this).css("color", "red");

    $("#price_range_form").attr("action", $(this).data('url'));

    $('#main').addClass('hide');

    $.ajax({
        type: "get",
        url: $(this).data('url'),
        data: {
            'categoryId': cat_id,
        },
        dataType: "json",
        success: function (data) {

            // console.log(data);
            $('#ajax_cat').html("");

            $('#ajax_cat').append(

                "<div class='page-description spcbt-30'>\n"+
                       "<img src='/storage/images/category/"+ data.singleCategory.image_ad +"' alt='banner-category-page' >\n"+
                "</div>\n"+
 
                "<div class='' tab-pane fade active in' role='tabpanel'>\n"+
                    "<div id='sort' class='row text-center hvr2 clearfix'>\n"+

                    "</div>\n"+
                "</div>\n");

            $.each(data.products, function(index, item) {

                var salePrice = 0;
                var offer_val = 0;

                var salePriceStatus = true;

                var shortDescription = item.shortDescription.replace(/(<([^>]+)>)/ig,"");

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                        offer_val = item.deal.discount_value+ item.discount;
                    } else {
                        salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                        offer_val = item.discount;
                    }
                } else {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                        offer_val = item.deal.discount_value;
                    } else {
                        salePrice = item.regularPrice;
                        salePriceStatus = false;
                    }
                }

                $('#ajax_cat').append(
                    "<div class='col-md-4 col-sm-6'>\n"+
                    "<div class='portfolio-wrapper'>\n"+
                        "<div class='portfolio-thumb'>\n"+
                            "<div class='icon-discount-label discount-right'>" + offer_val +" % \n"+  
                            "</div>\n"+
                            "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                            "<div class='portfolio-content'>\n"+   
                                "<div class='pop-up-icon'>\n"+
                                    "<a class='center-link quick-view' data-toggle='modal'  data-target='#product-preview' title='Quick View' data-min_order_qty='"+item.min_order_qty+"' data-brand='"+item.brand.brandName +"' data-category='"+item.category.categoryName +"'  data-id='"+item.id+"' data-slug='"+item.slug+"' data-name='"+item.productName+"' data-image='/storage/images/product/"+ item.image.image1 +"' data-desc='"+shortDescription+"' data-sale='"+salePrice+"'  data-regular='"+ item. regularPrice +"' data-url='/product/"+item.id+"/"+ item.slug + "'><i class='fa fa-search'></i></a>\n"+
                                    "<a href='#' class='compare left-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+ 
                                    "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                "</div>\n"+                                                  
                            "</div>\n"+
                        "</div>\n"+
                        "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                     "</div>\n" +
                     "</div>\n");
            });

        }
    });


});



/*-------------------------------------------
  00. search faq in All faq page
--------------------------------------------- */

jQuery('#faqs-search').on('keyup', function(e) {
    
    var query = $(this).val().toLowerCase();

    if(query !== ''){
        $('#all-faqs').addClass('hide');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/faqs-search",
            method: "GET",
            data: {query:query, _token: _token},
            success: function (data) {

            console.log(data);

                $('#ajax_call').html("");
                $.each(data, function(index, item) {

                $('#ajax_call').append(

                "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>\n"+
                    "<div class='panel panel-default'>\n"+
                      "<div class='panel-heading' role='tab' id='heading"+ item.id +"'>\n"+
                        "<h4 class='panel-title'>\n"+
                          "<a class='red-clr' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse" + item.id +"' aria-expanded='true' aria-controls='collapse" + item.id +"'>\n"+
                              "<i class='fa fa-minus' aria-hidden='true'></i> &nbsp; &nbsp;"+ item.question +"\n"+
                          "</a>\n"+
                        "</h4>\n"+
                      "</div>\n"+
                      "<div id='collapse" +item.id +"' class='panel-collapse collapse in' role='tabpanel' aria-expanded='true' aria-labelledby='heading" + item.id + "'>\n"+
                        "<div class='panel-body'> "+ item.answer +" \n"+
                        "</div>\n"+
                      "</div>\n"+
                    "</div>\n"+
                "</div>\n");

                });

          }
      });
    }else{
        $('#all-faqs').removeClass('hide');
        $('#ajax_call').html("");
    }

});


/*-------------------------------------------
  00. Menu brand (category)
--------------------------------------------- */

$(".brandCategory").hover(function(){

    var cat_id = $(this).data('id');


    $('.brandCategory').css('color','');
    $(this).css("color", "red");


    $('#brandItem').addClass('hide');

    var categoryId = $(this).find(':selected').data('id');

    $.ajax({
        type: "get",
        url: '/all-brands',
        data: {
            'categoryId': cat_id,
        },
        dataType: "json",
        success: function (data) {

            console.log(data);
            $('#brandSort').html("");
            $.each(data.brands, function(index, item) {

                if(index <= 17){
                    $('#brandSort').append(

                        "<a href='/product-by-brand/"+item.id +"/"+item.brandName.replace(/\s+/g, '_')+"'>\n"+
                            "<div class='col-lg-2 col-md-3 col-sm-3 menu-block mb-3' style='padding: 5px;'>\n"+
                                "<div class='sub-list text-center' style='height: 120px'>\n"+
                                    "<div class='menu-card' style='border: #999 1px solid; border-radius: 5px;'>\n"+
                                        "<img src='storage/images/brand/"+item.brandImage + "' height='100%' width='100%'' alt='"+ item.brandName +" ' style='padding: 10px;'>\n"+
                                    "</div>\n"+
                                    "<div>\n"+
                                        "<h5 class='fsz-10 mt-20'>" + item.brandName + "</h5>\n"+
                                    "</div>\n"+
                                    "<br>\n"+
                                "</div>\n"+
                            "</div>\n"+ 
                        "</a>");

                }
                    
            });

        }
    });



});



// $(document).on('click', '.brandCategory', function(e){
//     e.preventDefault();

//     var cat_id = $(this).data('id');


//     $('.brandCategory').css('color','');
//     $(this).css("color", "red");


//     $('#brandItem').addClass('hide');

//     var categoryId = $(this).find(':selected').data('id');

//     $.ajax({
//         type: "get",
//         url: '/all-brands',
//         data: {
//             'categoryId': cat_id,
//         },
//         dataType: "json",
//         success: function (data) {

//             console.log(data);
//             $('#brandSort').html("");
//             $.each(data.brands, function(index, item) {

//                 $('#brandSort').append(

//                     "<a href='/product-by-brand/"+item.id +"/"+item.brandName.replace(/\s+/g, '_')+"'>\n"+
//                         "<div class='col-lg-2 col-md-3 col-sm-3 menu-block mb-3' style='padding: 5px;'>\n"+
//                             "<div class='sub-list text-center' style='height: 120px'>\n"+
//                                 "<div class='menu-card' style='border: #999 1px solid; border-radius: 5px;'>\n"+
//                                     "<img src='storage/images/brand/"+item.brandImage + "' height='100%' width='100%'' alt='"+ item.brandName +" ' style='padding: 10px;'>\n"+
//                                 "</div>\n"+
//                                 "<div>\n"+
//                                     "<h5 class='fsz-10 mt-20'>" + item.brandName + "</h5>\n"+
//                                 "</div>\n"+
//                                 "<br>\n"+
//                             "</div>\n"+
//                         "</div>\n"+ 
//                     "</a>");
                    
//             });

//         }
//     });


// });


/*-------------------------------------------
  00. all brand   sidebar (minicategory)
--------------------------------------------- */

$(document).on('click', '.brand-minicat-sidebar', function(e){
    e.preventDefault();

    var minicat_id = $(this).data('id');
    var cat_id = $(this).data('cat_id');
    var subcat_id = $(this).data('subcat_id');

    // $('.subcat-panel-collapse').removeClass('in');
    $('.cat-panel-'.cat_id).addClass('in');
    $('.subcat-panel-'.subcat_id).addClass('in');
    $('.brand-minicat-sidebar').css('color','');
    $(this).css("color", "red");

    $("#price_range_form").attr("action", $(this).data('url'));
    
    $.ajax({
        type: "get",
        url: '/all-brands',
        data: {
            'minicategoryId': minicat_id,
        },
        dataType: "json",
        success: function (data) {

            console.log(data);
            $('#breadcrumbs').html("");
            $('#breadcrumbs').append(
                "<i class='fa fa-arrow-circle-right'></i>\n"+
                "<span class='current red-clr'>"+ data.minicategory.subcategory.subCategoryName + "</span>\n"+                
                "<i class='fa fa-arrow-circle-right'></i>\n"+
                "<span class='current red-clr'>"+ data.minicategory.miniCategoryName + "</span>\n"
                );
            $('#breadcrumbs').removeClass('hide');

            $('#grid-view-brand').addClass('hide');
            $('#sort').html("");
            $.each(data.brands, function(index, item) {


                $('#sort').append(

                    "<a href='/product-by-brand/"+item.id +"/"+ item.brandName.replace(/\s+/g, '_') +"'>\n"+
                        "<div class='col-lg-2 col-md-3 col-sm-3 menu-block mb-3' style='padding: 5px;'>\n"+
                            "<div class='sub-list text-center' style='height: 120px'>\n"+
                                "<div class='menu-card' style='border: #999 1px solid; border-radius: 5px;'>\n"+
                                    "<img src='storage/images/brand/"+item.brandImage + "' height='100%' width='100%'' alt='"+ item.brandName +" ' style='padding: 10px;'>\n"+
                                "</div>\n"+
                                "<div>\n"+
                                    "<h5 class='fsz-10 mt-20'>" + item.brandName + "</h5>\n"+
                                "</div>\n"+
                                "<br>\n"+
                            "</div>\n"+
                        "</div>\n"+ 
                    "</a>");
                    
            }); 

        }
    });


});


/*-------------------------------------------
  00. all brand   sidebar (subcategory)
--------------------------------------------- */

$(document).on('click', '.brand-subcat-sidebar', function(e){
    e.preventDefault();

    var subcat_id = $(this).data('id');
    var cat_id = $(this).data('cat_id');


    $('.subcat-panel-collapse').removeClass('in');
    $('.cat-panel-'.cat_id).addClass('in');
    $('.subcat-panel-'.subcat_id).addClass('in');
    $('.brand-subcat-sidebar').css('color','');
    $(this).css("color", "red");

    $("#price_range_form").attr("action", $(this).data('url'));

    $.ajax({
        type: "get",
        url: '/all-brands',
        data: {
            'subcategoryId': subcat_id,
        },
        dataType: "json",
        success: function (data) {

            $('#breadcrumbs').html("");
            $('#breadcrumbs').append(
                "<i class='fa fa-arrow-circle-right'></i>\n"+
                "<span class='current red-clr'>"+ data.subcategory.subCategoryName + "</span>\n"
                );
            $('#breadcrumbs').removeClass('hide');

            $('#grid-view-brand').addClass('hide');
            $('#sort').html("");
            $.each(data.brands, function(index, item) {


                $('#sort').append(

                    "<a href='/product-by-brand/"+item.id +"/"+item.brandName.replace(/\s+/g, '_')+"'>\n"+
                        "<div class='col-lg-2 col-md-3 col-sm-3 menu-block mb-3' style='padding: 5px;'>\n"+
                            "<div class='sub-list text-center' style='height: 120px'>\n"+
                                "<div class='menu-card' style='border: #999 1px solid; border-radius: 5px;'>\n"+
                                    "<img src='storage/images/brand/"+item.brandImage + "' height='100%' width='100%'' alt='"+ item.brandName +" ' style='padding: 10px;'>\n"+
                                "</div>\n"+
                                "<div>\n"+
                                    "<h5 class='fsz-10 mt-20'>" + item.brandName + "</h5>\n"+
                                "</div>\n"+
                                "<br>\n"+
                            "</div>\n"+
                        "</div>\n"+ 
                    "</a>");
                    

            });            

        }
    });


});


/*-------------------------------------------
  00. all brand sidebar (category)
--------------------------------------------- */

$(document).on('click', '.brand-cat-sidebar', function(e){
    e.preventDefault();

    var cat_id = $(this).data('id');

    $('.brand-cat-sidebar').addClass('collapsed');
    $(this).removeClass('collapsed');
    $('.panel-collapse').removeClass('in');
    $('.cat-panel-'.cat_id).addClass('in');

    $('.brand-cat-sidebar').css('color','');
    $('.minicat-sidebar').css('color','');
    $('.subcat-sidebar').css('color','');

    $(this).css("color", "red");


    $('#main').addClass('hide');

    var categoryId = $(this).find(':selected').data('id');

    $.ajax({
        type: "get",
        url: '/all-brands',
        data: {
            'categoryId': cat_id,
        },
        dataType: "json",
        success: function (data) {

            console.log(data);
            $('#breadcrumbs').html("");
            $('.cat-bread').html('');

            $('.cat-bread').html(data.category.categoryName);
            $('.cat-bread').addClass('red-clr');

            console.log(data);

            $('#grid-view-brand').addClass('hide');
            $('#sort').html("");
            $.each(data.brands, function(index, item) {


                $('#sort').append(

                    "<a href='/product-by-brand/"+item.id +"/"+item.brandName.replace(/\s+/g, '_')+"'>\n"+
                        "<div class='col-lg-2 col-md-3 col-sm-3 menu-block mb-3' style='padding: 5px;'>\n"+
                            "<div class='sub-list text-center' style='height: 120px'>\n"+
                                "<div class='menu-card' style='border: #999 1px solid; border-radius: 5px;'>\n"+
                                    "<img src='storage/images/brand/"+item.brandImage + "' height='100%' width='100%'' alt='"+ item.brandName +" ' style='padding: 10px;'>\n"+
                                "</div>\n"+
                                "<div>\n"+
                                    "<h5 class='fsz-10 mt-20'>" + item.brandName + "</h5>\n"+
                                "</div>\n"+
                                "<br>\n"+
                            "</div>\n"+
                        "</div>\n"+ 
                    "</a>");
  
            });

        }
    });


});



/*-------------------------------------------
  00. single category && all category  sidebar (minicategory)
--------------------------------------------- */

$(document).on('click', '.minicat-sidebar', function(e){
    e.preventDefault();

    var minicat_id = $(this).data('id');
    var cat_id = $(this).data('cat_id');
    var subcat_id = $(this).data('subcat_id');

    // $('.subcat-panel-collapse').removeClass('in');
    $('.cat-panel-'.cat_id).addClass('in');
    $('.subcat-panel-'.subcat_id).addClass('in');
    $('.minicat-sidebar').css('color','');
    $(this).css("color", "red");

    $("#price_range_form").attr("action", $(this).data('url'));
    
    $('#main').addClass('hide');

    // var categoryId = $(this).find(':selected').data('id');

    $.ajax({
        type: "get",
        url: $(this).data('url'),
        // data: {
        //     'categoryId': categoryId,
        // },
        dataType: "json",
        success: function (data) {

            console.log(data);

            $('#breadcrumbs').html("");
            $('#breadcrumbs').append(
                "<i class='fa fa-arrow-circle-right'></i>\n"+
                "<span class='current red-clr'>"+ data.miniCategory.subcategory.subCategoryName + "</span>\n"+                
                "<i class='fa fa-arrow-circle-right'></i>\n"+
                "<span class='current red-clr'>"+ data.miniCategory.miniCategoryName + "</span>\n"
                );
            $('#breadcrumbs').removeClass('hide');

            $('#ajax_cat').html("");


            //for tab start

            $('#ajax_cat').append(

                "<ul class='nav nav-tabs tabParent' role='tablist'>\n"+
                    "<li class='active tabChild'><a href='#all' aria-controls='all' role='tab' data-toggle='tab'>All</a></li>\n"+
                "</ul>\n"
            );


            $('#ajax_cat').append(

                "<div class='tab-content tabPanelParent'>\n"+
                    "<div role='tabpanel' class='tab-pane active tabPanelChild' id='all'>\n"+
                        "<div class='site-tab'>\n"+
                            "<div class='text-center'>\n"+
                                "<div id='table_data'>\n"+
                                    "<div class='tab-content'>\n"+
                                        "<div id='grid-view-minicategory' class='tab-pane fade active in' role='tabpanel'>\n"+
                                            "<div class='row text-center hvr2 clearfix allProduct'>\n"+
                                            "</div>\n"+
                                        "</div>\n"+
                                    "</div>\n"+
                                "</div>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"+
                "</div>\n" 
            );




            $.each(data.miniCategory.tabs, function(index, item) {
                $('.tabParent').append(
                    "<li class='tabChild'><a href='#tab" + item.id + "' aria-controls='tab" + item.id +"' role='tab' data-toggle='tab'>" + item.tabName + "</a></li>\n"
                );

                $('.tabPanelParent').append(
                    "<div role='tabpanel' class='tab-pane tabPanelChild' id='tab" + item.id +"'>\n"+
                        "<div class='site-tab'>\n"+
                            "<div class='text-center'>\n"+
                                "<div id='table_data'>\n"+
                                    "<div class='tab-content'>\n"+
                                        "<div id='grid-view-minicategory' class='tab-pane fade active in' role='tabpanel'>\n"+
                                            "<div class='row text-center hvr2 clearfix productForTab"+ item.id +" '>\n"+
                                            "</div>\n"+
                                        "</div>\n"+
                                    "</div>\n"+
                                "</div>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"
                );
            });

            //for all tab panel
            $.each(data.products, function(index, item) {

                var salePrice = 0;

                var salePriceStatus = true;

                var shortDescription = item.shortDescription.replace(/(<([^>]+)>)/ig,"");

                var productName = item.productName.substr(0, 35);


                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                    } else {
                        salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                    }
                } else {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                    } else {
                        salePrice = item.regularPrice;
                    }
                }



                $('.allProduct').append(
                    "<div class='col-md-4 col-sm-6'>\n"+
                    "<div class='portfolio-wrapper'>\n"+
                        "<div class='portfolio-thumb'>\n"+
                            "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                            "<div class='portfolio-content'>\n"+   
                                "<div class='pop-up-icon'>\n"+
                                    "<a class='center-link quick-view' data-toggle='modal'  data-target='#product-preview' title='Quick View' data-min_order_qty='"+item.min_order_qty+"' data-brand='"+item.brand.brandName +"' data-category='"+item.category.categoryName +"'  data-id='"+item.id+"' data-slug='"+item.slug+"' data-name='"+item.productName+"' data-image='/storage/images/product/"+ item.image.image1 +"' data-desc='"+shortDescription+"' data-sale='"+salePrice+"'  data-regular='"+ item. regularPrice +"' data-url='/product/"+item.id+"/"+ item.slug + "'><i class='fa fa-search'></i></a>\n"+
                                    "<a href='#' class='compare left-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+
                                    "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                "</div>\n"+                                                  
                            "</div>\n"+
                        "</div>\n"+
                        "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                     "</div>\n" +
                     "</div>\n");

                    $('.productForTab'+ item.tab_id).append(
                    "<div class='col-md-4 col-sm-6'>\n"+
                    "<div class='portfolio-wrapper'>\n"+
                        "<div class='portfolio-thumb'>\n"+
                            "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                            "<div class='portfolio-content'>\n"+   
                                "<div class='pop-up-icon'>\n"+
                                    "<a class='center-link quick-view' data-toggle='modal'  data-target='#product-preview' title='Quick View' data-min_order_qty='"+item.min_order_qty+"' data-brand='"+item.brand.brandName +"' data-category='"+item.category.categoryName +"'  data-id='"+item.id+"' data-slug='"+item.slug+"' data-name='"+item.productName+"' data-image='/storage/images/product/"+ item.image.image1 +"' data-desc='"+shortDescription+"' data-sale='"+salePrice+"'  data-regular='"+ item. regularPrice +"' data-url='/product/"+item.id+"/"+ item.slug + "'><i class='fa fa-search'></i></a>\n"+
                                    "<a href='#' class='compare left-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+  
                                    "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                "</div>\n"+                                                  
                            "</div>\n"+
                        "</div>\n"+
                        "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                     "</div>\n" +
                     "</div>\n");




            });

            //for tab end
        }
    });


});


/*-------------------------------------------
  00. single category && all category  sidebar (subcategory)
--------------------------------------------- */

$(document).on('click', '.subcat-sidebar', function(e){
    e.preventDefault();

    var subcat_id = $(this).data('id');
    var cat_id = $(this).data('cat_id');


    // $('.cat-sidebar').addClass('collapsed');
    // $('cat-'.cat_id).removeClass('collapsed');
    $('.subcat-panel-collapse').removeClass('in');
    $('.cat-panel-'.cat_id).addClass('in');
    $('.subcat-panel-'.subcat_id).addClass('in');
    $('.subcat-sidebar').css('color','');
    $('.minicat-sidebar').css('color','');

    $(this).css("color", "red");

    $("#price_range_form").attr("action", $(this).data('url'));

    $('#main').addClass('hide');

    // var categoryId = $(this).find(':selected').data('id');

    $.ajax({
        type: "get",
        url: $(this).data('url'),
        // data: {
        //     'categoryId': categoryId,
        // },
        dataType: "json",
        success: function (data) {

            $('#breadcrumbs').html("");
            $('#breadcrumbs').append(
                "<i class='fa fa-arrow-circle-right'></i>\n"+
                "<span class='current red-clr'>"+ data.singleSubcategory.subCategoryName + "</span>\n"
                );
            $('#breadcrumbs').removeClass('hide');

            $('#ajax_cat').html("");

            $('#ajax_cat').append(

                "<div class='page-description spcbt-30'>\n"+
                    // "<img src='/storage/images/category/"+ singlecategory.image_ad +"' alt=''>\n"+
                       "<img src='/storage/images/category/"+ data.singleSubcategory.category.image_ad +"' alt='banner-category-page' >\n"+
                "</div>\n"+

                "<div class='' tab-pane fade active in' role='tabpanel'>\n"+
                    "<div id='sort' class='row text-center hvr2 clearfix'>\n"+

                    "</div>\n"+
                "</div>\n");

            $.each(data.products, function(index, item) {

                var salePrice = 0;

                var salePriceStatus = true;

                var shortDescription = item.shortDescription.replace(/(<([^>]+)>)/ig,"");

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                    } else {
                        salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                    }
                } else {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                    } else {
                        salePrice = item.regularPrice;
                    }
                }


                // if (salePriceStatus == true) {
                $('#ajax_cat').append(
                    "<div class='col-md-4 col-sm-6'>\n"+
                    "<div class='portfolio-wrapper'>\n"+
                        "<div class='portfolio-thumb'>\n"+
                            "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                            "<div class='portfolio-content'>\n"+   
                                "<div class='pop-up-icon'>\n"+
                                    "<a class='center-link quick-view' data-toggle='modal'  data-target='#product-preview' title='Quick View' data-min_order_qty='"+item.min_order_qty+"' data-brand='"+item.brand.brandName +"' data-category='"+item.category.categoryName +"'  data-id='"+item.id+"' data-slug='"+item.slug+"' data-name='"+item.productName+"' data-image='/storage/images/product/"+ item.image.image1 +"' data-desc='"+shortDescription+"' data-sale='"+salePrice+"'  data-regular='"+ item. regularPrice +"' data-url='/product/"+item.id+"/"+ item.slug + "'><i class='fa fa-search'></i></a>\n"+
                                    "<a href='#' class='compare left-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+
                                    "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                "</div>\n"+                                                  
                            "</div>\n"+
                        "</div>\n"+
                        "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                     "</div>\n" +
                     "</div>\n");
            });
        }
    });


});


/*-------------------------------------------
  00. single category && All category  sidebar (category)
--------------------------------------------- */

$(document).on('click', '.cat-sidebar', function(e){
    e.preventDefault();

    var cat_id = $(this).data('id');

    $('.cat-sidebar').addClass('collapsed');
    $(this).removeClass('collapsed');
    $('.panel-collapse').removeClass('in');
    $('.cat-panel-'.cat_id).addClass('in');

    $('.cat-sidebar').css('color','');
    $('.minicat-sidebar').css('color','');
    $('.subcat-sidebar').css('color','');

    $(this).css("color", "red");

    $("#price_range_form").attr("action", $(this).data('url'));



    $('#main').addClass('hide');

    var categoryId = $(this).find(':selected').data('id');

    $.ajax({
        type: "get",
        url: $(this).data('url'),
        data: {
            'categoryId': categoryId,
        },
        dataType: "json",
        success: function (data) {

            $('#breadcrumbs').html("");
            $('.cat-bread').html('');

            $('.cat-bread').html(data.singleCategory.categoryName);
            $('.cat-bread').addClass('red-clr');

            // console.log(data);
            $('#ajax_cat').html("");

            $('#ajax_cat').append(

                "<div class='page-description spcbt-30'>\n"+
                       "<img src='/storage/images/category/"+ data.singleCategory.image_ad +"' alt='banner-category-page' >\n"+
                "</div>\n"+
 
                "<div class='' tab-pane fade active in' role='tabpanel'>\n"+
                    "<div id='sort' class='row text-center hvr2 clearfix'>\n"+

                    "</div>\n"+
                "</div>\n");

            $.each(data.products, function(index, item) {

                var salePrice = 0;

                var salePriceStatus = true;

                var shortDescription = item.shortDescription.replace(/(<([^>]+)>)/ig,"");

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                    } else {
                        salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                    }
                } else {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                    } else {
                        salePrice = item.regularPrice;
                    }
                }


                // if (salePriceStatus == true) {
                    $('#ajax_cat').append(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+
                                        "<a class='center-link quick-view' data-toggle='modal'  data-target='#product-preview' title='Quick View' data-min_order_qty='"+item.min_order_qty+"' data-brand='"+item.brand.brandName +"' data-category='"+item.category.categoryName +"'  data-id='"+item.id+"' data-slug='"+item.slug+"' data-name='"+item.productName+"' data-image='/storage/images/product/"+ item.image.image1 +"' data-desc='"+shortDescription+"' data-sale='"+salePrice+"'  data-regular='"+ item. regularPrice +"' data-url='/product/"+item.id+"/"+ item.slug + "'><i class='fa fa-search'></i></a>\n"+
                                        "<a href='#' class='compare left-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+  
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
            });

        }
    });


});


/*-------------------------------------------
  00. single category && all category  sidebar (service minicategory)
--------------------------------------------- */

$(document).on('click', '.service-minicat-sidebar', function(e){
    e.preventDefault();

    var minicat_id = $(this).data('id');
    var cat_id = $(this).data('cat_id');
    var subcat_id = $(this).data('subcat_id');

    // $('.subcat-panel-collapse').removeClass('in');
    $('.cat-panel-'.cat_id).addClass('in');
    $('.subcat-panel-'.subcat_id).addClass('in');
    $('.service-minicat-sidebar').css('color','');
    $(this).css("color", "red");

    
    $('#main').addClass('hide');

    // var categoryId = $(this).find(':selected').data('id');

    $.ajax({
        type: "get",
        url: $(this).data('url'),
        // data: {
        //     'categoryId': categoryId,
        // },
        dataType: "json",
        success: function (data) {

            console.log(data);

            $('#breadcrumbs').html("");
            $('#breadcrumbs').append(
                "<i class='fa fa-arrow-circle-right'></i>\n"+
                "<span class='current red-clr'>"+ data.miniCategory.subcategory.subCategoryName + "</span>\n"+                
                "<i class='fa fa-arrow-circle-right'></i>\n"+
                "<span class='current red-clr'>"+ data.miniCategory.miniCategoryName + "</span>\n"
                );
            $('#breadcrumbs').removeClass('hide');

            $('#ajax_cat').html("");


            //for tab start

            $('#ajax_cat').append(

                "<ul class='nav nav-tabs tabParent' role='tablist'>\n"+
                    "<li class='active tabChild'><a href='#all' aria-controls='all' role='tab' data-toggle='tab'>All</a></li>\n"+
                "</ul>\n"
            );


            $('#ajax_cat').append(

                "<div class='tab-content tabPanelParent'>\n"+
                    "<div role='tabpanel' class='tab-pane active tabPanelChild' id='all'>\n"+
                        "<div class='site-tab'>\n"+
                            "<div class='text-center'>\n"+
                                "<div id='table_data'>\n"+
                                    "<div class='tab-content'>\n"+
                                        "<div id='grid-view-minicategory' class='tab-pane fade active in' role='tabpanel'>\n"+
                                            "<div class='row text-center hvr2 clearfix allProduct'>\n"+
                                            "</div>\n"+
                                        "</div>\n"+
                                    "</div>\n"+
                                "</div>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"+
                "</div>\n" 
            );




            $.each(data.miniCategory.tabs, function(index, item) {
                $('.tabParent').append(
                    "<li class='tabChild'><a href='#tab" + item.id + "' aria-controls='tab" + item.id +"' role='tab' data-toggle='tab'>" + item.tabName + "</a></li>\n"
                );

                $('.tabPanelParent').append(
                    "<div role='tabpanel' class='tab-pane tabPanelChild' id='tab" + item.id +"'>\n"+
                        "<div class='site-tab'>\n"+
                            "<div class='text-center'>\n"+
                                "<div id='table_data'>\n"+
                                    "<div class='tab-content'>\n"+
                                        "<div id='grid-view-minicategory' class='tab-pane fade active in' role='tabpanel'>\n"+
                                            "<div class='row text-center hvr2 clearfix productForTab"+ item.id +" '>\n"+
                                            "</div>\n"+
                                        "</div>\n"+
                                    "</div>\n"+
                                "</div>\n"+
                            "</div>\n"+
                        "</div>\n"+
                    "</div>\n"
                );
            });

            //for all tab panel
            $.each(data.services, function(index, item) {

                var salePrice = 0;

                var salePriceStatus = true;

                var shortDescription = item.shortDescription.replace(/(<([^>]+)>)/ig,"");

                var serviceName = item.serviceName.substr(0, 35);


                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {

                    salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                    
                } else {
                   
                    salePrice = item.regularPrice;
                    
                }



                $('.allProduct').append(
                    "<div class='col-md-3 col-sm-6'>\n"+
                    "<div class='portfolio-wrapper'>\n"+
                        "<div class=''>\n"+
                            "<img src='/storage/images/service/"+ item.image +"' alt=''>\n"+
                        "</div>\n"+
                        "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-12' href='/service/"+ item.id + "/" + item.slug + "'>" + serviceName +"</a> </h3>\n"+
                            "<p class='font-3'>\n"+ 
                                "<span class='thm-clr'>Tk "+ salePrice.toFixed(2) +" </span>"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(2) + "</span>\n"+   
                            "</p>\n"+    
                        "</div>\n"+
                     "</div>\n" +
                     "</div>\n");

                    $('.productForTab'+ item.tab_id).append(
                    "<div class='col-md-3 col-sm-6'>\n"+
                    "<div class='portfolio-wrapper'>\n"+
                        "<div class=''>\n"+
                            "<img src='/storage/images/service/"+ item.image +"' alt=''>\n"+
                        "</div>\n"+
                        "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-12' href='/service/"+ item.id + "/" + item.slug + "'>" + serviceName +"</a> </h3>\n"+
                            "<p class='font-3'>\n"+ 
                                "<span class='thm-clr'>Tk "+ salePrice.toFixed(2) +" </span>"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(2) + "</span>\n"+   
                            "</p>\n"+    
                        "</div>\n"+
                     "</div>\n" +
                     "</div>\n");




            });

            //for tab end
        }
    });


});


/*-------------------------------------------
  00. single category && all category  sidebar ( service subcategory)
--------------------------------------------- */

$(document).on('click', '.service-subcat-sidebar', function(e){
    e.preventDefault();

    var subcat_id = $(this).data('id');
    var cat_id = $(this).data('cat_id');


    // $('.cat-sidebar').addClass('collapsed');
    // $('cat-'.cat_id).removeClass('collapsed');
    $('.subcat-panel-collapse').removeClass('in');
    $('.cat-panel-'.cat_id).addClass('in');
    $('.subcat-panel-'.subcat_id).addClass('in');
    $('.service-subcat-sidebar').css('color','');
    $('.service-minicat-sidebar').css('color','');

    $(this).css("color", "red");


    $('#main').addClass('hide');

    // var categoryId = $(this).find(':selected').data('id');

    $.ajax({
        type: "get",
        url: $(this).data('url'),
        // data: {
        //     'categoryId': categoryId,
        // },
        dataType: "json",
        success: function (data) {

            $('#breadcrumbs').html("");
            $('#breadcrumbs').append(
                "<i class='fa fa-arrow-circle-right'></i>\n"+
                "<span class='current red-clr'>"+ data.singleSubcategory.subCategoryName + "</span>\n"
                );
            $('#breadcrumbs').removeClass('hide');

            $('#ajax_cat').html("");

            $('#ajax_cat').append(

                "<div class='page-description spcbt-30'>\n"+
                    // "<img src='/storage/images/category/"+ singlecategory.image_ad +"' alt=''>\n"+
                       "<img src='/storage/images/category/"+ data.singleSubcategory.category.image_ad +"' alt='banner-category-page' >\n"+
                "</div>\n"+

                "<div class='' tab-pane fade active in' role='tabpanel'>\n"+
                    "<div id='sort' class='row text-center hvr2 clearfix'>\n"+

                    "</div>\n"+
                "</div>\n");

            $.each(data.services, function(index, item) {

                var salePrice = 0;

                var salePriceStatus = true;

                var shortDescription = item.shortDescription.replace(/(<([^>]+)>)/ig,"");

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {
                    
                    salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                    
                } else {
                   
                    salePrice = item.regularPrice;
                    
                }


                // if (salePriceStatus == true) {
                $('#ajax_cat').append(
                    "<div class='col-md-3 col-sm-6'>\n"+
                    "<div class='portfolio-wrapper'>\n"+
                        "<div class=''>\n"+
                            "<img src='/storage/images/service/"+ item.image +"' alt=''>\n"+
                        "</div>\n"+
                        "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-12' href='/service/"+ item.id + "/" + item.slug + "'>" + item.serviceName.substr(0, 35) +"</a> </h3>\n"+
                            "<p class='font-3'>\n"+ 
                                "<span class='thm-clr'>Tk "+ salePrice.toFixed(2) +" </span>"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(2) + "</span>\n"+   
                            "</p>\n"+    
                        "</div>\n"+
                     "</div>\n" +
                     "</div>\n");
            });
        }
    });


});


/*-------------------------------------------
  00. single category && All category  sidebar (service category)
--------------------------------------------- */

$(document).on('click', '.service-cat-sidebar', function(e){
    e.preventDefault();

    var cat_id = $(this).data('id');

    $('.service-cat-sidebar').addClass('collapsed');
    $(this).removeClass('collapsed');
    $('.panel-collapse').removeClass('in');
    $('.cat-panel-'.cat_id).addClass('in');

    $('.service-cat-sidebar').css('color','');
    $('.service-minicat-sidebar').css('color','');
    $('.service-subcat-sidebar').css('color','');

    $(this).css("color", "red");

    

    $('#main').addClass('hide');

    var categoryId = $(this).find(':selected').data('id');

    $.ajax({
        type: "get",
        url: $(this).data('url'),
        data: {
            'categoryId': categoryId,
        },
        dataType: "json",
        success: function (data) {

            $('#breadcrumbs').html("");
            $('.cat-bread').html('');

            $('.cat-bread').html(data.singleCategory.categoryName);
            $('.cat-bread').addClass('red-clr');

            // console.log(data);
            $('#ajax_cat').html("");

            $('#ajax_cat').append(

                "<div class='page-description spcbt-30'>\n"+
                       "<img src='/storage/images/category/"+ data.singleCategory.image_ad +"' alt='banner-category-page' >\n"+
                "</div>\n"+
 
                "<div class='' tab-pane fade active in' role='tabpanel'>\n"+
                    "<div id='sort' class='row text-center hvr2 clearfix'>\n"+

                    "</div>\n"+
                "</div>\n");

            $.each(data.services, function(index, item) {

                var salePrice = 0;

                var salePriceStatus = true;

                var shortDescription = item.shortDescription.replace(/(<([^>]+)>)/ig,"");

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {
                    salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                } else {
                    salePrice = item.regularPrice;
                }


                // if (salePriceStatus == true) {
                    $('#ajax_cat').append(
                        "<div class='col-md-3 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class=''>\n"+
                                "<img src='/storage/images/service/"+ item.image +"' alt=''>\n"+
                            "</div>\n"+
                            "<div class='product-content text-center'>\n"+
                                "<h3> <a class='title-3 fsz-12' href='/service/"+ item.id + "/" + item.slug + "'>" + item.serviceName.substr(0, 35) +"</a> </h3>\n"+
                                "<p class='font-3'>\n"+ 
                                    "<span class='thm-clr'>Tk "+ salePrice.toFixed(2) +" </span>"+    
                                    "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(2) + "</span>\n"+   
                                "</p>\n"+    
                            "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
            });

        }
    });


});




/*-------------------------------------------
  00. category link
--------------------------------------------- */

$(document).on('click', '.category-link a', function(e){
    e.preventDefault();

    var goto = $(this).attr('href');
    window.location.href = goto;

    // $('#compareSimiliar').attr('href', $(this).data('comparesimiliar'));
    // $('#compareList').attr('href', $(this).data('comparelist'));
});

/*-------------------------------------------
  00. ondemand
--------------------------------------------- */
// Retrieve subcategories from category dynamically using ajax & jquery
$(document).ready(function() {
    $('#ondemandCategory').change(function() {
        $.ajax({
            type:"GET",
            url:"getSubCat/"+$('#ondemandCategory').val(),
            success : function(results) {
                $("#ondemandSubCategory").html(results);
            }
        });
    });
});

// Retrieve minicategories from subcategory dynamically using ajax & jquery
$(document).ready(function() {
    $('#ondemandSubCategory').change(function() {
        $.ajax({
            type:"GET",
            url:"getMiniCat/"+$('#ondemandSubCategory').val(),
            success : function(results) {
                console.log(results);
                $("#ondemandMiniCategory").html(results);
            }
        });
    });
});


// Retrieve minicategories from subcategory dynamically using ajax & jquery
$(document).ready(function() {

    var catId = $('#ondemandCategory').val();
    var subCatId = $('#ondemandSubCategory').val();
    var miniCatId = $('#ondemandMiniCategory').val();

    $('#ondemandMiniCategory').change(function() {
        $.ajax({
            type:"GET",
            url:"getOndemandProduct",
            data: {
            'catId': $('#ondemandCategory').val(),
            'subCatId': $('#ondemandSubCategory').val(),
            'miniCatId': $('#ondemandMiniCategory').val(),
        },
            success : function(results) {
                $("#product_name").html(results);
            }
        });
    });
});




/*-------------------------------------------
  00. Product compare
--------------------------------------------- */

// Commpare dialogue box
// $(document).on('click', '.compare', function(e){
//     e.preventDefault();

//     $('#compareSimiliar').attr('href', $(this).data('comparesimiliar'));
//     $('#compareList').attr('href', $(this).data('comparelist'));
// });

//bundle offer quantity update

$("#bundle_offer tr").click(function (e) { 
    e.preventDefault();
    var final = $(this).data('qty_start');

    $('#volume_'+final).prop("checked", true);

    $("#qty").val(final);

    console.log(final);
});

//search product in single category  page

jQuery('#category-product-search').on('keyup', function(e) {
    
    var query = $(this).val().toLowerCase();
    var categoryId = $(this).data('category');

    if(query !== ''){
        $('#grid-view-category').addClass('hide');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/category-page-search/"+categoryId,
            method: "GET",
            data: {query:query, _token: _token},
            success: function (data) {

            console.log(data);

                $('#sort').html("");
                $.each(data, function(index, item) {

                    var salePrice = 0;
                    var salePriceStatus = true;


                    var date = new Date();
                    var dd =  date.getDate().toString().padStart(2, "0");
                    var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                    var yyyy = date.getFullYear(); //yields year
                    var currentDate= yyyy + "-" + MM + "-" + dd;

                    if (item.discount) {
                        if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                            salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                        } else {
                            salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                        }
                    } else {
                        if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                            salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                        } else {
                            salePrice = item.regularPrice;
                            salePriceStatus = false;
                        }
                    }


                    if (salePriceStatus == true) {
                        $('#sort').append(
                            "<div class='col-md-4 col-sm-6'>\n"+
                            "<div class='portfolio-wrapper'>\n"+
                                "<div class='portfolio-thumb'>\n"+
                                    "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                    "<div class='portfolio-content'>\n"+   
                                        "<div class='pop-up-icon'>\n"+
                                            "<a href='#' class='compare left-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+                 
                                            "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                            "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                        "</div>\n"+                                                  
                                    "</div>\n"+
                                "</div>\n"+
                                "<div class='product-content text-center'>\n"+
                                    "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                                    "<p class='font-2 fsz-10'>\n"+ 
                                        "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                        "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                        "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                            "<i class='fa fa-shopping-cart'></i>\n"+
                                        "</a>\n"+
                                        "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                            "<i class='fa fa-heart'></i>\n"+
                                        "</a>\n"+ 
                                    "</p>\n"+    
                                "</div>\n"+
                            "</div>\n" +
                            "</div>\n");
                        
                    } else {
                        $('#sort').prepend(
                            "<div class='col-md-4 col-sm-6'>\n"+
                            "<div class='portfolio-wrapper'>\n"+
                                "<div class='portfolio-thumb'>\n"+
                                    "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                    "<div class='portfolio-content'>\n"+   
                                        "<div class='pop-up-icon'>\n"+  
                                            "<a href='#' class='compare center-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+               
                                            "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                            "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                        "</div>\n"+                                                  
                                    "</div>\n"+
                                "</div>\n"+
                                "<div class='product-content text-center'>\n"+
                                    "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                                    "<p class='font-2 fsz-10'>\n"+ 
                                        "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                        "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                        "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                            "<i class='fa fa-shopping-cart'></i>\n"+
                                        "</a>\n"+
                                        "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                            "<i class='fa fa-heart'></i>\n"+
                                        "</a>\n"+ 
                                    "</p>\n"+    
                                "</div>\n"+
                            "</div>\n" +
                            "</div>\n");
                    }
                });

          }
      });
    }else{
        $('#grid-view-category').removeClass('hide');
        $('#sort').html("");
    }

});



//search product in all category  page

jQuery('#all-category-product-search').on('keyup', function(e) {
    
    var query = $(this).val().toLowerCase();
    if(query !== ''){
        $('#grid-view-all-category').addClass('hide');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/all-category-page-search",
            method: "GET",
            data: {query:query, _token: _token},
            success: function (data) {

            console.log(data);

                $('#sort').html("");
                $.each(data, function(index, item) {
      
                    var salePrice = 0;
                    var salePriceStatus = true;

                    var date = new Date();
                    var dd =  date.getDate().toString().padStart(2, "0");
                    var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                    var yyyy = date.getFullYear(); //yields year
                    var currentDate= yyyy + "-" + MM + "-" + dd;

                    if (item.discount) {
                        if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                            salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                        } else {
                            salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                        }
                    } else {
                        if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                            salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                        } else {
                            salePrice = item.regularPrice;
                            salePriceStatus = false;
                        }
                    }

                    if (salePriceStatus == true) {
                        $('#sort').append(
                            "<div class='col-md-4 col-sm-6'>\n"+
                            "<div class='portfolio-wrapper'>\n"+
                                "<div class='portfolio-thumb'>\n"+
                                    "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                    "<div class='portfolio-content'>\n"+   
                                        "<div class='pop-up-icon'>\n"+  
                                            "<a href='#' class='compare center-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+               
                                            "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                            "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                        "</div>\n"+                                                  
                                    "</div>\n"+
                                "</div>\n"+
                                "<div class='product-content text-center'>\n"+
                                    "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                                    "<p class='font-2 fsz-10'>\n"+ 
                                        "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                        "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                        "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                            "<i class='fa fa-shopping-cart'></i>\n"+
                                        "</a>\n"+
                                        "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                            "<i class='fa fa-heart'></i>\n"+
                                        "</a>\n"+ 
                                    "</p>\n"+    
                                "</div>\n"+
                            "</div>\n" +
                            "</div>\n");
                        
                    } else {
                        $('#sort').prepend(
                            "<div class='col-md-4 col-sm-6'>\n"+
                            "<div class='portfolio-wrapper'>\n"+
                                "<div class='portfolio-thumb'>\n"+
                                    "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                    "<div class='portfolio-content'>\n"+   
                                        "<div class='pop-up-icon'>\n"+ 
                                            "<a href='#' class='compare center-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+                
                                            "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                            "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                        "</div>\n"+                                                  
                                    "</div>\n"+
                                "</div>\n"+
                                "<div class='product-content text-center'>\n"+
                                    "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                                    "<p class='font-2 fsz-10'>\n"+ 
                                        "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                        "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                        "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                            "<i class='fa fa-shopping-cart'></i>\n"+
                                        "</a>\n"+
                                        "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                            "<i class='fa fa-heart'></i>\n"+
                                        "</a>\n"+ 
                                    "</p>\n"+    
                                "</div>\n"+
                            "</div>\n" +
                            "</div>\n");
                    }
                });

          }
      });
    }else{
        $('#grid-view-all-category').removeClass('hide');
        $('#sort').html("");
    }
  });



//search brand in brand common page

jQuery('#brand-search').on('keyup', function(e) {
    
    var query = $(this).val().toLowerCase();
    if(query === ''){
        $('#grid-view-brand').removeClass('hide');
        $('#sort').html("");
        
    }else{

        $('#grid-view-brand').addClass('hide');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/brand-search",
            method: "GET",
            data: {query:query, _token: _token},
            success: function (data) {

            console.log(data);

                $('#sort').html("");
                $.each(data, function(index, item) {


                    $('#sort').append(
                        "<a href='/product-by-brand/"+item.id +"/"+item.brandName.replace(/\s+/g, '_')+"'>\n"+
                        "<div class='col-lg-3 col-md-3 col-sm-2 menu-block'>\n"+
                            "<div class='sub-list'>\n"+
                                "<div class='card'>\n"+
                                    "<img src='storage/images/brand/"+item.brandImage + "' alt='Avatar' height='100px' width='100px' style='width:100%;'>\n"+
                                    "<div class='card-container'>\n"+
                                    "<h5><b>"+item.brandName+"</b></h5>\n"+ 
                                    "</div>\n"+
                                "</div>\n"+
                                "<br>\n"+                                                         
                            "</div>\n"+
                        "</div>\n"+
                    "</a>");
                        
                });

          }
      });
    }
  });



//search product in brand single page

jQuery('#brand-page-search').on('keyup', function(e) {
    
    var query = $(this).val().toLowerCase();
    var brandId = $(this).data('brand');
    if(query !== null){
        $('#grid-view-brandProduct').addClass('hide');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "/brand-page-search/"+ brandId,
            method: "GET",
            data: {query:query, _token: _token},
            success: function (data) {

            console.log(data);

                $('#sort').html("");
                $.each(data, function(index, item) {

                    // console.log(item);
                    // console.log(item[0].productName);
                    // console.log(item[0].image.image1);       
                    var salePrice = 0;
                    var salePriceStatus = true;

                    if (item.discount) {
                        if (item.deal_id) {
                            salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                        } else {
                            salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                        }
                    } else {
                        if (item.deal_id) {
                            salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                        } else {
                            salePrice = item.regularPrice;
                            salePriceStatus = false;
                        }
                    }

                    if (salePriceStatus == true) {
                        $('#sort').append(
                            "<div class='col-md-4 col-sm-6'>\n"+
                            "<div class='portfolio-wrapper'>\n"+
                                "<div class='portfolio-thumb'>\n"+
                                    "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                    "<div class='portfolio-content'>\n"+   
                                        "<div class='pop-up-icon'>\n"+ 
                                            "<a href='#' class='compare center-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+                  
                                            "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                            "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                        "</div>\n"+                                                  
                                    "</div>\n"+
                                "</div>\n"+
                                "<div class='product-content text-center'>\n"+
                                    "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                                    "<p class='font-2 fsz-10'>\n"+ 
                                        "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                        "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                        "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                            "<i class='fa fa-shopping-cart'></i>\n"+
                                        "</a>\n"+
                                        "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                            "<i class='fa fa-heart'></i>\n"+
                                        "</a>\n"+ 
                                    "</p>\n"+    
                                "</div>\n"+
                            "</div>\n" +
                            "</div>\n");
                        
                    } else {
                        $('#sort').prepend(
                            "<div class='col-md-4 col-sm-6'>\n"+
                            "<div class='portfolio-wrapper'>\n"+
                                "<div class='portfolio-thumb'>\n"+
                                    "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                    "<div class='portfolio-content'>\n"+   
                                        "<div class='pop-up-icon'>\n"+ 
                                            "<a href='#' class='compare center-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+                
                                            "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                            "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                        "</div>\n"+                                                  
                                    "</div>\n"+
                                "</div>\n"+
                                "<div class='product-content text-center'>\n"+
                                    "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                                    "<p class='font-2 fsz-10'>\n"+ 
                                        "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                        "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                        "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                            "<i class='fa fa-shopping-cart'></i>\n"+
                                        "</a>\n"+
                                        "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                            "<i class='fa fa-heart'></i>\n"+
                                        "</a>\n"+ 
                                    "</p>\n"+    
                                "</div>\n"+
                            "</div>\n" +
                            "</div>\n");
                    }
                });

          }
      });
    }
  });

//search product

jQuery('#search').on('keyup', function(e) {
    
    var query = $(this).val().toLowerCase();
    if(query === null){
      $('#searchList').addClass('out');
    }
    else{
      var _token = $('input[name="_token"]').val();
      $.ajax({
          url: "/search",
          method: "GET",
          data: {query:query, _token: _token},
          success: function (data) {
              $('#searchList').removeClass('out');
              $('#searchList').addClass('in');
              $('#searchList').html(data);
            

          }
      });
    }
  });

  $(document).on('click', '#search-li', function(){
    $('#search').val($(this).text());
    $('#searchList').fadeOut();
  });



// --------------------------- Coundown Timer in 'deal' section ------------------------ //
(function () {
    if (jQuery("#countdown-deal").length) {
        // console.log($(this).data('countdown'));
        var $time = "2020/11/18";
        
        $("#countdown-deal").countdown( $time, function (event) {
            var $this = $(this).html(event.strftime(''
                    + '<span>%D</span> Day '
                    + '<span>%H</span> hour '
                    + '<span>%M</span> min '
                    + '<span>%S</span> sec'));
        });
    }
}());

/*---------------------
	countdown with Day Hour Minute Second
--------------------- */
$('[data-countdown]').each(function() {
    var $this = $(this), finalDate = $(this).data('countdown');
    $this.countdown(finalDate, function(event) {
        $this.html(
            // event.strftime('<span class="cdown days"><span class="time-count">%-D</span> <p>Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Min</p></span><span class="cdown minutes"><span class="time-count">%S</span> <p>Sec</p></span>')
            event.strftime(''
        + '<div class="bor1 mr-2"><span>%D</span>d </div>'
        + '<div class="bor1 mr-2"><span>%H</span>h </div>'
        + '<div class="bor1 mr-2"><span>%M</span>m </div>'
        + '<div class="bor1 mr-2"><span>%S</span>s </div>')
            );
    });
});	
/*---------------------
	countdown with Day Hour Minute Second
--------------------- */
$('[data-countdown1]').each(function() {
    var $this = $(this), finalDate = $(this).data('countdown1');
    $this.countdown(finalDate, function(event) {
        $this.html(
            // event.strftime('<span class="cdown days"><span class="time-count">%-D</span> <p>Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Min</p></span><span class="cdown minutes"><span class="time-count">%S</span> <p>Sec</p></span>')
            event.strftime(''
        + '<div class="bor1 mr-2"><span>%H</span>h </div>'
        + '<div class="bor1 mr-2"><span>%M</span>m </div>'
        + '<div class="bor1 mr-2"><span>%S</span>s </div>')
            );
    });
});	


/*-------------------------------------------
  ##. Sort by 
--------------------------------------------- */
//sort by type for singlecategory
$('#sort-by-type-category').change(function () { 
    $('#grid-view-category').addClass('hide');

    var categoryId = $(this).find(':selected').data('id');

    $.ajax({
        type: "get",
        url: "/category-sort-by/"+$('#sort-by-type-category').val(),
        data: {
            'categoryId': categoryId,
        },
        dataType: "json",
        success: function (data) {
            $('#sort').html("");
            $.each(data, function(index, item) {
                var salePrice = 0;
                var salePriceStatus = true;

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                    } else {
                        salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                    }
                } else {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                    } else {
                        salePrice = item.regularPrice;
                        salePriceStatus = false;
                    }
                }

                if (salePriceStatus == true) {
                    $('#sort').append(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+ 
                                        "<a href='#' class='compare center-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+                  
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content text-center'>\n"+
                                "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                                "<p class='font-2 fsz-10'>\n"+ 
                                    "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                    "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                    "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                        "<i class='fa fa-shopping-cart'></i>\n"+
                                    "</a>\n"+
                                    "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                        "<i class='fa fa-heart'></i>\n"+
                                    "</a>\n"+ 
                                "</p>\n"+    
                            "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                    
                } else {
                    $('#sort').prepend(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+ 
                                        "<a href='#' class='compare center-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+                
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content text-center'>\n"+
                                "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                                "<p class='font-2 fsz-10'>\n"+ 
                                    "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                    "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                    "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                        "<i class='fa fa-shopping-cart'></i>\n"+
                                    "</a>\n"+
                                    "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                        "<i class='fa fa-heart'></i>\n"+
                                    "</a>\n"+ 
                                "</p>\n"+    
                            "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                }
            });
        }
    });


});

//sort by color for single category
$('#categoryColor a').click(function (e) { 
    e.preventDefault();
    $('#grid-view-category').addClass('hide');
    var id = $(this).data('id');
    var categoryId = $(this).data('category');

    $.ajax({
        type: "get",
        url: "/sort-by-color/"+id+"/"+categoryId,
        dataType: "json",
        success: function (data) {

            $('#sort').html("");
            $.each(data, function(index, item) {
                
                var salePrice = 0;
                var salePriceStatus = true;

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item[0].discount) {
                    if ( item[0].deal_id && item[0].deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item[0].regularPrice-((item[0].regularPrice * ( item[0].deal.discount_value+ item[0].discount))/100);
                    } else {
                        salePrice = item[0].regularPrice-((item[0].regularPrice * item[0].discount)/100);
                    }
                } else {
                    if ( item[0].deal_id && item[0].deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item[0].regularPrice-((item[0].regularPrice*item[0].deal.discount_value)/100);
                    } else {
                        salePrice = item[0].regularPrice;
                        salePriceStatus = false;
                    }
                }




                if (salePriceStatus == true) {
                    $('#sort').append(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item[0].image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+                 
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item[0].slug +" title='Add To Wishlist' data-id="+ item[0].id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item[0].slug +" title='Add To Cart' data-id="+ item[0].id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content'>\n"+
                                "<h3> <a class='title-3 fsz-12' href='/product/"+ item[0].id + "/" + item[0].slug + "'>" + item[0].productName.substr(0, 35) +"</a> </h3>\n"+
                                "<p class='font-3'>\n"+ 
                                    "<span class='thm-clr'>Tk "+ salePrice.toFixed(2) +" </span>"+    
                                    "<span class='thm-clr line-through'>Tk " + item[0].regularPrice.toFixed(2) + "</span>\n"+   
                                "</p>\n"+    
                            "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                    
                } else {
                    $('#sort').prepend(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item[0].image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+                 
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item[0].slug +" title='Add To Wishlist' data-id="+ item[0].id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item[0].slug +" title='Add To Cart' data-id="+ item[0].id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content'>\n"+
                                "<h3> <a class='title-3 fsz-12' href='/product/"+ item[0].id + "/" + item[0].slug + "'>" + item[0].productName.substr(0, 35) +"</a> </h3>\n"+
                                "<p class='font-3'>\n"+ 
                                    "<span class='thm-clr'>Tk "+ item[0].regularPrice.toFixed(2) +" </span>"+    
                                "</p>\n"+    
                            "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                }
            });
        }
    });


});

//sort by size for single category
$('#categorySize a').click(function (e) { 
    e.preventDefault();
    $('#grid-view-category').addClass('hide');
    var id = $(this).data('id');
    var categoryId = $(this).data('category');

    $.ajax({
        type: "get",
        url: "/sort-by-size/"+id+"/"+categoryId,
        dataType: "json",
        success: function (data) {
            $('#sort').html("");
            $.each(data, function(index, item) {
                var salePrice = 0;
                var salePriceStatus = true;

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item[0].discount) {
                    if ( item[0].deal_id && item[0].deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item[0].regularPrice-((item[0].regularPrice * ( item[0].deal.discount_value+ item[0].discount))/100);
                    } else {
                        salePrice = item[0].regularPrice-((item[0].regularPrice * item[0].discount)/100);
                    }
                } else {
                    if ( item[0].deal_id && item[0].deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item[0].regularPrice-((item[0].regularPrice*item[0].deal.discount_value)/100);
                    } else {
                        salePrice = item[0].regularPrice;
                        salePriceStatus = false;
                    }
                }




                if (salePriceStatus == true) {
                    $('#sort').append(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item[0].image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+                 
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item[0].slug +" title='Add To Wishlist' data-id="+ item[0].id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item[0].slug +" title='Add To Cart' data-id="+ item[0].id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                    
                } else {
                    $('#sort').prepend(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item[0].image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+                 
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item[0].slug +" title='Add To Wishlist' data-id="+ item[0].id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item[0].slug +" title='Add To Cart' data-id="+ item[0].id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                }
            });
        }
    });


});

//sort by type for minicategory
$('#sort-by-type-minicategory').change(function () { 
    $('#grid-view-minicategory').addClass('hide');

    var mid = $(this).find(':selected').data('mid');

    $.ajax({
        type: "get",
        url: "/minicategory-sort-by/"+$('#sort-by-type-minicategory').val(),
        data: {
            'minicategoryId': mid,
        },
        dataType: "json",
        success: function (data) {
            $('#sort').html("");
            $.each(data, function(index, item) {
                var salePrice = 0;
                var salePriceStatus = true;

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                    } else {
                        salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                    }
                } else {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                    } else {
                        salePrice = item.regularPrice;
                        salePriceStatus = false;
                    }
                }


                if (salePriceStatus == true) {
                    $('#sort').append(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+ 
                                        "<a href='#' class='compare center-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+                  
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                    
                } else {
                    $('#sort').prepend(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+  
                                        "<a href='#' class='compare center-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+               
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                }
            });
        }
    });


});

// sort by size
$('#miniCategorySize a').click(function (e) { 
    e.preventDefault();
    $('#grid-view-minicategory').addClass('hide');
    var id = $(this).data('id');;
    var miniCatId = $(this).data('mini');

    $.ajax({
        type: "get",
        url: "/sort-by-size/"+miniCatId+"/"+id,
        dataType: "json",
        success: function (data) {

            $('#sort').html("");
            $.each(data, function(index, item) {
                var salePrice = 0;
                var salePriceStatus = true;

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item[0].discount) {
                    if ( item[0].deal_id && item[0].deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item[0].regularPrice-((item[0].regularPrice * ( item[0].deal.discount_value+ item[0].discount))/100);
                    } else {
                        salePrice = item[0].regularPrice-((item[0].regularPrice * item[0].discount)/100);
                    }
                } else {
                    if ( item[0].deal_id && item[0].deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item[0].regularPrice-((item[0].regularPrice*item[0].deal.discount_value)/100);
                    } else {
                        salePrice = item[0].regularPrice;
                        salePriceStatus = false;
                    }
                }



                if (salePriceStatus == true) {
                    $('#sort').append(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item[0].image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+                 
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item[0].slug +" title='Add To Wishlist' data-id="+ item[0].id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item[0].slug +" title='Add To Cart' data-id="+ item[0].id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                    
                } else {
                    $('#sort').prepend(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item[0].image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+                 
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item[0].slug +" title='Add To Wishlist' data-id="+ item[0].id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item[0].slug +" title='Add To Cart' data-id="+ item[0].id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                }
            });
        }
    });

});

//sort by color in minicategory
$('#miniCategoryColor a').click(function (e) { 
    e.preventDefault();
    $('#grid-view-minicategory').addClass('hide');
    var id = $(this).data('id');
    var miniCatId = $(this).data('mini');

    $.ajax({
        type: "get",
        url: "/sort-by-color/"+miniCatId+"/"+id,
        dataType: "json",
        success: function (data) {
            // console.log(data);


            $('#sort').html("");
            $.each(data, function(index, item) {
      
                var salePrice = 0;
                var salePriceStatus = true;



                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item[0].discount) {
                    if ( item[0].deal_id && item[0].deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item[0].regularPrice-((item[0].regularPrice * ( item[0].deal.discount_value+ item[0].discount))/100);
                    } else {
                        salePrice = item[0].regularPrice-((item[0].regularPrice * item[0].discount)/100);
                    }
                } else {
                    if ( item[0].deal_id && item[0].deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item[0].regularPrice-((item[0].regularPrice*item[0].deal.discount_value)/100);
                    } else {
                        salePrice = item[0].regularPrice;
                        salePriceStatus = false;
                    }
                }



                if (salePriceStatus == true) {
                    $('#sort').append(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item[0].image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+                 
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item[0].slug +" title='Add To Wishlist' data-id="+ item[0].id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item[0].slug +" title='Add To Cart' data-id="+ item[0].id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content'>\n"+
                                "<h3> <a class='title-3 fsz-12' href='/product/"+ item[0].id + "/" + item[0].slug + "'>" + item[0].productName.substr(0, 35) +"</a> </h3>\n"+
                                "<p class='font-3'>\n"+ 
                                    "<span class='thm-clr'>Tk "+ salePrice.toFixed(2) +" </span>"+    
                                    "<span class='thm-clr line-through'>Tk " + item[0].regularPrice.toFixed(2) + "</span>\n"+   
                                "</p>\n"+    
                            "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                    
                } else {
                    $('#sort').prepend(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item[0].image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+                 
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item[0].slug +" title='Add To Wishlist' data-id="+ item[0].id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item[0].slug +" title='Add To Cart' data-id="+ item[0].id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content'>\n"+
                                "<h3> <a class='title-3 fsz-12' href='/product/"+ item[0].id + "/" + item[0].slug + "'>" + item[0].productName.substr(0, 35) +"</a> </h3>\n"+
                                "<p class='font-3'>\n"+ 
                                    "<span class='thm-clr'>Tk "+ item[0].regularPrice.toFixed(2) +" </span>"+    
                                "</p>\n"+    
                            "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                }
            });
        }
    });


});

//sort by color for brand
$('#allBrandColor a').click(function (e) { 
    e.preventDefault();
    $('#grid-view-brandProduct').addClass('hide');
    var id = $(this).data('id');
    var brandId = $(this).data('brand');

    $.ajax({
        type: "get",
        url: "/sort-by-brand-color/"+id +"/"+ brandId,
        dataType: "json",
        success: function (data) {
            // console.log(data);


            $('#sort').html("");
            $.each(data, function(index, item) {
      
                var salePrice = 0;
                var salePriceStatus = true;

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item[0].discount) {
                    if ( item[0].deal_id && item[0].deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item[0].regularPrice-((item[0].regularPrice * ( item[0].deal.discount_value+ item[0].discount))/100);
                    } else {
                        salePrice = item[0].regularPrice-((item[0].regularPrice * item[0].discount)/100);
                    }
                } else {
                    if ( item[0].deal_id && item[0].deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item[0].regularPrice-((item[0].regularPrice*item[0].deal.discount_value)/100);
                    } else {
                        salePrice = item[0].regularPrice;
                        salePriceStatus = false;
                    }
                }




                if (salePriceStatus == true) {
                    $('#sort').append(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item[0].image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+                 
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item[0].slug +" title='Add To Wishlist' data-id="+ item[0].id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item[0].slug +" title='Add To Cart' data-id="+ item[0].id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content'>\n"+
                                "<h3> <a class='title-3 fsz-12' href='/product/"+ item[0].id + "/" + item[0].slug + "'>" + item[0].productName.substr(0, 35) +"</a> </h3>\n"+
                                "<p class='font-3'>\n"+ 
                                    "<span class='thm-clr'>Tk "+ salePrice.toFixed(2) +" </span>"+    
                                    "<span class='thm-clr line-through'>Tk " + item[0].regularPrice.toFixed(2) + "</span>\n"+   
                                "</p>\n"+    
                            "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                    
                } else {
                    $('#sort').prepend(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item[0].image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+                 
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item[0].slug +" title='Add To Wishlist' data-id="+ item[0].id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item[0].slug +" title='Add To Cart' data-id="+ item[0].id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content'>\n"+
                                "<h3> <a class='title-3 fsz-12' href='/product/"+ item[0].id + "/" + item[0].slug + "'>" + item[0].productName.toFixed(2) +"</a> </h3>\n"+
                                "<p class='font-3'>\n"+ 
                                    "<span class='thm-clr'>Tk "+ item[0].regularPrice.toFixed(2) +" </span>"+    
                                "</p>\n"+    
                            "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                }
            });
        }
    });


});

// sort by size for brand
$('#allBrandSize a').click(function (e) { 
    e.preventDefault();
    $('#grid-view-brandProduct').addClass('hide');
    var id = $(this).data('id');
    var brandId = $(this).data('brand');
    

    $.ajax({
        type: "get",
        url: "/sort-by-brand-size/"+id+"/"+brandId,
        dataType: "json",
        success: function (data) {

            $('#sort').html("");
            $.each(data, function(index, item) {
                var salePrice = 0;
                var salePriceStatus = true;

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item[0].discount) {
                    if ( item[0].deal_id && item[0].deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item[0].regularPrice-((item[0].regularPrice * ( item[0].deal.discount_value+ item[0].discount))/100);
                    } else {
                        salePrice = item[0].regularPrice-((item[0].regularPrice * item[0].discount)/100);
                    }
                } else {
                    if ( item[0].deal_id && item[0].deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item[0].regularPrice-((item[0].regularPrice*item[0].deal.discount_value)/100);
                    } else {
                        salePrice = item[0].regularPrice;
                        salePriceStatus = false;
                    }
                }



                if (salePriceStatus == true) {
                    $('#sort').append(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item[0].image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+                 
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item[0].slug +" title='Add To Wishlist' data-id="+ item[0].id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item[0].slug +" title='Add To Cart' data-id="+ item[0].id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content'>\n"+
                                "<h3> <a class='title-3 fsz-12' href='/product/"+ item[0].id + "/" + item[0].slug + "'>" + item[0].productName.substr(0, 35) +"</a> </h3>\n"+
                                "<p class='font-3'>\n"+ 
                                    "<span class='thm-clr'>Tk "+ salePrice.toFixed(2) +" </span>"+    
                                    "<span class='thm-clr line-through'>Tk " + item[0].regularPrice.toFixed(2) + "</span>\n"+   
                                "</p>\n"+    
                            "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                    
                } else {
                    $('#sort').prepend(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item[0].image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+                 
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item[0].slug +" title='Add To Wishlist' data-id="+ item[0].id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item[0].slug +" title='Add To Cart' data-id="+ item[0].id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content'>\n"+
                                "<h3> <a class='title-3 fsz-12' href='/product/"+ item[0].id + "/" + item[0].slug + "'>" + item[0].productName.substr(0, 35) +"</a> </h3>\n"+
                                "<p class='font-3'>\n"+ 
                                    "<span class='thm-clr'>Tk "+ item[0].regularPrice.toFixed(2) +" </span>"+    
                                "</p>\n"+    
                            "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                }
            });
        }
    });

});

//sort by type for brand
$('#sort-by-type-brand').change(function () { 
    $('#grid-view-brandProduct').addClass('hide');
    var brandId = $(this).data('id');
    $.ajax({
        type: "get",
        url: "/brand-sort-by/"+$('#sort-by-type-brand').val()+"/"+brandId,
        dataType: "json",
        success: function (data) {
            $('#sort').html("");
            $.each(data, function(index, item) {
                console.log(item);
                var salePrice = 0;
                var salePriceStatus = true;

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                    } else {
                        salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                    }
                } else {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                    } else {
                        salePrice = item.regularPrice;
                        salePriceStatus = false;
                    }
                }


                if (salePriceStatus == true) {
                    $('#sort').append(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+ 
                                        "<a href='#' class='compare center-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+                
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                    
                } else {
                    $('#sort').prepend(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+   
                                        "<a href='#' class='compare center-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+              
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content text-center'>\n"+
                            "<h3> <a class='title-3 fsz-13' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 26) +"</a> </h3>\n"+
                            "<p class='font-2 fsz-10'>\n"+ 
                                "<span class='thm-clr fsz-13'>Tk "+ salePrice.toFixed(0) +" </span>&nbsp;&nbsp;"+    
                                "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(0) + "</span>\n"+   
                                "<a href='#' class='compare-add-to-cart right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'>\n"+
                                    "<i class='fa fa-shopping-cart'></i>\n"+
                                "</a>\n"+
                                "<a class='compare-add-to-cart left-link addWishlist' href='#' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'>\n"+
                                    "<i class='fa fa-heart'></i>\n"+
                                "</a>\n"+ 
                            "</p>\n"+    
                        "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                }
            });
        }
    });


});

//sort by type
$('#sort-by-type').change(function () { 
    $('#grid-view-all-category').addClass('hide');
    $.ajax({
        type: "get",
        url: "/sort-by/"+$('#sort-by-type').val(),
        dataType: "json",
        success: function (data) {
            $('#sort').html("");
            $.each(data, function(index, item) {
                console.log(item);
                var salePrice = 0;
                var salePriceStatus = true;

                var date = new Date();
                var dd =  date.getDate().toString().padStart(2, "0");
                var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                var yyyy = date.getFullYear(); //yields year
                var currentDate= yyyy + "-" + MM + "-" + dd;

                if (item.discount) {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice * ( item.deal.discount_value+ item.discount))/100);
                    } else {
                        salePrice = item.regularPrice-((item.regularPrice * item.discount)/100);
                    }
                } else {
                    if ( item.deal_id && item.deal.valid_until.toString() >=  currentDate.toString()) {

                        salePrice = item.regularPrice-((item.regularPrice*item.deal.discount_value)/100);
                    } else {
                        salePrice = item.regularPrice;
                        salePriceStatus = false;
                    }
                }


                if (salePriceStatus == true) {
                    $('#sort').append(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+ 
                                        "<a href='#' class='compare center-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+                  
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content'>\n"+
                                "<h3> <a class='title-3 fsz-12' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 35) +"</a> </h3>\n"+
                                "<p class='font-3'>\n"+ 
                                    "<span class='thm-clr'>Tk "+ salePrice.toFixed(2) +" </span>"+    
                                    "<span class='thm-clr line-through'>Tk " + item.regularPrice.toFixed(2) + "</span>\n"+   
                                "</p>\n"+    
                            "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                    
                } else {
                    $('#sort').prepend(
                        "<div class='col-md-4 col-sm-6'>\n"+
                        "<div class='portfolio-wrapper'>\n"+
                            "<div class='portfolio-thumb'>\n"+
                                "<img src='/storage/images/product/"+ item.image.image1 +"' alt=''>\n"+
                                "<div class='portfolio-content'>\n"+   
                                    "<div class='pop-up-icon'>\n"+       
                                        "<a href='#' class='compare center-link addToCompare' data-placement='top' data-url='addCompare/"+item.id +"' title='Add To Compare'><i class='fa fa-retweet'></i></a> \n"+            
                                        "<a href='#' class='left-link addWishlist' data-placement='top' data-slug="+ item.slug +" title='Add To Wishlist' data-id="+ item.id +" data-url='/add-to-wishlist'><i class='fa fa-heart'></i></a>\n"+   
                                        "<a href='#' class='right-link addCart' data-placement='top' data-slug="+ item.slug +" title='Add To Cart' data-id="+ item.id +" data-url='/add-cart' data-qty='1'><i class='cart-icn'> </i></a>\n"+
                                    "</div>\n"+                                                  
                                "</div>\n"+
                            "</div>\n"+
                            "<div class='product-content'>\n"+
                                "<h3> <a class='title-3 fsz-12' href='/product/"+ item.id + "/" + item.slug + "'>" + item.productName.substr(0, 35) +"</a> </h3>\n"+
                                "<p class='font-3'>\n"+ 
                                    "<span class='thm-clr'>Tk "+ item.regularPrice.toFixed(2) +" </span>"+    
                                "</p>\n"+    
                            "</div>\n"+
                         "</div>\n" +
                         "</div>\n");
                }
            });
        }
    });


});

$(document).on('cliek','all a', function(){
    alert('hello');
})

/*-------------------------------------------
  ##. Checkout
--------------------------------------------- */

$('#bank_payment').click(function () { 
    $('#bank_payment_details').removeClass('hide');
    $('#bkash_details').addClass('hide');
    $('#rocket_details').addClass('hide');
    $('#cod_details').addClass('hide');

    
});
$('#cod').click(function () { 
    $('#cod_details').removeClass('hide');
    $('#bank_payment_details').addClass('hide');
    $('#bkash_details').addClass('hide');
    $('#rocket_details').addClass('hide');
    
});
$('#bkash').click(function () { 
    $('#bank_payment_details').addClass('hide');
    $('#bkash_details').removeClass('hide');
    $('#rocket_details').addClass('hide');
    $('#cod_details').addClass('hide');

    
});
$('#rocket').click(function () { 
    $('#bank_payment_details').addClass('hide');
    $('#bkash_details').addClass('hide');
    $('#rocket_details').removeClass('hide');
    $('#cod_details').addClass('hide');

    
});



/*-------------------------------------------
  ##. Product quickview
--------------------------------------------- */


// Show function
$(document).on('click', '.quick-view', function() {

    var salePrice = $(this).data('sale');
    var regularPrice = $(this).data('regular');

    $('#name').text($(this).data('name'));
    $('.brand').text($(this).data('brand'));
    $('.category').text($(this).data('category'));
    $('.details').attr("href", $(this).data('url'));
    $('.min_order_qty').text($(this).data('min_order_qty'));




    $('.quick-desc').text($(this).data('desc'));
    $('#id').val($(this).data('id'));

    if( salePrice != null){
        $('#regular').removeClass('hide');

        $('#sale').text('Tk '+ salePrice );
        $('#regular').text('Tk ' + regularPrice );
 
        console.log(salePrice);  
  
    }else{
        $('#regular').addClass('hide');
        $('#sale').text('Tk ' + regularPrice );

        console.log(regularPrice);   
 
    }

    // if( regularPrice != ""){
    //     $('#regular').text('Tk ' + regularPrice );
    //     console.log(regularPrice);

    // }else{
    //     $('#regular').addClass('hide');
    //     console.log('no regular price')

    // }

    $('#img').attr('src', $(this).data('image'));
    $('.see-all').attr('href', $(this).data('url'));
    
});


/*-------------------------------------------
  ##. Wishlist
--------------------------------------------- */

// -- ajax Form Wishlist register --

$(document).on('click', '.addWishlist', function(e) {
    // this will get the full URL at the address bar

    var url = window.location.href;
    e.preventDefault();
    $.ajax({
        type: 'Get',
        url: $(this).data('url'),
        data: {
            'product_id': $(this).data('id')
        },
        success: function(data){
            if ((data.error)) {
                toastr.error(data.error);

            } else {
                toastr.success(data.success);
                // $(location).attr("href", url);
            }
        }
    });
});

// form Delete function

$(document).on('click', '.deleteWishlist', function(){

    $.ajax({
        type: 'Get',
        url: $(this).data('url'),
        data: {
            'id': $(this).data('id')
        },
        success: function(data){
            toastr.success(data.success);
            location.reload(true);

        }
    });
});

//
$('#change-billing-address').click(function () { 
    // e.preventDefault();
    $('#billing-address').removeClass('hide');
    $('#saved_billing_address').addClass('hide');
    
});

$('#change-shipping-address').click(function () { 
    // e.preventDefault();
    $('#shipping-address').removeClass('hide');
    $('#saved_shipping_address').addClass('hide');

});

$('#close_shipping').click(function (e) { 
    e.preventDefault();
    $('#shipping-address').addClass('hide');
    $('#saved_shipping_address').removeClass('hide');

});

$('#close_billing').click(function (e) { 
    e.preventDefault();
    $('#billing-address').addClass('hide');
    $('#saved_billing_address').removeClass('hide');

});

//change/set Shipping Address Information

$(document).on('submit', '#shippingAddressForm', function(e) {
    e.preventDefault();

    var name = $('#shipName').val();
    var email = $('#shipEmail').val();
    var town = $('#shipTown').val();
    var country = $('#shipCountry').val();
    var division = $('#shipDivision').val();
    var address = $('#shipAddress').val();
    var zipCode = $('#shipZipCode').val();
    var phone = $('#shipPhone').val();

    // Submit the form using AJAX.
    $.ajax({
        type: 'GET',
        url: '/client-shippingaddress-edit',
        data: {
            'name': name,
            'email': email,
            'address': address,
            'town': town,
            'country' : country,
            'division' : division,
            'zipCode' : zipCode,
            'phone': phone
        },
        success: function(data){
            if (data.error) {
                $.each( data.error, function( key, value ) {
                    toastr.error(key + ": " + value);
                  });

            } else {
                toastr.success(data.success);
                location.reload(true);
            }
        }
    });
});


//change/set Billing Address Information

$(document).on('submit', '#billingAddressForm', function(e) {
    e.preventDefault();

    var name = $('#billname').val();
    var email = $('#billemail').val();
    var town = $('#billtown').val();
    var country = $('#billcountry').val();
    var division = $('#billdivision').val();
    var address = $('#billaddress').val();
    var zipCode = $('#billzipCode').val();
    var phone = $('#billphone').val();

    // Submit the form using AJAX.
    $.ajax({
        type: 'GET',
        url: '/client-billingaddress-edit',
        data: {
            'name': name,
            'email': email,
            'address': address,
            'town': town,
            'country' : country,
            'division' : division,
            'zipCode' : zipCode,
            'phone': phone
        },
        success: function(data){
            if (data.error) {
                $.each( data.error, function( key, value ) {
                    toastr.error(key + ": " + value);
                  });

            } else {
                toastr.success(data.success);
                location.reload(true);
            }
        }
    });
});


//change personal Information

$(document).on('submit', '#editAddress', function(e) {
    e.preventDefault();

    var clientName = $('#clientName').val();
    var email = $('#clientEmail').val();
    var city = $('#clientCity').val();
    var country = $('#clientCountry').val();
    var division = $('#clientDivision').val();
    var address = $('#clientAddress').val();
    var zipCode = $('#clientZipCode').val();
    var phone = $('#clientPhone').val();

    // Submit the form using AJAX.
    $.ajax({
        type: 'GET',
        url: '/client-address-edit',
        data: {
            'clientName': clientName,
            'email': email,
            'address': address,
            'city': city,
            'country' : country,
            'division' : division,
            'zipCode' : zipCode,
            'phone': phone
        },
        success: function(data){
            if (data.error) {
                $.each( data.error, function( key, value ) {
                    toastr.error(key + ": " + value);
                  });

            } else {
                toastr.success(data.success);
                location.reload(true);
            }
        }
    });
});


/*-------------------------------------------
  00. signin / signup option hide and show
--------------------------------------------- */

$(document).on('click', '#signin_option', function(e){
    e.preventDefault();

    $('#signup_form').addClass('hide');
    $('#signin_form').removeClass('hide');
});

$(document).on('click', '#signup_option', function(e){
    e.preventDefault();

    $('#signup_form').removeClass('hide');
    $('#signin_form').addClass('hide');
});




//Login form

$(document).on('submit', '.login', function(e) {
// $(document).on('submit', '.login-popup-form', function(e) {
    e.preventDefault();

    var email = $('#email').val();
    var password = $('#password').val();

    // Submit the form using AJAX.
    $.ajax({
        type: 'GET',
        url: '/client-login',
        data: {
            'email': email,
            'password': password
        },
        success: function(data){
            if (data.error) {
                toastr.error(data.error);
                // $.each( data.error, function( key, value ) {
                //     toastr.error(key + ": " + value);
                // });

            } else {
                location.reload(true);
                toastr.success(data.success);
                // $(location).attr("href", "client-dashboard");

            }
        }
    });
});

//registration form

$(document).on('submit', '#registration', function(e) {
    e.preventDefault();
    var formData = $('#registration').serialize();;
    // Submit the form using AJAX.
    $.ajax({
        type: 'POST',
        url: 'client-information-store',
        data: formData,
        success: function(data){
            if ((data.error)) {
                toastr.error(data.error);

            } else {
                toastr.success(data.success);
                $('#registration-block').addClass('hide');
                $('#active-account').removeClass('hide');

            }
        }
    });
});

//

$(document).on('click', '#buy', function(e){
    e.preventDefault();
    $('#productCart').removeClass('hide');
});

/*-------------------------------------------
  ##. Product Cart start
--------------------------------------------- */


// -- ajax Form add Cart --

$(document).on('click', '.addCart', function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();
    var qty = $(this).data('qty');
    var id = $(this).data('id');


    // Submit the form using AJAX.
    $.ajax({
        type: 'post',
        url: $(this).data('url'),
        data: {
            'qty': $(this).data('qty'),
            'id': $(this).data('id')
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            if ((data.error)) {
                toastr.error(data.error);

            } else {

                if (data.warning) {
                    var i = 1;
                    var sum = 0;
                    var salePrice = 0;

                    var date = new Date();
                    var dd =  date.getDate().toString().padStart(2, "0");
                    var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                    var yyyy = date.getFullYear(); //yields year
                    var currentDate= yyyy + "-" + MM + "-" + dd;

                    if (data.product.discount) {
                        if ( data.product.deal_id && data.product.deal.valid_until.toString() >=  currentDate.toString()) {

                            salePrice = data.product.regularPrice-((data.product.regularPrice * ( data.product.deal.discount_value+ data.product.discount))/100);
                        } else {
                            salePrice = data.product.regularPrice-((data.product.regularPrice * data.product.discount)/100);
                        }
                    } else {
                        if ( data.product.deal_id && data.product.deal.valid_until.toString() >=  currentDate.toString()) {

                            salePrice = data.product.regularPrice-((data.product.regularPrice*data.product.deal.discount_value)/100);
                        } else {
                            salePrice = data.product.regularPrice;
                        }
                    }

                    // if (data.bundleOffers) {
                    //     foreach (data.bundleOffers as  $bundleOffer) {
                    //         if ($CartProductForTotal['qty'] >= $bundleOffer->qty_start) {
                    //             $proPrice = $proPrice - ($proPrice * ($bundleOffer->discount/100));
                    //         }
                    //     }
                    // }

                    $.each($('.product-items'), function() {
                        sum += $(this).data('price') * $(this).data('qty');
                        i++;
                    });

                    if (i>=1) {
                        $("#minicartHeader").css("overflow", "auto");
                    }

                    sum += salePrice * qty;

                    $('.cart-total').html('Item Qty: '+ i + '<br> <br>Total: Tk '+ sum.toFixed(2));

                    if (i == 1){
                        $('#miniCartView').html('');
                        $('#miniCartView').append('<ul id="minicartHeader" class="product_list_widget list-unstyled">\n'+                                      
                                '<li class="product-items id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                                    '<div class="media clearfix">\n'+
                                        '<div class="media-lefta product-thumbnail">\n'+
                                            '<a href="/product/'+data.product.id+'/'+data.product.slug+'">\n'+
                                                '<img  src="/storage/images/product/'+data.product.image.image1+ ' "alt="hoodie_5_front" />\n'+
                                            '</a>\n'+
                                        '</div>\n'+
                                        '<div class="media-body fsz-11">\n'+
                                            '<a class="fsz-11" href="/product/'+data.product.id+'/'+data.product.slug+'">'+data.product.productName.substr(0, 35)+'</a>\n'+
                                            '<span class="price"><span class="amount" style="font-size: 11px;">Tk '+salePrice * qty+'</span></span>'+
                                            'Qty:<span class="quantity fsz-11"> '+qty+' </span>Pcs'+
                                        '</div>\n'+
                                    '</div>\n'+

                                    '<div class="product-remove">\n'+
                                        '<a href="#" class="btn-remove" id="cart-delete" data-id="'+id+'" data-url="delete-cart" data-price="'+salePrice * qty+'"  title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                                    '</div>\n'+
                                '</li>\n'+
                        '</ul>\n'+

                        '<div class="cartActions">\n'+
                            '<span class="pull-left">Subtotal</span>\n'+
                            '<span class="pull-right"><span class="amount" id="subtotal">Tk \n'+sum.toFixed(2)+'</span></span>\n'+
                            '<div class="clearfix"></div>\n'+

                            '<div class="minicart-buttons">\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/cart">Your Cart</a>\n'+
                                '</div>\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/checkout" class="minicart-checkout">Checkout</a>\n'+
                                '</div>\n'+
                                '<div class="clearfix"></div>\n'+
                            '</div>\n'+
                        '</div>\n'+
                    '</div>'
                        );
                    }else {
                        $('.cart-total').html('Item Qty: '+ i + '<br> <br>Total: Tk '+ sum.toFixed(2));
                        $('#subtotal').text('Tk ' + sum.toFixed(2));

                        $('#minicartHeader').prepend(
                            '<li class="product-items" id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                            '<div class="media clearfix">\n'+
                                '<div class="media-lefta product-thumbnail">\n'+
                                    '<a href="/product/'+data.id+'/'+data.slug+'">\n'+
                                        '<img  src="/storage/images/product/'+ data.image.image1+ ' " alt="hoodie_5_front" />\n'+
                                    '</a>\n'+
                                '</div>\n'+
                                '<div class="media-body fsz-11">\n'+
                                    '<a class="fsz-11" href="/product/'+data.id+'/'+data.slug+'">'+data.productName.substr(0, 35)+'</a>\n'+
                                    '<span class="price"><span class="amount" style="font-size: 11px;">Tk '+salePrice * qty+'</span></span>'+
                                    'Qty: <span class="quantity fsz-11">'+qty+'</span> Pcs'+
                                '</div>\n'+
                            '</div>\n'+

                            '<div class="product-remove">\n'+
                                '<a href="#" class="btn-remove" id="cart-delete" data-id="'+id+'" data-url="delete-cart" data-price="'+salePrice * qty+'" title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                            '</div>\n'+
                        '</li>'
                        );
                    }
                    toastr.success('Successfully added to cart ');
                    toastr.warning(data.warning);
                    
                } else {

                    var i = 1;
                    var sum = 0;
                    var salePrice = 0;

                    var date = new Date();
                    var dd =  date.getDate().toString().padStart(2, "0");
                    var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                    var yyyy = date.getFullYear(); //yields year
                    var currentDate= yyyy + "-" + MM + "-" + dd;

                    if (data.discount) {
                        if ( data.deal_id && data.deal.valid_until.toString() >=  currentDate.toString()) {

                            salePrice = data.regularPrice-((data.regularPrice * ( data.deal.discount_value+ data.discount))/100);
                        } else {
                            salePrice = data.regularPrice-((data.regularPrice * data.discount)/100);
                        }
                    } else {
                        if ( data.deal_id && data.deal.valid_until.toString() >=  currentDate.toString()) {

                            salePrice = data.regularPrice-((data.regularPrice*data.deal.discount_value)/100);
                        } else {
                            salePrice = data.regularPrice;
                        }
                    }

                    // if (data.bundleOffers) {
                    //     foreach (data.bundleOffers as  $bundleOffer) {
                    //         if ($CartProductForTotal['qty'] >= $bundleOffer->qty_start) {
                    //             $proPrice = $proPrice - ($proPrice * ($bundleOffer->discount/100));
                    //         }
                    //     }
                    // }

                    $.each($('.product-items'), function() {
                        sum += $(this).data('price') * $(this).data('qty');
                        i++;
                    });

                    if (i>=1) {
                        $("#minicartHeader").css("overflow", "auto");
                    }

                    sum += salePrice * qty;

                    $('.cart-total').html('Item Qty: '+ i + '<br> <br>Total: Tk '+ sum.toFixed(2));

                    if (i == 1){
                        $('#miniCartView').html('');
                        $('#miniCartView').append('<ul id="minicartHeader" class="product_list_widget list-unstyled">\n'+                                      
                                '<li class="product-items id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                                    '<div class="media clearfix">\n'+
                                        '<div class="media-lefta product-thumbnail">\n'+
                                            '<a href="/product/'+data.id+'/'+data.slug+'">\n'+
                                                '<img  src="/storage/images/product/'+data.image.image1+ ' "alt="hoodie_5_front" />\n'+
                                            '</a>\n'+
                                        '</div>\n'+
                                        '<div class="media-body fsz-11">\n'+
                                            '<a class="fsz-11" href="/product/'+data.id+'/'+data.slug+'">'+data.productName.substr(0, 35)+'</a>\n'+
                                            '<span class="price"><span class="amount" style="font-size: 11px;">Tk '+salePrice * qty+'</span></span>'+
                                            'Qty:<span class="quantity fsz-11"> '+qty+' </span>Pcs'+
                                        '</div>\n'+
                                    '</div>\n'+

                                    '<div class="product-remove">\n'+
                                        '<a href="#" class="btn-remove" id="cart-delete" data-id="'+id+'" data-url="delete-cart" data-price="'+salePrice * qty+'"  title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                                    '</div>\n'+
                                '</li>\n'+
                        '</ul>\n'+

                        '<div class="cartActions">\n'+
                            '<span class="pull-left">Subtotal</span>\n'+
                            '<span class="pull-right"><span class="amount" id="subtotal">Tk \n'+sum.toFixed(2)+'</span></span>\n'+
                            '<div class="clearfix"></div>\n'+

                            '<div class="minicart-buttons">\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/cart">Your Cart</a>\n'+
                                '</div>\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/checkout" class="minicart-checkout">Checkout</a>\n'+
                                '</div>\n'+
                                '<div class="clearfix"></div>\n'+
                            '</div>\n'+
                        '</div>\n'+
                    '</div>'
                        );
                    }else {
                        $('.cart-total').html('Item Qty: '+ i + '<br> <br>Total: Tk '+ sum.toFixed(2));
                        $('#subtotal').text('Tk ' + sum.toFixed(2));

                        $('#minicartHeader').prepend(
                            '<li class="product-items" id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                            '<div class="media clearfix">\n'+
                                '<div class="media-lefta product-thumbnail">\n'+
                                    '<a href="/product/'+data.id+'/'+data.slug+'">\n'+
                                        '<img  src="/storage/images/product/'+ data.image.image1+ ' " alt="hoodie_5_front" />\n'+
                                    '</a>\n'+
                                '</div>\n'+
                                '<div class="media-body fsz-11">\n'+
                                    '<a class="fsz-11" href="/product/'+data.id+'/'+data.slug+'">'+data.productName.substr(0, 35)+'</a>\n'+
                                    '<span class="price"><span class="amount" style="font-size: 11px;">Tk '+salePrice * qty+'</span></span>'+
                                    'Qty: <span class="quantity fsz-11">'+qty+'</span> Pcs'+
                                '</div>\n'+
                            '</div>\n'+

                            '<div class="product-remove">\n'+
                                '<a href="#" class="btn-remove" id="cart-delete" data-id="'+id+'" data-url="delete-cart" data-price="'+salePrice * qty+'" title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                            '</div>\n'+
                        '</li>'
                        );
                    }
                    toastr.success('Successfully added to cart ');
                    
                }

                
            }
        }
    });
});

// -- ajax Form add Cart --

$(document).on('submit', '#addProductToCart', function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();

    var color_id = $('#color').val();
    var size_id = $('#size').val();
    var id = $('#productId').val();
    var qty = $('#qty').val();
    var price = $('#productId').data('price');

    if (qty == 0) {
        alert('select Quantity');
    }


    // Submit the form using AJAX.
    $.ajax({
        type: 'post',
        url: '/add-cart',
        data: {
            'color_id': color_id,
            'size_id': size_id,
            'qty': qty,
            'id': id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            if ((data.error)) {
                toastr.error(data.error);

            } else {

                if (data.warning) {

                    toastr.warning(data.warning);
                    toastr.success('Successfully added to cart ');

                    var i = 1;
                    var sum = 0;
                    var salePrice = 0;
                    
                    var date = new Date();
                    var dd =  date.getDate().toString().padStart(2, "0");
                    var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                    var yyyy = date.getFullYear(); //yields year
                    var currentDate= yyyy + "-" + MM + "-" + dd;
    
                    if (data.product.discount) {
                        if ( data.product.deal_id && data.product.deal.valid_until.toString() >=  currentDate.toString()) {
    
                            salePrice = data.product.regularPrice-((data.product.regularPrice * ( data.product.deal.discount_value+ data.product.discount))/100);
                        } else {
                            salePrice = data.product.regularPrice-((data.product.regularPrice * data.product.discount)/100);
                        }
                    } else {
                        if ( data.product.deal_id && data.product.deal.valid_until.toString() >=  currentDate.toString()) {
    
                            salePrice = data.product.regularPrice-((data.product.regularPrice*data.product.deal.discount_value)/100);
                        } else {
                            salePrice = data.product.regularPrice;
                        }
                    }
    
                    // if (data.bundleOffers) {
                    //     foreach (data.bundleOffers as  $bundleOffer) {
                    //         if ($CartProductForTotal['qty'] >= $bundleOffer->qty_start) {
                    //             $proPrice = $proPrice - ($proPrice * ($bundleOffer->discount/100));
                    //         }
                    //     }
                    // }
    
                    $.each($('.product-items'), function() {
                        sum += $(this).data('price') * $(this).data('qty');
                        i++;
                    });
    
                    if (i>=1) {
                        $("#minicartHeader").css("overflow", "auto");
                    }
    
                    sum += salePrice * qty;
    
                    $('.cart-total').html('Item Qty: '+ i + ' <br> <br>Total: Tk '+ sum.toFixed(2));
    
                    if (i == 1){
                        $('#miniCartView').html('');
                        $('#miniCartView').append('<ul id="minicartHeader" class="product_list_widget list-unstyled">\n'+                                      
                                '<li class="product-items id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                                    '<div class="media clearfix">\n'+
                                        '<div class="media-lefta product-thumbnail">\n'+
                                            '<a href="/product/'+data.product.id+'/'+data.product.slug+'">\n'+
                                                '<img  src="/storage/images/product/'+data.product.image.image1+ ' "alt="hoodie_5_front" />\n'+
                                            '</a>\n'+
                                        '</div>\n'+
                                        '<div class="media-body fsz-11">\n'+
                                            '<a class="fsz-11" href="/product/'+data.product.id+'/'+data.product.slug+'">'+data.product.productName.substr(0, 35)+'</a>\n'+
                                            '<span class="price"><span class="amount" style="font-size: 11px;">Tk '+salePrice * qty+'</span></span>'+
                                            'Qty:<span class="quantity fsz-11"> '+qty+' </span>Pcs'+
                                        '</div>\n'+
                                    '</div>\n'+
    
                                    '<div class="product-remove">\n'+
                                        '<a href="#" class="btn-remove" id="cart-delete" data-id="'+id+'" data-url="delete-cart" data-price="'+salePrice * qty+'"  title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                                    '</div>\n'+
                                '</li>\n'+
                        '</ul>\n'+
    
                        '<div class="cartActions">\n'+
                            '<span class="pull-left">Subtotal</span>\n'+
                            '<span class="pull-right"><span class="amount" id="subtotal">Tk \n'+sum.toFixed(2)+'</span></span>\n'+
                            '<div class="clearfix"></div>\n'+
    
                            '<div class="minicart-buttons">\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/cart">Your Cart</a>\n'+
                                '</div>\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/checkout" class="minicart-checkout">Checkout</a>\n'+
                                '</div>\n'+
                                '<div class="clearfix"></div>\n'+
                            '</div>\n'+
                        '</div>\n'+
                    '</div>'
                        );
                    }else {
                        $('.cart-total').html('Item Qty: '+ i + '<br> <br>Total: Tk '+ sum.toFixed(2));
                        $('#subtotal').text('Tk ' + sum.toFixed(2));
    
                        $('#minicartHeader').prepend(
                            '<li class="product-items" id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                            '<div class="media clearfix">\n'+
                                '<div class="media-lefta product-thumbnail">\n'+
                                    '<a href="/product/'+data.id+'/'+data.slug+'">\n'+
                                        '<img  src="/storage/images/product/'+ data.image.image1+ ' " alt="hoodie_5_front" />\n'+
                                    '</a>\n'+
                                '</div>\n'+
                                '<div class="media-body fsz-11>\n'+
                                    '<a class="fsz-11" href="/product/'+data.id+'/'+data.slug+'">'+data.productName.substr(0, 35)+'</a>\n'+
                                    '<span class="price"><span class="amount fsz-11" style="font-size: 11px;">Tk '+salePrice * qty+'</span></span>'+
                                    'Qty: <span class="quantity fsz-11">'+qty+'</span> Pcs'+
                                '</div>\n'+
                            '</div>\n'+
    
                            '<div class="product-remove">\n'+
                                '<a href="#" class="btn-remove" id="cart-delete" data-id="'+id+'" data-url="delete-cart" data-price="'+salePrice * qty+'"  title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                            '</div>\n'+
                        '</li>'
                        );
                    }
                    
                } else {
                    toastr.success('Successfully added to cart ');

                    var i = 1;
                    var sum = 0;
                    var salePrice = 0;
                    
                    var date = new Date();
                    var dd =  date.getDate().toString().padStart(2, "0");
                    var MM = (date.getMonth() + 1).toString().padStart(2, "0"); //yields month
                    var yyyy = date.getFullYear(); //yields year
                    var currentDate= yyyy + "-" + MM + "-" + dd;
    
                    if (data.discount) {
                        if ( data.deal_id && data.deal.valid_until.toString() >=  currentDate.toString()) {
    
                            salePrice = data.regularPrice-((data.regularPrice * ( data.deal.discount_value+ data.discount))/100);
                        } else {
                            salePrice = data.regularPrice-((data.regularPrice * data.discount)/100);
                        }
                    } else {
                        if ( data.deal_id && data.deal.valid_until.toString() >=  currentDate.toString()) {
    
                            salePrice = data.regularPrice-((data.regularPrice*data.deal.discount_value)/100);
                        } else {
                            salePrice = data.regularPrice;
                        }
                    }
    
                    // if (data.bundleOffers) {
                    //     foreach (data.bundleOffers as  $bundleOffer) {
                    //         if ($CartProductForTotal['qty'] >= $bundleOffer->qty_start) {
                    //             $proPrice = $proPrice - ($proPrice * ($bundleOffer->discount/100));
                    //         }
                    //     }
                    // }
    
                    $.each($('.product-items'), function() {
                        sum += $(this).data('price') * $(this).data('qty');
                        i++;
                    });
    
                    if (i>=1) {
                        $("#minicartHeader").css("overflow", "auto");
                    }
    
                    sum += salePrice * qty;
    
                    $('.cart-total').html('Item Qty: '+ i + ' <br> <br>Total: Tk '+ sum.toFixed(2));
    
                    if (i == 1){
                        $('#miniCartView').html('');
                        $('#miniCartView').append('<ul id="minicartHeader" class="product_list_widget list-unstyled">\n'+                                      
                                '<li class="product-items id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                                    '<div class="media clearfix">\n'+
                                        '<div class="media-lefta product-thumbnail">\n'+
                                            '<a href="/product/'+data.id+'/'+data.slug+'">\n'+
                                                '<img  src="/storage/images/product/'+data.image.image1+ ' "alt="hoodie_5_front" />\n'+
                                            '</a>\n'+
                                        '</div>\n'+
                                        '<div class="media-body fsz-11">\n'+
                                            '<a class="fsz-11" href="/product/'+data.id+'/'+data.slug+'">'+data.productName.substr(0, 35)+'</a>\n'+
                                            '<span class="price"><span class="amount" style="font-size: 11px;">Tk '+salePrice * qty+'</span></span>'+
                                            'Qty:<span class="quantity fsz-11"> '+qty+' </span>Pcs'+
                                        '</div>\n'+
                                    '</div>\n'+
    
                                    '<div class="product-remove">\n'+
                                        '<a href="#" class="btn-remove" id="cart-delete" data-id="'+id+'" data-url="delete-cart" data-price="'+salePrice * qty+'"  title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                                    '</div>\n'+
                                '</li>\n'+
                        '</ul>\n'+
    
                        '<div class="cartActions">\n'+
                            '<span class="pull-left">Subtotal</span>\n'+
                            '<span class="pull-right"><span class="amount" id="subtotal">Tk \n'+sum.toFixed(2)+'</span></span>\n'+
                            '<div class="clearfix"></div>\n'+
    
                            '<div class="minicart-buttons">\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/cart">Your Cart</a>\n'+
                                '</div>\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/checkout" class="minicart-checkout">Checkout</a>\n'+
                                '</div>\n'+
                                '<div class="clearfix"></div>\n'+
                            '</div>\n'+
                        '</div>\n'+
                    '</div>'
                        );
                    }else {
                        $('.cart-total').html('Item Qty: '+ i + '<br> <br>Total: Tk '+ sum.toFixed(2));
                        $('#subtotal').text('Tk ' + sum.toFixed(2));
    
                        $('#minicartHeader').prepend(
                            '<li class="product-items" id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                            '<div class="media clearfix">\n'+
                                '<div class="media-lefta product-thumbnail">\n'+
                                    '<a href="/product/'+data.id+'/'+data.slug+'">\n'+
                                        '<img  src="/storage/images/product/'+ data.image.image1+ ' " alt="hoodie_5_front" />\n'+
                                    '</a>\n'+
                                '</div>\n'+
                                '<div class="media-body fsz-11>\n'+
                                    '<a class="fsz-11" href="/product/'+data.id+'/'+data.slug+'">'+data.productName.substr(0, 35)+'</a>\n'+
                                    '<span class="price"><span class="amount fsz-11" style="font-size: 11px;">Tk '+salePrice * qty+'</span></span>'+
                                    'Qty: <span class="quantity fsz-11">'+qty+'</span> Pcs'+
                                '</div>\n'+
                            '</div>\n'+
    
                            '<div class="product-remove">\n'+
                                '<a href="#" class="btn-remove" id="cart-delete" data-id="'+id+'" data-url="delete-cart" data-price="'+salePrice * qty+'"  title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                            '</div>\n'+
                        '</li>'
                        );
                    }
                    
                }

            }
        }
    });
});

// -- ajax Form update Cart --



$("#quantity input").change(function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();
    var qty = $('input[name=qty'+$(this).data('id')+']').val();

    $.ajax({
        type: 'post',
        url: 'update-cart',
        data: {
            'qty': qty,
            'id': $(this).data('id')
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            $(location).attr("href", "cart");
        }
    });
});


// form Delete function
$(document).on('click', '#delete-cart', function(e){
    // Stop the browser from submitting the form.
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: $(this).data('url'),
        data: {
            'id': $(this).data('id')
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            $(location).attr("href", "cart");
        }
    });
});

$(document).on('click', '#cart-delete', function(e){
    // Stop the browser from submitting the form.
    e.preventDefault();

    var id = $(this).data('id');

    var count = parseInt($('#count').text()) - 1;
    var sum = 0;
    $.each($('.product-items'), function() {
        sum += $(this).data('price') * $(this).data('qty');
    });
    sum -= $(this).data('price');
    $('#subtotal').text('Tk ' + sum.toFixed(2));

    if (!count ){
        // $('#count').text(count + ': Item(s)');
        $('#count').text(0);
        $('#total').text( sum.toFixed(2));
        $('#miniCartView').html('<p id="empty-cart" class="text-center alert alert-danger">Your cart is empty!</p>');
    }else {
        // $('#count').text(count + ': Item(s)');
        $('#count').text( count);
        $('#total').text( sum.toFixed(2));
    }

    $.ajax({
        type: 'POST',
        url: $(this).data('url'),
        data: {
            'id': $(this).data('id')
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            $('#cartproduct'+id).remove();
        }
    });
});

/*-------------------------------------------
 Product Cart end
--------------------------------------------- */

/*-------------------------------------------
  ##. service Cart start
--------------------------------------------- */


// -- ajax Form add Cart --

$(document).on('click', '.addServiceCart', function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();
    var qty = $(this).data('qty');
    var id = $(this).data('id');


    // Submit the form using AJAX.
    $.ajax({
        type: 'post',
        url: $(this).data('url'),
        data: {
            'qty': $(this).data('qty'),
            'id': $(this).data('id')
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            if ((data.error)) {
                toastr.error(data.error);

            } else {

                if (data.warning) {

                    var i = 1;
                    var sum = 0;
                    var salePrice = 0;
    
    
                    if (data.service.discount) {
                        
                        salePrice = data.service.regularPrice-((data.service.regularPrice * data.service.discount)/100);
                        
                    } else {
                        salePrice = data.service.regularPrice;
                    }
    
                    $.each($('.product-items'), function() {
                        sum += $(this).data('price') * $(this).data('qty');
                        i++;
                    });
    
                    if (i>=1) {
                        $("#minicartHeader").css("overflow", "auto");
                    }
    
                    sum += salePrice * qty;
    
                    $('.cart-total').html('Item Qty: '+ i + '<br> <br>Total: Tk '+ sum.toFixed(2));
    
                    if (i == 1){
                        $('#miniCartView').html('');
                        $('#miniCartView').append('<ul id="minicartHeader" class="product_list_widget list-unstyled">\n'+                                      
                                '<li class="product-items id="cartservice'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                                    '<div class="media clearfix">\n'+
                                        '<div class="media-lefta product-thumbnail">\n'+
                                            '<a href="/service/'+data.service.id+'/'+data.service.slug+'">\n'+
                                                '<img  src="/storage/images/service/'+data.service.image+ ' "alt="hoodie_5_front" />\n'+
                                            '</a>\n'+
                                        '</div>\n'+
                                        '<div class="media-body fsz-11">\n'+
                                            '<a class="fsz-11" href="/service/'+data.service.id+'/'+data.service.slug+'">'+data.service.serviceName.substr(0, 35)+'</a>\n'+
                                            '<span class="price"><span class="amount" style="font-size: 11px;">Tk '+salePrice * qty+'</span></span>'+
                                            'Qty:<span class="quantity fsz-11"> '+qty+' </span>Pcs'+
                                        '</div>\n'+
                                    '</div>\n'+
    
                                    '<div class="product-remove">\n'+
                                        '<a href="#" class="btn-remove" id="service-cart-delete" data-id="'+id+'" data-url="delete-service-cart" data-price="'+salePrice * qty+'"  title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                                    '</div>\n'+
                                '</li>\n'+
                        '</ul>\n'+
    
                        '<div class="cartActions">\n'+
                            '<span class="pull-left">Subtotal</span>\n'+
                            '<span class="pull-right"><span class="amount" id="subtotal">Tk \n'+sum.toFixed(2)+'</span></span>\n'+
                            '<div class="clearfix"></div>\n'+
    
                            '<div class="minicart-buttons">\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/service-cart">Your Cart</a>\n'+
                                '</div>\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/service-checkout" class="minicart-checkout">Checkout</a>\n'+
                                '</div>\n'+
                                '<div class="clearfix"></div>\n'+
                            '</div>\n'+
                        '</div>\n'+
                    '</div>'
                        );
                    }else {
                        $('.cart-total').html('Item Qty: '+ i + '<br> <br>Total: Tk '+ sum.toFixed(2));
                        $('#subtotal').text('Tk ' + sum.toFixed(2));
    
                        $('#minicartHeader').prepend(
                            '<li class="product-items" id="cartservice'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                            '<div class="media clearfix">\n'+
                                '<div class="media-lefta product-thumbnail">\n'+
                                    '<a href="/service/'+data.id+'/'+data.slug+'">\n'+
                                        '<img  src="/storage/images/service/'+ data.image+ ' " alt="hoodie_5_front" />\n'+
                                    '</a>\n'+
                                '</div>\n'+
                                '<div class="media-body fsz-11">\n'+
                                    '<a class="fsz-11" href="/service/'+data.id+'/'+data.slug+'">'+data.serviceName.substr(0, 35)+'</a>\n'+
                                    '<span class="price"><span class="amount" style="font-size: 11px;">Tk '+salePrice * qty+'</span></span>'+
                                    'Qty: <span class="quantity fsz-11">'+qty+'</span> Pcs'+
                                '</div>\n'+
                            '</div>\n'+
    
                            '<div class="product-remove">\n'+
                                '<a href="#" class="btn-remove" id="service-cart-delete" data-id="'+id+'" data-url="delete-service-cart" data-price="'+salePrice * qty+'" title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                            '</div>\n'+
                        '</li>'
                        );
                    }
                    toastr.success('Successfully added to cart ');
                    toastr.success(data.warning);
                    
                } else {

                    var i = 1;
                    var sum = 0;
                    var salePrice = 0;
    
    
                    if (data.discount) {
                        
                        salePrice = data.regularPrice-((data.regularPrice * data.discount)/100);
                        
                    } else {
                        salePrice = data.regularPrice;
                    }
    
                    $.each($('.product-items'), function() {
                        sum += $(this).data('price') * $(this).data('qty');
                        i++;
                    });
    
                    if (i>=1) {
                        $("#minicartHeader").css("overflow", "auto");
                    }
    
                    sum += salePrice * qty;
    
                    $('.cart-total').html('Item Qty: '+ i + '<br> <br>Total: Tk '+ sum.toFixed(2));
    
                    if (i == 1){
                        $('#miniCartView').html('');
                        $('#miniCartView').append('<ul id="minicartHeader" class="product_list_widget list-unstyled">\n'+                                      
                                '<li class="product-items id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                                    '<div class="media clearfix">\n'+
                                        '<div class="media-lefta product-thumbnail">\n'+
                                            '<a href="/product/'+data.id+'/'+data.slug+'">\n'+
                                                '<img  src="/storage/images/product/'+data.image.image1+ ' "alt="hoodie_5_front" />\n'+
                                            '</a>\n'+
                                        '</div>\n'+
                                        '<div class="media-body fsz-11">\n'+
                                            '<a class="fsz-11" href="/product/'+data.id+'/'+data.slug+'">'+data.productName.substr(0, 35)+'</a>\n'+
                                            '<span class="price"><span class="amount" style="font-size: 11px;">Tk '+salePrice * qty+'</span></span>'+
                                            'Qty:<span class="quantity fsz-11"> '+qty+' </span>Pcs'+
                                        '</div>\n'+
                                    '</div>\n'+
    
                                    '<div class="product-remove">\n'+
                                        '<a href="#" class="btn-remove" id="cart-delete" data-id="'+id+'" data-url="delete-cart" data-price="'+salePrice * qty+'"  title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                                    '</div>\n'+
                                '</li>\n'+
                        '</ul>\n'+
    
                        '<div class="cartActions">\n'+
                            '<span class="pull-left">Subtotal</span>\n'+
                            '<span class="pull-right"><span class="amount" id="subtotal">Tk \n'+sum.toFixed(2)+'</span></span>\n'+
                            '<div class="clearfix"></div>\n'+
    
                            '<div class="minicart-buttons">\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/cart">Your Cart</a>\n'+
                                '</div>\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/checkout" class="minicart-checkout">Checkout</a>\n'+
                                '</div>\n'+
                                '<div class="clearfix"></div>\n'+
                            '</div>\n'+
                        '</div>\n'+
                    '</div>'
                        );
                    }else {
                        $('.cart-total').html('Item Qty: '+ i + '<br> <br>Total: Tk '+ sum.toFixed(2));
                        $('#subtotal').text('Tk ' + sum.toFixed(2));
    
                        $('#minicartHeader').prepend(
                            '<li class="product-items" id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                            '<div class="media clearfix">\n'+
                                '<div class="media-lefta product-thumbnail">\n'+
                                    '<a href="/product/'+data.id+'/'+data.slug+'">\n'+
                                        '<img  src="/storage/images/product/'+ data.image.image1+ ' " alt="hoodie_5_front" />\n'+
                                    '</a>\n'+
                                '</div>\n'+
                                '<div class="media-body fsz-11">\n'+
                                    '<a class="fsz-11" href="/product/'+data.id+'/'+data.slug+'">'+data.productName.substr(0, 35)+'</a>\n'+
                                    '<span class="price"><span class="amount" style="font-size: 11px;">Tk '+salePrice * qty+'</span></span>'+
                                    'Qty: <span class="quantity fsz-11">'+qty+'</span> Pcs'+
                                '</div>\n'+
                            '</div>\n'+
    
                            '<div class="product-remove">\n'+
                                '<a href="#" class="btn-remove" id="cart-delete" data-id="'+id+'" data-url="delete-cart" data-price="'+salePrice * qty+'" title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                            '</div>\n'+
                        '</li>'
                        );
                    }
                    toastr.success('Successfully added to cart ');
                    
                }
            }
        }
    });
});

// -- ajax Form add Cart --

$(document).on('submit', '#addServiceToCart', function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();

    var id = $('#serviceId').val();
    var qty = $('#qty').val();
    var hour = $('#hour').val();
    var price = $('#serviceId').data('price');

    if (qty == 0) {
        alert('select Quantity');
    }


    // Submit the form using AJAX.
    $.ajax({
        type: 'post',
        url: '/add-service-cart',
        data: {
            'qty': qty,
            'id': id,
            'hour': hour
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){

            console.log(data);

            if ((data.error)) {
                toastr.error(data.error);

            } else {

                if (data.warning) {
                    toastr.warning(data.warning);
                    toastr.success('Successfully added to cart ');

                    var i = 1;
                    var sum = 0;
                    var salePrice = 0;
                    
                    if (data.service.discount) {
                        salePrice = data.service.regularPrice-((data.service.regularPrice * data.service.discount)/100);
                    } else {
                        salePrice = data.service.regularPrice;
                    }
                
                    $.each($('.product-items'), function() {
                        sum += $(this).data('price') * $(this).data('qty') * $(this).data('hour');
                        i++;
                    });
    
                    if (i>=1) {
                        $("#minicartHeader").css("overflow", "auto");
                    }
    
                    sum += salePrice * qty;
    
                    $('.cart-total').html('Item Qty: '+ i + ' <br> <br>Total: Tk '+ sum.toFixed(2));
                    
                    if ( i == 1){
                        $('#miniCartView').html('');
                        $('#miniCartView').append('<ul id="minicartHeader" class="product_list_widget list-unstyled">\n'+                                      
                                '<li class="product-items id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                                    '<div class="media clearfix">\n'+
                                        '<div class="media-lefta product-thumbnail">\n'+
                                            '<a href="/service/'+data.service.id+'/'+data.service.slug+'">\n'+
                                                '<img  src="/storage/images/service/'+data.service.image+ ' "alt="hoodie_5_front" />\n'+
                                            '</a>\n'+
                                        '</div>\n'+
                                        '<div class="media-body fsz-11">\n'+
                                            '<a class="fsz-11" href="/service/'+data.service.id+'/'+data.service.slug+'">'+data.service.serviceName.substr(0, 35)+'</a>\n'+
                                            '<span class="price"><span class="amount" style="font-size: 11px;">Tk '+salePrice * qty * hour+'</span></span>'+
                                            'Qty:<span class="quantity fsz-11"> '+qty+' </span>Pcs'+
                                        '</div>\n'+
                                    '</div>\n'+
    
                                    '<div class="product-remove">\n'+
                                        '<a href="#" class="btn-remove" id="service-cart-delete" data-id="'+id+'" data-url="delete-service-cart" data-price="'+salePrice * qty * hour +'"  title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                                    '</div>\n'+
                                '</li>\n'+
                        '</ul>\n'+
    
                        '<div class="cartActions">\n'+
                            '<span class="pull-left">Subtotal</span>\n'+
                            '<span class="pull-right"><span class="amount" id="subtotal">Tk \n'+sum.toFixed(2)+'</span></span>\n'+
                            '<div class="clearfix"></div>\n'+
    
                            '<div class="minicart-buttons">\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/service-cart">Your Cart</a>\n'+
                                '</div>\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/service-checkout" class="minicart-checkout">Checkout</a>\n'+
                                '</div>\n'+
                                '<div class="clearfix"></div>\n'+
                            '</div>\n'+
                        '</div>\n'+
                    '</div>'
                        );
                    }else {
                        $('.cart-total').html('Item Qty: '+ i + '<br> <br>Total: Tk '+ sum.toFixed(2));
                        $('#subtotal').text('Tk ' + sum.toFixed(2));
    
                        $('#minicartHeader').prepend(
                            '<li class="product-items" id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                            '<div class="media clearfix">\n'+
                                '<div class="media-lefta product-thumbnail">\n'+
                                    '<a href="/service/'+data.id+'/'+data.slug+'">\n'+
                                        '<img  src="/storage/images/service/'+ data.image+ ' " alt="hoodie_5_front" />\n'+
                                    '</a>\n'+
                                '</div>\n'+
                                '<div class="media-body fsz-11>\n'+
                                    '<a class="fsz-11" href="/service/'+data.id+'/'+data.slug+'">'+data.serviceName.substr(0, 35)+'</a>\n'+
                                    '<span class="price"><span class="amount fsz-11" style="font-size: 11px;">Tk '+salePrice * qty * hour+'</span></span>'+
                                    'Qty: <span class="quantity fsz-11">'+qty+'</span> Pcs'+
                                '</div>\n'+
                            '</div>\n'+
                            '<div class="product-remove">\n'+
                                '<a href="#" class="btn-remove" id="service-cart-delete" data-id="'+id+'" data-url="delete-service-cart" data-price="'+salePrice * qty * hour+'"  title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                            '</div>\n'+
                        '</li>'
                        );
                    }
                    
                } else {

                    toastr.success('Successfully added to cart ');

                    var i = 1;
                    var sum = 0;
                    var salePrice = 0;
                    
                    if (data.discount) {
                        salePrice = data.regularPrice-((data.regularPrice * data.discount)/100);
                    } else {
                        salePrice = data.regularPrice;
                    }
                
                    $.each($('.product-items'), function() {
                        sum += $(this).data('price') * $(this).data('qty') * $(this).data('hour');
                        i++;
                    });
    
                    if (i>=1) {
                        $("#minicartHeader").css("overflow", "auto");
                    }
    
                    sum += salePrice * qty * hour;
    
                    $('.cart-total').html('Item Qty: '+ i + ' <br> <br>Total: Tk '+ sum.toFixed(2));
                    
                    if ( i == 1){
                        $('#miniCartView').html('');
                        $('#miniCartView').append('<ul id="minicartHeader" class="product_list_widget list-unstyled">\n'+                                      
                                '<li class="product-items id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                                    '<div class="media clearfix">\n'+
                                        '<div class="media-lefta product-thumbnail">\n'+
                                            '<a href="/service/'+data.id+'/'+data.slug+'">\n'+
                                                '<img  src="/storage/images/service/'+data.image+ ' "alt="hoodie_5_front" />\n'+
                                            '</a>\n'+
                                        '</div>\n'+
                                        '<div class="media-body fsz-11">\n'+
                                            '<a class="fsz-11" href="/service/'+data.id+'/'+data.slug+'">'+data.serviceName.substr(0, 35)+'</a>\n'+
                                            '<span class="price"><span class="amount" style="font-size: 11px;">Tk '+salePrice * qty * hour+'</span></span>'+
                                            'Qty:<span class="quantity fsz-11"> '+qty+' </span>Pcs'+
                                        '</div>\n'+
                                    '</div>\n'+
    
                                    '<div class="product-remove">\n'+
                                        '<a href="#" class="btn-remove" id="service-cart-delete" data-id="'+id+'" data-url="delete-service-cart" data-price="'+salePrice * qty * hour+'"  title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                                    '</div>\n'+
                                '</li>\n'+
                        '</ul>\n'+
    
                        '<div class="cartActions">\n'+
                            '<span class="pull-left">Subtotal</span>\n'+
                            '<span class="pull-right"><span class="amount" id="subtotal">Tk \n'+sum.toFixed(2)+'</span></span>\n'+
                            '<div class="clearfix"></div>\n'+
    
                            '<div class="minicart-buttons">\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/service-cart">Your Cart</a>\n'+
                                '</div>\n'+
                                '<div class="col-lg-6">\n'+
                                    '<a href="/service-checkout" class="minicart-checkout">Checkout</a>\n'+
                                '</div>\n'+
                                '<div class="clearfix"></div>\n'+
                            '</div>\n'+
                        '</div>\n'+
                    '</div>'
                        );
                    }else {
                        $('.cart-total').html('Item Qty: '+ i + '<br> <br>Total: Tk '+ sum.toFixed(2));
                        $('#subtotal').text('Tk ' + sum.toFixed(2));
    
                        $('#minicartHeader').prepend(
                            '<li class="product-items" id="cartproduct'+id+'" data-price="'+salePrice+'" data-qty="'+qty+'">\n'+
                            '<div class="media clearfix">\n'+
                                '<div class="media-lefta product-thumbnail">\n'+
                                    '<a href="/service/'+data.id+'/'+data.slug+'">\n'+
                                        '<img  src="/storage/images/service/'+ data.image+ ' " alt="hoodie_5_front" />\n'+
                                    '</a>\n'+
                                '</div>\n'+
                                '<div class="media-body fsz-11>\n'+
                                    '<a class="fsz-11" href="/service/'+data.id+'/'+data.slug+'">'+data.productName.substr(0, 35)+'</a>\n'+
                                    '<span class="price"><span class="amount fsz-11" style="font-size: 11px;">Tk '+salePrice * qty * hour+'</span></span>'+
                                    'Qty: <span class="quantity fsz-11">'+qty+'</span> Pcs'+
                                '</div>\n'+
                            '</div>\n'+
                            '<div class="product-remove">\n'+
                                '<a href="#" class="btn-remove" id="service-cart-delete" data-id="'+id+'" data-url="delete-service-cart" data-price="'+salePrice * qty * hour+'"  title="Remove this item"><i class="fa fa-close"></i></a>\n'+				
                            '</div>\n'+
                        '</li>'
                        );
                    }
                    
                }
                
            }
        }
    });
});

// -- ajax Form update Cart --


$("#service_quantity input").change(function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();
    var qty = $('input[name=qty'+$(this).data('id')+']').val();

    $.ajax({
        type: 'post',
        url: 'update-service-cart',
        data: {
            'qty': qty,
            'id': $(this).data('id')
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            $(location).attr("href", "service-cart");
        }
    });
});

$("#service_hour input").change(function(e) {
    // Stop the browser from submitting the form.
    e.preventDefault();
    var hour = $('input[name=hour'+$(this).data('id')+']').val();

    $.ajax({
        type: 'post',
        url: 'update-service-cart',
        data: {
            'hour': hour,
            'id': $(this).data('id')
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            $(location).attr("href", "service-cart");
        }
    });
});


// form Delete function
$(document).on('click', '#delete-service-cart', function(e){
    // Stop the browser from submitting the form.
    e.preventDefault();

    $.ajax({
        type: 'POST',
        url: $(this).data('url'),
        data: {
            'id': $(this).data('id')
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            $(location).attr("href", "cart");
        }
    });
});

$(document).on('click', '#service-cart-delete', function(e){
    // Stop the browser from submitting the form.
    e.preventDefault();

    var id = $(this).data('id');
    var count = parseInt($('#count').text()) - 1;
    var sum = 0;
    $.each($('.product-items'), function() {
        sum += $(this).data('price') * $(this).data('qty');
    });
    sum -= $(this).data('price');
    $('#subtotal').text('Tk ' + sum.toFixed(2));

    if (!count ){
        // $('#count').text(count + ': Item(s)');
        $('#count').text(0);
        $('#total').text( sum.toFixed(2));
        $('#miniCartView').html('<p id="empty-cart" class="text-center alert alert-danger">Your cart is empty!</p>');
    }else {
        // $('#count').text(count + ': Item(s)');
        $('#count').text( count);
        $('#total').text( sum.toFixed(2));
    }

    $.ajax({
        type: 'POST',
        url: $(this).data('url'),
        data: {
            'id': $(this).data('id')
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            $('#cartservice'+id).remove();
        }
    });
});

/*-------------------------------------------
 service Cart end
--------------------------------------------- */



$('#miniCategory a').click(function(){
    console.log($(this).data('miniCategory'));
});

jQuery('.contact-icon-left-arrow').click(function () {
    jQuery('.contact-icon-right').removeClass( "hide" );
    jQuery('.contact-icons').addClass( "fadeIn" );
    // jQuery('.contact-icons').removeClass( "fadeOut" );
    jQuery('.contact-icon-left-arrow').addClass( "hide" );
    jQuery('.contact-icon-left-close').removeClass( "hide" );
    jQuery('.ondemand-form').removeClass( "hide" );

});

jQuery('.contact-icon-left-close').click(function () {
    jQuery('.contact-icon-right').addClass( "hide" );
    // jQuery('.contact-icons').removeClass( "fadeIn" );
    jQuery('.contact-icons').addClass( "fadeOut" );
    jQuery('.contact-icon-left-arrow').removeClass( "hide" );
    jQuery('.contact-icon-left-close').addClass( "hide" );
    jQuery('.ondemand-form').addClass( "hide" );

});

jQuery('#discounts').click(function () {
    jQuery("#discounts a").css("color", "red");
    jQuery("#deals a").css("color", "");
    jQuery("#b1g1 a").css("color", "");
    jQuery("#combo a").css("color", "");
    jQuery("#emi-offer a").css("color", "");
    jQuery("#close-on-today a").css("color", "");
    jQuery("#clearence a").css("color", "");
    jQuery("#bidding-section a").css("color", "");
    jQuery("#auction-section a").css("color", "");

    jQuery('#discounts-show').removeClass( "hide" );
    jQuery('#deals-show').addClass( "hide" );
    jQuery('#b1g1-show').addClass( "hide" );
    jQuery('#combo-show').addClass( "hide" );
    jQuery('#emi-offer-show').addClass( "hide" );
    jQuery('#close-on-today-show').addClass( "hide" );
    jQuery('#clearence-show').addClass( "hide" );
    jQuery('#bidding-section-show').addClass( "hide" );
    jQuery('#auction-section-show').addClass( "hide" );

    jQuery('.discount-button').removeClass( "hide" );
    jQuery('.deal-button').addClass( "hide" );
    jQuery('.buy_get-button').addClass( "hide" );
    jQuery('.combo-button').addClass( "hide" );
    jQuery('.clearence_sale-button').addClass( "hide" );


});
jQuery('#deals').click(function () {
    jQuery("#deals a").css("color", "red");
    jQuery("#discounts a").css("color", "");
    jQuery("#b1g1 a").css("color", "");
    jQuery("#combo a").css("color", "");
    jQuery("#emi-offer a").css("color", "");
    jQuery("#close-on-today a").css("color", "");
    jQuery("#clearence a").css("color", "");
    jQuery("#bidding-section a").css("color", "");
    jQuery("#auction-section a").css("color", "");

    jQuery('#discounts-show').addClass( "hide" );
    jQuery('#deals-show').removeClass( "hide" );
    jQuery('#b1g1-show').addClass( "hide" );
    jQuery('#combo-show').addClass( "hide" );
    jQuery('#emi-offer-show').addClass( "hide" );
    jQuery('#close-on-today-show').addClass( "hide" );
    jQuery('#clearence-show').addClass( "hide" );
    jQuery('#bidding-section-show').addClass( "hide" );
    jQuery('#auction-section-show').addClass( "hide" );

    jQuery('.discount-button').addClass( "hide" );
    jQuery('.deal-button').removeClass( "hide" );
    jQuery('.buy_get-button').addClass( "hide" );
    jQuery('.combo-button').addClass( "hide" );
    jQuery('.clearence_sale-button').addClass( "hide" );


});
jQuery('#b1g1').click(function () {
    jQuery("#b1g1 a").css("color", "red");
    jQuery("#discounts a").css("color", "");
    jQuery("#deals a").css("color", "");
    jQuery("#combo a").css("color", "");
    jQuery("#emi-offer a").css("color", "");
    jQuery("#close-on-today a").css("color", "");
    jQuery("#clearence a").css("color", "");
    jQuery("#bidding-section a").css("color", "");
    jQuery("#auction-section a").css("color", "");

    jQuery('#b1g1-show').removeClass( "hide" );
    jQuery('#combo-show').addClass( "hide" );
    jQuery('#deals-show').addClass( "hide" );
    jQuery('#discounts-show').addClass( "hide" );
    jQuery('#emi-offer-show').addClass( "hide" );
    jQuery('#close-on-today-show').addClass( "hide" );
    jQuery('#clearence-show').addClass( "hide" );
    jQuery('#bidding-section-show').addClass( "hide" );
    jQuery('#auction-section-show').addClass( "hide" );

    jQuery('.discount-button').addClass( "hide" );
    jQuery('.deal-button').addClass( "hide" );
    jQuery('.buy_get-button').removeClass( "hide" );
    jQuery('.combo-button').addClass( "hide" );
    jQuery('.clearence_sale-button').addClass( "hide" );

});

jQuery('#combo').click(function () {
    jQuery("#combo a").css("color", "red");
    jQuery("#b1g1 a").css("color", "");
    jQuery("#discounts a").css("color", "");
    jQuery("#deals a").css("color", "");
    jQuery("#emi-offer a").css("color", "");
    jQuery("#close-on-today a").css("color", "");
    jQuery("#clearence a").css("color", "");
    jQuery("#bidding-section a").css("color", "");
    jQuery("#auction-section a").css("color", "");

    jQuery('#combo-show').removeClass( "hide" );
    jQuery('#b1g1-show').addClass( "hide" );
    jQuery('#deals-show').addClass( "hide" );
    jQuery('#discounts-show').addClass( "hide" );
    jQuery('#emi-offer-show').addClass( "hide" );
    jQuery('#close-on-today-show').addClass( "hide" );
    jQuery('#clearence-show').addClass( "hide" );
    jQuery('#bidding-section-show').addClass( "hide" );
    jQuery('#auction-section-show').addClass( "hide" );

    jQuery('.discount-button').addClass( "hide" );
    jQuery('.deal-button').addClass( "hide" );
    jQuery('.combo-button').removeClass( "hide" );
    jQuery('.buy_get-button').addClass( "hide" );
    jQuery('.clearence_sale-button').addClass( "hide" );

});



jQuery('#emi-offer').click(function () {
    jQuery("#emi-offer a").css("color", "red");
    jQuery("#discounts a").css("color", "");
    jQuery("#deals a").css("color", "");
    jQuery("#b1g1 a").css("color", "");
    jQuery("#combo a").css("color", "");
    jQuery("#close-on-today a").css("color", "");
    jQuery("#clearence a").css("color", "");
    jQuery("#bidding-section a").css("color", "");
    jQuery("#auction-section a").css("color", "");

    jQuery('#emi-offer-show').removeClass( "hide" );
    jQuery('#deals-show').addClass( "hide" );
    jQuery('#discounts-show').addClass( "hide" );
    jQuery('#b1g1-show').addClass( "hide" );
    jQuery('#combo-show').addClass( "hide" );
    jQuery('#close-on-today-show').addClass( "hide" );
    jQuery('#clearence-show').addClass( "hide" );
    jQuery('#bidding-section-show').addClass( "hide" );
    jQuery('#auction-section-show').addClass( "hide" );

    jQuery('.discount-button').addClass( "hide" );
    jQuery('.deal-button').addClass( "hide" );
    jQuery('.buy_get-button').addClass( "hide" );
    jQuery('.combo-button').addClass( "hide" );
    jQuery('.clearence_sale-button').addClass( "hide" );

});

jQuery('#close-on-today').click(function () {
    jQuery("#close-on-today a").css("color", "red");
    jQuery("#discounts a").css("color", "");
    jQuery("#deals a").css("color", "");
    jQuery("#b1g1 a").css("color", "");
    jQuery("#combo a").css("color", "");
    jQuery("#emi-offer a").css("color", "");
    jQuery("#clearence a").css("color", "");
    jQuery("#bidding-section a").css("color", "");
    jQuery("#auction-section a").css("color", "");

    jQuery('#close-on-today-show').removeClass( "hide" );
    jQuery('#deals-show').addClass( "hide" );
    jQuery('#discounts-show').addClass( "hide" );
    jQuery('#b1g1-show').addClass( "hide" );
    jQuery('#combo-show').addClass( "hide" );
    jQuery('#emi-offer-show').addClass( "hide" );
    jQuery('#clearence-show').addClass( "hide" );
    jQuery('#bidding-section-show').addClass( "hide" );
    jQuery('#auction-section-show').addClass( "hide" );

    jQuery('.discount-button').addClass( "hide" );
    jQuery('.deal-button').addClass( "hide" );
    jQuery('.buy_get-button').addClass( "hide" );
    jQuery('.combo-button').addClass( "hide" );
    jQuery('.clearence_sale-button').addClass( "hide" );


});
jQuery('#clearence').click(function () {
    jQuery("#clearence a").css("color", "red");
    jQuery("#discounts a").css("color", "");
    jQuery("#deals a").css("color", "");
    jQuery("#b1g1 a").css("color", "");
    jQuery("#combo a").css("color", "");
    jQuery("#emi-offer a").css("color", "");
    jQuery("#close-on-today a").css("color", "");
    jQuery("#bidding-section a").css("color", "");
    jQuery("#auction-section a").css("color", "");

    jQuery('#clearence-show').removeClass( "hide" );
    jQuery('#deals-show').addClass( "hide" );
    jQuery('#discounts-show').addClass( "hide" );
    jQuery('#b1g1-show').addClass( "hide" );
    jQuery('#combo-show').addClass( "hide" );
    jQuery('#emi-offer-show').addClass( "hide" );
    jQuery('#close-on-today-show').addClass( "hide" );
    jQuery('#bidding-section-show').addClass( "hide" );
    jQuery('#auction-section-show').addClass( "hide" );


    jQuery('.discount-button').addClass( "hide" );
    jQuery('.deal-button').addClass( "hide" );
    jQuery('.buy_get-button').addClass( "hide" );
    jQuery('.combo-button').addClass( "hide" );
    jQuery('.clearence_sale-button').removeClass( "hide" );


});
jQuery('#bidding-section').click(function () {
    jQuery("#bidding-section a").css("color", "red");
    jQuery("#discounts a").css("color", "");
    jQuery("#deals a").css("color", "");
    jQuery("#b1g1 a").css("color", "");
    jQuery("#combo a").css("color", "");
    jQuery("#emi-offer a").css("color", "");
    jQuery("#close-on-today a").css("color", "");
    jQuery("#clearence a").css("color", "");
    jQuery("#auction-section a").css("color", "");

    jQuery('#bidding-section-show').removeClass( "hide" );
    jQuery('#deals-show').addClass( "hide" );
    jQuery('#discounts-show').addClass( "hide" );
    jQuery('#b1g1-show').addClass( "hide" );
    jQuery('#combo-show').addClass( "hide" );
    jQuery('#emi-offer-show').addClass( "hide" );
    jQuery('#close-on-today-show').addClass( "hide" );
    jQuery('#clearence-show').addClass( "hide" );
    jQuery('#auction-section-show').addClass( "hide" );


    jQuery('.discount-button').addClass( "hide" );
    jQuery('.deal-button').addClass( "hide" );
    jQuery('.buy_get-button').addClass( "hide" );
    jQuery('.combo-button').addClass( "hide" );
    jQuery('.clearence_sale-button').addClass( "hide" );

});

jQuery('#auction-section').click(function () {
    jQuery("#auction-section a").css("color", "red");
    jQuery("#discounts a").css("color", "");
    jQuery("#deals a").css("color", "");
    jQuery("#b1g1 a").css("color", "");
    jQuery("#combo a").css("color", "");
    jQuery("#emi-offer a").css("color", "");
    jQuery("#close-on-today a").css("color", "");
    jQuery("#clearence a").css("color", "");
    jQuery("#bidding-section a").css("color", "");

    jQuery('#auction-section-show').removeClass( "hide" );
    jQuery('#deals-show').addClass( "hide" );
    jQuery('#discounts-show').addClass( "hide" );
    jQuery('#b1g1-show').addClass( "hide" );
    jQuery('#combo-show').addClass( "hide" );
    jQuery('#emi-offer-show').addClass( "hide" );
    jQuery('#close-on-today-show').addClass( "hide" );
    jQuery('#clearence-show').addClass( "hide" );
    jQuery('#bidding-section-show').addClass( "hide" );

    jQuery('.discount-button').addClass( "hide" );
    jQuery('.deal-button').addClass( "hide" );
    jQuery('.buy_get-button').addClass( "hide" );
    jQuery('.combo-button').addClass( "hide" );
    jQuery('.clearence_sale-button').addClass( "hide" );


});
// for input number

$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


//written by dadavaai development team end


'use strict';
var prodslid1 = jQuery('#tabs-1 .products-slider-2');
var prodslid2 = jQuery('#tabs-2 .products-slider-2');

jQuery(window).scroll(function () {

    // --------------------------- Scroll To Top ------------------------ //
    if (jQuery(this).scrollTop() > 100) {
        jQuery('.to-top').css({bottom: '0px'});
    }
    else {
        jQuery('.to-top').css({bottom: '-150px'});
    }

});


jQuery(document).ready(function ($) {

    // --------------------------- Custom Scroll Style ------------------------ // 
    (function () {
        jQuery(window).load(function () {
            if (jQuery(window).width() < 650) {
                if (jQuery(".top-bar .navigation").length) {
                    jQuery(".top-bar .navigation").mCustomScrollbar({
                        theme: "dark-2",
                        scrollButtons: {
                            enable: false
                        }
                    });
                }
                if (jQuery(".shop_table").length) {
                    jQuery(".shop_table").mCustomScrollbar({
                        axis: "x",
                        theme: "dark-2",
                        scrollButtons: {
                            enable: false
                        }
                    });
                }
            }

            if (jQuery(".scroll-div").length) {
                jQuery(".scroll-div").mCustomScrollbar({
                    theme: "dark-2",
                    scrollButtons: {
                        enable: false
                    }
                });
            }
        });
    }());

    // --------------------------- Remove Active Class ------------------------ // 
    (function () {
        jQuery(document).click(function (e) {
            jQuery(".header-wrap .navigation").removeClass('off-canvas');
            jQuery("body").removeClass('off-canvas-body');
        });
    }());

    // --------------------------- Header Off Canvas Add ------------------------ //
    (function () {
        jQuery(".nav-trigger").on("click", function (e) {
            e.stopPropagation();
            jQuery(".header-wrap .navigation").toggleClass("off-canvas");
            jQuery("body").toggleClass("off-canvas-body");
        });
    }());

    // --------------------------- Custom Scroll Style ------------------------ // 
    (function () {
        jQuery(window).load(function () {
            if (jQuery(window).width() < 767) {
                if (jQuery(".header-wrap .navigation").length) {
                    jQuery(".header-wrap .navigation").mCustomScrollbar({
                        theme: "light",
                        scrollButtons: {
                            enable: false
                        }
                    });
                }
            }
        });
    }());

    // --------------------------- Scroll To Top Animate ------------------------ //
    (function () {
        jQuery('.to-top').click(function () {
            jQuery('html, body').animate({scrollTop: 0}, 800);
            return false;
        });
    }());

    // --------------------------- Subscribe Popup ------------------------ //
    (function () {
        if (jQuery(".subscribe-me").length) {
            jQuery(".subscribe-me").subscribeBetter({
                trigger: "onidle", // You can choose which kind of trigger you want for the subscription modal to appear. Available triggers are "atendpage" which will display when the user scrolls to the bottom of the page, "onload" which will display once the page is loaded, and "onidle" which will display after you've scrolled.
                animation: "flyInDown", // You can set the entrance animation here. Available options are "fade", "flyInRight", "flyInLeft", "flyInUp", and "flyInDown". The default value is "fade".
                delay: 0, // You can set the delay between the trigger and the appearance of the modal window. This works on all triggers. The value should be in milliseconds. The default value is 0.
                showOnce: true, // Toggle this to false if you hate your users. :)
                autoClose: false, // Toggle this to true to automatically close the modal window when the user continue to scroll to make it less intrusive. The default value is false.
                scrollableModal: false      //  If the modal window is long and you need the ability for the form to be scrollable, toggle this to true. The default value is false.
            });
        }
    }());


    // --------------------------- Coundown Timer in 'Carbon Fiber' section ------------------------ //
    (function () {
        if (jQuery("#countdown-timer1").length) {
            var $time = "2020/11/18";
            
            $("#countdown-timer1").countdown( $time, function (event) {
                var $this = $(this).html(event.strftime(''
                        + '<span>%D</span> days '
                        + '<span>%H</span> hours '
                        + '<span>%M</span> mins '
                        + '<span>%S</span> secs'));
            });
        }
    }());

    // Main Carousel
    $("#owl-carousel-main").owlCarousel({
        rtl: false,
        loop: true,
        dots: false,
        nav: true,
        autoplay: true,
        autoplayHoverPause:true,
        singleItem: true,
        responsive: {
            0: {items: 1}
        },
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });

    // Carousel for 'Choose Your Bike' section
    $('.products-slider').owlCarousel({
        items: 4,
        rtl: false,
        center: true,
        loop: true,
        dots: false,
        nav: true,
        autoplay: true,
        responsive: {
            0: {items: 1},
            1200: {items: 4},
            990: {items: 4},
            600: {items: 2},
            480: {items: 2}
        },
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });

    // Carousel for 'RELATED PRODUCTS' section
    $('.related-product').owlCarousel({
        items: 4,
        rtl: false,
        center: true,
        loop: true,
        dots: false,
        nav: true,
        autoplay: true,
        responsive: {
            0: {items: 1},
            1500: {items: 6},
            1200: {items: 4},
            990: {items: 4},
            600: {items: 4},
            320: {items: 2}
        },
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });


    // Carousel for 'They Say' section
    $('.they-say').owlCarousel({
        items: 1,
        loop: true,
        navigation: true,
        nav: true,
        autoplay: true,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });

    // Carousel for 'Payment Systems' section
    $('.payment-systems').owlCarousel({
        items: 8,
        loop: true,
        navigation: true,
        nav: true,
        autoplay: true,
        responsive: {
            0: {items: 1},
            1200: {items: 8},
            990: {items: 7},
            700: {items: 5},
            600: {items: 4},
            480: {items: 3},
            320: {items: 2}
        },
        navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"]
    });

    // Carousel for 'Brand Slider' section
    $('.brand-slider').owlCarousel({
        items: 5,
        loop: true,
        navigation: true,
        nav: true,
        autoplay: true,
        responsive: {
            0: {items: 1},
            990: {items: 5},
            768: {items: 4},
            480: {items: 3},
            380: {items: 2}
        },
        navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"]
    });


    /*--- Home 2 ---*/

    // Carousel for 'Best Seller' section
    $('.best-seller').owlCarousel({
        items: 2,
        rtl: false,
        loop: true,
        dots: false,
        nav: true,
        margin: 30,
        autoplay: false,
        responsive: {
            0: {items: 1},
            568: {items: 2}
        },
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });

    // Carousel for 'Top Features' section
    $('.top-features').owlCarousel({
        items: 2,
        rtl: false,
        loop: true,
        dots: false,
        margin: 30,
        nav: true,
        autoplay: false,
        responsive: {
            0: {items: 1},
            568: {items: 2}
        },
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
    });


    // --------------------------- Isotope ------------------------ //    
    jQuery(window).load(function () {
        if (jQuery().isotope) {
            var jQuerycontainer = jQuery('.isotope'); // cache container
            jQuerycontainer.isotope({
                itemSelector: '.isotope-item'
            });
            jQuery('.filtrable a').click(function () {
                var selector = jQuery(this).attr('data-filter');
                jQuery('.filtrable li').removeClass('active');
                jQuery(this).parent().addClass('active');
                jQuerycontainer.isotope({filter: selector});
                return false;
            });
            jQuerycontainer.isotope('layout'); // layout/layout

            var jQuerycontainer2 = jQuery('.collection'); // cache container
            jQuerycontainer2.isotope({
                itemSelector: '.collection'
            });
            jQuery('.coll-filtrable a').click(function () {
                var selector = jQuery(this).attr('data-filter');
                jQuery('.coll-filtrable li').removeClass('active');
                jQuery(this).parent().addClass('active');
                jQuerycontainer2.isotope({filter: selector});
                return false;
            });
            jQuerycontainer2.isotope('layout'); // layout/layout
        }
    });
    jQuery(window).resize(function () {
        if (jQuery().isotope) {
            jQuery('.row.isotope').isotope('layout'); // layout/relayout on window resize
            jQuery('.row.collection').isotope('layout');
        }

    });
    jQuery('#product-filter').isotope({filter: '.tab-1'});
    jQuery('.cat-filter').isotope({filter: '.cat-1'});
    jQuery('.collection').isotope({filter: '*'});


    // --------------------------- Google Map ------------------------ //
    (function () {
        if (typeof google === 'object' && typeof google.maps === 'object') {
            if (jQuery('#map-canvas2').length) {

                var map;
                var marker;
                var infowindow;
                var mapIWcontent = '' +
                        '' +
                        '<div class="map-info-window">' +
                        '<div class="map-location">' +
                        '<div class="loctn-img">' +
                        '<a class="media-link" href="#">' +
                        '<img class="img-responsive" src="assets/img/banner/map-location.jpg" alt=""/>' +
                        '</a>' +
                        '</div>' +
                        '<div class="loctn-info">' +
                        '<h4 class="title-2"> Location </h4>' +
                        '<p> 79 Orchard St,New York <br>NY 10002, USA </p>' +
                        '<p> (0096) 8645 234 438 </p>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '';
                var contentString = '' +
                        '' +
                        '<div class="iw-container">' +
                        '<div class="iw-content">' +
                        '' + mapIWcontent +
                        '</div>' +
                        '<div class="iw-bottom-gradient"></div>' +
                        '</div>' +
                        '' +
                        '';
                var image = 'assets/img/extra/map-icon.png'; // marker icon
                google.maps.event.addDomListener(window, 'load', function () {
                    var mapOptions = {
                        scrollwheel: false,
                        zoom: 10,
                        center: new google.maps.LatLng(41.079379, 28.9984466) // map coordinates
                    };

                    map = new google.maps.Map(document.getElementById('map-canvas2'),
                            mapOptions);
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(41.0096559, 28.9755535), // marker coordinates
                        map: map,
                        icon: image,
                        title: 'Hello World!'
                    });


                });

            }
        }
    }());

});
(function ($) {
    'use strict';
    // Popup for Menu and Search Links in the Header
    $('#open-popup-search').on('click', function () {
        $('.page-search-box').fadeIn(250);
        $('.page-search-box .search-query').focus();
    });
    $('.close-page-search').on('click', function () {
        $('.page-search-box').fadeOut(250);
    });
})(jQuery);


var swiperslider1 = jQuery('.swiper-slider-1 .swiper-container');
var swiperslider2 = jQuery('.swiper-slider-2 .swiper-container');
var swiperslider3 = jQuery('.swiper-slider-3 .swiper-container');
var swiperslider4 = jQuery('.swiper-slider-4 .swiper-container');
var swiperslider5 = jQuery('.swiper-slider-5 .swiper-container');
jQuery(document).ready(function ($) {

    // ---------------------------------------------------------------------------------------
    // Products Slider Start

    jQuery('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        updater();
    });


    if (jQuery().swiper) {
        //Product Slider 1
        if (swiperslider1.length) {
            swiperslider1 = new Swiper(swiperslider1, {
                pagination: '.swiper-pagination',
                slidesPerView: 4,
                paginationClickable: true,
                loop: true,
                nextButton: '.swiper-slider-1 .owl-next',
                prevButton: '.swiper-slider-1 .owl-prev',
                breakpoints: {
                    481: {
                        slidesPerView: 1,
                        spaceBetweenSlides: 10
                    },
                    991: {
                        slidesPerView: 2,
                        spaceBetweenSlides: 20
                    },
                    1199: {
                        slidesPerView: 4,
                        spaceBetweenSlides: 30
                    }
                }
            });
        }

        //Product Slider 2
        if (swiperslider2.length) {
            swiperslider2 = new Swiper(swiperslider2, {
                slidesPerView: 4,
                paginationClickable: true,
                loop: true,
                nextButton: '.swiper-slider-2 .owl-next',
                prevButton: '.swiper-slider-2 .owl-prev',
                breakpoints: {
                    481: {
                        slidesPerView: 1,
                        spaceBetweenSlides: 10
                    },
                    991: {
                        slidesPerView: 2,
                        spaceBetweenSlides: 20
                    },
                    1199: {
                        slidesPerView: 3,
                        spaceBetweenSlides: 30
                    }
                }
            });
        }

        //Product Slider 3
        if (swiperslider3.length) {
            swiperslider3 = new Swiper(swiperslider3, {
                slidesPerView: 4,
                paginationClickable: true,
                spaceBetween: 30,
                loop: true,
                nextButton: '.swiper-slider-3 .owl-next',
                prevButton: '.swiper-slider-3 .owl-prev',
                breakpoints: {
                    481: {
                        slidesPerView: 1,
                        spaceBetweenSlides: 10
                    },
                    991: {
                        slidesPerView: 2,
                        spaceBetweenSlides: 20
                    },
                    1199: {
                        slidesPerView: 3,
                        spaceBetweenSlides: 30
                    }
                }
            });
        }

        if (swiperslider4.length) {
            swiperslider4 = new Swiper(swiperslider4, {
                slidesPerView: 4,
                paginationClickable: true,
                spaceBetween: 30,
                loop: true,
                nextButton: '.swiper-slider-4 .owl-next',
                prevButton: '.swiper-slider-4 .owl-prev',
                breakpoints: {
                    481: {
                        slidesPerView: 1,
                        spaceBetweenSlides: 10
                    },
                    991: {
                        slidesPerView: 2,
                        spaceBetweenSlides: 20
                    },
                    1199: {
                        slidesPerView: 3,
                        spaceBetweenSlides: 30
                    }
                }
            });
        }
        if (swiperslider5.length) {
            swiperslider5 = new Swiper(swiperslider5, {
                slidesPerView: 4,
                paginationClickable: true,
                spaceBetween: 30,
                loop: true,
                nextButton: '.swiper-slider-5 .owl-next',
                prevButton: '.swiper-slider-5 .owl-prev',
                breakpoints: {
                    481: {
                        slidesPerView: 1,
                        spaceBetweenSlides: 10
                    },
                    991: {
                        slidesPerView: 2,
                        spaceBetweenSlides: 20
                    },
                    1199: {
                        slidesPerView: 3,
                        spaceBetweenSlides: 30
                    }
                }
            });
        }
    }
    updater();
    //Products Slider End
    // ---------------------------------------------------------------------------------------

    // --------------------------- Sticky Header ------------------------ //
    (function () {
        if (jQuery(window).width() > 760) {
            jQuery(".header-wrap").sticky({topSpacing: 0});
            

        }
    }());

    if (jQuery("#gallery-2").length) {
        $('#gallery-2').royalSlider({
            fullscreen: {
                enabled: true,
                nativeFS: true
            },
            controlNavigation: 'thumbnails',
            thumbs: {
                orientation: 'vertical',
                paddingBottom: 4,
                appendSpan: true
            },
            transitionType: 'fade',
            autoScaleSlider: true,
            autoScaleSliderWidth: 1000,
            autoScaleSliderHeight: 800,
            loop: true,
            arrowsNav: false,
            keyboardNavEnabled: true

        });

        $('.royalSlider').royalSlider(function () {
            $('.rsFullscreenBtn').addClass('rsHidden');
        });
    }

    if (jQuery("#gallery-1").length) {
        $('#gallery-1').royalSlider({
            fullscreen: {
                enabled: false,
                nativeFS: false
            },
            controlNavigation: 'thumbnails',
            thumbs: {
                orientation: 'vertical',
                paddingBottom: 4,
                appendSpan: true
            },
            transitionType: 'fade',
            autoScaleSlider: true,
            autoScaleSliderWidth: 1000,
            autoScaleSliderHeight: 800,
            loop: true,
            arrowsNav: false,
            keyboardNavEnabled: true

        });

        $('.royalSlider').royalSlider(function () {
            $('.rsFullscreenBtn').addClass('rsHidden');
        });
    }

    // --------------------------- Price Ranger ------------------------ //
    (function () {
        var price_slider = document.getElementById('price_slider');

        if (jQuery("#price_slider").length) {
            noUiSlider.create(price_slider, {
                start: [0, 500000],
                connect: true,
                step: 1,
                range: {
                    'min': 10,
                    'max': 500000
                }
            });


            var valueMax = document.getElementById('max_price');
            var valueMin = document.getElementById('min_price');

            var labelMin = document.getElementById('label_min');
            var labelMax = document.getElementById('label_max');

            valueMax.style.display = 'none';
            valueMin.style.display = 'none';

            // When the slider value changes, update the input and span
            price_slider.noUiSlider.on('update', function (values, handle) {
                if (handle) {
                    valueMax.value = values[handle];
                    labelMax.innerHTML = values[handle];
                } else {
                    valueMin.value = values[handle];
                    labelMin.innerHTML = values[handle];
                }
            });

            // When the input changes, set the slider value
            valueMax.addEventListener('change', function () {
                price_slider.noUiSlider.set([null, this.value]);

            });

        }
    }());


});

function updater() {

    // refresh swiper slider
    if (jQuery().swiper) {
        //
        if (typeof (swiperslider1.length) === 'undefined') {
            swiperslider1.update();
            swiperslider1.onResize();
        }
        //
        if (typeof (swiperslider2.length) === 'undefined') {
            swiperslider2.update();
            swiperslider2.onResize();
        }
        //
        if (typeof (swiperslider3.length) === 'undefined') {
            swiperslider3.update();
            swiperslider3.onResize();
        }
        //
        if (typeof (swiperslider4.length) === 'undefined') {
            swiperslider4.update();
            swiperslider4.onResize();
        }
        //
        if (typeof (swiperslider5.length) === 'undefined') {
            swiperslider5.update();
            swiperslider5.onResize();
        }
    }
}

jQuery(window).resize(function () {
    updater();
});