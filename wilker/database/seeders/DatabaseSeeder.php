<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'username' => 'admin',
            'password' => Hash::make('adminpass'),
            'role' => 'admin'
        ]);
        \App\Models\User::create([
            'username' => 'user1',
            'password' => Hash::make('user1pass'),
            'role' => 'user'
        ]);
        \App\Models\User::create([
            'username' => 'user2',
            'password' => Hash::make('user2pass'),
            'role' => 'user'
        ]);


        \App\Models\Place::create([
            'name' => 'Malang',
            'latitude' => -7.966620,
            'longitude' => 112.632629,
            'image' => 'placeImages/malang.png',
            'description' => "Kota Malang, adalah sebuah kota di Provinsi Jawa Timur, Indonesia. Kota ini berada di dataran tinggi yang cukup sejuk, terletak 90 km sebelah selatan Kota Surabaya, dan wilayahnya dikelilingi oleh Kabupaten Malang."
        ]);
        \App\Models\Place::create([
            'name' => 'Blitar',
            'latitude' => -8.095463,
            'longitude' => 112.160904,
            'image' => 'placeImages/blitar.png',
            'description' => "Blitar disebut juga sebagai Kota Proklamator. Alasannya adalah karena di kota ini terdapat makam Proklamator Kemerdekaan sekaligus Presiden Pertama RI yaitu Soekarno. Makam Bung Karno berada di Jalan Ir Soekarno, Nomor 152, Bendogerit, Kecamatan Sananwetan, Kota Blitar, Jawa Timur."
        ]);
        \App\Models\Place::create([
            'name' => 'Lumajang',
            'latitude' => -8.094357,
            'longitude' => 113.144157,
            'image' => 'placeImages/lumajang.png',
            'description' => "Kabupaten Lumajang merupakan salah satu daerah yang berada di wilayah Provinsi Jawa Timur. Kabupaten ini terkenal dengan julukan 'Kota Pisang', karena daerah ini merupakan penghasil berbagai jenis buah pisang yang enak"
        ]);

        \App\Models\Schedule::create([
            'object' => 'bus',
            'from_place_id' => 1,
            'to_place_id' => 3,
            'line' => 'Jl. Tol Pandaan - Malang',
            'departure_time' => '20:00:00',
            'arrival_time' => '01:00:00',
            'distance' => 58,
            'speed' => 12
        ]);

        \App\Models\Schedule::create([
            'object' => 'train',
            'from_place_id' => 3,
            'to_place_id' => 2,
            'line' => 'Jl. Nasional III',
            'departure_time' => '21:00:00',
            'arrival_time' => '08:00:00',
            'distance' => 108,
            'speed' => 45
        ]);

        \App\Models\Schedule::create([
            'object' => 'bus',
            'from_place_id' => 3,
            'to_place_id' => 2,
            'line' => 'Jl. Semeru',
            'departure_time' => '12:00:00',
            'arrival_time' => '17:30:00',
            'distance' => 108,
            'speed' => 45
        ]);


    }
}
