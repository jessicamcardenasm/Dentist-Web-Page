@extends('../ViewParent')





@section('TransporteNorte')
@parent


<script type="text/javascript" src="http://www.highcharts.com/highslide/highslide-full.min.js"></script>
<script type="text/javascript" src="http://www.highcharts.com/highslide/highslide.config.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="http://www.highcharts.com/highslide/highslide.css" />


<script type="text/javascript">

   var category;

  
    
        $(function () {  

          
          var Data1=[];
          var Comentario1={};

          var Data2=[];
          var Comentario2={};

          var Data3=[];
          var Comentario3={};


          
 
          $(".btn").on('click', function() {
                var week_1=$('#semI').val();
                var week_2=$('#semF').val();
                var anho_1=$('#anhoI').val();
                var anho_2=$('#anhoF').val();
                
              $.get( ip+"getdatostransporte1", { "anho_1": anho_1, "week_1": week_1, "anho_2": anho_2, "week_2": week_2 } ).done(function( data) {

                  


                        // ----------------CARGA DE DATA ------------------//

                        var num_elementos_g1=data['g1']['elementos'].length;
                    
                  
                        for(var i = 0; i < num_elementos_g1; i++){

                        Data1[i]={};
                        Data1[i].data=[];  
                            for (var j = 0; j < data["g1"]["data"][0].length; j++) 

                                  {
                                     Data1[i]['data'].push(parseFloat(data['g1']['data'][i][j]['valor']));
                                     
                                  }  
                        Data1[i].name=data['g1']['elementos'][i]['nombre_elemento'];
                        } 

                        Data1[num_elementos_g1]={};
                        Data1[num_elementos_g1].data=[];
                        Data1[num_elementos_g1].name='Limit';   
                        Data1[num_elementos_g1].color='#FC1414'; 
                        Data1[num_elementos_g1].marker={radius: 0};
                                    
                        
                        //-----------------------------------------------------------------//

                       
                       // -------------- CARGA COMENTARIOS ---------------------//

                       for(var i = 0; i < num_elementos_g1; i++){

                        var name=data['g1']['elementos'][i]['nombre_elemento'];
                        Comentario1[name]={};
                        Comentario1[name].data=[];
                            for (var j = 0; j < data["g1"]["data"][0].length; j++) 

                                  {
                                     Comentario1[name]['data'].push(data['g1']['data'][i][j]['comentario']);
                                     
                                  } 

                        Comentario1[name].name=data['g1']['elementos'][i]['nombre_elemento'];

                       } 

                        // ----------------------------------------------------------------//


                       // ----------------CARGA DE DATA ------------------//

                        var num_elementos_g2=data['g2']['elementos'].length;
                    
                  
                        for(var i = 0; i < num_elementos_g2; i++){

                        Data2[i]={};
                        Data2[i].data=[];  
                            for (var j = 0; j < data["g2"]["data"][0].length; j++) 

                                  {
                                     Data2[i]['data'].push(parseFloat(data['g2']['data'][i][j]['valor']));
                                     
                                  }  
                        Data2[i].name=data['g2']['elementos'][i]['nombre_elemento'];
                        } 

                        Data2[num_elementos_g2]={};
                        Data2[num_elementos_g2].data=[];
                        Data2[num_elementos_g2].name='Limit';   
                        Data2[num_elementos_g2].color='#FC1414'; 
                        Data2[num_elementos_g2].marker={radius: 0};
                                    
                        
                        //-----------------------------------------------------------------//

                       
                       // -------------- CARGA COMENTARIOS ---------------------//

                       for(var i = 0; i < num_elementos_g2; i++){

                        var name=data['g2']['elementos'][i]['nombre_elemento'];
                        Comentario2[name]={};
                        Comentario2[name].data=[];
                            for (var j = 0; j < data["g2"]["data"][0].length; j++) 

                                  {
                                     Comentario2[name]['data'].push(data['g2']['data'][i][j]['comentario']);
                                     
                                  } 

                        Comentario2[name].name=data['g2']['elementos'][i]['nombre_elemento'];

                       } 

                        // ----------------------------------------------------------------//



                      // ----------------CARGA DE DATA ------------------//

                        var num_elementos_g3=data['g3']['elementos'].length;
                    
                  
                        for(var i = 0; i < num_elementos_g3; i++){

                        Data3[i]={};
                        Data3[i].data=[];  
                            for (var j = 0; j < data["g3"]["data"][0].length; j++) 

                                  {
                                     Data3[i]['data'].push(parseFloat(data['g3']['data'][i][j]['valor']));
                                     
                                  }  
                        Data3[i].name=data['g3']['elementos'][i]['nombre_elemento'];
                        } 

                        Data3[num_elementos_g3]={};
                        Data3[num_elementos_g3].data=[];
                        Data3[num_elementos_g3].name='Limit';   
                        Data3[num_elementos_g3].color='#FC1414'; 
                        Data3[num_elementos_g3].marker={radius: 0};
                                    
                        
                        //-----------------------------------------------------------------//

                       
                       // -------------- CARGA COMENTARIOS ---------------------//

                       for(var i = 0; i < num_elementos_g3; i++){

                        var name=data['g3']['elementos'][i]['nombre_elemento'];
                        Comentario3[name]={};
                        Comentario3[name].data=[];
                            for (var j = 0; j < data["g3"]["data"][0].length; j++) 

                                  {
                                     Comentario3[name]['data'].push(data['g3']['data'][i][j]['comentario']);
                                     
                                  } 

                        Comentario3[name].name=data['g3']['elementos'][i]['nombre_elemento'];

                       } 

                        // ----------------------------------------------------------------//








                        category=[];

                        for (var i = 0; i < data["semanas"].length; i++) {
                          category.push(data["semanas"][i]["semana"]);
                          Data1[num_elementos_g1]['data'].push(parseFloat(data['g1']['limite'][0]['limite']));
                          Data2[num_elementos_g2]['data'].push(parseFloat(data['g2']['limite'][0]['limite']));
                          Data3[num_elementos_g3]['data'].push(parseFloat(data['g3']['limite'][0]['limite']));
                          
                          
                        }

                        var new_category=getcategory(category);

                        var g1_nombre = data['g1']['nombre'][0]['nombre'];
                        var g2_nombre = data['g2']['nombre'][0]['nombre'];
                        var g3_nombre = data['g3']['nombre'][0]['nombre'];
                        
                       
                       

                        $('#grafica').highcharts({
                                        title: {
                                            text: g1_nombre,
                                            x: -20 //center
                                        },
                                        
                                        xAxis: {
                                            categories: new_category
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'Percentage (%)'
                                            },
                                            plotLines: [{
                                                value: 0,
                                                width: 1,
                                                color: '#808080'
                                            }]
                                        },
                                        tooltip: {
                                            valueSuffix: '%'
                                        },

                                        plotOptions: {
                                          series: {
                                            cursor: 'pointer',
                                            point: {
                                            events: {
                                                click: function (e) {
                                                    hs.htmlExpand(null, {
                                                        pageOrigin: {
                                                            x: e.pageX || e.clientX,
                                                            y: e.pageY || e.clientY
                                                        },
                                                        headingText: 'Observaciones',
                                                        maincontentText: 

                                                            "<p> Serie "+ this.series.name + "</p> <p> Semana "+
                                                            this.category + "</p> <p>" +
                                                            Comentario1[this.series.name]['data'][this.x]+ "</p>",
                                                           
                                                        width: 200


                                                    });
                                                }
                                            }
                                            },
                                            marker: {
                                            lineWidth: 1
                                            }
                                          }
                                        },

                                        legend: {
                                            layout: 'vertical',
                                            align: 'right',
                                            verticalAlign: 'middle',
                                            borderWidth: 0
                                        },

                                        series: Data1

                                });


                      
                      $('#grafica2').highcharts({
                                        title: {
                                            text: g2_nombre,
                                            x: -20 //center
                                        },
                                        
                                        xAxis: {
                                            categories: new_category
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'Percentage (%)'
                                            },
                                            plotLines: [{
                                                value: 0,
                                                width: 1,
                                                color: '#808080'
                                            }]
                                        },
                                        tooltip: {
                                            valueSuffix: '%'
                                        },

                                        plotOptions: {
                                          series: {
                                            cursor: 'pointer',
                                            point: {
                                            events: {
                                                click: function (e) {
                                                    hs.htmlExpand(null, {
                                                        pageOrigin: {
                                                            x: e.pageX || e.clientX,
                                                            y: e.pageY || e.clientY
                                                        },
                                                        headingText: 'Observaciones',
                                                        maincontentText: 

                                                            "<p> Serie "+ this.series.name + "</p> <p> Semana "+
                                                            this.category + "</p> <p>" +
                                                            Comentario2[this.series.name]['data'][this.x]+ "</p>",
                                                           
                                                        width: 200


                                                    });
                                                }
                                            }
                                            },
                                            marker: {
                                            lineWidth: 1
                                            }
                                          }
                                        },

                                        legend: {
                                            layout: 'vertical',
                                            align: 'right',
                                            verticalAlign: 'middle',
                                            borderWidth: 0
                                        },

                                        series: Data2

                                });





                      $('#grafica3').highcharts({
                                        title: {
                                            text: g3_nombre,
                                            x: -20 //center
                                        },
                                        
                                        xAxis: {
                                            categories: new_category
                                        },
                                        yAxis: {
                                            title: {
                                                text: 'Percentage (%)'
                                            },
                                            plotLines: [{
                                                value: 0,
                                                width: 1,
                                                color: '#808080'
                                            }]
                                        },
                                        tooltip: {
                                            valueSuffix: '%'
                                        },

                                        plotOptions: {
                                          series: {
                                            cursor: 'pointer',
                                            point: {
                                            events: {
                                                click: function (e) {
                                                    hs.htmlExpand(null, {
                                                        pageOrigin: {
                                                            x: e.pageX || e.clientX,
                                                            y: e.pageY || e.clientY
                                                        },
                                                        headingText: 'Observaciones',
                                                        maincontentText: 

                                                            "<p> Serie "+ this.series.name + "</p> <p> Semana "+
                                                            this.category + "</p> <p>" +
                                                            Comentario3[this.series.name]['data'][this.x]+ "</p>",
                                                           
                                                        width: 200


                                                    });
                                                }
                                            }
                                            },
                                            marker: {
                                            lineWidth: 1
                                            }
                                          }
                                        },

                                        legend: {
                                            layout: 'vertical',
                                            align: 'right',
                                            verticalAlign: 'middle',
                                            borderWidth: 0
                                        },

                                        series: Data3

                                });




  
                     $("#btn1").empty();
                        $("#btn1").append("<button onclick='abrirVentana(7,110, category)' >Actualizar </button>");    

                        $("#btn2").empty();
                        $("#btn2").append("<button onclick='abrirVentana(7,111, category)' >Actualizar </button>");

                        $("#btn3").empty();
                        $("#btn3").append("<button onclick='abrirVentana(7,112, category)' >Actualizar </button>");

                       






                       

             });      

          });

    });
  
    </script>

    



  

   




<!-- ////////////////////////// Select de año y semanas ////////////////////////////////////////-->




      <section class="wrapper">

          <section id="main-content">

               <section class="wrapper">
                <h3 > Cockpit Transporte - Enlaces Norte</h3>
                <p></p>





        <div id="contenedor">        
        
        <div id="demoIzq" class="bloque">

            <?php 

              echo "<select name='anhoI'   style='width:200px;' id='anhoI' class='form-control' >";
              echo "<option value='' disabled selected > Año Inicial ... </option>";
  
              echo "{{";

              foreach ($anhos as $a){ 
                echo    "<option value={$a["year"]}>{$a["year"]}</option>";
                };
              echo "}}";
              echo "</select>";  
            ?>

        </div>

        
        

        <div id="demoMed" class="bloque" >
          <select  name="semI" id="semI"  class="form-control" required="required" style="width:200px;">
                   <option value="1"  >Enero W1</option>
                  <option value="2"  >Enero W2</option>
                  <option value="3"  >Enero W3</option>
                  <option value="4"  >Febrero W4</option>
                  <option value="5"  >Febrero W5</option>
                  <option value="6"  >Febrero W6</option>
                  <option value="7"  >Febrero W7</option>
                  <option value="8"  >Marzo W8</option>
                  <option value="9"  >Marzo W9</option>
                  <option value="10"  >Marzo W10</option>
                  <option value="11"  >Marzo W11</option>
                  <option value="12"  >Marzo W12</option>
                  <option value="13"  >Abril W13</option>
                  <option value="14"  >Abril W14</option>
                  <option value="15"  >Abril W15</option>
                  <option value="16"  >Abril W16</option>
                  <option value="17"  >Mayo W17</option>
                  <option value="18"  >Mayo W18</option>
                  <option value="19"  >Mayo W19</option>
                  <option value="20"  >Mayo W20</option>
                  <option value="21"  >Mayo W21</option>
                  <option value="22"  >Junio W22</option>
                  <option value="23"  >Junio W23</option>
                  <option value="24"  >Junio W24</option>
                  <option value="25"  >Junio W25</option>
                  <option value="26"  >Julio W26</option>
                  <option value="27"  >Julio W27</option>
                  <option value="28"  >Julio W28</option>
                  <option value="29"  >Julio W29</option>
                  <option value="30"  >Agosto W30</option>
                  <option value="31"  >Agosto W31</option>
                  <option value="32"  >Agosto W32</option>
                  <option value="33"  >Agosto W33</option>
                  <option value="34"  >Agosto W34</option>
                  <option value="35"  >Septiembre W35</option>
                  <option value="36"  >Septiembre W36</option>
                  <option value="37"  >Septiembre W37</option>
                  <option value="38"  >Septiembre W38</option>
                  <option value="39"  >Octubre W39</option>
                  <option value="40"  >Octubre W40</option>
                  <option value="41"  >Octubre W41</option>
                  <option value="42"  >Octubre W42</option>
                  <option value="43"  >Noviembre W43</option>
                  <option value="44"  >Noviembre W44</option>
                  <option value="45"  >Noviembre W45</option>
                  <option value="46"  >Noviembre W46</option>
                  <option value="47"  >Noviembre W47</option>
                  <option value="48"  >Diciembre W48</option>
                  <option value="49"  >Diciembre W49</option>
                  <option value="50"  >Diciembre W50</option>
                  <option value="51"  >Diciembre W51</option>
                  <option value="52"  >Diciembre W52</option>

          </select>
        </div>

     

        <div id="demoMed2" class="bloque">
          <select  name="anhoF" id="anhoF"  class="form-control" required="required" style="width:200px;">
            <option value="2016"  >2016</option>
          </select>
        </div>

     

        <div id="demoDer" class="bloque" >
          <select  name="semF" id="semF" class="form-control"  required="required" style="width:200px;">
            <option value="2"  >Enero W2</option>
                  <option value="3"  >Enero W3</option>
                  <option value="4"  >Febrero W4</option>
                  <option value="5"  >Febrero W5</option>
                  <option value="6"  >Febrero W6</option>
                  <option value="7"  >Febrero W7</option>
                  <option value="8"  >Marzo W8</option>
                  <option value="9"  >Marzo W9</option>
                  <option value="10"  >Marzo W10</option>
                  <option value="11"  >Marzo W11</option>
                  <option value="12"  >Marzo W12</option>
                  <option value="13"  >Abril W13</option>
                  <option value="14"  >Abril W14</option>
                  <option value="15"  >Abril W15</option>
                  <option value="16"  >Abril W16</option>
                  <option value="17"  >Mayo W17</option>
                  <option value="18"  >Mayo W18</option>
                  <option value="19"  >Mayo W19</option>
                  <option value="20"  >Mayo W20</option>
                  <option value="21"  >Mayo W21</option>
                  <option value="22"  >Junio W22</option>
                  <option value="23"  >Junio W23</option>
                  <option value="24"  >Junio W24</option>
                  <option value="25"  >Junio W25</option>
                  <option value="26"  >Julio W26</option>
                  <option value="27"  >Julio W27</option>
                  <option value="28"  >Julio W28</option>
                  <option value="29"  >Julio W29</option>
                  <option value="30"  >Agosto W30</option>
                  <option value="31"  >Agosto W31</option>
                  <option value="32"  >Agosto W32</option>
                  <option value="33"  >Agosto W33</option>
                  <option value="34"  >Agosto W34</option>
                  <option value="35"  >Septiembre W35</option>
                  <option value="36"  >Septiembre W36</option>
                  <option value="37"  >Septiembre W37</option>
                  <option value="38"  >Septiembre W38</option>
                  <option value="39"  >Octubre W39</option>
                  <option value="40"  >Octubre W40</option>
                  <option value="41"  >Octubre W41</option>
                  <option value="42"  >Octubre W42</option>
                  <option value="43"  >Noviembre W43</option>
                  <option value="44"  >Noviembre W44</option>
                  <option value="45"  >Noviembre W45</option>
                  <option value="46"  >Noviembre W46</option>
                  <option value="47"  >Noviembre W47</option>
                  <option value="48"  >Diciembre W48</option>
                  <option value="49"  >Diciembre W49</option>
                  <option value="50"  >Diciembre W50</option>
                  <option value="51"  >Diciembre W51</option>
                  <option value="52"  >Diciembre W52</option>

          </select>
        </div>

</div>
  
                    <p></p>
                    <p></p>

                            
                    <p></p>

                    <button class="btn">Graficar</button>

                    <p></p>

                    <div id="grafica" ></div>
                    <div id="btn1"></div> 
                     
                    <p></p>

                    <p></p>

                    <div id="grafica2" ></div>
                    <div id="btn2"></div> 
                     
                    <p></p>

                    <p></p>
                   
                    <div id="grafica3" ></div>
                    <div id="btn3"></div>
                   
                    <p></p>

                   
                     
                   

                    


</section>

</section>

  </section>

  <script type="text/javascript" src={{asset('assets/js/SelectMultiple/Select.js');}}></script>
  <script type="text/javascript" src={{asset('assets/js/Actualizar/Actualizar.js');}}></script>
  <script type="text/javascript">

  $(document).ready(function () {

    $('#anhoI').val(2016);
    $('#semF').val(52);
    $('#anhoF').val(2016);
    $('#semI').val(1);

  })

  </script>




@stop