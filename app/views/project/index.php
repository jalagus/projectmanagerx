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
        
        echo '<td>' . $project->name . '</td>
            <td style="width: 200px">' . floor($project->minutes / 60)  . ' hours ' . floor($project->minutes % 60) . ' minutes </td>
            <td style="width: 170px">
            <button class="viewButton" data-projectid="' . $project->id . '"> View </button>
            <button class="editButton" data-projectid="' . $project->id . '"> Edit </button>
            <button class="deleteButton" data-projectid="' . $project->id . '"> Delete </button>
                </td>';
            
        echo "</tr>";
    }
?>
    </tbody>
</table>

<script>

    $(".viewButton").click(function() {
        window.location = "<?php echo BASE_DIR; ?>project/view/" + $(this).data('projectid');
    });
    
    $(".editButton").click(function() {
        window.location = "<?php echo BASE_DIR; ?>project/edit/" + $(this).data('projectid');
    });
    
    $(".deleteButton").click(function() {
        
        window.location = "<?php echo BASE_DIR; ?>project/delete/" + $(this).data('projectid');
    });
    
</script>