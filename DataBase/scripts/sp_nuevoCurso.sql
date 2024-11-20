BEGIN
    DECLARE cursoId INT;
    DECLARE nivelIndex INT DEFAULT 0;
    DECLARE nivelCount INT;
    DECLARE nivelId INT;
    DECLARE nivelNombre VARCHAR(255);
    DECLARE nivelPrecio DECIMAL(10, 2);
    DECLARE nivelVideo LONGBLOB;
    DECLARE recursoIndex INT DEFAULT 0;
    DECLARE recursoCount INT;
    DECLARE recursoTipo VARCHAR(50);
    DECLARE recursoArchivo LONGBLOB;

    INSERT INTO curso (nombre, descripcion, categoria, foto_promocional)
    VALUES (nombreCurso, descripcionCurso, categoriaCurso, fotoPromocional);

    SET cursoId = LAST_INSERT_ID();

    SET nivelCount = JSON_LENGTH(niveles);

    WHILE nivelIndex < nivelCount DO
        SET nivelNombre = JSON_UNQUOTE(JSON_EXTRACT(niveles, CONCAT('$[', nivelIndex, '].nombre')));
        SET nivelPrecio = JSON_UNQUOTE(JSON_EXTRACT(niveles, CONCAT('$[', nivelIndex, '].precio')));
        SET nivelVideo = FROM_BASE64(JSON_UNQUOTE(JSON_EXTRACT(niveles, CONCAT('$[', nivelIndex, '].video'))));

        INSERT INTO nivel (curso_id, nombre, precio, video)
        VALUES (cursoId, nivelNombre, nivelPrecio, nivelVideo);

        SET nivelId = LAST_INSERT_ID();

        SET recursoCount = JSON_LENGTH(JSON_EXTRACT(recursosAdicionales, CONCAT('$[', nivelIndex, ']')));

        WHILE recursoIndex < recursoCount DO
            SET recursoTipo = JSON_UNQUOTE(JSON_EXTRACT(recursosAdicionales, CONCAT('$[', nivelIndex, '][', recursoIndex, '].tipo')));
            SET recursoArchivo = FROM_BASE64(JSON_UNQUOTE(JSON_EXTRACT(recursosAdicionales, CONCAT('$[', nivelIndex, '][', recursoIndex, '].archivo'))));

            INSERT INTO recurso_adicional (nivel_id, tipo, archivo)
            VALUES (nivelId, recursoTipo, recursoArchivo);

            SET recursoIndex = recursoIndex + 1;
        END WHILE;

        SET nivelIndex = nivelIndex + 1;
    END WHILE;
END