Ext.define('Shopware.apps.Example.store.Example', {
    extend:'Shopware.store.Listing',

    configure: function() {
        return {
            controller: 'Example'
        };
    },
    model: 'Shopware.apps.Example.model.Example'
});