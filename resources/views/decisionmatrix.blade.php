@extends('layouts.sepuh')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="success" class="mt-2"></div>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6 table-title"><b>Decision Matrix</b></div>
                        <div class="col-md-6 d-flex justify-content-end" id="portal"><button type="button" href=""
                                class="edit_decisionmatrix btn btn-primary">
                                Edit Decision Matrix
                            </button> </div>
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
    let id_edas = @json($edas->id);
    let criterias = @json($criterias);
    let alternatives = @json($alternatives);
    let subcriterias = @json($subcriterias);
    let decisionmatrix = @json($decisionmatrix);
    let status_criteria = @json($status_criteria);
    let status_subcriteria = @json($status_subcriteria);
    let status_alternative = @json($status_alternative);

    document.addEventListener('DOMContentLoaded', function() {

    $('.table-title').html('<b>Matriks Keputusan for ' + "{{ $edas->name }}<b>");

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

    if (status_criteria == false) {
            $('#portal').html("");
            $('#portal').append(`<button type="button" class="btn btn-primary portal_button_criteria" value="`+id_edas+`">+ Tambah Kriteria</button>`);
            $('thead').append(`
                <th>
                    <td colspan="3" class="text-center"> No Criteria tracked. Try creating one from Criteria page.</td>
                </th>`);
        } else if (status_subcriteria == false) {
            $('#portal').html("");
            $('#portal').append(`<button type="button" class="btn btn-primary portal_button_criteria" value="`+id_edas+`">+ Tambah Kriteria</button>`);
            $('thead').append(`
                <th>
                    <td colspan="3" class="text-center"> Insufficient Sub-Criteria tracked. Fill up sub-criteria for each Criteria from Criteria page    .</td>
                </th>`);
        } else if (status_alternative == false) {
            $('#portal').html("");
            $('#portal').append(`<button type="button" class="btn btn-primary portal_button_alternative" value="`+id_edas+`">+ Tambah Alternatif</button>`);
                $('thead').append(`
                <th>
                    <td colspan="3" class="text-center"> No Alternative tracked. Try creating one from Alternative page.</td>
                </th>`);
        } else {
            let head = '<tr><th>Alternatif</td>';

                
            criterias.forEach(criteria => {
                head += '<th>' + criteria.name + '</th>';
            });
                
            head += '</tr>';
                
            $('thead').append(head);

            let body = ``;

            alternatives.forEach(alternative => {
                body += `<tr>
                            <th>` + alternative.name + `</th>`;
                criterias.forEach(criteria => {
                    let value = getValue(decisionmatrix, subcriterias, alternative.id, criteria.id);
                    body += `<td>` + value + `</td>` ;
                });
                body += `</tr>`;
            });

            $('tbody').append(body);
        }
    });

    function fetch() {
        $.ajax({
            type: "GET",
            url: "/dashboard/decisionmatrix/data/"+ id_edas,
            dataType: "json",
            success: function(data) {
                let criterias = data.criterias;
                let alternatives = data.alternatives;
                let subcriterias = data.subcriterias;
                let decisionmatrix = data.decisionmatrix;

                $('#portal').html("");
                $('#portal').append(`<button type="button" class="btn btn-primary edit_decisionmatrix" value="`+id_edas+`">Edit Decision Matrix</button>`);

                $('thead').html("");
                $('tbody').html("");

                let head = '<tr><th>Alternatif</td>';
                
                data.criterias.forEach(criteria => {
                    head += '<th>' + criteria.name + '</th>';
                });
                    
                head += '</tr>';
                    
                $('thead').append(head);

                let body = ``;

                data.alternatives.forEach(alternative => {
                    body += `<tr>
                                <th>` + alternative.name + `</th>`;
                    criterias.forEach(criteria => {
                        let value = getValue(data.decisionmatrix, data.subcriterias, alternative.id, criteria.id);
                        body += `<td>` + value + `</td>` ;
                    });
                    body += `</tr>`;
                });

                $('tbody').append(body);
            }
        });
    }

    function closeModal(idModal) {
            $("#" + idModal).modal('hide');
    }

    function getValue(matrix, sub_criterias, id_alternative, id_criteria)
    {
        let dm = matrix.find(x => x.id_alternative == id_alternative && x.id_criteria == id_criteria) || null;

        if (dm == null) {
            return '';
        } else {
            let id_subcriteria = dm.id_subcriteria != null ? dm.id_subcriteria : null;
            if (id_subcriteria == null) {
                return ``;
            } else {
                let value = sub_criterias.find(x => x.id == id_subcriteria).value;
                return value;
            }
        }
    }

    function getIdSubcriteria(matrix, id_alternative, id_criteria) {
        let dm = matrix.find(x => x.id_alternative == id_alternative && x.id_criteria == id_criteria) || null;

        if (dm == null) {
            return null;    
        } else {
            return dm.id_subcriteria != null ? dm.id_subcriteria : null;
        }
    }

    $(document).ready(function() {
            
        $(document).on('click', '.edit_decisionmatrix', function(e) {
            e.preventDefault();
            $('tbody').html("");
            $.ajax({
                type: "GET",
                url: "/dashboard/decisionmatrix/data/"+ id_edas,
                dataType: "json",
                success: function(data) {
                    $('thead').html("");
                    $('tbody').html("");
                    $('#portal').html("");
                    $('#portal').append(`<button type="button" class="btn btn-primary update_decisionmatrix" value="`+id_edas+`">Update Decision Matrix</button>`);

                    let head = '<tr><th>Alternatif</th>';
                    
                    data.criterias.forEach(criteria => {
                        head += '<th>' + criteria.name + '</th>';
                    });
                        
                    head += '</tr>';
                        
                    $('thead').append(head);

                    let body = ``;

                    data.alternatives.forEach(alternative => {
                        body += `<tr>
                                    <th>` + alternative.name + `</th>`;
                        data.criterias.forEach(criteria => {
                            let id_subcriteria = getIdSubcriteria(data.decisionmatrix, alternative.id, criteria.id);
                            body += `<td><select class="form-control" id="` + alternative.id + `-` + criteria.id + `">`;
                            let sub_criterias = data.subcriterias.filter(x => x.id_criteria == criteria.id);
                            if (id_subcriteria == null) {
                                body += `<option value="" selected disabled hidden>Choose here</option>`;
                            }
                            sub_criterias.forEach(subcriteria => {
                                if (id_subcriteria === subcriteria.id) {
                                    body += `<option value="` + subcriteria.id + `" selected>` + subcriteria.information + `</option>`;
                                } else {
                                    body += `<option value="` + subcriteria.id + `">` + subcriteria.information + `</option>`;
                                    
                                }
                            });
                            body += `</select></td>` ;
                        });
                        body += `</tr>`;
                    });

                    $('tbody').append(body);
                }
            });
        });

            $(document).on('click', '.update_decisionmatrix', function(e) {
                e.preventDefault(); 

                let input = [];

                alternatives.forEach(alternative => {
                    criterias.forEach(criteria => {
                        let value = parseInt($('#' + alternative.id + '-' + criteria.id).val()) || 0;
                        input.push([alternative.id, criteria.id, value]);
                    });
                });

                let data = [];

                input.forEach(value => {
                    data = [...data, {
                        'id_alternative' : value[0],
                        'id_criteria' : value[1],
                        'id_subcriteria' : value[2]
                    }];
                });

                $.ajax({
                    type: "put",
                    url: "/dashboard/decisionmatrix/"+ id_edas,
                    //  the data property in the $.ajax method should be a query string or an object
                    //  since you are sending a JSON string, you should use JSON.stringify to serialize the data
                    data: JSON.stringify(data) , // or JSON.stringify ({name: 'jonas'}),
                    contentType: "application/json", // this is to specify that you are sending a JSON string
                    dataType: "json",
                    success: function(response) {
                        if (response.status == true) {
                            $('#success').html("");
                            $('#success').append(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success!</strong> Decision Matrix updated successfully.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>`);
                            fetch();
                            closeModal('modal');
                        } else {
                            
                            $('#success').html("");
                            $('#success').addClass('alert alert-danger');
                            for (const [key, value] of Object.entries(response.error)) {
                                $('#success').append(`<li>` + value + `</li>`);
                            }
                            fetch();
                            closeModal('modal');
                        }
                    }
                });
                
            });

            $(document).on('click', '.portal_button_criteria', function(e) {
                e.preventDefault();
                let id_criteria = $(this).val();
                window.location.href = "/dashboard/criteria/" + id_criteria + "";
            });

            $(document).on('click', '.portal_button_alternative', function(e) {
                e.preventDefault();
                let id_criteria = $(this).val();
                window.location.href = "/dashboard/alternative/" + id_criteria + "";
            });
        });
</script>
@endsection