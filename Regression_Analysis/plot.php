<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Linear Regression</title>
		<!-- Bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<script src="bootstrap/js/jquery-1.11.3.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript"src="js/jquery.flot.min.js"></script>
		<script type="text/javascript"src="js/regression.min.js"></script>
		<script type="text/javascript"src="js/jquery.flot.axislabels.js"></script>
		
		<style type="text/css">
			.container2
			{
				margin: 0 auto;
				width: auto;
				max-width: 1170px;
				font-family: "Helvetica", sans-serif;
				text-align: center;
			}
			.graph
			{
				width: auto;
				max-width: 1170px;
				height: 500px;
			}
			td, th 
			{
				border: 1px solid #dddddd;
				text-align: center;
				padding: 8px;
			}
			th
			{
				background-color: #fbca12;
			}
			tr:nth-child(even) 
			{
				background-color: #ffcbab;
			}
		</style>
	</head>
<body>
	<?php 
		$max=$_POST['maximum_value'];
		$min=$_POST['minimum_value'];
	
		$plot=$_POST['Regression'];
		$plot_value = ucfirst($plot);

		//Reading the value from file and store into nested array
		if (($h = fopen("Dataset_Height_weight.csv", "r")) !== FALSE) 
		{
	  		while (($data = fgetcsv($h)) !== FALSE) 
	  		{
	    		$file_value[] = $data;		
	  		}
		  	fclose($h);
		}

		for ($i=$min; $i <= $max; $i++) 
		{ 
			$x[]=$file_value[$i][0];	//value in particular array
		}
	
		for ($i=$min; $i <= $max; $i++) 
		{ 
			$y[]=$file_value[$i][1];	//value in particular array
		}
		$n=count($y);
	?>
<div class="container">
	<script>
		var data = [
			<?php   for($i=0;$i<$n;$i++)
					{
						echo '[' . $x[$i] . ',' . $y[$i] . ']';
						if ($i<$n)
						{
							echo ',';
						}
					}
			?>
		];
		
		var options = {
					axisLabels: { show: true },
					xaxes: [{   axisLabel: '<?php echo $file_value[0][0] ?>', 
					 			axisLabelPadding: 13,
								axisLabelUseCanvas: true,
								axisLabelFontSizePixels: 20
							}],
					yaxes: [{   position: 'left', 
								axisLabelUseCanvas: true,
							    axisLabel: '<?php echo $file_value[0][1] ?>',
							    axisLabelPadding: 13,
							    axisLabelFontSizePixels: 20
							}]
					};		
		<?php 
		if($plot =="polynomial") 
		{
			$degree=$_POST['degree'];
		?>
		 	var myRegression = regression('<?php echo $plot;?>',data,<?php echo $degree; ?>);
			$(function()
			{	
			// Plot the result
			$.plot($('.graph'), [
				{data: myRegression.points, label: '<?php echo $plot;?>'},
				{data: data, lines: { show: false},points: {radius:4,show: true }}
	        ],options);

			// print the equation out
			$('h3').text(myRegression.string);
			});	
		<?php
		}
		else
		{
		?>
			var myRegression = regression('<?php echo $plot;?>',data);

			// Plot the result
			$(function()
			{
			$.plot($('.graph'), [
				{data: myRegression.points, label: '<?php echo $plot;?>'},
				{data: data, lines: { show: false},points: {radius:4,show: true }}
            	],options);

			// print the equation out
			$('h3').text(myRegression.string);
			});
		<?php 
		}
		?>				
	</script>
	<div class=container2>
		<h1><?php echo $plot_value; ?> Regression</h1>
		<h2 style="text-align: left;">Chart:</h2>
		<div class=graph></div>
		<h2 style="text-align: left;">Equation:</h2>
		<h3></h3>
	</div>
	<h2>Data:</h2>
	<h5>(Data coming from Database.)</h5><br>
	<table border="2" style="text-align: center;">

		<tr>
			<th>Sr. No</th>
			<th><?php echo $file_value[0][0]?></th>
			<th><?php echo $file_value[0][1]?></th>
		</tr>
		<?php
			for($i=0;$i<$n;$i++)
			{
		?>
				<tr>
					<td>
						<?php echo ($i+1);?>
					</td>
					<td>
						<?php echo $x[$i];?>
					</td>
					<td>
						<?php echo $y[$i];?>
					</td>
				</tr>
				<?php
			}
		?>		
	</table>
	
</div>
</body>
</html>