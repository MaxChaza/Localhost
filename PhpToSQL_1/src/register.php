    <script language="javascript" type="text/javascript" src="./js/checkParam.js">
    </script>

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
                <td>
                    <input type="password" name="password" id="password" maxlength="10"/>
                    <td><div id="erreurPassword"></div></td>
                   
                </td>
            </tr>
            <tr>
                <td id="colorPassword2">Confirm Password:</td>
                <td>
                    <input type="password" name="password2" id="password2" maxlength="10"/>
                </td>
            </tr>
            <input type="hidden" name="nextPage" id="nextPage" value="reponseRegister"/> 
            <tr>
                <th colspan=2>
                    <input type="submit" name="submitRegister" value="Register" >
                </th>
            </tr> 
        </table>
        <div id="titr"></div>
    </form>
    