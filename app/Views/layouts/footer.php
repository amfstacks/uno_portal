<!-- // app/Views/layouts/footer.php -->
  <?= $school['footer_html'] ?? '<footer class="bg-gray-800 text-white p-4 text-center">© '.date('Y').' '.$school['name'].'</footer>' ?>
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script> -->
  <?php if ($toast = session()->getFlashdata('toast')): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Toastify({
            text: "<?= esc($toast['message']) ?>",
            duration: 3000,
            backgroundColor: "<?= $toast['type'] === 'success' ? 'green' : 'red' ?>",
            position: "right",
            gravity: "top"
        }).showToast();
        
    });
</script>
<?php endif; ?>
<script>
    // Auto-close modal on success toast
    document.addEventListener('toast', function(e) {
        const modal = document.getElementById('createOfficerModal');
        if (modal && modal.open) modal.close();
    });
</script>
<script src="<?= base_url('assets/js/utils.js') ?>"></script>
  <script><?= $school['custom_js'] ?? '' ?></script>
</body>
</html>