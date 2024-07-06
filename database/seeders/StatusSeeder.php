<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'PENDING',
            ],
            [
                'name' => 'FAILED'
            ],
            [
                'name' => 'LIVE',
            ],
            [
                'name' => 'ANNOUNCEMENT'
            ],
            [
                'name' => 'DONE'
            ]
        ];

        foreach ($data as $item) {
            Status::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name'])
            ]);
        }
    }
}
