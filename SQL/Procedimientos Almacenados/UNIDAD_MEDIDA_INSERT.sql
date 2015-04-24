DELIMITER $$

DROP PROCEDURE IF EXISTS UNIDAD_MEDIDA_INSERT$$

CREATE PROCEDURE `UNIDAD_MEDIDA_INSERT`(
 IN P_id_unidad_medida		INT,
 IN P_descripcion			VARCHAR(100),
 IN P_estado				VARCHAR(100)
)
BEGIN 
 DECLARE P_ERROR VARCHAR(100);
 DECLARE CONTINUE HANDLER FOR SQLSTATE '23000'
 SELECT P_ERROR;
 IF ((SELECT COUNT(id_unidad_medida) FROM tm_unidad_medida WHERE descripcion = P_descripcion)>0)
 THEN SET P_ERROR = 'Ya existe un registro con esa descripción.';
 ELSE
		INSERT INTO tm_unidad_medida(
		id_unidad_medida, 
		descripcion) 
		VALUES (
		P_id_unidad_medida, 
		P_descripcion);
 END IF;
SELECT P_ERROR AS Mensaje; 
END$$