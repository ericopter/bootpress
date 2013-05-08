(
	function(){
	
		tinymce.create(
			"tinymce.plugins.echothemeShortcodes",
			{
				init: function(d,e) {
					abs_url = e;
				},
				createControl:function(d,e)
				{
				
					if(d=="echotheme_shortcodes_button"){
					
						d=e.createMenuButton( "echotheme_shortcodes_button",{
							title:"Insert Theme Shortcodes",
							icons:false,
							image : abs_url + '/../images/icon-e-small.png'
							});
							
							var a=this;d.onRenderMenu.add(function(c,b){
								
								a.addImmediate(b,"Button", '[button label="" url=""]');
								a.addImmediate(b,"Formated Box", '[box type="blockquote|message|note|alert"]Box Content[/box]');
								a.addImmediate(b,"Tabs", '[tabs]<br />[tab title="Tab Title"]Content here[/tab]<br />[/tabs]');
								a.addImmediate(b,"Toggle Box", ' [toggle_content title="Toggle Title"]Your content goes here...[/toggle_content]');
								a.addImmediate(b,"Clear", '[clear]');
								a.addImmediate(b,"Horizontal Rule", '[hr]');
								
								
								b.addSeparator();
								// Columns
								c=b.addMenu({title:"Columns"});
									a.addImmediate(c,"One Third [first]","[one_third_first]Content[/one_third_first]" );
									a.addImmediate(c,"One Third [middle]","[one_third]Content[/one_third]" );
									a.addImmediate(c,"One Third [last]","[one_third_last]Content[/one_third_last]" );
									a.addImmediate(c,"Two Thirds [first]","[two_thirds]Content[/two_thirds]" );
									a.addImmediate(c,"Two Thirds [last]","[two_thirds_last]Content[/two_thirds_last]" );
									a.addImmediate(c,"One Half [first]","[one_half]Content[/one_half]" );
									a.addImmediate(c,"One Half [last]","[one_half_last]Content[/one_half_last]" );
								
								b.addSeparator();
								
								// Sliders
								d=b.addMenu({title:"Gallery Sliders"});
									a.addImmediate(d,"jQuery Cycle", "[jquerycycle]");
									a.addImmediate(d,"Flexslider", "[flexslider]");
									a.addImmediate(d,"Nivo Slider", "[nivoslider]");
							});
						return d
					
					} // End IF Statement
					
					return null
				},
		
				addImmediate:function(d,e,a){d.add({title:e,onclick:function(){tinyMCE.activeEditor.execCommand( "mceInsertContent",false,a)}})}
				
			}
		);
		
		tinymce.PluginManager.add( "echothemeShortcodes", tinymce.plugins.echothemeShortcodes);
	}
)();