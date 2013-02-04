<?php

class Utils {

    /* 
     * Transforms array to object
     */
    public function arrayToObject($array) {
        $object = new stdClass();

        foreach ($array as $key => $value) {
            $object->$key = $value;
        }
        
        return $object;
    }

}

?>
