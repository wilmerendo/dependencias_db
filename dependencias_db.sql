-- Crear base de datos
CREATE DATABASE dependencias_db;
USE dependencias_db;

-- Tabla de Empresas
CREATE TABLE empresas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

-- Tabla de Dependencias
CREATE TABLE dependencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    empresa_id INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    codigo VARCHAR(50) NOT NULL,
    telefono VARCHAR(20),
    direccion VARCHAR(255),
    FOREIGN KEY (empresa_id) REFERENCES empresas(id),
    UNIQUE KEY unique_dependencia (nombre, empresa_id),
    UNIQUE KEY unique_codigo (codigo, empresa_id)
);

-- Tabla de Usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    dependencia_id INT,
    FOREIGN KEY (dependencia_id) REFERENCES dependencias(id)
);

-- Índices adicionales para mejorar el rendimiento
CREATE INDEX idx_dependencia_empresa ON dependencias(empresa_id);
CREATE INDEX idx_usuario_dependencia ON usuarios(dependencia_id);