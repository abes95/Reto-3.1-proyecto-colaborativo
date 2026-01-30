<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class facturalineas extends Model
{
    protected $table = 'facturalineas';

    protected $fillable = [
        'id_factura', 'codigo', 'cantidad', 'descripcion', 'precio', 'base', 'iva', 'importeiva', 'importe'
    ];

    public function factura()
    {
        return $this->belongsTo('App\Models\facturas', 'id_factura');
    }
}
