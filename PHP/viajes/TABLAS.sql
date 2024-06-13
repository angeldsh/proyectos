CREATE TABLE usuarios
(
    id            INTEGER AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(75) NOT NULL,
    password      VARCHAR(60),
    email         VARCHAR(75) NOT NULL,
    nombre        VARCHAR(20),
    apellido1     VARCHAR(20),
    apellido2     VARCHAR(20),
    direccion     VARCHAR(150),
    nif           VARCHAR(9),
    foto          VARCHAR(75),
    tipo          VARCHAR(15) NOT NULL,
    activo        BOOLEAN     NOT NULL,
    bloqueado     BOOLEAN     NOT NULL,
    num_intentos  INTEGER(2) NOT NULL,
    ultimo_acceso DATE,
    created_at    TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP,
    KEY (username),
    KEY (email),
    UNIQUE UQ_username (username),
    UNIQUE UQ_email (email),
    UNIQUE UQ_nif (nif)
);

CREATE TABLE roles
(
    id          INTEGER AUTO_INCREMENT PRIMARY KEY,
    rol         VARCHAR(15) NOT NULL,
    descripcion VARCHAR(25),
    KEY (rol),
    UNIQUE UQ_rol (rol)
);

CREATE TABLE usuarios_roles
(
    id         INTEGER AUTO_INCREMENT PRIMARY KEY,
    usuario_id INTEGER NOT NULL,
    rol_id     INTEGER NOT NULL,
    UNIQUE UQ_usuario_roles (usuario_id, rol_id)
);

ALTER TABLE usuarios_roles
    ADD CONSTRAINT fk_ur_roles FOREIGN KEY (rol_id) REFERENCES roles (id);
ALTER TABLE usuarios_roles
    ADD CONSTRAINT fk_ur_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios (id);

INSERT INTO roles (rol, descripcion)
VALUES ('ADMIN', 'Administrador');
INSERT INTO roles (rol, descripcion)
VALUES ('EMPLE', 'Empleado');
INSERT INTO roles (rol, descripcion)
VALUES ('CLIENTE', 'Cliente');


CREATE TABLE logs
(
    id  INTEGER AUTO_INCREMENT PRIMARY KEY,
    log VARCHAR(200) NOT NULL
);

CREATE TABLE viajes
(
    id                INTEGER AUTO_INCREMENT PRIMARY KEY,
    codigo            VARCHAR(10) UNIQUE NOT NULL,
    titulo            VARCHAR(50),
    descripcion       VARCHAR(2000),
    foto              VARCHAR(75),
    num_participantes INTEGER            NOT NULL,
    salida            DATE               NOT NULL,
    llegada           DATE               NOT NULL,
    precio DOUBLE NOT NULL,
    empleado_id       INTEGER            NOT NULL,
    FOREIGN KEY (empleado_id) REFERENCES usuarios (id)
);
CREATE TABLE viajes_clientes
(
    id         INTEGER AUTO_INCREMENT PRIMARY KEY,
    cliente_id INTEGER NOT NULL,
    viaje_id   INTEGER NOT NULL,
    pagado DOUBLE NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES usuarios (id),
    FOREIGN KEY (viaje_id) REFERENCES viajes (id)
);
