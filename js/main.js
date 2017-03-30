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
            $("#cotitular").show();
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

    codigopasaporte = document.getElementById('venta-numero_pasaporte').value;

    if (codigopasaporte !== '') {
        document.getElementById('venta-numero_pasaporte').setAttribute("readonly", true);
    } else {
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

function contador(codigopasaporte, codigocertificado) {
    var parametros = {
        "codigopasaporte": codigopasaporte,
        "codigocertificado": codigocertificado,
    };

    var escaneado, total, nTotal;
    escaneado = document.getElementById('venta-numero_escaneado').value;
    total = document.getElementById('venta-numero_total').value;

    nTotal = total - 1;

    if (parseInt(total) <= parseInt(escaneado)) {
        document.getElementById('btnScan').disabled = true;
    } else if (parseInt(nTotal) <= parseInt(escaneado)) {
        document.getElementById('btnScan').disabled = true;
    } else {
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
            alert("Se Inserto Correctamente el Certificado");
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


    var parametros = {
        "value": value,
    };

    precio(value);

    $.ajax({
        data: parametros,
        url: 'cantidad',
        type: 'post',
        beforeSend: function () {
        },

        success: function (response) {
            var var1;
            var1 = document.getElementById("venta-numero_total").value = response;
        }
    });

    // precio(value);
    //
    // if (value == "1") {
    //     document.getElementById("venta-numero_total").value = "10";
    // }
    // else if (value == "2") {
    //     document.getElementById("venta-numero_total").value = "20";
    // }
    // else {
    //     document.getElementById("venta-numero_total").value = "30";
    // }
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
        alert("El monto ingresado no debe ser mayor al Total.");
        document.getElementById('pago-monto_ingresado').value = "";
        document.getElementById('pago-monto_restante').value = "";

        if (document.getElementById('pago-estado_pago').value == 2) {
            if (parseFloat(montoTotal - MontoIngresa) == 0) {
                document.getElementById('btn-form-venta').disabled = false;
            } else {
                document.getElementById('btn-form-venta').disabled = true;
            }
        }

    }
    else if (parseFloat(MontoIngresa) == parseFloat(montoTotal)) {
        document.getElementById('pago-monto_restante').value = parseFloat(montoTotal - MontoIngresa);
        document.getElementById('btn-form-venta').disabled = true;
        if (parseFloat(montoTotal - MontoIngresa) == 0) {
            document.getElementById('btn-form-venta').disabled = false;
        }
    }
    else {
        document.getElementById('pago-monto_restante').value = parseFloat(montoTotal - MontoIngresa);

        if (document.getElementById('pago-estado_pago').value == 2) {
            if (parseFloat(montoTotal - MontoIngresa) == 0) {
                document.getElementById('btn-form-venta').disabled = false;
            } else {
                document.getElementById('btn-form-venta').disabled = true;
            }
        }

    }

}

function validador(estado, montoTotal, MontoIngresa) {

    if (estado == 2) {
        document.getElementById('btn-form-venta').disabled = true;
        alert("El monto cancelado debe ser igual al Monto Total");

        if (document.getElementById('venta-montototal').value == '' || document.getElementById('venta-montototal').value == null) {
            alert("No esta seleccionado un club, validar por favor");
        }
    } else {
        document.getElementById('btn-form-venta').disabled = false;
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
    } else if (estado == 1) {
        document.getElementById('sala').style.display = 'block';
        document.getElementById('estadopago').style.display = 'none';
        document.getElementById('club').style.display = 'none';
        document.getElementById('usuario').style.display = 'none';
    } else if (estado == 2) {
        document.getElementById('club').style.display = 'block';
        document.getElementById('estadopago').style.display = 'none';
        document.getElementById('sala').style.display = 'none';
        document.getElementById('usuario').style.display = 'none';
    } else if (estado == 3) {
        document.getElementById('usuario').style.display = 'block';
        document.getElementById('estadopago').style.display = 'none';
        document.getElementById('sala').style.display = 'none';
        document.getElementById('club').style.display = 'none';
    } else if (estado == null || estado == '') {
        document.getElementById('estadopago').style.display = 'none';
        document.getElementById('sala').style.display = 'none';
        document.getElementById('club').style.display = 'none';
        document.getElementById('usuario').style.display = 'none';
    }

}

function OperacionClub(precio, vigencia) {

    var total;
    total = parseFloat(precio / vigencia);

    Telefono_Casa = document.getElementById('club-precio_por_noche').value = total
}

function pasaporteCodigo(codsala) {
    var parametros = {
        "codsala": codsala,
    };

    $.ajax({
        data: parametros,
        url: 'codigosala',
        type: 'post',

        success: function (response) {
            var var1;
            var1 = document.getElementById('venta-numero_pasaporte').value = response;
        }
    });
}

function jsAgregar(evt, codigobarra, totalnoches, codigopasaporte) {
    var evt = (evt) ? evt : ((event) ? event : null);
    if (evt.keyCode == 13) {

        var parametros = {
            "codigobarra": codigobarra,
            "totalnoches": totalnoches,
            "codigopasaporte": codigopasaporte,
        };

        $.ajax({
            data: parametros,
            url: 'insertcodigobarra',
            type: 'post',
            beforeSend: function () {
                $("#queryRest").html("Procesando, espere por favor...");
            },

            success: function (response) {
                if (response == '<i class="fa fa-font-awesome fa-2x  text-success" aria-hidden="true"></i> Este codigo puede usarse. ') {
                    document.getElementById('btnScan').disabled = false;
                    $("#queryRest").html(response);
                } else {
                    document.getElementById('btnScan').disabled = true;
                    $("#queryRest").html(response);
                }
            }
        });

    }
}

document.getElementById('btnScan').disabled = true;
var clicks = 0;

function contadorescaneado(codigobarra) {

    if (codigobarra !== 0){
        clicks += 1;
        document.getElementById("venta-numero_escaneado").value = clicks;
    }else {
        alert("Seleccionar un Codigo de barra valido.");
    }

    // var parametros = {
    //     "codigobarra": codigobarra,
    // };
    //
    // $.ajax({
    //     data: parametros,
    //     url: 'cantidadscan',
    //     type: 'post',
    //
    //     success: function (response) {
    //         document.getElementById('venta-numero_escaneado').value = response;
    //     }
    // });
}

$(document).on("keypress", 'form', function (e) {
    var code = e.keyCode || e.which;
    // console.log(code);
    if (code == 13) {
        // console.log('Inside');
        e.preventDefault();
        return false;
    }
});


$("#FormaDePagoInac").hide();

$(document).on("click", "#FormaDePagoAct", function () {
    var MontoTotal, MontoIngresado;
    MontoTotal = document.getElementById('venta-montototal').value;
    MontoIngresado = document.getElementById('pago-monto_ingresado').value;

    if (MontoTotal == parseFloat(MontoIngresado)) {
        $("#FormaDePagoAct").hide();
        $("#FormaDePagoInac").show();
        $('.add-dynamic-relation').hide();
        $('.add-dynamic-relation').attr('disabled', 'disabled');

    } else {
        $("#FormaDePagoAct").show();
        $("#FormaDePagoInac").hide();
        $('.add-dynamic-relation').hide();
        $('.add-dynamic-relation').attr('disabled', 'disabled');
    }

});

