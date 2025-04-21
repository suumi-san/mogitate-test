@extends('layouts.app')

@section('styles')
<!-- 商品一覧専用CSS -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/edit.css') }}">
@endsection

@section('content')
<div class="container">
    <a href="{{ route('products.index') }}" class="breadcrumb">商品一覧</a> > {{ $product->name }}

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="edit-content">
            <div class="left">
                <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}" class="product-img">
                <input type="file" name="image">
            </div>

            <div class="right">
                <!-- 商品名 -->
                <input type="text" name="name" value="{{ old('name', $product->name) }}">
                @if ($errors->has('name'))
                <p class="error">{{ $errors->first('name') }}</p>
                @endif

                <!-- 値段 -->
                <input type="text" name="price" value="{{ old('price', $product->price) }}">
                @if ($errors->has('price'))
                <p class="error">{{ $errors->first('price') }}</p>
                @endif

                <!-- 季節 -->
                @foreach (['春', '夏', '秋', '冬'] as $season)
                <label>
                    <input type="radio" name="season" value="{{ $season }}"
                        {{ old('season', $product->season) === $season ? 'checked' : '' }}>
                    {{ $season }}
                </label>
                @endforeach
                @if ($errors->has('season'))
                <p class="error">{{ $errors->first('season') }}</p>
                @endif

                <!-- 商品説明 -->
                <textarea name="description">{{ old('description', $product->description) }}</textarea>
                @if ($errors->has('description'))
                <p class="error">{{ $errors->first('description') }}</p>
                @endif

                <!-- 商品画像 -->
                <input type="file" name="image">
                @if ($errors->has('image'))
                <p class="error">{{ $errors->first('image') }}</p>
                @endif

            </div>
        </div>

        <div class="buttons">
            <a href="{{ route('products.index') }}" class="btn back">戻る</a>
            <button type="submit" class="btn save">変更を保存</button>
        </div>
    </form>

    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('削除しますか？')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn delete">
            <img src="{{ asset('images/trash-icon.svg') }}" alt="削除">
        </button>

    </form>
</div>
@endsection