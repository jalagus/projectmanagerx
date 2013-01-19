<h2> Record </h2>

<p class="helptext"> Choose the project you want to record hours. You can record 
    hours only for one project at the same time and after you have recorded the hours, you have to confirm them to project. </p>

<p class="helptext"><b> Notice! </b> You can't change the page while recording. </p>

<div id="recordTable">
    <select name="projectid">
        <?php
        foreach ($viewmodel as $row) {
            echo '<option value="' . $row->id . '">' . $row->name . "</option>";
        }
        ?>
    </select>

    <input type="text" placeholder="Short work description..." name="description" />
    <button id="startRecord"> Record </button>  
    <span id="time">0 seconds</span>
</div>

<script>
    var running = false;
    var timer;
    var time = 0;
    var recordId = -1;
    
    $('#startRecord').click(function (event) {
        event.preventDefault();
        
        if (running == false) {
            $('#navigation a').click(function (event) {
                event.preventDefault();

                alert("Stop recording first!");
            });     
            
            if (recordId == -1) {
                $.post("<?php echo BASE_DIR; ?>hours/getrecordid",
                {   description: $('input[name="description"]').val(),
                    projectid: $('select[name="projectid"]').val() },
                function (data) {
                    recordId = data;
                });                
            }
            
            timer = setInterval(function(){myTimer()},1000);
            running = true;
            $('#startRecord').addClass("recording");
        }
        else {
            $('#navigation a').off('click'); 
            
            $('#startRecord').removeClass("recording");            
            window.clearInterval(timer);
            running = false;
        }
    });
    
    $('select[name="projectid"]').change(function() {
        $('#navigation a').off('click'); 
    
        time = 0;
        recordId = -1;
        running = false;
        $('input[name="description"]').val("");
        window.clearInterval(timer);
        $('#startRecord').removeClass("recording");
        $('#time').html("0 seconds");
    });
    
    function myTimer()
    {
        time += 10;
        
        if (time % 60 == 0) {
            $.post("<?php echo BASE_DIR; ?>hours/saverecordedhours", 
            {   minutes: (time / 60), 
                recordid: recordId },
            
            function (data) {
                $('#status').html(data);
            });
        }
        
        if (time < 60) {
            document.getElementById("time").innerHTML = time + " seconds";                        
        }
        else if (time < 3600) { 
            document.getElementById("time").innerHTML = 
                Math.floor(time / 60) + " minutes " +
                (time % 60) + " seconds";        }
        else  {
            document.getElementById("time").innerHTML = 
                Math.floor(time / 3600) + " hours " +
                Math.floor((time % 3600) / 60) + " minutes " +
                (time % 60) + " seconds";
        }

    }
</script>

<h2>Unconfirmed hours</h2>

<table id="datatable">
    <thead>
        <td>Project</td>
        <td>Date</td>
        <td>Minutes</td>
        <td></td>
    </thead>
</table>