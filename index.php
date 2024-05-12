<?php
include 'protectedFolder/View.php'; 

$view = new View();
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$pageSize = 10; // 每页显示10条记录
$search = isset($_GET['search']) ? $_GET['search'] : null;

$cards = $view->getCardsPageViewByIdOrName($search, $search, $page, $pageSize);
$totalCards = $view->getTotalCardCount();
$totalPages = ceil($totalCards / $pageSize);

function buildPageUrl($page) {
    $queryParams = $_GET;
    $queryParams['page'] = $page;
    return http_build_query($queryParams);
}

$nextPageUrl = buildPageUrl($page + 1);
$previousPageUrl = buildPageUrl($page - 1);
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FOGMOE YGO Card List</title>
    <link rel="stylesheet" type="text/css" href="./styles.css">
    <style>
        .cardList{text-align:center;border:2px}
        .card{padding: 8px;border-radius: 3px 3px 3px 3px;border:8px outset rgb(126, 126, 126);text-align:center;display: inline-block;margin: 5px; width: 280px; height: 530px; background-color: rgb(240, 240, 240); }
        .cardPic{text-align:center;width: 190px;object-fit: contain;}
        .cardLin1{text-align:left;border: 3px ridge rgb(163, 163, 163);padding: 5px;margin: -2px;border-radius: 3px 3px 3px 3px;}
        .cardName{font-weight:600;}
        .cardAttribute{float:right;}
        .cardLin2{text-align:left;font-size: 13px;}
        .cardTypeAndLevel{float:right;}
        .cardMiaoshu{resize:none; font-size:15px; height: 170px; width: 275px;}
        .cardLin4{height: 180px;text-align:left;border-bottom: 1px solid black;}
        .cardLin5{text-align:left;}
        .cardLin3{padding-top: 2px;padding-bottom: 2px;}
        .cardAtkAndDef{float:right;}
        .search{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1  align="center">FOGMOE YGO Card List</h1>
    <div class="search">
        <form method="GET">
            <label for="search">卡片 ID/名称:</label>
            <input type="text" id="search" name="search" value="<?= htmlspecialchars($search) ?>">
            <button type="submit">查询</button>
        </form>
    </div>


    <div class="cardList">
        <?php foreach ($cards as $card): ?>
            <div class="card">
                <div class="cardLin1">
                    <span class="cardName"><?= htmlspecialchars($card['name']) ?></span>
                    <span class="cardAttribute"><?= htmlspecialchars($card['attribute']) ?></span>
                </div>
                <div class="cardLin2">
                    <span class="cardRace"><?= htmlspecialchars($card['race']) ?></span>
                    字段:<span class="cardZiduan"><?= htmlspecialchars($card['setcode']) ?></span>
                    
                    <span class="cardTypeAndLevel">
                        <span class="cardType"><?= htmlspecialchars($card['type']) ?></span>
                        <?php if($card['level']>0): ?><span class="cardLevel"><?= htmlspecialchars($card['level']) ?>☆</span><?php endif;?>
                    </span>
                </div>
                <div class="cardLin3">
                    <img class="cardPic" src="https://mirror.ghproxy.com/https://raw.githubusercontent.com/FogMoe/YGOCustomCards/main/pics/<?= htmlspecialchars($card['id']) ?>.jpg" alt="<?= htmlspecialchars($card['name']) ?>">
                </div>
                <div class="cardLin4">
                    <textarea readonly class="cardMiaoshu"><?= htmlspecialchars($card['desc']) ?></textarea>
                </div>
                <div class="cardLin5">
                    <span class="cardId">ID:<?= htmlspecialchars($card['id']) ?></span>
                    <span class="cardAtkAndDef">ATK:<?= htmlspecialchars($card['atk']) ?>&nbsp;/&nbsp;DEF:<?= htmlspecialchars($card['def']) ?></span>
                </div>
            </div>
        <?php endforeach;?>
    </div>
    

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?<?= htmlspecialchars($previousPageUrl) ?>">上一页</a>
        <?php endif; ?>
        <?php if ($page < $totalPages && count($cards)>=10 ): ?>
            <a href="?<?= htmlspecialchars($nextPageUrl) ?>">下一页</a>
        <?php endif; ?>
    </div>
    <p align="center">总共<?= $totalCards ?> 条数据，当前第 <?= $page ?> 页</p>
    <h4  align="center"><a href="https://ygo.fog.moe/">点此返回FOGMOEYGO首页</a></h4>
    <footer>
        <a href="https://beian.miit.gov.cn/" target="_blank">鲁ICP备2022009156号-1</a>
        <br><br>
        <a href="https://fog.moe/" target="_blank">&copy; 2024 FOGMOE</a>
    </footer>
</body>
</html>