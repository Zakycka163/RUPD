CREATE
/* [DEFINER = { user | CURRENT_USER }]*/
VIEW view_disciplines
AS (
SELECT 	  dis.id
		, dis.name
		, dis.index_info
		, kaf.id as kaf_id
		, kaf.name as kaf
		, module.id as module_id
		, module.name as module
		, part.id as part_id
		, part.name as part
		, dis.time
FROM  `disciplines` dis
	, `pulpits` kaf
	, `modules` module
	, `parts` part
WHERE 	dis.pulpit_id = kaf.id
	and dis.module_id = module.id
	and dis.part_id = part.id);