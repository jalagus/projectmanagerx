<h2> Add new project </h2>

<?php
    if (!empty($viewbag)) {
        echo "<p>" . $viewbag . "</p>";
    }
?>

<form action="<?php echo BASE_DIR; ?>project/add" method="POST">

Name <br/>
<input type="text" name="projectName" /><br/>

Description<br/>
<textarea name="projectDescription" style="width: 600px; height: 200px;">

</textarea><br/>

<input type="submit" value="Add project" />
<input type="reset" value="Clear" />

</form>