DELIMITER $$

DROP PROCEDURE IF EXISTS TIPO_PERSONA_GET$$

CREATE PROCEDURE `TIPO_PERSONA_GET`(
 		P_opcion INT
)
BEGIN
		SELECT
		TP.id_tipo_persona,
		TP.descripcion AS Tipo
		FROM tm_tipo_persona TP;
END$$