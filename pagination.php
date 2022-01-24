<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pagination</title>
</head>
<body>
	<?php 
		//Step 1: Connect to database 
		$con = mysqli_connect("localhost", "root", "");
		mysqli_select_db($con, 'pagination');

		// Step 2: Define how many results you want per page
		$results_per_page = 6;

		// Step 3: Find out the number of results stored in database
		$sql = "SELECT * FROM alphabet";
		$results = mysqli_query($con, $sql);
		echo $number_of_results = mysqli_num_rows($results); //to viewthe total number
		echo "<br> <br>";

		// while ($row = mysqli_fetch_array($results)) {
		// 	// to fetch all data
		// 	echo $row['id'] . ' ' . $row['alphabet'] . ' '. '<br>';
		// }
		// echo "<br> <br>";
		// we commented this out since we now used step7

		// Step 4: Determine the number of total pages available
		echo $number_of_pages = ceil($number_of_results/$results_per_page);
		echo "<br> <br>";

		// Step 5: Determine which page number visitor is currently on
		if(!isset($_GET['page'])) {
			$page = 1;
		}
		else {
			$page = $_GET['page'];
		}

		// Step 6: Determine the sql LIMIT starting number for the results on the displaying page
		// To determine the starting limit number: starting_limit_number =(page_number -1) * results_per_page
		echo $this_page_first_result = ($page - 1) * $results_per_page;

		// Step 7: Retrieve selected results from databse and display them on page
		$sql = "SELECT * FROM alphabet LIMIT " . $this_page_first_result . "," . $results_per_page;
		$results = mysqli_query($con, $sql);
		while ($row = mysqli_fetch_array($results)) {
			// to fetch all data
			echo $row['id'] . ' ' . $row['alphabet'] . ' '. '<br>';
		}

		// Step 8: Display the link to the pages  
		for ($page=1; $page <= $number_of_pages; $page++) { 
			echo '<a href="pagination.php?page=' . $page. '">'. $page . '</a> ';
		}
	?>
</body>
</html>