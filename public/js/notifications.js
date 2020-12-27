$(window).load(realTime());
function realTime() {
    $.ajax({
        type:'post',
        url:'/send-notification',
        dataType: "json",
        data:{
            '_token':$('meta[name="csrf-token"]').attr('content'),
        },
        success: function (data) {
            messageNotify(data);
            setTimeout(realTime, 6000);
        },
        error: function (data) {
            messageNotify(data);
            setTimeout(realTime, 6000);
        }
    });
}

function messageNotify(data) {
    $.each( data, function( key, value ) {
        data = value['data'];
        $.notify(data['options'], data['settings']);
    });
}
