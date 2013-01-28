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
            
            $("body").addClass("recordingBodyBG");
            
            if (recordId == -1) {
                $.post("<?php echo BASE_DIR; ?>record/getrecordid",
                {   description: $('input[name="description"]').val(),
                    projectid: $('select[name="projectid"]').val() },
                function (data) {
                    recordId = data;
                });       
                
                // Add row to datatable
                var projectname = $('select[name="projectid"] option[value="' + $('select[name="projectid"]').val() + '"]').text();
                var date = new Date();
                
                $('#datatable').dataTable().fnAddData( [
                    projectname,
                    date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate(),
                    "Refresh to see",
                    $('input[name="description"]').val(),
                    '<button class="confirmButton" data-recordid="' + recordId + '">Confirm</button> ' + 
                    '<button class="deleteButton" data-recordid="' + recordId + '">Delete</button>']
                );            

                $("button, .button" ).button().click(function( event ) {
                    event.preventDefault();
                });

                $( "input[type=submit], input[type=reset]" ).button(); 
            }



                
            timer = setInterval(function(){myTimer()},1000);
            running = true;
            $('#startRecord').addClass("recording");
        }
        else {
            $('#navigation a').off('click'); 
            $("body").removeClass("recordingBodyBG");
            
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
        time += 1;
        
        if (time % 60 == 0) {
            $.post("<?php echo BASE_DIR; ?>record/saverecordedhours", 
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
    
    $(".deleteButton").click(function () {
        var pressed = this;
        
        $.post("<?php echo BASE_DIR; ?>record/deleterecordedhours", 
            { recordid: $(this).data('recordid') },
            function() {
                var index = $(pressed).closest('tr').index();
                $("#datatable").dataTable().fnDeleteRow( index );
                
                alert("Deleted!");
        });
    });
    
    $(".confirmButton").click(function () {
        var pressed = this;
        
        $.post("<?php echo BASE_DIR; ?>record/confirmrecordedhours", 
            { recordid: $(this).data('recordid') },
            function() {
                var index = $(pressed).closest('tr').index();
                $("#datatable").dataTable().fnDeleteRow( index );

                alert("Confirmed!");
        });    
    });    
    
</script>