@extends('layouts.app')
@section('content')
    <h1>Todo</h1>
    <h2 id="test">Add todo</h2>
    <form method="post" id="todo" action="{{route('todo.store')}}">
        @csrf
        <p>Title: <input type="text" id="title" name="title"></p>
        <p>
            <label class="radio-inline">
            <input type="radio" id="is_checked" name="is_checked" value="1">Task-1</label>
        </p>
        <button type="submit" id="add-todo">Add Todo</button>
    </form>
    <h2 id="test">Todos List</h2>

    <ul id="todos"></ul>

    <script>
        $(document).ready(function(){
            var todos = $('#todos');
            var $title = $('#title');
            var $is_checked = $('#is_checked');
            $.ajax({
                type: 'GET',
                url: '/todos',
                success:function (response) {
                    $.each(response,function(i, todo){
                        // todos.append('<li>title: '+ todo.title +'</li>');
                        todos.append('<li>title: '+ todo.title + '<br> task: '+todo.is_checked +'<br> created_at: '+todo.created_at +'<br> updated_at: '+todo.updated_at + '</li>');
                    });
                },
                error: function () {
                    alert('error loading orders');
                }
            });
            $('#add-todo').on('click',function () {
                var todo = {
                    title: $title.val(),
                    is_checked: $is_checked.val(),
                };
                $.ajex({
                    type: 'POST',
                    url: '/todos',
                    data: todo,
                    success:function (response) {
                        console.log(response);
                        // $todos.append('<li>title: '+ newTodo.title +'</li>');
                    },
                    error: function () {
                        alert('error saving orders');
                    }
                })
            });
        });
    </script>
@endsection

