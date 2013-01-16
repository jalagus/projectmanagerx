<?php

$action = $_GET['action'];

if ($action == "hoursAdd") {
    include("../view/hoursAdd.php");
} else if ($action == "hoursBrowse") {
    include("../view/hoursBrowse.php");
} else if ($action == "projectAdd") {
    include("../view/projectAdd.php");
} else if ($action == "reportsBrowse") {
    include("../view/reportBrowse.php");
} else {
    echo "Something is not right...";
}

?>