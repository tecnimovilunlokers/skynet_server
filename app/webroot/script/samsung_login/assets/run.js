/*
 * Date   : 2016.12.15
 * Author : contentstech
 * Desc   : run application
 */
!function () {
	wip.load(wipLogicalPath+'/resources/js/v2/cmm/', [
		'config.js',
		'controller.js',
		'directive.js',
		'filter.js',
		'loading.js',
		'provider.js',
		'service.js',
		'util.js'
	]);
	wip.run(wip.path(wipLogicalPath+'/resources/js/v2/biz/' + PAGEPATH));
} ();