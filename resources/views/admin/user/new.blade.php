@extends('welcome')

@section('title')
    <h1>
        Dashboard /
        <small>Datos de Usuario</small>
    </h1>
@endsection

@section('content')
<div class="card text-white col-lg-12" style="padding: 0px">
        <div class="card-header bg-primary">
            Administrador de Usuarios
            <div class="pull-right">
            <a href="{{ route('adminUser') }}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i> Usuario Ingresados</a>
        </div>
        </div>
        <div class="card-body text-black">
            <h5 class="card-title">Nuevo Usuario</h5>
            <br>
            <form id="newUser">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="run">RUN</label>
                        <input type="text" class="form-control" maxlength="12" id="run" name="run">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="first_name">Nombre</label>
                        <input type="text" class="form-control" maxlength="150" id="first_name" name="first_name">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="last_name">Apellido</label>
                        <input type="text" class="form-control" maxlength="150" id="last_name" name="last_name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="sex">Sexo</label>
                        <select id="sex" name="sex" class="form-control">
                            <option selected>-- Seleccione --</option>
                            <option value="0">Femenino</option>
                            <option value="1">Masculino</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="birthdate">Fecha de Nacimiento</label>
                        <input type="text" class="form-control datePicker" id="birthdate" name="birthdate">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="arrival_date">Fecha de llegada</label>
                        <input type="text" class="form-control datePicker" id="arrival_date" name="arrival_date">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Numero Celular</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button class="bt btn-success btn-sm pull-right"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $("#run").Rut({
            on_error: function(){
                $("#run").css("border-color", "red");
                toastr.error("El Rut ingresado es Incorrecto", "Error en Datos");
            },
            on_success: function(){
                $("#run").css("border-color", "");
            },
            format_on: 'keyup'
        });
    });

    function sendRegister () {
        $.ajax({
            url : 'post.php',
            data : { id : 123 },
            type : 'POST',
            success : function(json) {

                toastr.success("Almacenado", "Usuario ingresado con exito");
            },
            error : function(xhr, status) {
                toastr.error('Disculpe, existió un problema');
            },
            complete : function(xhr, status) {
                alert('Petición realizada');
            }
        });
    };


    $("#newUser").validate({
        rules: {
            run: {
                required: true
            },
            first_name: {
                required: true,
                minlength: 3
            },
            last_name: {
                required: true,
                minlength: 3
            },
            sex: {
                required: true
            },
            birthdate: {
                required: true
            },
            arrival_date: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true
            }
        },
        messages: {
            run: {
                required: "Ingrese Rut"
            },
            first_name: {
                required: "Ingrese el Nombre Valido",
                minlength: jQuery.validator.format("Debe Ingresar mas de {0} caracteres")
            },
            last_name: {
                required: "Ingrese un Apellido Valido",
                minlength: jQuery.validator.format("Debe Ingresar mas de {0} caracteres")
            },
            sex: {
                required: "Ingrese Sexo"
            },
            birthdate: {
                required: "Ingrese Fecha de Cumpleaños"
            },
            arrival_date: {
                required: "ingrese Fecha de Llegada"
            },
            email: {
                required: "Ingrese Correo Valido",
                minlength: "Ingrese Correo Valido"
            },
            phone: {
                required: "Ingrese Número de Telefono"
            }
        },
        // the errorPlacement has to take the table layout into account
        errorPlacement: function(error, element) {
            if (element.is(":radio"))
                error.appendTo(element.parent().next().next());
            else if (element.is(":checkbox"))
                error.appendTo(element.next());
            else
                error.appendTo(element.parent());
        },
        submitHandler: function() {
            console.log($(this));
            toastr.error("Hay Error en el llenado del formulario", "Error de Datos");
        },
        // set this class to error-labels to indicate valid fields
        success: function(label) {
            label.html("&nbsp;").addClass("checked");
        },
        highlight: function(element, errorClass) {
            $(element).parent().next().find("." + errorClass).removeClass("checked");
        }
});

</script>
@endsection