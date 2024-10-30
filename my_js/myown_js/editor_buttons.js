function tinyplugin() {
    return "[cgbutton-plugin]";
}

(function() {

    tinymce.create('tinymce.plugins.cgbuttonplugin', {

        init : function(ed, url){
            ed.addButton('cgbuttonplugin', {
                title : 'Add Gold Shortcode',
                onclick : function() {
				
				ed.windowManager.open({
					file : url + '/cube-gold-button.php',
					width : 450 + parseInt(ed.getLang('lightbox_buddy.delta_width', 0)),
					height : 350 + parseInt(ed.getLang('lightbox_buddy.delta_height', 0)),
					inline : 1
				})			
                },
                image: url + "/add.png"
            });
        },

        getInfo : function() {
            return {
                longname : 'Gold Button',
                author : 'Semar Yousif',
            };
        }
    });

    tinymce.PluginManager.add('cgbuttonplugin', tinymce.plugins.cgbuttonplugin);
    
})();