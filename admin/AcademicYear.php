<br>
<div id="main-content" class="container allContent-section py-6" style="margin-left:20%; width:70%;">
    <h2>Academic Year</h2>
    <hr>
    <h4><a href="<?php echo $urladmin.'?page=closesure_date.php' ?>">Add New Academic Year</a></h4>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">Year</th>
                <th class="text-center">Begin Date </th>
                <th class="text-center">Close Date</th>
                <th class="text-center">Final Date</th>
                <th class="text-center" colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $sql = "SELECT * FROM closesuredate";
            $results = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($results)) {
            ?>
                <tr>
                    <td scope="row"><?php echo $row['Year'] ?></td>
                    <td scope="row"><?php echo $row['Begin_date'] ?></td>
                    <td scope="row"><?php echo $row['Closesure_date'] ?></td>
                    <td scope="row"><?php echo $row['Final_Date'] ?></td>


                    <td>
                        <a href="<?php echo $urladmin . '?page=Adate_edit.php&year=' . $row['Year']; ?>">
                            <span class="material-icons">drive_file_rename_outline</span>

                        </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>