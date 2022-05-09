<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CateProduct;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoomProduct;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Cart;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatePost;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ContactController;
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
//Fontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/trang-chu', [HomeController::class, 'index']);

//tìm kiếm
Route::post('/tim-kiem', [HomeController::class, 'search']);

//Trang liên hệ
Route::get('/lien-he', [ContactController::class, 'lien_he']);

//đăng nhập đki
Route::get('/dang-nhap', [HomeController::class, 'dang_nhap']);
Route::get('/register', [HomeController::class, 'register']);
Route::post('/add-customer', [HomeController::class, 'add_customer']);
Route::post('/login-customer', [HomeController::class, 'login_customer']);

//Danh mục sản phẩm phần ng dùng
Route::get('/danh-muc/{category_slug}', [CateProduct::class, 'show_cate_home']);
// Thương hiệu sản phẩm phần ng dùng
Route::get('/thuong-hieu/{brand_slug}', [BrandProduct::class, 'show_brand_home']);
//Phòng  phần ng dùng
Route::get('/phong/{room_slug}', [RoomProduct::class, 'show_room_home']);
//danh mục bài viết
Route::get('/danh-muc-bai-viet/{post_slug}', [CatePost::class, 'show_post']);
Route::get('/bai-viet/{post_slug}', [PostController::class, 'bai_viet']);
//Chi tiết sản phẩm
Route::get('/chi-tiet-sp/{product_slug}', [ProductController::class, 'details_product']);
//video
Route::get('/videos', [VideoController::class, 'show_video_home']);
//load bình luận
Route::post('/load-cmt', [ProductController::class, 'load_cmt']);
Route::post('/send-cmt', [ProductController::class, 'send_cmt']);



//Backend
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);

//Category product
Route::get('/all-category-product', [CateProduct::class, 'all_category_product']);
Route::get('/add-category-product', [CateProduct::class, 'add_category_product']);
Route::get('/edit-category-product/{category_id}', [CateProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_id}', [CateProduct::class, 'delete_category_product']);
//ẩn hiện trạng thái
Route::get('/active-category-product/{category_id}', [CateProduct::class, 'active_category_product']);
Route::get('/unactive-category-product/{category_id}', [CateProduct::class, 'unactive_category_product']);
//lưu danh mục
Route::post('/save-category-product', [CateProduct::class, 'save_category_product']);
//update sau khi sửa danh mục
Route::post('/update-category-product/{category_id}', [CateProduct::class, 'update_category_product']);

//Brand product
Route::get('/all-brand-product', [BrandProduct::class, 'all_brand_product']);
Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
Route::get('/edit-brand-product/{brand_id}', [BrandProduct::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_id}', [BrandProduct::class, 'delete_brand_product']);
//ẩn hiện trạng thái
Route::get('/active-brand-product/{brand_id}', [BrandProduct::class, 'active_brand_product']);
Route::get('/unactive-brand-product/{brand_id}', [BrandProduct::class, 'unactive_brand_product']);
//lưu thương hiệu
Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']);
//update sau khi sửa thương hiệu
Route::post('/update-brand-product/{brand_id}', [BrandProduct::class, 'update_brand_product']);

//product
Route::get('/all-product', [ProductController::class, 'all_product']);
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
//ẩn hiện trạng thái
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);
Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
//lưu sản phẩm
Route::post('/save-product', [ProductController::class, 'save_product']);
//update sau khi sửa sản phẩm
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);

//Room product
Route::get('/all-room-product', [RoomProduct::class, 'all_room_product']);
Route::get('/add-room-product', [RoomProduct::class, 'add_room_product']);
Route::get('/edit-room-product/{room_id}', [RoomProduct::class, 'edit_room_product']);
Route::get('/delete-room-product/{room_id}', [RoomProduct::class, 'delete_room_product']);
//ẩn hiện trạng thái
Route::get('/active-room-product/{room_id}', [RoomProduct::class, 'active_room_product']);
Route::get('/unactive-room-product/{room_id}', [RoomProduct::class, 'unactive_room_product']);
//lưu danh mục
Route::post('/save-room-product', [RoomProduct::class, 'save_room_product']);
//update sau khi sửa danh mục
Route::post('/update-room-product/{room_id}', [RoomProduct::class, 'update_room_product']);

//Xử lý giỏ hàng bumbummen
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::post('/update-cart-qty', [CartController::class, 'update_cart_qty']);
Route::get('/delete-cart/{rowId}', [CartController::class, 'delete_cart']);

//xử lý giỏ hàng ajax
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/gio-hang',[CartController::class, 'gio_hang']);
Route::get('/del-product/{session_id}', [CartController::class, 'del_product']);
Route::get('/del-all-product',[CartController::class, 'del_all_product']);
Route::post('/update-cart', [CartController::class, 'update_cart']);

//check out
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/register-cus', [CheckoutController::class, 'register_cus']);
Route::post('/add-cus', [CheckoutController::class, 'add_cus']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::post('/save-checkout-cus', [CheckoutController::class, 'save_checkout_cus']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::post('/login-cus', [CheckoutController::class, 'login_cus']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);
Route::post('/calculate-fee', [CheckoutController::class, 'calculate_fee']);
Route::post('/confirm-order', [CheckoutController::class, 'confirm_order']);

//quản lý đơn hàng trang admin bumbummen
// Route::get('/manager-order', [CheckoutController::class, 'manager_order']);
// Route::get('/view-order/{orderID}', [CheckoutController::class, 'view_order']);
// Route::get('/delete-order/{orderID}', [CheckoutController::class, 'delete_order']);

//quản lý đơn hàng trang admin ajax
Route::get('/manager-order', [OrderController::class, 'manager_order']);
Route::get('/view-order/{order_code}', [OrderController::class, 'view_order']);
Route::get('/print-order/{checkout_code}', [OrderController::class, 'print_order']);
Route::post('/update-order-qty', [OrderController::class, 'update_order_qty']);
// Route::get('/delete-order/{orderID}', [CheckoutController::class, 'delete_order']);

//lịch sử đơn hàng người dùng
Route::get('/history', [OrderController::class, 'history']);
Route::get('/view-history/{order_code}', [OrderController::class, 'view_history']);

//sendmail
Route::get('/send-mail', [HomeController::class, 'send_mail']);

//coupon
//coupon phần ng dùng
Route::post('/check-coupon', [CartController::class, 'check_coupon']);
//coupon phần admin
Route::get('/all-coupon', [CouponController::class, 'all_coupon']);
Route::get('/add-coupon', [CouponController::class, 'add_coupon']);
Route::post('/save-coupon', [CouponController::class, 'save_coupon']);
Route::get('/delete-coupon/{coupon_id}',[CouponController::class, 'delete_coupon']);
Route::get('/unset-coupon',[CouponController::class, 'unset_coupon']);
//gửi mã giảm giá
Route::get('/send-coupon/{coupon_number}/{coupon_condition}/{coupon_code}', [CouponController::class, 'send_coupon']);
Route::get('/mail-example', [CouponController::class, 'mail_example']);

//delivery
Route::get('/delivery', [DeliveryController::class, 'delivery']);
Route::post('/select-delivery',[DeliveryController::class, 'select_delivery']);
Route::post('/insert-delivery',[DeliveryController::class, 'insert_delivery']);
Route::post('/select-feeship',[DeliveryController::class, 'select_feeship']);
Route::post('/update-feeship',[DeliveryController::class, 'update_feeship']);

//slider
Route::get('/all-slider', [SliderController::class, 'all_slider']);
Route::get('/add-slider', [SliderController::class, 'add_slider']);
Route::post('/save-slider', [SliderController::class, 'save_slider']);
//ẩn hiện trạng thái
Route::get('/active-slider/{slider_id}', [SliderController::class, 'active_slider']);
Route::get('/unactive-slider/{slider_id}', [SliderController::class, 'unactive_slider']);
//xóa slide
Route::get('/delete-slide/{slider_id}', [SliderController::class, 'delete_slide']);

//Autherntication roles
Route::get('/login-auth', [AuthController::class, 'login_auth']);
Route::post('/login', [AuthController::class, 'login']);

//User
Route::get('/users', [UserController::class, 'index']);
Route::post('/assign-roles', [UserController::class, 'assign_roles']);
Route::get('/add-users', [UserController::class, 'add_users']);
Route::post('/store-users', [UserController::class, 'store_users']);

//Category post
Route::get('/all-category-post', [CatePost::class, 'all_category_post']);
Route::get('/add-category-post', [CatePost::class, 'add_category_post']);
Route::get('/edit-category-post/{cate_id}', [CatePost::class, 'edit_category_post']);
Route::get('/delete-category-post/{cate_id}', [CatePost::class, 'delete_category_post']);
//ẩn hiện trạng thái
Route::get('/active-category-post/{cate_id}', [CatePost::class, 'active_category_post']);
Route::get('/unactive-category-post/{cate_id}', [CatePost::class, 'unactive_category_post']);
//lưu danh mục
Route::post('/save-category-post', [CatePost::class, 'save_category_post']);
//update sau khi sửa danh mục
Route::post('/update-category-post/{cate_id}', [CatePost::class, 'update_category_post']);

//Bài viết
Route::get('/all-post', [PostController::class, 'all_post']);
Route::get('/add-post', [PostController::class, 'add_post']);
Route::post('/save-post', [PostController::class, 'save_post']);
Route::get('/active-post/{post_id}', [PostController::class, 'active_post']);
Route::get('/unactive-post/{post_id}', [PostController::class, 'unactive_post']);
Route::get('/delete-post/{pos_id}', [PostController::class, 'delete_post']);
Route::get('/edit-post/{pos_id}', [PostController::class, 'edit_post']);
Route::post('/update-post/{pos_id}', [PostController::class, 'update_post']);


//gallery
Route::get('/add-gallery/{prod_id}', [GalleryController::class, 'add_gallery']);
Route::post('/all-gallery', [GalleryController::class, 'all_gallery']);
Route::post('/insert-gallery/{prod_id}', [GalleryController::class, 'insert_gallery']);
Route::post('/update-galname', [GalleryController::class, 'update_galname']);
Route::post('/delete-gallery', [GalleryController::class, 'delete_gallery']);

//video phong cách thiết kế
Route::get('/video', [VideoController::class, 'video']);
Route::post('/all-video', [VideoController::class, 'all_video']);
Route::post('/insert-video', [VideoController::class, 'insert_video']);
Route::post('/update-video', [VideoController::class, 'update_video']);
Route::post('/delete-video', [VideoController::class, 'delete_video']);
Route::post('/watch-video', [VideoController::class, 'watch_video']);

//quản lý bình luận
Route::get('/comment', [ProductController::class, 'all_comment']);
Route::post('/allow-cmt', [ProductController::class, 'allow_cmt']);
Route::post('/reply-cmt', [ProductController::class, 'reply_cmt']);
Route::get('/delete-cmt/{comment_id}',[ProductController::class, 'delete_cmt']);

//thống kê
Route::post('/days-order', [AdminController::class, 'days_order']);
Route::post('/filter-by-date', [AdminController::class, 'filter_by_date']);
Route::post('/dashboard-filter', [AdminController::class, 'dashboard_filter']);

