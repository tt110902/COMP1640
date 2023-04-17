<br>
<div id="main-content" class="container allContent-section py-6" style="margin-left:20%; width:70%;">
    <h2>Setting up for Academic Year</h4>
    <hr>

    <form id="update-Items" method="post" enctype='multipart/form-data'>
    <div class="form-group">
            <label for="Academic Year">Academic Year</label>
            <input type="Year" class="form-control" name="AYear" readonly = "readonly" value = "<?php echo date('Y');?>"></br>
        </div>
        <div class="form-group">
            <label for="BeginDate">Begin Date</label>
            <input type="datetime-local" class="form-control" name="BeginDate" required></br>
        </div>
        <div class="form-group">
            <label for="CloseDate">Closure Date</label>
            <input type="datetime-local" class="form-control" name="CloseDate" required></br>
        </div>
        <div class="form-group">
            <label for="CloseDate">Final Closure Date</label>
            <input type="datetime-local" class="form-control" name="FinalCloseDate" required></br>
        </div>
        <div class="form-group">
            <div class="from-group col md-12">
                <input type="submit" class="btn btn-primary" name="btnSet" value="SET">
                <input type="button" class="btn btn-danger" name="btnIgnore" value="Ignore" onclick="window.location='<?php echo '?page=' . $roles; ?>'" />
            </div>
        </div>
    </form>
</div>

<?php

if (isset($_POST['btnSet'])) {

    $year = date('Y');
    $begin = $_POST['BeginDate'];
    $closedate= $_POST['CloseDate'];
    $finaldate = $_POST['FinalCloseDate'];

    $sql = "INSERT INTO closesuredate (Begin_date, Closesure_date, Final_Date, Year) VALUES ('{$begin}','{$closedate}', '{$finaldate}', '{$year}')";

    $sql_run = mysqli_query($conn, $sql);

    if($sql_run)
    {
        echo '<script type="text/javascript"> window.onload = function () { alert("Setting sucessfull"); } </script>';
        header("location: ./admin");
    }else
    {
        echo '<script type="text/javascript"> window.onload = function () { alert("Something goes wrong"); } </script>';
    }

    }


?>