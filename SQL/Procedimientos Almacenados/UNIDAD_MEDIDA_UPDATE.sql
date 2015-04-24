DELIMITER $$

DROP PROCEDURE IF EXISTS UNIDAD_MEDIDA_UPDATE$$

CREATE PROCEDURE `UNIDAD_MEDIDA_UPDATE`(
 IN P_id_unidad_medida		INT,
 IN P_descripcion			VARCHAR(100),
 IN P_estado				VARCHAR(100)
)
BEGIN
 DECLARE P_ERROR VARCHAR(100);
 DECLARE CONTINUE HANDLER FOR SQLSTATE '23000'
 SELECT P_ERROR;
		UPDATE 			tm_unidad_medida 
        SET 			descripcion 			= P_descripcion,						
                        estado 					= P_estado
		WHERE           id_unidad_medida 		= P_id_unidad_medida;
SELECT P_ERROR AS Mensaje; 
END