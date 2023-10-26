<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationStep extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function assignUser()
    {
        return $this->belongsTo(User::class,'assign_user_id');
    }

    public function forwardUser()
    {
        return $this->belongsTo(User::class,'forward_user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function labUser()
    {
        return $this->belongsTo(User::class,'lab_user_id');
    }


    // public function application()
    // {
    //     return $this->belongsTo(Application::class);
    // }
}
