<?php

add_action('save_post', 'ksa_countd_save_meta');
function ksa_countd_save_meta($post_id)
{
    if ($parent_id = wp_is_post_revision($post_id))
        $post_id = $parent_id;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

    $slug = 'ksa_countdown';
    if ($slug != $_POST['post_type']) {
        return;
    }

    $count_items = [];
    if (isset($_POST['time'])) {

        update_post_meta($post_id, 'time', $_POST['time']);

        for ($i = 1; $i <= 4; $i++) {
            if (isset($_POST['count_' . $i])) {
                update_post_meta($post_id, 'count_' . $i, $_POST['count_' . $i]);
            } else {
                delete_post_meta($post_id, 'count_' . $i);
                delete_post_meta($post_id, 'title_' . $i);
                delete_post_meta($post_id, 'desc_' . $i);

                break;
            }
            if (isset($_POST['title_' . $i])) {
                update_post_meta($post_id, 'title_' . $i, $_POST['title_' . $i]);
            } else {
                delete_post_meta($post_id, 'title_' . $i);
                delete_post_meta($post_id, 'desc_' . $i);

                break;
            }
            if (isset($_POST['desc_' . $i])) {
                update_post_meta($post_id, 'desc_' . $i, $_POST['desc_' . $i]);
            } else {
                delete_post_meta($post_id, 'desc_' . $i);
            }
            $count_items[] = '<div class="countdown__item">'
                .'<div class="count count__number" data-count="' . $_POST['count_' . $i] . '"></div>'
                .'<div class="title">'. $_POST['title_' . $i] . '</div>'
                .'<div class="description">'. (isset($_POST['desc_' . $i]) ? $_POST['desc_' . $i] : '') . '</div>'
                .'</div>';
        }

        $content = '';
        if ($j = count($count_items)) {
            $content .= '<div class="list count__list" id="countd__' . $post_id . '" data-time="' . $_POST['time'] . '">';
            foreach ($count_items as $item) {
                $content .= $item;
            }
            $content .= '</div>';
        }


        $shortcode = '[ksa_countdown_' . $post_id . ']';
        update_post_meta($post_id, 'shortcode', $shortcode);

        remove_action('save_post', 'ksa_countd_save_meta');
        wp_update_post([
            'post_title' => $_POST['post_title'],
            'post_content' => $content,
            'post_status' => 'publish'
        ]);
        add_action('save_post', 'ksa_countd_save_meta');
    }

    return $post_id;
}

add_action('admin_menu', 'ksa_countd_add_meta');
function ksa_countd_add_meta()
{
    add_meta_box('work_select2', 'Add Countdown items', 'ksa_countd_display_meta', 'ksa_countdown', 'normal', 'default');
}

function ksa_countd_display_meta($post_object)
{
    $metas = get_post_meta($post_object->ID);

    $html = '';
    $html .= '<label for="time">Time, milliseconds: </label> ';
    $html .= '<input type="number" min="1" id="time" name="time" size="25" value="'
        . (int)get_post_meta($post_object->ID, 'time')[0] . '" required /><br>';
    $html .= '<div class="count__list">';
    for ($i = 1; $i < 5; $i++) {
        if (get_post_meta($post_object->ID, 'count_' . $i)[0]) {
            $html .= '<div class="dynamic"><div class="dynamic__item number_item">' . $i . '</div>';
            $html .= '<div class="dynamic__item"><label>Count</label>';
            $html .= '<input class="count" type="number" min="1" name="count_' . $i . '" value="'
                . (int)get_post_meta($post_object->ID, 'count_' . $i)[0] . '"required/></div>';
            $html .= '<div class="dynamic__item"><label>Title</label>';
            $html .= '<input  class="title" type="text"" name="title_' . $i . '" required value="'
                . get_post_meta($post_object->ID, 'title_' . $i)[0] . '" /></div>';
            $html .= '<div class="dynamic__item"><label>Description</label>';
            $html .= '<textarea name="desc_' . $i . '" size="25" cols="40" rows="2"/>'
                . get_post_meta($post_object->ID, 'desc_' . $i)[0] . '</textarea></div></div>';
        } else {
            break;
        }
    }
    $html .= '</div><br>';
    $html .= '<div class=""><button id="add__count" class="button button-primary">Add count</button></div>';
    echo $html;
}



