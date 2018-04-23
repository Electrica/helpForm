Ext.onReady(function () {
    helpForm.config.connector_url = OfficeConfig.actionUrl;

    var grid = new helpForm.panel.Home();
    grid.render('office-helpform-wrapper');

    var preloader = document.getElementById('office-preloader');
    if (preloader) {
        preloader.parentNode.removeChild(preloader);
    }
});