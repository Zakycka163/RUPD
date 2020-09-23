SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- База данных: `mydb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `attr_type_id` int(11) NOT NULL,
  `attr_type_def_id` int(11) NOT NULL,
  `attr_group_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `attr_groups`
--

CREATE TABLE `attr_groups` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `attr_object_types`
--

CREATE TABLE `attr_object_types` (
  `id` int(11) NOT NULL,
  `ot_id` int(11) NOT NULL,
  `required` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `attr_types`
--

CREATE TABLE `attr_types` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `attr_type_defs`
--

CREATE TABLE `attr_type_defs` (
  `id` int(11) NOT NULL,
  `attr_type_id` int(11) NOT NULL,
  `ot_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `configs`
--

CREATE TABLE `configs` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `list_values`
--

CREATE TABLE `list_values` (
  `id` int(11) NOT NULL,
  `attr_type_def_id` int(11) NOT NULL,
  `value` varchar(200) NOT NULL,
  `comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `objects`
--

CREATE TABLE `objects` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `ot_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `comment` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `object_types`
--

CREATE TABLE `object_types` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `pic_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `params`
--

CREATE TABLE `params` (
  `attr_id` int(11) NOT NULL,
  `ot_id` int(11) NOT NULL,
  `value` varchar(300) DEFAULT NULL,
  `list_value_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `url` varchar(500) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `references`
--

CREATE TABLE `references` (
  `attr_id` int(11) NOT NULL,
  `reference` int(11) NOT NULL,
  `object_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_attributes_attr_types_idx` (`attr_type_id`) USING BTREE,
  ADD KEY `fk_attributes_attr_groups_idx` (`attr_group_id`) USING BTREE,
  ADD KEY `fk_attributes_attr_type_defs_idx` (`attr_type_def_id`) USING BTREE;

--
-- Индексы таблицы `attr_groups`
--
ALTER TABLE `attr_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_attr_groups_attr_groups_idx` (`parent_id`) USING BTREE;

--
-- Индексы таблицы `attr_object_types`
--
ALTER TABLE `attr_object_types`
  ADD KEY `fk_attr_object_types_attributes_idx` (`id`) USING BTREE,
  ADD KEY `fk_attr_object_types_object_types_idx` (`ot_id`) USING BTREE;

--
-- Индексы таблицы `attr_types`
--
ALTER TABLE `attr_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `attr_type_defs`
--
ALTER TABLE `attr_type_defs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_attr_type_defs_attr_types_idx` (`attr_type_id`) USING BTREE,
  ADD KEY `fk_attr_type_defs_object_types_idx` (`ot_id`) USING BTREE;

--
-- Индексы таблицы `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Индексы таблицы `list_values`
--
ALTER TABLE `list_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_list_values_attr_type_defs_idx` (`attr_type_def_id`) USING BTREE;

--
-- Индексы таблицы `objects`
--
ALTER TABLE `objects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_objects_object_types_idx` (`ot_id`),
  ADD KEY `fk_objects_objects_idx` (`parent_id`) USING BTREE;

--
-- Индексы таблицы `object_types`
--
ALTER TABLE `object_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE,
  ADD KEY `fk_object_types_object_types_idx` (`parent_id`) USING BTREE,
  ADD KEY `fk_object_types_pictures_idx` (`pic_id`) USING BTREE;

--
-- Индексы таблицы `params`
--
ALTER TABLE `params`
  ADD KEY `fk_params_attributes_idx` (`attr_id`) USING BTREE,
  ADD KEY `fk_params_list_values_idx` (`list_value_id`) USING BTREE,
  ADD KEY `fk_params_object_types_idx` (`ot_id`) USING BTREE;

--
-- Индексы таблицы `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE;

--
-- Индексы таблицы `references`
--
ALTER TABLE `references`
  ADD KEY `fk_references_objects1_idx` (`reference`),
  ADD KEY `fk_references_objects2_idx` (`object_id`),
  ADD KEY `fk_references_attributes_idx` (`attr_id`) USING BTREE;

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `attr_groups`
--
ALTER TABLE `attr_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `attr_types`
--
ALTER TABLE `attr_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `attr_type_defs`
--
ALTER TABLE `attr_type_defs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `list_values`
--
ALTER TABLE `list_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `objects`
--
ALTER TABLE `objects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `object_types`
--
ALTER TABLE `object_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `attributes`
--
ALTER TABLE `attributes`
  ADD CONSTRAINT `fk_attributes_attr_groups` FOREIGN KEY (`attr_group_id`) REFERENCES `attr_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_attributes_attr_type_defs` FOREIGN KEY (`attr_type_def_id`) REFERENCES `attr_type_defs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_attributes_attr_types` FOREIGN KEY (`attr_type_id`) REFERENCES `attr_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `attr_groups`
--
ALTER TABLE `attr_groups`
  ADD CONSTRAINT `fk_attr_groups_attr_groups` FOREIGN KEY (`parent_id`) REFERENCES `attr_groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `attr_object_types`
--
ALTER TABLE `attr_object_types`
  ADD CONSTRAINT `fk_attr_object_types_attributes` FOREIGN KEY (`id`) REFERENCES `attributes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_attr_object_types_object_types` FOREIGN KEY (`ot_id`) REFERENCES `object_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `attr_type_defs`
--
ALTER TABLE `attr_type_defs`
  ADD CONSTRAINT `fk_attr_type_defs_attr_types` FOREIGN KEY (`attr_type_id`) REFERENCES `attr_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_attr_type_defs_object_types` FOREIGN KEY (`ot_id`) REFERENCES `object_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `list_values`
--
ALTER TABLE `list_values`
  ADD CONSTRAINT `fk_list_values_attr_type_defs` FOREIGN KEY (`attr_type_def_id`) REFERENCES `attr_type_defs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `objects`
--
ALTER TABLE `objects`
  ADD CONSTRAINT `fk_objects_object_types` FOREIGN KEY (`ot_id`) REFERENCES `object_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_objects_objects` FOREIGN KEY (`parent_id`) REFERENCES `objects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `object_types`
--
ALTER TABLE `object_types`
  ADD CONSTRAINT `fk_object_types_object_types` FOREIGN KEY (`parent_id`) REFERENCES `object_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_object_types_pictures` FOREIGN KEY (`pic_id`) REFERENCES `pictures` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `params`
--
ALTER TABLE `params`
  ADD CONSTRAINT `fk_params_attributes` FOREIGN KEY (`attr_id`) REFERENCES `attributes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_params_list_values` FOREIGN KEY (`list_value_id`) REFERENCES `list_values` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_params_object_types` FOREIGN KEY (`ot_id`) REFERENCES `object_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `references`
--
ALTER TABLE `references`
  ADD CONSTRAINT `fk_references_attributes` FOREIGN KEY (`attr_id`) REFERENCES `attributes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_references_objects1` FOREIGN KEY (`reference`) REFERENCES `objects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_references_objects2` FOREIGN KEY (`object_id`) REFERENCES `objects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
