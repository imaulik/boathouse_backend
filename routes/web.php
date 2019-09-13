<?php

Route::get('/runConfigArtisan', function ()
{
    return \Artisan::call('config:cache');
});

Route::get('/runmigrate', function ()
{
    return \Artisan::call('migrate');
});
Route::post('/file_upload_check', 'Vessel_detailsController@fileUploadCheck');
Route::get('storage/{filename}', 'AuthController@getFile')->where('filename', '.*');



Route::get('/register', function ()
{
    return view('auth/register');
});
Route::get('/login', function ()
{
    return view('auth/login');
})->name('auth_login');

Route::get('/forgot_password', function ()
{
    return view('auth/forgotpw');
});

Route::get('/films', function()
{
    return view('films');
});
Route::get('/cost-calculator', function()
{
    return view('cost-calculator');
});
Route::get('/sell', function()
{
    return view('sell');
});
Route::get('/contact', function()
{
    return view('contact');
});

Route::post('/front/save_contact_form', 'Contact_formController@SaveContact_form_front');
Route::get('bid_deposit_form/{slug}', 'Vessel_depositsController@getVesseleDepositForm');
Route::get('/', 'Vessel_detailsController@gethomeAuctionDetails');

Route::post('upload/uploadImages', 'UploadController@uploadImages');
Route::post('upload/uploadFile', 'UploadController@uploadFile');

Route::get('/how-it-works', 'Vessel_detailsController@ViewHowAuctionWork');
Route::get('/view-our-auctions', 'Vessel_detailsController@ViewOurAuctions');
Route::get('/sold-our-auctions', 'Vessel_detailsController@SoldOurAuctions');
Route::get('/about-us', 'About_memberController@getAllMembers');
Route::get('/view-our-auctions/{slug}', 'Vessel_detailsController@ViewOurAuctionsBySlug');
Route::post('/user_registration', 'UserController@saveUserRegistration');
Route::post('/user_login', 'UserController@UserLoginData');
Route::post('user/checkemailuser', 'UserController@checkUserEmail');
Route::post('user/checkusernameuser', 'UserController@checkUserUsername');
Route::get('role/get_all_roles', 'RoleController@getAllRoles');
Route::post('option_master/get_all_option_masters', 'Option_masterController@getAllOption_master');
Route::post('subscribe_email/save_subscribe_email', 'Email_subscriberController@saveEmail_subscriber');



Route::group(['middleware' => ['auth']], function ($router)
{
    Route::get('/post_new_auction', function ()
    {
        return view('vessel/post-new-auction');
    });

    Route::post('vessel_comment/save_vessel_comment', 'Vessel_commentsController@saveVessel_comments');
    Route::post('/save_deposit_form', 'Vessel_depositsController@saveVesseleDepositForm');
    Route::get('/my_activity', 'Vessel_detailsController@getMYVessel_details');
    Route::post('/vessel_bid/save_vessel_bid', 'Vessel_bidsController@SaveVessel_bid');
    Route::post('/submitNewVessel', 'Potntial_auctionController@SavePotntial_auction');

    Route::get('/logout', 'UserController@logout');
});



/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */
Route::group(['prefix' => 'auth'], function ($router)
{
    Route::post('refresh', 'AuthController@refresh');
    Route::post('signup', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('forgot_password', 'AuthController@forgetpassword');
    Route::post('check_reset_token', 'AuthController@get_forgotten_user');
    Route::post('password_reset', 'AuthController@resetPassword');
    Route::post('activate_account', 'AuthController@activeAccount');
});

Route::group(['middleware' => ['jwt.auth']], function ($router)
{

    //logout
    Route::get('auth/logout', 'AuthController@logout');

    Route::post('role/get_roles', 'RoleController@getRoles');
    Route::post('role/save_role', 'RoleController@saveRole');
    Route::post('role/delete_role', 'RoleController@deleteRole');
    Route::post('role/get_role', 'RoleController@getRole');
    Route::post('role/get_role_permission', 'RoleController@getRolePermission');

    Route::post('select_master/get_select_masters', 'Select_masterController@getSelect_masters');
    Route::get('select_master/get_all_select_masters', 'Select_masterController@getAllSelect_master');
    Route::post('select_master/save_select_master', 'Select_masterController@saveSelect_master');
    Route::post('select_master/delete_select_master', 'Select_masterController@deleteSelect_master');
    Route::post('select_master/get_select_master', 'Select_masterController@getSelect_master');

    Route::post('option_master/get_option_masters', 'Option_masterController@getOption_masters');
    Route::post('option_master/get_select_options', 'Option_masterController@getselectOption_masters');
    Route::post('option_master/save_option_master', 'Option_masterController@saveOption_master');
    Route::post('option_master/delete_option_master', 'Option_masterController@deleteOption_master');
    Route::post('option_master/get_option_master', 'Option_masterController@getOption_master');

    Route::post('permission/get_permissions', 'PermissionController@getPermissions');
    Route::get('permission/get_all_permissions', 'PermissionController@getAllPermissions');
    Route::post('permission/save_permission', 'PermissionController@savePermission');
    Route::post('permission/delete_permission', 'PermissionController@deletePermission');
    Route::post('permission/get_permission', 'PermissionController@getPermission');

    Route::post('user/get_users', 'UserController@getUsers');
    Route::get('user/get_all_users', 'UserController@getAllUsers');
    Route::post('user/change_UserStatus', 'UserController@changeUserstatus');
    Route::post('user/delete_user', 'UserController@deleteUser');
    Route::post('user/get_user', 'UserController@getUser');
    Route::post('user/save_user', 'UserController@saveUser');

    Route::post('vessel_detail/get_vessel_details', 'Vessel_detailsController@getVessel_details');
    Route::get('vessel_detail/get_all_vessel_details', 'Vessel_detailsController@getAllVessel_details');
    Route::post('vessel_detail/delete_vessel_detail', 'Vessel_detailsController@deleteVessel_detail');
    Route::post('vessel_detail/get_vessel_detail', 'Vessel_detailsController@getVessel_detail');
    Route::post('vessel_detail/save_vessel_detail', 'Vessel_detailsController@saveVessel_detail');
    Route::post('vessel_detail/delete_vessel_detail_gallery_image', 'Vessel_detailsController@deleteVessel_detail_gallery_image');

    
    Route::post('vessel_detail/save_gallery_order', 'Vessel_detailsController@saveVesselGalleryOrder');
    
    Route::post('email_subscriber/get_email_subscribers', 'Email_subscriberController@getEmail_subscribers');

    Route::post('vessel_comment/get_vessel_comments', 'Vessel_commentsController@getVessel_comments');
    Route::post('vessel_comment/get_vessel_comment', 'Vessel_commentsController@getVessel_commentByID');

    Route::post('vessel_deposits/get_vessel_deposits', 'Vessel_depositsController@getVessel_deposits');
    Route::post('vessel_deposits/get_vessel_deposit', 'Vessel_depositsController@getVessel_depositById');
    Route::post('vessel_deposits/save_vessel_deposits', 'Vessel_depositsController@SaveVessel_deposit');

    Route::post('vessel_bid/get_vessel_bids', 'Vessel_bidsController@getVessel_bids');
    Route::post('vessel_bid/delete_vessel_bid', 'Vessel_bidsController@deleteVessel_bid');
    Route::post('vessel_bid/get_vessel_bid', 'Vessel_bidsController@getVessel_bidById');

    Route::post('potntial_auction/get_potntial_auctions', 'Potntial_auctionController@getPotntial_auctions');
    Route::post('potntial_auction/delete_potntial_auction', 'Potntial_auctionController@deletePotntial_auction');
    Route::post('potntial_auction/get_potntial_auction', 'Potntial_auctionController@getPotntial_auctionById');

    Route::post('home_slider/get_home_sliders', 'Home_SliderController@getHome_Sliders');
    Route::post('home_slider/delete_home_slider', 'Home_SliderController@deleteHome_Slider');
    Route::post('home_slider/get_home_slider', 'Home_SliderController@getHome_SliderById');
    Route::post('home_slider/save_home_slider', 'Home_SliderController@SaveHome_Slider');

    Route::post('about_member/get_about_members', 'About_memberController@getAbout_members');
    Route::post('about_member/delete_about_member', 'About_memberController@deleteAbout_member');
    Route::post('about_member/get_about_member', 'About_memberController@getAbout_memberById');
    Route::post('about_member/save_about_member', 'About_memberController@SaveAbout_member');

    Route::post('contact_form/get_contact_forms', 'Contact_formController@getContact_forms');
    Route::post('contact_form/delete_contact_form', 'Contact_formController@deleteContact_form');
    Route::post('contact_form/get_contact_form', 'Contact_formController@getContact_formById');
    Route::post('contact_form/save_contact_form', 'Contact_formController@SaveContact_form');

    Route::post('latest_news/get_latest_newss', 'Latest_newsController@getLatest_newss');
    Route::post('latest_news/delete_latest_news', 'Latest_newsController@deleteLatest_news');
    Route::post('latest_news/get_latest_news', 'Latest_newsController@getLatest_newsById');
    Route::post('latest_news/save_latest_news', 'Latest_newsController@SaveLatest_news');

    Route::post('cms_page/get_cms_pages', 'CMS_pageController@getCMS_pages');
    Route::post('cms_page/get_cms_page', 'CMS_pageController@getCMS_pageById');
    Route::post('cms_page/save_cms_page', 'CMS_pageController@SaveCMS_page');
    Route::post('cms_page/delete_cms_page', 'CMS_pageController@deleteCMS_page');
    
    
    Route::post('home_testimonial/save_home_testimonial', 'HomeTestimonialController@SaveHomeTestimonial');
    Route::post('home_testimonial/get_home_testimonials', 'HomeTestimonialController@getHomeTestimonial');
    Route::post('home_testimonial/get_home_testimonial', 'HomeTestimonialController@getHomeTestimonialById');
    Route::post('home_testimonial/delete_home_testimonial', 'HomeTestimonialController@deleteHomeTestimonial');
});


