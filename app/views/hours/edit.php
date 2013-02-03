<h2> Edit hours </h2>

<?php if ($viewbag != "") echo "<p>" . $viewbag . "</p>"; ?>

<form action="<?php echo BASE_DIR; ?>hours/edit" method="POST">
    
<table id="hoursForm">
    <thead>
    <td>Project</td>
    <td>Hours</td>
    <td>Minutes</td>
    <td>Date</td>
    <td>Short description</td>
    <td></td>
</thead>
<tr>
    <td>
        <select name="projectid" >
            <?php
            foreach ($viewmodel->projectList as $row) {
                if ($row->id == $viewmodel->projectid) {
                    echo '<option value="' . $row->id . '" selected>' . $row->name . "</option>";        
                }
                else {
                    echo '<option value="' . $row->id . '">' . $row->name . "</option>";
                }
            }
            ?>
        </select>
    </td>

    <td><input type="text" name="hours" value="<?php echo floor($viewmodel->minutes / 60); ?>" /></td>
    <td><input type="text" name="minutes" value="<?php echo ($viewmodel->minutes % 60); ?>" /></td>
    <td><input class="dateInput" type="text" name="date" value="<?php echo $viewmodel->date; ?>" /></td>
    <td><input type="text" name="description" value="<?php echo $viewmodel->description; ?>" /></td>
    <input type="hidden" name="hoursid" value="<?php echo $viewmodel->id; ?>" />
</tr>     
</table>

    <input type="submit" value="Save values" />
</form>