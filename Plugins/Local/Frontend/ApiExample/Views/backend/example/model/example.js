Ext.define('Shopware.apps.Example.model.Example', {
    extend: 'Shopware.data.Model',

    configure: function () {
        return {
            controller: 'Example',
            detail: 'Shopware.apps.Example.view.detail.Example'
        };
    },

    fields: [
        { name: 'id', type: 'int', useNull: true },
        { name: 'name', type: 'string' },
        { name: 'mediaId', type: 'int' }
    ],

    associations: [{
        relation: 'ManyToMany',
        type: 'hasMany',
        model: 'Shopware.apps.Example.model.Supplier',
        name: 'getSupplier',
        associationKey: 'supplier'
    },{
        relation: 'ManyToOne',
        field: 'mediaId',
        type: 'hasMany',

        model: 'Shopware.apps.Base.model.Media',
        name: 'getMedia',
        associationKey: 'media'
    }]
});