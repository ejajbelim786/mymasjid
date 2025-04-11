<?php

use Illuminate\Support\Facades\Route;

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
        return redirect('login');
    });

    Auth::routes(['verify' => true]);
    Route::get('/logout', 'Auth\LoginController@logout');

    Route::group(['middleware' => ['auth', 'verified']], function () {

        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        //Profile Controller
        Route::get('profile', 'ProfileController@index')->name('profile.index');
        Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
        Route::post('profile/update', 'ProfileController@update')->name('profile.update')->middleware('demo');
        Route::get('profile/change_password', 'ProfileController@change_password')->name('profile.change_password');
        Route::post('profile/update_password', 'ProfileController@update_password')->name('profile.update_password')->middleware('demo');

        /** Admin Only Route **/
        Route::group(['middleware' => ['admin', 'demo'], 'prefix' => 'admin'], function () {

            //User Management
            Route::resource('users', 'UserController');

			//Payment History
            Route::get('membership_payments', 'UserController@membership_payments')->name('users.membership_payments');

            //Language Controller
            Route::resource('languages', 'LanguageController');

            //Utility Controller
            Route::match(['get', 'post'], 'administration/general_settings/{store?}', 'UtilityController@settings')->name('settings.update_settings');
            Route::post('administration/upload_logo', 'UtilityController@upload_logo')->name('settings.uplaod_logo');
            Route::get('administration/database_backup_list', 'UtilityController@database_backup_list')->name('database_backups.list');
            Route::get('administration/create_database_backup', 'UtilityController@create_database_backup')->name('database_backups.create');
            Route::delete('administration/destroy_database_backup/{id}', 'UtilityController@destroy_database_backup');
            Route::get('administration/download_database_backup/{id}', 'UtilityController@download_database_backup')->name('database_backups.download');
            Route::post('administration/remove_cache', 'UtilityController@remove_cache')->name('settings.remove_cache');

            //Email Template
            Route::resource('email_templates', 'EmailTemplateController')->only([
                'index', 'create', 'store', 'show', 'edit', 'update', 'destroy',
            ]);

        });

        /** Dynamic Permission **/
        Route::group(['middleware' => ['company']], function () {

			//Dashboard Permissions
			Route::get('dashboard/current_day_income', 'DashboardController@current_day_income')->name('dashboard.current_day_income');
			Route::get('dashboard/current_day_expense', 'DashboardController@current_day_expense')->name('dashboard.current_day_expense');
			Route::get('dashboard/current_month_income', 'DashboardController@current_month_income')->name('dashboard.current_month_income');
			Route::get('dashboard/current_month_expense', 'DashboardController@current_month_expense')->name('dashboard.current_month_expense');
			Route::get('dashboard/yearly_income_vs_expense', 'DashboardController@yearly_income_vs_expense')->name('dashboard.yearly_income_vs_expense');
			Route::get('dashboard/latest_income', 'DashboardController@latest_income')->name('dashboard.latest_income');
			Route::get('dashboard/latest_expense', 'DashboardController@latest_expense')->name('dashboard.latest_expense');
			Route::get('dashboard/monthly_income_vs_expense', 'DashboardController@monthly_income_vs_expense')->name('dashboard.monthly_income_vs_expense');
			Route::get('dashboard/financial_account_balance', 'DashboardController@financial_account_balance')->name('dashboard.financial_account_balance');

            //Contact Group
			Route::resource('contact_groups','ContactGroupController');
		     
			//Contact Controller
			Route::get('contacts/get_table_data','ContactController@get_table_data');
			Route::post('contacts/send_email/{id}','ContactController@send_email')->name('contacts.send_email');
			Route::resource('contacts','ContactController');

			//Account Controller
			Route::resource('accounts','AccountController');
			
			//Income Controller
			Route::get('income/get_table_data','IncomeController@get_table_data');
			Route::get('income/calendar','IncomeController@calendar')->name('income.income_calendar');
			Route::resource('income','IncomeController');
			
			//Expense Controller
			Route::get('expense/get_table_data','ExpenseController@get_table_data');
			Route::get('expense/calendar','ExpenseController@calendar')->name('expense.expense_calendar');
			Route::resource('expense','ExpenseController');
			
			//Transfer Controller
			Route::get('transfer/create', 'TransferController@create')->name('transfer.create');
			Route::post('transfer/store', 'TransferController@store')->name('transfer.store');
			
			//Repeating Income
			Route::get('repeating_income/get_table_data','RepeatingIncomeController@get_table_data');
			Route::resource('repeating_income','RepeatingIncomeController');
			
			//Repeating Expense
			Route::get('repeating_expense/get_table_data','RepeatingExpenseController@get_table_data');
			Route::resource('repeating_expense','RepeatingExpenseController');

			//Chart Of Accounts
			Route::resource('chart_of_accounts','ChartOfAccountController')->except('show');

			//Payment Method
			Route::resource('payment_methods','PaymentMethodController')->except('show');
					
			//Supplier Controller
			Route::resource('suppliers','SupplierController');

			//Product Controller
			Route::get('products/get_product/{id}','ProductController@get_product');
			Route::resource('products','ProductController');

			//Product Controller
			Route::resource('services','ServiceController');

			//Purchase Order
			Route::match(['get', 'post'],'purchase_orders/store_payment/{id?}','PurchaseController@store_payment')->name('purchase_orders.create_payment');
			Route::get('purchase_orders/view_payment/{id}','PurchaseController@view_payment')->name('purchase_orders.view_payment');
			Route::get('purchase_orders/download_pdf/{id}','PurchaseController@download_pdf')->name('purchase_orders.download_pdf');
			Route::post('purchase_orders/get_table_data','PurchaseController@get_table_data');
			Route::resource('purchase_orders','PurchaseController');

			//Purchase Return
			Route::get('purchase_returns/get_table_data','PurchaseReturnController@get_table_data');
			Route::resource('purchase_returns','PurchaseReturnController');
			
			//Sales Return
			Route::get('sales_returns/get_table_data','SalesReturnController@get_table_data');
			Route::resource('sales_returns','SalesReturnController');
						
			//Invoice Controller
			Route::get('invoices/download_pdf/{id}','InvoiceController@download_pdf')->name('invoices.download_pdf');
			Route::match(['get', 'post'],'invoices/store_payment/{invoice_id?}','InvoiceController@store_payment')->name('invoices.create_payment');
			Route::get('invoices/view_payment/{id}','InvoiceController@view_payment')->name('invoices.view_payment');
			Route::match(['get', 'post'],'invoices/send_email/{invoice_id?}','InvoiceController@send_email')->name('invoices.send_email');			
			Route::post('invoices/get_table_data','InvoiceController@get_table_data');
			Route::resource('invoices','InvoiceController');

			//Quotation Controller
			Route::get('quotations/download_pdf/{id}','QuotationController@download_pdf')->name('quotations.download_pdf');
			Route::get('quotations/convert_invoice/{quotation_id}','QuotationController@convert_invoice')->name('quotations.convert_invoice');
			Route::match(['get', 'post'],'quotations/send_email/{quotation_id?}','QuotationController@send_email')->name('quotations.send_email');
			Route::get('quotations/get_table_data','QuotationController@get_table_data');
			Route::resource('quotations','QuotationController');

			//Staff Controller
			Route::resource('staffs','StaffController');
			
			//Company Settings Controller
			Route::post('company/upload_logo', 'CompanySettingsController@upload_logo')->name('company.change_logo');
			Route::match(['get', 'post'],'company/general_settings/{store?}', 'CompanySettingsController@settings')->name('company.change_settings');
			
			//Company Email Template
			Route::get('company_email_template/get_template/{id}','CompanyEmailTemplateController@get_template');
			Route::resource('company_email_template','CompanyEmailTemplateController');
			
			//Tax Controller
			Route::resource('taxs','TaxController')->except('show');
			
			//Product Unit Controller
			Route::resource('product_units','ProductUnitController')->except('show');
			
			//Report Controller
			Route::match(['get', 'post'],'reports/account_statement/{view?}', 'ReportController@account_statement')->name('reports.account_statement');
			Route::match(['get', 'post'],'reports/income_report/{view?}', 'ReportController@income_report')->name('reports.income_report');
			Route::match(['get', 'post'],'reports/expense_report/{view?}', 'ReportController@expense_report')->name('reports.expense_report');
			Route::match(['get', 'post'],'reports/transfer_report/{view?}', 'ReportController@transfer_report')->name('reports.transfer_report');
			Route::match(['get', 'post'],'reports/income_vs_expense/{view?}', 'ReportController@income_vs_expense')->name('reports.income_vs_expense');
			Route::match(['get', 'post'],'reports/report_by_payer/{view?}', 'ReportController@report_by_payer')->name('reports.report_by_payer');
			Route::match(['get', 'post'],'reports/report_by_payee/{view?}', 'ReportController@report_by_payee')->name('reports.report_by_payee');
			Route::match(['get', 'post'],'reports/report_contacts/{view?}', 'ReportController@report_contacts')->name('reports.report_contacts');

            //Staff Roles
            Route::resource('roles', 'RoleController');

            //Permission Controller
            Route::get('permission/control/{user_id?}', 'PermissionController@index')->name('permission.index');
            Route::post('permission/store', 'PermissionController@store')->name('permission.store');

			// Category Controller
			Route::get('/categories', 'CategoryController@index')->name('categories.index');
			Route::post('/categories', 'CategoryController@store')->name('categories.store');
			Route::get('/categories/{id}/edit', 'CategoryController@edit')->name('categories.edit');
			Route::put('/categories/{id}', 'CategoryController@update')->name('categories.update'); // ✅ Changed POST to PUT
			Route::delete('/categories/{id}', 'CategoryController@destroy')->name('categories.destroy');
			Route::get('/get-subcategories/{category_id}', 'CategoryController@getSubcategories');


        });

		Route::group(['middleware' => ['client']], function () {
		    Route::get('client/invoices/{status?}','ClientController@invoices')->name('client.invoices');
		    Route::get('client/quotations','ClientController@quotations')->name('client.quotations');
		    Route::get('client/transactions','ClientController@transactions')->name('client.transactions');
			Route::get('client/view_transaction/{id}','ClientController@view_transaction')->name('client.view_transaction');	
		});

		//Extend Membertship
		Route::get('membership/extend', 'MembershipController@extend')->name('membership.extend');
		Route::post('membership/pay', 'MembershipController@pay')->name('membership.pay');
		Route::get('membership/paypal_payment_authorize/{order_id}/{payment_id}', 'MembershipController@paypal_payment_authorize')->name('membership.paypal_payment_authorize');
		Route::post('membership/stripe_payment_authorize/{payment_id}', 'MembershipController@stripe_payment_authorize')->name('membership.stripe_payment_authorize');

    });

});

//Socila Login
Route::get('/login/{provider}', 'Auth\SocialController@redirect');
Route::get('/login/{provider}/callback', 'Auth\SocialController@callback');

//JSON data for dashboard chart
Route::get('dashboard/json_month_wise_income_expense','DashboardController@json_month_wise_income_expense')->middleware('auth');
Route::get('dashboard/json_income_vs_expense','DashboardController@json_income_vs_expense')->middleware('auth');

//View Invoice & Quotation without login
Route::get('client/view_invoice/{id}','ClientController@view_invoice')->name('client.view_invoice');
Route::get('client/download_pdf_invoice/{id}','ClientController@download_pdf_invoice')->name('client.download_pdf_invoice');
Route::get('client/view_quotation/{id}','ClientController@view_quotation')->name('client.view_quotation');
Route::get('client/download_pdf_quotation/{id}','ClientController@download_pdf_quotation')->name('client.download_pdf_quotation');

//Ajax Select2 Controller
Route::get('ajax/get_table_data', 'Select2Controller@get_table_data');

//Run Cron Jobs
Route::get('console/run','CronJobsController@run');	

//Online Invoice payments
Route::get('client/paypal_payment_authorize/{paypal_order_id}/{invoice_id}','ClientController@paypal_payment_authorize');
Route::post('client/stripe_payment_authorize/{invoice_id}','ClientController@stripe_payment_authorize');

Route::get('/installation', 'Install\InstallController@index');
Route::get('install/database', 'Install\InstallController@database');
Route::post('install/process_install', 'Install\InstallController@process_install');
Route::get('install/create_user', 'Install\InstallController@create_user');
Route::post('install/store_user', 'Install\InstallController@store_user');
Route::get('install/system_settings', 'Install\InstallController@system_settings');
Route::post('install/finish', 'Install\InstallController@final_touch');

//Update System
Route::get('migration/update', 'Install\UpdateController@update_migration');

use App\Http\Controllers\PDFController;

Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);

Route::get('/generate-gujarati-pdf', [PDFController::class, 'generatePDF']);

Route::post('/generate-expense-pdf', [PDFController::class, 'generateExpensePDF'])->name('generate.expense.pdf');
Route::post('/export-account-pdf', 'PDFController@exportAccountPdf')->name('export.account.pdf');
Route::post('export/income/pdf', [PDFController::class, 'generateIncomePDF'])->name('export.income.pdf');
Route::post('/export-transfer-pdf', [PDFController::class, 'exportTransferPDF'])->name('export.transfer.pdf');
Route::post('/reports/income-vs-expense/direct-pdf', [PDFController::class, 'exportIncomevsExpensePDF'])->name('income-vs-expense.ajax.pdf');
Route::post('/report-by-payer/ajax-pdf', [PDFController::class, 'generatePayerReportPDF'])->name('report-by-payer.ajax.pdf');
Route::post('/report-by-payee/ajax-pdf', [PDFController::class, 'generatePayeeReportPDF'])->name('report-by-payee.ajax.pdf');
Route::post('/report-by-contact/ajax-pdf', [PDFController::class, 'generateContactReportPDF'])->name('report-by-contact.ajax.pdf');



