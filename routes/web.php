<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', 'LandingController@index')->name('landing_page');
Route::get('/', function(){return redirect()->route('book=>index');})->name('landing_page');
// Route::get('/test', function (){
//    return view('auth.admin_login');
// });

Auth::routes();
Route::post('/user/logout','Auth\LoginController@userLogout')->name('user.logout');
//Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function (){
    ////////////////////////////////////Login routes for admin/////////////////////////////////////////
    Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
    //----------------------------------------------------------------------------------------------//

    ////////////////////////////////////Register routes for admin/////////////////////////////////////////
    Route::get('/register','Auth\AdminRegisterController@showRegisterForm')->name('admin.register');
    Route::post('/register','Auth\AdminRegisterController@register')->name('admin.register.submit');
    //----------------------------------------------------------------------------------------------//

    ////////////////////////////////////Logout routes for admin/////////////////////////////////////////
    Route::post('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
    //----------------------------------------------------------------------------------------------//

    ////////////////////////////////////---Admin dashboard---/////////////////////////////////////////
    Route::get('/','AdminController@dashboard')->name('admin.dashboard');
    Route::post('/','AdminController@dashboard_post')->name('admin.dashboard.post');
    //----------------------------------------------------------------------------------------------//
    ////////////////////////////////////---Admin profile---///////////////////////////////////////////
    Route::get('/profile','AdminController@profile')->name('admin.profile');
    Route::post('/profile','AdminController@profile_post')->name('admin.profile.post');
    //----------------------------------------------------------------------------------------------//
    ////////////////////////////////////---Admin chat---//////////////////////////////////////////////
    Route::get('/chat','AdminController@chat')->name('admin.chat');
    //----------------------------------------------------------------------------------------------//
    ////////////////////////////////////---Admin settings---//////////////////////////////////////////
    Route::get('/settingsGetFSData','AdminController@settingsGetFSData');
    Route::get('/settings','AdminController@settings')->name('admin.settings');
    Route::post('/settings','AdminController@settings_post')->name('admin.settings_post');
    //----------------------------------------------------------------------------------------------//

    ////////////////////////////////////---Admin employee---//////////////////////////////////////////
    Route::get('/employee','AdminController@employee')->name('admin.employee');
    Route::post('/employee','AdminController@employee_post')->name('admin.employee.post');
    //----------------------------------------------------------------------------------------------//

    ////////////////////////////////////---Admin add books---//////////////////////////////////////////
    Route::get('/add-book','AdminController@add_book')->name('admin.add_book');
    Route::post('/add-book','AdminController@add_book_post')->name('book-upload');
    //----------------------------------------------------------------------------------------------//

    ////////////////////////////////////---All Books---//////////////////////////////////////////
    Route::get('/all-books','AdminController@all_books')->name('admin.all_books');
    Route::post('/all-books','AdminController@all_books_post')->name('admin.all_books.post');
    Route::get('/book/download/qr-code','AdminController@book_download_qr_code2')->name('admin.book.download.qr_code.current');
    Route::get('/book/download/qr-code/{id}','AdminController@book_download_qr_code')->name('admin.book.download.qr_code');
    Route::get('/book/check/{id}','AdminController@book_check')->name('admin.book.check');
    //----------------------------------------------------------------------------------------------//

    ////////////////////////////////////---All EBooks---//////////////////////////////////////////
    Route::get('/all-ebooks','AdminController@all_ebooks')->name('admin.all_ebooks');
    Route::post('/all-ebooks','AdminController@all_ebooks_post')->name('admin.all_ebooks.post');
    //----------------------------------------------------------------------------------------------//

    ////////////////////////////////////---All EBooks---//////////////////////////////////////////
    Route::get('/reports','AdminController@reports')->name('admin.reports');
    Route::post('/reports','AdminController@reports_post')->name('admin.reports.post');
    //----------------------------------------------------------------------------------------------//

    ////////////////////////////////////---Admin employee---//////////////////////////////////////////
    Route::get('/all-orders','AdminController@all_orders')->name('admin.all_orders');
    Route::post('/all-orders','AdminController@all_orders_post')->name('admin.all_orders.post');
    Route::get('/get','AdminController@getData')->name('admin.getData');
    Route::get('/get/users','AdminController@getUsersData')->name('admin.getUsersData');
    //----------------------------------------------------------------------------------------------//

    ///////////////////////////////////---Admin New Users ---/////////////////////////////////////////
    Route::get('/new-users','AdminController@new_users')->name('admin.new_users');
    Route::post('/new-users','AdminController@new_users_post')->name('admin.new_users.post');
    //----------------------------------------------------------------------------------------------//

    ///////////////////////////////////---Admin All Users ---/////////////////////////////////////////
    Route::get('/all-users','AdminController@all_users')->name('admin.all_users');
    Route::post('/all-users','AdminController@all_users_post')->name('admin.all_users.post');
    //----------------------------------------------------------------------------------------------//

    ///////////////////////////////////---Admin Borrowed Users ---/////////////////////////////////////////
    Route::get('/borrowed-users','AdminController@borrowed_users')->name('admin.borrowed_users');
    Route::post('/borrowed-users','AdminController@borrowed_users_post')->name('admin.borrowed_users.post');
    //----------------------------------------------------------------------------------------------//

    ///////////////////////////////////---Admin Borrowed History ---/////////////////////////////////////////
    Route::get('/borrowed-history','AdminController@borrowed_history')->name('admin.borrowed_history');
    Route::post('/borrowed-history','AdminController@borrowed_history_post')->name('admin.borrowed_history.post');
    //----------------------------------------------------------------------------------------------//

    ///////////////////////////////////--- Admin Kundalik ---/////////////////////////////////////////
    Route::get('/kundalik','AdminController@kundalik')->name('admin.kundalik');
    Route::post('/kundalik','AdminController@kundalik_post')->name('admin.kundalik.post');
    //----------------------------------------------------------------------------------------------//

    ///////////////////////////////////---Admin Kiosk ---/////////////////////////////////////////
    Route::get('/infokiosk/index','AdminController@infokiosk_index')->name('admin.infokiosk.index');
    Route::post('/infokiosk/index','AdminController@infokiosk_index_post')->name('admin.infokiosk.index.post');
    //----------------------------------------------------------------------------------------------//
    Route::get('/infokiosk/book-categories','AdminController@infokiosk_books')->name('admin.infokiosk.books');
    Route::post('/infokiosk/book-categories','AdminController@infokiosk_books_post')->name('admin.infokiosk.books.post');
    //----------------------------------------------------------------------------------------------//
    //----------------------------------------------------------------------------------------------//
    Route::get('/infokiosk/book-categories/{cat_id}','AdminController@infokiosk_selected_category')->name('admin.infokiosk.selected_category');
    Route::post('/infokiosk/book-categories/{cat_id}','AdminController@infokiosk_selected_category_post')->name('admin.infokiosk.selected_category.post');
    //----------------------------------------------------------------------------------------------//

    ///////////////////////////////////---Admin Kiosk ---/////////////////////////////////////////

});
Route::prefix('book')->group(function (){
    Route::get('/', 'BookController@index')->name('book=>index');
    Route::post('/', 'BookController@index_post')->name('book=>index.post');
    Route::get('/profile', 'BookController@profile')->name('book=>profile')->middleware('auth');
    Route::post('/profile','BookController@profile_post');
    Route::get('book-download/{id}','BookController@book_download')->name('book-download');
});
