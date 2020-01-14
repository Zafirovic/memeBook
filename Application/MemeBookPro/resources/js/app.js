require('./bootstrap');
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');


$("#meme-store").submit(function (e) {
    e.preventDefault();
    var url=$(this).attr('action');
    var formdata=new FormData(this);

    $.ajax(
        {
            url:url,
            type:"POST",
            data:formdata,
            success:function (msg) {
                notification.emit('send_notification',{room:'MemeBookPro',meme_id:msg})
                window.location.href='/welcome';
            },
            cache:false,
            contentType:false,
            processData:false
        }
    );
})


