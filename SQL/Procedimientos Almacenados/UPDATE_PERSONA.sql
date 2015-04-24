DELIMITER $$

DROP PROCEDURE IF EXISTS UPDATE_PERSONA$$

CREATE PROCEDURE `UPDATE_PERSONA`(
 IN P_id_persona 			INT,
 IN P_id_rol_persona		INT,
 IN P_id_tipo_persona		INT,
 IN P_nombre_completo		VARCHAR(100),
 IN P_documento_identidad 	VARCHAR(10),
 IN P_telefono		 		VARCHAR(15)
)
BEGIN
 DECLARE P_ERROR VARCHAR(100);
 DECLARE CONTINUE HANDLER FOR SQLSTATE '23000'
 SELECT P_ERROR;
		UPDATE 			tc_persona  P
        SET 			P.id_rol_persona 		= P_id_rol_persona, 
						P.id_tipo_persona 	= P_id_tipo_persona, 
						P.nombre_completo 	= P_nombre_completo, 
                        P.documento_identidad = P_documento_identidad, 
                        P.telefono 			= P_telefono 
		WHERE           P.id_persona 			= P_id_persona;
SELECT P_ERROR AS Mensaje; 
END$$
