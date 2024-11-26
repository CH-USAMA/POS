<?php

include("../config/config.php");





if (isset($_POST['action']) && $_POST['action'] == "fetch_stocks") {
    $data = array();
    $subdata = array();

    $order = "";
    $add_query = "";
    $add_search = "";

    $fromDate = $_POST['fromDate'];
    $endDate = $_POST['endDate'];


    if (!empty($fromDate) && !empty($endDate)) {
        $add_query = " AND (stocks.created_at BETWEEN '$fromDate' AND '$endDate') ";
    } else {
        $add_query = "";
    }


    //  $sql = "SELECT stocks.id as id,stocks.name as name,categories.name as category_name,stocks.created_at as created_at from stocks,categories  WHERE 1=1 and categories.id = stocks.product_id  $add_query ";

    $sql = "SELECT stocks.id as id,products.name as name,stocks.stock_qty as quantity,stocks.created_at as created_at,stocks.stock_sold as sold,shops.name as shop_name,categories.name as category_name 
     FROM stocks 
    inner join products on stocks.product_id = products.id 
    left join shops on stocks.shop_id = shops.id
    left join categories on products.category_id = categories.id
    WHERE 1=1 $add_query ";
    $sql_query = mysqli_query($connect, $sql);
    $recordsTotal = mysqli_num_rows($sql_query);
    $recordsFiltered = $recordsTotal;


    if (isset($_POST['search']) && $_POST['search']['value'] != "") {
        $add_search = " AND (products.name LIKE '%" . $_POST['search']['value'] . "%') ";
        $sql .= $add_search;
        $search_query = mysqli_query($connect, $sql);
        $recordsTotal = mysqli_num_rows($search_query);
        $recordsFiltered = $recordsTotal;
    }


    if (isset($_POST['order'])) {
        if ($_POST['length'] == -1) {
            $order .= " ORDER BY stocks.id DESC ";
        } else {
            $order .= " ORDER BY stocks.id DESC LIMIT " . $_POST['start'] . ", " . $_POST['length'];
        }
    }


    $sql .= $order;




    $main_query = mysqli_query($connect, $sql);

    $check_rows = mysqli_num_rows($main_query);



    if ($check_rows > 0) {
        while ($ra = mysqli_fetch_array($main_query)) {
            $stock_id = $ra['id'];

            $subdata = [];


            $subdata[] = $ra['name'];
            $subdata[] = $ra['quantity'];
            $subdata[] = $ra['sold'];
            $subdata[] = $ra['shop_name'] ?? 'Not Delivered';
            // $subdata[] = $ra['category_name'];



            $subdata[] = $ra['created_at'];



            $actions = '';

            $actions .= ' <td>
                <div class="d-flex justify-content-end flex-shrink-0">
                   
                    <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit_btn" value="' . $stock_id . '">
                        <i class="ki-duotone ki-pencil fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                    <button title="Delete" id="kt_docs_sweetalert_state_question" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete_stock" data-numberId="' . $stock_id . '">
                        <i class="ki-duotone ki-trash fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                    </button>
                </div>
            </td>';

            $subdata[] = $actions;


            $data[] = $subdata;
        }

        $result = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data
        );
        echo json_encode($result);
    } else {
        $result = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => []
        );

        echo json_encode($result);
    }
}


if (isset($_POST['action']) && $_POST['action'] == "add_stock_action") {


    // print
    $shop_id = $quantity = $sold = 0;
    $shop_id = mysqli_real_escape_string($connect, $_POST['shop_id']);
    $product_id = mysqli_real_escape_string($connect, $_POST['product_id']);
    $quantity = mysqli_real_escape_string($connect, $_POST['stock_qty']);
    $sold = mysqli_real_escape_string($connect, $_POST['stock_sold']);





    $error = false;

    if (empty($product_id)) {
        $error = true;
    }
    if (empty($quantity)) {
        $error = true;
    }
    // if (empty($sold)) {
    //     $error = true;
    // }
    if (empty($shop_id)) {
        $shop_id  = 0;

    }

    if ($error == false) {
        $created_at = date("Y-m-d H:i:s");
        $sql = "insert into stocks(product_id,stock_qty,stock_sold,shop_id) values('$product_id','$quantity','$sold',$shop_id)";
        $query_prompt_keys = mysqli_query($connect, $sql);
        $inserted_id = mysqli_insert_id($connect);


        $result = array(
            "success" => true,
            "message" => "Stock Added Successfully"
        );

        echo json_encode($result);
    } else {
        $result = array(
            "success" => false,
            "message" => "Invalid Form details"
        );
        echo json_encode($result);
    }
}

if (isset($_POST['action']) && $_POST['action'] == "edit_stock_details_action") {
    $tid = $_POST['stock_id'];


    $sql_select = "select * from stocks where id='$tid'";
    $query_select = mysqli_query($connect, $sql_select);
    $rc = mysqli_fetch_array($query_select);

    $product_id = $rc['product_id'];
    $shop_id = $rc['shop_id'];
    $stock_qty = $rc['stock_qty'];
    $stock_sold = $rc['stock_sold'];






    // Fetch categories from the database
    $query = mysqli_query($connect, "select products.id as id,products.name as product_name,categories.name as category_name from products,categories where products.category_id = categories.id order by id desc");

    // Start the HTML block
    echo '
    <div class="row">
       
        <div class="col-md-6 mb-6">
            <label class="required form-label">Category</label>
            <select id="product_id" name="product_id" class="form-select form-select-solid" data-control="select2">
                <option disabled selected value="">Choose Product</option>';

    // Loop through categories and dynamically generate options
    while ($r = mysqli_fetch_array($query)) {
        $selected = ($r['id'] == $product_id) ? 'selected' : '';
        echo '<option  ' . $selected . ' value="' . htmlspecialchars($r['id']) . '">' . htmlspecialchars($r['product_name']) . '- ' . htmlspecialchars($r['category_name']) . '</option>';
    }

    // Close the HTML block
    echo '
            </select>
        </div>
    </div>

     <div class="col-md-6 mb-6">
                            <label class="required form-label">Quantity</label>
                            <input type="number" name="stock_qty" id="stock_qty" class="form-control form-control-solid" value="'.$stock_qty.'" placeholder="Enter stock quantity">
                    </div>

                        <div class="col-md-6 mb-6">
                            <label class="required form-label">Sold</label>
                            <input type="number" name="stock_sold" id="stock_sold" value="'.$stock_sold.'" class="form-control form-control-solid" placeholder="Enter stock Sold">
                        </div>
    <input type="hidden" name="stock_id" id="stock_id" value="' . htmlspecialchars($tid) . '">
    <input type="hidden" name="action" id="edit_stock_action" value="edit_stock_action">
    ';

    // Fetch categories from the database
    $query = mysqli_query($connect, "select * from shops order by id desc");

    // Start the HTML block
    echo '
    <div class="row">
       
        <div class="col-md-6 mb-6">
            <label class="required form-label">Category</label>
            <select id="shop_id" name="shop_id" class="form-select form-select-solid" data-control="select2">
                <option disabled selected value="">Choose Product</option>';

    // Loop through categories and dynamically generate options
    while ($r = mysqli_fetch_array($query)) {
        $selected = ($r['id'] == $shop_id) ? 'selected' : '';
        echo '<option  ' . $selected . ' value="' . htmlspecialchars($r['id']) . '">' . htmlspecialchars($r['name']) . '</option>';
    }

    // Close the HTML block
    
}


if (isset($_POST['action']) && $_POST['action'] == "edit_stock_action") {
    // print_r($_POST);
    $error = false;
    $tid = $_POST['stock_id'];
    $product_id = $_POST['product_id'];

    $shop_id = mysqli_real_escape_string($connect, $_POST['shop_id']);
    $quantity = mysqli_real_escape_string($connect, $_POST['stock_qty']);
    $sold = mysqli_real_escape_string($connect, $_POST['stock_sold']);






    if (empty($product_id)) {
        $error = true;
    }
    if (empty($quantity)) {
        $error = true;
    }
    if (empty($sold)) {
        $error = true;
    }


    
    if ($product_id == "") {
        $error_category = "Category is required";
        $error = true;
    }


    if ($error == false) {
        // $updated_at = date("Y-m-d H:i:s");

        $sql_update =  "update stocks 
		set 
        product_id = '$product_id',
        stock_qty = '$quantity',
        stock_sold = '$sold',
        shop_id = '$shop_id'
		where id='$tid' LIMIT 1";
        // exit;



        $query_update = mysqli_query($connect, $sql_update);

        $result = array(
            "success" => true,
            "message" => "Updated stock Successfully"
        );
        echo json_encode($result);
    } else {
        $result = array(
            "success" => false,
            "message" => "Invalid Form Details"
        );
        echo json_encode($result);
    }
}

if (isset($_POST['action']) && $_POST['action'] == "delete_stock_action") {
    $stock_id = $_POST['stock_id'];


    echo $sql_delete_keys = "delete from stocks where id='$stock_id' LIMIT 1";
    $query_delete_keys = mysqli_query($connect, $sql_delete_keys);

    echo true;
}
