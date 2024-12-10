DELIMITER //

CREATE PROCEDURE obtener_mensajes(
    IN p_chat_id INT,
    OUT p_resultado INT
)
BEGIN
    -- Declaración de las variables locales
    DECLARE db_texto VARCHAR(255);
    DECLARE db_fecha DATETIME;
    DECLARE db_nombre_completo VARCHAR(100);
    DECLARE db_foto MEDIUMBLOB;
    
    -- Declaración del cursor
    DECLARE db_cursor CURSOR FOR 
        SELECT m.texto, m.fecha, u.nombre_completo, u.foto
        FROM mensaje m
        JOIN usuario u ON m.emisor = u.nombre_usuario
        WHERE m.chat_id = p_chat_id
        ORDER BY m.fecha ASC;

    -- Declaración del manejador para el caso de que no haya más resultados en el cursor
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET p_resultado = 0;

    -- Abre el cursor
    OPEN db_cursor;

    -- Inicia el ciclo para obtener los resultados del cursor
    FETCH db_cursor INTO db_texto, db_fecha, db_nombre_completo, db_foto;

    -- Si se obtiene un resultado, establecemos p_resultado en 1
    IF db_texto IS NOT NULL THEN
        SET p_resultado = 1;

        -- Aquí podrías hacer lo que necesites con los datos obtenidos (db_texto, db_fecha, db_nombre_completo, db_foto)
        -- Por ejemplo, insertar en una tabla temporal o concatenar los resultados en una variable para retornarlos
    END IF;

    -- Cierra el cursor
    CLOSE db_cursor;
    
END //

DELIMITER ;


