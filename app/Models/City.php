<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

use AzisHapidin\IndoRegion\Traits\ProvinceTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Province Model.
 */
class City extends Model
{
    use ProvinceTrait;
    use SoftDeletes;
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'ec_cities';
}
