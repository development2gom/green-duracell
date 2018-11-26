<?php
use yii\helpers\Url;
use app\assets\AppAsset;
/* @var $this yii\web\View */

$this->title = "Aviso de privacidad";

$this->params['classBody'] = "site-navbar-small";

$this->registerJsFile(
    '@web/webAssets/js/index.js',
    ['depends' => [AppAsset::className()]]
);
?>

<?= $this->render("//components/classic/topbar/nav-right")?>

<div class="pd-aviso-privacidad">

    <div class="pd-aviso-privacidad-imagen">
        <img src="<?= Url::base() ?>/webAssets/images/aviso-privacidad/conejoregalos.png" alt="">
    </div>

    <div class="pd-aviso-privacidad-textos">

        <h2>Aviso de privacidad</h2>

        <div class="pd-aviso-privacidad-texto">

            <h3>PUBLICIDAD Y SOLUCIONES GREEN S.A. DE C.V.</h3>

            <p>Con fundamento en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, hacemos de su conocimiento que PUBLICIDAD Y SOLUCIONES GREEN S.A. DE C.V., con domicilio en calle Convento de Santa Brígida #19, Colonia Jardines de Santa Mónica, Tlalnepantla, Estado de México, C.P. 54050, es responsable de recabar sus datos personales, uso y protección que se les dé a los mismos.</p>

            <p>Su información personal será utilizada para las siguientes finalidades: proveer los servicios y productos que ha solicitado; notificarle sobre nuevos productos que tengan relación con los ya contratados o adquiridos; comunicarle en los cambios de los mismos; elaborar estudios y programas que son necesarios para determinar hábitos de consumo; realizar evaluaciones periódicas de nuestros productos y servicios para efecto de mejorar la calidad de los mismos; evaluar la calidad del servicio que brindamos, y en general  para dar cumplimiento a las obligaciones que hemos contraído para con Usted.</p>

            <p>De manera adicional, utilizaremos su información personal para las siguientes finalidades que no son necesarias para el servicio solicitado, pero que nos permiten y facilitan brindarle una mejor atención:  con fines mercadotécnicos, publicitarios o de prospección comercial, lo anterior aplica aún y cuando estos datos fueren tratados por un tercero a solicitud de PUBLICIDAD Y SOLUCIONES GREEN S.A. DE C.V., y con el fin de cubrir los servicios necesarios, manteniendo la confidencialidad en todo momento. PUBLICIDAD Y SOLUCIONES GREEN S.A. DE C.V., toma las medidas necesarias y suficientes para procurar que esta Política de Privacidad sea respetada, por él o por terceros con los que guarde alguna relación, para otorgar los servicios o productos establecidos con el titular.</p>

            <p>Para las finalidades antes mencionadas, se podrán solicitar los siguientes datos personales: nombre completo, edad, teléfono fijo y/o teléfono celular, código postal, correo electrónico, ocupación, estado civil, dirección de facebook, twitter, y/o cualquier otra red social.</p>

            <p>Le informamos que sus datos personales podrán ser compartidos con las siguientes organizaciones y autoridades distintas a nosotros, para los siguientes fines:</p>

            <table>
                <thead>
                    <tr>
                        <th>DESTINATARIO DE LOS DATOS PERSONALES</th>
                        <th>FINALIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Procuraduría Federal del Consumidor</td>
                        <td>A petición de esta instancia para dar certeza de premios entregados y participantes de las promociones y concursos que realizamos como permisionarios.</td>
                    </tr>
                    <tr>
                        <td>La Dirección General de Juegos y Sorteos</td>
                        <td>Expedientes de ganadores de los sorteos con permisos otorgados por esta autoridad.</td>
                    </tr>
                    <tr>
                        <td>Secretaría de Finanzas</td>
                        <td>Presentar constancia de entrega de premios, así como pago de impuestos de los mismos.</td>
                    </tr>
                </tbody>
            </table>


            <p>Usted tiene derecho a conocer qué datos personales tenemos de usted, para qué los utilizamos y las condiciones del uso que les damos (Acceso). Asimismo, es su derecho solicitar la corrección de su información personal en caso de que esté desactualizada, sea inexacta o incompleta (Rectificación); que la eliminemos de nuestros registros o bases de datos cuando considere que la misma no está siendo utilizada conforme a los principios, deberes y obligaciones previstas en la normativa (Cancelación); así como oponerse al uso de sus datos personales para fines específicos (Oposición). Estos derechos se conocen como derechos ARCO.</p>

            <p>Para el ejercicio de cualquiera de los derechos ARCO, usted deberá presentar la solicitud respectiva al correo electrónico <a href="mailto:info@publicidadgreen.com.mx" target="_blank">info@publicidadgreen.com.mx</a>, a través de un escrito libre donde especifique los datos personales que quiera proteger, así como los motivos de la solicitud. El escrito libre deberá ir con nombre completo y firma autógrafa acompañado de una copia de su identificación oficial vigente; PUBLICIDAD Y SOLUCIONES GREEN S.A. DE C.V., contará con 20 días hábiles para atender su solicitud. Si usted no manifiesta su oposición para que sus datos personales sean transferidos y utilizados, se entenderá que ha otorgado su consentimiento para ello.</p>

            <p>Con objeto de que usted pueda limitar el uso y divulgación de su información personal, su inscripción en el Registro Público para Evitar Publicidad, que está a cargo de la Procuraduría Federal del Consumidor, con la finalidad de que sus datos personales no sean utilizados para recibir publicidad o promociones de empresas de bienes o servicios. Para más información sobre este registro, usted puede consultar el portal de Internet de la PROFECO, o bien ponerse en contacto directo con ésta.</p>

            <p>Le informamos que en algunas de nuestras ejecuciones donde el contacto sea a través de un micro sitio o web App es posible que utilicemos cookies, web beacons y otras tecnologías a través de las cuales es posible monitorear su comportamiento como usuario de Internet, brindarle un mejor servicio y experiencia de usuario al navegar en nuestra página, así como ofrecerle nuevos productos y servicios basados en sus preferencias.</p>

            <p>Los datos personales que obtenemos de estas tecnologías de rastreo son los siguientes: horario de navegación, tiempo de navegación, secciones consultadas, páginas de Internet accedidas previo a la nuestra, preferencias e interacciones.</p>

            <p>Estas tecnologías podrán deshabilitarse siguiendo los siguientes pasos: 1. Acceder a nuestra página de Internet, sección “Términos y condiciones del sitio”, subsección “Cookies”; 2. Dar clic en la subsección “Cookies”; 3. Leer el mensaje de advertencia sobre la deshabilitación de cookies, y 4. Dar clic en la leyenda de activar el mecanismo de deshabilitación de cookies.</p>

            <p>Para más información sobre el uso de estas tecnologías, puede consultar el sitio de Internet <a href="http://www.greenmkt.mx/" target="_blank">http://www.greenmkt.mx/</a></p>

            <p>El presente aviso de privacidad puede sufrir modificaciones, cambios o actualizaciones derivadas de nuevos requerimientos legales; de nuestras propias necesidades por los productos o servicios que ofrecemos; de nuestras prácticas de privacidad; de cambios en nuestro modelo de negocio, o por otras causas. PUBLICIDAD Y SOLUCIONES GREEN S.A. DE C.V. se compromete a mantenerlo informado sobre los cambios que pueda sufrir el presente aviso de privacidad, a través de nuestra página web <a href="http://www.publicidadgreen.com/aviso-de-privacidad/" target="_blank">www.publicidadgreen.com/aviso-de-privacidad/</a> Por lo anterior, les sugerimos visitar periódicamente esta declaración de privacidad.</p>

            <p>Para cualquier duda o comentario puede contactarnos al 01 800 467 1897 o escribirnos al correo electrónico <a href="mailto:info@publicidadgreen.com.mx" target="_blank">info@publicidadgreen.com.mx.</a></p>

        </div>

        <div class="pd-aviso-privacidad-btns">
            <a class="btn-regresar" href="<?= Url::base() ?>">Regresar</a>
        </div>

    </div>

    <div class="pd-aviso-privacidad-farmacia">
        <img src="<?= Url::base() ?>/webAssets/images/farmacias-guadalajara.png" alt="">
    </div> 

</div>
