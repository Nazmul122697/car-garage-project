<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function typeGood()
    {
        return $this->belongsTo(TypeGood::class,'type_good_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class,'customer_id','id');
    }
    public function customerDetail()
    {
        return $this->hasOne(CustomerDetails::class,'customer_id','customer_id');
    }

    public function importingCountry()
    {
        return $this->belongsTo(Country::class,'consignment_country','id');
    }
    public function consignmentCountry()
    {
        return $this->belongsTo(Country::class,'consignment_country','id');
    }

    public function modeOfTransport()
    {
        return $this->belongsTo(ModeOfTransport::class,'mode_of_transport','id');
    }

    public function manufacturerCountry()
    {
        return $this->belongsTo(Country::class,'manufacturer_country_id','id');
    }

    public function issuedBy()
    {
        return $this->belongsTo(User::class,'report_issued_by','id');
    }

    public function buyerCountry()
    {
        return $this->belongsTo(Country::class, 'buyer_country_id');
    }

}
