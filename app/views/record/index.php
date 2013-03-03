<h2> Record </h2>

<p class="helptext"> Choose the project you want to record hours. You can record 
    hours only for one project at the same time. After you have recorded the hours, you have to confirm them to the project. </p>

<p class="helptext"><b> Notice! </b> You can't change the page while recording. </p>

<div id="recordTable">
    <select name="projectid">
        <?php
        foreach ($viewmodel->projectList as $row) {
            echo '<option value="' . $row->id . '">' . $row->name . "</option>";
        }
        ?>
    </select>

    <input type="text" placeholder="Short work description..." name="description" />
    <button id="startRecord"> Record </button>  
    <span id="time">0 seconds</span>
</div>

<h2>Unconfirmed hours</h2>

<table id="datatable">
    <thead>
        <td>Project</td>
        <td>Date</td>
        <td>Minutes</td>
        <td>Description</td>
        <td></td>
    </thead>
        <?php
        foreach ($viewmodel->recordList as $row) {
            echo '<tr>';
            echo '<td>' . $row->projectname . '</td>';
            echo '<td>' . $row->date . '</td>';
            echo '<td>' . $row->minutes . '</td>';
            echo '<td>' . $row->description . '</td>';
            echo '<td>  <button class="confirmButton" data-recordid="' . $row->id . '">Confirm</button> 
                        <button class="deleteButton" data-recordid="' . $row->id . '">Delete</button> </td>';
            echo '</tr>';
        }
        ?>
</table>

<script>
    var basedir = "<?php echo BASE_DIR; ?>";
</script>