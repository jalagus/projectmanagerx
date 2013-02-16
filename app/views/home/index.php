<h2> Welcome </h2>

<p> <b>Last worked project:</b> 
    <a href="/project/view/<?php echo $viewmodel->lastWorkedProject->id; ?>"> 
    <?php echo $viewmodel->lastWorkedProject->name; ?>  </a>
</p>

<p> <b>Last 10 inserts</b> </p>
<ul>
    <?php
    $i = 0;
    foreach($viewmodel->projectList as $hours) {
        if ($i++ > 9) {
            break;
        }
        
        echo "<li>" . floor($hours->minutes / 60) . " hours and " . ($hours->minutes % 60) . 
                " minutes for \"" . $hours->projectname . "\" dated " . $hours->date . "</li>";
    }
    
    ?>
</ul>
<button id="changepassword"> Change password</button>

<script>
    $("#changepassword").click(function() {
        window.location.href = "<?php echo BASE_DIR; ?>home/changepassword";
    });
</script>