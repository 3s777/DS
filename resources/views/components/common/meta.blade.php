@aware([
    'title' => config('app.name', 'Laravel'),
    ])

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title ?? config('app.name', 'Laravel') }}</title>

<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('images/favicons/site.webmanifest') }}">
<meta name="msapplication-TileColor" content="#333458">
<meta name="theme-color" content="#333458">
{{ $slot }}
