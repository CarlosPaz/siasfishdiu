DELIMITER $$

DROP PROCEDURE IF EXISTS PROVEEDOR_UPDATE$$

CREATE PROCEDURE `PROVEEDOR_UPDATE`(
 IN P_id_proveedor				INT,
 IN P_nombre_completo			VARCHAR(100),
 IN P_numero_identificacion 	VARCHAR(10),
 IN P_telefono		 			VARCHAR(15),
 IN P_estado					VARCHAR(15)
)
BEGIN
 DECLARE P_ERROR VARCHAR(100);
 DECLARE CONTINUE HANDLER FOR SQLSTATE '23000'
 SELECT P_ERROR;
		UPDATE 			tm_proveedor 
        SET 			nombre_completo 		= P_nombre_completo,
						numero_identifacion 	= P_numero_identificacion,
						telefono 				= P_telefono,
                        estado 					= P_estado
		WHERE           id_proveedor 			= P_id_proveedor;
SELECT P_ERROR AS Mensaje; 
END