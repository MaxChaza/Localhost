
<form onsubmit="return checkParamLogin()" method="post">
    <table border="0">
        <tr>
            <td>
                <h1>Login form</h1>
            </td>
        </tr>
        <tr>
            <td id="colorUsername" >Username:</td>
            <td>
                <!--onsubmit="checkParamLogin()"-->
                <input type="text" name="username" id="username"  maxlength="20">
                <script  type="text/javascript" >
                    var keyUsername = document.getElementById('username');
                    keyUsername.focus();
                    keyUsername.select();
                </script>
            </td>
        </tr>
        <tr>
            <td id="colorPassword" >Password:</td>
            <td><input type="password" name="pass" id="pass" maxlength="20"></td>
            <td><input type="hidden" name="nextPage" id="nextPage" value="member"/></td>
        </tr>
        
        <tr>
            <td align="right"><input type="submit" name="submit" value="Login"></td>
        </tr>
        <tr>
            <td>
                Cliquer <a href="#" onclick="showContent('register')">ici</a> pour vous enregistrer
            </td>
        </tr>
    </table>
</form>

