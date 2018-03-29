@extends('layouts.app')
@section('content')
    <form>
        {{ csrf_field() }}
        <div class="container">
            <a href="{{route('home')}}" class="btn btn-primary">Назад</a>
            <div>
                @if(count($subjects) > 0)
                    <label>Выберите предмет</label>
                    <select class="form-group" name="subject" id = 'subjects'>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                        @endforeach
                    </select>
                @else
                    <h4>У вас нет созданных тестовых заданий</h4>
                @endif
                @if(count($topics) > 0)
                <div class="table-responsive">
                    <h4>Список тем</h4>
                    <table class="table" id = 'table'>
                        <tr class="record">
                            <td>Тема тестирования</td>
                            <td>Дата создания</td>
                            <td>Действия</td>
                            <td></td>
                        </tr>
                        @foreach($topics as $topic)
                            <tr class = "record">
                                <td>{{$topic->name}}</td>
                                <td>{{$topic->created_at}}</td>
                                <td><button type="button" class="btn btn-warning" value="{{$topic->id}}">Изменить</button>
                                <button type="button" class="btn btn-danger" value="{{$topic->id}}">Удалить</button>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                @endif
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            //Удаление темы
            $('.btn-danger').click(function () {
                deleteTopic($(this));
            });

            //Функция для удаления темы
            function deleteTopic(btn)
            {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var id = btn.val();
                var tr = btn;
                $.ajax({
                    type: 'POST',
                    url: '/test/edit/' + id,
                    success: function (data) {
                        console.log(data);
                        if (data === 'success') {
                            $(tr).parent().parent().remove();
                        }
                    }
                });
            }



            //Редактиирование темы
            $('.btn-warning').click(function () {
                var id = $(this).val();
                var url = '/test/edit/show/questions/'+id;
                window.location.href = url;
                return false;
            });

            //Изменение предмета
            $('#subjects').change(function () {
                var id = $('#subjects option:selected').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/test/edit/show/' + id,
                    success: function (data) {
                        $('.record').remove();
                        var tr = $('<tr>', {
                            class: 'record'
                        }).appendTo($('#table'));
                        var td = $('<td>').html('Тема тестирования').appendTo(tr);
                        var td = $('<td>').html('Дата создания').appendTo(tr);
                        var td = $('<td>',{
                            class : ''
                        }).html('Действия').appendTo(tr);
                        for (item in data) {
                            var tr = $('<tr>', {
                                class: 'record'
                            }).appendTo($('#table'));
                            var td = $('<td>').html(data[item].name).appendTo(tr);
                            var td = $('<td>').html(data[item].created_at).appendTo(tr);
                            var td = $('<td>',{
                                class : ''
                            }).appendTo(tr);

                            var button = $('<button>', {
                                type: 'button',
                                class: 'btn btn-warning btnmargin',
                                value: data[item].id
                            }).html('Изменить').appendTo(td);

                            button.click(function () {
                                var id = $(this).val();
                                var url = '/test/edit/show/questions/'+id;
                                window.location.href = url;
                                return false;
                            });

                            var button = $('<button>', {
                                type: 'button',
                                class: 'btn btn-danger btnmargin',
                                value: data[item].id
                            }).html('Удалить').appendTo(td);
                            button.click(function () {
                                deleteTopic($(this));
                            });
                        }
                    }
                })
            });
        });
    </script>

@endsection