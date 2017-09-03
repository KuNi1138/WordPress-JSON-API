<?php
/*
Template Name: API Page
*Github:https://github.com/KuNi1138/WordPress-JSON-API
*/

$args = array (
  // The Query
  //カスタム投稿タイプにも対応
  'post_type'      => 'post',
  'post_status'    => 'publish',
  'posts_per_page'   => -1
);
$query = new WP_Query($args);

if ($query->have_posts()) {
    $records = array();
    while ($query->have_posts()) {
        $query->the_post();
        $records[] = array(
          'title'     => get_the_title(),   //タイトルを取得
          'content'   => get_the_content(), //本文を取得
          // Advanced Custom Fields
          //https://www.advancedcustomfields.com/
          'value'   => get_field('field'),
          'value2'  => get_field('field2')
        );
    }
}

header("Content-Type: application/json; charset=utf-8");
echo json_encode($records);
