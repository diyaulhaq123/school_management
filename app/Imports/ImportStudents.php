<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;

class ImportStudents implements ToCollection, WithSkipDuplicates
{

    protected $class_id;

    public function __construct($class_id, $session_id)
    {
        $this->class_id = $class_id; // Assign the class_id to a class property
        $this->session_id = $session_id;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $class_id = $this->class_id;
        $session_id = $this->session_id;

        // Determine the category based on class_id
        if ($class_id <= 4) {
            $category = 1;
        } elseif ($class_id < 9 && $class_id > 5) {
            $category = 2;
        } elseif ($class_id < 12 && $class_id > 10) {
            $category = 3;
        } else {
            $category = 4;
        }


        // Loop through the imported rows and create student records
        foreach ($collection as $row) {
            $guardianPhone = $row[3];
            // Search for the guardian by phone number
            $guardian = User::where('email', $guardianPhone)->first();
            // If the guardian exists, retrieve their ID, otherwise set it to null
            $guardianId = $guardian ? $guardian->id : null;

            Student::create([
                'first_name' => $row[0],
                'last_name' => $row[1],
                'other_name' => $row[2],
                'guardian_id' => $guardianId,
                'class_id' => $class_id, // Use the class_id passed to the constructor
                'session_id' => $session_id,
                'address' => $row[4],
                // 'state_id' => $row[5],
                // 'lga_id' => $row[6],
                'password' => Hash::make('password'),
                'class_category_id' => $category, // Store the calculated category if needed
            ]);
        }
    }
}
