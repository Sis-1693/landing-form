<!-- resources/views/landing.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Appointment Landing Page</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div id="container">
    <div id="landingContent">
      <h1>Welcome to Our Appointment Portal</h1>
      <p>Click below to schedule your appointment</p>
      <button id="showFormBtn">Book Appointment</button>
    </div>

    <form id="appointmentForm" enctype="multipart/form-data">
      <label for="full_name">Full Name</label>
      <input type="text" name="full_name" id="full_name" placeholder="Full Name">
      <div class="error" id="err_full_name"></div>

      <label for="email">Email</label>
      <input type="email" name="email" id="email" placeholder="Email">
      <div class="error" id="err_email"></div>

      <label for="phone">Phone Number</label>
      <input type="text" name="phone" id="phone" placeholder="Phone Number">
      <div class="error" id="err_phone"></div>

      <label for="linkedin">LinkedIn Profile</label>
      <input type="url" name="linkedin" id="linkedin" placeholder="https://linkedin.com/in/your-profile">
      <div class="error" id="err_linkedin"></div>

      <label for="photo">Photo</label>
      <input type="file" name="photo" id="photo" accept="image/*">
      <div class="error" id="err_photo"></div>

      <label for="appointment_date">Appointment Date</label>
      <input type="date" name="appointment_date" id="appointmentDate">
      <div class="error" id="err_appointment_date"></div>

      <button type="submit">Submit</button>
    </form>
  </div>

  <script src="{{ asset('js/form.js') }}"></script>
  <script>
    // Show form with animation
    const landingContent = document.getElementById('landingContent');
    const form = document.getElementById('appointmentForm');
    const showFormBtn = document.getElementById('showFormBtn');

    showFormBtn.addEventListener('click', () => {
      landingContent.classList.add('slide-left', 'hidden');
      setTimeout(() => {
        landingContent.style.display = 'none';
        form.style.display = 'block';
        form.classList.remove('slide-right', 'hidden');
        setTimeout(() => form.classList.remove('slide-right'), 50);
      }, 600);
    });
  </script>
</body>
</html>
