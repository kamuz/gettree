<?php

error_reporting(-1);

$dns = "mysql:host=localhost;dbname=menu;charset=utf8";

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$pdo = new PDO($dns, 'root', 'root', $opt);

function dd($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

$smpt = $pdo->prepare("SELECT * FROM categories");
$smpt->execute();

while($row = $smpt->fetch()){
    $data[$row['id']] = $row;
}

// dd($data);

function getTree($data) {
    // $i = $i ?? 0;
    $i = isset($i) ? $i : 0;
    $tree = [];

    foreach ($data as $id => &$node) {
        // If has no children, do nothing
        if ($node['parent_id'] == 0) {
            $tree[$id] = &$node;
        } else {
            // Change tree
            $data[$node['parent_id']]['children'][$id] = &$node;
        }

        $i++;
        echo "<pre>=============== ($i) DATA ===============</pre>";
        dd($data);
        echo "<pre>=============== ($i) TREE ===============</pre>";
        dd($tree);
    }

    return $tree;
}

dd(getTree($data));