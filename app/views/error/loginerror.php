<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Project Manager X</title>
        <meta name="description" content="Project Manager X">
        <meta name="author" content="Jarkko Lagus">
        <link rel="stylesheet" href="<?php echo BASE_DIR; ?>css/login.css">
        <link rel="stylesheet" href="<?php echo JQUERY_UI_THEME_FILE; ?>">
        <script src="<?php echo BASE_DIR; ?>js/jquery-1.9.0.min.js"></script>

    </head>
    <body>

        <div id="container">
            <h2><?php echo BASE_NAME; ?></h2>

            <p> <b>Error on login!</b> </p>
            <p> Wrong username or password! </p>
            <button id="returnButton"> Return </button>

        </div>


        <script>
            $("#returnButton").click(function( ) {
                window.location = "<?php echo BASE_DIR; ?>";
            });
        </script>    
    </body>
</html>