/*
 * Date   : 2016.12.15
 * Author : contentstech
 * Desc   : application
 */
!function () {
	var wip = {}, app = angular.module('app', ['ngRoute', 'blockUI', 'ngMessages', 'angular.filter', 'monospaced.qrcode']);

	wip.app = function () { return app; };
	wip.run = run;
	wip.init = init;
	wip.v = v;
	wip.uri = uri;
	wip.path = path;
	wip.load = load;
	wip.device = device();
	wip.browser = browser();
	
	var cookies = angular.module('cookie', ['ngCookies']);
	wip.cookies = function () { return cookies; };

	window.wip = wip;

	/** 앱 실행 */
	function run(pagepath) {
		wip.load('', pagepath);
		angular.element(document).ready(function () {
			angular.bootstrap(document, ['app', 'cookie']);
		});
	}

	/** 모듈 초기화 route config 선언 */
	function init(lib, data, otherwise) {
		_.each(lib, function (v) {
			wip.load(v.base, v.path);
		});

		if(data && data.length){
			wip.app().config(['$routeProvider', 'routeProvider', function ($routeProvider, routeProvider) {
				$routeProvider.otherwise({ redirectTo: otherwise });
				_.each(data, function (v) {
					$routeProvider.when(v.path, routeProvider.route(v));
				});
			}]);
		}
	}

	/** 버전 문자열 생성 */
	function v() {
		return (new Date()).getTime() + (Math.floor(Math.random() * 100) + 1);
	}

	/** 파일PATH 조합 (c가 true 일때 캐싱) */
	function uri(p, c) {
		c = c === undefined ? true : c;
		//return (c = !c ? '?v=' + v() : ''), path(p) + c;
		return (c = !c ? '?v=' + v() : '?v=' + wipResourcesVerDt), path(p) + c;
	}

	/** 앱 루트 PATH 조합 */
	function path(p) {
		p = p || '';
		return (p[0] === '/' ? '/' : '') + _.compact(_.flatten(p.split('/'))).join('/');
	}

	/** 소스코드(js,css) 로드 */
	function load(b, p, c, as, cs) {
		c = c === undefined ? true : c;
		_.each(_.compact(_.flatten([p])), function (v) {
			var u = path('/' + b + '/' + v);
			//var e = _.last(u.split('.')).toUpperCase();
			var e = _.last(u.split('?')[0].split('.')).toUpperCase();
			if (e == 'JS') loadJS(u, c, as, cs);
			if (e == 'CSS') loadCSS(u, c, as);
		});
	}

	/** 로드 JS */
	function loadJS(p, c, as, cs) {
		var o = { src: uri(p, c) };
		if (cs) o.charset = cs;
		addTag('script', o, as);
	}

	/** 로드 CSS */
	function loadCSS(p, c, as) {
		addTag('link', { href: uri(p, c), rel: 'stylesheet' }, as);
	}

	/** 태그추가 */
	function addTag(n, a, as) {
		var h = document.getElementsByTagName('head')[0], e = document.createElement(n);
		_.each(a, function (v, k) { e.setAttribute(k, v); });
		if (as) h.appendChild(e); else document.write(out(e));
	}

	/** 객체삽입 */
	function out(e) {
		return e.outerHTML || (function (n) {
			var d = document.createElement('div'), h;
			return d.appendChild(n), h = d.innerHTML, d = null, h;
		})(e);
	}

	/** 하드웨어 종류 */
	function device() {
		var a = navigator.userAgent, av = navigator.appVersion, d = 'P', o = 'N';
		if (a.match(/Android|Mobile|iP(hone|od|ad)|BlackBerry|IEMobile|Kindle|NetFront|Silk-Accelerated|(hpw|web)OS|Fennec|Minimo|Opera M(obi|ini)|Blazer|Dolfin|Dolphin|Skyfire|Zune/)) {
			d = 'M';
			o = _.find({ 'Android': 'A', 'iPhone': 'I', 'iPod': 'I', 'iPad': 'I' }, function (v, k) { return a.indexOf(k) > -1; }) || 'N';
		}
		if (d != 'M' && av.match(/Android|Mobile|iP(hone|od|ad)|BlackBerry|IEMobile|Kindle|NetFront|Silk-Accelerated|(hpw|web)OS|Fennec|Minimo|Opera M(obi|ini)|Blazer|Dolfin|Dolphin|Skyfire|Zune/)) {
			d = 'M';
			o = _.find({ 'Android': 'A', 'iPhone': 'I', 'iPod': 'I', 'iPad': 'I' }, function (v, k) { return av.indexOf(k) > -1; }) || 'N';
		}
		return [d, o];
	}

	/** 브라우저 종류 */
	function browser() {
		var m = document.documentMode, a = navigator.userAgent,
			b = _.find({ 'Chrome/': 'C', 'Safari/': 'S', 'Firefox/': 'F', 'OPR': 'O', 'Opera': 'O', 'Trident/': 'I', 'MSIE': 'I' }, function (x, y) { return a.indexOf(y) > -1; }) || 'N',
			v = _.find({ 'Trident/4.0': 8, 'Trident/5.0': 9, 'Trident/6.0': 10, 'Trident/7.0': 11 }, function (x, y) { return a.indexOf(y) > -1; }) || 7;
		return b == 'I' ? (m ? ['I', v, m] : ['I', 7, 7]) : [b, 99, 99];
	}

} ();