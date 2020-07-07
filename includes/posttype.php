<?php
defined('KSA_COUNTD') or die;

add_action('init', 'ksa_countd_setup_post_type');
function ksa_countd_setup_post_type()
{
    register_post_type('ksa_countdown', array(
        'labels' => array(
            'name' => 'Счетчик',
            'singular_name' => 'Счетчик',
            'add_new' => 'Добавить новый',
            'add_new_item' => 'Добавить новый Счетчик',
            'edit_item' => 'Редактировать Счетчик',
            'new_item' => 'Новый Счетчик',
            'view_item' => 'Посмотреть Счетчик',
            'search_items' => 'Найти Счетчик',
            'not_found' => 'Счетчик не найдено',
            'not_found_in_trash' => 'В корзине Счетчик не найдено',
            'menu_name' => 'Счетчики'
        ),
        'public' => false,
        'hierarchical' => false,
        'menu_position' => 30,
        'supports' => array('title'),
        'exclude_from_search' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-clock',
    ));
}

add_filter('manage_ksa_countdown_posts_columns', 'ksa_countd_column_table');
function ksa_countd_column_table($columns)
{
    $new_column = ['shortcode' => 'Shortcode'];

    return array_slice($columns, 0, 2) + $new_column + $columns;
}

add_filter('manage_ksa_countdown_posts_custom_column', 'ksa_countd_custom_column_table', 10, 2);
function ksa_countd_custom_column_table($column_name, $post_id)
{
    if ($column_name === 'shortcode') {
        echo '[ksa_countdown id=' . $post_id . ']';
//        echo get_post_meta($post_id, 'shortcode', true);
    }

    return $column_name;
}
