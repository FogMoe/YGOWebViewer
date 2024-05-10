<?php
include 'protectedFolder/View.php'; 

$view = new View();
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$pageSize = 10; // 每页显示10条记录
$cardId = isset($_GET['cardId']) ? $_GET['cardId'] : null;

$cards = $view->getCardsPageViewByIdOrName($cardId, $cardId, $page, $pageSize);
$totalCards = $view->getTotalCardCount();
$totalPages = ceil($totalCards / $pageSize);
$nextPageGet = $_GET;
$nextPageGet['page'] = $page + 1;  // 设置为当前页码加一
$nextPageUrl = http_build_query($nextPageGet);
$previousPageGet = $_GET;
$previousPageGet['page'] = $page - 1;  // 设置为当前页码-一
$previousPageUrl = http_build_query($previousPageGet);
/*
if ($cardId) {
    $cards = $view->getCardViewById($cardId);
    $totalCards = count($cards);
    $totalPages = 1; // 只有一页，因为是单个卡片的结果
} else {
    $cards = $view->getCardsViewByPage($page, $pageSize);
    $totalCards = $view->getTotalCardCount();
    $totalPages = ceil($totalCards / $pageSize);
}
*/
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOGMOE YGO Card List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }
        a {
            color: #007BFF;
            text-decoration: none;
            padding: 8px 16px;
            border: 1px solid #ccc;
            background-color: #f8f8f8;
            border-radius: 5px;
            margin: 0 5px;
        }
        a:hover {
            background-color: #e9e9e9;
        }
        form {
            margin-top: 20px;
        }
        label {
            margin-right: 10px;
        }
        input[type="text"], button {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        h1, h2 {
            color: #333;
        }
        footer {
            width: 100%;
            padding: 20px 0;
            background-color: #f2f2f2;
            text-align: center;
            box-shadow: 0 -1px 3px rgba(0, 0, 0, 0.1);
        }
        
        footer a {
            color: #333;
            text-decoration: none;
            font-size: 14px;
        }
        
        footer a:hover {
            text-decoration: underline;
        }
        
        footer p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }

    </style>
</head>
<body>
    <h1>FOGMOE YGO Card List</h1>
    <h2><a href="https://ygo.fog.moe/">点此返回FOGMOEYGO首页</a></h2>
        <h1>查询卡片信息</h1>
    <form method="GET">
        <label for="cardId">卡片 身份证/名:</label>
        <input type="text" id="cardId" name="cardId">
        <button type="submit">查询</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>卡图</th>
                <th>身份证</th>
                <th>名字</th>
                <th>描述</th>
                <th>字段</th>
                <th>类型</th>
                <th>ATK</th>
                <th>DEF</th>
                <th>等级/连接值</th>
                <th>种族</th>
                <th>属性</th>
            </tr>
        </thead>
        <tbody>
                        <?php foreach ($cards as $card): ?>
            <tr>
                <td><img src="https://file1.fogmoe.top/YGODiy/pics/<?= htmlspecialchars($card['id']) ?>.jpg" alt="Smiley face" width="42" height="42"/></td>
                <td><?= htmlspecialchars($card['id']) ?></td>
                <td><?= htmlspecialchars($card['name']) ?></td>
                <td><?= htmlspecialchars($card['desc']) ?></td>
                <td><?= htmlspecialchars($card['setcode']) ?></td>
                <td><?= htmlspecialchars($card['type']) ?></td>
                <td><?= htmlspecialchars($card['atk']) ?></td>
                <td><?= htmlspecialchars($card['def']) ?></td>
                <td><?= htmlspecialchars($card['level']) ?></td>
                <td><?= htmlspecialchars($card['race']) ?></td>
                <td><?= htmlspecialchars($card['attribute']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?<?=htmlspecialchars($previousPageUrl)?>">Previous</a>
        <?php endif; ?>
        <?php if ($page < $totalPages&&count($cards)>=10): ?>
            <a href="?<?=htmlspecialchars($nextPageUrl)?>">Next</a>
        <?php endif; ?>
    </div>
    <p>总共<?= $totalCards ?> 条数据，当前第 <?= $page ?> 页</p>
    <br><br>

    <footer>
        <a href="https://beian.miit.gov.cn/" target="_blank">鲁ICP备2022009156号-1</a>
        <br><br>
        <a href="https://fog.moe/" target="_blank">&copy; 2024 FOGMOE</a>
        <a href="https://fog.moe/" target="_blank">&copy; 兔子猫世界第一可爱！！！！！</a>
    </footer>
</body>
</html>
