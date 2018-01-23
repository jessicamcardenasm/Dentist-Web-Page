
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/test', function()
{
	return View::make('test');
});


Route::post("nuevocoment","comentController@nuevocoment");



//Routes para los selects

Route::get('/getdataSemIAnhoF',['uses'=>'SelectController@getSemIAnhoF','as'=>'getSemIAnhoF']);
Route::get('/getdataSemF1',['uses'=>'SelectController@getSemF1','as'=>'getSemF1']);
Route::get('/getdataSemF2',['uses'=>'SelectController@getSemF2','as'=>'getSemF2']);
Route::get('/getSemanaSup',['uses'=>'SelectController@getSemSuperv','as'=>'getSemSuperv']);


//==================== RUTAS LOGIN ============================================//

Route::get('/', function()
{
	return View::make('login');
});

Route::get('/login', function()
{
	return View::make('login');
});

Route::get("login",array("before"=>"guest",function(){
	return View::make('login');
}));

Route::post("postLogin","AuthController@postLogin");

//Procesa al usuario e identifica al
Route::post("createUser",["uses"=>"AuthController@createUser",'before'=>'guest']);

//Desconecta al usuario
Route::get("Exit",['uses' => "AuthController@logOut", 'before' => 'auth']);

// =============== FILTROS ===========================//


Route::get('/HomeCockpit',array( function()
{
	return View::make('Home');

}));

// ======================= ACTUALIZAR ===========================================================================//
Route::get('/getelementos',array('uses'=>'actualizarController@getelementos','as'=>'getelementos'));
Route::get('/actualizar',array('uses'=>'actualizarController@actualizarvista','as'=>'actualizarvista'));
Route::get('/updatecomentario',array('uses'=>'actualizarController@updatecomentario','as'=>'updatecomentario'));
Route::get('/getcomentario',array('uses'=>'actualizarController@getcomentario','as'=>'getcomentario'));
Route::get('/updatelimite',array('uses'=>'actualizarController@updatelimite','as'=>'updatelimite'));


//===================================== RUTAS Roaming Mayoristas ===========================================================//

Route::get('/HomeRoaming',array('uses'=>'roamingController@homeRoaming','as'=>'homeRoaming'));

//===================================== RUTAS VAS ===========================================================//

Route::get('/HomeVasSmsc',array('uses'=>'vasController@homeVasSmsc','as'=>'homeVasSmsc'));
Route::get('/HomeVasUssd',array('uses'=>'vasController@homeVasUssd','as'=>'homeVasUssd'));
Route::get('/HomeVasDmm',array('uses'=>'vasController@homeVasDmm','as'=>'homeVasDmm'));
Route::get('/HomeVasMmsc',array('uses'=>'vasController@homeVasMmsc','as'=>'homeVasMmsc'));


Route::get('/getdatosvas1',array('uses'=>'vasController@getdatos1','as'=>'getdatos1'));
Route::get('/getdatosvas2',array('uses'=>'vasController@getdatos2','as'=>'getdatos2'));
Route::get('/getdatosvas3',array('uses'=>'vasController@getdatos3','as'=>'getdatos3'));
Route::get('/getdatosvas4',array('uses'=>'vasController@getdatos4','as'=>'getdatos4'));






//===================================== RUTAS Prepaid ===========================================================//


Route::get('/HomePrepaidServices',array('uses'=>'prepaidController@homePrepaidServices','as'=>'homePrepaidServices'));
Route::get('/HomePrepaidIcc',array('uses'=>'prepaidController@homePrepaidIcc','as'=>'homePrepaidIcc'));
Route::get('/HomePrepaidLicense',array('uses'=>'prepaidController@homePrepaidLicense','as'=>'homePrepaidLicense'));

Route::get('/getdatosprepaid1',array('uses'=>'prepaidController@getdatos1','as'=>'getdatos1'));
Route::get('/getdatosprepaid2',array('uses'=>'prepaidController@getdatos2','as'=>'getdatos2'));
Route::get('/getdatosprepaid3',array('uses'=>'prepaidController@getdatos3','as'=>'getdatos3'));


//===================================== RUTAS Datacomm ===========================================================//


Route::get('/HomeDatacommNE',array('uses'=>'datacommController@homeDatacommNE','as'=>'homeDatacommNE'));
Route::get('/HomeDatacommEnlaces',array('uses'=>'datacommController@homeDatacommEnlaces','as'=>'homeDatacommEnlaces'));


Route::get('/getdatosdatacomm1',array('uses'=>'datacommController@getdatos1','as'=>'getdatos1'));
Route::get('/getdatosdatacomm2',array('uses'=>'datacommController@getdatos2','as'=>'getdatos2'));

//===================================== RUTAS Datos ===========================================================//


Route::get('/HomeDatosUsn',array('uses'=>'datosController@homeDatosUsn','as'=>'homeDatosUsn'));
Route::get('/HomeDatosUgw',array('uses'=>'datosController@homeDatosUgw','as'=>'homeDatosUgw'));
Route::get('/HomeDatosCpu',array('uses'=>'datosController@homeDatosCpu','as'=>'homeDatosCpu'));


Route::get('/getdatosdatos1',array('uses'=>'datosController@getdatos1','as'=>'getdatos1'));
Route::get('/getdatosdatos2',array('uses'=>'datosController@getdatos2','as'=>'getdatos2'));
Route::get('/getdatosdatos3',array('uses'=>'datosController@getdatos3','as'=>'getdatos3'));

//===================================== RUTAS Transporte ===========================================================//


Route::get('/TransporteNorte',array('uses'=>'transporteController@TransporteNorte','as'=>'TransporteNorte'));
Route::get('/TransporteCentro',array('uses'=>'transporteController@TransporteCentro','as'=>'TransporteCentro'));
Route::get('/TransporteSur',array('uses'=>'transporteController@TransporteSur','as'=>'TransporteSur'));
Route::get('/TransporteLima',array('uses'=>'transporteController@TransporteLima','as'=>'TransporteLima'));


Route::get('/getdatostransporte1',array('uses'=>'transporteController@getdatos1','as'=>'getdatos1'));
Route::get('/getdatostransporte2',array('uses'=>'transporteController@getdatos2','as'=>'getdatos2'));
Route::get('/getdatostransporte3',array('uses'=>'transporteController@getdatos3','as'=>'getdatos3'));
Route::get('/getdatostransporte4',array('uses'=>'transporteController@getdatos4','as'=>'getdatos4'));


//===================================== RUTAS RAN ===========================================================//


Route::get('/HomeRanIden',array('uses'=>'ranController@homeRanIden','as'=>'homeRanIden'));
Route::get('/HomeRanRnc',array('uses'=>'ranController@homeRanRnc','as'=>'homeRanRnc'));
Route::get('/HomeRanBsc',array('uses'=>'ranController@homeRanBsc','as'=>'homeRanBsc'));


Route::get('/getdatosran1',array('uses'=>'ranController@getdatos1','as'=>'getdatos1'));
Route::get('/getdatosran2',array('uses'=>'ranController@getdatos2','as'=>'getdatos2'));
Route::get('/getdatosran3',array('uses'=>'ranController@getdatos3','as'=>'getdatos3'));


//===================================== RUTAS VOZ ===========================================================//


Route::get('/HomeVozMsc',array('uses'=>'vozController@homeVozMsc','as'=>'homeVozMsc'));
Route::get('/HomeVozGmsc',array('uses'=>'vozController@homeVozGmsc','as'=>'homeVozGmsc'));
Route::get('/HomeVozUmgs',array('uses'=>'vozController@homeVozUmgs','as'=>'homeVozUmgs'));
Route::get('/HomeVozBicc',array('uses'=>'vozController@homeVozBicc','as'=>'homeVozBicc'));
Route::get('/HomeVozTroncales',array('uses'=>'vozController@homeVozTroncales','as'=>'homeVozTroncales'));
Route::get('/HomeVozLicencias',array('uses'=>'vozController@homeVozLicencias','as'=>'homeVozLicencias'));


Route::get('/getdatosvoz1',array('uses'=>'vozController@getdatos1','as'=>'getdatos1'));
Route::get('/getdatosvoz2',array('uses'=>'vozController@getdatos2','as'=>'getdatos2'));
Route::get('/getdatosvoz3',array('uses'=>'vozController@getdatos3','as'=>'getdatos3'));
Route::get('/getdatosvoz4',array('uses'=>'vozController@getdatos4','as'=>'getdatos4'));
Route::get('/getdatosvoz5',array('uses'=>'vozController@getdatos5','as'=>'getdatos5'));
Route::get('/getdatosvoz6',array('uses'=>'vozController@getdatos6','as'=>'getdatos6'));

//===================================== RUTAS ISP ===========================================================//


Route::get('/HomeIsp1',array('uses'=>'ispController@homeIsp1','as'=>'homeIsp1'));
Route::get('/HomeIsp2',array('uses'=>'ispController@homeIsp2','as'=>'homeIsp2'));
Route::get('/HomeIsp3',array('uses'=>'ispController@homeIsp3','as'=>'homeIsp3'));
Route::get('/HomeIsp4',array('uses'=>'ispController@homeIsp4','as'=>'homeIsp4'));
Route::get('/HomeIsp5',array('uses'=>'ispController@homeIsp5','as'=>'homeIsp5'));
Route::get('/HomeIsp6',array('uses'=>'ispController@homeIsp6','as'=>'homeIsp6'));


Route::get('/getdatosisp1',array('uses'=>'ispController@getdatos1','as'=>'getdatos1'));
Route::get('/getdatosisp2',array('uses'=>'ispController@getdatos2','as'=>'getdatos2'));
Route::get('/getdatosisp3',array('uses'=>'ispController@getdatos3','as'=>'getdatos3'));
Route::get('/getdatosisp4',array('uses'=>'ispController@getdatos4','as'=>'getdatos4'));
Route::get('/getdatosisp5',array('uses'=>'ispController@getdatos5','as'=>'getdatos5'));
Route::get('/getdatosisp6',array('uses'=>'ispController@getdatos6','as'=>'getdatos6'));


//===================================== RUTAS CARGA ===========================================================//



Route::get('/DatosDatos',array('uses'=>'cargaController@datosDatos','as'=>'datosDatos'));
Route::get('/getDocumentos',['uses'=>'cargaController@getDocumentos','as'=>'getDocumentos']);
Route::get('/postEliminar',['uses'=>'cargaController@postEliminar','as'=>'postEliminar']);
Route::get('/actualizarDocumentoView',array('uses'=>'cargaController@actualizarDocumentoView','as'=>'actualizarDocumentoView'));
Route::get('/postEliminar',['uses'=>'cargaController@postEliminar','as'=>'postEliminar']);
Route::get('/postActualizarDocumento',['uses'=>'cargaController@postActualizarDocumento','as'=>'postActualizarDocumento']);



Route::post('postData','cargaController@postData');
Route::post('postDataActualizar','cargaController@postDataActualizar');

//===================================== RUTAS DISASTER ===========================================================//
Route::get('/Disaster',array('uses'=>'disasterController@disaster','as'=>'disaster'));
Route::get('/HomeDisaster',array('uses'=>'disasterController@homedisaster','as'=>'homedisaster'));
Route::post('/crearEvento',array('uses'=>'disasterController@crearEvento','as'=>'crearEvento'));
Route::get('/getEventos',['uses'=>'disasterController@getEventos','as'=>'getEventos']);
Route::get('/getEvento_id',['uses'=>'disasterController@getEvento_id','as'=>'getEvento_id']);
Route::get('/getValorNuevo',['uses'=>'disasterController@getValorNuevo','as'=>'getValorNuevo']);


Route::get('/getTitulos',['uses'=>'disasterController@getTitulos','as'=>'getTitulos']);
Route::get('/getTabla_evento',['uses'=>'disasterController@getTabla_evento','as'=>'getTabla_evento']);
Route::get('/postEstadoNuevo',['uses'=>'disasterController@postEstadoNuevo','as'=>'postEstadoNuevo']);
Route::get('/postObservacion',array('uses'=>'disasterController@postObservacion','as'=>'postObservacion'));
Route::get('/getObservacion',array('uses'=>'disasterController@getObservacion','as'=>'getObservacion'));
Route::get('/actualizarDetalle',array('uses'=>'disasterController@actualizarDetalle','as'=>'actualizarDetalle'));

Route::get('/cerrarEvento',array('uses'=>'disasterController@cerrarEvento','as'=>'cerrarEvento'));

