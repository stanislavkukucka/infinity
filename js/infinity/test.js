

 jQuery("#submitreg").click(function(){
   alert ("click");
 jQuery.post( jQuery("#regForm").attr("action"),
  jQuery("#regForm :button").serializeArray(),
  function(info) {
  jQuery("#ack").empty();
  jQuery("#ack").html(info);
  
  });
  jQuery("#regForm").submit(function(){
   return false;
  });
  
  
 
 });
 
 