CREATE
/* [DEFINER = { user | CURRENT_USER }]*/
VIEW view_acts
AS (
SELECT  act.work_function_id
      , act.id
      , act.name
      , act_type.id as type_id
      , act_type.name as type
FROM activities act
   , activity_types act_type 
WHERE act.activity_type_id = act_type.id);