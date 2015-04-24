delimiter $$

DROP PROCEDURE IF EXISTS USER_VALID$$

CREATE PROCEDURE `USER_VALID`(
 IN P_Id_Usuario VARCHAR(64),
 IN P_Password VARCHAR(64)
 )
BEGIN

	SELECT 		U.id_usuario, U.usuario, U.fecha_vigencia, PF.id_perfil, PF.nombre_perfil AS perfil FROM tc_usuario_perfil UPF
	LEFT JOIN 	tm_usuario U ON UPF.id_usuario = U.id_usuario
	LEFT JOIN 	tm_perfil PF ON UPF.id_perfil = PF.id_perfil
	WHERE 		U.usuario 	= P_Id_Usuario 
			AND U.password 	= P_Password 
            AND U.estado	= 'COD0000002'
	;
	
 END$$