<?php

if (isset($_GET["year"])) {
    $sql = "SELECT * FROM closesuredate WHERE Year=" . $_GET["year"];
    $results = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($results)) {
        $year = $row['Year'];
        $begin = $row['Begin_date'];
        $close = $row['Closesure_date'];
        $final = $row['Final_Date'];
    }
    if (isset($_POST["btnUpdate"])) {
        
        $begin = $_POST['beginDate'];
        $close = $_POST['CloseDate'];
        $final = $_POST['FinalDate'];


        $sql = "SELECT * FROM closesuredate WHERE Year='{$year}'";

        $sql_run = mysqli_query($conn, $sql);

        if (mysqli_num_rows($sql_run) > 0) {
            $update_role = "UPDATE closesuredate SET Begin_date = '{$begin}', Closesure_date= '{$close}', Final_Date='{$final}' WHERE Year = '{$year}'";
            $update_role_run = mysqli_query($conn, $update_role);

            if ($update_role_run) {
                echo '<script type="text/javascript"> window.onload = function () { alert("Update Success"); } </script>';
                header('location: ?page=AcademicYear.php');
            } else {
                echo '<script type="text/javascript"> window.onload = function () { alert("Update Fail"); } </script>';
            }
        } else {
            echo '<script type="text/javascript"> window.onload = function () { alert("Something Went Wrong!!."); } </script>';
        }
    }
}
?>
<br>
<div id="main-content" class="container allContent-section py-6" style="margin-left:20%; width:70%;">
    <h2>Edit Account Role</h4>
    <hr>

    <form id="update-Items" method="post" enctype='multipart/form-data'>
        <div class="form-group">
            <label for="InputName">Year</label>
            <input type="year" class="form-control" name="inputName" placeholder=" " disabled="disabled" value="<?php echo $year; ?>"></br>
        </div>
        <div class="form-group">
            <label for="InputName">Begin Date</label>
            <input type="datetime-local" class="form-control" name="beginDate" placeholder=" " value="<?php echo $begin; ?>"></br>
        </div>
        <div class="form-group">
            <label for="InputName">Close Date</label>
            <input type="datetime-local" class="form-control" name="CloseDate" placeholder=" "  value="<?php echo $close; ?>"></br>
        </div>
        <div class="form-group">
            <label for="InputName">Final Date</label>
            <input type="datetime-local" class="form-control" name="FinalDate" placeholder=" "  value="<?php echo $final; ?>"></br>
        </div>
        <div class="form-group">
            <div class="from-group col md-12">
                <input type="submit" class="btn btn-primary" name="btnUpdate" value="Update">
                <input type="button" class="btn btn-danger" name="btnIgnore" value="Ignore" onclick="window.location='<?php echo '?page=' . $roles; ?>'" />
            </div>
        </div>
    </form>
</div>