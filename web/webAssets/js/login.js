$(document).ready(function(){

    // Abrir modal
    $(".js-mask-check").on("click", function(){
        $('#modal-aviso').modal('show');
    });

    // Aceptar los terminos en modal
    $("#btn-acepto-terminos").on('click', function () {

        $(".styled-mask").hide();
        $("#styled-checkbox-1").prop("checked", true);
        $("#modal-aviso").modal("hide");
        // $(".js-aviso-check").css('display', 'none');
        console.log("acepto terminos");

    });

    // Check on change
    $("#styled-checkbox-1").change(function () {

        if ($(this).is(':checked')) {
            console.log('if');
            $(".styled-mask").hide();
        }
        else {
            $(".styled-mask").show();
            console.log('else');
        }

    });

    // Check on click
    $("#styled-checkbox-1").on('click', function () {

        if ($(this).is(':checked')) {
            console.log('click if');
            $(".styled-mask").hide();
        }
        else {
            $(".styled-mask").show();
            console.log('click else');
        }

    });

    
});
