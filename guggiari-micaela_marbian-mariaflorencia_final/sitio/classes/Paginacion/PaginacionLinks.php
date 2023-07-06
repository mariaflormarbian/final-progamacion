<?php

namespace DaVinci\Paginacion;

class PaginacionLinks
{
	public static function generar(Paginador $paginador)
	{
		require_once __DIR__ . '/../../vistas-parciales/paginador.php';
	}
}