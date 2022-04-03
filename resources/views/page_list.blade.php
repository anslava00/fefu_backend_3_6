<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        @foreach ($page_list as $page)
            <h1>{{ $page->title }}</h1>
            <p>{{ $page->text }}</p>
        @endforeach


        {{ $page_list->links() }}
    </body>
</html>
