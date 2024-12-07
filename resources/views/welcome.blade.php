<!DOCTYPE html>
<html>
<head>
    <title>Amo</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <Navbar></Navbar>
    <router-view></router-view>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
