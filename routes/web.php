<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UploadController;

Route::middleware(['logged'])->group(function () {
    Route::get('/', [CompanyController::class, 'index'])->name('home');

    Route::resource('companies', CompanyController::class)->except(['show']);

    Route::resource('companies.projects', ProjectController::class)->except(['show']);

    Route::resource('companies.projects.folders', FolderController::class)->except(['show']);

    Route::resource('users', UserController::class)->except(['show']);

    Route::patch('user/reset-password', [UserController::class, 'reset_password'])->name('reset.password');

    Route::resource('tags', TagController::class)->except(['show']);

    Route::post('/get-addition', [DocumentController::class, 'getAddition'])->name('get.addition');

    Route::post('/logoutUser', [UserController::class, 'logoutUser'])->name('logout.user');

    Route::post('/fileUpload', [UploadController::class, 'store'])->name('file.store');
    Route::put('/fileUpdate/{id}', [UploadController::class, 'update'])->name('file.update');
});
Route::prefix('companies/{company}/projects/{project}/folders/{folder}/documents')->middleware(['logged'])->name('companies.projects.folders.documents.')->controller(DocumentController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/contracts/create', 'createContract')->name('contracts.create');
    Route::get('/contract-additions/create', 'createContractAddition')->name('contract-additions.create');
    Route::get('/protocols/create', 'createProtocol')->name('protocols.create');
    Route::get('/delivery-statements/create', 'createDeliveryStatement')->name('delivery-statements.create');

    Route::post('/store', 'store')->name('store');

    Route::get('/contracts/{id}/edit', 'editContract')->name('contracts.edit');
    Route::get('/contract-additions/{id}/edit', 'editContractAddition')->name('contract-additions.edit');
    Route::get('/protocols/{id}/edit', 'editProtocol')->name('protocols.edit');
    Route::get('/delivery-statements/{id}/edit', 'editDeliveryStatement')->name('delivery-statements.edit');

    Route::put('/update/{document}', 'update')->name('update');


    Route::get('/contracts/{id}/show', 'showContract')->name('contracts.show');
    Route::get('/contract-additions/{id}/show', 'showContractAddition')->name('contract-additions.show');
    Route::get('/protocols/{id}/show', 'showProtocol')->name('protocols.show');
    Route::get('/delivery-statements/{id}/show', 'showDeliveryStatement')->name('delivery-statements.show');

    Route::delete('/delete/{document}', 'delete')->name('destroy');
});

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/loginUser', [UserController::class, 'loginUser'])->name('login.user');


