(function($) {
'use strict';
$(function() {

loadtasks();
var todoListItem = $('.todo-list');
var todoListInput = $('.todo-list-input');

function loadtasks() {
	$.ajax({
      type: 'POST',
      url: './script.php',
      data: {
      	action: 100
      },
      dataType: 'json',
      success: function(response){
        $('.todo-list').html(response.table);
      }
    });
}
$('.add-todo').on("click", function(event) {
	event.preventDefault();

	var item = $(this).prevAll('.todo-list-input').val();
	var id=$('#todo-id').val();
	if (item) {
	todoListInput.val("");
    $.ajax({
      type: 'POST',
      url: './script.php',
      data: {
      	id: id,
      	item: item,
      	action: 1
      }
    });
	loadtasks();
	}

});

todoListItem.on('change', '.checkbox', function() {
	if ($(this).attr('checked')) {
	$(this).removeAttr('checked');
	} else {
	$(this).attr('checked', 'checked');
	}

	$(this).closest("li").toggleClass('completed');

	var id=$(this).closest(".each-task").attr('id');
    $.ajax({
      type: 'POST',
      url: './script.php',
      data: {
      	id: id,
      	action: 5
      }
    });

});

todoListItem.on('click', '.remove', function() {
	$(this).parent().remove();
	var id=$(this).closest(".each-task").attr('id');
    $.ajax({
      type: 'POST',
      url: './script.php',
      data: {
      	id: id,
      	action: 3
      }
    });

});

todoListItem.on('click', '.edit', function() {
	var id=$(this).closest(".each-task").attr('id');
	$('#todo-id').val(id);
	$('.todo-list-add-btn').removeClass('add-todo');
	$('.todo-list-add-btn').addClass('edit-todo');
	$('.todo-list-add-btn').html('Update');
    $.ajax({
      type: 'POST',
      url: './script.php',
      data: {
      	id: id,
      	action: 4
      },
      dataType: 'json',
      success: function(response){
        $('.todo-list-input').val(response.data);
      }
    });

});

});
})(jQuery);