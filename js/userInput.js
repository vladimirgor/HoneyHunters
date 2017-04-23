$(document).ready(function(){

    $("form").submit(function(event){
        var name = $("#name").val();
        if (/^[A-ZА-ЯЁ][А-Яа-яЁёA-Za-z\s]+$/.test(name) != true )
            {alert('Введите, пожалуйста, имя правильно.');
                event.preventDefault();}
        else {
            var comment = $("#comment").val();
            if (/^[A-ZА-ЯЁ][А-Яа-яЁёA-Za-z!\-,.\s"]+$/.test(comment) != true )
                {alert('Введите, пожалуйста, комментарий правильно.');
                    event.preventDefault();}
            else {
                var email = $("#email").val();
                if (/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/.test(email) != true )
                {alert('Введите, пожалуйста, e-mail правильно.');
                    event.preventDefault();}
                else {
                    var session = $("#session").val();
                    event.preventDefault();
                    /*  page reload avoiding */
                    $.getJSON('../php/InsertSelect.php', /*  ajax request sending */
                        {name: name, comment: comment, email: email, session: session},
                        processResult
                    );
                }
            }
        }
    });

});
/*  ajax response processing  */
function processResult(json)	{
    var offset = "";
 /* input fields value cleaning
    $("#name").val("");
    $("#comment").val("");
    $("#email").val(""); */
/* cards html cleaning */
    $("#list").html("");
/* message html cleaning */
    $("#message").html("");

    $.each(json, function (i,e) {

        if ( typeof(e.message) == 'string' ) {
/* message rendering */
            $('#message').html(e.message);
        } else {
            /* cards  html forming */
            if ( i % 3 == 0 ) offset = " col-sm-offset-1 ";
            else offset = "";
            $("#list").append(
                '<div class="col-sm-3 ticket' + offset + '">' +
                '<p class="str1">' + e.name + '</p>' +
                '<p class="str2">' + e.email + '</p>' +
                '<p class="str3">' + e.comment + '</p>' +
                '</div>');
        }
    });
}


