$(document).ready(function(){
    $('#action_menu_btn').click(function(){
        $('.action_menu').toggle();
    });
    $(document).on('click', '.fa-location-arrow', function() {
        let message = $('#send-message').val();
        if (message != '') {
            $('#send-message').val('');
            $.ajax({
                type: 'POST',
                url: '/send_message.php',
                data: {
                    message: message
                },
                success:function(data) {	
                    if (data == 'false') {
                        console.log(data);
                    }
                }, 
                error:function(data) {
                    console.log(data);
                } 
            });
        }
    });
});
function init() {
    setTimeout('init();', 1000);
    $.ajax({
        type: 'POST',
        url: '/messenger.php',
        success:function(data) {	
            $('#tchat').remove();
            $('#msg-card-body').append(data);
        }
    });
}
init();