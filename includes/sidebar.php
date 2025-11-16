<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <?php
                $result = mysqli_query($conn,"SELECT * FROM assdt_sidebar WHERE is_active = 1 ORDER BY parent_id, tab_order");

                $sidebar = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $sidebar[$row['parent_id']][] = $row;
                }
                function renderSidebar($parent_id, $sidebar, $basePath)
                {
                    if (!isset($sidebar[$parent_id])) return;
                    foreach ($sidebar[$parent_id] as $item) {
                        echo '<li' . (isset($sidebar[$item['sidebar_id']]) ? ' class="sub-menu"' : '') . '>';
                        echo '<a href="' . $basePath . htmlspecialchars($item['link_url']) . '">';
                        if ($item['tab_icon_class']) echo '<i class="' . htmlspecialchars($item['tab_icon_class']) . '"></i>';
                        echo '<span>' . htmlspecialchars($item['tab_name']) . '</span>';
                        echo '</a>';
                        if (isset($sidebar[$item['sidebar_id']])) {
                            echo '<ul class="sub">';
                            renderSidebar($item['sidebar_id'], $sidebar, $basePath);
                            echo '</ul>';
                        }
                        echo '</li>';
                    }
                }
                renderSidebar(0, $sidebar, $basePath);

                ?>
                <li>
                    <a href="<?=$basePath?>basic_table.php">
                        <i class="fa fa-th"></i>
                        <span>DataTable Report</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<section id="main-content">