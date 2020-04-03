<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cif extends Model
{
    //
    protected $table = 'cif';
    public $timestamps = false;

    protected $fillable = [
        'nocifalt',	'kodecabang',	'jenisidentitas',	'namanasabah',	'jenisnasabah',	'perorangan_noktp',	'perorangan_tempatlahir',	'perorangan_tgllahir',	'perorangan_jeniskelamin',	'perorangan_agama',	'dataalamat_rumah_alamat1',	'dataalamat_ktp_rt',	'dataalamat_ktp_rw',	'dataalamat_ktp_kecamatan',	'dataalamat_ktp_kota',	'dataalamat_ktp_propinsi',	'dataalamat_rumah_notelp',	'tglbukacif','status','keterangan'
    ];
}


