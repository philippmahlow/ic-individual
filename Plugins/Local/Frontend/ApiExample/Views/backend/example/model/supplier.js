Ext.define('Shopware.apps.Example.model.Supplier', {
    extend: 'Shopware.apps.Base.model.Supplier',

    configure: function () {
        return {
            related: 'Shopware.apps.Example.view.detail.Supplier'
        };
    }
});