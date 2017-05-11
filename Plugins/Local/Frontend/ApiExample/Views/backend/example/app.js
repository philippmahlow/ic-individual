Ext.define('Shopware.apps.Example', {
    extend: 'Enlight.app.SubApplication',

    name:'Shopware.apps.Example',

    loadPath: '{url action=load}',
    bulkLoad: true,

    controllers: [ 'Main' ],

    views: [
        'list.Window',
        'list.Example',
        'detail.Window',
        'detail.Example',
        'detail.Supplier'
    ],

    models: [ 'Example', 'Supplier' ],
    stores: [ 'Example' ],

    launch: function() {
        return this.getController('Main').mainWindow;
    }
});