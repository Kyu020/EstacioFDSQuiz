<?php
    interface IEXample{
        public function getAll();
        public function getSingle($data);
        public function insert($data);
        //public function update($data);
        public function delete($data);
    }

    class Example implements IEXample
    {
        
        protected $pdo, $glob;
        protected $table_name = "users";

        
        public function __construct(\PDO $pdo, GlobalMethods $glob){
            $this->pdo = $pdo;
            $this->glob = $glob;
            }
        

        public function getAll(){
            $sql = "SELECT * FROM users";
            try{
                $stmt = $this->pdo->prepare($sql);

                if($stmt->execute()){
                    $data = $stmt->fetchAll();
                    if($stmt->rowCount()>=1){
                        return $this->glob->responsePayload($data, "success","Here's your data",200);
                    }else{
                        return $this->glob->responsePayload(null,"failed", "No data found", 404);
                    }
                }

            }catch(\PDOException $e){
                echo $e->getMessage();
            }
        }
        public function getSingle($data){
            $sql = "SELECT * FROM".$this->table_name."WHERE id = ?";
            return "yo";
        }
        public function insert($data){
            $sql = "INSERT INTO".$this->table_name."(firstname,lastname,is_admin) VALUES(?,?,?)";
            try{
                $stmt = $this->pdo->prepare($sql);
                
                if($stmt->execute([$data->firstname, $data->lastname,$data->is_admin])){
                    return $this->glob->responsePayload(null,"success","Successfully inserted data",200);
                }else{
                    return $this->glob->responsePayload(null,"failed", "Failed to insert data", 404);
                }
            }catch(\PDOException $e){
                echo $e->getMessage();
            }
        }

        public function delete($id){
            $sql ="DELETE FROM ".$this->table_name." WHERE id = :id";
            try{
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([':id' => $id]);

                    if($stmt->rowCount()>0){
                        return $this->glob->responsePayload(null, "success","Here's your data",200);
                    }else{
                        return $this->glob->responsePayload(null,"failed", "No data found", 404);
                    }
                

            }catch(\PDOException $e){
                echo $e->getMessage();
            }
        }
    }