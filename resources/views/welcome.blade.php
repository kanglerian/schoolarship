<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body class="bg-[#E6E7E8]">
    <div class="fixed inset-0 z-[-1] flex justify-center items-center px-4">
        <img src="./img/indonesia.png" alt="" class="h-auto md:h-80 opacity-70">
    </div>
    <section class="flex flex-col items-center justify-center h-screen gap-5">
        <div class="flex flex-col items-center justify-center text-center space-y-6">
            <img src="./img/lp3i.svg" alt="" class="hidden md:block h-16" data-aos="fade-down">
            <div class="hidden md:block space-y-2">
                <h1 id="header" class="text-2xl font-bold text-slate-900" data-aos="fade-down" data-aos-delay="50">
                    Cek Beasiswa Disini!</h1>
                <p id="subHeader" class="text-sm text-slate-700" data-aos="fade-down" data-aos-delay="100">Silahkan isi
                    dengan kode beasiswa yang dimiliki:</p>
            </div>
            <div class="flex justify-center items-center mx-4" data-aos="fade-down" data-aos-delay="150">
                <video id="scanner" class="w-full md:w-1/3 rounded-xl border-4 border-gray-100"></video>
                <form id="cekBeasiswa" action="{{ route('schoolarship.store') }}" method="POST">
                  @csrf
                  <input type="hidden" id="code" name="code">
                </form>
            </div>
        </div>
    </section>

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
                highlightScanRegion: true
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
            let getName = document.getElementById('name');
            let name = getName.innerText.replace(" ", "-").toLowerCase();
            console.log(name);
            var node = document.getElementById('my-node');
            domtoimage.toJpeg(document.getElementById('my-node'), {
                    quality: 1
                })
                .then(function(dataUrl) {
                    var link = document.createElement('a');
                    link.download = `voucher-${name}.jpeg`;
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
