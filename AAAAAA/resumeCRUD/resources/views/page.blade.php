@extends('layout.general')

@section('content')


    <div class="leftcol">
        @foreach($resumes as $resume)
            <a href="{{route('resume.show', ['resume' => $resume->id])}}">
                <p class="pinline second">
                    {{ $resume['FIO'] }}<br>
                    Телефон: {{ $resume['Phone'] }}
                </p>
                <p class="pinline third">
                    Стаж: {{ $resume['Stage'] }} лет
                </p>
            </a>
            <form action="{{ route('resume.delete', ['resume' => $resume->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>

    @endforeach
    </div>
@endsection
