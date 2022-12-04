<?php

use App\Http\Controllers\AdminController;

use App\Http\Controllers\SlideController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SectController;
use App\Http\Controllers\PersonalityController;
use App\Http\Controllers\WorldController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AuthorGuideController;
use App\Http\Controllers\StaffGuideController;
use App\Http\Controllers\MailController;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CustomLoginController;

use App\Http\Controllers\BookController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\TickBookController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RankingController;

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

// admin dang nhap

Route::get('/admin/home', [AdminController::class, 'show_dashboard'])->name('home');
Route::get('/admin/login', [AdminController::class, 'view_login']);
Route::get('/admin/logout', [AdminController::class, 'log_out']);
// phe duyet truyen
Route::get('/admin/approval', [AdminController::class, 'show_approval'])->name('approval');
Route::get('/admin/approval/{truyen_id}/show', [AdminController::class, 'show_truyen']);

Route::post('/admin/approval', [AdminController::class, 'load_approval'])->name('load_approval');
Route::post('/admin/approval/update', [AdminController::class, 'update_approval']);
Route::post('/admin/approval/delete', [AdminController::class, 'delete_approval']);

Route::get('/admin/solved', [AdminController::class, 'show_solved'])->name('solved');
Route::get('/admin/solved/{truyen_id}/show', [AdminController::class, 'show_truyen_2']);

Route::post('/admin/solved', [AdminController::class, 'load_solved'])->name('load_solved');
Route::post('/admin/solved/update', [AdminController::class, 'update_solved']);
Route::post('/admin/solved/delete', [AdminController::class, 'delete_solved']);

//admin dang nhap
Route::post('/admin/home', [AdminController::class, 'login']);

//list_account & mail
Route::get('/admin/list-account', [AdminController::class, 'listaccount'])->name('list_account');
Route::get('/admin/account/{id}', [AdminController::class, 'detail_account']);

Route::get('/admin/mailbox', [MailController::class, 'index'])->name('mail');
Route::get('/admin/mailbox/{u_id}', [MailController::class, 'create']);
Route::post('/admin/mailbox/{u_id}', [MailController::class, 'store']);
Route::get('/admin/mailbox/read-mail/{mail_id}', [MailController::class, 'read_mail']);


Route::resource('/admin/slide', SlideController::class);
Route::resource('/admin/category', CategoryController::class);
Route::resource('/admin/sect', SectController::class);
Route::resource('/admin/personality', PersonalityController::class);
Route::resource('/admin/world', WorldController::class);
Route::resource('/admin/faqs', FaqController::class);
Route::resource('/admin/staff-guide', StaffGuideController::class);
Route::resource('/admin/author-guide', AuthorGuideController::class);


// account
Route::get('/account/library', [AccountController::class, 'library'])->name('library');
Route::get('/account/rewarded', [AccountController::class, 'rewarded'])->name('rewarded');
Route::get('/account/notification', [AccountController::class, 'notification'])->name('notification');
Route::get('/account/pay', [AccountController::class, 'pay'])->name('pay');
Route::get('/account/listChapter', [AccountController::class, 'listChapter'])->name('listChapter');
Route::get('/account/addChapter', [AccountController::class, 'addChapter'])->name('addChapter');

Route::get('/account/quy-dinh-khi-dang-truyen', [AccountController::class, 'regulation'])->name('regulation');


//account mail
Route::get('/account/mail', [AccountController::class, 'mail'])->name('account_mail');
Route::post('/account/mail/{id}', [AccountController::class, 'send_mail']);
Route::get('/account/mail/{id}', [AccountController::class, 'create_mail']);
Route::get('/account/mail/read-mail/{mail_id}', [AccountController::class, 'read_mail']);

Route::get('/account/register', [RegistrationController::class, 'create']);
Route::post('/account/register', [RegistrationController::class, 'store']);
Route::get('/account/login', [CustomLoginController::class, 'create']);
Route::post('/account/login', [CustomLoginController::class, 'login']);
Route::get('/account/logout', [CustomLoginController::class, 'log_out']);

Route::post('/load_reading_account', [AccountController::class, 'load_reading_account']);
Route::post('/load_tickbook_account', [AccountController::class, 'load_tickbook_account']);
Route::post('/del_tickbook_account', [AccountController::class, 'del_tickbook_account']);

Route::post('/load_chat_account', [AccountController::class, 'load_chat_account']);
Route::post('/send_chat', [AccountController::class, 'send_chat']);


//Truyen
Route::resource('/account/book', BookController::class);
//Chuong
Route::get('/account/book/{truyen_id}/chapter/create', [ChapterController::class, 'create']);
Route::get('/account/book/{truyen_id}/chapter/index', [ChapterController::class, 'index']);
Route::post('/account/book/{truyen_id}/chapter/create', [ChapterController::class, 'store']);
Route::get('/account/book/{truyen_id}/chapter/{chap_id}/edit', [ChapterController::class, 'edit']);
Route::post('/account/book/{truyen_id}/chapter/{chap_id}/update', [ChapterController::class, 'update']);
Route::post('/account/book/{truyen_id}/chapter/{chap_id}/delete', [ChapterController::class, 'delete']);

//Profile
Route::get('/account/profile', [AccountController::class, 'profile'])->name('profile');
//setting
Route::post('/account/update_profile', [AccountController::class, 'update_profile']);
Route::get('/account/setting', [AccountController::class, 'setting'])->name('setting');
Route::post('/account/changepass', [AccountController::class, 'changePass']);
//Suport
Route::get('/account/faqs', [AccountController::class, 'faqs'])->name('faqs');
Route::get('/account/staff-guide', [AccountController::class, 'staff_guide'])->name('staff-guide');
Route::get('/account/author-guide', [AccountController::class, 'author_guide'])->name('author-guide');

//Home

Route::get('/', [HomeController::class, 'index'])->name('trangchu');
Route::get('/the-loai/{slug}', [HomeController::class, 'theloai']);
Route::get('/tinh-cach-nhan-vat/{slug}', [HomeController::class, 'tinhcach']);
Route::get('/boi-canh-the-gioi/{slug}', [HomeController::class, 'thegioi']);
Route::get('/luu-phai/{slug}', [HomeController::class, 'luuphai']);
Route::get('/trang-thai/{id}', [HomeController::class, 'trangthai']);
Route::get('/thi-giac/{id}', [HomeController::class, 'thigiac']);
Route::get('/tim-kiem', [HomeController::class, 'timkiem']);

Route::post('/load_reading', [HomeController::class, 'load_reading']);
Route::post('/del_reading', [HomeController::class, 'del_reading']);



//xem-truyen
Route::get('/truyen/{slug}', [HomeController::class, 'xemtruyen']);
Route::get('/truyen/{slug_truyen}/chuong-{slug_chuong}', [HomeController::class, 'xemchuong']);

Route::post('/load_comment', [HomeController::class, 'load_comment']);
Route::post('/send_comment', [HomeController::class, 'send_comment']);

Route::post('/load_vote', [HomeController::class, 'load_vote']);
Route::post('/load_rating', [HomeController::class, 'load_rating']);
Route::post('/send_vote', [HomeController::class, 'send_vote']);
Route::post('/delete_vote', [HomeController::class, 'delete_vote']);

Route::post('/load_book_comment', [HomeController::class, 'load_book_comment']);
Route::post('/send_book_comment', [HomeController::class, 'send_book_comment']);

Route::post('/load_tickbook', [TickBookController::class, 'load_tickbook']);
Route::post('/tickbook', [TickBookController::class, 'store']);
Route::post('/del_tickbook', [TickBookController::class, 'destroy']);

Route::post('/nominate_send', [HomeController::class, 'nominate_send']);

//xep hang
Route::get('/xep-hang/doc-nhieu', [RankingController::class, 'docnhieu']);
Route::get('/xep-hang/de-cu', [RankingController::class, 'decu']);
Route::get('/xep-hang/thao-luan', [RankingController::class, 'thaoluan']);
Route::get('/xep-hang/danh-gia', [RankingController::class, 'danhgia']);

