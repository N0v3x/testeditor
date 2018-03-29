@extends('layouts.app')
@section('content')
    <form action="/question/edit/{{$question->id}}" method="post">
        {{ csrf_field() }}
        <div class="container">
            <a href="/test/edit/show/questions/{{$id}}" class="btn btn-primary">Назад</a>
            <input type="hidden" name="topic" value="{{$id}}">
            @if(count($right) == 1 && count($fake)>0)
            <div class="form-group">
                    <label for="questionType">Выберите тип вопроса
                    <select id="qSelect">
                        <option value="1" selected = 'selected'>Выбор одного ответа</option>
                        <option value="2">Выбор нескольних ответов</option>
                        <option value="3">Ввод текстового ответа</option>
                    </select>
                </label>
            </div>
            @endif
            @if(count($right) >= 1 && count($fake)>0)
                <div class="form-group">
                    <label for="questionType">Выберите тип вопроса
                        <select id="qSelect">
                            <option value="1" >Выбор одного ответа</option>
                            <option value="2" selected = 'selected'>Выбор нескольних ответов</option>
                            <option value="3">Ввод текстового ответа</option>
                        </select>
                    </label>
                </div>
            @endif
            @if(count($right) == 1 && count($fake) == 0)
                <div class="form-group">
                    <label for="questionType">Выберите тип вопроса
                        <select id="qSelect">
                            <option value="1">Выбор одного ответа</option>
                            <option value="2">Выбор нескольних ответов</option>
                            <option value="3" selected = 'selected'>Ввод текстового ответа</option>
                        </select>
                    </label>
                </div>
            @endif
            <div class="row">
                <div class="col-md-5">
                    <label for="question">Вопрос
                        <input type="text" name="question" value="{{$question->question}}" required>
                    </label>
                </div>
            </div>
            <br>
            <div class="row">
                <label for="question" class="col-sm-1">Количество баллов</label>
                <input type="text" class="input-sm col-sm-1" name="mark" required pattern="[0-9]{1,2}" value="{{$question->mark}}">
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group" id="Answers">
                        @if(count($fake) == 1)
                            @foreach($fake as $f)
                                <h4 class="fake">Неправильные ответы:</h4>
                                <div class="Answer">
                                    <input type="text" name="fakeAnswer[]" required value="{{$f->name}}">
                                </div>
                            @endforeach
                        @elseif(count($fake) > 1)
                            <h4 class="fake">Неправильные ответы:</h4>
                            @for($i=0; $i < count($fake); $i++)
                                <div class="Answer">
                                    <input type="text" name="fakeAnswer[]" required value="{{$fake[$i]->name}}">
                                    @if($i >= 1)
                                        <input type="button" class="DeleteAnswer" value="Удалить">
                                    @endif
                                </div>
                            @endfor
                        @elseif(count($fake) == 0 && count($right) == 1)
                            <div class="Answer">
                                <label>Ответ</label>
                                <input type="text" name="rightAnswer[]" required value="{{$right[0]->name}}">
                            </div>
                        @endif
                    </div>
                    @if(count($fake) == 0)
                        <input type="button" id="addAnswerButton" value="Добавить ответ" class="btn btn-default" style="display: none">
                    @else
                        <input type="button" id="addAnswerButton" value="Добавить ответ" class="btn btn-default">
                    @endif
                </div>
                <div class="col-md-3">
                    <div class="form-group" id="rightAnswers">
                        @if(count($right) == 1 && count($fake) > 0)
                        <h4 class="right">Правильный ответ:</h4>
                        <div class="RightAnswer">
                            @foreach($right as $r)
                            <input type="text" name="rightAnswer[]" required value="{{$r->name}}">
                            @endforeach
                        </div>
                        @elseif(count($right) > 1)
                            <h4 class="right">Правильные ответы:</h4>
                            @for($i=0; $i < count($right); $i++)
                                <div class="RightAnswer">
                                    <input type="text" name="fakeAnswer[]" required value="{{$right[$i]->name}}">
                                    @if($i >= 1)
                                        <input type="button" class="DeleteRightAnswer" value="Удалить">
                                    @endif
                                </div>
                            @endfor
                        @endif
                    </div>
                    @if(count($right) == 1)
                        <input type="button" id="addRightAnswerButton" value="Добавить ответ" class="btn btn-default" style="display: none">
                    @elseif(count($right) > 1)
                        <input type="button" id="addRightAnswerButton" value="Добавить ответ" class="btn btn-default">
                    @endif
                </div>
            </div>
            <br>
            <input type="submit" class="btn bg-primary" value="Изменить вопрос">
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