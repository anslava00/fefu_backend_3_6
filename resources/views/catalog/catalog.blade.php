<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Catalog</title>
</head>
    <body>
        <div>
            Catalog
            @include('catalog.catalog_list', ['categories', $categories])
            @foreach ($products as $product)
            <article>
                <a href="{{ route('product', $product->slug) }}">
                    <h3>{{ $product->name }}</h3>
                </a>
                <p>{{ $product->price }} руб.</p>
            </article>
            @endforeach
            {{ $products->links() }}
        </div>
    </body>
</html>