<?php

namespace Database\Seeders;

use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Throwable;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataFromCSVFileSeeder extends Seeder
{
    private string $path = 'database/property-data.csv';

    /**
     * Seed the application's database.
     * @throws Exception
     */
    public function run(): void
    {
        if (file_exists($this->path)) {
            foreach ($this->csvToArray($this->path) as $record) {
                DB::table('apartments')->insert($record);
            }
        }
    }

    private function csvToArray(string $path): array
    {
        $records = [];
        $row = 0;
        if (($handle = fopen($this->path, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000)) !== FALSE) {
                $row++;
                if ($row > 1) {
                    $records[] = [
                        'name' => $data[0],
                        'price' => $data[1],
                        'bedrooms' => $data[2],
                        'bathrooms' => $data[3],
                        'storeys' => $data[4],
                        'garages' => $data[5],
                        'created_at' => now(),
                    ];
                }
            }
            fclose($handle);
        }

        return $records;
    }
}
