CREATE
/* [DEFINER = { user | CURRENT_USER }]*/
VIEW view_fgos
AS (
SELECT  fgos.id
	  , CONCAT_WS(' ',course.number,course.name) as `name`
	  , fgos.number
	  , fgos.date
	  , fgos.reg_number
	  , fgos.reg_date 
FROM  `courses` course
	, `fgos` fgos 
WHERE fgos.course_id = course.id);