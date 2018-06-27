<?php

    function frontbox_user_profile_add_information($user) {
        ?>
            <h2>Addon information</h2>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="field_specialization">Specialization</label>
                    </th>
                    <td>
                        <input type="text" id="field_specialization" name="field_specialization" value="<?php echo esc_attr(get_the_author_meta('field_specialization', $user->ID)); ?>" class="regular-text">
                        <p>EX. <span class="description">UX Designer, Web Developer</span></p>
                    </td>
                </tr>
            </table>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="field_specialization">Work</label>
                    </th>
                    <td>
                        <input type="text" id="field_work" name="field_work" value="<?php echo esc_attr(get_the_author_meta('field_work', $user->ID)); ?>" class="regular-text">
                        <p>EX. <span class="description">Varsovie Agency</span></p>
                    </td>
                </tr>
            </table>
        <?php
    }
    add_action('show_user_profile', 'frontbox_user_profile_add_information');
    add_action('edit_user_profile', 'frontbox_user_profile_add_information');

    function frontbox_user_profile_save_information($user_id) {
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }
        update_user_meta($user_id, 'field_specialization', $_POST['field_specialization']);
        update_user_meta($user_id, 'field_work', $_POST['field_work']);
    }
    add_action('personal_options_update', 'frontbox_user_profile_save_information');
    add_action('edit_user_profile_update', 'frontbox_user_profile_save_information');
    
?>