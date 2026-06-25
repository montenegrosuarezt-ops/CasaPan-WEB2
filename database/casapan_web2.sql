-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2026 a las 01:51:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `casapan_web2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `imagen`) VALUES
(1, 'Brunch', NULL),
(2, 'Sandwiches', NULL),
(3, 'Pizzas Artesanales', NULL),
(4, 'Pizzas Especiales', NULL),
(5, 'Bebidas Calientes', NULL),
(6, 'Bebidas Frias', NULL),
(7, 'Tortas y Postres', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle`, `id_pedido`, `id_producto`, `cantidad`, `precio_unitario`, `subtotal`) VALUES
(1, 1, 26, 2, 10.00, 20.00),
(2, 1, 2, 1, 25.00, 25.00),
(3, 2, 26, 1, 10.00, 10.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo_pedido` enum('Mesa','Delivery') NOT NULL,
  `numero_mesa` varchar(10) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` enum('Pendiente','Preparando','Entregado','Cancelado') DEFAULT 'Pendiente',
  `fecha_pedido` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `tipo_pedido`, `numero_mesa`, `direccion`, `total`, `estado`, `fecha_pedido`) VALUES
(1, 2, 'Mesa', '1', NULL, 45.00, 'Cancelado', '2026-06-23 18:18:25'),
(2, 2, 'Mesa', '1', NULL, 10.00, 'Pendiente', '2026-06-24 15:53:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `id_categoria` int(11) NOT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `descripcion`, `precio`, `imagen`, `id_categoria`, `estado`) VALUES
(1, 'Brunch De la Casa', 'Rodajas de pan artesanal, huevo revuelto, jamón ahumado, queso mozzarella y crema de queso.', 20.00, '1782344011_brunch_casa.jpg', 1, 1),
(2, 'Brunch Americano', 'Pan artesanal, waffle tipo belga, huevo revuelto con espinacas, jamón ahumado y crema de queso.', 25.00, '1782344002_brunch_americano.jpg', 1, 1),
(3, 'Brunch Tipo Integral', 'Empanada integral a elección, huevos revueltos con espinacas y jamón de pollo.', 22.00, '1782344022_brunch_integral.jpg', 1, 1),
(4, 'Especial de la Casa (Croissant)', 'Croissant relleno con jamón y queso.', 13.00, '1782343907_croissant_especial.jpg', 2, 1),
(5, 'Panini de jamón y queso', 'Panini con jamón y queso mozzarella.', 20.00, '1782343962_panini_jamon.webp', 2, 1),
(6, 'Pan ciabatta jamón y queso', 'Pan ciabatta con jamón, tomate y espinacas.', 20.00, '1782343937_ciabatta_jamon.avif', 2, 1),
(7, 'Pan ciabatta salame y queso', 'Pan ciabatta con salame y queso mozzarella.', 20.00, '1782343949_ciabatta_salame.avif', 2, 1),
(8, 'Bagel de jamón o salame', 'Bagel artesanal relleno con jamón o salame.', 20.00, '1782343869_bagel.jpg', 2, 1),
(9, 'Pan ciabatta integral de pollo', 'Ciabatta integral con pollo y espinacas.', 20.00, '1782343923_ciabatta_pollo.jpg', 2, 1),
(10, 'Pizza Orégano (M)', 'Pizza artesanal de orégano.', 30.00, '1782344240_pizza_oregano_m.jpg', 3, 1),
(11, 'Pizza Orégano (F)', 'Pizza artesanal familiar de orégano.', 40.00, '1782344229_pizza_oregano_f.jpg', 3, 1),
(12, 'Pizza Napolitana (M)', 'Pizza napolitana mediana.', 30.00, '1782344216_pizza_napolitana_m.jpg', 3, 1),
(13, 'Pizza Napolitana (F)', 'Pizza napolitana familiar.', 45.00, '1782344208_pizza_napolitana_f.jpg', 3, 1),
(14, 'Pizza Margarita (M)', 'Pizza margarita mediana.', 30.00, '1782344194_pizza_margarita_m.jpg', 3, 1),
(15, 'Pizza Margarita (F)', 'Pizza margarita familiar.', 45.00, '1782344182_pizza_margarita_f.jpg', 3, 1),
(16, 'Pizza Champiñones y Aceitunas (M)', 'Pizza mediana de champiñones y aceitunas.', 35.00, '1782344108_pizza_champi_m.jpg', 3, 1),
(17, 'Pizza Champiñones y Aceitunas (F)', 'Pizza familiar de champiñones y aceitunas.', 50.00, '1782344097_pizza_champi_f.jpg', 3, 1),
(18, 'Pizza Jamón y Queso (M)', 'Pizza jamón y queso mediana.', 35.00, '1782344164_pizza_jamon_m.jpg', 3, 1),
(19, 'Pizza Jamón y Queso (F)', 'Pizza jamón y queso familiar.', 50.00, '1782344155_pizza_jamon_f.jpg', 3, 1),
(20, 'Pizza Salame (M)', 'Pizza de salame mediana.', 35.00, '1782344264_pizza_salame_m.jpg', 3, 1),
(21, 'Pizza Salame (F)', 'Pizza de salame familiar.', 50.00, '1782344250_pizza_salame_f.jpg', 3, 1),
(22, 'Pizza Hawaiana (M)', 'Pizza hawaiana mediana.', 35.00, '1782344140_pizza_hawaiana_m.jpg', 4, 1),
(23, 'Pizza Hawaiana (F)', 'Pizza hawaiana familiar.', 50.00, '1782344121_pizza_hawaiana_f.jpg', 4, 1),
(24, 'Pizza Calabresa (M)', 'Pizza calabresa mediana.', 35.00, '1782344082_pizza_calabresa_m.jpg', 4, 1),
(25, 'Pizza Calabresa (F)', 'Pizza calabresa familiar.', 55.00, '1782344068_pizza_calabresa_f.jpg', 4, 1),
(26, 'Americano', 'Café americano caliente.', 10.00, '1782343165_cafe_americano.webp', 5, 1),
(27, 'Latte', 'Café latte cremoso.', 12.00, '1782343473_latte.webp', 5, 1),
(28, 'Cappuccino', 'Cappuccino espumoso.', 12.00, '1782343249_cappuccino.webp', 5, 1),
(29, 'Té caliente con agua', 'Té caliente simple.', 8.00, '1782343505_tea.webp', 5, 1),
(30, 'Cocoa caliente con agua', 'Cocoa preparada con agua.', 10.00, '1782343427_cocoa_agua.jpg', 5, 1),
(31, 'Cocoa caliente con leche', 'Cocoa con leche.', 12.00, '1782343442_cocoa_leche.jpg', 5, 1),
(32, 'Doble Espresso frío con leche', 'Doble espresso frío con leche.', 15.00, '1782343594_doble_espreso.jpg', 6, 1),
(33, 'Mocca frío con leche', 'Mocca frío con leche.', 16.00, '1782343809_mocca_frio.jpg', 6, 1),
(34, 'Jugo de durazno (agua)', 'Jugo de durazno con agua.', 13.00, '1782343625_jugo_durazno.jpg', 6, 1),
(35, 'Jugo de frutilla (agua)', 'Jugo de frutilla con agua.', 13.00, '1782343736_jugo_frutilla.jpg', 6, 1),
(36, 'Jugo de maracuyá (agua)', 'Jugo de maracuyá con agua.', 14.00, '1782343762_maracuya_agua.jpg', 6, 1),
(37, 'Jugo de durazno (leche)', 'Jugo de durazno con leche.', 15.00, '1782343717_durazno_leche.jpg', 6, 1),
(38, 'Jugo de frutilla (leche)', 'Jugo de frutilla con leche.', 15.00, '1782343748_frutilla_leche.jpg', 6, 1),
(39, 'Jugo de maracuyá (leche)', 'Jugo de maracuyá con leche.', 16.00, '1782344386_maracuya_leche.jpg', 6, 1),
(40, 'Torta de chocolate (porción)', 'Porción individual de torta de chocolate.', 12.00, '1782344328_tortas_postres.jpg', 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'Administrador'),
(3, 'Cliente'),
(2, 'Gerente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `id_rol` int(11) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `password`, `telefono`, `id_rol`, `fecha_registro`) VALUES
(1, 'Administrador General', 'admin@casapan.com', '$2y$10$.dNNU.huBG3fJ.1.yRr7KO3b/sfMwtsrddTZwCBQ9J.rT1AYtAqO2', '00000000', 1, '2026-06-16 19:42:50'),
(2, 'Willian Eguez Martinez', 'wem@gmail.com', '$2y$10$sp4orGehRD18LwzXIMb3qOH6qKqQEmVvK2XxhIGLqs33ZzKqQ2tUq', '12254893', 3, '2026-06-17 19:33:03'),
(3, 'Gerente', 'geren@gmail.com', '$2y$10$Zq5fn4MI3wVP8SXverNtruLPmnlEdCL1GtXuqM.6lrEYKdrPpAX1q', '78691542', 3, '2026-06-24 14:17:21'),
(4, 'Juan Gerente', 'gerente@casapan.com', '$2y$10$.r7E1rreESLvwhFs8l6mp.hud8yG3g45ZcAvRkJFNsRWchYd37wwi', '70000000', 2, '2026-06-24 14:24:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `fk_detalle_pedido` (`id_pedido`),
  ADD KEY `fk_detalle_producto` (`id_producto`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_pedido_usuario` (`id_usuario`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_producto_categoria` (`id_categoria`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_usuario_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `fk_detalle_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `fk_detalle_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
