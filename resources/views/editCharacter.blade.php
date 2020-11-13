@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">

                    <h5><b>{{ isset($editCharacter) ? 'Edit' : 'New' }}</b></h5>
                    <hr>

                    @if(isset($editCharacter))
                        <form method="POST" action="{{ route('character.update', $editCharacter->id) }}">
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
                                               value="{{ (isset($editCharacter)) ? $editCharacter->name : ''}}" required>

                                        <label for="gender">Select gender:</label>
                                        <select name="gender" required>
                                            <option></option>
                                            <option value="male">male</option>
                                            <option value="female">female</option>
                                            <option value="n/a">n/a</option>
                                            @if(isset($editCharacter))
                                                <option value="{{ $editCharacter->gender }}" selected="selected"
                                                >{{ $editCharacter->gender  }}</option>
                                            @endif
                                        </select>

                                        <label for="height">Height</label>
                                        <input type="number"
                                               name="height"
                                               id="height"
                                               value="{{ (isset($editCharacter)) ? $editCharacter->height : ''}}" required>
                                    </div>
                                    <div>
                                        <label for="homeworld_id">Select homeworld:</label>
                                        <select name="homeworld_id" required>
                                            <option></option>
                                            @foreach ($homeworlds as $homeworld)
                                                <option value="{{ $homeworld['id']}}"
                                                @if(isset($editCharacter))
                                                    {{ ($homeworld->id == $editCharacter->homeworld->id) ?
                                                     'selected="selected"' : ''}}
                                                @endif> {{ $homeworld['name'] }}</option>
                                            @endforeach
                                        </select>

                                        <label for="film_id">Select films:</label>
                                        <select multiple name="film_id[]" required>
                                            @foreach ($films as $film)
                                                <option value="{{ $film['id']}}"
                                                @if(isset($editCharacter))
                                                    @foreach($editCharacter->films as $editFilm)
                                                    {{ ($film->id == $editFilm->id) ?
                                                     'selected="selected"' : ''}}
                                                    @endforeach
                                                    @endif> {{ $film['movieTitle'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="submit">
                                        <input class="btn btn-secondary"
                                               type="submit"
                                               value="{{ isset($editCharacter) ? 'Update' : 'Save' }}">
                                    </div>

                                    @if(isset($editCharacter))
                                        <input type="hidden" name="id" value="{{ $editCharacter->id }}">

                                </form>

                                <form method="POST" action="{{ route('character.destroy',  $editCharacter->id ) }}">
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
