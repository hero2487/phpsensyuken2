// console.log(fi);

 $(document).ready(function(){
 $(window).scroll(function(){
 var position = $(window).scrollTop();
 var bottom = $(document).height() - $(window).height();

//  一番下までスクロールしたら実行==================
 if( position == bottom ){
 var row = Number($('#row').val());
 var allcount = Number($('#all_product_count').val());
 var rowperpage = 5;
 row = row + rowperpage;
//  console.log(row);
 if(row <= allcount){
 $('.ajax-load').show();
 var url = "pagenationdemo2.php";
 $('#row').val(row);
 $.ajax({
 url: url,
 type: 'post',
 data: {row:row,rowperpage:rowperpage},
 success: function(response){
  //  console.log(response);
let idArray=response.id;
let midArray=response.mid;
let tweetArray=response.tweet;
let nameArray=response.name;
let indateArray=response.indateArray;
let tweetNumberArray=response.tweetNumberArray;


for(i=0; i<=idArray.length-1;){
  // tbodyを取得
  const tbodyElem = document.getElementById('tbody');
  // 要素を生成
  const trElem = document.createElement('div')
  trElem.setAttribute('class','oneTweet')
  const divElem = document.createElement('div')
  divElem.setAttribute('class','matome')
  const conElem = document.createElement('div')
  conElem.setAttribute('class','container')
  const rowElem = document.createElement('div')
  rowElem.setAttribute('class','row')
  const tdNameElem = document.createElement('div'); // <div></div>
  tdNameElem.textContent = nameArray[i]; // <div>西山ウルトラ</div>
  const tdTweetElem = document.createElement('div'); // <div></div>
  tdTweetElem.textContent = tweetArray[i];
  tdTweetElem.setAttribute('class','tweetclass')
  const tdIndateElem = document.createElement('div');
  tdIndateElem.textContent = indateArray[i];

  //ツイートの数＝＝＝＝＝＝＝＝＝＝＝
  const tdTweetNumElem = document.createElement('div');
  tdTweetNumElem.setAttribute('class', 'tweetNum col-3')
  tdTweetNumElem.textContent = tweetNumberArray[i];

  // コメントボタン
  const comentElem = document.createElement('button')
  comentElem.setAttribute('id', 'coment'); 
  comentElem.setAttribute('class', 'coment col-3 btn-floating btn-cyan'); 
  comentElem.setAttribute('data-primary', idArray[i]);
  comentElem.textContent = 'コメント';
  // コメントスパン
  const spancoment = document.createElement('i')
  spancoment.setAttribute('class', 'fas fa-comment'); 

  // ボタンの要素を生成
  const buttonElem = document.createElement('button');

  // ボタンの属性を設定
  buttonElem.setAttribute('id', 'follow'); // <button id="follow"></button>
  buttonElem.setAttribute('class', 'followAJ'); // <button id="follow" class="followAJ"></button>
  let followcheck = fi.includes(midArray[i])
  // console.log(followcheck);
  // すでにフォローされているかで変わる
  buttonElem.setAttribute('data-primary', midArray[i]);
  if(followcheck == true){
    buttonElem.setAttribute('value', 'フォローをやめる');
    buttonElem.textContent = 'フォローをやめる';
  }else{
    buttonElem.setAttribute('value', 'フォローする');
    buttonElem.textContent = 'フォローする';
  }
// いいねボタンの要素を生成
  const likeBtnElem = document.createElement('button');
// いいねボタンの属性を設定
  likeBtnElem.setAttribute('id', 'like'); // <button id="follow"></button>
  likeBtnElem.setAttribute('class', 'like btn-floating btn-danger btn-sm col-3'); // <button id="follow" class="followAJ"></button>
  const ilikeBtn = document.createElement('i')
  ilikeBtn.setAttribute('class', 'fas fa-heart col-3'); 

  likeBtnElem.setAttribute('data-primary', idArray[i]);
  likeBtnElem.setAttribute('value', 'いいね');
  likeBtnElem.textContent = 'いいね';

  // クリックイベントの設定 // $().on('click')
  buttonElem.addEventListener('click', function (e) {
    // クリックされた時に動く
    const fid = e.target.getAttribute('data-primary')
    // console.log(fid)
    if(buttonElem.value == "フォローする") {
      follow(fid);
      buttonElem.value = "フォローをやめる";
      buttonElem.textContent = "フォローをやめる";
    } else {
      followdelete(fid);
      buttonElem.value = "フォローする";
      buttonElem.textContent = "フォローする";
    };
  });


  // いいねクリックイベントの設d定 // $().on('click')
  likeBtnElem.addEventListener('click', function (e) {
    const ti = e.target.getAttribute('data-primary')
    // console.log(ti);
    // クリックされた時に動く
    if(likeBtnElem.value == "いいね") {
      like(ti);
      likeBtnElem.value = "いいねをやめる";
      likeBtnElem.textContent = "いいねをやめる";
    } else {
      likedele(ti)
      likeBtnElem.value = "いいね";
      likeBtnElem.textContent = "いいね";
    };
  });


  // 要素を組み立てる // 最初のtrElem -> <tr></tr>
  trElem.appendChild(divElem); // <tr><td>西山ウルトラ</td></tr>
  divElem.appendChild(tdNameElem); // <tr><td>西山ウルトラ</td></tr>
  divElem.appendChild(tdTweetElem);  // <tr><td>西山ウルトラ</td>  "<td></td>" </tr>
  divElem.appendChild(tdIndateElem); // <tr><td>西山ウルトラ</td><td></td> "<td></td>" </tr>
  // !===========================
  trElem.appendChild(conElem);
  conElem.appendChild(rowElem);
  rowElem.appendChild(comentElem); 
  comentElem.appendChild(spancoment); 
  rowElem.appendChild(buttonElem); 
  rowElem.appendChild(likeBtnElem);
  likeBtnElem.appendChild(ilikeBtn);
  rowElem.appendChild(tdTweetNumElem); 

  tbodyElem.appendChild(trElem); // 画面上にいるtbodyにアペンド -> 画面に表示される

  i++
}

 $('.ajax-load').hide();
 $(".product:last").after(response).show().fadeIn("slow");
 }
 });
 }
 else{
 $('#remove').remove();
 $(".product:last").after('<tr id="remove"><td colspan="4" style="text-align: center;"><b></b></td></tr>');
 }
 }
 });
 });





//  最初の作業