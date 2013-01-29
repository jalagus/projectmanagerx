<h2> Confirm deletion </h2>

<p> Are you sure you want to delete project "<?php echo $viewmodel->name; ?>"? </p>

<form action="<?php echo BASE_DIR; ?>project/delete/" method="POST"> 
<input type="hidden" name="projectid" value="<?php echo $viewmodel->id; ?>" />
<button id="cancel">Cancel</button>
<input type="submit" value="Delete" /></form>

<script>
    $('#cancel').click(function() {
       window.location = "<?php echo BASE_DIR; ?>project/index";
    });
</script>