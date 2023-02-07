<?php

namespace DaVinci\Modelos;

class Modelo 
{
    protected $propiedades = [];
    
    public function cargarPropiedades(array $data)
    {
        foreach($data as $key => $value) {
            if(in_array($key, $this->propiedades)) {
                $this->{$key} = $value;
            }
        }
    }
}