@extends('layout.general')
@section('content')
    <div class="row">
        <div class="eight-columns">
            @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('rubric.store')}}" method="post">
                @csrf
                @method('POST')
                <label for="name">Заголовок</label>
                <input type="text" id="name" name="name" placeholder="Китайские ученые">
                <br><br>
                <button type="submit">Добавить</button>
            </form>
        </div>
    </div>
@endsection
