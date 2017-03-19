<html>
<head></head>
<body>
	<div>
	    <h2>{{ $subject }}</h2>
	</div>

	<div style="margin-top: 5px">
        <p>From: {{ $sender_name }}</p>
        <p>Email: {{ $sender_email }}</p>
        <p>Contact: {{ $telephone }}</p>
    </div>

	<div style="margin-top: 5px">
	{{ $body }}
	</div>
</body>
</html>