@extends('layouts.sepuh')

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
    var criterias = @json($criterias);
    var alternatives = @json($alternatives);
    var ndas = @json($ndas);

    document.addEventListener('DOMContentLoaded', function() {

    $('.table-title').html('<b>NDA for ' + "{{ $edas->name }}<b>");

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

        if (ndas.length==0) {
                    $('tbody').append(`
                    <tr>
                        <td colspan="2" class="text-center"> No NDA tracked. Complete Decision Matrix Table first.</td>
                    </tr>`);
        } else {
            let head = `<tr><th></th>`;
            
            criterias.forEach(criteria => {
                head += `<th>` +criteria.name+ `</th>`;
            });

            head += `</tr>`;

            $('thead').append(head);

            let row = ``;

            alternatives.forEach(alternative => {
                row += `<tr>
                    <th>`+alternative.name+`</th>`;
                criterias.forEach(criteria => {
                    let nda_value = ndas.find(nda => nda.id_criteria == criteria.id && nda.id_alternative == alternative.id).value || null;
                    row += `<td>` + nda_value + `</td>`;
                });
                row += `</tr>`;
            });

            $('tbody').append(row);
        }
    });

    function closeModal(idModal) {
            $("#" + idModal).modal('hide');
    }
</script>
@endsection