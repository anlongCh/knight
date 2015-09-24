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


    var transit = new BMap.DrivingRoute(map, {
        renderOptions: {
            map: map,
            //panel: "r-result",
            enableDragging : true //起终点可进行拖拽
        },
        onSearchComplete: function(results){
            if (transit.getStatus() == BMAP_STATUS_SUCCESS) {
                // 地图覆盖物
                getPoints(results);
                // 方案描述
                //addText(results);
            }
        }
    });

    /*transit.setSearchCompleteCallback(function(searchResult){
        alert(searchResult['getStart']);
        // marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
    });*/


    function mapGO()
    {
        var start = $('#start').val().trim();
        var end = $('#end').val().trim();

        transit.search(start,end);
    }
    transit.search('天安门','北京站');



    function dump(myObject) {
        var s = "";
        for (var property in myObject) {
            s = s + "<br> "+property +": " + myObject[property] ;
        }
        $("#js_dump").html(s);
    }

    function getPoints(results) {
        // 自行添加起点和终点
        var start = results.getStart();
        var end = results.getEnd();

        var start_point = start.point.lng+','+start.point.lat;
        var end_point = end.point.lng+','+end.point.lat;
        //dump(start_point+'<br/>'+end_point);
        $('#jwd').html(start_point+'<br/>'+end_point);
    }
</script>
