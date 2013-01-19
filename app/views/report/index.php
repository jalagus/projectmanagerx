<h2> Report </h2>

<form action="<?php echo BASE_DIR; ?>report/show" method="POST">
    <table>
        <thead>
        <td>Start date</td>
        <td>End date</td>
        <td></td>
        </thead>
        
        <tr>
            <td><input class="dateInput" type="text" name="startDate" /></td>
            <td><input class="dateInput" type="text" name="endDate" /></td>
            <td><input type="submit" value="Get report" /></td>
        </tr>

    </table>
</form>