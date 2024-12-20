
CREATE DATABASE bdm_db;

USE bdm_db;

/* Tabla de usuarios */
CREATE TABLE usuario (
	nombre_usuario	VARCHAR(50) NOT NULL PRIMARY KEY,
    contrasena	VARCHAR(50)	NOT NULL,
    nombre_completo	VARCHAR(100),
    correo	VARCHAR(50),
    genero	ENUM('hombre', 'mujer', 'no binario'),
    fecha_nac	DATE,
    foto	MEDIUMBLOB, /* blob es para guardar imagenes o videos */
    mime	VARCHAR(40), /*mime type es para saber que tipo de imagen es al cargarla (jpg, png, ...)*/
    rol	ENUM('estudiante', 'instructor', 'admin'),
    fecha_creacion	DATETIME DEFAULT CURRENT_TIMESTAMP, 
    estatus	ENUM('activo', 'bloqueado', 'eliminado')
);

/* Tabla de categorias */
CREATE TABLE categoria (
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre	VARCHAR(50),
    descripcion	VARCHAR(100),
    fecha_creacion	DATETIME DEFAULT CURRENT_TIMESTAMP,
    estatus	BOOLEAN, /* false si la categoria fue eliminada */
    usuario_creador	VARCHAR(50),
    CONSTRAINT FK_Categoria_creador
    FOREIGN KEY(usuario_creador)
    REFERENCES usuario(nombre_usuario)
);

/* Tabla de cursos */
CREATE TABLE curso (
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre	VARCHAR(80) NOT NULL,
    descripcion	VARCHAR(255),
    foto	MEDIUMBLOB, 
    mime	VARCHAR(40),
    valoracion_promedio	INT,
    total_niveles	INT,
    fecha_creacion	DATETIME DEFAULT CURRENT_TIMESTAMP,
    estatus	BOOLEAN, /* false si el curso fue eliminado */
    usuario_instructor	VARCHAR(50),
    categoria_id	INT,
    CONSTRAINT FK_Curso_instructor
    FOREIGN KEY(usuario_instructor)
    REFERENCES usuario(nombre_usuario),
    CONSTRAINT FK_Curso_categoria
    FOREIGN KEY(categoria_id)
    REFERENCES categoria(id)
);

/* Tabla de inscripciones hechas en los cursos */
CREATE TABLE inscripcion_estudiante(
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    curso_id	INT NOT NULL,
    fecha_inscripcion	DATETIME DEFAULT CURRENT_TIMESTAMP,
    usuario_estudiante	VARCHAR(50) NOT NULL,
    forma_pago	ENUM('paypal', 'tarjeta'),
    cursoCompletado	BOOLEAN,
	CONSTRAINT FK_Inscripcion_curso
    FOREIGN KEY(curso_id)
    REFERENCES curso(id),
    CONSTRAINT FK_Inscripcion_estudiante
    FOREIGN KEY(usuario_estudiante)
    REFERENCES usuario(nombre_usuario)
);

/* Se me habia olvidado poner la fecha del ultimo ingreso al curso y tambien le agregue la fecha en que es acabado */
ALTER TABLE inscripcion_estudiante ADD COLUMN ultimo_ingreso DATETIME;
ALTER TABLE inscripcion_estudiante ADD COLUMN fecha_finalizacion DATETIME;

/* Tabla de niveles */
CREATE TABLE nivel(
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre	VARCHAR(80),
    video VARCHAR(255), /* URL del video porque en blob seria muy grande */
    precio	DECIMAL(10, 2), /* solo aceptara numeros con dos decimales */
    curso_id	INT NOT NULL, /* De que curso forma parte */
    CONSTRAINT FK_nivel_curso
    FOREIGN KEY(curso_id)
    REFERENCES curso(id)
);

/* Tabla de recursos adicionales de los niveles como PDFs, Txts, etc. */
CREATE TABLE recurso_adicional(
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    archivo	VARCHAR(255), /* Link/archivo */
    nivel_id	INT, /* A que nivel pertenece */
    CONSTRAINT FK_recurso_nivel
    FOREIGN KEY(nivel_id)
    REFERENCES nivel(id)
);

-- DROP TABLE recurso_adicional;

/* Tabla de niveles completados por cada usuario para guardar su progreso */
CREATE TABLE nivel_completado(
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nivel_id	INT NOT NULL,
    fecha	DATETIME DEFAULT CURRENT_TIMESTAMP,
    usuario_estudiante	VARCHAR(50),
    CONSTRAINT FK_nivel_que_completo
    FOREIGN KEY(nivel_id)
    REFERENCES nivel(id),
    CONSTRAINT FK_nivel_completado_por
    FOREIGN KEY(usuario_estudiante)
    REFERENCES usuario(nombre_usuario)
);

/* Tabla de comentarios de los cursos */
CREATE TABLE comentario(
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    texto VARCHAR(255),
    valoracion	INT,
    fechaCreacion	DATETIME DEFAULT CURRENT_TIMESTAMP,
    estatus	BOOLEAN, /* false si el comentario fue eliminado */
    usuario_autor	VARCHAR(50),
    curso_id	INT NOT NULL, /* De que curso habla */
    fechaEliminacion	DATETIME, /* En caso de que haya sido eliminado */
    causaEliminacion	VARCHAR(100), /* En caso de que haya sido eliminado */
    CONSTRAINT FK_comentario_autor
    FOREIGN KEY(usuario_autor)
    REFERENCES usuario(nombre_usuario),
    CONSTRAINT FK_comentario_curso
    FOREIGN KEY(curso_id)
    REFERENCES curso(id)
);

/* Tabla de chats entre usuarios */
CREATE TABLE chat(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario1 VARCHAR(50),
    usuario2 VARCHAR(50),
    CONSTRAINT FK_Chat_usuario1
    FOREIGN KEY(usuario1)
    REFERENCES usuario(nombre_usuario),
    CONSTRAINT FK_Chat_usuario2
    FOREIGN KEY(usuario2)
    REFERENCES usuario(nombre_usuario)
);

/* Tabla de mensajes de los chats */
CREATE TABLE mensaje(
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    texto VARCHAR(255),
    fecha	DATETIME DEFAULT CURRENT_TIMESTAMP,
    emisor VARCHAR(50),
    chat_id INT,
    CONSTRAINT FK_Mensaje_emisor
    FOREIGN KEY(emisor)
    REFERENCES usuario(nombre_usuario),
    CONSTRAINT FK_Mensaje_chat
    FOREIGN KEY(chat_id)
    REFERENCES chat(id)
);

-- SELECTS --
SELECT * FROM usuario;
SELECT * FROM categoria;
SELECT * FROM chat;
SELECT * FROM comentario;
SELECT * FROM curso;
SELECT * FROM inscripcion_estudiante;
SELECT * FROM mensaje;
SELECT * FROM nivel;
SELECT * FROM nivel_completado;
SELECT * FROM recurso_adicional;
