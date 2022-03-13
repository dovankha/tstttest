<?php
    $connect = mysqli_connect('localhost', 'root', '', 'blog') or die('Can not connect database.');
    mysqli_set_charset($connect, "utf8");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link type="text/css" href="style.css" rel="stylesheet">
    <title>Nhom 3</title>
</head>
<body>
<div class="container">
    <div>
        <div class="w3-card-4">
            <img src="z3246267537146_1d2dcaa094a450362da08b12da6393f1.jpg"
                 alt="logo" style="width: 100%">
            <hr>
        </div>
    </div>
    <div>
        <nav class="navbar navbar-expand-md justify-content-center">
            <ul class="navbar-nav menu">
                <li class="nav-item home">
                    <a class="nav-link" href="#">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">AUTHORS</a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link">SIGN IN</a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link">SIGN UP</a>
                </li>
                <?php
                if (isset($_SESSION['username1'])) {
                    echo '<li class="nav-item">
                            <a href="Sign%20out.php" class="nav-link">SIGN OUT</a>
                        </li>';
                    echo '<li class="nav-item">
                            <a href="Add%20Post.php" class="nav-link">ADD POST</a>
                        </li>';
                }
                ?>
            </ul>
        </nav>
    </div>

    <div class="container align-content-center">
        <?php
        if (isset($_SESSION['username1'])) {
            $member = $_SESSION['username1'];
            echo "Hello, $member. ";
        }
        ?>
    </div>

    <?php
    $sql = "select * from posts order by date";
    $query = mysqli_query($connect, $sql);
    if (!$query) {
        die('Không thể lấy dữ liệu.');
    }
    ?>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($data = mysqli_fetch_array($query))
                    {
                        $id = $data["id"];
                ?>
                    <tr>
                        <td><?php echo $id ?></td>
                        <td><?php echo $data["title"];?></td>
                        <td>
                            <?php echo substr($data["context"], 0, 150) . " ...";?>
                            <a class="btn-link" href="Display%20Post.php?id=<?php echo $id;?>">Xem thêm</a>
                        </td>
                        <td><?php echo $data["date"]; ?></td> 
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
</div>
</body>
</html>