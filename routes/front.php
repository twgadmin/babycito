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

Route::get('deploy', function() {
    if ($_SERVER['SERVER_ADDR'] != '127.0.0.1') {

        $output = shell_exec('cd ' . __DIR__ . '/../ && git pull && php artisan optimize:clear && php artisan migrate && php artisan db:seed --class=ServicesTableSeeder && php artisan db:seed --class=RegistryEvents && php artisan db:seed --class=ServiceSectionsTableSeeder && php artisan db:seed --class=BannersTableSeeder && composer dump-autoload');
        echo '<pre>';
        print_r($output);echo '<br>';
        echo '</pre>';
        die();
    }
});

Auth::routes(); 
Route::post('/provider-register', 'Auth\ProviderRegisterController@register')->name('provider-register');
Route::get('/providerregister', 'Auth\ProviderRegisterController@showRegistrationForm')->name('providerregister');
Route::post('/provider-login', 'Auth\ProviderLoginController@login')->name('provider-login');
Route::get('/providerlogin', 'Auth\ProviderLoginController@showLoginForm')->name('providerlogin');
Route::get('/', 'HomeController@index')->name('public.index');
Route::get('/about-us', 'HomeController@about')->name('about-us');
Route::post('/newsletter', 'HomeController@newsletter')->name('subscribe-newsletter');
Route::get('/download-free-service-guide-pdf', 'HomeController@downloadFreeServiceGuidePdf')->name('download.free.0service.guide.pdf');
Route::post('/download-free-service-guide', 'HomeController@downloadFreeServiceGuide')->name('download.free.0service.guide');
Route::get('/registry', 'HomeController@registry')->name('registry');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::post('/blog-category', 'HomeController@blogCategory')->name('blog-category');
Route::get('/blog/{id}', 'HomeController@blogPost')->name('blog-post');
Route::get('/contact-us', 'HomeController@contact')->name('contact-us');
Route::post('/contact-us', 'HomeController@contactSave')->name('contact-us-save');
Route::get('/terms-and-conditions', 'HomeController@termsnconditions')->name('terms-and-conditions');
Route::get('/privacy-policy', 'HomeController@privacypolicy')->name('privacy-policy');
Route::get('/cookie-policy', 'HomeController@cookiepolicy')->name('cookie-policy');
Route::get('/help-center', 'HomeController@helpcenter')->name('help-center');
Route::get('/find-registry', 'HomeController@findregistry')->name('find-registry');
Route::get('/search_registry', 'HomeController@searchRegistryUser')->name('search-registry');
Route::get('/share_registry/{hash_code}', 'HomeController@shareRegistryLink')->name('share-registry');
Route::put('/share_registry/{hash_code}', 'HomeController@saveshareRegistryLink')->name('save-share-registry');
Route::get('/create-registry', 'HomeController@createregistry')->name('create-registry');
Route::post('/create-registry', 'HomeController@saveRegistryUser')->name('create-registry');
Route::post('/create-update-registry-event', 'HomeController@saveRegistryEvent')->name('create-update-registry-event');
Route::get('/delete-registry-event/{id}', 'HomeController@deleteRegistryEvent')->name('delete-registry-event');
Route::get('/registry-checkout', 'HomeController@registrycheckout')->name('registry-checkout');
Route::get('/providers', 'HomeController@providers')->name('providers');
Route::get('/provider-detail/{id}', 'HomeController@providerdetail')->name('provider-detail');
// Route::get('/providers/{slug}', 'CustomServicesController@categoryListing')->name('category');
Route::group(['middleware' =>'auth:web'],function () use ($router){
    Route::get('editUserPassword/{id}','HomeController@editUserPassword')->name('edit-user-password');
    Route::put('editUserPassword/{id}','HomeController@updateUserPassword')->name('update-user-password');
    Route::get('editUser/{id}','HomeController@editUser')->name('edit-user');
    Route::put('editUser/{id}','HomeController@updateUser')->name('update-user');
    Route::get('/services', 'CustomServicesController@serviceListing')->name('service-listing');
    Route::get('/add-new-service/{id?}', 'HomeController@addservice')->name('add-new-service');
    Route::post('custom_services','CustomServicesController@store')->name('custom-services');
    Route::get('custom_services/{id}','CustomServicesController@edit')->name('custom-services.edit');
    Route::put('custom_services/{id}','CustomServicesController@update')->name('custom-services.update');
    Route::get('/view-registry', 'HomeController@viewregistry')->name('view-registry');
    Route::get('/connect/stripe', 'HomeController@connectStripe')->name('connect-stripe');
    Route::get('/gifts', 'HomeController@viewGifts')->name('view-gifts');
    Route::post('add-to-registry','CustomServicesController@addtoregistry')->name('add-to-registry');
    Route::put('registries/{id}','CustomServicesController@registryUpdate')->name('registryUpdate');
    Route::post('request-for-pricing','HomeController@requestForPricing')->name('request-for-pricing');
    // Route::post('custom_services/{id}','CustomServicesController@destroy')->name('custom-services.destroy');
    Route::post('delete-media-images','HomeController@deleteMediaImages')->name('delete.media.images');
    Route::get('delete/{id}/registries','HomeController@deleteCustomService')->name('delete.custom.service.from.registries');
});

      Route::get('/onetimegift/success', 'HomeController@sendOneTimeGiftSuccess')->name('one-time-gift-success');
      Route::get('/onetimegift/cancel', 'HomeController@sendOneTimeGiftCancel')->name('one-time-gift-cancel');
      Route::get('one-time-gift', 'HomeController@oneTimeGift')->name('one.time.gift');
      Route::post('send-one-time-gift', 'HomeController@sendOneTimeGift')->name('send.one.time.gift');      
      Route::get('/resgitry/{user_hash}/{id}', 'HomeController@viewDetailRegistryService')->name('view-detail-registry');
      Route::post('/resgitry/{user_hash}/{id}', 'HomeController@registryServiceCart')->name('registry-add-cart');
      Route::get('/checkout', 'HomeController@checkout')->name('checkout');
      Route::get('/cart-clear', 'HomeController@emptyCart')->name('cart-clear');
      Route::post('delete-cart', 'HomeController@deleteCart')->name('delete-cart');

       Route::get('/checkout/message', 'HomeController@checkoutMessage')->name('checkout-message');

       Route::post('/checkout/message', 'CheckoutController@checkoutMessageSave')->name('checkout-message-save');

       Route::get('/checkout/success', 'CheckoutController@checkoutSuccess')->name('checkout-success');
       Route::get('/checkout/cancel', 'CheckoutController@checkoutCancel')->name('checkout-cancel');
       Route::get('pages/{page_identifire?}', 'HomeController@viewPages')->name('pages');
       Route::get('/view-payment-details/{accountid?}', 'HomeController@viewPaymentDetails')->name('view-payment-details');