Ext.define('Shopware.apps.Example.view.list.Example', {
    extend: 'Shopware.grid.Panel',
    alias:  'widget.example-listing-grid',
    region: 'center',
    configure: function(){
        return {
            detailWindow: 'Shopware.apps.Example.view.detail.Window',
            columns: {
                name: {
                    header: 'Mein Name'
                }
            }
        };
    }
});