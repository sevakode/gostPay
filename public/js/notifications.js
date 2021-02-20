function messageNotify(data) {
    $.each( data, function( key, value ) {
        data = value['data'];
        $.notify(data['options'], data['settings']);
    });
}

function sendNotification() {
    $.ajax({
        type:'post',
        url:'/send-notification',
        dataType: "json",
        data:{
            '_token':$('meta[name="csrf-token"]').attr('content'),
        },
        success: function (data) {
            messageNotify(data);
        },
        error: function (data) {
            messageNotify(data);
        }
    });
}

function realTime() {
    sendNotification();
    setTimeout(realTime, 6000);
}

$(document).ready(realTime());
