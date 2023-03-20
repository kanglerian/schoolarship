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

<body class="bg-[#E6E7E8]">
    @forelse ($students as $student)
        <div class="h-screen flex items-center justify-center">
            <div class="w-full md:w-2/5 p-5" data-aos="fade-down">
                <h1>Selamat, Anda Mendapatkan Beasiswa!</h1>
                <div id="my-node" onclick="download()" role="button"
                    class="bg-white border border-slate-300 bg-center bg-cover w-full">
                    <div class="flex flex-col md:flex-row text-center md:text-left justify-between items-center p-5">
                        <div class="space-y-3">
                            <img src="./img/lp3i.svg" class="inline h-12">
                            <h1 class="font-bold text-lg">Penerima Beasiswa</h1>
                            <ul class="space-y-1">
                                <li>{{ $student->name }}</li>
                                <li class="text-sm">{{ $student->school }}</li>
                            </ul>
                        </div>
                        <div class="flex flex-col items-center gap-2">
                            <input type="hidden" id="isian" value="{{ $student->code }}">
                            <canvas id="canvas" class="h-28"></canvas>
                            <p class="text-sm">{{ $student->code }}</p>
                        </div>
                    </div>
                    <footer class="bg-slate-800 text-white text-center text-xs px-5 py-1">
                        <div class="flex justify-between">
                            <p>PMB 2023/2024</p>
                            <p class="flex gap-2"><span>lp3i.tasik</span> | <span>081313608558</span></p>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    @empty
        <p>Tidak ada</p>
    @endforelse


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
