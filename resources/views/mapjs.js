var map;
var marker;
var infoWindow;
var mapCenter = [];
var service;


function initMap() {
    //現在地表示クリックイベント
    document.getElementById('nowPlace').addEventListener('click', function () {
        showlocationMap();
    });

    //緯度経度の初期値を宣言
    //  東京タワー
    var center = {
        lat: 35.658593,
        lng: 139.745441
    };
    //浜松町
    var centerA = {
        lat: 35.653827,
        lng: 139.7558629
    }
    mapCenter.push(center);
    mapCenter.push(centerA);
    //マップの表示
    showMap(center);
    var i = 0;
    for (i = 0; i < (mapCenter.length); i++) {

        //マーカーを表示させる
        showMarker(mapCenter[i], i);

    }

    //ジオコードを使えるように宣言
    var geocoder = new google.maps.Geocoder();
    //ルート検索ができるように宣言  
    var directionsService = new google.maps.DirectionsService;
    //ルート検索結果が描画できるように宣言
    var directionsRenderer = new google.maps.DirectionsRenderer;

    //ルート表示クリックイベント
    document.getElementById('searchRoute').addEventListener('click', function () {
        serachRouteMap(directionsService, directionsRenderer);
    });

    //検索ボタンの発生イベント
    document.getElementById('search').addEventListener('click', function () {
        geocodeAddress(geocoder, map);
    });


    //情報表示ウインドウの宣言
    infoWindow = new google.maps.InfoWindow({
        content: 'info' // 表示する内容
    });

    //ピンのクリックイベント
    marker.addListener('click', function () {
        //情報表示ウインドウを出す
        infoWindow.open(map, marker);
    });

}

/**
 * 住所検索
 * @param {any} geocoder
 * @param {any} resultMap
 */
function geocodeAddress(geocoder, resultMap) {
    //検索窓の入力値を取得
    var address = document.getElementById('address').value;
    geocoder.geocode({'address': address}, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {

            resultMap.setCenter(results[0].geometry.location);
            //検索後のマップにピンを出す
            var marker = new google.maps.Marker({
                map: resultMap,
                position: results[0].geometry.location,
                animation: google.maps.Animation.DROP,
            });


        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

/**
 * マップを表示させ、対象の位置を中央に表示させる
 * @param {any} center
 */
function showMap(center) {
    //マップに緯度経度を渡し表示させる
    map = new google.maps.Map(document.getElementById('map'), {
        center: center,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scaleControl: true
    });
}

/**
 * マップにマーカーを表示させる
 * @param {any} position
 * @param {any} i
 */
function showMarker(position, i) {
    //マップにマーカーを出す
    marker = new google.maps.Marker({
        position: position,
        map: map,
        animation: google.maps.Animation.DROP
    });
}

function CreateMarker(latlng) {
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        draggable: true
    });
    google.maps.event.addListener(marker, "dragend", UpdateRoute);
    return marker;
}

/**
 * ルートを描画する
 */
function UpdateRoute() {
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();
    var request = {
        origin: originMarker.getPosition(),
        destination: destinationMarker.getPosition(),
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function (result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsRenderer.setDirections(result);
            SetDistance(result);
        }
    });
}

// 移動距離を設定します。
function SetDistance(routeData) {
    var distance = GetDistanceKm(routeData.routes[0].legs);
    if (distance > 100) {
        distance = distance.toFixed(0);
    }
    else if (distance > 10) {
        distance = distance.toFixed(1);
    }
    document.getElementById('distance').value = distance;
    $("#distance").text(distance + 'km');
    // $("#distance2").text('km');
}

// 距離を取得します。
function GetDistanceKm(legs) {
    var journey = 0;
    for (var i in legs) {
        journey += legs[i].distance.value;
    }
    return journey / 1000;
}

//ルート表示押下処理
function serachRouteMap(directionsService, directionsRenderer)
{

    var driveFlag = document.getElementById('drive').checked;
    var walkFlag = document.getElementById('walk').checked;
    // var bicycleFlag = document.getElementById('bicycle').checked;
    var transitFlag = document.getElementById('transit').checked;
    var mode;
    if (driveFlag == true) {
        mode = google.maps.TravelMode.DRIVING;
    }
    if (walkFlag == true) {
        mode = google.maps.TravelMode.WALKING;
    }
    // if (bicycleFlag == true) {
    //     mode = google.maps.TravelMode.BICYCLING;
    // }
    if (transitFlag == true){
        mode = google.maps.TravelMode.TRANSIT;
    }
    // ルート検索を実行
    directionsService.route({
        origin: document.getElementById('startPoint').value,//開始地点
        destination: document.getElementById('endPoint').value,//目的地
        travelMode: mode //DRIVING:車 WALKING:徒歩
    }, function (response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            // ルート検索の結果を地図上に描画
            directionsRenderer.setMap(map);
            directionsRenderer.setDirections(response);

            SetDistance(response);
        }
    });
}

function showlocationMap()
{
    //現在地を取得し表示させる
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                var mapLatLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                mapCenter.push(mapLatLng);
                showMap(mapLatLng);
                //現在地の緯度経度を中心にマップに円を描く 
                var circleOptions = {
                    map: map,
                    center: mapLatLng,
                    radius: 1000,//1km
                    strokeColor: "#009933",
                    strokeOpacity: 1,
                    strokeWeight: 1,
                    fillColor: "#00ffcc",
                    fillOpacity: 0.35
                };
                circle = new google.maps.Circle(circleOptions);
                for (i = 0; i < (mapCenter.length); i++) {
                    //マーカーを表示させる
                    showMarker(mapCenter[i], i);

                }
            }
        );
    }
}