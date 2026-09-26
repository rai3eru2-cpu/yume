@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2 class="mb-4">商品情報一覧画面</h2>

            <!-- 検索フォーム -->
            <form action="{{ route('products.index') }}" method="GET" class="mb-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" placeholder="商品名（部分一致）" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="company_id" class="form-select">
                            <option value="">メーカー名を選択</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->company_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">検索</button>
                    </div>
                    <div class="col-md-2 text-end">
                        <a href="{{ route('products.create') }}" class="btn btn-success w-100">新規登録</a>
                    </div>
                </div>
            </form>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- 商品一覧テーブル -->
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>商品画像</th>
                        <th>商品名</th>
                        <th>価格</th>
                        <th>在庫数</th>
                        <th>メーカー名</th>
                        <th>アクション</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if($product->img_path)
                                    <img src="{{ asset($product->img_path) }}" alt="商品画像" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <span class="text-muted">なし</span>
                                @endif
                            </td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ number_format($product->price) }}円</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->company->company_name }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">詳細表示</a>
                                    
                                    <!-- 削除ボタン（仕様書通り、ダイアログで確認を行う） -->
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">削除</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">該当する商品がありません。</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection