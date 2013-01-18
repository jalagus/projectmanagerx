<h2> Add new project </h2>

<?php
    if ($viewmodel != "") {
        echo "<p>" . $viewmodel . "</p>";
    }
?>

<form action="/project/add" method="POST">

Name <br/>
<input type="text" name="projectName" /><br/>

Description<br/>
<textarea name="projectDescription" style="width: 600px; height: 200px;">

</textarea><br/>

<input type="submit" value="Add project" />
<input type="reset" value="Clear" />

</form>