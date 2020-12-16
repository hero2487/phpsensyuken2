var ctx = document.getElementById("myChart");

function drawBarChart(data) {
  //CSV列データを列ごとに配列にします。 3列の例＝項目名,data1,data2
  // var tmpLabels = [], tmpData1 = [], tmpData2 = [];
  // for (var row in data) {
  //    tmpLabels.push(data[row][0])     //軸項目名（１列目）
  //    tmpData1.push(data[row][1])      //データ１（２列目）"東京"
  //    tmpData2.push(data[row][2])      //データ２（３列目）"札幌"
  // };

  let izakaya_20 = 0;
  for (let row in data) {
    if (data[row][0] == "male" && data[row][1] >= 20 &&data[row][1] <= 29 && data[row][2] == "居酒屋") {
      izakaya_20++;
    }
  }
console.log(izakaya_20);

  var ctx = document.getElementById("myChart"); 
  var myBarChart = new Chart(ctx, {  // Chartクラス
      type: 'bar',
      data: {
         labels: tmpLabels,
         datasets: [
              { label: "東京", data: tmpData1, backgroundColor: "red" },
              { label: "札幌", data: tmpData2, backgroundColor: "blue" }
         ],
      option: {
      
      }
    }         // 詳細は下ソースコード参照
   });
}

// CSV読み込みcsvdata関数（csvdata-read.js）を起動。上の関数名drawBarChartとCSVファイルURLを指定。 
csvdata(drawBarChart,"./demo.csv"); 
