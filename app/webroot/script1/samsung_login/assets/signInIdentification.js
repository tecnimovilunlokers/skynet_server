/*
 * Date   : 2016.12.15
 * Author : contentstech
 * Desc   : login
 */
!function () {
  wip.init();

  wip.app().controller('signInController', function (co, $scope, $timeout) {
    var log = co.get('logger').getLogger('signIn');
    var http = co.get('http');
    var location = co.get('location');
    var localStoredParam = co.get('wiplocalstorage');

    var vm = $scope.vm = {};

    vm.iptLgnPlnID = iptLgnPlnID;
    vm.iptLgnPlnPD = null;
    vm.blnIptLgnPlnPD = true;
    vm.continueWith3rdParty = continueWith3rdParty;
    vm.isAdmin = isAdmin;
    vm.isUsingGlobalSession = isUsingGlobalSession;
    vm.staySignIn = false;

    deleteGoogleAnalyticsCookies();

    // Init google api
    var nonce = Math.random().toString(36).substring(2, 12);
    if (vm.continueWith3rdParty === "GG") {
      gapi.load('auth2', function () {
        gapi.auth2.init({
          client_id: '40316552947-p4entmmkhrq6r4e8gia8cprg30j17gn8.apps.googleusercontent.com',
          scope: 'openid profile email https://www.googleapis.com/auth/user.birthday.read',
          nonce: nonce
        })
      });
    }

    if (vm.isUsingGlobalSession) {
      const sessionExtendableCookie = getStaySignInCheckBoxCookie();
      if (sessionExtendableCookie) {
        vm.staySignIn = sessionExtendableCookie === "true";
      }
    } else {
      vm.staySignIn = false;
    }

    // 초기화 정보 로드
    http.get(wipLogicalPath + '/' + APPNAME + '/signInXhr').then(
      function (result) {
        if (!result.error) {
          if (result.iptLgnPlnID) {
            vm.iptLgnPlnID = result.iptLgnPlnID;

            var select = $('#ctnLgnPlnID');
            select.addClass('active');

          }
          vm.remIdChkYN = result.remIdChkYN;

          vm.angularCountryCode = result.userAcsCnty3dgtCd;
          vm.rmvCrtBtnYN = result.rmvCrtBtnYN == 'Y' ? true : false;
          vm.backgroundImage = result.backgroundImage;
          if (vm.backgroundImage) {
            $scope.$parent.bgStyle = {
              'background-color': $scope.$parent.stringSplit(
                vm.backgroundImage, '@', 0),
              'background-image': 'url(' + wipResourcesUrl
                + $scope.$parent.stringSplit(vm.backgroundImage, '@', 1)
                + ')'
            };
          }
        }

        if (result.iptLgnPlnID) {
          vm.iptLgnPlnID = result.iptLgnPlnID;
        }

        /* changePassword 통해서 비번 변경한 경우, 해당 계정으로 다시 로그인 할 수 있게 아이디를 프리필드 시켜준다. */
        var saveIptLgnINFO = localStoredParam.getObject('saveIptLgnINFO');
        if (saveIptLgnINFO) {
          var saveDateTime = new Date(saveIptLgnINFO.saveDateTime);
          var result = ((new Date().getTime() - saveDateTime.getTime()) < 300000) ? true : false; // 5분
          if (result) {
            vm.iptLgnPlnID = saveIptLgnINFO.saveIptLgnID;
          } else {
            localStoredParam.clear('saveIptLgnINFO');
          }
        }
      });

    $scope.err = {
      code: '',
      iptLgnPlnID: false,
      message: ''
    };


    $scope.isSubmitted = false;

    $scope.checkUsableLoginId = function () {
      eventLogging('next');
      $scope.recaptchaExecuteAndCreateAssessment('login', vm.iptLgnPlnID, function (assessmentId) {
        http.post(wipLogicalPath + '/' + APPNAME + '/signInIdentificationProc', {
          loginId: vm.iptLgnPlnID,
          rememberId: vm.remIdChkYN,
          staySignIn: vm.staySignIn
        }).then(
          function (result) {
            if (result.rtnCd === 'VALID' || result.nextURL) {
              $scope.recaptchaAnnotate(
                assessmentId,
                vm.iptLgnPlnID,
                "CORRECT_PASSWORD",
                undefined,
                function () {
                 window.location.href = result.nextURL;
                }
              )
            } else {
              $scope.err.code = '02';
              $scope.err.iptLgnPlnID = true;

              $scope.recaptchaAnnotate(assessmentId, vm.iptLgnPlnID, "INCORRECT_PASSWORD")
            }
          }
        );
      });
    }

    // vm.iptLgnPlnID 의 값을 지속적으로 감시
    $scope.$watch('vm.iptLgnPlnID', function (n, o) {
      if (typeof (n) == 'undefined') {//vm.iptLgnPlnID가 type이 email이라 패턴이 지켜지지 않음 undefined이므로 아무거나 입력되는 순간 패스워드 필드를 enabled시켜 준다.
        vm.blnIptLgnPlnPD = false;
      }
      if (n && n.length) {
        $scope.err.iptLgnPlnID = false;
      }
    });

    $scope.signUp = function () {
      eventLogging('signUp', function () {
        location.go(wipLogicalPath + '/' + APPNAME + '/signUp');
      });
    };

    $scope.findInfo = function () {
      eventLogging('findId', function () {
        location.go(wipLogicalPath + '/' + APPNAME + '/findId');
      });
    };

    $scope.remIdChk = function () {
      eventLogging('rememberId');
      vm.remIdChkYN = !vm.remIdChkYN;
    };

    $scope.googleSignIn = function () {
      eventLogging('signInWithGoogle');
      var mapParam = {};

      gapi.auth2
        .getAuthInstance()
        .signIn({
          prompt: 'select_account'
        })
        .then(function (response) {
          mapParam = {
            access_token: response.getAuthResponse().access_token,
            id_token: response.getAuthResponse().id_token,
            redirect_uri: location.uri(),
            nonce: nonce,
            staySignIn: vm.staySignIn
          }

          http.post(wipLogicalPath + '/' + APPNAME + '/signIn3rdParty',
            mapParam).then(function (result) {
            if (result.rtnCd == "SUCCESS_POST") {
              var keys = Object.keys(result.rtnMap);
              var form = null;
              try {
                form = document.createElement(
                  "<form id='formSecured' name='formSecured' method='POST' action='"
                  + result.nextURL + "' />");
              } catch (e) {
                form = document.createElement("form");
                form.id = 'formSecured';
                form.name = 'formSecured';
                form.method = 'POST';
                form.action = result.nextURL;
              }
              for (var i in keys) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", keys[i]);
                hiddenField.setAttribute("value", result.rtnMap[keys[i]]);
                form.appendChild(hiddenField);
              }
              document.body.appendChild(form);
              form.submit();
            } else {
              if (result.nextURL != null) {
                window.location.href = result.nextURL;
              } else if (result.rtnCd == "BLACKLISTED_USER_STATUS") {
                $scope.err.code = 'AUT_1837';
                $scope.err.iptLgnPlnID = true;
                return;
              } else if (result.rtnCd == "DENIED_CHARACTERS" || result.rtnCd == "INAPPROPRIATE_CHARACTERS") {
                $scope.err.code = '99';
                $scope.err.message = result.rtnMsg;//다국어 처리가 된 오류 메시지
                $scope.err.iptLgnPlnID = true;
              } else {
                $scope.err.code = '98'; //특정 다른 이유가 있을때 99 코드 적어줌
                $scope.err.message = result.rtnMsg;//다국어 처리가 된 오류 메시지
                $scope.err.iptLgnPlnID = true;
              }
            }
          });
        })
        .catch(function (error) {
          console.log("gapi.auth2.getAuthInstance().signIn() error :")
          console.log(error)
        });
    }

    $scope.wechatSignIn = function () {
      eventLogging('signInWithWechat');
      http.get(wipLogicalPath + '/' + APPNAME + '/signInWechatXhr').then(
        function (result) {
          if (result) {
            var param = "?appId=" + result.appId
              + "&redirect_uri=" + result.redirect_uri
              + "&response_type=" + result.response_type
              + "&scope=" + result.scope
              + "&state=" + encodeURIComponent(result.state);

            window.location.href = 'https://open.weixin.qq.com/connect/qrconnect'
              + param;
          }
        });
    }

    $scope.qrSignIn = function () {
      eventLogging('signInWithQrCode', function () {
        location.go(wipLogicalPath + '/' + APPNAME + '/signInWithQrCode');
      });
    }

    function deleteGoogleAnalyticsCookies() {
      let param = new URLSearchParams(window.location.search);
      let appId = param.get('client_id');
      if (appId !== 'ea2r064y73') {
        ['_ga', '_gat', '_gid'].forEach((value) => {
          document.cookie = value + '=; expires=Thu, 01 Jan 1999 00:00:10 GMT; domain=samsung.com; path=/;';
        })
      }
    }

    $scope.$watch('vm.staySignIn', function () {
      if (vm.isUsingGlobalSession) {
        vm.staySignIn ? setStaySignInCheckBoxCookie("true") : setStaySignInCheckBoxCookie("false");
      }
    });

    function getStaySignInCheckBoxCookie() {
      return document.cookie
        .split("; ")
        .find((row) => row.startsWith("sa_session_extendable="))
        ?.split("=")[1];
    }

    function setStaySignInCheckBoxCookie(value) {
      document.cookie = "sa_session_extendable=" + value + "; Path=/; Domain=samsung.com"
    }
  });
}();
