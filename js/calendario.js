   $(function() {

	$('#fechainput').datepicker({
        dateFormat: 'dd/mm/yy',
        minDate:' 0',
        	firstDay: 1,
					monthNames: ['Enero', 'Febreo', 'Marzo',
					'Abril', 'Mayo', 'Junio',
					'Julio', 'Agosto', 'Septiembre',
					'Octubre', 'Noviembre', 'Diciembre'],
					dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        onSelect: function(datetext){
            var d = new Date(); // for now
            var h = d.getHours();
        		h = (h < 10) ? ("0" + h) : h ;

        		var m = d.getMinutes();
            m = (m < 10) ? ("0" + m) : m ;

        		datetext = datetext + " " + h + ":" + m ;
            $('#fechainput').val(datetext);
            
        },
    });
});