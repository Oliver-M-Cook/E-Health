<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Graphs</title>
    <!-- loads the AJAXapi google graphs -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
    <script type="text/javascript">
    // loads the packages that are needed for the graphs to function
    google.charts.load('current', {'packages':['corechart']});

    // Once the api is loaded it calls these functions which draw the graph
    google.charts.setOnLoadCallback(drawChartOne);
    google.charts.setOnLoadCallback(drawChartTwo);
    google.charts.setOnLoadCallback(drawChartThree);
    google.charts.setOnLoadCallback(drawChartFour);

    /* 
    Function draws chartOne with the data that was passed through the controller
    the graph will show the amount of questionaires that are rejected, accepted, pending
    */
    function drawChartOne(){
        <?php
        echo <<<_END
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Status');
        data.addColumn('number', 'Status Count');
        data.addRows([
        _END;
        foreach($chartOne as $entry){
            echo "['{$entry['title']}', {$entry['value']}],";
        }
        echo <<<_END
        ]);
        _END;
        ?>
        var options = {title:'Questionaire Status Distribution',
                        width:400,
                        height:300};
        
        // creates the chart, setting the type of chart and selecting where it is drawn
        var chart = new google.visualization.PieChart(document.getElementById('graphOne'));

        // takes the data and options provided and draws the chart
        chart.draw(data, options);
    }

    /* 
    Function that is very similar to the first chart, it uses diffent data and is displayed
    in a different format.
    The graph will the avg alcohol audit score in different age groups
    */
    function drawChartTwo(){
        <?php
        echo <<<_END
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Avg Alcohol Score');
        data.addColumn('number', 'Avg Score');
        data.addRows([
        _END;
        foreach($chartTwo as $entry){
            echo "['{$entry['title']}', {$entry['value']}],";
        }
        echo <<<_END
        ]);
        _END;
        ?>
        var options = {title:'Age Groups Average Audit Score',
                        width:400,
                        height:300};
        var chart = new google.visualization.BarChart(document.getElementById('graphTwo'));
        chart.draw(data, options);
    }

    /* 
    Function will draw the third graph which will show the amount of 
    patients who are smoking or quit or never smoked
    */
    function drawChartThree(){
        <?php
        echo <<<_END
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Smoking Status');
        data.addColumn('number', 'Status Count');
        data.addRows([
        _END;
        foreach($chartThree as $entry){
            echo "['{$entry['title']}', {$entry['value']}],";
        }
        echo <<<_END
        ]);
        _END;
        ?>
        var options = {title:'Patient Smoking Distribution',
                        width:400,
                        height:300};

        var chart = new google.visualization.PieChart(document.getElementById('graphThree'));
        chart.draw(data, options);
    }

    /* 
    Function will draw the fourth chart which shows the diet of each patient 
    so that the admin can see if there is an inflation in bad diets
    */
    function drawChartFour(){
        <?php
        echo <<<_END
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Diet');
        data.addColumn('number', 'Diet_Count');
        data.addRows([
        _END;
        foreach($chartFour as $entry){
            echo "['{$entry['title']}', {$entry['value']}],";
        }
        echo <<<_END
        ]);
        _END;
        ?>
        var options = {title:'Patient Diet Distribution',
                        width:400,
                        height:300};

        var chart = new google.visualization.PieChart(document.getElementById('graphFour'));
        chart.draw(data, options);
    }
    </script>
</head>
<body>
    <table>
        <tr>
            <td>
            <!-- location for graph one -->
            <div id="graphOne"></div>
            </td>
            <td>
            <!-- location for graph two -->
            <div id="graphTwo"></div>
            </td>
        </tr>
        <tr>
            <td>
            <!-- location for graph three -->
            <div id="graphThree"></div>
            </td>
            <td>
            <!-- location for graph four -->
            <div id="graphFour"></div>
            </td>
        </tr>
    </table>
    <!-- creates a button that returns the admin back to the dashboard -->
    <button type="button" onclick="location.href='<?php echo base_url('index.php/Dashboard')?>'">Dashboard</button>
</body>
</html>