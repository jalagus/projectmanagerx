<h2> Report </h2>

<table>
    <thead>
    <td>Date</td>
    <td>Project</td>
    <td>Minutes</td>
    </thead>
    <?php
    
    foreach($viewmodel as $hours) {  
        echo "<tr>";
        echo "<td>" . $hours->date . "</td><td>" . $hours->projectname . "</td><td>" . $hours->minutes . "</td>";
        echo "</tr>";
    }
    ?>
    
</table>