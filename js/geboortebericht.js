(function() {
	tinymce.create('tinymce.plugins.geboortebericht', {
		init : function(ed, url) {
			ed.addButton('geboortebericht', {
				title : 'Geboortebericht',
				image : url+'/geboorteberichtbutton.png',
				onclick : function() {
					//var dummy = prompt("Hello world", "ok");
					ed.execCommand('mceInsertContent', false, 
						'[geboorte-bericht]<br>' +
						'Kennelnaam<br>' +
						'http://kennel/url<br>' +
						'Contactinfo (tel. )<br>' +
						'Reu: ?<br>' +
						'Teef: ?<br>' +
						'Geboortedatum: d-m-j<br>' +
						'x reuen/x teven<br>' +
						'(x pups beschikbaar)<br>' +
						'[/geboorte-bericht]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "Geboortebericht",
				author : 'Stephan Mahieu',
				authorurl : 'http://web.inter.nl.net/users/S.J.Mahieu/',
				infourl : 'http://web.inter.nl.net/users/S.J.Mahieu/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('geboortebericht', tinymce.plugins.geboortebericht);
})(); 
 
