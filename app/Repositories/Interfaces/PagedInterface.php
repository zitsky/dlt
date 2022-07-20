<?php


namespace App\Repositories\Interfaces;


interface PagedInterface
{
    public function paged($page,$per);
}
