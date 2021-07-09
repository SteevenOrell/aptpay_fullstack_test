<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
    use HasFactory;

    protected $table = 'disbursements';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [    'amount',
       'currency',
       'transactionType',
       'paymentType',
       'disbursementNumber',
       'instrumentId',
       'expirationDate',
       'network',
       'payeeId',
       'mode',
       'descriptor',
       'status'

];
}
