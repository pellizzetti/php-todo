$(document).ready (function() {

  $(".alert").delay(2750).fadeOut(750, function() {
    $(this).remove();
  });

  $('#delete-confirmation').on('show.bs.modal', function(e) {
    var action = $(e.relatedTarget);
    var data = action.data();

    if (action.hasClass('cancel-task')) {
      e.stopPropegation();
    } 

    $('.title', this).text(data.title);
    $('.btn-ok', this).data('id', data.id).data('origin', data.origin);
  });

  $('#delete-confirmation').on('click', '.btn-ok', function(e) {
    var deleteModal = $(e.delegateTarget);
    var id = $(this).data('id');
    var origin = $(this).data('origin');

    var element = (origin == 'list') ? $('div#list-' + id) : $('li#task-' + id);
    var listGroup = element.parent();
    var panelTitle = listGroup.parent().prev('.panel-heading').find('div.panel-title');
    var badge = panelTitle.children('span.badge');
    var taskCount = parseInt(badge.text()) || 0;

    $.ajax({
      type: 'DELETE',
      url: origin + '/' + id + '/delete',
      success: function() {
        deleteModal.modal('hide');
        element.slideUp(300,function() {
          element.remove();
        });

        if (taskCount > 1) {
            badge.text(taskCount - 1);
        } else {
            badge.remove();
        }

      }
    });
  });

  $(document).on('click', '.completed', function() {
    var task = $(this).closest('.list-group-item');
    var id = task.data('id');
    var checked = $(this).is(':checked') ? 1 : 0;

    $.ajax({
      type: "POST",
      url: 'task/' + id + '/toggle/' + checked,
      success: function() {
        task.toggleClass('disabled');
      }
    });
  });

  $('.add-task').on('click', function() {
    var list_id = $(this).data('id');
    var description = $(this).parent().prev('input').val();

    if (description !== '') {
      var listGroup = $('#list-tasks-' + list_id).children('.list-group');
      var panelTitle = listGroup.parent().prev('.panel-heading').find('div.panel-title');
      var badge = panelTitle.children('span.badge');
      var taskCount = parseInt(badge.text()) || 0;

      $.ajax({
        type: "POST",
        data: {description: description, list_id: list_id},
        url: 'task/add/post',
        success: function(data) {
          var newTask = $.parseJSON(data);

          listGroup.append('<li class="list-group-item" id="task-' + newTask.id + '" data-id="' + newTask.id + '">' +
            '<div class="checkbox">' +
            '<input type="checkbox" class="completed" id="checkbox-' + newTask.id + '">' +
            '<p>' +
              newTask.description +
            '</p>' +
            '</div>' +
            '<div class="pull-right action-buttons">' +
              '<a class="edit-task" href="#" data-id="' + newTask.id + '"><span class="text-info glyphicon glyphicon-pencil"></span></a>' +
              '<a class="delete-task" href="#" data-id="' + newTask.id + '" data-title="' + newTask.description + '" data-origin="task" data-toggle="modal" data-target="#delete-confirmation"><span class="text-danger glyphicon glyphicon-trash"></span></a>' +
            '</div>' +
            '</li>');

          if (taskCount > 0) {
            badge.text(taskCount + 1);
          } else {
            panelTitle.append('<span class="badge progress-bar-info">1</span>')
          }
        }
      });
    }
  });

  $('.edit-task').on('click', function() {
    var task = $(this).closest('.list-group-item');
    var id = task.data('id');
    var description = task.find('p').text();
    var deleteCancel = $(this).next('a');
    var mode = $(this).is('.edit-task') ? 'edit' : 'save';

    $(this).toggleClass('edit-task save-task');
    $("span", this).toggleClass("glyphicon-ok-circle glyphicon-pencil");

    deleteCancel.toggleClass('delete-task cancel-task');
    $("span", deleteCancel).toggleClass("glyphicon-ban-circle glyphicon-trash");
    
    if (mode == 'edit') {
      task.find('p').attr('contenteditable', 'true');
      task.find('p').attr('data-old-value', description)
    } else {
      task.find('p').attr('contenteditable', 'false');

      $.ajax({
        type: "POST",
        data: {description: description},
        url: 'task/' + id + '/edit/update',
        success: function(data) {
          console.log(data);
          $(this).toggleClass('save-task edit-task');
          $("span", this).toggleClass("glyphicon-pencil glyphicon-ok");
          
          task.find('p').attr('contenteditable', 'false');
        }
      });
    }

  });

  $('.delete-task').on('click', function(e) {
    var task = $(this).closest('.list-group-item');
    var taskDescription = task.find('p');
    var oldValue = taskDescription.data('old-value');
    var editSave = $(this).prev('a');
    var mode = editSave.is('.edit-task') ? 'edit' : 'save';

    if (mode !== 'edit') {
      $(this).toggleClass('delete-task cancel-task');
      $("span", this).toggleClass("glyphicon-ban-circle glyphicon-trash");

      editSave.toggleClass('edit-task save-task');
      $("span", editSave).toggleClass("glyphicon-ok-circle glyphicon-pencil"); 

      taskDescription.attr('contenteditable', 'false');
      taskDescription.text(oldValue)
      e.stopPropagation();
    } 

  });

});