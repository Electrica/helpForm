helpForm.page.Home = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'helpform-panel-home',
            renderTo: 'helpform-panel-home-div'
        }]
    });
    helpForm.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(helpForm.page.Home, MODx.Component);
Ext.reg('helpform-page-home', helpForm.page.Home);