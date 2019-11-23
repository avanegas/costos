<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user" content="Auth::user()">

    <title>{{config('app.name')}}</title>

    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
    <!--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    !-->
</head>

<body>
	<div id="root">
        <app></app>
    </div>
    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
    <script type="text/javascript">
    	let user = document.head.querySelector('meta[name="user"]');
    	window.Laravel = {!! json_encode([
        	'csrfToken' => csrf_token(),
        	'user'      => Auth::user()
    	]) !!};
        function markNotificationAsRead(){
            $.get('/markAsRead');
        }
    </script>
</body>

</html>
