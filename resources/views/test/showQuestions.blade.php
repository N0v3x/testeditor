@extends('layouts.app')
@section('content')
    <div id="alert"></div>

    <form id = 'form'>
        {{ csrf_field() }}
        <div class="container">
            <a href="{{route('showSubject')}}" class="btn btn-primary">Назад</a>
            <div>
                <br>
            </div>
            <div class="form-inline">
                <div class="form-group">
                    <label class=""><h4>Тема</h4></label>
                    <input type="text" class="form-control" id="Topic" value="{{$topic->name}}" required>
                </div>
                    <div class="form-group">
                            <button type="button" class="btn btn-sm btn-primary btnChange" value="{{$topic->id}}">Изменить</button>
                    </div>
                </div>


                @if(count($questions) > 0)
                    <div class="table-responsive">
                            <h4>Список вопросов</h4>
                            <table class="table" id = 'table'>
                                <tr class="record">
                                    <td>Вопрос</td>
                                    <td>Вес вопроса</td>
                                    <td>Действия</td>
                                </tr>
                                @foreach($questions as $question)
                                    <tr class = "record">
                                        <td>{{$question->question}}</td>
                                        <td>{{$question->mark}}</td>
                                        <td><a href="/test/question/edit/{{$topic->id}}/{{$question->id}}" class="btn btn-warning form-group" value="{{$question->id}}">Изменить</a>
                                            <button type="button" class="btn btn-danger form-group" value="{{$question->id}}">Удалить</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                    </div>
                    @endif
                <div class="col-sm-2">
                    <a href="/test/create/topic/{{$topic->id}}" class=" btn btn-primary">Добавить вопрос</a>
                </div>

        </div>
    </form>


@endsection

@section('script')
<script>
    $(document).ready(function () {

        //Изменить тему
        $(".btnChange").click(function () {

            var id = $(this).val();
            var topic = $("#Topic").val();
            $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
            $.ajax({
                type : 'post',
                url : '/topic/edit/' + id,
                data : {topic : topic},
                dataType : 'json',
                success : function (data) {
                    if(data == 'success')
                    {
                        var div = $('<div>',{
                            class : 'alert alert-success'
                        }).html('Тема успешно изменена').appendTo($('#alert'));
                        div.fadeTo(2000, 500).slideUp(500, function(){
                            div.slideUp(500);
                        });
                    }
               },
                error : function () {
                    var div = $('<div>',{
                        class : 'alert alert-danger'
                    }).html('Поле для темы не может быть пустым').appendTo($('#alert'));
                    div.fadeTo(2000, 500).slideUp(500, function(){
                        div.slideUp(500);
                    });
                }
           });
        });

        //Удалить вопрос
        $('.btn-danger').click(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = $(this).val();
            var tr = $(this);
            $.ajax({
                type: 'POST',
                url: '/question/delete/' + id,
                success: function (data) {
                    console.log(data);
                    if (data === 'success') {
                        $(tr).parent().parent().remove();
                    }
                }
            });
        });

    });

</script>
@endsection