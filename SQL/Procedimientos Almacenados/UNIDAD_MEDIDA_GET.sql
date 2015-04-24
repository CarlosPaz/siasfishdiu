
DELIMITER $$

DROP PROCEDURE IF EXISTS UNIDAD_MEDIDA_GET$$

CREATE PROCEDURE `UNIDAD_MEDIDA_GET`(
 IN P_id_unidad_medida INT(11),
 IN P_opcion CHAR(1)
)
BEGIN
	CASE P_opcion
	WHEN '1' THEN  -- BUSQUEDA CON FILTRO POR ID
		SELECT UM.id_unidad_medida, UM.descripcion, UM.estado FROM tm_unidad_medida UM 
        WHERE UM.id_unidad_medida = P_id_unidad_medida
        ;
	WHEN '2' THEN -- LISTA TODOS LOS DATOS DE LA TABLA
		SELECT UM.id_unidad_medida, UM.descripcion, UM.estado FROM tm_unidad_medida UM
		;
	END CASE;
END$$