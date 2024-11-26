<?php

include("../config/config.php");





if (isset($_POST['action']) && $_POST['action'] == "fetch_products") {
    $data = array();
    $subdata = array();

    $order = "";
    $add_query = "";
    $add_search = "";

    $fromDate = $_POST['fromDate'];
    $endDate = $_POST['endDate'];


    if (!empty($fromDate) && !empty($endDate)) {
        $add_query = " AND (products.created_at BETWEEN '$fromDate' AND '$endDate') ";
    } else {
        $add_query = "";
    }


     $sql = "SELECT products.id as id,products.name as name,categories.name as category_name,products.created_at as created_at from products,categories  WHERE 1=1 and categories.id = products.category_id  $add_query ";
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
            $order .= " ORDER BY products.id DESC ";
        } else {
            $order .= " ORDER BY products.id DESC LIMIT " . $_POST['start'] . ", " . $_POST['length'];
        }
    }


    $sql .= $order;




    $main_query = mysqli_query($connect, $sql);

    $check_rows = mysqli_num_rows($main_query);



    if ($check_rows > 0) {
        while ($ra = mysqli_fetch_array($main_query)) {
            $product_id = $ra['id'];

            $subdata = [];


            $subdata[] = $ra['name'];
            $subdata[] = $ra['category_name'];
            $subdata[] = $ra['created_at'];



            $actions = '';

            $actions .= ' <td>
                <div class="d-flex justify-content-end flex-shrink-0">
                   
                    <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit_btn" value="' . $product_id . '">
                        <i class="ki-duotone ki-pencil fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                    <button title="Delete" id="kt_docs_sweetalert_state_question" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete_product" data-numberId="' . $product_id . '">
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


if (isset($_POST['action']) && $_POST['action'] == "add_product_action") {


    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $category_id = mysqli_real_escape_string($connect, $_POST['category_id']);



    $error = false;

    if (empty($name)) {
        $error = true;
    }


    if ($error == false) {
        $created_at = date("Y-m-d H:i:s");
        $sql = "insert into products(name,category_id) values('$name','$category_id')";

        $query_prompt_keys = mysqli_query($connect, $sql);
        $inserted_id = mysqli_insert_id($connect);


        $result = array(
            "success" => true,
            "message" => "product Added Successfully"
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

if (isset($_POST['action']) && $_POST['action'] == "edit_product_details_action") {
    $tid = $_POST['product_id'];


    $sql_select = "select * from products where id='$tid'";
    $query_select = mysqli_query($connect, $sql_select);
    $rc = mysqli_fetch_array($query_select);

    $name = $rc['name'];
    $category_id = $rc['category_id'];


   
    
    // Fetch categories from the database
    $query = mysqli_query($connect, "SELECT * FROM categories ORDER BY id DESC");
    
    // Start the HTML block
    echo '
    <div id="product_parent" class="row">
        <div class="col-md-4 mb-5">
            <label class="required form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-solid" placeholder="Enter Name" value="' . htmlspecialchars($name) . '">
        </div>
        <div class="col-md-6 mb-6">
            <label class="required form-label">Category</label>
            <select id="category_id" name="category_id" class="form-select form-select-solid" data-dropdown-parent="#product_parent" data-control="select2">
                <option disabled selected value="">Choose Category</option>';
    
    // Loop through categories and dynamically generate options
    while ($r = mysqli_fetch_array($query)) {
        $selected = ($r['id'] == $category_id) ? 'selected' : '';
        echo '<option  '.$selected.' value="' . htmlspecialchars($r['id']) . '">' . htmlspecialchars($r['name']) . '</option>';
    }
    
    // Close the HTML block
    echo '
            </select>
        </div>
    </div>
    <input type="hidden" name="product_id" id="product_id" value="' . htmlspecialchars($tid) . '">
    <input type="hidden" name="action" id="edit_product_action" value="edit_product_action">
    ';
   
    
}


if (isset($_POST['action']) && $_POST['action'] == "edit_product_action") {
    // print_r($_POST);
    $error = false;
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $tid = $_POST['product_id'];
    $category_id= $_POST['category_id'];


    if ($name == "") {
        $error_name = "Name is required";
        $error = true;
    }
    if ($category_id == "") {
        $error_category = "Category is required";
        $error = true;
    }
   

    if ($error == false) {
        // $updated_at = date("Y-m-d H:i:s");

        $sql_update =  "update products 
		set name = '$name',
        category_id = '$category_id'
		where id='$tid' LIMIT 1";
        // exit;



        $query_update = mysqli_query($connect, $sql_update);

        $result = array(
            "success" => true,
            "message" => "Updated Product Successfully"
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

if (isset($_POST['action']) && $_POST['action'] == "delete_product_action") {
    $product_id = $_POST['product_id'];
    

    echo $sql_delete_keys = "delete from products where id='$product_id' LIMIT 1";
    $query_delete_keys = mysqli_query($connect, $sql_delete_keys);

    echo true;
}