<script language="javascript" type="text/javascript" src="./js/ajaxCode.js"></script>
</head>
<div class="myName">
    <h1><a  href=<?php $_SERVER['PHP_SELF']?>  >Home</a></h1>
</div>
<ul class="menu">
    <li><a>TP1</a>
        <ul>
                <li><a href="#" onclick="showContent('services')">Service</a></li>
                <li><a href="#" onclick="showContent('contact_us')">Contact</a></li>
        </ul>
    </li>
    <li><a>TP2</a>
        <ul>
                <li><a href="#" onclick="showContent('login')">Se connecter</a></li>
                <li><a href="#" onclick="showContent('register')">S'enregistrer</a></li>
        </ul>
    </li>
    <li><a>TP3</a>
        <ul>
                <li><a href="#" onclick="showContent('exAjax')">AJAX</a></li>
        </ul>
    </li>
</ul>