Ext.define('Shopware.apps.Example.view.detail.Window', {
    extend: 'Shopware.window.Detail',
    alias: 'widget.example-detail-window',
    title : '{s name=title}Example details{/s}',
    height: 420,
    width: 900,
    configure: function(){
        return {
            associations: [ 'supplier' ]
        }
    }
});