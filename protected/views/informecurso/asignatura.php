<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart:{
            'type':'spline',
            'animation':'Highcharts.svg',
        },
        lang: {
            'loading': 'Cargando...',  
            'months': ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],  
            'weekdays': ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'],  
            'shortMonths': ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],  
            'exportButtonTitle': "Exportar",  
            'printButtonTitle': "Importar",  
            'rangeSelectorFrom': "De",  
            'rangeSelectorTo': "A",  
            'rangeSelectorZoom': "Periodo",  
            'downloadPNG': 'Descargar gráfica PNG',  
            'downloadJPEG': 'Descargar gráfica JPEG',  
            'downloadPDF': 'Descargar gráfica PDF',  
            'downloadSVG':'Descargar gráfica SVG',  
            'printChart': 'Imprimir Gráfica',  
            'thousandsSep': ",",  
            'decimalPoint': '.'  
        },
        credits:{
            'enabled': false,
        },
        title: {
            text: 'Resumen Calificaciones',
            x: -20 //center
        },
        subtitle: {
           // text: <?php // echo '"Curso: '.$nombre_curso.'"';?>,
            //x: -20
        },
        xAxis: {
            title: {
                text: 'Nota',
               // max:2,
                //min:0,
                //range:10,
                floor: 0,
                ceiling: 50,
                
            },
            categories: 
            <?php echo json_encode($array_notas);?>
            
           
        },
        yAxis: {
            title: {
                text: 'Cantidad de alumnos',
                //max:2,
                //min:0,
                //range:10,
                floor: 0,
                ceiling: 50,
                
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: 
        [  
      
        <?php
            $visitas = array('name' => $nombre_asignatura , 'data' => $array_eval);
            echo json_encode($visitas).",";
            
            ?>
        ]
        ,
    });
});
</script>