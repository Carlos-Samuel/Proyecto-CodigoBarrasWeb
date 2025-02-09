ALTER TABLE facturas 
ADD COLUMN mensajeria TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Indica si la factura tiene mensajería';


ALTER TABLE facturas 
ADD COLUMN vtaid INT(11) NULL DEFAULT 0 COMMENT 'Id de la factura de la tabla ventas';


-- 24708