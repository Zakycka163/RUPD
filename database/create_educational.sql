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
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `short_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `academic_degrees`
--

INSERT INTO `academic_degrees` (`id`, `full_name`, `short_name`) VALUES
(1, 'Магистр', 'маг'),
(2, 'Доктор архитектуры', 'д-р архитектуры'),
(3, 'Доктор биологических наук', 'д-р биол. наук'),
(4, 'Доктор ветеринарных наук', 'д-р ветеринар. наук'),
(5, 'Доктор военных наук', 'д-р воен. наук'),
(6, 'Доктор географических наук', 'д-р геогр. наук'),
(7, 'Доктор геолого-минералогических наук', 'д-р геол.-минерал. наук'),
(8, 'Доктор искусствоведения', 'д-р искусствоведения'),
(9, 'Доктор исторических наук', 'д-р ист. наук'),
(10, 'Доктор культурологии', 'д-р культурологии'),
(11, 'Доктор медицинских наук', 'д-р мед. наук'),
(12, 'Доктор педагогических наук', 'д-р пед. наук'),
(13, 'Доктор политических наук', 'д-р полит. наук'),
(14, 'Доктор психологических наук', 'д-р психол. наук'),
(15, 'Доктор социологических наук', 'д-р социол. наук'),
(16, 'Доктор сельскохозяйственных наук', 'д-р с.-х. наук'),
(17, 'Доктор технических наук', 'д-р техн. наук'),
(18, 'Доктор фармацевтических наук', 'д-р фармацевт. наук'),
(19, 'Доктор физико-математических наук', 'д-р физ.-мат. наук'),
(20, 'Доктор филологических наук', 'д-р филол. наук'),
(21, 'Доктор философских наук', 'д-р филос. наук'),
(22, 'Доктор химических наук', 'д-р хим. наук'),
(23, 'Доктор экономических наук', 'д-р экон. наук'),
(24, 'Доктор юридических наук', 'д-р юрид. наук'),
(25, 'Кандидат архитектуры', 'канд. архитектуры'),
(26, 'Кандидат биологических наук', 'канд. биол. наук'),
(27, 'Кандидат ветеринарных наук', 'канд. ветеринар. наук'),
(28, 'Кандидат военных наук', 'канд. воен. наук'),
(29, 'Кандидат географических наук', 'канд. геогр. наук'),
(30, 'Кандидат геолого-минералогических наук', 'канд. геол.-минерал. наук'),
(31, 'Кандидат искусствоведения', 'канд. искусствоведения'),
(32, 'Кандидат исторических наук', 'канд. ист. наук'),
(33, 'Кандидат культурологии', 'канд. культурологии'),
(34, 'Кандидат медицинских наук', 'канд. мед. наук'),
(35, 'Кандидат педагогических наук', 'канд. пед. наук'),
(36, 'Кандидат политических наук', 'канд. полит. наук'),
(37, 'Кандидат психологических наук', 'канд. психол. наук'),
(38, 'Кандидат социологических наук', 'канд. социол. наук'),
(39, 'Кандидат сельскохозяйственных наук', 'канд. с.-х. наук'),
(40, 'Кандидат технических наук', 'канд. техн. наук'),
(41, 'Кандидат фармацевтических наук', 'канд. фармацевт. наук'),
(42, 'Кандидат физико-математических наук', 'канд. физ.-мат. наук'),
(43, 'Кандидат филологических наук', 'канд. филол. наук'),
(44, 'Кандидат философских наук', 'канд. филос. наук'),
(45, 'Кандидат химических наук', 'канд. хим. наук'),
(46, 'Кандидат экономических наук', 'канд. экон. наук'),
(47, 'Кандидат юридических наук', 'канд. юрид. наук');

-- --------------------------------------------------------

--
-- Структура таблицы `academic_ranks`
--

CREATE TABLE `academic_ranks` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(60) NOT NULL,
  `short_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `academic_ranks`
--

INSERT INTO `academic_ranks` (`id`, `full_name`, `short_name`) VALUES
(1, 'Разработчик', 'dev'),
(2, 'Доцент', 'доц.'),
(3, 'Профессор', 'проф.'),
(4, 'Старший научный сотрудник', 'ст. науч. сотр.'),
(5, 'Младший научный сотрудник', 'мл. науч. сотр.'),
(6, 'Академик', 'акад.'),
(7, 'Член-корреспондент', 'чл.-кор.');

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `grant_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`id`, `login`, `password`, `teacher_id`, `grant_id`) VALUES
(1, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `activity_type_id` int(10) UNSIGNED NOT NULL,
  `work_function_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(180) NOT NULL,
  `competence_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `activities`
--

INSERT INTO `activities` (`id`, `activity_type_id`, `work_function_id`, `name`, `competence_id`) VALUES
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
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `activity_types`
--

INSERT INTO `activity_types` (`id`, `name`) VALUES
(6, 'Владеет'),
(4, 'Знает'),
(3, 'Необходимые знания'),
(2, 'Необходимые умения'),
(1, 'Трудовые действия'),
(5, 'Умеет');

-- --------------------------------------------------------

--
-- Структура таблицы `competence_types`
--

CREATE TABLE `competence_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `competence_types`
--

INSERT INTO `competence_types` (`id`, `name`, `code`) VALUES
(1, 'Универсальные компетенции', 'УК'),
(2, 'Общепрофессиональные компетенции', 'ОПК'),
(3, 'Профессиональные компетенции', 'ПК');

-- --------------------------------------------------------

--
-- Структура таблицы `competencies`
--

CREATE TABLE `competencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `fgos_id` int(10) UNSIGNED NOT NULL,
  `competence_type_id` int(10) UNSIGNED DEFAULT NULL,
  `number` varchar(10) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `connections_opop`
--

CREATE TABLE `connections_opop` (
  `general_work_function_id` int(10) UNSIGNED NOT NULL,
  `competence_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(180) DEFAULT NULL
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
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `control_forms`
--

INSERT INTO `control_forms` (`id`, `name`) VALUES
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
  `id` int(10) UNSIGNED NOT NULL,
  `number` varchar(10) NOT NULL,
  `name` varchar(60) NOT NULL,
  `qualification_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id`, `number`, `name`, `qualification_id`) VALUES
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
  `id` int(10) UNSIGNED NOT NULL,
  `pulpit_id` int(10) UNSIGNED NOT NULL,
  `part_id` int(10) UNSIGNED NOT NULL,
  `module_id` int(11) UNSIGNED NOT NULL,
  `index_info` varchar(10) NOT NULL,
  `name` varchar(180) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `disciplines`
--

INSERT INTO `disciplines` (`id`, `pulpit_id`, `part_id`, `module_id`, `index_info`, `name`, `time`) VALUES
(1, 13, 1, 1, 'A1', 'Тестовая', 100),
(2, 13, 1, 1, 'A1', 'Тестовая 2', 100);

-- --------------------------------------------------------

--
-- Структура таблицы `educations`
--

CREATE TABLE `educations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `fgos`
--

CREATE TABLE `fgos` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `number` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `reg_number` varchar(10) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `fgos`
--

INSERT INTO `fgos` (`id`, `course_id`, `number`, `date`, `reg_number`, `reg_date`) VALUES
(1, 22, '932', '2017-10-19', '112', '2020-04-30'),
(21, 14, '123', '2019-11-22', '321', '2019-11-21');

-- --------------------------------------------------------

--
-- Структура таблицы `general_work_functions`
--

CREATE TABLE `general_work_functions` (
  `id` int(10) UNSIGNED NOT NULL,
  `prof_standard_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(180) NOT NULL,
  `level` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `general_work_functions`
--

INSERT INTO `general_work_functions` (`id`, `prof_standard_id`, `code`, `name`, `level`) VALUES
(1, 1, 'A', 'Создание вариантов архитектуры программного средства', 4),
(2, 1, 'D', 'Оценка требований к программному средству', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `grants`
--

CREATE TABLE `grants` (
  `id` int(10) UNSIGNED NOT NULL,
  `access` varchar(30) NOT NULL,
  `description` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `grants`
--

INSERT INTO `grants` (`id`, `access`, `description`) VALUES
(1, 'Преподаватель', 'Обычные права'),
(2, 'Администратор', 'Расширенные права');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `study_form_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `profile_id`, `study_form_id`, `description`) VALUES
(1, 'МПРз17', 1, 2, 'Группа разработчика системы');

-- --------------------------------------------------------

--
-- Структура таблицы `institutes`
--

CREATE TABLE `institutes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `institutes`
--

INSERT INTO `institutes` (`id`, `name`, `description`) VALUES
(1, 'Институт дизайна, туризма и социальных технологий', ''),
(2, 'Институт заочного обучения', NULL),
(3, 'Институт экономики', NULL),
(4, 'Факультет информационно – технического сервиса', NULL),
(5, 'Факультет среднего профессионального образования', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `missions`
--

CREATE TABLE `missions` (
  `id` int(10) UNSIGNED NOT NULL,
  `rup_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `modules`
--

INSERT INTO `modules` (`id`, `name`) VALUES
(1, 'Модуль 1');

-- --------------------------------------------------------

--
-- Структура таблицы `parts`
--

CREATE TABLE `parts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `parts`
--

INSERT INTO `parts` (`id`, `name`) VALUES
(1, 'базовой'),
(2, 'вариативной');

-- --------------------------------------------------------

--
-- Структура таблицы `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `positions`
--

INSERT INTO `positions` (`id`, `name`) VALUES
(4, 'Ассистент'),
(6, 'Декан ФИТС'),
(3, 'Доцент'),
(5, 'Заведующий кафедрой'),
(7, 'Заведующий лабораторией'),
(13, 'Инженер-лаборант'),
(12, 'Почасовик'),
(10, 'Преподаватель-практик'),
(2, 'Профессор'),
(1, 'Разработчик ИС формирования РУПД'),
(11, 'Специалист по работе с документами'),
(8, 'Старший преподаватель'),
(9, 'Старший преподаватель-практик');

-- --------------------------------------------------------

--
-- Структура таблицы `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `profiles`
--

INSERT INTO `profiles` (`id`, `course_id`, `name`, `description`) VALUES
(1, 22, 'Разработка программно-информационных систем', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `prof_standards`
--

CREATE TABLE `prof_standards` (
  `id` int(10) UNSIGNED NOT NULL,
  `fgos_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(180) NOT NULL,
  `number` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `reg_number` varchar(10) NOT NULL,
  `reg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `prof_standards`
--

INSERT INTO `prof_standards` (`id`, `fgos_id`, `code`, `name`, `number`, `date`, `reg_number`, `reg_date`) VALUES
(1, 1, '06.003', 'Архитектор программного обеспечения', '228н', '2014-04-02', '', '0000-00-00'),
(2, 1, '06.017', 'Руководитель разработки программного обеспечения', '645н', '2014-10-17', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Структура таблицы `pulpits`
--

CREATE TABLE `pulpits` (
  `id` int(10) UNSIGNED NOT NULL,
  `institute_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pulpits`
--

INSERT INTO `pulpits` (`id`, `institute_id`, `name`, `description`) VALUES
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
(13, 4, 'Информационный и электронный сервис', ''),
(14, 4, 'Математические и естественно-научные дисциплины', NULL),
(15, 4, 'Сервис технических и технологических систем', NULL),
(16, 4, 'Управление качеством и инновационные технологии', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `qualifications`
--

CREATE TABLE `qualifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `qualifications`
--

INSERT INTO `qualifications` (`id`, `name`) VALUES
(1, 'бакалавриат'),
(3, 'магистратура'),
(2, 'специалитет');

-- --------------------------------------------------------

--
-- Структура таблицы `rup`
--

CREATE TABLE `rup` (
  `id` int(10) UNSIGNED NOT NULL,
  `discipline_id` int(10) UNSIGNED NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `goal` varchar(180) NOT NULL,
  `task_id` int(10) UNSIGNED DEFAULT NULL,
  `path` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `second_works`
--

CREATE TABLE `second_works` (
  `id` int(10) UNSIGNED NOT NULL,
  `work_type_id` int(10) UNSIGNED NOT NULL,
  `rup_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `seminars`
--

CREATE TABLE `seminars` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `seminars`
--

INSERT INTO `seminars` (`id`, `description`) VALUES
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
  `id` int(10) UNSIGNED NOT NULL,
  `value` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `study_forms`
--

CREATE TABLE `study_forms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `study_forms`
--

INSERT INTO `study_forms` (`id`, `name`) VALUES
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
  `id` int(10) UNSIGNED NOT NULL,
  `objective` varchar(180) NOT NULL,
  `due_date` date NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `account_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE `teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) DEFAULT NULL,
  `second_name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `academic_degree_id` int(10) UNSIGNED DEFAULT NULL,
  `academic_rank_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`id`, `first_name`, `middle_name`, `second_name`, `email`, `academic_degree_id`, `academic_rank_id`) VALUES
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
  `description` varchar(180) DEFAULT NULL
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
  `id` int(10) UNSIGNED NOT NULL,
  `topic_type_id` int(10) UNSIGNED NOT NULL,
  `discipline_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(180) NOT NULL,
  `description` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `topic_types`
--

CREATE TABLE `topic_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `work_functions`
--

CREATE TABLE `work_functions` (
  `id` int(10) UNSIGNED NOT NULL,
  `general_work_function_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `work_functions`
--

INSERT INTO `work_functions` (`id`, `general_work_function_id`, `code`, `name`) VALUES
(1, 1, 'A/01.4', 'Определение перечня возможных типов для каждого компонента'),
(2, 1, 'A/02.4', 'Определение перечня возможных архитектур развертывания каждого компонента'),
(3, 2, 'D/01.5', 'Оценка возможности тестирования требований');

-- --------------------------------------------------------

--
-- Структура таблицы `work_types`
--

CREATE TABLE `work_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `academic_degrees`
--
ALTER TABLE `academic_degrees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD UNIQUE KEY `short_name_UNIQUE` (`short_name`) USING BTREE,
  ADD UNIQUE KEY `full_name_UNIQUE` (`full_name`) USING BTREE;

--
-- Индексы таблицы `academic_ranks`
--
ALTER TABLE `academic_ranks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD UNIQUE KEY `full_name_UNIQUE` (`full_name`) USING BTREE,
  ADD UNIQUE KEY `short_name_UNIQUE` (`short_name`);

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_accounts_teachers_idx` (`teacher_id`) USING BTREE,
  ADD KEY `fk_accounts_grants_idx` (`grant_id`) USING BTREE;

--
-- Индексы таблицы `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_activities_activity_types_idx` (`activity_type_id`) USING BTREE,
  ADD KEY `fk_activities_competencies_idx` (`competence_id`) USING BTREE,
  ADD KEY `fk_activities_work_functions_idx` (`work_function_id`) USING BTREE;

--
-- Индексы таблицы `activity_types`
--
ALTER TABLE `activity_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD UNIQUE KEY `name_UNIQUE` (`name`) USING BTREE;

--
-- Индексы таблицы `competence_types`
--
ALTER TABLE `competence_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `code_UNIQUE` (`code`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `competencies`
--
ALTER TABLE `competencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_competencies_competence_types_idx` (`competence_type_id`) USING BTREE,
  ADD KEY `fk_competencies_fgoses_idx` (`fgos_id`) USING BTREE;

--
-- Индексы таблицы `connections_opop`
--
ALTER TABLE `connections_opop`
  ADD PRIMARY KEY (`general_work_function_id`,`competence_id`),
  ADD KEY `fk_connections_opop_has_competencies_idx` (`competence_id`) USING BTREE,
  ADD KEY `fk_connections_opop_has_general_work_functions_idx` (`general_work_function_id`) USING BTREE;

--
-- Индексы таблицы `constants`
--
ALTER TABLE `constants`
  ADD UNIQUE KEY `key_UNIQUE` (`key`);

--
-- Индексы таблицы `control_forms`
--
ALTER TABLE `control_forms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number_UNIQUE` (`number`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_courses_qualifications_idx` (`qualification_id`) USING BTREE;

--
-- Индексы таблицы `disciplines`
--
ALTER TABLE `disciplines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_disciplines_parts_idx` (`part_id`) USING BTREE,
  ADD KEY `fk_disciplines_pulpits_idx` (`pulpit_id`) USING BTREE,
  ADD KEY `fk_disciplines_modules_idx` (`module_id`) USING BTREE;

--
-- Индексы таблицы `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `fgos`
--
ALTER TABLE `fgos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_fgoses_courses_idx` (`course_id`) USING BTREE;

--
-- Индексы таблицы `general_work_functions`
--
ALTER TABLE `general_work_functions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_general_work_functions_prof_standards_idx` (`prof_standard_id`) USING BTREE;

--
-- Индексы таблицы `grants`
--
ALTER TABLE `grants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `access_UNIQUE` (`access`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_groups_profiles_idx` (`profile_id`) USING BTREE,
  ADD KEY `fk_groups_study_forms_idx` (`study_form_id`) USING BTREE;

--
-- Индексы таблицы `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_missions_rup_idx` (`rup_id`) USING BTREE;

--
-- Индексы таблицы `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_profiles_courses_idx` (`course_id`) USING BTREE;

--
-- Индексы таблицы `prof_standards`
--
ALTER TABLE `prof_standards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_prof_standards_fgos_idx` (`fgos_id`) USING BTREE;

--
-- Индексы таблицы `pulpits`
--
ALTER TABLE `pulpits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_pulpits_institutes_idx` (`institute_id`) USING BTREE;

--
-- Индексы таблицы `qualifications`
--
ALTER TABLE `qualifications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `rup`
--
ALTER TABLE `rup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_rup_disciplines_idx` (`discipline_id`) USING BTREE,
  ADD KEY `fk_rup_tasks_idx` (`task_id`) USING BTREE,
  ADD KEY `fk_rup_profiles_idx` (`profile_id`) USING BTREE;

--
-- Индексы таблицы `second_works`
--
ALTER TABLE `second_works`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_second_works_rup_idx` (`rup_id`) USING BTREE,
  ADD KEY `fk_second_works_work_types_idx` (`work_type_id`) USING BTREE;

--
-- Индексы таблицы `seminars`
--
ALTER TABLE `seminars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `value_UNIQUE` (`value`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `study_forms`
--
ALTER TABLE `study_forms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `study_plan`
--
ALTER TABLE `study_plan`
  ADD PRIMARY KEY (`seminar_id`,`discipline_id`,`study_form_id`),
  ADD KEY `fk_study_plan_has_seminars_idx` (`seminar_id`) USING BTREE,
  ADD KEY `fk_study_plan_has_disciplines_idx` (`discipline_id`) USING BTREE,
  ADD KEY `fk_study_plan_control_forms_idx` (`control_form_id`) USING BTREE,
  ADD KEY `fk_study_plan_has_study_forms_idx` (`study_form_id`) USING BTREE;

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_tasks_statuses_idx` (`status_id`) USING BTREE,
  ADD KEY `fk_tasks_accounts_idx` (`account_id`) USING BTREE;

--
-- Индексы таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_teachers_academic_degrees_idx` (`academic_degree_id`) USING BTREE,
  ADD KEY `fk_teachers_academic_ranks_idx` (`academic_rank_id`) USING BTREE;

--
-- Индексы таблицы `teacher_educations`
--
ALTER TABLE `teacher_educations`
  ADD PRIMARY KEY (`teacher_id`,`education_id`),
  ADD KEY `fk_teacher_educations_has_educations_idx` (`education_id`) USING BTREE,
  ADD KEY `fk_teachers_educations_has_teachers_idx` (`teacher_id`) USING BTREE;

--
-- Индексы таблицы `teacher_positions`
--
ALTER TABLE `teacher_positions`
  ADD PRIMARY KEY (`teacher_id`,`position_id`),
  ADD KEY `fk_teachers_positions_has_positions_idx` (`position_id`) USING BTREE,
  ADD KEY `fk_teachers_positions_has_teachers_idx` (`teacher_id`) USING BTREE;

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_topics_disciplines_idx` (`discipline_id`) USING BTREE,
  ADD KEY `fk_topics_topic_types_idx` (`topic_type_id`) USING BTREE;

--
-- Индексы таблицы `topic_types`
--
ALTER TABLE `topic_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `work_functions`
--
ALTER TABLE `work_functions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_work_functions_general_work_functions_idx` (`general_work_function_id`) USING BTREE;

--
-- Индексы таблицы `work_types`
--
ALTER TABLE `work_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `academic_degrees`
--
ALTER TABLE `academic_degrees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT для таблицы `academic_ranks`
--
ALTER TABLE `academic_ranks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `activity_types`
--
ALTER TABLE `activity_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `competence_types`
--
ALTER TABLE `competence_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `competencies`
--
ALTER TABLE `competencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `control_forms`
--
ALTER TABLE `control_forms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `educations`
--
ALTER TABLE `educations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `fgos`
--
ALTER TABLE `fgos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `general_work_functions`
--
ALTER TABLE `general_work_functions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `grants`
--
ALTER TABLE `grants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `institutes`
--
ALTER TABLE `institutes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `missions`
--
ALTER TABLE `missions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT для таблицы `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `prof_standards`
--
ALTER TABLE `prof_standards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `pulpits`
--
ALTER TABLE `pulpits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `qualifications`
--
ALTER TABLE `qualifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `rup`
--
ALTER TABLE `rup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `second_works`
--
ALTER TABLE `second_works`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `seminars`
--
ALTER TABLE `seminars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `study_forms`
--
ALTER TABLE `study_forms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2326;

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `topic_types`
--
ALTER TABLE `topic_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `work_functions`
--
ALTER TABLE `work_functions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `work_types`
--
ALTER TABLE `work_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `fk_accounts_grants` FOREIGN KEY (`grant_id`) REFERENCES `grants` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_accounts_users` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `fk_activities_activity_types` FOREIGN KEY (`activity_type_id`) REFERENCES `activity_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_activities_work_functions` FOREIGN KEY (`work_function_id`) REFERENCES `work_functions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_activities_competencies` FOREIGN KEY (`competence_id`) REFERENCES `competencies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `competencies`
--
ALTER TABLE `competencies`
  ADD CONSTRAINT `fk_competencies_fgos` FOREIGN KEY (`fgos_id`) REFERENCES `fgos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_competencies_competence_types` FOREIGN KEY (`competence_type_id`) REFERENCES `competence_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `connections_opop`
--
ALTER TABLE `connections_opop`
  ADD CONSTRAINT `fk_connections_opop_has_general_work_functions` FOREIGN KEY (`general_work_function_id`) REFERENCES `general_work_functions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_connections_opop_has_competencies` FOREIGN KEY (`competence_id`) REFERENCES `competencies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_courses_qualifications` FOREIGN KEY (`qualification_id`) REFERENCES `qualifications` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `disciplines`
--
ALTER TABLE `disciplines`
  ADD CONSTRAINT `fk_disciplines_parts` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_disciplines_modules` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_disciplines_pulpits` FOREIGN KEY (`pulpit_id`) REFERENCES `pulpits` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `fgos`
--
ALTER TABLE `fgos`
  ADD CONSTRAINT `fk_fgoses_courses` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `general_work_functions`
--
ALTER TABLE `general_work_functions`
  ADD CONSTRAINT `fk_general_work_functions_prof_standards` FOREIGN KEY (`prof_standard_id`) REFERENCES `prof_standards` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `fk_groups_profiles` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_groups_study_forms` FOREIGN KEY (`study_form_id`) REFERENCES `study_forms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `fk_missions_rup` FOREIGN KEY (`rup_id`) REFERENCES `rup` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `fk_profiles_courses` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `prof_standards`
--
ALTER TABLE `prof_standards`
  ADD CONSTRAINT `fk_prof_standards_fgos` FOREIGN KEY (`fgos_id`) REFERENCES `fgos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `pulpits`
--
ALTER TABLE `pulpits`
  ADD CONSTRAINT `fk_pulpits_institutes` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `rup`
--
ALTER TABLE `rup`
  ADD CONSTRAINT `fk_rup_disciplines` FOREIGN KEY (`discipline_id`) REFERENCES `disciplines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rup_profiles` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rup_tasks` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `second_works`
--
ALTER TABLE `second_works`
  ADD CONSTRAINT `fk_second_works_rup` FOREIGN KEY (`rup_id`) REFERENCES `rup` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_second_works_work_types` FOREIGN KEY (`work_type_id`) REFERENCES `work_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `study_plan`
--
ALTER TABLE `study_plan`
  ADD CONSTRAINT `fk_study_plan_has_control_forms` FOREIGN KEY (`control_form_id`) REFERENCES `control_forms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_study_plan_has_seminars` FOREIGN KEY (`seminar_id`) REFERENCES `seminars` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_study_plan_disciplines` FOREIGN KEY (`discipline_id`) REFERENCES `disciplines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_study_plan_study_forms` FOREIGN KEY (`study_form_id`) REFERENCES `study_forms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_tasks_statuses` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tasks_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `fk_teachers_academic_degrees` FOREIGN KEY (`academic_degree_id`) REFERENCES `academic_degrees` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teachers_academic_ranks` FOREIGN KEY (`academic_rank_id`) REFERENCES `academic_ranks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `teacher_educations`
--
ALTER TABLE `teacher_educations`
  ADD CONSTRAINT `fk_teachers_has_educations_educations` FOREIGN KEY (`education_id`) REFERENCES `educations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teachers_has_educations_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `teacher_positions`
--
ALTER TABLE `teacher_positions`
  ADD CONSTRAINT `fk_teachers_has_positions_positions` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_teachers_has_positions_teachers` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `fk_topics_disciplines` FOREIGN KEY (`discipline_id`) REFERENCES `disciplines` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_topics_topic_types` FOREIGN KEY (`topic_type_id`) REFERENCES `topic_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `work_functions`
--
ALTER TABLE `work_functions`
  ADD CONSTRAINT `fk_work_functions_general_work_functions` FOREIGN KEY (`general_work_function_id`) REFERENCES `general_work_functions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
