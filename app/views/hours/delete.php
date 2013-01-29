<h2> Confirm deletion </h2>

<p> Are you sure you want to delete <?php echo $viewmodel->minutes; ?> minutes with
    description "<?php echo $viewmodel->description; ?>" 
    dated "<?php echo $viewmodel->date; ?>" 
    from project "<?php echo $viewmodel->projectname; ?>"? </p>


<form action="<?php echo BASE_DIR; ?>hours/delete/" method="POST"> 
<input type="hidden" name="hoursid" value="<?php echo $viewmodel->id; ?>" />
<button id="cancel">Cancel</button>
<input type="submit" value="Delete" /></form>

<script>
    $('#cancel').click(function() {
       window.location = "<?php echo BASE_DIR; ?>hours/index";
    });
</script>