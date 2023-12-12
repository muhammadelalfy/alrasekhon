<?php

use App\Http\Controllers\Api\V1\ActivityLogController;
use App\Http\Controllers\Api\V1\AdvertisementController;
use App\Http\Controllers\Api\V1\ArbitrationBandController;
use App\Http\Controllers\Api\V1\ArbitrationCommitteeController;
use App\Http\Controllers\Api\V1\ArbitrationTypeController;
use App\Http\Controllers\Api\V1\ArbitratorController;
use App\Http\Controllers\Api\V1\ArbitratorLevelController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Auth\ResetPasswordController;
use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\CommitteeChairmanController;
use App\Http\Controllers\Api\V1\CommitteeMemberController;
use App\Http\Controllers\Api\V1\CompetitionController;
use App\Http\Controllers\Api\V1\CompetitionLevelController;
use App\Http\Controllers\Api\V1\CompetitionTypeController;
use App\Http\Controllers\Api\V1\ConcertHonoringController;
use App\Http\Controllers\Api\V1\ContestantController;
use App\Http\Controllers\Api\V1\ContestantLevelController;
use App\Http\Controllers\Api\V1\CountryController;
use App\Http\Controllers\Api\V1\FileController;
use App\Http\Controllers\Api\V1\FilterController;
use App\Http\Controllers\Api\V1\GeneralSettingsController;
use App\Http\Controllers\Api\V1\GovernorateController;
use App\Http\Controllers\Api\V1\JuzController;
use App\Http\Controllers\Api\V1\MethodController;
use App\Http\Controllers\Api\V1\PermissionController;
use App\Http\Controllers\Api\V1\ReadingController;
use App\Http\Controllers\Api\V1\ReportExportController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\SampleController;
use App\Http\Controllers\Api\V1\StageController;
use App\Http\Controllers\Api\V1\SuraController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ViceCommitteeChairmanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('changeLocale/{locale}', function ($locale) {
    \Illuminate\Support\Facades\App::setLocale($locale);
    return \Illuminate\Support\Facades\App::getLocale();
});

Route::get('url', function (){
    return response()->json(['url' => 'https://dispatcher.phzdispatch.com/']);
});

//authentication
Route::post('login', LoginController::class);

Route::post('change-password', [ResetPasswordController::class,'changePassword'])->name('changePassword');
Route::post('reset-password', [ResetPasswordController::class,'sendLink'])->name('changePassword');

Route::resource('files', FileController::class)->only(['store', 'destroy']);

//apis for dynamics
//Route::group(['prefix'=>'dynamics','middleware'=>'dynamics.auth'], function(){
//    //put orders in our database
//    Route::post('orders', [DynamicsOrderController::class, 'store']);
//    //update invoice status
//    Route::post('orders/invoice/status', [DynamicsOrderController::class, 'updateInvoiceStatus']);
//});

Route::middleware('auth:sanctum')->group(function(){

    Route::post('logout', LogoutController::class);

    Route::resource('roles', RoleController::class)->except('edit', 'create');
    Route::get('permissions', PermissionController::class);
    Route::get('roles/{id?}/change-status', [RoleController::class,'toggle']);

    Route::get('/filters/{model}', FilterController::class);

    Route::resource('users', UserController::class)->except('create','edit');
    Route::post('users/upload',[UserController::class, 'upload']);
    Route::get('users/{id?}/change-status',[UserController::class, 'toggle']);


    Route::post('users/update-step/{user}',[UserController::class, 'updateStep']);
    //governorates
    Route::get('governorate/{id?}/change-status',[GovernorateController::class, 'toggle']);
    Route::resource('governorate', GovernorateController::class)->except('create', 'edit', 'show');

    //countries
    Route::get('country/{id?}/change-status',[CountryController::class, 'toggle']);
    Route::resource('country', CountryController::class)->except('create', 'edit', 'show');

    //cities
    Route::get('city/{id?}/change-status',[CityController::class, 'toggle']);
    Route::resource('city', CityController::class)->except('create', 'edit', 'show');

    //**************************** Settings *****************************************//

    //Competition types
    Route::get('competition-types/{id?}/change-status',[CompetitionTypeController::class, 'toggle']);
    Route::resource('competition-types', CompetitionTypeController::class)->except('create', 'edit', 'show');

    //Contestant levels
    Route::get('contestant-levels/{id?}/change-status',[ContestantLevelController::class, 'toggle']);
    Route::resource('contestant-levels', ContestantLevelController::class)->except('create', 'edit', 'show');

    //Arbitrator levels
    Route::get('arbitrator-levels/{id?}/change-status',[ArbitratorLevelController::class, 'toggle']);
    Route::resource('arbitrator-levels', ArbitratorLevelController::class)->except('create', 'edit', 'show');

    //Arbitrators
    Route::get('arbitrators/{id?}/change-status',[ArbitratorController::class, 'toggle']);
    Route::resource('arbitrators', ArbitratorController::class)->except('create', 'edit');
    Route::post('arbitrators/upload',[ArbitratorController::class, 'upload']);
    Route::post('arbitrators/update-step/{arbitrator}',[ArbitratorController::class, 'updateStep']);
    Route::post('arbitrators/add-work-experience/{arbitrator}',[ArbitratorController::class, 'addWorkExperience']);
    Route::post('arbitrators/delete-work-experience/{arbitrator}',[ArbitratorController::class, 'deleteWorkExperience']);

    Route::post('arbitrators/add-reading/{arbitrator}',[ArbitratorController::class, 'addReading']);
    Route::post('arbitrators/delete-reading/{arbitrator}',[ArbitratorController::class, 'deleteReading']);

    // Competitions

    Route::group(['prefix' => 'competitions'] , function (){
        Route::get('{id?}/change-status',[CompetitionController::class, 'toggle']);
        Route::apiResource('/', CompetitionController::class);
        Route::get('{competition}',[CompetitionController::class, 'show']);
        Route::post('/upload',[CompetitionController::class, 'upload']);
        Route::post('/add-update-place/{competition}',[CompetitionController::class, 'addUpdatePlace']);
        Route::post('/add-update-stages/{competition}',[CompetitionController::class, 'addUpdateStages']);
        Route::post('update-concert-honoring/{competition}',[CompetitionController::class, 'update_concert_honoring']);
        Route::post('update-prize/{competition}',[CompetitionController::class, 'update_prize']);
    });
    Route::get('competitions/{id?}/change-status',[CompetitionController::class, 'toggle']);
    Route::resource('/competitions', CompetitionController::class)->except('create', 'edit');
    Route::post('competitions/upload',[CompetitionController::class, 'upload']);
    Route::post('competitions/add-update-place/{competition}',[CompetitionController::class, 'addUpdatePlace']);
    Route::post('competitions/add-update-stages/{competition}',[CompetitionController::class, 'addUpdateStages']);
    Route::post('competitions/add-update-concert-honoring/{competition}',[CompetitionController::class, 'addUpdateConcertHonoring']);
    Route::post('competitions/add-update-condition/{competition}',[CompetitionController::class, 'addUpdateCondition']);
    Route::post('competitions/add-update-advertisement/{competition}',[CompetitionController::class, 'addUpdateAdvertisement']);

    Route::post('competitions/add-update-prizes/{competition}',[CompetitionController::class, 'addUpdatePrizes']);

    Route::post('competitions/update-competition-level/{competition}',[CompetitionController::class, 'update_level']);


    //suras
    Route::resource('sura', SuraController::class);
 //juz
    Route::resource('juz', JuzController::class);

//    Route::get('suras',[\App\Http\Controllers\Api\V1\SuraController::class, 'getSuras']);
    //Methods
    Route::get('methods/{id?}/change-status',[MethodController::class, 'toggle']);
    Route::resource('methods', MethodController::class)->only('index');

    //Reading
    Route::get('readings/{id?}/change-status',[ReadingController::class, 'toggle']);
    Route::resource('readings', ReadingController::class)->only('index');


    //Competition levels
    Route::resource('competition-levels', CompetitionLevelController::class);

    //Committees members
    Route::get('committee-members/{id?}/change-status',[CommitteeMemberController::class, 'toggle']);
    Route::resource('committee-members', CommitteeMemberController::class)->only('index');

    //Committees members
    Route::get('committee-chairman/{id?}/change-status',[CommitteeChairmanController::class, 'toggle']);
    Route::resource('committee-chairman', CommitteeChairmanController::class)->only('index');

    //Committees members
    Route::get('committee-chairman/{id?}/change-status',[CommitteeChairmanController::class, 'toggle']);
    Route::resource('committee-chairman', CommitteeChairmanController::class)->only('index');

    //Committees members
    Route::get('vice-committee-chairman/{id?}/change-status',[ViceCommitteeChairmanController::class, 'toggle']);
    Route::resource('vice-committee-chairman', ViceCommitteeChairmanController::class)->only('index');


    //Competition levels
    Route::get('arbitration-committees/{id?}/change-status',[ArbitrationCommitteeController::class, 'toggle']);
    Route::resource('arbitration-committees', ArbitrationCommitteeController::class)->except('create', 'edit');


    //Advertisements
    Route::get('advertisements/{id?}/change-status',[AdvertisementController::class, 'toggle']);
    Route::resource('advertisements', AdvertisementController::class)->except('create', 'edit', 'show');
    Route::post('advertisements/upload',[AdvertisementController::class, 'upload']);


    //Contestants
//    Route::get('concert-honoring/{id?}/change-status',[ConcertHonoringController::class, 'toggle']);
    Route::resource('concert-honoring', ConcertHonoringController::class)->only('index');


    //Contestants
    Route::get('contestants/{id?}/change-status',[ContestantController::class, 'toggle']);
    Route::resource('contestants', ContestantController::class)->except('create', 'edit');
    Route::post('contestants/upload',[ContestantController::class, 'upload']);
    Route::post('contestants/update-step/{contestant}',[ContestantController::class, 'updateStep']);

    //Sample
    Route::resource('samples', SampleController::class);

    //arbitration bands
    Route::get('arbitration-bands/{id?}/change-status',[ArbitrationBandController::class, 'toggle']);
    Route::resource('arbitration-bands', ArbitrationBandController::class);

    //arbitration types
    Route::get('arbitration-types/{id?}/change-status',[ArbitrationTypeController::class, 'toggle']);
    Route::resource('arbitration-types', ArbitrationTypeController::class);
    //stages types
    Route::get('stages/{id?}/change-status',[StageController::class, 'toggle']);
    Route::resource('stages', StageController::class)->except('create', 'edit', 'show');

    Route::group(['prefix' => 'settings'], function(){
        Route::controller(ActivityLogController::class)->group(function () {
            Route::group(['prefix' => 'logs'], function(){
                Route::get('', 'index');
                Route::get('modules-actions', 'getModulesActions');
            });
        });
//        Route::resource('notes', NoteController::class)->except('edit','create', 'show');
        Route::resource('general', GeneralSettingsController::class)->only('index','update');
        Route::post('update', [GeneralSettingsController::class,'update']);
    });
    //**************************** Settings *****************************************//

//    Route::controller(OrderController::class)->group(function () {
//        Route::group(['prefix' => 'orders'], function(){
//            Route::get('/', 'index');
//            Route::group(['prefix' => '/{id}'], function(){
//                Route::post('assign',  'assign');
//                Route::post('note', 'addNote');
//                Route::post('check-on-hand-items', 'checkItemsOnHand');
//                Route::post('manual-sync-to-dynamics', 'manualSyncToDynamics');
//                Route::group(['prefix' => '/status'], function(){
//                    Route::post('cancel', 'cancelOrder');
//                    Route::post('reassign', 'reassignOrder');
//                });
//            });
//        });
//    });

//    Route::controller(OrderStatusController::class)->group(function () {
//        Route::group(['prefix' => 'orders/statuses'], function () {
//            Route::get('/statistics', 'getStatistics');
//            Route::get('/', 'getStatuses');
//        });
//    });

//    Route::controller(ItemController::class)->group(function () {
//        Route::group(['prefix' => 'items'], function(){
//            Route::get('', 'index');
//        });
//    });

    Route::group(['prefix' => 'export-excel'], function(){
        Route::controller(ReportExportController::class)->group(function (){
            Route::group(['prefix' => 'reports'], function(){
                Route::get('delivery-time', 'deliveryTimeExport');
                Route::get('driver-order-count', 'driverOrderCountExport');
                Route::get('orders-delivery-duration', 'OrdersDeliveryDurationExport');
                Route::get('sales-orders', 'salesOrdersExport');
                Route::get('customer-orders', 'customerOrdersExport');
                Route::get('drivers', 'driversExport');
            });
        });
    });

});
