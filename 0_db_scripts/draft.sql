UPDATE `teachers` SET `email` = 'yan69@mail.ru'
WHERE `teachers`.`teacher_id` = 2;

INSERT INTO `constants` (`key`, `value`) VALUES ('limitObj', '20');

INSERT INTO `teachers`
	(`first_name`, `middle_name`, `second_name`, `email`, `academic_degree_id`, `academic_rank_id`) 
VALUES 
	('Валерий','Иванович','Аникин','anikin_vi@mail.ru',17,3),
	('Владимир','Иванович','Воловач','kaf_iies@tolgas.ru',17,3),
	('Виктор','Васильевич','Иванов','kaf_iies@tolgas.ru',17,3),
	('Виктор','Николаевич','Будилов','neuropower@yandex.ru',40,2),
	('Андрей','Алексеевич','Попов','andrei_popov.a@mail.ru',40,2),
	('Надежда','Геннадьевна','Пудовкина','kaf_iies@tolgas.ru',40,2),
	('Светлана','Николаевна','Скобелева','skobeleva-sn@yandex.ru',40,2),
	
	
	