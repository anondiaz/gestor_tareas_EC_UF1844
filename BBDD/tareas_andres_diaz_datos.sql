USE tareas_andres_diaz;

INSERT INTO usuarios_datos (nombre_usuario, password)
VALUES
("prueba01", "$2y$10$2Ho9JT8iU1otQMI7P4A9gul/DkjjVg1QWx0eT4bqfC6ZrDLsn7M5y"),
("prueba02", "$2y$10$IMbme5WOqRtgiIMxjAk/ye7oZBvgumEJKgHnVfXe1aMqyYuZZgzR6")
;

-- Populamos la tabla de tareas --
INSERT INTO tareas (titulo, descripcion, fecha_prevista_fin, id_estado, borrada, id_usuario, modificacion)
VALUES
("Tarea 01", "Plantear la BBDD y crear el script para generarla", '2025-05-08 23:59:59', 4, 0, 1, 0),
("Tarea 03", "Ponerse a picar código para que este lista a tiempo!", '2025-05-15 23:59:59', 3, 0, 1, 0),
("Tarea 04", "Ponerse a diseñar la estructura para que este lista", '2025-05-14 14:00:00', 2, 0, 2, 0)
;

INSERT INTO tareas (titulo, descripcion, id_estado, borrada, id_usuario, modificacion) 
VALUES
("Tarea 07", "Ponerse a diseñar la estructura para que este lista", 2, 0, 1, 0),
("Tarea 10", "Ponerse a picar código para que este lista a tiempo!", 4, 0, 2, 1),
("Tarea 12", "Plantear la BBDD y crear el script para generarla", 4, 0, 1, 0)
;

INSERT INTO tareas (titulo, descripcion, fecha_prevista_fin, id_estado, borrada, id_usuario, modificacion)
VALUES
("Tarea 08", "Plantear la BBDD y crear el script para generarla", '2025-05-21 16:00:00', 4, 0, 1, 0),
("Tarea 11", "Ponerse a diseñar la estructura para que este lista", '2025-05-12 23:00:00', 2, 1, 1, 0),
("Tarea 09", "Organizar la estructura de directorios para poder gestionar adecuadamente el proyecto", '2025-05-16 20:00:00', 3, 0, 2, 0)
;

INSERT INTO tareas (titulo, descripcion, id_estado, borrada, id_usuario, modificacion) 
VALUES 
("Tarea 02", "Organizar la estructura de directorios para poder gestionar adecuadamente el proyecto", 1, 0, 1, 0),
("Tarea 05", "Organizar la estructura de directorios para poder gestionar adecuadamente el proyecto", 1, 0, 2, 0),
("Tarea 06", "Ponerse a picar código para que este lista a tiempo!", 3, 1, 2, 0)
;

-- Populamos la tabla de modificaciones --
INSERT INTO modificaciones (fecha_modificacion, titulo_modif, descripcion_modif, id_tarea, id_estado, id_usuario) 
VALUE
('2025-05-21 16:00:00', "Tarea 10", "Ponerse a picar código!", 4, 2, 1)
;
