<?php
ini_set('display_errors',1);
session_start();
include('funcs.php'); 
// データ数を数える作業
 $row= 0;

$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM akiya_tweet_table ORDER BY indate DESC LIMIT $row,5");
$status = $stmt->execute();

if($status == false) {
  sql_error($stmt);
}else{
$idArray=[];
$tweetArray=[];
$nameArray=[];
$indateArray=[];
while( $v = $stmt->fetch(PDO::FETCH_ASSOC)){ 
  $idArray[]= $v["id"];
  $tweetArray[]= $v["tweet"];
  $nameArray[]= $v["name"];
  $indateArray[]= $v["indate"];
}
}
$allArray =[
  "id" => $idArray,
  "tweet" =>$tweetArray,
  "name" =>$nameArray,
  "indateArray" =>$indateArray,
];
// print_r($allArray);
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <title>みんなのツイート</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
 <link rel="stylesheet" href="demo.css">
</head>

<body>


 <h2 class="sticky-top vertical-middle">みんなのツイート</h2>
 <div style="overflow-x:auto;">
 <table class="table"  width="100" height="100">
 <thead>
 </thead>
 <tbody id="tbody">
 </tbody>
  </table>
 </div>
 <button id="nextbtn" value="0">次のページ</button>
<script>
let allArray = <?php print_r(json_encode($allArray));?>;
console.log(allArray);

let idNNArray=allArray.id;
console.log(idNNArray);
let tweetNNArray=allArray.tweet;
let nameNNArray=allArray.name;
let indateNNArray=allArray.indateArray;

for(i=0; i<=indateNNArray.length-1;){
  // tbodyを取得
  const tbodyElem = document.getElementById('tbody');
  tbodyElem.setAttribute('class','matome')
  // 要素を生成
  const divElem = document.createElement('div')
  divElem.setAttribute('class','matome')
  const trElem = document.createElement('div')
  trElem.setAttribute('class','oneTweet')
  const idElem = document.createElement('div')
  idElem.setAttribute('class','tweetid')
  idElem.textContent = idNNArray[i]
  const nameElem = document.createElement('div')
  nameElem.setAttribute('class','tweetname')
  nameElem.textContent = nameNNArray[i]
  const tweetElem = document.createElement('div')
  tweetElem.setAttribute('class','tweetvalue')
  tweetElem.textContent = tweetNNArray[i]

  // // ボタンの要素を生成
  // let followcheck = fi.includes(midNNArray[i])
  // console.log(followcheck);
  // すでにフォローされているかで変えたいときに使う


  // 要素を組み立てる // 最初のtrElem -><tr></tr>
 trElem.appendChild(divElem);
 divElem.appendChild(idElem);
 divElem.appendChild(nameElem);
 divElem.appendChild(tweetElem);
 tbodyElem.appendChild(trElem); 
  // 画面上にいるtbodyにアペンド -> 画面に表示される
  i++
}



document.getElementById("nextbtn").onclick=function() {
  let mu = document.getElementById("nextbtn").value
  let plus = Number(mu)+5
  $("#nextbtn").val(plus);
  console.log(plus);
//axiosでAjax送信
//Ajax（非同期通信）
const params = new URLSearchParams();
params.append('row', document.getElementById("nextbtn").value);

//axiosでAjax送信
axios.post('demoaxios.php',params).then(function (response) {
  // console.log(typeof response.data);//通信OK
  if(response.data==false){
    $("#status").html("登録出来ませんでした");
  }else{
  // console.log(response.data.id)
  for(i=0; i<=indateNNArray.length-1;){
      let idArray=response.data.id;
      let tweetArray=response.data.tweet;
      let nameArray=response.data.name;
      let indateArray=response.data.indateArray;

  // tbodyを取得
  const NtbodyElem = document.getElementById('tbody');
  NtbodyElem.setAttribute('class','matome')
  // 要素を生成
  const NdivElem = document.createElement('div')
  NdivElem.setAttribute('class','matome')
  const NtrElem = document.createElement('div')
  NtrElem.setAttribute('class','oneTweet')
  const NidElem = document.createElement('div')
  NidElem.setAttribute('class','tweetid')
  NidElem.textContent = idArray[i]
  const NnameElem = document.createElement('div')
  NnameElem.setAttribute('class','tweetname')
  NnameElem.textContent = nameArray[i]
  const NtweetElem = document.createElement('div')
  NtweetElem.setAttribute('class','tweetvalue')
  NtweetElem.textContent = tweetArray[i]

  // // ボタンの要素を生成
  // let followcheck = fi.includes(midNNArray[i])
  // console.log(followcheck);
  // すでにフォローされているかで変えたいときに使う

  // 要素を組み立てる // 最初のtrElem -><tr></tr>
 NtrElem.appendChild(NdivElem);
 NdivElem.appendChild(NidElem);
 NdivElem.appendChild(NnameElem);
 NdivElem.appendChild(NtweetElem);
 NtbodyElem.appendChild(NtrElem); 
  // 画面上にいるtbodyにアペンド -> 画面に表示される
  i++
}
        }
    }).catch(function (error) {
        console.log(error);//通信Error
    }).then(function () {
        console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });
};


</script>

</body>
</html>