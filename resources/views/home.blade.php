@extends('layouts.template')

@section('myTitle', 'Home')

@section('content')

    <div class="container-fluid custom-container-color"> {{-- Este coge tanto el buscador como la cuadricula de instrumentos --}}
        <div class="row">
            <div class="col-2 rounded p-3 m-3 custom-filter-color">
                <form class="search_form" action="{{ route('filter') }}" method="post">
                    @csrf
                    <h2>Search</h2>
                    <input type="hidden" name="instruments" value="{{ json_encode($instruments) }}">
                    <div class="mb-3">
                        <label for="instrumentFamilies" class="form-label">Instrument Family:</label>
                        <select id="instrumentFamilies" name="instrumentFamilies" class="form-select">
                            <option value="" selected disabled>-Select-</option>
                            @foreach (['brass', 'woodwind', 'percussion', 'strings', 'electronic'] as $family)
                                <option value="{{ $family }}" @if (isset($old_family) && $old_family == $family) selected @endif>
                                    {{ ucfirst($family) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" name="type" id="type" class="form-control"
                            value="{{ isset($old_type) ? $old_type : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control"
                            value="{{ isset($old_brand) ? $old_brand : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" name="model" id="model" class="form-control"
                            value="{{ isset($old_model) ? $old_model : '' }}">
                    </div>
                    <div class="mb-3">
                        <label for="serial" class="form-label">Serial Number</label>
                        <input type="text" name="serial" id="serial" class="form-control"
                            value="{{ isset($old_serial) ? $old_serial : '' }}">
                    </div>
                    <button type="submit" name="filter" class="btn btn-secondary">FILTER</button>
                </form>
                <form class="clean_form" action="{{ route('home') }}" method="get">
                    @csrf
                    <button class="btn btn-danger" type="submit" name="del_filter">CLEAN</button>
                </form>

            </div>
            <div class="col-9 ms-3">
                <div class="row mt-4 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
                    @if (empty($instruments) || !isset($instruments))
                        <div class="col">
                            <p>There are no instruments. Add some or clean the filter.</p>
                        </div>
                    @else
                        @foreach ($instruments as $item)
                            <div class="col-2">
                                <div class="card m-1 {{ $item['state'] == 'available' ? 'border-success' : 'border-secondary' }}" style="height: 350px;">
                                    <img src="{{ asset($item['image']) }}" class="card-img-top" alt="..."
                                        style="height: 200px; object-fit: cover;">
                                    <div class="card-body {{ $item['state'] == 'available' ? 'text-success' : 'text-secondary' }}">
                                        <h5 class="card-title">{{ $item['type'] }}</h5>
                                        <p class="card-text">{{ $item['brand'] }} - {{ $item['model'] }}</p>
                                        <span style="color: {{ $item['state'] == 'available' ? 'green' : 'red' }};">
                                            {{ $item['state'] == 'available' ? 'Available' : 'Lent' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection
