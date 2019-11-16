ALTER TABLE `teachers` DROP `phone_number`;

ALTER TABLE `teachers` 
	CHANGE `academic_degree_id` 
		`academic_degree_id` INT(10) UNSIGNED NULL, 
	CHANGE `academic_rank_id` 
		`academic_rank_id` INT(10) UNSIGNED NULL;
		
ALTER TABLE `teachers` DROP INDEX email_UNIQUE;