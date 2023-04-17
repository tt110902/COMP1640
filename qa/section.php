
    <?php 
        $page = isset($_GET['page']) ? $_GET["page"] : $chart;
        include ($page);
    ?>