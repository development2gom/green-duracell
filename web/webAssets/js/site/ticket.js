$(document).ready(function(){
    $('#enttickets-num_productos').keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    
            return false;
        }
    });

    $('.js_ingresar_producto').on('click', (e) => {
        e.preventDefault();
        
        var nuevoDiv = $(".js_div_clone").html();
        console.log(nuevoDiv);
        $(".js_nuevo_clone").append(nuevoDiv);
    });

    $(".js-btn-guardar").on('click', () => {
        var data = $("#js-form-ticket").serialize();
        var url = $("#js-form-ticket").data('url');

        $.ajax({
            url: url+'/site/guardar-tickets',
            type:'POST',
            data: data,
            success: (resp) => { console.log(resp);
                if(resp.status == 'success'){
                    window.location.href = url+'/site/ganador?token='+resp.result.uddi;
                }else{

                }
            },
            error: () => {

            }
        });
        console.log(data);
    });
});