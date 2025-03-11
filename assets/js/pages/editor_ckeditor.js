/* ------------------------------------------------------------------------------
*
*  # CKEditor editor
*
*  Specific JS code additions for editor_ckeditor.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {

    // Full featured editor
    CKEDITOR.replace( 'editor-full', {
        height: '400px',
        //extraPlugins: 'forms'
		toolbarGroups: [
			{ "name": 'styles' },
			{ "name": 'basicstyles', "groups": [ 'basicstyles', 'cleanup' ] },
			{ "name": 'clipboard', "groups": [ 'clipboard', 'undo' ]},
			{ "name": 'editing', "groups": [ 'find', 'selection', 'spellchecker' ]},
			{ "name": 'insert'},
			{ "name": 'editing', "groups": [ "find" ]},
			{"name":"paragraph","groups":["list","blocks"]},
			{"name":"document","groups":["mode"]},
			{ "name": 'links'},
			{"name": "tools"},
		],
	});
});
