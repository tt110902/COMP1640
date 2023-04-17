<!DOCTYPE html>
<html>

<head>
    <title>Sort and Download Table Data</title>
</head>

<body>
    <br>
    <div id="main-content" class="container allContent-section py-6" style="margin-left:20%; width: 70%;">
        <h2>Sort and Download Table Data</h2>
        <hr>
        <form method="post">
            <label for="sort">Sort By:</label>
            <select id="type" name="type">
                <option value="like_count">Like</option>
                <option value="dislike_count">Dislike</option>
                <option value="view">View</option>
            </select>
            <select id="sort" name="sort">
                <option value="ASC">Ascending</option>
                <option value="DESC">Descending</option>
            </select>
            <button type="submit" name="sortBtn">Sort</button>
            <div class="float-right">
                <a href="export.php" class="btn btn-success"><i class="dwn"></i> Export</a>
            </div>
        </form>

        <?php
        //Connect to database
        $db = new mysqli("localhost", "root", "", "btwev");

        //Query to get data from poster table
        $sql = "SELECT * FROM poster";

        //Check if sort button is clicked
        if (isset($_POST["sortBtn"])) {
            //Get the sort type from select input
            $sortType = $_POST["type"];
            //Get the sort order from select input
            $sortOrder = $_POST["sort"];
            //Append the sort order to the SQL query
            $sql .= " ORDER BY $sortType $sortOrder";
        }

        //Execute the query
        $result = $db->query($sql);

        //Check if download button is clicked
        if (isset($_POST["downloadBtn"])) {
            //Create a file pointer
            $fp = fopen('idea_data.csv', 'w');
            //Write the header row to the CSV file
            fputcsv($fp, array('Poster name', 'Poster user', 'view', 'like', 'dislike'));
            //Loop through the result set and write each row to the CSV file
            while ($row = $result->fetch_assoc()) {
                fputcsv($fp, array($row['p_name'], $row['p_user'], $row['view'], $row['like_count'], $row['dislike_count']));
            }

            //Close the file pointer
            fclose($fp);

            //Set headers to force download the CSV file
            header('Content-Type: application/csv');
            header('Content-Disposition: attachment; filename="idea_data.csv";');
            header('Content-Length: ' . filesize('idea_data.csv'));
            readfile('idea_data.csv');
            exit();
        }


        //Check if there are any rows returned from the query
        if ($result->num_rows > 0) {
            //Output table header
            echo "<table border='1'>";
            echo "<tr><th>Poster Name</th><th>Poster user</th><th>view</th><th>like</th><th>dislike</th></tr>";

            //Loop through the result set and output each row as a table row
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['p_name'] . "</td><td>" . $row['p_user'] . "</td><td>" . $row['view'] . "</td><td>" . $row['like_count'] . "</td><td>" . $row['dislike_count'] . "</td></tr>";
            }

            //Close the table
            echo "</table>";
        } else {
            //If no rows returned, output message
            echo "No data found.";
        }

        //Close the database connection
        $db->close();
        ?>
    </div>
</body>