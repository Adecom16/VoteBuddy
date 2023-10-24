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
                    <select class="form-select unit-input" onchange="lgaReq(this)" id="state">
                        <option selected>Select State</option>
                        @foreach ($state as $state)
                            <option value="{{ $state->state_id }}">{{ $state->state_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="lga"></div>
                <div id="party"></div>
            </div>
        </div>
    </div>
    <script>
        $("#result-heading").hide();

        function lgaReq(e) {
            $.ajax({
                type: 'POST',
                url: '/lga',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                data: 'id=' + e.value,
                success: function(local) {
                    lgaArray = local.lga;
                    let Opt = '';
                    let lga = `<select class="form-select" onchange="resultReq(this)" id="lga">
                        <option selected id="lga-default">Select LGA</option>
                    </select>`;
                    $("#lga").replaceWith(lga);
                    for (var i = 0; i < lgaArray.length; i++) {
                        Opt += `<option value="${lgaArray[i].lga_id}">${lgaArray[i].lga_name}</option>`;
                    }
                    $("#lga-default").after(Opt);
                    $('#state-text').text(`State: ${e.options[e.selectedIndex].text}`);
                }
            });
        }

        function partyReq(e) {
            $.ajax({
                type: 'POST',
                url: '/party',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                data: 'id=' + e.value,
                success: function(part) {
                    partyArray = part.party;
                    let Opt = '';
                    let party = `<select class="form-select" onchange="resultReq(this)" id="party">
                <option selected id="party-default">Select PARTY</option>
            </select>`;
                    $("#party").replaceWith(party);
                    for (var i = 0; i < partyArray.length; i++) {
                        Opt += `<option value="${partyArray[i].party_id}">${partyArray[i].party_name}</option>`;
                    }
                    $("#party-default").after(Opt);
                    $('#state-text').text(`State: ${e.options[e.selectedIndex].text}`);
                }
            });
        }
    </script>
@endsection
