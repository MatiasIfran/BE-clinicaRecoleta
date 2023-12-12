-- Tabla tipoDocumento
CREATE TABLE tipoDocumento (
    idTipoDocumento INT PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario VARCHAR(50) NOT NULL
);

-- Tabla de Personas
CREATE TABLE IF NOT EXISTS Personas (
    ID INT PRIMARY KEY,
    Nombre VARCHAR(50) NOT NULL,
    Apellido VARCHAR(50) NOT NULL,
    FechaNacimiento DATE,
    Genero VARCHAR(10),
    Direccion VARCHAR(100),
    Telefono VARCHAR(15),
    Mail VARCHAR(100),
    TipoDocumento INT NOT NULL,
    NumDocumento INT NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario VARCHAR(50) NOT NULL,
    FOREIGN KEY (TipoDocumento) REFERENCES tipoDocumento(ID)
);

-- Tabla de Pacientes
CREATE TABLE IF NOT EXISTS Pacientes (
    ID INT PRIMARY KEY,
    PersonaID INT,
    HistorialMedico TEXT,
    SeguroMedico VARCHAR(50),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario VARCHAR(50),
    FOREIGN KEY (PersonaID) REFERENCES Personas(ID)
);

-- Tabla de Médicos
CREATE TABLE IF NOT EXISTS Medicos (
    ID INT PRIMARY KEY,
    MedicoId INT,
    Especialidad VARCHAR(50),
    Telefono VARCHAR(15),
    ConsultorioDireccion VARCHAR(100),
    HorarioTrabajo VARCHAR(100),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario VARCHAR(50),
    FOREIGN KEY (MedicoId) REFERENCES Personas(ID)
);

-- Tabla de Empleados
CREATE TABLE IF NOT EXISTS Empleados (
    ID INT PRIMARY KEY,
    EmpleadoId INT,
    Puesto VARCHAR(50),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario VARCHAR(50),
    FOREIGN KEY (EmpleadoId) REFERENCES Personas(ID)
);

-- Tabla de Turnos (anteriormente Citas)
CREATE TABLE IF NOT EXISTS Turnos (
    ID INT PRIMARY KEY,
    PacienteID INT,
    MedicoID INT,
    FechaTurno DATE,
    HoraTurno TIME,
    RazonTurno TEXT,
    ResultadosTurno TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario VARCHAR(50),
    FOREIGN KEY (PacienteID) REFERENCES Pacientes(ID),
    FOREIGN KEY (MedicoID) REFERENCES Medicos(ID)
);

-- Tabla de Historias Clínicas
CREATE TABLE IF NOT EXISTS HistoriasClinicas (
    ID INT PRIMARY KEY,
    PacienteID INT,
    FechaRegistro DATE,
    Diagnostico TEXT,
    Tratamiento TEXT,
    NotasMedico TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario VARCHAR(50),
    FOREIGN KEY (PacienteID) REFERENCES Pacientes(ID)
);

-- Tabla de Recetas Médicas
CREATE TABLE IF NOT EXISTS RecetasMedicas (
    ID INT PRIMARY KEY,
    PacienteID INT,
    MedicoID INT,
    MedicamentosRecetados TEXT,
    Instrucciones TEXT,
    FechaEmision DATE,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario VARCHAR(50),
    FOREIGN KEY (PacienteID) REFERENCES Pacientes(ID),
    FOREIGN KEY (MedicoID) REFERENCES Medicos(ID)
);

-- Tabla de Inventario de Medicamentos
CREATE TABLE IF NOT EXISTS InventarioMedicamentos (
    ID INT PRIMARY KEY,
    NombreMedicamento VARCHAR(100),
    CantidadStock INT,
    FechaVencimiento DATE,
    Proveedor VARCHAR(100),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario VARCHAR(50)
);

-- Tabla de ObraSocial
CREATE TABLE IF NOT EXISTS ObraSocial (
    ID INT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Descripcion TEXT,
    CodArancel VARCHAR(20),
    Valor DECIMAL(10, 2) COMMENT 'Valor de la Orden de Consulta',
    MaxAnual INT(3) DEFAULT 0,
    MaxMensual INT(3) DEFAULT 0,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario VARCHAR(50)
);

-- Cosas a ejecutar en base de datos:

-- Codigo postal
INSERT INTO codpos (codigo, descripcion, usuario, created_at, updated_at) VALUES
    ('2000', 'ROSARIO - SANTA FE', 'admin', NOW(), NOW()),
    ('3000', 'SANTA FE - SANTA FE', 'admin', NOW(), NOW()),
    ('3001C', 'CAYASTA - SANTA FE', 'admin', NOW(), NOW()),
    ('3001R', 'SANTA ROSA - SANTA FE', 'admin', NOW(), NOW()),
    ('3003', 'HELVECIA - SANTA FE', 'admin', NOW(), NOW()),
    ('3005', 'SAN JAVIER - SANTA FE', 'admin', NOW(), NOW()),
    ('3016', 'SANTO TOME - SANTA FE', 'admin', NOW(), NOW()),
    ('3040', 'SAN JUSTO - SANTA FE', 'admin', NOW(), NOW()),
    ('3042', 'MARCELINO ESCALADA - SANTA FE', 'admin', NOW(), NOW()),
    ('3042S', 'COLONIA SILVA - SANTA FE', 'admin', NOW(), NOW()),
    ('3045', 'LA PENCA - SANTA FE', 'admin', NOW(), NOW()),
    ('3046', 'NARE - SANTA FE', 'admin', NOW(), NOW()),
    ('3048', 'VIDELA - SANTA FE', 'admin', NOW(), NOW()),
    ('3050', 'CALCHAQUI - SANTA FE', 'admin', NOW(), NOW()),
    ('3051', 'ALEJANDRA - SANTA FE', 'admin', NOW(), NOW()),
    ('3052', 'LA CRIOLLA - SANTA FE', 'admin', NOW(), NOW()),
    ('3054', 'VERA Y PINTADO - SANTA FE', 'admin', NOW(), NOW()),
    ('3056', 'MARGARITA - SANTA FE', 'admin', NOW(), NOW()),
    ('3057', 'LA GALLARETA - SANTA FE', 'admin', NOW(), NOW()),
    ('3550', 'VERA - SANTA FE', 'admin', NOW(), NOW()),
    ('3551', 'LA BLANCA - SANTA FE', 'admin', NOW(), NOW()),
    ('3553', 'FORTIN OLMOS - SANTA FE', 'admin', NOW(), NOW()),
    ('3555', 'ROMANG - SANTA FE', 'admin', NOW(), NOW()),
    ('3025', 'SOLEDAD - SANTA FE', 'admin', NOW(), NOW()),
    ('3100', 'PARANA - ENTRE RÍOS', 'admin', NOW(), NOW()),
    ('2240', 'CORONDA - SANTA FE', 'admin', NOW(), NOW()),
    ('0000', 'AAA-SIN LOCALIDAD - SANTA FE', 'admin', NOW(), NOW()),
    ('2300', 'RAFAELA - SANTA FE', 'admin', NOW(), NOW()),
    ('3561', 'AVELLANEDA - SANTA FE', 'admin', NOW(), NOW()),
    ('3080', 'ESPERANZA - SANTA FE', 'admin', NOW(), NOW()),
    ('3029', 'EMILIA - SANTA FE', 'admin', NOW(), NOW()),
    ('3081', 'HUMBOLT - SANTA FE', 'admin', NOW(), NOW()),
    ('2252', 'GALVEZ - SANTA FE', 'admin', NOW(), NOW()),
    ('3044', 'GOBERNADOR CRESPO - SANTA FE', 'admin', NOW(), NOW()),
    ('3013', 'SAN CARLOS SUR - SANTA FE', 'admin', NOW(), NOW()),
    ('2451', 'SAN JORGE - SANTA FE', 'admin', NOW(), NOW()),
    ('3023', 'SARMIENTO - SANTA FE', 'admin', NOW(), NOW()),
    ('3011', 'SAN GERONIMO NORTE - SANTA FE', 'admin', NOW(), NOW());

-- Profesionales
INSERT INTO profesionales (Nombre, Apellido, FechaNacimiento, Genero, Direccion, Telefono, Mail, TipoDocumento, NumDocumento, Matricula, Categoria, Cuit, Codigo, created_at, updated_at, usuario)
VALUES
    ('RICARDO', 'TONINI', NULL, NULL, NULL, NULL, NULL, 1, '00', 55, NULL, NULL, '1111', NOW(), NOW(), 'admin'),
    ('GUILLERMO', 'MAGNANO', NULL, NULL, NULL, NULL, NULL, 1, '01', 45, NULL, NULL, '2222', NOW(), NOW(), 'admin'),
    ('ADRIAN', 'ROCCO', NULL, NULL, NULL, NULL, NULL, 1, '02', 58, NULL, NULL, '3333', NOW(), NOW(), 'admin'),
    ('MARCELO', 'BORDON', NULL, NULL, NULL, NULL, NULL, 1, '03', 52, NULL, NULL, '4444', NOW(), NOW(), 'admin'),
    ('VICTORIA', 'LOPEZ CANDIOTI', NULL, NULL, NULL, NULL, NULL, 1, '04', 51, NULL, NULL, '6666', NOW(), NOW(), 'admin'),
    ('PATRICIA', 'BAISSETTO', NULL, NULL, NULL, NULL, NULL, 1, '05', 56, NULL, NULL, '7777', NOW(), NOW(), 'admin'),
    ('MILAGROS', 'CRISTOFOLI', NULL, NULL, NULL, NULL, NULL, 1, '06', NULL, NULL, NULL, '8888', NOW(), NOW(), 'admin'),
    ('ROSALIA', 'MEILAN', NULL, NULL, NULL, NULL, NULL, 1, '07', NULL, NULL, NULL, '9999', NOW(), NOW(), 'admin'),
    ('JUAN', 'MANTARAS', NULL, NULL, NULL, NULL, NULL, 1, '08', NULL, NULL, NULL, '2016', NOW(), NOW(), 'admin'),
    ('SEBASTIAN', 'HILGERT', NULL, NULL, NULL, NULL, NULL, 1, '09', NULL, NULL, NULL, '5432', NOW(), NOW(), 'admin'),
    ('JORGE', 'CORRAL', NULL, NULL, NULL, NULL, NULL, 1, '10', NULL, NULL, NULL, '5555', NOW(), NOW(), 'admin');

