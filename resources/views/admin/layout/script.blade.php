<script src="https://js.pusher.com/3.1/pusher.min.js"></script>
<script type="text/javascript">
    var notificationsWrapper=$('#notifications');
    var notifications =$('.notifications-dropdown');
    var notificationsCount=parseInt($('.badge-warning').attr('count'));
    if(notificationsCount <=0){
        $('.badge-warning').hide();
    }
    Pusher.logToConsole = true;
    var pusher =new Pusher('{{env('PUSHER_APP_KEY')}}',{
       cluster: 'ap1',
        encrypted: true
    });
    var channel = pusher.subscribe('send-notifications');
    channel.bind('App\\Events\\Notify',function (data){
        var existingNotifications = notifications.html();
        if(data.type ==1){
            var newHtml = ' <div class="dropdown-divider"></div>\n' +
                '                <a href="#" class="dropdown-item">\n' +
                '                    <i class="fas fa-envelope mr-2"></i>\n' +
                '                       <strong> '
                                            +data.stock  +
                '                       </strong>'+
                '                    <span> thêm</span>\n'+
                '                       <strong>'
                                            +data.product +
                '                       </strong>'+
                '                </a>';
        }
        if(data.type ==2){
            var newHtml = ' <div class="dropdown-divider"></div>\n' +
                '                <a href="#" class="dropdown-item">\n' +
                '                    <i class="fas fa-envelope mr-2"></i>\n' +
                '                       <strong> '
                                            +data.stock  +
                '                       </strong>'+
                '                    <span> sửa</span>\n'+
                '                       <strong>'
                                            +data.product +
                '                       </strong>'+
                '                </a>';
        }
        if(data.type== 3){
            var newHtml = ' <div class="dropdown-divider"></div>\n' +
                '                <a href="#" class="dropdown-item">\n' +
                '                    <i class="fas fa-envelope mr-2"></i>\n' +
                '                       <strong> '
                                            +data.stock  +
                '                       </strong>'+
                '                    <span> xóa</span>\n'+
                '                       <strong>'
                                            +data.product +
                '                       </strong>'+
                '                </a>';
        }
        notificationsCount+=1;
        $('.badge-warning').text(notificationsCount);
        $('.badge-warning').show();
        notifications.html(newHtml + existingNotifications);
    });
</script>
