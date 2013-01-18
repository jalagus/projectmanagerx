<h2> Add hours to project </h2>

<form action="/hours/add" method="POST">

    <table id="hoursForm">
        <thead>
        <td>Project</td>
        <td>Hours</td>
        <td>Minutes</td>
        <td>Date</td>
        </thead>
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
    </table>
    <a id="addRow" href="#" > Add row </a>
    <input type="submit" value="Add hours" />
</form>

<script>
    $('#addRow').click(function (event) {
        event.preventDefault();
        $('#hoursForm').append('<tr><td><select name="projectid[]">' +
                <?php
                foreach ($viewmodel as $row) {
                    echo '\'<option value="' . $row->id . '">' . $row->name . '</option>\' + ' . "\n";
                }
                ?>
            "</select></td>" +
            '<td><input type="text" name="hours[]" /></td>' +
            '<td><input type="text" name="minutes[]" /></td>' +
            '<td><input class="dateInput" type="text" name="date[]" /></td>' +
            '</tr>');
        
        $(".dateInput").datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>