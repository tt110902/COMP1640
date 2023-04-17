    <?php 
        $page = isset($_GET['page']) ? $_GET["page"] : $acadamicYear;
        include ($page);
    ?>