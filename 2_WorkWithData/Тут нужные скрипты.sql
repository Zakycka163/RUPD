select ps.code, ps.name, otf.code, otf.name, tf.code, tf.name
from prof_standards ps 
left join general_work_functions otf on ps.prof_standard_id=otf.prof_standard_id
left join work_functions tf 
	on otf.general_work_function_id=tf.general_work_function_id 
	and tf.work_function_id in (1,2)
where ps.prof_standard_id in (1,2);

select count(*) from
(select ps.code as ps_c, ps.name as ps_n, otf.code as otf_c, otf.name as otf_n, tf.code as tf_c, tf.name as tf_n
from prof_standards ps 
left join general_work_functions otf on ps.prof_standard_id=otf.prof_standard_id
left join work_functions tf on otf.general_work_function_id=tf.general_work_function_id and tf.work_function_id in (1,2)
where ps.prof_standard_id in (1,2)) t where t.tf_c is null
;
select count(*) from
(select ps.code as ps_c, ps.name as ps_n, otf.code as otf_c, otf.name as otf_n, tf.code as tf_c, tf.name as tf_n
from prof_standards ps 
left join general_work_functions otf on ps.prof_standard_id=otf.prof_standard_id
left join work_functions tf on otf.general_work_function_id=tf.general_work_function_id and tf.work_function_id in (1,2)
where ps.prof_standard_id in (1,2)) t where t.otf_c is null;	
	
var a = confirm("Ты администратор?");
if (a) {
alert("Красавчик!");
} else {
alert("Бывает :)");
}