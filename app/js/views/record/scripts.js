$(function() {
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
                $.post(basedir + "record/getrecordid",
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
            
            $.post(basedir + "record/saverecordedhours", 
            {   minutes: (time / 60), 
                recordid: recordId },
            
            function (data) {
                $('#status').html(data);
            });            
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
            $.post(basedir + "record/saverecordedhours", 
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
        
        $.post(basedir + "record/deleterecordedhours", 
            { recordid: $(this).data('recordid') },
            function() {
                var index = $(pressed).closest('tr').index();
                $("#datatable").dataTable().fnDeleteRow( index );
                
                alert("Deleted!");
        });
    });
    
    $(".confirmButton").click(function () {
        var pressed = this;
        
        $.post(basedir + "record/confirmrecordedhours", 
            { recordid: $(this).data('recordid') },
            function() {
                var index = $(pressed).closest('tr').index();
                $("#datatable").dataTable().fnDeleteRow( index );

                alert("Confirmed!");
        });    
    }); 
});