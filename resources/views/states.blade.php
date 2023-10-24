<!-- resources/views/states.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <div class="mt-5">
                <select class="form-select unit-input" onchange="getLocalGovernments(this)" id="state">
                    <option selected disabled>Select State</option>
                    @foreach($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                    @endforeach
                </select>
            </div>
            <h1>States</h1>
            <select id="states-list"></select>
            <h1>Local Governments</h1>
            <select id="local-governments-list"></select>
            <h1>Parties</h1>
            <ul id="parties-list"></ul>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function getLocalGovernments(selectObject) {
        var stateId = selectObject.value;
        $.get('/local-governments/' + stateId, function(data) {
            var localGovernmentsList = $('#local-governments-list');
            localGovernmentsList.empty();
            $.each(data, function(index, localGovernment) {
                localGovernmentsList.append($('<option>', {
                    value: localGovernment.id,
                    text: localGovernment.name
                }));
            });
        });
    }

    $(document).ready(function() {
        $.get('/states', function(data) {
            var statesList = $('#states-list');
            $.each(data, function(index, state) {
                statesList.append($('<option>', {
                    value: state.id,
                    text: state.name
                }));
            });
        });

        $.get('/parties', function(data) {
            var partiesList = $('#parties-list');
            $.each(data, function(index, party) {
                partiesList.append('<li>' + party.name + '</li>');
            });
        });

        $('#states-list').change(function() {
            var stateId = $(this).val();
            $.get('/local-governments/' + stateId, function(data) {
                var localGovernmentsList = $('#local-governments-list');
                localGovernmentsList.empty();
                $.each(data, function(index, localGovernment) {
                    localGovernmentsList.append($('<option>', {
                        value: localGovernment.id,
                        text: localGovernment.name
                    }));
                });
            });
        });
    });
</script>

@endsection
