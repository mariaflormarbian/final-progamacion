<?php

namespace DaVinci\Paginacion;

class Paginador
{
	protected int $registrosPorPagina;
	protected int $registroInicial;
	protected int $registrosTotales;
	protected int $pagina;
	protected int $paginas;
	protected string $urlBase;

	public function __construct(int $registrosPorPagina)
	{
		$this->registrosPorPagina = $registrosPorPagina;
		$this->pagina = $_GET['p'] ?? 1;
		$this->registroInicial = $this->registrosPorPagina * ($this->pagina - 1);
	}

	public function setRegistrosTotales(int $registrosTotales)
	{
		$this->registrosTotales = $registrosTotales;
		$this->paginas = ceil($this->registrosTotales / $this->registrosPorPagina);
	}

	/**
	 * Genera la lista de links de la paginación.
	 */
	public function generarPaginacion()
	{
		PaginacionLinks::generar($this);
	}

	public function setUrlBase(string $urlBase)
	{
		$this->urlBase = $urlBase;
	}

	public function getUrlBase(): string
	{
		return $this->urlBase;
	}

	public function getRegistrosTotales(): int
	{
		return $this->registrosTotales;
	}

	public function getRegistrosPorPagina(): int
	{
		return $this->registrosPorPagina;
	}

	public function getRegistroInicial(): int
	{
		return $this->registroInicial;
	}

	public function getPagina(): int
	{
		return $this->pagina;
	}

	public function getPaginas(): int
	{
		return $this->paginas;
	}
}