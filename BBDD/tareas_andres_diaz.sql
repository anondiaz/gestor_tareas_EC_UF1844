CREATE DATABASE IF NOT EXISTS tareas_andres_diaz;
USE tareas_andres_diaz;
CREATE TABLE IF NOT EXISTS tareas (
id_tarea  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
-- id_usuario INT NOT NULL,
titulo VARCHAR (50),
descripcion VARCHAR (200),
fecha_new TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
fecha_modify TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
estado VARCHAR (20)
-- id_estado INT NOT NULL
);

-- DROP DATABASE tareas_andres_diaz;

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

-- UPDATE tareas SET estado = "Ejecución" WHERE id_tarea = ;

-- CREATE TABLE IF NOT EXISTS estados (
-- id_estado  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
-- estado VARCHAR (15)
-- );

-- INSERT INTO estados (estado) VALUES ("Urgente");
-- INSERT INTO estados (estado) VALUES ("Pendiente");
-- INSERT INTO estados (estado) VALUES ("Ejecución");
-- INSERT INTO estados (estado) VALUES ("Finalizada");