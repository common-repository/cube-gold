$('#tabs').tabs({ajaxOptions: {
error: function (xhr, index, status, anchor)
{
	$(anchor.hash).text('Could not load page')
	}
	
	}});

  $(document).ready(function(){
   setTimeout(function(){
  $("div.noticetime").fadeOut("slow", function () {
  $("div.noticetime").remove();
      });
    
}, 2000);
 });
