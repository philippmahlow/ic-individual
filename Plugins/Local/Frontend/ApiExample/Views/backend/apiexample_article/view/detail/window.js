
//{namespace name=backend/article/view/main}
//{block name="backend/article/view/detail/window" append}

Ext.define('Shopware.apps.ApiExampleArticle.view.detail.Window', {
    override: 'Shopware.apps.Article.view.detail.Window',

    createMainTabPanel: function() {
        var me = this, tooltip = '';

        me.mainTab = me.callParent(arguments);

        me.staticTab = Ext.create('Ext.container.Container', {
            title: "{s name='ApiExampleStaticTabHeader'}Statischer Tab{/s}",
            disabled: true,
            layout: 'fit',
            name: 'api-static-tab',
            html: '<h2>Hallo Welt</h2>',
            listeners: {
                render: function(){
                    console.log('TEST');
                }
            }
        });

        me.mainTab.add(me.staticTab);

       return me.mainTab;
    },
    onStoresLoaded: function(article, stores) {
        var me = this;
        me.article = article;

        me.staticTab.setDisabled(false);

        if(me.article) {
            me.staticTab.add({
                html: me.article.get('name')
            });
        }

        me.callParent(arguments);
    }

});
//{/block}
