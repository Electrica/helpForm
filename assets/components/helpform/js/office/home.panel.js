helpForm.panel.Home = function (config) {
    config = config || {};
    Ext.apply(config, {
        baseCls: 'modx-formpanel',
        layout: 'anchor',
        /*
         stateful: true,
         stateId: 'helpform-panel-home',
         stateEvents: ['tabchange'],
         getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
         */
        hideMode: 'offsets',
        items: [{
            xtype: 'modx-tabs',
            defaults: {border: false, autoHeight: true},
            border: false,
            hideMode: 'offsets',
            items: [{
                title: _('helpform_items'),
                layout: 'anchor',
                items: [{
                    html: _('helpform_intro_msg'),
                    cls: 'panel-desc',
                }, {
                    xtype: 'helpform-grid-items',
                    cls: 'main-wrapper',
                }]
            }]
        }]
    });
    helpForm.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(helpForm.panel.Home, MODx.Panel);
Ext.reg('helpform-panel-home', helpForm.panel.Home);
