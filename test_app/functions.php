<?php
//データの受け取り・受け渡しとDBへの処理を依頼する機能をまとめるファイル

require_once('connection.php');

//connection.phpのDB操作をPOSTされた際にデータを渡すための記述
function createData($post)
{
    createTodoData($post['content']);
}

//getTodoList関数を index.php 内で呼び出して、TODOデータの一覧表示を行う
//functions.php で connection.php に記載した関数を呼び出すために実装しており、getAllRecords関数を返す。
//getAllRecords関数はDBに対して作成したSQL文を実行し、
//fetchAll() で実行結果を全件配列で取得し結果を返すため、返り値はその結果の値

function getTodoList()
{
    return getAllRecords();
}