<?php

include("../config/config.php");





if (isset($_POST['action']) && $_POST['action'] == "fetch_sales") {
    $data = array();
    $subdata = array();

    // print_r([$_POST]);

    $order = "";
    $add_query = "";
    $add_search = "";

    $fromDate = $_POST['fromDate'];
    $endDate = $_POST['endDate'];
    $type_filter = $_POST['type_filter'];
    $shop_id_filter = $_POST['shop_id_filter'];
    $product_id_filter = $_POST['product_id_filter'];



    if (!empty($fromDate) && !empty($endDate)) {
        $add_query .= " AND (sales.date BETWEEN '$fromDate' AND '$endDate') ";
    }
    if(!empty($shop_id_filter))
    {
        $add_query .= " AND shops.id =  '$shop_id_filter' ";
    }
    if(!empty($type_filter))
    {
        $add_query .= " AND sales.type =  '$type_filter' ";
    } 
    if(!empty($product_id_filter))
    {
        $add_query .= " AND sales.product_id =  '$product_id_filter' ";
    } 

    
    //  $sql = "SELECT sales.id as id,sales.name as name,categories.name as category_name,sales.date as date from sales,categories  WHERE 1=1 and categories.id = sales.product_id  $add_query ";

     $sql = "SELECT sales.id as id,products.name as name,sales.quantity as quantity,sales.date as date,sales.type as type,shops.name as shop_name,categories.name as category_name 
     FROM sales 
    inner join products on sales.product_id = products.id 
    left join shops on sales.shop_id = shops.id
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
            $order .= " ORDER BY sales.id DESC ";
        } else {
            $order .= " ORDER BY sales.id DESC LIMIT " . $_POST['start'] . ", " . $_POST['length'];
        }
    }


    $sql .= $order;




    $main_query = mysqli_query($connect, $sql);

    $check_rows = mysqli_num_rows($main_query);
    $total_sale = 0;



    if ($check_rows > 0) {
        while ($ra = mysqli_fetch_array($main_query)) {
            $sale_id = $ra['id'];

            $subdata = [];


            $subdata[] = $ra['name'].' <br> '.$ra['category_name'];
            $subdata[] = $ra['quantity'];
            $total_sale += $ra['quantity'];
            $subdata[] = $ra['type'];
            $subdata[] = $ra['shop_name'] ?? 'Not Delivered';
            // $subdata[] = $ra['category_name'];



            $subdata[] = $ra['date'];



            $actions = '';

            $actions .= ' <td>
                <div class="d-flex justify-content-end flex-shrink-0">
                   
                    <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit_btn" value="' . $sale_id . '">
                        <i class="ki-duotone ki-pencil fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                    <button title="Delete" id="kt_docs_sweetalert_state_question" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete_sale" data-numberId="' . $sale_id . '">
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
            "data" => $data,
            "total_sale" => $total_sale

        );
        echo json_encode($result);
    } else {
        $result = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => [],
            "total_sale" => $total_sale

        );

        echo json_encode($result);
    }
}


if (isset($_POST['action']) && $_POST['action'] == "add_sale_action") {


    // print
    $shop_id = $quantity = $type = 0;
    $shop_id = mysqli_real_escape_string($connect, $_POST['shop_id']);
    $product_id = mysqli_real_escape_string($connect, $_POST['product_id']);
    $quantity = mysqli_real_escape_string($connect, $_POST['quantity']);
    $type = mysqli_real_escape_string($connect, $_POST['type']);





    $error = false;

    if (empty($product_id)) {
        $error = true;
    }
    if (empty($quantity)) {
        $error = true;
    }
    if (empty($type)) {
        $error = true;
    }
    if (empty($shop_id)) {
        $shop_id  = 0;

    }

    if ($error == false) {
        $date = date("Y-m-d H:i:s");
        $sql = "insert into sales(product_id,quantity,type,shop_id) values('$product_id','$quantity','$type',$shop_id)";
        $query_prompt_keys = mysqli_query($connect, $sql);
        $inserted_id = mysqli_insert_id($connect);


        $result = array(
            "success" => true,
            "message" => "sale Added Successfully"
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

if (isset($_POST['action']) && $_POST['action'] == "edit_sale_details_action") {
    $tid = $_POST['sale_id'];


    $sql_select = "select * from sales where id='$tid'";
    $query_select = mysqli_query($connect, $sql_select);
    $rc = mysqli_fetch_array($query_select);

    $product_id = $rc['product_id'];
    $shop_id = $rc['shop_id'];
    $quantity = $rc['quantity'];
    $type = $rc['type'];






    // Fetch categories from the database
    $query = mysqli_query($connect, "select products.id as id,products.name as product_name,categories.name as category_name from products,categories where products.category_id = categories.id order by id desc");

    // Start the HTML block
    echo '
    <div id="edit_sale_parent" class="row">
       
        <div class="col-md-6 mb-6">
            <label class="required form-label">Category</label>
            <select id="product_id" name="product_id" class="form-select form-select-solid" data-dropdown-parent="#edit_sale_parent" data-control="select2">
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

     <div class="col-md-6 mb-6">
                            <label class="required form-label">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control form-control-solid" value="'.$quantity.'" placeholder="Enter sale quantity">
                    </div>

                        <div class="col-md-6 mb-6">
                           <label class="required form-label">Sales Type</label>
                            <select id="type" name="type" class="form-select form-select-solid" data-dropdown-parent="#edit_sale_parent"  data-control="select2">
                            <option disabled selected value="">Choose Sales type</option>';
                                echo '<option '.$selected = ($type == "produced") ? "selected" : "";
                                echo ' value="produced">Produced</option>';
                                echo '<option '.$selected = ($type == "sold") ? "selected" : "";
                                echo ' value="sold">Sold</option>';

                 
                            echo '          </select>
                        </div>
    <input type="hidden" name="sale_id" id="sale_id" value="' . htmlspecialchars($tid) . '">
    <input type="hidden" name="action" id="edit_sale_action" value="edit_sale_action">
    ';

    // Fetch categories from the database
    $query = mysqli_query($connect, "select * from shops order by id desc");

    // Start the HTML block
    echo '
       
        <div class="col-md-6 mb-6">
            <label class="required form-label">Shop</label>
            <select id="shop_id" name="shop_id" class="form-select form-select-solid" data-dropdown-parent="#edit_sale_parent" data-control="select2">
                <option disabled selected value="">Choose Shop</option>';

    // Loop through categories and dynamically generate options
    while ($r = mysqli_fetch_array($query)) {
        $selected = ($r['id'] == $shop_id) ? 'selected' : '';
        echo '<option  ' . $selected . ' value="' . htmlspecialchars($r['id']) . '">' . htmlspecialchars($r['name']) . '</option>';
    }
echo '</select></div></div>';
    // Close the HTML block
    
}


if (isset($_POST['action']) && $_POST['action'] == "edit_sale_action") {
    // print_r($_POST);
    $error = false;
    $tid = $_POST['sale_id'];
    $product_id = $_POST['product_id'];

    $shop_id = mysqli_real_escape_string($connect, $_POST['shop_id']);
    $quantity = mysqli_real_escape_string($connect, $_POST['quantity']);
    $type = mysqli_real_escape_string($connect, $_POST['type']);






    if (empty($product_id)) {
        $error = true;
    }
    if (empty($quantity)) {
        $error = true;
    }
    if (empty($type)) {
        $error = true;
    }


    
    if ($product_id == "") {
        $error_category = "Category is required";
        $error = true;
    }


    if ($error == false) {
        // $updated_at = date("Y-m-d H:i:s");

        $sql_update =  "update sales 
		set 
        product_id = '$product_id',
        quantity = '$quantity',
        type = '$type',
        shop_id = '$shop_id'
		where id='$tid' LIMIT 1";
        // exit;



        $query_update = mysqli_query($connect, $sql_update);

        $result = array(
            "success" => true,
            "message" => "Updated sale Successfully"
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

if (isset($_POST['action']) && $_POST['action'] == "delete_sale_action") {
    $sale_id = $_POST['sale_id'];


    echo $sql_delete_keys = "delete from sales where id='$sale_id' LIMIT 1";
    $query_delete_keys = mysqli_query($connect, $sql_delete_keys);

    echo true;
}
