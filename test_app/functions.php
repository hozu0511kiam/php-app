<?php
//データの受け取り・受け渡しとDBへの処理を依頼する機能をまとめるファイル

require_once('connection.php');
//connection.phpのDB操作をPOSTされた際にデータを渡すための記述

function createData($post)
{
    createTodoData($post['content']);
}
//functions.php で connection.php に記載した処理に登録したデータを渡している。

function getTodoList()
{
    return getAllRecords();
}
//getTodoList関数を index.php 内で呼び出して、TODOデータの一覧表示を行う
//DBに対して作成したSQL文を実行し、
//fetchAll() で実行結果を全件配列で取得し結果を返すため、返り値はその結果の値

function getSelectedTodo($id)
{
    return getTodoTextById($id);
}

//getRefererPath関数をsavePostedData関数で呼び出す処理
function savePostedData($post)
{
    $path = getRefererPath();
    switch ($path) {
    //条件分岐をして処理を振り分け
        case '/new.php':
            createTodoData($post['content']);
            //新規作成ページからPOSTされた
            //createTodoData関数を実行（INSERT処理）
            break;
        case '/edit.php':
            updateTodoData($post);
            //編集ページからPOSTされた
            //updateTodoData関数を実行（UPDATE処理）
            break;
        case '/index.php':
            deleteTodoData($post['id']);
            //新規作成ページの削除からPOSTされた
            //deleteTodoData関数を実行（論理削除のDB処理）
            break;
        default:
            break;
    }
}

//getRefererPath関数を定義
function getRefererPath()
{
    $urlArray = parse_url($_SERVER['HTTP_REFERER']);
    //変数$urlArrayに$_SERVER['HTTP_REFERER']を引数とする関数parse_urlを代入
    //リクエスト元（呼び出す前のフォルダ：edit.php）のURLを文字列で取得し、パスを返す

    //var_dump($urlArray);array(5) {
    //["scheme"]=>
    //string(4) "http"
    //["host"]=>
    //string(9) "localhost"
    //["port"]=>
    //int(9999)
    //["path"]=>
    //string(9) "/edit.php"
    //["query"]=>
    //string(4) "id=2"}

    //var_dump($_SERVER['HTTP_REFERER']);
    //string(35) "http://localhost:9999/edit.php?id=2"
    
    return $urlArray['path'];
    //リクエスト元のURLを文字列で取得しそのパスを返す（["path"]=>string(9) "/edit.php"）
}