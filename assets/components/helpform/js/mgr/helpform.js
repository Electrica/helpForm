// var helpForm = function (config) {
//     config = config || {};
//     helpForm.superclass.constructor.call(this, config);
// };
// Ext.extend(helpForm, Ext.Component, {
//     page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
// });
// Ext.reg('helpform', helpForm);
//
// helpForm = new helpForm();
//
// helpForm.grid.Items = function (config) {
//
//     config = config || {};
//
//     Ext.applyIf(config, {
//         fields: ['id','name'],
//         columns: ['id', 'name']
//     });
//
//     helpForm.grid.Items.superclass.constructor.call(this, config);
//
// };
// Ext.extend(helpForm.grid.Items, MODx.grid.Grid, {});
// Ext.reg('helpform-grid', helpForm.grid.Items);