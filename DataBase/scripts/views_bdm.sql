
-- Vista para enviar los datos requeridos de los cursos para el dashboard
CREATE VIEW Lista_cursos AS
SELECT C.id, C.foto AS imagen, C.nombre AS titulo, C.descripcion, U.nombre_completo AS instructor,
CG.nombre AS categoria, SUM(N.precio) AS precio_total FROM curso C 
JOIN categoria CG ON CG.id = C.categoria_id
JOIN usuario U ON U.nombre_usuario = C.usuario_instructor
JOIN nivel N ON N.curso_id = C.id 
WHERE C.estatus = 1 GROUP BY(C.id);

SELECT * FROM lista_cursos;

-- Vista para enviar la informacion de un curso para infoCurso
CREATE VIEW InfoCurso AS
SELECT C.id, C.foto AS imagen, C.nombre AS titulo, U.nombre_completo AS instructor,
CG.nombre AS categoria, C.descripcion, C.valoracion_promedio, N.id AS idNivel, 
N.nombre AS nombreNivel, N.precio AS precioNivel FROM curso C
JOIN categoria CG ON CG.id = C.categoria_id
JOIN usuario U ON U.nombre_usuario = C.usuario_instructor
JOIN nivel N ON N.curso_id = C.id
WHERE C.estatus = 1;

SELECT * FROM infocurso WHERE id = 23;

-- Vista para enviar la info del kardex de un estudiante
CREATE VIEW KardexInfo AS
SELECT I.id, I.usuario_estudiante, C.id AS idCurso, C.estatus AS cursoActivo, 
C.nombre AS curso, CG.nombre AS categoria, I.fecha_inscripcion, I.ultimo_ingreso, 
I.cursoCompletado, I.fecha_finalizacion FROM inscripcion_estudiante I
JOIN curso C ON C.id = I.curso_id
JOIN categoria CG ON CG.id = C.categoria_id;

SELECT * FROM kardexinfo WHERE usuario_estudiante = 'user123';