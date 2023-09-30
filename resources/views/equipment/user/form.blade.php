@extends('layouts.main')

@section('content')
    <div class="container mt-3">
        @if (session("success"))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session("error"))
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                {{session('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2>Form request equipment</h2>
        <hr>

        <form action="/from_request/store" method="post">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="equipment">ประเภทอุปกรณ์</label>
                        <select class="form-control" id="name" name="equipment_name">
                            <option value="" selected>--กรุณาเลือก--</option>
                            <option value="Mouse">Mouse</option>
                            <option value="Keyboard">Keyboard</option>
                            <option value="Monitor">Monitor</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="col-6"></div>
            </div>

            <div class="row" id="model_text">
                <div class="col-6 mt-4">
                    <div class="form-group">
                        <label for="equipment">รุ่นอุปกรณ์</label>
                        <select class="form-control" id="model" name="equipment_id">
                            <option value="" selected>--กรุณาเลือก--</option>
                        </select>
                    </div>
                </div>
                <div class="col-6"></div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <div class="form-group">
                        <label for="amount">หมายเหตุ</label>
                        <input type="text" class="form-control" name="note" id="note">
                    </div>
                </div>
                <div class="col-6"></div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <div class="form-group">
                        <label for="amount">จำนวน</label>
                        <input type="text" class="form-control" name="amount" id="amount">
                    </div>
                </div>
                <div class="col-6"></div>
            </div>

            <input type="hidden" name="user_id" value="{{ session('user_id') }}">

            <div class="row mt-4">
                <div class="col-6">
                    <input class="btn btn-primary" type="submit" value="บันทึก">
                </div>
                <div class="col-6"></div>
            </div>

        </form>

    </div>

    <script>
        $(document).ready(function() {

            $('#model').hide();
            $('#model_text').hide();

            $('#name').change(function() {
                let selectedName = $(this).val();
                let maxAmount = 1;
                if (selectedName === 'Mouse' || selectedName === 'Keyboard') {
                    $('#amount').val(1); // Set the amount value to 1
                    $('#amount').prop('readonly', true); // Make the amount field read-only
                } else {
                    // Reset the amount value and remove read-only attribute
                    $('#amount').val(''); // Clear the input value
                    $('#amount').prop('readonly', false); // Allow user input
                }

                if (selectedName === 'Other') {
                    $('#model').fadeOut();
                    $('#model_text').fadeOut();
                } else {

                // Make an AJAX request to fetch models based on the selected name
                $.ajax({
                    type: 'GET',
                    url: '/getModels', // Define your Laravel route to fetch models here
                    data: {
                        name: selectedName
                    },
                    success: function(res) {
                        // Clear previous options and populate with new options
                        $('#model_text').fadeIn();
                        $('#model').fadeIn();
                        $('#model').empty();
                        $('#model').append('<option value="" selected>--กรุณาเลือก--</option>');
                        $.each(res.models, function(index, model) {
                            $('#model').append('<option value="' + model.id + '">' + model.detail + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
            });
        });

    </script>


@endsection