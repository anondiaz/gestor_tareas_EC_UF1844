CREATE DATABASE IF NOT EXISTS tareas_andres_diaz;
USE tareas_andres_diaz;
CREATE TABLE IF NOT EXISTS tareas (
id_tarea  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
-- id_usuario INT NOT NULL,
titulo VARCHAR (50),
descripcion VARCHAR (200),
fecha_new TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
fecha_modify TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- id_estado INT NOT NULL
);

INSERT INTO tareas (titulo, descripcion) VALUES ("Crear la BBDD", "Plantear la BBDD y crear el script para generarla");
INSERT INTO tareas (titulo, descripcion) VALUES ("Preparar estructura archivos", "Organizar la estructura de directorios para poder gestionar adecuadamente el proyecto");
INSERT INTO tareas (titulo, descripcion) VALUES ("Empezar a programar", "Ponerse a picar código para que este lista a tiempo!");

-- CREATE TABLE IF NOT EXISTS estados (
-- id_estado  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
-- estado VARCHAR (15)
-- );

-- INSERT INTO estados (estado) VALUES ("Urgente");
-- INSERT INTO estados (estado) VALUES ("Pendiente");
-- INSERT INTO estados (estado) VALUES ("Ejecución");
-- INSERT INTO estados (estado) VALUES ("Finalizada");