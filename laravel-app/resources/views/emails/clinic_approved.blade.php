<h2>Hello {{ $clinic->clinic_name }},</h2>

<p>Congratulations! Your clinic has been approved by the MediQTrack admin.</p>

<p>You can now log in using your email:</p>

<ul>
  <li><strong>Email:</strong> {{ $clinic->email }}</li>
  <li><strong>Login:</strong> <a href="{{ route('clinic.login') }}">Click here to login</a></li>
</ul>

<p>Thank you for registering with us!</p>
