
INSERT INTO `empresas` (`idempresa`, `nombre`, `descripcion`, `creado`) VALUES
(1, 'PDVSA', 'Petroleos de Venezuela', '2018-11-08 04:42:12'),
(2, 'Polar', 'Empresas polar', '2018-11-09 01:17:04');

INSERT INTO `especialidades` (`idespecialidad`, `nombre`, `descripcion`, `creado`) VALUES
(1, 'General', 'Medicina general', '2018-11-09 04:27:58'),
(2, 'Internista', 'Medicina interna', '2018-11-09 04:27:58');

INSERT INTO `medicos` (`idmedico`, `idespecialidad`, `cedula`, `nombres`, `apellidos`, `firma`, `creado`) VALUES
(2, 1, '19651248', 'José', 'Diaz', 'josed', '2018-11-09 04:34:39');

INSERT INTO `niveles` (`idnivel`, `nombre`, `descripcion`, `creado`) VALUES
(1, 'Administrador', 'Administrador del sistema', '2018-11-08 04:42:35'),
(2, 'Operador', 'Operador del sistema', '2018-11-09 03:57:34');

INSERT INTO `tipopaciente` (`idtipopaciente`, `nombre`, `descripcion`, `creado`) VALUES
(1, 'Afiliado', 'Paciente afiliado', '2018-11-08 04:42:35'),
(2, 'Beneficiado', 'Paciente Beneficiado', '2018-11-09 03:57:34'),
(3, 'Comunitario', 'Paciente comunitario', '2018-11-08 04:42:35');

INSERT INTO `pacientes` (`idpaciente`, `idtipopaciente`, `idempresa`, `cedula`, `nombres`, `apellidos`, `sexo`, `correo`, `creado`) VALUES
(1, 1, 1, '19651249', 'Luis E.', 'Rondon', 1, 'leduardo.rondon@gmail.com', '2018-11-08 04:43:40'),
(6, 2, 1, '8220801', 'Luisa', 'Rondon', 2, 'luisa.rondon@gmail.com', '2018-11-08 06:55:33');

INSERT INTO `usuarios` (`idusuario`, `idnivel`, `cedula`, `nombres`, `apellidos`, `correo`, `cuenta`, `clave`, `creado`) VALUES
(1, 1, '19651249', 'Luis Eduardo', 'Rondon', 'leduardo.rondon@gmail.com', 'luiser', '827ccb0eea8a706c4c34a16891f84e7b', '2018-11-08 04:43:08'),
(2, 2, '8220801', 'Luisa', 'Rondon', 'luisa.rondon@gmail.com', 'luisar56', '827ccb0eea8a706c4c34a16891f84e7b', '2018-11-09 03:58:20');
