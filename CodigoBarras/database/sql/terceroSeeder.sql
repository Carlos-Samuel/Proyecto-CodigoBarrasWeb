INSERT INTO tipo_documento (nombre, sigla) VALUES 
('Cédula de Ciudadanía', 'CC'),
('Tarjeta de Identidad', 'TI'),
('Cédula de Extranjería', 'CE'),
('Pasaporte', 'PA'),
('Registro Civil', 'RC'),
('NIT', 'NIT');

INSERT INTO regimen (descripcion) VALUES 
('Régimen Común'),
('Régimen Simplificado'),
('Régimen Especial'),
('No Responsable de IVA'),
('Gran Contribuyente'),
('Autoretenedor');

INSERT INTO tipo_persona (descripcion) VALUES 
('Natural'),
('Jurídica');

-- Hacen falta muchos mas datos de divipola

INSERT INTO divipola (codigo, nombre, departamento_id) VALUES
('05', 'Antioquia', NULL),
('08', 'Atlántico', NULL),
('11', 'Bogotá D.C.', NULL),
('50', 'Meta', NULL),
('76', 'Valle del Cauca', NULL);

INSERT INTO divipola (codigo, nombre, departamento_id) VALUES
('05001', 'Medellín', '05'),
('05002', 'Bello', '05'),
('08001', 'Barranquilla', '08'),
('11001', 'Bogotá D.C.', '11'),
('50001', 'Villavicencio', '50'),
('76001', 'Cali', '76');

-- Inserta algunos países con su código ISO numérico como ID
INSERT INTO paises (codigo_iso_numeric, nombre, codigo_iso2, codigo_iso3) VALUES
(170, 'Colombia', 'CO', 'COL'),
(840, 'Estados Unidos', 'US', 'USA'),
(724, 'España', 'ES', 'ESP'),
(484, 'México', 'MX', 'MEX'),
(032, 'Argentina', 'AR', 'ARG'),
(076, 'Brasil', 'BR', 'BRA'),
(250, 'Francia', 'FR', 'FRA'),
(276, 'Alemania', 'DE', 'DEU'),
(380, 'Italia', 'IT', 'ITA'),
(826, 'Reino Unido', 'GB', 'GBR'),
(392, 'Japón', 'JP', 'JPN'),
(156, 'China', 'CN', 'CHN'),
(356, 'India', 'IN', 'IND'),
(643, 'Rusia', 'RU', 'RUS'),
(036, 'Australia', 'AU', 'AUS'),
(710, 'Sudáfrica', 'ZA', 'ZAF'),
(566, 'Nigeria', 'NG', 'NGA'),
(818, 'Egipto', 'EG', 'EGY'),
(124, 'Canadá', 'CA', 'CAN'),
(152, 'Chile', 'CL', 'CHL');


UPDATE tipo_documento
SET created_at = NOW(),
    updated_at = NOW();

UPDATE regimen
SET created_at = NOW(),
    updated_at = NOW();

UPDATE tipo_persona
SET created_at = NOW(),
    updated_at = NOW();

UPDATE divipola
SET created_at = NOW(),
    updated_at = NOW();

UPDATE paises
SET created_at = NOW(),
    updated_at = NOW();