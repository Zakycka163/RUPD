CREATE
/* [DEFINER = { user | CURRENT_USER }]*/
VIEW view_acts
AS (
SELECT  tf.tf_id
      , act.id
      , act.name
      , act_type.id as type_id
      , act_type.name as type
FROM `view_tfuns` tf
LEFT JOIN activities act 
       ON tf.tf_id = act.work_function_id
LEFT JOIN activity_types act_type 
       ON act.activity_type_id = act_type.id
WHERE tf.tf_id IS NOT NULL);