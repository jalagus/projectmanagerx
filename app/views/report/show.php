<h2> Report </h2>

<form action="/report/show" method="POST">
    <table>
        <thead>
        <td>Start date</td>
        <td>End date</td>
        <td></td>
        </thead>
        
        <tr>
            <td><input class="dateInput" type="text" value="<?php echo $viewmodel->startdate; ?>" name="startDate" /></td>
            <td><input class="dateInput" type="text" value="<?php echo $viewmodel->enddate; ?>" name="endDate" /></td>
            <td><input type="submit" value="Get report" /></td>
        </tr>

    </table>
</form>

<table id="datatable">
    <thead>
    <td>Date</td>
    <td>Project</td>
    <td>Minutes</td>
</thead>
<?php
foreach ($viewmodel->resultlist as $hours) {
    echo "<tr>";
    echo "<td>" . $hours->date . "</td><td>" . $hours->projectname . "</td><td>" . $hours->minutes . "</td>";
    echo "</tr>";
}
?>

</table>