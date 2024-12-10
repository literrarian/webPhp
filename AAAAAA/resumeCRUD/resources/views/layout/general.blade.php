{{--<!DOCTYPE html>--}}
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel=stylesheet href='{{asset('style.css')}}' type='text/css'>
    <title>Резюме и вакансии </title>
</head>
<body>
<div class="header">
    Резюме и вакансии<div id="logo"></div>
</div>

@yield('content')


<div class="rightcol">
    <ul class="menu">
        <li><a href="{{route('index')}}">Вакансии</a></li>
        <li><a href="{{route('resume.getSurname')}}">Резюме по стажу</a></li>
        <li><a href="{{route('resume.getProgers')}}">Резюме программистов</a></li>
        <li><a href="{{route('resume.count')}}">Всего резюме</a></li>
        <li><a href="{{route('resume.create')}}">Добавить резюме</a></li>
    </ul>
</div>
<div class="footer" ><p>&copy; Copyright 2017</p></div>
</body>
</html>
