
<form enctype="multipart/form-data" name="myForm" action="./include/upload.php" method="post" >
    <table>  
        <tr>
            <td>
                <input type="file" name="file1" />
            </td>
        </tr>
        <tr> 
            <td>
                <input type="file" name="file2" />
            </td>
        </tr>
        <tr>
            <td>
                <input type='submit' value='go!'/>
            </td>
        </tr>
    </table>
</form>

<form enctype="multipart/form-data" name="myFormAjax" onsubmit="return upload()" method="post" >
    <table>  
        <tr>
            <td>
                <input type="file" name="file1"/>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="goAjax"/>
            </td>
        </tr>
        <tr>
            <td>
                <div id="answerArea"></div>
            </td>
        </tr>
        <tr>
            <td>
                <div id="image"></div>
            </td>
        </tr>
    </table>
</form>
