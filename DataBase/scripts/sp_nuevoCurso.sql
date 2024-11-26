DELIMITER //

CREATE PROCEDURE nuevo_curso(
    IN p_curso VARCHAR(80),
    IN p_descripcion VARCHAR(255),
    IN p_foto MEDIUMBLOB,
    IN p_mime VARCHAR(40),
    IN p_nombre_usuario VARCHAR(50),
    IN p_categoria INT,
    OUT p_resultado INT
)
BEGIN
    INSERT INTO curso (nombre, descripcion, foto, mime, total_niveles, estatus, 
    usuario_instructor, categoria_id)
	VALUES (p_curso, p_descripcion, p_foto, p_mime, 0, true, p_nombre_usuario,
    p_categoria);
	SET p_resultado = 1;
END //

DELIMITER ;

DELIMITER //
CREATE PROCEDURE nuevo_nivel(
	IN p_nivel VARCHAR(80),
    IN p_video VARCHAR(255),
    IN p_precio DECIMAL(10,2)
)
BEGIN
	DECLARE p_curso_id INT;
	SET p_curso_id = (SELECT MAX(id) FROM curso);
	INSERT INTO nivel (nombre, video, precio, curso_id) VALUES
    (p_nivel, p_video, p_precio, p_curso_id);
    
    UPDATE curso SET total_niveles = (total_niveles + 1) WHERE id = p_curso_id;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE nuevo_recurso(
	IN p_archivo VARCHAR(255)
)
BEGIN
	DECLARE p_nivel_id INT;
	SET p_nivel_id = (SELECT MAX(id) FROM nivel);
	INSERT INTO recurso_adicional (archivo, nivel_id) VALUES
    (p_archivo, p_nivel_id);
END //
DELIMITER ;
