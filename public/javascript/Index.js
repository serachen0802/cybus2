//判斷時間
$(function() {
    $("#btnok").click(function() {
            var now = new Date();
            var orderdate = new Date($("#orderdate").val());

            if (orderdate  < now) {
                alert("請輸入正確日期");
            }
            else if ($("#ordertime1").val() != "" && $("#ordertime2").val() != "") {
                var ordertime1 = new Date(now.toDateString() + " " + $("#ordertime1").val());
                var ordertime2 = new Date(now.toDateString() + " " + $("#ordertime2").val());
                if (ordertime1 > ordertime2) {
                    alert("請輸入正確時間範圍");
                }
                else {
                    $("form").submit();
                }
            }
            else {
                $("form").submit();
            }
        })
        //抓取資料庫起站所有不重複城市
    $.ajax({
        url: '../Home/city1',
        type: 'POST',
        dataType: 'json',
        error: function(xhr) {
            alert(xhr.status);
        },
        success: function(response) {
            var str_option='';
            for(var i=0; i<response.length;i++){
                str_option+="<option>"+response[i]['start']+"</option>"
            }
            $('#city1').html(str_option);
        }
    })

    //抓取相對應的城市
    $("#city1").change(function() {
        var Val = $(this).val();
        $.ajax({
            url: '../Home/city2',
            type: 'post',
            dataType: 'json',
            data: {
                city1: Val
            },
            error: function(xhr) {
                alert(xhr.status);
            },
            success: function(response) {
                var str_option='';
                for(var i=0; i<response.length;i++){
                    str_option+="<option>"+response[i]['end']+"</option>"
                }
                $('#city2').html(str_option);
            }
        })
    }).trigger('change');
});

$(function() {

    $.datetimepicker.setLocale('zh-TW');

    $(".datenowpicker").datetimepicker({
        timepicker: false,
        format: 'Y/m/d',
        minDate: 0
    });

    $(".timepicker").datetimepicker({
        datepicker: false,
        format: 'H:i',
    });
});