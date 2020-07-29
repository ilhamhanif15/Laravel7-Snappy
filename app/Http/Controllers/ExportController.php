<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Factory as Faker; //import Faker untuk generate random data
use PDF; //import Fungsi PDF

class ExportController extends Controller
{
    public function printTable() {
        $dataDummy = [];
        $faker = Faker::create();

        //Max Data yang akan coba ditampilkan
        $MAX_DATA = 5000;

        //Membuat Data Faker sebanyak MAX_DATA
        for ($i = 0; $i < $MAX_DATA; $i++) {
            $people = (Object) [
                "id" => $i,
                "name" => $faker->name,
                "address" => $faker->address,
                "email" => $faker->email,
                "company" => $faker->company
            ];

            array_push($dataDummy, $people);
        }


        $data = [
            "dataDummy" => $dataDummy
        ];

        $pdf = PDF::loadView('tableView', $data);

        //Aktifkan Local File Access supaya bisa pakai file external ( cth File .CSS )
        $pdf->setOption('enable-local-file-access', true);

        // Stream untuk menampilkan tampilan PDF pada browser
        return $pdf->stream('table.pdf');

        // Jika ingin langsung download (tanpai melihat tampilannya terlebih dahulu) kalian bisa pakai fungsi download
        // return $pdf->download('table.pdf);
    }
}
