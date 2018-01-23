@extends('../ViewParent')





@section('dmm')
@parent


<script type="text/javascript" src="http://www.highcharts.com/highslide/highslide-full.min.js"></script>
<script type="text/javascript" src="http://www.highcharts.com/highslide/highslide.config.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="http://www.highcharts.com/highslide/highslide.css" />



    <script type="text/javascript">

    var category;

  
    
    $(function () {  

          
          var Data1;
          var Comentario1;

          var Data2;
          var Comentario2;

          var Data3;
          var Comentario3;

          var Data4;
          var Comentario4;
          
 
          $(".btn").on('click', function(){
                var week_1=$('#semI').val();
                var week_2=$('#semF').val();
                var anho_1=$('#anhoI').val();
                var anho_2=$('#anhoF').val();
                
                $.get( ip+"getdatosvas3", { "anho_1": anho_1, "week_1": week_1, "anho_2": anho_2, "week_2": week_2 } ).done(function( data) {

                        console.log(data["semanas"].length);

                        Data1=[

                        {data:[],name:'TM1'},
                        {data:[],name:'TM2'},
                        {data:[],name:'TM3'},
                        {data:[],name:'MDSUAPP 1A'},
                        {data:[],name:'MDSUAPP 1B'},
                        {data:[],name:'CDR 1'},
                        {data:[],name:'CDR2'},
                        {data:[],name:'LBA-F5-1A'},
                        {data:[],name:'LBA-F5-1B'},
                        {data:[], color:"#FC1414", name:'Limit', marker: {radius: 0}}

                        ];

                        Data2=[

                        {data:[],name:'TM1'},
                        {data:[],name:'TM2'},
                        {data:[],name:'TM3'},
                        {data:[],name:'MDSUAPP 1A'},
                        {data:[],name:'MDSUAPP 1B'},
                        {data:[],name:'CDR 1'},
                        {data:[],name:'CDR2'},
                        {data:[],name:'LBA-F5-1A'},
                        {data:[],name:'LBA-F5-1B'},
                        {data:[], color:"#FC1414", name:'Limit', marker: {radius: 0}}

                        ];
                        
                        Data3=[

                        {data:[],name:'TM1'},
                        {data:[],name:'TM2'},
                        {data:[],name:'TM3'},
                        {data:[],name:'MDSUAPP 1A'},
                        {data:[],name:'MDSUAPP 1B'},
                        {data:[],name:'CDR 1'},
                        {data:[],name:'CDR2'},
                        {data:[],name:'LBA-F5-1A'},
                        {data:[],name:'LBA-F5-1B'},
                        {data:[], color:"#FC1414", name:'Limit', marker: {radius: 0}}

                        ];

                        Data4=[

                        {data:[],name:'Concurrent PDP contexts'},
                        {data:[],name:'Throughput(mbps)'},
                        {data:[],name:'Transactions per second'},
                        {data:[], color:"#FC1414", name:'Limit', marker: {radius: 0}}

                        ];

                        category=[];

                        Comentario1={

                        "TM1": {"data":[],name:'TM1'},
                        "TM2": {"data":[],name:'TM2'},
                        "TM3": {"data":[],name:'TM3'},
                        "MDSUAPP 1A": {"data":[],name:'MDSUAPP 1A'},
                        "MDSUAPP 1B": {"data":[],name:'MDSUAPP 1B'},
                        "CDR 1": {"data":[],name:'CDR 1'},
                        "CDR 2": {"data":[],name:'CDR 2'},
                        "LBA-F5-1A": {"data":[],name:'LBA-F5-1A'},
                        "LBA-F5-1B": {"data":[],name:'LBA-F5-1B'}

                        };

                        Comentario2={

                        "TM1":{"data":[],name:'TM1'},
                        "TM2":{"data":[],name:'TM2'},
                        "TM3":{"data":[],name:'TM3'},
                        "MDSUAPP 1A":{"data":[],name:'MDSUAPP 1A'},
                        "MDSUAPP 1B":{"data":[],name:'MDSUAPP 1B'},
                        "CDR 1":{"data":[],name:'CDR 1'},
                        "CDR 2":{"data":[],name:'CDR2'},
                        "LBA-F5-1A":{"data":[],name:'LBA-F5-1A'},
                        "LBA-F5-1B":{"data":[],name:'LBA-F5-1B'}
                        
                        };

                        Comentario3={

                        "TM1":{"data":[],name:'TM1'},
                        "TM2":{"data":[],name:'TM2'},
                        "TM3":{"data":[],name:'TM3'},
                        "MDSUAPP 1A":{"data":[],name:'MDSUAPP 1A'},
                        "MDSUAPP 1B":{"data":[],name:'MDSUAPP 1B'},
                        "CDR 1":{"data":[],name:'CDR 1'},
                        "CDR 2":{"data":[],name:'CDR2'},
                        "LBA-F5-1A":{"data":[],name:'LBA-F5-1A'},
                        "LBA-F5-1B":{"data":[],name:'LBA-F5-1B'}
                        
                        };

                        
                        Comentario4={

                        "Concurrent PDP contexts":{data:[],name:'Concurrent PDP contexts'},
                        "Throughput(mbps)":{data:[],name:'Throughput(mbps)'},
                        "Transactions per second":{data:[],name:'Transactions per second'}
                        
                        };
                       

                        //4 es el numero de elementos en la grafica g1
                        for (var j = 0; j < 9; j++) {
                              for (var i = 0; i < data["g1"]["data"][0].length; i++) 

                              {
                                 Data1[j]['data'].push(parseFloat(data['g1']['data'][j][i]['valor']));
                                 
                              }
                        }
                              
                        
                        for (var j = 0; j < 9; j++) {
                              for (var i = 0; i < data["g2"]["data"][0].length; i++) 

                              {
                                 Data2[j]['data'].push(parseFloat(data['g2']['data'][j][i]['valor']));
                                 
                              }
                        }

                        for (var j = 0; j < 9; j++) {
                              for (var i = 0; i < data["g3"]["data"][0].length; i++) 

                              {
                                 Data3[j]['data'].push(parseFloat(data['g3']['data'][j][i]['valor']));
                                 
                              }
                        }


                        for (var j = 0; j < 3; j++) {
                              for (var i = 0; i < data["g4"]["data"][0].length; i++) 

                              {
                                 Data4[j]['data'].push(parseFloat(data['g4']['data'][j][i]['valor']));
                                 
                              }
                        }

                        
                        var name1="";
                        for(var j = 0; j < 9; j++) {
                                for (var i = 0; i< data["g1"]["data"][0].length; i++) {

                                  switch(j){
                                    case 0:name1="TM1"; break;
                                    case 1:name1="TM2"; break;
                                    case 2:name1="TM3"; break;
                                    case 3:name1="MDSUAPP 1A"; break;
                                    case 4:name1="MDSUAPP 1B"; break;
                                    case 5:name1="CDR 1"; break;
                                    case 6:name1="CDR 2"; break;
                                    case 7:name1="LBA-F5-1A"; break;
                                    case 8:name1="LBA-F5-1B"; break;
                                  };

                                  Comentario1[name1]['data'].push(data['g1']['data'][j][i]['comentario']);
                                  

                                }
                        }


                        var name1="";
                        for(var j = 0; j < 9; j++) {
                                for (var i = 0; i< data["g2"]["data"][0].length; i++) {

                                  switch(j){
                                    case 0:name1="TM1"; break;
                                    case 1:name1="TM2"; break;
                                    case 2:name1="TM3"; break;
                                    case 3:name1="MDSUAPP 1A"; break;
                                    case 4:name1="MDSUAPP 1B"; break;
                                    case 5:name1="CDR 1"; break;
                                    case 6:name1="CDR 2"; break;
                                    case 7:name1="LBA-F5-1A"; break;
                                    case 8:name1="LBA-F5-1B"; break;
                                  };

                                  Comentario2[name1]['data'].push(data['g2']['data'][j][i]['comentario']);
                                  

                                }
                        }

                        var name1="";
                        for(var j = 0; j < 9; j++) {
                                for (var i = 0; i< data["g3"]["data"][0].length; i++) {

                                  switch(j){
                                    case 0:name1="TM1"; break;
                                    case 1:name1="TM2"; break;
                                    case 2:name1="TM3"; break;
                                    case 3:name1="MDSUAPP 1A"; break;
                                    case 4:name1="MDSUAPP 1B"; break;
                                    case 5:name1="CDR 1"; break;
                                    case 6:name1="CDR 2"; break;
                                    case 7:name1="LBA-F5-1A"; break;
                                    case 8:name1="LBA-F5-1B"; break;
                                  };

                                  Comentario3[name1]['data'].push(data['g3']['data'][j][i]['comentario']);
                                  

                                }
                        }

                        var name1="";
                        for(var j = 0; j < 3; j++) {
                                for (var i = 0; i< data["g4"]["data"][0].length; i++) {

                                  switch(j){
                                    case 0:name1="Concurrent PDP contexts"; break;
                                    case 1:name1="Throughput(mbps)"; break;
                                    case 2:name1="Transactions per second"; break;
                                    
                                  };

                                  Comentario4[name1]['data'].push(data['g4']['data'][j][i]['comentario']);
                                  

                                }
                        }
                      
                        

                        for (var i = 0; i < data["semanas"].length; i++) {
                          category.push(data["semanas"][i]["semana"]);
                          Data1[9]['data'].push(parseFloat(data['g1']['limite'][0]['limite']));
                          Data2[9]['data'].push(parseFloat(data['g2']['limite'][0]['limite']));
                          Data3[9]['data'].push(parseFloat(data['g3']['limite'][0]['limite']));
                          Data4[3]['data'].push(parseFloat(data['g4']['limite'][0]['limite']));

                        }

                        var new_category=getcategory(category);


                        var g1_nombre = data['g1']['nombre'][0]['nombre'];
                        var g2_nombre = data['g2']['nombre'][0]['nombre'];
                        var g3_nombre = data['g3']['nombre'][0]['nombre'];
                        var g4_nombre = data['g4']['nombre'][0]['nombre'];

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
                                                            Comentario1[this.series.name]['data'][this.x].replace(/\n/g,'<br>')+ "</p>",
                                                           
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
                                                            Comentario2[this.series.name]['data'][this.x].replace(/\n/g,'<br>')+ "</p>",
                                                           
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
                                                            Comentario3[this.series.name]['data'][this.x].replace(/\n/g,'<br>')+ "</p>",
                                                           
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


                                $('#grafica4').highcharts({
                                        title: {
                                            text: g4_nombre,
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
                                                            Comentario4[this.series.name]['data'][this.x].replace(/\n/g,'<br>')+ "</p>",
                                                           
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

                                        series: Data4

                                });
                          
                            $("#btn1").empty();
                            $("#btn1").append("<button onclick='abrirVentana(5,90, category)' >Actualizar </button>");

                            $("#btn2").empty();
                            $("#btn2").append("<button onclick='abrirVentana(5,91, category)' >Actualizar </button>");

                            $("#btn3").empty();
                            $("#btn3").append("<button onclick='abrirVentana(5,92, category)' >Actualizar </button>");

                            $("#btn4").empty();
                            $("#btn4").append("<button onclick='abrirVentana(5,93, category)' >Actualizar </button>");

                });


        });      

    });

    
  
    </script>

    



  

   




<!-- ////////////////////////// Select de año y semanas ////////////////////////////////////////-->




      <section class="wrapper">

          <section id="main-content">

               <section class="wrapper">
                <h3 >Cockpit VAS - DMM</h3>
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
            <option value="2015"  >2015</option>
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

                    <p></p>

                    <div id="grafica4" ></div>
                    <div id="btn4"></div> 
                     
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