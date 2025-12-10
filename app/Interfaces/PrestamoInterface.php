<?php

namespace App\Interfaces;


interface PrestamoInterface
{
    public function index();
    public function store(array $data);
    public function show($id);
    public function update($id, array $data);
    public function updateStatus($id, array $data);
    public function destroy($id);
}