CREATE
/* [DEFINER = { user | CURRENT_USER }]*/
VIEW view_courses
AS (
SELECT    course.id
		, CONCAT_WS(' ',course.number,course.name) as `name`
		, qua.name as qualification
FROM  `courses` course
	, `qualifications` qua
WHERE course.qualification_id = qua.id);