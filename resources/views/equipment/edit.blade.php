@extends('layouts.main')

@section('content')
    <div class="container mt-3">
        @if (session("success"))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                {{session('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2>Edit equipment</h2>
        <hr>

        <form action="/equipment/update/id={{ $equipment->id }}" method="post">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="equipment">ประเภทอุปกรณ์</label>
                        <select class="form-control" id="name" name="name">
                            <option value="" selected>--กรุณาเลือก--</option>
                            <option value="Mouse" {{ $equipment->name == 'Mouse' ? 'selected' : '' }}>Mouse</option>
                            <option value="Keyboard" {{ $equipment->name == 'Keyboard' ? 'selected' : '' }}>Keyboard</option>
                            <option value="Monitor" {{ $equipment->name == 'Monitor' ? 'selected' : '' }}>Monitor</option>
                        </select>
                    </div>
                </div>
                <div class="col-6"></div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <div class="form-group">
                        <label for="detail">รายละเอียด</label>
                        <textarea class="form-control" id="detail" name="detail" rows="3">{{ $equipment->detail }}</textarea>
                    </div>
                </div>
                <div class="col-6"></div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <div class="form-group">
                        <label for="amount">จำนวนอุปกรณ์</label>
                        <input type="amount" class="form-control" name="amount" id="amount" value="{{ $equipment->amount }}">
                    </div>
                </div>
                <div class="col-6"></div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <div class="form-group">
                        <label for="price">ราคาต่อชิ้น</label>
                        <input type="amount" class="form-control" name="price" id="price" value="{{ $equipment->price }}">
                    </div>
                </div>
                <div class="col-6"></div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <input class="btn btn-primary" type="submit" value="บันทึก">
                </div>
                <div class="col-6"></div>
            </div>

        </form>

    </div>
@endsection