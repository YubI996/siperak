    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script>


            /*------------------------------------------
            --------------------------------------------
            Country Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            function popKel(idKec, selected = null) {
            // $('#kec').on('change', function () {
                // var idKec = this.value;
                $("#kel").html('');
                $.ajax({
                    url: "{{url('api/fetch-kelurahan')}}",
                    type: "POST",
                    data: {
                        kec_id: idKec,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#kel').html('<option value="">-- Pilih Kelurahan --</option>');
                        $.each(result.kels, function (key, value) {
                            if(selected !== null){
                                if (value.id === selected) {
                                    $("#kel").append('<option value="' + value
                                    .id + '" Selected>' +'Kelurahan '+ value.nama_kel + '</option>');
                                }
                                $("#kel").append('<option value="' + value
                                .id + '">' +'Kelurahan '+ value.nama_kel + '</option>');
                            }
                            else{
                                $("#kel").append('<option value="' + value
                                .id + '">' +'Kelurahan '+ value.nama_kel + '</option>');
                            }
                        });
                        $('#rt').html('<option value="">-- Pilih Rukun Tetangga --</option>');
                    }
                });
            }

            /*------------------------------------------
            --------------------------------------------
            State Dropdown Change Event
            --------------------------------------------
            --------------------------------------------*/
            function popRt(idKel, selected = null) {

            // }
            // $('#kel').on('change', function () {
                // var idKel = this.value;
                $("#rt").html('');

                $.ajax({
                    url: "{{url('api/fetch-rt')}}",
                    type: "POST",
                    data: {
                        kel_id: idKel,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#rt').html('<option value="">-- Pilih Rukun Tetangga --</option>');
                        $.each(res.rts, function (key, value) {
                            if (selected !== null) {
                            if (value.id === selected){
                                $("#rt").append('<option value="' + value
                                .id + '" Selected>'  +'RT '+ value.nama_rt + '</option>');
                            }
                                $("#rt").append('<option value="' + value
                                .id + '">'  +'RT '+ value.nama_rt + '</option>');
                            }
                            else{
                                $("#rt").append('<option value="' + value
                                .id + '">'  +'RT '+ value.nama_rt + '</option>');
                            }
                        });
                    }
                });
            }


    </script>
