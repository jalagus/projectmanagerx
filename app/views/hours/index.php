<h2> Hours list </h2>

<table id="datatable">
    <thead>
    <td>Date</td>
    <td>Project</td>
    <td>Minutes</td>
    <td>Description</td>    
    <td>Delete</td>
</thead>

<?php
foreach ($viewmodel as $hours) {

    echo "<tr>";

    echo '<td>' . $hours->date . '</td><td>' . $hours->projectname . '</td>
                <td>' . $hours->minutes . '</td>
                <td>' . $hours->description . '</td>
                <td><button class="deleteButton" data-hoursid="' . $hours->id . '"> Delete </button></td>';

    echo "</tr>";
}
?>
</table>

<script>

    $(".deleteButton").click(function() {
        
        window.location = "/hours/delete/" + $(this).data('hoursid');
    });
    
</script>