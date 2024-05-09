<?php

class Card {
    // 用户属性
    private $id;
    private $name;
    private $desc;
    private $str1;
    private $str2;
    private $str3;
    private $str4;
    private $str5;
    private $str6;
    private $str7;
    private $str8;
    private $str9;
    private $str10;
    private $str11;
    private $str12;
    private $str13;
    private $str14;
    private $str15;
    private $str16;
    private $ot;
    private $alias;
    private $setcode;
    private $type;
    private $atk;
    private $def;
    private $level;
    private $race;
    private $attribute;
    private $category;

    // 构造函数
    public function __construct($id, $name, $desc, $ot, $alias, $setcode, $type, $atk, $def, $level, $race, $attribute, $category) {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
        $this->ot = $ot;
        $this->alias = $alias;
        $this->setcode = $setcode;
        $this->type = $type;
        $this->atk = $atk;
        $this->def = $def;
        $this->level = $level;
        $this->race = $race;
        $this->attribute = $attribute;
        $this->category = $category;
    }

    // Getter 方法
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getDesc() { return $this->desc; }
    public function getOt() { return $this->ot; }
    public function getAlias() { return $this->alias; }
    public function getSetcode() { return $this->setcode; }
    public function getType() { return $this->type; }
    public function getAtk() { return $this->atk; }
    public function getDef() { return $this->def; }
    public function getLevel() { return $this->level; }
    public function getRace() { return $this->race; }
    public function getAttribute() { return $this->attribute; }
    public function getCategory() { return $this->category; }

    // Setter 方法
    public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setDesc($desc) { $this->desc = $desc; }
    public function setOt($ot) { $this->ot = $ot; }
    public function setAlias($alias) { $this->alias = $alias; }
    public function setSetcode($setcode) { $this->setcode = $setcode; }
    public function setType($type) { $this->type = $type; }
    public function setAtk($atk) { $this->atk = $atk; }
    public function setDef($def) { $this->def = $def; }
    public function setLevel($level) { $this->level = $level; }
    public function setRace($race) { $this->race = $race; }
    public function setAttribute($attribute) { $this->attribute = $attribute; }
    public function setCategory($category) { $this->category = $category; }
    
    public function __toString() {
        return "Card ID: {$this->id}\n" .
               "Name: {$this->name}\n" .
               "Description: {$this->desc}\n" .
               "OT: {$this->ot}\n" .
               "Alias: {$this->alias}\n" .
               "Set Code: {$this->setcode}\n" .
               "Type: {$this->type}\n" .
               "ATK: {$this->atk}\n" .
               "DEF: {$this->def}\n" .
               "Level: {$this->level}\n" .
               "Race: {$this->race}\n" .
               "Attribute: {$this->attribute}\n" .
               "Category: {$this->category}\n";
    }
}

?>
