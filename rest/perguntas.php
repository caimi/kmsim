<?php 

function getPergunta($id) {
    $sql = "SELECT t.id, t.nome, t.tipo FROM perguntas t WHERE id=:id";
    try {
        $dbCon = getDbConn();
        $stmt = $dbCon->prepare($sql);  
        $stmt->bindParam("id", $id);
        $stmt->execute();
        $tag = $stmt->fetchObject();  
        $dbCon = null;
        echo json_encode($tag); 
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function tagsByTipo($query) {
    $sql = "SELECT * FROM tags WHERE tipo LIKE :query order by nome";
    try {
        $dbCon = getDbConn();
        $stmt = $dbCon->prepare($sql);
        $query = "%".$query."%";
        $stmt->bindParam("query", $query);
        $stmt->execute();
        $tag = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        //echo '{"tags": ' . json_encode($tag) . '}';
        echo json_encode($tag);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}
function tagsSearch($query, $tipo) {
    $sql = "SELECT nome as text FROM tags WHERE nome LIKE :query and tipo = :tipo order by nome";
    try {
        $dbCon = getDbConn();
        $stmt = $dbCon->prepare($sql);
        $query = "%".$query."%";
        $stmt->bindParam("query", $query);
        $stmt->bindParam("tipo", $tipo);
        $stmt->execute();
        $tag = $stmt->fetchAll(PDO::FETCH_OBJ);
        $dbCon = null;
        echo json_encode($tag);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function addTag(){
    global $app;
    
    //using angular 
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $pNome = $request->nome;
    $pTipo = $request->tipo;
    
    $sql = "INSERT INTO tags (`nome`,`tipo`) VALUES (:nome, :tipo)";
    try {
        $dbCon = getDbConn();
        $stmt = $dbCon->prepare($sql);  
        $stmt->bindParam("nome", $pNome);
        $stmt->bindParam("tipo", $pTipo);
        $stmt->execute();
        $dbCon = null;
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}

function deleteTag($id) {
    $sql = "DELETE FROM tags WHERE id=:id";
    try {
        $dbCon = getDbConn();
        $stmt = $dbCon->prepare($sql);  
        $stmt->bindParam("id", $id);
        $status = $stmt->execute();
        $dbCon = null;
        echo json_encode($status);
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}'; 
    }
}