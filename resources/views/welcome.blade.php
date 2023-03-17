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
    <div>
      <div data-aos="fade-down" data-aos-delay="150">
          <video id="scanner" class="w-full md:w-1/3 rounded-xl border-4 border-gray-100 mx-auto"></video>
          <form id="cekBeasiswa" action="{{ route('schoolarship.store') }}" method="POST">
              @csrf
              <input type="hidden" id="code" name="code">
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

        const qrScanner = new QrScanner(
            videoElem,
            result => {
                axios.get(`https://schoolarship.politekniklp3i-tasikmalaya.ac.id/api/schoolarship/${result.data}`)
                    .then((response) => {
                        if (response.data.length > 0) {
                            let student = response.data[0];
                            code.value = student.code;
                            $('#scanner').removeClass('border-red-400');
                            $('#scanner').removeClass('border-gray-100');
                            $('#scanner').addClass('border-emerald-400');
                            $('#my-node').show();
                            $('#cekBeasiswa').submit();
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
        AOS.init({
            duration: 800,
            easing: 'ease'
        });
    </script>
</body>

</html>
