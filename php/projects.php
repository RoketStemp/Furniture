<?php
require "db.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Projects</title>
</head>
<body>
<?php
$get_projects_query = "SELECT * FROM `project`";
	$get_projects_result = mysqli_query($link, $get_projects_query) or die("Ошибка " . mysqli_error($link));

	echo "<form method='POST' style='margin-bottom: 50px;'>";
	$total=0;
	while ($row = mysqli_fetch_array($get_projects_result)) {
		echo "<div>{$row['project_name']}</div>";
		echo "<div>{$row['project_id']}</div>";
		echo "<div>{$row['start_project_date']}</div>";
		echo"<table>";
			echo "<tr>";
	            echo "<th>Назва роботи</th>";
	            echo "<th>Об'єм роботи</th>";
	            echo "<th>Ціна роботи</th>";
	        echo "</tr>";

	        $get_projects_works_query = "SELECT `projects_works`.`scope_of_work` AS 'SCOPE', `works_list`.`work_price` AS 'PRICE', `works_list`.`work_unit` AS 'UNIT', `works_list`.`work_name` AS 'NAME' FROM `projects_works` LEFT JOIN `works_list` ON `projects_works`.`work_id`=`works_list`.`work_id` WHERE `projects_works`.`project_id` = {$row['project_id']}";
	        $get_projects_works_result = mysqli_query($link, $get_projects_works_query);
	        while ($row2 = mysqli_fetch_array($get_projects_works_result)) {
	        	$total += doubleval($row2['PRICE'])*doubleval($row2['SCOPE']);
	        	echo "<tr>";
		            echo "<th>{$row2['NAME']}</th>";
		            echo "<th>{$row2['SCOPE']} {$row2['UNIT']}</th>";
		            echo "<th>".(doubleval($row2['PRICE'])*doubleval($row2['SCOPE']))." грн.</th>";
	       		echo "</tr>";
	        }
	        echo "<tr>";
	            echo "<th>Всього</th>";
	            echo "<th></th>";
	            echo "<th>{$total} грн.</th>";
	            $total=0;
       		echo "</tr>";
       		echo"</table>";
	}
       		
		
	echo "</form>";
?>
</body>
</html>