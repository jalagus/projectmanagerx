<h2> Welcome </h2>

<p> <b>Last worked project:</b> 
    <a href="/project/view/<?php echo $viewmodel->lastWorkedProject->id; ?>"> 
    <?php echo $viewmodel->lastWorkedProject->name; ?>  </a>
</p>

<p> <b>Latest inserts</b> </p>
<ul>
    <?php
    
    foreach($viewmodel->projectList as $hours) {
        echo "<li>" . $hours->projectname . " " . $hours->minutes . "</li>";
    }
    
    ?>
</ul>