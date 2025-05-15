-- CREATE USER tareas@'%' IDENTIFIED BY '13579#Aeiou';
-- GRANT ALL PRIVILEGES ON tareas_andres_diaz.* TO tareas@'%' WITH GRANT OPTION;

DROP DATABASE tareas_andres_diaz;
CREATE DATABASE IF NOT EXISTS tareas_andres_diaz;
USE tareas_andres_diaz;

-- CREATE USER tareas@'%' IDENTIFIED BY '13579#Aeiou';
-- GRANT ALL PRIVILEGES ON tareas_andres_diaz.* TO tareas@'%' WITH GRANT OPTION;

-- Creamos la tabla de tareas
CREATE TABLE IF NOT EXISTS tareas (
id_tarea  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
titulo VARCHAR (50),
descripcion VARCHAR (200),
fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
fecha_prevista_fin TIMESTAMP,
modificacion INT NOT NULL,
borrada INT NOT NULL,
id_estado INT NOT NULL,
id_usuario INT NOT NULL
);

-- Creamos una tabla para los estados
CREATE TABLE IF NOT EXISTS estados (
id_estado INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre_estado VARCHAR (15)
);

-- Creamos una tabla para el acceso de usuarios
CREATE TABLE IF NOT EXISTS usuarios_datos (
id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre_usuario VARCHAR(50) NOT NULL,
password VARCHAR(255) NOT NULL
);

-- TRUNCATE TABLE usuarios_datos;

CREATE TABLE IF NOT EXISTS usuarios_detalle (
id_detalle_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre_persona VARCHAR(50) NOT NULL,
apellidos_persona VARCHAR(50) NOT NULL,
email VARCHAR(100),
telefono VARCHAR(15),
id_usuario INT NOT NULL
);

CREATE TABLE IF NOT EXISTS modificaciones (
id_modificacion  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
titulo_modif VARCHAR (50),
descripcion_modif VARCHAR (200),
fecha_pre_modif TIMESTAMP,
id_tarea  INT NOT NULL,
id_estado INT NOT NULL,
id_usuario INT NOT NULL
);

INSERT INTO estados (nombre_estado) VALUES ("Urgente"), ("Pendiente"), ("Ejecución"), ("Finalizada");

-- Relaciones entre tablas --
-- Hay que revisar para que no se borren los estados --
-- Tareas --
-- Tareas <> Estados
ALTER TABLE tareas
ADD CONSTRAINT fk_tareas_estado
FOREIGN KEY (id_estado)
REFERENCES estados(id_estado)
ON DELETE RESTRICT
ON UPDATE RESTRICT
;
-- ALTER TABLE tareas DROP FOREIGN KEY fk_tareas_estado;

-- Tareas <> Usuarios
ALTER TABLE tareas
ADD CONSTRAINT fk_tareas_usuarios_datos
FOREIGN KEY (id_usuario)
REFERENCES usuarios_datos(id_usuario)
ON DELETE RESTRICT
ON UPDATE RESTRICT
;
-- ALTER TABLE tareas DROP FOREIGN KEY fk_tareas_usuarios_datos;

-- Usuarios --
-- Detalle <> Datos
ALTER TABLE usuarios_detalle
ADD CONSTRAINT fk_usuarios_datos_usuarios_detalle
FOREIGN KEY (id_usuario)
REFERENCES usuarios_datos(id_usuario)
ON DELETE RESTRICT
ON UPDATE RESTRICT
;
-- ALTER TABLE usuarios_detalle DROP FOREIGN KEY fk_usuarios_datos_usuarios_detalle;

-- Modificaciones --
-- Modificaciones <> Estados
ALTER TABLE modificaciones
ADD CONSTRAINT fk_modificaciones_estado
FOREIGN KEY (id_estado)
REFERENCES estados(id_estado)
ON DELETE RESTRICT
ON UPDATE RESTRICT
;
-- ALTER TABLE modificaciones DROP FOREIGN KEY fk_modificaciones_estado;

-- Modificaciones <> Tareas
ALTER TABLE modificaciones
ADD CONSTRAINT fk_modificaciones_tareas
FOREIGN KEY (id_tarea)
REFERENCES tareas(id_tarea)
ON DELETE RESTRICT
ON UPDATE RESTRICT
;
-- ALTER TABLE modificaciones DROP FOREIGN KEY fk_modificaciones_tareas;

-- Modificaciones <> Usuarios
ALTER TABLE modificaciones
ADD CONSTRAINT fk_modificaciones_usuarios_datos
FOREIGN KEY (id_usuario)
REFERENCES usuarios_datos(id_usuario)
ON DELETE RESTRICT
ON UPDATE RESTRICT
;
-- ALTER TABLE modificaciones DROP FOREIGN KEY fk_modificaciones_usuarios;

-- Creamos un trigger para las modificaciones
-- De esta forma se nos inserta en la modificacion(actualizacion(UPDATE))

DELIMITER //
CREATE TRIGGER trg_modificacion
BEFORE UPDATE ON tareas
FOR EACH ROW 
BEGIN
 	DECLARE id_tarea_modificacion INT;
    DECLARE id_estado_modificacion INT;
    DECLARE id_usuario_modificacion INT;
	DECLARE titulo_modificacion VARCHAR (50);
	DECLARE descripcion_modificacion VARCHAR (200);
    DECLARE fecha_pre_modificacion TIMESTAMP;
    
    SELECT id_tarea INTO id_tarea_modificacion
    FROM tareas
    WHERE id_tarea = new.id_tarea;
    
	SELECT id_estado INTO id_estado_modificacion
    FROM tareas
    WHERE id_tarea = new.id_tarea;
    
    SELECT id_usuario INTO id_usuario_modificacion
    FROM tareas
    WHERE id_tarea = new.id_tarea;
    
	SELECT titulo INTO titulo_modificacion
    FROM tareas
    WHERE id_tarea = new.id_tarea;
    
	SELECT descripcion INTO descripcion_modificacion
    FROM tareas
    WHERE id_tarea = new.id_tarea;
    
	SELECT fecha_prevista_fin INTO fecha_pre_modificacion
    FROM tareas
    WHERE id_tarea = new.id_tarea;

	INSERT INTO modificaciones (id_tarea, id_estado, id_usuario, titulo_modif, descripcion_modif, fecha_pre_modif)
    VALUES (id_tarea_modificacion, id_estado_modificacion, id_usuario_modificacion, titulo_modificacion, descripcion_modificacion, fecha_pre_modificacion)
    ;
END //
DELIMITER ;
-- DROP TRIGGER trg_modificacion;

