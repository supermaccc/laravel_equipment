@extends('layouts.main')

@section('content')
    <div class="container mt-3">

        <div class="row">
            <div class="col-6"><h2>Request equipment detail</h2></div>
            <div class="col-6 text-end">{{ $user->name }}</div>
        </div>
        <hr>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">รายการ</th>
                    <th scope="col">รายละเอียด</th>
                    <th scope="col">ราคา</th>
                    <th scope="col">จำนวน</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAmount = 0;
                @endphp

                @foreach ($requestDetails as $index => $requestDetail)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $requestDetail->equipment_name  }}</td>
                        <td>{{ $requestDetail->detail  }}</td>
                        <td>{{ number_format($requestDetail->price, 2) }}</td>
                        <td>{{ $requestDetail->amount }}</td>
                    </tr>
                    @php
                        $totalAmount += $requestDetail->amount * $requestDetail->price;
                    @endphp
                @endforeach

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>Total</strong></td>
                    <td><strong>{{ number_format($totalAmount, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
