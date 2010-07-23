function saveNews()
{
    $("#actionstatmsg").html('Сохраняю...');
    $("#loading").show();
    $('#actionstat').show();
    $.post('newsactions.php', $('#newsedit').serialize(),function(data){
        if(data == "ok")
        {
            $("#loading").fadeOut('fast');
            $("#actionstatmsg").html('Сохранено успешно');
            $("#actionstat").oneTime("5s", function() {
                $("#actionstat").fadeOut('fast');
                
            });
            if($("#do").val()=="make")
            {
                history.go(-1);
            }
        }
        else
        {
            $("#loading").fadeOut('fast');
            $("#actionstatmsg").html(data);
        }
    });
    return false;
}

function rmNews(id)
{
    if(confirm('Удалить эту новость?'))
    {
        $("#actionstatmsg").html("Удаление...");
        $.post('newsactions.php', {"do": "rm", "n_id": id}, function(data){
            if(data == "ok")
            {
                history.go(-1);
            }
            else
            {
                $("#loading").fadeOut('fast');
                $("#actionstatmsg").html(data);
            }
        });
    }
    return false;
}
