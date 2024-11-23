<?php

include("../config/config.php");





if (isset($_POST['action']) && $_POST['action'] == "fetch_categories") {
    $data = array();
    $subdata = array();

    $order = "";
    $add_query = "";
    $add_search = "";

    $fromDate = $_POST['fromDate'];
    $endDate = $_POST['endDate'];


    if (!empty($fromDate) && !empty($endDate)) {
        $add_query = " AND (created_at BETWEEN '$fromDate' AND '$endDate') ";
    } else {
        $add_query = "";
    }


    $sql = "SELECT * from categories WHERE 1=1 $add_query ";
    $sql_query = mysqli_query($connect, $sql);
    $recordsTotal = mysqli_num_rows($sql_query);
    $recordsFiltered = $recordsTotal;


    if (isset($_POST['search']) && $_POST['search']['value'] != "") {
        $add_search = " AND (name LIKE '%" . $_POST['search']['value'] . "%') ";
        $sql .= $add_search;
        $search_query = mysqli_query($connect, $sql);
        $recordsTotal = mysqli_num_rows($search_query);
        $recordsFiltered = $recordsTotal;
    }


    if (isset($_POST['order'])) {
        if ($_POST['length'] == -1) {
            $order .= " ORDER BY id DESC ";
        } else {
            $order .= " ORDER BY id DESC LIMIT " . $_POST['start'] . ", " . $_POST['length'];
        }
    }


    $sql .= $order;




    $main_query = mysqli_query($connect, $sql);

    $check_rows = mysqli_num_rows($main_query);



    if ($check_rows > 0) {
        while ($ra = mysqli_fetch_array($main_query)) {
            $category_id = $ra['id'];

            $subdata = [];


            $subdata[] = $ra['name'];
            $subdata[] = $ra['created_at'];



            $actions = '';

            $actions .= ' <td>
                <div class="d-flex justify-content-center flex-shrink-0">
                   
                    <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit_btn" value="' . $category_id . '">
                        <i class="ki-duotone ki-pencil fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                    <button title="Delete" id="kt_docs_sweetalert_state_question" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete_category" data-numberId="' . $category_id . '">
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


if (isset($_POST['action']) && $_POST['action'] == "add_category_action") {


    $name = mysqli_real_escape_string($connect, $_POST['name']);


    $error = false;

    if (empty($name)) {
        $error = true;
    }


    if ($error == false) {
        $created_at = date("Y-m-d H:i:s");
        $sql = "insert into categories(name,created_at) values('$name','$created_at')";

        $query_prompt_keys = mysqli_query($connect, $sql);
        $inserted_id = mysqli_insert_id($connect);


        $result = array(
            "success" => true,
            "message" => "Category Added Successfully"
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

if (isset($_POST['action']) && $_POST['action'] == "edit_category_details_action") {
    $tid = $_POST['category_id'];

    $sql_select = "select * from categories where id='$tid'";
    $query_select = mysqli_query($connect, $sql_select);
    $rc = mysqli_fetch_array($query_select);

    $name = $rc['name'];

    // echo $category_id;
    echo '<div class="row">
        <div class="col-md-4 mb-5">
            <label class="required form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-solid" placeholder="Enter Name" value="' . $name . '">
        </div>

    </div>
    <input type="hidden" name="category_id" id="category_id" value="'.$tid.'">
    <input type="hidden" name="action" id="edit_category_action" value="edit_category_action">
';
}


if (isset($_POST['action']) && $_POST['action'] == "edit_category_action") {
    // print_r($_POST);
    $error = false;
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $tid = $_POST['category_id'];

    if ($name == "") {
        $error_name = "Name is required";
        $error = true;
    }
   

    if ($error == false) {
        // $updated_at = date("Y-m-d H:i:s");

        $sql_update =  "update categories 
		set name = '$name'
		where id='$tid' LIMIT 1";
        // exit;



        $query_update = mysqli_query($connect, $sql_update);

        $result = array(
            "success" => true,
            "message" => "Category Successfully"
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

if (isset($_POST['action']) && $_POST['action'] == "delete_category_action") {
    $category_id = $_POST['category_id'];
    

    echo $sql_delete_keys = "delete from categories where id='$category_id' LIMIT 1";
    $query_delete_keys = mysqli_query($connect, $sql_delete_keys);

    echo true;
}