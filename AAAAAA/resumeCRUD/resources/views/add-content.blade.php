@extends('layout.general')
@section('content')
    <div class="leftcol">

        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('resume.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <label for="FIO">ФИО</label>
            <input type="text" id="FIO" name="FIO" placeholder="Тут был Вася...">
            <br><br>
            <label for="Stage">Стаж</label>
            <input type="number" id="Stage" name="Stage" placeholder="99">
            <br><br>
            <label for="Phone">Телефон</label>
            <input type="tel" id="Phone" name="Phone"  placeholder="00-00-00">
            <small>Формат: 23-45-68</small><br><br>
            <br><br>
            <label for="staff_id">Должность</label>
            <select name="staff_id" id="staff_id">
                @foreach ($staff as $pos)

                    <option value="{{ $pos['id'] }}">{{ $pos['staff'] }}</option>
                @endforeach
            </select>
            <br><br>
            <label for="Image">Аватарка</label>
            <input type="file" id="Image" name="Image">
            <br><br>
            <button type="submit">Добавить</button>
        </form>

    </div>
@endsection
