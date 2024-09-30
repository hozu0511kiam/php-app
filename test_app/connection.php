<?php
require_once('config.php');

// PDOクラスのインスタンス化
function connectPdo()
{
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit();
    }
}
//①例外を発生させる処理が書いていない
//PDOExceptionは、DBとの接続に失敗した場合などにおける例外のため、処理内容の記載はしない。

//②catchの引数がExceptionではなくPDOExceptionという別のクラスになっている。
//ExceptionクラスはPHPの例外階層の基底クラス
//PDOExceptionクラスはPODを使用してDB操作を行う際の例外を表すクラス

function createTodoData($todoText)
{
    $dbh = connectPdo();
    $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")';
    $dbh->query($sql);
}

function getAllRecords()
{
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';
    return $dbh->query($sql)->fetchAll();
}

