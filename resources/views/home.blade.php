@extends('layouts.app')

@section('content')

            <div class="container">
                <div class="raw">
                    <a href="{{route('create')}}" class="btn btn-primary">Создать тест</a>
                    <a href="{{route('showSubject')}}" class="btn btn-primary">Редактировать тесты</a>
                </div>
            </div>
@endsection
