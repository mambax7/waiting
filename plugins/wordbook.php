<?php

/**
 * @return array
 */
function b_waiting_wordbook()
{
    /** @var \XoopsMySQLDatabase $xoopsDB */
    $xoopsDB = \XoopsDatabaseFactory::getDatabaseConnection();
    $ret     = [];

    // Waiting
    $block  = [];
    $result = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('wbentries') . ' WHERE submit=1 AND categoryID>0');
    if ($result) {
        $block['adminlink'] = XOOPS_URL . '/modules/wordbook/admin/index.php#esp.';
        [$block['pendingnum']] = $xoopsDB->fetchRow($result);
        $block['lang_linkname'] = _PI_WAITING_WAITINGS;
    }
    $ret[] = $block;

    // Request
    $result = $xoopsDB->query('SELECT COUNT(*) FROM ' . $xoopsDB->prefix('wbentries') . ' WHERE submit=1 AND categoryID=0');
    if ($result) {
        $block['adminlink'] = XOOPS_URL . '/modules/wordbook/admin/index.php#sol.';
        [$block['pendingnum']] = $xoopsDB->fetchRow($result);
        $block['lang_linkname'] = _PI_WAITING_REQUESTS;
    }
    $ret[] = $block;

    return $ret;
}
