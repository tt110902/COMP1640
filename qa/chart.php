<?php include "connection.php"; ?>
<html>

<head>
    <div class="line">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', { 'packages': ['corechart'] });
            google.charts.setOnLoadCallback(drawVisualization);

            function drawVisualization() {
                // Some raw data (not necessarily accurate)
                // function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Post ', 'Like ', 'Dislike ', 'View '],
                    <?php
                    $query = "select * from poster";
                    $res = mysqli_query($conn, $query);
                    while ($data = mysqli_fetch_array($res)) {
                        $p_name = $data['p_name'];
                        $like_count = $data['like_count'];
                        $dislike_count = $data['dislike_count'];
                        $view = $data['view'];
                        ?>['<?php echo $p_name; ?>', <?php echo $like_count; ?>, <?php echo $dislike_count; ?>, <?php echo $view; ?>],
                        <?php
                    }
                    ?>
                ]);


                var options = {
                    title: 'Post statistic',
                    vAxis: { title: 'Numbers' },
                    hAxis: { title: 'Ideas' },
                    seriesType: 'bars',
                    series: { 2: { type: 'line' } }
                };

                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>
    </div>
</head>

<body>
    <div id="chart_div" style="width: 900px; height: 500px; margin-left: 20%;"></div>
    <div id="barchart_material_1" style="width: 800px; height: 400px; margin-left: 30%; margin-top: 5%;"></div>
</body>

</html>






<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Post', 'Comment'],
            <?php
            $getposter = "SELECT p_uni_no FROM poster";
            $getposter_query = mysqli_query($conn, $getposter);

            while ($data = mysqli_fetch_array($getposter_query)) {
                $getcomment = "SELECT mc_p_uni_id FROM mcomments";
                $getcomment_query = mysqli_query($conn, $getcomment);
                foreach ($data as $datas) {
                    $result1 = $conn->query("SELECT count(mc_p_uni_id) AS id FROM mcomments WHERE mc_p_uni_id = '$datas'");
                    $commentCount = $result1->fetch_all(MYSQLI_ASSOC);
                    $total = $commentCount[0]['id'];
                }
                ?>['<?php echo $datas; ?>', <?php echo $total; ?>],
                <?php
            }
            ?>
        ]);

        var options = {
            chart: {
                title: 'Comment statistic',
                subtitle: 'Comment',
            },
            bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material_1'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>