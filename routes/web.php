<?php

use App\Http\Controllers\User\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

//Quan tri vien - ADMIN
Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
    // Chay trong thu muc lib: php artisan serve
    // 1. Route Login - http://127.0.0.1:8000/login
    Route::group(['prefix' => 'login', 'middleware' => 'CheckLogedIn'], function () {
        Route::get('/', 'LoginController@getLogin');
        Route::post('/', 'LoginController@postLogin');
    });

    // Dang ky tai khoan
    Route::group(['prefix' => 'register'], function () {
        Route::get('/', 'RegisterController@getRegister');
        Route::post('/', 'RegisterController@postRegister');
    });


    //Route Logout khoi tai khoan admin
    Route::get('logout', 'HomeController@getLogout');

    // Route sau khi Login dung => vao trang index
    Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogedOut'], function () {
        // 2. Index - http://127.0.0.1:8000/admin/index
        Route::get('index', 'HomeController@getHome');

        // 3. Danh sach NQT - http://127.0.0.1:8000/admin/quantrivien
        Route::group(['prefix' => 'quantrivien'], function () {
            Route::get('/', 'ListAdminController@getListAdmin');
        });

        // 4. quanly_taikhoan_khachhang ( account_khachhang ) - http://127.0.0.1:8000/admin/account_khachhang
        Route::group(['prefix' => 'account_khachhang'], function () {
            Route::get('/', 'UserController@getAccountUser');
            //Xóa tài khoản khách hàng theo id
            Route::get('delete/{id}', 'UserController@getDeleteAccountUser');
        });

        // 5. quanly_taikhoan_nhaphanphoi ( account_nhaphanphoi ) - http://127.0.0.1:8000/admin/account_nhaphanphoi
        // Route::group(['prefix'=>'account_nhaphanphoi'], function(){
        //     Route::get('/', 'AccountPartnerController@getAccountPartner');
        // });

        // 6. thongtin_khachhang ( khachhang ) - http://127.0.0.1:8000/admin/khachhang
        Route::group(['prefix' => 'khachhang'], function () {
            Route::get('/', 'UserController@getUser');
        });

        // 7. thongtin_nhaphanphoi ( nhaphanphoi ) - http://127.0.0.1:8000/admin/nhaphanphoi
        // Route::group(['prefix'=>'nhaphanphoi'], function(){
        //     Route::get('/', 'PartnerController@getPartner');
        // });

        // quản lý bình luận sản phẩm - http://127.0.0.1:8000/admin/binhluan
        Route::group(['prefix' => 'binhluan'], function () {
            Route::get('/', 'CommentController@getComment');
        });

        // 8. quanly_baidang ( baidang) - http://127.0.0.1:8000/admin/baidang - Hiển thị/Thêm/Sửa/Xóa bài đăng
        Route::group(['prefix' => 'baidang'], function () {
            // Hiển thị bài đăng
            Route::get('/', 'BaiDangController@getBaiDang');
            // Thêm bài đăng - http://127.0.0.1:8000/admin/baidang/add
            Route::get('add', 'BaiDangController@getAddBaiDang');
            Route::post('add', 'BaiDangController@postAddBaiDang');
            // Cập nhật bài theo id - http://127.0.0.1:8000/admin/baidang/edit/{id}
            Route::get('edit/{id}', 'BaiDangController@getEditBaiDang');
            Route::post('edit/{id}', 'BaiDangController@postEditBaiDang');
            //Xóa bài theo id
            Route::get('delete/{id}', 'BaiDangController@getDeleteBaiDang');
        });

        // 8. quanly_tinh ( tinh) - http://127.0.0.1:8000/admin/tinh - Hiển thị/Thêm/Sửa/Xóa bài đăng
        Route::group(['prefix' => 'tinh'], function () {
            // Hiển thị xã
            Route::get('/', 'AddressController@getTinh');
            Route::post('/', 'AddressController@postTinh');

            // Chỉnh sửa danh mục sản phẩm theo id - http://127.0.0.1:8000/admin/danhmucsanpham/edit/{id}
            Route::get('edit/{id}', 'AddressController@getEditTinh');
            Route::post('edit/{id}', 'AddressController@postEditTinh');

            Route::get('delete/{id}', 'AddressController@getDeleteTinh');
        });

        // 8. quanly_huyen ( huyen) - http://127.0.0.1:8000/admin/tinh - Hiển thị/Thêm/Sửa/Xóa bài đăng
        Route::group(['prefix' => 'huyen'], function () {
            // Hiển thị xã
            Route::get('/', 'AddressController@getHuyen');
            Route::post('/', 'AddressController@postHuyen');

            // Chỉnh sửa danh mục sản phẩm theo id - http://127.0.0.1:8000/admin/danhmucsanpham/edit/{id}
            Route::get('edit/{id}', 'AddressController@getEditHuyen');
            Route::post('edit/{id}', 'AddressController@postEditHuyen');

            Route::get('delete/{id}', 'AddressController@getDeleteHuyen');
        });

        // 8. quanly_xa ( xa) - http://127.0.0.1:8000/admin/tinh - Hiển thị/Thêm/Sửa/Xóa bài đăng
        Route::group(['prefix' => 'xa'], function () {
            // Hiển thị xã
            Route::get('/', 'AddressController@getXa');
            Route::post('/', 'AddressController@postXa');

            // Chỉnh sửa danh mục sản phẩm theo id - http://127.0.0.1:8000/admin/danhmucsanpham/edit/{id}
            Route::get('edit/{id}', 'AddressController@getEditXa');
            Route::post('edit/{id}', 'AddressController@postEditXa');

            Route::get('delete/{id}', 'AddressController@getDeleteXa');
        });

        // 9. quanly_danhmucsanpham ( danhmucsanpham ) - http://127.0.0.1:8000/admin/danhmucsanpham - Hiển thị/Thêm/Sửa/Xóa danh muc san pham
        Route::group(['prefix' => 'danhmucsanpham'], function () {
            Route::get('/', 'CategoryController@getCategory');
            Route::post('/', 'CategoryController@postCategory');

            // Chỉnh sửa danh mục sản phẩm theo id - http://127.0.0.1:8000/admin/danhmucsanpham/edit/{id}
            Route::get('edit/{id}', 'CategoryController@getEditCategory');
            Route::post('edit/{id}', 'CategoryController@postEditCategory');

            Route::get('delete/{id}', 'CategoryController@getDeleteCategory');
        });

        // 9. quanly_thuonghieu ( thuonghieu ) - http://127.0.0.1:8000/admin/thuonghieu - Hiển thị/Thêm/Sửa/Xóa danh muc san pham
        Route::group(['prefix' => 'thuonghieu'], function () {
            Route::get('/', 'BrandController@getBrand');
            Route::post('/', 'BrandController@postBrand');

            // 
            Route::get('/active-status-brand/{id}', 'BrandController@activeStatusBrand');
            Route::get('/unactive-status-brand/{id}', 'BrandController@unactiveStatusBrand');
            Route::post('/toggle-status-brand/{id}', 'BrandController@toggleStatusBrand');
            // 

            // Chỉnh sửa danh mục sản phẩm theo id - http://127.0.0.1:8000/admin/danhmucsanpham/edit/{id}
            Route::get('edit/{id}', 'BrandController@getEditBrand');
            Route::post('edit/{id}', 'BrandController@postEditBrand');

            Route::get('delete/{id}', 'BrandController@getDeleteBrand');
        });

        // 10. quanly_loaisanpham ( loaisanpham ) - http://127.0.0.1:8000/admin/loaisanpham - Hiển thị/Thêm/Sửa/Xóa loai san pham
        Route::group(['prefix' => 'loaisanpham'], function () {
            Route::get('/', 'TypeController@getType');
            Route::post('/', 'TypeController@postType');

            // Chỉnh sửa loại sản phẩm theo id - http://127.0.0.1:8000/admin/loaisanpham/edit/{id}
            Route::get('edit/{id}', 'TypeController@getEditType');
            Route::post('edit/{id}', 'TypeController@postEditType');

            Route::get('delete/{id}', 'TypeController@getDeleteType');
        });

        // 11. quanly_sanpham ( sanpham ) - http://127.0.0.1:8000/admin/sanpham - Hiển thị/Thêm/Sửa/Xóa san pham
        Route::group(['prefix' => 'sanpham'], function () {
            //Hiển thị sản phẩm
            Route::get('/', 'ProductController@getProduct');
            // Route::post('/', 'ProductController@postProduct');

            //Thêm sản phẩm - http://127.0.0.1:8000/admin/sanpham/add
            Route::get('add', 'ProductController@getAddProduct');
            Route::post('add', 'ProductController@postAddProduct');

            //Sửa sản phẩm - http://127.0.0.1:8000/admin/sanpham/edit/{id}
            Route::get('edit/{id}', 'ProductController@getEditProduct');
            Route::post('edit/{id}', 'ProductController@postEditProduct');

            Route::get('delete/{id}', 'ProductController@getDeleteProduct');
        });

        // 12. quanly_mauson ( mauson ) - http://127.0.0.1:8000/admin/mauson - Hiển thị/Thêm/Sửa/Xóa mau son
        Route::group(['prefix' => 'mauson'], function () {
            Route::get('/', 'ColorController@getColor');
            Route::post('/', 'ColorController@postColor');

            // //Sửa màu sơn - http://127.0.0.1:8000/admin/mauson/edit/{id}
            Route::get('edit/{id}', 'ColorController@getEditColor');
            Route::post('edit/{id}', 'ColorController@postEditColor');

            Route::get('delete/{id}', 'ColorController@getDeleteColor');
        });

        // 13. quanly_nhanvien ( nhanvien )

        // 14. quanly_donhang ( donhang ) - http://127.0.0.1:8000/admin/donhang - Hiển thị/Thêm/Sửa/Xóa mau don hang
        Route::group(['prefix' => 'donhang'], function () {
            Route::get('/', 'OrderController@getOrder');

            Route::get('chitiet/{id}', 'OrderController@getChiTietOrder');
            // Chi tiết đơn theo id
            // Route::get('{id}', 'OrderController@getChiTietOrder');

            // CHỉnh sửa đơn hàng
            Route::get('edit/{id}', 'OrderController@getEditOrder');
            Route::post('edit/{id}', 'OrderController@postEditOrder');

            // Xóa đơn hàng
            Route::get('delete/{id}', 'OrderController@getDeleteOrder');
        });
    });
});

// USER
Route::group(['namespace' => 'App\Http\Controllers\User'], function () {
    // Đăng nhập - http://127.0.0.1:8000/user/login



    // Route sau khi Login dung => vao trang index
    // Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogedOut'], function () {

    //Route Logout khoi tai khoan user
    // Route::get('logout', '@getLogout');

    // Route::group(['prefix' => 'user', 'middleware' => 'CheckLogedOut'], function () {
    Route::group(['prefix' => 'user'], function () {
        // 1. Index - http://127.0.0.1:8000/user/index
        Route::get('index', 'HomeController@getHome');

        // 2. Đăng nhập - http://127.0.0.1:8000/user/login
        // Route::get('login', 'LoginController@getLogin');
        // -------------------------------------------------------------------------------------------------------
        Route::group(['prefix' => 'login', 'middleware' => 'CheckUserLogedIn'], function () {
            Route::get('/', 'LoginController@getLoginUser');
            Route::post('/', 'LoginController@postLoginUser');
        });
        //Logout
        Route::get('logout', 'HomeController@getLogout');
        // -------------------------------------------------------------------------------------------------------

        // Tim kiem
        Route::get('search', 'HomeController@getSearch');


        // 3. Giỏ hàng - http://127.0.0.1:8000/user/cart
        Route::group(['prefix' => 'cart'], function () {
            Route::get('add/{id}', 'CartController@getAddCart');
            Route::get('show', 'CartController@getShowCart');
            Route::get('delete/{id}', 'CartController@getDeleteCart');
            Route::get('update', 'CartController@getUpdateCart');
            // Route::post('show', 'CartController@postComplete');
            Route::post('show', 'CartController@postShipping');
            Route::post('checkout', 'CartController@postShipping')->name('user.cart.checkout');
        });
        // Route::group(['prefix' => 'cart', 'middleware' => 'CheckUserLogedOut'], function () {
        //     Route::get('/', 'LoginController@getLoginUser');
        //     Route::post('/', 'LoginController@postLoginUser');
        // });

        // 4. Đăng ký - http://127.0.0.1:8000/user/register
        Route::get('register', 'RegisterController@getRegister');
        Route::post('register', 'RegisterController@postRegister');

        // 5. Tin tức - http://127.0.0.1:8000/user/news
        // Route::get('news', 'NewsController@getNews');
        Route::group(['prefix' => 'news'], function () {
            //  5.1 Hiển thị tất cả bài đăng - http://127.0.0.1:8000/user/news
            Route::get('/', 'NewsController@getNews');
            //  5.2 Hiển thị từng bài theo id - http://127.0.0.1:8000/user/news/{id}
            Route::get('/baidang/{id}', 'NewsController@getPost');
            //     Route::get('/{id}', 'NewsController@getChiTietNews');
        });

        // 6. Mẫu nhà - http://127.0.0.1:8000/user/home
        Route::get('home', 'StyleController@getStyleHome');

        // 7. Liên hệ - http://127.0.0.1:8000/user/contact
        Route::get('contact', 'ContactController@getContact');

        // 8. Xem chi tiết sản phẩm - http://127.0.0.1:8000/user/detail/6/son-chong-tham-toa
        Route::get('detail/{id}/{slug}', 'HomeController@getDetail');
        Route::post('detail/{id}/{slug}', 'HomeController@postComment');

        // 9. Hiển thị sản phẩm cùng danh mục - http://127.0.0.1:8000/user/category/{id}/son-chong-tham-toa
        Route::get('category/{id}/{slug}.html', 'HomeController@getCategory');
    });
});
