@extends('welcome')

@section('title')
<h1>
    Administrador de Usuarios /
    <small>Listado de Usuarios</small>
</h1>
@endsection

@section('content')
<div class="card text-white col-lg-12" style="padding: 0px">
    @csrf
    <div class="card-header bg-primary">
        Administrador de Usuarios
        <div class="pull-right">
            <a href="{{ route('adminUserCreated') }}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-user"></i> Nuevo Usuario</a>
        </div>
    </div>
    <div class="card-body text-black">
        <table id="table-list-user" class="table">
            <thead>
                <tr>
                    <th class='text-center'>Rut</th>
                    <th class='text-center'>Nombre</th>
                    <th class='text-center'>Celular</th>
                    <th class='text-center'>Acciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<div class="modal" id="modal-confirm-accion-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titleConfirm">Eliminación de Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 id="textConfirm">¿Esta realmente seguro que desea eliminar un usuario?</h5>
                <input type="hidden" id="identificateDeleted">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="textButtonConfirm" class="btn btn-primary btn-acept-remove-user">Si, Eliminar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    var urlCreateEditUser = `{{ route('adminUserCreated') }}`;
    var urlDelete = `{{ route('adminUserRemove') }}`;

    $(document).ready(function() {
        init();
    });

    function init() {
        showChargePageLoad(true);
        $.ajax({
            url: 'user-admin/data',
            type: 'POST',
            success: function(json) {
                var data = JSON.parse(json);
                var HTML = "";
                $.each(data.data, function(i, row) {
                    console.log(row);
                    HTML += `<tr>
                                <td class='text-center'>${row.rut}</td>
                                <td class='text-center'>${row.name}</td>
                                <td class='text-center'>${row.phone}</td>
                                <td class='text-center'>
                                    <a href="${ urlCreateEditUser }/${row.id}" class='btn btn-info btn-sm btn-edit-user' data-user='${row.id}'><i class='fa fa-edit'></i></a>
                                    <a class='btn btn-success btn-sm btn-access-teacher-user' data-user='${row.id}'><i class='fa fa-book'></i></a>
                                    <a class='btn btn-danger btn-sm btn-remove-user' data-user='${row.id}'><i class='fa fa-trash'></i></a>
                                </td>
                            </tr>`;
                });
                if (HTML !== "" && $.fn.DataTable.isDataTable('#table-list-user')) {
                    $('#table-list-user').DataTable().destroy();
                }
                $('#table-list-user tbody').html(HTML);
                initDataTable();
            },
            error: function(xhr, status) {
                alert('Disculpe las molestias, existió un problema');
            },
            complete: function(jqXHR, textStatus) {
                showChargePageLoad();
            }
        });
    }

    function initDataTable() {
        $('#table-list-user').DataTable({
            "language": getLenguajeByDataTable({
                "name": "Usuarios"
            })
        });
    }

    $(document).on("click", ".btn-remove-user", function() {
        showModalConfirm('Confirmación de Eliminación', '¿Está realmente seguro de eliminar el usuario?', 'Si, Eliminar', $(this).data("user"));
    });

    $(document).on("click", ".btn-acept-remove-user", function() {
        $("#modal-confirm-accion-user").modal("hide");
        showChargePageLoad(true);
        var id_user = $("#identificateDeleted").val();
        $.ajax({
            url: 'user-admin/remove',
            data: {
                id: id_user
            },
            type: 'POST',
            success: function(json) {
                var data = JSON.parse(json);
                console.log(data);
                toastr.success("Usuario eliminado", "Dato Removido");
            },
            error: function(xhr, status) {
                alert('Disculpe, existió un problema');
            },
            complete: function(xhr, status) {
                init();
                showChargePageLoad();
            }
        });
    });

    $(document).on("click", ".btn-access-teacher-user", function() {
        showModalConfirm('Confirmación de Acceso', '¿Está realmente seguro de darle acceso de profesor al usuario?', 'Si, dar acceso', $(this).data("user"));
    });

    function showModalConfirm(title, message, textButton, identify) {
        $("#modal-confirm-accion-user #titleConfirm").text(title);
        $("#modal-confirm-accion-user #textConfirm").text(message);
        $("#modal-confirm-accion-user #textButtonConfirm").text(textButton);
        $("#identificateAccess").val(identify);
        $("#modal-confirm-accion-user").modal("show");
    };
</script>
@endsection