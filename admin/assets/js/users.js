document.addEventListener('DOMContentLoaded', () => {
  const toast = document.getElementById('toast');

  document.querySelectorAll('form.ajax-action').forEach(form => {
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(form);
      const id = formData.get('id');
      const action = formData.get('action');

      try {
        const res = await fetch('users.php', {
          method: 'POST',
          body: formData
        });

        if (!res.ok) throw new Error('Server error');

        // Cập nhật dòng hiện tại
        const row = form.closest('tr');

        if (action === 'toggle_role') {
          const roleCell = row.querySelector('td:nth-child(3)');
          roleCell.textContent = roleCell.textContent === 'admin' ? 'user' : 'admin';
        }

        if (action === 'toggle_block') {
          const statusCell = row.querySelector('td:nth-child(4)');
          const btn = form.querySelector('button');
          const isBlocked = statusCell.textContent === 'Bị chặn';

          statusCell.textContent = isBlocked ? 'Hoạt động' : 'Bị chặn';
          btn.textContent = isBlocked ? 'Chặn' : 'Bỏ chặn';
          btn.classList.toggle('btn-block');
          btn.classList.toggle('btn-unblock');
        }

        // Hiện toast
        toast.textContent = 'Cập nhật thành công!';
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3000);

      } catch (err) {
        alert('Có lỗi xảy ra!');
      }
    });
  });
});
