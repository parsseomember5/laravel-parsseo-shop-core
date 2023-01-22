<?php

use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\CartsController;
use App\Http\Controllers\Admin\ChaptersController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\DiscountsController;
use App\Http\Controllers\Admin\FeedbacksController;
use App\Http\Controllers\Admin\LearningsController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LogosController;
use App\Http\Controllers\Admin\MenuItemsController;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\PortfolioCategoriesController;
use App\Http\Controllers\Admin\PortfoliosController;
use App\Http\Controllers\Admin\PostCategoriesController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\ProductCategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Front\IndexController;
use Illuminate\Support\Facades\Artisan;
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

// Views Clear:
Route::get('/views-clear', function() {
    Artisan::call('view:clear');
    return '<h1>Views Cleared!</h1>';
});

//Clear configurations:
Route::get('/config-clear', function() {
    Artisan::call('config:clear');
    return '<h1>Configurations cleared</h1>';
});

//Clear cache:
Route::get('/cache-clear', function() {
    Artisan::call('cache:clear');
    return '<h1>Cache cleared</h1>';
});

//Clear cache:
Route::get('/optimize-me', function() {
    Artisan::call('optimize:clear');
    return '<h1>optimized!</h1>';
});

//migrate:
Route::get('/migrate-me', function() {
    Artisan::call('migrate');
    return '<h1>migrated!</h1>';
});


// *********************** Admin Routes ***************
Route::prefix('admin')->group(function (){

    Route::get('login',[LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('login',[LoginController::class,'login'])->name('admin.do_login');

    Route::middleware('auth:admin')->group(function (){
        Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');
        Route::get('dashboard',[PanelController::class,'dashboard'])->name('admin.dashboard');

        // profile
        Route::get('profile',[ProfileController::class,'index'])->name('admin.profile');
        Route::get('profile/security',[ProfileController::class,'security'])->name('admin.profile.security');
        Route::post('profile/update/{admin}',[ProfileController::class,'update'])->name('admin.update');
        Route::post('profile/update/password/{admin}',[ProfileController::class,'resetPassword'])->name('admin.update.password');

        // posts
        Route::post('posts/get-translations',[PostsController::class,'getTranslations']);
        Route::get('posts/trash',[PostsController::class,'trash'])->name('posts.trash');
        Route::post('posts/empty/trash',[PostsController::class,'emptyTrash'])->name('posts.trash.empty');
        Route::post('posts/restore/{id}',[PostsController::class,'restore'])->name('posts.restore');
        Route::post('posts/force-delete',[PostsController::class,'forceDelete'])->name('posts.delete.force');
        Route::get('posts/search/trash',[PostsController::class,'searchTrash'])->name('posts.search.trash');
        Route::get('posts/search',[PostsController::class,'search'])->name('posts.search');
        Route::resource('posts',PostsController::class);
        Route::post('posts/ajax-delete',[PostsController::class,'ajaxDelete']);

        // users
        Route::get('users/wallet/{user}',[UsersController::class,'showWallet'])->name('users.wallet');
        Route::get('users/cart/{user}',[UsersController::class,'showCart'])->name('users.cart');
        Route::post('users/get-balance',[UsersController::class,'getBalance']);
        Route::get('users/balance/{user?}',[UsersController::class,'balance'])->name('users.balance');
        Route::post('users/balance-update',[UsersController::class,'updateBalance'])->name('users.balance_update');
        Route::get('users/trash',[UsersController::class,'trash'])->name('users.trash');
        Route::post('users/empty/trash',[UsersController::class,'emptyTrash'])->name('users.trash.empty');
        Route::post('users/restore/{id}',[UsersController::class,'restore'])->name('users.restore');
        Route::post('users/force-delete',[UsersController::class,'forceDelete'])->name('users.delete.force');
        Route::get('users/search/trash',[UsersController::class,'searchTrash'])->name('users.search.trash');
        Route::get('users/search',[UsersController::class,'search'])->name('users.search');
        Route::resource('users',UsersController::class);
        Route::post('users/ajax-delete',[UsersController::class,'ajaxDelete']);

        // tickets
        Route::get('tickets/trash',[TicketsController::class,'trash'])->name('tickets.trash');
        Route::post('tickets/empty/trash',[TicketsController::class,'emptyTrash'])->name('tickets.trash.empty');
        Route::post('tickets/restore/{id}',[TicketsController::class,'restore'])->name('tickets.restore');
        Route::post('tickets/force-delete',[TicketsController::class,'forceDelete'])->name('tickets.delete.force');
        Route::get('tickets/search/trash',[TicketsController::class,'searchTrash'])->name('tickets.search.trash');
        Route::get('tickets/search',[TicketsController::class,'search'])->name('tickets.search');
        Route::resource('tickets',TicketsController::class);
        Route::post('tickets/ajax-delete',[TicketsController::class,'ajaxDelete']);

        // comments
        Route::get('comments/search',[CommentsController::class,'search'])->name('comments.search');
        Route::resource('comments',CommentsController::class);

        // discounts
        Route::get('discounts/trash',[DiscountsController::class,'trash'])->name('discounts.trash');
        Route::post('discounts/empty/trash',[DiscountsController::class,'emptyTrash'])->name('discounts.trash.empty');
        Route::post('discounts/restore/{id}',[DiscountsController::class,'restore'])->name('discounts.restore');
        Route::post('discounts/force-delete',[DiscountsController::class,'forceDelete'])->name('discounts.delete.force');
        Route::get('discounts/search/trash',[DiscountsController::class,'searchTrash'])->name('discounts.search.trash');
        Route::get('discounts/search',[DiscountsController::class,'search'])->name('discounts.search');
        Route::resource('discounts',DiscountsController::class);
        Route::post('discounts/ajax-delete',[DiscountsController::class,'ajaxDelete']);

        // payments
        Route::get('payments',[PaymentsController::class,'index'])->name('payments.index');
        Route::post('payments/search',[PaymentsController::class,'search'])->name('payments.search');

        // admins
        Route::get('admins/trash',[AdminsController::class,'trash'])->name('admins.trash');
        Route::post('admins/empty/trash',[AdminsController::class,'emptyTrash'])->name('admins.trash.empty');
        Route::post('admins/restore/{id}',[AdminsController::class,'restore'])->name('admins.restore');
        Route::post('admins/force-delete',[AdminsController::class,'forceDelete'])->name('admins.delete.force');
        Route::get('admins/search/trash',[AdminsController::class,'searchTrash'])->name('admins.search.trash');
        Route::get('admins/search',[AdminsController::class,'search'])->name('admins.search');
        Route::resource('admins',AdminsController::class);
        Route::post('admins/ajax-delete',[AdminsController::class,'ajaxDelete']);

        // product
        Route::get('products/trash',[ProductsController::class,'trash'])->name('products.trash');
        Route::post('products/empty/trash',[ProductsController::class,'emptyTrash'])->name('products.trash.empty');
        Route::post('products/restore/{id}',[ProductsController::class,'restore'])->name('products.restore');
        Route::post('products/force-delete',[ProductsController::class,'forceDelete'])->name('products.delete.force');
        Route::get('products/search/trash',[ProductsController::class,'searchTrash'])->name('products.search.trash');
        Route::get('products/search',[ProductsController::class,'search'])->name('products.search');
        Route::post('products/ajax-delete',[ProductsController::class,'ajaxDelete']);
        Route::resource('products',ProductsController::class);

        // tags
        Route::get('tags/search',[TagsController::class,'search'])->name('tags.search');
        Route::resource('tags',TagsController::class);

        // post categories
        Route::get('post-categories/search',[PostCategoriesController::class,'search'])->name('post-categories.search');
        Route::resource('post-categories',PostCategoriesController::class);

        // product categories
        Route::get('product-categories/search',[ProductCategoriesController::class,'search'])->name('product-categories.search');
        Route::resource('product-categories',ProductCategoriesController::class);

        // orders
        Route::get('orders/trash',[OrdersController::class,'trash'])->name('orders.trash');
        Route::post('orders/empty/trash',[OrdersController::class,'emptyTrash'])->name('orders.trash.empty');
        Route::post('orders/restore/{id}',[OrdersController::class,'restore'])->name('orders.restore');
        Route::post('orders/force-delete',[OrdersController::class,'forceDelete'])->name('orders.delete.force');
        Route::get('orders/search/trash',[OrdersController::class,'searchTrash'])->name('orders.search.trash');
        Route::get('orders/search',[OrdersController::class,'search'])->name('orders.search');
        Route::resource('orders',OrdersController::class);
        Route::post('orders/ajax-delete',[OrdersController::class,'ajaxDelete']);

        // pages
        Route::get('pages/trash',[PagesController::class,'trash'])->name('pages.trash');
        Route::post('pages/empty/trash',[PagesController::class,'emptyTrash'])->name('pages.trash.empty');
        Route::post('pages/restore/{id}',[PagesController::class,'restore'])->name('pages.restore');
        Route::post('pages/force-delete',[PagesController::class,'forceDelete'])->name('pages.delete.force');
        Route::get('pages/search/trash',[PagesController::class,'searchTrash'])->name('pages.search.trash');
        Route::get('pages/search',[PagesController::class,'search'])->name('pages.search');
        Route::resource('pages',PagesController::class);
        Route::post('pages/ajax-delete',[PagesController::class,'ajaxDelete']);

        // settings
        Route::prefix('settings')->group(function (){
            Route::get('general',[SettingsController::class,'general'])->name('settings.general');
            Route::post('general/update',[SettingsController::class,'updateGeneral'])->name('settings.general_update');
            Route::get('gateways',[SettingsController::class,'gateways'])->name('settings.gateways');
            Route::post('gateways/update',[SettingsController::class,'updateGateways'])->name('settings.gateways_update');
            Route::get('sms',[SettingsController::class,'sms'])->name('settings.sms');
            Route::post('sms/update',[SettingsController::class,'updateSMS'])->name('settings.sms_update');
            Route::get('about',[SettingsController::class,'about'])->name('settings.about');
            Route::post('about/update',[SettingsController::class,'updateAbout'])->name('settings.about_update');
            Route::get('articles',[SettingsController::class,'articles'])->name('settings.articles');
            Route::post('articles/update',[SettingsController::class,'updateArticles'])->name('settings.articles_update');
            Route::get('counters',[SettingsController::class,'counters'])->name('settings.counters');
            Route::post('counters/update',[SettingsController::class,'updateCounters'])->name('settings.counters_update');
            Route::get('feedbacks',[SettingsController::class,'feedbacks'])->name('settings.feedbacks');
            Route::post('feedbacks/update',[SettingsController::class,'updateFeedbacks'])->name('settings.feedbacks_update');
            Route::get('contact-us',[SettingsController::class,'contactUs'])->name('settings.contact_us');
            Route::post('contact-us/update',[SettingsController::class,'updateContactUs'])->name('settings.contact_us_update');
            Route::get('about-us',[SettingsController::class,'aboutUs'])->name('settings.about_us');
            Route::post('about-us/update',[SettingsController::class,'updateAboutUs'])->name('settings.about_us_update');
        });

        // feedbacks
        Route::post('feedbacks/get-translations',[FeedbacksController::class,'getTranslations']);
        Route::get('feedbacks/search',[FeedbacksController::class,'search'])->name('feedbacks.search');
        Route::resource('feedbacks',FeedbacksController::class);

        // menus
        Route::get('menus/search',[MenusController::class,'search'])->name('menus.search');
        Route::post('menus/get-items',[MenuItemsController::class,'getItems']);
        Route::resource('menus',MenusController::class);

        // menu items
        Route::get('menu-items/search',[MenuItemsController::class,'search'])->name('menu-items.search');
        Route::resource('menu-items',MenuItemsController::class);

        // contact requests
        Route::get('contacts/search',[PanelController::class,'searchContacts'])->name('contacts.search');
        Route::get('contacts',[PanelController::class,'contactRequest'])->name('contacts.index');
    });

});


// *********************** Site Routes ***************
Route::get('/',[IndexController::class,'home'])->name('home');
Route::get('/contact-us/',[IndexController::class,'contactUs'])->name('contact_us');
Route::get('/about-us/',[IndexController::class,'aboutUs'])->name('about_us');
Route::get('/article/{post}/',[IndexController::class,'article'])->name('post.show');
Route::get('/articles/',[IndexController::class,'articles'])->name('posts');
Route::get('/portfolio/{portfolio}/',[IndexController::class,'portfolio'])->name('portfolio.show');
Route::get('/portfolios/',[IndexController::class,'portfolios'])->name('portfolios');
Route::get('/{page}/',[IndexController::class,'page'])->name('page.show');
Route::get('/category/{category}/',[IndexController::class,'postCategory'])->name('post_category.show');
Route::get('/portfolio-cat/{category}/',[IndexController::class,'portfolioCategory'])->name('portfolio_category.show');
Route::get('/tag/{tag}/',[IndexController::class,'tag'])->name('tag.show');
Route::get('/search/',[IndexController::class,'search'])->name('search');
Route::post('/change-lang',[IndexController::class,'changeLang'])->name('change_lang');
Route::post('contact-form',[IndexController::class,'storeContact'])->name('contact_form');
