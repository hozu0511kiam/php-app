<?php
// config.phpを読み込み、中に記載あるものが使用可能になる
require_once('config.php');

// PDOクラスのインスタンス化
function connectPdo()
//返り値はPDO
//PDO(PHP Data Objects:DBとのやり取りをすることができるメソッドが詰め込まれた定義済みのクラス)をインスタンス化している。
{
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage(); // 例外メッセージを取得する
        exit();
    }
}
//try-catch:例外処理を実装するための構文
//try：エラーが発生する可能性のあるコード・catch(Exception $e)：エラー処理

//①例外を発生させる処理が書いていない
//PDOExceptionは、DBとの接続に失敗した場合などにおける例外のため、処理内容の記載はしない。

//②catchの引数がExceptionではなくPDOExceptionという別のクラスになっている。
//ExceptionクラスはPHPの例外階層の基底クラス
//PDOExceptionクラスはPDOを使用してDB操作を行う際の例外を表すクラス

//何らかの理由で指定したDBに接続できなかった場合、PDOクラスは例外（PDOException）を発生する
//例外によってスクリプト全体が停止しないようにするために例外処理をする必要がある

function createTodoData($todoText)
{
    $dbh = connectPdo();
    //DBへ接続する connectPdo関数 を呼びだし、返り値を $dbh に格納
    $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")';
    //実行したいSQL文 を作成し、$sql に格納
    $dbh->query($sql);
    //$sql を queryメソッド(sqlをDBに届ける役割) の引数に渡して実行し、INSERT文を実行
}

//データ取得処理 登録したデータをDBから全件取得する
function getAllRecords()
{
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';
    //todosテーブルから、削除されていないレコードを全件取得する
    return $dbh->query($sql)->fetchAll();//メソッドチェーン:メソッド2は、メソッド1の返り値から呼ばれている
    //PDO::query() は変数$sqlを引数とし、SQL文の結果を返り値とし、PDOStatementオブジェクトを返す
    //PDOStatement::fetchAll() はqueryメソッドの返り値から呼ばれ、結果の要素全てを返す
}

function updateTodoData($post)
{
    $dbh = connectPdo();
    //connectPdo関数を呼びだし、返り値を $dbh に格納
    //DBとのやりとり
    $sql = 'UPDATE todos SET content = "' . $post['content'] . '" WHERE id = ' . $post['id'];
    //変数$sqlにSQL文（文字列）を代入
    //UPDATE文でtodosテーブルの更新
    //idカラムを条件としてcontentカラムに更新する内容を変数$postに代入する
    $dbh->query($sql);
    //query関数でsqlの更新した値（内容）を返す
}

function getTodoTextById($id)
{
    $dbh = connectPdo();
    //connectPdo関数 を呼びだし、返り値を $dbh に格納
    //DBとのやりとり
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL AND id = '. $id;
    //変数$sqlにSQL文（文字列）を代入
    //todosテーブルのdeleted_atカラムかnullかつid = '. $id
    //現在保存されているデータを取得する
    $data = $dbh->query($sql)->fetch();
    //PDO::query() は変数$sqlを引数とし、SQL文の結果を返り値とし、PDOStatementオブジェクトを返す
    //PDOStatement::fetch() はqueryメソッドの返り値から呼ばれ、結果を返す
    return $data['content'];
    //変数$sqlにSQL文（文字列）を代入してfetch関数に$data['content']を返す
    //$data['content']は、結果の中のcontent（ページ内の'内容に当たる'）
}

function deleteTodoData($id)
{
    $dbh = connectPdo();
    //connectPdo関数 を呼びだし、返り値を $dbh に格納
    //DBとのやりとり
    $now = date('Y-m-d H:i:s');
    //変数$nowにdate関数を代入
    //現在時刻をdate関数で定義
    $sql = 'UPDATE todos SET deleted_at = "' . $now . '" WHERE id = ' . $id;
    //変数$sqlにSQL文（文字列）を代入している
    //論理削除：データ自体は残る「削除したことにする」処理
    //物理削除：データ自体を完全に消去
    //UPDATE文でtodosテーブルの更新をして論理削除
    //deleted_atカラムに$now変数を代入する
    //一覧表示するgetAllRecordsの処理条件としてdeleted_atカラムがnullから除外
    //$sql = "UPDATE todos SET deleted_at = \"$now\" WHERE id = $id";
    $dbh->query($sql);
    //echo $sql;
}