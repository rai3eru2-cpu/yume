@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>商品情報編集画面</h3></div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">商品情報ID</label>
                            <input type="text" class="form-control" value="{{ $product->id }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">商品名 <span class="text-danger">＊</span></label>
                            <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name', $product->product_name) }}">
                            @error('product_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">メーカー <span class="text-danger">＊</span></label>
                            <select name="company_id" class="form-select @error('company_id') is-invalid @enderror">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id', $product->company_id) == $company->id ? 'selected' : '' }}>
                                        {{ $company->company_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">価格 <span class="text-danger">＊</span></label>
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}">
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">在庫数 <span class="text-danger">＊</span></label>
                            <input type="text" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}">
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">コメント</label>
                            <textarea name="comment" class="form-control" rows="3">{{ old('comment', $product->comment) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">商品画像</label>
                            @if($product->img_path)
                                <div class="mb-2">
                                    <img src="{{ asset($product->img_path) }}" alt="現在の画像" style="max-width: 100px;">
                                </div>
                            @endif
                            <input type="file" name="img_path" class="form-control @error('img_path') is-invalid @enderror">
                            @error('img_path') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">戻る</a>
                            <button type="submit" class="btn btn-primary">更新</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection