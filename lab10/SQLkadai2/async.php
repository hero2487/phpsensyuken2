<!DOCTYPE html>
<html lang="ja">
<head>
<script src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=ArKOjzxRYjnXj7IJq5igWzogHt_XAr0Ky_d8MV1MTUOskBRhU8Zk0u1_e2NwrGIJ' async defer></script>
<script src="js/BmapQuery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.0.1/firebase.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<meta charset="UTF-8">
<title>Map:Geolocation</title>
<style>html,body{height:100%;}body{padding:0;margin:0;}h1{padding:0;margin:0;font-size:50%;}</style>
</head>
<body>


<button id="btn1">アラート</button>
<p id="abcd">aaaaa</p>

<script>
// async function f() {
//   return 1;
// }

// alertbtn("クソ");
// pchange("ふぁっく");

// async function alertbtn(unchi){
//   $("#btn1").on("click",function(){
//     alert(unchi);
//     return 1;
//   });
// }

// function pchange(change){
//   $("#btn1").on("click",function(){
//     $("#abcd").html(change);
//   });
// }


async function f() {
  return "ああああ";
}

f().then(alert); // 1

</script>
</body>
</html>
