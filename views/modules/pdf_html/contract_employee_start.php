<style type="text/css">
    @font-face {
        font-family: Calibri;
    }
</style>

<page backtop="3mm" backbottom="3mm" backleft="25mm" backright="25mm">
    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">CONTRATO INDIVIDUAL DE TRABAJO POR TIEMPO DETERMINADO, que
                            celebran por una parte la empresa denominada MERCADO DE CARNES ESTRELLA S.A. DE C.V.
                            representada por el SR. RAUL OCA&Ntilde;AS AGUIRRE en su car&aacute;cter de ADMINISTRADOR
                            GENERAL UNICO y por la otra, EL (LA) <span
                                style="background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;"><strong><span
                                        style="background-color: silver;">C.
                                        <?php echo $employee['nameEmployee'].' '.$employee['surName1Employee'].' '.$employee['surName2Employee']?>
                                    </span></strong></span>por su propio derecho y a quienes se les denominar&aacute; en
                            el curso del presente contrato &ldquo;EL Patr&oacute;n &ldquo;EL TRABAJADOR&rdquo;, y cuando
                            se haga referencia a ambos se denominar&aacute; &ldquo;LAS PARTES&rdquo; respectivamente,
                            contrato que sujetan al tenor de las siguientes declaraciones y cl&aacute;usulas</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: center; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">DECLARACIONES:</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">1.- “EL PATRON” manifiesta haberse constituido en observancia de
                            las Leyes Mexicanas, al corriente en el pago de contribuciones de carácter fiscal, tener
                            como actividad preponderante entre otras la de COMPRA-VENTA, IMPORTACION, DISTRIBUCION Y
                            COMERCIALIZACION DE CARNE DE RES, POLLO, CERDO, PESCADO, ALIMENTOS PERECEDEROS Y NO
                            PERECEDEROS, ABARROTES EN GENERAL, FRUTAS, LEGUMBRES, BEBIDAS, CIGARROS, ALIMENTOS LACTEOS,
                            QUESOS EMBUTIDOS Y LATERIA EN GENERAL y tener como domicilio el ubicado en MERCADO DE
                            ABASTOS ESTRELLA BODEGA 300 sito en AVENIDA LOS ANGELES No. 1000 DE LA COLONIA MERCADO DE
                            ABASTOS ESTRELLA EN SAN NICOLAS DE LOS GARZA NUEVO LEON.-</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">2.- “EL PATRON” declara que por la actividad que desempeña
                            requiere de los servicios de “EL TRABAJADOR” para que desempeñe la actividad de <b><span
                                    style="background-color: silver;"><?php echo$employee['position_employee']?></span></b>
                            exclusivamente por el período del <b><span
                                    style="background-color: silver;"><?php echo Helper::RangeDateContract($employee['start_contract'], $employee['end_contract'])?></span></b>.-</span>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">3.- “El TRBAJADOR” refiere ser mexicano, mayor de edad, <b><span
                                    style="background-color: silver;"><?php echo $employee['civil_status']?></span></b>
                            con fecha de nacimiento el día
                            <b><?php echo Helper::BirthDayContract($employee['birthdayEmployee'])?></b> en <b><span
                                    style="background-color: silver;"><?php echo $employee['addressCityPlaceBirth'].", ".$employee['addressStatePlaceBirth']?></span></b>.
                            y manifiesta que se encuentra en óptimas condiciones de desempeñar la actividad de <b><span
                                    style="background-color: silver;"><?php echo $employee['position_employee']?></span></b>
                            por el periodo indicado en el párrafo que antecede.</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">4.- “EL TRABAJADOR” manifiesta tener domicilio particular en
                            <b><span
                                    style="background-color: silver;"><?php echo "C. ".$employee['addressStreet']. " COLONIA ".$employee['addressColony'].", ".$employee['addressCityA'].", ".$employee['addressStateA'].". CP. ".$employee['addressCodePostal']?></span></b>
                            domicilio en el cual solicita le sean realizadas toda clase de notificaciones y ratifica su
                            conformidad y aceptación de las notificaciones que le sean realizadas en el domicilio en
                            cita.- Así como tener como Numero de inscripción en el Instituto Mexicano del Seguro Social
                            <b><?php echo $employee['nss_employee']?></b> el cual solicita se tome como referencia para
                            efectos de Ley.- </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">Motivo por el cual las partes han celebrado el presente contrato
                            que se contiene al tenor de las siguientes:</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">CLAUSULAS:</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">PRIMERA. OBLIGACIONES. EL TRABAJADOR se obliga a desempeñar sus
                            servicios personales a “EL PATRON” en el domicilio ubicado en calle MERCADO DE ABASTOS
                            ESTRELLA BODEGA 300 en AVENIDA LOS ANGELES No. 1000 DE LA COLONIA MERCADO DE ABASTOS
                            ESTRELLA, EN SAN NICOLAS DE LOS GARZA NUEVO LEON, en el puesto de <b><span
                                    style="background-color: silver;"><?php echo$employee['position_employee']?></span></b>
                            y se obliga a acatar siempre las demás disposiciones y órdenes que éste le dicte.-</span>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">Refiriendo que en caso de que le sea ordenado por “EL PATRON”
                            desempeñar la actividad laboral en diverso domicilio, la empresa MERCADO DE CARNES ESTRELLA
                            SA DE CV. Seguirá siendo su único y exclusivo Patrón, en virtud de ser la que le proporciona
                            los elementos necesarios para el desempeño de su actividad laboral y ser la que le cubre el
                            salario. </span></p>
                </td>
            </tr>
        </tbody>
    </table>

</page>
<!--PAGINA 2-->
<page backtop="3mm" backbottom="3mm" backleft="25mm" backright="25mm">

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">SEGUNDA. DURACIÓN DEL CONTRATO. El presente contrato será por
                            TIEMPO DETERMINADO, con vigencia a partir del día de hoy, con vencimiento el próximo
                            <b><span
                                    style="background-color: silver;"><?php echo Helper::DateStringContract($employee['end_contract'])?></span></b>.-
                        </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">TERCERA, JORNADA DE TRABAJO. “EL TRABAJADOR” y “EL PATRÓN” pactan
                            que el horario de labores seguirá siendo el pactado originalmente, comprendido éste de lunes
                            a sábado de 6:00 A 12:00 Y 13:00 A 15:00 HORAS, DISFRUTANDO DEL INTERVALO COMPRENDIDO DE
                            12:00 A 13:00 HORAS DE LUNES A SABADO para consumo y disfrute de alimentos con plena
                            disposición para disfrutarlo fuera del centro de trabajo, periodo de alimentos en el cual no
                            se encontrará subordinado a las órdenes de “EL PATRON”.- Asimismo señalan ambas partes que
                            el control de jornada será mediante constancia semanal, en la cual se insertará la jornada
                            de labores por el periodo que corresponda y que deberá signar “EL TRABAJADOR” en caso de que
                            esté de acuerdo en la materialización de la misma (disponiéndose que el estampamiento de la
                            firma de “EL TRABAJADOR” en la constancia en cita, representa la materialización del horario
                            de labores respectivo y aceptación del desglose del mismo por parte de “EL
                            TRABAJADOR”).-</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">Descansando el día domingo íntegro, con goce de salario, jornada
                            de trabajo que pacta en términos del artículo 59 de la Ley Federal del Trabajo.</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">TIEMPO EXTRAORDINARIO. Queda prohibido al TRABAJADOR trabajar
                            tiempo extraordinario si no es con consentimiento previo y orden escrita dada por la EL
                            PATRON, la cual deberá conservar el trabajador para cualquier reclamación futura. Cuando por
                            cualquier circunstancia deba trabajar el TRABAJADOR mayor tiempo que el señalado como
                            jornada ordinaria, deberá recabar previamente de EL PATRON la orden a que se refiere esta
                            cláusula, sin cuyo requisito no le será reconocida cantidad alguna por el tiempo que trabaje
                            con exceso a la jornada legal.-</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">CUARTA. SALARIO. “EL TRABAJADOR” Y “EL PATRON” pactan que “EL
                            TRABAJADOR” percibirá como sueldo total por la prestación de los servicios a que se refiere
                            este contrato el importe de <b><span
                                    style="background-color: silver;"><?php echo "$".$employee['weekly_balance']?></span></b>
                            PESOS SEMANALES, asimismo están de acuerdo en que el pago del salario se haga por medio de
                            depósito bancario en tarjeta de nómina y/o débito o bien en efectivo o cheque cuyo importe
                            se cubrirá en forma semanal.- Refiriendo que en el importe semanal del mismo, se tiene por
                            incluido íntegramente el séptimo día.-</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">Asimismo pactan como prestaciones diversas en forma semanal las de
                            PREMIO DE ASISTENCIA por el importe de <b><span
                                    style="background-color: silver;"><?php echo "$".$employee['attendance_prize']?></span></b>
                            pesos semanales, así como PREMIO DE PUNTUALIDAD por el importe de <b><span
                                    style="background-color: silver;"><?php echo "$".$employee['punctuality_award']?></span></b>
                            pesos semanales, premios que están condicionados en los términos siguientes:- Pactan como
                            requisitos para la procedencia del pago de PREMIO DE PUNTUALIDAD, PREMIO DE ASISTENCIA los
                            siguientes:-</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">PREMIO DE PUNTUALIDAD:- Se genera por puntualidad perfecta
                            semanal, es decir sin retardo de entrada y sin salida antes de la hora de conclusión
                            ordinaria de labores.- Se dispone como única excepción la de otorgamiento de permiso por
                            escrito por “EL PATRON” para retardo en la entrada o salida antes del horario de conclusión
                            de labores (en cuyo documento debe establecerse el periodo y fecha de llegada tarde o salida
                            temprano), sin éste requisito se tendrá por no generado el PREMIO DE PUNTUALIDAD.- </span>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">PREMIO DE ASISTENCIA:- Se genera por asistencia perfecta semanal,
                            es decir, no tener faltas injustificadas en la semana, (para ser justificada cada falta,
                            debe acreditarse la imposibilidad medica para laborar, mediante el certificado de
                            incapacidad otorgado por el IMSS, o bien permiso para inasistencia otorgado por “EL PATRON”
                            en forma escrita.- En caso de haber incurrido en FALTA INJUSTIFICADA, no se cubrirá el
                            importe del mismo.-</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">QUINTA. RECIBO DE SALARIO. EL TRABAJADOR se obliga a otorgar los
                            días de pago de salario semanal, un recibo a favor de EL PATRON por la totalidad de los
                            sueldos devengados hasta esa fecha, entendiéndose que el otorgamiento del mismo implicará su
                            conformidad en que el sueldo recibido cubre el trabajo desempeñado, sin que pueda exigir
                            posteriormente pago de prestación alguna, ya que cualquier cantidad a la que creyere tener
                            derecho deberá exigirla precisamente al otorgar el recibo de referencia. La firma del recibo
                            correspondiente implicará un finiquito total para EL PATRON por cualquier clase de sueldos o
                            prestaciones a que tuviere derecho el TRABAJADOR por los servicios prestados hasta esa
                            fecha, aun cuando no se diga en el recibo lo anterior.</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">“EL TRABAJADOR” manifiesta que por pedimento propio de él el pago
                            de su salario y prestaciones (en caso de ser generadas) se realice en tarjeta de nomina y/o
                            debito número _________________del banco BANREGIO, en la cual solicita se le haga el
                            depósito de salario y prestaciones que genere semanalmente.-</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">SEXTA. DIAS DE DESCANSO SEMANAL. EL TRABAJADOR disfrutará
                            semanalmente atento a la jornada de labores pactada en la cláusula tercera del presente
                            contrato individual de trabajo, de un día de descanso semanal, el que se conviene por ambas
                            partes que será los días DOMINGO de cada semana, con goce integro de salario.- </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">SEPTIMA. AGUINALDO. En virtud de que el presente contrato
                            individual de trabajo es por tiempo determinado, EL TRABAJADOR recibirá por concepto de
                            aguinaldo anual el importe que legalmente le corresponda en términos del artículo 87 de la
                            Ley Federal del Trabajo, que es el equivalente a 15 días de salario y en caso de no cumplir
                            un año laborado a la parte proporcional respectiva.</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">OCTAVA. VACACIONES Y PRIMA VACACIONAL. En virtud de que el
                            contrato individual de trabajo es por tiempo determinado, EL TRABAJADOR tendrá derecho a
                            percibir VACACIONES y DE PRIMA VACACIONAL, respectivamente, en los términos de los artículos
                            76, 77, 78, 79 80 y 81 de la Ley Federal del Trabajo. </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">NOVENA. DIAS DE DESCANSO OBLIGATORIO. EL TRABAJADOR disfrutará
                            descanso obligatorio los siguientes días (en cuanto se encuentren comprendidos dentro el
                            periodo de vigencia del presente contrato individual de trabajo):- </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <ol style="list-style-type: upper-roman;">
        <li style=" padding: 5px;">El 1o. de enero;</li>
        <li style=" padding: 5px;">El primer lunes de febrero en conmemoración del 5 de febrero; </li>
        <li style=" padding: 5px;">El tercer lunes de marzo en conmemoración del 21 de marzo;</li>
        <li style=" padding: 5px;">El 1o. de mayo;</li>
        <li style=" padding: 5px;">El 16 de septiembre;</li>
        <li style=" padding: 5px;">El tercer lunes de noviembre en conmemoración del 20 de noviembre;</li>
        <li style=" padding: 5px;">El 1o. de diciembre de cada seis años, cuando corresponda a la transmisión del Poder
            Ejecutivo Federal;</li>
        <li style=" padding: 5px;">El 25 de diciembre;</li>
        <li style=" padding: 5px;">El que determinen las leyes federales y locales electorales, en el caso de elecciones
            ordinarias, para efectuar la jornada electoral;</li>
    </ol>


    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">Días referidos en los cuales “EL TRABAJADOR” percibirá salario
                            integro.- </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">DECIMA. REGLAMENTO INTERIOR DE TRABAJO. “EL TRABAJADOR” manifiesta
                            haber recibido a su entera conformidad un ejemplar del REGLAMENTO INTERIOR DE TRABAJO, el
                            cual refiere haber leído en su integridad y se compromete a cumplir con las disposiciones
                            del mismo.-</span></p>
                </td>
            </tr>
        </tbody>
    </table>

</page>


<page backtop="3mm" backbottom="3mm" backleft="25mm" backright="25mm">

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">DECIMA PRIMERA. CAPACITACION Y ADIESTRAMIENTO. “EL TRABAJADOR”
                            manifiesta haber recibido la CAPACITACIÓN Y ADIESTRAMIENTO para el puesto a desempeñar,
                            otorgada por “EL PATRON” en forma y términos de Ley, por lo cual manifiesta haber sido
                            adiestrado en la operación y mantenimiento de la maquinaria, utensilios y herramienta con la
                            cual desempeñará su actividad laboral.- </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">DECIMA SEGUNDA.- CUIDADO DE INSTALACIONES Y HERRAMIENTA DE
                            TRABAJO. “EL TRABAJADOR” manifiesta haber sido instruido por “EL PATRON” en el cuidado de
                            las instalaciones y área de trabajo, por lo cual se compromete a mantener limpia su zona de
                            trabajo y otorgar esmero en el cuidado de las instalaciones de “EL PATRON” y del CENTRO DE
                            TRABAJO.- </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">DECIMA TERCERA.- COMPROMISO. “EL TRABAJADOR” se compromete a
                            informar a “EL PATRON” o a la COMISION DE SEGURIDAD E HIGIENE de cualquier daño o falla que
                            observe en la herramienta, equipo de trabajo, maquinaria o en las propias instalaciones de
                            la empresa, así como de conducta inapropiada de alguno o varios de sus compañeros de trabajo
                            que pudiera poner en riesgo la seguridad de ellos mismos, de compañeros de trabajo, de la
                            maquinaria, herramienta de trabajo o de las instalaciones de la empresa.- </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">DECIMA CUARTA.- “EL TRABAJADOR” manifiesta haber recibido curso de
                            primeros auxilios y estar capacitado para aplicar los conocimientos adquiridos en caso de
                            ser necesario.- </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">Asimismo, manifiesta tener conocimiento de las medidas de
                            seguridad e higiene aplicables en la empresa, y tener ubicados los extinguidores, salida de
                            emergencia, señalamientos de evacuación, y tener conocimiento sobre las medidas a tomar en
                            caso de contingencia o accidente.- </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">DECIMA QUINTA.- LEY APLICABLE. “EL TRABAJADOR” y “EL PATRON”
                            convienen en que todo lo no previsto en el presente contrato se regirá por las disposiciones
                            de la Ley Federal del Trabajo y en que para todo lo que se refiera a interpretación,
                            ejecución y cumplimiento del mismo, se someterán expresamente a la jurisdicción y
                            competencia de la Junta Local de Conciliación y Arbitraje de Nuevo León. </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">DECIMA SEXTA.- “EL TRABAJADOR” y “EL PATRON” establecen como
                            duración del presente Contrato Individual de Trabajo la de “POR TIEMPO DETERMINADO”, y que
                            sólo podrá SUSPENDER SUS EFECTOS por las causales que establece el Artículo 42 de la ley
                            Federal del Trabajo; TERMINAR Y RESCINDIR por las causales de Terminación y Rescisión que
                            establecen los Artículos 46, 47, 48, 53,54, 55 y 434 de la Ley Laboral invocada, así como
                            haber allegado éste a su término, estableciéndose como duración del presente contrato única
                            y exclusivamente <b><span
                                    style="background-color: silver;"><?php echo Helper::RangeDateContract($employee['start_contract'], $employee['end_contract'])?></span></b>.-</span>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 6 ￼
                    ￼ ￼
                    2	1400	Hiram	Salazar	Rojas	30/Abril/2019 12:00 PM (6 días 6 horas, 7 minutos)	
                    ￼ ￼
                    ￼ ￼
                    3	2000	nohemi	Aguilar	Aguilar	19/Abril/2019 12:05 AM (17 días 18 horas, 2 minutos)	
                    ￼ ￼
                    ￼ ￼
                    4	200	Pancho	Pantera	Negra	05/Abril/2019 01:00 PM (1 día, 5 horas, 7 minutos)	
                    ￼ ￼
                    ￼ ￼
                    5	10588	SANDRA	RDZ	OLVERA	12/Abril/2019 01:00 PM (24 días 5 horas, 7 minutos)	
                    ￼ ￼
                    ￼ ￼
                    0pt 5.0cm;"><span
                            style="font-size: 9.5pt;">DECIMA SEPTIMA:- “EL TRABAJADOR” y “EL PATRON” pactan que llegado
                            a su término la fecha de vencimiento del presente contrato, a partir de las <b><span
                                    style="background-color: silver;"><?php echo Helper::DateTimeStringContracteEnd($employee['end_contract']); ?></span></b>
                            se tendrá por terminado y concluido el presente contrato individual de trabajo, en cuyo caso
                            habrá cesado y terminado la relación de trabajo pactada y originada en el presente contrato,
                            SIN OPCIÒN DE PRORROGA, EXTENSIÒN O RENOVACION.</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">DECIMA OCTAVA:- “EL TRABAJADOR” y “EL PATRON” pactan que llegado a
                            su término la fecha de vencimiento del presente contrato, se pagará por concepto de
                            liquidación y terminación de la </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">Relación de trabajo a “EL TRABAJADOR” exclusivamente los conceptos
                            de vacaciones, prima vacacional y aguinaldo proporcionales al tiempo laborado.-</span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">“EL TRABAJADOR” dispone que el finiquito referido en el párrafo
                            que antecede le pueda ser depositado en la tarjeta de nomina o debito referida para deposito
                            del salario respectivo, con cuyo deposito se tendrá por cumplido el fin y conclusión del
                            presente contrato.- </span></p>
                </td>
            </tr>
        </tbody>
    </table>

</page>


<page backtop="3mm" backbottom="3mm" backleft="25mm" backright="25mm">

    <table style="width: 100%; border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 100%;">
                    <p style="text-align: justify; line-height: 20px; tab-stops: 60pt 5.0cm;"><span
                            style="font-size: 9.5pt;">Leído que le fue el presente contrato e impuestas las partes de su
                            contenido y fuerza legal firman y ratifican su contenido integro, obligándose a estar y
                            pasar por él ahora y en todo tiempo y lugar, firmándose en la Ciudad de San Nicolas de los
                            Garza, Nuevo León a las <b><span
                                    style="background-color: silver;"><?php echo Helper::DateTimeStringContracteStart($employee['start_contract']); ?></span></b>,
                            ante dos testigos que suscriben:- </span></p>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; padding-top: 100px; border-collapse: collapse; margin-right: auto;" border="0">
        <tbody>
            <tr>
                <td style="width: 55%; text-align: center; font-size: 9.5pt;">"El Patron"</td>
                <td style="width: 55%; text-align: center; font-size: 9.5pt;">"El Trabajador"</td>
            </tr>
            <tr>
                <td style="width: 55%; text-align: center; font-size: 9.5pt; padding-top: 15px; padding-botton: 60px;">
                    MERCADO DE CARNES ESTRELLA S.A DE C.V.</td>
                <td style="width: 55%; text-align: center; font-size: 9.5pt; padding-top: 15px; padding-botton: 60px;">
                    &nbsp;</td>
            </tr>
            <tr>
                <td style="width: 55%; text-align: center; font-size: 9.5pt; padding-top: 60px; padding-botton: 20px;">
                    __________________________________</td>
                <td style="width: 55%; text-align: center; font-size: 9.5pt; padding-top: 60px; padding-botton: 20px;">
                    __________________________________</td>
            </tr>
            <tr>
                <td style="width: 55%; text-align: center; font-size: 9.5pt; padding-top: 20px; padding-botton: 20px;">
                    SR. RAUL OCA&Ntilde;AS AGUIRRE</td>
                <td style="width: 55%; text-align: center; font-size: 9.5pt; padding-top: 20px; padding-botton: 20px;">
                    <b><span style="background-color: silver;">C.
                            <?php echo $employee['nameEmployee'].' '.$employee['surName1Employee'].' '.$employee['surName2Employee']?></span></b>
                </td>
            </tr>

            <tr>
                <td style="width: 55%; text-align: center; font-size: 9.5pt; padding-top: 15px; padding-botton: 60px;">
                    TESTIGO:</td>
                <td style="width: 55%; text-align: center; font-size: 9.5pt; padding-top: 15px; padding-botton: 60px;">
                    TESTIGO:</td>
            </tr>
            <tr>
                <td style="width: 55%; text-align: center; font-size: 9.5pt; padding-top: 60px; padding-botton: 20px;">
                    __________________________________</td>
                <td style="width: 55%; text-align: center; font-size: 9.5pt; padding-top: 60px; padding-botton: 20px;">
                    __________________________________</td>
            </tr>
        </tbody>
    </table>

</page>