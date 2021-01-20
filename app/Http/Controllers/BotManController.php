<?php

namespace App\Http\Controllers;

use App\Conversations\ExampleConversation;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('/start|help|start|info' , function ($bot) {
            $bot->typesAndWaits(2);
            $bot->reply(
    <<<EOT
    Hai saya adalah AdministrasiKDCW Chatbot, silahkan bertanya seputar administrasi di KeDai Computerworks dengan cara mengirim perintah seperti di bawah ini :
                
    /surat [nomor/judul surat]
    Untuk menemukan informasi surat.
    
    /anggota [NRA/nama anggota]
    Untuk menemukan informasi anggota.
    
    /barang [nama barang]
    Untuk menemukan informasi barang.
    
    /dana [keterangan dana]
    Untuk menemukan informasi dana.
    
    /relasi [nama instansi]
    Untuk menemukan informasi relasi.
EOT
            );
        });
        
        //Perintah menampilkan surat
        $botman->hears('/surat {hear}', function ($bot, $hear) {
            $surat = DB::table('persuratans')
                ->where('no_surat', 'like', '%'.$hear.'%')
                ->orWhere('judul', 'like', '%'.$hear.'%')
                ->first();
            
            // $attachment = new Image(asset('storage/administrasi/'.$surat->foto), [
            //     'custom_payload' => true,
            // ]);
            // $message = OutgoingMessage::create($surat->foto)->withAttachment($attachment);
            
            $bot->typesAndWaits(2);
            
            if (!$surat) {
                $bot->reply('Maaf, data yang Anda cari tidak ditemukan!');
            }
            else {
                $bot->reply(
<<<EOT
INFORMASI SURAT
No. Surat : $surat->no_surat
Judul Surat : $surat->judul
Jenis Surat : $surat->jenis_surat
Dari/Kepada : $surat->dari_kepada
Tgl. Surat : $surat->tanggal
EOT
                );
            
                // $bot->reply($message);  
                $bot->reply(asset('storage/administrasi/'.$surat->foto));
            }
        });
        
        //Perintah menampilkan anggota
        $botman->hears('/anggota {hear}', function ($bot, $hear) {
            $anggota = DB::table('users')
                ->join('jabatans', 'users.jabatan', '=', 'jabatans.id')
                ->select([
                    'users.nama as nama',
                    'users.noreg as noreg',
                    'users.email as email',
                    'users.kontak as kontak',
                    'users.alamat as alamat',
                    'users.status_surat as status_surat',
                    'jabatans.nama as jabatan',
                ])
                ->where('users.nama', 'like', '%'.$hear.'%')
                ->orWhere('users.noreg', 'like', '%'.$hear.'%')
                ->first();
            
            $bot->typesAndWaits(2);
            
            if (!$anggota) {
                $bot->reply('Maaf, data yang Anda cari tidak ditemukan!');
            }
            else {
                $bot->reply(
<<<EOT
INFORMASI ANGGOTA
Nama Lengkap : $anggota->nama
NRA : $anggota->noreg
Jabatan : $anggota->jabatan
Email : $anggota->email
Kontak : $anggota->kontak
Alamat : $anggota->alamat
Status Surat : $anggota->status_surat
EOT
                );
            }
        });
        
        //Perintah menampilkan barang
        $botman->hears('/barang {hear}', function ($bot, $hear) {
            $barang = DB::table('databarangs')
                ->where('nama', 'like', '%'.$hear.'%')
                ->first();
            
            // $attachment = new Image(asset('storage/inventaris/'.$barang->foto), [
            //     'custom_payload' => true,
            // ]);
            // $message = OutgoingMessage::create($barang->foto)->withAttachment($attachment);
            
            $bot->typesAndWaits(2);
            
            if (!$barang) {
                $bot->reply('Maaf, data yang Anda cari tidak ditemukan!');
            }
            else {
                $bot->reply(
<<<EOT
INFORMASI BARANG
Nama Barang : $barang->nama
Kondisi Barang : $barang->kondisi
Jumlah Tersedia : $barang->tersedia
Jumlah Dipinjam : $barang->dipinjam
EOT
                );
                
                // $bot->reply($message);
                $bot->reply(asset('storage/inventaris/'.$barang->foto));
            }
        });
        
        //Perintah menampilkan dana
        $botman->hears('/dana {hear}', function ($bot, $hear) {
            $dana = DB::table('keuangans')
                ->where('keterangan', 'like', '%'.$hear.'%')
                ->first();

            // $attachment = new Image(asset('storage/keuangan/'.$dana->nota), [
            //     'custom_payload' => true,
            // ]);
            // $message = OutgoingMessage::create($dana->nota)->withAttachment($attachment);
            
            $bot->typesAndWaits(2);
            
            if (!$dana) {
                $bot->reply('Maaf, data yang Anda cari tidak ditemukan!');
            }
            else {
                $bot->reply(
<<<EOT
INFORMASI DANA
Keterangan : $dana->keterangan
Jenis Dana : $dana->jenis_dana
Nominal Dana : Rp. $dana->nominal
EOT
                );
            
                // $bot->reply($message); 
                $bot->reply(asset('storage/keuangan/'.$dana->nota));
            }
        });
        
        //Perintah menampilkan relasi
        $botman->hears('/relasi {hear}', function ($bot, $hear) {
            $relasi = DB::table('relasis')
                ->where('nama', 'like', '%'.$hear.'%')
                ->first();
            
            // $attachment = new Image(asset('storage/relasi/'.$relasi->logo), [
            //     'custom_payload' => true,
            // ]);
            // $message = OutgoingMessage::create($relasi->logo)->withAttachment($attachment);
            
            $bot->typesAndWaits(2);
            
            if (!$relasi) {
                $bot->reply('Maaf, data yang Anda cari tidak ditemukan!');
            }
            else {
                $bot->reply(
<<<EOT
INFORMASI RELASI
Nama Instansi : $relasi->nama
Alamat : $relasi->alamat
Email : $relasi->email
Kontak : $relasi->kontak
Keterangan : $relasi->keterangan
EOT
                );
            
                // $bot->reply($message);
                $bot->reply(asset('storage/relasi/'.$relasi->logo));
            }
        });

        //Fallback Error
        $botman->fallback(function($bot) {
            $bot->reply('Perintah yang anda input salah!, untuk mengetahui perintah yang ada silakan masukkan perintah /start atau help');
        });

        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
    }
}