@extends('layouts.main')

@section('content')
    <div class="container mt-3">

        <h2>Request equipment detail</h2>
        <hr>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">รายการ</th>
                    <th scope="col">รายละเอียด</th>
                    <th scope="col">จำนวน</th>
                    <th scope="col">หมายเหตุ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requestDetails as $index => $requestDetail)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $requestDetail->equipment_name  }}</td>
                        <td>{{ $requestDetail->detail  }}</td>
                        <td>{{ $requestDetail->amount }}</td>
                        <td>{{ $requestDetail->note }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
