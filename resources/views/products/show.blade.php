@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>商品情報詳細画面</h3></div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th class="table-light" style="width: 30%;">商品情報ID</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">商品画像</th>
                            <td>
                                @if($product->img_path)
                                    <img src="{{ asset($product->img_path) }}" alt="商品画像" style="max-width: 200px;">
                                @else
                                    <span class="text-muted">なし</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="table-light">商品名</th>
                            <td>{{ $product->product_name }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">メーカー</th>
                            <td>{{ $product->company->company_name }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">価格</th>
                            <td>{{ number_format($product->price) }}円</td>
                        </tr>
                        <tr>
                            <th class="table-light">在庫数</th>
                            <td>{{ $product->stock }}</td>
                        </tr>
                        <tr>
                            <th class="table-light">コメント</th>
                            <td>{{ $product->comment ?? 'なし' }}</td>
                        </tr>
                    </table>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">編集</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection