<?php
$allowedExts = array("zip");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);  // 获取文件后缀名

// 检查文件类型和大小
if (($_FILES["file"]["type"] == "application/zip" || $_FILES["file"]["type"] == "application/x-zip-compressed") &&
    $_FILES["file"]["size"] < 10485760 &&  // 小于 10 MB
    in_array($extension, $allowedExts)) {

    if ($_FILES["file"]["error"] > 0) {
        echo "错误：请联系qq群管理员: " . $_FILES["file"]["error"] . "<br>";
    } else {
        // 安全地处理文件名
        $filename = basename($_FILES["file"]["name"]);
        $uploadPath = "UploadCardData/" . $filename;

        if (file_exists($uploadPath)) {
            echo htmlspecialchars($filename) . " 文件已经存在，请勿重复上传。";
        } else {
            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadPath)) {
                echo "上传完毕，请加qq群联系管理员以便可以及时审核！";
            } else {
                echo "上传失败，请稍后再试或联系管理员。";
            }
        }
    }
} else {
    echo "非法的文件格式，只能上传Zip压缩文件！";
}
?>
