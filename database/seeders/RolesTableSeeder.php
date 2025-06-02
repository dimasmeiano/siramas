<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
        ['name' => 'admin'],
        ['name' => 'anggota'],
        ['name' => 'kontributor'],
        ['name' => 'sekretaris'],
        ['name' => 'bendahara'],
    ]);

    DB::table('departements')->insert([
        ['name' => 'Ketua'],
        ['name' => 'Wakil Ketua'],
        ['name' => 'Sekretaris'],
        ['name' => 'Wakil Sekretaris'],
        ['name' => 'Bendahara'],
        ['name' => 'Wakil Bendahara'],
        ['name' => 'Koordinator Departemen Dakwah dan Syiar Agama'],
        ['name' => 'Koordinator Departemen Seni, Budaya dan Olahraga'],
        ['name' => 'Koordinator Departemen Komunikasi dan Informasi'],
        ['name' => 'Koordinator Departemen Kewirausahaan'],
        ['name' => 'Departemen Dakwah dan Syiar Agama'],
        ['name' => 'Departemen Seni, Budaya dan Olahraga'],
        ['name' => 'Departemen Komunikasi dan Informasi'],
        ['name' => 'Departemen Kewirausahaan'],
    ]);
    }
}
