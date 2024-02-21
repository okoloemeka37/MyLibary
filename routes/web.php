<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashBoardController;
use App\Http\Controllers\UserDashBoardController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\IndexPageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\CommmentController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
for pagination:: php artisan vendor:publish --tag=laravel-pagination
*/




//payment system
Route::post('/pay',[paymentController::class,'pay'])->name('pay');
Route::get('/boo/{id}',[paymentController::class,'success'])->name('ret');
Route::get('/error',[paymentController::class,'error']);

//COMMENT SECTION
Route::post("/Add_comment",[CommmentController::class,'save']);
Route::post("/get_comment",[CommmentController::class,'get']);
Route::post("/edit_comment",[CommmentController::class,'edit']);
Route::delete("/delete_comment/{id}",[CommmentController::class,'delete']);



//RATNG SECTION
Route::post("/add_rating",[RatingsController::class,'add']);
Route::get("/p_get_rating/{id}",[RatingsController::class,'p_rating']);
Route::get("/other_rating/{id}",[RatingsController::class,'other_rating']);


//EMAIL SECTION
Route::get("/bos/{id}",[MailController::class,'sendDownloadMail'])->name('sdm');




Route::get('/',[IndexPageController::class,'index'])->name("home");
Route::get('/sort{genre}',[IndexPageController::class,'index'])->name("gen");


//showing all books by a particular author
Route::get('/Author{id}',[IndexPageController::class,'SortAuth'])->name("sortAuth");



//live search
Route::post("/live",[IndexPageController::class,'live'])->name('live');

//ind_genre
Route::get("/genre{gen}",[IndexPageController::class, 'genre'])->name('genre');

Route::middleware(['auth'])->group(function () {
    
//report page
Route::get('/reportConsole/{type}/{id}',[ReportController::class,'index'])->name('report_index');
Route::post('/reportstore',[ReportController::class,'store'])->name('report_store');







  
    //editing user profile

    Route::get('/editProfile',function(){
return view('Auths.profile_edit');
    })->name('profile_edit');

    Route::put("editProfile{id}",[AuthController::class,'edit'])->name('editProfile_handle');

    Route::get("/emailConfirmation",[AuthController::class,'codeSend'])->name('confirm_email');
    Route::post("/codeCheck",[AuthController::class,'codeCheck'])->name('codeCheck');

    Route::get("/password_change_view/{token}",[AuthController::class,'pass_view'])->name("pass_view");

    Route::post("/password_change",[AuthController::class,'password_change'])->name('p_change_handle');


    // anyAuth can access this route
    //working with book page
Route::post('/storeBook', [BooksController::class,'store'])->name('storeBook');
Route::get("/Addbook",[BooksController::class,"show"])->name("Addbook");
Route::delete("/delete_book/{id}",[BooksController::class,'delete_book']);
Route::get("/editForm/{id}",[BooksController::class,'edit'])->name("edit_btn");
Route::put('/editBook/{id}', [BooksController::class,'update'])->name('editBook');
Route::post("/livesearch",[BooksController::class,"search"]);



//viewing single book 
Route::get('/book/{id}',[BooksController::class,'single'])->name("sin");


//showing soft deleted books
Route::get('/deletedbook/{id}',[BooksController::class,'s_deleted'])->name("s_deleted");




//working with notification page
Route::get("/Notification",[NotificationController::class,'all'])->name('notice');
Route::get("/check/{id}",[NotificationController::class,'check']);



Route::get("/settings",function(){
    return view('all.Settings');
})->name('setting');



Route::middleware(['admin'])->group(function(){
    //showing report page
    Route::get('/reportshow',[ReportController::class,'show'])->name('report_show');
    Route::get('/clear_report',[ReportController::class,'clear'])->name('clear_report');
    Route::Delete('/remove_report/{id}',[ReportController::class,'remove']);
   // /remove_report/


    Route::get("/AdminDashboard",[AdminDashBoardController::class,"show"])->name("dashboard");
    Route::get("/alusers",[AdminDashBoardController::class,'users'])->name("alusers");
    Route::delete("/delete_user/{id}",[AdminDashBoardController::class,'delete_user']);


//books time
    Route::get("/Adminbook",[BooksController::class,"AdminBooks"])->name("AdminBooks");
//removing books uploaded by others;

Route::post("/removebook",[BooksController::class,"remove"]);

Route::post("/restore_book",[BooksController::class,"restore"]);
   
    //blog show
    Route::get("/createPost",function(){
        return view("blog.createPost");
    })->name('createPost');

    Route::post("/submitPost",[PostsCOntroller::class,'handlePost'])->name("handlePost");
   });



 // working on Authors
Route::middleware(['author'])->group(function(){
    Route::get("/dashboard",[UserDashBoardController::class,'show'])->name("AuthorDashboard");


 Route::get("/book",[BooksController::class,'user_show_books'])->name("Authorbook");


    Route::get("/posts",[PostsController::class,'owner'])->name('AuthorPost');


    Route::get("/createPost",function(){
        return view("blog.createPost");
    })->name('createPost');
 
    Route::post("/submitPost",[PostsController::class,'handlePost'])->name("handlePost");
    Route::get("/editpost/{id}",[PostsController::class,'editpost'])->name("edit_post");

    Route::post("/ckImage",[PostsController::class,'ck_upload'])->name("ck_upload");

    Route::post("/updatePost/{id}",[PostsController::class,'updatepost'])->name("updatePost");


    //deleting post by author;
    Route::post("/author-delete-book",[PostsController::class,'Authordelete'])->name("Authordelete");


});
 



 //working on normal users
 Route::get("/ndashboard",[UserDashBoardController::class,'Normshow'])->name("NormDashboard");


 Route::post("/logout",[AuthController::class,'logout'])->name('logout');
    
    // becoming An Author show

    Route::get("/beAuthor",[AuthController::class,'BeAuthShow'])->name('BeAuthShow');
    Route::put("/beAuthor{id}",[AuthController::class,'BeAuthHandle'])->name('BeAuthHandle');


    //blog show

   
 
});






//blog time

Route::get("/AllArticles",[PostsController::class,'allArticle'])->name('AllArticle');
Route::get("/indPost/{id}",[PostsController::class,'indPost'])->name('indPost');




Route::middleware(['guest'])->group(function () {

   Route::get('/login',function(){
        return view('Auths.login');
    })->name('login');
    Route::get('/register',function(){
        return view('Auths.Register');
    })->name("register");

    Route::post("/register",[AuthController::class, 'register_normal'])->name('register_handle');
    Route::post("/Aregister",[AuthController::class, 'register_author'])->name('register_handle_author');
   Route::post("/login",[AuthController::class,'login'])->name('login_handle');

});


Route::get("/feature",function (){
    return view('feature');
})->name('feature');