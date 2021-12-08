<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>	
    @include('client.layouts.style')
    @stack('styles')
</head>
<body class="home-page home-01 ">
    @include('client.layouts.header')
    @include('client.layouts.main')
    @include('client.layouts.footer')

    @include('client.layouts.script')
    @stack('scripts')
</body>
</html>