-- Tabla de Pacientes
CREATE TABLE IF NOT EXISTS Pacientes (
    ID INT PRIMARY KEY,
    Nombre VARCHAR(50),
    Apellido VARCHAR(50),
    FechaNacimiento DATE,
    Genero VARCHAR(10),
    Direccion VARCHAR(100),
    Telefono VARCHAR(15),
    Mail VARCHAR(100), -- Correo Electrónico
    Sexo VARCHAR(10), -- Sexo
    NumDocumento INT, -- Número de Documento como número entero
    HistorialMedico TEXT,
    SeguroMedico VARCHAR(50),
    fechaultmdf TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Valor predeterminado: fecha y hora actual
    usuario VARCHAR(50)
);

-- Tabla de Médicos
CREATE TABLE IF NOT EXISTS Medicos (
    ID INT PRIMARY KEY,
    Nombre VARCHAR(50),
    Apellido VARCHAR(50),
    Especialidad VARCHAR(50),
    Telefono VARCHAR(15),
    ConsultorioDireccion VARCHAR(100),
    HorarioTrabajo VARCHAR(100),
    Mail VARCHAR(100), -- Correo Electrónico
    Sexo VARCHAR(10), -- Sexo
    NumDocumento INT, -- Número de Documento como número entero
    fechaultmdf TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Valor predeterminado: fecha y hora actual
    usuario VARCHAR(50)
);

-- Tabla de Turnos (anteriormente Citas)
CREATE TABLE IF NOT EXISTS Turnos (
    ID INT PRIMARY KEY,
    PacienteID INT,
    MedicoID INT,
    FechaTurno DATE, -- Columna para la fecha
    HoraTurno TIME,  -- Columna para la hora
    RazonTurno TEXT,
    ResultadosTurno TEXT,
    fechaultmdf TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Valor predeterminado: fecha y hora actual
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
    fechaultmdf TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Valor predeterminado: fecha y hora actual
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
    fechaultmdf TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Valor predeterminado: fecha y hora actual
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
    fechaultmdf TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Valor predeterminado: fecha y hora actual
    usuario VARCHAR(50)
);

-- Tabla de Empleados (si es necesario)
CREATE TABLE IF NOT EXISTS Empleados (
    ID INT PRIMARY KEY,
    Nombre VARCHAR(50),
    Apellido VARCHAR(50),
    Puesto VARCHAR(50),
    Telefono VARCHAR(15),
    Direccion VARCHAR(100),
    Mail VARCHAR(100), -- Correo Electrónico
    Sexo VARCHAR(10), -- Sexo
    NumDocumento INT, -- Número de Documento como número entero
    fechaultmdf TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Valor predeterminado: fecha y hora actual
    usuario VARCHAR(50)
);

-- Tabla de ObraSocial
CREATE TABLE IF NOT EXISTS ObraSocial (
    ID INT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Descripcion TEXT,
    CodArancel VARCHAR(20), -- Código de Arancel
    Valor DECIMAL(10, 2) COMMENT 'Valor de la Orden de Consulta',
    MaxAnual INT(3) DEFAULT 0, -- Máximo Anual con valor predeterminado 0
    MaxMensual INT(3) DEFAULT 0, -- Máximo Mensual con valor predeterminado 0
    fechaultmdf TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Valor predeterminado: fecha y hora actual
    usuario VARCHAR(50)
);
