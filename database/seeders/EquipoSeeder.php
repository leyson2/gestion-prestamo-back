<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipos = [
            ['nombre' => 'Laptop Dell XPS 13'],
            ['nombre' => 'Proyector Epson X200'],
            ['nombre' => 'Tablet iPad Pro'],
            ['nombre' => 'Cámara Canon EOS R5'],
            ['nombre' => 'Monitor Samsung 27"'],
            ['nombre' => 'Impresora HP LaserJet'],
            ['nombre' => 'Router WiFi TP-Link'],
            ['nombre' => 'Micrófono Blue Yeti'],
            ['nombre' => 'Auriculares Bose QC35'],
            ['nombre' => 'Disco Duro Externo Seagate 2TB'],
            ['nombre' => 'Teclado Mecánico Logitech'],
            ['nombre' => 'Mouse'],
            ['nombre' => 'Proyector'],
        ];

        foreach ($equipos as $equipo) {
            \DB::table('equipos')->insert($equipo);
        }
    }
}
