<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Project Manager X</title>
        <meta name="description" content="Project Manager X">
        <meta name="author" content="Jarkko Lagus">

        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/jquery.dataTables.css">
        <link rel="stylesheet" href="/css/jquery.dataTables_themeroller.css">
        <link rel="stylesheet" href="/css/smoothness/jquery-ui-1.10.0.custom.min.css">

        <script src="/js/jquery-1.9.0.min.js"></script>
        <script src="/js/tiny_mce/tiny_mce.js"></script>        
        <script src="/js/jquery.dataTables.min.js"></script>
        <script src="/js/jquery-ui-1.10.0.custom.min.js"></script>
        <script>
            $(function() {
                $(".dateInput").datepicker({ dateFormat: 'yy-mm-dd' }); 
                
                $("#datatable").dataTable({
                    "bJQueryUI": true
                });
                
                $("#navigation").buttonset();
                
                tinyMCE.init({
                    mode : "textareas",
                    theme : "simple"
                });
            });
        </script>        
    </head>
    <body>

        <div id="container">
            <div id="header">
                <h1> Project Manager X </h1>
            </div>
            <div id="navigation">
                <ul>
                    <li><a href="/home/">Dashboard</a></li>
                    <li><a href="/hours/add">Add hours</a></li>
                    <li><a href="/hours/">List hours</a></li>
                    <li><a href="/project/add">Add project</a></li>
                    <li><a href="/project/">List projects</a></li>    
                    <li><a href="/report/">Generate reports</a></li>
                    <li><a href="/authentication/logout">Logout</a></li>
                </ul>               
            </div>