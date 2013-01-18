<h2> Project list </h2>
<table id="datatable">
    <thead>
    <td>Project</td>
    <td>Minutes</td>
    <td>Delete</td>
    </thead>
<?php
    
    foreach($viewmodel as $project) {
        
        echo "<tr>";
        
        echo '<td>' . $project->projectname . '</td><td>' . $project->minutes . '</td>
            <td><form action="/project/delete" method="POST"> 
            <input type="hidden" name="projectid" value="' . $project->projectid . '" />
            <input type="submit" value="Delete" /></form></td>';
        
        echo "</tr>";
    }
?>
</table>