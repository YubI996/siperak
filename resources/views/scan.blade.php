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
                    <input type="text" id="hasil">
                    <div id="reader" width="75%"></div>
                </div>
            </div>
        </div>
    </div>
    @push('custom-scripts')
        {{-- <script src="https://cdn.jsdelivr.net/npm/html5-qrcode@2.0.4/build/html5-qrcode.min.js" type="text/javascript"></script> --}}
        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
        <script>
            // import Html5Qrcode from 'html5-qrcode';
            const html5QrCode = new Html5Qrcode(/* element id */ "reader");

            function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            // console.log(`Code matched = ${decodedText}`, decodedResult);
            $('#hasil').val(decodedText);
            html5QrCode.stop();
            }

            function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
            }

            let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader",
            { fps: 10, qrbox: {width: 250, height: 250} },
            /* verbose= */ false);
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);



        </script>
    @endpush
</x-app-layout>
