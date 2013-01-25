<h2> Add new project </h2>

<?php
    if (!empty($viewbag)) {
        echo "<p>" . $viewbag . "</p>";
    }
?>

<form action="<?php echo BASE_DIR; ?>project/add" method="POST">

Name <br/>
<input type="text" name="projectName" value="<?php echo $viewmodel->name; ?>" /><br/>

Description<br/>
<textarea name="projectDescription" style="width: 600px; height: 200px;">
    <?php echo $viewmodel->description; ?>
</textarea><br/>

<input type="submit" value="Add project" />
<input type="reset" value="Clear" />

</form>