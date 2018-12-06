<!DOCTYPE html>
<html lange="ja">
<head>
    <meta charset="utf-8">
    <title>javascript</title>
</head>
<body>
<div>
    <span>出発地点</span>
    <input type="text" id="startPoint">
</div>
<div>
    <span>目的地点</span>
    <input type="text" id="endPoint"/>
</div>
<div>
    <input type="radio" id="drive" name="travelMode" value="DRIVING" checked>車
    <input type="radio" id="walk" name="travelMode" value="WALKING">徒歩
    <!--<input type="radio" id="bicycle" name="travelMode" value="BICYCLING">自転車-->
    <input type="radio" id="transit" name="travelMode" value="TRANSIT">公共交通機関
</div>
<button type="button" id="searchRoute">ルート表示</button>
<div>
    <div>距離</div>
    <span id="distance"></span>
    <span id="distance2"></span>
</div>
<div>
    <input type="text" id="address" placeholder="住所" maxlength="50">
    <button type="button" id="search">検索</button>
    <button type="button" id="deleteIcon">ピン削除</button>
    <button type="button" id="searchKMm">距離測定</button>
</div>
<div>
    <button type="button" id="nowPlace">現在地表示</button>
</div>
<div>
</div>
<div>
    <button type="button" id="searchPlace">周辺検索</button>
</div>
<div id="map" style="width:600px; height:600px"></div>
<div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26591.852737067424!2d130.41991679999998!3d33.579827200000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x354191c7e6f9b375%3A0x2ee22b3d45b98b90!2z5Y2a5aSa6aeF!5e0!3m2!1sja!2sjp!4v1538617642212"
            width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>


<script type="text/javascript" src="mapjs.js"></script>

<script>

    var msg;
    msg = 'Hello world';
    console.log(msg);
</script>
<script src="./mapjs.js"></script>
<!--マップの読み込み-->
<!-- callbck=〇〇でスクリプト読み込み後〇〇の初期関数を呼び出す -->
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>

<!--cssのライブラリ読み込み-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>