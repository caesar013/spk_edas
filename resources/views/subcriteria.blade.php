@extends('layouts.crud')

@section('title', 'Sub-Criteria')

@section('variable')
@php
$model = 'subcriteria';
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
                        <div class="col-md-6" id="table-title"><b>Sub-Kriteria</b></div>
                        <div class="col-md-6 d-flex justify-content-end"><button type="button" href=""
                                class=" btn btn-primary" data-toggle="modal" data-target="#add_subcriteria_modal">
                                + Tambah Sub-Kriteria
                            </button> </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Nilai</th>
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
<input type="hidden" id="id_criteria" value="">
<label for="information">Keterangan Sub-Kriteria</label>
<input type="text" class="information form-control" id="information" value="{{ old('information') }}" required>
<label for="value">Bobot</label>
<input type="number" class="value form-control" id="value" value="{{ old('value') }}" required>
@endsection

@section('edit_modal')
<input type="hidden" id="id_edit">
<input type="hidden" id="id_edas_edit">
<input type="hidden" id="id_criteria_edit">
<label for="information">Keterangan</label>
<input type="text" class="information form-control" id="information_edit" value="{{ old('information') }}" required>
<label for="value">Nilai</label>
<input type="number" class="value form-control" id="value_edit" value="{{ old('value') }}" required>
@endsection

@section('js')
<script>
    var id_edas = @json($criteria->id_edas);
    var subcriterias = @json($subcriterias);
    var id_criteria = @json($criteria->id);

    document.addEventListener('DOMContentLoaded', function() {

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

    $('#table-title').html('Sub-Criteria of ' + "{{ $criteria->name }}" + ' Criteria');

    $('#id_criteria').val(id_criteria);
    $('#id_edas').val(id_edas);

        if (subcriterias.length==0) {
                    $('tbody').append(`
                    <tr>
                        <td colspan="4" class="text-center"> No Sub-Criteria tracked. Try creating one.</td>
                    </tr>`);
        } else {
            $.each(subcriterias, function(foo, bar) {
                $('tbody').append(`
                    <tr>
                        <td>` + (foo+1) + `</td>
                        <td>` + bar.information + `</td>
                        <td>` + bar.value + `</td>
                        <td>
                                <button type="button" class="edit_subcriteria btn btn-primary btn-sm" value="` +
                            bar.id + `">Edit</button>
                                <button type="button" class="delete_subcriteria btn btn-danger btn-sm" value="` +
                            bar.id + `">Delete</button>
                        </td>
                    </tr>`);
            })
        }
    });

    function fetch() {
        $.ajax({
            type: "GET",
            url: "/dashboard/subcriteria/data/"+ id_criteria,
            dataType: "json",
            success: function(data) {
                $('#errorAdd').html("");
                $('#errorEdit').html("");
                $('#modal_add_subcriteriaLabel').html('Add Sub-Criteria');
                $('tbody').html("");
                if (data.subcriterias.length==0) {
                    $('tbody').append(`
                        <tr>
                            <td colspan="4" class="text-center"> No Sub-Criteria tracked. Try creating one.</td>
                        </tr>`);
                } else {
                    $.each(data.subcriterias, function(foo, bar) {
                        $('tbody').append(`
                            <tr>
                                <td>` + (foo+1) + `</td>
                                <td>` + bar.information + `</td>
                                <td>` + bar.value+ `</td>
                                <td>
                                        <button type="button" class="edit_subcriteria btn btn-primary btn-sm" value="` +
                                    bar.id + `">Edit</button>
                                        <button type="button" class="delete_subcriteria btn btn-danger btn-sm" value="` +
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


    $(document).on('click', '.add_subcriteria', function(e) {
                e.preventDefault();
                var subcriteria = {
                    'id_edas': $('#id_edas').val(),
                    'id_criteria': $('#id_criteria').val(),
                    'information': $('#information').val(),
                    'value': $('#value').val(),
                };

                $.ajax({
                    type: "POST",
                    url: "{{ route('dashboard.subcriteria.store') }}",
                    data: subcriteria,
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            $('#success').addClass('alert alert-success');
                            $('#success').text(response.message);
                            fetch();
                            $('#add_subcriteria_modal').modal('hide');
                        } else {
                            $('#errorAdd').addClass('alert alert-danger');
                            $('#errorAdd').text(response.error);
                        }
                    }
                });
            });

    $(document).on('click', '.delete_subcriteria', function(e) {
        e.preventDefault();
        let id_subcriteria = $(this).val();
        $('#delete_id').val(id_subcriteria);
        $('#modal_delete_subcriteriaLabel').text('Delete Warning!!!');
        $('#modal_delete_subcriteria').modal('show');
    });

    $(document).on('click', '.proceed_delete_subcriteria', function(e) {
                e.preventDefault();
                let id_subcriteria = $('#delete_id').val();

                $.ajax({
                    type: 'DELETE',
                    url: '/dashboard/subcriteria/' + id_subcriteria,
                    success: function(res) {
                        if (res.status) {
                            $('#success').html("");
                            $('#success').addClass('alert alert-success');
                            $('#success').text(res.message);
                            fetch();
                            $('#modal_delete_subcriteria').modal('hide');
                        } else {
                            $('#success').html("");
                            $('#success').addClass('alert alert-danger');
                            $('#success').text(res.error);
                            $('#modal_delete_subcriteria').modal('hide');
                        }
                    }
                });
            });

            $(document).on('click', '.edit_subcriteria', function(e) {
                e.preventDefault();
                let id_subcriteria = $(this).val();
                $("#modal_edit_subcriteriaLabel").html('Edit Sub-Criteria');
                $('#modal_edit_subcriteria').modal('show');
                let editUrl = "/dashboard/subcriteria/" + id_subcriteria + "/edit";
                $.ajax({
                    type: "GET",
                    url: editUrl,
                    success: function(response) {
                        if (response.status) {
                            $('#id_edit').val(response.subcriteria.id);
                            $('#id_edas_edit').val(response.subcriteria.id_edas);
                            $('#id_criteria_edit').val(response.subcriteria.id_criteria);
                            $('#information_edit').val(response.subcriteria.information);
                            $('#value_edit').val(response.subcriteria.value);
                        } else {
                            $('#success').html('');
                            $('#success').addClass('alert alert-danger');
                            $('#success').text(response.error);
                        }
                    }
                });
            });

            $(document).on('click', '.update_subcriteria', function(e) {
                e.preventDefault();

                let id_subcriteria = $("#id_edit").val();

                let data = {
                    'id' : $('#id_edit').val(),
                    'id_edas': $('#id_edas_edit').val(),
                    'id_criteria': $('#id_criteria_edit').val(),
                    'information': $('#information_edit').val(),
                    'value': $('#value_edit').val(),
                };

                $.ajax({
                    type: 'PUT',
                    url: '/dashboard/subcriteria/' + id_subcriteria,
                    data: data,
                    dataType: 'json',
                    success: function(res) {
                        if (res.status) {
                            $('#success').html('');
                            $('#success').addClass('alert alert-success');
                            $('#success').text(res.message);
                            $('#modal_edit_subcriteria').modal('hide');
                            fetch();
                        } else {
                            $('#errorEdit').html('');
                            $('#errorEdit').addClass('alert alert-danger');
                            $('#errorEdit').text(res.error);
                        }
                    }
                });
            });
        });
</script>
@endsection