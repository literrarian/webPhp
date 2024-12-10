@extends('layout.general')
@section('content')

    <body>

    <header>

        <div class="row">
            <a href="{{ route('rubric.show', ['id' => $article['rubrics_id']]) }}">
                <h4>{{$article['name']}}</h4></a>
            <article>

                <div class="twelve columns">
                    <h1>{{$article['title']}}</h1>
                    <p class="excerpt">
                        {{$article['lid']}}
                    </p>
                </div>

            </article>


        </div>

    </header>

    <section class="section_light">

        <div class="row">

            <p><img src="{{ asset('images/' . $article['image']) }}" width=400 align=left hspace=30 alt="artThumb">
                {{$article['content']}}

            </p>

        </div>

    </section>
    </body>
@endsection
