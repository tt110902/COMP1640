<?php include "connection.php"; ?>
<html>

<div class="bar">

    <head>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Post', 'Like ', 'Dislike'],
                    <?php
                    $query = "select * from poster";
                    $res = mysqli_query($conn, $query);
                    while ($data = mysqli_fetch_array($res)) {
                        $p_name = $data['p_name'];
                        $view = $data['view'];
                    ?>['<?php echo $p_name; ?>', <?php echo $view; ?>],
                    <?php
                    }
                    ?>
                ]);

                var options = {
                    chart: {
                        title: 'Post statistic',
                        subtitle: 'Like , dislike_count',
                    },
                    bars: 'vertical' // Required for Material Bar Charts.
                };

                var chart = new google.charts.Bar(document.getElementById('barchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
    </head>

    <body>
        <br>
        <div id="main-content" class="container allContent-section py-6" style="margin-left:20%">
            <div id="barchart_material" style="width: 900px; height: 500px;"></div>
        </div>
    </body>
</div>