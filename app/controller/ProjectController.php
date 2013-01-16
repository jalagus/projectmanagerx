<?php

include_once("controller/Controller.php");

class ProjectController extends Controller {

    public function invoke() {
        $action = $_POST['action'];

        if ($action == "add") {
            echo "Adding project!";

            $this->addProjectToDatabase($_POST['projectName'], $_POST['projectDescription']);
        } else if ($action == "delete") {
            echo "Deleting project!";
        } else if ($action == "update") {
            echo "Updating project!";
        }
    }

    public function addProjectToDatabase($name, $description, $database) {
        $userId = $this->login->getUserId();

        $result = $this->database->doQuery("INSERT INTO projects VALUES ('', '$userId', '$name', '$description')");
    }
    
    public function loadProjectArrayFromDB() {
        $result = $this->database->doQuery("INSERT INTO projects VALUES ('', '$userId', '$name', '$description')");

        foreach() {
            
        }
    }

}

?>