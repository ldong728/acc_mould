<?php
include_once '../includePackage.php';
session_start();
if (isset($_SESSION[DOMAIN]['login']) && DOMAIN == $_SESSION[DOMAIN]['login']) {

    if (isset($_POST['pms']) && array_key_exists($_POST['pms'], $_SESSION[DOMAIN]['pms'])) {
        if (isset($_POST['method'])) {
            switch ($_POST['method']) {
                default:
                    $param = isset($_POST['ajax_data']) ? $_POST['ajax_data'] : null;
                    $method = trim($_POST['method']);
                    $method($param);
                    break;
            }
        }
        if (isset($_POST['alteTblVal'])) {//快速更改
            $altValues = array();
            foreach ($_POST['col_value'] as $k => $v) {
                $altValues[$k] = addslashes($v);
            }
            $data = pdoUpdate($_POST['tbl'] . '_tbl', $altValues, array($_POST['index'] => $_POST['id']), ' limit 1');
            if ($data) {
                echo ajaxBack(array('id' => $data));
            } else {
                echo ajaxBack(null, 1, '记录无法修改');
            }
            exit;
        }
        if (isset($_POST['deleteTblVal'])) {//快速删除
            try {
                pdoDelete($_POST['tbl'] . '_tbl', $_POST['value'], ' limit 1');
                echo ajaxBack();

            } catch (PDOException $e) {
                echo ajaxBack(null, 1, '记录无法修改');
            }
            exit;
        }
        if (isset($_POST['addTblVal'])) {//快速插入
            try {
                foreach ($_POST['value'] as $k => $v) {
                    $value[$k] = addslashes($v);
                }
                $id = pdoInsert($_POST['tbl'] . '_tbl', $value, $_POST['onDuplicte']);
                echo ajaxBack(array('id' => $id));
            } catch (PDOException $e) {
                echo ajaxBack(null, 1, '记录无法修改');
            }
            exit;
        }
        if (isset($_POST['altConfig'])) {//快速更改设置
            $path = '../config/' . $_POST['name'] . '.json';
            $config = getConfig($path);
            if (array_key_exists($_POST['key'], $config)) {
                $config[$_POST['key']] = $_POST['value'];
                saveConfig($path, $config);
                echo ajaxBack();
            } else {
                echo ajaxBack(null, '3', '不存在的设置项');
            }
            exit;
        }

    } else {
        if ('stock_alert' == $_POST['method']) {
            product_list($_POST['ajax_data']);
            exit;
        }
        echo ajaxBack(null, 9, '无权限');
        exit;
    }
}

/*
 * 以下为ajax通用方法
 */
function category_list()
{
//    verifyPms(['category_edit','product_list','product_edit']);
    $back = pdoQuery('category_tbl', null, null, 'order by p_category asc');
    $back->setFetchMode(PDO::FETCH_ASSOC);
    $back = $back->fetchAll();
    if (!$back) {
        $back = [];
    }
    mylog($back);
    echo ajaxBack($back);
}

function category_attr_list($data)
{
    $category = $data['category_id'];
    $back = pdoQuery('category_attr_tbl', null, ['category' => $category], null);
    $back->setFetchMode(PDO::FETCH_ASSOC);
    echo ajaxBack($back->fetchAll());

}

function category_attr_edit($data)
{
    $categoryId = $data['category_id'];
    $values = $data['values'];
    pdoTransReady();
    try {
        pdoDelete('category_attr_tbl', ['category' => $categoryId]);
        pdoBatchInsert('category_attr_tbl', $values);
        pdoCommit();
        echo ajaxBack('ok');
    } catch (PDOException $e) {
        mylog($e->getMessage());
        pdoRollBack();
        echo ajaxBack(null, 109, '数据库错误');
    }
}

function delete_category($data)
{
    verifyPms('category_edit');
    $id = $data['id'];
    $query = pdoQueryNew('category_tbl', ['category_id'], ['p_category' => $id], 'limit 1')->fetch();
    if ($query) {
        echo ajaxBack(null, 21, '不能删除');
    } else {
        pdoDelete('category_tbl', ['category_id' => $id], ' limit 1');
        echo ajaxBack('ok');
    }
}

function add_category($data)
{
    verifyPms('category_edit');
    $name = '新类型（双击可更改）';
    $pid = $data['parent_id'];
    $id = pdoInsert('category_tbl', ['category_name' => $name, 'p_category' => $pid], 'ignore');
    if ($id) {
        echo ajaxBack(['category_id' => $id, 'category_name' => $name, 'p_category' => $pid, 'img' => '']);
    } else {
        echo ajaxBack(null, 10, '数据库错误');
    }
}

function add_company($data)
{
    $companyInf = $data['company_inf'];
    $companyCategory = $data['company_category'];
    $companyInf['img'] = json_encode($companyInf['img']);
    pdoTransReady();
    try {
        $newId = pdoInsert('company_tbl', $companyInf, 'update');
        if (isset($companyInf['company_id']) && $companyInf['company_id']) {
            pdoDelete('company_category_tbl', ['company' => $companyInf['company_id']]);
            $newId = $companyInf['company_id'];
        }
        $values = [];
        foreach ($companyCategory as $row) {
            $values[] = ['company' => $newId, 'category' => $row['category']];
        }
        if (count($values) > 0) {
            pdoBatchInsert('company_category_tbl', $values, 'ignore');
        }
        pdoCommit();
    } catch (PDOException $e) {
        pdoRollBack();
        mylog($e->getMessage());

    }

    echo ajaxBack('ok');
}

function company_list($data)
{
    $back = getList('company_tbl', 'company_tbl', $data);
    echo ajaxBack($back);
}

function company_category_list($data){
    $category=$data['category'];
    $query=pdoQuery('company_category_view',['company','category','company_name'],['category'=>$category],null);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    echo ajaxBack($query->fetchAll());
}

function add_product($data)
{
    $data['img'] = isset($data['img'])? json_encode($data['img']):null;
    $data['product_attr'] =isset($data['product_attr'])? json_encode($data['product_attr']):null;
    try {
        pdoInsert('product_tbl', $data, 'update');
    } catch (PDOException $e) {
        mylog($e->getMessage());

    }
    echo ajaxBack('ok');
}
function product_list($data){
//    verifyPms(['product_list','purchase_add']);
    $back=getList('product_company_view','product_company_view',$data);
    echo ajaxBack($back);
}


/*
 *以下为通用方法
 * 非ajax
 */
function verifyPms($pms)
{
    $query = pdoQuery('pms_view', ['f_id'], ['f_key' => $_POST['pms'], 's_key' => $pms], 'limit 1')->fetch();
    if (!$query) {
        mylog('ajax 权限错误');
        echo ajaxBack(null, 9, '无权限');
        exit;
    }
}

/**
 * 通用获取列表内容的方法，和前端TableController联合使用
 * @param $tableName
 * @param $countTableName
 * @param $data
 * @param bool $needCount
 * @return mixed
 */
function getList($tableName, $countTableName, $data, $needCount = true)
{
    $number = isset($data['number']) ? $data['number'] : 12;
    $orderby = isset($data['orderby']) && $data['orderby'] ? $data['orderby'] : '';
    $order = isset($data['order']) && $data['order'] ? $data['order'] : '';
    $start = $data['page'] * $number;
    $filter = $orderby && $order ? "order by $orderby $order" : '';
    $limit = " limit $start,$number";
    $where = isset($data['where']) && $data['where'] ? $data['where'] : null;
    $count = 0;
    if ($needCount) {
        $count = pdoQueryNew($countTableName, array('count(*) as count'), $where, $filter)->fetch()['count'];
    }
    $query = pdoQueryNew($tableName, null, $where, $filter . $limit);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query = $query->fetchAll();
    $back['list'] = $query;
    $back['count'] = $count;
    $back['page'] = ceil($count / $number);
    return ($back);
}



/*
 * select user_name,user_phone,address FROM duty_view where duty_id in (select content_int from motion_view where attr_name in ("提案人","领衔人","提案联系人") and motion_id in (select motion_id from motion_view where target="unit" and content_int=55))
 */
