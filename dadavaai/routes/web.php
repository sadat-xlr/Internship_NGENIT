<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// use Illuminate\Http\Request;
Route::get('AccessDenaid', function() {
    return view('403');
});
Route::get('notFound', function() {
    return view('notFound');
});

Route::group(['middleware' => ['role:super-admin']], function () {
    
});

// $role = Role::create(['name' => 'writer']);

//admin panel route

Auth::routes();
// Route::get('/admin-dashboard', 'HomeController@index')->name('admin-dashboard')->middleware(['auth','role:super-admin']);

Route::get('/admin-dashboard', 'HomeController@index')->name('admin-dashboard');
Route::post('/addUser', 'Auth\RegisterController@addUser')->middleware('auth');
// Route::post('/addUser', 'Auth\RegisterController@addUser');
Route::get('/users', 'RoleController@users')->middleware('auth');

Route::put('/roles-permission/{id}', 'RoleController@setRoleAndPermission')->middleware('auth');

//services

Route::get('/requested-services', 'ServiceController@requestedService')->middleware('auth');
Route::put('/published-service/{id}', 'ServiceController@publishService')->middleware('auth');

Route::get('/services', 'ServiceController@index')->middleware('auth');
Route::post('/services', 'ServiceController@store')->middleware('auth');
Route::put('/service/{id}', 'ServiceController@update')->middleware('auth');
Route::delete('/service/{id}', 'ServiceController@destroy')->middleware('auth');


//Roles

Route::get('/roles', 'RoleController@index')->middleware('auth');
Route::post('/roles', 'RoleController@store')->middleware('auth');
Route::put('/roles/{id}', 'RoleController@update')->middleware('auth');
Route::delete('/roles/{id}', 'RoleController@destroy')->middleware('auth');

//permissions

Route::get('/permissions', 'RoleController@permissions')->middleware('auth');
Route::post('/permissions', 'RoleController@permissionStore')->middleware('auth');
Route::put('/permissions/{id}', 'RoleController@permissionUpdate')->middleware('auth');
Route::delete('/permissions/{id}', 'RoleController@permissionDestroy')->middleware('auth');

// product information
Route::get('/product-ad-Information/{id}', 'ProductinformationController@information');

Route::get('/product-Informations', 'ProductinformationController@index')->middleware('auth');
Route::post('/product-Informations', 'ProductinformationController@store')->middleware('auth');
Route::put('/product-Informations/{id}', 'ProductinformationController@update')->middleware('auth');
Route::delete('/product-Informations/{id}', 'ProductinformationController@destroy')->middleware('auth');

//blog
Route::get('/blogs', 'BlogController@index')->middleware('auth');
Route::get('/add-blog', 'BlogController@addBlog')->middleware('auth');
Route::post('/blogs', 'BlogController@storeBlog')->middleware('auth');
Route::get('/edit-blog/{id}/edit', 'BlogController@editBlog')->middleware('auth');
Route::put('/blogs/{blogId}', 'BlogController@updateBlog')->middleware('auth');
Route::delete('/blogs/{blogId}', 'BlogController@deleteBlog')->middleware('auth');



//contacts
Route::get('/contacts', 'ContactController@index')->middleware('auth');
Route::post('/contacts', 'ContactController@store')->middleware('auth');
Route::put('/contacts/{id}', 'ContactController@update')->middleware('auth');
Route::delete('/contacts/{id}', 'ContactController@destroy')->middleware('auth');

// About routes here
Route::get('/about', 'AboutController@allAbouts')->name('about');
Route::get('/abouts', 'AboutController@index')->middleware('auth');
Route::post('/abouts', 'AboutController@store')->middleware('auth');
Route::put('/abouts/{id}', 'AboutController@update')->middleware('auth');
Route::delete('/abouts/{id}', 'AboutController@destroy')->middleware('auth');

// terms & policies routes here
Route::get('/terms-policies', 'PolicyController@allPolicies');
Route::get('/policies', 'PolicyController@index')->middleware('auth');
Route::post('/policies', 'PolicyController@store')->middleware('auth');
Route::put('/policies/{id}', 'PolicyController@update')->middleware('auth');
Route::delete('/policies/{id}', 'PolicyController@destroy')->middleware('auth');

// FAQ

Route::get('/faqs-search', 'FaqController@faqPageSearch');
Route::get('/all-faqs', 'FaqController@allFaqs');
Route::get('/faqs', 'FaqController@index')->middleware('auth');
Route::post('/faqs', 'FaqController@store')->middleware('auth');
Route::put('/faqs/{id}', 'FaqController@update')->middleware('auth');
Route::delete('/faqs/{id}', 'FaqController@destroy')->middleware('auth');


//slidrs 

Route::get('/sliders', 'SliderController@index')->middleware('auth');
Route::post('/sliders', 'SliderController@store')->middleware('auth');
Route::put('/sliders/{id}', 'SliderController@update')->middleware('auth');
Route::delete('sliders/{id}', 'SliderController@destroy')->middleware('auth');

//banners

Route::get('/banners', 'BannerController@index')->middleware('auth');
Route::post('/banners', 'BannerController@store')->middleware('auth');
Route::put('/banners/{id}', 'BannerController@update')->middleware('auth');
Route::delete('banners/{id}', 'BannerController@destroy')->middleware('auth');

//Categories

Route::get('/categories', 'CategoryController@index')->middleware('auth');
Route::post('/categories', 'CategoryController@store')->middleware('auth');
Route::put('/categories/{id}', 'CategoryController@update')->middleware('auth');
Route::delete('/categories/{id}', 'CategoryController@destroy')->middleware('auth');

//Sub-Categories

Route::get('/sub-categories', 'SubcategoryController@index')->middleware('auth');
Route::post('/sub-categories', 'SubcategoryController@store')->middleware('auth');
Route::put('/sub-categories/{id}', 'SubcategoryController@update')->middleware('auth');
Route::get('/getSubCat/{id}', 'SubcategoryController@getSubCat');
Route::delete('/sub-categories/{id}', 'SubcategoryController@destroy')->middleware('auth');

//minicategory
Route::get('/mini-categories', 'MinicategoryController@index')->middleware('auth');
Route::post('/mini-categories', 'MinicategoryController@store')->middleware('auth');
Route::put('/mini-categories/{id}', 'MinicategoryController@update')->middleware('auth');
Route::get('/getMiniCat/{id}', 'MinicategoryController@getMiniCat');
Route::delete('/mini-categories/{id}', 'MinicategoryController@destroy')->middleware('auth');

//tab
Route::get('/tabs', 'TabController@index')->middleware('auth');
Route::post('/tabs', 'TabController@store')->middleware('auth');
Route::put('/tabs/{id}', 'TabController@update')->middleware('auth');
Route::get('/getTab/{id}', 'TabController@getTab')->middleware('auth');
Route::delete('/tabs/{id}', 'TabController@destroy')->middleware('auth');

//brand
Route::get('/brands', 'BrandController@index')->middleware('auth');
Route::post('/brands', 'BrandController@store')->middleware('auth');
Route::put('/brands/{id}', 'BrandController@update')->middleware('auth');
Route::delete('/brands/{id}', 'BrandController@destroy')->middleware('auth');

//tag
Route::get('/tags', 'TagController@index')->middleware('auth');
Route::post('/tags', 'TagController@store')->middleware('auth');
Route::put('/tags/{id}', 'TagController@update')->middleware('auth');
Route::delete('/tags/{id}', 'TagController@destroy')->middleware('auth');

//colors
Route::get('/colors', 'ColorController@index')->middleware('auth');
Route::post('/colors', 'ColorController@store')->middleware('auth');
Route::put('/colors/{id}', 'ColorController@update')->middleware('auth');
Route::delete('/colors/{id}', 'ColorController@destroy')->middleware('auth');


//sizes
Route::get('/sizes', 'SizeController@index')->middleware('auth');
Route::post('/sizes', 'SizeController@store')->middleware('auth');
Route::put('/sizes/{id}', 'SizeController@update')->middleware('auth');
Route::delete('/sizes/{id}', 'SizeController@destroy')->middleware('auth');

//products
Route::get('/requested-products', 'ProductController@requestedProduct')->middleware('auth');
Route::put('/published-product/{id}', 'ProductController@publishProduct')->middleware('auth');

Route::get('/products', 'ProductController@index')->middleware('auth');
Route::post('/products', 'ProductController@store')->middleware('auth');
Route::put('/products/{id}', 'ProductController@update')->middleware('auth');
Route::delete('/products/{id}', 'ProductController@destroy')->middleware('auth');

//deals
Route::get('/deals', 'DealController@index')->middleware('auth');
Route::post('/deals', 'DealController@store')->middleware('auth');
Route::put('/deals/{id}', 'DealController@update')->middleware('auth');
Route::delete('/deals/{id}', 'DealController@destroy')->middleware('auth');

//bundle offers
Route::get('/bundle-offers', 'BundleofferController@index')->middleware('auth');
Route::post('/bundle-offers', 'BundleofferController@store')->middleware('auth');
Route::put('/bundle-offers/{id}', 'BundleofferController@update')->middleware('auth');
Route::delete('/bundle-offers/{id}', 'BundleofferController@destroy')->middleware('auth');

// Offer routes here
Route::get('/luky-today', 'OfferController@index')->middleware('auth');
Route::post('/luky-today', 'OfferController@store')->middleware('auth');
Route::put('/luky-today/{id}', 'OfferController@update')->middleware('auth');
Route::delete('/luky-today/{id}', 'OfferController@destroy')->middleware('auth');

//prebook
Route::get('/pre-launching-product-list', 'PrebookController@index')->middleware('auth');
Route::post('/pre-launching-product-store', 'PrebookController@store')->middleware('auth');
Route::get('/pre-launching-product-details/{id}', 'PrebookController@show');
Route::put('/pre-launching-product-update/{id}', 'PrebookController@update')->middleware('auth');
Route::delete('/pre-launching-product-delete/{id}', 'PrebookController@destroy')->middleware('auth');

//preorder
Route::get('/pre-order-list', 'PrebookController@preorderList')->middleware('auth');
Route::get('/pre-order-details/{id}', 'PrebookController@preOrderDetails')->middleware('auth');


//siteinfos
Route::get('/faq', 'SiteinfoController@faq');
Route::get('/term-condition', 'SiteinfoController@terms');
Route::get('/siteinfos', 'SiteinfoController@index');
Route::post('/siteinfos', 'SiteinfoController@store');
Route::put('/siteinfos/{id}', 'SiteinfoController@update');
Route::delete('/siteinfos/{id}', 'SiteinfoController@destroy');

// Subscription
Route::post('/subscribes', 'SubscriptionController@store');
Route::get('/unsubscribe', 'SubscriptionController@unsubscribe');

// Mail 
Route::get('/mailbox', 'MailController@index')->middleware('auth');
Route::get('/compose', 'MailController@compose')->middleware('auth');
Route::post('/sendMail', 'MailController@sendMail')->middleware('auth');

// Draft 
Route::get('drafts', 'DraftController@index')->middleware('auth');
Route::post('drafts', 'DraftController@store')->middleware('auth');
Route::get('drafts/{id}', 'DraftController@show')->middleware('auth');
Route::put('drafts/{id}', 'DraftController@update')->middleware('auth');
Route::delete('drafts/{id}', 'DraftController@destroy')->middleware('auth');




// Sent
Route::get('/sents', 'SentController@index')->middleware('auth');
Route::get('/sents/{id}', 'SentController@show')->middleware('auth');
Route::delete('/sents/{id}', 'SentController@destroy')->middleware('auth');
Route::delete('/sents', 'SentController@destroyBulk')->middleware('auth');

//products Ads

Route::get('/productsads', 'ProductsadController@index')->middleware('auth');
Route::post('/productsads', 'ProductsadController@store')->middleware('auth');
Route::put('/productsads/{id}', 'ProductsadController@update')->middleware('auth');
Route::delete('/productsads/{id}', 'ProductsadController@destroy')->middleware('auth');

//ondemand
Route::get('/ondemands', 'OndemandProductController@index')->middleware('auth');
Route::get('/ondemand-quotation/{id}', 'OndemandProductController@show')->middleware('auth');
Route::delete('/ondemands/{id}', 'OndemandProductController@destroy')->middleware('auth');

Route::get('/getOndemandProduct', 'OndemandProductController@getOndemandProduct');


Route::post('/ondemand-update/{id}', 'OndemandProductController@update');
Route::post('/all-to-quote/{id}', 'OndemandProductController@allToQuote');
Route::post('quote-to-client/{ondemand_id}/{quotation_id}', 'OndemandProductController@quoteToClient');


//vendor list for admin
Route::get('/all-vendor', 'VendorController@vendorList')->middleware('auth');
Route::post('/vendor-commission', 'VendorController@vendorCommission')->middleware('auth');

Route::get('/order-for-vendor', 'VendorProductController@orderForVendor')->middleware('auth');
Route::get('/order-details-for-vendor', 'VendorProductController@orderDetailsForVendor')->middleware('auth');


Route::post('/delivery-acknowledgement-status', 'VendorProductController@vendorDeliveryAcknowledgement')->middleware('auth');
Route::post('/vendor-payment-status', 'VendorProductController@vendorPaymentStatus')->middleware('auth');


//vendor's profile

Route::get('/vendor-login', 'VendorController@loginView');
Route::post('/vendor-login', 'VendorController@login');
Route::post('/vendor-logout', 'VendorController@logout');

Route::get('/vendor-registration', 'VendorController@registration');
Route::post('/vendor-registration', 'VendorController@store');

Route::get('/vendor-verify/{token}', 'VendorController@verifyVendor');


Route::get('/vendor-forgot-password', 'VendorController@forgotPassword');
Route::get('/vendor-recovery-email-verify', 'VendorController@recoveryEmailVerify');

Route::get('/vendor-change-password', 'VendorController@changePassword')->middleware('vendorAuth');
Route::post('/vendor-confirm-change-password', 'VendorController@confirmChangePassword')->middleware('vendorAuth');

Route::get('/vendor-account-details', 'VendorController@accountDetails');
Route::post('/vendor-profile-update/{id}', 'VendorController@update');

Route::get('/vendor-dashboard', 'VendorController@index')->middleware('vendorAuth');
Route::get('/product-provide', 'VendorController@productProvide');
Route::post('/product-provide-store', 'VendorController@productProvideStore');
Route::put('/product-provide-update/{id}', 'VendorController@productProvideUpdate');
Route::delete('/product-provide-delete/{id}', 'VendorController@productProvideDelete');


//vendor's products
Route::get('/vendor-products', 'VendorProductController@index')->middleware('vendorAuth');
Route::post('/vendors-products', 'VendorProductController@store')->middleware('vendorAuth');
Route::put('/vendors-products/{id}', 'VendorProductController@update')->middleware('vendorAuth');
Route::delete('/vendors-products/{id}', 'VendorProductController@destroy')->middleware('vendorAuth');

//vendor order

Route::get('/vendor-orders', 'VendorProductController@orderedProduct')->middleware('vendorAuth');
Route::get('/vendor-order-details', 'VendorProductController@vendorOrderDetails')->middleware('vendorAuth');
Route::post('/vendor-delivery-status', 'VendorProductController@vendorDeliveryStatus')->middleware('vendorAuth');
Route::post('/payment-acknowledgement-status', 'VendorProductController@vendorPaymentAcknowledgement')->middleware('vendorAuth');

Route::get('/vendor-delivery', 'VendorProductController@vendorDelivery')->middleware('vendorAuth');
Route::get('/vendor-payment', 'VendorProductController@vendorPayment')->middleware('vendorAuth');








//RFQS/ondemand
Route::get('/rfqs', 'RfqController@rfqs')->middleware('vendorAuth');
Route::post('/quotation/{id}', 'OndemandProductController@quotation')->middleware('vendorAuth');
Route::get('/ondemand-invoice', 'VendorController@ondemandInvoice')->middleware('vendorAuth');




//FrontEnd

Route::get('/contact-form', 'ContactController@contactForm');

Route::get('/', 'ClientHomeController@index');
Route::get('/all-sliders', 'SliderController@allSliders');

Route::get('/all-categories', 'CategoryController@allCategory');

Route::get('/product-by-category/{id}/{categoryName}', 'CategoryController@singleCategory');

Route::get('/product-by-subcategory/{id}/{subcategoryName}', 'SubcategoryController@singleSubcategory');


Route::get('/product-by-minicategory/{id}', 'MinicategoryController@singleMiniCategory');
Route::get('/home-product-by-minicategory/{id}', 'MinicategoryController@homeMiniCategoryProduct');

Route::get('/product-by-brand/{id}/{brandName}', 'BrandController@singleBrand');

Route::get('/product/{id}/{slug}', 'ProductController@show');


//Cart

Route::get('/cart', 'CartController@index');
Route::post('/add-cart', 'CartController@store');
Route::post('/update-cart', 'CartController@update');
Route::post('/delete-cart', 'CartController@destroy');

//service Cart

Route::get('/service-cart', 'CartController@serviceIndex');
Route::post('/add-service-cart', 'CartController@serviceStore');
Route::post('/update-service-cart', 'CartController@serviceUpdate');
Route::post('/delete-service-cart', 'CartController@serviceDestroy');

Route::get('/service-checkout', 'OrderController@serviceCheckout')->middleware('clientAuth');
Route::post('/service-order-store', 'OrderController@serviceOrderStore')->middleware('clientAuth');

//Client

Route::get('/client-login-register', 'ClientController@create');
Route::get('/client-register-view', 'ClientController@registerView');

Route::post('/client-information-store', 'ClientController@store');

Route::get('/forgot-password', 'ClientController@forgotPassword');
Route::get('/recovery-email-verify', 'ClientController@recoveryEmailVerify');

Route::get('/client-verify/{token}', 'ClientController@verifyUser');

Route::get('/client-login', 'ClientController@login');
Route::get('/client-dashboard', 'ClientController@index')->middleware('clientAuth');
Route::get('/client-logout', 'ClientController@logout');
Route::get('/client-address', 'ClientController@address')->middleware('clientAuth');

Route::get('/client-change-password', 'ClientController@changePassword')->middleware('clientAuth');
Route::post('/client-confirm-change-password', 'ClientController@confirmChangePassword')->middleware('clientAuth');

Route::get('/client-address-edit', 'ClientController@editAddress')->middleware('clientAuth');
Route::get('/client-billingaddress-edit', 'ClientController@billingAddress')->middleware('clientAuth');
Route::get('/client-shippingaddress-edit', 'ClientController@shippingAddress')->middleware('clientAuth');

Route::get('/client-use-address', 'ClientController@useAddress')->middleware('clientAuth');

Route::get('/client-payment-method', 'ClientController@paymentMethod')->middleware('clientAuth');
Route::get('/client-payment-method-store', 'ClientController@payment_store')->middleware('clientAuth');
Route::get('/client-order-history', 'ClientController@orderHistory')->middleware('clientAuth');
Route::get('/client-preorder-history', 'ClientController@preOrder')->middleware('clientAuth');

Route::get('/client-preorder-invoice/{preorder_id}', 'ClientController@preOrderInvoice')->middleware('clientAuth');

Route::get('/client-order-invoice/{order_id}', 'ClientController@showInvoice')->middleware('clientAuth');
Route::get('/client-offers', 'ClientController@clientOffers')->middleware('clientAuth');

Route::get('/client-order-delivery-history', 'ClientController@deliveryHistory')->middleware('clientAuth');

Route::get('/client-order-payment-history', 'ClientController@paymentHistory')->middleware('clientAuth');


//client point 

Route::get('/my-point', 'ClientpointController@pointHistory')->middleware('clientAuth');



//login with facebook

Route::get('/facebook-login-redirect', 'SocialAuthFacebookController@redirect');
Route::get('/facebook-login-callback', 'SocialAuthFacebookController@callback');



//Wishlist 

Route::get('/wishlist', 'WishlistController@index')->middleware('clientAuth');
Route::get('/add-to-wishlist', 'WishlistController@store');
Route::get('/delete-from-wishlist', 'WishlistController@destroy')->middleware('clientAuth');

//compare

// Redirect to compare method of CompareController
Route::get('/compare', 'CompareController@compare');
// Redirect to addCompare method of UserController
Route::get('/addCompare/{proId}', 'CompareController@addCompare');

// Redirect to addCompare method of UserController
Route::get('/tabCompare', 'CompareController@tabCompare');


// Redirect to deleteCompare method of UserController
Route::get('/deleteCompare/{compareId}', 'CompareController@deleteCompare');


//offers
Route::get('/offers-discount', 'OffersController@offers');
Route::get('/offers-deals', 'OffersController@deals');
Route::get('/offers-occasion', 'OffersController@occasion');
Route::get('/offers-promotion', 'OffersController@promotion');
Route::get('/offers-clearance', 'OffersController@clearance');
Route::get('/offers-buy-get', 'OffersController@buyGet');
Route::get('/offers-combo', 'OffersController@combo');




//order/checkout
Route::get('/all-order', 'OrderController@index')->middleware('auth');
Route::get('/orders/{id}/edit', 'OrderController@edit')->middleware('auth');
Route::put('/orders/{id}', 'OrderController@update')->middleware('auth');
Route::delete('/orders/{id}', 'OrderController@destroy')->middleware('auth');

Route::get('/ondemand-checkout', 'OrderController@ondemandCheckout')->name('ondemand-checkout')->middleware('clientAuth');
Route::post('/ondemand-order-store', 'OrderController@ondemandOrderStore')->middleware('clientAuth');

Route::get('/checkout', 'OrderController@create')->middleware('clientAuth');

Route::post('/order-store', 'OrderController@store')->middleware('clientAuth');
// Route::get('/order', 'OrderController@sslcommerz')->middleware('clientAuth');

Route::post('/order-success', 'OrderController@success')->middleware('clientAuth');
Route::post('/order-failed', 'OrderController@failed')->middleware('clientAuth');
Route::post('/order-cancle', 'OrderController@cancle')->middleware('clientAuth');



//sort all category
Route::get('/sort-by/{type}', 'ProductController@productSort');
Route::get('/sort-by-color/{miniCatId}/{colorId}', 'ProductController@productSortByColor');
Route::get('/sort-by-size/{miniCatId}/{sizeId}', 'ProductController@productSortBySize');
Route::get('/sort-by-price-range', 'ProductController@productSortByPriceRange');

//search in all category page
Route::get('/all-category-page-search', 'CategoryController@allcategoryPageSearch');

//sort minicategory

Route::get('/minicategory-sort-by/{type}', 'ProductController@minicategoryProductSort');

//sort for single category
Route::get('/category-sort-by/{type}', 'ProductController@categoryProductSort');
Route::get('/sort-by-color/{colorId}/{categoryId}', 'ProductController@singleCategoryProductSortByColor');
Route::get('/sort-by-size/{sizeId}/{categoryId}', 'ProductController@singleCategoryProductSortBySize');

//search in single category page
Route::get('/category-page-search/{categoryId}', 'CategoryController@categoryPageSearch');

//sort for single Brand
Route::get('/brand-sort-by/{type}', 'ProductController@brandProductSort');
Route::get('/sort-by-brand-color/{colorId}/{brandId}', 'ProductController@singleBrandProductSortByColor');
Route::get('/sort-by-brand-size/{sizeId}/{brandId}', 'ProductController@singleBrandProductSortBySize');
Route::get('/brand-sort-by/{type}/{brandId}', 'ProductController@brandProductSort');
Route::get('/sort-by-price-range-brand-product', 'ProductController@brandProductSortByPriceRange');

//search in single Brand
Route::get('/brand-page-search/{brandId}', 'BrandController@brandPageSearch');


//all brands
Route::get('/all-brands', 'BrandController@allBrands');
Route::get('/product-by-brand/{id}/{brandName}', 'BrandController@show');
Route::get('/product-by-brand-mini/{brandId}/{minicategoryId}', 'BrandController@byMinicategory');
Route::get('/brand-search', 'BrandController@brandSearch');

//prebook
Route::get('/prebook-form/{id}', 'PrebookController@prebookForm');

//preorders
Route::post('/pre-order', 'PrebookController@preOrderStore');
Route::post('/pre-order-success', 'PrebookController@preorderSuccess');
Route::post('/pre-order-remaining-payment-success', 'PrebookController@remainingPaymentSuccess');
Route::post('/pre-order-cancle', 'PrebookController@preoredCancle');
Route::post('/pre-order-failed', 'PrebookController@preoredFailed');

Route::post('/pre-order-remaining-payment', 'PrebookController@remainingPayment');


//search
Route::get('/search', 'ClientHomeController@search');
Route::get('/search-page', 'ClientHomeController@searchPage');

//query
Route::post('/query', 'QueryController@store');
Route::get('/query/{id}', 'QueryController@show');

//track order

Route::get('/order-track', 'OrderController@orderTrack');
Route::get('/order-status', 'OrderController@orderStatus');

//chat

Route::post('/message', 'MessageController@store');



//ondemand 
Route::post('/on-demand', 'OndemandProductController@store')->middleware('clientAuth');
Route::get('/client-ondemand-history', 'OndemandProductController@clientOndemandHistory')->middleware('clientAuth');
Route::get('/client-ondemand/{id}', 'OndemandProductController@clientOndemand')->middleware('clientAuth');

//blogs
Route::get('/dadavaai-blogs', 'BlogController@dadavaaiBlogs');
Route::get('/dadavaai-blog/{blogId}/{slug}', 'BlogController@singleBlog');
Route::post('/add-blog-comment/{blogId}', 'BlogController@addBlogComment');



//review

Route::post('/product-review', 'ProductreviewController@store');

//service

Route::get('/all-service', function () {
    return view('client\service\allService');
});

Route::get('/service-by-category/{id}/{categoryName}', 'ServiceController@serviceCategory');

Route::get('/service-by-subcategory/{id}/{subcategoryName}', 'ServiceController@serviceSubcategory');


Route::get('/service-by-minicategory/{id}', 'ServiceController@serviceMiniCategory');

Route::get('/service/{id}/{slug}', 'ServiceController@show');
