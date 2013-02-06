<?php
    $controller = $_GET['controller'];
    
    $loadStyle = false;
    $loadScript = false;
    
    if (file_exists(BASE_DIR . "css/views/" . $controller . "/style.css")) {
        $loadStyle = true;
    }
    
    if (file_exists(BASE_DIR . "js/views/" . $controller . "/scripts.js")) {
        $loadScript = true;
    }
    
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo BASE_NAME; ?></title>
        <meta name="description" content="Project Manager X">
        <meta name="author" content="Jarkko Lagus">
        
        <?php if ($loadStyle) { ?>
            <link rel="stylesheet" href="<?php echo BASE_DIR; ?>css/views/<?php echo $controller; ?>/style.css" >
        <?php } ?>
        <link rel="stylesheet" href="<?php echo BASE_DIR; ?>css/themes/smoothness/jquery-ui-1.10.0.custom.min.css">
        <link rel="stylesheet" href="<?php echo BASE_DIR; ?>css/themes/jquery.dataTables.css">
        <link rel="stylesheet" href="<?php echo BASE_DIR; ?>css/themes/jquery.dataTables_themeroller.css">
        <link rel="stylesheet" href="<?php echo BASE_DIR; ?>css/style.css">
        
        <script src="<?php echo BASE_DIR; ?>js/libs/jquery-1.9.0.min.js"></script>
        <script src="<?php echo BASE_DIR; ?>js/libs/tiny_mce/tiny_mce.js"></script>        
        <script src="<?php echo BASE_DIR; ?>js/libs/jquery.dataTables.min.js"></script>
        <script src="<?php echo BASE_DIR; ?>js/libs/jquery-ui-1.10.0.custom.min.js"></script>
        <?php if ($loadScript) { ?>
            <script src="<?php echo BASE_DIR; ?>js/views/<?php echo $controller; ?>/scripts.js"></script>        
        <?php } ?>
            
        <script>
            $(function() {
                $(".dateInput").datepicker({ dateFormat: 'yy-mm-dd' }); 
                
                $("#datatable").dataTable({
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers"                  
                });
                
                $("#navigation").buttonset();
                
                tinyMCE.init({
                    mode : "textareas",
                    theme : "simple"
                });

                $("button, .button" ).button().click(function( event ) {
                    event.preventDefault();
                });
                
                $( "input[type=submit], input[type=reset]" ).button();   
                                
            });
        </script>        
    </head>
    <body>

        <div id="container">
            <div id="header">
                <h1> <?php echo BASE_NAME; ?> </h1>
            </div>
            <div id="navigation">
                <ul>
                    <li><a href="<?php echo BASE_DIR; ?>home/">Dashboard</a></li>
                    <li><a href="<?php echo BASE_DIR; ?>record/">Record hours</a></li>
                    <li><a href="<?php echo BASE_DIR; ?>hours/add">Add hours</a></li>
                    <li><a href="<?php echo BASE_DIR; ?>hours/">List hours</a></li>
                    <li><a href="<?php echo BASE_DIR; ?>project/add">Add project</a></li>
                    <li><a href="<?php echo BASE_DIR; ?>project/">List projects</a></li>    
                    <li><a href="<?php echo BASE_DIR; ?>report/">Generate reports</a></li>
                    <li><a id="logoutButton" href="<?php echo BASE_DIR; ?>authentication/logout">Logout</a></li>
                </ul>               
            </div>
            <div id="content">