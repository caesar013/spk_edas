@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
    </ol>
    <div class="row justify-content-center">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="row align-items-center p-3">
                    <div class="col-md-6">EDAS</div>
                    <div class="col-md-6 d-flex justify-content-end" id="edas_count">Ajax Error</div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('dashboard.edas.index') }}">
                        Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="row align-items-center p-3">
                    <div class="col-md-6">Kriteria</div>
                    <div class="col-md-6 d-flex justify-content-end" id="criteria_count">Ajax Error</div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('dashboard.edas.index') }}">View
                        Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="row align-items-center p-3">
                    <div class="col-md-6">Alternatif</div>
                    <div class="col-md-6 d-flex justify-content-end" id="alternative_count">Ajax Error</div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('dashboard.edas.index') }}">View
                        Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function fetch() {
    $.ajax({
        type: "GET",
        url: "{{ route('dashboard.fetchDataIndex') }}",
        dataType: "json",
        success: function(data) {
            if (data.edas_count == 0) {
                $('#edas_count').text('-');
            } else {
                $('#edas_count').text(data.edas_count);
            }
            if (data.criterias_count == 0) {
                $('#criteria_count').text('-');
            } else {
                $('#criteria_count').text(data.criterias_count);
            }
            if (data.alternatives_count == 0) {
                $('#alternative_count').text('-');
            } else {
                $('#alternative_count').text(data.alternatives_count);
            }
        }
    });
}
    $(document).ready(function () {

    fetch();


});
</script>
@endsection