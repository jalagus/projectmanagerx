<h2> Hours list </h2>

<table id="datatable">
    <thead>
    <td>Date</td>
    <td>Project</td>
    <td>Minutes</td>
    <td>Delete</td>
</thead>

<?php
foreach ($viewmodel as $hours) {

    echo "<tr>";

    echo '<td>' . $hours->date . '</td><td>' . $hours->projectname . '</td>
                <td>' . $hours->minutes . '</td>
                <td><form action="/hours/delete" method="POST"> 
                <input type="hidden" name="hoursid" value="' . $hours->id . '" />
                <input type="submit" value="Delete" /></form></td>';

    echo "</tr>";
}
?>
</table>