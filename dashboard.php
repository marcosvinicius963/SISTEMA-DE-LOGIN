<?php
    session_start();
    

    if(isset($_SESSION["usuario"]) && is_array($_SESSION["usuario"])){
        require("acoes/conexao.php");


        $adm = $_SESSION["usuario"][1];
        $nome = $_SESSION["usuario"][0];
    }else{
        echo "<script>window.location = 'index.html'</script>";
    }
?>

<html>
        <head>
            <title>Dashboard - <?echo $nome; ?></title>
        </head>
        <body>
        <?php if($adm): ?>
            <table width=50%">
                <thead>
                    <tr  style="font-weight: bold">
                        <td>Email</td>
                        <td>Senha</td>
                        <td>Nome</td>
                        <td>ADM</td>
                        <td>ID</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query =$conexao->prepare("SELECT * FROM usuarios");
                        $query->execute();

                        $users = $query->fetchAll(PDO::FETCH_ASSOC);

                        for($i= 0; $i <sizeof($users); $i++):
                            $usuarioAtual = $users[$i];
                    ?>
                    <tr>
                        <td> <? echo $usuarioAtual["email"];?> </td>
                        <td> <? echo $usuarioAtual["senha"];?> </td>
                        <td> <? echo $usuarioAtual["nome"];?> </td>
                        <td> <? echo $usuarioAtual["adm"];?> </td>
                        <td> <? echo $usuarioAtual["id"];?> </td>
                    </tr>
                    <?php
                        endfor;
                    ?>
                </tbody>
            </table>
        <?php endif; ?>

        <a href="acoes/logout.php">sair</a>
        </body>
</html>