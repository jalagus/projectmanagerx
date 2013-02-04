<h2> Edit project </h2>

<?php if ($viewbag != "") echo "<p>" . $viewbag . "</p>"; ?>


<form action="<?php echo BASE_DIR; ?>project/edit" method="POST">

<input type="hidden" name="projectId" value="<?php echo $viewmodel->id; ?>" />
    
Name <br/>
<input type="text" name="projectName" value="<?php echo $viewmodel->name; ?>" /><br/>

Description<br/>
<textarea name="projectDescription" style="width: 600px; height: 200px;">
<?php echo $viewmodel->description; ?> 
</textarea><br/>

<input type="submit" value="Save" />
</form>