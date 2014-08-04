<?php 

function getPerguntas() {
    global $app;
    $sql = "SELECT p.*, m.nome as materia, i.nome as instituicao, g.nome as grau FROM perguntas p, tags m, tags i, tags g WHERE p.id_materia = m.id and p.id_instituicao = i.id and p.id_grau = g.id";
    
    $materia = $app->request()->get("materia");
    $ano = $app->request()->get("ano");
    
    if(isset($materia)){
        $sql .= " and t.nome = :materia";
    }
    if(isset($ano)){
        $sql .= " and p.ano = :ano";
    }
    
    try {
        $dbCon = getDbConn();
        $stmt = $dbCon->prepare($sql);
        if(isset($materia)){
             $stmt->bindParam("materia", $materia);
        }
        if(isset($ano)){
             $stmt->bindParam("ano", $ano);
        }
        $stmt->execute();
        $perguntas = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        echo json_encode($perguntas);
    } catch(PDOException $e) {
        echo '{"error":{"text":'.$e->getMessage() .'}}'; 
    }
}

function addPergunta(){
    global $app;
    
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    
    $pIdMateria = $request->materia;
    $pIdInstituicao = $request->instituicao;
    $pIdGrau = $request->grau;
    $pAno = $request->ano;
    $pEnunciado = $request->enunciado;
    $pExplicacao = $request->explicacao;
    $alternativas = $request->alternativas;
    $correta = $request->correta;
    
    $sql = "INSERT INTO kmsim.perguntas (`id_materia`,`id_instituicao`, `id_grau`, `ano`, `enunciado`, `explicacao`) VALUES ((select id from kmsim.tags where nome = :materia and tipo='materia'), select id from kmsim.tags where nome = :instituicao and tipo='instituicao'), (select id from kmsim.tags where nome = :grau and tipo='Grau'), :ano, :enunciado, :explicacao)";
    $sqlAlteranativas = "insert into alternativas (`id_pergunta`, `alternativa`, `correta`) VALUES (:pergunta, :alternativa, :correta)";

    try {
        $dbCon = getDbConn();
        $dbCon->beginTransaction();
        
        $stmt = $dbCon->prepare($sql);  
        $stmt->bindParam("materia", $pNome);
        $stmt->bindParam("instituicao", $pInstituicao);
        $stmt->bindParam("grau", $pGrau);
        $stmt->bindParam("ano", $pAno);
        $stmt->bindParam("enunciado", $pEnunciado);
        $stmt->bindParam("explicacao", $pExplicacao);
        //$stmt->execute();
        $lastId = $dbCon->lastInsertId();
        echo $stmt->debugDumpParams();
        
        $max = sizeof($huge_array);
        for($i = 0; $i < sizeof($alternativas);$i++){
            $stmt = $dbCon->prepare($sqlAlteranativas);  
            $stmt->bindParam("pergunta", $lastId);
            $stmt->bindParam("alternativa", $alternativas[$i]);
            $stmt->bindParam("correta", $i == $correta);
            //$stmt->execute();
            echo $stmt->debugDumpParams();
        }
        $dbCon = null;
    } catch(PDOException $e) {
        echo $postdata.'{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
?>