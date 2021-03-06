<?php

/**
 * @param string $wp_num
 * @return array
 */
function b_waiting_wordpress_0($wp_num = '')
{
    /** @var \XoopsMySQLDatabase $xoopsDB */
    $xoopsDB = \XoopsDatabaseFactory::getDatabaseConnection();
    $ret     = [];
    $block   = [];

    // wordpress
    $result = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix("wp{$wp_num}_comments") . " WHERE comment_approved='0'");
    if ($result) {
        $block['adminlink'] = XOOPS_URL . "/modules/wordpress{$wp_num}/wp-admin/moderation.php";
        [$block['pendingnum']] = $xoopsDB->fetchRow($result);
        $block['lang_linkname'] = sprintf(_PI_WAITING_WAITINGS_FMT, $wp_num);
    }

    $ret[] = $block;

    return $ret;
}

for ($i = 0; $i < 10; ++$i) {
    if (file_exists(XOOPS_ROOT_PATH . "/modules/wordpress{$i}/xoops_version.php")) {
        eval(
            ' function b_waiting_wordpress_' . ($i + 1) . '() {
            return b_waiting_wordpress_0(' . $i . ');
        }
        '
        );
    }
}
?>
