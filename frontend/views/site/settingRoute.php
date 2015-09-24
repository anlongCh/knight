<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
        body, html {width: 100%;height: 100%; margin:0;font-family:"微软雅黑";}
        #l-map{height:600px;width:100%;}
        #r-result,#r-result table{width:100%;}
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=<?=BAIDU_MAP_AK ?>"></script>
    <title>起终点可拖拽的驾车导航</title>
</head>
<body>
<div>
    <label>起点</label><input name="start" id="start" value="天安门" type="text">
    <label>终点</label><input name="end" id="end" value="北京站" type="text">
    <button type="button" class="btn btn-primary" name="contact-button" onclick="mapGO()">确定</button>

    <a href="javascript:removeGroundOverlay();">删除</a>
</div>
<div id="l-map"></div>
<div id="r-result"></div>
<div id="jwd"></div>
<div id="js_dump"></div>
</body>
</html>
<script type="text/javascript">
    // 百度地图API功能
    var map = new BMap.Map("l-map");
    var point = new BMap.Point(116.404, 39.915); //初始化地图标记
    map.centerAndZoom(point, 12);


    function dump(myObject)
    {
        var s = "";
        for (var property in myObject) {
            s = s + "<br> "+property +": " + myObject[property] ;
        }
        $("#js_dump").html(s);
    }


    //-------------

    //单击获取点击的经纬度
    map.addEventListener("click",function(e){
        userMarker(e.point.lng, e.point.lat)
    });

    var poin_arr = new Array();
    function userMarker(lng, lat)
    {
        var marker = new BMap.Marker(new BMap.Point(lng, lat));  // 创建标注，为要查询的地方对应的经纬度
        //map.addOverlay(marker);
        //var content = document.getElementById("text_").value + "<br/><br/>经度：" + poi.point.lng + "<br/>纬度：" + poi.point.lat;
        //var infoWindow = new BMap.InfoWindow("<p style='font-size:14px;'>" + content + "</p>");
        //marker.addEventListener("click", function () { this.openInfoWindow(infoWindow); });
        //marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
        poin_arr.push(new Array(lng, lat));

        userPolyline(poin_arr);
    }

    var polyline_old;   //前一次画的线
    function userPolyline(poin_arr)
    {
        var point_obj = [];
        for (var poin in poin_arr) {
            point_obj.push(new BMap.Point(poin_arr[poin][0], poin_arr[poin][1])) ;
        }

$('#jwd').text(poin_arr);

        var polyline = new BMap.Polyline(point_obj, {strokeColor:"blue", strokeWeight:5, strokeOpacity:0.5});
        map.removeOverlay(polyline_old);
        map.addOverlay(polyline);

        polyline_old = polyline;

    }


</script>
