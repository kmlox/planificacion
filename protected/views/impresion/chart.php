<?php
echo "Alumno: Camilo Fabian Oyarzo Molina";
$this->widget(
    'booster.widgets.TbHighCharts',
    array(
        'options' => array(
            'chart'=>array(               
                'type'=>'spline',
                'animation'=> 'Highcharts.svg', // don't animate in old IE
            ),
            'lang'=>array(                
                'loading'=> 'Cargando...',  
                'months'=> ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],  
                'weekdays'=> ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'],  
                'shortMonths'=> ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],  
                'exportButtonTitle'=> "Exportar",  
                'printButtonTitle'=> "Importar",  
                'rangeSelectorFrom'=> "De",  
                'rangeSelectorTo'=> "A",  
                'rangeSelectorZoom'=> "Periodo",  
                'downloadPNG'=> 'Descargar gráfica PNG',  
                'downloadJPEG'=> 'Descargar gráfica JPEG',  
                'downloadPDF'=> 'Descargar gráfica PDF',  
                'downloadSVG'=> 'Descargar gráfica SVG',  
                'printChart'=> 'Imprimir Gráfica',  
                'thousandsSep'=> ",",  
                'decimalPoint'=> '.'  
                ),
            'credits'=> array(
                'enabled'=> false,
            ),
            'title' => array(
                'text' => 'Resumen Calificaciones',
                //'x' => -20 //center
            ),
            'subtitle' => array(
                'text' => 'Alumno(a): Camilo Oyarzo',
                //'x' -10
            ),
            'xAxis' => array(
                'categories' => '',
                'title' => array(
                    'text' =>  'Evaluaciones',
                ),
                
            ),
            'yAxis' => array(
                'title' => array(
                    'text' =>  'Nota',
                ),
                'max'=>7.0,
                'min'=>1.0,
                'plotLines' => [
                    [
                        'value' => 0,
                        'width' => 1,
                        'color' => '#808080'
                    ]
                ],
            ),
            'tooltip' => array(
                'valuePrefix' => '', 
            ),
            'legend' => array(
                'layout' => 'vertical',
                'align' => 'right',
                'verticalAlign' => 'middle',
                'borderWidth' => 0
            ),
            'series' => array(
                [
                    'name' => 'Lenguaje',
                    'data' => [7.0, 6.9, 4.5, 4.5, 1.2, 2.5, 2.2, 6.5, 3.3, 1.3]
                ],
                [
                    'name' => 'Matemáticas',
                    'data' => [1.2, 4.8, 5.7, 1.3, 7.0, 2.0, 4.8, 4.1, 2.1, 4.1, 6.0, 5.0]
                ],
                [
                    'name' => 'Ciencias',
                    'data' => [5.9, 6.0, 3.5, 5.4, 6.5, 7.0, 4.6, 5.9, 4.3, 7.0, 3.9, 1.0]
                ],
                [
                    'name' => 'Historia',
                    'data' => [3.9, 4.2, 5.7, 6.5, 1.9, 5.2, 7.0, 6.6, 4.2, 1.3, 6.6, 4.8]
                ]
            )
        ),
        'htmlOptions' => array(
            'style' => 'min-width: 310px; height: 400px; margin: 0 auto'
        )
    )
);
