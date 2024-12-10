@extends('layout.general')
@section('content')



    <section>

        <div class="section_main">

            <div class="row">

                <section class="eight columns">

                    @foreach($articles as $article)
                        <article class="blog_post">
                            <div class="three columns">
                                <img src="{{ asset('images/' . $article['image']) }}" alt="artThumb">
                            </div>
                            <div class="nine columns">
                                <a href="{{ route('article.show', ['artId' => $article->id]) }}">
                                    <h4>{{$article['title']}}</h4></a>
                                <p> {{$article['lid']}}</p>
                                @can('delete-article')
                                <form action="{{ route('article.destroy', ['article' => $article]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Удалить</button>
                                </form>
                                @endcan
                            </div>
                        </article>
                @endforeach

                </section>
                @can('create-article',$article)
                <section class="four columns">
                    <H3>  &nbsp; </H3>
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
            </div>


        </div>
    </section>




    <!-- Included JS Files (Compressed) -->
    <script src="javascripts/foundation.min.js" type="text/javascript"></script>
    <!-- Initialize JS Plugins -->
    <script src="javascripts/app.js" type="text/javascript"></script>
@endsection



