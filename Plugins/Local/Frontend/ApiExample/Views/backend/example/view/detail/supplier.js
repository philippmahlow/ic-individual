Ext.define('Shopware.apps.Example.view.detail.Supplier', {
    extend: 'Shopware.grid.Association',
    alias: 'widget.example-view-detail-supplier',
    height: 300,
    title: 'Supplier',

    configure: function() {
        return {
            controller: 'Example',
            columns: {
                name: {

                }
            }
        };
    }
});