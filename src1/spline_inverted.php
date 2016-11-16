<?php
$myFile = "http://4me302-16.site88.net/data1.csv";
$fileArr = @file($myFile);
$newdata =  explode("\r",$fileArr[0]);

$comma='';

///$chart_arr = array();

if(count($newdata)>0)
{
	$chart_data = '[';
	foreach($newdata as $k=>$v)
	{
		if($k)
		{
			$linedata =  explode(",",$v);
			$chart_data .= $comma.'['.$linedata[0].','.$linedata[1].']';
			$comma = ',';
		}
		if($k>=10)
		{
			///break;
		}
	}
	$chart_data .= ']';
}

///echo "<pre>"; print_r($chart_data);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            chart: {
                type: 'spline',
                inverted: true
            },
            title: {
                text: 'Patient exercise data'
            },
            subtitle: {
                text: 'Chart of CSV data'
            },
            xAxis: {
                reversed: false,
                title: {
                    enabled: true,
                    text: 'Y-axis'
                },
                labels: {
                    
                },
                maxPadding: 0.05,
                showLastLabel: true
            },
            yAxis: {
                title: {
                    text: 'X-axis'
                },
                labels: {
                    
                },
                lineWidth: 2
            },
            legend: {
                enabled: false
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br/>',
                pointFormat: '{point.x} km: {point.y}°C'
            },
            plotOptions: {
                spline: {
                    marker: {
                        enable: false
                    }
                }
            },
            series: [{
                name: 'Temperature',
				data: <?php echo $chart_data;?>
                /*data: [[108,125], [108, 121], [107, 116], [103, 113], [99, 113],
                    [95, 116], [92, 120], [89, 124], [87, 130]]*/
            }]
        });
    });
    

		</script>
	</head>
	<body>
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

	</body>
</html>
