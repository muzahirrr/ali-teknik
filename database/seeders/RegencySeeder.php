<?php

namespace Database\Seeders;

use App\Models\Regency;
use Illuminate\Database\Seeder;

class RegencySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Regency::create([
      'province_id' => 1,
      'name' => 'Kota Jakarta Barat'
    ]);

    Regency::create([
      'province_id' => 1,
      'name' => 'Kota Jakarta Pusat'
    ]);

    Regency::create([
      'province_id' => 1,
      'name' => 'Kota Jakarta Selatan'
    ]);

    Regency::create([
      'province_id' => 1,
      'name' => 'Kota Jakarta Timur'
    ]);

    Regency::create([
      'province_id' => 1,
      'name' => 'Kota Jakarta Utara'
    ]);

    Regency::create([
      'province_id' => 2,
      'name' => 'Kota Bogor'
    ]);

    Regency::create([
      'province_id' => 2,
      'name' => 'Kabupaten Bogor'
    ]);

    Regency::create([
      'province_id' => 2,
      'name' => 'Kota Depok'
    ]);

    Regency::create([
      'province_id' => 2,
      'name' => 'Kota Bekasi'
    ]);

    Regency::create([
      'province_id' => 2,
      'name' => 'Kabupaten Bekasi'
    ]);

    Regency::create([
      'province_id' => 3,
      'name' => 'Kota Tangerang'
    ]);

    Regency::create([
      'province_id' => 3,
      'name' => 'Kota Tangerang Selatan'
    ]);

    Regency::create([
      'province_id' => 3,
      'name' => 'Kabupaten Tangerang'
    ]);
  }
}
