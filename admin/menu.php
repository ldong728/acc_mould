<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/25
 * Time: 11:16
 */
function printAdminView($addr, $title = 'abc', $subPath = '/admin')
{
    if (!isset($_SESSION[DOMAIN]['pms'])) {
        if (isset($_SESSION[DOMAIN]['operator_id'])) {
            if (-1 == $_SESSION[DOMAIN]['operator_id']) {
                $menuQuery = pdoQuery('pms_view', null, null, ' order by f_id,s_id asc');
            } else {
                $opQuery = pdoQuery('op_pms_tbl', array('pms_id'), array('o_id' => $_SESSION[DOMAIN]['operator_id']), null);
                foreach ($opQuery as $row) {
                    $pmList[] = $row['pms_id'];
                }
                $menuQuery = pdoQuery('pms_view', null, array('f_id' => $pmList), ' order by f_id,s_id asc');
            }
        } else {
            $menuQuery = pdoQuery('pms_view', null, array('f_key' => 'dealer'), ' order by f_id,s_id asc');
        }

        foreach ($menuQuery as $row) {
            if (!isset($_SESSION[DOMAIN]['pms'][$row['f_key']])) {
                $_SESSION[DOMAIN]['pms'][$row['f_key']] = array('key' => $row['f_key'], 'name' => $row['f_name'], 'sub' => array());
            }
            if (isset($row['s_id'])) $_SESSION[DOMAIN]['pms'][$row['f_key']]['sub'][$row['s_key']] = array('id' => $row['s_id'], 'key' => $row['s_key'], 'name' => $row['s_name']);
        }
    }
//    pdoQuery('sub_menu_tbl',null,array('parent_id'=>array()))
    $mypath = $GLOBALS['mypath'];
    include $mypath . $subPath . '/templates/header.html.php';
    include $mypath .$subPath. '/view/' . $addr;
    include $mypath . $subPath . '/templates/footer.html.php';
}
