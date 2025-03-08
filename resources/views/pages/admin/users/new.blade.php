<x-template.admin title="New User" slug="users">
    <table class="forTexts" width="100%" height="100%" cellspacing="0" cellpadding="10" border="0">
        <tbody>
            <tr>
                <td width="100%" valign="top" height="100%">
                    <h3>New User:</h3>
                    <form method="post">
                        <table class="form">
                            @csrf
                            <tbody>
                                <tr>
                                    <th>Name:</th>
                                    <td><input type="text" name="name" class="inpts" size="30"></td>
                                </tr>
                                <tr>
                                    <th>Username:</th>
                                    <td><input type="text" name="username" class="inpts" size="30"></td>
                                </tr>
                                <tr>
                                    <th>E-mail:</th>
                                    <td><input type="text" name="email" class="inpts" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Password:</th>
                                    <td><input type="text" name="password" value="" class="inpts"
                                            size="30"></td>
                                </tr>
                                <tr>
                                    <th>Secret Question:</th>
                                    <td><input type="text" name="secret_question" class="inpts"></td>
                                </tr>
                                <tr>
                                    <th>Secret Answer:</th>
                                    <td><input type="text" name="secret_answer" class="inpts">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Auto-withdrawal Enabled:</th>
                                    <td> <select name="auto_withdrawal" class="inpts">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select> </td>
                                </tr>
                            </tbody>
                        </table> <br>
                        <center> <input type="submit" value="Create User" class="btn btn-success sbmt"> </center>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>

</x-template.admin>
