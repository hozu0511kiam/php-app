# PHP App ① レビュー

## 全般

### 以下のaタグのリンクを押下した際にedit.phpの$_GETにどんな値が格納されるか説明してください。

```html
<a href="edit.php?todo_id=123&todo_content=焼肉">更新</a>
```

### 以下のフォームの送信ボタンを押下した際にstore.phpの$_POSTにどんな値が格納されるか説明してください。

```html
<form action="store.php" method="post">
    <input type="text" name="id" value="123">
		<textarea　name="content">焼肉</textarea>
    <button type="submit">送信</button>
</form>
```
123 $POST = ["connect" => "123"]

### `require_once()` は何のために記述しているか説明してください。
外部のファイルを読み込むときに使用。"require"と"require_once"があり、意味はどちらも同じだが、"require_once"は。同じファイルを複数回requireすることがない。そのため、関数の再定義や変数値の再代入をする場面にエラーが出ない.

require_onceでは同一のファイルを複数回呼び出しても、2度目以降の呼び出しが処理されない。変数を変更すると、変更した値が呼び出される。

### `savePostedData($post)`は何をしているか説明してください。
リクエスト元のURLを文字列で取得しそのパスを返す getRefererPath関数 を定義し、それを savePostedData関数 で呼び出している。
新規作成ページからPOSTされたなら、createTodoData関数 を実行（INSERT処理）
編集ページからPOSTされたなら、updateTodoData関数 を実行（UPDATE処理）

### `header('location: ./index.php')`は何をしているか説明してください。
PHPの header関数 を用いてリダイレクト先を指定している。
header関数の引数を「Location：遷移先」にして実行すると、指定したパスに存在する指定したファイルに遷移することができる。

### `getRefererPath()`は何をしているか説明してください。
リクエスト元のURLを文字列で取得し、そのパス部分を返している。

### `connectPdo()` の返り値は何か、またこの記述は何をするための記述か説明してください。
返り値はPDO。PDO（PHP Data Objects）というDBとのやり取りをすることができるメソッドが詰め込まれた定義済みのクラスをインスタンス化している。

### `try catch`とは何か説明してください。
例外処理を実装するための構文。
try：エラーが発生する可能性のあるコード
catch(Expention $e)：エラー処理
ファイル読み込みのエラー処理や接続、数学演算（÷0）などのエラーで例外が発生したときに、適切なメッセージを表示したり、エラー情報の詳細を表示することができる。

### Pdoクラスをインスタンス化する際に`try catch`が必要な理由を説明してください。
何らかの理由で指定したDBに接続できなかった場合、PDOクラスは例外（PDOException）を発生するため、例外によってスクリプト全体が停止しないようにするために例外処理をする必要があるから。

## 新規作成

### `createTodoData($post)`は何をしているか説明してください。
connection.phpで行ったDB操作に関する実装をされたとき、データを渡して処理を依頼する。

## 一覧

### `getTodoList()`の返り値について説明してください。
functions.php で connection.php に記載した関数を呼び出すために実装しており、getAllRecords関数を返す。

### `<?= ?>`は何の省略形か説明してください。
<?php echo ?>

## 更新

### `getSelectedTodo($_GET['id'])`の返り値は何か、またなぜ`$_GET['id']` を引数に渡すのか説明してください。

### `updateTodoData($post)`は何をしているか説明してください。

## 削除

### `deleteTodoData($id)`は何をしているか説明してください。

### `deleted_at`を現在時刻で更新すると一覧画面からToDoが非表示になる理由を説明してください。

### 今回のように実際のデータを削除せずに非表示にすることで削除されたように扱うことを〇〇削除というか。

### 実際にデータを削除することを〇〇削除というか。

### 前問のそれぞれの削除のメリット・デメリットについて説明してください。
