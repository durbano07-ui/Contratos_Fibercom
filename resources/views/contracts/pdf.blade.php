{{-- resources/views/contracts/adhesion_contract.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Contrato de Adhesión - SIGNAL INTERNET / FIBERCOM ECUADOR</title>
    <style>
        @page {
            margin: 140px 2cm 80px 2cm;
        }

        body {
            font-family: 'Calibri', 'Helvetica', 'Arial', sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            color: #000;
        }

        header {
            position: fixed;
            top: -100px;
            left: 0px;
            right: 0px;
            height: 80px;
        }

        footer {
            position: fixed;
            bottom: -50px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 9pt;
            text-align: center;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
            margin: 0;
        }

        .header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .footer-content {
            border-top: 1px solid #000;
            padding-top: 5px;
            font-family: 'Calibri', 'Helvetica', 'Arial', sans-serif;
            font-size: 9pt;
            color: #555;
            line-height: 1.2;
        }

        h1,
        h2,
        h3 {
            font-weight: bold;
            margin-top: 1.2em;
            margin-bottom: 0.5em;
        }

        h1 {
            font-size: 16pt;
            text-align: center;
            margin-bottom: 0.8em;
        }

        h2 {
            font-size: 13pt;
        }

        .clause-title {
            font-weight: bold;
            margin-top: 1em;
            margin-bottom: 0.3em;
            font-size: 10.5pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0.8em 0;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 5px 8px;
            vertical-align: middle;
            font-size: 10pt;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        .table-no-border,
        .table-no-border td {
            border: none;
        }

        .table-fillable td {
            height: 28px;
        }

        .input-line {
            line-height: 1.8;
        }

        .signature-table {
            width: 100%;
            border: none;
            margin-top: 60px;
            text-align: center;
        }

        .signature-table td {
            border: none;
            width: 50%;
            padding: 40px 10px 10px;
            vertical-align: bottom;
        }

        .page-break {
            page-break-before: always;
        }

        .text-center {
            text-align: center;
        }

        .underline {
            text-decoration: underline;
        }

        .mark {
            background-color: #f9f2b0;
            padding: 0 2px;
        }

        .checkbox-symbol {
            font-family: monospace;
            white-space: pre;
        }

        .anexo-title {
            font-size: 13pt;
            font-weight: bold;
            text-align: center;
            margin: 1.5em 0 1em;
        }
    </style>
</head>

<body>

    <header>
        <table class="header-table">
            <tr>
                <td style="width: 33%;">
                    <img src="{{ public_path('img/logo_fibercom.png') }}" alt="Fibercom Logo"
                        style="max-height: 55px; width: auto;">
                </td>
                <td
                    style="width: 34%; text-align: center; font-size: 10px; font-family: 'Calibri', 'Helvetica', 'Arial', sans-serif; font-weight: bold; color: #444;">
                    RESOLUCIÓN ARCOTEL 2018-0019<br>
                    RUC: 0201657897001
                </td>
                <td style="width: 33%; text-align: right;">
                    <img src="{{ public_path('img/logo_signal.png') }}" alt="Internet Signal Logo"
                        style="max-height: 60px; width: auto;">
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <div class="footer-content">
            <strong>Dirección:</strong> km 1.8 Vía las Cochas y Pasaje Urbano - Guaranda<br>
            <strong>Telfs:</strong> 033 033680 / 0997852792 / 0990303604<br>
            <strong>Email:</strong> <a href="mailto:ventas@fibercom.ec"
                style="color:blue; text-decoration:underline;">ventas@fibercom.ec</a> &nbsp;&nbsp;&nbsp;&nbsp; <a
                href="http://www.fibercom.ec" style="color:blue; text-decoration:underline;">www.fibercom.ec</a>
        </div>
    </footer>

    <main>

        {{-- CONTRATO PRINCIPAL --}}
        <h1>CONTRATO DE ADHESION</h1>

        @php
            $signatureImg = ($contract->anexo2 && $contract->anexo2->firma_cliente)
                ? $contract->anexo2->firma_cliente
                : null;
        @endphp

        {{-- CLAUSULA PRIMERA --}}
        <div class="clause-title">CLAUSULA PRIMERA. Lugar y fecha. - Guaranda,
            {{ \Carbon\Carbon::parse($contract->fecha)->translatedFormat('d \d\e F \d\e Y') }}
        </div>
        <p><strong>Datos de los Comparecientes:</strong></p>
        <p><strong>Datos del prestador</strong><br>
            Nombre/Razón Social: <strong>LUCIA DEL SOCORRO URBANO URBANO</strong><br>
            Nombre comercial: <strong>SIGNAL INTERNET, FIBERCOM ECUADOR</strong><br>
            Dirección: <strong>Calle Azuay 820 y Salinas -- Guaranda (sector Plaza Roja)</strong><br>
            Provincia: <strong>BOLIVAR</strong> Ciudad: <strong>GUARANDA</strong> Cantón: <strong>GUARANDA</strong><br>
            Parroquia: <strong>GUARANDA</strong> No. Teléfono: <strong>099 0303604</strong><br>
            RUC: <strong>0201657897001</strong> Correo Electrónico: <strong>ventas@fibercom.ec</strong><br>
            Web: <a href="http://www.signal-internet-ec.com"><strong>www.signal-internet-ec.com</strong></a>, <a
                href="https://fibercom.ec"><strong>https://fibercom.ec</strong></a></p>

        <p><strong>Datos del abonado/suscriptor</strong><br>
            Nombres/Razón social: <strong>{{ mb_strtoupper($contract->client->nombre) }}
                {{ mb_strtoupper($contract->client->apellido ?? '') }}</strong><br>
            Cédula/RUC: <strong>{{ $contract->client->cedula }}</strong> Email:
            <strong>{{ strtolower($contract->client->email ?? 'N/A') }}</strong><br>
            Dirección: (Av. Principal No. De casa o lote y calle secundaria)
            <strong>{{ mb_strtoupper($contract->client->direccion ?? 'N/A') }}</strong><br>
            Provincia: <strong>{{ mb_strtoupper($contract->client->provincia ?? 'BOLIVAR') }}</strong> Ciudad:
            <strong>{{ mb_strtoupper($contract->client->ciudad ?? 'GUARANDA') }}</strong> Cantón:
            <strong>{{ mb_strtoupper($contract->client->canton ?? 'GUARANDA') }}</strong> Parroquia:
            <strong>{{ mb_strtoupper($contract->client->parroquia ?? 'GUARANDA') }}</strong><br>
            Dirección donde será prestado el servicio:
            <strong>{{ mb_strtoupper($contract->direccion_servicio ?? $contract->direccion_instalacion ?? $contract->client->direccion) }}</strong><br>
            Número telefónico de referencia fijo/móvil:
            <strong>{{ $contract->client->n_telefono ?? $contract->client->telefono }}</strong><br>
            ¿El abonado es de la tercera edad o discapacitado? Sí <span
                class="checkbox-symbol">{{ $contract->beneficio_ley ? 'X' : '_' }}</span> No <span
                class="checkbox-symbol">{{ !$contract->beneficio_ley ? 'X' : '_' }}</span><br>
            Si el abonado es de la tercera edad o discapacitado, aplica para el descuento del 50% del plan residencial
            escogido.
        </p>

        {{-- CLAUSULA SEGUNDA --}}
        <div class="clause-title">CLAUSULA SEGUNDA. - Objeto:</div>
        <p>El prestador del servicio se compromete a proporcionar al abonado/suscriptor el/los siguiente (s) servicio
            (s), para lo cual el prestador dispone de los correspondientes títulos habilitantes otorgados por la
            ARCOTEL, de conformidad con el ordenamiento jurídico vigente:</p>
        @php
            $services = [
                'Móvil Avanzado (SMA)' => '',
                'Móvil Avanzado a través de Operador Móvil Virtual (OMV)' => '',
                'Telefonía Fija' => '',
                'Telecomunicaciones por Satélite' => '',
                'Valor Agregado' => '',
                'Acceso a internet' => 'X',
                'Troncalizados' => '',
                'Comunales' => '',
                'Audio y video por suscripción' => '',
                'Portador' => ''
            ];
        @endphp
        <table class="table-compact">
            @foreach($services as $service => $mark)
                <tr>
                    <td style="width: 85%;">{{ $service }}</td>
                    <td style="width: 15%; text-align: center;">{{ $mark }}</td>
                </tr>
            @endforeach
        </table>
        <p>Las Condiciones del/los servicio(s) que el abonado va a contratar se encuentran detalladas en el Anexo No.
            1f, el cual forma parte integrante del presente contrato.</p>

        {{-- CLAUSULA TERCERA --}}
        <div class="clause-title">CLAUSULA TERCERA. - Vigencia del Contrato:</div>
        <p>El presente contrato tendrá una duración de 24 meses y entrará en vigencia, a partir de la fecha de
            instalación y prestación efectiva del servicio, La fecha inicial considerada para facturación para cada uno
            de los servicios contratados debe ser la de la activación del servicio.</p>
        <p>El prestador del servicio, previo a la firma o aceptación del contrato, deberá verificar la identidad del
            abonado, cliente, usuario o suscriptor. El prestador debe de indicar los mecanismos de identificación
            disponibles para que el abonado elija, siguiendo la Ley Orgánica de Protección de Datos Personales y la Ley
            Orgánica del Sistema Nacional de Registro de Datos Públicos y sus respectivos reglamentos.</p>
        <p>Las partes se comprometen a respetar el plazo de vigencia pactado, sin perjuicio de que el abonado/suscriptor
            pueda darlo por terminado unilateralmente, en cualquier tiempo, previa notificación física o electrónica,
            con por lo menos quince (15) días de anticipación, conforme lo dispuesto en las Leyes Orgánicas de
            Telecomunicaciones y de Defensa del Consumidor y sin que para ello esté obligado a cancelar multas o
            recargos de valores de ninguna naturaleza.</p>
        <p>El abonado acepta la renovación automática sucesiva del contrato en las mismas condiciones de este contrato,
            independientemente de su derecho a terminar la relación contractual conforme la legislación aplicable, o
            solicitar en cualquier tiempo, con hasta quince (15) días de antelación a la fecha de renovación, su
            decisión de no renovación:<br>
            Si <span class="checkbox-symbol">X</span> No <span class="checkbox-symbol">_</span></p>
        <p>Todas las promociones, servicios adicionales y suplementarios que ofrezca el prestador con carácter gratuito,
            no requerirán autorización y aceptación; la prestación de dichos servicios no debe generar al abonado,
            suscriptor o cliente, obligaciones de retribución de ninguna clase o de permanencia mínima. El abonado,
            suscriptor o cliente podrá solicitar al prestador el cese de dichos servicios, lo cual deberá ser realizado
            por el prestador en un plazo máximo de cinco (5) días a partir del pedido del abonado, suscriptor o cliente,
            sin que, bajo ninguna condición, se exijan o establezcan requisitos de ninguna índole, ni valores o pagos
            asociados a dicho cese.</p>

        {{-- CLAUSULA CUARTA --}}
        <div class="clause-title">CLAUSULA CUARTA. - Suspensión del Servicio. -</div>
        <p>Los servicios contratados podrán ser suspendidos debido a las siguientes causas: a) Por falta de pago del
            abonado; b) Caso fortuito o fuerza mayor que obliguen a la suspensión del servicio, calificada por la
            ARCOTEL, en este caso sólo se podrá cobrar por los servicios efectivamente prestados; c) Por uso indebido de
            los servicios contratados o uso ilegal de los mismos; d) Por mandato judicial; y e) Por otras causas
            previstas en el ordenamiento vigente.</p>
        <p>La falta de pago a la que se refiere la letra a), aplicará al día siguiente de cumplida la fecha máxima de
            pago, la cual estará detallada en la factura emitida, no se considerarán valores impagos los valores que se
            encuentren bajo un proceso de reclamación ante el prestador. Durante la suspensión de los servicios
            contratados, se cobrarán únicamente los servicios efectivamente prestados y aquellos que se justifiquen y no
            atente contra la Ley Orgánica de Defensa del Consumidor y Títulos habilitantes para la prestación del
            servicio.</p>

        {{-- CLAUSULA QUINTA --}}
        <div class="clause-title">CLAUSULA QUINTA. - Terminación del contrato. -</div>
        <p>Los contratos podrán darse por terminado por cualquiera de las siguientes causas: <strong>Por el prestador
                del Servicio:</strong> a) Incumplimiento de las condiciones contractuales del abonado, o la consignación
            de datos erróneos o falsos, b) Si el abonado o cliente utiliza los servicios contratados para fines
            distintos a los convenidos o si los utiliza en prácticas contrarias a la ley, c) Por vencimiento del plazo
            de vigencia del contrato, cuando no exista renovación, d) Por falta de pago, e) Por las demás causas
            previstas en el Ordenamiento Jurídico Vigente.</p>
        <p><strong>Por abonado o cliente</strong>: a) Por decisión unilateral del abonado, suscriptor o cliente de dar
            por terminado el contrato. b) Por vencimiento del plazo de vigencia del contrato, cuando no exista
            renovación pactada. c) Por incumplimiento de las condiciones contractuales pactadas. d) Por las demás causas
            previstas en el Ordenamiento Jurídico Vigente.</p>
        <p>El no cancelar los saldos que estuvieron pendientes al momento de la presentación de la solicitud de
            terminación no podrá ser considerado como un impedimento para procesar y cancelar el contrato. Esto no
            significa que el prestador haya renunciado al cobro de dichos valores ya que los podrá cobrar en la forma y
            plazos establecidos en el ordenamiento jurídico a través de los medios legales correspondientes.</p>
        <p>Los abonados, clientes o suscriptores podrán ejercer su derecho de devolución o cambio del servicio dentro
            del término de quince (15) días posteriores a la activación del servicio, sin la necesidad de presentar
            requisitos adicionales, conforme al ordenamiento jurídico vigente. La devolución del servicio implicará la
            cesación inmediata del contrato de provisión del mismo. El cambio de servicio se efectuará a través de la
            modificación total o parcial de las condiciones de prestación previamente pactadas.</p>
        <p>El prestador del servicio no podrá cobrar ningún valor por instalación cuando la solicitud de devolución se
            deba a problemas técnicos o el incumplimiento de una o varias de las condiciones contractuales por parte del
            prestador, comprobados por este en el término de hasta cinco (5) días después de presentada la solicitud. En
            tales casos, los abonados, suscriptores o clientes deberán detallar expresamente los problemas técnicos o
            incumplimientos aducidos, ya sea por medio físico, electrónico o telefónico.</p>

        {{-- CLAUSULA SEXTA --}}
        <div class="clause-title">CLAUSULA SEXTA. - Permanencia mínima:</div>
        <p>¿El abonado se acoge al período de permanencia mínima de 24 meses en la prestación del servicio
            contratado?<br>
            Si <span class="checkbox-symbol">X</span> No <span class="checkbox-symbol">_</span></p>
        <p>Los beneficios de la permanencia mínima son:<br>
            <strong>No pago por el costo de instalación del servicio si cumple el tiempo, caso contrario cancelara un
                proporcional del costo de instalación.</strong>
        </p>
        <p>La permanencia mínima se acuerda, sin perjuicio de que el abonado/suscriptor conforme lo determina la Ley
            Orgánica de Telecomunicaciones, puede dar por terminado el contrato en forma unilateral y anticipada, y en
            cualquier tiempo previa notificación por medios físicos, telefónicos o electrónicos al prestador, con por lo
            menos quince (15) días calendario de anticipación, El contrato terminará quince (15) días calendario
            posteriores a la fecha de presentación de la solicitud.</p>

        {{-- CLAUSULA SEPTIMA --}}
        <div class="clause-title">CLAUSULA SEPTIMA. - Tarifa y forma de pago;</div>
        <p>Las tarifas o valores mensuales a ser cancelados por cada uno de los servicios contratados por el abonado
            estará determinada en la ficha de cada servicio, que constan en el Anexo 1f.... y el pago se realizará, de
            la siguiente forma:</p>
        <table class="table-compact">
            <tr>
                <th>Forma de pago</th>
                <th style="width:15%">SI</th>
                <th style="width:15%">NO</th>
            </tr>
            <tr>
                <td>- Pago directo en cajas del prestador del servicio</td>
                <td class="text-center">
                    {{ ($contract->payment == 'direct' || $contract->metodo_pago == 'direct') ? 'X' : '' }}
                </td>
                <td></td>
            </tr>
            <tr>
                <td>- Débito automático cuenta de ahorro o corriente</td>
                <td class="text-center">
                    {{ ($contract->payment == 'auto' || $contract->metodo_pago == 'auto') ? 'X' : '' }}
                </td>
                <td></td>
            </tr>
            <tr>
                <td>- Pago en ventanilla de locales autorizados</td>
                <td class="text-center">
                    {{ ($contract->payment == 'window' || $contract->metodo_pago == 'window') ? 'X' : '' }}
                </td>
                <td></td>
            </tr>
            <tr>
                <td>- Débito con tarjeta de crédito</td>
                <td class="text-center">
                    {{ ($contract->payment == 'card' || $contract->metodo_pago == 'card') ? 'X' : '' }}
                </td>
                <td></td>
            </tr>
            <tr>
                <td>- Transferencia vía medios electrónicos</td>
                <td class="text-center">
                    {{ ($contract->payment == 'transfer' || $contract->metodo_pago == 'transfer') ? 'X' : '' }}
                </td>
                <td></td>
            </tr>
        </table>
        <p>La tarifa correspondiente al servicio contratado y efectivamente prestado estará dentro de los techos
            tarifarios señalados por la ARCOTEL y en los títulos habilitantes correspondientes, en caso de que se
            establezcan, de conformidad con el ordenamiento jurídico vigente.</p>
        <p>En caso de que el abonado o suscriptor desee cambiar su modalidad de pago a otra de las disponibles, deberá
            comunicar al prestador del servicio con quince (15) días de anticipación. El prestador del servicio, luego
            de haber sido comunicado, instrumentará la nueva forma de pago.</p>

        {{-- CLAUSULA OCTAVA --}}
        <div class="clause-title">CLAUSULA OCTAVA.- Compra, Arrendamiento de Equipos:</div>
        <p>(Cuando sea procedente el arrendamiento o adquisición de equipos, por parte del abonado, toda la información
            pertinente será detallada en un <strong>Anexo adicional</strong>, suscrito por el abonado el cual contendrá
            los temas relacionados a las condiciones de los equipos adquiridos/arrendados, entre otras características
            se deberá incluir: cantidad, precio, marca, estado, y las condiciones de tal adquisición o arrendamiento,
            particularmente el tiempo en el que se pagará el arrendamiento o la compra del equipo, el valor mensual a
            cancelar o las condiciones de pago).</p>

        {{-- CLAUSULA NOVENA --}}
        <div class="clause-title">CLAUSULA NOVENA.- Uso de información personal:</div>
        <p>Los datos personales que los usuarios proporcionen a los prestadores de servicios del régimen general de
            telecomunicaciones, no podrán ser usados para la promoción comercial de servicios o productos, inclusive de
            la propia operadora; salvo autorización y consentimiento expreso del abonado/suscriptor, el que constará
            como instrumento separado y distinto al presente contrato de prestación de servicios (contrato de adhesión)
            a través de medios físicos o electrónicos. En dicho instrumento se deberá dejar constancia expresa de los
            datos personales o información que están expresamente autorizadas; el plazo de la autorización y el objetivo
            que esta utilización persigue, conforme lo dispuesto en el artículo 121 del Reglamento General a la Ley
            Orgánica de Telecomunicaciones, Ley Orgánica de Protección de Datos Personales, su Reglamento General y las
            directrices emitidas por la Autoridad de Protección de Datos.</p>

        {{-- CLAUSULA DECIMA --}}
        <div class="clause-title">CLAUSULA DECIMA. - Reclamos y soporte técnico:</div>
        <p>El "ABONADO/SUSCRIPTOR" podrá requerir soporte técnico o presentar reclamos al prestador de servicios a
            través de los siguientes medios o puntos:</p>
        <p>- Medio electrónico: ventas@fibercom.ec, info@fibercom.ec<br>
            - Oficinas de atención a usuarios:<br>
            . Guaranda: Calle Azuay 820 y Salinas -- Guaranda (sector Plaza Roja)<br>
            . San Miguel de Bolívar: Av. Circunvalación y Regulo de Mora (frente a la coop. transporte Atenas)<br>
            . Guanujo: Km 1.8 Vía Las Cochas - Guaranda<br>
            - Horarios de atención oficinas: lunes a viernes (de 8:00 a 17:00) y sábados de 9:00 am a 13:00<br>
            - Teléfono: 033033680 -- 0990303604</p>
        <p>En el caso en que su queja, reclamo o solicitud no hayan sido resueltos por el prestador del servicio, en
            relación a la calidad del servicio prestado, a errores de facturación de los servicios, facturación de
            servicios no contratados, cobros indebidos, o en general por cualquier irregularidad que se hubiere
            producido en relación con el servicio contratado, los abonados, clientes o suscriptores podrán presentar las
            mismas a través de cualquiera de los siguientes canales de atención:</p>
        <p>Plataforma GOB.EC<br>
            ARCOTEL<br>
            a) Atención Presencial (Oficinas de la ARCOTEL).<br>
            b) PBX-Directo Matriz, Coordinaciones Zonales y Oficinas Técnicas.<br>
            c) Call Center (llamadas gratuitas al número 1800-567567 o número que designe la ARCOTEL).<br>
            d) Correo Tradicional (oficios), o;<br>
            e) Cualquier otro medio tecnológico o aplicativo que la ARCOTEL ponga a disposición</p>

        {{-- CLAUSULA DECIMA PRIMERA --}}
        <div class="clause-title">CLAUSULA DECIMA PRIMERA. - Normativa Aplicable:</div>
        <p>En la prestación del servicio, se entienden incluidos todos los derechos y obligaciones de los
            abonados/suscriptores, establecidos en las normas jurídicas aplicables, así como también los derechos y
            obligaciones de los prestadores de servicios de telecomunicaciones y/o servicios de radiodifusión por
            suscripción, dispuestos en el marco regulatorio.</p>

        {{-- CLAUSULA DECIMA SEGUNDA --}}
        <div class="clause-title">CLAUSULA DECIMA SEGUNDA. - Controversias:</div>
        <p>Las diferencias que surjan de la ejecución del presente Contrato, podrán ser resueltas por mutuo acuerdo
            entre las partes, sin perjuicio de que el abonado o suscriptor acuda con su reclamo, queja o denuncia, ante
            las autoridades administrativas que correspondan. De no llegarse a una solución, cualquiera de las partes
            podrá acudir ante los jueces competentes.</p>
        <p>No obstante, lo indicado, las partes pueden pactar adicionalmente, someter sus controversias ante un centro
            de mediación o arbitraje, si así lo deciden expresamente, en cuyo caso el abonado/suscriptor deberá
            señalarlo en forma expresa.</p>
        <p>El abonado, en caso de conflicto, acepta someterse a la mediación o arbitraje (puede significar costos en los
            que debe incurrir el abonado/suscriptor - No aplica a Empresas Públicas prestadoras de servicios de
            telecomunicaciones).<br>
            SI__X___ NO______</p>
        <p>Firma de aceptación-sujeción a arbitraje:</p>
        <p style="margin-top: 10px;">
            @if($signatureImg)
                <img src="{{ $signatureImg }}" style="max-height: 50px; width: auto; margin-bottom: -15px;"><br>
            @endif
            _________________________
        </p>

        {{-- CLAUSULA DECIMA TERCERA --}}
        <div class="clause-title">CLAUSULA DECIMA TERCERA. - Anexos:</div>
        <p>Es parte integrante del presente contrato el Anexo 1f "SERVICIO DE ACCESO A INTERNET", Anexo 2 "ARRENDAMIENTO
            O COMPRA DE EQUIPOS", Anexo 3 "ACTA DE INSTALACION Y ACTIVACION ", Anexo 4 "FORMA DE PAGO", así como los
            demás anexos y documentos que se incorporen de conformidad con el ordenamiento jurídico.</p>

        {{-- CLAUSULA DECIMA CUARTA --}}
        <div class="clause-title">CLAUSULA DECIMA CUARTA. - Notificaciones y Domicilio:</div>
        <p>Las notificaciones que corresponda, serán entregadas en el domicilio de cada una de las partes señalado en la
            cláusula primera del presente contrato. Cualquier cambio de domicilio debe ser comunicado por escrito a la
            otra parte en un plazo de 10 días, a partir del día siguiente en que el cambio se efectúe.</p>

        {{-- CLAUSULA DECIMA QUINTA --}}
        <div class="clause-title">CLAUSULA DECIMA QUINTA. - Empaquetamiento de servicios:</div>
        <p class="input-line">La contratación incluye empaquetamiento de servicios: Si <span class="checkbox-symbol">_</span> No <span class="checkbox-symbol">X</span></p>
        <p class="input-line">Especificar los servicios del paquete y los beneficios para cada uno, incluyendo las
            tarifas aplicables:
            ..................................................................................................................
        </p>

        <p>El abonado acepta el presente contrato con sus términos y condiciones y demás documentos anexos para lo cual
            deja constancia de lo anterior y firman junto con <span class="mark">(FIBERCOM ECUADOR)</span> en tres
            ejemplares del mismo tenor, en la ciudad de
            <strong>{{ mb_strtoupper($contract->client->ciudad ?? 'GUARANDA') }}</strong> a los
            <strong>{{ \Carbon\Carbon::parse($contract->fecha)->format('d') }}</strong> días del mes de
            <strong>{{ \Carbon\Carbon::parse($contract->fecha)->translatedFormat('F') }}</strong> del año
            <strong>{{ \Carbon\Carbon::parse($contract->fecha)->format('Y') }}</strong>.
        </p>
        <p>La fecha de inscripción del modelo de contrato de adhesión que se utiliza es el <strong>20</strong> de
            <strong>Mayo</strong> de <strong>2020</strong>.
        </p>

        <table class="signature-table">
            <tr>
                <td>
                    @if($signatureImg)
                        <img src="{{ $signatureImg }}" style="max-height: 80px; width: auto; margin-bottom: -20px;"><br>
                    @endif
                    _________________________<br>
                    <strong>{{ mb_strtoupper($contract->client->nombre) }}
                        {{ mb_strtoupper($contract->client->apellido ?? '') }}</strong><br>
                    <strong>C.I. {{ $contract->client->cedula }}</strong><br>
                    <strong>ABONADO/SUSCRIPTOR</strong>
                </td>
                <td>
                    _________________________<br>
                    <strong>LUCIA DEL SOCORRO URBANO URBANO</strong><br>
                    <strong>PRESTADOR</strong>
                </td>
            </tr>
        </table>

        {{-- ANEXO 1f --}}
        <div class="page-break"></div>
        <div class="anexo-title">ANEXO 1f</div>
        <p><strong>Nombre del Plan: SERVICIO DE ACCESO A INTERNET
                ({{ mb_strtoupper($contract->plan->nombre_plan ?? 'PLAN ELEGIDO') }})</strong></p>
        <p>FECHA: <strong>{{ \Carbon\Carbon::parse($contract->fecha)->format('d') }}</strong> de
            <strong>{{ \Carbon\Carbon::parse($contract->fecha)->translatedFormat('F') }}</strong> del
            <strong>{{ \Carbon\Carbon::parse($contract->fecha)->format('Y') }}</strong>
        </p>

        <p><strong>Red de Acceso:</strong></p>
        <table class="table-compact">
            <tr>
                <td>Par de cobre</td>
                <td></td>
            </tr>
            <tr>
                <td>Coaxial</td>
                <td></td>
            </tr>
            <tr>
                <td>Otros</td>
                <td></td>
            </tr>
            <tr>
                <td>Fibra Óptica</td>
                <td class="text-center">X</td>
            </tr>
            <tr>
                <td>Inalámbrico</td>
                <td></td>
            </tr>
        </table>

        <p><strong>Tipo de Cuenta:</strong></p>
        <table class="table-compact">
            <tr>
                <td>Residencial</td>
                <td class="text-center">
                    {{ str_contains(strtolower($contract->plan->nombre_plan ?? ''), 'residencial') ? 'X' : '' }}
                </td>
            </tr>
            <tr>
                <td>Cibercafé</td>
                <td></td>
            </tr>
            <tr>
                <td>Corporativo</td>
                <td class="text-center">
                    {{ str_contains(strtolower($contract->plan->nombre_plan ?? ''), 'corporativo') ? 'X' : '' }}
                </td>
            </tr>
            <tr>
                <td>Otros tipos</td>
                <td></td>
            </tr>
        </table>

        <p><strong>Velocidad (Mb) (si existe velocidad máxima para acceso a internet en servidores internacionales y a
                través del NAP local, se debe especificar local, se debe especificar):</strong></p>
        <p><strong>{{ $contract->plan->velocidad ?? '8' }}:{{ ((int) ($contract->plan->velocidad ?? 8)) / 2 }}</strong>
        </p>
        <table>
            <tr>
                <td>Comercial de bajada</td>
                <td>{{ $contract->plan->velocidad ?? '0' }} Mbps</td>
            </tr>
            <tr>
                <td>Mínima efectiva de bajada</td>
                <td>{{ ((int) ($contract->plan->velocidad ?? 0)) * 0.4 }} Mbps</td>
            </tr>
        </table>
        <p><strong>2:1</strong></p>
        <p><strong>Nivel de Compartición (1:1,2:1,4:1,8:4)</strong></p>
        <p><strong>El contrato incluye permanencia mínima:</strong> SI <span class="checkbox-symbol">X</span> NO <span
                class="checkbox-symbol">_</span> TIEMPO: <strong>24 MESES</strong></p>
        <p><strong>Beneficios por permanencia mínima:</strong> <strong>Exoneración del cargo por instalación (Sin
                Costo)</strong></p>
        <p><strong>SERVICIOS ADICIONALES QUE SE OFRECE:</strong></p>
        <table>
            <tr>
                <th>Servicio</th>
                <th>SI</th>
                <th>NO</th>
                <th>Descripción</th>
            </tr>
            <tr>
                <td>Cuentas de correo electrónico</td>
                <td class="text-center"></td>
                <td class="text-center">X</td>
                <td>No. Cuentas, capacidad en el servidor por cuenta (MB)</td>
            </tr>
            <tr>
                <td>Otros Servicios</td>
                <td class="text-center"></td>
                <td class="text-center">X</td>
                <td></td>
            </tr>
        </table>

        <p><strong>Tarifas (*):</strong></p>
        <p><strong>Valores a pagar por una sola vez:</strong></p>
        <table>
            <tr>
                <td>Valor Instalación</td>
                <td>$0.00 USD (Exento por Contrato)</td>
            </tr>
            <tr>
                <td>Plazo para instalar/ activar el servicio (horas, días)</td>
                <td></td>
            </tr>
        </table>
        @php
            $precioTotal  = (float) ($contract->plan->precio ?? 0);
            $subtotalSinIva = $precioTotal / 1.15;
            $ivaValue     = $precioTotal - $subtotalSinIva;
        @endphp
        <p><strong>Valores pago Mensual:</strong></p>
        <table>
            <tr>
                <td>Valor mensual plan (Sin Impuestos)</td>
                <td><strong>${{ number_format($subtotalSinIva, 2) }} USD</strong></td>
            </tr>
            <tr>
                <td>Impuestos SRI (IVA 15%)</td>
                <td><strong>${{ number_format($ivaValue, 2) }} USD</strong></td>
            </tr>
            <tr>
                <td>Valor total a cancelar</td>
                <td><strong>${{ number_format($precioTotal, 2) }} USD</strong></td>
            </tr>
        </table>
        <p><strong>Detalles otros valores:</strong> ________________________________________________________________</p>
        <p><strong>Sitio web para consultas de tarifas:</strong> <a
                href="http://www.signal-internet-ec.com">www.signal-internet-ec.com</a>, <a
                href="https://fibercom.ec">https://fibercom.ec</a><br>
            <strong>Sitio web consulta de calidad del servicio:</strong> <a
                href="http://www.signal-internet-ec.com">www.signal-internet-ec.com</a>, <a
                href="https://fibercom.ec">https://fibercom.ec</a>
        </p>
        <p><strong>Notas:</strong> * Las tarifas no incluyen impuestos de ley</p>
        <p><strong>Autorización expresa de las partes:</strong></p>
        <table class="signature-table">
            <tr>
                <td>
                    @if($signatureImg)
                        <img src="{{ $signatureImg }}" style="max-height: 80px; width: auto; margin-bottom: -20px;"><br>
                    @endif
                    _________________________<br><strong>{{ mb_strtoupper($contract->client->nombre) }}
                        {{ mb_strtoupper($contract->client->apellido ?? '') }}</strong><br>C.I.
                    {{ $contract->client->cedula }}<br>ABONADO/SUSCRIPTOR
                </td>
                <td>_________________________<br><strong>LUCIA DEL SOCORRO URBANO URBANO</strong><br><strong>PRESTADOR</strong></td>
            </tr>
        </table>

        {{-- ANEXO 2 --}}
        <div class="page-break"></div>
        <div class="anexo-title">ANEXO 2</div>
        <p><strong>ARRENDAMIENTO O COMPRA DE EQUIPOS</strong></p>
        <p><strong>DETALLE Y CONDICIONES DE EQUIPOS:</strong></p>
        <table class="table-fillable">
            <tr>
                <th style="width: 10%;">CANTIDAD</th>
                <th style="width: 15%;">PRECIO UNIT.</th>
                <th style="width: 20%;">MARCA</th>
                <th style="width: 20%;">MODELO</th>
                <th style="width: 20%;">SERIAL</th>
                <th style="width: 15%;">NUEVO/USADO</th>
            </tr>
            @if($contract->anexo2 && is_array($contract->anexo2->equipos))
                @foreach($contract->anexo2->equipos as $equipo)
                    <tr>
                        <td class="text-center">{{ $equipo['cantidad'] ?? '' }}</td>
                        <td class="text-center">
                            {{ isset($equipo['precio_unitario']) ? '$' . number_format($equipo['precio_unitario'], 2) : '' }}
                        </td>
                        <td>{{ mb_strtoupper($equipo['marca'] ?? '') }}</td>
                        <td>{{ mb_strtoupper($equipo['modelo'] ?? '') }}</td>
                        <td>{{ mb_strtoupper($equipo['serial'] ?? '') }}</td>
                        <td class="text-center">{{ mb_strtoupper($equipo['estado_equipo'] ?? '') }}</td>
                    </tr>
                @endforeach
                {{-- Fill remaining rows to reach a minimum of 2 for layout consistency --}}
                @for($i = count($contract->anexo2->equipos); $i < 2; $i++)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endfor
            @else
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
        </table>

        <table class="table-compact">
            <tr>
                <td style="width: 70%;">CLIENTE NOS COMPRA EQUIPOS A CREDITO</td>
                <td style="width: 15%; text-align: center;">SI:
                    {{ ($contract->anexo2 && $contract->anexo2->compra_credito) ? 'X' : '' }}
                </td>
                <td style="width: 15%; text-align: center;">NO:
                    {{ ($contract->anexo2 && !$contract->anexo2->compra_credito) ? 'X' : '' }}
                </td>
            </tr>
            <tr>
                <td>CLIENTE NOS ARRIENDA EQUIPOS</td>
                <td style="text-align: center;">SI:
                    {{ ($contract->anexo2 && $contract->anexo2->arrendamiento) ? 'X' : '' }}
                </td>
                <td style="text-align: center;">NO:
                    {{ ($contract->anexo2 && !$contract->anexo2->arrendamiento) ? 'X' : '' }}
                </td>
            </tr>
            <tr>
                <td>CLIENTE NOS COMPRA EQUIPOS DE CONTADO:</td>
                <td style="text-align: center;">SI:
                    {{ ($contract->anexo2 && $contract->anexo2->compra_contado) ? 'X' : '' }}
                </td>
                <td style="text-align: center;">NO:
                    {{ ($contract->anexo2 && !$contract->anexo2->compra_contado) ? 'X' : '' }}
                </td>
            </tr>
        </table>

        <table class="table-fillable">
            <tr>
                <th style="width: 33%;">VALOR MENSUAL POR ARRENDAMIENTO</th>
                <th style="width: 33%;">VALOR MENSUAL POR COMPRA A CREDITO</th>
                <th style="width: 34%;">CANTIDAD DE MESES POR COBRAR</th>
            </tr>
            <tr>
                <td class="text-center">
                    {{ ($contract->anexo2 && $contract->anexo2->valor_mensual_arrendamiento > 0) ? '$' . number_format($contract->anexo2->valor_mensual_arrendamiento, 2) : '' }}
                </td>
                <td class="text-center">
                    {{ ($contract->anexo2 && $contract->anexo2->valor_mensual_compra_credito > 0) ? '$' . number_format($contract->anexo2->valor_mensual_compra_credito, 2) : '' }}
                </td>
                <td class="text-center">
                    {{ ($contract->anexo2 && $contract->anexo2->cantidad_meses) ? $contract->anexo2->cantidad_meses . ' MESES' : '' }}
                </td>
            </tr>
        </table>
        <p><strong>Autorización expresa de las partes:</strong></p>
        <table class="signature-table">
            <tr>
                <td>
                    @if($signatureImg)
                        <img src="{{ $signatureImg }}" style="max-height: 80px; width: auto; margin-bottom: -20px;"><br>
                    @endif
                    _________________________<br><strong>{{ mb_strtoupper($contract->client->nombre) }}
                        {{ mb_strtoupper($contract->client->apellido ?? '') }}</strong><br>C.I.
                    {{ $contract->client->cedula }}<br>ABONADO/SUSCRIPTOR
                </td>
                <td>_________________________<br><strong>LUCIA DEL SOCORRO URBANO URBANO</strong><br><strong>PRESTADOR</strong></td>
            </tr>
        </table>

        {{-- ANEXO 3 --}}
        <div class="page-break"></div>
        <div class="anexo-title">ANEXO 3</div>
        <p><strong>ACTA DE INSTALACION Y ACTIVACION</strong></p>
        <p class="input-line">Fecha y hora de instalación: <strong>{{ \Carbon\Carbon::parse($contract->anexo2->completado_en ?? $contract->fecha)->translatedFormat('d \d\e F \d\e Y') }} {{ \Carbon\Carbon::parse($contract->anexo2->completado_en ?? $contract->hora_creacion)->format('H:i') }}</strong><br>
            Lugar de la instalación: <strong>{{ mb_strtoupper($contract->direccion_servicio ?? $contract->direccion_instalacion ?? $contract->client->direccion) }}</strong><br>
            IP asignada al cliente: <strong>{{ $contract->anexo2->datos_anexo3['ip_asignada'] ?? '__________________________________' }}</strong></p>

        <table class="table-fillable">
            <tr>
                <td>Cliente verificó ancho de banda instalado</td>
                <td style="width: 10%; text-align: center;">{{ ($contract->anexo2 && isset($contract->anexo2->datos_anexo3['verifico_ancho_banda'])) ? 'SI' : '' }}</td>
                <td style="width: 10%; text-align: center;">{{ ($contract->anexo2 && !isset($contract->anexo2->datos_anexo3['verifico_ancho_banda'])) ? 'NO' : '' }}</td>
            </tr>
        </table>

        <p class="input-line">Características de la computadora del cliente: <strong>{{ $contract->anexo2->datos_anexo3['caracteristicas_pc'] ?? '__________________________________' }}</strong><br>
            ______________________________________________________________________________</p>
        <table class="table-compact">
            <tr>
                <td>Cliente tiene puesta a tierra</td>
                <td style="width: 10%; text-align: center;">{{ ($contract->anexo2 && isset($contract->anexo2->datos_anexo3['puesta_a_tierra'])) ? 'SI' : '' }}</td>
                <td style="width: 10%; text-align: center;">{{ ($contract->anexo2 && !isset($contract->anexo2->datos_anexo3['puesta_a_tierra'])) ? 'NO' : '' }}</td>
            </tr>
        </table>

        <table class="table-fillable">
            <tr>
                <td>Cliente pide bloqueo de páginas web</td>
                <td style="width: 5%; text-align: center;">{{ ($contract->anexo2 && ($contract->anexo2->datos_anexo3['bloqueo_web'] ?? '') != 'No') ? 'SI' : 'NO' }}</td>
                <td style="width: 5%;"></td>
                <td style="width: 40%;">DETALLE: <strong>{{ $contract->anexo2->datos_anexo3['bloqueo_web'] ?? '' }}</strong></td>
            </tr>
            <tr>
                <td>Cliente pide bloqueo de servicios</td>
                <td style="text-align: center;">{{ ($contract->anexo2 && ($contract->anexo2->datos_anexo3['bloqueo_servicios'] ?? '') != 'No') ? 'SI' : 'NO' }}</td>
                <td></td>
                <td>DETALLE: <strong>{{ $contract->anexo2->datos_anexo3['bloqueo_servicios'] ?? '' }}</strong></td>
            </tr>
            <tr>
                <td>Cliente pide bloqueo de puertos</td>
                <td style="text-align: center;">{{ ($contract->anexo2 && ($contract->anexo2->datos_anexo3['bloqueo_puertos'] ?? '') != 'No') ? 'SI' : 'NO' }}</td>
                <td></td>
                <td>DETALLE: <strong>{{ $contract->anexo2->datos_anexo3['bloqueo_puertos'] ?? '' }}</strong></td>
            </tr>
            <tr>
                <td colspan="3" style="height: 60px;">DETALLE DE MATERIAL UTILIZADO PARA INSTALACION POR PARTE DE
                    PRESTADOR</td>
                <td><strong>{{ $contract->anexo2->datos_anexo3['material_utilizado'] ?? '' }}</strong></td>
            </tr>
        </table>
        <p><strong>Autorización expresa de las partes:</strong></p>
        <table class="signature-table">
            <tr>
                <td>
                    @if($signatureImg)
                        <img src="{{ $signatureImg }}" style="max-height: 80px; width: auto; margin-bottom: -20px;"><br>
                    @endif
                    _________________________<br><strong>{{ mb_strtoupper($contract->client->nombre) }}
                        {{ mb_strtoupper($contract->client->apellido ?? '') }}</strong><br>C.I.
                    {{ $contract->client->cedula }}<br>ABONADO/SUSCRIPTOR
                </td>
                <td>_________________________<br><strong>LUCIA DEL SOCORRO URBANO URBANO</strong><br><strong>PRESTADOR</strong></td>
            </tr>
        </table>

        {{-- ANEXO 4 --}}
        <div class="page-break"></div>
        <div class="anexo-title">ANEXO 4</div>
        <p><strong>FORMA DE PAGO</strong></p>
        <table class="table-compact">
            <tr>
                <td>Pago directo en oficina de Prestador</td>
                <td style="width: 15%; text-align: center;">SI: {{ ($contract->payment == 'direct' || $contract->metodo_pago == 'direct' || $contract->payment == 'window' || $contract->metodo_pago == 'window') ? 'X' : '' }}</td>
                <td style="width: 15%; text-align: center;">NO: {{ !($contract->payment == 'direct' || $contract->metodo_pago == 'direct' || $contract->payment == 'window' || $contract->metodo_pago == 'window') ? 'X' : '' }}</td>
            </tr>
            <tr>
                <td>Deposito o transferencia a la cuenta bancaria del Prestador</td>
                <td style="width: 15%; text-align: center;">SI: {{ ($contract->payment == 'transfer' || $contract->metodo_pago == 'transfer') ? 'X' : '' }}</td>
                <td style="width: 15%; text-align: center;">NO: {{ !($contract->payment == 'transfer' || $contract->metodo_pago == 'transfer') ? 'X' : '' }}</td>
            </tr>
            <tr>
                <td>Débito automático a la cuenta bancaria del Abonado</td>
                <td style="width: 15%; text-align: center;">SI: {{ ($contract->payment == 'auto' || $contract->metodo_pago == 'auto') ? 'X' : '' }}</td>
                <td style="width: 15%; text-align: center;">NO: {{ !($contract->payment == 'auto' || $contract->metodo_pago == 'auto') ? 'X' : '' }}</td>
            </tr>
            <tr>
                <td>Débito automático a la tarjeta de crédito del Abonado</td>
                <td style="width: 15%; text-align: center;">SI: {{ ($contract->payment == 'card' || $contract->metodo_pago == 'card') ? 'X' : '' }}</td>
                <td style="width: 15%; text-align: center;">NO: {{ !($contract->payment == 'card' || $contract->metodo_pago == 'card') ? 'X' : '' }}</td>
            </tr>
        </table>
        <p>Para efecto de depósito o transferencia a la cuenta bancaria del Prestador, se detalla la información de
            esta:<br>
            BANCO: ____________ TIPO DE CUENTA: ____________ NÚMERO DE CUENTA: ____________ NOMBRE DE PRESTADOR: LUCIA
            DEL SOCORRO URBANO URBANO NO. DE RUC: 0201657897001, se enviará foto del depósito o transferencia al número
            celular de contacto del Prestador No. ____________, se enviará factura al correo electrónico del Abonado:
            <strong>{{ strtolower($contract->client->email ?? '') }}</strong>
        </p>
        <p>Para efecto de débito automático a la cuenta bancaria del Abonado, se detalla la información de la misma:
            BANCO: ____________ TIPO DE CUENTA: ____________ NÚMERO DE CUENTA: ____________ NOMBRE DE ABONADO:
            <strong>{{ mb_strtoupper($contract->client->nombre) }}
                {{ mb_strtoupper($contract->client->apellido ?? '') }}</strong>, NO. DE IDENTIFICACION:
            <strong>{{ $contract->client->cedula }}</strong>, se enviará factura al correo electrónico del Abonado:
            <strong>{{ strtolower($contract->client->email ?? '') }}</strong>
        </p>
        <p>Para efecto de débito automático a la tarjeta de crédito del Abonado, se detalla la información de la misma:
            BANCO EMISOR: ____________ NOMBRE DE LA TARJETA: ____________ NÚMERO DE TARJETA: ____________ NÚMERO DE
            CÓDIGO: ____________ NOMBRE DE ABONADO: <strong>{{ mb_strtoupper($contract->client->nombre) }}
                {{ mb_strtoupper($contract->client->apellido ?? '') }}</strong> NO. DE IDENTIFICACION:
            <strong>{{ $contract->client->cedula }}</strong>, se enviará factura al correo electrónico del Abonado:
            <strong>{{ strtolower($contract->client->email ?? '') }}</strong>
        </p>
        <p><strong>Autorización expresa de las partes:</strong></p>
        <table class="signature-table">
            <tr>
                <td>
                    @if($signatureImg)
                        <img src="{{ $signatureImg }}" style="max-height: 80px; width: auto; margin-bottom: -20px;"><br>
                    @endif
                    _________________________<br><strong>{{ mb_strtoupper($contract->client->nombre) }}
                        {{ mb_strtoupper($contract->client->apellido ?? '') }}</strong><br>C.I.
                    {{ $contract->client->cedula }}<br>ABONADO/SUSCRIPTOR
                </td>
                <td>_________________________<br><strong>LUCIA DEL SOCORRO URBANO URBANO</strong><br><strong>PRESTADOR</strong></td>
            </tr>
        </table>

        {{-- ANEXO 5 --}}
        <div class="page-break"></div>
        <div class="anexo-title">ANEXO 5</div>
        <p><strong>Autorización expresa de uso de información personal</strong></p>
        <p>El abonado/suscriptor por medio de este anexo, deja en constancia que autoriza al Prestador, basado en el
            Artículo 121 del Reglamento General a Ley Orgánica de Telecomunicaciones, y en la Ley Orgánica de Protección
            de Datos Personales, su Reglamento General y las directrices emitidas por la Autoridad de Protección de
            Datos, al uso de datos o información personal a la cual tiene acceso El Prestador del abonado/suscriptor.
        </p>
        <p>Esta autorización rige a partir de la fecha de suscripción de este contrato de adhesión. La información
            personal sólo será utilizada para promociones de planes o premios que sortee El Prestador y la información
            sólo será publicada en la página web oficial del Prestador, en cualquier momento, El abonado/suscriptor,
            podrá revocar su consentimiento y lo comunicará a través de medios físicos o electrónicos al Prestador, sin
            que el Prestador pueda condicionar o establecer requisitos para tal fin, adicionales a la simple voluntad
            del abonado/suscriptor.</p>
        <p>Fecha de validez: {{ \Carbon\Carbon::parse($contract->fecha)->translatedFormat('d \d\e F \d\e Y') }}</p>
        <table class="signature-table">
            <tr>
                <td>
                    @if($signatureImg)
                        <img src="{{ $signatureImg }}" style="max-height: 80px; width: auto; margin-bottom: -20px;"><br>
                    @endif
                    _________________________<br><strong>{{ mb_strtoupper($contract->client->nombre) }}
                        {{ mb_strtoupper($contract->client->apellido ?? '') }}</strong><br>C.I.
                    {{ $contract->client->cedula }}<br>ABONADO/SUSCRIPTOR
                </td>
                <td>_________________________<br><strong>LUCIA DEL SOCORRO URBANO URBANO</strong><br><strong>PRESTADOR</strong></td>
            </tr>
        </table>

    </main>
</body>

</html>