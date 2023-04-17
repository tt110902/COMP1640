<?php
require_once('connection.php');
?>

<?php

if (isset($_GET["u_id"])) {
    $sql = "SELECT * FROM users WHERE u_id=" . $_GET["u_id"];
    $results = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($results)) {
        $u_name = $row['u_name'];
        $email = $row['email'];
        $role = $row['roles'];
    }
    if (isset($_POST["btnUpdate"])) {

        $role = $_POST['roles'];
        $sql = "SELECT * FROM users WHERE email='{$email}'";

        $sql_run = mysqli_query($conn, $sql);

        if (mysqli_num_rows($sql_run) > 0) {
            $update_role = "UPDATE users SET roles = '{$role}' WHERE email = '{$email}'";
            $update_role_run = mysqli_query($conn, $update_role);

            if ($update_role_run) {
                echo '<script type="text/javascript"> window.onload = function () { alert("The role of $email have been setted."); } </script>';
                header('location?page=role.php');
            } else {
                echo '<script type="text/javascript"> window.onload = function () { alert("Cant Set the email: ' . $email . ' as ' . $role . '."); } </script>';
            }
        } else {
            echo '<script type="text/javascript"> window.onload = function () { alert("Something Went Wrong!!."); } </script>';
        }
    }
}
?>
<br>
<div id="main-content" class="container allContent-section py-6" style="margin-left:20%; width:70%;;">
    <h2>Edit Account Role</h4>
        <hr>

        <form id="update-Items" method="post" enctype='multipart/form-data'>
            <div class="form-group">
                <label for="InputName">Name</label>
                <input type="text" class="form-control" name="inputName" placeholder=" " disabled="disabled"
                    value="<?php echo $u_name; ?>"></br>
            </div>
            <div class="form-group">
                <label for="InputName">Email</label>
                <input type="text" class="form-control" name="inputName" placeholder=" " disabled="disabled"
                    value="<?php echo $email; ?>"></br>
            </div>
            <div class="form-group">
                <label for="InputName">Roles</label>
                <select id="roles" name="roles">
                    <option value="0">staff</option>
                    <option value="1">qa</option>
                    <option value="2">admin</option>
                </select></br>
            </div>
            <div class="form-group">
                <div class="from-group col md-12">
                    <input type="submit" class="btn btn-primary" name="btnUpdate" value="Update">
                    <input type="button" class="btn btn-danger" name="btnIgnore" value="Ignore"
                        onclick="window.location='<?php echo '?page=' . $roles; ?>'" />
                </div>
            </div>
        </form>
</div>