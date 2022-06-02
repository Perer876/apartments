<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                color: rgb(30,30,30)
            }
            .fw-bold {
                font-weight: bold;
            }
            .fs-italic {
                font-style: oblique;
            }
            .text-uppercase {
                text-transform: uppercase;
            }
            .text-underline {
                text-decoration: underline;
            }
            .text-align-justify {
                text-align: justify;
                text-justify: inter-word;
            }
            .text-align-center {
                text-align: center;
            }
            h1.text-align-center, h2.text-align-center, h3.text-align-center,
            h4.text-align-center, h5.text-align-center, h6.text-align-center {
                letter-spacing: 3px;
            }
            p { margin-top: 0; }
            ul.circle { list-style-type: circle; }
            ul.square { list-style-type: square; }
            ol.upper-roman { list-style-type: upper-roman; }
            ol.lower-roman { list-style-type: lower-roman; }
            ol.upper-alpha { list-style-type: upper-alpha; }
            ol.lower-alpha { list-style-type: lower-alpha; }
            .tab { padding-left: 2em; }
            .pt-1 { padding-top: 1em; }
            ol.bold li { font-weight:bold; }
            ol.bold li > p, ol.normal li { font-weight:normal; }
        </style> 
        <title></title>
    </head>
    <body>
        <h2 class="text-align-center text-uppercase">Contrato de Arrendamiento</h2>
        <p class="text-align-justify text-uppercase">
            Contrato de arrendamiento que celebran por una parte <span class="fw-bold">{{ $contract->lessor->name }}</span>, a quien en lo sucesivo se le denominara el <span class="fs-italic text-underline">arrendador</span>, y por la otra <span class="fw-bold">{{ $contract->tenant->name }}</span> quien en lo sucesivo se le denominara el <span class="fs-italic text-underline">arrendatario</span>, los cuales sujetan a las siguientes declaraciones y clausulas.
        </p>

        <h3 class="text-align-center text-uppercase">Declaraciones</h3>
        <ol class="upper-roman bold">
            <li>
                <h4 class="text-uppercase">Declara el arrendador</h4>
                <ol class="lower-alpha">
                    <li>
                        <p>
                            Ser mexicano, mayor de edad, tener su domicilio para recibir todo tipo de notificaciones y pagos en la calle continuación 16 de septiembre 1474 en esta ciudad de Atotonilco el Alto Jalisco.
                        </p>
                    </li>
                    <li>
                        <p>
                            Ser legítimo propietario de la finca marcada con el número #{{ $contract->apartment->building->number }} interior {{ $contract->apartment->number }} de la Calle {{ $contract->apartment->building->street }}, en la colonia del Valle de esta ciudad de {{ $contract->apartment->building->city }}, {{ $contract->apartment->building->state }}.
                        </p>
                    </li>
                    <li>
                        <p>
                            Estar interesado en otorgar en arrendamiento el bien del inmueble que se describe en el punto anterior.
                        </p>
                    </li>
                </ol>
            </li>
            <li>
                <h4 class="text-uppercase">Declara el arrendatario</h4>
                <ol class="lower-alpha">
                    <li>
                        <p>
                            Ser mexicano, mayor de edad y designar como su domicilio para recibir notificaciones en el inmueble material del presente contrato de arrendamiento.
                        </p>
                    </li>
                    <li>
                        <p>
                            Estar interesado en rentar el inmueble material del presente contrato. 
                        </p>
                    </li>
                </ol>
            </li>
            <li>
                <h4 class="text-uppercase">Declaran las partes</h4>
                <ol class="lower-alpha">
                    <li>
                        <p>
                            Las partes contratantes manifiestan su deseo de obligarse al tenor del presente contrato y de conformidad con las cláusulas presentadas a continuación.
                        </p>
                    </li>
                </ol>
            </li>
        </ol>
        
        <h3 class="text-align-center text-uppercase">Cláusulas</h3>
        <ol class="bold">
            <li>
                <p class="text-align-justify">
                    <span class="text-uppercase fw-bold">Objeto.</span>
                    El arrendador entrega a la firma del presente contrato en arrendamiento a el arrendatario la finca marcada con el número #{{ $contract->apartment->building->number }} interior {{ $contract->apartment->number }} de la Calle {{ $contract->apartment->building->street }}, en la colonia del Valle de esta ciudad de {{ $contract->apartment->building->city }}, {{ $contract->apartment->building->state }} que se describe en la declaración 1, inciso b). Por lo que el arrendatario recibe en estos momentos en el excelente estado en el que se encuentra el bien inmueble respectivo en tal concepto.
                    <br><br>
                    <span class="tab">
                        Las partes contratantes coinciden expresamente en que el destino del inmueble en materia del presente contrato es exclusivamente para casa habitación.
                    </span>    
                </p>
            </li>
            <li>
                <p class="text-align-justify">
                    <span class="text-uppercase fw-bold">Monto de la renta.</span>
                    “EL ARRENDATARIO” se obliga a pagar a “EL ARRENDADOR” en el domicilio de este ultimo por concepto de renta mensual la cantidad de ${{ $contract->monthly_rent }}
                    <span class="text-uppercase">{{$contract->spell_monthly_rent}}</span>
                    (00/100 M.N).
                </p>
            </li>
            <li>
                <p class="text-align-justify">
                    <span class="text-uppercase fw-bold">Deposito en garantía.</span>
                    En estos momentos “EL ARRENDATARIO” entrega a “EL ARRENDADOR” la cantidad de ${{ $contract->monthly_rent }}
                    <span class="text-uppercase">{{$contract->spell_monthly_rent}}</span>
                    (00/100 M.N) como deposito, cantidad la cual le será devuelta una vez concluido el contrato de arrendamiento respetivo, previo cercioramiento por parte del arrendador de que el inmueble se entregue en las mismas condiciones en las que fue recibido, así mismo que se demuestre con los recibos respectivos de la luz, agua, gas y teléfono se encuentren liquidados en su totalidad; en caso de que existan desperfectos en el inmueble o bien que los servicios antes indicados no se encuentren cubiertos se autoriza desde este momento a el arrendador para que utilice el deposito de dinero que le fue entregado y cubra dichos servicios.
                </p>
            </li>
            <li>
                <p class="text-align-justify">
                    <span class="text-uppercase fw-bold">Plazo.</span>
                    El plazo, término o duración de este contrato será forzoso para "EL ARRENDADOR" y voluntario para "EL ARRENDATARIO" por
                    @include('resources.contracts.components.period-show', compact('contract'))
                    comenzando a surtir sus efectos el día {{$contract->start_at->locale('es')->isoFormat('dddd LL')}} y concluyendo precisamente el día {{$contract->end_at->locale('es')->isoFormat('dddd LL')}}.
                    <br><br>
                    <span class="tab">
                        "EL ARRENDATARIO" que renuncia expresamente al derecho de prórroga establecida en el Código Civil del Estado de {{$contract->apartment->building->state}}.
                    </span>
                </p>
            </li>
            <li>
                <p class="text-align-justify">
                    <span class="text-uppercase fw-bold">INTERESES MORATORIOS.</span>
                    Queda estipulado entre las partes que si "EL ARRENDATARIO" no paga puntualmente su renta mensual ésta generará un interés moratorio mensual del 5% cinco por ciento tomando como base la cantidad de renta generada mensualmente.
                </p>
            </li>
            <li>
                <p class="text-align-justify">
                    <span class="text-uppercase fw-bold">PROHIBICIÓN DE TRASPASAR O SUBARRENDAR EL INMUEBLE</span>
                    Queda expresamente prohibido el traspaso en todo o en parte del inmueble a otra persona, así cormo también subarrendar total o parcialmente el inmueble materia del arrendamiento, tampoco podrá "EL ARRENDATARIO" modificar o hacer variaciones alteraciones, construcciones al inmueble materia del arrendamiento, esto sin el consentimiento expreso y por escrito de "EL ARRENDADOR"; el incumplimiento de cualquiera de los supuestos establecidos en esta Cláusula será causa de rescisión de este contrato, independientemente de que todo lo que se construya o modifique, quedará en favor de "EL ARRENDADOR" sin costo alguno.
                </p>
            </li>
            <li>
                <p class="text-align-justify">
                    <span class="text-uppercase fw-bold">COMPOSTURAS.</span>
                     Correrán a cargo de "EL ARRENDATARIO" todas las composturas o arreglos de vidrios, puertas, cocina, chapas, closets, instalaciones eléctricas, teléfono y el no realizar dichos arreglos, composturas o adquisiciones será causa de rescisión de este contrato, pues el inmueble se encuentra completo, con todos estos aditamentos y en el buen estado en el que se encuentra.
                </p>
            </li>
            <li>
                <p class="text-align-justify">
                    <span class="text-uppercase fw-bold">PAGO DE SERVICIOS.</span>
                    El consumo del agua, de la luz, el del teléfono, el gas quedara a cargo de "EL ARRENDATARIO" quien deberá de comprobar a "EL ARRENDADOR" estar al corriente en el pago de estos servicios cada vez que éste último lo solicite.
                </p>
            </li>
            <li>
                <p class="text-align-justify">
                    <span class="text-uppercase fw-bold">PROHIBICIÓN DE RETENER EL PAGO DE LA RENTA.</span>
                    Queda establecido que "EL ARRENDATARIO" no podrá retener la renta en ningún caso, ni bajo ningún título judicial ni extrajudicialmente, sino que se obliga a pagarla integra en la fecha estipulada.
                </p>
            </li>
            <li>
                <p class="text-align-justify">
                    <span class="text-uppercase fw-bold">CAUSALES DE RESCISIÓN O VENCİMIENTO ANTICIPADO DEL PLAZO DEL ARRENDAMIENTO.</span>
                    Serán causales de rescisión o vencimiento anticipado del plazo del presente contrato, además de las que prevén los artículos pertenecientes al CAPITULO IX del Código Civil Federal, así como el incumplimiento de cualquiera de las obligaciones establecidas en el contrato que nos trata y también por lo siguiente:
                    <ol class="lower-roman normal">
                        <li>
                            <p class="text-align-justify">El retraso por 30 treinta días en el pago de la renta mensual.</p>
                        </li>
                        <li>
                            <p class="text-align-justify">Por dedicar el inmueble total o parcialmente a fin diverso al establecido en la cláusula primera del presente contrato.</p>
                        </li>
                        <li>
                            <p class="text-align-justify">Deterioro excesivo del inmueble y la falta de mantenimiento por parte "EL ARRENDATARIO", respecto de las áreas que ocupa, para que dicho inmueble se mantenga en las mismas perfectas condiciones en que fue recibido.</p>
                        </li>
                    </ol>
                </p>
            </li>
            <li>
                <p class="text-align-justify">
                    <span class="text-uppercase fw-bold">MODIFICACIONES AL CONTRATO.</span>
                    Cualquier modificación que las partes deseen realizar al contenido del presente contrato, deberá efectuarse mediante acuerdo realizado por escrito y firmado por ambas partes.
                </p>
            </li>
            <li>
                <p class="text-align-justify">
                    <span class="text-uppercase fw-bold">LEY APLICABLE.</span>
                    Las partes establecen de común acuerdo que en la celebración del presente contrato se someten al Código Civil Federal y al Código de Procedimientos Civiles del Estado de {{$contract->apartment->building->state}}, por lo que serán dichos ordenamientos legales los que en todo momento apliquen al contrato, lo anterior para todos los efectos legales que en derecho corresponda para el caso Ley.
                </p>
            </li>
            <li>
                <p class="text-align-justify">
                    <span class="text-uppercase fw-bold">JURISDICCIÓN.</span>
                    Para todas las cuestiones relativas al alcance, interpretación y cumplimiento de las obligaciones y derechos que se consignan en este contrato las partes contratantes se someten expresamente a las Leyes y a los Tribunales competentes de la ciudad de {{$contract->apartment->building->location}}, renunciando al fuero que por sus domicilios actuales o futuros o que por cualquier otra razón pudiera corresponderles.
                </p>
            </li>
        </ol>
        <p>
            Leído que fue por las partes y habiendo quedado enteradas del contenido y los alcances legales de todas y cada una de las Cláusulas de este contrato, lo firman por duplicado ante dos Testigos en esta ciudad de {{$contract->apartment->building->location}} el día {{$contract->start_at->locale('es')->isoFormat('dddd LL')}}.
        </p>
    </body>
</html>