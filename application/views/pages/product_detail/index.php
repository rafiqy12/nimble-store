<!-- ======= DETAIL SECTION START ======= -->
<?php
// Ambil tanggal produk dari database
$productDate = $product['created_at']; // Pastikan field ini ada di database Anda

// Cek apakah produk ditambahkan dalam 7 hari terakhir
$sevenDaysAgo = strtotime('-7 days'); // Mendapatkan timestamp 7 hari yang lalu
$productTimestamp = strtotime($productDate); // Mengonversi tanggal produk ke timestamp

// Jika produk ditambahkan dalam 7 hari terakhir, tampilkan "New Release"
$isNewRelease = $productTimestamp >= $sevenDaysAgo;
?>
<section
    class="mt-[32px] flex flex-col gap-6 container items-center justify-center lg:mt-[60px] lg:flex-row lg:gap-[70px] lg:items-stretch">
    <!-- PRODUCT -->
    <img src="<?= base_url("public/uploads/" . (isset($product['image_url']) ? $product['image_url'] : 'default-image.png')); ?>"
        class="block w-full h-full max-h-[280px] rounded-2xl object-cover lg:max-h-[872px]" alt="product-image"
        loading="lazy">
    <form method="post" action="<?php echo site_url('Cart/add/' . $product['id']); ?>" class="flex flex-col gap-6 items-start justify-center w-full lg:gap-8" id="add-to-cart-form">
        <div class="flex flex-col gap-2 w-full items-start justify-center lg:gap-4">
            <?php if ($isNewRelease) { ?>
                <span class="bg-royal-blue rounded-lg font-rubik font-semibold text-xs text-white py-2 px-4 lg:rounded-xl lg:py-3">New Release</span>
            <?php } ?>
            <h3 class="font-rubik font-semibold text-xl text-dark-charcoal uppercase lg:text-[32px]">
                <?= $product['name']; ?>
            </h3>
            <p class="text-royal-blue font-rubik font-semibold text-2xl">$<?= $product['price']; ?></p>
        </div>
        <div class="flex flex-col gap-2 items-start justify-center w-full lg:gap-4">
            <h4 class="font-rubik font-semibold text-base text-dark-charcoal">Color</h4>
            <span class="size-6 rounded-full bg-<?= $product['color_name']; ?> lg:size-8"></span>
        </div>
        <div class="flex flex-col gap-2 items-start justify-center w-full lg:gap-4">
            <h4 class="font-rubik font-semibold text-base text-dark-charcoal">Size</h4>
            <div class="flex flex-wrap gap-2 items-center justify-start lg:gap-1 w-full">
                <!-- Size Select -->
                <select id="size-select" name="size" class="max-w-[75px] rounded-lg bg-white text-dark-charcoal font-rubik font-medium text-sm py-[15.5px] px-4 w-full border-none outline-none ring-0 focus:outline-none focus:ring-0 focus:border-none">
                    <option value="" class="transition-all duration-300 hover:bg-royal-blue">Size</option>
                    <?php foreach ($product_sizes as $product_size) { ?>
                        <?php if (!empty($size_ada)) { ?>
                            <option value="<?php echo $product_size['id_sizes']; ?>" class="transition-all duration-300 hover:bg-royal-blue">
                                <?php echo $product_size['size_name']; ?>
                            </option>
                        <?php } ?>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="flex flex-col gap-2 items-center justify-center w-full">
            <?php if ($this->session->userdata('user_logged_in')): ?>
                <?php if ($this->session->userdata('role') != 'admin'): ?>
                    <button type="submit"
                        class="w-full bg-dark-charcoal text-off-white rounded-lg font-rubik font-medium text-sm uppercase py-[15.5px] transition-all duration-300 hover:scale-105">Add
                        To Cart</button>
                <?php endif; ?>
            <?php else: ?>
                <button type="button"
                    class="w-full bg-dark-charcoal text-off-white rounded-lg font-rubik font-medium text-sm uppercase py-[15.5px] transition-all duration-300 hover:scale-105"
                    onclick="window.location.href = '<?php echo base_url('login'); ?>'">Add
                    To Cart</button>
            <?php endif; ?>
        </div>
        <div class="flex flex-col gap-2 items-start justify-center w-full">
            <h3 class="font-rubik font-semibold text-base text-dark-charcoal uppercase">About the product</h3>
            <p class="font-open-sans font-normal text-base text-dark-charcoal/80">
                <?= $product['description']; ?>
            </p>
        </div>
    </form>
</section>
<!-- ======= DETAIL SECTION END ======= -->

<!-- ======= REVIEWS SECTION START ======= -->
<section class="w-full mt-[45px] flex flex-col container items-start justify-center gap-6 lg:mt-[100px] lg:gap-8">
    <div class="w-full flex items-center justify-between">
        <h3 class="font-rubik font-semibold text-2xl text-dark-charcoal lg:text-5xl">Reviews</h3>
        <?php if ($this->session->userdata('user_logged_in')): ?>
            <button type="button"
                class="bg-royal-blue rounded-[8px] font-rubik font-medium text-sm text-white py-[11.5px] px-4 w-full max-w-[157px] lg:text-lg lg:py-3 lg:px-8 lg:max-w-[270px] uppercase transition-all duration-300 hover:scale-105"
                id="button-add-review">Add
                Review</button>
        <?php endif; ?>
    </div>
    <!-- COMMENTS -->
    <div class="grid grid-cols-1 gap-y-6 gap-x-4 items-stretch justify-center w-full lg:gap-4 lg:grid-cols-4">
        <?php if (!empty($comments)) { ?>
            <?php foreach ($comments as $comment) { ?>
                <div class="flex flex-col items-center justify-center w-full bg-off-white p-4 rounded-[16px] gap-4">
                    <div class="flex items-start justify-between w-full">
                        <div class="flex flex-col gap-2 items-start justify-start max-w-[85%]">
                            <h4 class="font-rubik font-semibold text-xl text-dark-charcoal lg:text-2xl">
                                <?= isset($comment['user_name']) ? $comment['user_name'] : 'No users'; ?>
                            </h4>
                            <p class="font-open-sans font-normal text-sm text-dark-charcoal/80 lg:text-base">
                                <?= isset($comment['comment']) ? $comment['comment'] : 'No comment'; ?>
                            </p>
                            <div class="flex items-center justify-start gap-1 w-full">
                                <?php if (isset($comment['rating'])) {
                                    for ($i = 1; $i <= $comment['rating']; $i++) { ?>
                                        <img src="<?= base_url('public/icons/products/star.png'); ?>" alt="star"
                                            class="block size-4 lg:size-6" loading="lazy">
                                <?php }
                                } ?>
                                <p class="font-open-sans font-semibold text-sm text-dark-charcoal ml-1">
                                    <?= number_format($comment['rating'], 1); ?>
                                </p>
                            </div>
                        </div>
                        <img src="<?= base_url("public/uploads/" . (isset($product['image_url']) ? $product['image_url'] : 'default-image.png')); ?>"
                            class="block size-12 lg:size-24 rounded-full object-cover" alt="product-image" loading="lazy">
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No reviews available for this product.</p>
        <?php } ?>
    </div>
</section>
<!-- ======= REVIEWS SECTION END ======= -->


<!-- ======= ADD REVIEWS SECTION START ======= -->
<section
    class="mt-[32px] bg-off-white container w-[60%] rounded-2xl px-4 pt-6 pb-[34px] flex flex-col gap-5 items-center justify-center lg:mt-[60px] lg:gap-6 lg:pt-6 lg:pb-[45px] lg:rounded-3xl fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 lg:w-[600px] hidden"
    id="add-review">
    <div class="flex flex-col gap-2 items-center justify-center lg:max-w-[480px]">
        <h3 class="font-rubik font-semibold text-2xl text-dark-charcoal lg:text-4xl">Add Review</h3>
    </div>
    <!-- FORM INPUTS -->
    <form action="<?php echo site_url('Admin/add_comment_action') ?>" method="post"
        class="flex flex-col gap-5 items-center justify-center w-full lg:max-w-[480px] lg:gap-6">
        <!-- Input tambahan untuk product_id -->
        <input type="hidden" name="product_id" value="<?= $product['id']; ?>">

        <!-- Input tambahan untuk user_name -->
        <input type="hidden" name="user_id" value="<?= $this->session->all_userdata()['id']; ?>">


        <!-- Input untuk komentar -->
        <div class="flex flex-col gap-4 items-start justify-center w-full lg:gap-5">
            <textarea name="comment" id="comment" rows="4"
                class="rounded-lg border border-solid border-dark-charcoal focus:ring-0 focus:outline-none w-full py-[14.5px] px-4 font-rubik font-normal text-dark-charcoal text-base placeholder:text-[#79767C]"
                placeholder="Comment"></textarea>

            <!-- Input untuk rating -->
            <input type="number" name="rating" id="rating" min="1" max="5"
                class="rounded-lg border border-solid border-dark-charcoal focus:ring-0 focus:outline-none w-full py-[14.5px] px-4 font-rubik font-normal text-dark-charcoal text-base placeholder:text-[#79767C]"
                placeholder="Rating (1-5)">
        </div>

        <!-- Tombol Kirim -->
        <button type="submit"
            class="rounded-lg bg-dark-charcoal py-4 px-[74px] w-full text-white font-rubik text-sm font-medium flex gap-1 items-center justify-center lg:gap-2 transition-all duration-300 hover:scale-105">Add
            Review
            <img src="<?= base_url('public/icons/register/arrow-forward.png'); ?>" alt="arrow"
                class="block w-4 text-base text-white" loading="lazy">
        </button>

        <!-- Tombol Batal -->
        <button type="button"
            class="rounded-lg bg-off-white py-4 px-[74px] w-full text-dark-charcoal font-rubik text-sm font-medium flex gap-1 items-center justify-center lg:gap-2 border border-solid border-dark-charcoal transition-all duration-300 hover:scale-105"
            id="cancel-add-review">Cancel
        </button>
    </form>
</section>
<!-- ======= ADD REVIEWS SECTION END ======= -->

<!-- ======= ADD REVIEWS SECTION END ======= -->

<script>
    const buttonAddReview = document.getElementById('button-add-review');
    const cancelAddReview = document.getElementById('cancel-add-review');
    const addReview = document.getElementById('add-review');

    document.addEventListener('click', function(event) {
        if (event.target === buttonAddReview) {
            addReview.classList.remove('hidden');
        }

        if (event.target === cancelAddReview) {
            addReview.classList.add('hidden');
        }
    });
</script>

<!-- JavaScript for form validation -->
<script>
    document.getElementById('add-to-cart-form').addEventListener('submit', function(event) {
        var sizeSelect = document.getElementById('size-select');
        if (sizeSelect.value === "") {
            // Menampilkan peringatan jika ukuran belum dipilih
            alert('Please select a size before adding to cart.');
            event.preventDefault(); // Mencegah form untuk disubmit
        }
    });
</script>

<!-- ======= SWEETALERT START ======= -->
<?php if ($this->session->flashdata('success')): ?>
    <script>
        Swal.fire({
            title: "Success!",
            text: "<?= $this->session->flashdata('success'); ?>",
            icon: "success",
            confirmButtonText: "OK"
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <script>
        Swal.fire({
            title: "Error!",
            html: "<ul><?= $this->session->flashdata('error'); ?></ul>",
            icon: "error",
            confirmButtonText: "OK"
        });
    </script>
<?php endif; ?>
<!-- ======= SWEETALERT END ======= -->