<h2> Add hours to project </h2>

<form action="/hours/add" method="POST">

Project <br/>
<select name="projectName">
    <?php
    
    foreach($viewmodel as $row) {
        echo '<option value="' . $row->id . '">' . $row->name . "</option>";
    }
    
    ?>
</select><br/>

Hours<br/>
<input type="text" name="hours" /><br/>
Minutes<br/>
<input type="text" name="minutes" /><br/>
Date<br/>
<input type="text" name="date" /><br/>

<input type="submit" value="Add hours" />
</form>