<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/22
 * Time: 14:43
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class Student extends Model
{

    protected $fillable = [
        'school',
        'name',
        'sex',
        'age',
        'address'
    ];

    protected $hidden = [];

}