$('.toggle').click(function(){

    $('.formulario'). animate({
        height:"toggle",
        'padding-top': 'toggle',
        'padding.bottom': 'toggle',
        opacity: 'toggle'

    },"slow");
});

$(".submenu").click(function(){
  $(this).children("ul").slideToggle();
})

$("ul").click(function(ev){
  ev.stopPropagation();
})