<!DOCTYPE html>
<html>
<body>

	<h1>Change username</h1>
	<form action='change.php' method= "post">
    <input type="text" name="user">
    <label for='username_change'>Enter new username</label>
    <input type='submit' value='Change' name='upload'>
    </form>
    
    <h1>Change password</h1>
    <form action='changepw.php' method='post'>
    <input type='password' name='old_password'>
    <label for='old_password'>Enter old password</label>
    <input type='password' name='new_password'>
    <label for='new_password'>Enter new password</label>
    <input type='submit' value='Change' name='uploadpw'>
    </form>
    
    <h1>By pressing delete you are deleting your account and all images you have uploaded.</h1>
    <form action='delete.php' method='post'>
    <input type='submit' value='DELETE ACCOUNT' name='delete'>
    </form>
    


</body>
</html>

