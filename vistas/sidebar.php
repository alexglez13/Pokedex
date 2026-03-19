<nav class="menu">
<ul>
    <li><a href="tipos.php">Inicio</a></li>
    <li><a href="prueba.php">Registra</a></li>
    <li><a href="control.php">Control</a></li>
</ul>
</nav>

<!-- inicio de estilo -->
 <style>
/* CONTENEDOR DEL MENU */
.menu{
    background: linear-gradient(90deg, #f7dc6f, #f4d03f);
    padding: 10px 0;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
}

/* LISTA */
.menu ul{
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center; /* centra el menú */
}

/* ITEMS */
.menu ul li{
    margin: 0 15px;
}

/* LINKS */
.menu ul li a{
    text-decoration: none;
    color: #000;
    font-weight: bold;
    padding: 10px 20px;
    border-radius: 20px;
    transition: all 0.3s ease;
}

/* HOVER BONITO */
.menu ul li a:hover{
    background-color: #fff3b0;
    color: #333;
    transform: scale(1.05);
}

/* ACTIVO (opcional) */
.menu ul li a.active{
    background-color: #ffffff;
    box-shadow: 0px 3px 8px rgba(0,0,0,0.2);
}
</style>