<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Admin\DashboardController;
use App\Http\Controllers\API\Admin\PropertyController;
use App\Http\Controllers\API\Admin\QuestionController;
use App\Http\Controllers\API\Admin\ArticleController;
use App\Http\Controllers\API\Admin\CareerController;
use App\Http\Controllers\API\Admin\FacilityController;
use App\Http\Controllers\API\Admin\FeatureController;
use App\Http\Controllers\API\Admin\ApplicationController;
use App\Http\Controllers\API\Admin\AppointmentController;
use App\Http\Controllers\API\Admin\BuildingController;
use App\Http\Controllers\API\Admin\ItemController;
use App\Http\Controllers\API\Admin\PlanController;
use App\Http\Controllers\API\Admin\UnitController;
use App\Http\Controllers\API\Admin\ListingController;
use App\Http\Controllers\API\Admin\CertificateController;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\Admin\ImageController;
use App\Http\Controllers\API\Admin\TestimonialController;
use App\Http\Controllers\API\Admin\ProfileController;
use App\Http\Controllers\API\Admin\SubscriberController;
use App\Http\Controllers\API\Admin\InquiryController;
use App\Http\Controllers\API\Admin\VideoController;
use App\Http\Controllers\API\Admin\ContractController;
use App\Http\Controllers\API\Admin\PropertyListingsController;
use App\Http\Controllers\API\UserSideController;


/*
|---------------------------------------------------------------------- ----
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('throttle:150,1')->group(function () {
    Route::prefix('users')->group(function () {
        Route::post('', [UserController::class, 'create']);
        Route::post('login', [UserController::class, 'login']);
        Route::post('request-reset', [UserController::class, 'requestReset']);
        Route::post('reset-password', [UserController::class, 'resetPassword']);
    });

    Route::middleware('auth.admin')->group(function () {
        Route::prefix('dashboard')->group(function () {
            Route::get('get-counts', [DashboardController::class, 'getCounts']);
        });

        Route::prefix('users')->group(function () {
            Route::get('', [UserController::class, 'getAll']);
            Route::get('{id}', [UserController::class, 'get']);
            Route::put('', [UserController::class, 'update']);
            Route::post('logout', [UserController::class, 'logout']);

            Route::post('admin-emails', [UserController::class, 'getAdminEmails']);
        });

        Route::prefix('properties')->group(function () {
            Route::get('', [PropertyController::class, 'getAll']);
            Route::get('{id}', [PropertyController::class, 'get']);
            Route::post('', [PropertyController::class, 'create']);
            Route::put('', [PropertyController::class, 'update']);
            Route::delete('{id}', [PropertyController::class, 'delete']);

            Route::post('set/{id}', [PropertyController::class, 'set']);
        });

        Route::prefix('property')->group(function () {
            Route::get('', [PropertyListingsController::class, 'getAll']);
            Route::get('{id}', [PropertyListingsController::class, 'get']);
            Route::post('', [PropertyListingsController::class, 'create']);
            Route::put('', [PropertyListingsController::class, 'update']);
            Route::delete('{id}', [PropertyListingsController::class, 'delete']);

            Route::post('set/{id}', [PropertyListingsController::class, 'set']);
        });

        Route::prefix('inquiries')->group(function () {
            Route::get('', [InquiryController::class, 'getAll']);
            Route::get('{id}', [InquiryController::class, 'get']);
            Route::post('', [InquiryController::class, 'create']);
            Route::put('', [InquiryController::class, 'update']);
            Route::delete('{id}', [InquiryController::class, 'delete']);

            Route::post('change-status', [InquiryController::class, 'changeStatus']);
        });

        Route::prefix('questions')->group(function () {
            Route::get('', [QuestionController::class, 'getAll']);
            Route::get('{id}', [QuestionController::class, 'get']);
            Route::post('', [QuestionController::class, 'create']);
            Route::put('', [QuestionController::class, 'update']);
            Route::delete('{id}', [QuestionController::class, 'delete']);
        });

        Route::prefix('articles')->group(function () {
            Route::get('', [ArticleController::class, 'getAll']);
            Route::get('{id}', [ArticleController::class, 'get']);
            Route::post('', [ArticleController::class, 'create']);
            Route::put('', [ArticleController::class, 'update']);
            Route::delete('{id}', [ArticleController::class, 'delete']);
        });

        Route::prefix('careers')->group(function () {
            Route::get('', [CareerController::class, 'getAll']);
            Route::get('{id}', [CareerController::class, 'get']);
            Route::post('', [CareerController::class, 'create']);
            Route::put('', [CareerController::class, 'update']);
            Route::delete('{id}', [CareerController::class, 'delete']);
        });

        Route::prefix('features')->group(function () {
            Route::get('', [FeatureController::class, 'getAll']);
            Route::get('{id}', [FeatureController::class, 'get']);
            Route::post('', [FeatureController::class, 'create']);
            Route::put('', [FeatureController::class, 'update']);
            Route::delete('{id}', [FeatureController::class, 'delete']);
        });

        Route::prefix('facilities')->group(function () {
            Route::get('', [FacilityController::class, 'getAll']);
            Route::get('{id}', [FacilityController::class, 'get']);
            Route::post('', [FacilityController::class, 'create']);
            Route::put('', [FacilityController::class, 'update']);
            Route::delete('{id}', [FacilityController::class, 'delete']);
        });

        Route::prefix('applications')->group(function () {
            Route::get('', [ApplicationController::class, 'getAll']);
            Route::get('{id}', [ApplicationController::class, 'get']);
            Route::post('', [ApplicationController::class, 'create']);
            Route::put('', [ApplicationController::class, 'update']);
            Route::delete('{id}', [ApplicationController::class, 'delete']);
        });

        Route::prefix('buildings')->group(function () {
            Route::get('', [BuildingController::class, 'getAll']);
            Route::get('{id}', [BuildingController::class, 'get']);
            Route::post('', [BuildingController::class, 'create']);
            Route::put('', [BuildingController::class, 'update']);
            Route::delete('{id}', [BuildingController::class, 'delete']);
        });

        Route::prefix('plans')->group(function () {
            Route::get('', [PlanController::class, 'getAll']);
            Route::get('{id}', [PlanController::class, 'get']);
            Route::post('', [PlanController::class, 'create']);
            Route::put('', [PlanController::class, 'update']);
            Route::delete('{id}', [PlanController::class, 'delete']);
        });

        Route::prefix('units')->group(function () {
            Route::get('', [UnitController::class, 'getAll']);
            Route::get('{id}', [UnitController::class, 'get']);
            Route::post('', [UnitController::class, 'create']);
            Route::put('', [UnitController::class, 'update']);
            Route::delete('{id}', [UnitController::class, 'delete']);
        });

        Route::prefix('items')->group(function () {
            Route::get('', [ItemController::class, 'getAll']);
            Route::get('{id}', [ItemController::class, 'get']);
            Route::post('', [ItemController::class, 'create']);
            Route::put('', [ItemController::class, 'update']);
            Route::delete('{id}', [ItemController::class, 'delete']);
        });

        Route::prefix('appointments')->group(function () {
            Route::get('', [AppointmentController::class, 'getAll']);
            Route::get('{id}', [AppointmentController::class, 'get']);
            Route::post('', [AppointmentController::class, 'create']);
            Route::put('', [AppointmentController::class, 'update']);
            Route::delete('{id}', [AppointmentController::class, 'delete']);

            Route::post('change-status', [AppointmentController::class, 'changeStatus']);
        });

        Route::prefix('listings')->group(function () {
            Route::get('', [ListingController::class, 'getAll']);
            Route::get('{id}', [ListingController::class, 'get']);
            Route::post('', [ListingController::class, 'create']);
            Route::put('', [ListingController::class, 'update']);
            Route::delete('{id}', [ListingController::class, 'delete']);

            Route::post('change-status', [ListingController::class, 'changeStatus']);
        });

        Route::prefix('certificates')->group(function () {
            Route::get('', [CertificateController::class, 'getAll']);
            Route::get('{id}', [CertificateController::class, 'get']);
            Route::post('', [CertificateController::class, 'create']);
            Route::put('', [CertificateController::class, 'update']);
            Route::delete('{id}', [CertificateController::class, 'delete']);
        });

        Route::prefix('images')->group(function () {
            Route::get('', [ImageController::class, 'getAll']);
            Route::get('{id}', [ImageController::class, 'get']);
            Route::post('', [ImageController::class, 'create']);
            Route::put('', [ImageController::class, 'update']);
            Route::delete('{id}', [ImageController::class, 'delete']);
        });

        Route::prefix('testimonials')->group(function () {
            Route::get('', [TestimonialController::class, 'getAll']);
            Route::get('{id}', [TestimonialController::class, 'get']);
            Route::post('', [TestimonialController::class, 'create']);
            Route::put('', [TestimonialController::class, 'update']);
            Route::delete('{id}', [TestimonialController::class, 'delete']);

            Route::post('change-status', [TestimonialController::class, 'changeStatus']);
        });

        Route::prefix('profiles')->group(function () {
            Route::get('', [ProfileController::class, 'getAll']);
            Route::get('{id}', [ProfileController::class, 'get']);
            Route::post('', [ProfileController::class, 'create']);
            Route::put('', [ProfileController::class, 'update']);
            Route::delete('{id}', [ProfileController::class, 'delete']);
        });

        Route::prefix('subscribers')->group(function () {
            Route::get('', [SubscriberController::class, 'getAll']);
            Route::get('{id}', [SubscriberController::class, 'get']);
            Route::post('', [SubscriberController::class, 'create']);
            Route::put('', [SubscriberController::class, 'update']);
            Route::delete('{id}', [SubscriberController::class, 'delete']);
        });

        Route::prefix('videos')->group(function () {
            Route::get('', [VideoController::class, 'getAll']);
            Route::get('{id}', [VideoController::class, 'get']);
            Route::post('', [VideoController::class, 'create']);
            Route::put('', [VideoController::class, 'update']);
            Route::delete('{id}', [VideoController::class, 'delete']);
        });

        Route::prefix('contracts')->group(function () {
            Route::get('', [ContractController::class, 'getAll']);
            Route::get('{id}', [ContractController::class, 'get']);
            Route::post('', [ContractController::class, 'create']);
            Route::put('', [ContractController::class, 'update']);
            Route::delete('{id}', [ContractController::class, 'delete']);
        });
    });

    Route::prefix('user')->middleware('auth.user')->group(function () {
        Route::get('', [UserSideController::class, 'getUser']);

        Route::get('featured-property', [UserSideController::class, 'featuredProperty']);
        Route::get('filter-properties', [UserSideController::class, 'filterProperties']);
        Route::post('submit-property', [UserSideController::class, 'submitProperty']);
        Route::post('request-viewing', [UserSideController::class, 'requestViewing']);
        Route::post('submit-application', [UserSideController::class, 'submitApplication']);
        Route::post('subscribe', [UserSideController::class, 'subscribe']);
        Route::post('submit-inquiry', [UserSideController::class, 'submitInquiry']);
        Route::post('submit-testimonial', [UserSideController::class, 'submitTestimonial']);

        Route::prefix('properties')->group(function () {
            Route::get('', [UserSideController::class, 'propertiesGetAll']);
            Route::get('{id}', [UserSideController::class, 'propertiesGet']);
        });

        Route::prefix('property')->group(function () {
            Route::get('', [UserSideController::class, 'propertyGetAll']);
            Route::get('{id}', [UserSideController::class, 'propertyGet']);
        });


        Route::prefix('listings')->group(function () {
            Route::get('', [UserSideController::class, 'listingsGetAll']);
            Route::get('{id}', [UserSideController::class, 'listingsGet']);
        });

        Route::prefix('articles')->group(function () {
            Route::get('', [UserSideController::class, 'articlesGetAll']);
            Route::get('{id}', [UserSideController::class, 'articlesGet']);
        });

        Route::prefix('careers')->group(function () {
            Route::get('', [UserSideController::class, 'careersGetAll']);
            Route::get('{id}', [UserSideController::class, 'careersGet']);
        });

        Route::prefix('applications')->group(function () {
            Route::post('', [ApplicationController::class, 'create']);
        });

        Route::prefix('questions')->group(function () {
            Route::get('', [UserSideController::class, 'questionsGetAll']);
        });
    });

    Route::get('user/unsubscribe/{email}', [UserSideController::class, 'unsubscribe']);
});
