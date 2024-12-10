@extends('layout.general')

@section('content')

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="leftcol">
        <form action="{{ route('resume.update', ['resume' => $person['id']] )}}"
              enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <label for="FIO">ФИО</label>
            <input type="text" id="FIO" name="FIO" value="{{ $person['FIO'] }}">
            <br><br>
            <label for="Stage">Стаж</label>
            <input type="number" id="Stage" name="Stage" value="{{$person['Stage']}}">
            <br><br>
            <label for="Phone">Телефон</label>
            <input type="tel" id="Phone" name="Phone"  value="{{ $person['Phone'] }}">
            <small>Формат: 234568</small><br><br>
            <br>
            <label for="staff_id">Должность</label>
            <select name="staff_id" id="staff_id">
                @foreach ($staff as $pos)
                    <option value="{{ $pos['id'] }}"
                            @if($pos['id'] == $person['staff_id']) selected @endif>
                        {{ $pos['staff'] }}
                    </option>
                @endforeach
            </select>
            <br><br>
            <label for="Image">Аватарка</label>
            <input type="file" id="Image" name="Image" value="{{$person['Image']}}">
            <br><br>
            <button type="submit">Изменить</button>
        </form>

    </div>
@endsection
