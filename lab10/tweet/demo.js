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
   rowElem.appendChild(buttonm); 
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





  let idNNArray=allArray.id;
let midNNArray=allArray.mid;
let tweetNNArray=allArray.tweet;
let nameNNArray=allArray.name;
let indateNNArray=allArray.indateArray;
let tweetNumberArray=allArray.tweetNumber
// console.log(allArray);

for(i=0; i<=indateNNArray.length-1;){
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
  const tdNameElem=document.createElement('div')
  tdNameElem.textContent = nameNNArray[i]; // <td>西山ウルトラ</td>
  const tdTweetElem = document.createElement('div'); // <td></td>
  tdTweetElem.textContent = tweetNNArray[i];
  tdTweetElem.setAttribute('class','tweetclass')
  const tdIndateElem = document.createElement('div');
  tdIndateElem.textContent = indateNNArray[i];

  const ilikeNBtn = document.createElement('i')
  ilikeNBtn.setAttribute('class', 'fas fa-heart col-3'); 


//! モーダルボタンのdivタグ
let content = document.createElement('div')
content.setAttribute('class','content')
let modalj = document.createElement('div')
modalj.setAttribute('class','modal js-modal')
let modal = document.createElement('div')
modal.setAttribute('class','modal__bg js-modal-close')
let modalC = document.createElement('div')
modalC.setAttribute('class','modal__content')

//! モーダルフォームのdivタグ＝＝＝＝＝
let fieldset = document.createElement('fieldset')
let legend = document.createElement('legend')
legend.textContent ="コメントする"

let text = document.createElement('textArea')
text.setAttribute('id','textArea')
text.setAttribute('class','texttweet')
text.setAttribute('rows','4')
text.setAttribute('cols','40')
text.setAttribute('value','')


let br = document.createElement("br")

let tbtn = document.createElement("button")
tbtn.setAttribute('id','btn')
tbtn.setAttribute('class','btn btn-outline-primary')
tbtn.setAttribute('value',"bad");
tbtn.textContent = "つぶやく"

//!＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
  //ツイートの数＝＝＝＝＝＝＝＝＝＝＝
  const tdTweetNElem = document.createElement('div');
  tdTweetNElem.setAttribute('class', 'tweetNum col-3')
  tdTweetNElem.textContent = tweetNumberArray[i];

  // コメントボタン
  const comentElem = document.createElement('button')
  comentElem.setAttribute('id', 'coment'); 
  comentElem.setAttribute('class', 'coment col-3 btn-floating btn-cyan'); 
  comentElem.setAttribute('data-primary', idNNArray[i]);
  comentElem.textContent = 'コメント';
  // コメントスパン
  const spancoment = document.createElement('i')
  spancoment.setAttribute('class', 'fas fa-comment'); 

  // ボタンの要素を生成
  const buttonElem = document.createElement('button');

  let followcheck = fi.includes(midNNArray[i])
  // console.log(followcheck);
  // すでにフォローされているかで変わる
  buttonElem.setAttribute('data-primary', midNNArray[i]);
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

  likeBtnElem.setAttribute('data-primary', idNNArray[i]);
  likeBtnElem.setAttribute('value', 'いいね');
  likeBtnElem.textContent = 'いいね';


  // console.log(midNNArray[i])
  // クリックイベントの設定 // $().on('click')
  buttonElem.addEventListener('click', function (e) {
    // クリックされた時に動く
    const fid = e.target.getAttribute('data-primary')
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

  // console.log(tdTweetNElem.textContent);
// ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝

  // いいねクリックイベントの設定 // $().on('click')
  likeBtnElem.addEventListener('click', function (e) {
    // クリックされた時に動く
    const ti = e.target.getAttribute('data-primary')
    // console.log(ti);
    if(likeBtnElem.value == "いいね") {
      like(ti)
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
  divElem.appendChild(tdTweetElem); // <tr><td>西山ウルトラ</td>  "<td></td>" </tr>
  divElem.appendChild(tdIndateElem); // <tr><td>西山ウルトラ</td><td></td> "<td></td>" </tr>
  trElem.appendChild(conElem);
  conElem.appendChild(rowElem);
  // !モーダルボタン===========================

  rowElem.appendChild(comentElem); 
  rowElem.appendChild(content);
  content.appendChild(modalj);
  modalj.appendChild(modal);
  modalj.appendChild(modalC);
  // !モーダルフォーム＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
  
  modalC.appendChild(fieldset)
  fieldset.appendChild(legend)
  fieldset.appendChild(text)
  fieldset.appendChild(br)
  fieldset.appendChild(tbtn)

  // !＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
  comentElem.appendChild(spancoment); 
  rowElem.appendChild(buttonElem); 
  rowElem.appendChild(likeBtnElem);
  likeBtnElem.appendChild(ilikeNBtn);
  rowElem.appendChild(tdTweetNElem);  
  tbodyElem.appendChild(trElem); // 画面上にいるtbodyにアペンド -> 画面に表示される
  i++
}

// ＝＝＝＝＝＝＝関数＝＝＝＝＝＝＝＝＝＝＝＝＝


// モーダル関数




// フォロー関数
function follow(pk){
  //axiosでAjax送信
  //Ajax（非同期通信）
  const params = new URLSearchParams();
  params.append('fid', pk);
    //axiosでAjax送信
    axios.post('../follow/followInsert.php',params).then(function (response) {
      // console.log(typeof response.data);//通信OK
    }).catch(function (error) {
      console.log(error);//通信Error
    }).then(function () {
      // console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });
  }

  // フォローをやめる関数
function followdelete(pk){
  //axiosでAjax送信
  //Ajax（非同期通信）
  const params = new URLSearchParams();
  params.append('fid', pk);
    //axiosでAjax送信
    axios.post('../follow/followdelete.php',params).then(function (response) {
      // console.log(typeof response.data);//通信OK
    }).catch(function (error) {
      console.log(error);//通信Error
    }).then(function () {
      // console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });
  }

  //いいね関数========================================
  function like(ti){
  const params = new URLSearchParams();
  params.append('id', ti);
    //axiosでAjax送信
    axios.post('like.php',params).then(function (response) {
      // console.log(typeof response.data);//通信OK
    }).catch(function (error) {
      console.log(error);//通信Error
    }).then(function () {
      // console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });
  }

  //いいねをやめる関数
  function likedele(ti){
  const params = new URLSearchParams();
  params.append('id', ti);
    //axiosでAjax送信
    axios.post('likedelete.php',params).then(function (response) {
      // console.log(typeof response.data);//通信OK
    }).catch(function (error) {
      console.log(error);//通信Error
    }).then(function () {
      // console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });
  }

  function likedele(ti){
  const params = new URLSearchParams();
  params.append('id', ti);
    //axiosでAjax送信
    axios.post('likedelete.php',params).then(function (response) {
      // console.log(typeof response.data);//通信OK
    }).catch(function (error) {
      console.log(error);//通信Error
    }).then(function () {
      // console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });
  }

  $(".coment").on("click",function(e){
   const pk = e.target.getAttribute('data-primary')
  // const pk = e.currentTarget.attributes[2].nodeValue;
  // console.log(pk);
  $(".btn").val(pk);
  $('.js-modal').fadeIn();
          return false;
})

$('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut();
        return false;
    });

  $(function(){
    $('.js-modal-open').on('click',function(){
      $('.js-modal').fadeIn();
      return false;
    });
    $('.js-modal-close').on('click',function(){
      $('.js-modal').fadeOut();
      return false;
    });
  });


  $(".btn").on("click",function(){
    let val = document.querySelectorAll("textArea");
    val.forEach(elem => {
      console.log(elem);
    });

    // let val = $("#textArea");
    console.log(val);
  });


  // const renderedText = htmlElement.innerText
  // htmlElement.innerText = string

//   $(".btn").on("click",function() {
//     // let val =$("#textArea").eq(1).val();
//     let val =$("#textArea").val();
//     console.log(val);
//     //axiosでAjax送信
//     //Ajax（非同期通信）
//     const params = new URLSearchParams();
//     params.append('coment', val);
//     params.append('tid',  $("#btn").val());
//     //axiosでAjax送信
//     axios.post('coment_insert.php',params).then(function (response) {
//         console.log(typeof response.data);//通信OK
//         if(response.data==true){
//           $("#textArea").val("");
//         }else{
//           $("#status").html("登録出来ませんでした");
//         }
//     }).catch(function (error) {
//         console.log(error);//通信Error
//     }).then(function () {
//         console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
//     });
// });
