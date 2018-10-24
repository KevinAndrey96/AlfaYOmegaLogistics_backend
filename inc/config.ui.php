<?php

$breadcrumbs = array(
	"Alfa & Omega Logistics" => APP_URL
);

$page_nav = array(
	"Administradores" => array(
		"title" => "Administradores",
		"icon" => "fa-key",
		"sub" => array(
			"Consultar" => array(
				"title" => "Consultar",
				"url" => APP_URL."/admin.php"
			)
		)
	),
	"Mensajeros" => array(
		"title" => "Mensajeros",
		"icon" => "fa fa-envelope",
		"sub" => array(
			"Consultar" => array(
				"title" => "Consultar",
				"url" => APP_URL."/mensajeros.php"
			)
		)
	),
	"Clientes" => array(
		"title" => "Clientes",
		"icon" => "fa-child",
		"sub" => array(
			"Consultar" => array(
				"title" => "Consultar",
				"url" => APP_URL."/clientes.php"
			)
		)
	),
	"Servicios" => array(
		"title" => "Servicios",
		"icon" => "fa fa-calendar",
		"sub" => array(
			"Consultar" => array(
				"title" => "Consultar",
				"url" => APP_URL."/servicios.php"
			)
		)
	),
	"Extras" => array(
		"title" => "Extras",
		"icon" => "fa-bell-o",
		"sub" => array(
			"Foto de perfil" => array(
				"title" => "Foto de perfil",
				"url" => APP_URL."/fotoperfil.php"
			),
			"Cambiar contraseña" => array(
				"title" => "Cambiar contraseña",
				"url" => APP_URL."/pass.php"
			)
		)
	)
);

$page_title = "Alfa & Omega Logistics";
$page_css = array();
$no_main_header = false;
?>