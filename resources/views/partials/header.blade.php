
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="is-authenticated" content="{{ auth()->check() ? 'true' : 'false' }}">
    <title>@yield('title')</title>
