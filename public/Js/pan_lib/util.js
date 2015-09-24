var util = {
    Limit : function(num){
        return Number(parseFloat(num).toFixed(2));
    },
    isNum : function(testee){
        return (!isNaN(testee) && testee!=null && testee.toString().trim()!="" );
    },
    deepCopy: function(copyee){
        return  JSON.parse(JSON.stringify(copyee));
    },
    //--------------------   订单查询页面  ---------------------------
    orderIconAction :  [{icon:"",action:"状态修改"},
        {icon:"",action:"已下单"},
        {icon:"",action:"已送达"},
        {icon:"",action:"已取消"}]
    //--------------------   酒店查询页面  ---------------------------
    ,
    hotelIconAction :  [{icon:"",action:"修改状态"},
        {icon:"",action:"正常"},
        {icon:"",action:"暂停服务"},
        {icon:"",action:"协议终止"},
        {icon:"",action:"调整服务"},        
        {icon:"",action:"更改信息(酒)"},
        {icon:"",action:"删除酒店"}]

    //--------------------   服务查询页面  ---------------------------
    ,
    serviceIconAction :  [{icon:"",action:"修改状态"},
        {icon:"",action:"开通"},
        {icon:"",action:"服务暂停"},
        {icon:"",action:"调整酒店"},
        {icon:"",action:"更改信息(客)"},
        {icon:"",action:"删除服务"}]

}

var show =function(showee){
    alert(JSON.stringify(showee));
}

