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

        <h2>Items equipment</h2>
        <hr>

        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ชื่ออุปกรณ์</th>
                    <th scope="col">รายละเอียด</th>
                    <th scope="col">จำนวนอุปกรณ์</th>
                    <th scope="col">ราคาต่อชิ้น</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($e_items as $item)
                    <tr>
                        <th scope="row">{{ $e_items->firstItem()+$loop->index }}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->detail}}</td>
                        <td>{{$item->amount}}</td>
                        <td>{{$item->price}}</td>
                        <td>
                            <a href="/equipment/edit/id={{ $item->id }}" class="btn btn-sm btn-warning">Edit</a>
                            <a onclick="delete_item({{ $item->id }})" class="btn btn-sm btn-danger del_btn">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$e_items->links()}}

    </div>

    <script>
        function delete_item(id) {
            // if(confirm('Are you delete this item ?')) {
            //     window.location.href = "{{ URL('admin/management/news/delete') }}/"+id;
            // }
            $.confirm({
                title: 'ลบอุปกรณ์!',
                content: 'คุณต้องการลบอุปกรณ์นี้หรือไม่?',
                type: 'red',
                buttons: {
                    confirm: {
                        text: 'ลบ', // Set custom text for the confirm button
                        btnClass: 'btn-red', // Optional custom CSS class for the confirm button
                        action: function () {
                            // $.alert("Confirmed!" + id);
                            window.location.href = "{{ URL('/equipment/delete/id=') }}" + id;
                        }
                    },
                    cancel: {
                        text: 'ยกเลิก', // Set custom text for the cancel button
                        btnClass: 'btn-default', 
                    }
                }
            });

        }
    </script>

@endsection