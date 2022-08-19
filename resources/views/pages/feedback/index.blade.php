@extends('layouts.main')
@section('title', 'Feedback | Index')
@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Customer's name</th>
                <th scope="col">Feedback's content</th>
                <th scope="col">Created At</th>
                <!-- <th scope="col">Action</th> -->
            </tr>
        </thead>
        <tbody>
            @php
                // dd($feedback);
            @endphp
            @if ( count($feedbacks) == 0)
                <tr>
                    <td colspan="9" class="text-center">
                        No data has found!
                    </td>
                </tr>
            @else
                @foreach ($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback["id"]}}</td>
                        <td>{{ $feedback["customer"] }}</td>
                        <td>{{ $feedback["content"] }}</td>
                        <td>{{ date_create($feedback["createdAt"])->format("d-m-Y H:i:s") }}</td>
                        
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
