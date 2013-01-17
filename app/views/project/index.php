<h2> Projekteja pukkaa </h2>
<ul>
<?php
    foreach($viewmodel as $project) {
        echo "<li>" . $project->name . 
                '<form action="/project/delete" method="POST"> 
                    <input type="hidden" name="projectid" value="' . $project->id . '" />
                        <input type="submit" value="Delete" /></form>
                    </li>';
    }
?>
</ul>