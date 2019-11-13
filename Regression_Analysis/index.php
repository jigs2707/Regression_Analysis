<?php
	if (($h = fopen("Dataset_Height_weight.csv", "r")) !== FALSE) 
	{
  		while (($data = fgetcsv($h)) !== FALSE) 
  		{
    		$file_value[] = $data;		
  		}
	  	fclose($h); 
	}
?>

<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Regression Analysis</title>

	    <!-- Bootstrap -->
	    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="bootstrap/js/jquery-1.11.3.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
	 			<p class="navbar-brand" href="#">Regression Analysis</p>
			</div>
		</nav>
			<br><br><br><br>
		<div class="container">
			<h1>Regression Analysis Example</h1>
			<h4>Here,You can implement Linear Regression, Polynomial Regression,Logarithmic Regression, Power Regression and Exponential Regression.
			<br>
			To Implement the Regression you have to enter Minimum and Maximum value between 1 to <?php echo count($file_value);?></h4><br>

			<form  name="form" id="Form" method="post" onsubmit="return compare()" action="plot.php" target="_blank">
			    <div class="input-group col-md-8">
					<span class="input-group-addon" id="basic-addon1">Minimum Value</span>
					<input name="minimum_value" id="minimumvalue" type="number" class="form-control" aria-describedby="basic-addon1" value="1" min="1">
				</div>
				<br>
				<div class="input-group col-md-8">
					<span class="input-group-addon" id="basic-addon1">Maximum Value</span>
					<input name="maximum_value" id="maximumvalue" type="number" class="form-control" aria-describedby="basic-addon1"  value="2" min="2" max="<?php echo count($file_value);?>">
				</div>
				<div class="input-group col-md-8">
					<h4>Choose type of regression you want to perform:</h4>
					 <div class="radio">
						<label><input type="radio" name="Regression" value="linear" Checked>Linear</label>&nbsp&nbsp&nbsp
					
						<label><input type="radio" name="Regression" value="polynomial">Polynomial</label>&nbsp&nbsp&nbsp
					
						<label><input type="radio" name="Regression" value="logarithmic">Logarithmic</label>&nbsp&nbsp&nbsp
					
						<label><input type="radio" name="Regression" value="power">Power</label>&nbsp&nbsp&nbsp
					
						<label><input type="radio" name="Regression" value="exponential">Exponential</label>
					</div>
						
			 		<div class="input-group col-md-8" id="degree" style="display: none">
					<span class="input-group-addon" id="basic-addon1">Degree</span>
					<input name="degree" type="number" class="form-control" aria-describedby="basic-addon1" value="2" min="2">
				</div>
				<br>
				</div>
				<button type="submit" id="submit" class="btn btn-default" >Plot</button>
			</form>
		</div>

		<script type="text/javascript">
			$(function() {
			    $('input[name="Regression"]').on('click', function() {
			        if ($(this).val() == 'polynomial') {
			            $('#degree').show();
			        }
			        else {
			            $('#degree').hide();
			        }
			    });
			});

			function compare() {
			  var a = document.getElementById('minimumvalue').value;
			  a = parseFloat(a);
			  var b = document.getElementById('maximumvalue').value;
			  b = parseFloat(b);
			  
			  if(a > b) 
			  {
			    alert("Maximum Value should not be less than Minimum Value");
			    return false;
			  } else if(a < b) {	return true;  } 
			}
		</script>
	</body>
</html>