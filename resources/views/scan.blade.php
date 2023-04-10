<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Scanner') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col items-center">
                        <input type="text" id="hasil" class="mb-2 py-1 px-2 border rounded-md border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-400">
                        <div class="flex flex-col items-center">
                            <video id="preview" class="h-80 w-full object-cover"></video>
                            <div class="flex justify-center space-x-4 mt-4">
                                <button id="startScan" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                                    Start Scan
                                </button>
                                <button id="stopScan" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">
                                    Stop Scan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('custom-scripts')
        <script type="module">
            const video = document.getElementById('preview');
            const camQrResult = document.getElementById('hasil');
            import QrScanner from '{{asset("admin/vendors/scripts/qr-scanner.min.js")}}';
            let scanner = new QrScanner(video, result => setResult(camQrResult, result), {
                                onDecodeError: error => {
                                    camQrResult.textContent = error;
                                    camQrResult.style.color = 'inherit';
                                },
                                highlightScanRegion: true,
                                highlightCodeOutline: true,
                            });

            document.getElementById('startScan').addEventListener('click', () => {
                scanner = new QrScanner(document.getElementById('preview'), result => {
                    // document.getElementById('hasil').value = result;
                    let param = validateAndExtract(result);

                    if (param !== "kosong") {
                    let url = "{{route('recipients.scan', 'ssss')}}";
                    url = url.replace('ssss', param);
                    // console.log(result);
                    window.location.replace(url);
                    }
                    else{
                        alert("Kode QR tidak dikenali atau bukan Kode QR aplikasi SIPeRak");
                    }

                    scanner.stop();
                });
                scanner.start();
            });

            document.getElementById('stopScan').addEventListener('click', () => {
                if (scanner !== null) {
                    scanner.stop();
                }
            });

            function validateAndExtract(str) {
                 if (str.length === 61 && str.slice(0, 46) !== "https://siperak.bontangkota.go.id/penerima/qr/") {
                    return "kosong";
                }
                else if (str.length === 60 && str.slice(0, 45) !== "http://siperak.bontangkota.go.id/penerima/qr/") {
                    return "kosong";
                }
                else {
                    return "kosong";
                }

                // if all validations pass, extract the recipient's slug
                return str.slice(-15);
            }

        </script>
    @endpush

</x-app-layout>
