<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Project Manager X</title>
  <meta name="description" content="Project Manager X">
  <meta name="author" content="Jarkko Lagus">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/smoothness/jquery-ui-1.9.2.custom.min.css">
  
  <script src="js/jquery-1.9.0.min.js"></script>
  <script src="js/jquery-ui-1.9.2.custom.min.js"></script>

  <script>
  $(function() {
    $( "#tabs" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.error(function() {
          ui.panel.html(
            "Something went wrong. Try again.");
        });
      }
    });
  });
  </script>
</head>
<body>

<div id="container">
<div id="header">
<h1> Project Manager X </h1>
</div>

