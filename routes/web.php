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
header("Pragma:no-cache");
header("Cache-Control:no-cache,must-revalidate");


Route::group(['middleware' => 'auth'], function () {
    //
    Route::get('test','TestController@index');
    //
    Route::any('curl', function (Curl\Curl $curl, \Illuminate\Http\Request $request) {
        return $curl->{$request->method()}($request->url, $request->except(['url', 's']))->response;
    });
    //首页
    Route::get('/', 'CustomerController@index');


    //Dialogs
    //选择客户
    Route::get('/customer/choose', 'DialogController@customer');
    //选择产品
    Route::get('/product/choose', 'DialogController@product');
    //选择审核通过的开票人
    Route::get('/drawer_user/choose', 'DialogController@drawer_user');
    //选择发票产品
    Route::get('/drawer/choose', 'DialogController@drawer');
    //选择某开票人的订单
    Route::get('/drawer_order/{id}/choose', 'DialogController@drawerOrder');
    //选择审核通过的订单
    Route::get('/order/{status}/choose', 'DialogController@order');
    //选择开票工厂
    Route::get('/company/choose', 'DialogController@company');
    //选择发票
    Route::get('/invoice/choose', 'DialogController@invoice');
    //选择权限
    Route::get('permission/choose', 'DialogController@permission');
    //选择权限
    Route::get('role/choose', 'DialogController@role');
    //选择公司
    Route::get('firm/choose', 'DialogController@firm');
    //选择业务类型
    Route::get('business/choose', 'DialogController@business');

    //上传接口
    Route::post('/upload', 'UploadController@upload');


    

    //客户管理
    //普通请求获取主页,ajax请求获取分页数据
    Route::get('/customer', 'CustomerController@index');
    //传id查看客户详情,id为0获取修改页面,添加disabled
    //type {read 查看, save 新增,update 修改,approve 审核}
    Route::get('/customer/{type}/{id}', 'CustomerController@read');

    //新增
    Route::post('/customer', 'CustomerController@save');
    //删除
    Route::post('/customer/delete/{id}', 'CustomerController@delete');
    //更新
    Route::post('/customer/update/{id}', 'CustomerController@update');
    //选择业务员
    Route::get('/chosalesman/{ids}', 'CustomerController@chosalesman');
    Route::post('/chosalesman/{ids}', 'CustomerController@salesman');


    //产品管理
    //type{0:所有,1:草稿,2:审批中,3:审批通过,4:审批拒绝}
    Route::get('/product/{status}', 'ProductController@index');
    Route::get('/product/{type}/{id}', 'ProductController@read');
    //新增
    Route::post('/product', 'ProductController@save');
    //删除
    Route::post('/product/delete/{id}', 'ProductController@delete');
    //更新
    Route::post('/product/update/{id}', 'ProductController@update');

    

    //开票人管理
    Route::get('/drawer/{status}', 'DrawerController@index');
    Route::get('/drawer/{type}/{id}', 'DrawerController@read');
    //新增
    Route::post('/drawer', 'DrawerController@save');
    //删除
    Route::post('/drawer/delete/{id}', 'DrawerController@delete');
    //更新
    Route::post('/drawer/update/{id}', 'DrawerController@update');
    //开票的所有产品
    Route::get('/drawer_products', 'DrawerController@products');


    //订单管理
    Route::get('/order/{status}', 'OrderController@index');
    Route::get('/order/{type}/{id}', 'OrderController@read');
    //新增
    Route::post('/order', 'OrderController@save');
    //删除
    Route::post('/order/delete/{id}', 'OrderController@delete');
    //更新
    Route::post('/order/update/{id}', 'OrderController@update');


    //报关管理
    Route::get('/clearance', 'ClearanceController@index');
    Route::get('/clearance/file/{id}', 'ClearanceController@file');
    Route::get('/clearance/{type}/{id}', 'ClearanceController@read');
    //Route::post('/clearance', 'ClearanceController@save');
    Route::post('/clearance/update/{id}', 'ClearanceController@update');
    Route::get('/clearance/{id}', 'ClearanceController@get');

    //发票管理
    Route::get('/invoice/{status}', 'InvoiceController@index');
    Route::get('/invoice/{type}/{id}', 'InvoiceController@read');
    Route::post('/invoice', 'InvoiceController@save');
    Route::post('/invoice/delete/{id}', 'InvoiceController@delete');
    Route::post('/invoice/update/{id}', 'InvoiceController@update');
    Route::get('/invoice_clearances/{drawer_id}', 'InvoiceController@clearances');


    //申报管理
    Route::get('/filing/{status}', 'FilingController@index');
    //查看发票详情
    Route::get('/filing/{type}/{id}', 'FilingController@read');
    //新增申报登记
    Route::post('/filing', 'FilingController@save');
    //待申报申报登记
    Route::post('/filing/update/{id}', 'FilingController@update');
    Route::post('/filing/delete/{id}', 'FilingController@delete');

    //退税管理
    Route::get('/rebate/{status}', 'RebateController@index');
    Route::get('/rebate/{type}/{id}', 'RebateController@read');
    //新增
    Route::post('/rebate', 'RebateController@save');

    //运费管理
    Route::get('/finance/transport/{status}', 'TransportController@index');
    //type {read 查看, save 新增, approve 审核, update 修改}
    Route::get('/finance/transport/{type}/{id}', 'TransportController@read');
    Route::post('/finance/transport', 'TransportController@save');

    //付款管理
    Route::get('/finance/pay/{status}', 'PayController@index');
    //type {read 查看, save 新增, approve 审核, update 修改}
    Route::get('/finance/pay/{type}/{id}', 'PayController@read');
    Route::post('/finance/pay', 'payController@save');//付款管理

    //收汇登记
    Route::get('/finance/receipt', 'ReceiptController@index');
    //type {read 查看, save 新增, approve 审核, update 修改}
    Route::get('/finance/receipt/{type}/{id}', 'ReceiptController@read');
    Route::post('/finance/receipt', 'ReceiptController@save');

    //收汇登记
    Route::get('/finance/remittee', 'RemitteeController@index');
    //type {read 查看, save 新增, approve 审核, update 修改}
    Route::get('/finance/remittee/{type}/{id}', 'RemitteeController@read');
    Route::post('/finance/remittee', 'RemitteeController@save');
    Route::post('/finance/remittee/update/{id}', 'RemitteeController@update');
    Route::post('/finance/remittee/delete/{id}', 'RemitteeController@delete');


    //数据维护
    Route::get('/data_manage', 'DataController@index');
    Route::get('/data/{id}', 'DataController@read');
    Route::post('/data/{id}', 'DataController@save');

    //业务管理
    //普通请求获取主页,ajax请求获取分页数据
    Route::get('/busine', 'BusineController@index');
    Route::get('/busine/{type}/{id}', 'BusineController@read');

    //新增
    Route::post('/busine', 'BusineController@save');
    //删除
    Route::post('/busine/delete/{id}', 'BusineController@delete');
    //更新
    Route::post('/busine/update/{id}', 'BusineController@update');

    //系统管理
    Route::get('user/profile', function () {
        // 使用 `Auth` 中间件
    });

    Route::get('/system/role', 'RoleController@index');
    Route::get('/system/role/{type}/{id}', 'RoleController@read');
    Route::post('/system/role', 'RoleController@save');

    Route::get('/system/permission', 'PermissionController@index');
    Route::get('/system/permission/{type}/{id}', 'PermissionController@read');
    Route::post('/system/permission', 'PermissionController@save');

    Route::get('/system/account', 'AccountController@index');
    Route::get('/system/account/{role}', 'AccountController@role');
    Route::get('/system/account/{type}/{id}', 'AccountController@read');
    Route::post('/system/account', 'AccountController@save');
    Route::post('/system/account/update/{id}', 'AccountController@update');
    Route::post('/system/account/delete/{id}', 'AccountController@delete');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
