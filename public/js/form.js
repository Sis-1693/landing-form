// public/js/form.js

document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById('appointmentForm');
  const appointmentDate = document.getElementById('appointmentDate');
  const landingContent = document.getElementById('landingContent');
  const showFormBtn = document.getElementById('showFormBtn');

  // Restrict appointment date to today + 10 days
  const today = new Date();
  const minDate = today.toISOString().split('T')[0];
  const maxDate = new Date(today.getTime() + 10 * 24 * 60 * 60 * 1000).toISOString().split('T')[0];
  appointmentDate.min = minDate;
  appointmentDate.max = maxDate;

  // Show form with slide/fade animation
  showFormBtn.addEventListener('click', () => {
    landingContent.classList.add('slide-left');
    landingContent.classList.add('hidden');

    setTimeout(() => {
      landingContent.style.display = 'none';
      form.style.display = 'block';
      form.classList.add('slide-right');
      form.classList.add('hidden');
      setTimeout(() => {
        form.classList.remove('slide-right');
        form.classList.remove('hidden');
      }, 50);
    }, 600);
  });

  // Form submission with AJAX and animation on success
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(form);
    const photo = formData.get('photo');

    // Clear errors
    document.querySelectorAll('.error').forEach(el => el.textContent = '');

    // Photo size validation
    if (photo && photo.size > 1024 * 1024) {
      document.getElementById('err_photo').textContent = 'Photo must be 1MB or smaller.';
      return;
    }

    // Auto-prefix LinkedIn
    let linkedin = formData.get('linkedin');
    if (linkedin && !linkedin.startsWith('http')) {
      formData.set('linkedin', 'https://' + linkedin);
    }

    fetch("/submit-form", {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Data submitted successfully.',
          confirmButtonColor: '#3085d6'
        }).then(() => {
          // Animate form out
          form.classList.add('slide-right');
          form.classList.add('hidden');

          setTimeout(() => {
            form.style.display = 'none';
            form.classList.remove('slide-right', 'hidden');
            form.reset();

            // Show landing content again
            landingContent.style.display = 'block';
            landingContent.classList.add('slide-left');
            landingContent.classList.add('hidden');
            setTimeout(() => {
              landingContent.classList.remove('slide-left', 'hidden');
            }, 50);
          }, 600);
        });
      } else {
        // Show validation errors
        Object.keys(data.errors).forEach(field => {
          const errEl = document.getElementById(`err_${field}`);
          if (errEl) errEl.textContent = data.errors[field][0];
        });
      }
    })
    .catch(err => {
      console.error('Submission error:', err);
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong! Please try again.',
        confirmButtonColor: '#e74c3c'
      });
    });
  });
});
