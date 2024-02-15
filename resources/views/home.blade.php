@extends('layouts.template')

@section('myTitle', 'Home')

@section('content')

    <div class="container"> {{-- Este coge tanto el buscador como la cuadricula de instrumentos --}}
        <div class="filter">
            <form class="search_form" action="{{ route('filter') }}" method="post">
                @csrf
                <h2>Search</h2>
                <input type="hidden" name="instruments" value="{{ json_encode($instruments) }}">
                <label for="instrumentFamilies">Instrument Family:</label>
                <select id="instrumentFamilies" name="instrumentFamilies">
                    <option value="" selected disabled>-Select-</option>
                    @foreach (['brass', 'woodwind', 'percussion', 'strings', 'electronic'] as $family)
                        <option value="{{ $family }}" @if (isset($old_family) && $old_family == $family) selected @endif>
                            {{ ucfirst($family) }}</option>
                    @endforeach
                </select>
                <label for="type">Type</label>
                <input type="text" name="type" id="type" value="{{ isset($old_type) ? $old_type : '' }}">
                <label for="brand">Brand</label>
                <input type="text" name="brand" id="brand" value="{{ isset($old_brand) ? $old_brand : '' }}">
                <label for="model">Model</label>
                <input type="text" name="model" id="model" value="{{ isset($old_model) ? $old_model : '' }}">
                <label for="serial">Serial Number</label>
                <input type="text" name="serial" id="serial" value="{{ isset($old_serial) ? $old_serial : '' }}">
                <input type="submit" name="filter" value="FILTER">
            </form>
            <form class="clean_form" action="{{ route('home') }}" method="get">
                @csrf
                <input class="clean" type="submit" name="del_filter" value="CLEAN">
            </form>
        </div>

        <div class="instrument_grid">
            @if (empty($instruments) || !isset($instruments))
                <p>There are no instruments. Add some or clean the filter.</p>
            @else
                @foreach ($instruments as $item)
                    <div class="instrument_box">
                        <article>
                            {{ $item['type'] }}
                            {{ $item['brand'] }}
                            {{ $item['model'] }}
                            <span style="color: {{ $item['state'] == 'available' ? 'green' : 'red' }}; float: right;">
                                {{ $item['state'] == 'available' ? 'Available' : 'Lent' }}
                            </span>
                            <img src="{{ asset($item['image']) }}" />
                        </article>
                    </div>
                @endforeach
            @endif

        </div>
    </div>

@endsection
