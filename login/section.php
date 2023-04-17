<!-- Section-->
<section class="py-5">
<div class="container px-4 px-lg-5 mt-5">
    <?php 
        $page = isset($_GET['page']) ? $_GET["page"] : $homepage;
        include($page);
    ?>
   