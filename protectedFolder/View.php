<?php
include 'Controller.php'; // 确保包含了修改后的Controller类
class View{

    private $controller;

    // 构造函数，用于初始化数据库连接
    public function __construct() {$this->controller = new Controller();}

    //转换成可读性更好的数据
    public function toView($cards){
        foreach ($cards as &$card): 
            if($card['atk']===-2):$card['atk']='?';endif;
            if($card['def']===-2):$card['def']='?';endif;

            //如果怪兽星大于99意味着要变成十六进制后取最后2位
            if($card['level']>99):
                $card['level']=(int)dechex($card['level'])%100;
            endif;

            //类型
            $types = [
                0x1       => '怪兽卡',
                0x2       => '魔法卡',
                0x4       => '陷阱卡',
                0x10      => '通常怪兽',
                0x20      => '效果',
                0x40      => '融合',
                0x80      => '仪式',
                0x100     => '陷阱怪兽',
                0x200     => '灵魂',
                0x400     => '同盟',
                0x800     => '二重',
                0x1000    => '调整',
                0x2000    => '同调',
                0x4000    => '衍生物',
                0x10000   => '速攻',
                0x20000   => '永续',
                0x40000   => '装备',
                0x80000   => '场地',
                0x100000  => '反击',
                0x200000  => '翻转',
                0x400000  => '卡通',
                0x800000  => '超量',
                0x1000000 => '灵摆',
                0x2000000 => '特殊召唤',
                0x4000000 => '连接',
            ];
            $result = [];
            foreach ($types as $bit => $name) {
                if (($card['type'] & $bit) == $bit) {
                    $result[] = $name;
                }
            }
            $card['type']=implode(", ", $result);


            //种族
            $race = [
                0x1        => '战士',
                0x2        => '魔法师',
                0x4        => '天使',
                0x8        => '恶魔',
                0x10       => '不死',
                0x20       => '机械',
                0x40       => '水',
                0x80       => '炎',
                0x100      => '岩石',
                0x200      => '鸟兽',
                0x400      => '植物',
                0x800      => '昆虫',
                0x1000     => '雷',
                0x2000     => '龙',
                0x4000     => '兽',
                0x8000     => '兽战士',
                0x10000    => '恐龙',
                0x20000    => '鱼',
                0x40000    => '海龙',
                0x80000    => '爬虫类',
                0x100000   => '念动力',
                0x200000   => '幻神兽',
                0x400000   => '创造神',
                0x800000   => '幻龙',
                0x1000000  => '电子界',
                0x2000000  => '幻想魔',
            ];
            $result = [];
            foreach ($race as $bit => $name) {
                if (($card['race'] & $bit) == $bit) {
                    $result[] = $name;
                }
            }
            $card['race']=implode(", ", $result);


            //属性attribute
            $attribute = [
                0x01 => '地',
                0x02 => '水',
                0x04 => '炎',
                0x08 => '风',
                0x10 => '光',
                0x20 => '暗',
                0x40 => '神'
            ];
            $result = [];
            foreach ($attribute as $bit => $name) {
                if (($card['attribute'] & $bit) == $bit) {
                    $result[] = $name;
                }
            }
            $card['attribute']=implode(", ", $result);



        endforeach;
        unset($card);

        return $cards;
    }

    //根据id获取卡牌
    public function getCardViewById($id) {return $this->toView($this->controller->getCardById($id));}

    //根据name获取卡牌
    public function getCardViewByName($name) {return $this->toView($this->controller->getCardByName($name));}
    
    //获取某页卡
    public function getCardsViewByPage($page, $pageSize) {return $this->toView($this->controller->getCardsByPage($page, $pageSize));}

    public function getCardsPageViewByIdOrName($id = null, $name = null, $page = 1, $pageSize = 10){
        return $this->toView($this->controller->getCardsPageByIdOrName($id, $name, $page, $pageSize));
    }

    // 获取卡片总数的方法
    public function getTotalCardCount() {return $this->controller->getTotalCardCount();}



}
$v=new View();

/*foreach ($v->getCardsPageViewByIdOrName($id = '龙', $name = '龙', $page = 1, $pageSize = 10) as $c) {
    echo $c['name'];
}*/
?>

