function CatalogTree(opts) {
    var holderElem = opts.holderElem;
    var baseCatalogPath = opts.baseCatalogPath;

    holderElem.on('click', function(e) {
        var clickedElem = $(e.target);
        if (clickedElem.hasClass('expander')) {
            var list = $(clickedElem.siblings('.to-expand').get(0));
            if (list) {
                var arrow = clickedElem.hasClass('arrow') ? clickedElem : $(clickedElem.siblings('.arrow').get(0));
                list.toggleClass('closed');
                arrow.toggleClass('glyphicon-menu-down').toggleClass('glyphicon-menu-right');
            }
        }
        if (clickedElem.attr('data-action')) {
            var action = clickedElem.attr('data-action');
            var catalogId = clickedElem.attr('data-catalog-id');
            window.location.href = baseCatalogPath + action + '/' + catalogId;
        }
    })
}
