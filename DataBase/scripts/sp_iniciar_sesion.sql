DELIMITER //

CREATE PROCEDURE iniciar_sesion (
    IN p_nombre_usuario VARCHAR(50),
    IN p_contrasena VARCHAR(50),
    OUT p_rol ENUM('estudiante', 'instructor', 'admin'),
    OUT p_estatus ENUM('activo', 'bloqueado', 'eliminado'),
    OUT p_resultado INT
)
BEGIN
    DECLARE db_contrasena VARCHAR(255);

    SELECT contrasena, rol, estatus 
    INTO db_contrasena, p_rol, p_estatus
    FROM usuario 
    WHERE nombre_usuario = p_nombre_usuario;
    
    IF db_contrasena IS NULL THEN
        SET p_resultado = 0;
    ELSE
        IF p_estatus != 'activo' THEN
            SET p_resultado = 2;        ELSE

            IF p_contrasena = db_contrasena THEN
                SET p_resultado = 1;             ELSE
                SET p_resultado = 3;            END IF;
        END IF;
    END IF;

END //

DELIMITER ;
