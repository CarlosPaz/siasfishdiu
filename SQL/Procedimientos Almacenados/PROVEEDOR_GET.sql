
DELIMITER $$

DROP PROCEDURE IF EXISTS PROVEEDOR_GET$$

CREATE PROCEDURE `PROVEEDOR_GET`(
 IN P_id_proveedor INT(11),
 IN P_opcion CHAR(1)
)
BEGIN
	CASE P_opcion
	WHEN '1' THEN  -- BUSQUEDA CON FILTRO POR ID
		SELECT PV.id_proveedor, PV.nombre_completo, PV.numero_identificacion, PV.telefono, PV.estado FROM tm_proveedor PV
		WHERE PV.id_proveedor = P_id_proveedor
        ;
	WHEN '2' THEN -- LISTA TODOS LOS DATOS DE LA TABLA
		SELECT PV.id_proveedor, PV.nombre_completo, PV.numero_identificacion, PV.telefono, PV.estado FROM tm_proveedor PV
		;
	END CASE;
END$$