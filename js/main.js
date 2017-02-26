$(document).ready(function () {
    $("#BtnBuscarAvanzada").click(function () {
        $(".search-form").toggle();
    });
});

$(document).ready(function () {
    $("#BtnBuscar").click(function () {
        $(".search-form").toggle();
    });
});

$(document).ready(function () {
    $("#BtnCerrar").click(function () {
        $(".search-form").toggle();
    });
});

function valueChanged() {
    $('.uso_normal').is(":checkbox")
    $(".uso_interno").toggle();
    $('.uso_normal').hide();
}


function busqueda(cliente) {

    var parametros = {
        "cliente": cliente,
    };

    $.ajax({
        async: true,
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        timeout: 4000,
        data: parametros,
        url: 'busqueda',
        type: 'post',
        beforeSend: function () {
            $("#ResultadoCliente").show();
            $("#ProductoContratado").show();
            $("#Inventivos").show();
            $("#FormaPago").show();
            $("#Comisiones").show();
            $("#Ncontrato").show();
            $("#Selectsalas").show();
            $("#Busqueda").hide();
            $("#btnBotones").show();
        },

        success: function (response) {
            // $("#resultado").html(response);

            cadena = response.split('/');

            var
                Codigo_Cliente,
                nombre,
                apellido,
                Profesion,
                Edad,
                Estado_Civil,
                Distrito,
                Direccion,
                Telefono_Casa,
                Telefono_Casa2,
                Telefono_Celular,
                Telefono_Celular2,
                Telefono_Celular3,
                Email,
                Traslado,
                Tarjeta_De_Credito,
                Promotor,
                Local,
                Local,
                dni,
                Super_Promotor,
                Jefe_Promotor;

            Codigo_Cliente = document.getElementById('cliente-codigo_cliente').value = cadena[0];
            nombre = document.getElementById('cliente-nombre').value = cadena[1];
            apellido = document.getElementById('cliente-apellido').value = cadena[2];
            Profesion = document.getElementById('cliente-profesion').value = cadena[3];
            Edad = document.getElementById('cliente-edad').value = cadena[4];
            Estado_Civil = document.getElementById('cliente-estado_civil').value = cadena[5];
            Distrito = document.getElementById('cliente-distrito').value = cadena[6];
            Direccion = document.getElementById('cliente-direccion').value = cadena[7];
            Telefono_Casa = document.getElementById('cliente-telefono_casa').value = cadena[8];
            Telefono_Casa2 = document.getElementById('cliente-telefono_casa2').value = cadena[9];
            Telefono_Celular = document.getElementById('cliente-telefono_celular').value = cadena[10];
            Telefono_Celular2 = document.getElementById('cliente-telefono_celular2').value = cadena[11];
            Telefono_Celular3 = document.getElementById('cliente-telefono_celular3').value = cadena[12];
            Email = document.getElementById('cliente-email').value = cadena[13];
            Traslado = document.getElementById('cliente-traslado').value = cadena[14];
            Tarjeta_De_Credito = document.getElementById('cliente-tarjeta_de_credito').value = cadena[15];
            // Promotor = document.getElementById('cliente-promotor').value = cadena[16];
            // Local = document.getElementById('cliente-local').value = cadena[17];
            dni = document.getElementById('cliente-dni').value = cadena[18];
            // Super_Promotor = document.getElementById('cliente-super_promotor').value = cadena[19];
            // Jefe_Promotor = document.getElementById('cliente-jefe_promotor').value = cadena[20];
        }
    });


}

function ValidarPasaporte(tipopasaporte, codigobarra) {

    var parametros = {
        "tipopasaporte": tipopasaporte,
        "codigobarra": codigobarra,
    };

    $.ajax({
        data: parametros,
        url: 'validarpasaporte',
        type: 'post',
        beforeSend: function () {
            $("#query").html("Procesando, espere por favor...");
        },

        success: function (response) {
            $("#query").html(response);
        }
    });


}

function IngresarCertificado(codigobarra, totalnoches, codigopasaporte) {

    var parametros = {
        "codigobarra": codigobarra,
        "totalnoches": totalnoches,
        "codigopasaporte": codigopasaporte,
    };

    var codigopasaporte;

    codigopasaporte =  document.getElementById('venta-numero_pasaporte').value;

    if(codigopasaporte !== ''){
        document.getElementById('venta-numero_pasaporte').setAttribute("readonly", true);
    }else{
        document.getElementById('venta-numero_pasaporte').setAttribute("readonly", false);
    }

    $.ajax({
        data: parametros,
        url: 'insertcodigobarra',
        type: 'post',
        beforeSend: function () {
            $("#query2").html("Procesando, espere por favor...");
        },

        success: function (response) {
            $("#query2").html(response);
        }
    });
}

function contador(codigopasaporte) {
    var parametros = {
        "codigopasaporte": codigopasaporte,
    };

    var escaneado,total,nTotal;
    escaneado = document.getElementById('venta-numero_escaneado').value;
    total = document.getElementById('venta-numero_total').value;

    nTotal = total-1;

    if(nTotal <= escaneado){
        document.getElementById('btnScan').disabled = true;
    }else{
        document.getElementById('btnScan').disabled = false;
    }


    $.ajax({
        data: parametros,
        url: 'cargardata',
        type: 'post',
        beforeSend: function () {
            $("#Grilla").html("Procesando, espere por favor...");



        },

        success: function (response) {
            $("#Grilla").html(response);
        }
    });
}

function escaneado(codigopasaporte) {
    var parametros = {
        "codigopasaporte": codigopasaporte,
    };

    $.ajax({
        data: parametros,
        url: 'count',
        type: 'post',
        beforeSend: function () {
            // $("#Grilla").html("Procesando, espere por favor...");
        },

        success: function (response) {
            var var1;
            var1 = document.getElementById('venta-numero_escaneado').value = response;
        }
    });
}

function Cantidad(value) {

    precio(value);

    if (value == "1") {
        document.getElementById("venta-numero_total").value = "10";
    }
    else if (value == "2") {
        document.getElementById("venta-numero_total").value = "20";
    }
    else {
        document.getElementById("venta-numero_total").value = "30";
    }
}

function precio(codigo) {
    var parametros = {
        "codigo": codigo,
    };

    $.ajax({
        data: parametros,
        url: 'costo',
        type: 'post',
        beforeSend: function () {
        },

        success: function (response) {
            var var1;
            var1 = document.getElementById('venta-montototal').value = response;
        }
    });
}

function resta(montoTotal, MontoIngresa) {

    if (parseFloat(MontoIngresa) > parseFloat(montoTotal)) {
        alert("El monto ingresado no debe ser igual al Total.");
        document.getElementById('pago-monto_ingresado').value = "";
    } else {
        document.getElementById('pago-monto_restante').value = parseFloat(montoTotal - MontoIngresa);
    }

}

function validar(nombre) {

    if (document.getElementById('venta-uso_interno').value == "") {
        document.getElementById('btnbusqueda').disabled = true;
    } else {
        document.getElementById('btnbusqueda').disabled = false;
    }

}

function Combo(estado) {

    if (estado == 0) {
        document.getElementById('estadopago').style.display = 'block';
        document.getElementById('sala').style.display = 'none';
        document.getElementById('club').style.display = 'none';
        document.getElementById('usuario').style.display = 'none';
    }else if (estado == 1){
        document.getElementById('sala').style.display = 'block';
        document.getElementById('estadopago').style.display = 'none';
        document.getElementById('club').style.display = 'none';
        document.getElementById('usuario').style.display = 'none';
    }else if (estado == 2){
        document.getElementById('club').style.display = 'block';
        document.getElementById('estadopago').style.display = 'none';
        document.getElementById('sala').style.display = 'none';
        document.getElementById('usuario').style.display = 'none';
    }else if (estado == 3){
        document.getElementById('usuario').style.display = 'block';
        document.getElementById('estadopago').style.display = 'none';
        document.getElementById('sala').style.display = 'none';
        document.getElementById('club').style.display = 'none';
    }else if (estado == null || estado == ''){
        document.getElementById('estadopago').style.display = 'none';
        document.getElementById('sala').style.display = 'none';
        document.getElementById('club').style.display = 'none';
        document.getElementById('usuario').style.display = 'none';
    }

}

function OperacionClub(precio,vigencia) {

    var total;
    total = parseFloat(precio/vigencia);

    Telefono_Casa = document.getElementById('club-precio_por_noche').value = total
}


