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
//try：エラーが発生する可能性のあるコード・catch(Expention $e)：エラー処理

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
    return $dbh->query($sql)->fetchAll();
    //DBに対して作成したSQL文を実行し、fetchAll() で実行結果を全件配列で取得、そしてその結果をreturn
}

