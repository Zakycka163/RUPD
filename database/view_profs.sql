CREATE
/* [DEFINER = { user | CURRENT_USER }]*/
VIEW view_profs
AS (
SELECT  prof.id
      , CONCAT_WS(' ',prof.code,prof.name) as name
	  , fgos.id as fgos_id
	  , fgos.name as fgos_name
	  , prof.number
	  , prof.date
	  , prof.reg_number
	  , prof.reg_date 
FROM  `prof_standards` prof
	, `view_fgos` fgos
WHERE prof.fgos_id = fgos.id);