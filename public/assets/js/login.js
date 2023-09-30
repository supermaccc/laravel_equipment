$(document).ready(function () {
    $('.login-info-box').fadeOut();
    $('.login-show').addClass('show-log-panel');
});


$('.login-reg-panel input[type="radio"]').on('change', function () {
    if ($('#log-login-show').is(':checked')) {
        $('.register-info-box').fadeOut();
        $('.login-info-box').fadeIn();

        $('.white-panel').addClass('right-log');
        $('.register-show').addClass('show-log-panel');
        $('.login-show').removeClass('show-log-panel');

    }
    else if ($('#log-reg-show').is(':checked')) {
        $('.register-info-box').fadeIn();
        $('.login-info-box').fadeOut();

        $('.white-panel').removeClass('right-log');

        $('.login-show').addClass('show-log-panel');
        $('.register-show').removeClass('show-log-panel');
    }
});

// Function to validate email format
function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

//login function
const equipmentIndexRoute = document.getElementById('equipmentIndexRoute').dataset.route;
const requestIndexRoute = document.getElementById('requestIndexRoute').dataset.route;
$('#login_btn').click(function (e) { 
    e.preventDefault();
    //console.log("login click");

    let name = $('#name').val();
    let password = $('#password').val();

    if (name == "" || password == "") {
        $.alert({
            title: 'ข้อมูลไม่ถูกต้อง!',
            content: 'กรุณากรอกข้อมูลให้ครบถ้วน',
            type: 'orange'
        });
    } else {
        $.ajax({
            type: "post",
            url: baseUrl + "/login",
            data: {
                name: name,
                password: password,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (res) {
                if (res.status == "success") {
                    let permision = res.permision
                    $.alert({
                        title: 'สำเร็จ!',
                        content: 'เข้าสู่ระบบสำเร็จ',
                        type: 'green',
                        onClose: function () {
                            setTimeout(function () {
                                if (permision == 'admin') {
                                    window.location.href = equipmentIndexRoute;
                                } else if (permision == 'user') {
                                    window.location.href = requestIndexRoute;
                                }
                            }, 500);
                        }
                    });
                } else if (res.status == "fail") {
                    $.alert({
                        title: 'ไม่สำเร็จ!',
                        content: 'ชื่อหรือรหัสผ่านไม่ถูกต้อง',
                        type: 'orange'
                    });
                } else {
                    $.alert({
                        title: 'ไม่สำเร็จ!',
                        content: 'เกิดข้อผิดพลาดกรุณาลองใหม่ภายหลัง',
                        type: 'red'
                    });
                }
            }
        });
    }
});

//register function
$('#register_btn').click(function (e) {
    e.preventDefault();

    let name = $('#r_name').val();
    let email = $('#r_email').val();
    let password = $('#r_password').val();
    let c_password = $('#c_password').val();

    //console.log(name+email+password+c_password);

    if (name == "" || email == "" || password == "" || c_password == "") {
        $.alert({
            title: 'ข้อมูลไม่ถูกต้อง!',
            content: 'กรุณากรอกข้อมูลให้ครบถ้วน',
            type: 'orange'
        });
    } else if (!isValidEmail(email)) {
        $.alert({
            title: 'ข้อมูลไม่ถูกต้อง!',
            content: 'รูปแบบอีเมลไม่ถูกต้อง',
            type: 'orange'
        });
    } else if (password != c_password) {
        $.alert({
            title: 'ข้อมูลไม่ถูกต้อง!',
            content: 'รหัสผ่านไม่ตรงกัน',
            type: 'orange'
        });
    } else {
        // console.log("data pass");
        $.ajax({
            type: "post",
            url: baseUrl + "/register",
            data: {
                name: name,
                email: email,
                password: password,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (res) {
                if (res.status == "success") {
                    $('#r_name').val("");
                    $('#r_email').val("");
                    $('#r_password').val("");
                    $('#c_password').val("");

                    $.alert({
                        title: 'สำเร็จ!',
                        content: 'สมัครสมาชิกสำเร็จ',
                        type: 'green',
                        onClose: function () {
                            // Introduce a delay of 0.5 seconds (500 milliseconds) before triggering the click event
                            setTimeout(function () {
                                $('#label-register').trigger("click");
                            }, 500);
                        }
                    });
                } else if (res.status == "duplicate") {
                    $.alert({
                        title: 'ไม่สำเร็จ!',
                        content: 'อีเมลนี้ถูกใช้งานแล้ว',
                        type: 'orange'
                    });
                } else {
                    $.alert({
                        title: 'ไม่สำเร็จ!',
                        content: 'เกิดข้อผิดพลาดกรุณาลองใหม่ภายหลัง',
                        type: 'red'
                    });
                }
            }
        });
    }
});