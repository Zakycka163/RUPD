<?php 
	function read($uploadfile, $file_type) {
		require_once ($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
		$reader->setReadDataOnly(TRUE);
		$spreadsheet = $reader->load($uploadfile);

		$worksheet = $spreadsheet->getActiveSheet();
		// Get the highest row numbers
		$highestRow = $worksheet->getHighestRow(); // e.g. 10
		// Get highest column numbers
		
		switch ($file_type) {
			
			case "teachers":
				$highestColumn = 'G'; // e.g 'F'
				$highestColumn++;
		
				for ($row = 2; $row <= $highestRow; ++$row) {
					$sql_insert = "INSERT INTO `teachers` (`second_name`, `first_name`, `middle_name`, `email`, `academic_rank_id`, `academic_degree_id`) VALUES (";
					$sql_insert2 = "INSERT INTO `teacher_positions` (`position_id`, `teacher_id`, `main_position`) VALUES (";
					
					unset($teacher_info);
					$teacher_info = array('1');
		
					for ($col = 'A'; $col != $highestColumn; ++$col) {
						$value = $worksheet->getCell($col . $row)->getValue();
		
						if (($col == 'A') or ($col == 'B') or ($col == 'C')) {
							$teacher_info[] = ''.$value.'';
							$sql_insert .= "'".$value."', ";
						} elseif ($col == 'E') {
							connect();
							global $link;
							$result = mysqli_query($link, "SELECT academic_rank_id FROM academic_ranks WHERE UPPER(full_name) = UPPER('".$value."')");
							if (mysqli_num_rows($result) == 0) {
								$sql_insert .= "null, ";
							} else {
								while($p1 = mysqli_fetch_array($result)){$sql_insert .= "'".$p1[0]."', "; }
							}
							close();
						} elseif ($col == 'F') {
							connect();
							global $link;
							$result = mysqli_query($link, "SELECT academic_degree_id FROM academic_degrees WHERE UPPER(short_name) = UPPER('".$value."')");
							if (mysqli_num_rows($result) == 0) {
								$sql_insert .= "null";
							} else {
								while($p1 = mysqli_fetch_array($result)){$sql_insert .= "'".$p1[0]."'"; }
							}
							close();
						} elseif ($col == 'G') {
							connect();
							global $link;
							$result = mysqli_query($link, "SELECT position_id FROM positions WHERE `name` = '".$value."'");
							if (mysqli_num_rows($result) == 0) {
								$result = mysqli_query($link, "INSERT INTO `positions` (`name`) VALUES ('".$value."')");
								$result = mysqli_query($link, "SELECT position_id FROM positions WHERE `name` = '".$value."'");
							}
							if (mysqli_num_rows($result) == 0) {
								$sql_insert2 .= "null, ";
							} else {
								while($p1 = mysqli_fetch_array($result)){$sql_insert2 .= "'".$p1[0]."', "; }
							}
							close();
						} else {
							$sql_insert .= "'".$value."', ";
						}
					};
					$sql_insert .= ')'.PHP_EOL;
					connect();
					global $link;
					#echo $sql_insert;
					#$result = mysqli_query($link, $sql_insert); <---------------необходимо разкомментировать
					$result = mysqli_query($link, "SELECT teacher_id FROM teachers WHERE second_name = '".$teacher_info[1]."' AND first_name = '".$teacher_info[2]."' AND middle_name = '".$teacher_info[3]."'");
					if (mysqli_num_rows($result) == 0) {
						$sql_insert2 .= "null, ";
					} else {
						while($p1 = mysqli_fetch_array($result)){$sql_insert2 .= "'".$p1[0]."', ";  };
					}
					$sql_insert2 .= '1)'.PHP_EOL;
					#echo $sql_insert2;
					#$result = mysqli_query($link, $sql_insert2); <---------------необходимо разкомментировать
					close();
				};
				break;

			case "disciplines":	
				$maxColumn = 'G';
				$highestColumn++;
		
				for ($row = 2; $row <= $highestRow; ++$row) {
					$sql_insert = "INSERT INTO `disciplines` (`pulpit_id`, `name`, `part_id`, `module_id`, `index_info`, `time`) VALUES (";
		
					for ($col = 'A'; $col != $highestColumn; ++$col) {
						$value = $worksheet->getCell($col . $row)->getValue();
		
						if ($col == 'A') {
							connect();
							global $link;
							$result = mysqli_query($link, "SELECT institute_id FROM institutes WHERE UPPER(name) = UPPER('".$value."')");
							if (mysqli_num_rows($result) == 0) {
								$result = mysqli_query($link, "INSERT INTO `institutes` (`name`) VALUES ('".$value."')");
								$result = mysqli_query($link, "SELECT institute_id FROM institutes WHERE `name` = '".$value."'");
							};
							if (mysqli_num_rows($result) == 0) {
								$sql_insert .= "null, ";
							} else {
								while($p1 = mysqli_fetch_array($result)){$inst_id = "'".$p1[0]."', "; };
							};
							close();
						} elseif ($col == 'B') {
							connect();
							global $link;
							$result = mysqli_query($link, "SELECT pulpit_id FROM pulpits WHERE UPPER(name) = UPPER('".$value."') AND institute_id = ".$inst_id."");
							if (mysqli_num_rows($result) == 0) {
								$result = mysqli_query($link, "INSERT INTO `pulpits` (`institute_id`, `name`) VALUES (".$inst_id.",'".$value."')");
								$result = mysqli_query($link, "SELECT pulpit_id FROM pulpits WHERE `name` = '".$value."' AND institute_id = ".$inst_id."");
							};
							if (mysqli_num_rows($result) == 0) {
								$sql_insert .= "null, ";
							} else {
								while($p1 = mysqli_fetch_array($result)){$sql_insert .= "'".$p1[0]."', "; };
							};
							close();
						} elseif ($col == 'D') {
							$sql_insert .= "".$value.", ";
						} elseif ($col == 'F') {
							connect();
							global $link;
							$result = mysqli_query($link, "SELECT module_id FROM modules WHERE UPPER(name) = UPPER('".$value."')");
							if (mysqli_num_rows($result) == 0) {
								$result = mysqli_query($link, "INSERT INTO `modules` (`name`) VALUES ('".$value."')");
								$result = mysqli_query($link, "SELECT module_id FROM modules WHERE `name` = '".$value."'");
							};
							if (mysqli_num_rows($result) == 0) {
								$sql_insert .= "null, ";
							} else {
								while($p1 = mysqli_fetch_array($result)){$sql_insert .= "'".$p1[0]."', "; };
							};
							close();
						} else {
							$sql_insert .= "'".$value."', ";
						}
					};
					$sql_insert .= ')' . PHP_EOL;
					echo $sql_insert;
					#$result = mysqli_query($link, $sql_insert); <---------------необходимо разкомментировать
				};
				break;

			case "profstandards_otf_tf_activities":	
				$maxColumn = 'L';
				$highestColumn++;
				
				
				break;

			case "courses_fgos_profstandards":	
				$maxColumn = 'M';
				$highestColumn++;
				
				
				break;
		};
	};	
?> 