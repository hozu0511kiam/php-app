<?php
require_once('functions.php');
////functions.phpの関数を呼び出すことが可能
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
</head>
<body>
  welcome hello world
  <div>
     <a href="new.php">
       <p>新規作成</p>
     </a>
  </div>
  <div>
    <table>
      <tr>
        <th>ID</th>
        <th>内容</th>
        <th>更新</th>
        <th>削除</th>
      </tr>
      <?php foreach (getTodoList() as $todo): ?>
      <!--HTMLと混在してPHPの処理を書くときのみforeach{}ではなく、: , endforeach;-->
        <tr>
          <!-- echo の省略形 -->
          <td><?= $todo['id']; ?></td>
          <td><?= $todo['content']; ?></td>
          <td>
            <a href="">更新</a>
          </td>
          <td>
            <form action="store.php" method="post">
              <input type="hidden" name="id" value="">
              <button type="submit">削除</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>