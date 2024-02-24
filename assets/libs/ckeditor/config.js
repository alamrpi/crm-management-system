/**
 * @license Copyright (c) 2003-2022, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	//config.language = 'fr';
	// config.uiColor = '#AADC6E';
	// config.removePlugins= 'stylesheetparser';
	config.removePlugins =  [
		// These two are commercial, but you can try them out without registering to a trial.
		// 'ExportPdf',
		// 'ExportWord',
		'AIAssistant',
		'CKBox',
		'CKFinder',
		'EasyImage',
		// This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
		// https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
		// Storing images as Base64 is usually a very bad idea.
		// Replace it on production website with other solutions:
		// https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
		// 'Base64UploadAdapter',
		'RealTimeCollaborativeComments',
		'RealTimeCollaborativeTrackChanges',
		'RealTimeCollaborativeRevisionHistory',
		'PresenceList',
		'Comments',
		'TrackChanges',
		'TrackChangesData',
		'RevisionHistory',
		'Pagination',
		'WProofreader',
		// Careful, with the Mathtype plugin CKEditor will not load when loading this sample
		// from a local file system (file://) - load this site via HTTP server if you enable MathType.
		'MathType',
		// The following features are part of the Productivity Pack and require additional license.
		'SlashCommand',
		'Template',
		'DocumentOutline',
		'FormatPainter',
		'TableOfContents',
		'PasteFromOfficeEnhanced'
	];
	config.allowedContent=true;
	config.extraAllowedContent= '*(*)';
	config.toolbarCanCollapse= true;
	config.toolbar = [
	    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },
	    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
	    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
	    { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
	    '/',
	    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
	    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
	    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
	    { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
	    '/',
	    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
	    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	    { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
	    { name: 'others', items: [ '-' ] },
	    { name: 'about', items: [ 'About' ] }
	];


};
