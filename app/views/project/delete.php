<h2> Confirm deletion </h2>

<p> Are you sure you want to delete project "<?php echo $viewmodel->name; ?>"? </p>

<form action="/project/delete/" method="POST"> 
<input type="hidden" name="projectid" value="<?php echo $viewmodel->id; ?>" />
<input type="submit" value="Delete" /></form>