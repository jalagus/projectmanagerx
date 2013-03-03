<h2>Change password</h2>

<?php echo "<p>" . $viewbag . "</p>"; ?>

<form action="<?php echo BASE_DIR; ?>home/changepassword" method="post">
    Old password:<br/>
    <input type="password" name="oldpass" /><br/>

    New password:<br/>
    <input type="password" name="newpass" /><br/>

    New password again:<br/>
    <input type="password" name="newpassconfirm" /><br/>
    
    <input type="submit" value="Change"/>
    
</form>