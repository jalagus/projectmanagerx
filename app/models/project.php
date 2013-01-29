<?php

class ProjectModel extends BaseModel {
    
    private $projectViewmodel;

    /*
     * Contructor of the project model -object
     */
    public function __construct() {
        parent::__construct();    
        
        $this->projectViewmodel = new ProjectViewmodel($this->database);
    }

    /*
     * Returns view data used by index view
     * 
     * @param int $userid id of the user asking the data
     */
    public function Index($userid) {         
        return $this->projectViewmodel->getList($userid);
    }
    
    /*
     * Adds project to database
     * 
     * @param int $userid id of the user asking the data
     * @param string $projectName name of the project
     * @param string $projectDescription description of the project
     */    
    public function Add($userid, $projectName, $projectDescription) {
        if (empty($userid) || empty($projectName) || empty($projectDescription)) {
            return false;
        }
        
        $projectObj = new ProjectDBModel($userid, htmlspecialchars($projectName), 
            htmlspecialchars($projectDescription));
        
        $query = $this->database->prepare("INSERT INTO projects (id, userid, name, description) 
            VALUES (:id, :userid, :name, :description)");
        
        return $query->execute((array) $projectObj);     
    }

    /*
     * Returns view data used by delete confirmation view
     * 
     * @param int $userid id of the user asking the data
     * @param int $projectid id of the project to be deleted
     */
    public function ConfirmDelete($userid, $projectid) {
        return $this->projectViewmodel->getById($userid, $projectid);      
    }
    
    /*
     * Deletes project (database must be set to delete the entries according to 
     * project from the hours table)
     * 
     * @param int $userid id of the user asking the data
     * @param int $projectid id of the project to be deleted
     */
    public function Delete($userid, $projectid) {
        $query = $this->database->prepare("DELETE FROM projects WHERE id = ? AND userid = ?");
        $query->execute(array($projectid, $userid));
    }
    
    /*
     * Returns view data used by project view -view
     * 
     * @param int $userid id of the user asking the data
     * @param int $projectid id of the project to be viewed
     */
    public function View($userid, $projectid) {
        return $this->projectViewmodel->getById($userid, $projectid);
    }
    
    /*
     * Returns view data used by edit view
     * 
     * @param int $userid id of the user asking the data
     * @param int $projectid id of the project to be edited
     */
    public function Edit($userid, $projectid) {
        return $this->projectViewmodel->getById($userid, $projectid);        
    }
    
    /*
     * Updates the data from edit view to the database
     * 
     * @param int $userid id of the user asking the data
     * @param int $projectid id of the project to be updated
     * @param string $name updated name of the project
     * @param string $description updated description of the project
     * 
     */
    public function Update($userid, $projectid, $name, $description) {       
        $query = $this->database->prepare("UPDATE projects SET name = ?, description = ? WHERE id = ? AND userid = ?");
        $query->execute(array(htmlspecialchars($name), htmlspecialchars($description), $projectid, $userid));
    }
}

?>
