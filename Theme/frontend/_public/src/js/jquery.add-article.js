;(function($, window) {
    'use strict';

    $.overridePlugin('swAddArticle', {
        sendSerializedForm: function (event) {

            if(confirm('Willst du wirklich?')) {
                var me = this;
                me.superclass.sendSerializedForm.apply(me, arguments);
            } else {
                event.preventDefault();
                alert('Dann nicht.');
            }
        }
    });
})(jQuery, window);
