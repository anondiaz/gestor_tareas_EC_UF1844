CREATE DATABASE IF NOT EXISTS tareas_andres_diaz;

USE tareas_andres_diaz;

-- DROP DATABASE tareas_andres_diaz;

CREATE TABLE IF NOT EXISTS tareas (
id_tarea  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
-- id_usuario INT NOT NULL,
titulo VARCHAR (50),
descripcion VARCHAR (200),
fecha_new TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
fecha_prevista_fin TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
estado VARCHAR (20),
id_estado INT NOT NULL,
id_modificacion INT NOT NULL
);

CREATE TABLE IF NOT EXISTS estados (
id_estado  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
estado VARCHAR (15)
);

INSERT INTO estados (estado) VALUES ("Urgente");
INSERT INTO estados (estado) VALUES ("Pendiente");
INSERT INTO estados (estado) VALUES ("Ejecución");
INSERT INTO estados (estado) VALUES ("Finalizada");

CREATE TABLE IF NOT EXISTS modificaciones (
id_modificacion  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
id_tarea  INT NOT NULL,
id_estado INT NOT NULL,
titulo_modif VARCHAR (50),
descripcion_modif VARCHAR (200)
);

-- Relaciones entre tablas
-- Estados <> Tareas
ALTER TABLE tareas
ADD CONSTRAINT fk_estado
FOREIGN KEY (id_estado)
REFERENCES estados(id_estado)
-- Hay que revisar para que no se borren los estados
ON DELETE RESTRICT -- solo borra si no hay más elemntos asociados
ON UPDATE RESTRICT
;

-- Modificaciones <> Tareas
ALTER TABLE tareas
ADD CONSTRAINT fk_modificacion
FOREIGN KEY (id_modificacion)
REFERENCES modificaciones(id_modificacion)
ON DELETE RESTRICT -- solo borra si no hay más elementos asociados
ON UPDATE RESTRICT
;

-- DELIMITER //

-- CREATE TRIGGER trg_modificacion
-- BEFORE UPDATE ON tareas
-- FOR EACH ROW 
-- BEGIN

-- 	DECLARE disponibilidad_libro INT UNSIGNED;
--     
--     SELECT disponibilidad INTO disponibilidad_libro
--     FROM libros
--     WHERE id_libro = new.id_libro;

-- 		INSERT INTO modificaciones (id_tarea) VALUES (new.id_tarea);

-- END //

-- DELIMITER ;

-- DROP TRIGGER trg_modificacion;

-- Populamos la tabla de tareas
INSERT INTO tareas (titulo, descripcion, estado) VALUES ("Tarea 1, Crear la BBDD", "Plantear la BBDD y crear el script para generarla", "Finalizada");
INSERT INTO tareas (titulo, descripcion, estado) VALUES ("Tarea 2, Preparar estructura archivos", "Organizar la estructura de directorios para poder gestionar adecuadamente el proyecto", "Urgente");
INSERT INTO tareas (titulo, descripcion, estado) VALUES ("Tarea 3, Empezar a programar", "Ponerse a picar código para que este lista a tiempo!", "Ejecución");
INSERT INTO tareas (titulo, descripcion, estado) VALUES ("Tarea 4, Ver la estructura de la web", "Ponerse a diseñar la estructura para que este lista", "Pendiente");
INSERT INTO tareas (titulo, descripcion, estado) VALUES ("Tarea 5", "Organizar la estructura de directorios para poder gestionar adecuadamente el proyecto", "Urgente");
INSERT INTO tareas (titulo, descripcion, estado) VALUES ("Tarea 6", "Ponerse a picar código para que este lista a tiempo!", "Ejecución");
INSERT INTO tareas (titulo, descripcion, estado) VALUES ("Tarea 7", "Ponerse a diseñar la estructura para que este lista", "Pendiente");
INSERT INTO tareas (titulo, descripcion, estado) VALUES ("Tarea 8", "Plantear la BBDD y crear el script para generarla", "Finalizada");
INSERT INTO tareas (titulo, descripcion, estado) VALUES ("Tarea 9", "Organizar la estructura de directorios para poder gestionar adecuadamente el proyecto", "Ejecución");
INSERT INTO tareas (titulo, descripcion, estado) VALUES ("Tarea 10", "Ponerse a picar código para que este lista a tiempo!", "Finalizada");
INSERT INTO tareas (titulo, descripcion, estado) VALUES ("Tarea 11", "Ponerse a diseñar la estructura para que este lista", "Pendiente");
INSERT INTO tareas (titulo, descripcion, estado) VALUES ("Tarea 12", "Plantear la BBDD y crear el script para generarla", "Finalizada");

-- Pruebas trigger_modificacion
-- UPDATE tareas SET estado = 'Urgente' WHERE id_tarea = 9;
-- UPDATE tareas SET estado = "Ejecución" WHERE id_tarea = 8;

