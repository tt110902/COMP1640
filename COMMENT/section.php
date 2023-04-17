
    <?php 
        $page = isset($_GET['page']) ? $_GET["page"] : $post;
        include ($page);
    ?>