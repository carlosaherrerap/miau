
CREATE TABLE Rol(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    cod VARCHAR(255),
    nombre VARCHAR(255)
);

CREATE TABLE Sede_reg(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

CREATE TABLE Sede_juris(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_sedereg INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,

    CONSTRAINT fk_sedereg FOREIGN KEY (id_sedereg) REFERENCES Sede_reg(id)
);

-- TABLAS MAESTRA
CREATE TABLE Usuario(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_rol INT,
    cod_usuario VARCHAR(255),
    username VARCHAR(255) NOT NULL,
    clave VARCHAR(255) NOT NULL,
    nombres VARCHAR(255) NOT NULL,
    ape_pat VARCHAR(255) NOT NULL,
    ape_mat VARCHAR(255),
    id_sedereg INT NOT NULL,
    id_sedejuris INT NOT NULL,
    doc INT,
    email VARCHAR(255),
    estado INT,

    CONSTRAINT fk_rol FOREIGN KEY (id_rol) REFERENCES Rol(id),
    CONSTRAINT fk_sedereg FOREIGN KEY (id_sedereg) REFERENCES Sede_reg(id),
    CONSTRAINT fk_sedejuris FOREIGN KEY (id_sedejuris) REFERENCES Sede_juris(id)
);

-- Asignar la visualizacion de tickets de un usuario segun sede Reg o Juris.
CREATE TABLE Asignaciones(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_usuario INT UNIQUE,
    id_rol INT,
    id_sedereg INT ,
    id_sedejuris INT,

    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
    CONSTRAINT fk_rol FOREIGN KEY (id_rol) REFERENCES Rol(id),
    CONSTRAINT fk_sedereg FOREIGN KEY (id_sedereg) REFERENCES Sede_reg(id),
    CONSTRAINT fk_sedejuris FOREIGN KEY (id_sedejuris) REFERENCES Sede_juris(id)
);

CREATE TABLE Categoria(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre VARCHAR(255), -- ticket(Sistema Integrado) o informativo
    tipo VARCHAR(255) -- Aplicadores - Preselección o  Cortes de energía eléctrica
);

-- TABLAS SECUNDARIAS
CREATE TABLE Ticket(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    cod_ticket VARCHAR(255),
    id_usuario INT NOT NULL,
    fecha_emision TIMESTAMP,
    id_categoria INT NOT NULL,
    descripcion_problema VARCHAR(255),
    nivel_importancia VARCHAR(255),

    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
    CONSTRAINT fk_categoria FOREIGN KEY (id_categoria) REFERENCES Categoria(id)
);


CREATE TABLE Estado_ticket(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_ticket INT NOT NULL UNIQUE,
    estado VARCHAR(255),
    fecha_estado_actual TIMESTAMP,
    descripcion_solucion VARCHAR(255),

CONSTRAINT fk_ticket FOREIGN KEY (id_ticket) REFERENCES Ticket(id)
);


CREATE TABLE Publicacion(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre VARCHAR(255),
    version DECIMAL,
    fecha_publicacion TIMESTAMP,
    fecha_vigencia TIMESTAMP,
    indicaciones TEXT
);

CREATE TABLE Permisos_publicacion(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_publicacion INT NOT NULL,
    id_usuario INT,
    id_rol INT,
    id_sedereg INT,
    id_sedejuris INT,
    estado INT NOT NULL,

    CONSTRAINT fk_publicacion FOREIGN KEY (id_publicacion) REFERENCES Publicacion(id),
    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
    CONSTRAINT fk_rol FOREIGN KEY (id_rol) REFERENCES Rol(id),
    CONSTRAINT fk_sedereg FOREIGN KEY (id_sedereg) REFERENCES Sede_reg(id),
    CONSTRAINT fk_sedejuris FOREIGN KEY (id_sedejuris) REFERENCES Sede_juris(id)
);

-- Si un usuario ha visto una publicación
CREATE TABLE Vista_publicacion(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_publicacion INT NOT NULL,
    fecha_vista TIMESTAMP NOT NULL,

    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES Usuario(id),
    CONSTRAINT fk_publicacion FOREIGN KEY (id_publicacion) REFERENCES Publicacion(id)
);


CREATE TABLE File(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_ticket INT,
    id_publicacion INT,
    tipo VARCHAR(255),
    enlace VARCHAR(255),

CONSTRAINT fk_ticket FOREIGN KEY (id_ticket) REFERENCES Ticket(id),
CONSTRAINT fk_publicacion FOREIGN KEY (id_publicacion) REFERENCES Publicacion(id)
);


