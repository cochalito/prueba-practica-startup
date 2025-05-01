CREATE DATABASE IF NOT EXISTS `copia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `copia`;


CREATE TABLE `resources` (
  `id` int NOT NULL COMMENT 'ID Column',
  `type` int NOT NULL COMMENT '1: Clase, 2: Examen',
  `name` mediumtext COMMENT 'Nombre de Recurso',
  `value` int NOT NULL COMMENT '1: Ponderacion 1, 2: Ponderacion 2, 3: Ponderacion 3, 4: Ponderacion 4, 5: Ponderacion 5, 6: Tipo Seleccion, 7: Tipo Pregunta y Respuesta, 8: Tipo Completacion\r\n',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1: Activo, 0: Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `resources`
--

INSERT INTO `resources` (`id`, `type`, `name`, `value`, `status`) VALUES
(1, 1, 'Vocabulario sobre Trabajo en Inglés', 5, 1),
(2, 1, 'Conversaciones de Trabajo en Inglés', 5, 1),
(3, 2, 'Trabajos y ocupaciones en Inglés', 6, 1),
(4, 2, 'Gramática francesa', 8, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RESOURCES_NAME` (`name`(100));

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID Column', AUTO_INCREMENT=5;

