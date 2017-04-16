$(document).ready(function(){

    $("form").submit(function(event){
        var name = $("#name").val();
        var comment = $("#comment").val();
        var email = $("#email").val();
        var session = $("#session").val();
        event.preventDefault();                   /*  page reload avoiding */
        $.getJSON('../php/InsertSelect.php',      /*  ajax request sending */
            { name : name, comment : comment, email : email, session : session },
            processResult
        );
    });

});
/*  ajax response processing  */
function processResult(json)	{
    var str = '';
    var j = 0;
/* input fields value cleaning */
    $("#name").val("");
    $("#comment").val("");
    $("#email").val("");
/* cards html cleaning */
    $("#list").html("");

    $.each(json, function (i,e) {

        if ( typeof(e.message) == 'string' ) {
/* message rendering */
            $('#message').html(e.message);
        } else {
/* cards  html forming */
            if (j % 3 == 0) $("#list").append('<div class = "col-sm-1"></div>');
            j++;
            if (i % 2 == 0) str = 'c'; /* even card class */
            else str = 'nc';           /* odd  card class */
            $("#list").append(
                '<div class="col-sm-3 ticket' + str + '">' +
                '<p class="' + str + '1' + '">' + e.name + '</p>' +
                '<p class="' + str + '2' + '">' + e.email + '</p>' +
                '<p class="' + str + '3' + '">' + e.comment + '</p>' +
                '</div>');
        }
    });
}


