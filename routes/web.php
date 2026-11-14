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

Route::get('/', function () {
    return view('index');
})->name('login');

Route::get('/login', function () {
    return view('index');
})->name('login');

// ADMINISTRATOR MODULE
Route::get('/change_pass_view', function () {
    return view('change_password');
});

Route::get('/user', function () {
    return view('user');
})->name('user');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

// STATUS BOARD CONTENT MODULES
Route::get('/engineering_content', function () {
    return view('engineering_content');
})->name('engineering_content');

Route::get('/qc_content_lot_out_defects', function () {
    return view('qc_content_lot_out_defects');
})->name('qc_content_lot_out_defects');

Route::get('/qc_content_customer_claim', function () {
    return view('qc_content_customer_claim');
})->name('qc_content_customer_claim');

Route::get('/qc_content_list_of_documents', function () {
    return view('qc_content_list_of_documents');
})->name('qc_content_list_of_documents');

Route::get('/production_content_monthly_best_performer', function () {
    return view('production_content_monthly_best_performer');
})->name('production_content_monthly_best_performer');

Route::get('/production_content_prod_line_eff_monitoring', function () {
    return view('production_content_prod_line_eff_monitoring');
})->name('production_content_prod_line_eff_monitoring');

// STATUS BOARD DISPLAY CONTENT MODULES
Route::get('/display_content', function () {
    return view('display_content');
})->name('display_content');

Route::get('/test_display', function () {
    return view('test_display');
})->name('test_display');

// USER CONTROLLER
Route::post('/sign_in', 'UserController@sign_in')->name('sign_in');
Route::post('/sign_out', 'UserController@sign_out')->name('sign_out');
Route::post('/change_pass', 'UserController@change_pass')->name('change_pass');
Route::post('/change_user_stat', 'UserController@change_user_stat')->name('change_user_stat');
Route::get('/view_users', 'UserController@view_users');
Route::post('/add_user', 'UserController@add_user');
Route::get('/get_user_by_id', 'UserController@get_user_by_id');
Route::get('/get_user_list', 'UserController@get_user_list');
Route::get('/get_user_by_batch', 'UserController@get_user_by_batch');
Route::get('/get_user_by_stat', 'UserController@get_user_by_stat');
Route::post('/edit_user', 'UserController@edit_user');
Route::post('/reset_password', 'UserController@reset_password');
Route::get('/generate_user_qrcode', 'UserController@generate_user_qrcode');
Route::post('/import_user', 'UserController@import_user');

//STATUS BOARD CONTROLLER

//Engineering Status Board Content
Route::post('/add_nonconformingproducts', 'NonConformingProductsController@add_nonconformingproducts');
Route::get('/view_nonconformingproducts', 'NonConformingProductsController@view_nonconformingproducts');
Route::get('/get_nonconformingproducts_by_id', 'NonConformingProductsController@get_nonconformingproducts_by_id');
Route::post('/edit_nonconformingproducts', 'NonConformingProductsController@edit_nonconformingproducts');
Route::post('/change_nonconformingproducts_stat', 'NonConformingProductsController@change_nonconformingproducts_stat')->name('change_nonconformingproducts_stat');
Route::get('/get_nonconformingproducts_by_stat', 'NonConformingProductsController@get_nonconformingproducts_by_stat');
Route::post('/change_nonconformingproducts_stat_by_batch', 'NonConformingProductsController@change_nonconformingproducts_stat_by_batch');
Route::post('/import_nonconformingproducts', 'NonConformingProductsController@import_nonconformingproducts');
Route::post('/setinterval_nonconformingproducts', 'NonConformingProductsController@setinterval_nonconformingproducts');

//QC Status Board Content
// Lot-out Defects
Route::get('/view_lotoutdefects', 'LotOutDefectsController@view_lotoutdefects');
Route::post('/add_lotoutdefects', 'LotOutDefectsController@add_lotoutdefects');
Route::get('/get_lotoutdefects_by_id', 'LotOutDefectsController@get_lotoutdefects_by_id');
Route::post('/edit_lotoutdefects', 'LotOutDefectsController@edit_lotoutdefects');
Route::post('/change_lotoutdefects_stat', 'LotOutDefectsController@change_lotoutdefects_stat')->name('change_lotoutdefects_stat');
Route::get('/get_lotoutdefects_by_stat', 'LotOutDefectsController@get_lotoutdefects_by_stat');
Route::post('/change_lotoutdefects_stat_by_batch', 'LotOutDefectsController@change_lotoutdefects_stat_by_batch');
Route::post('/import_lotoutdefects', 'LotOutDefectsController@import_lotoutdefects');
Route::post('/setinterval_lotoutdefects', 'LotOutDefectsController@setinterval_lotoutdefects');

// Customer Claim
Route::get('/view_customerclaim', 'CustomerClaimController@view_customerclaim');
Route::post('/add_customerclaim', 'CustomerClaimController@add_customerclaim');
Route::get('/get_customerclaim_by_id', 'CustomerClaimController@get_customerclaim_by_id');
Route::post('/edit_customerclaim', 'CustomerClaimController@edit_customerclaim');
Route::post('/change_customerclaim_stat', 'CustomerClaimController@change_customerclaim_stat')->name('change_customerclaim_stat');
Route::get('/get_customerclaim_by_stat', 'CustomerClaimController@get_customerclaim_by_stat');
Route::post('/change_customerclaim_stat_by_batch', 'CustomerClaimController@change_customerclaim_stat_by_batch');
Route::post('/import_customerclaim', 'CustomerClaimController@import_customerclaim');
// List of Documents
Route::get('/view_listofdocs', 'ListofDocumentsController@view_listofdocs');
Route::post('/add_listofdocs', 'ListofDocumentsController@add_listofdocs');
Route::get('/get_listofdocs_by_id', 'ListofDocumentsController@get_listofdocs_by_id');
Route::post('/edit_listofdocs', 'ListofDocumentsController@edit_listofdocs');
Route::post('/change_listofdocs_stat', 'ListofDocumentsController@change_listofdocs_stat')->name('change_listofdocs_stat');
Route::get('/get_listofdocs_by_stat', 'ListofDocumentsController@get_listofdocs_by_stat');
Route::post('/change_listofdocs_stat_by_batch', 'ListofDocumentsController@change_listofdocs_stat_by_batch');
Route::post('/import_listofdocs', 'ListofDocumentsController@import_listofdocs');
Route::post('/setinterval_listofdocs', 'ListofDocumentsController@setinterval_listofdocs');

//Production Status Board Content
//Monthly Best Performer
Route::get('/view_monthlybestperformers', 'MonthlyBestPerformerController@view_monthlybestperformers');
Route::post('/add_monthlybestperformers', 'MonthlyBestPerformerController@add_monthlybestperformers');
Route::get('/get_monthlybestperformers_by_id', 'MonthlyBestPerformerController@get_monthlybestperformers_by_id');
Route::post('/edit_monthlybestperformers', 'MonthlyBestPerformerController@edit_monthlybestperformers');
Route::post('/change_monthlybestperformers_stat', 'MonthlyBestPerformerController@change_monthlybestperformers_stat')->name('change_monthlybestperformers_stat');
Route::get('/get_monthlybestperformers_by_stat', 'MonthlyBestPerformerController@get_monthlybestperformers_by_stat');
Route::post('/change_monthlybestperformers_stat_by_batch', 'MonthlyBestPerformerController@change_monthlybestperformers_stat_by_batch');
Route::post('/import_monthlybestperformers', 'MonthlyBestPerformerController@import_monthlybestperformers');
Route::post('/setinterval_monthlybestperformers', 'MonthlyBestPerformerController@setinterval_monthlybestperformers');

//Production Line Efficiency Monitoring
Route::get('/view_prodlineeffmonitoring', 'ProdLineEffMonitoringController@view_prodlineeffmonitoring');
Route::post('/add_prodlineeffmonitoring', 'ProdLineEffMonitoringController@add_prodlineeffmonitoring');
Route::get('/get_prodlineeffmonitoring_by_id', 'ProdLineEffMonitoringController@get_prodlineeffmonitoring_by_id');
Route::post('/edit_prodlineeffmonitoring', 'ProdLineEffMonitoringController@edit_prodlineeffmonitoring');
Route::post('/change_prodlineeffmonitoring_stat', 'ProdLineEffMonitoringController@change_prodlineeffmonitoring_stat')->name('change_prodlineeffmonitoring_stat');
Route::get('/get_prodlineeffmonitoring_by_stat', 'ProdLineEffMonitoringController@get_prodlineeffmonitoring_by_stat');
Route::post('/change_prodlineeffmonitoring_stat_by_batch', 'ProdLineEffMonitoringController@change_prodlineeffmonitoring_stat_by_batch');
Route::post('/import_prodlineeffmonitoring', 'ProdLineEffMonitoringController@import_prodlineeffmonitoring');
Route::post('/setinterval_prodlineeffmonitoring', 'ProdLineEffMonitoringController@setinterval_prodlineeffmonitoring');

//STATUS BOARD DISPLAY CONTROLLER
Route::get('/display_engg_content', 'DisplayController@display_enggcontent');
Route::get('/display_qc_content_lotoutdefects', 'DisplayController@display_qccontent_lotoutdefects');
Route::get('/display_qc_content_customerclaim', 'DisplayController@display_qccontent_customerclaim');
Route::get('/display_qc_content_listofdocuments', 'DisplayController@display_qccontent_listofdocuments');
Route::get('/display_prodcontent_monthlybestperformers', 'DisplayController@display_prodcontent_monthlybestperformers');
Route::get('/display_prodcontent_prodlineeffmonitoring', 'DisplayController@display_prodcontent_prodlineeffmonitoring');
// USER LEVEL CONTROLLER
Route::get('/get_user_levels', 'UserLevelController@get_user_levels');
// USER CLASSIFICATION CONTROLLER
Route::get('/get_user_classifications', 'UserClassificationController@get_user_classifications');
