<div class="container">
    <section class="jumbotron text-center bg-white">
        <div class="container">
            <h1>Favourites</h1>
            <p class="lead text-muted">Here you can remove or view the favourites</p>
        </div>
    </section>
    <div>
        <div class="row justify-content-center">
            <?php foreach ($favorites as $book) : ?>
                <div class="col-lg-3 product-card favorite-card">

                    <a class="text-dark" href="<?= base_url('users/bookDetail/') . $book->id ?>" title="<?= $book->book_name ?>">
                        <div class="card mb-4 box-shadow favorites-box">
                            <img class="card-img-top favorite-list-img" src="<?= $book->book_image ?>" alt="<?= $book->book_name ?>">
                            <div class="card-body favorite-card-body">
                                <div class="pname">
                                    <h2 style="font-size:17px;font-weight:bold"><?= $book->book_name ?></h2>

                                </div>

                                <div class="product-author-publisher">
                                    <h9 class="product-author" style="font-weight: 400; font-style: italic">
                                        <?= $book->author ?>
                                    </h9>
                                    <h9 class="publisher"><?= $book->publisher ?></h9>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div id="favourite-section">
                                        <form action="<?= base_url() . 'user_account/favoriteBook/' . $book->id ?>" method="POST" style="margin: 0 !important; padding:0 !important;">
                                            <button type="submit" name="product_id" value="<?= $book->id ?>" class="btn btn-outline-primary remove-from-favorites">
                                                Remove
                                            </button>

                                        </form>
                                        <a class="btn btn-outline-success view-product-detail" href="<?= base_url('users/bookDetail/') . $book->id ?>">View</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>