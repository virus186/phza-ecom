<?php

use App\Http\Controllers\Admin\PromotionsController;
use Illuminate\Support\Facades\Route;

// Metrics / Key Performance Indicators...
// Show all promotions
Route::get('promotions/', [PromotionsController::class, 'index'])->name('promotions');

// Deal of the day:
Route::get('promotions/dealOfTheDay/edit', [PromotionsController::class, 'editDealOfTheDay'])->name('promotion.dealOfTheDay');
Route::put('promotions/dealOfTheDay/update', [PromotionsController::class, 'updateDealOfTheDay'])->name('promotion.dealOfTheDay.update');

// Featured Products:
Route::get('promotions/featuredItems/edit', [PromotionsController::class, 'editFeaturedItems'])->name('featuredItems.edit');
Route::put('promotions/featuredItems/update', [PromotionsController::class, 'updateFeaturedItems'])->name('update.featuredItems');

// Featured Brands:
Route::get('promotions/featuredBrands/edit', [PromotionsController::class, 'editFeaturedBrands'])->name('featuredBrands.edit');
Route::put('promotions/featuredBrands/update', [PromotionsController::class, 'updateFeaturedBrands'])->name('update.featuredBrands');

// Featured Categories:
Route::get('promotions/featuredCategories/edit', [PromotionsController::class, 'editFeaturedCategories'])->name('promotion.featuredCategories.edit');
Route::put('promotions/featuredCategories/update', [PromotionsController::class, 'updateFeaturedCategories'])->name('promotion.featuredCategories.update');

// Trending Now Categories
Route::get('promotions/trendingNow/edit', [PromotionsController::class, 'editTrendingNow'])->name('promotion.trendingNow.edit');
Route::put('promotions/trendingNow/update', [PromotionsController::class, 'updateTrendingNow'])->name('promotion.trendingNow.update');

// Tagline
Route::get('promotions/tagline/edit', [PromotionsController::class, 'editTagline'])->name('promotion.tagline');
Route::put('promotions/tagline/update', [PromotionsController::class, 'updateTagline'])->name('promotion.tagline.update');

// BestFinds
Route::get('promotions/bestFinds/edit', [PromotionsController::class, 'editBestFinds'])->name('promotion.bestFindsUnder');
Route::put('promotions/bestFinds/update', [PromotionsController::class, 'updateBestFinds'])->name('promotion.bestFindsUnder.update');

// Main Nav Categories
Route::get('promotions/navCat/edit', [PromotionsController::class, 'editNavCategories'])->name('promotion.navCategories.edit');
Route::put('promotions/navCat/update', [PromotionsController::class, 'updateNavCategories'])->name('promotion.navCategories.update');

// Hide Main Nav Item
Route::get('promotions/navigation/edit', [PromotionsController::class, 'editNavigation'])->name('promotion.navigation.edit');
Route::put('promotions/navigation/update', [PromotionsController::class, 'updateNavigation'])->name('promotion.navigation.update');
