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
    {{-- @if ($student !== null) --}}
    <div class="h-screen flex items-center justify-center">
        <div class="w-full md:w-2/5 p-5" data-aos="fade-down">
            <div class="text-center mb-8 space-y-2">
                <h1 class="font-bold text-2xl text-slate-900 mt-5" data-aos="fade-down" data-aos-delay="150">
                    Selamat,
                    anda telah mendapatkan beasiswa!</h1>
                <p class="text-slate-700" data-aos="fade-down" data-aos-delay="200">Download dan tukarkan voucher ini ke
                    Politeknik
                    LP3I Kampus Tasikmalaya.</p>
                <div class="space-x-2">
                    <a href="https://pmb.politekniklp3i-tasikmalaya.ac.id/dashboard/form_pmb" data-aos="fade-down"
                        data-aos-delay="250"
                        class="inline-block bg-[#00426D] text-white rounded-lg px-4 py-2 text-sm">Daftar Online <i
                            class="fa-solid fa-square-check mr-1"></i></a>
                    <a href="https://forms.gle/KSbs6gjQpC86uCAK6" onclick="download()" data-aos="fade-down"
                        data-aos-delay="250"
                        class="inline-block bg-[#009DA5] text-white rounded-lg px-4 py-2 text-sm">Carter Kuota <i
                            class="fa-regular fa-address-card"></i></a>
                </div>
            </div>
            <div id="my-node" onclick="download()" role="button" class="w-full shadow-lg rounded-lg">
                <div
                    class="bg-white flex flex-col md:flex-row text-center md:text-left justify-between items-center p-5 rounded-t-lg">
                    <div class="space-y-3">
                        <img src="{{ asset('/img/lp3i.svg') }}" class="inline h-12">
                        <h1 class="font-bold text-lg text-[#00426D]">Penerima Beasiswa</h1>
                        <ul class="space-y-1">
                            <li class="text-xl font-bold">{{ $student->name == '' ? 'Your full name' : $student->name }}
                            </li>
                            <li class="text-sm">{{ $student->school == '' ? 'Your school' : $student->school }}</li>
                        </ul>
                    </div>
                    <div class="flex flex-col items-center gap-2">
                        <input type="hidden" id="isian"
                            value="{{ $student->code == '' ? '0000000001' : $student->code }}">
                        <canvas id="canvas" class="h-28"></canvas>
                        <p class="text-sm">{{ $student->code == '' ? '0000000001' : $student->code }}</p>
                    </div>
                </div>
                <footer class="bg-red-500 text-white text-center text-[10px] py-1 px-2">
                    <p>Kuota hanya untuk 30 orang pertama saja!</p>
                </footer>
                <footer class="bg-[#00426D] text-white text-center text-[10px] px-5 py-1 rounded-b-lg">
                    <div class="flex flex-col items-center">
                        <p>Jl. Ir. H. Juanda No.106, Panglayungan, Kec. Cipedes Kota Tasikmalaya, Jawa Barat 46151</p>
                        <p class="flex gap-2"><span>@lp3i.tasik</span> | <span>081313608558</span></p>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    {{-- @else --}}
    {{-- <div class="h-screen flex items-center justify-center">
        <div class="w-full md:w-2/5 p-5" data-aos="fade-down">
            <div class="text-center mb-8 space-y-2">
                <a href="{{ route('schoolarship.index') }}"
                    class="inline-block bg-slate-200 hover:bg-slate-300 px-4 py-2 rounded-lg mb-2" data-aos="fade-down"
                    data-aos-delay="100"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                <h1 class="font-bold text-2xl text-slate-900 mt-5" data-aos="fade-down" data-aos-delay="150">
                    Data Penerima Beasiswa Tidak Ditemukan</h1>
                <p class="text-slate-700" data-aos="fade-down" data-aos-delay="200">Isi kode beasiswa dengan benar, hubungi Panitia PMB Politeknik LP3I Kampus Tasikmalaya.</p>
                <a href="https://bit.ly/InfoPMBLP3ITasik" data-aos="fade-down" data-aos-delay="250" class="inline-block bg-emerald-500 text-white rounded-lg px-4 py-2 text-sm"><i class="fa-brands fa-whatsapp"></i> Hubungi kami!</a>
            </div>
        </div>
    </div> --}}
    {{-- @endif --}}

    <script src="{{ asset('js/dom-to-image.min.js') }}"></script>
    <script src="{{ asset('js/qrcode.js') }}"></script>
    <script src="{{ asset('js/qr-scanner.umd.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        let videoElem = document.getElementById('scanner');
        let code = document.getElementById('code');
        let name = document.getElementById('name');
        let school = document.getElementById('school');
        let codeBeasiswa = document.getElementById('codeBeasiswa');
        let canvas = document.getElementById('canvas');
        let isian = document.getElementById('isian');

        QRCode.toCanvas(canvas, `${isian.value}`, function(error) {
            if (error) console.error(error)
            $('#my-node').show();
        })


        const qrScanner = new QrScanner(
            videoElem,
            result => {
                axios.get(`https://schoolarship.politekniklp3i-tasikmalaya.ac.id/api/schoolarship/${result.data}`)
                    .then((response) => {
                        if (response.data.length > 0) {
                            let student = response.data[0];
                            code.value = student.code;
                            name.innerText = student.name;
                            school.innerText = student.school;
                            codeBeasiswa.innerText = student.code;
                            QRCode.toCanvas(canvas, `${student.code}`, function(error) {
                                if (error) console.error(error)
                                $('#scanner').removeClass('border-red-400');
                                $('#scanner').removeClass('border-gray-100');
                                $('#scanner').addClass('border-emerald-400');
                                $('#my-node').show();
                                $('#cekBeasiswa').submit();
                            })
                        } else {
                            $('#scanner').removeClass('border-gray-100');
                            $('#scanner').removeClass('border-emerald-400');
                            $('#scanner').addClass('border-red-400');
                            $('#my-node').hide();
                        }
                    })
                    .catch((error) => {
                        $('#my-node').hide();
                    });
            }, {
                maxScansPerSecond: 2,
            }
        );
        qrScanner.start();
    </script>
    <script>
        const cari = () => {
            let code = document.getElementById('code').value;
            let name = document.getElementById('name');
            let school = document.getElementById('school');
            let codeBeasiswa = document.getElementById('codeBeasiswa');
            let canvas = document.getElementById('canvas');
            axios.get(`https://schoolarship.politekniklp3i-tasikmalaya.ac.id/api/schoolarship/${code}`)
                .then((response) => {
                    if (response.data.length > 0) {
                        let student = response.data[0];
                        name.innerText = student.name;
                        school.innerText = student.school;
                        codeBeasiswa.innerText = student.code;
                        QRCode.toCanvas(canvas, `${student.code}`, function(error) {
                            if (error) console.error(error)
                            $('#my-node').show();
                        })
                        absenSekarang(student);
                    } else {
                        $('#scanner').removeClass('border-gray-100');
                        $('#scanner').removeClass('border-emerald-400');
                        $('#scanner').addClass('border-red-400');
                        $('#my-node').hide();
                    }
                })
                .catch((error) => {
                    $('#my-node').hide();
                });
        }
        const download = async () => {
            var node = document.getElementById('my-node');
            domtoimage.toJpeg(document.getElementById('my-node'), {
                    quality: 1
                })
                .then(function(dataUrl) {
                    var link = document.createElement('a');
                    link.download = `voucher.jpeg`;
                    link.href = dataUrl;
                    link.click();
                });
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
