@extends('layouts.main')
@section('title', 'Customer | Index')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Address</th>
                <th scope="col">Gender</th>
                <th scope="col">DoB</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                // dd($customers);
            @endphp
            @if ($customers->isEmpty())
                <tr>
                    <td colspan="9" class="text-center">
                        No data has found!
                    </td>
                </tr>
            @else
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->username }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->gender }}</td>
                        <td>{{ $customer->dob }}</td>
                        <td>{{ $customer->created_at }}</td>
                        <td>
                            <button class="btn btn-danger mb-2">
                                <i class="bi bi-x-octagon-fill"></i>
                            </button>
                            <form action="" method="POST">
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
