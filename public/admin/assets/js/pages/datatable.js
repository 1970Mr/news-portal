var tableMain = $('#data-table').DataTable({
    "columnDefs": [{
        "targets": [0,5],
        "orderable": false
    }],
    "pageLength": 25,
    "drawCallback": function() {
        var topestStatus = $("#btn-check-all-toggle").prop("checked");
        $("table td input[type='checkbox']").each(function(){
            currentStatus = $(this).prop("checked");
            if(topestStatus != currentStatus){
                console.log("Reversed");
                $("#btn-check-all-toggle").prop("checked", currentStatus);
            }
        });

        Modiran.initiCkeck();
    },
});

$(window).on( 'resize', function () {
    $('#data-table').css("width", "100%");
} );

// Checkboxes
$(document).on('ifChanged', 'input#btn-check-all-toggle', function (event) {
    var isChecked = $("#btn-check-all-toggle").prop("checked");
    if(isChecked){
        $("table td input[type='checkbox']").iCheck("check").iCheck("update");
    }else{
        $("table td input[type='checkbox']").iCheck("uncheck").iCheck("update");
    }
});