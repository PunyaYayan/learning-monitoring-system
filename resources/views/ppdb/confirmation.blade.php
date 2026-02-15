<x-public-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">
            Pendaftaran Berhasil
        </h2>
    </x-slot>

    <x-card>

        <div class="text-center space-y-4">

            <h3 class="text-lg font-semibold">
                Terima kasih, {{ $ppdb->fullname }}
            </h3>


            {{-- SISWA / ORTU --}}
            @if(in_array($ppdb->applicant_type, ['student', 'parent']))

                <p class="text-sm text-gray-700">
                    Pendaftaran Anda telah kami terima.
                </p>

                <p class="text-sm text-gray-700">
                    Silakan menunggu informasi selanjutnya melalui WhatsApp.
                </p>

                <p class="text-sm text-gray-500">
                    Nomor: {{ $ppdb->phone }}
                </p>


                {{-- MAHASISWA / PEKERJA --}}
            @elseif($ppdb->applicant_type === 'worker')

                <p class="text-sm text-gray-700">
                    Pendaftaran Anda telah kami terima.
                </p>

                <p class="text-sm text-gray-700 font-semibold">
                    Silakan lakukan pembayaran administrasi sebesar:
                </p>

                <div class="text-2xl font-bold text-green-600">
                    Rp 100.000
                </div>

                <p class="text-sm text-gray-700 mt-2">
                    Transfer ke rekening:
                </p>

                <p class="text-sm font-medium">
                    BCA 1234567890<br>
                    a.n New Concept Course
                </p>

                <p class="text-sm text-gray-500 mt-2">
                    Setelah transfer, kirim bukti via WhatsApp.
                </p>

            @endif


            <div class="mt-6">
                <a href="/" class="text-blue-600 underline text-sm">
                    Kembali ke Beranda
                </a>
            </div>

        </div>

    </x-card>

</x-public-layout>