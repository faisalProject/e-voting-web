<!-- <script src="../assets/js/sweetalert2@11.js"></script> -->

<?php
    // connect to databases
    $conn = mysqli_connect("localhost", "root", "", "db_evoting_web");

    function query($query) {
        global $conn;

        $result = mysqli_query($conn, $query);
        $data = [];

        while ($d = mysqli_fetch_assoc($result)) {
            $data [] = $d;
        }

        return $data;
    
    }

    function register($data) {
        global $conn;

        $username = strtolower(stripslashes($data['username']));
        $email = $data['email'];
        $password = mysqli_real_escape_string($conn, $data['password']);
        $confirmation_password = mysqli_real_escape_string($conn, $data['confirmation-password']);

        // check confirmation password
        if ( $password !== $confirmation_password ) {
            echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal', 
                            html: '<p class="."p-popup".">Konfirmasi password tidak sesuai!</p>',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    })
                </script>
            ";

            return false;
        }

        // check username already exist
        $result = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");
        if ( mysqli_fetch_assoc($result) ) {
            echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal', 
                            html: '<p class="."p-popup".">Username sudah ada sebelumnya!</p>',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    })
                </script>
            ";
            
            return false;
        }

        // password encryption
        $password = password_hash($password, PASSWORD_BCRYPT);
        $created_at = date('Y-m-d H:i:s', time());
        $updated_at = $created_at;
        // adding a new user to the database
        $query = "INSERT INTO admin VALUES(
            '',
            '$username',
            '$email',
            '$password',
            '$created_at',
            '$updated_at'
        )";

        $queryLog = "INSERT INTO log VALUES(
            '',
            'Register',
            'Account Register',
            '$email',
            '$created_at',
            '$updated_at'
        )";

        mysqli_query($conn, $query);
        mysqli_query($conn, $queryLog);

        return mysqli_affected_rows($conn);

    }

    function addStudentData($data) {
        global $conn;

        $nis = htmlspecialchars($data['nis']);
        $name = htmlspecialchars($data['name']);
        $email = htmlspecialchars($data['email']);
        $fk_id_class = $data['id_class'];
        $created_at = date('Y-m-d H:i:s', time());
        $updated_at = $created_at;

        $result = mysqli_query($conn, "SELECT * FROM student_data WHERE nis = '$nis'");
        $nisData = mysqli_fetch_assoc($result);

        if ( $nisData !== NULL ) {
            if ( $nis === $nisData['nis'] ) {
                echo "
                    <script type='text/javascript'>
                        document.addEventListener('DOMContentLoaded', () => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal', 
                                html: '<p class="."p-popup".">Nis sudah sudah terdaftar!</p>',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        })
                    </script>
                ";
    
                return false;
            }
        }

        $query = "INSERT INTO student_data VALUES (
            '',
            '$nis',
            '$name',
            '$email',
            '$fk_id_class',
            '$created_at',
            '$updated_at'
        )";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function updateStudentData($data) {
        global $conn;

        $id_data = $data['id_data'];
        $nis = $data['nis'];
        $name = $data['name'];
        $email = $data['email'];
        $fk_id_class = $data['id_class'];
        $updated_at = date('Y-m-d H:i:s', time());

        $query = "UPDATE student_data SET 
                        nis = '$nis',
                        name = '$name',
                        email = '$email',
                        fk_id_class = '$fk_id_class',
                        updated_at = '$updated_at'
                    WHERE id_data = $id_data";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function deleteStudentData($id_data) {
        global $conn;

        mysqli_query($conn, "DELETE FROM voting WHERE fk_id_data IN (SELECT id_data FROM student_data WHERE id_data = $id_data)");
        mysqli_query($conn, "DELETE FROM candidate WHERE fk_id_data IN (SELECT id_data FROM student_data WHERE id_data = $id_data)");
        mysqli_query($conn, "DELETE FROM student WHERE fk_id_data IN (SELECT id_data FROM student_data WHERE id_data = $id_data)");
        mysqli_query($conn, "DELETE FROM student_data WHERE id_data = $id_data");
        
        return mysqli_affected_rows($conn);
    }
    
    function deleteCandidate($id_candidate) {
        global $conn;

        $result = mysqli_query($conn, "SELECT id_candidate, id_student, status FROM candidate
        INNER JOIN student ON candidate.fk_id_student = student.id_student WHERE id_candidate = $id_candidate");

        $student = mysqli_fetch_assoc($result);
        $fk_id_student = $student['id_student'];

        mysqli_query($conn, "DELETE FROM voting WHERE fk_id_candidate IN  (SELECT id_candidate FROM candidate WHERE id_candidate = $id_candidate)");
        mysqli_query($conn, "DELETE FROM candidate WHERE id_candidate = $id_candidate");
        mysqli_query($conn, "UPDATE student SET status = 'siswa' WHERE id_student = $fk_id_student");

        return mysqli_affected_rows($conn);
    }

    function studentRegister($data) {
        global $conn;

        $nis = $data['nis'];
        $email = $data['email'];
        $password = mysqli_escape_string($conn, $data['password']);
        $confirmation_password = $data['confirmation-password'];
        $status = 'siswa';
        $last_login = date('Y-m-d H:i:s', time());
        $created_at = date('Y-m-d H:i:s', time());
        $updated_at = $created_at;

        $result = mysqli_query($conn, "SELECT * FROM student_data WHERE nis = '$nis'");
        $student_data = mysqli_fetch_assoc($result);

        if ( $student_data === NULL || $nis !== $student_data['nis'] ) {
            echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal', 
                            html: '<p class="."p-popup".">Nis tidak terdaftar!</p>',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    })
                </script>
            ";

            return false;
        }

        if ( $email !== $student_data['email'] ) {
            echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal', 
                            html: '<p class="."p-popup".">Email tidak terdaftar!</p>',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    })
                </script>
            ";

            return false;
        }   

        if ( $password !== $confirmation_password ) {
            echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal', 
                            html: '<p class="."p-popup".">Kondirmasi password tidak sesuai!</p>',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    })
                </script>
            ";

            return false;
        }

        $fk_id_data = $student_data['id_data'];
        $student_account_already_exists = mysqli_query($conn, "SELECT * FROM student WHERE fk_id_data = $fk_id_data");
        $student_account = mysqli_fetch_assoc($student_account_already_exists);

        if ( $student_account ) {
            echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal', 
                            html: '<p class="."p-popup".">Akun siswa sudah terdaftar!</p>',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    })
                </script>
            ";

            return false;
        }   

        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT student VALUES (
            '' ,
            '$fk_id_data',
            '$password',
            '$status',
            '$last_login',
            '$created_at',
            '$updated_at'
        )";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function imageFiles() {
        $file_name = $_FILES['picture']['name'];
        $file_size = $_FILES['picture']['size'];
        $error = $_FILES['picture']['error'];
        $tmp_name = $_FILES['picture']['tmp_name'];

        // cek apakah tidak ada gambar yang diupload
        if ( $error === 4 ) {
            echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Gagal', 
                            html: '<p class="."p-popup".">Upload gambar terlebih dahulu!</p>',
                            showConfirmButton: true,
                        })
                    })
                </script>
            ";

            return false;
        }

        // cek apakah yang diupload adalah gambar
        $valid_image_extension = ['jpg', 'jpeg', 'png'];
        $image_extension = explode('.', $file_name);
        $image_extension = strtolower(end($image_extension));

        if ( !in_array($image_extension, $valid_image_extension) ) {
            echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal', 
                            html: '<p class="."p-popup".">File yang anda upload bukan gambar!</p>',
                            showConfirmButton: true,
                            showCancelButton: false
                        })
                    })
                </script>
            ";

            return false;
        }

        // cek jika ukuran gambar terlalu besar
        if ( $file_size > 2000000) {
            echo "
                <script type='text/javascript'>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Gagal', 
                            html: '<p class="."p-popup".">Ukuran file terlalu besar!</p>',
                            showConfirmButton: true,
                            showCancelButton: false
                        })
                    })
                </script>
            ";

            return false;
        }

        $new_file_name = uniqid();
        $new_file_name .= '.';
        $new_file_name .= $image_extension;

        // lolos pengecekan gambar siap upload
        move_uploaded_file($tmp_name, '../assets/img/' . $new_file_name);

        return $new_file_name;
    }

    function addCandidate($data) {
        global $conn;

        $fk_id_student = htmlspecialchars($data['id_student']);
        $result = mysqli_query($conn, "SELECT * FROM student WHERE id_student = $fk_id_student");
        $student = mysqli_fetch_assoc($result);
        $fk_id_data = $student['fk_id_data'];
        $vision = htmlspecialchars($data['vision']);
        $mission = htmlspecialchars($data['mission']);
        $picture = imageFiles();
        $created_at = date('Y-m-d H:i:s', time());
        $updated_at = $created_at;

        if ( !$picture ) {
            return false;
        }

        // echo $fk_id_student;

        $query = "INSERT INTO candidate VALUES (
            '',
            '$fk_id_student',
            '$fk_id_data',
            '$vision',
            '$mission',
            '$picture',
            '$created_at',
            '$updated_at'
        )";
        
        $queryStatus = "UPDATE student SET status = 'kandidat' WHERE id_student = $fk_id_student";

        mysqli_query($conn, $query);
        mysqli_query($conn, $queryStatus);

        return mysqli_affected_rows($conn);
    }

    function updateCandidate($data) {
        global $conn;

        $id_candidate = $data['id_candidate'];
        $vision = $data['vision'];
        $mission = $data['mission'];
        $old_picture = $data['old_picture'];
        $updated_at = date('Y-m-d H:i:s', time());

        if ( $_FILES['picture']['error'] === 4 ) {
            $picture = $old_picture;
        } else {
            $picture = imageFiles();
        }

        $query = "UPDATE candidate SET
                        vision = '$vision',
                        mission = '$mission',
                        picture = '$picture',
                        updated_at = '$updated_at'
                WHERE id_candidate = $id_candidate
        ";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function searchStudentData($keyword) {
        $query = "SELECT * from student_data WHERE
                    name LIKE '%$keyword%' OR
                    nis LIKE '%$keyword%' ORDER BY id_data DESC";
        
        return query($query);
    }

    function searchStudentAccount($keyword) {
        $query = "SELECT id_student, name, email, status FROM student
        INNER JOIN student_data ON student.fk_id_data = student_data.id_data WHERE
                    name LIKE '%$keyword%' OR
                    email LIKE '%$keyword%' ORDER BY id_student DESC";

        return query($query);
    }

?>