<?php
header('Content-type: application/pdf');

$Codigo_Contrato = $model->Codigo_venta;
$Codigo_Cliente = $model->Codigo_Cliente;

//$connection = \Yii::$app->db;
//$sqlStatement = "
//       SELECT concat(Nombre,' ',Apellido) as Dato
//        FROM beneficiario
//        WHERE Codigo_Cliente =  $Codigo_Cliente;";
//$comando = $connection->createCommand($sqlStatement);
//$resultado = $comando->queryAll();
//
//while ($row = $resultado->read()) {
//    $cadena = $row['Dato'];
foreach ($Beneficiario as $Beneficiarios):
    $dato = $Beneficiarios['dato'];
//    $pagina1 = "<div><p class='datos'>LOS BENEFICIARIOS:  $dato </p></div>";
endforeach;
//}
//


$pagina1 = "
<style>
    .titulo {
        text-align: center;
        font-weight: bold;
        font-size: 9.5pt;
        text-decoration: underline;
    }

    .documento {
        text-align: justify;
        font-size: 8.5pt;
    }

    .anexo {
        text-align: center;
        font-size: 8.5pt;
    }

    .datos {
        font-weight: bold;
        font-size: 8.5pt;
        text-transform: uppercase;
    }

    .subrayado {
        text-decoration: underline;
    }
</style>
<html>
<body>
<br/>
<p class='titulo'>CONTRATO DE TERMINOS Y CONDICIONES DE LOS SERVICIOS VACACIONALES Y TURÍSTICOS DENOMINADO
    “RUSTICA CLUB” QUE INCLUYE EL PRODUCTO “NOCHES HOTELERAS RESORTS”
</p>
<div>
    <p class='documento'>Conste por el presente documento la afiliación a
        <b>“RUSTICA CLUB”</b> con sus <b>NOCHES HOTELERAS RESORTS</b>, que celebran de una parte
        <b>RUSTICA CLUB S.A.C.</b>, identificada con <b>R.U.C. N° 20601629284</b>, con domicilio fiscal ubicado
        en el Conjunto Residencial Los Próceres N° II, Departamento N° 503, Edificio E, Distrito de
        Santiago de Surco, Provincia y Departamento de Lima, debidamente representada por su Gerente
        General Don <b>LUIS ROBERTO CALIXTO HIDALGO</b>, identificado con <b>D.N.I. N° 00516273</b>, con Poder inscrito
        en la Partida Electrónica N° 13721828 del Registro de Personas Jurídicas de Lima, a quien en lo sucesivo
        se denominará <b>“LA EMPRESA”</b>; y, de la otra parte:</p>
</div>

<div>
    <p class='datos'>EL SOCIO: $Nombre</p>
</div>

<div>
    <p class='datos'>Identificado con DNI N°: $DNI</p>
</div>

<div>
    <p class='datos'>Dirección: $Direccion</p>
</div>

<div><p class='datos'>LOS BENEFICIARIOS:   </p></div>

<div>
    <p class='documento'>Cada una de las siguientes palabras o frases, cuando sea empleada en el Contrato, tendrán los
        siguientes significados: </p>
</div>

<div>
    <ul>
        <li class='documento'>
            <b class='subrayado'>CONTRATO DE TERMINOS Y CONDICIONES DE LOS SERVICIOS VACACIONALES Y TURÍSTICOS DEL
                PRODCUTO “RUSTICA CLUB” QUE INCLUYE EL PRODUCTO “NOCHES HOTELERAS RESORTS”</b>, en adelante se le
            denominará <b>“RUSTICA CLUB”</b>.
        </li>
        <li class='documento'>
            <b class='subrayado'> AFILIACIÓN</b>.- Se refiere al acto de inscripción que le permite al <b>SOCIO</b> ser
            parte de <b>“RUSTICA CLUB”</b>.
        </li>
        <li class='documento'>
            <b class='subrayado'> SOCIO</b> .- Se refiere a la persona natural que acepta la inscripción a <b>“RUSTICA
            CLUB”.</b> No se refiere a formar parte de la sociedad conforme a lo establecido por la Ley General de
            Sociedades del Perú.
        </li>
        <li class='documento'>
            <b class='subrayado'> LOS RESORTS</b> .- Se le denominará <b>RESORTS a los Hoteles donde se brindará el
            producto <b>“RUSTICA CLUB”</b>.
        </li>
        <li class='documento'>
            <b class='subrayado'> PASAPORTE</b> .- Es una cartilla que anuncia los derechos exclusivos del producto <b>“RUSTICA
            CLUB”</b> en los diferentes <b>RESORTS</b> que LA <b>EMPRESA</b> tiene el servicio exclusivo de
            comercializar y posteriormente <b>AFILIAR</b>. El mismo es para el uso y goce personal del <b>SOCIO</b> y
            los beneficiarios.
        </li>
        <li class='documento'>
            <b class='subrayado'> LA EMPRESA</b> .- Se refiere a la persona jurídica que, a través del presente CONTRATO
            se encargará de comercializar y suscribir AL SOCIO para que LOS RESORTS brinden el producto “RUSTICA CLUB”,
            que se utilizará con el PASAPORTE.
        </li>
        <li class='documento'>
            <b class='subrayado'> RESERVA</b> .- Se refiere a la acción de reservar una o más habitaciones del
            <b>RESORT</b> de su preferencia por <b>EL SOCIO</b>.
        </li>
        <li class='documento'>
            <b class='subrayado'> NOCHES HOTELERAS RESORTS</b> .- Hace referencia a la cantidad de días que<b> EL
            SOCIO</b> haya adquirido del producto
            <b>“RUSTICA CLUB”.
        </li>
        <li class='documento'>
            <b class='subrayado'> BENEFICIARIOS</b> .- <b>EL SOCIO</b> podrá escoger a discrecionalidad quienes serán
            las personas que incluirá dentro del producto <b>“RUSTICA CLUB”</b> y que gozarán de dichos beneficios.
        </li>

    </ul>
</div>

<div>
    <p class='documento'>
        Las siguientes Condiciones y Términos del presente Contrato son aplicables para todas <b>LAS PARTES</b> que
        participen
        en el mismo, como también alcanza a todos los beneficiarios que señale en su oportunidad <b>EL SOCIO</b>, según
        se
        indican a continuación:
    </p>

    <p class='documento subrayado'>
        <b>CARACTERES DEL CONTRATO. </b>
    </p>

    <p class='documento'>
        <b>LOS RESORTS</b> que son parte del producto <b>“RUSTICA CLUB”</b>, donde <b>LA EMPRESA</b> tiene la
        exclusividad de comercializar y posteriormente <b>AFILIAR</b>, son los que a continuación se detallan:
    </p>

    <ul class='datos'>
        <li>
            RESORTS RUSTICA VICHAYITO.
        </li>
        <li>
            RESORTS RUSTICA TARAPOTO.
        </li>
        <li>
            RESORTS RUSTICA PACHACAMAC.
        </li>
        <li>
            RESORTS RUSTICA SANTA EULALIA.
        </li>
    </ul>

    <p class='documento'>
        <b>EL SOCIO</b> podrá escoger entre los diferentes <b>RESORTS</b> que <b>LA EMPRESA</b> ofrece dentro del
        producto <b>“RUSTICA CLUB”</b>.
    </p>

</div>
</body>
</html>
";

$pagina2 = "

<html>
<body>
<div>
    <p class='documento subrayado'>
        <b>OBJETO DEL CONTRATO. </b>
    </p>

    <p class='documento'>
        El presente Contrato tiene por objeto establecer los <b>TERMINOS Y CONDICIONES</b> que regirá el producto <b>“RUSTICA
        CLUB”</b>,
        mediante el cual <b>EL SOCIO</b> se obliga a pagar una contraprestación por el servicio que se prestará cuando
        éste lo
        disponga.
    </p>

    <p class='documento subrayado'>
        <b>TIPOS DE PASAPORTE Y CONTRAPRESTACIÓN CONVENIDA. </b>
    </p>

    <p class='documento'>
        Los tipos de <b>PASAPORTE</b> son los siguientes:
    </p>

    <ul class='documento'>
        <li>
            <b>NOCHES HOTELERAS</b> de 10 días, por un monto ascendente a <b>S/ 2,690.00, válidas por un año. </b>
        </li>
        <li>
            <b>NOCHES HOTELERAS</b> de 20 días, por un monto ascendente a <b>S/ 4,980.00, válidas por dos años.</b>
        </li>
        <li>
            <b>NOCHES HOTELERAS</b> de 30 días, por un monto ascendente a <b>S/ 6,570.00, válidas por tres años</b>.
        </li>
    </ul>

    <p class='documento'>
        Los tipos de <b>PASAPORTE</b> son los siguientes:
    </p>

    <p class='documento  subrayado'>
        <b>FORMA DE UTILIZACIÓN. </b>
    </p>

    <ul class='documento'>
        <li>
            <b>EL <b>PASAPORTE </b></b> le otorga el derecho al <b>SOCIO </b>o sus <b>BENEFICIARIOS</b> a utilizar el
            producto<b> “RUSTICA CLUB”</b> por
            habitación, la misma que será utilizada de acuerdo a lo señalado en el <b>ANEXO N° 1</b>.
        </li>
        <li>
            <b>EL SOCIO </b>y sus <b>BENEFICIARIOS</b> podrán sólo utilizar las habitaciones ESTÁNDAR de <b>LOS
            RESORTS</b>, adicionalmente
            en el <b>ANEXO 1 </b>del presente <b>CONTRATO </b>se indicará de manera detallada las excepciones a la
            utilización de las
            diferentes habitaciones por cada <b>RESORTS </b>.
        </li>
        <li>
            <b>EL SOCIO </b>podrá indicar en el presente <b>CONTRATO </b>dos beneficiarios del producto <b>“RUSTICA
            CLUB”</b> los cuales
            podrán hacer uso del <b>PASAPORTE </b> con derecho a <b>LAS NOCHES HOTELERAS</b>.
        </li>
        <li>
            En el supuesto que <b>EL SOCIO </b>haya reservado en alguno de <b>LOS RESORTS</b> una NOCHE HOTELERA y
            posteriormente
            proceda a solicitar la cancelación de la misma, se le descontará por concepto de penalidad un día de NOCHE
            HOTELERA de su <b>PASAPORTE </b>. Excepcionalmente <b>EL SOCIO </b>podrá solicitar la cancelación sin
            penalidad siempre y
            cuando <b>EL SOCIO </b>realice la cancelación con 15 días de anticipación.
        </li>
        <li>
            Mediante el presente <b>CONTRATO </b>se estipula que <b>EL SOCIO </b>no podrá utilizar <b>EL PASAPORTE</b>
            con sus <b>NOCHES
            HOTELERAS</b> en los días feriados ni días festivos, tampoco para los meses de Diciembre, Enero, Febrero y
            Julio.
        </li>
        <li>
            Se establece que sólo las partes descritas en el presente <b>CONTRATO </b>han intervenido en la negociación
            y por
            tanto que <b>LOS RESORTS</b> y establecimientos en donde funcionan las salas de ventas no están vinculadas
            de
            ninguna manera con el proceso de venta, es así que ante cualquier contratiempo será responsable de la
            solución del mismo <b>LA EMPRESA</b>.
        </li>
        <li>
            EL <b>SOCIO </b>puede recibir mejores ofertas y tendrá que llamar al CENTRO DE SERVICIOS DEL PROGRAMA donde
            se le
            informará y guiará sobre el 100 % de las opciones que estén disponibles en cada momento.
        </li>
        <li>
            <b>EL SOCIO </b>debe de proveer una dirección de email y mantener y notificar cualquier cambio en ella ya
            que en
            esa dirección recibirá, periódicamente, las promociones, ofertas especiales y noticias de descuento que le
            permitirán maximizar los beneficios del producto <b>“RUSTICA CLUB”</b>.
        </li>
        <li>
            <b>LA EMPRESA</b> puede sustituir o añadir cualquier producto, servicio o <b>RESORTS </b> que integran el
            programa <b>“RUSTICA
            CLUB”</b> en cualquier momento, lo que no afecta los derechos de <b>EL SOCIO </b>y sus beneficiarios, ya que
            obtendrá
            mayores beneficios al momento de utilizar el programa <b>“RUSTICA CLUB”</b>.
        </li>
        <li>
            El programa <b>“RUSTICA CLUB”</b> con respecto a la utilización de <b>LAS NOCHES HOTELERAS</b> y demás
            beneficios, están
            sujetos a la disponibilidad de habitaciones.
        </li>
        <li>
            El programa <b>“RUSTICA CLUB”</b> podrá ser utilizado de domingo a jueves, siendo la hora del check in a las
            15:00
            p.m y el check out a las 12:00 horas, siempre y cuando haya disponibilidad en <b>LOS RESORTS</b>. También
            podrá
            usarse de manera excepcional de viernes a domingo, siempre y cuando <b>EL SOCIO </b>pague con dos <b>NOCHES
            HOTELERAS</b>
            por día. En cualquier caso también se podrá usar en otras fechas siempre y cuando cuente con la anuencia de
            <b>LA EMPRESA</b>.
        </li>
        <li>
            Tanto el early check in como el late check out están sujetos a disponibilidad y a cargos adicionales.
        </li>
        <li>
            No se admiten mascotas en <b>LOS RESORTS</b>.
        </li>
        <li>
            <b>EL SOCIO </b>podrá tener acceso al desayuno Bufet que ofrecen <b>LOS RESORTS</b>.
        </li>
        <li>
            <b>EL SOCIO </b>contará con acceso libre a la Discoteca, Karaoke y Restaurant de <b>LOS RESORTS</b> y un
            descuento del 10
            % de consumo en los tres conceptos mencionados.
        </li>
        <li>
            La reservación para hacer uso del producto <b>“RUSTICA CLUB”</b> tendrá que solicitarse con 30 días de
            anticipación.
        </li>
        <li>
    </ul>

    <br>
    <br>
    <br>
    <br>

    <table style='width:100%' class='datos'>
        <tr>
            <th>LA EMPRESA</th>
            <th>EL SOCIO</th>
        </tr>
    </table>

</div>
</body>
</html>
";

$pagina3 = "
<html>
<body>
<div>

    <p class='anexo subrayado'>
        <b>ANEXO N° 01</b>
    </p>

    <p class='documento'>
        <b>Con respecto a las habitaciones: </b>
    </p>

    <ul class='documento'>
        <li>
            <b>RESORTS RUSTICA VICHAYITO</b> .- Las habitaciones tienen capacidad para 2 adultos y 2 niños menores de 12
            años
            de edad. En el caso no asistan los dos niños menores de 12 años, se podrá incluir a un adulto más. Los niños
            mayores de 12 años serán considerados como adultos.
        </li>
        <br>
        <li>
            <b>RESORTS RUSTICA TARAPOTO</b> .- Las habitaciones tienen capacidad para 2 adultos y 2 niños menores de 12
            años
            de edad. En el caso no asistan los dos niños menores de 12 años, se podrá incluir a un adulto más. Los niños
            mayores de 12 años serán considerados como adultos.
        </li>
        <br>
        <li>
            <b>RESORTS RUSTICA SANTA EULALIA</b> .- Las habitaciones tienen capacidad para 2 adultos y 2 niños menores
            de 12
            años de edad. En el caso no asistan los dos niños menores de 12 años, se podrá incluir a un adulto más. Los
            niños mayores de 12 años serán considerados como adultos.
        </li>
        <br>
        <li>
            <b>RESORTS RUSTICA PACHACAMAC</b> .- Las habitaciones tienen capacidad para 2 adultos y un (01) niño menor
            de 12
            años de edad. Los niños mayores de 12 años serán considerados como adultos.
        </li>
        <br>
        <di>
            En el <b>RESORT RUSTICA PACHACAMAC</b>, de manera excepcional y a solicitud <b>EL SOCIO</b> tendrá la opción
            de utilizar la
            Habitación Presidencial, por la cual se descontaran <b>DOS NOCHES HOTELERAS</b>; donde la capacidad será de
            2 adultos y
            4 menores de 12 años de edad. Los niños mayores de 12 años, serán considerados como adultos.
        </di>

        <p class='documento'>
            * Todo esto a disponibilidad y discrecionalidad de <b>LOS RESORTS</b>.
        </p>

    </ul>

</div>
</body>
</html>
";

$pdf = new mPDF('utf-8', array(216, 279));
$Reporte = "Contrato-Comercial.pdf";
$pdf->AddPage();
$pdf->WriteHTML($pagina1);
$pdf->AddPage();
$pdf->WriteHTML($pagina2);
$pdf->AddPage();
$pdf->WriteHTML($pagina3);
$pdf->SetTitle("Contrato Comercial");
$pdf->SetAuthor("Rustica Club");
$pdf->Output($Reporte, 'I');
$pdf->Close();
exit();