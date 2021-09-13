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

// Redirect to home page if address is not specified in address bar.

use App\Siteinfo;

Route::get('/shop', 'HomeController@index');

// top request routes here
Route::resource('/announcements', 'AnnouncementController');

// top request routes here
Route::resource('/top-requests', 'ToprequestController');


// Redirect to addNews method of NewsController
Route::get('/addNews', 'NewsController@addNews');

// Redirect to insertNews method of NewsController
Route::post('/insertNews', 'NewsController@insertNews');

// Redirect to allBNews method of NewsController
Route::get('/all-news', 'NewsController@allNews');

// Redirect to editNews method of NewsController
Route::get('/editNews/{newsId}', 'NewsController@editNews');

// Redirect to updateNews method of NewsController
Route::post('/updateNews/{newsId}', 'NewsController@updateNews');

// Redirect to deleteNews method of NewsController
Route::get('/deleteBlog/{blogId}', 'NewsController@deleteBlog');

//for front end

// Redirect to news method of NewsController
Route::get('/news', 'NewsController@news');
// Redirect to news archive method of NewsController
Route::get('/media-archive', 'NewsController@mediaArchive');



//partnership

Route::get('/partnership', 'PartnershipController@partnership');
Route::post('/store-partnership', 'PartnershipController@store');

// Redirect to addJob method of AdminController
Route::get('/add-job', 'JobController@create');
Route::get('/all-jobs', 'JobController@index');
Route::post('/insert-job', 'JobController@store');
Route::get('/edit-job/{id}', 'JobController@edit');
Route::put('/update-job/{id}', 'JobController@update');
Route::get('/delete-job/{id}', 'JobController@destroy');
//for front end
Route::get('/career', 'JobController@career');
Route::get('/career/{id}', 'JobController@show');
Route::post('/application', 'JobController@jobApplication');
Route::get('/application-list', 'JobController@applicationList');
Route::get('/job-seeker', 'JobController@jobSeeker');



// Redirect to subscribe method of HelpController
Route::post('/subscribe', 'HomeController@subscribe');

// Redirect to productDetails method of ProductsController
Route::get('/productDetails/{productId}', 'ProductsController@productDetails');

// Redirect to addProduct method of ProductsController
Route::get('/addProduct', 'ProductsController@addProduct');

// Redirect to allProducts method of ProductsController
Route::get('/all-products', 'ProductsController@allProducts');

// Redirect to insertProduct method of ProductsController
Route::post('/insertProduct', 'ProductsController@insertProduct');

// Redirect to editProduct method of ProductsController
Route::get('/editProduct/{productId}', 'ProductsController@editProduct');

// Redirect to updateProduct method of ProductsController
Route::post('/updateProduct/{productId}', 'ProductsController@updateProduct');

// Redirect to editProduct method of ProductsController
Route::get('/deleteProduct/{productId}', 'ProductsController@deleteProduct');

// Redirect to productsByBrand method of ProductsController
Route::get('/productsByBrand/{brandId}', 'ProductsController@productsByBrand');

// Redirect to productsByCat method of ProductsController
Route::get('/productsByCat/{catId}/{subCatId?}/{miniCatId?}', 'ProductsController@productsByCat');

// Redirect to productsByCat method of ProductsController
Route::get('/products-by-ajax', 'ProductsController@productsByAjax');

// Redirect to productsByInd method of ProductsController
Route::get('/productsByInd/{industryId}/{catId?}', 'ProductsController@productsByInd');
Route::get('/productsByInd', 'ProductsController@productsByIndustry');

// Redirect to productsByTech method of ProductsController
Route::get('/productsByTech/{techId}', 'ProductsController@productsByTech');
Route::get('/technologies', 'ProductsController@productsByTechnology');

// Redirect to getSearchedProduct method of ProductsController
Route::get('/getSearchedProduct', 'ProductsController@getSearchedProduct');

// Redirect to getProduct method of ProductsController
Route::get('/getProduct/{key}', 'ProductsController@getProduct');

// Redirect to addReview method of ProductsController
Route::post('/addReview/{proId}', 'ProductsController@addReview');

// Redirect to faq mathod of HelpController
Route::get('/faq', 'HelpController@faq');

// Redirect to storeLocation method of HelpController
Route::get('/store-location', 'HelpController@storeLocation');

// Redirect to termCondition method of HelpController
Route::get('/term-condition', 'HelpController@termCondition');

// Redirect to orderTracking method of HelpController
Route::get('/order-tracking', 'HelpController@orderTracking');
Route::post('/tracked-order', 'HelpController@showOrder');

// Redirect to login method of UserController
Route::get('/login', 'UserController@login');

// Redirect to register method of UserController
Route::post('/register', 'UserController@register');

// Redirect to register method of UserController
Route::get('/user/verify/{token}', 'UserController@verifyUser');
Route::get('/user/resend-verify-mail/{email}', 'UserController@resendVerifyMail');
Route::post('/user/resend-verify-mail', 'UserController@resendVerifyMailPost');

// Redirect to cmrLogout method of UserController
Route::get('/cmrLogout', 'UserController@cmrLogout');

// Redirect to loginAuthorization method of UserController
Route::post('/loginAuthorization', 'UserController@loginAuthorization');

// Redirect to deleteOrder method of UserController
Route::get('/deleteOrder/{orderId}', 'UserController@deleteOrder');

// Redirect to cart method of UserController
Route::get('/cart', 'UserController@cart');

// Redirect to addCart method of UserController
Route::get('/addCart/{proId}', 'UserController@addCart');

// Redirect to insertCart method of UserController
Route::post('/insertCart/{proId}', 'UserController@insertCart');

// Redirect to updateCart method of UserController
Route::post('/updateCart/{cartId}', 'UserController@updateCart');

// Redirect to deleteCart method of UserController
Route::get('/deleteCart/{cartId}', 'UserController@deleteCart');

// Redirect to compare method of UserController
Route::get('/compare', 'UserController@compare');

// Redirect to addCompare method of UserController
Route::get('/addCompare/{proId}', 'UserController@addCompare');
Route::get('/compareSimiliar/{proId}/{miniCatId}', 'UserController@compareSimiliar');

// Redirect to deleteCompare method of UserController
Route::get('/deleteCompare/{compareId}', 'UserController@deleteCompare');

// Redirect to wishlist method of UserController
Route::get('/wishlist', 'UserController@wishlist');

// Redirect to deleteWishlist method of UserController
Route::get('/deleteWishlist/{wishlistId}', 'UserController@deleteWishlist');

// Redirect to addWishlist method of UserController
Route::get('/addWishlist/{proId}', 'UserController@addWishlist');

// Redirect to myAccount method of UserController
Route::get('/my-account', 'UserController@myAccount');

// Redirect to checkout method of UserController
Route::get('/checkout', 'UserController@checkout');

// Redirect to order method of UserController
Route::post('/order', 'UserController@order');

// Redirect to cmrOrder method of UserController
Route::post('/cmrOrder', 'UserController@cmrOrder');

// Redirect to index method of BrandController
Route::get('/brands', 'BrandController@index');

// Redirect to addBrands method of BrandController
Route::get('/addBrands', 'BrandController@addBrands');

// Redirect to insertBrands method of BrandController
Route::post('/insertBrands', 'BrandController@insertBrands');

// Redirect to allBrands method of BrandController
Route::get('/all-brands', 'BrandController@allBrands');

// Redirect to editBrand method of BrandController
Route::get('/editBrand/{brandId}', 'BrandController@editBrand');

// Redirect to updateBrand method of BrandController
Route::post('/updateBrand/{brandId}', 'BrandController@updateBrand');

// Redirect to deleteBrand method of BrandController
Route::get('/deleteBrand/{brandId}', 'BrandController@deleteBrand');

// Redirect to index method of CategoryController
Route::get('/categories', 'CategoryController@index');

// Redirect to addCategories method of CategoryController
Route::get('/addCategories', 'CategoryController@addCategories');

// Redirect to insertCategory method of CategoryController
Route::post('/insertCategory', 'CategoryController@insertCategory');

// Redirect to editCategory method of CategoryController
Route::get('/editCat/{catId}', 'CategoryController@editCategory');

// Redirect to updateCategory method of CategoryController
Route::post('/updateCategory/{catId}', 'CategoryController@updateCategory');

// Redirect to deleteCategory method of CategoryController
Route::get('/deleteCat/{catId}', 'CategoryController@deleteCategory');

// Redirect to allCategory method of CategoryController
Route::get('/all-category', 'CategoryController@allCategory');

// Redirect to index method of BlogController
Route::get('/blog', 'BlogController@index');

// Redirect to addBlog method of BlogController
Route::get('/addBlog', 'BlogController@addBlog');

// Redirect to insertBlog method of BlogController
Route::post('/insertBlog', 'BlogController@insertBlog');

// Redirect to allBlogs method of BlogController
Route::get('/all-blogs', 'BlogController@allBlogs');

// Redirect to editBlog method of BlogController
Route::get('/editBlog/{blogId}', 'BlogController@editBlog');

// Redirect to updateBlog method of BlogController
Route::post('/updateBlog/{blogId}', 'BlogController@updateBlog');

// Redirect to deleteBlog method of BlogController
Route::get('/deleteBlog/{blogId}', 'BlogController@deleteBlog');

// Redirect to blogDetails method of BlogController
Route::get('/blog-details/{blogId}', 'BlogController@blogDetails');

// Redirect to addBlogReview method of BlogController
Route::post('/addBlogReview/{blogId}', 'BlogController@addBlogReview');

// Redirect to about method of CompanyController
Route::get('/about', 'CompanyController@about');

// Redirect to addAbout method of CompanyController
Route::get('/addAbout', 'CompanyController@addAbout');

// Redirect to insertAbout method of CompanyController
Route::post('/insertAbout', 'CompanyController@insertAbout');

// Redirect to allAbout method of CompanyController
Route::get('/aboutInfo', 'CompanyController@allAbout');

// Redirect to editAbout method of CompanyController
Route::get('/editAbout/{aboutId}', 'CompanyController@editAbout');

// Redirect to updateAbout method of CompanyController
Route::post('/updateAbout/{aboutId}', 'CompanyController@updateAbout');

// Redirect to deleteAbout method of CompanyController
Route::get('/deleteAbout/{aboutId}', 'CompanyController@deleteAbout');

// Redirect to contact method of CompanyController
Route::get('/contact', 'CompanyController@contact');

// Redirect to addMessage method of CompanyController
Route::post('/addMessage', 'CompanyController@addMessage');

// Redirect to allMessages method of CompanyController
Route::get('/allMessages', 'CompanyController@allMessages');

// Redirect to deleteMessage method of CompanyController
Route::get('/deleteMessage/{mesID}', 'CompanyController@deleteMessage');

// Redirect to addContact method of CompanyController
Route::get('/addContact', 'CompanyController@addContact');

// Redirect to insertContact method of CompanyController
Route::post('/insertContact', 'CompanyController@insertContact');

// Redirect to allContacts method of CompanyController
Route::get('/allContacts', 'CompanyController@allContacts');

// Redirect to editContact method of CompanyController
Route::get('/editContact/{contactId}', 'CompanyController@editContact');

// Redirect to updateContact method of CompanyController
Route::post('/updateContact/{contactId}', 'CompanyController@updateContact');

// Redirect to deleteContact method of CompanyController
Route::get('/deleteContact/{contactId}', 'CompanyController@deleteContact');

// Redirect to index method of AdminController
Route::get('/administration', 'AdminController@index');

// Redirect to dashboard method of AdminController
Route::get('/dashboard', 'AdminController@dashboard');

// Redirect to loginAuth method of AdminController
Route::post('/loginAuth', 'AdminController@loginAuth');

// Redirect to logout method of AdminController
Route::get('/logout', 'AdminController@logout');

// Redirect to addUser method of AdminController
Route::get('/addUser', 'AdminController@addUser');

// Redirect to insertUser method of AdminController
Route::post('/insertUser', 'AdminController@insertUser');

// Redirect to allUsers method of AdminController
Route::get('/all-user', 'AdminController@allUsers');

// Redirect to editUser method of AdminController
Route::get('/editUser/{userId}', 'AdminController@editUser');

// Redirect to updateUser method of AdminController
Route::post('/updateUser/{userId}', 'AdminController@updateUser');

// Redirect to deleteUser method of AdminController
Route::get('/deleteUser/{userId}', 'AdminController@deleteUser');

// Redirect to siteinfo method of AdminController
Route::get('/siteinfo', 'AdminController@siteinfo');

// Redirect to addInfo method of AdminController
Route::post('/addInfo', 'AdminController@addInfo');

// Redirect to allInfo method of AdminController
Route::get('/allInfo', 'AdminController@allInfo');

// Redirect to editInfo method of AdminController
Route::get('/editInfo/{infoId}', 'AdminController@editInfo');

// Redirect to updateInfo method of AdminController
Route::post('/updateInfo/{infoId}', 'AdminController@updateInfo');

// Redirect to deleteInfo method of AdminController
Route::get('/deleteInfo/{infoId}', 'AdminController@deleteInfo');

// Redirect to addPartner method of AdminController
Route::get('/addPartner', 'AdminController@addPartner');

// Redirect to insertPartner method of AdminController
Route::post('/insertPartner', 'AdminController@insertPartner');

// Redirect to allPartners method of AdminController
Route::get('/all-partners', 'AdminController@allPartners');

// Redirect to editPartner method of AdminController
Route::get('/editPartner/{partnerId}', 'AdminController@editPartner');

// Redirect to updatePartner method of AdminController
Route::post('/updatePartner/{partnerId}', 'AdminController@updatePartner');

// Redirect to deletePartner method of AdminController
Route::get('/deletePartner/{partnerId}', 'AdminController@deletePartner');

// Redirect to addIndustry method of IndustryController
Route::get('/addIndustry', 'IndustryController@addIndustry');

// Redirect to insertIndustry method of IndustryController
Route::post('/insertIndustry', 'IndustryController@insertIndustry');

// Redirect to allIndustries method of IndustryController
Route::get('/all-industries', 'IndustryController@allIndustries');

// Redirect to editIndustry method of IndustryController
Route::get('/editIndustry/{industryId}', 'IndustryController@editIndustry');

// Redirect to updateIndustry method of IndustryController
Route::post('/updateIndustry/{industryId}', 'IndustryController@updateIndustry');

// Redirect to deleteIndustry method of IndustryController
Route::get('/deleteIndustry/{industryId}', 'IndustryController@deleteIndustry');

// Redirect to addTechnology method of TechnologyController
Route::get('/addTechnology', 'TechnologyController@addTechnology');

// Redirect to insertTechnology method of TechnologyController
Route::post('/insertTechnology', 'TechnologyController@insertTechnology');

// Redirect to allTechnologies method of TechnologyController
Route::get('/all-technologies', 'TechnologyController@allTechnologies');

// Redirect to editTechnology method of TechnologyController
Route::get('/editTechnology/{techId}', 'TechnologyController@editTechnology');

// Redirect to updateTechnology method of TechnologyController
Route::post('/updateTechnology/{techId}', 'TechnologyController@updateTechnology');

// Redirect to deleteTechnology method of TechnologyController
Route::get('/deleteTechnology/{techId}', 'TechnologyController@deleteTechnology');

// Redirect to addSubCategory method of SubCategoryController
Route::get('/addSubCategory', 'SubCategoryController@addSubCategory');

// Redirect to insertSubCategory method of SubCategoryController
Route::post('/insertSubCategory', 'SubCategoryController@insertSubCategory');

// Redirect to allSubCategories method of SubCategoryController
Route::get('/all-subCategories', 'SubCategoryController@allSubCategories');

// Redirect to editSubCategory method of SubCategoryController
Route::get('/editSubCategory/{subCatId}', 'SubCategoryController@editSubCategory');

// Redirect to updateSubCategory method of SubCategoryController
Route::post('/updateSubCategory/{subCatId}', 'SubCategoryController@updateSubCategory');

// Redirect to deleteSubCategory method of SubCategoryController
Route::get('/deleteSubCategory/{subCatId}', 'SubCategoryController@deleteSubCategory');

// Redirect to getSubCat method of SubCategoryController
Route::get('/getSubCat/{catId}', 'SubCategoryController@getSubCat');

// Redirect to addMiniCategory method of MiniCategoryController
Route::get('/addMiniCategory', 'MiniCategoryController@addMiniCategory');

// Redirect to insertMiniCategory method of MiniCategoryController
Route::post('/insertMiniCategory', 'MiniCategoryController@insertMiniCategory');

// Redirect to allMiniCategories method of MiniCategoryController
Route::get('/all-miniCategories', 'MiniCategoryController@allMiniCategories');

// Redirect to editMiniCategory method of MiniCategoryController
Route::get('/editMiniCategory/{miniCatId}', 'MiniCategoryController@editMiniCategory');

// Redirect to updateMiniCategory method of MiniCategoryController
Route::post('/updateMiniCategory/{miniCatId}', 'MiniCategoryController@updateMiniCategory');

// Redirect to deleteMiniCategory method of MiniCategoryController
Route::get('/deleteMiniCategory/{miniCatId}', 'MiniCategoryController@deleteMiniCategory');

// Redirect to getMiniCat method of MiniCategoryController
Route::get('/getMiniCat/{subCatId}', 'MiniCategoryController@getMiniCat');

// Slider routes here
Route::resource('sliders', 'SliderController');

// Color routes here
Route::resource('colors', 'ColorController');

// Size routes here
Route::resource('sizes', 'SizeController');

// Tag routes here
Route::resource('tags', 'TagController');

// Discount routes here
Route::post('/applyCoupon', 'DiscountController@applyCoupon');
Route::resource('discounts', 'DiscountController');

// MembershipType routes here
Route::resource('membership_types', 'MembershipTypeController');

// Salesman routes here
Route::get('/sales_login', function () {
    return view('sales_login');
});
Route::post('/salesmen_auth', 'LoginController@sales_login');
Route::post('/sales_logout', 'LoginController@sales_logout');
Route::put('/sales_update', 'SalesmanController@sales_update');
Route::put('/update_sales_pass', 'SalesmanController@updatePass');
Route::resource('salesmen', 'SalesmanController');

// Salesman target routes here
Route::resource('salesmantargets', 'SalesmantargetController');

// Offer routes here
Route::get('/offer', 'OfferController@allOffers');
Route::resource('offers', 'OfferController');

// Deal routes here
Route::get('/deal', 'DealController@allDeals');
Route::resource('deals', 'DealController');

// Banner routes here
Route::resource('banners', 'BannerController');

// Customer routes here
Route::get('customers', 'CustomerController@index');
Route::delete('customers/{id}', 'CustomerController@destroy');
Route::put('customers/{id}', 'CustomerController@update');
Route::put('updatePass', 'CustomerController@updatePass');
Route::get('/client-login', 'LoginController@login_view');

// Order routes here
Route::get('orders', 'OrderController@index');
Route::get('orders/{id}/edit', 'OrderController@edit');
Route::put('orders/{id}', 'OrderController@update');
Route::get('orders/{id}', 'OrderController@show');
Route::delete('orders/{id}', 'OrderController@destroy');

// Salesman routes here
Route::get('/sales_login', 'SalesmanController@sales_login');
Route::post('/salesmen_auth', 'LoginController@sales_login');
Route::post('/sales_logout', 'LoginController@sales_logout');
Route::put('/sales_update', 'SalesmanController@sales_update');
Route::put('/update_sales_pass', 'SalesmanController@updatePass');
Route::get('clientOrder/{id}', 'SalesmanController@showOrder');
Route::resource('salesmen', 'SalesmanController');

// Salesman target routes here
Route::get('targets', 'SalesmantargetController@targets');
Route::resource('salesmantargets', 'SalesmantargetController');

// Password reset routes here
Route::put('/password_reset', 'ResetController@password_reset');
Route::post('/passwordReset', 'ResetController@passwordReset');
Route::get('/reset/verify/{token}', 'ResetController@reset');

// Mail routes here
Route::get('/compose', 'MailController@compose');
Route::post('/sendMail', 'MailController@sendMail');

// Client target routes here
Route::resource('clients', 'ClientController');

// Dmar target routes here
Route::resource('dmars', 'DmarController');

// Mydeal target routes here
Route::resource('mydeals', 'MydealController');

// Plan target routes here
Route::resource('plans', 'PlanController');

// Sector target routes here
Route::resource('sectors', 'SectorController');

// Subsector target routes here
Route::resource('subsectors', 'SubsectorController');

// Incentive target routes here
Route::resource('incentives', 'IncentiveController');

//Forum target reoute here
Route::get('/forum-questions', 'ForumController@index');
Route::get('/forum-question-create', 'ForumController@create');
Route::post('/forum-question-store', 'ForumController@store');
Route::get('/forum-question-show/{slug}', 'ForumController@show');
Route::post('/forum-question-comment/{id}', 'ForumController@comments');
Route::post('/forum-question-replies/{id}', 'ForumController@forumcommentreplies');



//informative
Route::get('/info-login', 'InformativeHomeController@login');
Route::get('/', 'InformativeHomeController@index');
Route::get('/search', 'InformativeHomeController@search');
Route::get('/contact', 'InformativeHomeController@contact');

// Redirect to addwelcomeNote method of InformativeHomeController
Route::get('/addWelcomeNote', 'InformativeHomeController@addWelcomeNote');

// Redirect to welcomeNote method of InformativeHomeController
Route::post('/welcomeNote', 'InformativeHomeController@welcomeNote');

// Redirect to latest news method of InformativeHomeController
Route::get('/latest-news', 'InformativeHomeController@latestNews');
Route::get('/allIndustry', 'InformativeHomeController@allIndustry');
Route::get('/all-brand', 'InformativeHomeController@allBrand');
Route::get('/all-category-info', 'InformativeHomeController@allCategory');
Route::get('/brand-details/{id}', 'InformativeHomeController@brandDetails');
Route::get('/industry-details/{id}', 'InformativeHomeController@industryDetails');
Route::get('/informative-products', 'InformativeHomeController@informativeProducts');
Route::get('/testimony-create', 'InformativeHomeController@testimony');
Route::get('/info-about', function(){
    $about = \App\About::all()->first();
    return view('informative.about')->with('about', $about);
});
Route::post('/search-page', 'InformativeHomeController@searchPage');

//services
Route::get('/services', 'ServiceController@index');
Route::get('/service/{id}/{slug}', 'ServiceController@show');
Route::get('/addservice', 'ServiceController@create');
Route::post('/store-service', 'ServiceController@store');

//feature content
Route::get('/feature-content', 'FeaturedcontentController@index');
Route::get('/feature-content-create', 'FeaturedcontentController@create');
Route::post('/feature-content-store', 'FeaturedcontentController@store');
Route::get('/feature-content/{id}', 'FeaturedcontentController@show');
Route::get('/searchByCategory/{id}', 'FeaturedcontentController@searchByCategory');
Route::get('/searchByTag/{id}', 'FeaturedcontentController@searchByTag');
Route::get('/all-content', 'FeaturedcontentController@allContent');
Route::get('/edit-featuredcontent/{id}', 'FeaturedcontentController@edit');
Route::post('/feature-content-update/{id}', 'FeaturedcontentController@update');
Route::delete('/delete-featuredcontent/{id}', 'FeaturedcontentController@destroy');


//guest message (contact with us)
Route::get('/contact-messages', 'GuestMessageController@index');
Route::get('/send-query-reply/{id}', 'GuestMessageController@queryReply');
Route::post('/send-guest-message', 'GuestMessageController@store');
Route::post('/show-guest-message/{id}', 'GuestMessageController@showGuestQuery');
Route::get('/delete-guest-message/{id}', 'GuestMessageController@destroy');


//Solution 
Route::get('/solutions', 'SolutionController@index');
Route::get('/all-solutions', 'SolutionController@allSolution');
Route::get('/add-solution', 'SolutionController@create');
Route::post('/store-solution', 'SolutionController@store');
Route::get('/edit-solution/{id}', 'SolutionController@edit');
Route::post('/update-solution/{id}', 'SolutionController@update');
Route::get('/solution/{id}/{slug}', 'SolutionController@show');
Route::delete('/delete-solution/{id}', 'SolutionController@destroy');


//SubSolution
Route::get('/sub-solution', 'SubsolutionController@index');
Route::get('/all-subSolutions', 'SubsolutionController@allSubSolution');
Route::get('/add-subsolution', 'SubsolutionController@create');
Route::post('/store-subsolution', 'SubsolutionController@store');
Route::get('/edit-subSolution/{id}', 'SubsolutionController@edit');
Route::post('/update-subsolution/{id}', 'SubsolutionController@update');
Route::get('/sub-solution/{id}/{slug}', 'SubsolutionController@show');
Route::get('/get-subSolution/{solutionId}', 'SubsolutionController@getSubSolution');
Route::delete('/delete-Subsolution/{id}', 'SubsolutionController@destroy');


//Product
Route::get('product-info/{id}/{slug}', 'ProductsController@productInfo');
Route::get('products-by-cat/{id}', 'ProductsController@productsByCatInfo');
Route::get('products-by-cat/{catId}/{subCatId}', 'ProductsController@productsByCatInfo');


//profile
Route::get('/add-profile', 'InformativeHomeController@addProfile');
Route::post('/store-profile', 'InformativeHomeController@profile');

//newsletter
Route::get('/add-newsletter', 'InformativeHomeController@addNewsletter');
Route::post('/store-newsletter', 'InformativeHomeController@newsletter');
Route::get('/newsletter', 'InformativeHomeController@allNewsletter');

//Informative blog
Route::get('/informative-blog', 'BlogController@infoIndex');
Route::get('/informative-blog-details/{id}', 'BlogController@informativeBlogDetails');

//faq
Route::get('/create-faq', 'FaqController@create');
Route::post('/store-faq', 'FaqController@store');
Route::get('/info-faq','FaqController@index');

//Quotation
Route::get('quotation/{slug}', function ($slug) {
    return view('informative.quotation')->with('slug', $slug);
});

//Vendors
Route::get('/vendors', 'LogoController@index');
Route::get('/vendor-create', 'LogoController@create');
Route::post('/vendors', 'LogoController@store');
Route::delete('/vendors/{id}', 'LogoController@destroy');

//Principles
Route::get('/principles', 'LogoController@principleIndex');
Route::get('/principle-create', 'LogoController@principleCreate');
Route::post('/principles', 'LogoController@principleStore');
Route::delete('/principles/{id}', 'LogoController@principleDestroy');


//What we Do

Route::get('/digital-innovations', 'WhatWeDoController@digitalInnovations');
Route::get('/create-digital-innovations', 'WhatWeDoController@createDigitalInnovation');
Route::post('/store-digital-innovations', 'WhatWeDoController@storeDigitalInnovation');
Route::get('/digital-innovation/{id}', 'WhatWeDoController@showDigitalInnovation');
Route::get('/edit-digital-innovations/{id}', 'WhatWeDoController@editDigitalInnovation');
Route::post('/update-digital-innovations/{id}', 'WhatWeDoController@updateDigitalInnovation');
Route::delete('/delete-digital-innovations/{id}', 'WhatWeDoController@destroy');
Route::any('digital-innovation', function () {
    $siteinfos = Siteinfo::first();
    $digitalInnovations = \App\Digitalinnovation::all();
    return view('informative.whatWeDo.digitalInnovation')->with('siteinfos', $siteinfos)->with('digitalInnovations', $digitalInnovations);
});

Route::get('/cloud-datacenter', 'WhatWeDoController@dataCenter');
Route::get('/create-cloud-datacenter', 'WhatWeDoController@createDataCenter');
Route::post('/store-cloud-datacenter', 'WhatWeDoController@storeDataCenter');
Route::get('/edit-cloud-datacenter/{id}', 'WhatWeDoController@editDataCenter');
Route::post('/update-cloud-datacenter/{id}', 'WhatWeDoController@updateDataCenter');
Route::delete('/delete-cloud-datacenter/{id}', 'WhatWeDoController@destroyDataCenter');
Route::get('/cloud-datacenter/{id}', 'WhatWeDoController@showDataCenter');
Route::any('cloud-datacenter-font', function () {
    $siteinfos = Siteinfo::first();
    $dataCenterInfoes = \App\Datacenter::all();
    return view('informative.whatWeDo.allDataCenter')->with('siteinfos', $siteinfos)->with('dataCenterInfoes', $dataCenterInfoes);
});

//connected workforce
Route::get('/connected-workforce', 'WhatWeDoController@connectedWorkforces');
Route::get('/create-connected-workforce', 'WhatWeDoController@createConnectedWorkforce');
Route::post('/store-connected-workforce', 'WhatWeDoController@storeConnectedWorkforce');
Route::get('/connected-workforce/{id}', 'WhatWeDoController@showConnectedWorkforce');
Route::get('/edit-connected-workforce/{id}', 'WhatWeDoController@editConnectedWorkforce');
Route::post('/update-connected-workforce/{id}', 'WhatWeDoController@updateConnectedWorkforce');
Route::delete('/delete-connected-workforce/{id}', 'WhatWeDoController@destroyConnectedWorkforce');

Route::any('connected-workforce-all', function () {
    $siteinfos = Siteinfo::first();
    $connectedWorkforces = \App\Connectedworkforce::all();
    return view('informative.whatWeDo.allConnectedWrkforce')->with('siteinfos', $siteinfos)->with('connectedWorkforces', $connectedWorkforces);
});

//system integration
Route::get('/system-integration', 'WhatWeDoController@systemIntegrations');
Route::get('/create-system-integration', 'WhatWeDoController@createSystemIntegration');
Route::post('/store-system-integration', 'WhatWeDoController@storeSystemIntegration');
Route::get('/system-integration/{id}', 'WhatWeDoController@showSystemIntegration');
Route::get('/edit-system-integration/{id}', 'WhatWeDoController@editSystemIntegration');
Route::post('/update-system-integration/{id}', 'WhatWeDoController@updateSystemIntegration');
Route::delete('/delete-system-integration/{id}', 'WhatWeDoController@destroySystemIntegration');

Route::any('system-integration-all', function () {
    $siteinfos = Siteinfo::first();
    $systemIntegrations = \App\Systemintegration::all();
    return view('informative.whatWeDo.allSystemIntegrations')->with('siteinfos', $siteinfos)->with('systemIntegrations', $systemIntegrations);
});


Route::get('/notFound', function () {
    return view('notFound');
});
