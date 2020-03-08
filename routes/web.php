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

Route::group(['middleware' => ['install']], function () {
Route::get('/', function () {
    // return redirect()->route('login');
	return view('welcome');
});

Auth::routes();
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
	//ui:::::::::::::::::::
		 Route::get('/profile', 'UiController@index')->name('profile');
		 Route::post('/profile', 'UiController@postprofile')->name('postprofile');
		 Route::post('/password', 'UiController@password_change')->name('password');

		/*::::::::::::::Employee Section:::::::::*/
		Route::get('employee/department', 'Configuration\Employee\EmployeeController@Department_index')->name('employee.department.index');
		Route::get('employee/department/datatable', 'Configuration\Employee\EmployeeController@Department_datatable')->name('employee.department.datatable');
		Route::get('employee/department/create', 'Configuration\Employee\EmployeeController@Department_create')->name('employee.department.create');
		Route::any('employee/department/store', 'Configuration\Employee\EmployeeController@Department_store')->name('employee.department.store');
		Route::get('employee/department/edit/{id?}', 'Configuration\Employee\EmployeeController@Department_edit')->name('employee.department.edit');
		Route::any('employee/department/update/{id}', 'Configuration\Employee\EmployeeController@Department_update')->name('employee.department.update');
		Route::delete('/employee/department/delete/{id}', 'Configuration\Employee\EmployeeController@Department_delete')->name('employee.department.delete');
		//:::::::::::::::::::::::::::::Employee Document Type::::::::::::::::::::::::::::::::::::
		Route::get('employee/document/datatable', 'Configuration\Employee\EmployeeDocumentTypeController@datatable')->name('document.datatable');
		Route::resource('employee-document-type', 'Configuration\Employee\EmployeeDocumentTypeController');

		//:::::::::::::::::::::::::::::Employee Category::::::::::::::::::::::::::::::::::::
		Route::get('employee-category-datatable', 'Configuration\Employee\EmployeeCategoryController@datatable')->name('category.datatable');
		Route::resource('employee-category', 'Configuration\Employee\EmployeeCategoryController');

		//:::::::::::::::::::::::::::::Employee leave type:::::::::::::::::::::::::::::::
		Route::get('employee-leave-type-datatable', 'Configuration\Employee\EmployeeLeaveTypeController@datatable')->name('leave_type.datatable');
		Route::resource('employee-leave-type', 'Configuration\Employee\EmployeeLeaveTypeController');

		//:::::::::::::::::::::::::::::Employee leave Allocation:::::::::::::::::::::::::::::::
		Route::get('employee-leave', 'Configuration\Employee\EmployeeLeaveTypeController@view')->name('employee-leave.view');
		Route::get('employee-leave-allocation-datatable', 'Configuration\Employee\EmployeeLeaveAllocationController@datatable')->name('leave_allocation.datatable');
		Route::resource('employee-leave-allocation', 'Configuration\Employee\EmployeeLeaveAllocationController');

		//:::::::::::::::::::::::::::::Employee leave Request:::::::::::::::::::::::::::::::
		Route::get('employee-leave-request-datatable', 'Configuration\Employee\EmployeeLeaveRequestController@datatable')->name('leave_request.datatable');
		Route::post('employee-leave-request-details', 'Configuration\Employee\EmployeeLeaveRequestController@details')->name('employee-leave-request.details');
		Route::resource('employee-leave-request', 'Configuration\Employee\EmployeeLeaveRequestController');

		//:::::::::::::::::::::: Employee Pay Head ::::::::::::::::::::::::::::::
		Route::get('employee-pay-head-datatable', 'Configuration\Employee\EmployeePayHeadController@datatable')->name('pay_head.datatable');
		Route::resource('employee-pay-head', 'Configuration\Employee\EmployeePayHeadController');

		//:::::::::::::::::::::: Employee Pay Roll ::::::::::::::::::::::::::::::
		Route::get('payroll', 'Configuration\Employee\EmployeePayRollTemplateController@view')->name('payroll.view');
		Route::get('payroll-template-datatable', 'Configuration\Employee\EmployeePayRollTemplateController@datatable')->name('payroll-template.datatable');
		Route::resource('payroll-template', 'Configuration\Employee\EmployeePayRollTemplateController');
			// employee_salary_structure
			Route::resource('payroll-s-structure', 'Configuration\Employee\EmployeeSalaryStructureController');
			Route::post('employee-s-structure.ajax', 'Configuration\Employee\EmployeeSalaryStructureController@ajaxcall')->name('employee-s-structure.ajax');
			Route::get('employee-s-structure-datatable', 'Configuration\Employee\EmployeeSalaryStructureController@datatable')->name('employee-s-structure.datatable');

		//:::::::::::::::::::::::::::::Designation::::::::::::::::::::::::::
		Route::get('designation-datatable', 'Configuration\Employee\DesignationController@datatable')->name('designation.datatable');
		Route::resource('employee/designation', 'Configuration\Employee\DesignationController');

		//:::::::::::::::::::::::::::::Employee Attendance Type:::::::::::::::::::::::::::::::::
		Route::get('employee-attendance-type-datatable', 'Configuration\Employee\EmployeeAttendanceTypeController@datatable')->name('attendance-type.datatable');
		Route::resource('employee-attendance-type', 'Configuration\Employee\EmployeeAttendanceTypeController');

		//:::::::::::::::::::::::::::::Employee List::::::::::::::::::::::::::::::::::::
		Route::get('employee-list-datatable', 'Configuration\Employee\EmployeeListController@datatable')->name('list.datatable');
		Route::resource('employee-list', 'Configuration\Employee\EmployeeListController');
		Route::post('admin/employee-list/basic_info', 'Configuration\Employee\EmployeeListController@Store_Basic_Info')->name('employee-list.basic_info');
		Route::post('admin/employee-list/contact_info', 'Configuration\Employee\EmployeeListController@Store_Contact_Info')->name('employee-list.contact_info');
		Route::any('employee-list/Image_Upload/{id}', 'Configuration\Employee\EmployeeListController@Image_Upload')->name('employee-list.Image_Upload');

		// Route for Employee Basic Info
			Route::get('/ajax/basic_info', 'Configuration\Employee\EmployeeListController@basic_info')->name('ajax.basic_info');
			Route::post('/employee/basic_info/update', 'Configuration\Employee\EmployeeListController@update_basic_info')->name('employee.basic_info.update');

		// Route for Employee Contact Info
			Route::get('/ajax/contact_info', 'Configuration\Employee\EmployeeListController@contact_info')->name('ajax.contact_info');
			Route::post('/employee/contact_info/update', 'Configuration\Employee\EmployeeListController@update_contact_info')->name('employee.contact_info.update');

		//  Route for Employee Document Info
			Route::get('/ajax/document_info', 'Employee\DocumentController@document_info')->name('ajax.document_info');
			// Route::resource('/employee-document/{id}', 'Employee\DocumentController');
			Route::get('/employee-document/create/{id}', 'Employee\DocumentController@create')->name('employee-document.create');
			Route::post('/employee-document/store', 'Employee\DocumentController@store')->name('employee-document.store');
			Route::get('/employee-document/show/{id}', 'Employee\DocumentController@show')->name('employee-document.show');
			Route::get('/employee-document/edit/{id}', 'Employee\DocumentController@edit')->name('employee-document.edit');
			Route::patch('/employee-document/update/{id}', 'Employee\DocumentController@update')->name('employee-document.update');
			Route::delete('/employee-document/destroy/{id}', 'Employee\DocumentController@destroy')->name('employee-document.destroy');
		// Route for Employee Account Info
			Route::get('/ajax/qua_info', 'Employee\QualificationController@qua_info')->name('ajax.qua_info');
			Route::get('/employee-qua/create/{id}', 'Employee\QualificationController@create')->name('employee-qua.create');
			Route::post('/employee-qua/store', 'Employee\QualificationController@store')->name('employee-qua.store');
			Route::get('/employee-qua/show/{id}', 'Employee\QualificationController@show')->name('employee-qua.show');
			Route::get('/employee-qua/edit/{id}', 'Employee\QualificationController@edit')->name('employee-qua.edit');
			Route::patch('/employee-qua/update/{id}', 'Employee\QualificationController@update')->name('employee-qua.update');
			Route::delete('/employee-qua/destroy/{id}', 'Employee\QualificationController@destroy')->name('employee-qua.destroy');
			
		// Route for Employee Account Info
			Route::get('/ajax/account_info', 'Employee\AccountController@account_info')->name('ajax.account_info');
			Route::get('/ajax/account/info/{id}', 'Employee\AccountController@create')->name('account.create');
			Route::post('/ajax/account/info/store/{id}', 'Employee\AccountController@store')->name('account.store');
			Route::delete('/ajax/account/info/destroy/{id}', 'Employee\AccountController@destroy')->name('account.destroy');
			Route::get('/ajax/account/info/edit/{id}', 'Employee\AccountController@edit')->name('account.edit');
			Route::get('/ajax/account/info/show/{id}', 'Employee\AccountController@show')->name('account.show');
			Route::patch('/ajax/account/info/update/{id}', 'Employee\AccountController@update')->name('account.update');

		// Route for Employee Designation Info
			Route::get('/ajax/desig_info', 'Employee\DesignationController@desig_info')->name('ajax.desig_info');
			
			// Route for Employee Designation add for
				Route::get('/designation_history/add', 'Employee\DesignationController@add_desig')->name('designation.add');
			Route::get('/designation_history/desig_info', 'Employee\DesignationController@desig_info')->name('ajax.desig_info');

		// Route for Employee Designation add for
			Route::get('/designation_history/add/{id}', 'Employee\DesignationController@add_desig')->name('designation.add');

		// Route for Employee  Designation Insert
			Route::post('/designation_history/store/', 'Employee\DesignationController@store')->name('designation.store_designation');

		// Route for Employee  Designation show
			Route::get('/designation_history/show/{id}', 'Employee\DesignationController@show')->name('designation.show_designation');

		// Route for Employee  Designation edit
			Route::get('/designation_history/edit/{id}', 'Employee\DesignationController@edit')->name('designation.edit_designation');

		// Route for Employee  Designation delete
			Route::delete('/designation_history/{id}', 'Employee\DesignationController@destroy')->name('designation.delete_designation');

		// Route for Employee  Designation update
			Route::patch('/designation_history/update/{id}', 'Employee\DesignationController@update')->name('designation.update_designation');

		// Route for Employee Term History
			Route::get('/term_history/term_info', 'Employee\TermController@term_info')->name('term_info');


		// Route for Employee  term show
			Route::get('/term_history/show/{id}', 'Employee\TermController@show')->name('term.show_term');

		// Route for Employee  term edit
			Route::get('/term_history/edit/{id}', 'Employee\TermController@edit')->name('term.edit_term');
			Route::patch('/term_history/update_term/{id}', 'Employee\TermController@update')->name('term.update_term');

		// Route for Employee  term edit
			Route::delete('/term_history/{id}', 'Employee\TermController@destroy')->name('term.delete_term');

		// Route for Employee  term update
			Route::patch('/term_history/update/{id}', 'Employee\TermController@update')->name('term.update_term');


		// Route for Employee Login Info
			Route::get('/ajax/login_info', 'UserController@login_info')->name('ajax.login_info');
			Route::any('/employee-details/login_info/{id}', 'UserController@set_login_info')->name('employee-details.login_info');


		// Production Route Start

		// Production Category Route
			// Route::get('production-category-datatable', 'Production\CategoryController@datatable')->name('category.datatable');
			// select2 ajax
			Route::get('people/get_people', 'Production\CategoryController@getCatagory')->name('people/get_people');
			Route::get('remort/production/category','Production\CategoryController@remort_add')->name('remort_production_category');
			Route::post('remort/production/category','Production\CategoryController@remort_addCategory')->name('remort_production_category_post');
			Route::resource('production-category', 'Production\CategoryController');

			// Production Brand Route
			Route::get('production-brands/datatable', 'Production\BrandsController@datatable')->name('brands.datatable');
			Route::get('remort/brandmodal','Production\BrandsController@remort_modal')->name('remort_brand_modal');
			Route::post('remort/brandmodal','Production\BrandsController@addremort_modal')->name('addremort_brand_modal');
			Route::get('brand/mail/{id}','Production\BrandsController@email')->name('brand.mail');
			Route::get('brand/sms/{id}','Production\BrandsController@sms')->name('brand.sms');
			Route::resource('production-brands', 'Production\BrandsController');

			//Production Unit Route
			Route::get('production-unit/datatable', 'Production\UnitController@datatable')->name('unit.datatable');
			Route::get('remort/unitmodal','Production\UnitController@remort_modal')->name('remort_unit_modal');
			Route::post('remort/unitmodal','Production\UnitController@addremort_modal')->name('addremort_unit_modal');
			Route::resource('production-unit', 'Production\UnitController');

			// Production Ingredients Category Route
			Route::get('production-ingredients-category/datatable', 'Production\IngredientsController@datatable')->name('ingredients-category.datatable');
			Route::resource('production-ingredients-category', 'Production\IngredientsController');

			//production-raw-materials
			Route::get('production-raw-materials/datatable', 'Production\RawMaterialsController@datatable')->name('raw-materials.datatable');
			Route::get('remort/row-material','Production\RawMaterialsController@remort_material')->name('remort_material');
			Route::post('remort/row-material','Production\RawMaterialsController@addremort_material')->name('addremort_material');
			Route::resource('production-raw-materials', 'Production\RawMaterialsController');

			//production-work-order
			Route::get('production-work-order/datatable', 'Production\WorkOrderController@datatable')->name('work-order.datatable');
			Route::get('production-work-order/item', 'Production\WorkOrderController@item')->name('production-work-order.item');
			Route::get('product/get_product', 'Production\WorkOrderController@getProduct');
			Route::get('production-work-order/append', 'Production\WorkOrderController@append');
			Route::resource('production-work-order', 'Production\WorkOrderController');

			// Production Variation Route
			Route::get('ajax_get_before_data', function() {
				$row = request()->i;
				$id = request()->data_load_template_id;
				dd($id);
				return view('admin.production.variation.show', compact('row'));
			})->name('ajax_get_before_data');
			Route::get('production-variation/addmore',function(){
				$row = request()->row;
				return view('admin.production.variation.add', compact('row'));
			})->name('production-variation.addmore');
			Route::get('production-variation-datatable', 'Production\VariationController@datatable')->name('production-variation.datatable');
			Route::resource('production-variation', 'Production\VariationController');

		// Production Product Route
			Route::get('get-unit-of-product/{id}', 'Production\ProductController@get_product');
			Route::get('production-product/product-add', 'Production\ProductController@product_add')->name('production-product.product_add');
			Route::get('production-product-datatable', 'Production\ProductController@datatable')->name('product.datatable');
			Route::get('production-product/category', 'Production\ProductController@category')->name('production-product.category');
			Route::resource('production-product', 'Production\ProductController');


		// Production wop-materials Route
			Route::get('production-wop-materials/datatable', 'Production\WopMaterialController@datatable')->name('wop-materials.datatable');
			Route::get('production-wop-materials/product', 'Production\WopMaterialController@product')->name('wop-materials.product');
			Route::resource('production-wop-materials', 'Production\WopMaterialController');

		// Production Purchase Route
			Route::get('production-purchase/datatable', 'Production\PurchaseController@datatable')->name('purchase.datatable');
			Route::get('production-purchase/product', 'Production\PurchaseController@product')->name('purchase.product');
			Route::get('production-purchase/material', 'Production\PurchaseController@material')->name('purchase.material');
			Route::get('production-purchase/raw_material', 'Production\PurchaseController@rawMaterial')->name('purchase.raw_material');
			Route::get('get_raw_material', 'Production\PurchaseController@get_raw_material')->name('get_raw_material');
			Route::get('get_product', 'Production\PurchaseController@getProduct')->name('get_product');
			Route::get('get_employee', 'Production\PurchaseController@getEmployee')->name('get_employee');
			Route::get('get_work_order', 'Production\PurchaseController@WorkOrder')->name('get_work_order');
			Route::get('production-purchase/request', 'Production\PurchaseController@request')->name('production-purchase.request');
			Route::get('production-purchase/details/{id}', 'Production\PurchaseController@details')->name('production-purchase.details');
			Route::get('production-purchase/payment/{id}', 'Production\PurchaseController@payment')->name('production-purchase.payment');
			Route::patch('production-purchase/add_payment/{id}', 'Production\PurchaseController@add_payment')->name('production-purchase.add_payment');
			Route::resource('production-purchase', 'Production\PurchaseController');
			// Client:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
			Route::get('client-datatable', 'ClientController@datatable')->name('client.datatable');
			Route::get('client/mail/{id}','ClientController@email')->name('client.mail');
			Route::get('client/sms/{id}','ClientController@sms')->name('client.sms');
			Route::resource('client', 'ClientController');

		// Production Route End

		//:::::::::::::::::::::::::::::Employee Payhead::::::::::::::::::::::::::::::::::::
		// Route::resource('employee-payhead', 'Configuration\Employee\EmployeePayHeadController');

		//  ::::::::::::::::::::::::::::: Member Setting :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		Route::get('setting/member-setting', 'Configuration\Member\MemberSettingDashboardController@index')->name('member-setting');

			// Member Setting Nationality :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
			Route::get('setting/member-setting/nationality', 'Configuration\Member\Member_Nationality_Setting_Controller@index')->name('setting.member-setting.nationality');
			Route::get('setting/member-setting/nationality-datatable', 'Configuration\Member\Member_Nationality_Setting_Controller@datatable')->name('setting.member-setting.nationality.datatable');
			Route::get('setting/member-setting/nationality/create', 'Configuration\Member\Member_Nationality_Setting_Controller@create')->name('setting.member-setting.nationality.create');
			Route::post('setting/member-setting/nationality/store', 'Configuration\Member\Member_Nationality_Setting_Controller@store')->name('setting.member-setting.nationality.store');
			Route::get('setting/member-setting/nationality/edit/{id}', 'Configuration\Member\Member_Nationality_Setting_Controller@edit')->name('setting.member-setting.nationality.edit');
			Route::patch('setting/member-setting/nationality/update/{id}', 'Configuration\Member\Member_Nationality_Setting_Controller@update')->name('setting.member-setting.nationality.update');
			Route::delete('setting/member-setting/nationality/destroy/{id}', 'Configuration\Member\Member_Nationality_Setting_Controller@destroy')->name('setting.member-setting.nationality.destroy');

			// Member Setting Religious :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
			Route::get('setting/member-setting/religious', 'Configuration\Member\Member_Religious_Setting_Controller@index')->name('setting.member-setting.religious');
			Route::get('setting/member-setting/religious-datatable', 'Configuration\Member\Member_Religious_Setting_Controller@datatable')->name('setting.member-setting.religious.datatable');
			Route::get('setting/member-setting/religious/create', 'Configuration\Member\Member_Religious_Setting_Controller@create')->name('setting.member-setting.religious.create');
			Route::post('setting/member-setting/religious/store', 'Configuration\Member\Member_Religious_Setting_Controller@store')->name('setting.member-setting.religious.store');
			Route::get('setting/member-setting/religious/edit/{id}', 'Configuration\Member\Member_Religious_Setting_Controller@edit')->name('setting.member-setting.religious.edit');
			Route::patch('setting/member-setting/religious/update/{id}', 'Configuration\Member\Member_Religious_Setting_Controller@update')->name('setting.member-setting.religious.update');
			Route::delete('setting/member-setting/religious/destroy/{id}', 'Configuration\Member\Member_Religious_Setting_Controller@destroy')->name('setting.member-setting.religious.destroy');

			// Member Setting Occupation :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
			Route::get('setting/member-setting/occupation', 'Configuration\Member\Member_Occupation_Setting_Controller@index')->name('setting.member-setting.occupation');
			Route::get('setting/member-setting/occupation-datatable', 'Configuration\Member\Member_Occupation_Setting_Controller@datatable')->name('setting.member-setting.occupation.datatable');
			Route::get('setting/member-setting/occupation/create', 'Configuration\Member\Member_Occupation_Setting_Controller@create')->name('setting.member-setting.occupation.create');
			Route::post('setting/member-setting/occupation/store', 'Configuration\Member\Member_Occupation_Setting_Controller@store')->name('setting.member-setting.occupation.store');
			Route::get('setting/member-setting/occupation/edit/{id}', 'Configuration\Member\Member_Occupation_Setting_Controller@edit')->name('setting.member-setting.occupation.edit');
			Route::patch('setting/member-setting/occupation/update/{id}', 'Configuration\Member\Member_Occupation_Setting_Controller@update')->name('setting.member-setting.occupation.update');
			Route::delete('setting/member-setting/occupation/destroy/{id}', 'Configuration\Member\Member_Occupation_Setting_Controller@destroy')->name('setting.member-setting.occupation.destroy');

		/*::::::::::::::Member List Section:::::::::*/
		Route::resource('member-list', 'Configuration\Member\MemberController');


		
		// Employee Section End


		// Employee Id Card Section

		Route::get('setting/id-card-template', 'IdCardController@index')->name('id-card-template');
		Route::get('/employee-id-card/', 'IdCardController@id_card')->name('employee-id-card.id_card');
		Route::post('/employee-id-card/show', 'IdCardController@show')->name('employee-id-card.show');

		Route::get('setting/id-card-template/create', 'IdCardController@create')->name('id-card-template.create');
		Route::post('setting/id-card-template/store', 'IdCardController@store')->name('id-card-template.store');
		Route::any('setting/id-card-template/datatable', 'IdCardController@datatable')->name('id-card-template.datatable');
		Route::get('setting/id-card-template/edit/{id}', 'IdCardController@edit')->name('id-card-template.edit');
		Route::patch('setting/id-card-template/update/{id}', 'IdCardController@update')->name('id-card-template.update');
		Route::delete('setting/id-card-template/destroy/{id}', 'IdCardController@destroy')->name('id-card-template.destroy');


		 Route::any('setting/general-setting','SettingController@index')->name('setting');
		 Route::any('setting/system-setting','SettingController@SystemConfiguration')->name('system.setting');
		 Route::any('setting/mail-setting','SettingController@MainConfiguration')->name('mail.setting');
		 Route::any('setting/sms-setting','SettingController@SmsConfiguration')->name('sms.setting');
		 Route::any('setting/module-setting','SettingController@ModudelConfiguraion')->name('module.setting');
		 Route::get('backup','SettingController@getBackup')->name('backup');
		 Route::get('language','LanguageController@index')->name('language');
		 Route::match(['get', 'post'], 'create', 'LanguageController@create')->name('language.create');

		 Route::get('language/edit/{id?}', 'LanguageController@edit')->name('language.edit');
		 Route::patch('language/update/{id}', 'LanguageController@update')->name('language.update');
		 Route::delete('/language/delete/{id}', 'LanguageController@delete')->name('language.delete');

    Route::group(['as' => 'expense.','prefix' => 'expense','namespace' => 'expense'], function () {

    	Route::get('category/datatable','ExpenseCategoryController@datatable')->name('category.datatable');
    	Route::resource('category', 'ExpenseCategoryController');
    	Route::get('datatable','ExpenseController@datatable')->name('datatable');
    	Route::resource('ex', 'ExpenseController');
	});
  //Email Marketing::::::::::::::::
	Route::group(['as' => 'emailmarketing.','prefix' => 'emailmarketing','namespace' => 'marketing'], function () {

    	Route::get('template/datatable','EmailTemplateController@datatable')->name('template.datatable');
    	Route::resource('template', 'EmailTemplateController');
    	Route::get('media/datatable','EmailMediaController@datatable')->name('media.datatable');
    	Route::get('media/import','EmailMediaController@import_media');
    	Route::resource('media', 'EmailMediaController');
    	Route::get('get_emails/{type}','SendMailController@get_emails');
    	Route::get('get_emails_list/{type}','SendMailController@get_emails_list');
    	Route::get('email-history/datatable','SendMailController@history_table')->name('email_history_datable');
    	Route::get('email-history','SendMailController@history')->name('email_history');
    	Route::get('email-history/{id}','SendMailController@history_view')->name('email_history_view');
    	Route::post('client-send-mail','SendMailController@client_send_mail')->name('client_send_mail');
    	Route::resource('sendmail', 'SendMailController');
	});

	//Sms Marketing:::::::::::::::::::
	Route::group(['as' => 'smsmerketing.','prefix' => 'smsmerketing','namespace' => 'marketing'], function () {
		Route::get('get_number/{type}','SendSmsController@get_number');
    	Route::get('get_number_list/{type}','SendSmsController@get_number_list');
    	Route::get('sms-history/datatable','SendSmsController@history_table')->name('sms_history_datatable');
    	Route::get('sms-history','SendSmsController@history')->name('sms_history');
    		Route::post('client-send-sms','SendSmsController@client_send_sms')->name('client_send_sms');
		Route::resource('sendsms', 'SendSmsController');

	});

		/*::::::::::::::Depertment:::::::::*/
		Route::get('department/datatable', 'DepertmentController@datatable')->name('department.datatable');
		Route::get('depertment/employee/{id}','DepertmentController@new_employee')->name('depertment_new_employee');
		Route::post('depertment/newemployee','DepertmentController@new_employee_add')->name('depertment_new_employee_add');
		Route::delete('depertment/employee/delete/{id}', 'DepertmentController@employee_destroy')->name('depertment.employee.delete');
		Route::get('depertment/category/{id}','DepertmentController@new_category')->name('depertment_new_category');
		Route::post('depertment/newcategory','DepertmentController@new_category_add')->name('depertment_new_category_add');
		Route::delete('depertment/category/delete/{id}', 'DepertmentController@category_destroy')->name('depertment.category.delete');
		Route::get('depertment/approve/request/{id}','DepertmentController@approve_request')->name('department.approve_request');
		Route::resource('department', 'DepertmentController');
		//Store Request:::::::::::::::::::::::::::::::
		Route::get('request/department/{id}','StoreRequestController@request')->name('request.department');
		Route::get('request/department/store/{type}/{id}','StoreRequestController@request_form')->name('store_request.department');
		Route::get('get_product_request', 'StoreRequestController@get_requestProduct')->name('get_product_request');
	    Route::get('get_work_order_request', 'StoreRequestController@WorkOrder_request')->name('get_work_order_request');
	    Route::get('get_row_material_request', 'StoreRequestController@get_row_material_request')->name('get_row_material_request');
	    Route::get('request/product/append', 'StoreRequestController@product_append')->name('request.product_append');
		Route::get('request/material/append', 'StoreRequestController@material_append')->name('request.material_append');
		Route::get('request/row/material/append', 'StoreRequestController@row_material_append')->name('request.row_material_append');
		Route::get('request/datatable', 'StoreRequestController@datatable')->name('request.datatable');
		Route::get('request/get_prev_request','StoreRequestController@get_prev_request')->name('request.get_reques_prev');
		Route::get('depertment/flow/{id}','StoreRequestController@depertmentflow')->name('department.flow');
		Route::delete('mainrequest/destroy/{id}','StoreRequestController@request_destroy')->name('mainrequest.destroy');
		Route::resource('request', 'StoreRequestController');


	 		/*::::::::::::::user role Permission:::::::::*/
	 Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
			Route::get('/role', 'RoleController@index')->name('role');
			Route::get('/role/datatable', 'RoleController@datatable')->name('role.datatable');
			Route::any('/role/create', 'RoleController@create')->name('role.create');
			Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
			Route::post('/role/edit', 'RoleController@update')->name('role.update');
			Route::delete('/role/delete/{id}', 'RoleController@distroy')->name('role.delete');
			//user:::::::::::::::::::::::::::::::::
			Route::get('/', 'UserController@index')->name('index');
			Route::get('/datatable', 'UserController@datatable')->name('datatable');
			Route::any('/create', 'UserController@create')->name('create');
			Route::put('/change/{value}/{id}', 'UserController@status')->name('change');
			Route::get('/edit/{id}', 'UserController@edit')->name('edit');
			Route::put('/edit', 'UserController@update')->name('update');
			Route::delete('/delete/{id}', 'UserController@destroy')->name('delete');
		});

	});

Route::get('/home', 'HomeController@index')->name('home');
});


Route::get('/contact_form_submit', 'Frontend/Front_End_Controller@contact_form_submit')->name('contact_form_submit');

Route::get('/installs', 'Install\InstallController@index');
Route::get('install/database', 'Install\InstallController@database');
Route::post('install/process_install', 'Install\InstallController@process_install');
Route::get('install/create_user', 'Install\InstallController@create_user');
Route::post('install/store_user', 'Install\InstallController@store_user');
Route::get('install/system_settings', 'Install\InstallController@system_settings');
Route::post('install/finish', 'Install\InstallController@final_touch');	
