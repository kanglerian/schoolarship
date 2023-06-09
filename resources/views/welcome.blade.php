<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Politeknik LP3I Kampus Tasikmalaya adalah perguruan tinggi swasta di Kota Tasikmalaya berbasis pendidikan vokasi yaitu 70% praktek dan 30% teori. Mahasiswa/i Politeknik LP3I Kampus Tasikmalaya di semester 6 akan ditempatkan bekerja oleh bagian Career Center di perusahaan relasi. Mandiri, tepat dan cepat kerja!">
    <meta name="keywords"
        content="Kuliah, Penempatan Kerja, Kampus Vokasi, Beasiswa Pendidikan, Perguruan Tinggi, Politeknik, LP3I, Kota Tasikmalaya, Vokasi, Kuliah Praktek">
    <meta name="author" content="Politeknik LP3I Kampus Tasikmalaya">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Politeknik LP3I Kampus Tasikmalaya</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
</head>

<body class="bg-slate-100">
    <div class="container mx-auto">
        <div class="flex flex-col items-center justify-center gap-3 md:h-screen" data-aos="fade-down" data-aos-delay="150">
            <div class="flex flex-col items-center gap-2 text-center py-3">
                <img src="{{ asset('img/lp3i.svg') }}" alt="Politeknik LP3I Kampus Tasikmalaya" class="h-16">
                <h1 class="text-2xl font-bold text-slate-900 uppercase">Beasiswa Politeknik LP3I Kampus Tasikmalaya</h1>
                <p class="text-slate-700 text-sm">Cek status beasiswa kamu dengan scan QRCode atau tuliskan kode. Lalu tukarkan kode beasiswamu ini ke Politeknik LP3I Kampus Tasikmalaya.</p>
            </div>
            {{-- <div data-aos="fade-down" data-aos-delay="100" class="px-4">
                <video id="scanner" class="w-full md:w-1/3 shadow-lg mx-auto my-auto md:rounded-lg"></video>
            </div> --}}
            <form id="cekBeasiswa" action="{{ route('schoolarship.store') }}" method="POST">
                @csrf
                <div class="flex items-center justify-center gap-3 py-5">
                    <input type="text" id="code" name="code"
                        class="text-sm px-3 py-2 w-[230px] rounded-lg border border-slate-300 outline-slate-300"
                        placeholder="Tulis kode beasiswa disini..." autofocus>
                    <button type="submit" class="bg-sky-500 px-4 py-2 rounded-lg text-sm text-white"
                        onclick="cari()"><i class="fa-solid fa-magnifying-glass"></i> Cari</button>
                </div>
                <hr>
                <footer class="text-center text-slate-500 text-xs my-3">
                    <p>Copyright © 2023 Politeknik LP3I Kampus Tasikmalaya</p>
                </footer>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/dom-to-image.min.js') }}"></script>
    <script src="{{ asset('js/qrcode.js') }}"></script>
    <script src="{{ asset('js/qr-scanner.umd.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        let videoElem = document.getElementById('scanner');
        let code = document.getElementById('code');
        let alertInfo = document.getElementById('alertInfo');

        const qrScanner = new QrScanner(
            videoElem,
            result => {
                axios.post(`https://schoolarship.politekniklp3i-tasikmalaya.ac.id/api/schoolarship`,{
                    code: code.value
                })
                    .then((response) => {
                        if (response.data.length > 0) {
                            let student = response.data[0];
                            code.value = student.code;
                            $('#alertContent').removeClass('bg-red-500');
                            $('#alertContent').addClass('bg-emerald-500');
                            $('#alertContent').html(
                                `
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="bg-slate-100 px-2 py-1 text-emerald-500 rounded"><i class="fa-solid fa-check"></i></span>
                                    <span>Data ditemukan!</span>
                                </div>
                                <button class="hover:bg-emerald-600 px-2 py-1 rounded"><i class="fa-solid fa-xmark"></i></button>
                                `);
                            $('#alertInfo').show();
                            $('#cekBeasiswa').submit();
                        } else {
                            $('#alertContent').removeClass('bg-emerald-500');
                            $('#alertContent').addClass('bg-red-500');
                            $('#alertContent').html(
                                `
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="bg-slate-100 px-2 py-1 text-red-500 rounded"><i class="fa-solid fa-triangle-exclamation"></i></span>
                                    <span>Data tidak ditemukan</span>
                                </div>
                                <button onclick="tutup()" class="hover:bg-red-600 px-2 py-1 rounded"><i class="fa-solid fa-xmark"></i></button>
                                `);
                            $('#alertInfo').show();
                        }
                    })
                    .catch((error) => {
                        $('#my-node').hide();
                    });
            }, {
                maxScansPerSecond: 2,
                highlightScanRegion: true,
                highlightCodeOutline: true
            }
        );
        qrScanner.start();

        const tutup = () => {
            $('#alertInfo').hide();
        }
    </script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease'
        });
    </script>
</body>

</html>
