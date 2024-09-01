<?php
session_start();
require_once __DIR__ . "/lib/util.php";
$user_id = isset($_SESSION["user_login"]) ? $_SESSION["user_login"] : (isset($_SESSION["admin_login"]) ? header("location: ./admin/") : null);
if ($user_id) {
    $row = sql("SELECT * FROM `users` WHERE `user_id` = ?", [$user_id])->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $webname; ?></title>
    <?php require_once __DIR__ . "/lib/link.php"; ?>
</head>

<body style="background-color: var(--bs-primary-secondary);">
    <?php require_once __DIR__ . "/components/navbar.php"; ?>

    <div class="position-relative">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= pathImage("banner.png", "web") ?>" class="d-block w-100 image-banner" alt="banner" style="object-fit:cover;" draggable="false">
            </div>
        </div>

        <div class="w-100 w-100 h-100 position-absolute top-0 left-0" style="background: linear-gradient(45deg, #414141, transparent);"></div>

        <div class="title-banner d-flex align-items-center">
            <div>
                <div class="fw-semibold" style="font-size:50px;">
                    <?= $bannerTitle[0]; ?>
                    <div class="fw-medium">
                        <?= $bannerTitle[1]; ?>
                    </div>
                </div>
                <p class="fs-4">
                    <?= $bannerTitle[2]; ?>
                </p>
                <p class="mt-3">
                    <?= $bannerTitle[3]; ?>
                </p>
            </div>
        </div>
    </div>

    <div class="px-2" id="orderProducts">
        <div class="d-flex justify-content-center container">
            <div class="bg-primary p-5 py-4 my-3 text-center text-white rounded-5 w-100 d-flex justify-content-between flex-wrap" style="filter: opacity(0.8);">
                <img src="<?= pathImage("ICON1.svg", "web") ?>" width="100px" height="100px" style="filter: invert(1);" class="d-none d-sm-block">
                <div>
                    <h1>สั่งชาหรือกาแฟออนไลน์</h1>
                    <h1>"<?= $webname; ?>" <i class="fa-solid fa-mug-hot"></i></h1>
                </div>
                <img src="<?= pathImage("ICON2.svg", "web") ?>" width="100px" height="100px" style="filter: invert(1);" class="d-none d-sm-block">
            </div>
        </div>
    </div>

    <div class="container position-relative bg-white rounded-5 p-4 px-5">
        <div class="d-flex justify-content-sm-between justify-content-center mb-4 py-3 flex-wrap gap-4">
            <h1>เมนูชาและกาแฟ <i class="fa-solid fa-mug-saucer text-primary"></i></h1>
            <div class="d-flex align-items-center gap-2">
                <input type="search" class="form-control rounded-4" placeholder="ค้นหาเมนู" id="searchInputNavbar">
                <button type="button" class="btn btn-primary rounded-4" onclick='searchProduct($("#searchInputNavbar").val())'>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>

        <div class="d-flex justify-content-center flex-column align-items-center d-none mb-5 pb-5" id="productSearchNotFound">
            <div class="d-flex align-items-center justify-content-center h-100 w-100 p-5 pb-0" style="gap: 10px;">
                <h3 class="text-muted">ไม่พบเมนูที่คุณต้องการค้นหา</h3>
                <div class="d-flex align-items-center" style="gap:10px">
                    <div class="spinner-grow spinner-grow-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow" role="status" style="width: 1.5rem !important;height: 1.5rem !important;">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="spinner-grow spinner-grow-lg" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <img src="<?= pathImage("searchNotFoundIcon.jpg", "web"); ?>" width="300px" height="auto">
        </div>

        <div class="row">
            <?php $product_data = sql("SELECT `product_id`,`name`,`detail`,`drink_type`,`price`,`product_image` FROM `products`");
            if ($product_data->rowCount() > 0) {
                while ($product = $product_data->fetch()) { ?>
                    <div data-product-card="<?= $product["product_id"] ?>" class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-12 mb-5">
                        <a href="javascript:void(0)" style="color:var(--bs-primary);text-decoration: none;" data-bs-toggle="modal" data-bs-target="#modalProduct<?= $product["product_id"] ?>">
                            <div class="card-item-order">
                                <img src="<?= pathImage($product["product_image"], "product_images"); ?>" alt="product image" />
                                <div class="p-3 d-flex flex-column justify-content-between" style="height: 125px;">
                                    <div>
                                        <h5 data-product-name="<?= $product["product_id"] ?>" class="titleCardItemOrder"><?= $product["name"]; ?></h5>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2 align-items-center">
                                        <h5>฿ <?php echo formatNumberWithComma($product["price"]); ?>.-</h5>
                                        <button class="addToCart btn" onclick="setTimeout(()=>alert('กรุณาเลือกประเภทการชง'),500)">
                                            <i class="fa-solid fa-cart-plus"></i>
                                            <h6>หยิบใส่ตะกร้า</h6>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="modal fade" id="modalProduct<?= $product["product_id"] ?>">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content rounded-4 shadow-lg border-2" style="border-color:var(--cyan-color1)">
                                <div class="modal-body position-relative p-5">
                                    <div class="position-absolute" style="top:10px;right:10px">
                                        <button type="button" class="btn rounded-circle btn-light btn-close border-3 border p-2" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="row mt-4 pb-5">
                                        <div class="col-12 col-xl-5 d-flex justify-content-center">
                                            <img src="<?= pathImage($product["product_image"], "product_images") ?>" width="350px" height="350px" class="border object-fit-cover rounded-2">
                                        </div>
                                        <div class="col-12 col-xl-7 mt-5 mt-xl-0">
                                            <div class="d-flex flex-column gap-4">
                                                <div class="d-flex flex-column">
                                                    <h3><?= $product["name"] ?></h3>
                                                    <h6><?= $product["detail"] ?></h6>
                                                </div>
                                                <div class="bg-light p-4 rounded-4" style="width: auto;">
                                                    <h4 class="text-primary fw-semibold">ราคา​ ฿<span><?= $product["price"] ?></span></h4>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h5>ประเภทการชง:</h5>
                                                    <div class="d-flex flex-row gap-2 flex-wrap drink_type">
                                                        <?php foreach (json_decode($product["drink_type"]) as $index => $drink_type) { ?>
                                                            <div>
                                                                <input type="radio" name="drink_type<?= $product["product_id"] ?>" value="<?= $drink_type; ?>" hidden>
                                                                <button onclick="selectDrinkType($(this))" type="button" class="btn btn-outline-primary rounded-4" style="width: 100px;"><?= $drink_type; ?></button>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center gap-2 mt-5">
                                                    <h6>จำนวน</h6>
                                                    <div class="d-flex overflow-hidden border rounded-4" style="width: 110px;">
                                                        <button onclick="minusAmountItem($(this).parent().find('.amountItem'))" type="button" class="btn btn-primary border-0 rounded-0 border-0">-</button>
                                                        <input oninput="inputAmountItem($(this))" data-amountitem="<?= $i; ?>" type="number" class="form-control border-0 text-center amountItem" style="width: 50px;box-shadow: none !important;outline: none;" value="1">
                                                        <button onclick="plusAmountItem($(this).parent().find('.amountItem'))" type="button" class="btn btn-primary border-0 rounded-0 border-0" onclick="plusAmountItem(<?= $i; ?>)">+</button>
                                                    </div>
                                                    <a href="./api/manage_carts.php?addToCart&product_id=<?= $product["product_id"] ?>&amount=1&drink_type=noselected" class="btn btn-primary rounded-5 fs-5 ms-auto py-2 px-4 d-flex align-items-center gap-2 addToCart" onclick="checkAddToCart(event,$(this))">
                                                        +<i class="fa-solid fa-cart-shopping"></i>
                                                        <div class="d-none d-lg-block">เพิ่มลงตะกร้าสินค้า</div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <script>
                        $("#modalProduct<?= $product["product_id"] ?>").on('hidden.bs.modal', function() {
                            $(this).find("input[type='radio']").each((index, input) => $(input).prop("checked", false));
                            $(this).find(".active-drink-type").removeClass("active-drink-type");
                            $(this).find("a.addToCart").attr("href", "./api/manage_carts.php?addToCart&product_id=<?= $product["product_id"] ?>&amount=1&drink_type=noselected");
                        });
                    </script>
                <?php }
            } else { ?>
                <div class="d-flex align-items-center justify-content-center h-100 w-100 p-5 pb-0" style="gap: 10px;">
                    <h3>ขณะนี้ยังไม่มีข้อมูลสินค้า...</h3>
                    <div class="d-flex align-items-center" style="gap:10px">
                        <div class="spinner-grow spinner-grow-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow" role="status" style="width: 1.5rem !important;height: 1.5rem !important;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow spinner-grow-lg" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <img class="mb-5" src="<?= pathImage("empty_product.png", "web") ?>" style="width: 100%;height: 350px;object-fit: contain;" draggable="false">
            <?php } ?>
        </div>
    </div>


    <script>
        const searchProduct = (query) => {
            const product_name = $("[data-product-name]");
            const product_card = $("[data-product-card]");

            product_name.each(function(index, product) {
                const productName = $(product).text().toLowerCase();
                if (productName.includes(query.toLowerCase())) {
                    $(product_card[index]).removeClass("d-none");
                    $("#productSearchNotFound").addClass("d-none");
                } else {
                    $(product_card[index]).addClass("d-none");
                    if ($(product_card).not(".d-none").length === 0) {
                        $("#productSearchNotFound").removeClass("d-none");
                    }
                }
            });
        }
        const searchInputNavbar = $("#searchInputNavbar");
        searchInputNavbar.on("keypress", (e) => {
            if (event.key === 'Enter') {
                event.preventDefault();
                searchProduct(searchInputNavbar.val())
            }
        })

        $("input[type='radio']").on("change", function() {
            $(this).siblings("button").addClass("active-drink-type");
        })

        const selectDrinkType = (button) => {
            button.closest(".drink_type").find("button").removeClass("active-drink-type")
            const inputRadio = button.siblings("input[type='radio']");
            inputRadio.prop("checked", true).trigger("change")
            const href = button.closest(".modal-content").find("a.addToCart").attr("href");
            const newHref = href.replace(/drink_type=[^&]*/, `drink_type=${inputRadio.val()}`);
            button.closest(".modal-content").find(".addToCart").attr("href", newHref);
        }

        function minusAmountItem(input) {
            let amount = parseInt(input.val());
            if (amount > 1) {
                input.val(amount - 1);
                updateHref(input);
            }
        }

        function plusAmountItem(input) {
            let amount = parseInt(input.val());
            input.val(amount + 1);
            updateHref(input);
        }

        function inputAmountItem(input) {
            let amount = parseInt(input.val());
            if (amount >= 1) {
                updateHref(input);
            } else {
                input.val(1);
                updateHref(input);
            }
        }

        function updateHref(input) {
            const amount = parseInt(input.val());
            const href = input.closest(".modal-content").find(".addToCart").attr("href");
            const newHref = href.replace(/amount=\d+/, `amount=${amount}`);
            input.closest(".modal-content").find(".addToCart").attr("href", newHref);
        }

        const checkAddToCart = (e, element) => {
            e.preventDefault();
            const href = element.prop("href");
            const url = new URL(href);
            const drink_type = url.searchParams.get("drink_type");
            if (drink_type === "noselected") {
                Swal.fire({
                    icon: "warning",
                    title: "กรุณาเลือกชงก่อนเพิ่มลงตะกร้า!",
                    showCancelButton: true,
                    showConfirmButton: false,
                    cancelButtonText: `ปิด`,
                    customClass: {
                        popup: 'border-radius-sweetAlert',
                        confirmButton: 'border-radius-sweetAlert',
                        cancelButton: 'border-radius-sweetAlert',
                        denyButton: 'border-radius-sweetAlert'
                    }
                })
            } else {
                window.location.href = href;
            }
        }

        const checkHashProduct = () => {
            if (window.location.hash === '#orderProducts') {
                setTimeout(() => history.replaceState(null, null, window.location.pathname + window.location.search), 100)
            }
        }
        $(window).on('hashchange', function() {
            checkHashProduct();
        });
        checkHashProduct();
    </script>
    <?php require_once __DIR__ . "/components/footer.php"; ?>
</body>

</html>