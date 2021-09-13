<head>
    <title>Fido Pizza</title>
    <!-- compiled and minfied CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <style type="text/css">
        .brand {
            background: #cbb09c !important;
        }
        .brand-text {
            color: #008000 !important;
        }
        form{
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }
        .pizza {
            max-width: 100px;
            margin: 40px auto 30px;
            display: block;
            position: relative;
            top: -30px;
        }

        body {
            background-image: url("img/body-bg3.jpg");
        }

        /* card styling */
        .photo-album {
            display: flex;
            flex-wrap: wrap;
        }
        .photo-frame {
            width: 300px;
            height: 200px;
            border: 2px solid goldenrod;
            border-radius: 10px;
            position: relative;
            margin: 15px;
            margin-bottom: 20px;
            padding-bottom: 25px;
            overflow: hidden;
        }
        .photo img {
            width: 100%;
            border-radius: 10px;
        }
        .photo-detail {
            display: none;
            position: absolute;
            width: 300px;
            top: 0;
        }
        .photo-detail h3 {
            background-color: lightsalmon;
            color: white;
            text-align: center;
        }
        .photo-detail p {
            color:whitesmoke;
        }
        .photo-frame:hover .photo-detail {
            display: block;
            background-color: rgba(199, 184, 146, 0.67);
        }
        .photo-frame:hover .photo {
            transform: scale(1.5) rotate(-30deg);
            transition: transform 2s ease-in-out;
        }
        /* end of card styling */
    </style>
</head>
<body class="blue lighten-4">
    <nav class="yellow z-depth-0">
        <div class="container">
            <a href="user.php" class="brand-logo brand-text">FIDO PIZZA <i class="fab fa-fonticons-fi"></i></a>
            <ul class="right">
                <li><a href="add.php" class="btn blue z-depth-0">Order Pizza  <i class="fas fa-pizza-slice"></i></a></li>
                <li><a href="login.php" class="btn red z-depth-0">LOG OUT</a></li>
                <li><a href="user-account.php" class="btn grey z-depth-0">Create account</a></li>
            </ul>
        </div>
    </nav>
