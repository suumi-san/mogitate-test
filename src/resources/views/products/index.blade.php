@extends('layouts.app')

@section('styles')
<!-- 商品一覧専用CSS -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="container">
    <h2>商品一覧</h2>
    <div class="content-wrapper">
        <div class="sidebar">
            <form action="{{ route('products.search') }}" method="GET">
                @csrf
                <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
                <button type="submit">検索</button>

                <div class="sort-select">
                    <label for="sort">価格順で表示</label>
                    <select name="sort" id="sort" onchange="this.form.submit()">
                        <option value="">価格で並べ替え</option>
                        <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>低い順に表示</option>
                    </select>
                </div>

                @if(request('sort'))
                <div class="sort-tag">
                    並び替え:
                    <span class="tag">
                        {{ request('sort') == 'high' ? '高い順' : '低い順' }}
                        <a href="{{ route('products.index', array_filter(request()->except('sort'))) }}" class="remove-tag">×</a>
                    </span>
                </div>
                @endif
            </form>
        </div>

        <div class="product-area">
            <form action="{{ route('products.create') }}" method="GET">
                <button type="submit" class="btn-warning">+ 商品を追加</button>
            </form>

            <div class="grid">
                @foreach($products as $product)
                <div class="card">
                    <a href="{{ route('products.edit', $product->id) }}">
                        <img src="{{ asset('storage/images/' . $product->image) }}" alt="{{ $product->name }}">
                        <p>{{ $product->name }}</p>
                        <p>¥{{ number_format($product->price) }}</p>
                    </a>
                </div>
                @endforeach
            </div>

            <div class="pagination-area">
                <ul class="custom-pagination">
                    {{-- 前のページ --}}
                    @if ($products->currentPage() > 1)
                    <li><a href="{{ $products->url($products->currentPage() - 1) }}">&lt;</a></li>
                    @endif

                    {{-- ページ番号 --}}
                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <li>
                            <a href="{{ $products->url($i) }}"
                                class="{{ $products->currentPage() == $i ? 'active' : '' }}">
                                {{ $i }}
                            </a>
                        </li>
                        @endfor

                        {{-- 次のページ --}}
                        @if ($products->currentPage() < $products->lastPage())
                            <li><a href="{{ $products->url($products->currentPage() + 1) }}">&gt;</a></li>
                            @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection