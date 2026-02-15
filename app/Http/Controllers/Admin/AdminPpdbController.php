<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentModel;
use App\Models\ParentModel;
use Illuminate\Support\Str;
use App\Models\PpdbApplication;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminPpdbController extends Controller
{
    public function index()
    {
        $ppdbs = PpdbApplication::latest()
            ->paginate(6);

        return view('admin.ppdb.index', compact('ppdbs'));
    }


    public function show(PpdbApplication $ppdb)
    {
        return view('admin.ppdb.show', compact('ppdb'));
    }


    public function approve(
        Request $request,
        PpdbApplication $ppdb,
        WhatsAppService $wa
    ) {
        // cegah approve ulang
        if ($ppdb->status !== 'submitted') {
            abort(403);
        }

        DB::transaction(function () use ($request, $ppdb) {

            /*
            |--------------------------------------------------------------------------
            | BUAT AKUN SISWA
            |--------------------------------------------------------------------------
            */

            $studentUser = User::create([
                'name' => $ppdb->fullname,
                'email' => $ppdb->student_email,
                'phone' => $ppdb->phone,
                'password' => bcrypt('password123'),
                'role' => 'student',
            ]);


            /*
            |--------------------------------------------------------------------------
            | BUAT ORTU (JIKA ADA)
            |--------------------------------------------------------------------------
            */

            $parentModel = null;

            if ($ppdb->parent_name && $ppdb->parent_phone) {

                $parentUser = User::create([
                    'name' => $ppdb->parent_name,
                    'email' => $ppdb->parent_email,
                    'phone' => $ppdb->parent_phone,
                    'password' => bcrypt('password123'),
                    'role' => 'ortu',
                ]);

                $parentModel = ParentModel::create([
                    'user_id' => $parentUser->id,
                    'name' => $ppdb->parent_name,
                    'email' => $ppdb->parent_email,
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | BUAT DATA STUDENT
            |--------------------------------------------------------------------------
            */

            StudentModel::create([
                'fullname' => $ppdb->fullname,
                'birthdate' => $ppdb->birthdate,
                'gender' => $ppdb->gender,
                'school' => $ppdb->school,
                'email' => $ppdb->student_email,
                'address' => $ppdb->address,

                'user_id' => $studentUser->id,
                'parent_id' => $parentModel?->id,

                // class_id NULL → trial dulu
                'status_siswa' => 'active',
            ]);


            /*
            |--------------------------------------------------------------------------
            | UPDATE STATUS PPDB
            |--------------------------------------------------------------------------
            */

            $ppdb->update([
                'status' => 'approved',
                'validated_at' => now(),
                'validated_by' => auth()->id(),
                'admin_note' => $request->note,
            ]);
        });


        /*
        |--------------------------------------------------------------------------
        | KIRIM WHATSAPP
        |--------------------------------------------------------------------------
        */

        $message =
            "Halo {$ppdb->fullname}\n\n" .
            "Pendaftaran Anda TELAH DITERIMA.\n\n" .
            "Akun Login:\n" .
            "No HP: {$ppdb->phone}\n" .
            "Password: password123\n\n" .
            "Silakan login dan ikuti trial class.\n" .
            "Terima kasih.";

        $wa->send($ppdb->phone, $message);


        return redirect()
            ->route('admin.ppdb.show', $ppdb->id)
            ->with('success', 'PPDB berhasil disetujui');
    }


    public function reject(Request $request, PpdbApplication $ppdb)
    {
        $request->validate([
            'note' => 'required',
        ]);

        $ppdb->update([
            'status' => 'rejected',
            'validated_at' => now(),
            'validated_by' => auth()->id(),
            'admin_note' => $request->note,
        ]);

        return redirect()
            ->route('admin.ppdb.show', $ppdb->id)
            ->with('success', 'Pendaftaran ditolak');
    }
}
