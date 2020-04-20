CREATE
/* [DEFINER = { user | CURRENT_USER }]*/
VIEW view_users
AS (
SELECT    acc.account_id 
		, acc.login
		, acc.grant_id
		, teach.second_name
		, teach.first_name
		, teach.middle_name
		, teach.teacher_id
FROM  `accounts` acc
	, `teachers` teach 
WHERE acc.teacher_id = teach.teacher_id);