<h2>Manage users</h2>

<?php
if (isset($viewbag)) {
    echo "<p>". $viewbag . "</p>";
}
?>
<button id="addnewuser">Add new user</button>

<h3>User list </h3>
<table>
    <thead>
        <td><b>Username</b></td>
        <td><b>Actions</b></td>
    </thead>
<?php

foreach ($viewmodel as $user) {
    echo '<tr><td>' . $user->username . '</td><td> <button class="deleteButton" data-userid="' . $user->id . '"> Delete </button></tr>';
}

?>
</table>

<script>
    $("#addnewuser").click(function () {
        window.location.href = "<?php echo BASE_DIR; ?>admin/adduser";
    });
    
    $(".deleteButton").click(function() {
        
        window.location = "<?php echo BASE_DIR; ?>admin/deleteuser/" + $(this).data('userid');
    });    
</script>