$(document).ready(function () {
    $(function () {
        $('#sDate, #birthday, #eDate, #officalDate, .dtpkTime').datetimepicker({
            format: 'YYYY/MM/DD',
        });
        $('#sTime,#eTime').datetimepicker({
            allowInputToggle: true,
            format: 'HH:mm',
            stepping: 15
        });
        $(".selectpicker").selectpicker();
    });

});




