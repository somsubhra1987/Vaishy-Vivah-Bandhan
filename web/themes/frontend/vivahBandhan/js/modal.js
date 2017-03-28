function getModalData(url, modalButtonObject){
 $.ajax({
          type: "GET",
          url: url,
          beforeSend: function(){
          $(modalButtonObject).append('<div class="fa fa-spinner fa-spin modal_loader"></div>');
        },
          success: function(data){
            $('#commonModal').html(data);
            $('#commonModal').modal('show');
            $('#commonModal').on('shown.bs.modal', function (e) {
        $('.modal_loader').remove();
      });
          }
    });
}

function recordCreateOrUpdate(url){
    var formData = new FormData($('form')[0]);
$.ajax({
        type: "POST",
        url: url,
        data: formData,
        dataType: "json",
        enctype: "multipart/form-data",
        cache: false,
      contentType: false,
      processData: false,
    success: function(data)
    {
      if(data.result=='success')
      {
        if(data.divAppend)
        {
          $('#renderDataDiv'+data.divAppend).html(data.renderDataDiv);
          $('#message'+data.divAppend).html('<div class="alert alert-success">'+data.msg+'</div>');
        }else {
          window.location.reload();
        }
        $('#commonModal').modal('hide');
      }
      else
      {
         $("#msg").html('<div class="error-summary">'+data.msg+'</div>');
      }
      },
      beforeSend:function()
  {
     $("#msg").html('<div class="alert alert-warning">Please wait...</div>');
  },
    });
}

function deleteAjax(obj, formMethod, message) {
  var url = $(obj).attr('href');
  var message = message || false;
  if(message)
    var ans = confirm(message);
  else
    var ans = confirm('Do you really want to delete ?');
  var parentObj = $(obj).parent();
  var parentHtml = '';
  if(ans)
  {
    $.ajax({
          type: formMethod,
          url: url,
          dataType: "json",
      success: function(data)
      {
        if(data.result=='success')
        {
          if(data.divAppend)
          {
            $('#renderDataDiv'+data.divAppend).html(data.renderDataDiv);
            $('#message'+data.divAppend).html('<div class="alert alert-success">'+data.msg+'</div>');
          }
        }
        else
        {
          $(parentObj).html(parentHtml);
          if(data.divAppend)
          {
            $('#message'+data.divAppend).html('<div class="alert alert-warning">'+data.msg+'</div>');
          }
          else
          {
            $("#msg").html('<div class="error-summary">'+data.msg+'</div>');
          }
        }
        },
        beforeSend:function()
    {
      parentHtml = $(parentObj).html();
        $(parentObj).html('<div class="ajax_loader"></div>');
    },
      });
    }
}