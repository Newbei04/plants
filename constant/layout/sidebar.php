<?php
include('../constant/connect.php');
?>

<div class="left-sidebar">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">Home</li>

                <li>
                    <a href="dashboard.php" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span></a>
                </li>

                <li class="nav-label">Management</li>
                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-leaf"></i><span class="hide-menu">Herbal Plants</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="new_herbal.php">Add Herbal</a></li>
                        <li><a href="manage_herbal.php">Manage Herbal</a></li>
                        <li><a href="activate_herbal.php">Archived Herbal</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-tree"></i><span class="hide-menu">Not Herbal Plants</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="new_not_herbal.php">Add Not Herbal</a></li>
                        <li><a href="manage_not_herbal.php">Manage Not Herbal</a></li>
                        <li><a href="activate_not_herbal.php">Archived Not Herbal</a></li>
                    </ul>
                </li>

                <li>
                    <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-list"></i><span class="hide-menu">Categories</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="new_categories.php">Add Categories</a></li>
                        <li><a href="manage_categories.php">Manage Categories</a></li>
                    </ul>
                </li>

                <li>
                    <a href="profile.php" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">Profile</span></a>
                </li>
            </ul>
        </nav>
    </div>
</div>