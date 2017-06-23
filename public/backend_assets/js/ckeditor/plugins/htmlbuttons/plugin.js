/*
 * @file HTML Buttons plugin for CKEditor
 * Copyright (C) 2012 Alfonso Martínez de Lizarrondo
 * A simple plugin to help create custom buttons to insert HTML blocks
 */

CKEDITOR.plugins.add( 'htmlbuttons',
{
	init : function( editor )
	{
		var buttonsConfig = editor.config.htmlbuttons;
		if (!buttonsConfig)
			return;

		function createCommand( definition )
		{
			return {
				exec: function( editor ) {
					editor.insertHtml( definition.html );
				}
			};
		}

		// Create the command for each button
		for(var i=0; i<buttonsConfig.length; i++)
		{
			var button = buttonsConfig[ i ];
			var commandName = button.name;
			editor.addCommand( commandName, createCommand(button, editor) );

			editor.ui.addButton( commandName,
			{
				label : button.title,
				command : commandName,
				icon : this.path + button.icon
			});
		}
	} //Init

} );

/**
 * An array of buttons to add to the toolbar.
 * Each button is an object with these properties:
 *	name: The name of the command and the button (the one to use in the toolbar configuration)
 *	icon: The icon to use. Place them in the plugin folder
 *	html: The HTML to insert when the user clicks the button
 *	title: Title that appears while hovering the button
 *
 * Default configuration with some sample buttons:
 */
CKEDITOR.config.htmlbuttons =  [
	{
		name:'PDF Download Icon',
		icon:'icon-pdf.png',
		html:'<span class="pdf-download theme-bg"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span><span class="corner"></span></span> <a href="http://">下載 PDF</a>',
		title:''
	},
	{
		name:'DOC Download Icon',
		icon:'icon-doc.png',
		html:'<span class="doc-download theme-bg"><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span><span class="corner"></span></span> <a href="http://">下載 DOC</a>',
		title:''
	},
	{
		name:'Video Icon',
		icon:'icon-video.png',
		html:'<span class="watch-video"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span></span> <a href="http://">觀看短片</a>',
		title:''
	},
	{
		name:'Image Icon',
		icon:'icon-image.png',
		html:'<span class="view-image"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></span> <a href="http://">下載圖片</a>',
		title:''
	},
	{
		name:'PPT Icon',
		icon:'icon-ppt.png',
		html:'<span class="watch-video"><span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span></span> <a href="http://">下載簡報</a>',
		title:''
	},
	
];