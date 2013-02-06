$(function() {
    
    // Form validation
    $("#addHoursForm").submit(function (event) {
        var validationError = false;
        
        // Validate minutes
        $('input[name="minutes[]"]').each(function () {
            if ( $(this).val() < 1 && $(this).is(":disabled") == false) {
                
                $(this).css("background", "yellow");
                $(this).addClass("formatError");
                
                validationError = true;
            }
        });
        
        // Validate date
        $('input[name="date[]"]').each(function () {
            if ( $(this).val() == "" && $(this).is(":disabled") == false ) {
                $(this).css("background", "yellow");
                $(this).addClass("formatError");
                
                validationError = true;
            }
        });    
        
        if (validationError) {
            $('.formatError').change(function() {
                $(this).css("background", "white");                
            });
            
            alert("Check the inputs marked with yellow!");
            
            event.preventDefault();
        }
        
    });
});