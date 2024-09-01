<footer class="mt-5 text-white">
    <div class="p-4 bg-primary">
        <div class="container d-flex align-items-sm-start justify-content-between align-items-center mb-5 flex-wrap gap-5">
            <h1 class="text-white me-2 text-nowrap">
                <?= $webname; ?>
            </h1>
            <?php navlink(); ?>
            <h1 class="text-end d-none d-sm-block">
                SOCAIL MEDIA
            </h1>
        </div>
        <div class="container d-flex mb-4 align-items-start flex-wrap">
            <div class="d-flex flex-column gap-2 fs-5">
                <div style="width: 300px;"><i class="fa-solid fa-map-pin text-white"></i> ที่อยู่: <?= $address_var; ?></div>
                <div><i class="fa-solid fa-envelope text-white"></i> อีเมล: <?= $email_var; ?></div>
            </div>
            <div class="flex-grow-1 justify-content-center d-flex mt-2 mb-5 mb-sm-0">
                <div class="d-flex align-items-center gap-2">
                    <div class="form-floating">
                        <input type="text" class="form-control rounded-4" name="subscription" placeholder="ติดตามรับข่าวขาร">
                        <label for="subscription" class="text-secondary">ติดตามรับข่าวขาร</label>
                    </div>
                    <button type="button" class="btn btn-outline-light border rounded-4 p-3">ติดตาม</button>
                </div>
            </div>
            <div class="flex-row d-flex flex-wrap gap-2 justify-content-center">
                <?php
                foreach ($linkContact as $index => $link) { ?>
                    <div class="d-flex align-items-center flex-column gap-2" style="width: 100px;">
                        <a href="<?= $link["link"] ?>" target="_blank" class="rounded-circle bg-white d-flex align-items-center justify-content-center text-primary fs-2" style="width: 50px; height: 50px;">
                            <?= $link["icon"] ?>
                        </a>
                        <h6 class="text-white"><?= $link["label"] ?></h6>
                    </div>
                <?php } ?>
            </div>
        </div>


        <div class="d-flex align-items-center justify-content-center container">

        </div>
    </div>
    <div class="text-center text-white bg-primary fw-bold fs-5 py-4">
        <?= $copyright_text_var; ?>
    </div>
</footer>
