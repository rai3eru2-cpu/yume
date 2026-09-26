@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>商品新規登録画面</h3></div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">商品名 <span class="text-danger">＊</span></label>
                            <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}">
                            @error('product_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">メーカー <span class="text-danger">＊</span></label>
                            <select name="company_id" class="form-select @error('company_id') is-invalid @enderror">
                                <option value="">メーカーを選択してください</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                        {{ $company->company_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">価格 <span class="text-danger">＊</span></label>
                            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">在庫数 <span class="text-danger">＊</span></label>
                            <input type="text" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}">
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">コメント</label>
                            <textarea name="comment" class="form-control" rows="3">{{ old('comment') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">商品画像</label>
                            <input type="file" name="img_path" class="form-control @error('img_path') is-invalid @enderror">
                            @error('img_path') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
                            <button type="submit" class="btn btn-success">登録</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>