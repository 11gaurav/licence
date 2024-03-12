$(document).ready(function () {
    initTables();

    $(document).on("click", ".print-form", function (event) {
//        alert('dfs');
        event.preventDefault();
        var link = $(this).attr("href");
        $.ajax({
            url: link,
            dataType: 'html',
            success: function (data) {
                var filename = base_url + data;
                console.log(filename);
                printPage(filename);
            }
        });
    });
});


function blockUI()
{
    $.blockUI({
        baseZ: 9999,
        message: '<p><img src="' + base_url + 'assets/images/ajax-loader.gif" />  Processing ...</p>'
    });
}

function initTables() {
    $("table.dyntable:visible").each(function (i, ele) {
        var ele = $(ele);
        var source = ele.attr('source');
        var jsonStr = ele.attr('jsonInfo');
        var max_rows = ele.attr("max_rows");
        ele.DataTable({
//            dom: 'Bflrtip',
//            buttons: [
//                'print'
//            ],
            stateSave: true,
            "searchable": true,
            "pageLength": 10,
            "sortable": true,
            "serverSide": true,
            "processing": true,
            "pagingType": "full_numbers",
            "ajax": source,
            "order": [[0, 'asc']],
            "columns": eval(jsonStr),
            "scrollX": true,
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function () {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
        });
//        ele.dataTable().fnFilterOnReturn();
    });
}

function printResult(element_id)
{
    var DocumentContainer = document.getElementById(element_id);
    var WindowObject = window.open('', "PrintWindow", "width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes");
    WindowObject.document.writeln(DocumentContainer.innerHTML);
    WindowObject.document.close();
    WindowObject.focus();
    WindowObject.print();
    WindowObject.close();
}

function closePrint() {
    document.body.removeChild(this.__container__);
}

function setPrint() {
    this.contentWindow.__container__ = this;
    this.contentWindow.onbeforeunload = closePrint;
    this.contentWindow.onafterprint = closePrint;
    this.contentWindow.focus(); // Required for IE
    this.contentWindow.print();
}

function printPage(sURL) {
    var oHiddFrame = document.createElement("iframe");
    oHiddFrame.onload = setPrint;
    oHiddFrame.style.visibility = "hidden";
    oHiddFrame.style.position = "fixed";
    oHiddFrame.style.right = "0";
    oHiddFrame.style.bottom = "0";
    oHiddFrame.src = sURL;
    document.body.appendChild(oHiddFrame);
}