<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Email Address</title>
</head>
<body>
    <p>Assalamu'alaikum, {{ $name }},</p>
    <p>Terima kasih sudah mendaftar PPDB MAN 1 Bogor! Untuk melanjutkan proses pendaftaran, mohon klik tautan di bawah ini untuk verifikasi alamat email:</p>
    <p><a href="{{ route('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]) }}">Verifikasi Email PPDB</a></p>
    <p>Terima kasih atas partisipasinya dalam PPDB MAN 1 Bogor.</p>
</body>
</html>
