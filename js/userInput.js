$(document).ready(function(){

    $("form").submit(function(event){
        var name = $("#name").val();
        var comment = $("#comment").val();
        var email = $("#email").val();
        var session = $("#session").val();
        event.preventDefault();
        $.getJSON('php/InsertSelect.php',
            { name : name, comment : comment, email : email, session : session },
            processResult
        );
    });

});

function processResult(json)	{
    var str = '';
    var j = 0;
    $("#name").val("");
    $("#comment").val("");
    $("#email").val("");
    $("#list").html("");

    $.each(json, function (i,e) {

        if ( typeof(e.message) == 'string' ) {
            $('#message').html(e.message);
        } else {
            if (j % 3 == 0) $("#list").append('<div class = "col-sm-1"></div>');
            j++;
            if (i % 2 == 0) str = 'c'; else str = 'nc';
            $("#list").append(
                '<div class="col-sm-3 ticket' + str + '">' +
                '<p class="' + str + '1' + '">' + e.name + '</p>' +
                '<p class="' + str + '2' + '">' + e.email + '</p>' +
                '<p class="' + str + '3' + '">' + e.comment + '</p>' +
                '</div>');
        }
    });
}


