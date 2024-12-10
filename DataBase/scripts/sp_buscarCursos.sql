DELIMITER //

CREATE PROCEDURE buscar_cursos(
    IN palabra_clave VARCHAR(255),
    IN fecha_inicio DATE,
    IN fecha_fin DATE,
    IN id_categoria INT
)
BEGIN
    SELECT 
        C.id, 
        C.foto AS imagen, 
        C.nombre AS titulo, 
        C.descripcion, 
        U.nombre_completo AS instructor,
        CG.nombre AS categoria, 
        SUM(N.precio) AS precio_total 
    FROM 
        curso C
    JOIN 
        categoria CG ON CG.id = C.categoria_id
    JOIN 
        usuario U ON U.nombre_usuario = C.usuario_instructor
    JOIN 
        nivel N ON N.curso_id = C.id
    WHERE 
        C.estatus = 1
        AND (palabra_clave IS NULL OR C.nombre LIKE CONCAT('%', palabra_clave, '%') OR C.descripcion LIKE CONCAT('%', palabra_clave, '%'))
        AND (fecha_inicio IS NULL OR C.fecha_creacion >= fecha_inicio)
        AND (fecha_fin IS NULL OR C.fecha_creacion <= fecha_fin)
        AND (id_categoria IS NULL OR C.categoria_id = id_categoria)
    GROUP BY 
        C.id;
END //

DELIMITER ;
