<?php  $connect = mysqli_connect('localhost','root','','blog') or die('Can not connect database.');
mysqli_set_charset($connect,"utf8");
session_start(); 
if (!isset($_SESSION['username1']))
{
    echo '<script> alert("Bạn không phải admin. Vui lòng đăng nhập để thêm bài viết."); location.replace("index.php");</script>';
}?>


<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Post</title>
</head>

<body>

<?php
    $title = $titleErr = $context = "";
        if (isset($_POST["btn_submit"])) {
            if (empty($_POST["title"])) {
                $titleErr = "Title is required";}
            else {
                $title = $_POST["title"];
            }
            if (empty($_POST["context"])) {
                $context = "";
            }
            else {
                $context = $_POST["context"];
            }
            $date = date("Y/m/d");
            $sql = "insert into posts(title,context,date) values ('$title','$context','$date')";
            if (mysqli_query($connect, $sql) && empty($errors) == true) {
                echo '<script> alert("Đăng bài viết thành công!"); location.replace("index.php");</script>';
            } else {
                echo '<script> alert("Có lỗi trong quá trình xử lý"); location.replace("index.php");</script>';
            }
        }
    /*function test_input ($data) {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }*/
?>
    <form action="Add%20Post.php" method="post">
        <table>
            <tr>
                <td colspan="2"><h2 style="color: blue">Thêm bài viết mới</h2></td>
            </tr>
            <tr>
                <td nowrap="nowrap">Tiêu đề bài viết :</td>
                <td><label for="title"></label><input type="text" id="title" name="title"><span class="error"> * <?php echo $titleErr;?></span></td>
            </tr>
            <tr>
                <td nowrap="nowrap">Nội dung :</td>
                <td><label>
                        <textarea name="context" rows="10" cols="100"></textarea>
                    </label></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center"><input type="submit" name="btn_submit" value="Thêm bài viết"></td>
            </tr>
        </table>
    </form>

</body>
</html>