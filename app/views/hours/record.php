<h2> Record </h2>
<a href="#" id="startRecord"> Start </a>
<div id="status"></div>
<div id="time"></div>

<script>
    var running = false;
    var timer;
    var time = 0;
    var recordId = -1;
    
    $('#startRecord').click(function (event) {
        event.preventDefault();
        
        if (running == false) {
            if (recordId == -1) {
                $.post("<?php echo BASE_DIR; ?>hours/getrecordid",
                function (data) {
                    recordId = data;
                });                
            }
            
            timer = setInterval(function(){myTimer()},1000);
            running = true;
            $('#startRecord').html("Stop");
        }
        else {
            $('#startRecord').html("Start");            
            window.clearInterval(timer);
            running = false;
        }
    });
    
    function myTimer()
    {
        time += 10;
        
        if (time % 60 == 0) {
            $.post("<?php echo BASE_DIR; ?>hours/saverecordedhours", 
            { projectid: '1', minutes: (time / 60), recordid: recordId },
            
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


<p>Previously recorded, unassigned hours</p>

<table id="datatable">
    <thead>
    <td>Project</td>
    <td>Minutes</td>
    <td>Date</td>
    <td></td>
</thead>
<?php
foreach ($viewmodel as $record) {
    echo '<tr><td>' . $record->projectid . '</td>
            <td>' . $record->minutes . '</td>
                <td>' . $record->date . '</td>
                    <td><button> Assign to project </button></td></tr>';
}
?>
</table>


