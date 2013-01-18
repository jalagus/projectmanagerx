<h2> Project list </h2>
<table id="datatable">
    <thead>
    <td>Project</td>
    <td>Minutes</td>
    <td>Delete</td>
    <td>Edit</td>
    </thead>
<?php
    
    foreach($viewmodel as $project) {
        
        echo "<tr>";
        
        echo '<td> <a href="/project/view/' . $project->projectid . '">' . $project->projectname . '</a></td><td>' . $project->minutes . '</td>
            <td><form action="/project/delete" method="POST"> 
            <input type="hidden" name="projectid" value="' . $project->projectid . '" />
            <input type="submit" value="Delete" /></form></td>
            
            <td><a href="/project/edit/' . $project->projectid . '"> Edit </a></td>';
            
        echo "</tr>";
    }
?>
</table>