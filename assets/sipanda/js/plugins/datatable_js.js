// demo file...no need to steal our code ;-)
$(document).ready(function(e) {
    e.extend(e.tablesorter.themes.bootstrap, {
        table: "table table-bordered",
        header: "bootstrap-header",
        footerRow: "",
        footerCells: "",
        icons: "",
        sortNone: "fa fa-sort",
        sortAsc: "fa fa-sort-up",
        sortDesc: "fa fa-sort-down",
        active: "",
        hover: "",
        filterRow: "",
        even: "",
        odd: ""
    });
    e("#tablesorting-1").tablesorter({
        theme: "bootstrap",
        widthFixed: true,
        headerTemplate: "{content} {icon}",
        widgets: ["uitheme", "filter", "zebra"],
        widgetOptions: {
            zebra: ["even", "odd"],
            filter_reset: ".reset"
        }
    }).tablesorterPager({
        container: e(".pager"),
        cssGoto: ".pagenum",
        removeRows: false,
        output: "{startRow} - {endRow} / {filteredRows} ({totalRows})"
    });
});

