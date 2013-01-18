<h2> Confirm deletion </h2>

<p> Are you sure you want to delete <?php echo $viewmodel->minutes; ?> minutes 
    dated "<?php echo $viewmodel->date; ?>" 
    from project "<?php echo $viewmodel->projectname; ?>"? </p>

<form action="/hours/delete/" method="POST"> 
<input type="hidden" name="hoursid" value="<?php echo $viewmodel->id; ?>" />
<input type="submit" value="Delete" /></form>