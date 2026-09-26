<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 最初のアドレス（localhost:8888/vending_machine/public/）にアクセスしたらログイン画面に飛ばす
Route::get('/', function () {
    return redirect()->route('login');
});

// Laravel UIが自動生成した認証用のルート（ログインや新規登録など）
Auth::routes();

// ログインが成功した後の標準の飛び先（仕様書通り、商品一覧画面へリダイレクトさせる）
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 🔒 ログインしたユーザーだけがアクセスできるグループ（Authミドルウェア）
Route::middleware(['auth'])->group(function () {
    
    // 商品管理のすべてのURL（一覧・登録・詳細・編集・削除）をまとめて規約通り定義
    Route::resource('products', ProductController::class);
    
});