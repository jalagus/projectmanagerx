<?php

include_once("controller/Controller.php");

class ProjectController extends Controller {	

	public function invoke() {
		$action = $_POST['action'];
		
		if ($action == "add") {
			echo "Adding project!";
			
			$this->addProjectToDatabase($_POST['projectName'], $_POST['projectDescription']);
		}
		else if ($action == "delete") {
			echo "Deleting project!";
		}
		else if ($action == "update") {
			echo "Updating project!";
		}	
	}
	
	public function addProjectToDatabase($name, $description) {
		$result = $this->database->doQuery("INSERT INTO projects VALUES ('', '1', '$name', '$description')");
	}
}

?>