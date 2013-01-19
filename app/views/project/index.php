<h2> Project list </h2>
<table id="datatable">
    <thead>
    <td>Project</td>
    <td>Time</td>
    <td>Action</td>
    </thead>
    <tbody>
<?php
    
    foreach($viewmodel as $project) {
        
        echo "<tr>";
        
        echo '<td> <a href="'. BASE_DIR . 'project/view/' . $project->projectid . '">' . $project->projectname . '</a></td>
            <td>' . floor($project->minutes / 60)  . ' hours ' . floor($project->minutes % 60) . ' minutes </td>
            <td>
            <button class="deleteButton" data-projectid="' . $project->projectid . '"> Delete </button>
            <button class="editButton" data-projectid="' . $project->projectid . '"> Edit </button>
                </td>';
            
        echo "</tr>";
    }
?>
    </tbody>
</table>

<script>
    $(".editButton").click(function() {
        window.location = "<?php echo BASE_DIR; ?>project/edit/" + $(this).data('projectid');
    });
    
    $(".deleteButton").click(function() {
        
        window.location = "<?php echo BASE_DIR; ?>project/delete/" + $(this).data('projectid');
    });
    
</script>