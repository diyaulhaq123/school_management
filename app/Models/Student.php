<?php

namespace App\Models;

use App\Models\Payment;
use App\Models\StudentRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $guarded = [];

    /**
     * Get the guardian that owns the Student
     *
     * @return BelongsTo
     */
    public function guardian(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guardian_id', 'id');
    }

    /**
     * Get the class that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    /**
     * Get the wing that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wing(): BelongsTo
    {
        return $this->belongsTo(Wing::class, 'wing', 'name');
    }

    /**
     * Get the class_category that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class_category(): BelongsTo
    {
        return $this->belongsTo(ClassCategory::class);
    }



    public function studentSessions($student_id){
        $past = StudentRecord::where('student_id', $student_id)->count();
        $present = Self::where('id', $student_id)->count();
        return $past+$present;
    }


    /**
     * Get the state that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the lga that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lga(): BelongsTo
    {
        return $this->belongsTo(Lga::class);
    }

    /**
     * Get the session that owns the StudentRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    /**
     * Get the payment associated with the Student
     *
     * @return HasOne
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Get all of the payments for the Student
     *
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }


    public function totalPayments($student_id)
    {
        $total = Payment::where([
            'student_id' => $student_id,
            'response' => 'success',
        ])->sum('amount');

        return $total;
    }


    public function getAllData($student_id){
        $past = StudentRecord::select('student_id','admission_no','session_id','class_id','guardian_id')
            ->where('student_id', $student_id)->get()->toArray();
        $present = Self::select('id as student_id','admission_no','session_id','class_id','guardian_id')
            ->where('id', $student_id)
            ->get()->toArray();
        $data = array_merge($past,$present);
        return $data;
    }


    /**
     * Get all of the attendances for the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

}
