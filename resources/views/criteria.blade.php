@extends('layouts.crud')

@section('title', 'Criteria')

@section('variable')
@php
$model = 'criteria';
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
                        <div class="col-md-6 table-title"><b>Kriteria</b></div>
                        <div class="col-md-6 d-flex justify-content-end"><button type="button" href=""
                                class=" btn btn-primary" data-toggle="modal" data-target="#add_criteria_modal">
                                + Tambah Kriteria
                            </button> </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th>Kode Kriteria</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th>Tipe</th>
                                <th>Sub-Kriteria</th>
                                <th>Aksi</th>
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

@section('add_modal')
<input type="hidden" id="id_edas" value="">
<label for="name">Nama Kriteria</label>
<input type="text" class="name form-control" id="name" value="{{ old('name') }}" required>
<label for="weight">Bobot</label>
<input type="number" class="weight form-control" id="weight" value="{{ old('weight') }}" required>
<label for="type">Type</label>
<select class="form-control" id="type" required>
    <option value="" selected hidden disabled>Benefit/Cost</option>
    <option value="1">Benefit</option>
    <option value="0">Cost</option>
</select>
@endsection

@section('edit_modal')
<input type="hidden" id="id_edit">
<input type="hidden" id="id_edas_edit">
<label for="name">Nama Kriteria</label>
<input type="text" class="name form-control" id="name_edit" value="{{ old('name') }}" required>
<label for="weight">Bobot</label>
<input type="number" class="weight form-control" id="weight_edit" value="{{ old('weight') }}" required>
<label for="type">Type</label>
<select class="form-control" id="type_edit" required>
    <option value="1">Benefit</option>
    <option value="0">Cost</option>
</select>
@endsection

@section('js')
<script>
    var id_edas = @json($edas->id);
    var criterias = @json($criterias);

    document.addEventListener('DOMContentLoaded', function() {

    $('.table-title').html('<b>Kriteria for ' + "{{ $edas->name }}<b>");

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

        if (criterias.length==0) {
                    $('tbody').append(`
                    <tr>
                        <td colspan="5" class="text-center"> No Criteria tracked. Try creating one.</td>
                    </tr>`);
        } else {
            $.each(criterias, function(foo, bar) {
                $('tbody').append(`
                    <tr>
                        <td> C` + (foo+1) + `</td>
                        <td>` + bar.name + `</td>
                        <td>` + bar.weight + `</td>
                        <td> {{` + bar.type + ` ? 'Benefit' : 'Cost' }} </td>
                        <td> ` + bar.subcriterias_count + ` </td>
                        <td>
                                <button type="button" class="subcriteria btn btn-secondary btn-sm" value="` +
                            bar.id + `">Subcriteria</button>
                                <button type="button" class="edit_criteria btn btn-primary btn-sm" value="` +
                            bar.id + `">Edit</button>
                                <button type="button" class="delete_criteria btn btn-danger btn-sm" value="` +
                            bar.id + `">Delete</button>
                        </td>
                    </tr>`);
            })
        }
    });

    function fetch() {
        $.ajax({
            type: "GET",
            url: "/dashboard/criteria/data/"+ id_edas,
            dataType: "json",
            success: function(data) {
                $('#errorAdd').html("");
                $('#errorEdit').html("");
                $('#modal_add_criteriaLabel').html('Add Criteria');
                $('tbody').html("");
                if (data.criterias.length==0) {
                    $('tbody').append(`
                        <tr>
                            <td colspan="5" class="text-center"> No Criteria tracked. Try creating one.</td>
                        </tr>`);
                } else {
                    $.each(data.criterias, function(foo, bar) {
                        $('tbody').append(`
                            <tr>
                                <td> C` + (foo+1) + `</td>
                                <td>` + bar.name + `</td>
                                <td>` + bar.weight + `</td>
                                <td> {{` + bar.type + ` ? 'Benefit' : 'Cost' }} </td>
                                <td>  `+ bar.subcriterias_count + ` </td>
                                <td>
                                        <button type="button" class="subcriteria btn btn-secondary btn-sm" value="` +
                                    bar.id + `">Subcriteria</button>
                                        <button type="button" class="edit_criteria btn btn-primary btn-sm" value="` +
                                    bar.id + `">Edit</button>
                                        <button type="button" class="delete_criteria btn btn-danger btn-sm" value="` +
                                    bar.id + `">Delete</button>
                                </td>
                            </tr>`);
                    })
                }
            }
        });
    }

    function closeModal(idModal) {
            $("#" + idModal).modal('hide');
    }

    $(document).ready(function() {

    fetch();

    $(document).on('click', '.add_criteria', function(e) {
                e.preventDefault();
                var criteria = {
                    'id_edas': $('#id_edas').val(),
                    'name': $('#name').val(),
                    'weight': $('#weight').val(),
                    'type': $('#type').val(),
                };

                $.ajax({
                    type: "POST",
                    url: "{{ route('dashboard.criteria.store') }}",
                    data: criteria,
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            $('#success').addClass('alert alert-success');
                            $('#success').text(response.message);
                            $('#add_criteria_modal').modal('hide');
                            fetch();
                        } else {
                            $('#errorAdd').addClass('alert alert-danger');
                            $('#errorAdd').html("");
                            for (const [key, value] of Object.entries(response.error)) {
                                $('#errorAdd').append(`<li>` + value + `</li>`);
                            }
                        }
                    }
                });
            });

    $(document).on('click', '.delete_criteria', function(e) {
        e.preventDefault();
        let id_criteria = $(this).val();
        $('#delete_id').val(id_criteria);
        $('#modal_delete_criteriaLabel').text('Delete Warning!!!');
        $('#modal_delete_criteria').modal('show');
    });

    $(document).on('click', '.proceed_delete_criteria', function(e) {
                e.preventDefault();
                let id_criteria = $('#delete_id').val();

                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/criteria/' + id_criteria,
                    success: function(res) {
                        if (res.status) {
                            $('#success').html("");
                            $('#success').addClass('alert alert-success');
                            $('#success').text(res.message);
                            $('#modal_delete_criteria').modal('hide');
                            fetch();
                        } else {
                            $('#success').html("");
                            $('#success').addClass('alert alert-danger');
                            for (const [key, value] of Object.entries(response.error)) {
                                $('#success').append(`<li>` + value + `</li>`);
                            }
                            $('#modal_delete_criteria').modal('hide');
                        }
                    }
                });
            });

            $(document).on('click', '.edit_criteria', function(e) {
                e.preventDefault();
                let id_criteria = $(this).val();
                $("#modal_edit_criteriaLabel").html('Edit Criteria');
                $('#modal_edit_criteria').modal('show');
                let editUrl = "/dashboard/criteria/" + id_criteria + "/edit";
                $.ajax({
                    type: "GET",
                    url: editUrl,
                    success: function(response) {
                        if (response.status) {
                            $('#id_edit').val(response.criteria.id);
                            $('#id_edas_edit').val(response.criteria.id_edas);
                            $('#name_edit').val(response.criteria.name);
                            $('#weight_edit').val(response.criteria.weight);
                            $('#type_edit').val(response.criteria.type);
                        } else {
                            $('#success').html('');
                            $('#success').addClass('alert alert-danger');
                            for (const [key, value] of Object.entries(response.error)) {
                                $('#success').append(`<li>` + value + `</li>`);
                            }
                        }
                    }
                });
            });

            $(document).on('click', '.update_criteria', function(e) {
                e.preventDefault();

                let id_criteria = $("#id_edit").val();

                let data = {
                    'id' : $('#id_edit').val(),
                    'id_edas': $('#id_edas_edit').val(),
                    'name': $('#name_edit').val(),
                    'weight': $('#weight_edit').val(),
                    'type': $('#type_edit').val(),
                };

                $.ajax({
                    type: 'PUT',
                    url: '/dashboard/criteria/' + id_criteria,
                    data: data,
                    dataType: 'json',
                    success: function(res) {
                        if (res.status) {
                            $('#success').html('');
                            $('#success').addClass('alert alert-success');
                            $('#success').text(res.message);
                            $('#modal_edit_criteria').modal('hide');
                            fetch();
                        } else {
                            $('#errorEdit').html('');
                            $('#errorEdit').addClass('alert alert-danger');
                            for (const [key, value] of Object.entries(response.error)) {
                                $('#errorEdit').append(`<li>` + value + `</li>`);
                            }
                        }
                    }
                });
            });

            $(document).on('click', '.subcriteria', function(e) {
                e.preventDefault();
                let id_criteria = $(this).val();
                window.location.href = "/dashboard/subcriteria/" + id_criteria;
            });
        });
</script>
@endsection
