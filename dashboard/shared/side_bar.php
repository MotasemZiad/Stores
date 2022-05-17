
  <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item"><a href="index.php"><i class="la la-home"></i><span class="menu-title" data-i18n="nav.dash.main">Dashboard</span></a>
        </li>
        <li class="nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="nav.templates.main">Categories</span><span
              class="badge badge bg-primary badge-info badge-pill float-right mr-2">
              <?php 
                include_once('db/db_connection.php');
                $query = 'SELECT * FROM categories';
                $result = mysqli_query($connection, $query);
                echo mysqli_num_rows($result);
              ?>
            </span></a>
          <ul class="menu-content">
                <li><a class="menu-item" href="add_category.php" data-i18n="nav.templates.horz.classic">Add a new category</a>
                </li>
                <li><a class="menu-item" href="show_all_categories.php" data-i18n="nav.templates.horz.top_icon">All Categories</a>
                </li>
          </ul> 
        </li>
        <li class="nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title" data-i18n="nav.templates.main">Stores</span><span
              class="badge badge bg-success badge-info badge-pill float-right mr-2">
              <?php 
                include_once('db/db_connection.php');
                $query = 'SELECT * FROM stores';
                $result = mysqli_query($connection, $query);
                echo mysqli_num_rows($result);
              ?>
            </span></a>
          <ul class="menu-content">
                <li><a class="menu-item" href="add_store.php" data-i18n="nav.templates.horz.classic">Add a new store</a>
                </li>
                <li><a class="menu-item" href="show_all_stores.php" data-i18n="nav.templates.horz.top_icon">All Stores</a>
                </li>
          </ul> 
        </li>
    </div>
  </div>