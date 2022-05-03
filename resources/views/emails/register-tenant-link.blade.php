@component('mail::message')
# Invitación
Tu arrendador ha compartido contigo este enlace para que puedas administrar tus rentas con él.

Registrarte no es obligatorio, pero te puede ser de utilidad :).
@component('mail::button', ['url' => $url])
Click para registarte
@endcomponent
@endcomponent