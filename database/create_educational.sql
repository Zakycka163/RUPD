-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 04 2020 г., 16:54
-- Версия сервера: 10.3.16-MariaDB
-- Версия PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `create_educational`
--

-- --------------------------------------------------------

--
-- Структура таблицы `academic_degrees`
--

CREATE TABLE `academic_degrees` (
  `academic_degree_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `short_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `academic_degrees`
--

INSERT INTO `academic_degrees` (`academic_degree_id`, `full_name`, `short_name`) VALUES
(1, 'Магистр', 'маг'),
(2, 'Доктор архитектуры', 'д-р архите'),
(3, 'Доктор биологических наук', 'д-р биол. '),
(4, 'Доктор ветеринарных наук', 'д-р ветери'),
(5, 'Доктор военных наук', 'д-р воен. '),
(6, 'Доктор географических наук', 'д-р геогр.'),
(7, 'Доктор геолого-минералогических наук', 'д-р геол.-'),
(8, 'Доктор искусствоведения', 'д-р искусс'),
(9, 'Доктор исторических наук', 'д-р ист. н'),
(10, 'Доктор культурологии', 'д-р культу'),
(11, 'Доктор медицинских наук', 'д-р мед. н'),
(12, 'Доктор педагогических наук', 'д-р пед. н'),
(13, 'Доктор политических наук', 'д-р полит.'),
(14, 'Доктор психологических наук', 'д-р психол'),
(15, 'Доктор социологических наук', 'д-р социол'),
(16, 'Доктор сельскохозяйственных наук', 'д-р с.-х. '),
(17, 'Доктор технических наук', 'д-р техн. '),
(18, 'Доктор фармацевтических наук', 'д-р фармац'),
(19, 'Доктор физико-математических наук', 'д-р физ.-м'),
(20, 'Доктор филологических наук', 'д-р филол.'),
(21, 'Доктор философских наук', 'д-р филос.'),
(22, 'Доктор химических наук', 'д-р хим. н'),
(23, 'Доктор экономических наук', 'д-р экон. '),
(24, 'Доктор юридических наук', 'д-р юрид. '),
(25, 'Кандидат архитектуры', 'канд. архи'),
(26, 'Кандидат биологических наук', 'канд. биол'),
(27, 'Кандидат ветеринарных наук', 'канд. вете'),
(28, 'Кандидат военных наук', 'канд. воен'),
(29, 'Кандидат географических наук', 'канд. геог'),
(30, 'Кандидат геолого-минералогических наук', 'канд. геол'),
(31, 'Кандидат искусствоведения', 'канд. иску'),
(32, 'Кандидат исторических наук', 'канд. ист.'),
(33, 'Кандидат культурологии', 'канд. куль'),
(34, 'Кандидат медицинских наук', 'канд. мед.'),
(35, 'Кандидат педагогических наук', 'канд. пед.'),
(36, 'Кандидат политических наук', 'канд. поли'),
(37, 'Кандидат психологических наук', 'канд. псих'),
(38, 'Кандидат социологических наук', 'канд. соци'),
(39, 'Кандидат сельскохозяйственных наук', 'канд. с.-х'),
(40, 'Кандидат технических наук', 'канд. техн'),
(41, 'Кандидат фармацевтических наук', 'канд. фарм'),
(42, 'Кандидат физико-математических наук', 'канд. физ.'),
(43, 'Кандидат филологических наук', 'канд. фило'),
(44, 'Кандидат философских наук', 'канд. фило'),
(45, 'Кандидат химических наук', 'канд. хим.'),
(46, 'Кандидат экономических наук', 'канд. экон'),
(47, 'Кандидат юридических наук', 'канд. юрид');

-- --------------------------------------------------------

--
-- Структура таблицы `academic_ranks`
--

CREATE TABLE `academic_ranks` (
  `academic_rank_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `short_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `academic_ranks`
--

INSERT INTO `academic_ranks` (`academic_rank_id`, `full_name`, `short_name`) VALUES
(1, 'Разработчик', 'dev'),
(2, 'Доцент', 'доц.'),
(3, 'Профессор', 'проф.'),
(4, 'Старший научный сотрудник', 'ст. науч. '),
(5, 'Младший научный сотрудник', 'мл. науч. '),
(6, 'Академик', 'акад.'),
(7, 'Член-корреспондент', 'чл.-кор.');

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) UNSIGNED NOT NULL,
  `login` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `grant_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`account_id`, `login`, `password`, `teacher_id`, `grant_id`) VALUES
(1, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(10) UNSIGNED NOT NULL,
  `activity_type_id` int(10) UNSIGNED NOT NULL,
  `work_function_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `competence_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `activities`
--

INSERT INTO `activities` (`activity_id`, `activity_type_id`, `work_function_id`, `name`, `competence_id`) VALUES
(1, 1, 1, 'Описание возможных типов для каждого компонента, включая оценку современного состояния предлагаемых типов', NULL),
(2, 1, 1, 'Обоснование методов или методологии проведения работы', NULL),
(3, 1, 1, 'Описание технологических и технико-эксплуатационных характеристик возможных типов для каждого компонента', NULL),
(4, 1, 1, 'Формулирование оценки результатов исследований, включающих оценку полноты перечня возможных типов и предложения по дальнейшим направлениям работ', NULL),
(5, 1, 1, 'Обоснование необходимости дополнительных исследований; обоснование необходимости прекращения дальнейших исследований в случае получения отрицательных результатов', NULL),
(6, 1, 1, 'Передача перечня возможных типов для каждого компонента на рецензирование архитектору более высокого уровня квалификации и заинтересованным лицам', NULL),
(7, 1, 1, 'Обработка комментариев и замечаний архитектора более высокого уровня квалификации и заинтересованных лиц с необходимой доработкой перечня возможных типов', NULL),
(8, 2, 1, 'Анализировать и оценивать полноту перечня типов компонентов', NULL),
(9, 2, 1, 'Производить исследования и анализ', NULL),
(10, 3, 1, 'Типы компонентов', NULL),
(11, 3, 1, 'Методы разработки, анализа и проектирования ПО', NULL),
(12, 3, 1, 'Технологические и технико-эксплуатационные характеристики типов компонентов', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `activity_types`
--

CREATE TABLE `activity_types` (
  `activity_type_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `activity_types`
--

INSERT INTO `activity_types` (`activity_type_id`, `name`) VALUES
(6, 'Владеет'),
(4, 'Знает'),
(3, 'Необходимые знания'),
(2, 'Необходимые умения'),
(1, 'Трудовые действия'),
(5, 'Умеет');

-- --------------------------------------------------------

--
-- Структура таблицы `cabinets`
--

CREATE TABLE `cabinets` (
  `cabinet_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(5) NOT NULL,
  `description` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `cabinet_fund`
--

CREATE TABLE `cabinet_fund` (
  `discipline_id` int(10) UNSIGNED NOT NULL,
  `cabinet_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `competence_types`
--

CREATE TABLE `competence_types` (
  `competence_type_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `competence_types`
--

INSERT INTO `competence_types` (`competence_type_id`, `name`, `code`) VALUES
(1, 'Универсальные компетенции', 'УК'),
(2, 'Общепрофессиональные компетенции', 'ОПК'),
(3, 'Профессиональные компетенции', 'ПК');

-- --------------------------------------------------------

--
-- Структура таблицы `competencies`
--

CREATE TABLE `competencies` (
  `competence_id` int(10) UNSIGNED NOT NULL,
  `fgos_id` int(10) UNSIGNED NOT NULL,
  `competence_type_id` int(10) UNSIGNED DEFAULT NULL,
  `number` varchar(5) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `connections_opop`
--

CREATE TABLE `connections_opop` (
  `general_work_function_id` int(10) UNSIGNED NOT NULL,
  `competence_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `constants`
--

CREATE TABLE `constants` (
  `key` varchar(10) NOT NULL,
  `value` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `constants`
--

INSERT INTO `constants` (`key`, `value`) VALUES
('limitObj', '20');

-- --------------------------------------------------------

--
-- Структура таблицы `control_forms`
--

CREATE TABLE `control_forms` (
  `control_form_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `control_forms`
--

INSERT INTO `control_forms` (`control_form_id`, `name`) VALUES
(2, 'Дифференцированный зачет'),
(3, 'Зачет'),
(5, 'Защита КП'),
(4, 'Защита КР'),
(6, 'Контрольная работа'),
(1, 'Экзамен');

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE `courses` (
  `course_id` int(10) UNSIGNED NOT NULL,
  `number` varchar(8) NOT NULL,
  `name` varchar(60) NOT NULL,
  `qualification_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`course_id`, `number`, `name`, `qualification_id`) VALUES
(12, '09.03.01', 'Информатика и вычислительная техника', 1),
(13, '09.03.02', 'Информационные системы и технологии', 1),
(14, '09.03.04', 'Программная инженерия', 1),
(15, '11.03.01', 'Радиотехника', 1),
(16, '11.03.02', 'Инфокоммуникационные технологии и системы связи', 1),
(17, '43.03.01', 'Сервис', 1),
(18, '09.02.01', 'Компьютерные системы и комплексы', 1),
(19, '09.02.02', 'Компьютерные сети', 1),
(20, '11.02.02', 'Техническое обслуживание и ремонт радиоэлектронной техники', 1),
(21, '09.04.01', 'Информатика и вычислительная техника', 1),
(22, '09.04.04', 'Программная инженерия', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `disciplines`
--

CREATE TABLE `disciplines` (
  `discipline_id` int(10) UNSIGNED NOT NULL,
  `pulpit_id` int(10) UNSIGNED NOT NULL,
  `part_id` int(10) UNSIGNED NOT NULL,
  `module_id` int(11) UNSIGNED NOT NULL,
  `index_info` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `disciplines`
--

INSERT INTO `disciplines` (`discipline_id`, `pulpit_id`, `part_id`, `module_id`, `index_info`, `name`, `time`) VALUES
(1, 13, 1, 1, 'A1', 'Тестовая', 100);

-- --------------------------------------------------------

--
-- Структура таблицы `educations`
--

CREATE TABLE `educations` (
  `education_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `fgos`
--

CREATE TABLE `fgos` (
  `fgos_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `number` varchar(5) NOT NULL,
  `date` date NOT NULL,
  `reg_number` varchar(10) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `fgos`
--

INSERT INTO `fgos` (`fgos_id`, `course_id`, `number`, `date`, `reg_number`, `reg_date`) VALUES
(1, 22, '932', '2017-10-19', '111', '0000-00-00'),
(21, 14, '123', '2019-11-22', '321', '2019-11-21'),
(22, 12, '123', '2019-12-14', '412', '2019-12-13');

-- --------------------------------------------------------

--
-- Структура таблицы `general_work_functions`
--

CREATE TABLE `general_work_functions` (
  `general_work_function_id` int(10) UNSIGNED NOT NULL,
  `prof_standard_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  `level` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `general_work_functions`
--

INSERT INTO `general_work_functions` (`general_work_function_id`, `prof_standard_id`, `code`, `name`, `level`) VALUES
(1, 1, 'A', 'Создание вариантов архитектуры программного средства', 4),
(2, 1, 'D', 'Оценка требований к программному средству', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `grants`
--

CREATE TABLE `grants` (
  `grant_id` int(10) UNSIGNED NOT NULL,
  `access` varchar(15) NOT NULL,
  `description` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `grants`
--

INSERT INTO `grants` (`grant_id`, `access`, `description`) VALUES
(1, 'Преподаватель', 'Обычные права'),
(2, 'Администратор', 'Расширенные права');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `group_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `study_form_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`group_id`, `name`, `profile_id`, `study_form_id`, `description`) VALUES
(1, 'МПРз17', 1, 2, 'Группа разработчика системы');

-- --------------------------------------------------------

--
-- Структура таблицы `institutes`
--

CREATE TABLE `institutes` (
  `institute_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `institutes`
--

INSERT INTO `institutes` (`institute_id`, `name`, `description`) VALUES
(1, 'Институт дизайна, туризма и социальных технологий', NULL),
(2, 'Институт заочного обучения', NULL),
(3, 'Институт экономики', NULL),
(4, 'Факультет информационно – технического сервиса', NULL),
(5, 'Факультет среднего профессионального образования', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `missions`
--

CREATE TABLE `missions` (
  `mission_id` int(10) UNSIGNED NOT NULL,
  `rup_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `modules`
--

CREATE TABLE `modules` (
  `module_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `modules`
--

INSERT INTO `modules` (`module_id`, `name`) VALUES
(1, 'Модуль 1');

-- --------------------------------------------------------

--
-- Структура таблицы `parts`
--

CREATE TABLE `parts` (
  `part_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `parts`
--

INSERT INTO `parts` (`part_id`, `name`) VALUES
(1, 'базовой'),
(2, 'вариативной');

-- --------------------------------------------------------

--
-- Структура таблицы `positions`
--

CREATE TABLE `positions` (
  `position_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `positions`
--

INSERT INTO `positions` (`position_id`, `name`) VALUES
(1, 'Разработик ИС формирования РУПД');

-- --------------------------------------------------------

--
-- Структура таблицы `profiles`
--

CREATE TABLE `profiles` (
  `profile_id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `profiles`
--

INSERT INTO `profiles` (`profile_id`, `course_id`, `name`, `description`) VALUES
(1, 22, 'Разработка программно-информационных систем', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `prof_standards`
--

CREATE TABLE `prof_standards` (
  `prof_standard_id` int(10) UNSIGNED NOT NULL,
  `fgos_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(7) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(5) NOT NULL,
  `date` date NOT NULL,
  `reg_number` varchar(10) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `prof_standards`
--

INSERT INTO `prof_standards` (`prof_standard_id`, `fgos_id`, `code`, `name`, `number`, `date`, `reg_number`, `reg_date`) VALUES
(1, 1, '06.003', 'Архитектор программного обеспечения', '228н', '2014-04-02', '', '0000-00-00'),
(2, 1, '06.017', 'Руководитель разработки программного обеспечения', '645н', '2014-10-17', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Структура таблицы `pulpits`
--

CREATE TABLE `pulpits` (
  `pulpit_id` int(10) UNSIGNED NOT NULL,
  `institute_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pulpits`
--

INSERT INTO `pulpits` (`pulpit_id`, `institute_id`, `name`, `description`) VALUES
(1, 1, 'Гостеприимство и межкультурные коммуникации', NULL),
(2, 1, 'Дизайн и искусство', NULL),
(3, 1, 'Социальные технологии и гуманитарные науки', NULL),
(4, 1, 'Физическое воспитание', NULL),
(5, 2, 'Отдел мониторинга качества освоения ООП', NULL),
(6, 2, 'Отдел развития Заочного обучения', NULL),
(7, 3, 'Экономика и управление', NULL),
(8, 3, 'Экономика, организация и коммерческая деятельность', NULL),
(9, 3, 'Бухгалтерский учет, анализ и аудит', NULL),
(10, 3, 'Финансы и кредит', NULL),
(11, 3, 'Прикладная информатика в экономике', NULL),
(12, 3, 'Менеджмент', NULL),
(13, 4, 'Информационный и электронный сервис', NULL),
(14, 4, 'Математические и естественно-научные дисциплины', NULL),
(15, 4, 'Сервис технических и технологических систем', NULL),
(16, 4, 'Управление качеством и инновационные технологии', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `qualifications`
--

CREATE TABLE `qualifications` (
  `qualification_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `qualifications`
--

INSERT INTO `qualifications` (`qualification_id`, `name`) VALUES
(1, 'бакалавриат'),
(3, 'магистратура'),
(2, 'специалитет');

-- --------------------------------------------------------

--
-- Структура таблицы `rup`
--

CREATE TABLE `rup` (
  `rup_id` int(10) UNSIGNED NOT NULL,
  `discipline_id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `goal` varchar(120) NOT NULL,
  `task_id` int(10) UNSIGNED DEFAULT NULL,
  `path` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `second_works`
--

CREATE TABLE `second_works` (
  `second_work_id` int(10) UNSIGNED NOT NULL,
  `work_type_id` int(10) UNSIGNED NOT NULL,
  `rup_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `seminars`
--

CREATE TABLE `seminars` (
  `seminar_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `seminars`
--

INSERT INTO `seminars` (`seminar_id`, `description`) VALUES
(1, '1 курс 1 семестр'),
(2, '1 курс 2 семестр'),
(3, '2 курс 3 семестр'),
(4, '2 курс 4 семестр'),
(5, '3 курс 5 семестр'),
(6, '3 курс 6 семестр'),
(7, '4 курс 7 семестр'),
(8, '4 курс 8 семестр');

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `status_id` int(10) UNSIGNED NOT NULL,
  `value` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `study_forms`
--

CREATE TABLE `study_forms` (
  `study_form_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `study_forms`
--

INSERT INTO `study_forms` (`study_form_id`, `name`) VALUES
(2, 'Заочная'),
(1, 'Очная'),
(3, 'Очно-заочная');

-- --------------------------------------------------------

--
-- Структура таблицы `study_plan`
--

CREATE TABLE `study_plan` (
  `seminar_id` int(10) UNSIGNED NOT NULL,
  `discipline_id` int(10) UNSIGNED NOT NULL,
  `study_form_id` int(10) UNSIGNED NOT NULL,
  `individual_time` int(10) UNSIGNED DEFAULT NULL,
  `lecture_time` int(10) UNSIGNED DEFAULT NULL,
  `laboratory_time` int(10) UNSIGNED DEFAULT NULL,
  `practical_time` int(10) UNSIGNED DEFAULT NULL,
  `course_work` tinyint(1) UNSIGNED DEFAULT NULL,
  `course_project` tinyint(1) UNSIGNED DEFAULT NULL,
  `control_work` tinyint(1) UNSIGNED DEFAULT NULL,
  `control_form_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(10) UNSIGNED NOT NULL,
  `objective` varchar(100) NOT NULL,
  `due_date` date NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) DEFAULT NULL,
  `second_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `academic_degree_id` int(10) UNSIGNED DEFAULT NULL,
  `academic_rank_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `first_name`, `middle_name`, `second_name`, `email`, `academic_degree_id`, `academic_rank_id`) VALUES
(1, 'Дмитрий', 'Александрович', 'Ставинский', 'test@test.ru', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `teacher_educations`
--

CREATE TABLE `teacher_educations` (
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `education_id` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `teacher_positions`
--

CREATE TABLE `teacher_positions` (
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `position_id` int(10) UNSIGNED NOT NULL,
  `main_position` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teacher_positions`
--

INSERT INTO `teacher_positions` (`teacher_id`, `position_id`, `main_position`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(10) UNSIGNED NOT NULL,
  `topic_type_id` int(10) UNSIGNED NOT NULL,
  `discipline_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `topic_types`
--

CREATE TABLE `topic_types` (
  `topic_type_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `work_functions`
--

CREATE TABLE `work_functions` (
  `work_function_id` int(10) UNSIGNED NOT NULL,
  `general_work_function_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(6) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `work_functions`
--

INSERT INTO `work_functions` (`work_function_id`, `general_work_function_id`, `code`, `name`) VALUES
(1, 1, 'A/01.4', 'Определение перечня возможных типов для каждого компонента'),
(2, 1, 'A/02.4', 'Определение перечня возможных архитектур развертывания каждого компонента'),
(3, 2, 'D/01.5', 'Оценка возможности тестирования требований');

-- --------------------------------------------------------

--
-- Структура таблицы `work_types`
--

CREATE TABLE `work_types` (
  `work_type_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `academic_degrees`
--
ALTER TABLE `academic_degrees`
  ADD PRIMARY KEY (`academic_degree_id`),
  ADD UNIQUE KEY `academic_degree_id_UNIQUE` (`academic_degree_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`full_name`);

--
-- Индексы таблицы `academic_ranks`
--
ALTER TABLE `academic_ranks`
  ADD PRIMARY KEY (`academic_rank_id`),
  ADD UNIQUE KEY `academic_rank_id_UNIQUE` (`academic_rank_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`full_name`);

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD UNIQUE KEY `idAccounts_UNIQUE` (`account_id`),
  ADD UNIQUE KEY `password_UNIQUE` (`password`),
  ADD KEY `fk_Accounts_Users1_idx` (`teacher_id`),
  ADD KEY `fk_Accounts_Grants1_idx` (`grant_id`);

--
-- Индексы таблицы `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`),
  ADD UNIQUE KEY `idType_UNIQUE` (`activity_id`),
  ADD KEY `fk_Activities_ActionSkillKnowledge1_idx` (`activity_type_id`),
  ADD KEY `fk_Activities_WorkFunctions1_idx` (`work_function_id`),
  ADD KEY `fk_activities_competencies1_idx` (`competence_id`);

--
-- Индексы таблицы `activity_types`
--
ALTER TABLE `activity_types`
  ADD PRIMARY KEY (`activity_type_id`),
  ADD UNIQUE KEY `typeName_UNIQUE` (`name`),
  ADD UNIQUE KEY `idType_UNIQUE` (`activity_type_id`);

--
-- Индексы таблицы `cabinets`
--
ALTER TABLE `cabinets`
  ADD PRIMARY KEY (`cabinet_id`),
  ADD UNIQUE KEY `idСabinet_UNIQUE` (`cabinet_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Индексы таблицы `cabinet_fund`
--
ALTER TABLE `cabinet_fund`
  ADD PRIMARY KEY (`discipline_id`,`cabinet_id`),
  ADD KEY `fk_сabinet_fund_disciplines1_idx` (`discipline_id`),
  ADD KEY `fk_сabinet_fund_cabinets1_idx` (`cabinet_id`);

--
-- Индексы таблицы `competence_types`
--
ALTER TABLE `competence_types`
  ADD PRIMARY KEY (`competence_type_id`),
  ADD UNIQUE KEY `idTypesСompetence_UNIQUE` (`competence_type_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`);

--
-- Индексы таблицы `competencies`
--
ALTER TABLE `competencies`
  ADD PRIMARY KEY (`competence_id`),
  ADD UNIQUE KEY `idСompetencies_UNIQUE` (`competence_id`),
  ADD KEY `fk_Сompetencies_TypesСompetence1_idx` (`competence_type_id`),
  ADD KEY `fk_Сompetencies_Fgoses1_idx` (`fgos_id`);

--
-- Индексы таблицы `connections_opop`
--
ALTER TABLE `connections_opop`
  ADD PRIMARY KEY (`general_work_function_id`,`competence_id`),
  ADD KEY `fk_GeneralWorkFunctions_has_Сompetencies_Сompetencies1_idx` (`competence_id`),
  ADD KEY `fk_GeneralWorkFunctions_has_Сompetencies_GeneralWorkFuncti_idx` (`general_work_function_id`);

--
-- Индексы таблицы `constants`
--
ALTER TABLE `constants`
  ADD UNIQUE KEY `key_UNIQUE` (`key`);

--
-- Индексы таблицы `control_forms`
--
ALTER TABLE `control_forms`
  ADD PRIMARY KEY (`control_form_id`),
  ADD UNIQUE KEY `idControlForm_UNIQUE` (`control_form_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `idCourse_UNIQUE` (`course_id`),
  ADD UNIQUE KEY `number_UNIQUE` (`number`),
  ADD KEY `fk_courses_qualifications1_idx` (`qualification_id`);

--
-- Индексы таблицы `disciplines`
--
ALTER TABLE `disciplines`
  ADD PRIMARY KEY (`discipline_id`),
  ADD UNIQUE KEY `idDiscipline_UNIQUE` (`discipline_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_Disciplines_Parts1_idx` (`part_id`),
  ADD KEY `fk_disciplines_pulpits1_idx` (`pulpit_id`),
  ADD KEY `fk_disciplines_modules1_idx` (`module_id`);

--
-- Индексы таблицы `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`education_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `education_id_UNIQUE` (`education_id`);

--
-- Индексы таблицы `fgos`
--
ALTER TABLE `fgos`
  ADD PRIMARY KEY (`fgos_id`),
  ADD UNIQUE KEY `idfgos_UNIQUE` (`fgos_id`),
  ADD KEY `fk_Fgoses_Courses1_idx` (`course_id`);

--
-- Индексы таблицы `general_work_functions`
--
ALTER TABLE `general_work_functions`
  ADD PRIMARY KEY (`general_work_function_id`),
  ADD UNIQUE KEY `idGeneralWorkFunction_UNIQUE` (`general_work_function_id`),
  ADD KEY `fk_GeneralWorkFunctions_ProfStandards1_idx` (`prof_standard_id`);

--
-- Индексы таблицы `grants`
--
ALTER TABLE `grants`
  ADD PRIMARY KEY (`grant_id`),
  ADD UNIQUE KEY `access_UNIQUE` (`access`),
  ADD UNIQUE KEY `idGrant_UNIQUE` (`grant_id`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `idGroup_UNIQUE` (`group_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_Groups_Profiles1_idx` (`profile_id`),
  ADD KEY `fk_Groups_StudyForms1_idx` (`study_form_id`);

--
-- Индексы таблицы `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`institute_id`),
  ADD UNIQUE KEY `institute_id_UNIQUE` (`institute_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Индексы таблицы `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`mission_id`),
  ADD UNIQUE KEY `idMission_UNIQUE` (`mission_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_Missions_RUP1_idx` (`rup_id`);

--
-- Индексы таблицы `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`),
  ADD UNIQUE KEY `module_id_UNIQUE` (`module_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Индексы таблицы `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`part_id`),
  ADD UNIQUE KEY `idPart_UNIQUE` (`part_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Индексы таблицы `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`),
  ADD UNIQUE KEY `position_id_UNIQUE` (`position_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Индексы таблицы `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD UNIQUE KEY `idProfiles_UNIQUE` (`profile_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_Profiles_Courses1_idx` (`course_id`);

--
-- Индексы таблицы `prof_standards`
--
ALTER TABLE `prof_standards`
  ADD PRIMARY KEY (`prof_standard_id`),
  ADD UNIQUE KEY `idProfStandard_UNIQUE` (`prof_standard_id`),
  ADD KEY `fk_ProfStandards_Fgoses1_idx` (`fgos_id`);

--
-- Индексы таблицы `pulpits`
--
ALTER TABLE `pulpits`
  ADD PRIMARY KEY (`pulpit_id`),
  ADD UNIQUE KEY `idPulpit_UNIQUE` (`pulpit_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD KEY `fk_pulpits_institutes1_idx` (`institute_id`);

--
-- Индексы таблицы `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`qualification_id`),
  ADD UNIQUE KEY `qualification_id_UNIQUE` (`qualification_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Индексы таблицы `rup`
--
ALTER TABLE `rup`
  ADD PRIMARY KEY (`rup_id`),
  ADD UNIQUE KEY `idRUP_UNIQUE` (`rup_id`),
  ADD KEY `fk_RUP_Disciplines1_idx` (`discipline_id`),
  ADD KEY `fk_RUP_Profiles1_idx` (`profile_id`),
  ADD KEY `fk_RUP_Tasks1_idx` (`task_id`);

--
-- Индексы таблицы `second_works`
--
ALTER TABLE `second_works`
  ADD PRIMARY KEY (`second_work_id`),
  ADD UNIQUE KEY `idSecondWork_UNIQUE` (`second_work_id`),
  ADD KEY `fk_SecondWorks_RUP1_idx` (`rup_id`),
  ADD KEY `fk_SecondWorks_WorkTypes1_idx` (`work_type_id`);

--
-- Индексы таблицы `seminars`
--
ALTER TABLE `seminars`
  ADD PRIMARY KEY (`seminar_id`),
  ADD UNIQUE KEY `idSeminar_UNIQUE` (`seminar_id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`status_id`),
  ADD UNIQUE KEY `idStatus_UNIQUE` (`status_id`),
  ADD UNIQUE KEY `value_UNIQUE` (`value`);

--
-- Индексы таблицы `study_forms`
--
ALTER TABLE `study_forms`
  ADD PRIMARY KEY (`study_form_id`),
  ADD UNIQUE KEY `idStudyForm_UNIQUE` (`study_form_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Индексы таблицы `study_plan`
--
ALTER TABLE `study_plan`
  ADD PRIMARY KEY (`seminar_id`,`discipline_id`,`study_form_id`),
  ADD KEY `fk_Disciplines_has_Seminars_Seminars1_idx` (`seminar_id`),
  ADD KEY `fk_Disciplines_has_Seminars_ControlForms1_idx` (`control_form_id`),
  ADD KEY `fk_study_plan_disciplines1_idx` (`discipline_id`),
  ADD KEY `fk_study_plan_study_forms1_idx` (`study_form_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD UNIQUE KEY `idTask_UNIQUE` (`task_id`),
  ADD KEY `fk_Tasks_Statuses2_idx` (`status_id`),
  ADD KEY `fk_tasks_accounts1_idx` (`account_id`);

--
-- Индексы таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`teacher_id`),
  ADD KEY `fk_teachers_academic_degrees1_idx` (`academic_degree_id`),
  ADD KEY `fk_teachers_academic_ranks1_idx` (`academic_rank_id`);

--
-- Индексы таблицы `teacher_educations`
--
ALTER TABLE `teacher_educations`
  ADD PRIMARY KEY (`teacher_id`,`education_id`),
  ADD KEY `fk_teachers_has_educations_educations1_idx` (`education_id`),
  ADD KEY `fk_teachers_has_educations_teachers1_idx` (`teacher_id`);

--
-- Индексы таблицы `teacher_positions`
--
ALTER TABLE `teacher_positions`
  ADD PRIMARY KEY (`teacher_id`,`position_id`),
  ADD KEY `fk_teachers_has_positions_positions1_idx` (`position_id`),
  ADD KEY `fk_teachers_has_positions_teachers1_idx` (`teacher_id`);

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD UNIQUE KEY `idTopic_UNIQUE` (`topic_id`),
  ADD KEY `fk_Topics_Disciplines1_idx` (`discipline_id`),
  ADD KEY `fk_Topics_TopicTypes1_idx` (`topic_type_id`);

--
-- Индексы таблицы `topic_types`
--
ALTER TABLE `topic_types`
  ADD PRIMARY KEY (`topic_type_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `idTopicType_UNIQUE` (`topic_type_id`);

--
-- Индексы таблицы `work_functions`
--
ALTER TABLE `work_functions`
  ADD PRIMARY KEY (`work_function_id`),
  ADD UNIQUE KEY `idGeneralWorkFunction_UNIQUE` (`work_function_id`),
  ADD KEY `fk_WorkFunctions_GeneralWorkFunctions1_idx` (`general_work_function_id`);

--
-- Индексы таблицы `work_types`
--
ALTER TABLE `work_types`
  ADD PRIMARY KEY (`work_type_id`),
  ADD UNIQUE KEY `idWorkType_UNIQUE` (`work_type_id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `academic_degrees`
--
ALTER TABLE `academic_degrees`
  MODIFY `academic_degree_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `academic_ranks`
--
ALTER TABLE `academic_ranks`
  MODIFY `academic_rank_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `activity_types`
--
ALTER TABLE `activity_types`
  MODIFY `activity_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `cabinets`
--
ALTER TABLE `cabinets`
  MODIFY `cabinet_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `competence_types`
--
ALTER TABLE `competence_types`
  MODIFY `competence_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `competencies`
--
ALTER TABLE `competencies`
  MODIFY `competence_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `control_forms`
--
ALTER TABLE `control_forms`
  MODIFY `control_form_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `discipline_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `educations`
--
ALTER TABLE `educations`
  MODIFY `education_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fgos`
--
ALTER TABLE `fgos`
  MODIFY `fgos_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `general_work_functions`
--
ALTER TABLE `general_work_functions`
  MODIFY `general_work_function_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `grants`
--
ALTER TABLE `grants`
  MODIFY `grant_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `institutes`
--
ALTER TABLE `institutes`
  MODIFY `institute_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `missions`
--
ALTER TABLE `missions`
  MODIFY `mission_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `parts`
--
ALTER TABLE `parts`
  MODIFY `part_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profile_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `prof_standards`
--
ALTER TABLE `prof_standards`
  MODIFY `prof_standard_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `pulpits`
--
ALTER TABLE `pulpits`
  MODIFY `pulpit_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `qualification_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `rup`
--
ALTER TABLE `rup`
  MODIFY `rup_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `second_works`
--
ALTER TABLE `second_works`
  MODIFY `second_work_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `seminars`
--
ALTER TABLE `seminars`
  MODIFY `seminar_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `status_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `study_forms`
--
ALTER TABLE `study_forms`
  MODIFY `study_form_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `topic_types`
--
ALTER TABLE `topic_types`
  MODIFY `topic_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `work_functions`
--
ALTER TABLE `work_functions`
  MODIFY `work_function_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `work_types`
--
ALTER TABLE `work_types`
  MODIFY `work_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `fk_Accounts_Grants1` FOREIGN KEY (`grant_id`) REFERENCES `grants` (`grant_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Accounts_Users1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `fk_Activities_ActionSkillKnowledge1` FOREIGN KEY (`activity_type_id`) REFERENCES `activity_types` (`activity_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Activities_WorkFunctions1` FOREIGN KEY (`work_function_id`) REFERENCES `work_functions` (`work_function_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_activities_competencies1` FOREIGN KEY (`competence_id`) REFERENCES `competencies` (`competence_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `cabinet_fund`
--
ALTER TABLE `cabinet_fund`
  ADD CONSTRAINT `fk_сabinet_fund_cabinets1` FOREIGN KEY (`cabinet_id`) REFERENCES `cabinets` (`cabinet_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_сabinet_fund_disciplines1` FOREIGN KEY (`discipline_id`) REFERENCES `disciplines` (`discipline_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `competencies`
--
ALTER TABLE `competencies`
  ADD CONSTRAINT `fk_Сompetencies_Fgoses1` FOREIGN KEY (`fgos_id`) REFERENCES `fgos` (`fgos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Сompetencies_TypesСompetence1` FOREIGN KEY (`competence_type_id`) REFERENCES `competence_types` (`competence_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `connections_opop`
--
ALTER TABLE `connections_opop`
  ADD CONSTRAINT `fk_GeneralWorkFunctions_has_Сompetencies_GeneralWorkFunctions1` FOREIGN KEY (`general_work_function_id`) REFERENCES `general_work_functions` (`general_work_function_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_GeneralWorkFunctions_has_Сompetencies_Сompetencies1` FOREIGN KEY (`competence_id`) REFERENCES `competencies` (`competence_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_courses_qualifications1` FOREIGN KEY (`qualification_id`) REFERENCES `qualifications` (`qualification_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `disciplines`
--
ALTER TABLE `disciplines`
  ADD CONSTRAINT `fk_Disciplines_Parts1` FOREIGN KEY (`part_id`) REFERENCES `parts` (`part_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_disciplines_modules1` FOREIGN KEY (`module_id`) REFERENCES `modules` (`module_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_disciplines_pulpits1` FOREIGN KEY (`pulpit_id`) REFERENCES `pulpits` (`pulpit_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `fgos`
--
ALTER TABLE `fgos`
  ADD CONSTRAINT `fk_Fgoses_Courses1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `general_work_functions`
--
ALTER TABLE `general_work_functions`
  ADD CONSTRAINT `fk_GeneralWorkFunctions_ProfStandards1` FOREIGN KEY (`prof_standard_id`) REFERENCES `prof_standards` (`prof_standard_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `fk_Groups_Profiles1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`profile_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Groups_StudyForms1` FOREIGN KEY (`study_form_id`) REFERENCES `study_forms` (`study_form_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `fk_Missions_RUP1` FOREIGN KEY (`rup_id`) REFERENCES `rup` (`rup_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `fk_Profiles_Courses1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `prof_standards`
--
ALTER TABLE `prof_standards`
  ADD CONSTRAINT `fk_ProfStandards_Fgoses1` FOREIGN KEY (`fgos_id`) REFERENCES `fgos` (`fgos_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `pulpits`
--
ALTER TABLE `pulpits`
  ADD CONSTRAINT `fk_pulpits_institutes1` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`institute_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `rup`
--
ALTER TABLE `rup`
  ADD CONSTRAINT `fk_RUP_Disciplines1` FOREIGN KEY (`discipline_id`) REFERENCES `disciplines` (`discipline_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_RUP_Profiles1` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`profile_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_RUP_Tasks1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `second_works`
--
ALTER TABLE `second_works`
  ADD CONSTRAINT `fk_SecondWorks_RUP1` FOREIGN KEY (`rup_id`) REFERENCES `rup` (`rup_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_SecondWorks_WorkTypes1` FOREIGN KEY (`work_type_id`) REFERENCES `work_types` (`work_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `study_plan`
--
ALTER TABLE `study_plan`
  ADD CONSTRAINT `fk_Disciplines_has_Seminars_ControlForms1` FOREIGN KEY (`control_form_id`) REFERENCES `control_forms` (`control_form_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Disciplines_has_Seminars_Seminars1` FOREIGN KEY (`seminar_id`) REFERENCES `seminars` (`seminar_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_study_plan_disciplines1` FOREIGN KEY (`discipline_id`) REFERENCES `disciplines` (`discipline_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_study_plan_study_forms1` FOREIGN KEY (`study_form_id`) REFERENCES `study_forms` (`study_form_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_Tasks_Statuses2` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tasks_accounts1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `fk_teachers_academic_degrees1` FOREIGN KEY (`academic_degree_id`) REFERENCES `academic_degrees` (`academic_degree_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teachers_academic_ranks1` FOREIGN KEY (`academic_rank_id`) REFERENCES `academic_ranks` (`academic_rank_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `teacher_educations`
--
ALTER TABLE `teacher_educations`
  ADD CONSTRAINT `fk_teachers_has_educations_educations1` FOREIGN KEY (`education_id`) REFERENCES `educations` (`education_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teachers_has_educations_teachers1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `teacher_positions`
--
ALTER TABLE `teacher_positions`
  ADD CONSTRAINT `fk_teachers_has_positions_positions1` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teachers_has_positions_teachers1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `fk_Topics_Disciplines1` FOREIGN KEY (`discipline_id`) REFERENCES `disciplines` (`discipline_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Topics_TopicTypes1` FOREIGN KEY (`topic_type_id`) REFERENCES `topic_types` (`topic_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `work_functions`
--
ALTER TABLE `work_functions`
  ADD CONSTRAINT `fk_WorkFunctions_GeneralWorkFunctions1` FOREIGN KEY (`general_work_function_id`) REFERENCES `general_work_functions` (`general_work_function_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
