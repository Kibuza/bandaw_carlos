@extends('layouts.template')

@section('myTitle', 'Add')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-5 offset-3 rounded px-3 mt-2 custom-filter-color">
                <form action="{{ route('add') }}" method="post" enctype="multipart/form-data" class="mt-5">
                    @csrf
                    <div class="mb-3">
                        <label for="instrumentFamilies" class="form-label">Instrument Family:</label>
                        <select id="instrumentFamilies" name="instrumentFamilies" class="form-select">
                            <option value="" selected disabled>-Select-</option>
                            <option value="Brass" @if (old('instrumentFamilies') == 'Brass') selected @endif>Brass</option>
                            <option value="Woodwind" @if (old('instrumentFamilies') == 'Woodwind') selected @endif>Woodwind</option>
                            <option value="Percussion" @if (old('instrumentFamilies') == 'Percussion') selected @endif>Percussion</option>
                            <option value="Strings" @if (old('instrumentFamilies') == 'Strings') selected @endif>String</option>
                            <option value="Electronic" @if (old('instrumentFamilies') == 'Electronic') selected @endif>Electronic</option>
                        </select>
                        @error('instrumentFamilies')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type:</label>
                        <input type="text" name="type" id="type" class="form-control"
                            value="{{ old('type') }}">
                            @error('type')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand:</label>
                        <input type="text" name="brand" id="brand" class="form-control"
                            value="{{ old('brand') }}">
                            @error('brand')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model:</label>
                        <input type="text" name="model" id="model" class="form-control"
                            value="{{ old('model') }}">
                            @error('model')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="serial_number" class="form-label">Serial Number:</label>
                        <input type="text" name="serial_number" id="serial_number" class="form-control"
                            value="{{ old('serial_number') }}">
                            @error('serial_number')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label for="acquisition_date" class="form-label">Acquisition Date:</label>
                        <input type="date" name="acquisition_date" id="acquisition_date" class="form-control"
                            value="{{ old('acquisition_date') }}">
                            @error('acquisition_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">State:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="state" id="state_lent" value="lent"
                                @if (old('state') == 'lent') checked @endif>
                            <label class="form-check-label" for="state_lent">Lent</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="state" id="state_available"
                                value="available" @if (old('state') == 'available') checked @endif>
                            <label class="form-check-label" for="state_available">Available</label>
                        </div>
                        @error('state')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment:</label>
                        <textarea name="comment" id="comment" rows="4" class="form-control">{{ old('comment') }}</textarea>
                        @error('comment')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-secondary" name="update">UPDATE INSTRUMENT</button>
                </form>
            </div>
        </div>
    </div>



@endsection
