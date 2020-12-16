<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <title>Document</title>
  </head>
  <body>
  <?php
$filename = "./total.csv";
$fp = fopen($filename,'r');
$get = fgets($fp);
$t = explode(",",$get);
// print_r($t);
?>

  </body>
  
  <canvas id="myPieChart">
  </canvas>
  <script>
    var ctx = document.getElementById("myPieChart");
    let dataset_php = <?php echo json_encode($t); ?>;
    let dataset = [];
    for(key in dataset_php){
      dataset.push(dataset_php[key]);
    };

    var myPieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["居酒屋", "カフェ", "イタリアン", "ラーメン"], //データ項目のラベル
        datasets: [{
          backgroundColor: [
            "#c97586",
            "#bbbcde",
            "#93b881",
            "#e6b422"
          ],
          data: dataset //グラフのデータ
        }]
      },
      options: {
        title: {
          display: true,
          //グラフタイトル
          text: '飲食店カテゴリ'
        }
      }
    });
    </script>
    </html>