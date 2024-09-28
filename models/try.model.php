<?php
    interface IEXample{
        public function getAll();
        //public function getSingle($data);
        //public function insert($data);
        //public function update($data);
        //public function delete($data);
    }

    class Example implements IEXample
    {

        protected $pdo, $glob;
        protected $table_name = "users";

        public function getAll(){
            $sql = "SELECT * FROM ".$this->table_name;
            try{
                $stmt = $this->pdo->prepare($sql);

                if($stmt->execute()){
                    $data = $stmt ->fetchAll();
                    if($stmt->rowCount()>=1){
                        return $this->glob->responsePayload($data, "Success betch","Gottem all",200);
                    }else{
                        return $this->glob->responsePayload(null,"U a Failure", "Nuh uh", 404);
                    }
                }
            }catch(\PDOException $e){
                echo $e->getMessage();
            }
        }
        public function insert($data){
            $sql = "INSERT INTO" .$this->table_name."(firstname,lastname,is_admin) VALUES(?,?,?)";
            try{
                $stmt = $this->pdo->prepare($sql);
                
                if($stmt->execute([$data->firstname, $data->lastname,$data->is_admin])){
                    return $this->glob->responsePayload(null,"Success Betch","Successfully inserted stepbro",200);
                }else{
                    return $this->glob->responsePayload(null,"Failure", "Missed bruh", 404);
                }
            }catch(\PDOException $e){
                echo $e->getMessage();
            }
        }
    }