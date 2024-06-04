@extends('layouts.crud')

@section('title', 'Appraisal Score')

@section('variable')
@php
$model = 'apraisalscore';
@endphp
@endsection

@section('main')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="success" class="mt-2"></div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 table-title"><b></b></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th>Ranking</th>
                                <th>Nilai</th>
                                <th>Apraisal Score</th>
                                <th>Alternatif</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    let id_edas = @json($edas->id);
    let alternatives = @json($alternatives);
    let apraisalscores = @json($apraisalscores);
    let ap = [...apraisalscores];
    // clone so that the memory address won't be the same
    // this will affect which array we're going to rank on the next line
    let ranked = ap.sort((x,y) => y.value - x.value); // sort desc

    document.addEventListener('DOMContentLoaded', function() {

    $('.table-title').html('<b>Apraisal Score for ' + "{{ $edas->name }}<b>");

    $('#href_criteria').attr('href', "/dashboard/criteria/"+id_edas+"");
    $('#href_alternative').attr('href' , "/dashboard/alternative/"+id_edas+ "");
    $('#href_matrix').attr('href' , "/dashboard/decisionmatrix/"+id_edas+ "");

    $('#href_average').attr('href' , "/dashboard/average/"+id_edas+ "");
    $('#href_pda').attr('href' , "/dashboard/pda/"+id_edas+ "");
    $('#href_nda').attr('href' , "/dashboard/nda/"+id_edas+ "");
    $('#href_sp').attr('href' , "/dashboard/sp/"+id_edas+ "");
    $('#href_sn').attr('href' , "/dashboard/sn/"+id_edas+ "");
    $('#href_nsp').attr('href' , "/dashboard/nsp/"+id_edas+ "");
    $('#href_nsn').attr('href' , "/dashboard/nsn/"+id_edas+ "");
    $('#href_apraisalscore').attr('href' , "/dashboard/apraisalscore/"+id_edas+ "");

        $('#id_edas').val(id_edas);

        if (apraisalscores.length==0) {
                    $('tbody').append(`
                    <tr>
                        <td colspan="2" class="text-center"> No Apraisal Score tracked. Complete Decision Matrix Table first.</td>
                    </tr>`);
        } else {
            $.each(ranked, function(foo, value) {
                $('tbody').append(`
                    <tr>
                        <td>` + (foo + 1) + `</td>
                        <td>` + value.value + `</td>
                        <td> AS` + getAS(value) + `</td>
                        <td>` + getAlternative(value) + `</td>
                    </tr>`);
            })
        }
    });

    function closeModal(idModal) {
        $("#" + idModal).modal('hide');
    }

    function getAS(as)
    {
        return apraisalscores.findIndex(x => x.id == as.id) +1;
    }

    function getAlternative(as) {
        let alternative = alternatives.find(alternative => alternative.id == as.id_alternative);
        return alternative.name;
    }
</script>
@endsection