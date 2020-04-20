CREATE
/* [DEFINER = { user | CURRENT_USER }]*/
VIEW view_disciplines
AS (
SELECT 	  kaf.pulpit_id
		, kaf.name as kaf
		, dis.discipline_id
		, dis.name
		, dis.index_info
		, module.module_id
		, module.name as module
		, part.part_id
		, part.name as part
		, dis.time
FROM  `disciplines` dis
	, `pulpits` kaf
	, `modules` module
	, `parts` part
WHERE 	dis.pulpit_id = kaf.pulpit_id
	and dis.module_id = module.module_id
	and dis.part_id = part.part_id);