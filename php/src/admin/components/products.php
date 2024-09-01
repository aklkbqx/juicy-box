<div class="d-flex align-items-center justify-content-between flex-column flex-sm-row gap-2">
    <h1 class="d-flex align-items-center" style="gap:10px"><i class="fa-solid fa-cart-shopping"></i> รายการสินค้าทั้งหมด</h1>
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary fs-4 rounded-4" type="button" data-bs-toggle="modal" data-bs-target="#add_product"><i class="fa-solid fa-plus"></i> เพิ่มรายการสินค้า</button>
    </div>
</div>
<div class="modal fade" id="add_product">
    <div class="modal-dialog modal-dialog-centered">
        <form action="../api/manage_products.php?add" method="POST" enctype="multipart/form-data" class="modal-content m-0 rounded-4">
            <div class="modal-header">
                <h3 class="modal-title d-flex align-items-center" style="gap:10px"><i class="fa-solid fa-plus"></i> เพิ่มรายการสินค้า</h3>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column">
                    <div class="position-relative" style="max-width: 558px;">
                        <div class="d-flex justify-content-center">
                            <img id="product_image_preview" src="../assets/images/product_images/image_placeholder.jpg" class="border rounded-4 object-fit-cover" style="width:300px;height:300px;">
                        </div>
                        <div class="d-flex align-items-center mt-3 z-1 bg-white rounded-5 p-2 justify-content-end" style="gap:5px;">
                            <label for="product_image" class="btn btn-primary rounded-4"><i class="fa-solid fa-image"></i> เปลี่ยนรูปภาพ</label>
                            <button id="trash-can" type="button" class="btn btn-danger d-none rounded-4" onclick="document.getElementById('product_image_preview').src = '../assets/images/product_images/image_placeholder.jpg';document.getElementById('product_image').value=''; this.classList.add('d-none')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="form-floating">
                            <input type="text" class="form-control rounded-4" name="name" id="ชื่อสินค้า" placeholder="ชื่อสินค้า" required>
                            <label for="ชื่อสินค้า">ชื่อสินค้า</label>
                        </div>
                        <div class="form-floating mt-4">
                            <textarea class="form-control rounded-4" placeholder="คำอธิบาย" name="detail" id="คำอธิบาย" style="min-height: 100px;max-height:280px;"></textarea>
                            <label for="คำอธิบาย">คำอธิบาย</label>
                        </div>
                        <div class="form-floating mt-4">
                            <input type="number" class="form-control rounded-4" name="price" id="ราคาสินค้า" placeholder="ราคาสินค้า (บาท)" required>
                            <label for="ราคาสินค้า">ราคาสินค้า (บาท)</label>
                        </div>
                    </div>
                </div>
                <input name="productImage" id="product_image" type="file" onchange="document.getElementById('product_image_preview').src = window.URL.createObjectURL(this.files[0]);document.getElementById('trash-can').classList.remove('d-none')" hidden>
            </div>
            <div class="modal-footer">
                <div class="d-flex align-items-center flex-row w-100" style="gap: 10px;">
                    <button type="button" class="btn btn-secondary w-100 rounded-4" data-bs-dismiss="modal">ปิด</button>
                    <button type="submit" name="add_product" class="btn btn-primary w-100 rounded-4">เพิ่มสินค้า</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="mt-4 p-2 overflow-y-auto overflow-x-hidden" style="height: calc(100% - 15%);">

    <?php $product_data = sql("SELECT `product_id`,`name`,`detail`,`price`,`product_image` FROM `products`");
    if ($product_data->rowCount() > 0) { ?>
        <div class="row">
            <?php while ($data = $product_data->fetch()) { ?>
                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-12 mb-5">
                    <div style="color:var(--bs-primary);text-decoration: none;">
                        <div class="card-item-order">
                            <img src="<?= pathImage($data["product_image"], "product_images"); ?>" alt="product image" />
                            <div class="p-3 d-flex flex-column justify-content-between" style="height: 125px;">
                                <div>
                                    <h5 data-product-name="<?= $data["product_id"] ?>" class="titleCardItemOrder"><?= $data["name"]; ?></h5>
                                </div>
                                <div class="position-absolute z-2 bg-white rounded-4 end-0 m-2 p-2 border" style="bottom: 100px;">
                                    <h5>฿ <?php echo formatNumberWithComma($data["price"]); ?>.-</h5>
                                </div>
                                <div class="d-flex align-items-center mt-2" style="gap:10px">
                                    <button class="btn btn-warning w-100 rounded-4" data-bs-toggle="modal" data-bs-target="#edit_product<?= $data["product_id"] ?>">
                                        <i class="fa-solid fa-pen-to-square"></i> แก้ไข
                                    </button>
                                    <button class="btn btn-danger w-100 rounded-4" data-bs-toggle="modal" data-bs-target="#delete_product<?= $data["product_id"] ?>">
                                        <i class="fa-solid fa-trash-can"></i> ลบ
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="edit_product<?= $data["product_id"] ?>">
                    <div class="modal-dialog modal-dialog-centered">
                        <form action="../api/manage_products.php?edit&product_id=<?= $data["product_id"] ?>" method="POST" enctype="multipart/form-data" class="modal-content m-0 rounded-4">
                            <div class="modal-header">
                                <h3 class="modal-title d-flex align-items-center" style="gap:10px"><i class="fa-solid fa-pen-to-square"></i> แก้ไขสินค้า</h3>
                                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex flex-column">
                                    <div class="position-relative" style="max-width: 558px;">
                                        <div class="d-flex justify-content-center">
                                            <img id="product_image_preview<?= $data['product_id'] ?>" src="<?= pathImage($data["product_image"], "product_images"); ?>" class="border rounded-4 object-fit-cover" style="width:300px;height:300px;">
                                        </div>
                                        <div class="d-flex align-items-center mt-3 z-1 rounded-5 p-2 justify-content-end" style="gap:5px;">
                                            <label for="product_image<?= $data["product_id"] ?>" class="btn btn-primary rounded-4"><i class="fa-solid fa-image"></i> เปลี่ยนรูปภาพ</label>
                                            <button id="trash-can<?= $data['product_id'] ?>" type="button" class="btn btn-danger d-none rounded-4" onclick="document.getElementById('product_image_preview<?= $data['product_id'] ?>').src = '<?= pathImage($data['product_image'], 'product_images'); ?>';document.getElementById('product_image<?= $data['product_id'] ?>').value=''; this.classList.add('d-none')">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control rounded-4" name="name" id="ชื่อสินค้า" placeholder="ชื่อสินค้า" required value="<?= $data["name"] ?>">
                                            <label for="ชื่อสินค้า">ชื่อสินค้า</label>
                                        </div>
                                        <div class="form-floating mt-4">
                                            <textarea class="form-control rounded-4" placeholder="คำอธิบาย" name="detail" id="คำอธิบาย" style="min-height: 100px;max-height:280px;"><?= $data["detail"] ?></textarea>
                                            <label for="คำอธิบาย">คำอธิบาย</label>
                                        </div>
                                        <div class="form-floating mt-4">
                                            <input type="number" class="form-control rounded-4" name="price" id="ราคาสินค้า" placeholder="ราคาสินค้า (บาท)" required value="<?= $data["price"] ?>">
                                            <label for="ราคาสินค้า">ราคาสินค้า (บาท)</label>
                                        </div>
                                    </div>
                                </div>
                                <input name="productImage" id="product_image<?= $data["product_id"] ?>" type="file" onchange="document.getElementById('product_image_preview<?= $data['product_id'] ?>').src = window.URL.createObjectURL(this.files[0]);document.getElementById('trash-can<?= $data['product_id'] ?>').classList.remove('d-none')" hidden>
                            </div>
                            <div class="modal-footer">
                                <div class="d-flex align-items-center flex-row w-100" style="gap: 10px;">
                                    <button type="button" class="btn btn-secondary w-100 rounded-4" data-bs-dismiss="modal">ปิด</button>
                                    <button type="submit" name="edit_product" class="btn btn-primary w-100 rounded-4">บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal fade" id="delete_product<?= $data["product_id"] ?>">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <form action="../api/manage_products.php?delete&product_id=<?= $data["product_id"] ?>" method="POST" class="modal-content m-0 rounded-4">
                            <div class="modal-header">
                                <h3 class="modal-title d-flex align-items-center" style="gap:10px"><i class="fa-solid fa-trash"></i> ลบสินค้า</h3>
                                <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex flex-column align-items-center">
                                    <h4 class="text-center mb-3">คุณแน่ใจที่จะทำการลบใช่หรือไม่?</h4>
                                    <div class="position-relative">
                                        <img src="<?= pathImage($data["product_image"], "product_images"); ?>" width="200px" height="200px" class="border rounded-4 object-fit-cover">
                                        <div class="position-absolute z-2 bg-white rounded-4 p-1 border" style="bottom: -15px;right:-30px">
                                            <h5 class="text-danger">฿ <?php echo formatNumberWithComma($data["price"]); ?>.-</h5>
                                        </div>
                                    </div>
                                    <h6 class="mt-3 fs-5 text-center"><?= $data["name"] ?></h6>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="d-flex align-items-center flex-row w-100" style="gap: 10px;">
                                    <button type="reset" class="btn btn-secondary w-100 rounded-4" data-bs-dismiss="modal">ปิด</button>
                                    <button type="submit" name="delete_product" class="btn btn-danger w-100 rounded-4">ลบสินค้า</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="d-flex align-items-center justify-content-center h-100 w-100 p-5 pb-0" style="gap: 10px;">
            <h3 class="text-muted">คุณยังไม่ได้เพิ่มสินค้า
                <span class="text-primary text-decoration-underline pointer" data-bs-toggle="modal" data-bs-target="#add_product">เพิ่มสินค้าเลย</span>
            </h3>
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
    <?php } ?>
</div>