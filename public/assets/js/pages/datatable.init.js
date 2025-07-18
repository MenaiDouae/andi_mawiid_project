try {
    new simpleDatatables.DataTable("#datatable_1", {
        searchable: !0,
        fixedHeight: !1,
    });
} catch (e) {}
try {
    const b = new simpleDatatables.DataTable("#datatable_2");
    document.querySelector("button.csv").addEventListener("click", () => {
        simpleDatatables.exportCSV(b, {
            download: !0,
            lineDelimiter: "\n\n",
            columnDelimiter: ";",
        });
    }),
        document.querySelector("button.sql").addEventListener("click", () => {
            simpleDatatables.exportSQL(b, {
                download: !0,
                tableName: "export_table",
            });
        }),
        document.querySelector("button.txt").addEventListener("click", () => {
            simpleDatatables.exportTXT(b, { download: !0 });
        }),
        document.querySelector("button.json").addEventListener("click", () => {
            simpleDatatables.exportJSON(b, {
                download: !0,
                escapeHTML: !0,
                space: 3,
            });
        });
} catch (e) {}
try {
    document.addEventListener("DOMContentLoaded", function () {
        var a = document.querySelector("[name='select-all']"),
            c = document.querySelectorAll("[name='check']");
        a?.addEventListener("change", function () {
            var t = a.checked;
            c.forEach(function (e) {
                e.checked = t;
            });
        }),
            c.forEach(function (e) {
                e.addEventListener("click", function () {
                    var e = c.length,
                        t = document.querySelectorAll(
                            "[name='check']:checked"
                        ).length;
                    t <= 0
                        ? ((a.checked = !1), (a.indeterminate = !1))
                        : e === t
                        ? ((a.checked = !0), (a.indeterminate = !1))
                        : ((a.checked = !0), (a.indeterminate = !0));
                });
            });
    });
} catch (e) {}
