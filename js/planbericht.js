(function() {
	tinymce.create('tinymce.plugins.planbericht', {
		init : function(ed, url) {
			ed.addButton('planbericht', {
				title : 'Planbericht',
				image : url+'/planberichtbutton.png',
				onclick : function() {
					//var dummy = prompt("Hello world", "ok");
					ed.execCommand('mceInsertContent', false, 
						'[plan-bericht]<br>' +
						'Kennelnaam<br>' +
						'http://kennel/url<br>' +
						'Contactinfo (tel. )<br>' +
						'Reu: ?<br>' +
						'Teef: ?<br>' +
						'[/plan-bericht]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "Planbericht",
				author : 'Stephan Mahieu',
				authorurl : 'http://web.inter.nl.net/users/S.J.Mahieu/',
				infourl : 'http://web.inter.nl.net/users/S.J.Mahieu/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('planbericht', tinymce.plugins.planbericht);
})(); 
