@extends('layouts.main')
@section('title', 'Staff | Index')
@section('content')
<button href="" class="btn btn-danger mb-2">
    <i class="bi bi-plus-circle"></i>
</button>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Gender</th>
                <th scope="col">Image</th>
                <th scope="col">Position</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                // dd($staff);
            @endphp
            @if ($staff->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">
                        No data has found!
                    </td>
                </tr>
            @else
                @foreach ($staff as $staff)
                    <tr>
                        <td>{{ $staff->name }}</td>
                        <td>{{ $staff->gender }}</td>
                        <td><img src="./public/assets/images/{{$staff->image}}"><img></td>
                        <td>{{ $staff->position }}</td>
                        <td>{{ $staff->created_at }}</td>
                        <td>
                        <button class="btn btn-danger mb-2">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form role="form" action="delete/{{$staff->id}}" method="POST">
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
