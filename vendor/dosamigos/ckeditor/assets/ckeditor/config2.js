/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	 config.toolbar = [
          { name: 'document', items: [ 'Source', '-', 'Templates' ] },
          { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo' ] },
          { name: 'editing', items : [ 'Find','Replace','-','SelectAll' ] },
          { name: 'basicstyles', items: [ 'Bold', 'Italic','Underline', 'Strike', 'Subscript', 'Superscript' ] },
          
          { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote',
 '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
 { name: 'insert', items : [ 'Image', 'Table','HorizontalRule','Smiley','SpecialChar' ] },
       
       { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
 { name: 'colors', items : [ 'TextColor','BGColor' ] },
          { name: 'tools', items : [ 'Maximize', 'ShowBlocks' ] },
          { name: 'links', items: [ 'Anchor' ] }
      ];
      
	config.allowedContent=true;	
	config.extraAllowedContent = 'span(*);'+'td{data-title}';
};
CKEDITOR.dtd.$removeEmpty.span = 0;
for(var tag in CKEDITOR.dtd.$removeEmpty){
    CKEDITOR.dtd.$removeEmpty[tag] = false;
}