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

Route::get('admin', 'IndexController@index')->name('login'); // for redirection purpose
Route::name('admin.')->group(
    function () {

    	Route::get('/', 'IndexController@index');

        # to show login form
        Route::get('/auth/login', [
            'uses'  => 'Auth\LoginController@showLoginForm',
            'as'    => 'auth.login'
        ]);

        # login form submits to this route
        Route::post('/auth/login', [
            'uses'  => 'Auth\LoginController@login',
            'as'    => 'auth.login'
        ]);

        # logs out admin user
        # it was post method before I recieved MethodNotAllowedHttpException
        Route::any('/auth/logout', [
            'uses'  => 'Auth\LoginController@logout',
            'as'    => 'auth.logout'
        ]);

        # Password reset routes
        Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
        Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

        # shows dashboard
        Route::get('dashboard', [
            'uses'  => 'DashboardController@index',
            'as'    => 'dashboard.index'
        ]);
        Route::get('update-profile', 'AdministratorsController@editProfile')->name('update-profile');
        Route::resource('administrators', 'AdministratorsController');
        Route::resource('site-settings', 'SiteSettingsController');
        Route::resource('pages', 'PagesController');
        Route::resource('payout', 'PayoutController');
        Route::get('payout/pay/{id}', 'PayoutController@payout')->name('payout');
        Route::resource('contact', 'ContactController');
        Route::resource('faq', 'FaqController');
        Route::resource('users', 'UsersController');
        Route::resource('blogs', 'BlogsController');
        Route::resource('blog-categories', 'BlogCategoriesController');
        Route::resource('featured-images', 'FeaturedImagesController');
        Route::resource('testimonials', 'TestimonialsController');
        Route::resource('vendors', 'VendorsController');
        Route::resource('media-files', 'MediaFilesController');
        Route::resource('services','ServicesController');
        Route::resource('service_sections','ServiceSectionsController');
        Route::resource('category','CategoryController');
        Route::resource('custom_services','CustomServicesController');
        Route::get('vendors/{id}/custom_services','VendorsController@listing');
        Route::get('user/{id}/custom_services','UsersController@listing');
        Route::get('user/{id}/registries','UsersController@registryListing');
        Route::resource('banner','BannerController');
        Route::resource('registry_services','RegistryServiceController');
        Route::resource('registry','RegistryController');
    }
);
