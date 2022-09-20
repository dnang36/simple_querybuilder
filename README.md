# Design Parttern bài thực hành 3

## Đề bài: Create simple query builder

### Thực hiện bởi: [Nguyễn Đoàn Đăng](https://github.com/dnang36)

### Download code và run code tại đường dẫn https://github.com/dnang36/simple_querybuilder

## Kiến thức nắm được:
## 1. Giới thiệu PDO - PHP Data Objects
- PHP Data Objects (PDO) là một lớp truy xuất cơ sở dữ liệu cung cấp một phương pháp thống nhất để làm việc với nhiều loại cơ sở dữ liệu khác nhau. Khi làm việc với PDO bạn sẽ không cần phải viết các câu lệnh SQL cụ thể mà chỉ sử dụng các phương thức mà PDO cung cấp, giúp tiết kiệm thời gian và làm cho việc chuyển đổi Hệ quản trị cơ sở dữ liệu trở nên dễ dàng hơn, chỉ đơn giản là thay đổi Connection String (chuỗi kết nối CSDL).
### 1.1. Kết nối cơ sở dữ liệu:
- Mỗi Hệ quản trị cơ sở dữ liệu (Database Management System- DBMS) sẽ có các phương thức kết nối khác nhau (có loại cần Username, Password, đường dẫn đới Database, Port, có loại không). Connection String của các DBMS phổ biến hầu hết đều có dạng như sau:
````
$conn = new PDO('mysql:host=localhost;dbname=pdo', $username, $password);
````
- Với mysql là tên của DBMS, localhost có ý nghĩa database được đặt trên cùng server, pdo là tên của database. $username và $password là 2 biến chứa thông tin xác thực.
- Đế ngắt kết nối khi không cần thao tác với database nữa, các bạn chỉ cần sét biến $conn về null; $conn = null;
### 1.2. Select Data - "Đọc" dữ liệu từ database
- Khi đọc dữ liệu từ database, PDO sẽ trả về dữ liệu theo cấu trúc mảng (array) hoặc đối tượng (object) thông qua phương thức fetch().
- FETCH_ASSOC: Kiểu fetch này sẽ tạo ra một mảng kết hợp lập chỉ mục theo tên column (nghĩa là các key của mảng chính là tên của column), tương tự như khi ta dùng MySQL/MySQLi Extension

## 2. Query builder
- query builder la kỹ thuật mà giúp lập trình viên xây dựng ra những câu truy vấn CSDL Quan Hệ một cách nhanh chóng và chính xác thay vì phải tự viết truy vấn.