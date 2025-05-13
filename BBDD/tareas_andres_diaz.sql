CREATE DATABASE IF NOT EXISTS tareas_andres_diaz;

USE tareas_andres_diaz;

-- DROP DATABASE tareas_andres_diaz;

CREATE TABLE IF NOT EXISTS tareas (
id_tarea  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
-- id_usuario INT NOT NULL,
titulo VARCHAR (50),
descripcion VARCHAR (200),
fecha_new TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
fecha_prevista_fin TIMESTAMP,
estado VARCHAR (20),
id_estado INT NOT NULL,
modificacion INT NOT NULL
);

CREATE TABLE IF NOT EXISTS estados (
id_estado  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre_estado VARCHAR (15)
);

INSERT INTO estados (nombre_estado) VALUES ("Urgente");
INSERT INTO estados (nombre_estado) VALUES ("Pendiente");
INSERT INTO estados (nombre_estado) VALUES ("Ejecución");
INSERT INTO estados (nombre_estado) VALUES ("Finalizada");

CREATE TABLE IF NOT EXISTS modificaciones (
id_modificacion  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
id_tarea  INT NOT NULL,
id_estado INT NOT NULL,
titulo_modif VARCHAR (50),
descripcion_modif VARCHAR (200)
);

-- Relaciones entre tablas
-- Tareas <> Estados
ALTER TABLE tareas
ADD CONSTRAINT fk_tareas_estado
FOREIGN KEY (id_estado)
REFERENCES estados(id_estado)
-- Hay que revisar para que no se borren los estados
ON DELETE RESTRICT -- solo borra si no hay más elemntos asociados
ON UPDATE RESTRICT
;
-- ALTER TABLE tareas DROP FOREIGN KEY fk_tareas_estado;

-- Modificaciones <> Tareas
ALTER TABLE modificaciones
ADD CONSTRAINT fk_modificaciones_tarea
FOREIGN KEY (id_tarea)
REFERENCES tareas(id_tarea)
ON DELETE RESTRICT -- solo borra si no hay más elementos asociados
ON UPDATE RESTRICT
;

-- ALTER TABLE modificaciones DROP FOREIGN KEY fk_modificaciones_tarea;

-- Modificaciones <> Estados
ALTER TABLE modificaciones
ADD CONSTRAINT fk_modificaciones_estado
FOREIGN KEY (id_estado)
REFERENCES estados(id_estado)
ON DELETE RESTRICT -- solo borra si no hay más elementos asociados
ON UPDATE RESTRICT
;
-- ALTER TABLE modificaciones DROP FOREIGN KEY fk_modificaciones_estado;

DELIMITER //

CREATE TRIGGER trg_modificacion
BEFORE UPDATE ON tareas
FOR EACH ROW 
BEGIN
 	DECLARE id_tarea_modificacion INT;
    DECLARE id_estado_modificacion INT;
	DECLARE titulo_modificacion VARCHAR (50);
	DECLARE descripcion_modificacion VARCHAR (200);
    
    SELECT id_tarea INTO id_tarea_modificacion
    FROM tareas
    WHERE id_tarea = new.id_tarea;
    
	SELECT id_estado INTO id_estado_modificacion
    FROM tareas
    WHERE id_tarea = new.id_tarea;
    
	SELECT titulo INTO titulo_modificacion
    FROM tareas
    WHERE id_tarea = new.id_tarea;
    
	SELECT descripcion INTO descripcion_modificacion
    FROM tareas
    WHERE id_tarea = new.id_tarea;

	INSERT INTO modificaciones (id_tarea, id_estado, titulo_modif, descripcion_modif)
    VALUES (id_tarea_modificacion, id_estado_modificacion, titulo_modificacion, descripcion_modificacion)
    ;
END //

DELIMITER ;

-- DROP TRIGGER trg_modificacion;

-- Populamos la tabla de tareas

INSERT INTO tareas (titulo, descripcion, fecha_prevista_fin, estado, id_estado, modificacion)
VALUES
("Tarea 1, Crear la BBDD", "Plantear la BBDD y crear el script para generarla", '2025-05-08 23:59:59', "Finalizada", 4, 0),
("Tarea 3, Empezar a programar", "Ponerse a picar código para que este lista a tiempo!", '2025-05-15 23:59:59', "Ejecución", 3, 0),
("Tarea 4, Ver la estructura de la web", "Ponerse a diseñar la estructura para que este lista", '2025-05-14 14:00:00', "Pendiente", 2, 0)
;

INSERT INTO tareas (titulo, descripcion, estado, id_estado, modificacion) 
VALUES
("Tarea 7", "Ponerse a diseñar la estructura para que este lista", "Pendiente", 2, 0),
("Tarea 10", "Ponerse a picar código para que este lista a tiempo!", "Finalizada", 4, 0),
("Tarea 12", "Plantear la BBDD y crear el script para generarla", "Finalizada", 4, 0)
;

INSERT INTO tareas (titulo, descripcion, fecha_prevista_fin, estado, id_estado, modificacion)
VALUES
("Tarea 8 Continuar con la BBDD", "Plantear la BBDD y crear el script para generarla", '2025-05-21 16:00:00', "Finalizada", 4, 0),
("Tarea 11", "Ponerse a diseñar la estructura para que este lista", '2025-05-12 23:00:00', "Pendiente", 2, 0),
("Tarea 9", "Organizar la estructura de directorios para poder gestionar adecuadamente el proyecto", '2025-05-16 20:00:00', "Ejecución", 3, 0)
;

INSERT INTO tareas (titulo, descripcion, estado, id_estado, modificacion) 
VALUES 
("Tarea 2, Preparar estructura archivos", "Organizar la estructura de directorios para poder gestionar adecuadamente el proyecto", "Urgente", 1, 0),
("Tarea 5", "Organizar la estructura de directorios para poder gestionar adecuadamente el proyecto", "Urgente", 1, 0),
("Tarea 6", "Ponerse a picar código para que este lista a tiempo!", "Ejecución", 3, 0)
;

-- Pruebas trigger_modificacion

-- UPDATE tareas SET 
-- titulo = 'Tarea 17',
-- descripcion = 'gfd eahbño donnuas gzzrñjfebnsñ vñdf jkldhgñ kjdhfgñd klh', 
-- fecha_prevista_fin = '2025-05-20 20:00:59', 
-- estado = 'Ejecución', 
-- id_estado = 3,
-- modificacion = 1
-- WHERE id_tarea = 14; 

-- UPDATE tareas SET
-- titulo = "Tarea 17", 
-- descripcion = "gfd eahbño donnuas gzzrñjfebnsñ vñdf jkldhgñ kjdhfgñd klh", 
-- fecha_prevista_fin = '2025-05-20 20:00:59', 
-- estado = "Ejecución", 
-- id_estado = 3, 
-- modificacion = 1
-- WHERE id_tarea = 14;

-- INSERT INTO tareas (titulo, descripcion, fecha_prevista_fin, estado, id_estado, modificacion)
-- VALUES
-- ("Tarea 18, Crear la BBDD", "gfd eahbño donnuas gzzrñjfebnsñ vñdf jkldhgñ kjdhfgñd klh", '2025-05-23 20:00:59', "Ejecución", 3, 0);
