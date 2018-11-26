$(document).ready(function()
{
    $("#entusuarios-txt_username").keypress(function (e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toString();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
        especiales = [8, 37, 39, 46, 6];
    
        tecla_especial = false
        for(var i in especiales) {
            if(key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }
    
        if(letras.indexOf(tecla) == -1 && !tecla_especial){
    
            return false;
          }
    
    });

});

 