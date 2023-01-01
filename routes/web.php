<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\SubSubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\AdminUserController;


use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeBlogController;


use App\Http\Controllers\User\wishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\ReviewController;



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
    return view("welcome");
});
// multi Auth
Route::group(['prefix'=>'admin','middleware'=>['admin:admin']],function(){
    Route::get('/login',[AdminController::class,'loginForm']);
    Route::post('/login',[AdminController::class,'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard')->middleware('auth:admin');


//Admin All Route
Route::middleware(['auth:admin'])->group(function(){

    Route::get('/admin/logout',[AdminController::class,'destroy'])->name('admin.logout');
    //admin Profile
    Route::get('/admin/Profile',[AdminProfileController::class,'Adminprofile'])->name('admin.profile');
    Route::get('/admin/Profile/edit',[AdminProfileController::class,'AdminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/Profile/store',[AdminProfileController::class,'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/password/edit',[AdminProfileController::class,'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update',[AdminProfileController::class,'AdminPasswordUpdate'])->name('admin.password.update');


    // admin Brands All Route
    Route::prefix('brand')->group(function(){
        Route::get('/view',[BrandController::class,'BrandView'])->name('all.brand');
        Route::post('/store',[BrandController::class,'BrandStore'])->name('brand.store');
        Route::get('/edit/{id}',[BrandController::class,'BrandEdit'])->name('brand.edit');
        Route::post('/update/{id}',[BrandController::class,'BrandUpdate'])->name('brand.update');
        Route::get('/delete/{id}',[BrandController::class,'BrandDelete'])->name('brand.delete');
    });

    // admin Category All Route
    Route::prefix('category')->group(function(){
        Route::get('/view',[CategoryController::class,'CategoryView'])->name('all.category');
        Route::post('/store',[CategoryController::class,'CategoryStore'])->name('category.store');
        Route::get('/edit/{id}',[CategoryController::class,'CategoryEdit'])->name('category.edit');
        Route::post('/update/{id}',[CategoryController::class,'CategoryUpdate'])->name('category.update');
        Route::get('/delete/{id}',[CategoryController::class,'CategoryDelete'])->name('category.delete');

    // admin Sub Category All Route
        Route::get('/sub/view',[SubCategoryController::class,'SubCategoryView'])->name('all.subcategory');
        Route::post('/sub/store',[SubCategoryController::class,'SubCategoryStore'])->name('subcategory.store');
        Route::get('/sub/edit/{id}',[SubCategoryController::class,'SubCategoryEdit'])->name('subcategory.edit');
        Route::post('/sub/update/{id}',[SubCategoryController::class,'SubCategoryUpdate'])->name('subcategory.update');
        Route::get('/sub/delete/{id}',[SubCategoryController::class,'SubCategoryDelete'])->name('subcategory.delete');

        // admin Sub Sub Category All Route
        Route::get('/sub/sub/view',[SubSubCategoryController::class,'SubSubCategoryView'])->name('all.subsubcategory');
        Route::get('/subcategory/ajax/{category_id}',[SubSubCategoryController::class,'GetSubCategory']);
        Route::get('/subsubcategory/ajax/{subcategory_id}',[SubSubCategoryController::class,'GetSubSubCategory']);
        Route::post('/sub/sub/store',[SubSubCategoryController::class,'SubSubCategoryStore'])->name('subsubcategory.store');
        Route::get('/sub/sub/edit/{id}',[SubSubCategoryController::class,'SubSubCategoryEdit'])->name('subsubcategory.edit');
        Route::post('/sub/sub/update/{id}',[SubSubCategoryController::class,'SubSubCategoryUpdate'])->name('subsubcategory.update');
        Route::get('/sub/sub/delete/{id}',[SubSubCategoryController::class,'SubSubCategoryDelete'])->name('subsubcategory.delete');
    });



    // admin Products All Route
    Route::prefix('product')->group(function(){
        Route::get('/add',[ProductController::class,'AddProduct'])->name('add-product');
        Route::post('/store',[ProductController::class,'ProductStore'])->name('product-store');
        Route::get('/view',[ProductController::class,'ProductView'])->name('manage-product');
        Route::get('/edit/{id}',[ProductController::class,'ProductEdit'])->name('product.edit');
        Route::get('/update/{id}',[ProductController::class,'ProductUpdate'])->name('product-update');
        Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
        Route::post('/thmb/update/{id}', [ProductController::class, 'ThmbUpdate'])->name('update-product-thmb');
        Route::get('/multi/delete/{id}',[ProductController::class,'DeleteMultiImg'])->name('product.multiimg.delete');
        Route::get('/inactive/{id}',[ProductController::class,'ProductInactive'])->name('product.inactive');
        Route::get('/active/{id}',[ProductController::class,'ProductActive'])->name('product.active');
        Route::get('/delete/{id}',[ProductController::class,'ProductDelete'])->name('product.delete');
    });

    // admin Sliders All Route
    Route::prefix('slider')->group(function(){
        Route::get('/view',[SliderController::class,'SliderView'])->name('manage-slider');
        Route::post('/store',[SliderController::class,'SliderStore'])->name('slider.store');
        Route::get('/edit/{id}',[SliderController::class,'SliderEdit'])->name('slider.edit');
        Route::post('/update/{id}',[SliderController::class,'SliderUpdate'])->name('slider.update');
        Route::get('/delete/{id}',[SliderController::class,'SliderDelete'])->name('slider.delete');
        Route::get('/inactive/{id}',[SliderController::class,'SliderInactive'])->name('slider.inactive');
        Route::get('/active/{id}',[SliderController::class,'SliderActive'])->name('slider.active');
    });

    // admin coupons All Route
    Route::prefix('coupons')->group(function(){
        Route::get('/view',[CouponController::class,'CouponView'])->name('manage-coupon');
        Route::post('/store',[CouponController::class,'CouponStore'])->name('coupon.store');
        Route::get('/edit/{id}',[CouponController::class,'CouponEdit'])->name('coupon.edit');
        Route::post('/update/{id}',[CouponController::class,'CouponUpdate'])->name('coupon.update');
        Route::get('/delete/{id}',[CouponController::class,'CouponDelete'])->name('coupon.delete');

    });

    // admin Shipping Area All Route
    Route::prefix('shipping')->group(function(){
        Route::get('/division/view',[ShippingAreaController::class,'DivisionView'])->name('manage-division');
        Route::post('/division/store',[ShippingAreaController::class,'DivisionStore'])->name('division.store');
        Route::get('/division/edit/{id}',[ShippingAreaController::class,'DivisionEdit'])->name('division.edit');
        Route::post('/division/update/{id}',[ShippingAreaController::class,'DivisionUpdate'])->name('division.update');
        Route::get('/division/delete/{id}',[ShippingAreaController::class,'DivisionDelete'])->name('division.delete');


        // Ship District
        Route::get('/district/view', [ShippingAreaController::class, 'DistrictView'])->name('manage-district');

        Route::post('/district/store', [ShippingAreaController::class, 'DistrictStore'])->name('district.store');

        Route::get('/district/edit/{id}', [ShippingAreaController::class, 'DistrictEdit'])->name('district.edit');

        Route::post('/district/update/{id}', [ShippingAreaController::class, 'DistrictUpdate'])->name('district.update');

        Route::get('/district/delete/{id}', [ShippingAreaController::class, 'DistrictDelete'])->name('district.delete');


        // Ship State
        Route::get('/state/view', [ShippingAreaController::class, 'StateView'])->name('manage-state');

        Route::post('/state/store', [ShippingAreaController::class, 'StateStore'])->name('state.store');

        Route::get('/state/edit/{id}', [ShippingAreaController::class, 'StateEdit'])->name('state.edit');

        Route::post('/state/update/{id}', [ShippingAreaController::class, 'StateUpdate'])->name('state.update');

        Route::get('/state/delete/{id}', [ShippingAreaController::class, 'StateDelete'])->name('state.delete');



    });

    // Admin Order All Routes

    Route::prefix('orders')->group(function(){

        Route::get('/pending/orders', [OrderController::class, 'PendingOrders'])->name('pending-orders');

        Route::get('/pending/orders/details/{order_id}', [OrderController::class, 'PendingOrdersDetails'])->name('pending.order.details');

        Route::get('/confirmed/orders', [OrderController::class, 'ConfirmedOrders'])->name('confirmed-orders');

        Route::get('/processing/orders', [OrderController::class, 'ProcessingOrders'])->name('processing-orders');

        Route::get('/picked/orders', [OrderController::class, 'PickedOrders'])->name('picked-orders');

        Route::get('/shipped/orders', [OrderController::class, 'ShippedOrders'])->name('shipped-orders');

        Route::get('/delivered/orders', [OrderController::class, 'DeliveredOrders'])->name('delivered-orders');

        Route::get('/cancel/orders', [OrderController::class, 'CancelOrders'])->name('cancel-orders');

        // Update Status
        Route::get('/pending/confirm/{order_id}', [OrderController::class, 'PendingToConfirm'])->name('pending-confirm');

        Route::get('/confirm/processing/{order_id}', [OrderController::class, 'ConfirmToProcessing'])->name('confirm.processing');

        Route::get('/processing/picked/{order_id}', [OrderController::class, 'ProcessingToPicked'])->name('processing.picked');

        Route::get('/picked/shipped/{order_id}', [OrderController::class, 'PickedToShipped'])->name('picked.shipped');

        Route::get('/shipped/delivered/{order_id}', [OrderController::class, 'ShippedToDelivered'])->name('shipped.delivered');

        Route::get('/invoice/download/{order_id}', [OrderController::class, 'AdminInvoiceDownload'])->name('invoice.download');

    });

    // Admin Reports Routes
    Route::prefix('reports')->group(function(){

        Route::get('/view', [ReportController::class, 'ReportView'])->name('all-reports');

        Route::post('/search/by/date', [ReportController::class, 'ReportByDate'])->name('search-by-date');

        Route::post('/search/by/month', [ReportController::class, 'ReportByMonth'])->name('search-by-month');

        Route::post('/search/by/year', [ReportController::class, 'ReportByYear'])->name('search-by-year');


    });


    // Admin Get All User Routes
    Route::prefix('alluser')->group(function(){

    Route::get('/view', [AdminProfileController::class, 'AllUsers'])->name('all-users');


    });

    // Admin Blog Routes
    Route::prefix('blog')->group(function(){

        Route::get('/category', [BlogController::class, 'BlogCategory'])->name('blog.category');
        Route::post('/store', [BlogController::class, 'BlogCategoryStore'])->name('blogcategory.store');

        Route::get('/category/edit/{id}', [BlogController::class, 'BlogCategoryEdit'])->name('blog.category.edit');


        Route::post('/update', [BlogController::class, 'BlogCategoryUpdate'])->name('blogcategory.update');

        // Admin View Blog Post Routes

        Route::get('/list/post', [BlogController::class, 'ListBlogPost'])->name('list.post');

        Route::get('/add/post', [BlogController::class, 'AddBlogPost'])->name('add.post');

        Route::post('/post/store', [BlogController::class, 'BlogPostStore'])->name('post-store');


    });

    // Admin Site Setting Routes 
    Route::prefix('setting')->group(function(){

        Route::get('/site', [SiteSettingController::class, 'SiteSetting'])->name('site.setting');

        Route::post('/site/update', [SiteSettingController::class, 'SiteSettingUpdate'])->name('update.sitesetting');

        Route::get('/seo', [SiteSettingController::class, 'SeoSetting'])->name('seo.setting'); 

        Route::post('/seo/update', [SiteSettingController::class, 'SeoSettingUpdate'])->name('update.seosetting');

    
    });

    // Admin Return Order Routes 
    Route::prefix('return')->group(function(){

       Route::get('/admin/request', [ReturnController::class, 'ReturnRequest'])->name('return.request');

       Route::get('/admin/return/approve/{order_id}', [ReturnController::class, 'ReturnRequestApprove'])->name('return.approve');

       Route::get('/admin/all/request', [ReturnController::class, 'ReturnAllRequest'])->name('all.request');
    
    });

    // Admin Manage Review Routes 
    Route::prefix('review')->group(function(){

        Route::get('/pending', [ReviewController::class, 'PendingReview'])->name('pending.review');
        
        Route::get('/admin/approve/{id}', [ReviewController::class, 'ReviewApprove'])->name('review.approve');
        
        Route::get('/publish', [ReviewController::class, 'PublishReview'])->name('publish.review');

        Route::get('/delete/{id}', [ReviewController::class, 'DeleteReview'])->name('delete.review');
    
    });

    // Admin Manage Stock Routes 
    Route::prefix('stock')->group(function(){

      Route::get('/product', [ProductController::class, 'ProductStock'])->name('product.stock');


    });

    // Admin User Role Routes   
    Route::prefix('adminuserrole')->group(function(){

        Route::get('/all', [AdminUserController::class, 'AllAdminRole'])->name('all.admin.user');

        Route::get('/add', [AdminUserController::class, 'AddAdminRole'])->name('add.admin');

        Route::post('/store', [AdminUserController::class, 'StoreAdminRole'])->name('admin.user.store');

        Route::get('/edit/{id}', [AdminUserController::class, 'EditAdminRole'])->name('edit.admin.user');

        Route::post('/update', [AdminUserController::class, 'UpdateAdminRole'])->name('admin.user.update');

        Route::get('/delete/{id}', [AdminUserController::class, 'DeleteAdminRole'])->name('delete.admin.user');
    
    
    });


});





// All Front End Route
// User  All Routes

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/',[IndexController::class,'index']);
Route::get('/user/logout',[IndexController::class,'UserLogout'])->name('user.logout');
Route::get('/user/profile',[IndexController::class,'UserProfile'])->name('user.profile');
Route::post('/user/profile/store',[IndexController::class,'UserProfileStore'])->name('user.profile.store');
Route::get('/user/password/Change',[IndexController::class,'UserChangePassword'])->name('user.change.password');
Route::post('/user/password/update',[IndexController::class,'UserPasswordUpdate'])->name('user.password.update');

// Route language
Route::get('/language/arabic', [LanguageController::class, 'Arabic'])->name('arabic.language');
Route::get('/language/english', [LanguageController::class, 'English'])->name('english.language');
// Route Product Details Page Url
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
// Route Product Tags Page Url
Route::get('/product/tag/ar/{tag}', [IndexController::class, 'TagWiseProductAR']);
Route::get('/product/tag/en/{tag}', [IndexController::class, 'TagWiseProductEN']);
// Route Product Sub Page Url
Route::get('/subcategory/product/{id}/{slug}', [IndexController::class, 'SubWiseProduct']);
// Route Product Sub Page Url
Route::get('/subsubcategory/product/{id}/{slug}', [IndexController::class, 'SubSubWiseProduct']);
// Product View Model With Ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'productViewAjax']);
// Add To Cart Store Date
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
// Get Data from mini cart
Route::get('/product/mini/cart/', [CartController::class, 'AddMiniCart']);
// Remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);
// Add to Wishlist
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishlist']);







//// /////// Strat Need  User Login  ////

Route::group(['prefix' =>'user','middleware'=>['user','auth'],'namespace'=>'User'],function(){

// Wishlist Page
Route::get('/wishlist', [wishlistController::class, 'ViewWishlist'])->name('wishlist');

Route::get('/get-wishlist-product', [wishlistController::class, 'GetWishlistProduct']);

Route::get('/wishlist-remove/{id}', [wishlistController::class, 'RemoveWishlistProduct']);
//stripe order
Route::post('/stripe/order', [StripeController::class, 'StripeOrder'])->name('stripe.order');

Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');
//User Orders
Route::get('/my/orders', [AllUserController::class, 'MyOrders'])->name('my.orders');

Route::get('/order_details/{order_id}', [AllUserController::class, 'OrderDetails']);

Route::get('/invoice_download/{order_id}', [AllUserController::class, 'InvoiceDownload']);

Route::post('/return/order/{order_id}', [AllUserController::class, 'ReturnOrder'])->name('return.order');

Route::get('/return/order/list', [AllUserController::class, 'ReturnOrderList'])->name('return.order.list');

Route::get('/cancel/orders', [AllUserController::class, 'CancelOrders'])->name('cancel.orders');

/// Order Traking Route 
Route::post('/order/tracking', [AllUserController::class, 'OrderTraking'])->name('order.tracking');   
});

/////// End Need User Login///////////





// My Cart Page
Route::get('/mycart', [CartPageController::class, 'MyCart'])->name('mycart');

Route::get('/user/get-cart-product', [CartPageController::class, 'GetCartProduct']);

Route::get('/user/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);

Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);

// Frontend Coupon Option

Route::post('/coupon-apply', [CartController::class, 'CouponApply']);

Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);

Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

// Checkout Route

Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');

Route::get('/district-get/ajax/{division_id}', [CheckoutController::class, 'DistrictGetAjax']);

Route::get('/state-get/ajax/{district_id}', [CheckoutController::class, 'StateGetAjax']);

Route::post('/checkout/store', [CheckoutController::class, 'CheckoutStore'])->name('checkout.store');

//  Frontend Blog Show Routes

Route::get('/blog', [HomeBlogController::class, 'AddBlogPost'])->name('home.blog');

Route::get('/post/details/{id}', [HomeBlogController::class, 'DetailsBlogPost'])->name('post.details');

Route::get('/blog/category/post/{category_id}', [HomeBlogController::class, 'HomeBlogCatPost']);

/// Frontend Product Review Routes

Route::post('/review/store', [ReviewController::class, 'ReviewStore'])->name('review.store');

/// Product Search Route 
Route::post('/search', [IndexController::class, 'ProductSearch'])->name('product.search');

// Advance Search Routes 
Route::post('search-product', [IndexController::class, 'SearchProduct']);