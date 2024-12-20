DELIMITER //

CREATE PROCEDURE actualizar_usuario(
    IN p_nombre_usuario VARCHAR(50),
    IN p_contrasena VARCHAR(50),
    IN p_nombre_completo VARCHAR(100),
    IN p_correo VARCHAR(50),
    IN p_genero ENUM('hombre', 'mujer', 'no binario'),
    IN p_fecha_nac DATE,
    IN p_foto MEDIUMBLOB,
    IN p_mime VARCHAR(40)
)
BEGIN
    IF EXISTS (SELECT 1 FROM usuario WHERE correo = p_correo AND nombre_usuario != p_nombre_usuario) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El correo ya está en uso por otro usuario.';
    END IF;

    IF p_foto, p_mime IS NULL THEN
    UPDATE usuario
    SET 
        contrasena = p_contrasena,
        nombre_completo = p_nombre_completo,
        correo = p_correo,
        genero = p_genero,
        fecha_nac = p_fecha_nac
    WHERE nombre_usuario = p_nombre_usuario;
    END IF;
    IF p_foto, p_mime IS NOT NULL THEN
        UPDATE usuario 
        SET 
            contrasena = p_contrasena,
            nombre_completo = p_nombre_completo,
            correo = p_correo,
            genero = p_genero,
            fecha_nac = p_fecha_nac,
            foto = p_foto,
            mime = p_mime
        WHERE nombre_usuario = p_nombre_usuario;
    END IF;

END //

DELIMITER ;