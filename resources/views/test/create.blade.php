@extends('layouts.app')

@section('content')
    <form action="{{route('createTopic')}}" method="post">
        {{ csrf_field() }}
        <div class="container">
        <label>Выберите предмет из списка</label>
            <select class="form-group" name="subject">
                @foreach($subjects as $subject)
                    <option>{{$subject->name}}</option>
                @endforeach
            </select>
        <div class="form-inline">
            <label for="topic">Тема тестирования</label>
            <input type="text" class="form-control" id="topic" name="topic" value="" required>
        </div>
        <button type="submit" class="btn btn-primary">Добавить тему</button>
        </div>
    </form>
@endsection