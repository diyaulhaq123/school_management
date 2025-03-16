<?php
namespace App\Traits;

trait GeneratesReferenceNumber
{
    public function generateReferenceNumber()
    {
        return 'REF' . mt_rand(1000000000, 9999999999);
    }
}
