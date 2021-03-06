<?php

/**
 * @return array
 */
function b_waiting_tutorials()
{
    /** @var \XoopsMySQLDatabase $xoopsDB */
    $xoopsDB = \XoopsDatabaseFactory::getDatabaseConnection();
    $ret     = [];
    $block   = [];

    // tutorials
    $myts = \MyTextSanitizer::getInstance();

    $result = $xoopsDB->query('SELECT count(*) FROM ' . $xoopsDB->prefix('tutorials') . ' WHERE status=0 OR status=2 ORDER BY date');
    if ($result) {
        $block['adminlink'] = XOOPS_URL . '/modules/tutorials/admin/index.php';
        [$block['pendingnum']] = $xoopsDB->fetchRow($result);
        $block['lang_linkname'] = _PI_WAITING_WAITINGS;
    }

    $ret[] = $block;

    return $ret;
}
