<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB,View;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * get Order History
     *
     * @return Response
     */
    public function getOrder()
    {
        //
        $GoodsHistory = DB::table('OrderInfo')
                            ->join('Merchant_Combo_Mapping','Merchant_Combo_Mapping.CMB_ID','=','OrderInfo.CMB_ID')
                            ->join('Merchant_Info','Merchant_Info.MRCHNT_ID','=','Merchant_Combo_Mapping.MRCHNT_ID')
                            ->join('Combo_Info','Combo_Info.CMB_ID','=','Merchant_Combo_Mapping.CMB_ID')
                            ->join('Hotel_Info','OrderInfo.HTL_ID','=','Hotel_Info.HTL_ID')
                            ->select('OrderInfo.ORDR_ID as ORDR_ID',
                                'Combo_Info.CMB_NM as CMB_NM',
                                'Merchant_Info.MRCHNT_NM as MRCHNT_NM',
                                'Hotel_Info.HTL_NM as HTL_NM',                                
                                'OrderInfo.ORDR_TSTMP as ORDR_TSTMP',
                                'Combo_Info.CMB_PRC as CMB_PRC',
                                'OrderInfo.STATUS as STATUS')
                            ->get();
        return response()->json($GoodsHistory);
    }
 /**
     * change order status
     *
     * @return Response
     */
    public function updateStatus(Request $request)
    {
        $ORDR_ID = $request->input('ORDR_ID');
        $STATUS = $request->input('STATUS');
        try {
            DB::beginTransaction();   //////  Important !! TRANSACTION Begin!!!
            if($STATUS == '已下单'){
                DB::update('update OrderInfo set STATUS = ?, ORDR_TAKEN_TSTMP = ? where ORDR_ID = ?',
                    array($STATUS, date('Y-m-d H:i:s'), $ORDR_ID ) );
            }else{
                DB::update('update OrderInfo set STATUS = ? where ORDR_ID = ?',
                    array($STATUS, $ORDR_ID ) );
            }

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

    public function Change2Start($ORDR_ID){
        DB::table('OrderInfo')
            ->where('OrderInfo.ORDR_ID','=',$ORDR_ID)
            ->update(array(
                "STATUS" => "已下单"
            ));
    }

    public function Change2Finish($ORDR_ID){
        DB::table('OrderInfo')
            ->where('OrderInfo.ORDR_ID','=',$ORDR_ID)
            ->update(array(
                "STATUS" => "已送达"
            ));
    }    

    public function Change2Cancel($ORDR_ID){
        DB::table('OrderInfo')
            ->where('OrderInfo.ORDR_ID','=',$ORDR_ID)
            ->update(array(
                "STATUS" => "已取消"
            ));
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
