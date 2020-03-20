<?php 
	require_once ($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");
	require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");

	$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
	$reader->setReadDataOnly(TRUE);
	$spreadsheet = $reader->load($_POST["uploadfile"]);

	$worksheet = $spreadsheet->getActiveSheet();
	// Get the highest row numbers
	$highestRow = $worksheet->getHighestRow(); // e.g. 10
	// Get highest column numbers
	
	switch ($_POST["file_type"]) {
		
		case "teachers":
			$highestColumn = 'G'; // e.g 'F'
			$highestColumn++;
	
			for ($row = 2; $row <= $highestRow; ++$row) {
				$teachers_insert = "INSERT INTO `teachers` (`second_name`, `first_name`, `middle_name`, `email`, `academic_rank_id`, `academic_degree_id`) VALUES (";
				$teacher_positions_insert = "INSERT INTO `teacher_positions` (`position_id`, `teacher_id`, `main_position`) VALUES (";
				
				unset($teacher_info);
				$teacher_info = array('1');
	
				for ($col = 'A'; $col != $highestColumn; ++$col) {
					$value = $worksheet->getCell($col . $row)->getValue();
	
					if (($col == 'A') or ($col == 'B') or ($col == 'C')) {
						$teacher_info[] = ''.$value.'';
						$teachers_insert .= "'".$value."', ";
					} elseif ($col == 'D') {
						$teachers_insert .= "'".$value."', ";
					} elseif ($col == 'E') {
						connect();
						global $link;
						$result = mysqli_query($link, "SELECT 	MAX(academic_rank_id)
													   FROM 	academic_ranks 
													   WHERE 	UPPER(full_name) = UPPER('".$value."')");
						if (mysqli_num_rows($result) == 0) {
							$teachers_insert .= "null, ";
						} else {
							while($p1 = mysqli_fetch_array($result)) {
								$teachers_insert .= "'".$p1[0]."', ";  
							}
						}
						close();
					} elseif ($col == 'G') {
						connect();
						global $link;
						$result = mysqli_query($link, "SELECT 	MAX(academic_degree_id)
													   FROM 	academic_degrees 
													   WHERE 	UPPER(short_name) = UPPER('".$value."')");
						if (mysqli_num_rows($result) == 0) {
							$teachers_insert .= "null";
						} else {
							while($p1 = mysqli_fetch_array($result)) {
								$teachers_insert .= "'".$p1[0]."'"; 
							}
						}
						close();
					} elseif ($col == 'F') {
						connect();
						global $link;
						/*SELECT 
							TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(parse.value, ',', NS.n), ',', -1)) as pos_values
						FROM
							(SELECT 1 as n UNION ALL
							SELECT 2 UNION ALL
							SELECT 3 UNION ALL
							SELECT 4 UNION ALL
							SELECT 5) NS
						INNER JOIN 
							(SELECT 'старший преподаватель, доцент, ведущий научный сотрудник' as value FROM DUAL) parse
						ON NS.n <= CHAR_LENGTH(parse.value) - CHAR_LENGTH(REPLACE((parse.value),',',''))+1*/
						$result = mysqli_query($link, "SELECT 	MAX(position_id)
													   FROM 	positions 
													   WHERE 	`name` = '".$value."'");
						if (mysqli_num_rows($result) == 0) {
							mysqli_query($link, "INSERT INTO positions (`name`) VALUES ('".$value."')");
							$result = mysqli_query($link, "SELECT 	MAX(position_id)
														   FROM 	positions 
														   WHERE 	`name` = '".$value."'");
						}
						if (mysqli_num_rows($result) == 0) {
							$teacher_positions_insert .= "null, ";
						} else {
							while($p1 = mysqli_fetch_array($result)) {
								$teacher_positions_insert .= "'".$p1[0]."', "; 
							}
						}
						close();
					}
				}
				$teachers_insert .= ')'.PHP_EOL;
				connect();
				global $link;
				#echo $teachers_insert;
				mysqli_query($link, $teachers_insert);
				if ($link->error) {
					try {   
						throw new Exception("MySQL error $link->error <br> Query:<br> $teachers_insert", $link->errno);   
					} catch(Exception $e ) {
						echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
						echo nl2br($e->getTraceAsString());
					}
				} else {
					echo '';
				}

				$result = mysqli_query($link, "SELECT 	MAX(teacher_id)
											   FROM 	teachers 
											   WHERE 	second_name = '".$teacher_info[1]."' 
											   		AND first_name  = '".$teacher_info[2]."' 
													AND middle_name = '".$teacher_info[3]."'");
				if (mysqli_num_rows($result) == 0) {
					$teacher_positions_insert .= "null, ";
				} else {
					while($p1 = mysqli_fetch_array($result)) {
						$teacher_positions_insert .= "'".$p1[0]."', ";  
					}
				}
				$teacher_positions_insert .= '1)'.PHP_EOL;
				#echo $teacher_positions_insert;
				mysqli_query($link, $teacher_positions_insert);
				if ($link->error) {
					try {   
						throw new Exception("MySQL error $link->error <br> Query:<br> $teacher_positions_insert", $link->errno);   
					} catch(Exception $e ) {
						echo "Error No: ".$e->getCode(). " - ". $e->getMessage() . "<br >";
						echo nl2br($e->getTraceAsString());
					}
				} else {
					echo '';
				}
				close();
			}
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
						$result = mysqli_query($link, "SELECT 	MAX(institute_id)
													   FROM 	institutes 
													   WHERE 	UPPER(name) = UPPER('".$value."')");
						if (mysqli_num_rows($result) == 0) {
							mysqli_query($link, "INSERT INTO `institutes` (`name`) VALUES ('".$value."')");
							$result = mysqli_query($link, "SELECT 	MAX(institute_id)
														   FROM 	institutes 
														   WHERE 	`name` = '".$value."'");
						};
						if (mysqli_num_rows($result) == 0) {
							$sql_insert .= "null, ";
						} else {
							while($p1 = mysqli_fetch_array($result)) {
								$inst_id = "'".$p1[0]."', "; 
							}
						}
						close();
					} elseif ($col == 'B') {
						connect();
						global $link;
						$result = mysqli_query($link, "SELECT 	MAX(pulpit_id)
													   FROM 	pulpits 
													   WHERE 	UPPER(name) = UPPER('".$value."') 
													   		AND institute_id = ".$inst_id."");
						if (mysqli_num_rows($result) == 0) {
							mysqli_query($link, "INSERT INTO `pulpits` (`institute_id`, `name`) VALUES (".$inst_id.",'".$value."')");
							$result = mysqli_query($link, "SELECT 	MAX(pulpit_id)
														   FROM 	pulpits 
														   WHERE 	`name` = '".$value."' 
														   		AND institute_id = ".$inst_id."");
						};
						if (mysqli_num_rows($result) == 0) {
							$sql_insert .= "null, ";
						} else {
							while($p1 = mysqli_fetch_array($result)) {
								$sql_insert .= "'".$p1[0]."', "; 
							}
						}
						close();
					} elseif (($col == 'C') or ($col == 'F')) {
						$sql_insert .= "'".$value."', ";
					} elseif ($col == 'D') {
						$sql_insert .= "".$value.", ";
					} elseif ($col == 'E') {
						connect();
						global $link;
						$result = mysqli_query($link, "SELECT 	MAX(module_id)
													   FROM 	modules 
													   WHERE 	UPPER(name) = UPPER('".$value."')");
						if (mysqli_num_rows($result) == 0) {
							mysqli_query($link, "INSERT INTO `modules` (`name`) VALUES ('".$value."')");
							$result = mysqli_query($link, "SELECT 	MAX(module_id)
														   FROM 	modules 
														   WHERE 	`name` = '".$value."'");
						}
						if (mysqli_num_rows($result) == 0) {
							$sql_insert .= "null, ";
						} else {
							while($p1 = mysqli_fetch_array($result)) {
								$sql_insert .= "'".$p1[0]."', "; 
							}
						}
						close();
					} elseif ($col == 'G') {
						$sql_insert .= "".$value."";
					}
				}
				$sql_insert .= ')' . PHP_EOL;
				#echo $sql_insert;
				mysqli_query($link, $sql_insert);
			}
			break;

		case "profstandards_otf_tf_activities":
			$maxColumn = 'L';
			$highestColumn++;
			
			for ($row = 2; $row <= $highestRow; ++$row) {
				$sql_insert = "INSERT INTO `general_work_functions` (`code`, `name`, `level`, `prof_standard_id`) VALUES (";
				$sql_insert2 = "INSERT INTO `work_functions` (`code`, `name`, `general_work_function_id`) VALUES (";
				$sql_insert3 = "INSERT INTO `competencies` (`competence_type_id`, `number`, `name`, `fgos_id`) VALUES (";
				$sql_insert4 = "INSERT INTO `activities` (`activity_type_id`, `name`, `work_function_id`, `competence_id`) VALUES (";
				
				unset($prof_standard_info);
				$prof_standard_info = array('1');
				unset($otf_info);
				$otf_info = array('1');
				unset($tf_info);
				$tf_info = array('1');
				unset($competence_info);
				$competence_info = array('1');

				for ($col = 'A'; $col != $highestColumn; ++$col) {
					$value = $worksheet->getCell($col . $row)->getValue();
	
					if (($col == 'A') or ($col == 'B')) {
						$prof_standard_info[] = ''.$value.'';
					} elseif (($col == 'C') or ($col == 'D') or ($col == 'E')) {
						$otf_info[] = ''.$value.'';
						$sql_insert .= "'".$value."', ";
					} elseif (($col == 'F') or ($col == 'G')) {
						$tf_info[] = ''.$value.'';
						$sql_insert2 .= "'".$value."', ";
					} elseif (($col == 'H')) {
						$sql_insert4_1 = $sql_insert4;
						connect();
						global $link;
						$result = mysqli_query($link, "SELECT 	MAX(activity_type_id)
													   FROM 	activity_types 
													   WHERE 	UPPER(name) = UPPER('Необходимые знания')");
						while($p1 = mysqli_fetch_array($result)) {
							$sql_insert4_1 .= "'".$p1[0]."', "; 
						}
						close();
						$sql_insert4_1 .= "'".$value."', ";
					} elseif (($col == 'I')) {
						$sql_insert4_2 = $sql_insert4;
						connect();
						global $link;
						$result = mysqli_query($link, "SELECT 	MAX(activity_type_id)
													   FROM 	activity_types 
													   WHERE 	UPPER(name) = UPPER('Необходимые умения')");
						while($p1 = mysqli_fetch_array($result)) {
							$sql_insert4_2 .= "'".$p1[0]."', "; 
						}
						close();
						$sql_insert4_2 .= "'".$value."', ";
					} elseif (($col == 'J')) {
						$sql_insert4_3 = $sql_insert4;
						connect();
						global $link;
						$result = mysqli_query($link, "SELECT 	MAX(activity_type_id)
													   FROM 	activity_types 
													   WHERE 	UPPER(name) = UPPER('Трудовые действия')");
						while($p1 = mysqli_fetch_array($result)) {
							$sql_insert4_3 .= "'".$p1[0]."', "; 
						}
						close();
						$sql_insert4_3 .= "'".$value."', ";
					} elseif (($col == 'K')) {
						connect();
						global $link;
						$result = mysqli_query($link, "SELECT 	MAX(competence_type_id), SUBSTRING_INDEX('".$value."','-',-1)
													   FROM 	competence_types 
													   WHERE 	code = SUBSTRING_INDEX('".$value."','-',-1)");
						while($p1 = mysqli_fetch_array($result)) {
							$competence_info[] = ''.$p1[0].'';
							$competence_info[] = ''.$p1[1].'';
							$sql_insert3 .= "'".$p1[0]."', '".$p1[1]."', "; 
						}
						close();
					} elseif (($col == 'L')) {
						$competence_info[] = ''.$value.'';
						$sql_insert3 .= "'".$value."', ";
					}
				}
				connect();
				global $link;
				$result = mysqli_query($link, "SELECT 	MAX(prof_standard_id) 
											   FROM 	prof_standards 
											   WHERE 	`code` = '".$prof_standard_info[1]."' 
											   		AND `name` = '".$prof_standard_info[2]."'");
				if (mysqli_num_rows($result) == 0) {
					$sql_insert .= "null";
				} else {
					while($p1 = mysqli_fetch_array($result)) {
						$sql_insert .= "'".$p1[0]."'"; 
					}
				}
				$sql_insert .= ')' . PHP_EOL;
				#echo $sql_insert;
				mysqli_query($link, $sql_insert);
				$result = mysqli_query($link, "SELECT 	MAX(general_work_function_id)
											   FROM 	general_work_functions 
											   WHERE 	`code`  = '".$otf_info[1]."' 
											   		AND `name`  = '".$otf_info[2]."' 
													AND `level` = '".$otf_info[3]."'");
				if (mysqli_num_rows($result) == 0) {
					$sql_insert2 .= "null";
				} else {
					while($p1 = mysqli_fetch_array($result)) {
						$sql_insert2 .= "'".$p1[0]."'"; 
					}
				}
				$sql_insert2 .= ')' . PHP_EOL;		
				#echo $sql_insert2;
				mysqli_query($link, $sql_insert2);
				$result = mysqli_query($link, "SELECT 	fg.fgos_id
													  , MAX(prof.prof_standard_id) 
											   FROM 	prof_standards 	prof
											   		  , fgos 			fg
											   WHERE 	prof.code 		= '".$prof_standard_info[1]."' 
													AND prof.name 		= '".$prof_standard_info[2]."'
													AND prof.fgos_id 	= fg.fgos_id"); # <---------------если не отработает, выкинуть таблицу fgos из запроса
				if (mysqli_num_rows($result) == 0) {
					$sql_insert3 .= "null";
				} else {
					while($p1 = mysqli_fetch_array($result)) {
						$sql_insert3 .= "'".$p1[0]."'"; 
					}
				}
				$sql_insert3 .= ')' . PHP_EOL;
				#echo $sql_insert3;
				mysqli_query($link, $sql_insert3);
				$result = mysqli_query($link, "SELECT 	MAX(tf.work_functions_id)
											   FROM 	work_functions 				tf
											   		  , general_work_functions 		otf
											   WHERE 	tf.code 					= '".$tf_info[1]."' 
													AND tf.name 					= '".$tf_info[2]."'
													AND tf.general_work_function_id = otf.general_work_function_id
													AND otf.code 					= '".$otf_info[1]."'
													AND otf.name 					= '".$otf_info[2]."'
													AND otf.level 					= '".$otf_info[3]."'");
				if (mysqli_num_rows($result) == 0) {
					$sql_insert4 = "null";
				} else {
					while($p1 = mysqli_fetch_array($result)) {
						$sql_insert4 = "'".$p1[0]."'"; 
					}
				}
				$result = mysqli_query($link, "SELECT 	MAX(comp.competence_id)
											   FROM 	competencies 				comp
											   		  , prof_standards 				prof
													  , fgos						fg
											   WHERE 	prof.code 					= '".$prof_standard_info[1]."' 
													AND prof.name 					= '".$prof_standard_info[2]."'
													AND prof.fgos_id 				= fg.fgos_id
													AND fg.fgos_id					= comp.fgos_id
													AND comp.competence_type_id		= '".$competence_info[1]."' 
													AND comp.number 				= '".$competence_info[2]."'
													AND comp.name 					= '".$competence_info[3]."'"); # <---------------тут может быть ошибка
				if (mysqli_num_rows($result) == 0) {
					$sql_insert4 .= "null";
				} else {
					while($p1 = mysqli_fetch_array($result)) {
						$sql_insert4 .= "'".$p1[0]."'"; 
					}
				}
				$sql_insert4 .= ')' . PHP_EOL;
				$sql_insert4_1 .= $sql_insert4;
				$sql_insert4_2 .= $sql_insert4;
				$sql_insert4_3 .= $sql_insert4;
				#echo $sql_insert4_1;
				#echo $sql_insert4_2;
				#echo $sql_insert4_3;
				mysqli_query($link, $sql_insert4_1);
				mysqli_query($link, $sql_insert4_2);
				mysqli_query($link, $sql_insert4_3);
				close();
			}
			break;

		case "courses_fgos_profstandards":	
			$maxColumn = 'M';
			$highestColumn++;
			
			for ($row = 2; $row <= $highestRow; ++$row) {
				$sql_insert = "INSERT INTO `courses` (`number`, `name`, `qualification_id`) VALUES (";
				$sql_insert2 = "INSERT INTO `fgos` (`number`, `date`, `reg_number`, `reg_date`, `course_id`) VALUES (";
				$sql_insert3 = "INSERT INTO `prof_standards` (`code`, `name`, `number`, `date`, `reg_number`, `reg_date`, `fgos_id`) VALUES (";
				
				unset($course_info);
				$course_info = array('1');
				unset($fgos_info);
				$fgos_info = array('1');

				for ($col = 'A'; $col != $highestColumn; ++$col) {
					$value = $worksheet->getCell($col . $row)->getValue();
	
					if (($col == 'A') or ($col == 'B')) {
						$course_info[] = ''.$value.'';
						$sql_insert .= "'".$value."', ";
					} elseif ($col == 'C') {
						$sql_insert .= "".$value."";
					} elseif (($col == 'D') or ($col == 'E') or ($col == 'F') or ($col == 'G')) {
						$fgos_info[] = ''.$value.'';
						$sql_insert2 .= "'".$value."', ";
					} else {
						$sql_insert3 .= "'".$value."', ";
					}
				}
				$sql_insert .= ')' . PHP_EOL;
				connect();
				global $link;
				#echo $sql_insert;
				mysqli_query($link, $sql_insert);
				$result = mysqli_query($link, "SELECT 	MAX(course_id)
											   FROM 	courses 
											   WHERE 	`number` = '".$course_info[1]."' 
											   		AND `name`   = '".$course_info[2]."'");
				if (mysqli_num_rows($result) == 0) {
					$sql_insert2 .= "null";
				} else {
					while($p1 = mysqli_fetch_array($result)) {
						$sql_insert2 .= "'".$p1[0]."'"; 
					}
				}
				$sql_insert2 .= ')' . PHP_EOL;
				#echo $sql_insert2;
				mysqli_query($link, $sql_insert2);
				$result = mysqli_query($link, "SELECT 	MAX(fgos_id)
											   FROM 	fgos 
											   WHERE 	`number` 	 = '".$fgos_info[1]."' 
											   		AND `date` 		 = '".$fgos_info[2]."' 
													AND `reg_number` = '".$fgos_info[3]."' 
													AND `reg_date` 	 = '".$fgos_info[4]."'");
				if (mysqli_num_rows($result) == 0) {
					$sql_insert3 .= "null";
				} else {
					while($p1 = mysqli_fetch_array($result)) {
						$sql_insert3 .= "'".$p1[0]."'"; 
					}
				}
				$sql_insert3 .= ')' . PHP_EOL;		
				#echo $sql_insert3;
				mysqli_query($link, $sql_insert3);
				close();
			}
		break;
	}	
?> 