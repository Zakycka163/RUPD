CREATE
/* [DEFINER = { user | CURRENT_USER }]*/
VIEW view_teachers
AS (
SELECT    tech.id
		, tech.second_name
		, tech.first_name
		, tech.middle_name
		, tech.email
		, deg.full_name as deg_name
		, ac_rank.full_name as ac_rank_name
		, pos.name as position
		, acc.id
		, acc.login as account
FROM `teachers` tech
LEFT JOIN (`academic_degrees` deg) 
	ON tech.academic_degree_id = deg.id
LEFT JOIN (`academic_ranks` ac_rank) 
	ON tech.academic_rank_id = ac_rank.id
LEFT JOIN (`teacher_positions` poses, `positions` pos) 
	ON tech.id = poses.teacher_id and poses.main_position = pos.id
LEFT JOIN (`accounts` acc) 
	ON tech.id = acc.teacher_id
WHERE tech.academic_degree_id = deg.id
  and tech.academic_rank_id = ac_rank.id);