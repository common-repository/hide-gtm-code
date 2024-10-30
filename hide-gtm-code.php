<?php
/*
* Plugin Name: Hide GTM code
* Plugin URI: https://create-accord.com/production/plugins/
* Description: The plugin embeds GTM code with minimal impact on your theme and performance, preventing unnecessary measurement.
* Version: 1.0.8
* Author: CREATE ACCORD
* Author URI: https://create-accord.com/
* License: GPL2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: hide-gtm-code
* Domain Path: /languages
*/

// Security

if (
    !defined('ABSPATH')
) exit;

// Performance

/* ---------------------------------------------
* プラグインをアンインストールしたときの処理
* 有効化したとき、停止時に行う処理はないので省略
* ------------------------------------------- */
register_uninstall_hook(__FILE__, 'creaco_hgtmc_uninstall');
function creaco_hgtmc_uninstall()
{
    delete_option('hgtmc_gtmcode');
    delete_option('hgtmc_gsccode');
}

// plugin start

/* ---------------------------------------------
* load_plugin_textdomain関数で翻訳ファイルをロードする
* ------------------------------------------- */
add_action('init', function () {
    load_plugin_textdomain('hide-gtm-code');
});

/* ---------------------------------------------
* 管理画面にプラグイン設定画面を追加登録する
* ------------------------------------------- */
add_action('admin_menu', function () {
    // メイン設定
    add_menu_page(
        'Hide GTM Code', // ページのタイトル
        'Hide GTM Code', // 左メニューテキスト
        'manage_options', // 必要な権限の設定
        'creaco_hgtmc_menu', // 左メニューのスラッグ名
        'creaco_hgtmc_mainpage_contents', // メインページ表示呼び出し用（サブメニューを使う場合は空）
        'dashicons-code-standards', // メニューアイコン https://developer.wordpress.org/resource/dashicons/#awards
        81 // メニューが表示される位置のインデックス(0が先頭)
    );
    // サブメニュー（親メニュー）
    add_submenu_page(
        'creaco_hgtmc_menu', // 親メニューのスラッグ
        __('Dashboard', 'hide-gtm-code'), // ページのタイトル
        __('Dashboard', 'hide-gtm-code'), // 左メニュー（サブメニュー）テキスト
        'manage_options', // 必要な権限の設定
        'creaco_hgtmc_menu', // サブメニューのスラッグ名（親と同じにすると親メニューもサブメニューに連動）
        'creaco_hgtmc_mainpage_contents', // サブページ表示呼び出し用（任意）
        81
    );
    // サブメニュー「設定」（事実上の子メニュー）
    add_submenu_page(
        'creaco_hgtmc_menu', // 親メニューのスラッグ
        __('setting', 'hide-gtm-code'), // ページのタイトル
        __('setting', 'hide-gtm-code'), // 左メニュー（サブメニュー）テキスト
        'manage_options', // 必要な権限の設定
        'creaco_hgtmc_submenu', // サブメニューのスラッグ名
        'creaco_hgtmc_subpage_contents', // サブページ表示呼び出し用（任意）
        81
    );
    // サブメニュー「GSC 設定」（事実上の子メニュー）
    add_submenu_page(
        'creaco_hgtmc_menu', // 親メニューのスラッグ
        __('GSC setting', 'hide-gtm-code'), // ページのタイトル
        __('GSC setting', 'hide-gtm-code'), // 左メニュー（サブメニュー）テキスト
        'manage_options', // 必要な権限の設定
        'creaco_hgtmc_submenu_gsc', // サブメニューのスラッグ名
        'creaco_hgtmc_subpage_gsc_contents', // サブページ表示呼び出し用（任意）
        81
    );
});

/* ---------------------------------------------
* メインページ：ページ内容の表示・更新処理
* ------------------------------------------- */
function creaco_hgtmc_mainpage_contents()
{
    // アクセスしたときに権限があるか確認
    if (!current_user_can('manage_options')) {
        // エラー文章
        wp_die(__('You do not have permission to access this settings page.', 'hide-gtm-code'));
    }

    // 表示
?>

    <div class="wrap">
        <h2><?php echo esc_html__('Dashboard', 'hide-gtm-code'); ?></h2>
        <div style="height: 32px;"></div>
        <h3><?php echo esc_html__('Setting method', 'hide-gtm-code'); ?></h3>
        <ol>
            <li>
                <?php echo esc_html__('Copy the code starting with "GTM" from your GTM installation.', 'hide-gtm-code'); ?>
                <br>
                <?php echo esc_html__('No need to copy the entire JavaScript code.', 'hide-gtm-code'); ?>
            </li>
            <li>
                <?php echo esc_html__('Go to the "Settings" screen and paste the code you copied in step 1 into the input field.', 'hide-gtm-code'); ?>
            </li>
        </ol>
        <p>
            <?php echo esc_html__('You can also check the code starting with "GTM" on the workspace and management screen.', 'hide-gtm-code'); ?>
        </p>
        <p><?php echo esc_html__('Be sure to clear the cache after setting.', 'hide-gtm-code'); ?></p>
        <div style="height: 32px;"></div>
        <h3><?php echo esc_html__('Precautions when using GSC', 'hide-gtm-code'); ?></h3>
        <p><?php echo esc_html__('After embedding the GTM code in your website, if you want to register your GA4 with GTM and also register GSC, please select GTM in "How to verify ownership of GSC". Attempting to verify ownership in GA4 fails with an error.', 'hide-gtm-code'); ?></p>
        <div style="height: 8px;"></div>
        <p><?php echo esc_html__('Some themes have tags (such as the "a" tag) embedded directly under the body tag as theme-specific elements. In that case, selecting GTM in "GSC Ownership Verification Method" will unfortunately fail, so please set it in "HTML Tag". If you want to set HTML tags on your website, please set them in "GSC Settings".', 'hide-gtm-code'); ?></p>
        <p><?php echo esc_html__('Be sure to clear the cache after setting.', 'hide-gtm-code'); ?></p>
        <div style="height: 8px;"></div>
        <h3><?php echo esc_html__('others', 'hide-gtm-code'); ?></h3>
        <p><?php echo esc_html__('There is no initialization function. If you want to erase the information you entered, please reinstall the plugin. If there is any necessary information, we apologize for the inconvenience, but please enter it again.', 'hide-gtm-code'); ?></p>
    </div>

<?php
}

/* ---------------------------------------------
* サブメニュー「設定」ページ：ページ内容の表示・更新処理
* ------------------------------------------- */
function creaco_hgtmc_subpage_contents()
{
    // アクセスしたときに権限があるか確認
    if (!current_user_can('manage_options')) {
        // エラー文章
        wp_die(__('You do not have permission to access this settings page.', 'hide-gtm-code'));
    }

    // 初期化
    $hgtmc_script_code_val = get_option('hgtmc_gtmcode'); // GTMコード：既に保存してある値があれば取得

    // 設定入力フォーム表示
?>

    <div class="wrap">
        <h2><?php echo esc_html__('setting', 'hide-gtm-code'); ?></h2>

        <?php
        // 更新時の処理
        if (isset($_POST['hgtmc_gtmcode'])) {

            // POSTされたデータを取得
            $hgtmc_script_code_post = sanitize_text_field($_POST['hgtmc_gtmcode']);
            // POSTで取得したデータをサニタイズ
            // サニタイズしたデータを保存
            update_option('hgtmc_gtmcode', $hgtmc_script_code_post);
            // 更新したあと値が消えてしまうので表示用にvalueに値を入れる
            $hgtmc_script_code_val = $hgtmc_script_code_post;
            // 画面に更新したことを示すメッセージを表示
        ?>

            <div class="notice notice-success is-dismissible">
                <p>
                    <?php echo esc_html__('Your message has been saved.', 'hide-gtm-code'); ?>
                </p>
            </div>

        <?php
        }
        // GTMコード入力用のフォームを表示
        ?>

        <form name="hgtmc_config_form" method="post" action="">
            <p>
                <label for="hgtmc_gtmcode"><?php echo esc_html__('Enter a tag starting with "GTM" in the input field.', 'hide-gtm-code'); ?></label>
                <?php
                if ($hgtmc_script_code_val != '') {
                    $hgtmc_script_code_val_view = $hgtmc_script_code_val;
                } else {
                    $hgtmc_script_code_val_view = '';
                }
                ?>
                <br>
                <input name="hgtmc_gtmcode" value="<?php echo esc_attr($hgtmc_script_code_val_view); ?>" required style="width: 90%; max-width:560px; height:32px;">
            </p>
            <div style="height: 32px;"></div>
            <hr />
            <div style="height: 32px;"></div>
            <p class="submit">
                <input type="submit" name="submit" class="button-primary" value="<?php echo esc_html__('Save settings', 'hide-gtm-code'); ?>">
            </p>
        </form>

    </div>

<?php
}

/* ---------------------------------------------
* サブメニュー「GSC 設定」ページ：ページ内容の表示・更新処理
* ------------------------------------------- */
function creaco_hgtmc_subpage_gsc_contents()
{
    // アクセスしたときに権限があるか確認
    if (!current_user_can('manage_options')) {
        // エラー文章
        wp_die(__('You do not have permission to access this settings page.', 'hide-gtm-code'));
    }

    // 初期化
    $hgtmc_script_gsc_code_val = get_option('hgtmc_gsccode'); // GSCコード：既に保存してある値があれば取得

    // 設定入力フォーム表示
?>

    <div class="wrap">
        <h2><?php echo esc_html__('GSC settings', 'hide-gtm-code'); ?></h2>

        <?php
        // 更新時の処理
        if (isset($_POST['hgtmc_gsccode'])) {

            // POSTされたデータを取得
            $hgtmc_script_gsc_code_post = sanitize_text_field($_POST['hgtmc_gsccode']);
            // POSTで取得したデータをサニタイズ
            // サニタイズしたデータを保存
            update_option('hgtmc_gsccode', $hgtmc_script_gsc_code_post);
            // 更新したあと値が消えてしまうので表示用にvalueに値を入れる
            $hgtmc_script_gsc_code_val = $hgtmc_script_gsc_code_post;
            // 画面に更新したことを示すメッセージを表示
        ?>

            <div class="notice notice-success is-dismissible">
                <p>
                    <?php echo esc_html__('Your message has been saved.', 'hide-gtm-code'); ?>
                </p>
            </div>

        <?php
        }
        // GSCコード入力用のフォームを表示
        ?>

        <form name="hgtmc_gsc_config_form" method="post" action="">
            <p>
                <label for="hgtmc_gsccode"><?php echo esc_html__('Enter the double-quoted code for "Content" in the input field.', 'hide-gtm-code'); ?></label>
                <?php
                if ($hgtmc_script_gsc_code_val != '') {
                    $hgtmc_script_gsc_code_val_view = $hgtmc_script_gsc_code_val;
                } else {
                    $hgtmc_script_gsc_code_val_view = '';
                }
                ?>
                <br>
                <input name="hgtmc_gsccode" value="<?php echo esc_attr($hgtmc_script_gsc_code_val_view); ?>" required style="width: 90%; max-width:560px; height:32px;">
            </p>
            <div style="height: 32px;"></div>
            <hr />
            <div style="height: 32px;"></div>
            <p class="submit">
                <input type="submit" name="submit" class="button-primary" value="<?php echo esc_html__('Save settings', 'hide-gtm-code'); ?>">
            </p>
        </form>

    </div>

    <?php
}

/* ---------------------------------------------
* ソースに設定内容を反映
* ------------------------------------------- */
// タグマネージャー出力1（head）
// サーチコンソールのmetaタグがあれば出力する（head）
add_action('wp_head', function () {
    if (!is_user_logged_in() || (is_user_logged_in() && !current_user_can('edit_posts'))) {
        // ログインしていないとき、または「記事の作成・編集」の権限がないユーザー（購読者を想定）がサイトにログインしてサイトを閲覧したときに呼び出す（script:s)
        $hgtmc_script_code = get_option('hgtmc_gtmcode');
        $hgtmc_script_gsc_code = get_option('hgtmc_gsccode');

        if ($hgtmc_script_gsc_code != '') {
            // GSCコード出力（meta）
    ?>
            <!-- Hide GTM Code HTML Code -->
            <meta name="google-site-verification" content="<?php echo esc_attr($hgtmc_script_gsc_code); ?>">
            <!-- End Hide GTM Code HTML Code -->
        <?php
        }
        if ($hgtmc_script_code != '') {
            // GTMコード出力（script）
        ?>

            <!-- Hide GTM Code script -->
            <!-- Google Tag Manager -->
            <script>
                (function(w, d, s, l, i) {
                    w[l] = w[l] || [];
                    w[l].push({
                        'gtm.start': new Date().getTime(),
                        event: 'gtm.js'
                    });
                    var f = d.getElementsByTagName(s)[0],
                        j = d.createElement(s),
                        dl = l != 'dataLayer' ? '&l=' + l : '';
                    j.async = true;
                    j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                    f.parentNode.insertBefore(j, f);
                })(window, document, 'script', 'dataLayer', '<?php echo esc_attr($hgtmc_script_code); ?>');
            </script>
            <!-- End Google Tag Manager -->
            <!-- End Hide GTM Code script -->

        <?php
        }
    }
});
// タグマネージャー出力2（body）
add_action('wp_body_open', function () {
    if (!is_user_logged_in() || (is_user_logged_in() && !current_user_can('edit_posts'))) {
        // ログインしていないとき、または「記事の作成・編集」の権限がないユーザー（購読者を想定）がサイトにログインしてサイトを閲覧したときに呼び出す（noscript:ns)
        $hgtmc_noscript_code = get_option('hgtmc_gtmcode');
        if ($hgtmc_noscript_code != '') {
            // GTMコード出力（noscript）
        ?>

            <!-- Hide GTM Code noscript -->
            <!-- Google Tag Manager (noscript) -->
            <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr($hgtmc_noscript_code); ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->
            <!-- End Hide GTM Code noscript -->

<?php

        }
    }
}, 0);
