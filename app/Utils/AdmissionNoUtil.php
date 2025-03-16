<?php

namespace App\Util;

use App\Models\ReferenceCount;

class Util
{
    /**
     * Increments admission number count for a given class_id
     * and gives the updated admission number
     *
     * @param string $type
     *
     * @return int
     */
    public function setAndGetAdmissionNo($class_id)
    {
        $ref = ReferenceCount::where('class_id', $class_id)
                          ->first();
        if (!empty($ref)) {
            $ref->ref_count += 1;
            $ref->save();
            return $ref->ref_count;
        } else {
            $new_ref = ReferenceCount::create([
                'class_id' => $class_id,
                'ref_count' => 1
            ]);
            return $new_ref->ref_count;
        }
    }

    /**
     * Generates reference number
     *
     * @param string $type
     *
     * @return int
     */
    public function generateReferenceNumber($type, $ref_count, $default_prefix = null)
    {
        $prefix = '';

        if (!empty($default_prefix)) {
            $prefix = $default_prefix;
        }

        $ref_digits =  str_pad($ref_count, 4, 0, STR_PAD_LEFT);

        if ($type == 'receipt') {
            $ref_number = $prefix . $ref_digits;
        } else {
            $ref_number = $prefix . rand(0000, 9999) . $ref_digits;
        }



        return $ref_number;
    }

    function generateTransactionID($length) {
        $uniqueNumbers = range(0, 9);
        $numberString = '';

        for ($i = 0; $i < $length; $i++) {
            $numberString .= $uniqueNumbers[array_rand($uniqueNumbers)];
        }

        return $numberString;
    }

}
