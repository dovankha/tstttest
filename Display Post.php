<?php $connect = mysqli_connect('localhost', 'root', '', 'blog') or die ('Can not connect database.');
mysqli_set_charset($connect,"utf8");
    //$id = -1;
    if (isset($_GET["id"]))
    {
        $id = intval($_GET['id']);
    }
    $query = "SELECT * FROM posts WHERE id = '$id'";
    $sql = mysqli_query($connect, $query);
?>
    <div class="innertube">
        <?php
            while ($data = mysqli_fetch_array($sql)) {
        ?>
        <h2><?php echo $data["title"];?></h2>
    </div>
    <i> Ngày tạo: <?php echo $data["date"]; ?></i>
    <p><?php echo $data["context"]; ?></p>
    <?php } ?>