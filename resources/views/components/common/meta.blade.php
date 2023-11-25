@aware([
    'title' => config('app.name', 'Laravel'),
    ])

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title ?? config('app.name', 'Laravel') }}</title>

<link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::image('favicons/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::image('favicons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::image('favicons/favicon-16x16.png') }}">
<link rel="manifest" href="{{ Vite::image('favicons/site.webmanifest') }}">
<meta name="msapplication-TileColor" content="#333458">
<meta name="theme-color" content="#333458">
{{ $slot }}
