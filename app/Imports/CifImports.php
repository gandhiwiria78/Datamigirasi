<?php

namespace App\Imports;

use App\Cif;
use Illuminate\Support\Collection;
use Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class CifImports implements ToCollection,WithHeadingRow
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function transformDateTime(string $value, string $format = 'Y/m/d')
    {
        try {
                return Carbon::instance(Date::excelToDateTimeObject($value))->format($format);
            } catch (\ErrorException $e) {
                return Carbon::parse(date($format,strtotime($value)));
            }
    }

    public function collection(Collection $rows)
    {
        $data_error = array();
        $detail_error = array();
        foreach ($rows as $row)
        {

            try {
                $kodecabang = $row['kodelokasi'];
            } catch (\Exception $e) {
                $kodecabang = $row['kodecabang'];
            }

            try {

                $tgllahir= $this->transformDateTime($row['perorangan_tgllahir']);
                $data = [
                    //
                    'nocifalt'  => $row['nocifalt'],
                    'kodecabang' => $kodecabang,
                    'jenisidentitas' => $row['jenisidentitas'],
                    'namanasabah' => $row['namanasabah'],
                    'jenisnasabah' => $row['jenisnasabah'],
                    'perorangan_noktp' => $row['perorangan_noktp'],
                    'perorangan_tempatlahir' => $row['perorangan_tempatlahir'],
                    'perorangan_tgllahir' => $tgllahir,
                    'perorangan_jeniskelamin' => $row['perorangan_jeniskelamin'],
                    'perorangan_agama' => $row['perorangan_agama'],
                    'dataalamat_rumah_alamat1' => $row['dataalamat_rumah_alamat1'],
                    'dataalamat_ktp_rt' => $row['dataalamat_ktp_rt'],
                    'dataalamat_ktp_rw' => $row['dataalamat_ktp_rw'],
                    'dataalamat_ktp_kecamatan' => $row['dataalamat_ktp_kecamatan'],
                    'dataalamat_ktp_kota' => $row['dataalamat_ktp_kota'],
                    'dataalamat_ktp_propinsi' => $row['dataalamat_ktp_propinsi'],
                    'dataalamat_rumah_notelp' => $row['dataalamat_rumah_notelp'],
                    //tglbukacif' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tglbukacif']),
                ];
            } catch (\Exception $e) {
                array_push($data,$e);
                array_push($data_error,$data);
            }


             Cif::create($data);


        }

        if(count($data_error)>0){
            dd($data_error);
        }
    }

    public function model(array $row)
    {
       // dd($row);
        // return new Cif([
        //     //
        //     'nocifalt'  => $row['nocifalt'],
        //     'kodecabang' => $row['kodecabang'],
        //     'jenisidentitas' => $row['jenisidentitas'],
        //     'namanasabah' => $row['namanasabah'],
        //     'jenisnasabah' => $row['jenisnasabah'],
        //     'perorangan_noktp' => $row['perorangan_noktp'],
        //     'perorangan_tempatlahir' => $row['perorangan_tempatlahir'],
        //     'perorangan_tgllahir' => $row['perorangan_tgllahir'],
        //     'perorangan_jeniskelamin' => $row['perorangan_jeniskelamin'],
        //     'perorangan_agama' => $row['perorangan_agama'],
        //     'dataalamat_rumah_alamat1' => $row['dataalamat_rumah_alamat1'],
        //     'dataalamat_ktp_rt' => $row['dataalamat_ktp_rt'],
        //     'dataalamat_ktp_rw' => $row['dataalamat_ktp_rw'],
        //     'dataalamat_ktp_kecamatan' => $row['dataalamat_ktp_kecamatan'],
        //     'dataalamat_ktp_kota' => $row['dataalamat_ktp_kota'],
        //     'dataalamat_ktp_propinsi' => $row['dataalamat_ktp_propinsi'],
        //     'dataalamat_rumah_notelp' => $row['dataalamat_rumah_notelp'],
        //     'tglbukacif' => $row['tglbukacif'],
        // ]);
    }

    // public function mapping(): array
    // {
    //     return [
    //         'nocifalt'  => 'A1',
    //         'kodecabang' => 'B1',
    //         'jenisidentitas' => 'C1',
    //         'namanasabah' => 'D1',
    //         'jenisnasabah' => 'E1',
    //         'perorangan_noktp' =>'F1',
    //         'perorangan_tempatlahir'=>'G1',
    //         'perorangan_tgllahir' => 'H1',
    //         'perorangan_jeniskelamin' => 'I1',
    //         'perorangan_agama' => 'J1',
    //         'dataalamat_rumah_alamat1' => 'K1',
    //         'dataalamat_ktp_rt' => 'L1',
    //         'dataalamat_ktp_rw' => 'M1',
    //         'dataalamat_ktp_kecamatan' => 'N1',
    //         'dataalamat_ktp_kota' => 'O1',
    //         'dataalamat_ktp_propinsi' => 'P1',
    //         'dataalamat_rumah_notelp' => 'Q1',
    //         'tglbukacif' => 'R1',
    //     ];
    // }
}
