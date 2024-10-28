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

dd($data);

function getTree($data) {
    $tree = [];

    foreach ($data as $id => &$node) {
        // If has no children, do nothing
        if ($node['parent_id'] == 0) {
            $tree[$id] = &$node;
        } else {
            // Change tree
            $data[$node['parent_id']]['children'][$id] = &$node;
        }
    }

    return $tree;
}

dd(getTree($data));
$tree = getTree($data);

function build_menu_list($tree){
    $html = '<ul>';

    foreach($tree as $item){
        if(isset($item['children'])){
            $html .= '<li><a href="?category=' . $item['id'] . '">' . $item['title'] . '</a>';
            $html .= build_menu_list($item['children']);
            $html .= '</li>';
        } else {
            $html .= '<li><a href="?category=' . $item['id'] . '">' . $item['title'] . '</a></li>';
        }
    }

    $html .= '</ul>';

    return $html;
}

function build_menu_select($tree, $tab = ''){
    $html = '';
    foreach($tree as $item){
        if(isset($item['children'])){
            $html .= "<option>" . $tab . $item['title'] . "</option>";
            $html .= build_menu_select($item['children'], $tab . ' - ');
        } else {
            $html .= "<option>" . $tab . $item['title'] . "</option>";
        }
    }
    return $html;
}

echo build_menu_list($tree);

echo '<select>' . build_menu_select($tree) . '</select>';