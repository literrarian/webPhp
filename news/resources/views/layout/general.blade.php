<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en"> <!--<![endif]-->

<head>

    <meta charset="utf-8"/>

    <meta name="viewport" content="width=device-width"/>

    <title>Новости науки</title>


    <!-- Included CSS Files (Compressed) -->
    <link rel="stylesheet" href={{asset("stylesheets/foundation.min.css")}}>
    <link rel="stylesheet" href={{asset("stylesheets/main.css")}}>
    <link rel="stylesheet" href={{asset("stylesheets/app.css")}}>

    <script src="{{asset("javascripts/modernizr.foundation.js")}}"></script>

    <link rel="stylesheet" href="{{asset("fonts/ligature.css")}}">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic'
          rel='stylesheet' type='text/css'/>

    <!-- IE Fix for HTML5 Tags -->
    <!--[if lt IE 9]>
    <script src="{{asset("http://html5shiv.googlecode.com/svn/trunk/html5.js")}}"></script>
    <![endif]-->

</head>

<body>

<nav>

    <div class="twelve columns header_nav">
        <div class="row">

            <ul id="menu-header" class="nav-bar horizontal">

                <li><a href={{route("index")}}>Главная</a></li>

                @foreach($rubrics as $rubric)
                    <li><a href="{{ route('rubric.show', ['id' => $rubric->id]) }}"> {{$rubric->name}}</a></li>
                @endforeach

            </ul>
            @guest
                @if (Route::has('login'))
                    <a class="nav-bar horizontal" href="{{ route('login') }}">Войти</a>
                @endif

            @else

                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Выйти
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @endguest
        </div>
    </div>

</nav><!-- END main menu -->
<div class="row">
    <h1><a href={{route("index")}}>Новости науки</a></h1>
</div>
<div class="row">
    <div class="eight-columns">
        @yield('content')
    </div>

</div>
<section>

    <div class="section_dark">
        <div class="row">

            <h2></h2>
            @for($i = 1; $i < 7; $i++)
                <div class="two columns">
                    <img src="{{ asset('images/' .'thumb'.$i.'.jpg') }}" alt="Thumb">
                </div>
            @endfor


        </div>
    </div>

</section>
</body>
<footer>

    <div class="row">

        <div class="twelve columns footer">
            <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="twitter">Twitter</a>
            <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="facebook">Facebook</a>
            <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="pinterest">Pinterest</a>
            <a href="" class="lsf-icon" style="font-size:16px" title="instagram">Instagram</a>
        </div>

    </div>

</footer>
