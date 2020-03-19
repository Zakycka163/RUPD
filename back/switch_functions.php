<?php   
	require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");

    switch($_POST["functionname"]){ 

        #-----------Листовые значения
		case 'get_profile_list': 
            echo "<option selected style='display' disabled>Выбрать профиль</option>"."\n";
			options_present("SELECT profile_id
								  , `name`
							 FROM profiles 
							 WHERE course_id='".$_POST["param"]."'");
            break;
			
		case 'get_prof_stand_list': 
			options_present("SELECT prof_standard_id
								  , CONCAT_WS(' ',code,`name`) 
							 FROM prof_standards 
							 WHERE fgos_id='".$_POST["param"]."'");
            break;
			
		case 'get_otf_list_by_group': 
			connect();
			global $link;
			$result = mysqli_query($link, "SELECT prof_standard_id
												, code 
										   FROM prof_standards 
										   WHERE fgos_id='".$_POST["param"]."'");
			while($row = mysqli_fetch_array($result)){
				echo "<optgroup id='".$row[0]."' label='".$row[1]."'>"."\n";
				options_present("SELECT general_work_function_id
									  , CONCAT_WS(' ',code,`name`) 
								 FROM general_work_functions 
								 WHERE prof_standard_id='".$row[0]."'");
				echo "</optgroup>";
			}
            close();
			break;
		
		case 'get_tf_list':
			echo "<option selected style='display'></option>"."\n";
			options_present("SELECT tf.work_function_id
								  , CONCAT_WS(' ',tf.code,tf.name) 
							 FROM prof_standards prof
							    , general_work_functions otf
								, work_functions tf 
							 WHERE prof.fgos_id='".$_POST["param"]."' 
							   AND prof.prof_standard_id = otf.prof_standard_id 
							   AND otf.general_work_function_id = tf.general_work_function_id");
            break;
		
		case 'get_course_list':
			if(isset($_POST["param"])){
				get_result("SELECT CONCAT_WS(' ',`number`,`name`) 
							FROM courses 
							WHERE course_id='".$_POST["param"]."'");
				break;
			} else {
				echo "<option selected style='display' disabled>Выбрать направление</option>"."\n";
				options_present("SELECT course_id
									  , CONCAT_WS(' ',`number`,`name`)
								 FROM courses 
								 order by `number`");
				break;
			};
		
		case 'get_discipline_list': 
            echo "<option selected style='display' disabled>Выбрать дисциплину</option>"."\n";
			options_present("SELECT discipline_id
								  , `name` 
							 FROM disciplines
							 WHERE pulpit_id='".$_POST["param"]."'");
			break; 
			
		case 'get_course_list': 
			echo "<option selected style='display' disabled>Выбрать направление</option>"."\n";
			options_present("SELECT course_id
								  , CONCAT_WS(' ',`number`,`name`) 
							 FROM courses 
							 order by `number`");
			break;

		#-----------Одиночные значения
		case 'get_fgos_info': 
			get_result("SELECT CONCAT_WS(' ','Приказ Минобрнауки РФ от',DATE_FORMAT(`date`, '%d-%m-%Y'),'г. №',`number`) 
						FROM fgos 
						WHERE course_id='".$_POST["param"]."'");
            break;		
			
		case 'get_fgos_id': 
			get_result("SELECT fgos_id 
						FROM fgos 
						WHERE course_id='".$_POST["param"]."'");
            break;
			
		case 'get_course_id':
			get_result("SELECT course_id 
						FROM courses 
						WHERE CONCAT_WS(' ',`number`,`name`)='".$_POST["param"]."'");
			break;
			
		case 'get_institute':
			get_result("SELECT inst.name 
						FROM institutes inst
						   , pulpits kaf
						WHERE kaf.pulpit_id='".$_POST["param"]."' 
						  and kaf.institute_id = inst.institute_id");
			break;
			
		case 'get_part':
			get_result("SELECT part.name 
						FROM parts part
						   , disciplines disc 
						WHERE disc.discipline_id='".$_POST["param"]."' 
						  and disc.part_id = part.part_id");
			break;
			
		#-----------Создание объектов
		case 'create_fgos': 
			connect();
			global $link;
			mysqli_query($link,"INSERT INTO fgos (course_id
												, number
												, date
												, reg_number
												, reg_date) 
								values ('".$_POST["course"]."'
								      , '".$_POST["number"]."'
									  , '".$_POST["date"]."'
									  , '".$_POST["reg_number"]."'
									  , '".$_POST["reg_date"]."')");
            close();
			break;	
    }   
?>