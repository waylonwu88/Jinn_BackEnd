<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB,View;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HotelController extends Controller
{
    /**
     * get Order History
     *
     * @return Response
     */

    public function getHotel()
    {
        //
        $HotelInfo = DB::table('Hotel_Info') 
                            ->get();
        return response()->json($HotelInfo);
    }

    public function getHotelTypes()
    {
        $HotelTypes = DB::table('Hotel_Type_Info')
            ->get();
        return response()->json($HotelTypes);
    }
    // public function getHotel()
    // {
    //     //
    //     $HotelInfo = DB::table('Hotel_Info')
    //                         ->join('Transaction_Info','Hotel_Info.HTL_ID','=','Transaction_Info.HTL_ID')
    //                         ->join('OrderInfo','OrderInfo.TRN_ID','=','Transaction_Info.TRN_ID')
    //                         ->where('OrderInfo.STATUS','=','已送达')
    //                         ->select('Transaction_Info.TRN_ID as TRN_ID')
    //                         ->where('Transaction_Info.PYMNT_MTHD','=','酒店挂账')
    //                         ->select('Transaction_Info.HTL_ID as HTL_ID',
    //                             'Hotel_Info.HTL_NM as HTL_NM',
    //                             'Hotel_Info.HTL_ADDRSS as HTL_ADDRSS',
    //                             'Hotel_Info.HTL_TP as HTL_TP',                                
    //                             'Hotel_Info.HTL_NM_OF_RM as HTL_NM_OF_RM',
    //                             'Hotel_Info.HTL_PRM_CNTCT_NM as HTL_PRM_CNTCT_NM',
    //                             'Transaction_Info.PYMNT_TTL as PYMNT_TTL',
    //                             'Transaction_Info.STATUS as STATUS') 
    //                         ->get();
    //     return response()->json($HotelInfo);
    // }
 /**
     * change order status
     *
     * @return Response
     */

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

    public function getHotelInfo($HTL_ID)
    {
        //
        $HotelInfo = DB::table('Hotel_Info')
                    ->where('Hotel_Info.HTL_ID','=',$HTL_ID) 
                            ->get();
        return response()->json($HotelInfo);
    }

    public function Change2NormalHotel($HTL_ID){
        DB::table('Hotel_Info')
            ->where('Hotel_Info.HTL_ID','=',$HTL_ID)
            ->update(array(
                "HTL_STATUS" => "正常"
            ));
    }

    public function Change2PauseHotel($HTL_ID){
        DB::table('Hotel_Info')
            ->where('Hotel_Info.HTL_ID','=',$HTL_ID)
            ->update(array(
                "HTL_STATUS" => "服务暂停"
            ));
    }    

    public function Change2StopHotel($HTL_ID){
        DB::table('Hotel_Info')
            ->where('Hotel_Info.HTL_ID','=',$HTL_ID)
            ->update(array(
                "HTL_STATUS" => "协议终止"
            ));
    }    

    public function updateHotelInfo(Request $request){
        $hotelInfo = $request->input('hotelInfo');
        $hotelID = $request->input('hotelID');
        DB::table('Hotel_Info')
            ->where('Hotel_Info.HTL_ID','=',$hotelID)
            ->update(array(
                "HTL_NM" => $hotelInfo['HTL_NM'],
                "HTL_TP" => $hotelInfo['HTL_TP'],
                "HTL_PRM_CNTCT_NM" => $hotelInfo['HTL_PRM_CNTCT_NM'],
                "HTL_PRM_CNTCT_PHN" => $hotelInfo['HTL_PRM_CNTCT_PHN'],
                "HTL_CT" => $hotelInfo['HTL_CT'],
                "HTL_ADDRSS" => $hotelInfo['HTL_ADDRSS'], 
                "HTL_NM_OF_RM" => $hotelInfo['HTL_NM_OF_RM'],           
                "HTL_UPDT_TSTMP" => $hotelInfo['HTL_UPDT_TSTMP']              
            ));        
    }

    public function getServiceRelation($HTL_ID){
        $Relation = DB::table('Hotel_Combo_Mapping')
            ->where('Hotel_Combo_Mapping.HTL_ID','=',$HTL_ID)
            ->join('Combo_Info','Hotel_Combo_Mapping.CMB_ID','=','Combo_Info.CMB_ID')
            ->join('Merchant_Combo_Mapping','Merchant_Combo_Mapping.CMB_ID','=','Combo_Info.CMB_ID')
            ->join('Merchant_Info','Merchant_Info.MRCHNT_ID','=','Merchant_Combo_Mapping.MRCHNT_ID')
            ->select('Combo_Info.CMB_ID as CMB_ID')
                    // ,'Combo_Info.CMB_NM as CMB_NM',
                    // 'Merchant_Info.MRCHNT_NM as MRCHNT_NM',
                    // 'Merchant_Info.MRCHNT_TP as MRCHNT_TP',
                    // 'Merchant_Info.MRCHNT_GEO_ID as MRCHNT_GEO_ID',
                    // 'Combo_Info.CMB_STATUS as CMB_STATUS')
            ->get();   
        return response()->json($Relation);                  

    }

    public function getAllService()
    {
        //
        $Relation = DB::table('Combo_Info')
            ->join('Merchant_Combo_Mapping','Merchant_Combo_Mapping.CMB_ID','=','Combo_Info.CMB_ID')
            ->join('Merchant_Info','Merchant_Info.MRCHNT_ID','=','Merchant_Combo_Mapping.MRCHNT_ID')
            ->select('Combo_Info.CMB_ID as CMB_ID',
                     'Combo_Info.CMB_NM as CMB_NM',
                    'Merchant_Info.MRCHNT_NM as MRCHNT_NM',
                    'Merchant_Info.MRCHNT_TP as MRCHNT_TP',
                    'Merchant_Info.MRCHNT_GEO_ID as MRCHNT_GEO_ID',
                    'Combo_Info.CMB_STATUS as CMB_STATUS')
            ->get();   
        return response()->json($Relation);  
    }

    public function postNewRelation(Request $request){
        $relations = $request->input('relation');
        $hotelID = $request->input('hotelID');


        DB::table('Hotel_Combo_Mapping')
        ->where('Hotel_Combo_Mapping.CMB_ID','=',$hotelID)
        ->delete();

        foreach($relations as $relation)
        { 
            DB::table('Hotel_Combo_Mapping')
              ->insert(
                array('HTL_ID' => $hotelID,
                      'CMB_ID' => $relation)
            ); 
        }            
    }


    public function deleteHotel($HTL_ID){
        DB::table('Hotel_Info')
        ->where('Hotel_Info.HTL_ID','=',$HTL_ID)
        ->delete();
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
