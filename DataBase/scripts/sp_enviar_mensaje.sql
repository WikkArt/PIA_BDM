DELIMITER //

CREATE PROCEDURE enviar_mensaje(
    IN p_chat_id INT,
    IN p_emisor VARCHAR(50),
    IN p_mensaje VARCHAR(255)
)
BEGIN
    INSERT INTO mensaje (texto, fecha, emisor, chat_id)
    VALUES (p_mensaje, NOW(), p_emisor, p_chat_id);
END //

DELIMITER ;

