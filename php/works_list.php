<?php
require "db.php";
if (isset($_POST['add_work'])) {
		$project_query = "INSERT INTO `project` VALUES(NULL,'".$_POST['project_name']."','".$_POST['project_date']."',false)";
		mysqli_query($link, $project_query);

		$get_project_id_query = "SELECT * FROM `project` ORDER BY `project_id` DESC LIMIT 1";
		$result = mysqli_query($link, $get_project_id_query);
		$project_id = mysqli_fetch_row($result)[0];

		$scope_of_work = array_filter($_POST['scope'], function($element) {
		    if ($element != "") return $element;
		});

		$projects_works_query ="";
		foreach (array_combine($_POST['work_id'], $scope_of_work) as $id => $scope) {
	    $projects_works_query = $projects_works_query."INSERT INTO `projects_works` VALUES (".$project_id.",".$id.",".$scope."); ";
		}

		mysqli_multi_query($link,$projects_works_query);
		header("Location: projects.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
        <title>Furniture</title>
</head>
<body>
<?php 
if(isset($_POST['name'])){
	$query = "INSERT INTO `works_list` VALUES(NULL, '".$_POST['name']."','".$_POST['price']."','".$_POST['unit']."')";
	mysqli_query($link, $query);
}
?>
<form method="POST" style="margin-bottom: 50px;">
	<label> Введіть назву роботи </label>
	<input name="name">
	<br>
	<label> Введіть одиницю виміру</label>
	<input name="unit">
	<br>
	<label> Введіть ціну за одиницю виміру</label>
	<input name="price">
	<br>
	<button type="submit"> Додати роботу </button>
</form>

<?php
	$query1 = "SELECT * FROM `works_list`";
	$request1 = mysqli_query($link, $query1);
	echo "<form method='POST' style='margin-bottom: 50px;'>";
		echo "<table>";
		 	echo "<tr>";
	            echo "<th>Назва роботи</th>";
	            echo "<th>Ціна роботи</th>";
	            echo "<th>Об'єм роботи</th>";
	            echo "<th>Вибрати</th>";
	        echo "</tr>";
		while($row = mysqli_fetch_array($request1)){
			echo"<tr>";
				echo"<td>{$row['work_name']}</td>";
				echo"<td>{$row['work_price']} грн./{$row['work_unit']}</td>";
				echo"<td><input name='scope[]'></td>";
				echo "<td><input type='checkbox' name='work_id[]' value='{$row['work_id']}'></td>";
			echo"</tr>";
		}
		echo "</table>";
		echo "<label>Назва проекту</label><input name='project_name'>";
		echo "<br>";
		echo "<label>Дата початку проекту</label><input name='project_date'>";
		echo "<br>";
		echo "<button type='submit' name='add_work'>Подтвердити вибір</button>";
	echo "</form>";
	
?>

</body>
</html>

