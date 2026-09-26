<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;

class ProductController extends Controller
{
    /**
     * 商品一覧画面の表示（検索機能付き）
     */
    public function index(Request $request) {
        // 規約を遵守：Modelに定義した「search」メソッドを呼び出してDB操作を行う
        $products = Product::with('company')
            ->search($request->only(['search', 'company_id']))
            ->get();

        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }

    /**
     * 商品新規登録画面の表示
     */
    public function create() {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }

    /**
     * 商品新規登録処理
     */
    public function store(Request $request) {
        // バリデーションチェック（仕様書の必須項目をチェック）
        $request->validate([
            'product_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'comment' => 'nullable|string',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // 画像がアップロードされた場合の処理
        if ($request->hasFile('img_path')) {
            $filename = time() . '.' . $request->img_path->extension();
            $request->img_path->move(public_path('images'), $filename);
            $data['img_path'] = 'images/' . $filename;
        }

        Product::create($data);

        // 仕様書通り：登録完了後は「自画面（登録画面）にリダイレクト」する
        return redirect()->route('products.create')->with('success', '商品を登録しました。');
    }

    /**
     * 商品詳細画面の表示
     */
    public function show(Product $product) {
        return view('products.show', compact('product'));
    }

    /**
     * 商品編集画面の表示
     */
    public function edit(Product $product) {
        $companies = Company::all();
        // 仕様書通り：初期値として現在のデータを渡す
        return view('products.edit', compact('product', 'companies'));
    }

    /**
     * 商品編集更新処理
     */
    public function update(Request $request, Product $product) {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'comment' => 'nullable|string',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('img_path')) {
            $filename = time() . '.' . $request->img_path->extension();
            $request->img_path->move(public_path('images'), $filename);
            $data['img_path'] = 'images/' . $filename;
        }

        $product->update($data);

        // 仕様書通り：編集完了後は「自画面（編集画面）にリダイレクト」する
        return redirect()->route('products.edit', $product->id)->with('success', '商品を更新しました。');
    }

    /**
     * 商品削除処理
     */
    public function destroy(Product $product) {
        $product->delete();
        // 削除後は一覧画面に戻す
        return redirect()->route('products.index')->with('success', '商品を削除しました。');
    }
}