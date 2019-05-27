<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PopulateConsumerTable extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('areas')->delete();

        function csv_to_array($filename='', $delimiter=';')
        {
            if(!file_exists($filename) || !is_readable($filename))
                return FALSE;

            $header = NULL;
            $data = array();
            if (($handle = fopen($filename, 'r')) !== FALSE)
            {
                while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
                {
                    if(!$header)
                        $header = $row;
                    else
                        $data[] = array_combine($header, $row);
                }
                fclose($handle);
            }
            return $data;
        }

        $csvFile = base_path().'/database/data/export.csv';

        Log::debug($csvFile);

        $data = csv_to_array($csvFile);

        DB::table('consumer')->insert($data);
    }

}
