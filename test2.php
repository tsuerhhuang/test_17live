<?php

// 2.PHP 當中的 interface 和 abstract ，分別適合於什麼時機使用。請描述對於這兩個保留字的看法。
// 使用時機：
// interface -> 如今天需要設定新增刪除修改的規則，可以針對 create / update / delete 我們可以設計規範

interface test_interface
{
    public function create(array $array, $user_id);

    public function update($id, array $array);

    public function delete($id);
}

// 針對這三個function 使用的設定定義

// abstract class -> 如果有固定需要取得的資訊，ex.tableName / 預設使用Query ... 等固定抓取的方式，可以使用此方式做預設處理

abstract class test_abstract_class
{
    public function __construct($name = null)
    {
        $this->setName($name);
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    abstract public function query();

    /**
     * Get table name
     *
     * @param string $builder
     * @return string
     */
    public function getTableName($builder)
    {
        $table = '';
        if ($builder instanceof Model) {
            $column = $builder->getTable();
        } elseif ($builder instanceof Builder) {
            $table = $builder->from;
        } else {
            $table = $builder->getModel()->getTable();
        }

        return $table;
    }
}

// 看法：
// interface -> 使用場所常使用在定義規範 class 內的function規格，用來製作及定義必要的共通使用的class內容
// abstract class -> 使用的方式會使用繼承的方式，可以定義指定抽象的設定，給繼承的class做運用
