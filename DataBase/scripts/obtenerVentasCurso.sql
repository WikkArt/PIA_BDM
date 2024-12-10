
DELIMITER //
CREATE PROCEDURE nivel_promedio_cursado(p_curso INT)
BEGIN
    -- Verificar cual es el nivel promedio que los estudiantes cursan
    SELECT NC.nivel_id, N.nombre AS nivel_promedio, COUNT(NC.nivel_id) AS conteo FROM curso C
	JOIN nivel N ON N.curso_id = C.id
	JOIN nivel_completado NC ON NC.nivel_id = N.id
	WHERE C.id = p_curso
	GROUP BY(NC.nivel_id)
	ORDER BY conteo, NC.nivel_id desc
	LIMIT 1;
END //
DELIMITER ; 

CALL nivel_promedio_cursado(23);

DELIMITER //
CREATE FUNCTION total_ingresos(p_curso INT, _forma_pago ENUM('paypal', 'tarjeta'))
RETURNS DECIMAL(10,2)
DETERMINISTIC
BEGIN

DECLARE precioCurso DECIMAL(10,2);
DECLARE totalInscritos INT;
SET precioCurso = (SELECT SUM(N.precio) FROM curso C
					JOIN nivel N ON N.curso_id = C.id
					WHERE C.id = p_curso);

IF (_forma_pago IS NULL) THEN
	SET totalInscritos = (SELECT COUNT(I.id) FROM curso C
						LEFT JOIN inscripcion_estudiante I ON I.curso_id = C.id
						WHERE C.id = p_curso);
ELSE
	SET totalInscritos = (SELECT COUNT(I.id) FROM curso C
						LEFT JOIN inscripcion_estudiante I ON I.curso_id = C.id
						WHERE C.id = p_curso AND I.forma_pago = _forma_pago);
END IF;

RETURN (precioCurso * totalInscritos);
END //
DELIMITER ; 

-- Reporte de ventas perfil instructor
CREATE VIEW cursos_general AS
SELECT C.id, C.nombre, COUNT(I.id) AS NoAlumnos, total_ingresos(C.id, null) AS total_ingresos,
total_ingresos(C.id, 'paypal') AS ingresos_paypal, 
total_ingresos(C.id, 'tarjeta') AS ingresos_tarjeta, C.usuario_instructor  FROM curso C
LEFT JOIN inscripcion_estudiante I ON I.curso_id = C.id
GROUP BY(C.id);

SELECT * FROM cursos_general WHERE usuario_instructor = 'user21';

DELIMITER //
CREATE FUNCTION precio_curso(p_curso INT)
RETURNS DECIMAL(10,2)
DETERMINISTIC
BEGIN
DECLARE precioCurso DECIMAL(10,2);
SET precioCurso = (SELECT SUM(N.precio) FROM curso C
					JOIN nivel N ON N.curso_id = C.id
					WHERE C.id = p_curso);
RETURN precioCurso;
END //
DELIMITER ; 

DELIMITER //
CREATE FUNCTION nivel_avance(p_curso INT, p_usuario VARCHAR(50))
RETURNS DECIMAL(10,2)
DETERMINISTIC
BEGIN
DECLARE totalCompletado INT;
DECLARE totalNiveles INT;
SET totalCompletado = (SELECT COUNT(NC.id) FROM curso C
					JOIN nivel N ON N.curso_id = C.id
					LEFT JOIN nivel_completado NC ON NC.nivel_id = N.id
					LEFT JOIN inscripcion_estudiante I ON I.curso_id = C.id
					WHERE C.id = p_curso AND I.usuario_estudiante = p_usuario);
                    
SET totalNiveles = (SELECT total_niveles FROM curso WHERE id = p_curso);

RETURN ((totalCompletado/totalNiveles) * 100);

END //
DELIMITER ; 

-- Reporte de ventas detallado
CREATE VIEW ventasDetalle AS
SELECT C.id AS idCurso, I.id, U.nombre_completo, I.fecha_inscripcion, 
nivel_avance(C.id, U.nombre_usuario) AS nivel_avance, 
precio_curso(C.id) AS precio, I.forma_pago FROM usuario U
JOIN inscripcion_estudiante I ON I.usuario_estudiante = U.nombre_usuario
JOIN curso C ON C.id = I.curso_id;

SELECT * FROM ventasDetalle WHERE idCurso = 23;
