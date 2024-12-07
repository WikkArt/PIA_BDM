DELIMITER //

CREATE PROCEDURE inscribir_curso(
    IN p_cursoId INT,
    IN p_estudiante VARCHAR(50),
    IN p_formaPago ENUM('paypal', 'tarjeta')
)
BEGIN
	-- Solo hacer la inscripcion si aun no existe
	IF (SELECT COUNT(*) FROM inscripcion_estudiante WHERE curso_id = p_cursoId AND usuario_estudiante = p_estudiante) = 0 THEN
		INSERT INTO inscripcion_estudiante (curso_id, usuario_estudiante, forma_pago, cursoCompletado)
		VALUES (p_cursoId, p_estudiante, p_formaPago, false);
	END IF;
END //

DELIMITER ;