@extends('layouts.main')

@section('content')
    <div class="container mt-3">
        <h2>Request list</h2>
        <hr>
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ชื่อผู้ขออุปกรณ์</th>
                    <th scope="col">อีเมล</th>
                    <th scope="col">Permision</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userRequests as $request)
                    <tr>
                        <th scope="row">{{ $userRequests->firstItem()+$loop->index }}</th>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->user->email }}</td>
                        <td>{{ $request->user->permision }}</td>
                        <td>
                            <a href="all_request/detail/id={{ $request->user_id }}" class="btn btn-sm btn-warning">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $userRequests->links() }}
    </div>
@endsection
