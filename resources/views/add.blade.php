@extends('layouts.template')

@section('myTitle', 'Add')

@section('content')

    <div class="Formulary">
        <form action="{{ route('add') }}" method="post" enctype="multipart/form-data">
            @csrf

            @foreach (['instrumentFamilies', 'type', 'brand', 'model', 'serial_number', 'acquisition_date', 'state', 'comment', 'image'] as $field)
                <label for="{{ $field }}">{{ ucfirst(str_replace('_', ' ', $field)) }}:</label> {{-- Crea la label basada en el name del campo --}}

                @if ($field == 'instrumentFamilies')
                    <select id="{{ $field }}" name="{{ $field }}">
                        <option value="" selected disabled>-Select-</option>
                        <option value="Brass" @if (old($field) == 'Brass') selected @endif>Brass</option>
                        <option value="Woodwind" @if (old($field) == 'Woodwind') selected @endif>Woodwind</option>
                        <option value="Percussion" @if (old($field) == 'Percussion') selected @endif>Percussion</option>
                        <option value="Strings" @if (old($field) == 'Strings') selected @endif>String</option>
                        <option value="Electronic" @if (old($field) == 'Electronic') selected @endif>Electronic</option>
                    </select>
                @elseif ($field == 'state')
                    <div class="radio-group">
                        <input type="radio" name="{{ $field }}" id="{{ $field }}_lent" value="lent"
                            @if (old($field) == 'lent') checked @endif>Available
                        <input type="radio" name="{{ $field }}" id="{{ $field }}_available"
                            value="available" @if (old($field) == 'available') checked @endif>Lent
                    </div>
                @elseif($field == 'acquisition_date')
                    <input type="date" name="{{ $field }}" id="{{ $field }}" value="{{ old($field) }}">
                @elseif ($field == 'comment')
                    <textarea name="{{ $field }}" id="{{ $field }}" rows="4">{{ old($field) }}</textarea>
                @elseif ($field == 'image')
                    <input type="file" name="{{ $field }}" id="{{ $field }}" accept="image/*"
                        value="{{ old($field) }}">
                @else
                    <input type="text" name="{{ $field }}" id="{{ $field }}"
                        value="{{ old($field) }}">
                @endif

                {{-- Como estoy en un bucle, el mensaje de error se genera para todos los campos y se coloca debajo de cada uno --}}
                @error($field)
                    <p class="error-message"> {{ $message }}</p>
                @enderror
            @endforeach

            <input type="submit" value="UPDATE INSTRUMENT" name="update">
        </form>
    </div>



@endsection
