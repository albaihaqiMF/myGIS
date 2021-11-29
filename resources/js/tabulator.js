import xlsx from "xlsx";
import feather from "feather-icons";
import Tabulator from "tabulator-tables";

(function (cash) {
    "use strict";

    // Tabulator
    if (cash("#tabulator").length) {
        // Setup Tabulator
        let table = new Tabulator("#tabulator", {
            ajaxURL: "http://localhost:8000/data/map-list",
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "No matching records found",
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    align: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "NAME",
                    minWidth: 200,
                    responsive: 0,
                    field: "name",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div>
                            <div class="font-medium whitespace-nowrap">${
                                cell.getData().name
                            }</div>
                            <div class="text-gray-600 text-xs whitespace-nowrap">${
                                cell.getData().created_by
                            }</div>
                        </div>`;
                    },
                },
                {
                    title: "TAKSASI",
                    minWidth: 200,
                    field: "taksasi",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex lg:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img data-action="zoom" alt="MyGIS Tailwind HTML Admin Template" class="rounded-full zoom-in" src="${
                                    cell.getData().taksasi
                                }">
                            </div>
                        </div>`;
                    },
                },
                {
                    title: "N D V I",
                    minWidth: 200,
                    field: "ndvi",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex lg:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img data-action="zoom" alt="MyGIS Tailwind HTML Admin Template" class="rounded-full zoom-in" src="${
                                    cell.getData().ndvi
                                }">
                            </div>
                        </div>`;
                    },
                },
                {
                    title: "DATE",
                    minWidth: 200,
                    field: "date",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex items-center lg:justify-center text-theme-20"">
                            <i data-feather="check-square" class="w-4 h-4 mr-2"></i> ${
                                cell.getData().date
                            }
                        </div>`;
                    },
                },
                {
                    title: "ACTIONS",
                    minWidth: 200,
                    field: "actions",
                    responsive: 1,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex lg:justify-center items-center">
                            <a class="edit flex items-center text-theme-20 mr-3" href="${
                                cell.getData().url
                            }">
                                <i data-feather="eye" class="w-4 h-4 mr-1"></i> Lihat
                            </a>
                        </div>`;
                    },
                },

                // For print format
                {
                    title: "NAME",
                    field: "name",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "CREATOR",
                    field: "created_by",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "NDVI",
                    field: "ndvi",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue();
                    },
                },
                {
                    title: "DATE",
                    field: "date",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "TAKSASI",
                    field: "taksasi",
                    visible: false,
                    print: true,
                    download: true,
                    formatterPrint(cell) {
                        return cell.getValue();
                    },
                },
            ],
            renderComplete() {
                feather.replace({
                    "stroke-width": 1.5,
                });
            },
        });

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            feather.replace({
                "stroke-width": 1.5,
            });
        });

        // Filter function
        function filterHTMLForm() {
            let field = cash("#tabulator-html-filter-field").val();
            let type = cash("#tabulator-html-filter-type").val();
            let value = cash("#tabulator-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        cash("#tabulator-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLForm();
                }
            }
        );

        // On click go button
        cash("#tabulator-html-filter-go").on("click", function (event) {
            filterHTMLForm();
        });

        // On reset filter form
        cash("#tabulator-html-filter-reset").on("click", function (event) {
            cash("#tabulator-html-filter-field").val("name");
            cash("#tabulator-html-filter-type").val("like");
            cash("#tabulator-html-filter-value").val("");
            filterHTMLForm();
        });

        // Export
        cash("#tabulator-export-csv").on("click", function (event) {
            table.download("csv", "data.csv");
        });

        cash("#tabulator-export-json").on("click", function (event) {
            table.download("json", "data.json");
        });

        cash("#tabulator-export-xlsx").on("click", function (event) {
            window.XLSX = xlsx;
            table.download("xlsx", "data.xlsx", {
                sheetName: "Products",
            });
        });

        cash("#tabulator-export-html").on("click", function (event) {
            table.download("html", "data.html", {
                style: true,
            });
        });

        // Print
        cash("#tabulator-print").on("click", function (event) {
            table.print();
        });
    }
})(cash);
