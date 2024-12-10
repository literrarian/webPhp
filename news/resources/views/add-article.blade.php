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
        <form action="{{route('article.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <label for="title">Заголовок</label>
            <input type="text" id="title" name="title" placeholder="Китайские ученые снова что-то открыли!">
            <br><br>
            <label for="lid">Аннотация</label>
            <input type="text" id="lid" name="lid" placeholder="Шок-контент! Вы никогда не догадаетесь, что!!!">
            <br><br>
            <label for="content">Статья</label>
            <textarea type="text" id="content" name="content" placeholder="Они открыли банку огурцов."></textarea>
            <br><br>
            <label for="rubrics_id">Рубрика</label>
            <select name="rubrics_id" id="rubrics_id">
                @foreach ($rubrics as $pos)

                    <option value="{{ $pos['id'] }}">{{ $pos['name'] }}</option>
                @endforeach
            </select>
            <br><br>
            <label for="image">Картинка</label>
            <input type="file" id="image" name="image">
            <br><br>
            <button type="submit">Добавить</button>
        </form>
</div>
    </div>
@endsection
