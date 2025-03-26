<?php
error_reporting(0);
session_start();
include "connect_db.php";

//Dòng này kiểm tra xem các trường biểu mẫu user, phone, email, address, password, và password_confirmation có được gửi hay không. Nếu có, tiếp tục xử lý dữ liệu.
if (isset($_POST['user'], $_POST['phone'], $_POST['email'], $_POST['address'], $_POST['password'], $_POST['password_confirmation'])) {
        $username = validate($_POST['user']);
        $phone = validate($_POST['phone']);                               //Hàm validate dùng để xử lý dữ liệu đầu vào, loại bỏ các khoảng trắng không cần thiết,
        $email = validate($_POST['email']);                               //bỏ các ký tự gạch chéo ngược và chuyển đổi các ký tự đặc biệt thành thực thể HTML để tránh các lỗ hổng bảo mật như XSS.
        $address = validate($_POST['address']);
        $password = validate($_POST['password']);
        $password_confirmation = validate($_POST['password_confirmation']); 

        // Save user input to session
        $_SESSION['user'] = $username;
        $_SESSION['phone'] = $phone;
        $_SESSION['email'] = $email;
        $_SESSION['address'] = $address;

        // Check if password and confirmation match
        if ($password !== $password_confirmation) {
            header("Location: Sign_up.php?error=Mật khẩu xác nhận không khớp!");
            exit();
        }

        // Check password strength
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            header("Location: Sign_up.php?error=Mật khẩu phải dài ít nhất 8 ký tự và bao gồm ít nhất một chữ hoa, một chữ thường và một số.");
            exit();
        }

        // Check if the username already exists
        $check_username_query = "SELECT * FROM ThanhVien WHERE TenTaiKhoan = ?";
        $stmt = $conn->prepare($check_username_query);  //Hàm prepare tạo ra một đối tượng stmt (statement) từ kết nối cơ sở dữ liệu $conn.
        $stmt->bind_param("s", $username); //bind_param liên kết một biến PHP với một tham số của câu lệnh SQL
        $stmt->execute();   // thực thi câu lệnh SQL đã chuẩn bị với giá trị được gán. Nó gửi câu lệnh đến cơ sở dữ liệu và thực hiện truy vấn.
        $result_username = $stmt->get_result();  //Sau khi câu lệnh SQL được thực thi, get_result thu thập kết quả truy vấn. Kết quả này là một đối tượng chứa tất cả các hàng được trả về từ truy vấn.

        if ($result_username->num_rows > 0) {    // kiểm tra số hàng trả về từ truy vấn bằng cách sử dụng thuộc tính num_rows của đối tượng kết quả.
            header("Location: Sign_up.php?error=Đã tồn tại Tên Tài Khoản này!");
            exit();
        }

        // Check if the email already exists
        $check_email_query = "SELECT * FROM ThanhVien WHERE Email = ?";
        $stmt = $conn->prepare($check_email_query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result_email = $stmt->get_result();

        if ($result_email->num_rows > 0) {
            header("Location: Sign_up.php?error=Đã tồn tại Email này!");
            exit();
        }


        // Hash the password
        //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
        // $hashed_password = md5($password);
        $hash = password_hash($password, PASSWORD_BCRYPT);
        // Insert the user into the database
        $insert_query = "INSERT INTO ThanhVien(TenTaiKhoan, SDT, Email, DiaChi, MatKhau) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sssss", $username, $phone, $email, $address, $hash);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {   //kiểm tra nếu có ít nhất một hàng trong cơ sở dữ liệu đã được thay đổi (thêm mới, cập nhật hoặc xóa), tức là câu lệnh SQL đã được thực thi thành công.
            header("Location: Sign_up.php?success=Tài Khoản của bạn được tạo thành công!");
            exit();
        } else {
            header("Location: Sign_up.php?error=Không tạo được tài khoản!");
            exit();
        }
    } else {
        header("Location: Sign_up.php?error=Không tạo được tài khoản!");
        exit();
    }

    function validate($data)
    {
        $data = trim($data);   //Hàm trim() loại bỏ các khoảng trắng (hoặc các ký tự được chỉ định) từ đầu và cuối của chuỗi.
        $data = stripslashes($data);  //Hàm stripslashes() loại bỏ các ký tự gạch chéo ngược (\) từ chuỗi.
        $data = htmlspecialchars($data);  //Hàm stripslashes() loại bỏ các ký tự gạch chéo ngược (\) từ chuỗi.
        return $data;
    }
?>
