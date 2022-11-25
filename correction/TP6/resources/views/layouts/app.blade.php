<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>@yield('title')</title>
	</head>
	<body>
        @section('main')
            <h1>@yield('title')</h1>
        @show

        @include('shared.message')
	</body>
</html>
