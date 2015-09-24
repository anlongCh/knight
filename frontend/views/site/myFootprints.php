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

    <link rel="stylesheet" href="css/baguettebox.min.css">
    <link rel="stylesheet" href="css/lrtk.css">
    <script src="js/baguettebox.min.js"></script>
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
    var sContent =
        "<h4 style='margin:0 0 5px 0;padding:0.2em 0'>天安门</h4>" +
        "<img style='float:right;margin:4px' id='imgDemo' src='http://app.baidu.com/map/images/tiananmen.jpg' width='139' height='104' title='天安门'/>" +
        +
        '<div class="baguetteBoxOne gallery">'+
        '<a href="/images/1-1.jpg" data-caption="Golden Gate Bridge"><img src="/images/thumbs/1-1.jpg"></a>'+
        '<a href="/images/1-2.jpg" title="Midnight City"><img src="/images/thumbs/1-2.jpg"></a>'+
        '<a href="/images/1-3.jpg"><img src="/images/thumbs/1-3.jpg"></a>'+
        '<a href="/images/1-4.jpg"><img src="/images/thumbs/1-4.jpg"></a>'+
        '<a href="/images/1-5.jpg"><img src="/images/thumbs/1-5.jpg"></a>'+
        '<a href="/images/1-6.jpg"><img src="/images/thumbs/1-6.jpg"></a>'+
        '<a href="/images/1-7.jpg"><img src="/images/thumbs/1-7.jpg"></a>'+
        '<a href="/images/1-8.jpg"><img src="/images/thumbs/1-8.jpg"></a>'+
        '</div>'
            +
        "<p style='margin:0;line-height:1.5;font-size:13px;text-indent:2em'>天安门坐落在中国北京市中心,故宫的南侧,与天安门广场隔长安街相望,是清朝皇城的大门...</p>" +
        "</div>";
    var map = new BMap.Map("l-map");
    var point = new BMap.Point(116.404, 39.915);
    var marker = new BMap.Marker(point);
    var infoWindow = new BMap.InfoWindow(sContent);  // 创建信息窗口对象
    map.centerAndZoom(point, 15);
    map.addOverlay(marker);
    marker.addEventListener("click", function(){
        this.openInfoWindow(infoWindow);
        //图片加载完毕重绘infowindow
        document.getElementById('imgDemo').onload = function (){
            infoWindow.redraw();   //防止在网速较慢，图片未加载时，生成的信息框高度比图片的总高度小，导致图片部分被隐藏

            baguetteBox.run('.baguetteBoxOne', {
                animation: 'fadeIn'
            });
        }
    });
</script>
