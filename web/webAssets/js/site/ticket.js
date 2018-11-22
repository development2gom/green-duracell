var index = 1;
$(document).ready(function(){
    $('#enttickets-num_productos').keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    
            return false;
        }
    });

   
    $('.js_ingresar_producto').on('click', (e) => {
        e.preventDefault();
        
        var nuevoDiv = $(".js_div_clone").html();
        //console.log(nuevoDiv);
        $(".js_nuevo_clone").append(nuevoDiv); 
        
        $(".js_nuevo_clone #js-codigo_barras-0").last().prop('id', 'js-codigo_barras-'+index);
        $(".js_nuevo_clone #js-txt_serial-0").last().prop('id', 'js-txt_serial-'+index);
        $(".js_nuevo_clone .js_quitar_producto").last().css('display','block');
        index++;
    });
    
   


    /////////////////////////////////////////

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
                    if(resp.result.txt_sucursal){
                        $(".js-txt_sucursal").text(resp.result.txt_sucursal);
                    }
                    if(resp.result.txt_codigo_ticket){
                        $(".js-txt_codigo_ticket").text(resp.result.txt_codigo_ticket);                        
                    }
                    //console.log(resp.result.length);
                    resp.result.forEach( (item, index) => {
                        if(!Object.values(item).indexOf('txt_codigo_barras') > -1){
                            $("#js-codigo_barras-"+index).text(item.txt_codigo_barras);                            
                        }else{
                            console.log('no entro');
                        }
                        if(!Object.values(item).indexOf('txt_serial') > -1){
                            $("#js-txt_serial-"+index).text(item.txt_serial);
                        }else{
                            console.log('no entro1');
                        }
                        // console.log( index + ": " + item.txt_codigo_barras );
                      });
                }
            },
            error: () => {

            }
        });
    });

    $("#js-txt-sucursal").on('change', () => {
        if($(".js-txt_sucursal").text()){
            $(".js-txt_sucursal").text('');
        }
    });

    $("#js-txt-codigo-ticket").on('change', () => {
        if($(".js-txt_codigo_ticket").text()){
            $(".js-txt_codigo_ticket").text('');
        }
    });
});

$(document).on({
    'change': () => {
        if($(".js-codigo_barras-error").text()){
            $(".js-codigo_barras-error").text('');
        }
    }
}, ".js-codigo_barras");

$(document).on({
    'change': () => {
        if($(".js-txt_serial-error").text()){
            $(".js-txt_serial-error").text('');
        }
    }
}, ".js-txt_serial");

$(document).on('click','.js_quitar_producto', (e) => {
    e.preventDefault();
    $('.js_nuevo_clone .row:last').remove();
    
    // var elementoborrar = $(this).parents('.row')
    // console.log(elementoborrar);
    // elementoborrar.remove();
    index--;

});