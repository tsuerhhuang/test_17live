# test_17live
測試題

1.假定有 posts 與 comments 兩張 table。
posts 有 title, content 兩個欄位，comments 有 messages 欄位。
請以 laravel 設計並實作新增 comment 與 post 的 api ，並將 comments 與 posts 相關聯。缺少的欄位可自行補足，實作能以 github 等方式提供。

2.PHP 當中的 interface 和 abstract ，分別適合於什麼時機使用。請描述對於這兩個保留字的看法。
使用時機：
interface -> 如今天需要設定新增刪除修改的規則，可以針對 create / update / delete 我們可以設計規範


interface test
{

    public function create(array $array, $user_id);

    public function update($id, array $array);

    public function delete($id);

}

針對這三個function 使用的設定定義

abstract class -> 如果有固定需要取得的資訊，ex.tableName / 預設使用Query ... 等固定抓取的方式，可以使用此方式做預設處理

abstract class test
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

看法：
interface -> 使用場所常使用在定義規範 class 內的function規格，用來製作及定義必要的共通使用的class內容
abstract class -> 使用的方式會使用繼承的方式，可以定義指定抽象的設定，給繼承的class做運用

3.Laravel 當中的 middleware 能夠在進入 controller 和離開 controller 後提供額外的操作，參考 官方文件 。若換成自己設計類似的 middleware ，請描述一下會如何設計以及設計的做法。
在此提供兩種做法

1.製作在controller 內的__construct

public function __construct()
{
    $this->middleware('auth');
    $this->middleware('web');
}

2.製作在route內處理

// 先經過middleware才經過controller
Route::middleware('auth')->get('test', function () {});

// 先經過controller才經過middleware
Route::get('test', function () {})->middleware('auth');

1/2 middleware 的說明

namespace App\Http\Middleware;

use Closure;

class TestMiddleware
{
    public function handle($request, Closure $next)
    {
        echo 'before';
        $response = $next($request); // 處理request
        echo 'after';
        return $response;
    }
}
