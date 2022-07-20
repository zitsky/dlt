<?php


namespace App\Repositories\Interfaces;


interface CustomersInterface extends PagedInterface
{
    public function add($fields);
    public function update($id, $fields);
    public function remove($id);
}
