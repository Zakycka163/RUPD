CREATE
/* [DEFINER = { user | CURRENT_USER }]*/
VIEW view_tfuns
AS (
SELECT  prof.id
      , prof.name
	  , prof.fgos_id
	  , prof.fgos_name
FROM  `view_profs` prof
	, `general_work_functions` otf
    , `work_functions` tf
    , `activities` act
WHERE	prof.id = otf.);