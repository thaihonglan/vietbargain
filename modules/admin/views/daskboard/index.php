<?php
/* @var $this yii\web\View */
// require('/../vendor/gapi13/gapi.class.php');
use dosamigos\chartjs\Chart;
require 'gapi.class.php';

?>

<style type="text/css">
#page-analtyics {
  clear: left;
}
#page-analtyics .metric_1 {
  background: #fefefe; /* Old browsers */
    background: -moz-linear-gradient(top, #fefefe 0%, #f2f3f2 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fefefe), color-stop(100%,#f2f3f2)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #fefefe 0%,#f2f3f2 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, #fefefe 0%,#f2f3f2 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, #fefefe 0%,#f2f3f2 100%); /* IE10+ */
    background: linear-gradient(top, #fefefe 0%,#f2f3f2 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefefe', endColorstr='#f2f3f2',GradientType=0 ); /* IE6-9 */
  border: 1px solid #ccc;
  float: left;
  font-size: 13px;
  margin: -4px 0 0em -1px;
  padding: 10px;
  width: 130px;
}
#page-analtyics .metric_2 {
  background: #fefefe; /* Old browsers */
    background: -moz-linear-gradient(top, #fefefe 0%, #f2f3f2 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fefefe), color-stop(100%,#f2f3f2)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #fefefe 0%,#f2f3f2 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, #fefefe 0%,#f2f3f2 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top, #fefefe 0%,#f2f3f2 100%); /* IE10+ */
    background: linear-gradient(top, #fefefe 0%,#f2f3f2 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefefe', endColorstr='#f2f3f2',GradientType=0 ); /* IE6-9 */
  border: 1px solid #ccc;
  float: left;
  font-size: 13px;
  margin: -4px 0 0em -1px;
  padding: 10px;
  width: 160px;
}
#page-analtyics .metric:hover {
  background: #fff;
  border-bottom-color: #b1b1b1;
}
#page-analtyics .metric .legend {
  background-color: #058DC7;
  border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
  font-size: 0;
  margin-right: 5px;
  padding: 10px 5px 0;
}
#page-analtyics .metric strong {
  font-size: 16px;
  font-weight: bold;
}
#page-analtyics .range {
  color: #686868;
  font-size: 11px;
  margin-bottom: 0px;
  width: 100%;
}
</style>

<?php
$ga_email = 'heruka.ga@gmail.com';
$ga_password = 'chanhatho';
$ga_profile_id = '94005637';
$ga_url = $_SERVER['REQUEST_URI'];

$ga = new gapi($ga_email,$ga_password);

// $ga->requestReportData(ga_profile_id,array('browser','browserVersion'),array('pageviews','visits'));

// $ga->requestReportData($ga_profile_id, array('date'), array('pageviews','visits'), 'date', 'pagePath == '.$ga_url);
$ga->requestReportData($ga_profile_id, array('date'), array('pageviews','visits'), 'date');

$results = $ga->getResults();
?>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Day');
    data.addColumn('number', 'Pageview');
<!-- Fill the chart with the data pulled from Analtyics. Each row matches the order setup by the columns: day then pageviews -->
    data.addRows([
      <?php
        foreach($results as $result) {
          echo '["'.date('Y-m-d',strtotime($result->getDate())).'", '.$result->getPageviews().'],';
        }
      ?>
    ]);

    var chart = new google.visualization.AreaChart(document.getElementById('chart_pageview'));
    chart.draw(data, {width: "85%", height: 200, title:
        '<?php echo date('Y-m-d',strtotime('-30 day')).' - '.date('m-d'); ?>',
                      colors:['#058dc7','#e6f4fa'],
                      areaOpacity: 0.1,
                      hAxis: {textPosition: 'in', showTextEvery: 5, slantedText: false, textStyle: 
                          { color: '#058dc7', fontSize: 10 } },
                      pointSize: 5,
                      legend: 'none',
                      chartArea:{left:0,top:30,width:"100%",height:"100%"}
    });
  }
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Day');
    data.addColumn('number', 'Visits');
<!-- Fill the chart with the data pulled from Analtyics. Each row matches the order setup by the columns: day then pageviews -->
    data.addRows([
      <?php
        foreach($results as $result) {
          echo '["'.date('Y-m-d',strtotime($result->getDate())).'", '.$result->getVisits().'],';
        }
      ?>
    ]);

    var chart = new google.visualization.AreaChart(document.getElementById('chart_visit'));
    chart.draw(data, {width: "85%", height: 200, title:
        '<?php echo date('Y-m-d',strtotime('-30 day')).' - '.date('m-d'); ?>',
                      colors:['#058dc7','#e6f4fa'],
                      areaOpacity: 0.1,
                      hAxis: {textPosition: 'in', showTextEvery: 5, slantedText: false, textStyle: 
                          { color: '#058dc7', fontSize: 10 } },
                      pointSize: 5,
                      legend: 'none',
                      chartArea:{left:0,top:30,width:"100%",height:"100%"}
    });
  }
</script>

<div style="text-align: center;"><h3>Pageviews Statistic</h3></div>
<div id="chart_pageview"></div>
<h2></h2>

<div style="text-align: center;"><h3>Visitors Statistic</h3></div>
<div id="chart_visit"></div>
<h2></h2>

<?php
$ga->requestReportData($ga_profile_id, 'date', array('pageviews', 'uniquePageviews', 'exitRate', 'avgTimeOnPage', 'entranceBounceRate', 'visits'), 'date');
$results = $ga->getResults();

function secondMinute($seconds) {
    $minResult = floor($seconds/60);
    if($minResult < 10){$minResult = 0 . $minResult;}
    $secResult = ($seconds/60 - $minResult)*60;
    if($secResult < 10){$secResult = 0 . round($secResult);}
    else { $secResult = round($secResult); }
    return $minResult.":".$secResult;
}
echo '<div id="page-analtyics">';
echo '<div class="metric_1" style="text-align: center;"><strong>Date</strong></div>';
echo '<div class="metric_1" style="text-align: center;"><strong>Pageviews</strong></div>';
echo '<div class="metric_2" style="text-align: center;"><strong>Unique pageviews</strong>'.'</div>';
echo '<div class="metric_1" style="text-align: center;"><strong>Visitors</strong></div>';
echo '<div class="metric_2" style="text-align: center;"><strong>Avg time on page</strong>'.'</div>';
echo '<div class="metric_1" style="text-align: center;"><strong>Bounce rate</strong>'.'%</div>';
echo '<div class="metric_1" style="text-align: center;"><strong>Exit rate</strong>'.'%</div>';
echo '<div style="clear: left;"></div>';

foreach($results as $result) {
    echo '<div class="metric_1" style="text-align: center;"><strong>'.date('Y-m-d',strtotime($result->getDate())).'</strong></div>';
    echo '<div class="metric_1" style="text-align: right;"><strong>'.number_format($result->getPageviews()).'</strong></div>';
    echo '<div class="metric_2" style="text-align: right;"><strong>'.number_format($result->getUniquepageviews()).'</strong></div>';
    echo '<div class="metric_1" style="text-align: right;"><strong>'.number_format($result->getVisits()).'</strong></div>';
    echo '<div class="metric_2" style="text-align: center;"><strong>'.secondMinute($result->getAvgtimeonpage()).'</strong></div>';
    echo '<div class="metric_1" style="text-align: center;"><strong>'.round($result->getEntrancebouncerate(), 2).'%</strong></div>';
    echo '<div class="metric_1" style="text-align: center;"><strong>'.round($result->getExitrate(), 2).'%</strong></div>';
    echo '<div style="clear: left;"></div>';
}

echo '<div class="metric_1" style="text-align: center;"><span><strong>Total</strong></span></div>';
echo '<div class="metric_1" style="text-align: right;"><span><strong>'.number_format($ga->getPageviews()).'</strong></span></div>';
echo '<div class="metric_2" style="text-align: right;"><span><strong>'.number_format($ga->getUniquepageviews()).'</strong></span>'.'</div>';
echo '<div class="metric_1" style="text-align: right;"><span><strong>'.number_format($ga->getVisits()).'</strong></span></div>';
echo '<div class="metric_2" style="text-align: center;"><span><strong>'.secondMinute($ga->getAvgtimeonpage()).'</strong></span>'.'</div>';
echo '<div class="metric_1" style="text-align: center;"><span><strong>'.round($ga->getEntrancebouncerate(), 2).'</strong></span>'.'%</div>';
echo '<div class="metric_1" style="text-align: center;"><span><strong>'.round($ga->getExitrate(), 2).'</strong></span>'.'%</div>';
echo '<div style="clear: left;"></div>';

echo '</div>';
?>


