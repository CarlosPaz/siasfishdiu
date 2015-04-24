
DELIMITER $$

DROP PROCEDURE IF EXISTS PERSONA_GET$$

CREATE PROCEDURE `PERSONA_GET`(
 IN P_id_persona INT(11),
 IN P_opcion CHAR(1)
)
BEGIN
	CASE P_opcion
	WHEN '1' THEN  -- BUSQUEDA CON FILTRO POR ID
		SELECT 		P.id_persona AS id_persona, RP.descripcion AS rol_persona , TP.descripcion AS tipo_persona, 
					P.nombre_completo, P. documento_identidad, P.telefono FROM tc_persona P
		INNER JOIN 	tm_rol_persona RP ON P.id_rol_persona = RP.id_rol_persona
		INNER JOIN 	tm_tipo_persona TP ON P.id_tipo_persona = TP.id_tipo_persona
		WHERE 		P.id_persona = P_id_persona
        ;
	WHEN '2' THEN -- LISTA TODOS LOS DATOS DE LA TABLA
		SELECT 		P.id_persona AS id_persona, RP.descripcion AS rol_persona , TP.descripcion AS tipo_persona, 
					P.nombre_completo, P. documento_identidad, P.telefono FROM tc_persona P
		INNER JOIN 	tm_rol_persona RP ON P.id_rol_persona = RP.id_rol_persona
		INNER JOIN 	tm_tipo_persona TP ON P.id_tipo_persona = TP.id_tipo_persona
		ORDER BY id_persona
		;
	END CASE;
END$$



