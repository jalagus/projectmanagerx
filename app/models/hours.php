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
    public function AddHours($userid, $hoursObj) {
        $i = 0;
        
        $errorMsg = "";
        
        $savedLines = 0;
        
        while (isset($hoursObj->projectid[$i])) {
            $minutes = ($hoursObj->hours[$i] * 60) + $hoursObj->minutes[$i];
            
            if ($minutes > 0) {
                $hoursDbObj = new HoursDBModel($userid, $hoursObj->projectid[$i], $minutes, 
                    $hoursObj->date[$i], htmlspecialchars($hoursObj->description[$i]));
                
                $query = $this->database->prepare("INSERT INTO hours (id, userid, projectid, minutes, date, description) 
                    VALUES (:id, :userid, :projectid, :minutes, :date, :description)");
                
                $query->execute((array) $hoursDbObj);
                
                if ($query == false) {
                    $errorMsg .= "Row: " . $minutes . " " . $hoursObj->date[$i] . " " . 
                            $hoursObj->description[$i] . " not saved!\n";
                }
                else {
                    $savedLines++;
                }
            }
            else {
                $projectName = $this->projectViewmodel->getById($userid, $hoursObj->projectid[$i])->name;
                
                $errorMsg .= "Couldn't add " . $minutes  . " minutes to project \"" . $projectName . 
                        "\" dated " . $hoursObj->date[$i] . " with description \"" . 
                        $hoursObj->description[$i] . "\".\n";
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
    
    /*
     * Gets hours data for edit
     */
    public function Edit($userid, $hoursid) {
        $retValue = $this->hoursViewmodel->getById($userid, $hoursid);
        
        if ($retValue == false) {
            return false;
        }
        
        $retValue->projectList = $this->projectViewmodel->getList($userid);
        
        return $retValue; 
    }
    
    public function Update($userid, $hoursObj) {               
        $minutes = $hoursObj->hours * 60 + $hoursObj->minutes;
        
        $query = $this->database->prepare("UPDATE hours SET projectid = ?, minutes = ?, 
            date = ?, description = ? WHERE id = ? AND userid = ?");
        
        
        $query->execute(array($hoursObj->projectid, $minutes, $hoursObj->date, 
            htmlspecialchars($hoursObj->description), 
            $hoursObj->hoursid, $userid));        
        
        return $query;
    }
}

?>
