<?php 
	session_start();
    require_once ($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");
	require_once ($_SERVER['DOCUMENT_ROOT']."/back/base.php");
	date_default_timezone_set('Europe/Samara');
	
	function fill_parameters() {
		$document = new \PhpOffice\PhpWord\TemplateProcessor($_SERVER['DOCUMENT_ROOT'].'/templates/New_template.docx');
		
		$document ->setValue('year', $_POST["year"]);
		
		connect();
		global $link;
		
		$result = mysqli_query($link, "	select 	name 
										from 	pulpits 
										where 	pulpit_id=".$_POST["pulpit"]."");
		while($row = mysqli_fetch_array($result)){
			$document ->SetValue('pulpit', $row[0]);
		};	
		
		$result = mysqli_query($link, "	select 	c.name, 
												c.number, 
												q.name 
										from 	courses c, 
												qualifications q 
										where 	c.course_id=".$_POST["course"]." 
											and c.qualification_id=q.qualification_id");
		while($row = mysqli_fetch_array($result)){
			$document ->SetValue('course_name', $row[0]);
			$document ->SetValue('course_code', $row[1]);
			$document ->SetValue('qualification', $row[2]);
			$type = ($row[2]=='специалитет') ? 'Cпециальность' : 'Направление подготовки';
			$document ->SetValue('course_type', $type);
			$profile_chapter = ($row[2]=='специалитет') ? ' ' : 'Направленность (профиль):';
			$document ->SetValue('profile_chapter', $profile_chapter);
			if ($profile_chapter=='Направленность (профиль):'){
				$result = mysqli_query($link, "	select 	name 
												from 	profiles 
												where 	profile_id=".$_POST["profile"]."");
				while($row = mysqli_fetch_array($result)){
					$document ->SetValue('profile', '«'.$row[0].'»');
				};
			} else {
				$document ->SetValue('profile', ' ');
			};
		};
		
		$result = mysqli_query($link, "	select 	d.name, 
												d.index_info, 
												t.name, 
												m.name 
										from 	disciplines d, 
												parts t, 
												modules m 
										where 	d.discipline_id=".$_POST["discipline"]." 
											and d.part_id=t.part_id 
											and d.module_id=m.module_id");
		while($row = mysqli_fetch_array($result)){
			$document ->SetValue('discipline_name', $row[0]);
			$document ->SetValue('discipline_index', $row[1]);
			$type = ($row[2]=='базовой') ? 'обязательной части' : 'части, формируемой участниками образовательных отношений,';
			$document ->SetValue('discipline_type', $type);
			$goal_text = ($row[2]=='базовой') ? 'формирование' : 'углубление уровня освоения';
			$document ->setValue('goal', $goal_text);
			$document ->SetValue('module', $row[3]);
		};
		
		$result = mysqli_query($link, "	select 	number, 
												date, 
												reg_number, 
												reg_date 
										from 	fgos 
										where 	fgos_id=".$_POST["fgos"]."");
		while($row = mysqli_fetch_array($result)){
			$document ->SetValue('fgos_number', $row[0]);
			$document ->SetValue('fgos_date', $row[1]);
			$document ->SetValue('fgos_registration_number', $row[2]);
			$document ->SetValue('fgos_registration_date', $row[3]);
		};

		$result = mysqli_query($link, "	select 	CONCAT_WS(' ',
														  t.second_name,
														  CONCAT(LEFT(t.first_name,1),'.'),
														  CONCAT(LEFT(t.middle_name,1),'.')
														  ) as teacher, 
												CONCAT_WS(' ',d.short_name,r.short_name) as d_r 
										from 	accounts a, 
												teachers t, 
												academic_degrees d, 
												academic_ranks r 
										where 	a.account_id=".$_SESSION["id"]."
											and a.teacher_id=t.teacher_id 
											and t.academic_degree_id=d.academic_degree_id 
											and t.academic_rank_id=r.academic_rank_id");
		while($row = mysqli_fetch_array($result)){
			$document ->SetValue('teacher_fio', $row[0]);
			$document ->SetValue('teacher_degree_and_rank', $row[1]);
		};

		$document ->cloneRow('prof_stad_code', count($_POST["tf_list"]));
		$counter = 1;
		$activity = '';
		$tf_id = '0';
		$prof_id = '0';
		foreach ($_POST["tf_list"] as $value){
			$tf_id .= ','.$value;
		};
		foreach ($_POST["prof_stad"] as $value){
			$prof_id .= ','.$value;
		};
		
		$result = mysqli_query($link, "	select 	ps.code, ps.name, 
												otf.code, otf.name, 
												tf.code, tf.name, tf.work_function_id
										from 	prof_standards ps, 
												general_work_functions otf, 
												work_functions tf
										where 	ps.prof_standard_id in (".$prof_id.") 
											and ps.prof_standard_id=otf.prof_standard_id 
											and otf.general_work_function_id=tf.general_work_function_id
											and tf.work_function_id in (".$tf_id.")");
		while($row = mysqli_fetch_array($result)){
			$document ->SetValue('prof_stad_code#'.$counter, $row[0]);
			$document ->SetValue('prof_stad_name#'.$counter, $row[1]);
			$document ->SetValue('otf_code#'.$counter, $row[2]);
			$document ->SetValue('otf_name#'.$counter, $row[3]);
			$document ->SetValue('tf_code#'.$counter, $row[4]);
			$document ->SetValue('tf_name#'.$counter, $row[5]);
			$result1 = mysqli_query($link, "select 	act.name 
											from 	work_functions tf,
													activities act,
													activity_types t
											where 	tf.work_function_id in (".$row[6].")
												and tf.work_function_id=act.work_function_id
												and act.activity_type_id=t.activity_type_id
												and t.name = 'Трудовые действия'");
			while($row1 = mysqli_fetch_array($result1)){
				$activity .= $row1[0].'; ';
			};
			$document ->SetValue('tf_activities_1#'.$counter, $activity);
			$activity = '';
			$result1 = mysqli_query($link, "select 	act.name 
											from 	work_functions tf,
													activities act,
													activity_types t
											where 	tf.work_function_id in (".$row[6].")
												and tf.work_function_id=act.work_function_id
												and act.activity_type_id=t.activity_type_id
												and t.name = 'Необходимые умения'");
			while($row1 = mysqli_fetch_array($result1)){
				$activity .= $row1[0].'; ';
			};
			$document ->SetValue('tf_activities_2#'.$counter, $activity);
			$activity = '';
			$result1 = mysqli_query($link, "select 	act.name 
											from 	work_functions tf,
													activities act,
													activity_types t
											where 	tf.work_function_id in (".$row[6].")
												and tf.work_function_id=act.work_function_id
												and act.activity_type_id=t.activity_type_id
												and t.name = 'Необходимые знания'");
			while($row1 = mysqli_fetch_array($result1)){
				$activity .= $row1[0].'; ';
			};
			$document ->SetValue('tf_activities_3#'.$counter, $activity);
			$activity = '';
			$counter += 1;
		};		
		
		close();	

		$document ->cloneRow('lecture', count($_POST["lecture"]));
		$counter = 1;
		foreach ($_POST["lecture"] as $value){
			$document ->SetValue('lecture#'.$counter, $value);
			$counter += 1;
		};
		
		/*
		$document ->cloneRow('mission', count($_POST["mission"]));
		$counter = 1;
		foreach ($_POST["mission"] as $value){
			$document ->SetValue('mission#'.$counter, $value);
			$counter += 1;
		}
		
		$document ->cloneRow('otf', count($_POST["otf"]));
		$counter = 1;
		foreach ($_POST["otf"] as $value){
			$document ->SetValue('otf#'.$counter, $value);
			$counter += 1;
		}
		$document ->cloneRow('tf', count($_POST["tf"]));
		$counter = 1;
		foreach ($_POST["tf"] as $value){
			$document ->SetValue('tf#'.$counter, $value);
			$counter += 1;
		}
		$document ->cloneRow('lecture', count($_POST["lecture"]));
		$counter = 1;
		foreach ($_POST["lecture"] as $value){
			$document ->SetValue('lecture#'.$counter, $value);
			$counter += 1;
		}
		$document ->cloneRow('practical', count($_POST["practical"]));
		$counter = 1;
		foreach ($_POST["practical"] as $value){
			$document ->SetValue('practical#'.$counter, $value);
			$counter += 1;
		}
		$document ->cloneRow('laboratory', count($_POST["laboratory"]));
		$counter = 1;
		foreach ($_POST["laboratory"] as $value){
			$document ->SetValue('laboratory#'.$counter, $value);
			$counter += 1;
		}
		$document ->cloneRow('individual', count($_POST["individual"]));
		$counter = 1;
		foreach ($_POST["individual"] as $value){
			$document ->SetValue('individual#'.$counter, $value);
			$counter += 1;
		}
		$document ->cloneRow('course_work', count($_POST["course_work"]));
		$counter = 1;
		foreach ($_POST["course_work"] as $value){
			$document ->SetValue('course_work#'.$counter, $value);
			$counter += 1;
		}
		$document ->cloneRow('course_project', count($_POST["course_project"]));
		$counter = 1;
		foreach ($_POST["course_project"] as $value){
			$document ->SetValue('course_project#'.$counter, $value);
			$counter += 1;
		}*/
		
		$document ->saveAs($_SERVER['DOCUMENT_ROOT'].'/documents/'.$_POST["doc_name"].'.docx');
		echo ('Сохранено');
	}
	
	switch($_POST["functionname"]){
		
		case 'fill_parameters': 
			fill_parameters();
            break;
	}
	
    #$document = new \PhpOffice\PhpWord\TemplateProcessor('Templates/RUP_Template.docx');
	#$document ->setValue('pulpite', 'Информационно'); #Кафедра
	#$document ->setValue('courseNumber', '09.05.19'); #Код направления
	#$document ->setValue('distipline', 'Магическая'); #Дисциплина
	#$document ->saveAs('Documents/Hello.docx');
?> 