# Coding convention for Laravel

## Oveview

Mục đích của tài liệu này là dựng nên một style chuẩn để làm các dự án sử dụng Laravel ở Detomo.

Hiện nay mình mới đang bắt đầu tìm hiểu về Laravel :) cho nên chưa có được kinh nghiệm và tài liệu.
Trước hết mọi người tham khảo các tài liệu sau
* Laravel best practice [bản tiếng Việt](https://chungnguyen.xyz/posts/code-laravel-lam-sao-cho-chuan), [bản tiếng Anh](https://github.com/alexeymezenin/laravel-best-practices).

## Cơ bản

Tham khảo về coding convention cơ bản ở đây
* [Coding convention đối với một project PHP](https://viblo.asia/p/coding-convention-doi-voi-mot-project-php-ORNZqNPrl0n)
* [Coding Conventions và các chuẩn viết code trong PHP](https://viblo.asia/p/coding-conventions-va-cac-chuan-viet-code-trong-php-naQZRbrGZvx)

## MVC

* Không viết xử lý logic trong controller class. Controller chỉ làm 3 việc
  1. Nhận request parameter (lưu vào biến, model...)
  2. Gọi các service/helper/model class để xử lý logic.
  3. Gọi lệnh render file view (với tham số các model, biến ở bước trên).
  Đặc biệt tránh mô tả logic xử lý trong các private function của controller.
* Nên bao các xử lý có phát sinh ghi data trong DB vào transaction. Điều này không chỉ giúp rollback lại khi có error, mà còn tăng tốc độ khi một request gọi nhiều SQL query.
  Sample (TBD)
* Model chủ yếu dùng để lưu data theo một đối tượng được định nghĩa.
  Các xử lý có đối tượng là một model nên được viết trong class của model đó, không nên viết ở class bên ngoài.
  Sample (TBD)


## Action

* Sau mỗi POST action, cần phải redirect nếu xử lý thành công (để tránh user ấn F5).

## Space

* Không viết thừa space. Ví dụ không để 2 space liền nhau, như `if (a  == b)`.
* Setup editor để xóa hết trailing space when saving.

## Function

Không được viết function có số dòng quá dài. Mỗi function chỉ nên dưới 30 dòng.
Function dài thì không thể hiện được logic (chính) mà function thực hiện.
Function viết các step chính cho việc nó định xử lý. Chi tiết của các step đó cho vào các function khác.

## Array

* Để dấu phẩy sau phần tử cuối cùng của array.
  ```php
  $arr = [
      'a' => 'This is a',
      'b' => 'This is b',
  ];
  ```
  Điều này sẽ giúp dễ dàng mỗi khi bổ sung phần tử mới vào array (không sợ quên dấu phẩy ở phần tử phía trước), cũng không khiến diff báo dòng phía trước có sự khác biệt.

## Naming

### Common

Tên hàm và tên biến phải đặt dễ hiểu. Kể cả đặt dài cũng được.
Ví dụ:
* Nếu có một array mapping giữa model id và model object (model là kiểu Car), thì không đặt tên là `$cars` mà nên đặt là `$mapCarId2Objects`, sao cho thể hiện rõ đặc trưng của nó. Nếu chỉ là array `$cars` bình thường, thì sẽ hiểu là key của nó không có gì đặc biệt. Nên tham khảo thêm từ quyển craftman.
* Nếu có xử lý tên là `Employee::removeEmployees()`, trong khi ta còn có data là `team`, `project` có chứa employees, thì nên ghi tên hàm là `Employee::removeEmployeeFromTeam()` hoặc `Employee::removeEmployeeFromProject()`

### Tên biến

* Tên biến PHP phải dùng theo dạng camel, không được dùng kiểu underscore.
  <details>
  <summary>Ví dụ</summary>

  ```php
  // Nên đặt tên
  private $employeeName;

  // Không đặt tên
  private $employee_name;
  ```
  </details>

## Document

* Các function cần phải có document giải thích nó làm gì.
  Có thông tin về parameter trong document, ít nhất là data type type. Trong khả năng có thể thì khai báo luôn data type trong function definition.
  <details>
  <summary>Ví dụ</summary>

  ```php
  /**
   * Copy data from another employee to this object.
   * @param Employee $employee
   * @return Employee $this object.
   */
  public function copyEmployee(Employee $source)
  {
    $this->attributes = $source->attributes;
  }
  ```
  </details>
* Có thông tin về class variable trong document, ít nhất là data type.
  Cái này sẽ có lợi cho IDE trong việc đưa ra code assistance.
  <details>
  <summary>Ví dụ</summary>

  ```php
  /**
   * Manipulate employee record in DB.
   */
  class Employee
  {
    /**
     * Name of employee.
     * @var string
     */
    private $name;
  }
  ```
  </details>
* Đôi khi, khai báo kiểu của biến trong đoạn code sẽ giúp IDE hỗ trợ (code assistance).
  <details>
  <summary>Ví dụ</summary>

  ```php
  /** @var Employee $employee */
  $employee = Employee::findOne(['id' => $id]);
  $employee->status = 1;
  ```
  </details>