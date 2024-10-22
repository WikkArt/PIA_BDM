DELIMITER //

CREATE PROCEDURE registrar_usuario(
    IN p_nombre_completo VARCHAR(100),
    IN p_nombre_usuario VARCHAR(50),
    IN p_correo VARCHAR(50),
    IN p_contrasena VARCHAR(255),
    IN p_fecha_nac DATE,
    IN p_genero ENUM('hombre', 'mujer', 'no binario'),
    IN p_rol ENUM('estudiante', 'instructor', 'admin'),
    IN p_foto MEDIUMBLOB,
    IN p_mime VARCHAR(40),
    OUT p_resultado INT
)
BEGIN
    IF (SELECT COUNT(*) FROM usuario WHERE nombre_usuario = p_nombre_usuario OR correo = p_correo) > 0 THEN
        SET p_resultado = 0;
    ELSE
        INSERT INTO usuario (nombre_completo, nombre_usuario, correo, contrasena, fecha_nac, genero, rol, foto, mime, estatus)
        VALUES (p_nombre_completo, p_nombre_usuario, p_correo, p_contrasena, p_fecha_nac, p_genero, p_rol, p_foto, p_mime, 'activo');
        SET p_resultado = 1;
    END IF;
END //

DELIMITER ;
