<html>
<head>
    <title>BargePoller</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
    function addmsg(type, msg){
        /* Simple helper to add a div.
        type is the name of a CSS class (old/new/error).
        msg is the contents of the div */
        //$(".post_page").replaceWith(
          //  "<div class='msg "+ type +"'>"+ msg +"</div>"
        //);
        $(".post_page").replaceWith(msg);
    }

    function waitForMsg(){
        /* This requests the url "msgsrv.php"
        When it complete (or errors)*/
        $.ajax({
            type: "GET",
            url: "msgsrv.php",

            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,
            timeout:50000, /* Timeout in ms */

            success: function(data){ /* called when request to barge.php completes */
                addmsg("new", data); /* Add response to a .msg div (with the "new" class)*/
                setTimeout(
                    waitForMsg, /* Request next message */
                    10000 /* ..after 1 seconds */
                );
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                //addmsg("error", textStatus + " (" + errorThrown + ")");
                //setTimeout(
                  //  waitForMsg, // Try again after.. 
                   // 15000); // milliseconds (15seconds) 
            }
        });
    };

    //$(document).ready(function(){
      //  waitForMsg(); /* Start the inital request */
    //});
    </script>
</head>
<body onload ="waitForMsg()">
    <div id="messages">
        <?php
            include("php_parse_xml.php");
        ?>
    </div>
</body>
</html>