$(document).ready(function(){
    var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};
    $("#username").focus(function(){
        $("#errorid").hide();
    });  
    $("#pwd").focus(function(){
        $("#errorid").hide();
    });    
$("#login-button").click(function(){
var ID = getUrlParameter('ID');
var username = $("#username").val();
var password = $("#pwd").val();
var domain = window.location.hostname;

if(!$("#username").val() || !$("#pwd").val()) {
   
}else{
    var dataString = 'ID=' + ID + '&username=' + username + '&password=' + password + '&domain=' + domain;
    $.ajax({
      type: "POST",
      url:"login.php",
      data: dataString,
      beforeSend: function(){
        $("#loadit").show();
      },
      complete: function(){
        $("#loadit").hide();
      },
      success: function(data){
        if(data == "success"){
window.location.href = "/map/";
        }else{
            $("#errorid").html('<p style="color:#ff6700">The account ID or password you entered is incorrect.</p>');
            $("#errorid").show();

        }
      }
  });

    
}

});



});