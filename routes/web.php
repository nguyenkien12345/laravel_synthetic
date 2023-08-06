<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorldCupController;
use App\Http\Controllers\MutiStepFormController;
use App\Http\Controllers\InfiniteScrollPaginationController;
use App\Http\Controllers\ScrapingController;
use App\Http\Controllers\UploadMillionRecordController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AutoCompleteSearchController;
use App\Http\Controllers\GoogleCalendarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Start dự án Polling
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('poll')->middleware('auth')->group(function () {
    Route::view('create', 'polls.create')->name('poll.create');
    Route::post('/store', [PollController::class, 'store'])->name('poll.store');

    Route::get('/', [PollController::class, 'index'])->name('poll.index');

    Route::get('/update/{poll}', [PollController::class, 'edit'])->name('poll.edit');
    Route::put('/update/{poll}', [PollController::class, 'update'])->name('poll.update');

    Route::get('/delete/{poll}', [PollController::class, 'delete'])->name('poll.delete');

    Route::get('/{poll}', [PollController::class, 'show'])->name('poll.show');
    Route::post('/{poll}/vote', [PollController::class, 'vote'])->name('poll.vote');
});

require __DIR__ . '/auth.php';
// End dự án Polling

// Start dự án world cup
Route::prefix('world-cup')->middleware('auth')->group(function () {
    Route::get('/', [WorldCupController::class, 'index'])->name('world-cup.index');
    // Ta nhận về name (name chính là 1 column trong bảng team (nếu không truyền gì thì mặc định sẽ lấy column id trong bảng team để get detail))
    Route::get('/team/edit/{team:name}', [WorldCupController::class, 'edit'])->name('world-cup.team.edit');
    Route::put('/team/update/{team}', [WorldCupController::class, 'update'])->name('world-cup.team.update');
});
// End dự án world cup

// Start dự án quản lý email
Route::prefix('mail')->group(function () {
    Route::get('send-mail', [MailController::class, 'sendEmail'])->name('mail.send-mail');
    Route::get('theme', [MailController::class, 'theme'])->name('mail.theme');
    Route::post('active-theme', [MailController::class, 'activeTheme'])->name('mail.active-theme');
});
// End dự án quản lý email

// Start dự án chart
Route::prefix('chart')->group(function () {
    Route::get('user-register-bar-chart', [ChartController::class, 'userRegisterBarChart'])->name('chart.user-register-bar-chart');
    Route::get('user-register-high-chart', [ChartController::class, 'userRegisterHighChart'])->name('chart.user-register-high-chart');
});
// End dự án chart

// Start dự án excel
Route::prefix('excel')->group(function () {
    Route::get('export-data', [ExcelController::class, 'exportData'])->name('export-data');
});
// End dự án excel

// Start dự án multistepform
Route::prefix('multistepform')->group(function (){
    Route::get('', [MutiStepFormController::class, 'index'])->name('multistepform');
    Route::post('/submitForm', [MutiStepFormController::class, 'submitForm'])->name('multistepform.submitForm');
}) ;
// End dự án multistepform

// Start dự án infinite scroll pagination
Route::prefix('infinite-scroll-pagination')->group(function (){
    Route::get('', [InfiniteScrollPaginationController::class, 'index'])->name('infinite-scroll-pagination');
    Route::get('/get-more-blog', [InfiniteScrollPaginationController::class, 'getMoreBlogInfiniteScroll'])->name('infinite-scroll-pagination.get-more-blog');
}) ;
// End dự án infinite scroll pagination

// Start dự án scraping
Route::prefix('scraping')->group(function (){
    Route::get('', [ScrapingController::class, 'index'])->name('scraping');
}) ;
// End dự án scraping

// start dự án Upload Million Record
Route::prefix('upload-million-record')->group(function(){
    Route::get('', [UploadMillionRecordController::class, 'index'])->name('upload-million-record');
    Route::post('/upload', [UploadMillionRecordController::class, 'uploadMillionRecord'])->name('upload-million-record.upload');
    Route::get('watch-batch', [UploadMillionRecordController::class, 'watchBatch'])->name('upload-million-record.watch-batch');
});
// End dự án Upload Million Record

// Start dự án Image
Route::prefix('image')->group(function(){
    Route::get('resize-image', [ImageController::class, 'resizeImage'])->name('image.resize-image');
    Route::post('handle-resize-image', [ImageController::class, 'resizeImageSubmit'])->name('image.handle-resize-image');

    Route::get('dropzone-image', [ImageController::class, 'dropzoneImage'])->name('image.dropzone-image');
    Route::post('handle-dropzone-image', [ImageController::class, 'dropzoneImageSubmit'])->name('image.handle-dropzone-image');

    Route::get('lazy-load-image', [ImageController::class, 'lazyLoadImage'])->name('image.lazy-load-image');
});
// End dự án Image

// Start dự án Auto Complete Search
Route::prefix('auto-complete-search')->group(function(){
    Route::get('', [AutoCompleteSearchController::class, 'index'])->name('auto-complete-search.index');
    Route::get('list-team', [AutoCompleteSearchController::class, 'listTeam'])->name('auto-complete-search.list-team');
});
// End dự án Auto Complete Search

// Start dự án Google Calendar
Route::prefix('google-calendar')->group(function(){
    Route::get('', [GoogleCalendarController::class, 'index'])->name('google-calendar.index');
    Route::post('add-booking', [GoogleCalendarController::class, 'addBooking'])->name('google-calendar.add-booking');
    Route::delete('delete-booking/{id}', [GoogleCalendarController::class, 'deleteBooking'])->name('google-calendar.delete-booking');
});
// End dự án Google Calendar
