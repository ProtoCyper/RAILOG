<?php
$pager->setSurroundCount(1);

// Ambil query string yang sudah ada
$query = $_GET;
?>
<nav aria-label="Pagination">
    <ul class="inline-flex items-center gap-2">
        <?php if ($pager->hasPrevious()) : ?>
            <?php
            $query['page_number'] = $pager->getPreviousPageNumber();
            $prevUrl = current_url() . '?' . http_build_query($query);
            ?>
            <li>
                <a href="<?= $prevUrl ?>"
                    class="inline-flex items-center justify-center min-w-[40px] h-10 px-3 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition">
                    &laquo;
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link): ?>
            <?php
            $query['page_number'] = $link['title'];
            $url = current_url() . '?' . http_build_query($query);
            ?>
            <li>
                <a href="<?= $url ?>"
                    class="inline-flex items-center justify-center min-w-[40px] h-10 px-3 text-sm font-semibold border rounded-lg transition <?= $link['active'] ? 'active' : '' ?>
                          <?= $link['active']
                                ? 'bg-blue-500 text-white border-blue-500 shadow-sm hover:bg-blue-600 hover:border-blue-600'
                                : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50 hover:border-gray-300' ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <?php
            $query['page_number'] = $pager->getNextPageNumber();
            $nextUrl = current_url() . '?' . http_build_query($query);
            ?>
            <li>
                <a href="<?= $nextUrl ?>"
                    class="inline-flex items-center justify-center min-w-[40px] h-10 px-3 text-sm font-semibold text-gray-700 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition">
                    &raquo;
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>
