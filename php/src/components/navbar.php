<nav class="w-100 position-fixed z-2">
    <div class="container d-flex p-3 align-items-center gap-2 justify-content-between flex-wrap rounded-5" id="navbar">
        <a href="/" class="text-white text-decoration-none d-flex align-items-center gap-2">
            <img src="<?= pathImage("logo.png", "web") ?>" width="50px" height="50px" class="object-fit-cover mb-3">
            <h5>JUICY BOX</h5>
        </a>
        <?php navlink(); ?>
        <?php if (isset($_SESSION["user_login"])) {
            $countCarts = sql("SELECT COUNT(*) AS `count` FROM `carts` WHERE `user_id` = ?", [$row["user_id"]])->fetch(PDO::FETCH_ASSOC)["count"];
        ?>
            <div class="dropdown ms-auto">
                <div class="d-flex gap-2 align-items-center dropdown-toggle text-white cursor-pointer" data-bs-toggle="dropdown">
                    <img src="<?= pathImage($row["profile_image"]) ?>" width="50px" height="50px" class="rounded-circle border">
                    <div class="fs-6">
                        <?= $row["firstname"] ?> <?= $row["lastname"] ?>
                    </div>
                </div>

                <ul class="dropdown-menu rounded-4 p-2">
                    <a href="<?= linkPage("account-setting.php") ?>" class="dropdown-item p-3 rounded-4">
                        <li><i class="fa-solid fa-user-pen"></i> แก้ไขข้อมูลส่วนตัว</li>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:void(0)" class="p-0" id="logout-btn">
                        <li class="btn btn-outline-danger border-0 rounded-4 w-100 p-3"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</li>
                    </a>
                </ul>
                <script>
                    $("#logout-btn").on("click", () => {
                        Swal.fire({
                            icon: "warning",
                            title: "คุณต้องการออกจากระบบหรือไม่?",
                            showDenyButton: true,
                            showCancelButton: true,
                            showConfirmButton: false,
                            denyButtonText: `ออกจากระบบ`,
                            cancelButtonText: `ปิด`,
                            reverseButtons: true,
                            customClass: {
                                popup: 'border-radius-sweetAlert',
                                confirmButton: 'border-radius-sweetAlert',
                                cancelButton: 'border-radius-sweetAlert',
                                denyButton: 'border-radius-sweetAlert'
                            }
                        }).then((result) => {
                            if (result.isDenied) {
                                Swal.fire({
                                    icon: "success",
                                    title: "ออกจากระบบแล้ว",
                                    customClass: {
                                        popup: 'border-radius-sweetAlert',
                                        confirmButton: 'border-radius-sweetAlert',
                                        cancelButton: 'border-radius-sweetAlert',
                                        denyButton: 'border-radius-sweetAlert'
                                    }
                                }).then(() => {
                                    window.location.href = "?logout";
                                });
                            }
                        });
                    })
                </script>
            </div>
        <?php } else { ?>
            <div class="d-flex align-items-center overflow-hidden rounded-4 gap-1 ms-auto me-auto">
                <a href="<?= linkPage("register.php") ?>" class="btn btn-outline-light rounded-4 fs-6 border">สมัครสมาชิก</a>
                <a href="<?= linkPage("login.php") ?>" class="btn btn-light rounded-4 fs-6">เข้าสู่ระบบ</a>
            </div>
        <?php } ?>
    </div>
</nav>

<script>
    if (window.location.pathname.endsWith("index.php") | window.location.pathname.endsWith("/")) {
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 300) {
                $('#navbar').addClass('bg-primary');
            } else {
                $('#navbar').removeClass('bg-primary');
            }
        });
    } else {
        $('#navbar').addClass('bg-primary');
    }
</script>