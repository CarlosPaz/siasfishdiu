delimiter $$

DROP PROCEDURE IF EXISTS CONFIGURACION_ACCESO_GET$$

CREATE PROCEDURE `CONFIGURACION_ACCESO_GET`( 
	IN P_Perfil INT, 
	IN P_App VARCHAR(32), 
    IN P_Clase VARCHAR(32), 
    IN P_Funcion VARCHAR(32), 
    IN P_Opcion CHAR(1) 
)
BEGIN 
	CASE P_Opcion 
    WHEN 'M' 
	THEN 
			SELECT 	CA.id_funcion 
            FROM 	tc_configuracion_acceso CA 
            INNER JOIN tc_objeto O ON CA.id_clase = O.id_objeto 
            WHERE 	CA.id_perfil = P_Perfil 
					AND CA.id_aplicacion = P_App 
					AND O.id_objeto_padre = 'menu' 
                    AND CA.flag_activo = 'S' 
			ORDER BY CA.id_funcion ASC; 
	WHEN 'C' 
    THEN 
			SELECT CA.id_funcion 
            FROM tc_configuracion_acceso CA 
            INNER JOIN tc_objeto O ON CA.id_clase = O.id_objeto 
            WHERE CA.id_perfil = P_Perfil 
            AND CA.id_aplicacion = P_App 
            AND CA.id_clase = P_Clase 
            AND CA.id_funcion = P_Funcion 
            AND O.id_objeto_padre = 'class' 
            AND CA.flag_activo = 'S'; 
	END CASE; 
END$$