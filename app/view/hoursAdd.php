<p> Add new hours to project </p>
<form action="" method="POST">
    <input type="hidden" name="controller" value="hours" />
    <input type="hidden" name="action" value="add" />
    
    Projekti
    <select>
        <?php
            //$userId = $this->login->getUserId();
            
            $result = $this->database->doQuery("SELECT * FROM projects WHERE manager = '1'");
            
            print_r($result);
        ?>
    </select>
    
    Tunnit
    <input type="text" name="hours" />
    
    Minuutit
    <input type="text" name="minutes" />
    
</form>