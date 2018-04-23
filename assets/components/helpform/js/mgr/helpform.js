var helpForm = function (config) {
    config = config || {};
    helpForm.superclass.constructor.call(this, config);
};
Ext.extend(helpForm, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('helpform', helpForm);

helpForm = new helpForm();