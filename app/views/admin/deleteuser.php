<h2> Confirm delete </h2>

<p> Are you sure you want to delete user "<?php echo $viewmodel->username; ?>"?</p>

<form action="<?php echo BASE_DIR; ?>admin/deleteuser/" method="post">
    <input type="hidden" name="userid" value="<?php echo $viewmodel->id; ?>" />
    <input type="submit" value="Delete" />
</form>