<h2> Welcome </h2>
<p> Latest inserts </p>

<ul>
    <?php
    
    foreach($viewmodel as $hours) {
        echo "<li>" . $hours->projectname . " " . $hours->minutes . "</li>";
    }
    
    ?>
</ul>