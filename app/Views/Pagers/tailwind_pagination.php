<?php
$pager->setSurroundCount(1);

// Ambil query string yang sudah ada
$query = $_GET;
?>
<nav aria-label="Pagination">
    <ul class="inline-flex items-center space-x-1">
        <?php if ($pager->hasPrevious()) : ?>
            <?php
            $query['page_number'] = $pager->getPreviousPageNumber();
            $prevUrl = current_url() . '?' . http_build_query($query);
            ?>
            <li>
                <a href="<?= $prevUrl ?>"
                    class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition">
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
                    class="px-3 py-1 text-sm font-medium border rounded transition
                          <?= $link['active']
                                ? 'bg-blue-500 text-white border-blue-500 hover:bg-blue-600'
                                : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100' ?>">
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
                    class="px-3 py-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-100 transition">
                    &raquo;
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>