<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ApiController;
    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "api" middleware group. Make something great!
    |
    */
    Route::get('test', function () {
        return 'test';
    });

    Route::get('login', [ApiController::class, 'login']);
    Route::get('register', [ApiController::class, 'register']);
    Route::get('contacts', [ApiController::class, 'getContacts']);
    Route::get('contacts/{id}', [ApiController::class, 'getContactById']);
    Route::get('contacts/delete/{id}', [ApiController::class, 'deleteContactbyId']);
    // Route::post('add-contact', [ApiController::class, 'addContact']);
    Route::get('add-contact', [ApiController::class, 'addContact']);
    Route::get('edit-contact/{id}', [ApiController::class, 'editById']);
    
    