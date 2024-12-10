@extends('layout.general')

@section('content')

    <div class="leftcol">

        <p class="pinline1">
            <img src="{{ asset('images/' . $person['Image']) }}" width="100" height="100" alt="Profile Image">


        </p>
        <p class="pinline second">
            {{ $person['FIO'] }}<br>
            Телефон: {{ $person['Phone'] }}
        </p>
        <p class="pinline third">
            {{$person['staff']}}
            <br>
            Стаж: {{ $person['Stage'] }} лет
        </p>

        <form action="{{ route('resume.edit', ['resume' => $person['id']] )}}">
            @csrf
            @method('get')
            <button type="submit">Изменить</button>
        </form>


    </div>
@endsection
