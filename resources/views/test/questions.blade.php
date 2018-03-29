@extends('layouts.app')
@section('content')
    <h3>Тема: {{$topic->name}}</h3>
    <form action="/test/create/topic/{{$topic->id}}" method="get">
        {{ csrf_field() }}
        <div class="container">
        <div class="form-group">
            <label for="questionType">Выберите тип вопроса
                <select id="qSelect">
                    <option value="1" selected = 'selected'>Выбор одного ответа</option>
                    <option value="2">Выбор нескольних ответов</option>
                    <option value="3">Ввод текстового ответа</option>
                </select>
            </label>
        </div>
        <div class="row">
            <div class="col-md-5">
                <label for="question">Введите вопрос
                    <input type="text" name="question" required>
                </label>
            </div>
        </div>
        <br>
        <div class="row">
            <label for="question" class="col-sm-1">Количество баллов</label>
            <input type="text" class="input-sm col-sm-1" name="mark" required pattern="[0-9]{1,2}">
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <div class="form-group" id="Answers">
                    <h4 class="fake">Неправильные ответы:</h4>
                    <div class="Answer">
                        <input type="text" name="fakeAnswer[]" required>
                    </div>
                </div>
                <input type="button" id="addAnswerButton" value="Добавить ответ" class="btn btn-default">
            </div>
            <div class="col-md-3">
                <div class="form-group" id="rightAnswers">
                    <h4 class="right">Правильный ответ:</h4>
                    <div class="RightAnswer">
                        <input type="text" name="rightAnswer[]" required>
                    </div>
            </div>
                <input type="button" id="addRightAnswerButton" value="Добавить ответ" class="btn btn-default" style="display: none">
            </div>
        </div>
        <br>
        <div class="form-group">
            <input type="submit" class="btn bg-primary" value="Добавить вопрос">
            <a href="/test/edit/show/questions/{{$topic->id}}" class="btn btn-success">Закончить создание</a>
        </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        $('#qSelect').change(function () {
            $('.Answer').remove();
            $('.RightAnswer').remove();
            $('.fake').remove();
            $('.right').remove();
            var question = $("#qSelect option:selected").val();
            if(question == 1){
                $('#addAnswerButton').show();
                $('#addRightAnswerButton').hide();
                var h4 = $('<h4/>', {
                    class : 'fake'
                }).html('Неправильные ответы:').appendTo($('#Answers'));
                var h4 = $('<h4/>', {
                    class : 'right'
                }).html('Правильный ответ:').appendTo($('#rightAnswers'));
                var div = $('<div/>', {
                    'class' : 'RightAnswer'
                }).appendTo($('#rightAnswers'));
                var input = $('<input/>', {
                    name: 'rightAnswer[]',
                    type: 'text',
                    required : 'true'
                }).appendTo(div);
                var div = $('<div/>', {
                    'class' : 'Answer'
                }).appendTo($('#Answers'));
//                var br = $('<br/>').appendTo(div);
                var input = $('<input/>', {
                    name : 'fakeAnswer[]',
                    type : 'text',
                    required : 'true'
                }).appendTo(div);
            }
            else if(question == 2){
                $('#addAnswerButton').show();
                $('#addRightAnswerButton').show();
                var h4 = $('<h4/>', {
                    class : 'fake'
                }).html('Неправильные ответы:').appendTo($('#Answers'));
                var h4 = $('<h4/>', {
                    class : 'right'
                }).html('Правильные ответы:').appendTo($('#rightAnswers'));
                var div = $('<div/>', {
                    'class' : 'RightAnswer'
                }).appendTo($('#rightAnswers'));
                var br = $('<br/>').appendTo(div);
                var input = $('<input/>', {
                    name : 'rightAnswer[]',
                    type : 'text',
                    required : 'true'
                }).appendTo(div);
                var input = $('<input/>', {
                    name : 'rightAnswer[]',
                    type : 'text',
                    required : 'true'
                }).appendTo(div);
                var div = $('<div/>', {
                    'class' : 'Answer'
                }).appendTo($('#Answers'));
                var br = $('<br/>').appendTo(div);
                var input = $('<input/>', {
                    name : 'fakeAnswer[]',
                    type : 'text',
                    required : 'true'
                }).appendTo(div);

            }
            else if(question == 3) {
                $('#addAnswerButton').hide();
                $('#addRightAnswerButton').hide();
                var div = $('<div/>', {
                    'class' : 'Answer'
                }).appendTo($('#Answers'));
                var label = $('<label>').html('Ответ').appendTo(div);
                var input = $('<input/>', {
                    name: 'rightAnswer[]',
                    type: 'text',
                    required : 'true'
                }).appendTo(div);
            }
        });

        $('#addAnswerButton').click(function() {
            addAnswer();
            return false;
        });
        function addAnswer() {

            var div = $('<div/>', {
                'class' : 'Answer'
            }).appendTo($('#Answers'));
            var br = $('<br/>').appendTo(div);
            var input = $('<input/>', {
                name : 'fakeAnswer[]',
                type : 'text',
                required : 'true'
            }).appendTo(div);
            var input = $('<input/>', {
                value : 'Удалить',
                type : 'button',
                'class' : 'DeleteAnswer'
            }).appendTo(div);
            input.click(function() {
                $(this).parent().remove();
            });
        }
        $('#addRightAnswerButton').click(function() {
            addRightAnswer();
            return false;
        });
        function addRightAnswer() {

            var div = $('<div/>', {
                'class' : 'RightAnswer'
            }).appendTo($('#rightAnswers'));
            var br = $('<br/>').appendTo(div);

            var input = $('<input/>', {
                name : 'rightAnswer[]',
                type : 'text',
                required : 'true'
            }).appendTo(div);
            var input = $('<input/>', {
                value : 'Удалить',
                type : 'button',
                'class' : 'DeleteRightAnswer'
            }).appendTo(div);
            input.click(function() {
                $(this).parent().remove();
            });
        }

        $('.DeleteAnswer').click(function() {
            $(this).parent().remove();
        });
    </script>
@endsection