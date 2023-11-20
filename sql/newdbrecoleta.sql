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