<?php

include('connection.php');

?>

<?php

$msg = "";
if (isset($_POST['submit'])) {
    $email = $_POST['mail'];
    $role = $_POST['roles'];
    $sql = "SELECT * FROM users WHERE email='{$email}'";

    $sql_run = mysqli_query($conn, $sql);

    if (mysqli_num_rows($sql_run) > 0) {
        $update_role = "UPDATE users SET roles = '{$role}' WHERE email = '{$email}'";
        $update_role_run = mysqli_query($conn, $update_role);

        if ($update_role_run) {
            $msg = "<div class='alert alert-info'>The role of $email have been setted.</div>";
        } else {
            $msg = "<div class='alert alert-info'>Can't Set the email: $email as $role.</div>";
        }
    } else {
        $msg = "<div class='alert alert-info'>Email Not Found.</div>";
    }
}




?>

<br>
<div id="main-content" class="container allContent-section py-6" style="margin-left:20%; width:70%;">
    <h2>All Staff</h2>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">Name</th>
                <th class="text-center">Email </th>
                <th class="text-center">Role</th>
                <th class="text-center" colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $sql = "SELECT * FROM users";
            $results = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($results)) {
                ?>
                <tr>
                    <td scope="row">
                        <?php echo $row['u_name'] ?>
                    </td>
                    <td scope="row">
                        <?php echo $row['email'] ?>
                    </td>
                    <td scope="row">
                        <?php
                        switch ($row['roles']) {
                            case "0":
                                echo "staff";
                                break;
                            case "2":
                                echo "admin";
                                break;
                            case "1":
                                echo "qa";
                                break;
                        }
                        ?>
                    </td>

                    <td>
                        <a href="<?php echo $urladmin . '?page=role_edit.php&u_id=' . $row['u_id']; ?>">
                            <span class="material-icons">drive_file_rename_outline</span>

                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
</div>
<script src="js/jquery.min.js"></script>
<script>
    $(document).ready(function (c) {
        $('.alert-close').on('click', function (c) {
            $('.main-mockup').fadeOut('slow', function (c) {
                $('.main-mockup').remove();
            });
        });
    });
</script>