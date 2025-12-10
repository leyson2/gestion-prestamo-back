<?php

namespace App\Interfaces;


interface EquipoInterface
{
    public function index();
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
}
