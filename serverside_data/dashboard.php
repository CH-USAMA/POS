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




    if (!empty($fromDate) && !empty($endDate)) {
        $add_query .= " AND (sales.date BETWEEN '$fromDate' AND '$endDate') ";
    }

    
    //  $sql = "SELECT sales.id as id,sales.name as name,categories.name as category_name,sales.date as date from sales,categories  WHERE 1=1 and categories.id = sales.product_id  $add_query ";

     $sql = "SELECT 
    product_id,
		products.name as name,
        categories.name as category_name,
    SUM(CASE WHEN type = 'produced' THEN quantity ELSE 0 END) AS total_produced,
    SUM(CASE WHEN type = 'sold' THEN quantity ELSE 0 END) AS total_sold,
    (SUM(CASE WHEN type = 'produced' THEN quantity ELSE 0 END) - 
     SUM(CASE WHEN type = 'sold' THEN quantity ELSE 0 END)) AS remaining_quantity
FROM 
    sales,products,categories 
WHERE 
		sales.product_id = products.id
        and products.category_id = categories.id

    $add_query ";
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
            $order .= "GROUP BY 
    product_id ORDER BY sales.id DESC ";
        } else {
            $order .= "GROUP BY 
    product_id ORDER BY sales.id DESC LIMIT " . $_POST['start'] . ", " . $_POST['length'];
        }
    }


    $sql .= $order;




    $main_query = mysqli_query($connect, $sql);

    $check_rows = mysqli_num_rows($main_query);
    $total_sale = 0;



    if ($check_rows > 0) {
        while ($ra = mysqli_fetch_array($main_query)) {
            // $sale_id = $ra['id'];

            $subdata = [];


            $subdata[] = $ra['name'].' <br> '.$ra['category_name'];
            $subdata[] = $ra['total_produced'];
            $subdata[] = $ra['total_sold'];
            $subdata[] = $ra['remaining_quantity'];
            // $subdata[] = $ra['category_name'];



            // $subdata[] = $ra['date'];



            // $actions = '';

          
            // $subdata[] = $actions;


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




if (isset($_POST['action']) && $_POST['action'] == "fetch_shops") {
    $data = array();
    $subdata = array();

    // print_r([$_POST]);

    $order = "";
    $add_query = "";
    $add_search = "";


    //  $sql = "SELECT sales.id as id,sales.name as name,categories.name as category_name,sales.date as date from sales,categories  WHERE 1=1 and categories.id = sales.product_id  $add_query ";

     $sql = "SELECT 
    shop_id,
		shops.name as name,
    SUM(CASE WHEN type = 'sold' THEN quantity ELSE 0 END) AS total_sold
FROM 
    sales,shops
WHERE 
		sales.shop_id = shops.id 
        

    $add_query";
    $sql_query = mysqli_query($connect, $sql);
    $recordsTotal = mysqli_num_rows($sql_query);
    $recordsFiltered = $recordsTotal;


    if (isset($_POST['search']) && $_POST['search']['value'] != "") {
        $add_search = " AND (shops.name LIKE '%" . $_POST['search']['value'] . "%') ";
        $sql .= $add_search;
        $search_query = mysqli_query($connect, $sql);
        $recordsTotal = mysqli_num_rows($search_query);
        $recordsFiltered = $recordsTotal;
    }


    if (isset($_POST['order'])) {
        if ($_POST['length'] == -1) {
            $order .= " GROUP BY 
    shop_id ORDER BY sales.id DESC ";
        } else {
            $order .= " GROUP BY 
    shop_id ORDER BY sales.id DESC LIMIT " . $_POST['start'] . ", " . $_POST['length'];
        }
    }


     $sql .= $order;




    $main_query = mysqli_query($connect, $sql);

    $check_rows = mysqli_num_rows($main_query);
    $total_sale = 0;



    if ($check_rows > 0) {
        while ($ra = mysqli_fetch_array($main_query)) {
            // $sale_id = $ra['id'];

            $subdata = [];


            $subdata[] = $ra['name'];
            $subdata[] = $ra['total_sold'];
            // $subdata[] = $ra['category_name'];



            // $subdata[] = $ra['date'];



            // $actions = '';

          
            // $subdata[] = $actions;


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
