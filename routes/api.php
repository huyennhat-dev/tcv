<?php

use Illuminate\Http\Request;
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

Route::prefix('v1')->group(function () {
    Route::post('/login', [App\Http\Controllers\Api\V1\UserController::class, 'login']);
    Route::post('/register', [App\Http\Controllers\Api\V1\UserController::class, 'register']);

    Route::put('/upload_profile/{cus_id}', [App\Http\Controllers\Api\V1\UserController::class, 'uploadProfile']);
    Route::get('/show_account/{cus_id}', [App\Http\Controllers\Api\V1\UserController::class, 'showAccount']);

    Route::put('/changepass', [App\Http\Controllers\Api\V1\UserController::class, 'changePass']);

    Route::get('/books', [App\Http\Controllers\Api\V1\BookController::class, 'showAllBook']);

    Route::get('/delete_history/{id}/{cus_id}', [App\Http\Controllers\Api\V1\HistoryController::class, 'deleteHistory']);

    Route::get('/books/{id}', [App\Http\Controllers\Api\V1\BookController::class, 'showBookById']);

    Route::get('/books/{cus_id}/{truyen_id}/{chapter_slug}', [App\Http\Controllers\Api\V1\ChapterController::class, 'readChapter']);
    Route::get('/list_chapter/{truyen_id}/{sort}', [App\Http\Controllers\Api\V1\ChapterController::class, 'listChapter']);

    Route::get('/library/history/{cus_id}', [App\Http\Controllers\Api\V1\HistoryController::class, 'index']);
    Route::get('/rating/{truyen_id}', [App\Http\Controllers\Api\V1\BookController::class, 'loadRating']);
    Route::post('/post_rating', [App\Http\Controllers\Api\V1\BookController::class, 'postRating']);


    Route::get('/slide', [App\Http\Controllers\Api\V1\HomeController::class, 'slide']);
    Route::get('/latest_novel', [App\Http\Controllers\Api\V1\HomeController::class, 'latestNovel']);
    Route::get('/nominations', [App\Http\Controllers\Api\V1\HomeController::class, 'nominations']);
    Route::get('/popular', [App\Http\Controllers\Api\V1\HomeController::class, 'popular']);
    Route::get('/just_posted', [App\Http\Controllers\Api\V1\HomeController::class, 'justPosted']);
    Route::get('/just_finished', [App\Http\Controllers\Api\V1\HomeController::class, 'justFinished']);

    Route::get('/search_book', [App\Http\Controllers\Api\V1\HomeController::class, 'search_book']);

    Route::get('/fetch_book/{slug}', [App\Http\Controllers\Api\V1\HomeController::class, 'fetchBook']);


    Route::post('/tickbook', [App\Http\Controllers\Api\V1\TickBookController::class, 'tickBook']);
    Route::get('/library/tickbook/{cus_id}', [App\Http\Controllers\Api\V1\TickBookController::class, 'showTickBookByCusId']);
    Route::get('/checktickbook/{cus_id}/{truyen_id}', [App\Http\Controllers\Api\V1\TickBookController::class, 'checkTickBook']);
    Route::get('/delete_tickbook/{id}/{cus_id}', [App\Http\Controllers\Api\V1\TickBookController::class, 'deleteTickbook']);


    Route::post('/comment', [App\Http\Controllers\Api\V1\BookController::class, 'comment']);
    Route::get('/load_comment/{truyen_id}', [App\Http\Controllers\Api\V1\BookController::class, 'load_comment']);

    Route::get('/load_category', [App\Http\Controllers\Api\V1\SortController::class, 'loadCategory']);
    Route::get('/load_personality', [App\Http\Controllers\Api\V1\SortController::class, 'loadPersonality']);
    Route::get('/load_worldScene', [App\Http\Controllers\Api\V1\SortController::class, 'loadWorldScene']);
    Route::get('/load_current', [App\Http\Controllers\Api\V1\SortController::class, 'loadCurrent']);

    Route::get('/sort/sort_by={sortBookUrl}&status={sortStatusUrl}&category={sortCategoryUrl}&current={sortCurrentUrl}&pers={sortPersonalityUrl}&world={sortWorldSceneUrl}', [App\Http\Controllers\Api\V1\SortController::class, 'sort']);

    Route::get('/load_ques', [App\Http\Controllers\Api\V1\HomeController::class, 'loadQues']);

    Route::post('/google_sign_in', [App\Http\Controllers\Api\V1\UserController::class, 'googleSignIn']);

    Route::get('/category/{id}', [App\Http\Controllers\Api\V1\HomeController::class, 'fetchCategory']);

    
});

Route::prefix('v2')->group(function () {
    //

    Route::get('/home-data', [App\Http\Controllers\Api\V2\HomeController::class, 'getHomePage']);
    Route::get('/book_recommendation/{uid}', [App\Http\Controllers\Api\V2\HomeController::class, 'bookRecommendation']);
    Route::get('/search_book', [App\Http\Controllers\Api\V2\HomeController::class, 'search_book']);


    Route::get('/books/{uid}/{id}', [App\Http\Controllers\Api\V2\BookController::class, 'showBookDetail']);
    Route::get('/library/history/{cus_id}', [App\Http\Controllers\Api\V2\BookController::class, 'historyReadBook']);
    Route::delete('/delete_history/{id}', [App\Http\Controllers\Api\V2\BookController::class, 'deleteHistory']);
    
    Route::get('/library/bookmark/{cus_id}', [App\Http\Controllers\Api\V2\BookController::class, 'showAllbookMark']);
    Route::post('/library/bookmark', [App\Http\Controllers\Api\V2\BookController::class, 'bookMark']);
    Route::delete('/delete_bookmark/{id}', [App\Http\Controllers\Api\V2\BookController::class, 'delBookMark']);

    Route::get('/book_for_you/{truyen_id}', [App\Http\Controllers\Api\V2\BookController::class, 'bookForYou']);


    Route::get('/list_chapter/{truyen_id}', [App\Http\Controllers\Api\V2\ChapterController::class, 'listChapter']);
    Route::get('/load_chapter/{id}', [App\Http\Controllers\Api\V2\ChapterController::class, 'loadChapter']);
    Route::get('/books/{cus_id}/{truyen_id}/{chapter_slug}', [App\Http\Controllers\Api\V2\ChapterController::class, 'readChapter']);

    Route::post('/post_rating', [App\Http\Controllers\Api\V2\BookController::class, 'postRating']);
    Route::delete('/delete_rating/{id}', [App\Http\Controllers\Api\V2\BookController::class, 'delRating']);
});
