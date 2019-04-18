// подписка на мероприятие
$('.sign').click(function(event){
    var target = event.target;
    var event_id = $(target).data('event_id');
    var data = {event_id : event_id};
    $.ajax({
        type: "POST",
        url: '/site/sign',
        data: data,
        success: function(ans){

            window.alert('Вы зарегистрировались на мероприятие');

        },
        error: function(ans){
            var status = ans.responseJSON.status;
            window.alert('Произошла ошибка: ' + status);
        }

    });
});
