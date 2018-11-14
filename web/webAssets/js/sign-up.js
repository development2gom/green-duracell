var inputFile = $("#entusuarios-image");
var tamanioAdmitido = 3;
var tipoImagenesAdmitidas = ["image/jpeg", "image/png", "image/jpg", "image/gif"];



$(document).ready(function () {

    $(".btn-enviar").on("click", function(e){
        e.preventDefault();
        if(!$(".styled-checkbox-1").prop("checked")){
            swal("Espera", "Debes aceptar el aviso de privacidad", "warning");
            return false;
        }

        $("#form-ajax-signup").submit();

    });

    $(".js-img-avatar").on("click", function (e) {
        e.preventDefault();
        inputFile.trigger("click");
    });

    inputFile.on("change", function (e) {
        var file = this.files[0];
        if (!validarTipoImagen(file))
            return false

        if (!validarTamanioImagen(file))
            return false
            
        colocarImagen(file);

    });
    
    $('#entusuarios-num_edad').keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    
            return false;
        }
    });

    $('#entusuarios-txt_telefono').keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    
            return false;
        }
    });
});

function validarTipoImagen(jsfile) {
    var file = jsfile;
    var imagefile = file.type;
    var match = tipoImagenesAdmitidas;

    if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]) || (imagefile == match[3]))) {
        swal("Espera", "Solo se admiten archivos con extensión .jpeg, .jpg, .png, .gif", "warning");
        return false;
    }

    return true;
}

function validarTamanioImagen(jsfile) {
    var file = jsfile;
    sizeImage = (file.size) / 1048576;

    if (sizeImage > tamanioAdmitido) {
        swal("Espera", "Tu imagen debe ser menor a " + tamanioAdmitido + "MB", "warning");
        return false;
    }
    return true;
}

function colocarImagen(jsfile) {
    var file = jsfile;
    var reader = new FileReader();

    // Set preview image into the popover data-content
    reader.onload = function (e) {

        $('.js-image-preview').load(function () {

        }).attr('src', e.target.result);
    }
    reader.readAsDataURL(file);
}