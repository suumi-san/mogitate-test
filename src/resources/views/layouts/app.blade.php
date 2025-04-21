<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">

</head>

<body>
    <header>
        <a class="form_title" href=" {{ route('products.index') }}">mogitate</a>
    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>