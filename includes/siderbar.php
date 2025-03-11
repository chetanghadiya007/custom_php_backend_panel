<!-- Main sidebar -->
<div class="sidebar sidebar-main sidebar-default">
	<div class="sidebar-content">

		<!-- Main navigation -->
		<div class="sidebar-category sidebar-category-visible">
			<div class="category-content sidebar-user">
				<div class="media">
					<a href="#" class="media-left"><img src="assets/images/avtar.png" class="img-circle img-sm" alt=""></a>
					<div class="media-body">
						<span class="media-heading text-semibold"><?=$_SESSION['user_name']?></span>
						<div class="text-size-mini text-muted">
							<?=$_SESSION['role_name']?>
						</div>
					</div>
				</div>
			</div>

			<div class="category-content no-padding">
				<ul class="navigation navigation-main navigation-accordion">
					<li <?php if($page == 'home'){echo 'class="active"';}?>><a href="index"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
					<li>
						<a href="#"><i class="fa fa-tags"></i> <span>Product Category</span></a>
						<ul>
							<li <?php if($page == 'category_manage'){echo 'class="active"';}?>><a href="category_manage"><i class="fa fa-list-ul"></i> <span>Category List</span></a></li>
							<li <?php if($page == 'category_add'){echo 'class="active"';}?>><a href="category_add"><i class="fa fa-plus-square"></i> <span>Add New Category</span></a></li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="fa fa-tags"></i> <span>Products</span></a>
						<ul>
							<li <?php if($page == 'product_manage'){echo 'class="active"';}?>><a href="product_manage"><i class="fa fa-list-ul"></i> <span>Product List</span></a></li>
							<li <?php if($page == 'product_add'){echo 'class="active"';}?>><a href="product_add"><i class="fa fa-plus-square"></i> <span>Add New Product</span></a></li>
						</ul>
					</li>
					<li <?php if($page == 'setting'){echo 'class="active"';}?>><a href="setting"><i class="icon-gear"></i> <span>My Profile</span></a></li>
				</ul>
			</div>
		</div>
		<!-- /main navigation -->
	</div>
</div>
<!-- /main sidebar -->