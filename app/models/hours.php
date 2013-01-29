<?php

class HoursModel extends BaseModel {

    private $projectViewmodel;
    private $hoursViewmodel;
    
    /* 
     * Constructor of the Hours model 
     */
    public function __construct() {
        parent::__construct();    
        
        $this->projectViewmodel = new ProjectViewmodel($this->database);
        $this->hoursViewmodel = new HoursViewmodel($this->database);
    }    
    
    /* 
     * Gets view data for the index view 
     * 
     * @param int $userid id of the user
     */    
    public function Index($userid) {        
        return $this->hoursViewmodel->getList($userid);;
    }
    
    /* 
     * Gets view data for the add view 
     * 
     * @param int $userid id of the user
     */    
    public function Add($userid) {
        return $this->projectViewmodel->getList($userid);
    }
    
    /* 
     * Saves the hours to database
     * 
     * Return string with rows that had error in saving
     * 
     * @param int $userid id of the user
     * @param int $projectid id of the project
     * @param int $minutes time used on the task
     * @param date $date date of the work hours
     * @param string $description work description
     */
    public function AddHours($userid, $projectid, $minutes, $date, $description) {
        $i = 0;
        
        $errorMsg = "";
        
        $savedLines = 0;
        
        while (isset($projectid[$i])) {
            if ($minutes[$i] > 0) {
                $hoursObj = new HoursDBModel($userid, $projectid[$i], $minutes[$i], 
                    $date[$i], htmlspecialchars($description[$i]));
                
                $query = $this->database->prepare("INSERT INTO hours (id, userid, projectid, minutes, date, description) 
                    VALUES (:id, :userid, :projectid, :minutes, :date, :description)");
                
                $query->execute((array) $hoursObj);
                
                if ($query == false) {
                    $errorMsg .= "Row: " . $minutes[$i] . " " . $date[$i] . " " . $description[$i] . " not saved!\n";
                }
                else {
                    $savedLines++;
                }
            }
            else {
                $projectName = $this->projectViewmodel->getById($userid, $projectid[$i])->name;
                
                $errorMsg .= "Couldn't add " . $minutes[$i]  . " minutes to project \"" . $projectName . 
                        "\" dated " . $date[$i] . " with description \"" . $description[$i] . "\".\n";
            }
            $i++;
        }
        
        $returnModel->errorMsg = htmlspecialchars($errorMsg);
        $returnModel->savedLines = $savedLines;
        
        return $returnModel;
    }
    
    /*
     * Deletes the hours entry from database
     * 
     * @param int $userid id of the user
     * @param int $hoursid id of the hours to be deleted
     */
    public function Delete($userid, $hoursid) {
        $query = $this->database->prepare("DELETE FROM hours WHERE id = ? AND userid = ?");
        $query->execute(array($hoursid, $userid));  
        
        if ($query == false) {
            throw new Exception("Error on delete");
        }
    }
    
    /* 
     * Gets view data for the delete confirmation view 
     * 
     * @param int $userid id of the user
     * @param int $hoursid id of the hours to be deleted
     */    
    public function ConfirmDelete($userid, $hoursid) {
        return $this->hoursViewmodel->getById($userid, $hoursid);        
    }
}

?>
