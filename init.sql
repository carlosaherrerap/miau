
-- TABLAS MAESTRAS
CREATE TABLE Usuario(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    clave VARCHAR(255) NOT NULL,
    nombres VARCHAR(255) NOT NULL,
    ape_pat VARCHAR(255) NOT NULL,
    ape_mat VARCHAR(255),
    doc INT,
    email VARCHAR(255),
    rol INT
);

-- TABLAS SECUNDARIAS

CREATE TABLE Emisor(
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    id_usuario INT,
    sede_reg VARCHAR(255),
    sede_juris VARCHAR(255),

    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES Usuario(id)
);

CREATE TABLE Receptor(
id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
id_usuario INT,
estado INT,

CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES Usuario(id)
);

CREATE TABLE Ticket(
id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
id_emisor INT,
id_receptor INT,
fecha_emision TIMESTAMP,

CONSTRAINT fk_emisor FOREIGN KEY (id_emisor) REFERENCES Emisor(id),
CONSTRAINT fk_receptor FOREIGN KEY (id_receptor) REFERENCES Receptor(id)
);

CREATE TABLE Categoria(
id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
nombre VARCHAR(255),
tipo VARCHAR(255)
);

CREATE TABLE Ticket_detalle(
id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
id_ticket INT,
id_categoria INT,
descripcion_problema VARCHAR(255),
fecha_recepcion TIMESTAMP,
nivel_importancia VARCHAR(255),
estado VARCHAR(255),
fecha_estado_actual TIMESTAMP,
descripcion_solucion VARCHAR(255),

CONSTRAINT fk_ticket FOREIGN KEY (id_ticket) REFERENCES Ticket(id),
CONSTRAINT fk_categoria FOREIGN KEY (id_categoria) REFERENCES Categoria(id)
);

CREATE TABLE File(
id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
id_ticket_detalle INT,
tipo VARCHAR(255),
enlace VARCHAR(255),

CONSTRAINT fk_detalle_ticket FOREIGN KEY (id_ticket_detalle) REFERENCES Ticket_detalle(id)
);