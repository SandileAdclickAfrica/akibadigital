<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h1>test</h1>

<form method="POST" action="/" enctype="multipart/form-data" >
    @csrf
    <input type="email" name="email" placeholder="email" >
    <input type="file" name="bankStatement" id="bankStatement" required>
    <input type="file" name="identity" id="identity" required>
    <input type="submit" value="Submit">
</form>

</body>
</html>