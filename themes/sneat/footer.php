					</div>
					<!-- / Content -->
				</div>
				<!-- Footer -->
				<footer class="content-footer footer bg-footer-theme">
					<div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
						<div class="mb-2 mb-md-0">
							© <?=date('Y')?> <?= env('FOOTER_TEXT') ?> Theme by
							<a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
						</div>
					</div>
				</footer>
				<!-- / Footer -->

				<div class="content-backdrop fade"></div>
			</div>
			<!-- Content wrapper -->
		</div>
		<!-- / Layout page -->
	</div>

	<!-- Overlay -->
	<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->



<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="<?= asset('theme/assets/vendor/libs/jquery/jquery.js') ?>"></script>
<script src="<?= asset('theme/assets/vendor/libs/popper/popper.js') ?>"></script>
<script src="<?= asset('theme/assets/vendor/js/bootstrap.js') ?>"></script>
<script src="<?= asset('theme/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>

<script src="<?= asset('theme/assets/vendor/js/menu.js') ?>"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?= asset('theme/assets/vendor/libs/apex-charts/apexcharts.js') ?>"></script>

<!-- Main JS -->
<script src="<?= asset('theme/assets/js/main.js') ?>"></script>

<!-- Page JS -->
<script src="<?= asset('theme/assets/js/dashboards-analytics.js') ?>"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Datatables -->
<script src="<?= asset('theme/assets/js/datatables/datatables.min.js') ?>"></script>
<script src="<?= asset('theme/assets/js/datatables/datatables.bootstrap5.min.js') ?>"></script>
<script src="<?= asset('theme/assets/js/datatables-pagingtype/full_numbers_no_ellipses.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php foot_script() ?>
</body>

</html>