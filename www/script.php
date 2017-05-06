<?php 
	include("inc/core.php");

	function script(){
		global $db;
		$sql = "SELECT * FROM solution WHERE history!=''";
		$count = 0;
		$sel = mysqli_query($db, $sql);
		if(mysqli_num_rows($sel) > 0){
			$row = mysqli_fetch_assoc($sel);
			while($row = mysqli_fetch_assoc($sel)){
				$id = $row['id'];
				$count++;
				$date = time() + 60 * 60 * 24 * 365;
				$up = mysqli_query($db, "UPDATE solution SET date_clear_history='$date' WHERE id='$id'");
			}
			return $count;
		}
	}

	echo $a =  script();
?>