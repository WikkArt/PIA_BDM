DELIMITER //

CREATE PROCEDURE actualizar_curso(
	IN p_id_curso INT,
    IN p_foto MEDIUMBLOB,
    IN p_mime VARCHAR(40),
    IN p_categoria INT,
    IN p_nombre VARCHAR(80),
    IN p_descripcion VARCHAR(255)
)
BEGIN
	IF p_foto IS NULL THEN
		UPDATE curso
		SET 
			categoria_id = p_categoria,
			nombre = p_nombre,
			descripcion = p_descripcion
		WHERE id = p_id_curso;
	ELSE
		UPDATE curso    
		SET 
			categoria_id = p_categoria,
			nombre = p_nombre,
			descripcion = p_descripcion,
			foto = p_foto,
            mime = p_mime
		WHERE id = p_id_curso;
    END IF;
END //

DELIMITER ;