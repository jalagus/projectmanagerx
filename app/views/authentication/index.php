<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Project Manager X</title>
  <meta name="description" content="Project Manager X">
  <meta name="author" content="Jarkko Lagus">
  <link rel="stylesheet" href="<?php echo BASE_DIR; ?>css/login.css">
  <link rel="stylesheet" href="<?php echo BASE_DIR; ?>css/smoothness/jquery-ui-1.9.2.custom.min.css">

</head>
<body>

<div id="container">
<h2><?php echo BASE_NAME; ?></h2>
<form action="<?php echo BASE_DIR; ?>authenctication/login" method="POST">

Username<br/>
<input class="rounded" type="text" name="username" /> <br/>

Password<br/>
<input class="rounded" type="password" name="password" /> <br/>

<input class="button" type="submit" value="Login">
</form>

</div>
</body>
</html>