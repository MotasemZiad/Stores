<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<?php include_once('shared/header.php'); ?>

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu-modern"
  data-col="2-columns">
  <?php 
  include_once("shared/nav.php"); 
  include_once("shared/side_bar.php");
  ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row"> 
      </div>
      <div class="content-body">
      <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Products</h4>
                                <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table style="width: 100%"
                                           class="table display nowrap table-striped table-bordered scroll-horizontal ">
                                        <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th> Product Details</th>
                                            <th> Product First Price</th>
                                            <th> Product Price</th>
                                            <th> Product Quantity</th>
                                            <th> Product's Category</th>
                                            <th>Status</th>
                                            <th> Image</th>
                                            <th colspan="2"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                include_once('db/db_connection.php');
                                                $limit = 4;
                                                $page = $_GET['page'] ?? 1; 
                                                $offset = ($page - 1) * $limit;


                                                $query = "SELECT * FROM products ORDER BY id DESC LIMIT $limit OFFSET $offset";
                                                $result = mysqli_query($connection, $query);
                                                if(mysqli_num_rows($result) > 0){
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        if($row['status'] == 1){
                                                            $status = "<span class='badge badge-success'>Active</span>";
                                                        }else {
                                                            $status = "<span class='badge badge-danger'>Inactive</span>";
                                                        }
                                                        $query1 = "SELECT name FROM categories WHERE id =" . $row['category_id'] . "";
                                                        $result1 = mysqli_query($connection, $query1);
                                                        $category_row = mysqli_fetch_assoc($result1);


                                                        echo "<tr>".
                                                        "<td>". $row['name'] ."</td>".
                                                        "<td>". $row['description'] ."</td>".
                                                        "<td> $". $row['first_price'] ."</td>".
                                                        "<td> $". $row['price'] ."</td>".
                                                        "<td>". $row['quantity'] ."</td>".
                                                        "<td>". $category_row['name'] ."</td>".
                                                        "<td>". $status ."</td>".
                                                        "<td> <img width='75px' height='75px' src='http://localhost/final_project/dashboard/uploads/images/". $row['image'] ."'</td>".
                                                        "<td> <a href='edit_product.php?id=". $row['id'] ."' class='btn btn-primary'>Edit
                                                                </a></td>".
                                                        "<td>
                                                        <form class='c_form' action='delete_product.php' method='POST'>
                                                        <input name='id' type='hidden' value='".$row['id']."'>
                                                            <button type='button' class='btn btn-danger delete_product' id='delete-btn'>
                                                                DELETE
                                                            </button>
                                                        </form>
                                                        </td>".
                                                        "</tr>";
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">
                                        <div class="row">
                                            <div class="col-12">
                                                <?php
                                                    $query = "SELECT count(id) AS row_number FROM products";
                                                    $result = mysqli_query($connection, $query);
                                                    $row = mysqli_fetch_assoc($result);
                                                    $pages = ceil($row['row_number'] / $limit);

                                                    echo "<ul class='pagination'>";
                                                    for ($i=1; $i <= $pages; $i++) { 
                                                        echo "<li class='page-item'><a href='show_all_products.php?page=". $i ."' class='page-link'> $i </a> </li>";
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php include_once("shared/footer.php"); ?> 
<script>
    $('.delete_product').click(function (event) {
        var result = confirm('Are you sure you want to delete this product?');

        if(result){
            $('.c_form').submit();
        }
    });
</script>
    </body>
</html>