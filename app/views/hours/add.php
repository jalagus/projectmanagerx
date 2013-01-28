<h2> Add hours to project </h2>

<p class="helptext"> More rows can be added with the plus sign at the end of the last row. </p>

<?php
    if (!empty($viewbag)) {
        echo "<p> Saved " . $viewbag->savedLines . " entries</p>";
        
        if (!empty($viewbag->errorMsg)) {
            echo "<p><b>Notice:</b><br/>" . nl2br($viewbag->errorMsg) . "</p>";
        }
    }
?>

<form action="<?php echo BASE_DIR; ?>hours/add" method="POST">

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
            <select name="projectid[]">
                <?php
                foreach ($viewmodel as $row) {
                    echo '<option value="' . $row->id . '">' . $row->name . "</option>";
                }
                ?>
            </select>
        </td>

        <td><input type="text" name="hours[]" /></td>
        <td><input type="text" name="minutes[]" /></td>
        <td><input class="dateInput" type="text" name="date[]" /></td>
        <td><input type="text" name="description[]" /></td>
        </tr>
        
        <tr>
        <td>
            <select name="projectid[]" disabled >
                <?php
                foreach ($viewmodel as $row) {
                    echo '<option value="' . $row->id . '">' . $row->name . "</option>";
                }
                ?>
            </select>
        </td>

        <td><input type="text" name="hours[]" disabled /></td>
        <td><input type="text" name="minutes[]" disabled /></td>
        <td><input class="dateInput" type="text" name="date[]" disabled /></td>
        <td><input class="disabledRow" type="text" name="description[]" disabled /></td>
        <td><button class="ui-icon ui-icon-plus" id="addRow"> New </button></td>
        </tr>        
    </table>
    <input type="submit" value="Save rows" />
</form>

<script>
    $('#addRow').click(function (event) {
        event.preventDefault();
        $("#hoursForm tr").last().before('<tr><td><select name="projectid[]">' +
                <?php
                foreach ($viewmodel as $row) {
                    echo '\'<option value="' . $row->id . '">' . $row->name . '</option>\' + ' . "\n";
                }
                ?>
            "</select></td>" +
            '<td><input type="text" name="hours[]" /></td>' +
            '<td><input type="text" name="minutes[]" /></td>' +
            '<td><input class="dateInput" type="text" name="date[]" /></td>' +
            '<td><input type="text" name="description[]" /></td></tr>');
        
        $(".dateInput").datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>