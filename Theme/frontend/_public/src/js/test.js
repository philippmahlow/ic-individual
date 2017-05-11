;(function($, window) {
    'use strict';

    $(function(){
        setTimeout(function(){
            $('.footer--column').eq(0).append('<form url="http://shopware.p408414.webspaceconfig.de/" method="post"><input name="test" /> <button type="submit">ASDF</button></form>');
            CSRF.updateForms();

            $.post('http://shopware.p408414.webspaceconfig.de/checkout/cart', {
                data: {
                    test: 1
                }
            });
        }, 2000);
    });

})(jQuery, window);
