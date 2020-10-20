CREATE
/* [DEFINER = { user | CURRENT_USER }]*/
VIEW view_tfuns
AS (
SELECT  otf.prof_standard_id as prof_id
	  , otf.id
      , CONCAT_WS('. ',otf.code,otf.name) as name
      , otf.level
      , tf.id as tf_id
      , CONCAT_WS('. ',tf.code,tf.name) as tf_name
FROM  `general_work_functions` otf
LEFT JOIN `work_functions` tf ON otf.id = tf.general_work_function_id);