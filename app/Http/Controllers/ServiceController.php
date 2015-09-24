<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB,View,PDO;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

class ServiceController extends Controller
{
    /**
     * get Order History
     *
     * @return Response
     */

    public function getService()
    {
        //
        $ServiceInfo = DB::table('Merchant_Info')
                            ->join('Merchant_Combo_Mapping','Merchant_Combo_Mapping.MRCHNT_ID','=','Merchant_Info.MRCHNT_ID')
                            ->join('Combo_Info','Combo_Info.CMB_ID','=','Merchant_Combo_Mapping.CMB_ID')
                            ->select('Combo_Info.CMB_ID as CMB_ID',
                                'Combo_Info.CMB_NM as CMB_NM',
                                'Merchant_Info.MRCHNT_NM as MRCHNT_NM',
                                'Merchant_Info.MRCHNT_TP as MRCHNT_TP',                                
                                'Merchant_Info.MRCHNT_CVR as MRCHNT_CVR',
                                'Merchant_Info.MRCHNT_ID as MRCHNT_ID',
                                'Combo_Info.CMB_PRC as CMB_PRC',
                                'Combo_Info.CMB_TP as CMB_TP',
                                'Combo_Info.CMB_MTHD as CMB_MTHD',
                                'Combo_Info.CMB_RMRK as CMB_RMRK',
                                'Combo_Info.CMB_INPT_TSTMP as CMB_INPT_TSTMP',
                                'Combo_Info.CMB_OTSTND_AMNTS as CMB_OTSTND_AMNTS',
                                'Combo_Info.CMB_STATUS as CMB_STATUS') 
                            ->get();
        return response()->json($ServiceInfo);
    }

    public function getServiceTypes()
    {
        $ServiceTypes = DB::table('Service_Type_Info')
            ->get();
        return response()->json($ServiceTypes);
    }
    
    // public function getService()
    // {
    //     //
    //     $ServiceInfo = DB::table('Merchant_Info')
    //                         ->join('Merchant_Combo_Mapping','Merchant_Combo_Mapping.MRCHNT_ID','=','Merchant_Info.MRCHNT_ID')
    //                         ->join('Combo_Info','Combo_Info.CMB_ID','=','Merchant_Combo_Mapping.CMB_ID')
    //                         ->join('OrderInfo','OrderInfo.CMB_ID','=','Merchant_Combo_Mapping.CMB_ID')
    //                         ->where('OrderInfo.STATUS','=','已送达')                            
    //                         ->join('Transaction_Info','OrderInfo.TRN_ID','=','Transaction_Info.TRN_ID')
    //                         ->where('Transaction_Info.PYMNT_MTHD','=','货到付现')
    //                         ->select('OrderInfo.CMB_ID as CMB_ID',
    //                             'Combo_Info.CMB_NM as CMB_NM',
    //                             'Merchant_Info.MRCHNT_NM as MRCHNT_NM',
    //                             'Merchant_Info.MRCHNT_TP as MRCHNT_TP',                                
    //                             'Merchant_Info.MRCHNT_GEO_ID as MRCHNT_GEO_ID',
    //                             'Combo_Info.CMB_PRC as CMB_PRC',
    //                             'OrderInfo.STATUS as STATUS',
    //                             'Combo_Info.CMB_LNK as CMB_LNK') 
    //                         ->get();
    //     return response()->json($ServiceInfo);
    // }
 /**
     * change order status
     *
     * @return Response
     */
    public function postServiceInfo(Request $request){

        $combo= $request->input('combo');
        $merchant=$request->input('merchant');
        $relation=null;
        DB::setFetchMode(PDO::FETCH_ASSOC);

        $items=DB::table('Merchant_Info')
            ->where('Merchant_Info.MRCHNT_NM','=',$merchant['MRCHNT_NM'])
            ->select('Merchant_Info.MRCHNT_ID as MRCHNT_ID')
            ->get();

        DB::setFetchMode(PDO::FETCH_CLASS);            
// var_dump(head($flag));
        $flag=head($items);
        // var_dump(head($flag)); 
        if(!$flag)
        {
            try {
                DB::beginTransaction();   //////  Important !! TRANSACTION Begin!!!
                 
                $CMB_ID=DB::table('Combo_Info')->insertGetId($combo);
                $MRCHNT_ID=DB::table('Merchant_Info')->insertGetId($merchant);

                $relation['MRCHNT_ID']=$MRCHNT_ID;
                $relation['CMB_ID']=$CMB_ID;
                DB::table('Merchant_Combo_Mapping')->insert($relation);
            }catch (Exception $e){
                DB::rollback();
                $message=($e->getLine())."&&".$e->getMessage();
    //            throw new Exception($message);
                return response()->json('数据库错误'+$message);
            }finally{
                DB::commit();

                return response()->json('成功');
            }                          
        }
        else
        {
            try {
               
                DB::beginTransaction();   //////  Important !! TRANSACTION Begin!!!
                $CMB_ID=DB::table('Combo_Info')->insertGetId($combo);
                $relation['MRCHNT_ID']=$flag['MRCHNT_ID'];
                $relation['CMB_ID']=$CMB_ID;    
                DB::table('Merchant_Combo_Mapping')->insert($relation);

            }catch (Exception $e){
                DB::rollback();
                $message=($e->getLine())."&&".$e->getMessage();
    //            throw new Exception($message);
                return response()->json('数据库错误'+$message);
            }finally{
                DB::commit();
                return response()->json('成功');
            }             
        }
     
    }

    public function queryMerchant($MRCHNT_NM){
        $Merchant_Info = DB::table('Merchant_Info')
            ->where('Merchant_Info.MRCHNT_NM','=',$MRCHNT_NM)
            ->select('Merchant_Info.MRCHNT_TP as MRCHNT_TP',
                     'Merchant_Info.MRCHNT_PHN as MRCHNT_PHN',
                     'Merchant_Info.MRCHNT_CVR as MRCHNT_CVR')
            ->get();
        return response()->json($Merchant_Info);        
    }

    public function postHotelInfo(Request $request)
    {
        $hotelInfo = $request->input('hotelInfo');
        try {
            DB::beginTransaction();   //////  Important !! TRANSACTION Begin!!!
            $HTL_INFO_ID=DB::table('Hotel_Info')->insertGetId($hotelInfo);

        }catch (Exception $e){
            DB::rollback();
            $message=($e->getLine())."&&".$e->getMessage();
//            throw new Exception($message);
            return response()->json('数据库错误'+$message);
        }finally{
            DB::commit();
            return response()->json('成功');
        }
    }        

    public function Change2NormalService($CMB_ID){
        DB::table('Combo_Info')
            ->where('Combo_Info.CMB_ID','=',$CMB_ID)
            ->update(array(
                "CMB_STATUS" => "开通"
            ));
    }

    public function Change2PauseService($CMB_ID){
        DB::table('Combo_Info')
            ->where('Combo_Info.CMB_ID','=',$CMB_ID)
            ->update(array(
                "CMB_STATUS" => "服务暂停"
            ));
    }    

    public function updateServiceInfo(Request $request){
        $serviceID = $request->input('serviceID');
        $serviceInfo = $request->input('serviceInfo'); 

        DB::setFetchMode(PDO::FETCH_ASSOC);

        $merchantID=DB::table('Merchant_Combo_Mapping')
            ->where('Merchant_Combo_Mapping.CMB_ID','=',$serviceID)
            ->select('Merchant_Combo_Mapping.MRCHNT_ID as MRCHNT_ID')
            ->get();

        var_dump($serviceInfo);
        DB::setFetchMode(PDO::FETCH_CLASS);      

        DB::table('Merchant_Info')
            ->where('Merchant_Info.MRCHNT_ID','=',$merchantID)
            ->update(array(
                "MRCHNT_TP" => $serviceInfo['MRCHNT_TP'],
                "MRCHNT_NM" => $serviceInfo['MRCHNT_NM'],
                "MRCHNT_PHN" => $serviceInfo['MRCHNT_PHN'],
                "MRCHNT_CVR" => $serviceInfo['MRCHNT_CVR']             
            ));   

        DB::table('Combo_Info')
            ->where('Combo_Info.CMB_ID','=',$serviceID)
            ->update(array(
                "CMB_NM" => $serviceInfo['CMB_NM'],
                "CMB_MTHD" => $serviceInfo['CMB_MTHD'], 
                "CMB_PRC" => $serviceInfo['CMB_PRC'],           
                "CMB_RMRK" => $serviceInfo['CMB_RMRK']              
            ));        
    }

    public function getServiceInfo($CMB_ID){
        $ServiceInfo = DB::table('Merchant_Info')
                            ->join('Merchant_Combo_Mapping','Merchant_Combo_Mapping.MRCHNT_ID','=','Merchant_Info.MRCHNT_ID')
                            ->join('Combo_Info','Combo_Info.CMB_ID','=','Merchant_Combo_Mapping.CMB_ID')
                            ->where('Combo_Info.CMB_ID','=',$CMB_ID)
                            ->select('Combo_Info.CMB_NM as CMB_NM',
                                'Merchant_Info.MRCHNT_NM as MRCHNT_NM',
                                'Merchant_Info.MRCHNT_TP as MRCHNT_TP',                                
                                'Merchant_Info.MRCHNT_CVR as MRCHNT_CVR',
                                'Merchant_Info.MRCHNT_PHN as MRCHNT_PHN', 
                                'Combo_Info.CMB_PRC as CMB_PRC',
                                'Combo_Info.CMB_TP as CMB_TP',
                                'Combo_Info.CMB_MTHD as CMB_MTHD',
                                'Combo_Info.CMB_RMRK as CMB_RMRK') 
                            ->get();
        return response()->json($ServiceInfo);        
    }

    public function getHotelRelation($CMB_ID){
        $ServiceInfo = DB::table('Hotel_Combo_Mapping')
                            ->join('Hotel_Info','Hotel_Combo_Mapping.HTL_ID','=','Hotel_Info.HTL_ID')
                            ->where('Hotel_Combo_Mapping.CMB_ID','=',$CMB_ID)
                            ->select('Hotel_Info.HTL_ID as HTL_ID')
                                // ,'Hotel_Info.HTL_NM as HTL_NM',
                                // 'Hotel_Info.HTL_CT as HTL_CT',                                
                                // 'Hotel_Info.HTL_ADDRSS as HTL_ADDRSS',
                                // 'Hotel_Info.HTL_TP as HTL_TP',
                                // 'Hotel_Info.HTL_STATUS as HTL_STATUS') 
                            ->get();
        return response()->json($ServiceInfo);        
    }  

    public function deleteService($CMB_ID){
        DB::table('Combo_Info')
        ->where('Combo_Info.CMB_ID','=',$CMB_ID)
        ->delete();
    }      

    public function getAllHotel()
    {
        //
        $HotelInfo = DB::table('Hotel_Info')
                    ->select('Hotel_Info.HTL_ID as HTL_ID',
                            'Hotel_Info.HTL_NM as HTL_NM',
                            'Hotel_Info.HTL_CT as HTL_CT',                                
                            'Hotel_Info.HTL_ADDRSS as HTL_ADDRSS',
                            'Hotel_Info.HTL_TP as HTL_TP',
                            'Hotel_Info.HTL_STATUS as HTL_STATUS') 
                            ->get();
        return response()->json($HotelInfo);
    }


    public function postServiceNewRelation(Request $request){
        $relations = $request->input('relation');
        $serviceID = $request->input('serviceID');


        DB::table('Hotel_Combo_Mapping')
        ->where('Hotel_Combo_Mapping.CMB_ID','=',$serviceID)
        ->delete();

        foreach($relations as $relation)
        { 
            DB::table('Hotel_Combo_Mapping')
              ->insert(
                array('HTL_ID' => $relation,
                      'CMB_ID' => $serviceID)
            ); 
        }            
    }

      public function upload() {
        if(Input::hasFile('file')) {
          //upload an image to the /img directory and return the filepath.
          $file = Input::file('file');
          $name = Input::file('name');
          $tmpFilePath = '/img';
          $tmpFileName = time() . '-' . $file->getClientOriginalName();
          $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
          $path = $tmpFilePath . $tmpFileName;
          return response()->json(array('path'=> $path), 200);
        } else {
          return response()->json(false, 200);
        }
      }    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
