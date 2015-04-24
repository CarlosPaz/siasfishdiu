DELIMITER $$

DROP PROCEDURE IF EXISTS PROVEEDOR_INSERT$$

CREATE PROCEDURE `PROVEEDOR_INSERT`(
 IN P_id_proveedor				INT,
 IN P_nombre_completo			VARCHAR(100),
 IN P_numero_identificacion 	VARCHAR(10),
 IN P_telefono		 			VARCHAR(15),
 IN P_estado					varchar(15)
)
BEGIN 
 DECLARE P_ERROR VARCHAR(100);
 DECLARE CONTINUE HANDLER FOR SQLSTATE '23000'
 SELECT P_ERROR;
 IF ((SELECT COUNT(id_proveedor) FROM tm_proveedor WHERE nombre_completo = P_nombre_completo OR numero_identifacion = P_numero_identificacion)>0)
 THEN SET P_ERROR = 'Ya existe un registro con este nombre ó número de identificación.';
 ELSE
		INSERT INTO tm_proveedor(
		nombre_completo, 
		numero_identifacion, 
		telefono,estado) 
		VALUES (
		P_nombre_completo, 
		P_numero_identificacion, 
		P_telefono,
        P_estado);
 END IF;
SELECT P_ERROR AS Mensaje; 
END