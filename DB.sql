#CREATE DATABASE ipasme;

CREATE TABLE especialidades(
    idespecialidad INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)ENGINE = INNODB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE niveles(
    idnivel INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(25) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)ENGINE = INNODB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE usuarios(
    idusuario INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    idnivel INT UNSIGNED NOT NULL,
    cedula VARCHAR(25) UNIQUE NOT NULL,
    nombres VARCHAR(200) NOT NULL,
    apellidos VARCHAR(200) NOT NULL,
    correo VARCHAR(45) UNIQUE NOT NULL,
    cuenta VARCHAR(255) NOT NULL,
    clave VARCHAR(255) NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idnivel) REFERENCES niveles(idnivel)
)ENGINE = INNODB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE empresas(
    idempresa INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)ENGINE = INNODB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE medicos(
    idmedico INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    idespecialidad INT UNSIGNED NOT NULL,
    cedula VARCHAR(25) UNIQUE NOT NULL,
    nombres VARCHAR(200) NOT NULL,
    apellidos VARCHAR(200) NOT NULL,
    firma VARCHAR(255) NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idespecialidad) REFERENCES especialidades(idespecialidad)
)ENGINE = INNODB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE tipopaciente(
    idtipopaciente INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(25) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)ENGINE = INNODB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE pacientes(
    idpaciente INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    idtipopaciente INT UNSIGNED NOT NULL,
    idempresa INT UNSIGNED NOT NULL,
    cedula VARCHAR(25) UNIQUE NOT NULL,
    nombres VARCHAR(200) NOT NULL,
    apellidos VARCHAR(200) NOT NULL,
    sexo INT(1) NOT NULL, #1 Masculino , 2 Femenino
    fechaNacimiento DATETIME NOT NULL,
    edad INT(3) NOT NULL,
    telefono VARCHAR(45) UNIQUE NOT NULL,
    direccion VARCHAR(45) NOT NULL,
    correo VARCHAR(45) UNIQUE NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idempresa) REFERENCES empresas(idempresa),
    FOREIGN KEY (idtipopaciente) REFERENCES tipopaciente(idtipopaciente)
)ENGINE = INNODB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE familiares(
    idfamiliar INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    idpaciente INT UNSIGNED NOT NULL,
    parentesco VARCHAR(100) NOT NULL,
    cedula VARCHAR(25) UNIQUE NOT NULL,
    nombres VARCHAR(200) NOT NULL,
    apellidos VARCHAR(200) NOT NULL,
    sexo INT(1) NOT NULL, #1 Masculino , 2 Femenino
    fechaNacimiento DATETIME NOT NULL,
    edad INT(3) NOT NULL,
    telefono VARCHAR(45) UNIQUE NOT NULL,
    direccion VARCHAR(45) NOT NULL,
    correo VARCHAR(45) UNIQUE NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idpaciente) REFERENCES pacientes(idpaciente)
)ENGINE = INNODB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE estudios(
    idestudio INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(200) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
)ENGINE = INNODB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE auditoria(
    idauditoria INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    idusuario INT UNSIGNED NOT NULL,
    tabla VARCHAR(25) NOT NULL,
    accion VARCHAR(25) NOT NULL,
    ip VARCHAR(45) NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idusuario) REFERENCES usuarios(idusuario)
)ENGINE = INNODB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE estudiopaciente(
    idestudiopac INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    idpaciente INT UNSIGNED NOT NULL,
    idestudio INT UNSIGNED NOT NULL,
    idmedico INT UNSIGNED NOT NULL,
    fecha VARCHAR(25) NOT NULL,
    tecnica VARCHAR(45) NOT NULL,
    hallazgo VARCHAR(200) NOT NULL,
    conclusion VARCHAR(255) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    creado TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idpaciente) REFERENCES pacientes(idpaciente),
    FOREIGN KEY (idestudio) REFERENCES estudios(idestudio),
    FOREIGN KEY (idmedico) REFERENCES medicos(idmedico)
)ENGINE = INNODB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;