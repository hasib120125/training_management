function submitForm(form){
    var formURL = $(form).attr('action');
    //alert(formURL);
    var formData = new FormData(form);
    $.post({
      url: formURL,
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function (data, textStatus, jqXHR) {
        $('#modal-form').modal('hide');
        $("#data-table").DataTable().draw(false);

        $("#success-msg").html(data.success);
        $("#success-msg").show();
        setTimeout(function(){
          $("#success-msg").hide();
        }, 5000)

        $("#success-msg-bottom").html(data.success);
        $("#success-msg-bottom").show();
        setTimeout(function(){
          $("#success-msg-bottom").hide();
        }, 5000)
        $('html, body').animate({ scrollTop: 0 }, 0);
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        if (jqXHR.status === 422) {
          $('.help-block').html('');
          $('.has-error').removeClass('has-error');
          errors = jqXHR.responseJSON;
          $.each(errors.errors, function (key, value) {
            var group = $("[name=" + key + "]").closest('.form-group');
            if(!group.length){
              group = $("[name='" + key + "[]']").closest('.form-group');
            }
            $(group).addClass("has-error")
            $(group).find('.help-block').html(value[0]);
          });
        } else if(jqXHR.status === 403) {
          var element = document.getElementById('error-msg');
          $("#modal-form").modal('hide');
          element.innerHTML = "You don't have permission to do this";
          element.style.display = "block";
        } else {
          //console.log(jqXHR.responseText)
        }
      }
    })
}
function validateAndSubmitForm(form){
  var data = new FormData($(form)[0]);
  data.delete('files[]');
  data.delete('file');
  data.append('validate', true);
  console.log(data);
  $.post({
    url : $(form).attr('action'),   
    data: data,
    processData: false,  // Important!
    contentType: false,
    cache: false,
    success: function(){
      $(".has-error").removeClass('has-error');
      $(".help-block").html('');
      $('html, body').animate({ scrollTop: 0 }, 0);
      submitForm(form);      
    },

    error: function(jqXHR){
      if (jqXHR.status === 422) {
        $('.help-block').html('');
        $('.has-error').removeClass('has-error');
        errors = jqXHR.responseJSON;
        $.each(errors.errors, function (key, value) {
          var group = $("[name=" + key + "]").closest('.form-group');
          if(!group.length){
            group = $("[name='" + key + "[]']").closest('.form-group');
          }
          $(group).addClass("has-error")
          $(group).find('.help-block').html(value[0]);
        });
      } else if(jqXHR.status === 403) {
        var element = document.getElementById('error-msg');
        $("#modal-form").modal('hide');
        element.innerHTML = "You don't have permission to do this";
        element.style.display = "block";
      } else {
        //console.log(jqXHR.responseText)
      }
    }
  });
}
$(document).ready(function(){
  $(document).on('submit', "#model-form", function (e) {
    e.preventDefault();
    if($(this).is('[data-val]')){
      validateAndSubmitForm(this);
    }else{
      submitForm(this);
    }
  })
  $("#create-button").click(function (e) {
    e.preventDefault();
    $.get($(this).attr('href'))
    .done(function (data) {
      $(".modal-content").html(data);
      $("#modal-form").modal('show');
    });
  })
  $("#data-table").on('click', '.action-button', function (e) {
    e.preventDefault();
    $.get($(this).attr('href'))
    .done(function (data) {
      $(".modal-content").html(data);
      $("#modal-form").modal('show');
    });
  })

  $('#data-table').on('click', '.activate-button', function (e) {
    e.preventDefault();
    var table = $("#data-table").DataTable();
    var row = $(this).closest('tr');
    var user = table.row(row).data();
    var isActive = true;
    if (user.is_active == 1) {
      isActive = false;
    }
    $.ajax({
      url: $(this).attr('href'),
      method: 'PATCH',
      data: {
        _token: $("meta[name=csrf-token]").attr('content'),
        id: user.id,
        is_active: isActive
      }
    })
    .done(function (data) {
      table.draw(false);
    })
  })
  $('.datetimepicker').datetimepicker({
      format: "yyyy-mm-dd hh:ii:00",
      showMeridian: true,
      autoclose: true,
      minuteStep: 15,
    })
  
    
  $('.assignTrainingDatetimepicker').datetimepicker({
      format: "yyyy-mm-dd hh:ii:00",
      showMeridian: true,
      autoclose: true,
      minuteStep: 15,   
  }) 

    $('.datepicker').datetimepicker({
      format: "yyyy-mm-dd",
      showMeridian: true,
      autoclose: true,
      minView: 2,
    })
    $(".file-one").fileinput({
      'showUpload':false,
      'showPreview':false
    })
    $(".select2").select2({
      widht: "100%",
      placeholder: "Please Select"
    })    
  
  $('#modal-form').on('shown.bs.modal', function() {
    

    $('.file-remove-button').click(function(e){
      e.preventDefault();
      $(this).siblings('.file-id').val(0);
      $(this).siblings('.file-revert-button').show();
      $(this).siblings('.file-name').css('text-decoration', 'line-through');
      $(this).hide();
    })

    $('.file-revert-button').click(function(e){
      e.preventDefault();
      $(this).siblings('.file-id').val(1);
      $(this).siblings('.file-remove-button').show();
      $(this).siblings('.file-name').css('text-decoration', 'none');
      $(this).hide();
    })

    $('.datetimepicker').datetimepicker({
      format: "yyyy-mm-dd hh:ii:00",
      showMeridian: true,
      autoclose: true,
      minuteStep: 15,
    })
  });

  // $(document).on('change', ".file", function(){
  //   var fileName = $(this).val().replace(/.*(\/|\\)/, '');
  //   fileNameWOExt = fileName.substr(0, fileName.lastIndexOf('.'));
  //   if($(this).is(".file:last")){
  //     var input = $('<input class="file" name="files[]" type="file">');
  //     var newInput = $(this).closest('.file-input').after(input);
  //     $('.file').last().fileinput({
  //       'showUpload':false,
  //       'showPreview':false
  //     });
  //   }
  // })
  // $(document).on('click', ".fileinput-remove", function(){
  //   if($(this).closest('.file-input').not(':first')){
  //     $(this).closest('.file-input').prev('label').remove();
  //     $(this).closest('.file-input').remove();
  //   }else{
  //     var html = '<span class="file-caption-icon"></span>';
  //     html+= '<input class="file-caption-name" onkeydown="return false;" onpaste="return false;" placeholder="Select file...">'
  //     $(this).closest('.file-input').prev('label').remove();
  //     $(this).closest('.file-input').find('.file-caption').html(html);
  //   }
  // })

    $('.datetimepicker').click(function() 
    {
      var started_at = $("#started_at").val();
      var ended_at = $("#ended_at").val();
      //alert(started_at);
      var hours = myfunc(Date.parse(started_at), Date.parse(ended_at));
      $("#user-duration").val(hours);
    });


    function myfunc(start, end){
      var diffMs = (end - start); /// (1000 * 60 * 60);
      var diffHrs = Math.floor(diffMs / 3600000); // hours
      var diffMins = Math.round((diffMs % 3600000) / 60000); // minutes
      
      var hoursMin = (diffHrs + " : " + diffMins);
      return hoursMin;
    }

       
});


