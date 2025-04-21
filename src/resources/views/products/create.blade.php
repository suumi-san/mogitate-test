@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="container">
    <h2 class="form-title">商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-content">
            <label>商品名<span class="required">必須</span></label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-content">
            <label>値段<span class="required">必須</span></label>
            <input type="text" name="price" value="{{ old('price') }}">
            @error('price')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-content">
            <label>商品画像<span class="required">必須</span></label>
            <input type="file" name="image">
            @error('image')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-content">
            <label>季節<span class="required">必須</span></label>
            <div class="season-options">
                @foreach ($seasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                        {{ is_array(old('seasons')) && in_array($season->id, old('seasons')) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label>
                @endforeach
            </div>
            @error('seasons')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-content">
            <label>商品説明<span class="required">必須</span></label>
            <textarea name="description">{{ old('description') }}</textarea>
            @error('description')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn.back">戻る</a>
            <button type="submit" class="btn.submit">登録</button>
        </div>
</div>
</form>
</div>
@endsection