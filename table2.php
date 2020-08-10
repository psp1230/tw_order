<?php
session_start();
if(!empty($_SESSION[ 'uid'])){
    $sel = $_SESSION['uid'];
}
?>
<?php
include './php/init.php';
if (isset($_POST['Logout'])) {
  // 如果帳號和密碼正確的話，寫入Session變數，並視情況重導到相關的頁面
  // var_dump($_SESSION);
  session_destroy();
  header("Location: https://fbbot.youcanbemama.com/tworder/login.php");
}
if(isset($_POST['Login'])){
  header('Location: https://fbbot.youcanbemama.com/tworder/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link href="./assets/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
    <title>Document</title>
</head>

<style>
    #sticky-footer {
        flex-shrink: none;
    }
</style>

<body style="background-color: #D0D0D0; ">
    <div>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="./index.php">訂單網</a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <form action="" method="POST">
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="./table.php">金額查詢</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./table2.php">訂單查詢</a></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./uploadform.php">新增訂單</a>
                        </li>
                        <?php
                            if (empty($_SESSION['user'])) {
                                echo '<li class="nav-item">
                                    <input type="submit" class="btn btn-outline-light" name="Login" value="登入"></input>
                                </li>';
                                    } else {
                                        echo '<li class="nav-item">
                                    <input type="submit" class="btn btn-outline-light" name="Logout" value="登出"></input>
                                </li>';
                            }
                        ?>
                    </ul>
                </div>
            </form>
        </nav>
    </div>
    <div class="container mt-2 mb-2">
        <div id="toolbar" class="select">
            <select class="form-control">
                <option value="">Export Basic</option>
                <option value="all">Export All</option>
                <option value="selected">Export Selected</option>
            </select>
        </div>

        <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-search-clear-button="true" data-url="https://fbbot.youcanbemama.com/tworder/php/front_select_order.php?uid=<?php echo $sel ?>" data-show-print="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" data-show-jump-to="true">
            <thead>
                <tr>
                    <th data-field="id" data-sortable="true">ID</th>
                    <th data-field="status" data-sortable="true">狀態</th>
                    <th data-field="image" data-sortable="false" data-formatter="imageFormatter">圖片</th>
                    <th data-field="color" data-sortable="true">顏色</th>
                    <th data-field="size" data-sortable="true">尺寸</th>
                    <th data-field="amount" data-sortable="true">數量</th>
                    <th data-field="price" data-sortable="true">單價</th>
                    <th data-field="totalprice" data-sortable="true">總額</th>
                </tr>
            </thead>
        </table>
    </div>
    <!-- Footer -->
    <footer id="sticky-footer" class="py-3 bg-dark text-white-50">
        <div class="container text-center">
            <small style="color: white;">Copyright &copy; Your Website</small>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
    <script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF/jspdf.min.js"></script>
    <script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/print/bootstrap-table-print.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/export/bootstrap-table-export.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/page-jump-to/bootstrap-table-page-jump-to.min.js"></script>


    <script>
        var table = $('#table')

        $('select').on('change', function() {
            if ($(this).val() == 'selected') {
                table.boostrapTable('showColumn', 'state')
            } else {
                table.boostrapTable('hideColumn', 'state')
            }
            table.boostrapTable({
                exportDatatype: $(this).val(),
                exportTypes: ['json', 'xml', 'csv', 'txt', 'spl', 'excel', 'pdf']
            })
        })

        function imageFormatter(value, row) {
            return '<img src="' + value + '" style="width: 100px; height: 100px; " />';
        }
    </script>

</body>

</html>