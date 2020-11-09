@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="navbar navbar-toggleable-md navbar-light bg-faded">
                        <a class="btn btn-primary" href="{{ route('character.create') }}">New character</a>
                    </div>
                    <table class="table table hover" id="table">
                        <thead class="thead-light">
                        <tr>
                            <th>Name</th>
                            <th>Height </th>
                            <th>Gender</th>
                            <th>Homeworld</th>
                            <th>Film</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($characters as $character)
                            <tr>
                                <td>{{ $character->name }}</td>
                                <td>{{ $character->height }}</td>
                                <td>{{ $character->gender }}</td>
                                <td>{{ $character->homeworld->name }}</td>
                                <td>{{ $character->film->movieTitle}}</td>
                                <td>
                                    <a href="{{ route('character.edit', $character->id ) }} " id="edit"> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>


                </div>

            </div>
            @if($characters->total() > $characters->count())
                <div class="row justify-content-center">
                    {{ $characters->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection


