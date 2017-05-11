Ext.define('Shopware.apps.Example.view.detail.Example', {
    extend: 'Shopware.model.Container',
    padding: 20,

    configure: function() {
        return {
            controller: 'Example',
            fieldSets: [
                {
                    fields: {
                        name: 'Name',
                        mediaId: 'Bild'
                    },
                    title: 'Basis'
                }
            ]
        };
    }
});