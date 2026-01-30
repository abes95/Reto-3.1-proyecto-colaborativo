<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class FacturalineasRoutesTest extends TestCase
{
    public function test_store_creates_line_and_updates_factura_totals()
    {
        $this->withoutMiddleware();

        // crear cliente
        $clienteId = DB::table('clientes')->insertGetId([
            'nombre' => 'Prueba', 'direccion' => 'Calle', 'email' => 'a@b.c', 'telefono' => '1234567890', 'logo' => null, 'created_at' => now(), 'updated_at' => now()
        ]);

        // crear factura
        $facturaId = DB::table('facturas')->insertGetId([
            'cliente_id' => $clienteId,
            'numero' => 'F001',
            'fecha' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $post = [
            'id_factura' => $facturaId,
            'codigo' => 1,
            'cantidad' => 2,
            'descripcion' => 'Item',
            'precio' => 10.00,
            'iva' => 21.00,
        ];

        $response = $this->post('/facturalineas', $post);
        $response->assertStatus(302);

        $linea = DB::table('facturalineas')->where('id_factura', $facturaId)->first();
        $this->assertEquals(20.00, (float) $linea->base);
        $this->assertEquals(4.20, (float) $linea->importeiva);
        $this->assertEquals(24.20, (float) $linea->importe);

        $factura = DB::table('facturas')->where('id', $facturaId)->first();
        $this->assertEquals(20.00, (float) $factura->base);
        $this->assertEquals(4.20, (float) $factura->importeiva);
        $this->assertEquals(24.20, (float) $factura->importe);
    }
}
