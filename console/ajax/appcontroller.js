
function removecheckin(contentID)
{

    var data = $("#checkindeleteform"+contentID).serialize();
    $.ajax({

        type  : "post",
        url   : "/ajax/loadaction.php",
        data  : data,
        cache : false

    })

    .done(function(response){

       if(response == "true")
       {

        window.location.reload();

       }

    })  

}

function removestory(contentID)
{

    var data = $("#storydeleteform"+contentID).serialize();
    $.ajax({

        type  : "post",
        url   : "/ajax/loadaction.php",
        data  : data,
        cache : false

    })

    .done(function(response){

       if(response == "true")
       {

        window.location.reload();

       }

    })  


}

function removeslide(contentID)
{

    var data = $("#slidedeleteform"+contentID).serialize();
    $.ajax({

        type  : "post",
        url   : "/ajax/loadaction.php",
        data  : data,
        cache : false

    })

    .done(function(response){

       if(response == "true")
       {

        window.location.reload();

       }

    })  

}

function removegalery(contentID)
{

    var data = $("#galerydeleteform"+contentID).serialize();
    $.ajax({

        type  : "post",
        url   : "/ajax/loadaction.php",
        data  : data,
        cache : false

    })

    .done(function(response){

       if(response == "true")
       {

        window.location.reload();

       }

    }) 

}

function removeguest(contentID)
{

    var data = $("#guestdeleteform"+contentID).serialize();
    $.ajax({

        type  : "post",
        url   : "/ajax/loadaction.php",
        data  : data,
        cache : false

    })

    .done(function(response){

       if(response == "true")
       {

        window.location.reload();

       }

    }) 

}

function removeguestcat(contentID)
{

    var data = $("#guestcatdeleteform"+contentID).serialize();
    $.ajax({

        type  : "post",
        url   : "/ajax/loadaction.php",
        data  : data,
        cache : false

    })

    .done(function(response){

       if(response == "true")
       {

        window.location.reload();

       }

    }) 

}

function removeactivity(contentID)
{

    var data = $("#activitydeleteform"+contentID).serialize();
    $.ajax({

        type  : "post",
        url   : "/ajax/loadaction.php",
        data  : data,
        cache : false

    })

    .done(function(response){

       if(response == "true")
       {

        window.location.reload();

       }

    })

}

