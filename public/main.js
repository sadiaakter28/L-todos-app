$(function () {
    var $orders = $('#todos');
    var $title = $('#title');
    var $is_checked = $('#is_checked');
    $.ajax({
        type: 'GET',
        url: '/todos',
        success:function (todos) {
            $.each(todos,function(i, todo){
                $todos.append('<li>title: '+ todo.title +',is_checked: '+ todo.is_checked +'</li>');
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
            success:function (newTodo) {
                $todos.append('<li>title: '+ newTodo.title +',is_checked: '+ newTodo.is_checked +'</li>');
            },
            error: function () {
                alert('error saving orders');
            }
        })
    });
});
