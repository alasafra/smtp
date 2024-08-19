<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Send Email</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container mt-5">
    <h1 class="text-center">Send an Email</h1>
    <form id="emailForm" class="mt-4">
      <div class="container-fluid mt-5">
        <div class="row">
          <div class="col-md-12 col-lg-6">
            <h4>SMTP Settings</h4>
            <div class="mb-3">
              <label for="smtp_host" class="form-label">SMTP Host</label>
              <input type="text" class="form-control" id="smtp_host" name="smtp_host" required>
            </div>
            <div class="mb-3">
              <label for="smtp_secure" class="form-label">SMTP Secure</label>
              <select class="form-control" id="smtp_secure" name="smtp_secure" required>
                <option value="">Select Security Protocol</option>
                <option value="ssl">SSL</option>
                <option value="tls">TLS</option>
                <option value="starttls">STARTTLS</option>
                <option value="none">None</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="smtp_port" class="form-label">SMTP Port</label>
              <input type="text" class="form-control" id="smtp_port" name="smtp_port" required>
            </div>
            <div class="mb-3">
              <label for="smtp_user" class="form-label">SMTP User</label>
              <input type="email" class="form-control" id="smtp_user" name="smtp_user">
            </div>
            <div class="mb-3">
              <label for="smtp_pass" class="form-label">SMTP Password</label>
              <input type="password" class="form-control" id="smtp_pass" name="smtp_pass">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="smtp_auth" name="smtp_auth">
              <label class="form-check-label" for="smtp_auth">Enable SMTP Authentication</label>
            </div>
          </div>
          <div class="col-md-12 col-lg-6">
            <h4>Email Details</h4>
            <div class="mb-3">
                <label for="email" class="form-label">Recipient Emails</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter multiple emails separated by commas" required>
            </div>
            <div class="mb-3">
              <label for="subject" class="form-label">Subject</label>
              <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- Debug Output -->
  <div class="container mt-5">
    <div class="container-fluid mt-5">
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <div class="mt-4">
              <h5>Debug Log:</h5>
              <pre id="debugOutput" class="bg-light p-3"></pre>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
        $(document).ready(function() {
            $('#emailForm').on('submit', function(e) {
                e.preventDefault();
                $('#debugOutput').html('Sending...');
                $.ajax({
                    type: 'POST',
                    url: 'send_email.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#debugOutput').html(response);
                    }
                });
            });
        });
  </script>
</body>

</html>