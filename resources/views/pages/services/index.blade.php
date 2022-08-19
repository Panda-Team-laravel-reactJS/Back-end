@extends('layouts.main')
@section('title', 'Service | Index')
@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Duration</th>
      <th scope="col">CategoryName</th>
      <th scope="col">Is_displayed</th>
      <th scope="col">Display_at_home</th>
    </tr>
  </thead>
  <tbody>
    @php
    // dd($service);
    @endphp
    @if (count($services) == 0)
    <tr>
      <td colspan="9" class="text-center">
        No data has found!
      </td>
    </tr>
    @else
    @foreach ($services as $service)
    <tr>
      <td>{{ $service["name"] }}</td>
      <td><img src="{{$service["image"]}}"></img></td>
      <td>{{ $service["description"]}}</td>
      <td>{{ $service["price"]}}</td>
      <td>{{ $service["duration"]}}</td>
      <td>{{ $service["categoryName"]}}</td>
      <td><input class="form-check-input" type="checkbox" {{$service["isDisplayed"] ? "checked" : ""}}></td>
      <!-- <form action="" method="POST">
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td> -->
      <td><input class="form-check-input" type="checkbox" {{$service["displayAtHome"] ? "checked" : ""}}></td>
    </tr>
    @endforeach
    @endif
  </tbody>
</table>
@endsection