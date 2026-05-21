<?php
$page_title = isset($page_title) ? $page_title : 'Dashboard';
$breadcrumbs = isset($breadcrumbs) ? $breadcrumbs : [];
?>
<div class="admin-page-header mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
        <div>
            <h1 class="admin-page-title"><?= html_escape($page_title) ?></h1>
            <?php if (!empty($breadcrumbs)): ?>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb admin-breadcrumb mb-0">
                    <?php foreach ($breadcrumbs as $i => $crumb): ?>
                        <?php if ($i === count($breadcrumbs) - 1): ?>
                            <li class="breadcrumb-item active" aria-current="page"><?= html_escape($crumb['label']) ?></li>
                        <?php else: ?>
                            <li class="breadcrumb-item">
                                <a href="<?= isset($crumb['url']) ? $crumb['url'] : '#' ?>"><?= html_escape($crumb['label']) ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
            </nav>
            <?php endif; ?>
        </div>
        <?php if (!empty($page_actions)): ?>
        <div class="admin-page-actions flex-shrink-0">
            <?= $page_actions ?>
        </div>
        <?php endif; ?>
    </div>
</div>
