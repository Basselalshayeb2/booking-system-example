<?php

namespace App\Http\Interfaces;

interface BookingRepositoryInterface extends RepositoryInterface
{
    public function getBy($id, $options = []);
    public function delete($id);
}
