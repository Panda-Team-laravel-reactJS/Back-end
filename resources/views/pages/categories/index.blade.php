@extends('layouts.main')
@section('title', 'Customer | Index')
@section('content')

<button href="" class="btn btn-danger mb-2">
    <i class="bi bi-plus-circle"></i>
</button>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                
            </tr>
        </thead>
        <tbody>
            @php
                // dd($categories);
            @endphp
            @if ($categories->isEmpty())
                <tr>
                    <td colspan="2" class="text-center">
                        No data has found!
                    </td>
                </tr>
            @else
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->image }}</td>
                       
                        <td>
                        <button class="btn btn-danger mb-2">
                                <i class="bi bi-pencil-square"></i>
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
