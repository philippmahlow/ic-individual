Ext.define('Shopware.apps.Example.view.list.Window', {
    extend: 'Shopware.window.Listing',
    alias: 'widget.example-list-window',
    height: 450,
    title : '{s name=window_title}Example listing{/s}',

    configure: function() {
        return {
            listingGrid: 'Shopware.apps.Example.view.list.Example',
            listingStore: 'Shopware.apps.Example.store.Example'
        };
    }
});