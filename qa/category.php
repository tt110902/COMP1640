<?php
include('connection.php');
?>
<br>
<div id="main-content" class="container allContent-section py-6" style="margin-left:20%; width:70%;">
    <h2>All Category</h2>
    <hr>
    <h4><a href="<?php echo "?page=" . $categoryAdd; ?>">Create new</a></h4>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <th class="text-center" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM categories";
            $results = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($results)) {
            ?>
                <tr>
                    <td scope="row"><?php echo $row['cat_id'] ?></td>
                    <td><?php echo $row['cat_name'] ?></td>

                    <td>
                        <a href="<?php echo $urladmin . '?page=' . $categoryEdit . '&cat_id=' . $row['cat_id']; ?>">
                            <span class="material-icons">drive_file_rename_outline</span>
                            <a href="<?php echo $urladmin . '?page=' . $categoryDelete . 'cat_id=' . $row['cat_id']; ?>" onclick="return confirm('Are you sure')">
                                <span class="material-icons">delete_outline</span>
                            </a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>