DELIMITER //

CREATE PROCEDURE nueva_curso(
    IN p_curso VARCHAR(80),
    IN p_descripcion VARCHAR(255),
    IN p_nombre_usuario VARCHAR(50),
    IN p_categoria INT,
    OUT p_resultado INT
)
BEGIN
    IF (SELECT COUNT(*) FROM categoria WHERE nombre = p_categoria) > 0 THEN
        SET p_resultado = 0;
    ELSE
        INSERT INTO categoria (nombre, descripcion, estatus, usuario_creador)
        VALUES (p_categoria, p_descripcion, true, p_nombre_usuario);
        SET p_resultado = 1;
    END IF;
END //

DELIMITER ;
