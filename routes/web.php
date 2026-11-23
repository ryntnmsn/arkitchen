<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\NewsletterSubscriptionController;
use App\Http\Controllers\Site\QuoteRequestController;
use App\Http\Controllers\Site\DesignRequestController;
use App\Http\Controllers\Site\DesignPreviewController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\NewsletterController;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/sitemap.xml', [SiteController::class, 'sitemap'])->name('sitemap');
Route::get('/services', [SiteController::class, 'services'])->name('services.index');
Route::get('/services/{slug}', [SiteController::class, 'service'])->name('services.show');
Route::get('/gallery', [SiteController::class, 'gallery'])->name('gallery');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [QuoteRequestController::class, 'store'])->middleware('throttle:10,60')->name('contact.store');
Route::get('/design-your-cabinet', [SiteController::class, 'designer'])->name('designer');
Route::post('/design-your-cabinet', [DesignRequestController::class, 'store'])->middleware('throttle:3,60')->name('designer.store');
Route::get('/design-preview/{designRequest}', DesignPreviewController::class)->middleware('signed')->name('design.preview');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [SiteController::class, 'article'])->name('blog.show');

Route::get('admin/login', [AdminAuthController::class, 'create'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'store'])->middleware('throttle:5,1')->name('admin.login.store');
Route::post('newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', AdminDashboardController::class)->name('dashboard');
    Route::post('logout', [AdminAuthController::class, 'destroy'])->name('logout');
    Route::resource('articles', ArticleController::class)->except('show');
    Route::get('newsletter', [NewsletterSubscriptionController::class, 'index'])->name('newsletter.index');
    Route::delete('newsletter/{subscription}', [NewsletterSubscriptionController::class, 'destroy'])->name('newsletter.destroy');
    Route::get('quote-requests', [LeadController::class, 'quotes'])->name('quotes.index');
    Route::get('design-requests', [LeadController::class, 'designs'])->name('designs.index');
    Route::get('quote-requests/{quoteRequest}/attachments/{index}', [LeadController::class, 'quoteAttachment'])->name('quotes.attachment');
    Route::get('design-requests/{designRequest}/attachments/{index}', [LeadController::class, 'designAttachment'])->name('designs.attachment');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
