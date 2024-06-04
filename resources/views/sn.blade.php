@extends('layouts.crud')

@section('title', 'SN')

@section('content')
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
                                <th>No</th>
                                <th>Nilai</th>
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
    var id_edas = @json($edas->id);
    var sns = @json($sns);

    document.addEventListener('DOMContentLoaded', function() {

    $('.table-title').html('<b>SN for ' + "{{ $edas->name }}<b>");

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

        if (sns.length==0) {
                    $('tbody').append(`
                    <tr>
                        <td colspan="2" class="text-center"> No SN tracked. Complete Decision Matrix Table first.</td>
                    </tr>`);
        } else {
            $.each(sns, function(foo, bar) {
                $('tbody').append(`
                    <tr>
                        <td><b> SN` + (foo+1) + `</b></td>
                        <td>` + bar.value + `</td>
                    </tr>`);
            })
        }
    });

    function closeModal(idModal) {
            $("#" + idModal).modal('hide');
    }
</script>
@endsection