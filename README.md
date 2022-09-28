# Design Parttern bài thực hành 3

## Đề bài: Create simple query builder

### Thực hiện bởi: [Nguyễn Đoàn Đăng](https://github.com/dnang36)

### Download code và run code tại đường dẫn https://github.com/dnang36/simple_querybuilder

## Install

```php
composer require ngdang/simple_querybuilder
```

## Sử dụng:
- use composer autoloader
- thay đổi thông tin dbname,password trong $config
````php
require 'vendor/autoload.php';
$config = [
    'host' => 'localhost',
    'dbname' => 'pdotest',
    'charset' => 'utf8',
    'username' => 'root',
    'password' => '12345678',
];
````
- init querybuider with config::connect($config)
```php
$query = new QueryBuilder(config::connect($config));
```
- use query buider
```php
// Lấy tất cả dữ liệu từ bảng user
$result = $query->select('user')->all();
// lấy user có id > 3 giới hạn là 3 user
$result = $query->select('user')
    ->where([['id','>',3]])
    ->limit(3)
    ->all();
print_r($result);
//thêm user mới:
$query->insert('user',[
    ['name','address'],
    ["hung","thai binh"]
])->go();

//sửa user có id = 4
$query->update('user',[
    'name'=>'vnp',
    'address'=>'102 thái thinh'
    ])->where([['id','=',4]])
    ->go();
    
//xoá user id = 18;
$query->delete('user')
    ->where([['id','=',18]])
    ->go();
```

-result 
````php
Array
(
    [0] => Array
        (
            [id] => 1
            [name] => dang
            [address] => ha noi
        )
)
````

- use with PDO
````php
$user = ngdang\dto\test\user::query(clone $query)->select()->all();
print_r($user);
````
- result with PDO
````php
[0] => ngdang\dto\test\user Object
      (
         [attributes:protected] => Array
            (
               [id] => 1
               name] => dang
               [address] => ha noi
            )

               [original:protected] => Array
               (
               )

            [casts:protected] => Array
                (
                )

                [table:protected] => user
      )
````

## Kiến thức nắm được:
## 1. Giới thiệu PDO - PHP Data Objects
- PHP Data Objects (PDO) là một lớp truy xuất cơ sở dữ liệu cung cấp một phương pháp thống nhất để làm việc với nhiều loại cơ sở dữ liệu khác nhau. Khi làm việc với PDO bạn sẽ không cần phải viết các câu lệnh SQL cụ thể mà chỉ sử dụng các phương thức mà PDO cung cấp, giúp tiết kiệm thời gian và làm cho việc chuyển đổi Hệ quản trị cơ sở dữ liệu trở nên dễ dàng hơn, chỉ đơn giản là thay đổi Connection String (chuỗi kết nối CSDL).
### 1.1. Kết nối cơ sở dữ liệu:
- Mỗi Hệ quản trị cơ sở dữ liệu (Database Management System- DBMS) sẽ có các phương thức kết nối khác nhau (có loại cần Username, Password, đường dẫn đới Database, Port, có loại không). Connection String của các DBMS phổ biến hầu hết đều có dạng như sau:
````php
$conn = new PDO('mysql:host=localhost;dbname=pdo', $username, $password);
````
- Với mysql là tên của DBMS, localhost có ý nghĩa database được đặt trên cùng server, pdo là tên của database. $username và $password là 2 biến chứa thông tin xác thực.
- Đế ngắt kết nối khi không cần thao tác với database nữa, các bạn chỉ cần sét biến $conn về null; $conn = null;
### 1.2. Select Data - "Đọc" dữ liệu từ database
- Khi đọc dữ liệu từ database, PDO sẽ trả về dữ liệu theo cấu trúc mảng (array) hoặc đối tượng (object) thông qua phương thức fetch().
- FETCH_ASSOC: Kiểu fetch này sẽ tạo ra một mảng kết hợp lập chỉ mục theo tên column (nghĩa là các key của mảng chính là tên của column), tương tự như khi ta dùng MySQL/MySQLi Extension

## 2. Query builder
- query builder la kỹ thuật mà giúp lập trình viên xây dựng ra những câu truy vấn CSDL Quan Hệ một cách nhanh chóng và chính xác thay vì phải tự viết truy vấn.