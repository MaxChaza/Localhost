<html>
    <head>
        <script language="javascript" type="text/javascript" src="./js/ajaxDate.js">
        </script>
    </head>
    <body>
        <center>Basic AJAX programming
        </center>
        <br/><br/>
        When entering data, we asynchronously get the date server side
        <br/><br/>
        <form name="myForm">
            Name: <input type="text" name="username" onkeyup="ajaxFunction();"/>
            Time: <input type="text" name="time" />
            <input type="reset" value="reset">
        </form>
        <div id="place"></div>
    </body>                         
</html>
