CREATE
/* [DEFINER = { user | CURRENT_USER }]*/
VIEW teachers_presenter
AS (
SELECT    tech.teacher_id
		, tech.second_name
		, tech.first_name
		, tech.middle_name
		, tech.email
		, deg.full_name as deg_name
		, ac_rank.full_name as ac_rank_name
		, pos.name as position
		, acc.account_id
		, acc.login as account
FROM `teachers` tech
LEFT JOIN (`academic_degrees` deg) 
	ON tech.academic_degree_id = deg.academic_degree_id
LEFT JOIN (`academic_ranks` ac_rank) 
	ON tech.academic_rank_id = ac_rank.academic_rank_id
LEFT JOIN (`teacher_positions` poses, `positions` pos) 
	ON tech.teacher_id = poses.teacher_id and poses.main_position = pos.position_id
LEFT JOIN (`accounts` acc) 
	ON tech.teacher_id = acc.teacher_id
WHERE tech.academic_degree_id = deg.academic_degree_id
  and tech.academic_rank_id = ac_rank.academic_rank_id);