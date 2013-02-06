$(function() {
    
    // Form validation
    $("#addHoursForm").submit(function (event) {
        var validationError = false;

        $('#addHoursForm tr').each(function() {
                        
            var hours = $(this).find('input[name="hours[]"]');
            var minutes = $(this).find('input[name="minutes[]"]');
            var date = $(this).find('input[name="date[]"]');
            
            var re = /^[0-9]+$/;
            
            if (!re.test(hours.val()) && hours.is(":disabled") == false) {                
                hours.css("background", "yellow");
                hours.addClass("formatError");
                
                validationError = true;
            }
            
            if (!re.test(minutes.val()) && minutes.is(":disabled") == false) {
                minutes.css("background", "yellow");
                minutes.addClass("formatError");                    
                    
                validationError = true;               
            }
            
            re = /^[0-9]*$/;
            
            if (re.test(minutes.val()) && re.test(hours.val()) && hours.val() + minutes.val() > 0) {
                minutes.css("background", "white");
                hours.css("background", "white");

                validationError = false;
            }
                        
            if (date.val() == "" && date.is(":disabled") == false) {
                date.css("background", "yellow");
                date.addClass("formatError");                    
                    
                validationError = true;                  
            }
            
        });
   
        
        if (validationError) {
            $('.formatError').change(function() {
                $(this).css("background", "white");                
            });
            
            
            $('#submit').after('<p id="notification" style="position: relative; top: -32px; left: 100px;">' +
                '<b>Please check the values in fields highlighted with yellow</b></p>').next("p").delay(2000).hide(500);


            event.preventDefault();
        }
        
    });
});