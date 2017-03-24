(function() {
	tinymce.create('tinymce.plugins.dekbericht', {
		init : function(ed, url) {
			ed.addButton('dekbericht', {
				title : 'Dekbericht',
				image : url+'/dekberichtbutton.png',
				onclick : function() {
					ed.execCommand('mceInsertContent', false, 
						'[dek-bericht]<br>' +
						'Kennelnaam<br>' +
						'http://kennel/url<br>' +
						'Contactinfo (tel. )<br>' +
						'Reu: ?<br>' +
						'Teef: ?<br>' +
						'Dekdatum: d-m-j<br>' +
						'[/dek-bericht]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "Dekbericht",
				author : 'Stephan Mahieu',
				authorurl : 'http://web.inter.nl.net/users/S.J.Mahieu/',
				infourl : 'http://web.inter.nl.net/users/S.J.Mahieu/',
				version : "1.1"
			};
		}
	});
	tinymce.PluginManager.add('dekbericht', tinymce.plugins.dekbericht);
})(); 
