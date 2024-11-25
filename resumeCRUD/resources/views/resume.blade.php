@extends('layout.general')
@section('content')

    <div class="leftcol">
        @if(isset($persons))
            <h2>{{$title}}</h2>
            <table>
                <thead>
                <tr>
                    @foreach(array_keys((array) $persons[0]) as $header)
                        <th>{{ ucfirst($header) }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($persons as $person)
                    <tr>
                        @foreach((array) $person as $value)
                            <td>{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Данных нет, таблички нет, все пропало</p>
        @endif

        @if(isset($count))
            <h2>Всего резюме:</h2>
            <p>{{ $count }} штук</p>
        @endif
    </div>
@endsection
