<head>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f124118c9b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="1640/COMMENT/CSS/Stylesheet.css">
    <style>
        .nav-list {
            list-style: none;
            display: flex;
        }

        .strong {

            font-weight: 500;
            color: #00bcd4;
            margin: 5%;
        }

        .size {
            font-size: 20;
        }

        .nav-link:hover {
            font-size: 120%;
            color: rgba(0, 0, 0, 0.9);
            text-decoration: none;
        }

        .nav-link {
            color: #00bcd4;
        }

        .dropdown {
            list-style: none;
            display: flex;
            font-family: 'Ubuntu';
            font-weight: 500;
            color: #00bcd4;
            position: relative;
        }

        .dropdown-toggle::after {
            color: #00bcd4;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgb(0,188,212)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
        }

        .dropdown-menu {
            position: absolute;
            display: none;
            color: #00bcd4;
            background-color: #e9ecef;
            border: 1px solid #ccc;
            z-index: 1;
        }

        .dropdown:hover .dropdown-menu {
            color: #00bcd4;
            display: block;
        }

        .dropdown-item {
            color: #00bcd4;
        }
    </style>
</head>



<div class="container mt-2 mb-2" style="background-color:#e9ecef">
    <nav class="navbar navbar-expand-lg">
        <a class=" text" href="http://localhost/1640/homepage.php" style="color:#00bcd4"><b><img src="image/Logo.png" align="center" width="25%" alt="logo"></b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-list strong" style="margin-left: -30%;">
                <li class="nav-item" style=" margin-right: 15%;">
                    <a class="nav-link size" style=" margin-right: 15%;" href="http://localhost/1640/homepage.php">Home</a>
                </li>
                <hr>
                <li class="nav-item" style=" margin-right: 15%;">
                    <a class="nav-link size" style="margin-right: 15%;" href="<?php echo "http://localhost/1640/COMMENT/post.php?page=1" ?>">Idea</a>
                </li>
                <hr>
                <li class="nav-item dropdown" style="border :solid 0.5px">
                    <a class="nav-link size dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome,
                        <?php
                        // session_start();
                        $conn = mysqli_connect('localhost', 'root', '', 'btwev')
                            or die("Can not connect database" . mysqli_connect_error());

                        if (isset($_SESSION['user_uni_no']) && $_SESSION['user_uni_no'] != "") {
                            $user = $_SESSION['user_uni_no'];
                            $sql = "SELECT * FROM users WHERE verify_token='$user'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            $name = $row['u_name'];
                            $roles = $row['roles'];
                            echo $name;
                        } else {
                            echo "guest";
                        }
                        ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        if (!isset($_SESSION['user_uni_no']) || $_SESSION['user_uni_no'] == "") {
                        ?>
                            <li class="dropdown-item"><a class="dropdown-item" href="http://localhost/1640/login/login.php">Login</a></li>
                            <hr>
                            <li class="dropdown-item"><a class="dropdown-item" href="http://localhost/1640/login/signup.php">Register</a></li>
                        <?php
                        } else if ($roles == 0) {
                        ?>
                            <li class="dropdown-item"><a class="dropdown-item" href="http://localhost/1640/accountmanage.php">Account manage</a></li>
                            <hr>
                            <li class="dropdown-item"><a class="dropdown-item" href="http://localhost/1640/login/logout.php">Logout</a></li>
                        <?php
                        } else if ($roles == 1) {
                        ?>
                            <li class="dropdown-item"><a class="dropdown-item" href="http://localhost/1640/accountmanage.php">Account manage</a></li>
                            <hr>
                            <li class="dropdown-item"><a class="dropdown-item" href="http://localhost/1640/qa">QA Application</a></li>
                            <hr>
                            <li class="dropdown-item"><a class="dropdown-item" href="http://localhost/1640/login/logout.php">Logout</a></li>
                        <?php
                        } else if ($roles == 2) {
                        ?>
                            <li class="dropdown-item"><a class="dropdown-item" href="http://localhost/1640/admin/">Admin Function</a></li>
                            <hr>
                            <li class="dropdown-item"><a class="dropdown-item" href="http://localhost/1640/login/logout.php">Logout</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
            <!-- <form class=" " style="margin-right: 55px;">
                <div class="user-area">
                    <img src="/1640/image/<?php echo $sel_user_img['u_image']; ?>" alt="User Image">
                </div>
                <p href="logout.php" class="logout my-2 my-sm-0"><i class="fas fa-power-off fa-2x"></i></p>
            </form>-->
        </div>
    </nav>
</div>

<script>
    const dropdownToggle = document.querySelector('.dropdown-toggle');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    dropdownToggle.addEventListener('click', () => {
        dropdownMenu.classList.toggle('show');
    });

    window.addEventListener('click', (event) => {
        if (!event.target.matches('.dropdown-toggle')) {
            dropdownMenu.classList.remove('show');
        }
    });
</script>




</body>

</html>