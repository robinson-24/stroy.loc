<?php
namespace app\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
}