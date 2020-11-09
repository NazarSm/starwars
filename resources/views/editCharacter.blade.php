@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">

                    <h5><b>{{ isset($character) ? 'Edit' : 'New' }}</b></h5>
                    <hr>

                    @if(isset($character))
                        <form method="POST" action="{{ route('character.update', $character->id) }}">
                            @method('PATCH')
                            @else
                                <form method="POST" action="{{ route('character.store') }}">
                                    @endif
                                    @csrf

                                    <div>
                                        <label for="name">Name</label>
                                        <input type="text"
                                               name="name"
                                               id="name"
                                               value="{{ (isset($character)) ? $character->name : ''}}">
                                    </div>

                                    <div>
                                        <label for="gender">Select gender:</label>
                                        <select name="gender">
                                            <option value="male">male</option>
                                            <option value="female">female</option>
                                            <option value="n/a">n/a</option>
                                            @if(isset($character))
                                                <option value="{{ $character->gender }}" selected="selected"
                                                >{{ $character->gender  }}</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div>
                                        <label for="height">Height</label>
                                        <input type="number"
                                               name="height"
                                               id="height"
                                               value="{{ (isset($character)) ? $character->height : ''}}">
                                    </div>

                                    <div>
                                        <label for="homeworld_id">Select homeworld:</label>
                                        <select name="homeworld_id">
                                            <option>Select homeworld...</option>
                                            @foreach ($homeworlds as $homeworld)
                                                <option value="{{ $homeworld->id}}"
                                                        @if(isset($character))
                                                        {{'selected="selected"'}}
                                                    @endif
                                                >{{ $homeworld->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <label for="film_id">Select films:</label>
                                        <select name="film_id">
                                            @foreach ($films as $film)
                                                <option value="{{ $film->id}}"
                                                        @if(isset($character))
                                                        selected="selected"
                                                    @endif> {{ $film->movieTitle}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="submit">
                                        <input class="btn btn-secondary"
                                               type="submit"
                                               value="{{ isset($character) ? 'Update' : 'Save' }}">
                                    </div>

                                    @if(isset($character))
                                        <input type="hidden" name="id" value="{{ $character->id }}">

                                </form>

                                <form method="POST" action="{{ route('character.destroy',  $character->id ) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-link">Delete</button>
                                </form>
                                @else
                        </form>
                    @endif

                </div>
            </div>
            <a href="{{ route('character.index') }}">←back</a>
        </div>

    </div>


@endsection
