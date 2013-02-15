<h2> Add new user </h2>

<?php
    if (isset($viewmodel)) {
        echo '<p>' . $viewmodel . '</p>';
    } 
?>
<form action="<?php echo BASE_DIR; ?>admin/adduser" method="post">
    Username:<br/>
    <input type="text" name="username" <?php 
        if (isset($_POST['username'])) {
            echo 'value="' . $_POST['username'] . '"'; 
        }
        ?> /><br/>
    
    Password:<br/>
    <input type="password" name="password" /><br/>
    
    Password again:<br/>
    <input type="password" name="confirmpassword" /><br/>
    
    <br/>
    <input type="submit" value="Create" />
    
</form>
