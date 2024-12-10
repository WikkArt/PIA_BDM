DELIMITER //

CREATE PROCEDURE obtener_conversacion(
    IN p_usuario1 VARCHAR(50),
    IN p_usuario2 VARCHAR(50),
    OUT p_chat_id INT
)
BEGIN
    DECLARE db_chat_id INT;

    -- Aseguramos que el menor id sea usuario1 y el mayor sea usuario2
    IF p_usuario1 < p_usuario2 THEN
        SET @us1 = p_usuario1;
        SET @us2 = p_usuario2;
    ELSE
        SET @us1 = p_usuario2;
        SET @us2 = p_usuario1;
    END IF;

    -- Buscamos si ya existe una conversación
    SELECT id
    INTO db_chat_id
    FROM chat
    WHERE (usuario1 = @us1 AND usuario2 = @us2) OR (usuario1 = @us2 AND usuario2 = @us1)
    LIMIT 1;

    IF db_chat_id IS NULL THEN
        -- Si no existe, se crea una nueva conversación
        INSERT INTO chat (usuario1, usuario2)
        VALUES (@us1, @us2);
        
        -- Retornamos el ID de la nueva conversación
        SET p_chat_id = LAST_INSERT_ID();
    ELSE
        -- Si existe, se devuelve el ID de la conversación
        SET p_chat_id = db_chat_id;
    END IF;

END //

DELIMITER ;
