<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard','HomeController@dashboard')->name('dashboard');


//Organization
Route::get('/organization/create','OrganizationController@create');
Route::post('/organization/update/{organization}', 'OrganizationController@update');

//Master
Route::get('/master/create','MasterController@create')->name('master.create');
Route::post('/master/store','MasterController@store')->name('master.store');
Route::post('/master/update/{master}', 'MasterController@update')->name('master.update');
Route::get('/master/edit/{master}', 'MasterController@edit')->name('master.edit');
Route::get('/master/delete', 'MasterController@delete')->name('master.delete');
Route::get('/master/search', 'MasterController@search')->name('master.search');

//Contact
Route::get('/contact/create','ContactController@create')->name('contact.create');
Route::post('/contact/store','ContactController@store')->name('contact.store');
Route::post('/contact/update/{contact}', 'ContactController@update')->name('contact.update');
Route::get('/contact/edit/{contact}', 'ContactController@edit')->name('contact.edit');
Route::get('/contact/delete', 'ContactController@delete')->name('contact.delete');
Route::get('/contact/search', 'ContactController@search')->name('contact.search');
Route::get('/contact/view/{contact}', 'ContactController@view')->name('contact.view');
Route::get('/contact/lead/{contact}', 'ContactController@lead')->name('contact.lead');
Route::get('/contact/display','ContactController@display')->name('contact.display');
Route::get('/contact/get_name','ContactController@get_name')->name('contact.get_name');
Route::get('/contact/upload','ContactController@upload');
Route::post('/contact/upload_excel', 'ContactController@upload_excel');
Route::post('/contact/save_contact/{contact}', 'ContactController@save_contact')->name('contact.save_contact');


//member
Route::get('/member/display','MemberController@display')->name('member.display');
Route::post('/member/update/{contact}','MemberController@update')->name('member.update');
Route::get('/member/edit/{contact}', 'MemberController@edit')->name('member.edit');
Route::get('/member/delete', 'MemberController@delete')->name('member.delete');
Route::get('/member/search', 'MemberController@search')->name('member.search');
Route::get('/member/view/{contact}', 'MemberController@view')->name('member.view');
Route::get('/member/new_member_report', 'MemberController@new_member_report');

//Project
Route::get('/project/create','ProjectController@create')->name('project.create');
Route::post('/project/store','ProjectController@store')->name('project.store');
Route::post('/project/update/{project}', 'ProjectController@update')->name('project.update');
Route::get('/project/edit/{project}', 'ProjectController@edit')->name('project.edit');
Route::get('/project/search', 'ProjectController@search')->name('project.search');

Route::get('/project/delete', 'ProjectController@delete')->name('project.delete');
Route::get('/project/view/{project}','ProjectController@view')->name('project.view');
//user
Route::get('/user/create','UserController@create')->name('user.create');
Route::post('/user/store','UserController@store')->name('user.store');
Route::post('/user/update/{user}', 'UserController@update')->name('user.update');
Route::get('/user/edit/{user}', 'UserController@edit')->name('user.edit');
Route::get('/user/delete', 'UserController@delete')->name('user.delete');
Route::get('/user/search', 'UserController@search')->name('user.search');
Route::get('/user/view/{user}', 'UserController@view')->name('user.view');
Route::get('/contact/get_user', 'UserController@get_user')->name('user.get_user');
Route::post('/contact/save_user', 'UserController@save_user')->name('user.save_user');
Route::get('/user/profile','UserController@profile')->name('profile');
Route::post('/user/update_profile/{user}','UserController@update_profile')->name('update_profile');


//Account_Type
Route::get('/account_type/create','AccountTypeController@create')->name('account_type.create');
Route::post('/account_type/store','AccountTypeController@store')->name('account_type.store');
Route::post('/account_type/update/{account_type}', 'AccountTypeController@update')->name('account_type.update');
Route::get('/account_type/edit/{account_type}', 'AccountTypeController@edit')->name('account_type.edit');
Route::get('/account_type/delete', 'AccountTypeController@delete')->name('account_type.delete');
Route::get('/account_type/search', 'AccountTypeController@search')->name('account_type.search');

//Accounts
Route::get('/account/create','AccountController@create')->name('account.create');
Route::post('/account/store','AccountController@store')->name('account.store');
Route::post('/account/update/{account}', 'AccountController@update')->name('account.update');
Route::get('/account/edit/{account}', 'AccountController@edit')->name('account.edit');
Route::get('/account/delete', 'AccountController@delete')->name('account.delete');
Route::get('/account/search', 'AccountController@search')->name('account.search');

//Expense
Route::get('/expense/create','ExpenseController@create')->name('expense.create');
Route::post('/expense/store','ExpenseController@store')->name('expense.store');
Route::post('/expense/update/{expense}', 'ExpenseController@update')->name('expense.update');
Route::get('/expense/edit/{expense}', 'ExpenseController@edit')->name('expense.edit');
Route::get('/expense/delete', 'ExpenseController@delete')->name('expense.delete');
Route::get('/expense/search', 'ExpenseController@search')->name('expense.search');

//Income
Route::get('/income/create','IncomeController@create')->name('income.create');
Route::post('/income/store','IncomeController@store')->name('income.store');
Route::post('/income/update/{income}', 'IncomeController@update')->name('income.update');
Route::get('/income/edit/{income}', 'IncomeController@edit')->name('income.edit');
Route::get('/income/delete', 'IncomeController@delete')->name('income.delete');
Route::get('/income/search', 'IncomeController@search')->name('income.search');

//Tax
Route::get('/tax/create','TaxController@create')->name('tax.create');
Route::post('/tax/store','TaxController@store')->name('tax.store');
Route::post('/tax/update/{tax}', 'TaxController@update')->name('tax.update');
Route::get('/tax/edit/{tax}', 'TaxController@edit')->name('tax.edit');
Route::get('/tax/delete', 'TaxController@delete')->name('tax.delete');
Route::get('/tax/search', 'TaxController@search')->name('tax.search');

//Tag
Route::get('/tag/create','TagController@create')->name('tag.create');
Route::post('/tag/store','TagController@store')->name('tag.store');
Route::post('/tag/update/{tag}', 'TagController@update')->name('tag.update');
Route::get('/tag/edit/{tag}', 'TagController@edit')->name('tag.edit');
Route::get('/tag/delete', 'TagController@delete')->name('tag.delete');
Route::get('/tag/search', 'TagController@search')->name('tag.search');

//Site
Route::get('/site/create','SiteController@create')->name('site.create');
Route::post('/site/store','SiteController@store')->name('site.store');
Route::post('/site/update/{site}', 'SiteController@update')->name('site.update');
Route::get('/site/edit/{site}', 'SiteController@edit')->name('site.edit');
Route::get('/site/delete', 'SiteController@delete')->name('site.delete');
Route::get('/site/search', 'SiteController@search')->name('site.search');

//payment_term
Route::get('/payment_term/create','PaymentTermController@create')->name('payment_term.create');
Route::post('/payment_term/store','PaymentTermController@store')->name('payment_term.store');
Route::post('/payment_term/update/{payment_term}', 'PaymentTermController@update')->name('payment_term.update');
Route::get('/payment_term/edit/{payment_term}', 'PaymentTermController@edit')->name('payment_term.edit');
Route::get('/payment_term/delete', 'PaymentTermController@delete')->name('payment_term.delete');
Route::get('/payment_term/search', 'PaymentTermController@search')->name('payment_term.search');

//assign_user
Route::get('/assign_user/create/{contact}','AssignUserController@create')->name('assign_user.create');
Route::post('/assign_user/store','AssignUserController@store')->name('assign_user.store');
Route::post('/assign_user/update/{assign_user}', 'AssignUserController@update')->name('assign_user.update');
Route::get('/assign_user/edit/{assign_user}', 'AssignUserController@edit')->name('assign_user.edit');
Route::get('/assign_user/delete', 'AssignUserController@delete')->name('assign_user.delete');
Route::get('/assign_user/search', 'AssignUserController@search')->name('assign_user.search');

//follow_up
Route::get('/follow_up/create/{contact}','FollowUpController@create')->name('follow_up.create');
Route::post('/follow_up/store','FollowUpController@store')->name('follow_up.store');
Route::post('/follow_up/update/{follow_up}', 'FollowUpController@update')->name('follow_up.update');
Route::get('/follow_up/edit/{follow_up}', 'FollowUpController@edit')->name('follow_up.edit');
Route::get('/follow_up/delete', 'FollowUpController@delete')->name('follow_up.delete');
Route::get('/follow_up/search', 'FollowUpController@search')->name('follow_up.search');
Route::get('/follow_up/view/{follow_up}', 'FollowUpController@view')->name('follow_up.view');

//assign_site
Route::get('/assign_site/create/{contact}','AssignSiteController@create')->name('assign_site.create');
Route::post('/assign_site/store','AssignSiteController@store')->name('assign_site.store');
Route::post('/assign_site/update/{assign_site}', 'AssignSiteController@update')->name('assign_site.update');
Route::get('/assign_site/edit/{assign_site}', 'AssignSiteController@edit')->name('assign_site.edit');
Route::get('/assign_site/delete', 'AssignSiteController@delete')->name('assign_site.delete');
Route::get('/assign_site/search', 'AssignSiteController@search')->name('assign_site.search');


//Priority
Route::get('/priority/create','PriorityController@create')->name('priority.create');
Route::post('/priority/store','PriorityController@store')->name('priority.store');
Route::post('/priority/update/{priority}', 'PriorityController@update')->name('priority.update');
Route::get('/priority/edit/{priority}', 'PriorityController@edit')->name('priority.edit');
Route::get('/priority/delete', 'PriorityController@delete')->name('priority.delete');
Route::get('/priority/search', 'PriorityController@search')->name('priority.search');

//Ticket_category

Route::get('/ticket_category/create','TicketCategoryController@create')->name('ticket_category.create');
Route::post('/ticket_category/store','TicketCategoryController@store')->name('ticket_category.store');
Route::post('/ticket_category/update/{ticket_category}', 'TicketCategoryController@update')->name('ticket_category.update');
Route::get('/ticket_category/edit/{ticket_category}', 'TicketCategoryController@edit')->name('ticket_category.edit');
Route::get('/ticket_category/delete', 'TicketCategoryController@delete')->name('ticket_category.delete');
Route::get('/ticket_category/search', 'TicketCategoryController@search')->name('ticket_category.search');



//Tickets
Route::get('/ticket/create','TicketController@create')->name('ticket.create');
Route::post('/ticket/store','TicketController@store')->name('ticket.store');
Route::post('/ticket/update/{ticket}', 'TicketController@update')->name('ticket.update');
Route::get('/ticket/edit/{ticket}', 'TicketController@edit')->name('ticket.edit');
Route::get('/ticket/delete', 'TicketController@delete')->name('ticket.delete');
Route::get('/ticket/search', 'TicketController@search')->name('ticket.search');
Route::get('/ticket/display','TicketController@display')->name('ticket.display');
Route::get('/ticket/view/{ticket}', 'TicketController@view')->name('ticket.view');
Route::post('/ticket/reply/{ticket}', 'TicketController@reply')->name('ticket.reply');
Route::post('/ticket/multiple_delete', 'TicketController@multiple_delete');
Route::post('/ticket/multiple_close','TicketController@multiple_close')->name('ticket.multiple_close');
Route::get('ticket/all','TicketController@all')->name('ticket.all');
Route::get('ticket/open','TicketController@open')->name('ticket.open');
Route::get('ticket/pending/{ticket}','TicketController@pending')->name('ticket.pending');
Route::get('/ticket/close/{ticket}','TicketController@close')->name('ticket.close');
Route::get('/ticket/reopen/{ticket}','TicketController@reopen')->name('ticket.reopen');
Route::get('/ticket/edit_reply', 'TicketController@edit_reply')->name('ticket.edit_reply');
Route::post('/ticket/update_reply/{message}', 'TicketController@update_reply')->name('ticket.update_reply');
Route::get('/ticket/delete_reply', 'TicketController@delete_reply')->name('ticket.delete_reply');



//Calllog
Route::get('/calllog/create/{contact}','CalllogController@create')->name('calllog.create');
Route::post('/calllog/store','CalllogController@store')->name('calllog.store');
Route::post('/calllog/update/{calllog}', 'CalllogController@update')->name('calllog.update');
Route::get('/calllog/edit/{calllog}', 'CalllogController@edit')->name('calllog.edit');
Route::get('/calllog/delete', 'CalllogController@delete')->name('calllog.delete');
Route::get('/calllog/search', 'CalllogController@search')->name('calllog.search');

//Category
Route::get('/category/create','CategoryController@create')->name('category.create');
Route::post('/category/store','CategoryController@store')->name('category.store');
Route::post('/category/update/{category}', 'CategoryController@update')->name('category.update');
Route::get('/category/edit/{category}', 'CategoryController@edit')->name('category.edit');
Route::get('/category/delete', 'CategoryController@delete')->name('category.delete');
Route::get('/category/search', 'CategoryController@search')->name('category.search');

//Payment
Route::get('/payment/create/{site_allotment}','PaymentController@create')->name('payment.create');
Route::post('/payment/store','PaymentController@store')->name('payment.store');
Route::get('/payment/edit/{payment}','PaymentController@edit')->name('payment.edit');
Route::post('/payment/update/{payment}','PaymentController@update')->name('payment.update');
Route::get('/payment/search','PaymentController@search')->name('payment.search');
Route::get('/payment/delete','PaymentController@delete')->name('payment.delete');
Route::get('/payment/display','PaymentController@display')->name('payment.display');
Route::get('/payment/payment_report', 'PaymentController@payment_report')->name('payment.payment_report');

//Refund
Route::get('/refund/create/{site_allotment}','RefundController@create')->name('refund.create');
Route::post('/refund/store','RefundController@store')->name('refund.store');
Route::get('/refund/delete','RefundController@delete')->name('refund.delete');
Route::get('/refund/edit/{refund}','RefundController@edit')->name('refund.edit');
Route::post('/refund/update/{refund}','RefundController@update')->name('refund.update');
Route::get('/refund/search','RefundController@search')->name('refund.search');
Route::get('/refund/display','RefundController@display')->name('refund.display');

//Site Allotment
Route::get('/site_allotment/create/{contact}','SiteAllotmentController@create')->name('site_allotment.create');
Route::post('/site_allotment/store','SiteAllotmentController@store')->name('site_allotment.store');
Route::get('/site_allotment/edit/{site_allotment}','SiteAllotmentController@edit')->name('site_allotment.edit');
Route::post('/site_allotment/update/{site_allotment}','SiteAllotmentController@update')->name('site_allotment.update');
Route::get('/site_allotment/delete','SiteAllotmentController@delete')->name('site_allotment.delete');
Route::get('/site_allotment/display','SiteAllotmentController@display')->name('site_allotment.display');
Route::get('/site_allotment/search','SiteAllotmentController@search')->name('site_allotment.search');
Route::get('/site_allotment/allotment/{site_allotment}','SiteAllotmentController@edit_allotment')->name('site_allotment.edit_allotment');
Route::post('/site_allotment/update_allotment/{site_allotment}','SiteAllotmentController@update_allotment')->name('site_allotment.update_allotment');
Route::get('/site_allotment/get_site','SiteAllotmentController@get_site')->name('site_allotment.get_site');
Route::post('/site_allotment/add_row', 'SiteAllotmentController@AddRow')->name('site_allotment.add_row');
Route::get('/site_allotment/edit_row', 'SiteAllotmentController@EditRow')->name('site_allotment.edit_row');
Route::post('/site_allotment/update_row', 'SiteAllotmentController@UpdateRow')->name('site_allotment.update_row');
Route::get('/site_allotment/delete_row', 'SiteAllotmentController@DeleteRow')->name('site_allotment.delete_row');
Route::get('/site_allotment/get_date', 'SiteAllotmentController@get_date')->name('site_allotment.get_date');
Route::get('/site_allotment/sum_total', 'SiteAllotmentController@sum_total')->name('site_allotment.sum_total');
Route::get('/site_allotment/edit_sum_total', 'SiteAllotmentController@edit_sum_total')->name('site_allotment.edit_sum_total');

//society
Route::get('/society/create','SocietyController@create')->name('society.create');
Route::Post('/society/store','SocietyController@store')->name('society.store');
Route::get('/society/delete','SocietyController@delete')->name('society.delete');
Route::get('/society/display','SocietyController@display')->name('society.display');
Route::post('/society/update/{society}', 'SocietyController@update')->name('society.update');
Route::get('/society/edit/{society}', 'SocietyController@edit')->name('society.edit');
Route::get('/society/search', 'SocietyController@search')->name('society.search');
Route::get('/society/view/{society}', 'SocietyController@view')->name('society.view');

//Reports
Route::get('/reports/payment_report', 'ReportController@payment_report');
Route::get('/reports/refund_report', 'ReportController@refund_report');
Route::get('/reports/member_report', 'ReportController@member_report');
Route::get('/reports/member_report_view','ReportController@member_report_view');
Route::get('/reports/contact_report','ReportController@contact_report');
Route::get('/reports/contact_report_view','ReportController@contact_report_view');

//Message Settings
Route::get('/message_setting/edit', 'MessageSettingController@edit')->name('message_setting.edit');
Route::post('/message_setting/update/{message_setting}', 'MessageSettingController@update')->name('message_setting.update');
