@extends('layout.general')
@section('content')

    <body>

    <section>

        <div class="section_main">

            <div class="row">

                <section class="eight columns">

                    <h3>{{$rubric->name}}</h3>

                    @if (count($articles)<1)
                        <h3>Ничего тут нет :р</h3>
                    @else

                    @foreach($articles as $article)
                        <article class="blog_post">
                            <div class="three columns">
                                <img src="{{ asset('images/' . $article['image']) }}" alt="artThumb">
                            </div>
                            <div class="nine columns">
                                <a href="{{ route('article.show', ['artId' => $article->id]) }}">
                                    <h4>{{$article['title']}}</h4></a>
                                <p> {{$article['lid']}}</p>

                            </div>
                        </article>
                    @endforeach

                </section>


                @can('create-article',$article)
                    <section class="four columns">
                        <H3> &nbsp; </H3>
                        <div class="panel">
                            <h3>Админ-панель</h3>

                            <ul class="accordion">
                                <li class="active">
                                    <div class="title">
                                        <a href="{{route('article.create')}}"><h5>Добавить статью</h5></a>
                                    </div>
                                    <div class="title">
                                        <a href="{{route('rubric.create')}}"><h5>Добавить рубрику</h5></a>
                                    </div>

                                </li>
                            </ul>
                        </div>
                    </section>
                @endcan
                @endif
            </div>

        </div>

    </section>


    </body>
@endsection
