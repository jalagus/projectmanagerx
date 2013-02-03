<h2> Hours list </h2>

<table id="datatable">
    <thead>
    <td>Date</td>
    <td>Project</td>
    <td>Description</td>
    <td>Time</td>    
    <td>Delete</td>
</thead>
<tbody>
    <?php
    foreach ($viewmodel as $hours) {

        echo "<tr>";

        echo '<td style="width: 100px">' . $hours->date . '</td>
                <td>' . $hours->projectname . '</td>
                <td>' . $hours->description . '</td>
                <td style="width: 170px">' . floor($hours->minutes / 60)  . ' hours ' . floor($hours->minutes % 60) . ' minutes</td>
                <td style="width: 120px">
                <button class="editButton" data-hoursid="' . $hours->id . '"> Edit </button>
                <button class="deleteButton" data-hoursid="' . $hours->id . '"> Delete </button></td>';

        echo "</tr>";
    }
    ?>
</tbody>
</table>

<script>

    $(".editButton").click(function() {
        window.location = "<?php echo BASE_DIR; ?>hours/edit/" + $(this).data('hoursid');
    });
    $(".deleteButton").click(function() {
        window.location = "<?php echo BASE_DIR; ?>hours/delete/" + $(this).data('hoursid');
    });    
</script>