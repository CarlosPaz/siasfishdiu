DELIMITER $$

DROP PROCEDURE IF EXISTS PERSONA_INSERT$$

CREATE PROCEDURE `PERSONA_INSERT`(
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
 IF ((SELECT COUNT(id_persona) FROM tc_persona WHERE nombre_completo = P_nombre_completo OR documento_identidad = P_documento_identidad)>0)
 THEN SET P_ERROR = 'Ya existe un registro con este nombre ó documento de identidad.';
 ELSE
		INSERT INTO tc_persona(
		id_rol_persona, 
		id_tipo_persona, 
		nombre_completo, 
		documento_identidad, 
		telefono) 
		VALUES (
		P_id_rol_persona, 
		P_id_tipo_persona, 
		P_nombre_completo, 
		P_documento_identidad, 
		P_telefono);
 END IF;
SELECT P_ERROR AS Mensaje; 
END$$

