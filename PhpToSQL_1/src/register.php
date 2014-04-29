<form  onsubmit="return checkParamRegister()" name="log" method="post">
    <table border="0">
        <tr>
            <td id="colorUsername">Username:</td>
            <td>
                <input type="text" name="username" id="username" maxlength="60"/>
                <script  type="text/javascript" >
                    var keyUsername = document.getElementById('username');
                    keyUsername.focus();
                    keyUsername.select();
                </script>
            </td>
        </tr>
        <tr>
            <td id="colorPassword">Password:</td>
            <td><input type="password" name="password" id="password" maxlength="10"/></td>
            <td><div id="erreurPassword"></div></td>
        </tr>
        <tr>
            <td id="colorPassword2">Confirm Password:</td>
            <td><input type="password" name="password2" id="password2" maxlength="10"/></td>
            <td><input type="hidden" name="nextPage" id="nextPage" value="reponseRegister"/></td>
        </tr>

        <tr>
            <th colspan=2>
                <button type="button" name="" value="" class="myButton">submit</button>
                <input type="submit" name="submitRegister" value="Register" />
            </th>
        </tr> 
    </table>
    <div id="titr"></div>
</form>
    