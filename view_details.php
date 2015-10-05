<?php
	session_start();
	include 'header.php';
	include "dbcon.php";
	if(!isset($_SESSION['login-user'])){
        header("location: index.php");
    }

    $election_id = $_GET['view_details'];
    $election_name = '';
    $position_name = '';
    //echo $election_id;
    $details = mysql_query("SELECT * FROM `elections` AS E join `election_users` as EU on E.election_id = EU.election_id join `positions` AS P on E.position_id = P.position_id join `users` AS U on EU.user_id = U.user_id WHERE E.election_id = $election_id");

    
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    	google.load('visualization', '1', {packages: ['corechart', 'bar']});
		google.setOnLoadCallback(drawChart);
		function drawChart() {

	      // Create the data table.
	      var data = google.visualization.arrayToDataTable([
	      	['Nominees', 'Votes', { role: 'style' }],
	      <?php
	      	while($iter = mysql_fetch_assoc($details)){
	      		$election_name = $iter['election_name'];
	      		$position_name = $iter['position_name'];
	      		$name = $iter['fname'].' '.$iter['lname'];
	      		$votes = $iter['votes'];
	      		echo "['$name', $votes, 'blue'],";
	      	}
	      ?>
      ]);

      // Set chart options
      var options = {'title':'Votes Distribution Table',
                     'width':600,
                     'height':400};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
      chart.draw(data, options);

    }
    </script>

</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="index.php">IIITM Student Election</a>
            </div>
             <ul class="nav navbar-nav">
             <li>
                       <a href="logout.php"><button class="btn btn-sm btn-danger" href="logout.php">Logout</button></a>
                    </li>
                   </ul>

        </div>
    </nav>
</br>
	<div class="container">
		<div>
			<h2>Details of <?php echo $election_name?> for Position of <?php echo $position_name ?></h2>
		</div>
		<div id="chart_div"></div>
	</div>
</body>